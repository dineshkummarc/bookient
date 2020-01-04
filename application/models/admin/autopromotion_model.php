<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autopromotion_model extends CI_Model{
																
	public function app_promo_type(){
		$this->db->select('promo_type_id,promo_type_name');
		$this->db->from('app_promo_type');
		$this->db->where('promo_type_status','1');
		$query = $this->db->get();		
		$retArr = $query->result_array();  
		return $retArr;	
	}
	
  /*	public function allCuponDetails($cuponType){
		$localAdminId = $this->session->userdata('local_admin_id');
		$this->db->select('coupon_id,coupon_heading');
		$this->db->from('app_coupon');
		$this->db->where('coupon_type', $cuponType); 
		$this->db->where('local_admin_id', $localAdminId);
		$this->db->order_by("coupon_id", "desc");
		$query = $this->db->get();          
		$CouponArray =  $query->result_array();
		return $CouponArray;
	}
	
	*/
	
	public function allCuponDetails($cuponType){
		$localAdminId = $this->session->userdata('local_admin_id');
		$this->db->select('coupon_id,coupon_heading');
		$this->db->from('app_coupon');
		$this->db->where('coupon_type', $cuponType); 
		$this->db->where('local_admin_id', $localAdminId);
		$this->db->where('applicbl_services_for', 0);
		$this->db->order_by("coupon_id", "desc");
		$query = $this->db->get();          
		$CouponArray =  $query->result_array();
		return $CouponArray;
	}
	
	
	public function saveAutoPromotion($id,$insertData){
		$insertData = $this->global_mod->db_parse($insertData);
		if(isset($id) && $id != ''){
			$insertData['auto_promo_edit_date'] = date('Y-m-d');
			$this->db->where('auto_promo_id', $id);
			$this->db->update('app_auto_promotion', $insertData); 
			return 1;
		}
		else{
			$insertData['auto_local_admin_id'] = $this->session->userdata('local_admin_id');
			$insertData['auto_promo_add_date'] = date('Y-m-d');
			$this->db->insert('app_auto_promotion', $insertData); 
        	return $this->db->insert_id();
		}
		
	}
	
	public function allAutoPromotion(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_auto_promotion');
		$this->db->where('auto_local_admin_id',$local_admin_id);
		$this->db->order_by('auto_promo_priority', "ASC"); 
		$query = $this->db->get();		
		$retArr = $query->result_array();  
		return $retArr;	
	}
	
	public function FetchDataById(){
		$promotionId = $this->input->post('promotionId');
		
		$this->db->select('*');
		$this->db->from('app_auto_promotion');
		$this->db->where('auto_promo_id',$promotionId);
		$query = $this->db->get();		
		$retArr = $query->result_array();  
		
		$coupon_head = $this->allCuponDetails($retArr[0]['auto_promo_linkon']);
		
		$retArr[1] = $coupon_head;
		return $retArr;
	}
	
	public function DeletePromo($promotnId){
		$this->db->where('auto_promo_id', $promotnId);
		$this->db->delete('app_auto_promotion'); 
		return 1;
	}
	
	public function ChangeStatus(){
		$promotnId = $this->input->post('promotionId');
		$status = $this->input->post('status');
		
		$data = array('auto_promo_status'=>$status);
		$this->db->where('auto_promo_id', $promotnId);
		$this->db->update('app_auto_promotion', $data); 
		return 1;
	}

}
?>


