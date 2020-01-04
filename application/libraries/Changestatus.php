<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_ChangeStatus
{				
	var $ERROR = "";
	function clear_error()
	{
		$this->ERROR = "";
	}
	function __construct(){
		//parent::__construct();
		
    }		
	function ChangeStatus($record_id,$change_status_id)
	{		
		$CI =& get_instance();
		$CI->load->model('changestatusmod');

	
			
			$ChangeStatusType			 = $CI->changestatusmod->get_FieldData('change_status_type',$change_status_id);
			$TableName					 = $CI->changestatusmod->get_FieldData('table_name',$change_status_id);
			$Pkey						 = $CI->changestatusmod->get_FieldData('Pkey',$change_status_id);
			$ChangeStatusName			 = $CI->changestatusmod->get_FieldData('change_status_name',$change_status_id);
			$ChangeOtherStatusName		 = $CI->changestatusmod->get_FieldData('other_status_name',$change_status_id);
			$IsOtherStatus				 = $CI->changestatusmod->get_FieldData('is_other_status',$change_status_id);
			$IsOtherStatusMode			 = $CI->changestatusmod->get_FieldData('is_other_status_mode',$change_status_id);
			$ChangeOtherStatusDependency = $CI->changestatusmod->get_FieldData('other_status_dependency',$change_status_id);
			$ChangeOtherStatusType		 = $CI->changestatusmod->get_FieldData('other_status_type',$change_status_id);

			
			$CI->changestatusmod->set_ChangestatusSettings($ChangeStatusType,$TableName,$Pkey,$ChangeStatusName,$ChangeOtherStatusName,$IsOtherStatus,$IsOtherStatusMode,$ChangeOtherStatusDependency,$ChangeOtherStatusType,$record_id);
			
			/* Default Setting Starts */
			
	}		
				
}	




?>