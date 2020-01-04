<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_gateway_settings_model extends CI_Model
{
	public function PaymentGatewayDetails()
	{
		$PaymentGatewayArray = array();
		$this->db->select('*');
		$this->db->from('app_payment_gateways');
		$this->db->where('status', 1);
		$where = '(type = "0" OR type = "2")';
		$this->db->where($where);		
		$query = $this->db->get();
		$GateWaysArr = $query->result_array();
		$Num = count($GateWaysArr);
	
		if($Num > 0)
		{
			for($i=0;$i < $Num;$i++)
			{
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
	
				for($j=0;$j < count($FieldsArr);$j++)
				{
					$this->db->select('payment_gateways_values');
					$this->db->from('app_payment_gateways_superadmn_values');
					$this->db->where('payment_gateways_fields_id', $FieldsArr[$j]['payment_gateways_fields_id']);
					$query = $this->db->get();
					$ValuesArr = $query->result_array();
					@$FieldsArr[$j]['values'] = $ValuesArr[0]['payment_gateways_values'];
				}
				
				$PaymentGatewayArray[$i]['fields'] = $FieldsArr;
			}
		}
		
		return $PaymentGatewayArray;
	}
	
	public function SavePaymentGatewayValues()
	{
		$PaymentGatewayArray = array();
		$error = 0;
		
		$query = $this->db->query("SELECT fields.payment_gateways_fields_id FROM app_payment_gateways AS gateway,app_payment_gateways_fields AS fields WHERE fields.payment_gateways_id = gateway.payment_gateways_id AND gateway.status = 1 AND fields.status = 1 AND (gateway.type = '0' OR gateway.type = '2')");
		$ResArr = $query->result();
		
		foreach($ResArr as $row)
		{
			$this->db->select('payment_gateways_values_id');
			$this->db->from('app_payment_gateways_superadmn_values');
			$this->db->where('payment_gateways_fields_id', $row->payment_gateways_fields_id);
			$query = $this->db->get();
			$CheckArr = $query->result_array();
			
			$this->db->trans_begin();
			if(count($CheckArr) > 0)
			{
				$data = array(
								'payment_gateways_values' 		=> $this->input->post($row->payment_gateways_fields_id),
								'date_modified'					=> date('Y-m-d')
						);
						$data =$this->global_mod->db_parse($data);
				$this->db->where('payment_gateways_values_id', $CheckArr[0]['payment_gateways_values_id']);
				$this->db->update('app_payment_gateways_superadmn_values',$this->db->escape($data));
			}
			else
			{
				$this->db->select('payment_gateways_id');
				$this->db->from('app_payment_gateways_fields');
				$this->db->where('payment_gateways_fields_id', $row->payment_gateways_fields_id);
				$this->db->limit(1);
				$query = $this->db->get();
				$PaymentGatewayArr = $query->result_array();
				
				$data = array(
								'payment_gateways_id'			=> $PaymentGatewayArr[0]['payment_gateways_id'],
								'payment_gateways_fields_id'	=> $row->payment_gateways_fields_id,
								'superadmn_id' 					=> $this->session->userdata('super_user_id'),
								'payment_gateways_values' 		=> $this->input->post($row->payment_gateways_fields_id),
								'date_added'					=> date('Y-m-d')
						);
						$data =$this->global_mod->db_parse($data);
				$this->db->insert('app_payment_gateways_superadmn_values',$this->db->escape($data));
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$error++;
			}
			else
			{
				$this->db->trans_commit();
			}
		}
		
		if($error == 0)
		{
			return 1;	
		}
		else
		{
			return 0;
		}
	}
}
?>