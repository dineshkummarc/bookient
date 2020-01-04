<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends CI_Model
{
	public function getContent($type){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$this->db->select('*');
        $this->db->from('app_cms');
        $this->db->where('cms_type', $type);
		$this->db->where('local_admin_id', $local_admin_id);
        $query_super = $this->db->get();
        $Arr_super = $query_super->result_array();
		if(count($Arr_super)>0){
			return $Arr_super[0]['cms_dec'];
		}
	}
	
	public function UpdateContent($cmsType,$comment){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$data = array(
		       'cms_dec' => $comment
		    );
		$data = $this->global_mod->db_parse($data);   
		$this->db->where('cms_type', $cmsType);
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->update('app_cms', $data); 
	}
}
?>