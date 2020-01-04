<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class back_to_super_model extends CI_Model{
	  
	public function super_admin_dashboard()
	{
            global $config;
	  $set_user_data = array(
		   'user_name'   			 => '',
		   'user_id'     			 => '',
		   'user_id_local_admin'     => '',
		   'local_admin_id' 		 => '',
		   'user_type'   			 => '',
		   'is_super_admin'			 => '',
		   'logged_in'   			 => ''
	   ); 
	   $this->session->unset_userdata($set_user_data);	
	   
		$this->db->select('user_id,user_name');
		$this->db->from('app_password_manager');
		$this->db->where('user_type', '5');
		$query = $this->db->get();
		$ResArr = $query->result_array();
		
		$set_user_data = array(
		   'super_user_name'   			 => $ResArr[0]['user_name'],
		   'super_user_id'     			 => $ResArr[0]['user_id'],
		   'super_user_type'   			 => '5',
		   'is_super_admin'			 	 => TRUE,
		   'super_logged_in'   			 => TRUE
		);
           redirect($this->config->item('super_base_url_back'));
	   //redirect(base_url().'superadmin/dashboard');
	}
}
?>