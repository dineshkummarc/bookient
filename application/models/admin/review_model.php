<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model
{
	public function GetReports()
	{
		$data1 = array(
					  'review_text'	=>	$this->input->post('comments'),	
					  'review_text_date' => date('Y-m-d'),
					  'review_text_time' => date('H:i:s')
					);
		$this->db->where('url-encode',$this->input->post('urlNumber'));
		$this->db->update('app_review_report',$this->db->escape($data1));
		
		
	}
	
	public function GetAll(){
		$hidd_enid = array_keys($_GET);
		$local_admin_id = $this->session->userdata('local_admin_id');
		$query=$this->db->query("SELECT business_logo from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row = $query->row();
		$business_logo = $row->business_logo;
		$resultant = array($hidd_enid[0],$business_logo);
		return $resultant;
	}
	
	
}
?>


