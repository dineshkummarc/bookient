<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model{
	public function login_check($user_email,$password){
		$sql="SELECT 
						* 
					FROM 
						app_password_manager 
					WHERE 
						user_email='".$user_email."' 
						AND  
						password='".$password."' 
						AND 
						user_type='5'";
		
		 $query = $this->db->query($sql);

		 if ($query->num_rows() > 0){
			$row = $query->row();
			$set_user_data = array(
			   'super_user_name'   			 => $row->user_name,
			   'super_user_id'     			 => $row->user_id,
			   'super_user_type'   			 => $row->user_type,
			   'is_super_admin'				 => TRUE,
			   'super_logged_in'   			 => TRUE
			);
			$this->session->set_userdata($set_user_data);   
			return '1';
		 }else{ 
		   return '0';
		 }
	}
}
?>