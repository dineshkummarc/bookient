<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency_rate_manager_model extends CI_Model{
	
	public function getCurrencyname(){
		$query = $this->db->query('SELECT a.currency_abbriviation,a.currency_name,b.rate FROM `app_currency` a  LEFT JOIN `app_currency_rate` b ON a.currency_abbriviation=b.currency_to');
		return $query->result_array();
	}
	
	public function saveCurrency($currency_to,$rate){
		$data = array(
		   'currency_from' => 'USD',
		   'currency_to' => $currency_to,
		   'rate' => $rate
		);
		$data =$this->global_mod->db_parse($data);
		$this->db->insert('app_currency_rate', $data); 
	}
	
	public function fetCurrencyValue(){
		$this->db->select('*');
        $this->db->from('app_currency_rate');
		$query = $this->db->get();
        return $query->result_array();
	}
	
	public function TrancateTable(){
		$this->db->query('TRUNCATE TABLE `app_currency_rate`');
	}
}
?>