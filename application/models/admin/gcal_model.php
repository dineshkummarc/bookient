<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gcal_model extends CI_Model{
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
		
		//service date
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
	}
	//PARDCO ADD: Added function to get location correct for the appointments synced to google calendar.
	public function getBookingLocation($local_admin_id) {
		$sql='SELECT ad.business_location, ad.business_zip_code, city.city_name, ct.country_name  
			 FROM app_local_admin ad, app_cities city, app_countries ct
			 WHERE ad.city_id=city.city_id AND city.country_id=ct.country_id AND ad.local_admin_id='.$local_admin_id.'';
		$query = $this->db->query($sql);
		$result = $query->result_array(); //or return this if wanted to keep as an array.
		return utf8_encode (''.$result[0]['business_location'].', '.$result[0]['business_zip_code'].', '.$result[0]['city_name'].', '.$result[0]['country_name'].'');
	}
}
