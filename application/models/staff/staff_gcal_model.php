<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class staff_gcal_model extends CI_Model{
	public function __construct(){	
        date_default_timezone_set('GMT');
    }
	
	public function getSelectedBooking($dateArr,$empArr = array(),$srvArr = array()){
		
		$string		="";
		
		//Employee query start
		if(count($empArr)>0 && is_array($empArr)){
		$string		.= " AND srvDtls_employee_id in (";
			$ls_Emp="";	
			foreach($empArr AS $lsEmp){
	               $ls_Emp	.= $lsEmp.",";
	            }
		$string		.=substr_replace($ls_Emp ,"",-1).")";
		}
		
		//Service query start
		if(count($srvArr)>0 && is_array($srvArr)){
		$string		.= " AND srvDtls_service_id in (";
			$ls_srv="";	
			foreach($srvArr AS $lsEmp){
	               $ls_srv	.= $lsEmp.",";
	            }
		$string		.=substr_replace($ls_srv ,"",-1).")";
		}
		
		//service date OLD
		if(is_array($dateArr)){
			$string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d %H:%i:%s") BETWEEN CAST("'.$dateArr["start"].'" AS datetime) AND CAST("'.$dateArr["end"].'" AS datetime) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d %H:%i:%s") = CAST("'.$dateArr.'" AS datetime) ';
		}
			$string		.= ' AND srvDtls_booking_status  != 4 ';
			
			$start 	= ' srvDtls_service_name AS srvName ';
			$start .= ' ,srvDtls_employee_name AS empNme ';
			$start .= ' ,srvDtls_service_start AS bookStart ';
			$start .= ' ,srvDtls_service_end AS bookEnd ';
			
		$returnArr	=	$this->global_mod->mainBookingStorePro($string);
        return $returnArr;
		
		/*service date
		if(is_array($dateArr)){
			$string .= 'AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$dateArr["start"].'" AS date) AND CAST("'.$dateArr["end"].'" AS date) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$dateArr.'" AS date) ';
		}
			//$string		.= ' AND srvDtls_booking_status  != 4 ';
			
			$string		.= ' ORDER BY booking_id, srvDtls_service_start ';
		$returnArr	=	$this->global_mod->mainBookingStoreProReport($string);
		return $returnArr;*/
		/*$localBookingId = 0;
		$localArr=array();
		$j=0;
		$i=0;
		foreach($returnArr as $returnVal){
			if($localBookingId != $returnVal['booking_id']){			
				$j++;
				$localArr[$j-1]['srvDtls_service_name']			= $returnVal['srvDtls_service_name'];
				$localArr[$j-1]['srvDtls_service_start']= $returnVal['srvDtls_service_start'];
				$localArr[$j-1]['srvDtls_service_end']= $returnVal['srvDtls_service_end'];
				$localArr[$j-1]['bookingCustomerName']	=$returnVal['cus_fname'].'&nbsp;'.$returnVal['cus_lname'];
				$localArr[$j-1]['bookingCustomerAddress']=$returnVal['cus_address'].',&nbsp;'.$returnVal['city_name'].'<br>'.$returnVal['region_name'].',&nbsp;'.$returnVal['country_name'].'<br>'.$returnVal['cus_zip'];
				$localArr[$j-1]['bookingCustomerPhone']	=$returnVal['cus_mob'];
				$localArr[$j-1]['bookingCustomerEmail']	=$returnVal['user_email'];
				$localArr[$j-1]['bookingGrandTotal']	=$returnVal['booking_grnd_total'];
				$localBookingId = $returnVal['booking_id'];
				$i=0;
			}
				$localArr[$j-1]['bookingDetails'][$i]	= $returnVal;
				$i++;
		}

        return $localArr;*/
	}
	
}