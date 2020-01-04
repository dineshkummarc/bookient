<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//permission library for getting permission...

class MY_Permission {

	var $member_group_id	= '1'; // The page we are linking to
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct()
	{	
		$CI =& get_instance();
		$this->member_group_id = $CI->session->userdata('member_group_id');
	}

	function is_access($feature_id){
	$CI =& get_instance();
	$CI->load->model('group');	
			
		if(!empty($this->member_group_id) && $CI->session->userdata('member_logged_in')){
		$groupArr = $CI->group->get_GroupArr($this->member_group_id);		
		$feature_ids = explode(",",$groupArr->feature_ids);
		
			if(in_array($feature_id,$feature_ids))
				return true;
			else
				return false;		
		}else{
			return false;
		}
	}
	
	
}