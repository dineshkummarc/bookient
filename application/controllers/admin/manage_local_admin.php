<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_local_admin extends Pardco {
	public function check_user_access($id)
	{
		$this->load->model('admin/manage_local_admin_model');
		$explode=explode('FghJU435GFGsjdn790',$id);
		
	
		
		$return = $this->manage_local_admin_model->check_admin_status($explode);
		echo $return;
	}
}