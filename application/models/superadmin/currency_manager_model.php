<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency_manager_model extends CI_Model
{
	public function GetAllCURRENCY(){
		$this->db->select('*');
		$this->db->from('app_currency');
		$query = $this->db->get();
		$CURRENCYArr = $query->result_array();
		return $CURRENCYArr;
	}
	
	public function SaveCURRENCY(){
		$this->db->trans_begin();
		if($this->input->post('currency_id') == ''){
			$data = array(
			    'currency_name'	            =>	$this->input->post('currency_name'),
			    'currency_abbriviation'		=>	$this->input->post('currency_abbriviation'),
			    'currency_symbol'		    =>	$this->input->post('currency_symbol'),
			    'is_active'		            =>	'Y'						 
			);
			$data =$this->global_mod->db_parse($data);
			$this->db->insert('app_currency',$this->db->escape($data));
		}else{
			$data = array(
				'currency_name'	            =>	$this->input->post('currency_name'),
				'currency_abbriviation'		=>	$this->input->post('currency_abbriviation'),
				'currency_symbol'		    =>	$this->input->post('currency_symbol'),
			);
			$data =$this->global_mod->db_parse($data);
			$this->db->where('currency_id', $this->input->post('currency_id'));
			$this->db->update('app_currency',$this->db->escape($data));
		}
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}
		
		$CURRENCYArr = $this->GetAllCURRENCY();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>		
			<th align="left">Sl.No.</th>
			<th align="left">Currency Name</th>
			<th align="left">Currency Abbriviation</th>
			<th align="left">Currency Symbol</th>
			<th align="center">Status</th>
			<th colspan="2">Action</th>
		  </tr>';
		if(count($CURRENCYArr) > 0){
			foreach($CURRENCYArr as $key=>$row){
				$sl_no = $key+1;
				
				if($row['is_active'] == 'Y') {
					$status = '<span id="replace_status_'.$row["currency_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
				} else {
					$status = '<span id="replace_status_'.$row["currency_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
				}
				
				$html .= '<tr>
					<td align="left">'.$sl_no.'</td>					
					<td align="left">'. $row['currency_name'].'</td>
					<td align="left">'. $row['currency_abbriviation'].'</td>
					<td align="left">'. $row['currency_symbol'].'</td>
					<td align="center"><a href="javascript:void(0);" onclick="change_status(\''.$row["currency_id"].'\');">'.$status.'</a></td>
					<td align="center"><a href="javascript:void(0);" onclick="edit_currency(\''.$row['currency_id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_currency(\''.$row['currency_id'].'\');">
                    <img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
                    </a></td>
				  </tr>';
			}
		}else{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';
		
		echo $html;
	}
	
	public function DelCURRENCY(){
		$this->db->where('currency_id', $this->input->post('currency_id'));
		$this->db->delete('app_currency'); 
		$CURRENCYArr = $this->GetAllCURRENCY();
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>
			<th align="left">Sl.No.</th>
			<th align="left">Currency Name</th>
			<th align="left">Currency Abbriviation</th>
			<th align="left">Currency Symbol</th>
			<th align="center">Status</th>
			<th colspan="2" align="center">Action</th>
		  </tr>';
		if(count($CURRENCYArr) > 0){
			foreach($CURRENCYArr as $key=>$row){
				$sl_no = $key+1;
				
				if($row['is_active'] == 'Y') {
					$status = '<span id="replace_status_'.$row["currency_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
				} else {
					$status = '<span id="replace_status_'.$row["currency_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
				}
				
				$html .= '<tr>
					<td align="left">'.$sl_no.'</td>
					<td align="left">'. $row['currency_name'].'</td>
					<td align="left">'. $row['currency_abbriviation'].'</td>
					<td align="left">'. $row['currency_symbol'].'</td>
					<td align="center"><a href="javascript:void(0);" onclick="change_status(\''.$row["currency_id"].'\');">'.$status.'</a></td>
					<td align="center"><a href="javascript:void(0);" onclick="edit_faq(\''.$row['currency_id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_faq(\''.$row['currency_id'].'\');">
                    <img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
                    </a></td>
				  </tr>';
			}
		}else{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';
		
		echo $html;
	}
	
	public function ChangeStatusCURRENCY(){
		$this->db->select('is_active');
		$this->db->from('app_currency');
		$this->db->where('currency_id', $this->input->post('currency_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		if($StatusArr[0]['is_active'] == 'Y'){
			$data = array('is_active' => 'N');
			$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
		}else{
			$data = array('is_active' => 'Y');
			$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
		}
		$data =$this->global_mod->db_parse($data);
		
		$this->db->trans_begin();
		$this->db->where('currency_id', $this->input->post('currency_id'));
		$this->db->update('app_currency',$this->db->escape($data));
		$this->db->last_query();
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo 0;
		}else{
			$this->db->trans_commit();
			echo $ret;
		}
	}
	
	public function EditCURRENCY(){
		$this->db->select('*');
		$this->db->from('app_currency');
		$this->db->where('currency_id', $this->input->post('currency_id'));
		$query = $this->db->get();
		$FAQArr = $query->result_array();
		foreach($FAQArr as $row){
			$FAQArr['currency_id'] 		            = $row['currency_id'];
			$FAQArr['currency_name']                = $row['currency_name'];
			$FAQArr['currency_abbriviation'] 	    = $row['currency_abbriviation'];
			$FAQArr['currency_symbol'] 	            = $row['currency_symbol'];
			$FAQArr['is_active'] 	                = $row['is_active'];
		}
		echo json_encode($FAQArr);
	}/**/
}
?>