<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_not_verified_model extends CI_Model{
	
	public function findUserDetails()
	{
		 $this->load->database();
		 $data=array();
		 $local_admin_id = $this->session->userdata('local_admin_id');
		 $user_id_resend_email = $this->session->userdata('user_id_resend_email');
		 $query = $this->db->query("SELECT * FROM app_password_manager  
		 WHERE user_id='".$user_id_resend_email."' AND user_type='3'");
		//$query = $this->db->query("YOUR QUERY");
		
		$this->db->select('*');
			$this->db->from('app_password_manager');
			$this->db->where('user_id', $user_id_resend_email);
			$this->db->where('user_type', '3');
			$query = $this->db->get();
			$row = $query->row();

		 if ($query->num_rows() > 0)
		 {
			$this->db->select('first_name,last_name');
			$this->db->from('app_local_admin');
			$this->db->where('local_admin_id', $user_id_resend_email);
			$query_user_id_resend_email = $this->db->get();
			$RetArr = $query_user_id_resend_email->row();
			   
			$data['encription_key']   	= $row->encription_key;
			$data['encrypt_username']   	= $row->user_name_enc;
			$data['user_email']   		= $row->user_email;
			$data['user_name']  		= $row->user_name;
			$data['first_name']   	= $RetArr->first_name;
			$data['last_name']   	= $RetArr->last_name;
				   
			return($data);	  
		 } 
		 else
		 { 
		   return '0';
		 }
	}

}
?>