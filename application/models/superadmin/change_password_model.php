<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password_model extends CI_Model
{
	public function change_password()
	{
		$this->load->database();
		
		$this->db->select('password');
		$this->db->from('app_password_manager');
		$this->db->where('user_id', $this->session->userdata('super_user_id'));
		$this->db->where('user_type', 5);
		$query = $this->db->get();
		$OldPassArr = $query->result_array();
		
		if($OldPassArr[0]['password'] == trim($this->input->post('current_pass')))
		{
			if($this->input->post('new_pass') == trim($this->input->post('confirm_pass')))
			{
				$data = array('password' => trim($this->input->post('new_pass')));				
				$data =$this->global_mod->db_parse($data);
				$this->db->trans_begin();
				$this->db->where('user_id', $this->session->userdata('super_user_id'));
				$this->db->where('user_type', 5);
				$this->db->update('app_password_manager',$this->db->escape($data));
				$this->db->last_query();
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					echo 0;
				}
				else
				{
					$this->db->trans_commit();
					echo 1;
				}
			}
			else
			{
				echo 2;	
			}
		}
		else
		{
			echo 3;
		}
	}
	
}
?>