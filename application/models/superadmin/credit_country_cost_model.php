<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class credit_country_cost_model extends CI_Model{
    public function getAllCountry(){
        $this->db->select('*');
        $this->db->from('app_countries');
        //$this->db->where('status', 1);
        $this->db->order_by("country_order", "asc"); 
		//$this->db->limit(5, 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllServiceType(){
        $this->db->select('*');
        $this->db->from('app_membership_credits_service');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllCreditsCountryCost($credit_id){
        $this->db->select('*');
        $this->db->from('app_membership_credits_country_price');
		$this->db->where('credit_id', $credit_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function save($relationArr){
        $data = array();
		//return $relationArr['credit_id'];exit;
		$this->db->where('credit_id',$relationArr['credit_id']);
		$a = $this->db->delete('app_membership_credits_country_price'); 
        //$this->db->truncate('app_membership_credits_country_cost'); 
        foreach($relationArr as $relationKey=>$relationVal){
			if($relationKey !='credit_id'){
				 $relArr = explode("_",$relationKey);
	            $data = array(
					'credit_id' => $relationArr['credit_id'],
					'country_id' => $relArr[0],
					'credit_service_id' => $relArr[1],
					'cost' => $relationVal			   
	            );
				$data =$this->global_mod->db_parse($data);
				if($relationVal !=''){
					$this->db->insert('app_membership_credits_country_price', $data); 
				}   
			}                
        }
        return $relationArr['credit_id'];
    }
}
?>