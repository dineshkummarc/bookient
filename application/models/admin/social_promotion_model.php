<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class social_promotion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getALLTemplate(){
		$this->db->select('*');
		$this->db->from('app_offer_template');
		$this->db->where('is_active', '1');
		$this->db->order_by("template_id", "ASC"); 
		$query = $this->db->get();
		return $template =  $query->result_array();		
	}  
	public function getDesignOffer(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_design_offer');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$NumRowsSi =  $query->num_rows();
		if($NumRowsSi > 0)
		{
			return $template =  $query->result_array();
		}
		else{
			return $template =  "";			
		}		
	}  
	public function save($app_design_offer){
		$local_admin_id = $this->session->userdata('local_admin_id');
		//$app_design_offer = $this->global_mod->db_parse($app_design_offer);
		$this->db->select('design_offer_id');
		$this->db->from('app_design_offer');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$NumRows =  $query->num_rows();	
		$this->db->trans_begin();
		if($NumRows == 0)
		{
			$this->db->insert('app_design_offer',$this->db->escape($app_design_offer));
		}
		else
		{
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->update('app_design_offer',$this->db->escape($app_design_offer));
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
	}
	public function app_promotion_message_save($app_promotion_message){
		$local_admin_id = $this->session->userdata('local_admin_id');
		//$app_promotion_message = $this->global_mod->db_parse($app_promotion_message);
		$this->db->select('message_id');
		$this->db->from('app_promotion_message');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$NumRows =  $query->num_rows();	
		$this->db->trans_begin();
		if($NumRows == 0)
		{
			$this->db->insert('app_promotion_message',$this->db->escape($app_promotion_message));
		}
		else
		{
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->update('app_promotion_message',$this->db->escape($app_promotion_message));
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
	}
	public function getSocialMsg(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_promotion_message');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$NumRowsSi =  $query->num_rows();
		if($NumRowsSi > 0)
		{
			return $SocialMsg =  $query->result_array();
		}
		else{
			return $SocialMsg =  "";			
		}		
	}  
}
?>


