<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_manager_model extends CI_Model
{
	public function GetAllAdmin()
	{
		$this->db->select('local_admin_id,first_name,last_name');
		$this->db->from('app_local_admin');
		$query = $this->db->get();
		$AdminArr = $query->result_array();
		
		return $AdminArr;
	}
	
	public function SearchForm($data)
	{
		$html = '';
		$sl_no = 0;
		$start_date = date("Y-m-d",strtotime($data["start_date"]));
		$end_date = date("Y-m-d",strtotime($data["end_date"]));
		if($data['payment_type'] == '2')
		{
			$query = $this->db->query("SELECT *,(SELECT membership_name FROM app_membership_types WHERE membership_type_id = app_membership_payment_history.membership_type_id) AS membership_name,(SELECT currency_symbol FROM app_currency WHERE currency_id = (SELECT currency_id FROM app_membership_types WHERE membership_type_id = app_membership_payment_history.membership_type_id)) AS currency_symbol FROM app_membership_payment_history WHERE local_admin_id = ".$data['local_admin_id']." AND DATE_FORMAT(payment_date,'%Y-%m-%d') >= '".trim($start_date)."' AND DATE_FORMAT(payment_date,'%Y-%m-%d') <= '".trim($end_date)."'");
			$ResArr = $query->result();
			$rows = $query->num_rows();
			
                        $html .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
                                                  <thead> <tr>
                                                        <th width="5%" align="left">Sl.No.</th>
                                                        <th width="12%" align="left">Membership Title</th>
                                                        <th width="39%" align="left">Amount Paid</th>
                                                        <th width="13%" align="center">Activation Date</th>
                                                        <th width="8%" align="center">Expiry Date</th>
                                                        <th width="5%" align="center">Status</th>
                                                  </tr> </thead>';
                        if($rows > 0)
			{
				foreach($ResArr as $row)
				{
					$sl_no = $sl_no+1;
					
					if($row->status == '1') {
						$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
					} else {
						$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
					}
					
					$html .= '<tr>
								<td width="5%" align="left">'.$sl_no.'</td>
								<td width="12%" align="left">'.$row->membership_name.'</td>
								<td width="39%" align="left"><strong>'.$row->currency_symbol.'</strong>'.$row->amount_paid.'</td>
								<td width="13%" align="center">'.$row->activation_date.'</td>
								<td width="8%" align="center">'.$row->deactivation_date.'</td>
								<td width="5%" align="center">
								<a href="javascript:void(0);" onclick="change_status(\''.$row->membership_payment_history_id.'\')">
								<span id="replace_status_'.$row->membership_payment_history_id.'">'.$status.'</span>
								</a>
								</td>
								</tr>';
				}
				//CB#SOG#19-11-2012#PR#S
				$html .= '</table><div id="status"></div><div id="paginate"></div>';
				//CB#SOG#19-11-2012#PR#E
			}
			else 
			{		
                            $html .= '<tr><td colspan="5">No Results Found.</td></tr></table>'; 
	                }
		}		
		else		
		{
			$query = $this->db->query("SELECT *,(SELECT currency_symbol FROM app_currency WHERE currency_id = (SELECT currency_id FROM app_local_admin WHERE local_admin_id = ".$data['local_admin_id'].")) AS currency_symbol FROM app_membership_payment_smscall_credit_history WHERE local_admin_id = ".$data['local_admin_id']." AND DATE_FORMAT(date_purchased,'%Y-%m-%d') >= '".trim($start_date)."' AND DATE_FORMAT(date_purchased,'%Y-%m-%d') <= '".trim($end_date)."'");
			$ResArr = $query->result();
			$rows = $query->num_rows();			
			
                        $html .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
                                                 <thead>  <tr>
                                                        <th width="5%" align="left">Sl.No.</th>
                                                        <th width="12%" align="left">Package Name</th>
                                                        <th width="19%" align="left">Amount</th>
                                                        <th width="13%" align="center">Credit</th>
                                                        <th width="8%" align="center">Purchase Date</th>
                                                  </tr> </thead>';
                        if($rows > 0)
			{      
				foreach($ResArr as $row)
				{
					$sl_no = $sl_no+1;
					
                                      $html .= '<tr>
                                                <td width="5%" align="left">'.$sl_no.'</td>
                                                <td width="12%" align="left">'.$row->package_name.'</td>
                                                <td width="39%" align="left"><strong>'.$row->currency_symbol.'</strong>'.$row->amount.'</td>
                                                <td width="13%" align="center">'.$row->credit.'</td>
                                                <td width="8%" align="center">'.$row->date_purchased.'</td>
                                                </tr>';
				}
				//CB#SOG#19-11-2012#PR#S
				$html .= '</table><div id="status"></div><div id="paginate"></div>';
				//CB#SOG#19-11-2012#PR#E
			}
			else 
			{		
		         $html .= '<tr><td colspan="5">No Results Found.</td></tr></table>';
	                }
		}
		
		
		return $html;
	}
	
	
	public function ChangeStatus($membership_payment_history_id)
	{
		$this->db->select('status');
		$this->db->from('app_membership_payment_history');
		$this->db->where('membership_payment_history_id', $membership_payment_history_id);
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		
		if($StatusArr[0]['status'] == '1')
		{
			$data = array('status' => '0');
			$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
		}
		else
		{
			$data = array('status' => '1');
			$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('membership_payment_history_id', $membership_payment_history_id);
		$this->db->update('app_membership_payment_history ',$this->db->escape($data));
		$this->db->last_query();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 0;
		}
		else
		{
			$this->db->trans_commit();
			return $ret;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	public function Del()
	{
		$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
		$this->db->delete('app_membership_smscall_dtls'); 
		
		$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
		$this->db->delete('app_membership_smscall_rate_dtls'); 
		
		$ResArr = $this->GetAllCredits();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>
			<th align="left">Sl.No.</th>
			<th align="left">Package Title</th>
			<th align="left">Package Description</th>
			<th align="center">Package Amount</th>
			<th align="center">Credit</th>
			<th align="center">Status</th>
			<th colspan="2" align="center">Action</th>
		  </tr>';
		if(count($ResArr) > 0)
		{
			foreach($ResArr as $key=>$row)
			{
				$sl_no = $key+1;
				
				if($row['status'] == '1') {
					$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
				} else {
					$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
				}
				
				$html .= '<tr>
							<td align="left">'.$sl_no.'</td>
							<td align="left">'.$row["package_name"].'</td>
							<td align="left">'.$row["description"].'</td>
							<td align="center">'.$row["amount"].'</td>
							<td align="center">'.$row["credit"].'</td>
							<td align="center">
							<a href="javascript:void(0);" onclick="change_status(\''.$row["smscall_dtls_id"].'\');">
							<span id="replace_status_'.$row["smscall_dtls_id"].'">'.$status.'</span>
							</a>
							</td>
							<td align="center"><a href="javascript:void(0);" onclick="edit_credit(\''.$row["smscall_dtls_id"].'\');">
							<img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
							</a></td>
							<td align="center"><a href="javascript:void(0);" onclick="del_credit(\''.$row["smscall_dtls_id"].'\');">
							<img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
							</a></td>
                      </tr>';
			}
		}
		else
		{
			$html .= '<tr><td colspan="8" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';
		
		echo $html;
	}
	
	public function Save()
	{
		$this->db->trans_begin();
		if($this->input->post('smscall_dtls_id') == '')
		{
			$data = array(
						  'package_name'	=>	$this->input->post('package_name'),
						  'amount'			=>	$this->input->post('amount'),
						  'credit'			=>	$this->input->post('credit'),
						  'description'		=>	$this->input->post('description'),
						  'status'			=> 	'1',
						  'date_creation'	=>	date("Y-m-d")
						  );
			$data =$this->global_mod->db_parse($data);
			
			$this->db->insert('app_membership_smscall_dtls',$this->db->escape($data));
		}
		else
		{
			$data = array(
						  'package_name'	=>	$this->input->post('package_name'),
						  'amount'			=>	$this->input->post('amount'),
						  'credit'			=>	$this->input->post('credit'),
						  'description'		=>	$this->input->post('description'),
						  );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
			$this->db->update('app_membership_smscall_dtls',$this->db->escape($data));
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		
		$ResArr = $this->GetAllCredits();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>
			<th align="left">Sl.No.</th>
			<th align="left">Package Title</th>
			<th align="left">Package Description</th>
			<th align="center">Package Amount</th>
			<th align="center">Credit</th>
			<th align="center">Status</th>
			<th colspan="2" align="center">Action</th>
		  </tr>';
		if(count($ResArr) > 0)
		{
			foreach($ResArr as $key=>$row)
			{
				$sl_no = $key+1;
				
				if($row['status'] == '1') {
					$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
				} else {
					$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
				}
				
				$html .= '<tr>
							<td align="left">'.$sl_no.'</td>
							<td align="left">'.$row["package_name"].'</td>
							<td align="left">'.$row["description"].'</td>
							<td align="center">'.$row["amount"].'</td>
							<td align="center">'.$row["credit"].'</td>
							<td align="center">
							<a href="javascript:void(0);" onclick="change_status(\''.$row["smscall_dtls_id"].'\');">
							<span id="replace_status_'.$row["smscall_dtls_id"].'">'.$status.'</span>
							</a>
							</td>
							<td align="center"><a href="javascript:void(0);" onclick="edit_credit(\''.$row["smscall_dtls_id"].'\');">
							<img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
							</a></td>
							<td align="center"><a href="javascript:void(0);" onclick="del_credit(\''.$row["smscall_dtls_id"].'\');">
							<img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
							</a></td>
                      </tr>';
			}
		}
		else
		{
			$html .= '<tr><td colspan="8" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';
		
		echo $html;
	}
	
	public function Edit()
	{
		$this->db->select('*');
		$this->db->from('app_membership_smscall_dtls');
		$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		foreach($RetArr as $row)
		{
			$RetArr['smscall_dtls_id'] 	= $row['smscall_dtls_id'];
			$RetArr['package_name'] 	= $row['package_name'];
			$RetArr['amount'] 			= $row['amount'];
			$RetArr['credit'] 			= $row['credit'];
			$RetArr['description'] 		= $row['description'];
		}
		
		echo json_encode($RetArr);
	}
	
	public function EditRate($smscall_dtls_id)
	{
		$this->db->select('*');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->join('app_countries','app_countries.country_id=app_membership_smscall_rate_dtls.country_id');
		$this->db->where('app_membership_smscall_rate_dtls.smscall_dtls_id', $smscall_dtls_id);
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		$html =	'<div"><a href="javascript:void(0);" onclick="add_new_rate(\''.$smscall_dtls_id.'\');" class="add-call">Add Call/SMS Rate</a></div>
		<div id="back_credit"><a href="javascript:void(0);" onclick="back_credit()" class="back-page">Back to credit manager</a></div><br />
		<table width="50%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>
			<th align="left">Country Name</th>
			<th align="center">Call Rate</th>
			<th align="center">SMS Rate</th>
			<th align="center">Status</th>
			<th colspan="2" align="center">Action</th>
		  </tr>';
		
		foreach($RetArr as $row)
		{
			if($row['status'] == '1') {
				$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
			} else {
				$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
			}
		  
		  $html .= '<tr>
						<td align="left">'.$row["country_name"].'</td>
						<td align="center"><span id="edit_span_call_'.$row["smscall_rate_dtls_id"].'">'.$row["call_rate"].'</span></td>
						<td align="center"><span id="edit_span_sms_'.$row["smscall_rate_dtls_id"].'">'.$row["sms_rate"].'</span></td>
						<td align="center">
						<a href="javascript:void(0);" onclick="change_status_rate(\''.$row["smscall_rate_dtls_id"].'\')">
						<span id="rate_status_'.$row["smscall_rate_dtls_id"].'">'.$status.'</span>
						</a>
						</td>
						<td align="center">
						<a href="javascript:void(0);" onclick="edit_rate(\''.$row["smscall_rate_dtls_id"].'\')">
						<img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
						</a>
						</td>
						<td align="center">
						<a href="javascript:void(0);" onclick="delete_rate(\''.$row["smscall_rate_dtls_id"].'\',\''.$smscall_dtls_id.'\')">
						<img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
						</a>
						</td>
					</tr>';
		}
		
		$html .= '</table>';
		
		return $html;
	}
	
	public function DeleteCreditRate()
	{
		$this->db->where('smscall_rate_dtls_id', $this->input->post('smscall_rate_dtls_id'));
		$this->db->delete('app_membership_smscall_rate_dtls');
		
		$html = $this->EditRate($this->input->post('smscall_dtls_id'));
		
		return $html;
	}
	
	public function GetAllCountry()
	{
		$this->db->select('country_id,country_name');
		$this->db->from('countries');
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		return $RetArr;
	}
	
	public function ChangeStatusRate()
	{
		$this->db->select('status');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('smscall_rate_dtls_id', $this->input->post('smscall_rate_dtls_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		
		if($StatusArr[0]['status'] == '1')
		{
			$data = array('status' => '0');
			$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
		}
		else
		{
			$data = array('status' => '1');
			$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('smscall_rate_dtls_id', $this->input->post('smscall_rate_dtls_id'));
		$this->db->update('app_membership_smscall_rate_dtls',$this->db->escape($data));
		$this->db->last_query();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 0;
		}
		else
		{
			$this->db->trans_commit();
			return $ret;
		}
	}
	
	public function save_call_rate()
	{
		$this->db->select('smscall_rate_dtls_id');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('country_id', $this->input->post('country_id'));
		$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
		$query = $this->db->get();
		$ResArr = $query->result_array();
		
		$this->db->trans_begin();
		if(count($ResArr) > 0)
		{
			$data = array(  'call_rate'		=>	$this->input->post('call_rate')  );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('smscall_rate_dtls_id', $ResArr[0]['smscall_rate_dtls_id']);
			$this->db->update('app_membership_smscall_rate_dtls',$this->db->escape($data));
		}
		else
		{
			$data = array(
				  'country_id'		=>	$this->input->post('country_id'),
				  'smscall_dtls_id'	=>	$this->input->post('smscall_dtls_id'),
				  'call_rate'		=>	$this->input->post('call_rate'),
				  'status'			=> 	'1'
			  );
			  $data =$this->global_mod->db_parse($data);
			$this->db->insert('app_membership_smscall_rate_dtls',$this->db->escape($data));	
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		
		$RetArr = $this->EditRate($this->input->post('smscall_dtls_id'));
		
		return $RetArr;
	}
	
	public function save_sms_rate()
	{
		$this->db->select('smscall_rate_dtls_id');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('country_id', $this->input->post('country_id'));
		$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
		$query = $this->db->get();
		$ResArr = $query->result_array();
		
		$this->db->trans_begin();
		if(count($ResArr) > 0)
		{
			$data = array(  'sms_rate'		=>	$this->input->post('sms_rate')  );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('smscall_rate_dtls_id', $ResArr[0]['smscall_rate_dtls_id']);
			$this->db->update('app_membership_smscall_rate_dtls',$this->db->escape($data));
		}
		else
		{
			$data = array(
				  'country_id'		=>	$this->input->post('country_id'),
				  'smscall_dtls_id'	=>	$this->input->post('smscall_dtls_id'),
				  'sms_rate'		=>	$this->input->post('sms_rate'),
				  'status'			=> 	'1'
			  );
			  $data =$this->global_mod->db_parse($data);
			$this->db->insert('app_membership_smscall_rate_dtls',$this->db->escape($data));	
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		
		$RetArr = $this->EditRate($this->input->post('smscall_dtls_id'));
		
		return $RetArr;
	}
	
	public function GetRateVal($smscall_rate_dtls_id)
	{
		$this->db->select('sms_rate,call_rate');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('smscall_rate_dtls_id', $smscall_rate_dtls_id);
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		if(count($RetArr) > 0)
		{
			$RetArr['sms_rate'] = $RetArr[0]['sms_rate'];
			$RetArr['call_rate'] = $RetArr[0]['call_rate'];
		}
		else
		{
			$RetArr = array();
		}
		
		return json_encode($RetArr);
	}
	
	public function save_edited_rate_call($smscall_rate_dtls_id, $call_rate)
	{
		$pre_call_rate = $this->get_call_rate($smscall_rate_dtls_id);
		
		$data = array(  'call_rate'		=>	$call_rate  );
		$data =$this->global_mod->db_parse($data);
		$this->db->where('smscall_rate_dtls_id', $smscall_rate_dtls_id);
		$this->db->update('app_membership_smscall_rate_dtls',$this->db->escape($data));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return $pre_call_rate;
		}
		else
		{
			$this->db->trans_commit();
			return $call_rate;
		}
	}
	
	public function save_edited_rate_sms($smscall_rate_dtls_id, $sms_rate)
	{
		$pre_sms_rate = $this->get_sms_rate($smscall_rate_dtls_id);
		
		$data = array(  'sms_rate'		=>	$sms_rate  );
		$data =$this->global_mod->db_parse($data);
		$this->db->where('smscall_rate_dtls_id', $smscall_rate_dtls_id);
		$this->db->update('app_membership_smscall_rate_dtls',$this->db->escape($data));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return $pre_sms_rate;
		}
		else
		{
			$this->db->trans_commit();
			return $sms_rate;
		}
	}
	
	public function get_call_rate($smscall_rate_dtls_id)
	{
		$this->db->select('call_rate');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('smscall_rate_dtls_id', $smscall_rate_dtls_id);
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		return $RetArr[0]['call_rate'];
	}
	
	public function get_sms_rate($smscall_rate_dtls_id)
	{
		$this->db->select('sms_rate');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('smscall_rate_dtls_id', $smscall_rate_dtls_id);
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		return $RetArr[0]['sms_rate'];
	}
}
?>