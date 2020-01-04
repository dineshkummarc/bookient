<?php
class Xml_rpc_model extends CI_Model{
	function testCkeckLogin(){
		//	$this->load->database();
	//	$this->db->select('user_id');
		$this->db->select('*');
		$this->db->from('app_password_manager');
		$this->db->where('user_email', $parameters['0']);
		$this->db->where('password', $parameters['1']);
	//	$this->db->where('user_type', 1);
		$this->db->where('user_status',1);
		$query = $this->db->get(); 
		$UserAuthArr = $query->result_array();
		
		return $UserAuthArr;
	}
}