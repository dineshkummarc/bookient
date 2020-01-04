<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PrePayment_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function UpdateSetting(){
		$flag = 0;
		if(count($this->input->post()) > 0){	
			$dataArray = array(
				'pre_pmnt_setting' 	=> $this->input->post('pre_pmnt_setting')
			);
			$this->db->trans_begin();
			$whereData=array(    
                'local_admin_id'=> $this->session->userdata('local_admin_id')    
            );
			$this->db->update('app_local_admin_gen_setting',$this->db->escape($dataArray),$whereData);
			if ($this->db->trans_status() === FALSE){
				$flag = 0;
				$this->db->trans_rollback();
			}else{
				$flag = 1;
				$this->db->trans_commit();
			}
		}
		echo $flag;
	}
	public function SaveSetting(){ 
		$resultant_array = serialize($this->input->post('title'));
		$SettingArr = $this->input->post();
		if($SettingArr['action'] == "save" &&  $SettingArr['service_type'] == "0"){
			$data = array(
			    'pre_pmnt_setting '	=> $SettingArr['service_type'],
			    'pre_pmnt_val'	=> 0
			);
		}elseif($SettingArr['action'] == "save" &&  $SettingArr['service_type'] == "2"){
			$data = array(
			    'pre_pmnt_setting '	=> $SettingArr['service_type'],
			    'pre_pmnt_val'	=> $SettingArr['fixed_amount_val']
			);
		}elseif($SettingArr['action'] == "save" &&  $SettingArr['service_type'] == "3"){
			$data = array(
			    'pre_pmnt_setting '	=> $SettingArr['service_type'],
			    'pre_pmnt_val'	=> $SettingArr['percent_amount_val']
			);
		}else{
			$data = array(
                'pre_pmnt_setting '	=> 0,
                'pre_pmnt_val'	=> 0
            );
		}
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
		$this->db->update('app_local_admin_gen_setting',$this->db->escape($data));
		return $this->db->affected_rows();
	}
	public function PaymentGatewayDetails(){
		$PaymentGatewayArray = array();
		$this->db->select('*');
		$this->db->from('app_payment_gateways');
		$this->db->where('status', 1);
		$where = '(type = "1" OR type = "2")';
		$this->db->where($where);		
		$query = $this->db->get();
		$GateWaysArr = $query->result_array();
		$Num = count($GateWaysArr);
	
		if($Num > 0){
			for($i=0;$i < $Num;$i++){
				$PaymentGatewayArray[$i]['num'] = $Num;
				
				$this->db->select('*');
				$this->db->from('app_payment_gateways');
				$this->db->where('payment_gateways_id', $GateWaysArr[$i]['payment_gateways_id']);
				$query = $this->db->get();
				$DetailsArr = $query->result_array();
				$PaymentGatewayArray[$i]['detail'] = $DetailsArr;
				
				$this->db->select('*');
				$this->db->from('app_payment_gateways_fields');
				$this->db->where('payment_gateways_id', $GateWaysArr[$i]['payment_gateways_id']);
				$query = $this->db->get();
				$FieldsArr = $query->result_array();
	
				for($j=0;$j < count($FieldsArr);$j++){
					$this->db->select('payment_gateways_values');
					$this->db->from('app_payment_gateways_values');
					$this->db->where('payment_gateways_fields_id', $FieldsArr[$j]['payment_gateways_fields_id']);
					$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
					$query = $this->db->get();
					$ValuesArr = $query->result_array();
					@$FieldsArr[$j]['values'] = $ValuesArr[0]['payment_gateways_values'];
				}
				$PaymentGatewayArray[$i]['fields'] = $FieldsArr;
			}
		}
		return $PaymentGatewayArray;
	}
	public function SavePaymentGatewayValues(){
		$err = 0;
		if(count($this->input->post()) > 0){
			$payment_gateway = $this->input->post('payment_gateways_id');
			//echo $this->input->post('payment_gateways_enabled');
			$this->db->select('payment_gateways_enabled');
			$this->db->from('app_local_admin_gen_setting');
			$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
			$query = $this->db->get();
			$payment_gateways_enabled = $query->result_array();
			
			if($this->input->post('payment_gateways_enabled') != '' || $this->input->post('payment_gateways_enabled') != '0'){
				if($payment_gateways_enabled[0]['payment_gateways_enabled'] == '' || $payment_gateways_enabled[0]['payment_gateways_enabled'] == 'NULL'){
					$data = array(
						'payment_gateways_enabled'	=> $this->input->post('strPmntGtwyenbld')
					);
					$this->db->trans_begin();
					$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
					$this->db->update('app_local_admin_gen_setting',$this->db->escape($data));
					if ($this->db->trans_status() === FALSE){
						$err++;
						$this->db->trans_rollback();
					}else{
						$this->db->trans_commit();
					}
				}else{
					$payment_gateways_enabled_arr = explode(",",$payment_gateways_enabled[0]['payment_gateways_enabled']);
					if(in_array($this->input->post('payment_gateways_enabled'),$payment_gateways_enabled_arr)){ 
                        /* do nothing */
                    }else{
						$payment_gateways_enabled_arr[] = $this->input->post('payment_gateways_enabled');
						$payment_gateways_enabled = implode(",",$payment_gateways_enabled_arr);
						$data = array(
							'payment_gateways_enabled'	=> $this->input->post('strPmntGtwyenbld')
						);
						$this->db->trans_begin();
						$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
						$this->db->update('app_local_admin_gen_setting',$this->db->escape($data));
						if ($this->db->trans_status() === FALSE){
							$err++;
							$this->db->trans_rollback();
						}else{
							$this->db->trans_commit();
						}
					}
				}
			}else{
				if($payment_gateways_enabled[0]['payment_gateways_enabled'] == '' || $payment_gateways_enabled[0]['payment_gateways_enabled'] == 'NULL'){ 
                    /* do nothing*/ 
                }else{
					$payment_gateways_enabled_arr = explode(",",$payment_gateways_enabled[0]['payment_gateways_enabled']);
					if(($key = array_search($payment_gateway,$payment_gateways_enabled_arr)) !== false){
						unset($payment_gateways_enabled_arr[$key]);
						$payment_gateways_enabled = implode(",",$payment_gateways_enabled_arr);
						$data = array(
							'payment_gateways_enabled'	=> $this->input->post('strPmntGtwyenbld')
						);
						$this->db->trans_begin();
						$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
						$this->db->update('app_local_admin_gen_setting',$this->db->escape($data));
						
						echo $this->db->last_query();
						if ($this->db->trans_status() === FALSE){
							$err++;
							$this->db->trans_rollback();
						}else{
							$this->db->trans_commit();
						}
					}else{
                        /* do nothing*/ 
                    }
				}
			}
			$this->db->select('payment_gateways_values_id');
			$this->db->from('app_payment_gateways_values');
			$this->db->where('payment_gateways_id', $payment_gateway);
			$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
			$query = $this->db->get();
			$TotalFieldsArr = $query->result_array();
			$Rows = count($TotalFieldsArr);
			
			$this->db->select('payment_gateways_fields_id');
			$this->db->from('app_payment_gateways_fields');
			$this->db->where('payment_gateways_id', $payment_gateway);
			$query = $this->db->get();
			$FieldsNoArr = $query->result_array();
			$FieldsNo = count($FieldsNoArr);
			
			if($Rows > 0){	
				$this->db->where('payment_gateways_id', $payment_gateway);
				$this->db->where('local_admin_id', $this->session->userdata('local_admin_id')); //modify 7june2013
				$this->db->delete('app_payment_gateways_values'); 
				
				for($i=0;$i < $FieldsNo;$i++){
					$data = array(
						'payment_gateways_id'			=> $payment_gateway,
						'payment_gateways_fields_id'	=> $FieldsNoArr[$i]['payment_gateways_fields_id'],
						'local_admin_id' 				=> $this->session->userdata('local_admin_id'),
						'payment_gateways_values' 		=> $this->input->post($FieldsNoArr[$i]['payment_gateways_fields_id']),
						'date_added'					=> date('Y-m-d')
					);
					$this->db->trans_begin();
					$this->db->insert('app_payment_gateways_values',$this->db->escape($data));
					
					if ($this->db->trans_status() === FALSE){
						$err++;
						$this->db->trans_rollback();
					}else{
						$this->db->trans_commit();
					}
				}
			}else{
				for($i=0;$i < $FieldsNo;$i++){
					$data = array(
						'payment_gateways_id'			=> $payment_gateway,
						'payment_gateways_fields_id'	=> $FieldsNoArr[$i]['payment_gateways_fields_id'],
						'local_admin_id' 				=> $this->session->userdata('local_admin_id'),
						'payment_gateways_values' 		=> $this->input->post($FieldsNoArr[$i]['payment_gateways_fields_id']),
						'date_added'					=> date('Y-m-d')
					);
					$this->db->trans_begin();
					$this->db->insert('app_payment_gateways_values',$this->db->escape($data));
					if ($this->db->trans_status() === FALSE){
						$err++;
						$this->db->trans_rollback();
					}else{
						$this->db->trans_commit();
					}
				}
			}
		}
		return $err;
	}
	public function SetTaxCategorySelect(){
		$this->db->select('tax_master_id,tax_title');
		$this->db->from('app_tax_master');
		$this->db->where('status', 1);
		$query = $this->db->get();
		$CategoryArr = $query->result_array();
		$Num = count($CategoryArr);
		
		$select_box = '<select name="tax_cat" id="tax_cat">';
		for($i=0;$i < $Num;$i++){
			$select_box .= '<option value="'.$CategoryArr[$i]['tax_master_id'].'">'.$this->global_mod->show_to_control($CategoryArr[$i]['tax_title']).'</option>';
		}
		$select_box .= '</select><a href="javascript:void(0);" onclick="not_in_list_textbox();">Not in List</a>';
		echo $select_box;
	}
	public function TaxCategoryList(){
		$this->db->select('tax_master_id,tax_title');
		$this->db->from('app_tax_master');
		$this->db->where('status', 1);
		$query = $this->db->get();
		$CategoryArr = $query->result_array();
		return $CategoryArr;
	}
	public function SaveTaxValues(){
		$err = 0;
		$err_msg = '';
		$rows = '';
		if(count($this->input->post()) > 0){
			if($this->input->post('tax_cat') == 0){
				if($this->input->post('tax_cat_not_in_list') == ''){
					$err++;
					$err_msg .= '(@)'.'1';
				}
			}
			if($this->input->post('tax_rate') == ''){
				$err++;
				$err_msg .= '(@)'.'2';
			}
			if($this->input->post('tax_rate') != ''){
				if($this->input->post('tax_rate') >= 100){
					$err++;
					$err_msg .= '(@)'.'3';
				}
			}
			if($err == 0){
				if($this->input->post('tax_cat') == 0){
					$dataArray = array(
						'local_admin_id' 	=> $this->session->userdata('local_admin_id'),
						'tax_master_id' 	=> 0,
						'tax_rate'			=> $this->input->post('tax_rate'),
						'not_in_list_title'	=> $this->input->post('tax_cat_not_in_list'),
						'date_added'		=> date('Y-m-d'),
						'status'			=> 1
					);
					$this->db->select('tax_local_admin_setting_id');
					$this->db->from('app_tax_local_admin');
					$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
					$this->db->where('not_in_list_title', $this->input->post('tax_cat_not_in_list'));
					$query = $this->db->get();
					$FieldsNoArr = $query->result_array();
					$Rows = count($FieldsNoArr);
					$this->db->trans_begin();
					if($Rows > 0){
						$this->db->where('tax_local_admin_setting_id', $FieldsNoArr[0]['tax_local_admin_setting_id']);
						$this->db->update('app_tax_local_admin',$this->db->escape($dataArray));
					}else{
						$this->db->insert('app_tax_local_admin',$this->db->escape($dataArray));
					}
				}else{
					$dataArray = array(
						'local_admin_id' 	=> $this->session->userdata('local_admin_id'),
						'tax_master_id' 	=> $this->input->post('tax_cat'),
						'tax_rate'			=> $this->input->post('tax_rate'),
						'not_in_list_title'	=> '',
						'date_added'		=> date('Y-m-d'),
						'status'			=> 1
					);
					$this->db->select('tax_local_admin_setting_id');
					$this->db->from('app_tax_local_admin');
					$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
					$this->db->where('tax_master_id', $this->input->post('tax_cat'));
					$query = $this->db->get();
					$FieldsNoArr = $query->result_array();
					$Rows = count($FieldsNoArr);
					$this->db->trans_begin();
					if($Rows > 0){
						$this->db->where('tax_local_admin_setting_id', $FieldsNoArr[0]['tax_local_admin_setting_id']);
						$this->db->update('app_tax_local_admin',$this->db->escape($dataArray));
					}else{
						$this->db->insert('app_tax_local_admin',$this->db->escape($dataArray));
					}
				}
				if ($this->db->trans_status() === FALSE){
					$err_msg .= '(@)'.'4';
					$this->db->trans_rollback();
				}else{
					$err_msg .= '(@)'.'0';
					$this->db->trans_commit();
				}
			}
		}

        $Arr = array();
		$qry="SELECT tax_local_admin_setting_id,tax_rate,not_in_list_title,(SELECT tax_title FROM app_tax_master WHERE tax_master_id = app_tax_local_admin.tax_master_id) as tax_category FROM app_tax_local_admin WHERE local_admin_id = ".$this->session->userdata('local_admin_id');
		$sql = mysql_query($qry) or die(mysql_error());
		$num = mysql_num_rows($sql);
		if($num > 0){
			$rows .= '<tr bgcolor="#ECF3FF">
				<th width="25%" align="left">'.$this->lang->line("prepayment_tax").'</th>
				<th width="34%" align="left">'.$this->lang->line("prepayment_percentage").'</th>
				<th width="41%" align="left"></th>
			</tr>';
			while($fetch_row = mysql_fetch_array($sql)){
				$tax_local_admin_setting_id = $fetch_row['tax_local_admin_setting_id'];
				$tax_rate = $fetch_row['tax_rate'];
				if($fetch_row['tax_category'] == '' || $fetch_row['tax_category'] == NULL){
					$tax_category = $fetch_row['not_in_list_title'];
				}else
					$tax_category = $fetch_row['tax_category'];	
				$rows .= '<tr>
							<td width="25%">'.$this->global_mod->show_to_control($tax_category).'</td>
							<td width="34%">'.$tax_rate.'</td>
							<td width="41%"><a href="javascript:void(0);" onclick="DeleteTaxRecord('.$tax_local_admin_setting_id.');"><img align="absbottom" src="'.base_url().'/images/trash.png"></a></td>
						</tr>';
			}
		}else{
		    $rows = '<tr><td colspan="3" align="center">'.$this->lang->line("no_recrds_found").'</td></tr>';
		}
		echo $rows.$err_msg;
	}
	public function TaxDetailsList(){
		$Arr = array();
		$qry="SELECT tax_local_admin_setting_id,tax_rate,not_in_list_title,(SELECT tax_title FROM app_tax_master WHERE tax_master_id = app_tax_local_admin.tax_master_id) as tax_category FROM app_tax_local_admin WHERE local_admin_id = ".$this->session->userdata('local_admin_id');
		$sql = mysql_query($qry) or die(mysql_error());
		$num = mysql_num_rows($sql);
		if($num > 0){
			$i=0;
			while($fetch_row = mysql_fetch_array($sql)){
				$Arr[$i]['tax_local_admin_setting_id'] = $fetch_row['tax_local_admin_setting_id'];
				$Arr[$i]['tax_rate'] = $fetch_row['tax_rate'];
				if($fetch_row['tax_category'] == '' || $fetch_row['tax_category'] == NULL){
					$Arr[$i]['tax_category'] = $fetch_row['not_in_list_title'];
				}else
					$Arr[$i]['tax_category'] = $fetch_row['tax_category'];
				$i++;
			}
		}
		return $Arr;
	}
	public function DeleteTaxDetails($id){
		$this->db->delete('app_tax_local_admin', array('tax_local_admin_setting_id ' => $id)); 
		if($this->db->affected_rows()>0){
			$Arr = array();
			$qry="SELECT tax_local_admin_setting_id,tax_rate,not_in_list_title,(SELECT tax_title FROM app_tax_master WHERE tax_master_id = app_tax_local_admin.tax_master_id) as tax_category FROM app_tax_local_admin WHERE local_admin_id = ".$this->session->userdata('local_admin_id');
			$sql = mysql_query($qry) or die(mysql_error());
			$num = mysql_num_rows($sql);
			if($num > 0){
				$rows = '';
				$rows .= '<tr bgcolor="#ECF3FF">
					<th width="25%" align="left">'.$this->lang->line("prepayment_tax").'</th>
					<th width="34%" align="left">'.$this->lang->line("prepayment_percentage").'</th>
					<th width="41%" align="left"></th>
				</tr>';
				
				while($fetch_row = mysql_fetch_array($sql)){
					$tax_local_admin_setting_id = $fetch_row['tax_local_admin_setting_id'];
					$tax_rate = $fetch_row['tax_rate'];
					if($fetch_row['tax_category'] == '' || $fetch_row['tax_category'] == NULL){
						$tax_category = $fetch_row['not_in_list_title'];
					}else
						$tax_category = $fetch_row['tax_category'];
						
					$rows .= '<tr>
						<td width="25%">'.$this->global_mod->show_to_control($tax_category).'</td>
						<td width="34%">'.$tax_rate.'</td>
						<td width="41%"><a href="javascript:void(0);" onclick="DeleteTaxRecord('.$tax_local_admin_setting_id.');"><img align="absbottom" src="'.base_url().'/images/trash.png"></a></td>
					</tr>';
				}
			}else{
				$rows = '<tr><td colspan="3" align="center">'.$this->lang->line("no_recrds_found").'</td></tr>';
			}
		}
		echo $rows;
	}
	public function LocalAdminSetting(){
		$this->db->select('payment_gateways_enabled,pre_pmnt_setting,pre_pmnt_val');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
		$query = $this->db->get();
		$SettingArr = $query->result_array();
		if(count($SettingArr) > 0)
			$SettingArr[0]['payment_gateways_enabled'] = explode(",",$SettingArr[0]['payment_gateways_enabled']);
		else
			$SettingArr[0]['payment_gateways_enabled'] = array();
		return $SettingArr;
	}
	public function CheckSelectedGateways($local_admin_id, $val){
		$ResArr = $this->LocalAdminSetting();
		$GatewaysArr = $ResArr[0]['payment_gateways_enabled'] ;
		$count_gateways_enabled = count($GatewaysArr);
		
		if($count_gateways_enabled == 1){
			if($GatewaysArr[0] == $val)
				return false;
			else
				return true;	
		}
		else
			return true;
	}
}