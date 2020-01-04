<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_pro_model extends CI_Model{
	
	public function __construct()
	{
		$this->load->database();
	}
	
	/*public function getPaymentSettings()
	{
		        $Arr = array();
				
				$this->db->select('*');
				$this->db->from('app_payment_gateways_fields');
				$this->db->where('payment_gateways_id', 1);
				$query = $this->db->get();
				$FieldsArr = $query->result_array();
				
				for($j=0;$j < count($FieldsArr);$j++)
				{
					$this->db->select('payment_gateways_values');
					$this->db->from('app_payment_gateways_values');
					$this->db->where('payment_gateways_fields_id', $FieldsArr[$j]['payment_gateways_fields_id']);
					$query = $this->db->get();
					$ValuesArr = $query->result_array();
					//@$FieldsArr[$j]['values'] = $ValuesArr[0]['payment_gateways_values'];
					$Arr[$j][$FieldsArr[$j]['payment_gateways_fields_id']] = $ValuesArr[0]['payment_gateways_values'];
				}
				//$PaymentSettingsArray['fields'] = $FieldsArr;
				
				return $Arr;
	}*/
}	
?>