<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calender_model extends CI_Model{
	public function __construct(){	
		$this -> calender_colors = FALSE;
        date_default_timezone_set('GMT');
    }
	public function mainBookingStorePro($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call bookingDetails('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}
	public function getAllBooking(){
		$returnArr	=	$this->mainBookingStorePro();

        return $returnArr;
    }
	public function getServiceList(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
                    distinct ser.* 
                FROM 
                    app_biz_hours AS abh, 
                    app_service AS ser 
                WHERE 
                    ser.service_id = abh.service_id AND 
                    ser.is_active = 'Y' AND 
                    abh.local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    public function getEmployeeList(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
                    distinct ae.* 
                FROM 
                    app_biz_hours AS abh, 
                    app_employee AS ae 
                WHERE 
                    ae.employee_id = abh.employee_id AND 
                    ae.is_active = 'Y' AND 
                    abh.local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
	public function getSelectedEmployee($empArr){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		
		if(count($empArr)>0 && is_array($empArr)){
			$ls_Emp="";	
			foreach($empArr AS $lsEmp){
	               $ls_Emp	.= $lsEmp.",";
	            }
			$string	=substr_replace($ls_Emp ,"",-1);
		}
		
        $sql = "SELECT 
                    distinct ae.* 
                FROM 
                    app_biz_hours AS abh, 
                    app_employee AS ae 
                WHERE 
                    abh.employee_id IN (".$string.") AND 
                    ae.is_active = 'Y' AND 
					ae.employee_id IN (".$string.") AND
                    abh.local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
	}
	public function service_date(){

		$starting ='';
		$starting .=' distinct DATE_FORMAT(srvDtls_service_start,"%m_%d_%Y") AS service_dates ';
		
		$string ='';
		$string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") >= DATE_FORMAT(NOW(),"%Y-%m-%d") ';
        $string	.= ' AND srvDtls_booking_status  != 4 AND srvDtls_booking_status  != 5 AND srvDtls_booking_status != 16 ';
		
		$ServiceArr	=	$this->mainBookingStorePro($string,$starting);
        $date_str='';
        foreach ($ServiceArr as $row){
				$date_str .=$row['service_dates']."@@";
        } 
        return substr_replace($date_str ,"",-2);
    }
	public function count_staff_booking($employee_id,$todate,$srvArr = array()){
		$todate = ($todate=='')? gmdate("Y-m-d"):$todate;
		$string='';
		$string		.=' AND srvDtls_employee_id = '.$employee_id;
		$string		.=' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$todate.'" AS date) ';
		$string		.=' AND srvDtls_booking_status != 4 AND srvDtls_booking_status != 5 AND srvDtls_booking_status != 16 ';
		
		if(count($srvArr)>0 && is_array($srvArr)){
		$string		.= " AND srvDtls_service_id in (";
			$ls_srv="";	
			foreach($srvArr AS $lsEmp){
	               $ls_srv	.= $lsEmp.",";
	            }
		$string		.=substr_replace($ls_srv ,"",-1).")";
		}
		
		$returnArr	=	$this->mainBookingStorePro($string);

		return count($returnArr);
    }
    public function checkTime24(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$sql = "SELECT 
                    hours_type 
                FROM 
                    app_local_admin_gen_setting 
                WHERE 
                    local_admin_id = ".$local_admin_id;
        $query = $this->db->query($sql);
        $genSettings = $query->result_array();
        return $genSettings;
	}
    
	public function set_time($time,$genSettings){
		if($genSettings[0]['hours_type'] == 1){
			switch($time){
                case "0":
                    return "00 am";
                    break;
                case "1":
                    return "1 am";
                    break;
                case "2":
                    return "2 am";
                    break;
                    case "3":
                    return "3 am";
                    break;
                case "4":
                    return "4 am";
                    break;
                case "5":
                    return "5 am";
                    break;
                    case "6":
                    return "6 am";
                    break;
                case "7":
                    return "7 am";
                    break;
                case "8":
                    return "8 am";
                    break;
                    case "9":
                    return "9 am";
                    break;
                case "10":
                    return "10 am";
                    break;
                case "11":
                    return "11 am";
                    break;
                    case "12":
                    return "12 am";
                    break;
                case "13":
                    return "1 pm";
                    break;
                case "14":
                    return "2 pm";
                    break;
                    case "15":
                    return "3 pm";
                    break;
                case "16":
                    return "4 pm";
                    break;
                case "17":
                    return "5 pm";
                    break;
                    case "18":
                    return "6 pm";
                    break;
                case "19":
                    return "7 pm";
                    break;
                case "20":
                    return "8 pm";
                    break;
                    case "21":
                    return "9 pm";
                    break;
                case "22":
                    return "10 pm";
                    break;
                case "23":
                    return "11 pm";
                    break;
            }
		}else{
			switch($time){
                case "0":
                    return "00:00";
                    break;
                case "1":
                    return "01:00";
                    break;
                case "2":
                    return "02:00";
                    break;
                    case "3":
                    return "03:00";
                    break;
                case "4":
                    return "04:00";
                    break;
                case "5":
                    return "05:00";
                    break;
                    case "6":
                    return "06:00";
                    break;
                case "7":
                    return "07:00";
                    break;
                case "8":
                    return "08:00";
                    break;
                    case "9":
                    return "09:00";
                    break;
                case "10":
                    return "10:00";
                    break;
                case "11":
                    return "11:00";
                    break;
                    case "12":
                    return "12:00";
                    break;
                case "13":
                    return "13:00";
                    break;
                case "14":
                    return "14:00";
                    break;
                    case "15":
                    return "15:00";
                    break;
                case "16":
                    return "16:00";
                    break;
                case "17":
                    return "17:00";
                    break;
                    case "18":
                    return "18:00";
                    break;
                case "19":
                    return "19:00";
                    break;
                case "20":
                    return "20:00";
                    break;
                    case "21":
                    return "21:00";
                    break;
                case "22":
                    return "22:00";
                    break;
                case "23":
                    return "23:00";
                    break;
            }
		}      
     }
	public function set_time_ampm_new($time){
            switch($time){
                case "0":
                    return "00@@am";
                    break;
                case "1":
                    return "01@@am";
                    break;
                case "2":
                    return "02@@am";
                    break;
                case "3":
                    return "03@@am";
                    break;
                case "4":
                    return "04@@am";
                    break;
                case "5":
                    return "05@@am";
                    break;
                case "6":
                    return "06@@am";
                    break;
                case "7":
                    return "07@@am";
                    break;
                case "8":
                    return "08@@am";
                    break;
                case "9":
                    return "09@@am";
                    break;
                case "10":
                    return "10@@am";
                    break;
                case "11":
                    return "11@@am";
                    break;
                case "12":
                    return "12@@am";
                    break;
                case "13":
                    return "13@@pm";
                    break;
                case "14":
                    return "14@@pm";
                    break;
                case "15":
                    return "15@@pm";
                    break;
                case "16":
                    return "16@@pm";
                    break;
                case "17":
                    return "17@@pm";
                    break;
                case "18":
                    return "18@@pm";
                    break;
                case "19":
                    return "19@@pm";
                    break;
                case "20":
                    return "20@@pm";
                    break;
                case "21":
                    return "21@@pm";
                    break;
                case "22":
                    return "22@@pm";
                    break;
                case "23":
                    return "23@@pm";
                    break;
            }
     }
	public function set_time_ampm($time,$genSettings){
		if($genSettings[0]['hours_type'] == 1){
            switch($time){
                case "0":
                    return "0@@am";
                    break;
                case "1":
                    return "1@@am";
                    break;
                case "2":
                    return "2@@am";
                    break;
                case "3":
                    return "3@@am";
                    break;
                case "4":
                    return "4@@am";
                    break;
                case "5":
                    return "5@@am";
                    break;
                case "6":
                    return "6@@am";
                    break;
                case "7":
                    return "7@@am";
                    break;
                case "8":
                    return "8@@am";
                    break;
                case "9":
                    return "9@@am";
                    break;
                case "10":
                    return "10@@am";
                    break;
                case "11":
                    return "11@@am";
                    break;
                case "12":
                    return "12@@am";
                    break;
                case "13":
                    return "1@@pm";
                    break;
                case "14":
                    return "2@@pm";
                    break;
                case "15":
                    return "3@@pm";
                    break;
                case "16":
                    return "4@@pm";
                    break;
                case "17":
                    return "5@@pm";
                    break;
                case "18":
                    return "6@@pm";
                    break;
                case "19":
                    return "7@@pm";
                    break;
                case "20":
                    return "8@@pm";
                    break;
                case "21":
                    return "9@@pm";
                    break;
                case "22":
                    return "10@@pm";
                    break;
                case "23":
                    return "11@@pm";
                    break;
            }
     	}else{
			switch($time){
                case "0":
                    return "0@@ ";
                    break;
                case "1":
                    return "1@@ ";
                    break;
                case "2":
                    return "2@@ ";
                    break;
                case "3":
                    return "3@@ ";
                    break;
                case "4":
                    return "4@@ ";
                    break;
                case "5":
                    return "5@@ ";
                    break;
                case "6":
                    return "6@@ ";
                    break;
                case "7":
                    return "7@@ ";
                    break;
                case "8":
                    return "8@@ ";
                    break;
                case "9":
                    return "9@@ ";
                    break;
                case "10":
                    return "10@@ ";
                    break;
                case "11":
                    return "11@@ ";
                    break;
                case "12":
                    return "12@@ ";
                    break;
                case "13":
                    return "13@@ ";
                    break;
                case "14":
                    return "14@@ ";
                    break;
                case "15":
                    return "15@@ ";
                    break;
                case "16":
                    return "16@@ ";
                    break;
                case "17":
                    return "17@@ ";
                    break;
                case "18":
                    return "18@@ ";
                    break;
                case "19":
                    return "19@@ ";
                    break;
                case "20":
                    return "20@@ ";
                    break;
                case "21":
                    return "21@@ ";
                    break;
                case "22":
                    return "22@@ ";
                    break;
                case "23":
                    return "23@@ ";
                    break;
            }	
		}
     }
	public function getBookingDetailsServiceWise($bookingServiceId){
		$string		= ' AND srvDtls_id ='.$bookingServiceId;
		$returnArr	=	$this->global_mod->mainBookingStoreProReport($string);
		return $returnArr;
	}
	public function getSelectedBookingAjax_pr_agenda($dateArr,$empArr = array(),$srvArr = array()){
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
			$string .= 'AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$dateArr["start"].'" AS date) AND CAST("'.$dateArr["end"].'" AS date) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$dateArr.'" AS date) ';
		}
			$string		.= ' AND srvDtls_booking_status  != 4 AND srvDtls_booking_status  != 5 AND srvDtls_booking_status != 16 ';
			
			$string		.= ' ORDER BY booking_id, srvDtls_service_start ';
		$returnArr	=	$this->global_mod->mainBookingStoreProReport($string);
		$localBookingId = 0;
		$localArr=array();
		$j=0;
		$i=0;
		foreach($returnArr as $returnVal){
			if($localBookingId != $returnVal['booking_id']){			
				$j++;
				$localArr[$j-1]['bookingId']			= $returnVal['booking_id'];
				$localArr[$j-1]['bookingTime']			= date("h:i A",strtotime($returnVal['srvDtls_service_start']));
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

        return $localArr;
	}
	public function getSelectedBookingAjax_pr($dateArr,$empArr = array(),$srvArr = array()){
		$string		= "";
		//Employee query start
		if(count($empArr)>0 && is_array($empArr)){
		    $string		.= " AND srvDtls_employee_id in (";
		    $ls_Emp="";	
		    foreach($empArr AS $lsEmp){
	            $ls_Emp	.= $lsEmp.",";
	        }
		    $string	.=substr_replace($ls_Emp ,"",-1).")";
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
			$string .= 'AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$dateArr["start"].'" AS date) AND CAST("'.$dateArr["end"].'" AS date) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$dateArr.'" AS date) ';
		}
		$string		.= ' AND srvDtls_booking_status  != 4 AND srvDtls_booking_status  != 5 AND srvDtls_booking_status != 16 ';
		$returnArr	=	$this->mainBookingStorePro($string);
		/*echo '<pre>';
		print_r($returnArr);
		echo '</pre>';
		exit;*/
		$BookingStatusDisp = "";
        if (count($returnArr) > 0){
            $strTosend = "";
            $k=0;
		$show_booked_by = $this -> get_show_booked_by($this->session->userdata('local_admin_id'));
           
            foreach($returnArr as $IndiServDtls){
				$booking_service_id     = $IndiServDtls['srvDtls_service_id'];
				$StartDt                = date("Y-m-d",strtotime($IndiServDtls['srvDtls_service_start']));
				$EndDt                  = date("Y-m-d",strtotime($IndiServDtls['srvDtls_service_end']));
				$StrtTim                = date("H:i:s",strtotime($IndiServDtls['srvDtls_service_start']));
				$EndtTim                = date("H:i:s",strtotime($IndiServDtls['srvDtls_service_end']));
				$service_name           = $IndiServDtls['srvDtls_service_name'];
				$srvcDesc               = $IndiServDtls['srvDtls_service_description'];
				$local_admin_id         = $this->session->userdata('local_admin_id');
				$booking_id             = $IndiServDtls['booking_id'];
				$service_id             = $IndiServDtls['srvDtls_service_id'];
				$service_cost           = $IndiServDtls['srvDtls_service_cost'];
				$employee_id            = $IndiServDtls['srvDtls_employee_id'];
				$cust_name              = $this->customerNameFromSearch($IndiServDtls['customer_id']);//'customer name';///$IndiServDtls['cust_name']; 
				$employee_name          = $IndiServDtls['srvDtls_employee_name'];
				$service_duration       = $IndiServDtls['srvDtls_service_duration'];
				$service_duration_unit  = $IndiServDtls['srvDtls_service_duration_unit'];
				$booking_status         = $IndiServDtls['srvDtls_booking_status'];
				$srvDtls_id				= $IndiServDtls['srvDtls_id'];

                if($booking_status == 0)     {$BookingStatusDisp = "unapproved";}
                elseif($booking_status == 1) {$BookingStatusDisp = "aproved";}
                elseif($booking_status == 2) {$BookingStatusDisp = "pending";}
                elseif($booking_status == 3) {$BookingStatusDisp = "Cmpleted";}
                elseif($booking_status == 4) {$BookingStatusDisp = "canceledByAdmin";}
                elseif($booking_status == 5) {$BookingStatusDisp = "CancelledByUser";}

                $ExplodeArrStartDate = explode("-",$StartDt);
                $StartDateY = $ExplodeArrStartDate[0];
                $StartDateM = $ExplodeArrStartDate[1];
                $StartDateD = $ExplodeArrStartDate[2];

                $ExplodeArrEndDate = explode("-",$EndDt);
                $EndDateY 	= $ExplodeArrEndDate[0];
                $EndDateM 	= $ExplodeArrEndDate[1];
                $EndDateD 	= $ExplodeArrEndDate[2];

                $ExplodeArrStrtTim = explode(":",$StrtTim);
                $StrtTimH 	= $ExplodeArrStrtTim[0];
                $StrtTimM 	= $ExplodeArrStrtTim[1];
                $StrtTimS 	= $ExplodeArrStrtTim[2];

                $ExplodeArrEndtTim = explode(":",$EndtTim);
                $EndtTimH 	= $ExplodeArrEndtTim[0]; 
                $EndtTimM 	= $ExplodeArrEndtTim[1];
                $EndtTimS 	= $ExplodeArrEndtTim[2];

                $strTosend[$k]['booking_service_id'] = $booking_service_id;
                $strTosend[$k]['local_admin_id'] = $local_admin_id;
                $strTosend[$k]['booking_id'] = $booking_id;
                $strTosend[$k]['service_id'] = $service_id;
                $strTosend[$k]['service_cost'] = $service_cost;
				$strTosend[$k]['srvDtls_id'] = $srvDtls_id;
                $strTosend[$k]['cust_name'] = $cust_name;
                $strTosend[$k]['employee_name'] = $employee_name;
                $strTosend[$k]['employee_id'] = $employee_id;
                $strTosend[$k]['BookingStatusDisp'] = $BookingStatusDisp;
                $strTosend[$k]['service_duration'] = $service_duration." ".$service_duration_unit;
                $strTosend[$k]['booking_status'] = $booking_status;
                $strTosend[$k]['service_name'] = $service_name;
                $strTosend[$k]['srvcDesc'] = $srvcDesc; 
                $strTosend[$k]['StrtTim'] = $StrtTim;
                $strTosend[$k]['EndtTim'] = $EndtTim;
                $strTosend[$k]['start'] = $StartDateY."@_@".$StartDateM."@_@".$StartDateD."@_@".$StrtTimH."@_@".$StrtTimM;
                $strTosend[$k]['end'] = $EndDateY."@_@".$EndDateM."@_@".$EndDateD."@_@".$EndtTimH."@_@".$EndtTimM;
                $strTosend[$k]['allDay'] = 'false';
                
              //  $strTosend[$k]['booked'] = "<span class='book_cont'><label>Title:</label>".$service_name." :: ".$srvcDesc."<br><label>FOR:</label>".$cust_name."<br><label>BY:</label>".$employee_name."<br><label>FROM:</label>".date("h:i a",strtotime($IndiServDtls['srvDtls_service_start']))."<br><label>TO:</label>".date("h:i a",strtotime($IndiServDtls['srvDtls_service_end']))."</span>";
				//PARDCO ADDITION

				//$booking_style = booking_status_style($booking_status);
			    $booking_style = $this->calendar_booking_status_style($booking_status);
			    $this -> db -> select('added_by, booking_comment');
			    $this -> db -> from('app_booking');
			    $this -> db -> where('booking_id', $booking_id);
			    $this -> db -> where('local_admin_id', $local_admin_id);
			    $result = $this -> db -> get() -> row();

			    $added_by = $result -> added_by;
				$notes = $result -> booking_comment;
				
				//Checking the time
				$past_opacity = "";
				
				/*if( date( "Y-m-d" ) == $EndDt && date( "H:i:s" ) >= $EndtTim || date( "Y-m-d" ) > $EndDt ) {
					$past_opacity = "-webkit-filter: grayscale(70%);";// Do something clever
				}*/
				
			    if (time() > strtotime($IndiServDtls['srvDtls_service_end'])) //Time Zone fix, and verify that right data is needed
				{
					$past_opacity = "-webkit-filter: grayscale(70%);"; // current time is greater than time of the appointment
				}
				
				ob_start();
				echo '<span class="book_cont" style="' , $booking_style , ' ' , $past_opacity , '">' , 
					'<label>Title:</label> ' , $service_name , ' :: ' , $srvcDesc , '<br>';
				if ($show_booked_by)
				{
					echo '<label>Booked by</label> ' , ($added_by == 1 ? 'User' : 'Admin') . '<br>';
				}
				echo '<label>FOR:</label> ' , $cust_name , '<br>' , 
					'<label>Duration:</label> ' , $strTosend[$k]['service_duration'] , '<br>' , 
					'<label>Info:</label>' , $notes , '</span>';
				$strTosend[$k]['booked'] = ob_get_contents();
				ob_end_clean();
			  
			  //ORIGINAL
              //$strTosend[$k]['booked'] = "<span class='book_cont'><label>Title:</label>".$service_name." :: ".$srvcDesc."<br><label>FOR:</label>".$cust_name."</span>";
			  //PARDCO ADDITION END
                $k++; 
            } 
        }else{
            $strTosend = 0;
        }
        return $strTosend;
	}
	public function customerName($customerId){
        $sql = "SELECT 
                    value
                FROM 
                    app_local_customer_details 
                WHERE
					sign_upinfo_item_id IN ( 2,3)
					AND 
                    customer_id = '".$customerId."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
		$str ='';
		foreach($Arr as $ArrVal){
		$str .= $ArrVal['value'].'&nbsp;';	
		}
        return $str;
		
	
	}
	public function getSelectedBookingAjax_weekData($dateArr,$empArr = array(),$srvArr = array()){
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
			$string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$dateArr["start"].'" AS date) AND CAST("'.$dateArr["end"].'" AS date) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$dateArr.'" AS date) ';
		}
			$string		.= ' AND srvDtls_booking_status  != 4 ';
			
			$start 	= ' srvDtls_service_name AS srvName ';
			$start .= ' ,srvDtls_employee_name AS empNme ';
			$start .= ' ,srvDtls_service_start AS bookStart ';
			$start .= ' ,srvDtls_service_end AS bookEnd ';
			$start .= ' ,srvDtls_booking_status AS bookingStatus ';
			$start .= ' ,srvDtls_service_duration AS duration ';
			
		$returnArr	=	$this->mainBookingStorePro($string,$start);
        return $returnArr;
	}
	
	public function getSelectedBookingAjax_pr_week($dateArr,$empArr = array(),$srvArr = array()){
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
			
		$returnArr	=	$this->mainBookingStorePro($string,$start);
        return $returnArr;
	}
	
	public function getSelectedBookingAjax_pr_month($dateArr,$empArr = array(),$srvArr = array()){
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
			$string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d %h:%i:%s") BETWEEN CAST("'.$dateArr["start"].'" AS datetime) AND CAST("'.$dateArr["end"].'" AS datetime) ';
		}else{
			$string		.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$dateArr.'" AS date) ';
		}
			$string		.= ' AND srvDtls_booking_status  != 4 ';
			
			$string		.= ' GROUP BY srvDtls_employee_id';
		
		$start = ' srvDtls_service_name AS empname ';
		$start .= ' ,srvDtls_service_start AS bookDate ';
		$start .= ' ,count(*) AS bookCount ';
		
		$returnArr	=	$this->mainBookingStorePro($string,$start);
		
        return $returnArr;
	}
	public function convertTimeInLocal($time){
		$dbTime		=	$this->global_mod->getTimeZoneDiff();
		$dbTimeEx	=	explode(":", $dbTime[0]['gmt_value']);
		$dbTimeSec	=	intval($dbTimeEx[0])*3600+intval($dbTimeEx[1])*60+intval($dbTimeEx[2]);		
		$TimeEx		=	explode(":", $time);
		$TimeSec	=	intval($TimeEx[0])*3600+intval($TimeEx[1])*60+intval($TimeEx[2]);		
		$ls_total	=	$dbTimeSec  +  ($dbTime[0]['gmt_symbol'].$TimeSec);

		return date("h:i:s A",$ls_total);
	}
	public function get_week_data($weekStartDt, $weekEndDt, $srvArr =array(), $empArr =array()){      
		$string = '';
		$string .= 'AND DATE_FORMAT(booking_date_time,"%Y-%m-%d") BETWEEN CAST("'.$weekStartDt.'" AS date) AND CAST("'.$weekEndDt.'" AS date) ';
		
		//Service query start
		if(count($srvArr)>0 && is_array($srvArr)){
		$string	.= " AND srvDtls_service_id in (";
			$ls_srv="";	
			foreach($srvArr AS $lsEmp){
	               $ls_srv	.= $lsEmp.",";
	            }
		$string	.=substr_replace($ls_srv ,"",-1).")";
		}
		
		//Employee query start 
		if(count($empArr)>0 && is_array($empArr)){
		$string		.= " AND srvDtls_employee_id in (";
			$ls_Emp="";	
			foreach($empArr AS $lsEmp){
	               $ls_Emp	.= $lsEmp.",";
	            }
		$string		.=substr_replace($ls_Emp ,"",-1).")";
		}
		

		$returnArr	=	$this->mainBookingStorePro($string);


        if (count($returnArr) > 0){
            $strTosend = "";
            $k=0;
            foreach($returnArr as $IndiServDtls){
                $booking_service_id     = $IndiServDtls['srvDtls_service_id'];
                $StartDt                = date("Y-m-d",strtotime($IndiServDtls['srvDtls_service_start']));
                $EndDt                  = date("Y-m-d",strtotime($IndiServDtls['srvDtls_service_end']));
                $StrtTim                = date("H:i:s",strtotime($IndiServDtls['srvDtls_service_start']));
                $EndtTim                = date("H:i:s",strtotime($IndiServDtls['srvDtls_service_end']));
                $service_name           = $IndiServDtls['srvDtls_service_name'];
                $srvcDesc               = $IndiServDtls['srvDtls_service_description'];
                $local_admin_id         = $this->session->userdata('local_admin_id');
                $booking_id             = $IndiServDtls['booking_id'];
                $service_id             = $IndiServDtls['srvDtls_service_id'];
                $service_cost           = $IndiServDtls['srvDtls_service_cost'];
                $employee_id            = $IndiServDtls['srvDtls_employee_id'];
                $cust_name              = 'Customer Name';//$IndiServDtls['cust_name']; 
                $employee_name          = $IndiServDtls['srvDtls_employee_name'];
                $service_duration       = $IndiServDtls['srvDtls_service_duration'];
                $service_duration_unit  = $IndiServDtls['srvDtls_service_duration_unit'];
                $booking_status         = $IndiServDtls['srvDtls_booking_status'];
		$srvDtls_id		= $IndiServDtls['srvDtls_id'];

                if($booking_status == 0)     {$BookingStatusDisp = "Unapproved";}
                elseif($booking_status == 1) {$BookingStatusDisp = "Aproved";}
                elseif($booking_status == 2) {$BookingStatusDisp = "Pending";}
                elseif($booking_status == 3) {$BookingStatusDisp = "Completed";}
                elseif($booking_status == 4) {$BookingStatusDisp = "CancelledByAdmin";}
                elseif($booking_status == 5) {$BookingStatusDisp = "CancelledByUser";}

                $ExplodeArrStartDate = explode("-",$StartDt);
                $StartDateY = $ExplodeArrStartDate[0];
                $StartDateM = $ExplodeArrStartDate[1];
                $StartDateD = $ExplodeArrStartDate[2];

                $ExplodeArrEndDate = explode("-",$EndDt);
                $EndDateY 	= $ExplodeArrEndDate[0];
                $EndDateM 	= $ExplodeArrEndDate[1];
                $EndDateD 	= $ExplodeArrEndDate[2];

                $ExplodeArrStrtTim = explode(":",$StrtTim);
                $StrtTimH 	= $ExplodeArrStrtTim[0];
                $StrtTimM 	= $ExplodeArrStrtTim[1];
                $StrtTimS 	= $ExplodeArrStrtTim[2];

                $ExplodeArrEndtTim = explode(":",$EndtTim);
                $EndtTimH 	= $ExplodeArrEndtTim[0];
                $EndtTimM 	= $ExplodeArrEndtTim[1];
                $EndtTimS 	= $ExplodeArrEndtTim[2];
                
                $blockTime = date("h:i a",strtotime($StrtTim));

                $strTosend[$k]['booking_service_id'] = $booking_service_id;
                $strTosend[$k]['local_admin_id'] = $local_admin_id;
		$strTosend[$k]['srvDtls_id'] = $srvDtls_id;
                $strTosend[$k]['booking_id'] = $booking_id;
                $strTosend[$k]['service_id'] = $service_id;
                $strTosend[$k]['service_cost'] = $service_cost;
                $strTosend[$k]['cust_name'] = $cust_name;
                $strTosend[$k]['employee_name'] = $employee_name;
                $strTosend[$k]['employee_id'] = $employee_id;
                $strTosend[$k]['BookingStatusDisp'] = $BookingStatusDisp;
                $strTosend[$k]['service_duration'] = $service_duration." ".$service_duration_unit;
                $strTosend[$k]['booking_status'] = $booking_status;
                $strTosend[$k]['service_name'] = $service_name;
                $strTosend[$k]['srvcDesc'] = $srvcDesc;
                $strTosend[$k]['StrtTim'] = $StrtTim;
                $strTosend[$k]['EndtTim'] = $EndtTim;
                $strTosend[$k]['start'] = $StartDateY."@_@".$StartDateM."@_@".$StartDateD."@_@".$StrtTimH."@_@".$StrtTimM;
                $strTosend[$k]['end'] = $EndDateY."@_@".$EndDateM."@_@".$EndDateD."@_@".$EndtTimH."@_@".$EndtTimM;
                $strTosend[$k]['allDay'] = 'false';
                $strTosend[$k]['booked'] = '<h3 class=\'ui-widget-header\'>'.$blockTime.'</h3><div class=\'min_max_div\' style="display:none;"><span class=\'book_cont\'><label>title:</label>'.$service_name.' :: '.$srvcDesc.'<br><label>FOR:</label>'.$cust_name.'<br><label>BY:</label>'.$employee_name.'<br><label>FROM:</label>'.$StrtTim.'<br><label>TO:</label>'.$EndtTim.'</span></div>';
                $k++; 
            } 
        }
        else
        {
            $strTosend = 0;
        }

        return ($strTosend) ;

    }
	public function grpBookingDetails($inputString){
		$string		= ' AND srvDtls_id IN ('.$inputString.') ';
		$returnArr	=	$this->mainBookingStorePro($string);
		return $returnArr;
	}
	public function staffWiseBizSchedule($staffId,$selectedDate,$serviceArr=array()){
		$string = '';
		$string .=' AND employee_id ='.$staffId.' AND day_id='.date ("N", strtotime($selectedDate));
		
		$string .= ' AND DATE_FORMAT(CAST("'.$selectedDate.'" AS datetime),"%H:%i:%s") BETWEEN time_from AND time_to ';
		if(COUNT($serviceArr) != 0){
			$srvString = '';
			foreach($serviceArr as $index=>$servVa){ 
				$srvString.= $servVa.',';
			}
		    $string .=' AND service_id IN ('.substr_replace($srvString ,"",-1).')';	
		}
		$returnArr = $this->global_mod->mainBizSchedule($string);
		return $returnArr;
	}
	public function employeeDetails($employeeId){
		$local_admin_id		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
                    * 
                FROM 
                    app_employee 
                WHERE 
                    employee_id = '".$employeeId."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
public function employeeWiseServiceTwentyFour($employeeId, $localAdminId)
{
	$sql = 'SELECT DISTINCT `app_biz_hours`.`service_id`, `app_service`.`service_name`
		FROM `app_biz_hours`, `app_service`
		WHERE `app_biz_hours`.`local_admin_id` = ' . $localAdminId . '
		AND `app_biz_hours`.`employee_id` = ' . $employeeId . '
		AND `app_biz_hours`.`service_id` = `app_service`.`service_id`
		AND `app_service`.`local_admin_id`= ' . $localAdminId;
	$query = $this -> db -> query($sql);
	
	ob_start();
	foreach ($query -> result() as $row)
	{
		echo '<option value="' , $row -> service_id , '">' , $row -> service_name , '</option>';
	}
	$r = ob_get_contents();
	ob_end_clean();
	return $r;
}

	public function employeeWiseService($staffArr,$bookingDateTime){
		$str	= '';
		foreach($staffArr AS $staff){
			$serviceDetails	= $this->global_mod->serviceDetails($staff['service_id']);
			$bookEndTime	= date('H:i:s', strtotime('+'.$serviceDetails[0]['service_duration_min'].' minutes', strtotime($bookingDateTime)));
			if(strtotime($staff['time_from']) <= strtotime($bookEndTime) && strtotime($staff['time_to']) >= strtotime($bookEndTime)){
				$str .= '<option value="'.$serviceDetails[0]['service_id'].'">'.$serviceDetails[0]['service_name'].'</option>';
			}
		}
		return $str;
	}
	public function region_ajax_cal($country_id){
        $str='';
        $query=$this->db->query("SELECT * from app_regions where country_id='$country_id'");
		$str .='<select onchange="re(this.value)" id="appo_region" name="appo_region" class="text_search ui-widget-content ui-corner-all">';
        $str .='<option value="-1" selected="selected">--Select Region--</option>';	
        if ($query->num_rows() > 0){						 
            foreach ($query->result() as $row){
                $region_id=$row->region_id;
                $region_name=$row->region_name;
                $str .='<option value="'.$region_id.'" >'.$region_name.'</option>';
            }	
		}
		$str.='</select>';	 	
        return $str;
    }
	public function city_ajax($region_id){
        $str ='';
        $str .='<select id="appo_city" name="appo_city" class="text_search ui-widget-content ui-corner-all">';
        $str .='<option value="-1"  selected="selected">--Select City--</option>';
			
		$a=$this->db->query("SELECT * from app_cities where region_id='$region_id'");
		$result = $a->result();	
		if(count($result>0)){						 
	        foreach ($result as $row){
	            $city_id=$row->city_id;
	            $city_name=$row->city_name;
	            $str .='<option value="'.$city_id.'" >'.$city_name.'</option>';
	        }
		}		
        $str .='</select>';
        return $str;
    }
	public function getTimeZone(){
        $sql=$this->db->query("SELECT * FROM app_time_zone WHERE is_active = 'Y' ORDER BY time_zone_name");
        $zone = "";
        foreach ($sql->result() as $row){
            $time_zone_id=$row->time_zone_id;
            $time_zone_name=$row->time_zone_name;
            $zone.="<option value=".$time_zone_id.">".$time_zone_name."</option>";
        }
        return $zone;
    }
	public function country($customer_id=''){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");

        foreach ($sql->result() as $row){
            $country_name_id=$row->country_id;
        }
        if($customer_id !=''){
            $query=$this->db->query("SELECT value from app_local_customer_details where local_admin_id='".$local_admin_id."' and 
                                        sign_upinfo_item_id='5' and customer_id='".$customer_id."'");
            if ($query->num_rows() > 0){
                $row1 = $query->row();		
                $country_name_id=$row1->value;
            }else{
                $country_name_id="";
            }
        }else{

            $query=$this->db->query("SELECT country_id from app_local_admin where local_admin_id='".$local_admin_id."'");
            $row1 = $query->row();		
            $country_name_id=$row1->country_id;
        }

        $country='';
        $sql=$this->db->query("SELECT * from app_countries");
        foreach ($sql->result() as $row){
            $country_name=$row->country_name;
            $country_id=$row->country_id;
            if($country_id==$country_name_id){
                $country_id_selected="selected";
            }else{
                $country_id_selected="";
            }
            $country.="<option value=".$country_id.">".$country_name."</option>";
        }
        return $country;		
    }
	public function customerGlobalSearch($searchKey){
		//Search by Email or Phone
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$sql ="SELECT DISTINCT	
						cust.cus_id					AS  user_id,
						cust.cus_fname				AS cus_fname,
						cust.cus_lname				AS cus_lname,
						cust.cus_address			AS cus_address,
						cust.cus_countryid			AS cus_countryid,
						cust.cus_regionid			AS cus_regionid,
						cust.cus_cityid				AS cus_cityid,
						cust.cus_zip				AS cus_zip,
						cust.cus_mob				AS cus_mob,
						cust.cus_phn1				AS cus_phn1,
						cust.cus_phn2				AS cus_phn2,
						cust.time_zone_id			AS time_zone_id,
						rel.customer_tag			AS customer_tag,
						rel.customer_info			AS customer_info,
						pass.user_email				AS user_email,
						pass.email_veri_status		AS email_veri_status
				FROM
						app_customer_search				AS cust,
						app_customer_admin_relationship	AS rel,
						app_password_manager			AS pass
				WHERE
						pass.user_type = 1
						AND
						rel.customer_id = pass.user_id 
						AND
						rel.search_id = cust.search_id 
						AND
						rel.local_admin_id !=".$local_admin_id."
						AND
						( pass.user_email LIKE '".$searchKey."%'
						OR
						cust.cus_mob LIKE '".$searchKey."%')";
			
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
	}
	public function customerLocalSearch($searchKey){
		$searchKey = $this->global_mod->db_parse($searchKey);
		
		$local_admin_id		= $this->session->userdata('local_admin_id');
		//Search by First name or Last name or Email or Phone
		$sql ="SELECT	
					cust.cus_id					AS  user_id,
					cust.cus_fname				AS cus_fname,
					cust.cus_lname				AS cus_lname,
					cust.cus_address			AS cus_address,
					cust.cus_countryid			AS cus_countryid,
					cust.cus_regionid			AS cus_regionid,
					cust.cus_cityid				AS cus_cityid,
					cust.cus_zip				AS cus_zip,
					cust.cus_mob				AS cus_mob,
					cust.cus_phn1				AS cus_phn1,
					cust.cus_phn2				AS cus_phn2,
					cust.time_zone_id			AS time_zone_id,
					rel.customer_tag			AS customer_tag,
					rel.customer_info			AS customer_info,
					pass.user_email				AS user_email,
					pass.email_veri_status		AS email_veri_status
			FROM
					app_customer_search				AS cust,
					app_customer_admin_relationship	AS rel,
					app_password_manager			AS pass
			WHERE
					pass.user_type = 1
					AND
					rel.customer_id = pass.user_id 
					AND
					rel.search_id = cust.search_id 
					AND
					rel.local_admin_id =".$local_admin_id."
					AND
					( cust.cus_fname LIKE '%".$searchKey."%'
					OR
					cust.cus_lname LIKE '%".$searchKey."%'
					OR
					pass.user_email LIKE '%".$searchKey."%'
					OR
					cust.cus_mob LIKE '%".$searchKey."%' )";					
					
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
	}
	public function adminEmployeeBlocking($block_from,$block_to,$employeeArr){

	foreach($employeeArr AS $key=>$employeeId){
			$dateDiff = floor(abs(strtotime($block_from) - strtotime($block_to))/(60*60*24));
			for($i=0;$i<=$dateDiff;$i++){
			$currentDate	=	date ("Y-m-d", strtotime("+".$i." day", strtotime($block_from)));

			$this->db->select(' * ');
			$this->db->from('app_staff_unavailable');
			$this->db->where('employee_id', $employeeId);
			$this->db->where('block_date', 'CAST("'.$currentDate.'" AS date)');
			$sql= "SELECT 
						* 
						FROM 
						app_staff_unavailable
						WHERE
						employee_id = '".$employeeId."'
						AND
						block_date	= '".$currentDate."'";
			$query = $this->db->query($sql);
        	$Arr = $query->result_array();
				if(count($Arr) == 0){
					$data = array(
					            'employee_id' 	=> $employeeId,
					            'block_date'    => $currentDate,
					            'date_added' 	=> date('Y-m-d H:i:s')
					             );
					$this->db->insert('app_staff_unavailable',$data);
						$sql= "SELECT 
						unavailable_time_id
						FROM 
						app_staff_unavailable_time
						WHERE
						employee_id = '".$employeeId."'
						AND
						date	= '".$currentDate."'";
					$query = $this->db->query($sql);
		        	$idArr = $query->result_array();
					
					$deleteArr=array(
					            'unavailable_time_id' 	=> $idArr[0]['unavailable_time_id']
					             );
					$this->db->delete('app_staff_unavailable_time', $deleteArr); 
					$deleteArrC=array(
					            'continuation_id' 	=> $idArr[0]['unavailable_time_id']
					             );
					$this->db->delete('app_staff_unavailable_time', $deleteArrC);
				}
			}
		}		
}
	public function checkingStaffBlockDate($employeeId,$currentDate){
		$string	= '';
		$string .= ' AND DATE_FORMAT(block_date,"%Y-%m-%d") = DATE_FORMAT(CAST("'.$currentDate.'" AS date),"%Y-%m-%d") ';
		$string .= ' AND unavailable_time_id =0 ';
		$string .= ' AND employee_id ="'.$employeeId.'" ';

		$result = $this->global_mod->staffBlockingStorePro($string);
		return COUNT($result);
	}
	public function checkingStaffBlockTime ($employeeId,$currentDate){
		$string	= '';
		$string .= ' AND DATE_FORMAT(block_date,"%Y-%m-%d") = DATE_FORMAT(CAST("'.$currentDate.'" AS date),"%Y-%m-%d") ';
		$string .= ' AND unavailable_time_id !=0 ';
		$string .= ' AND employee_id ="'.$employeeId.'" ';

		$result = $this->global_mod->staffBlockingStorePro($string);
		return COUNT($result);
	}
	public function checkingReschedule($rescheduleDateTime,$dropEmployeeId,$dragServiceId){
		$string =' AND srvDtls_id = "'.$dragServiceId.'"';
		$serviceDetailsArr	=	$this->mainBookingStorePro($string);
		$empArr	= array($dropEmployeeId);
		$srvArr	= array($serviceDetailsArr[0]['srvDtls_service_id']);
		$bookAlways = $this->booking_always_allowed($this->session->userdata('local_admin_id'));//PARDCO ADDITION
		$checkAvailability		=	$this->global_mod->checkStaffAvailability($rescheduleDateTime,$empArr,$srvArr,$bookAlways); //ADDED $bookAlways
		return $checkAvailability[0][0]['bk_status'];
		//return TRUE;
	}
	public function serviceDetails($serviceId){
        $sql = "SELECT 
                    * 
                FROM 
                    app_service 
                WHERE 
                    service_id = '".$serviceId."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
	public function adminRescheduleSave($rescheduleDateTime,$dropEmployeeId,$dragServiceId,$is_mail='',$serviceQuantity=''){
            $string =' AND srvDtls_id = "'.$dragServiceId.'"';
            $serviceDetailsArr	= $this->mainBookingStorePro($string);
            
            $empDetails			= $this->calender_model->employeeDetails($dropEmployeeId);
            $srvDetails			= $this->calender_model->serviceDetails($serviceDetailsArr[0]['srvDtls_service_id']);
            $rescheduleDateTime	= $this->global_mod->gmtTimeReturn($rescheduleDateTime);
            $endTime = date('Y-m-d H:i:s', strtotime('+'.$srvDetails[0]['service_duration_min'].' minutes', strtotime($rescheduleDateTime)));
            $insertData = array(
                            'srvDtls_booking_id'		=> $serviceDetailsArr[0]['booking_id'],
                            'srvDtls_service_id'		=> $serviceDetailsArr[0]['srvDtls_service_id'],
                            'srvDtls_service_name'		=> $serviceDetailsArr[0]['srvDtls_service_name'],
                            'srvDtls_service_cost'		=> $serviceDetailsArr[0]['srvDtls_service_cost'],
                            'srvDtls_service_duration' 		=> $serviceDetailsArr[0]['srvDtls_service_duration'],
                            'srvDtls_service_duration_unit'	=> $serviceDetailsArr[0]['srvDtls_service_duration_unit'],
                            'srvDtls_service_start'		=> $rescheduleDateTime,
                            'srvDtls_service_end'		=> $endTime,
                            'srvDtls_employee_id'		=> $empDetails[0]['employee_id'],
                            'srvDtls_employee_name'		=> $empDetails[0]['employee_name'],
                            'srvDtls_booking_status'		=> '2',
                            'srvDtls_status_date'		=> date('Y-m-d H:i:s'),
                            'srvDtls_service_quantity'		=> ($serviceQuantity =='')?$serviceDetailsArr[0]['srvDtls_service_quantity']:$serviceQuantity,
                            'srvDtls_rescheduled_child_id'	=> 0,
                            'srvDtls_service_description' 	=> $serviceDetailsArr[0]['srvDtls_service_description']
                          );
            
            $insertData = $this->global_mod->db_parse($insertData);             
            $this->db->insert('app_booking_service_details',$insertData);
            $insert_id = $this->db->insert_id();
            $updateData = array(
                            'srvDtls_status_date'		=> date('Y-m-d H:i:s'),
                            'srvDtls_booking_status'		=> '16',
                            'srvDtls_rescheduled_child_id'	=> $serviceDetailsArr[0]['srvDtls_id']
                          );
            $this->db->where('srvDtls_id', $dragServiceId);
            $this->db->update('app_booking_service_details', $updateData); 
            if($insert_id == 0 || $insert_id == ''){
                return 0;
            }else{
            	return $insert_id;
                //return 1;
            }
		
	}
	public function adminNewCustomerInsert($dataArr){
            $local_admin_id     = $this->session->userdata('local_admin_id');
            $customerData = array(
                'user_type'			=> 1,
                'register_from'		=> 1,
                'user_name'			=> $dataArr['fName'],
                'user_name_enc'		=> '',
                'password' 			=> $dataArr['mobileNo'],
                'user_email'		=> $dataArr['email'],
                'encription_key'	=> '',
                'email_veri_status'	=> 1,
                'user_status'		=> 1,
                'date_creation'		=> date('Y-m-d H:i:s'),
                'date_modified'		=> date('Y-m-d H:i:s')
            );
			$customerData = $this->global_mod->db_parse($customerData);
            $this->db->insert('app_password_manager',$customerData);
            $lastPassTableId = $this->db->insert_id();
            
			$srcData = array(
			    'cus_fname'			=> $dataArr['fName'],
			    'cus_lname'			=> $dataArr['lName'],
			    'cus_address'		=> $dataArr['address'],
			    'cus_countryid'		=> ($dataArr['countryId']=='-1')?'':$dataArr['countryId'],
			    'cus_regionid' 		=> ($dataArr['regionId']=='-1')?'':$dataArr['regionId'],
			    'cus_cityid'		=> ($dataArr['cityId'] =='-1')?'':$dataArr['cityId'],
			    'cus_zip'			=> $dataArr['pinCode'],
			    'cus_mob'			=> $dataArr['mobileNo'],
			    'cus_phn1'			=> $dataArr['homeNo'],
			    'cus_phn2'			=> $dataArr['workNo'],
			    'cus_status'		=> 1,
			    'created_by'		=> $local_admin_id,
			    'created_on'		=> date('Y-m-d H:i:s'),
			    'time_zone_id'		=> $dataArr['timeZoneId'],
				'cus_id'			=> $lastPassTableId
			);
			$srcData = $this->global_mod->db_parse($srcData);
			$this->db->insert('app_customer_search',$srcData);
			$lastSearchTableId = $this->db->insert_id();
			
			$relationshipData = array(
				'local_admin_id'	=> $local_admin_id,
				'customer_id'		=> $lastPassTableId,
				'search_id'			=> $lastSearchTableId
			);
			$this->db->insert('app_customer_admin_relationship',$relationshipData);

            $firstName = $dataArr['fName'];
            $last_name = $dataArr['lName'];
            $SITE_URL  = base_url();
            $full_name = $this->session->userdata('ad_fname').' '.$this->session->userdata('ad_lname');
            $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $firstName,
								'{lname}' 					=> $last_name,
								'{businessLink}' 			=> $SITE_URL,
								'{clientemail}' 			=> $dataArr['email'],
								'{yourfullname}' 			=> $full_name
								
								);
								
            $email_from = $this->session->userdata('local_admin_email');
            $mail = $this->email_model->sentMail(10, $replacerArr, $dataArr['email'], $email_from);
            return $lastPassTableId;
	}
	public function adminNewUserInsert($dataArr){
            $local_admin_id     = $this->session->userdata('local_admin_id');
            $this->db->select('user_email');
            $this->db->from('app_password_manager');
            $this->db->where('user_id',$local_admin_id);
            $query = $this->db->get();		
            $Ret_Arr_val = $query->result_array();       
            $email_from = $Ret_Arr_val[0]['user_email'];
            
            $user_id            = $this->session->userdata('user_id');
            $customerData = array(
                'user_type'			=> 1,
                'register_from'		=> 1,
                'user_name'			=> $dataArr['fName'],
                'user_name_enc'		=> '',
                'password' 			=> $dataArr['mobileNo'],
                'user_email'		=> $dataArr['email'],
                'encription_key'	=> '',
                'email_veri_status'	=> 1,
                'user_status'		=> 1,
                'date_creation'		=> date('Y-m-d H:i:s'),
                'date_modified'		=> date('Y-m-d H:i:s')
            );
			$customerData = $this->global_mod->db_parse($customerData);
            $this->db->insert('app_password_manager',$customerData);
            $insert_id = $this->db->insert_id();

            $relationshipData = array(
                   'local_admin_id'	=> $local_admin_id,
                   'customer_id'	=> $insert_id
            );
            $this->db->insert('app_customer_admin_relationship',$relationshipData);

            $userData[0]['value']	=	$dataArr['fName'];
            $userData[0]['key']		=	2;
            $userData[1]['value']	=	$dataArr['lName'];
            $userData[1]['key']		=	3;
            $userData[2]['value']	=	$dataArr['address'];
            $userData[2]['key']		=	4;
            $userData[3]['value']	=	$dataArr['countryId'];
            $userData[3]['key']		=	5;
            $userData[4]['value']	=	$dataArr['regionId'];
            $userData[4]['key']		=	6;
            $userData[5]['value']	=	$dataArr['cityId'];
            $userData[5]['key']		=	7;
            $userData[6]['value']	=	$dataArr['pinCode'];
            $userData[6]['key']		=	8;
            $userData[7]['value']	=	$dataArr['mobileNo'];
            $userData[7]['key']		=	9;
            $userData[8]['value']	=	$dataArr['homeNo'];
            $userData[8]['key']		=	10;
            $userData[9]['value']	=	$dataArr['workNo'];
            $userData[9]['key']		=	11;
            $userData[10]['value']	=	$user_id;
            $userData[10]['key']	=	17;
            $userData[11]['value']	=	$dataArr['timeZoneId'];
            $userData[11]['key']	=	21;

            foreach($userData as $userArr){
                $eavData = array(
                    'local_admin_id'		=> $local_admin_id,
                    'sign_upinfo_item_id'	=> $userArr['key'],
                    'customer_id'		=> $insert_id,
                    'value'			=> $userArr['value'],
                    'date_inserted' 		=> date('Y-m-d'),
                    'date_edited'		=> date('Y-m-d H:i:s')
                );
                $this->db->insert('app_local_customer_details',$eavData);
            }
            
            
             $srcData = array(
             		'cus_id'			=> $insert_id,
                    'cus_fname'			=> $dataArr['fName'],
                    'cus_lname'			=> $dataArr['lName'],
                    'cus_address'		=> $dataArr['address'],
                    'cus_countryid'		=> ($dataArr['countryId']=='-1')?'':$dataArr['countryId'],
                    'cus_regionid' 		=> ($dataArr['regionId']=='-1')?'':$dataArr['regionId'],
                    'cus_cityid'		=> ($dataArr['cityId'] =='-1')?'':$dataArr['cityId'],
                    'cus_zip'			=> $dataArr['pinCode'],
                    'cus_mob'			=> $dataArr['mobileNo'],
                    'cus_phn1'			=> $dataArr['homeNo'],
                    'cus_phn2'			=> $dataArr['workNo'],
                    'cus_status'		=> 1,
                    'time_zone_id'		=> $dataArr['timeZoneId']
                );
                $srcData = $this->global_mod->db_parse($srcData);
                $this->db->insert('app_customer_search',$srcData);

            $firstName = $userData[0]['value'];
            $last_name = $userData[1]['value'];
            $SITE_URL  = base_url();
            $full_name = $this->session->userdata('ad_fname').' '.$this->session->userdata('ad_lname');
            $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $firstName,
								'{lname}' 					=> $last_name,
								'{businessLink}' 			=> $SITE_URL,
								'{clientemail}' 			=> $dataArr['email'],
								'{yourfullname}' 			=> $full_name
								
								);
								
            $email_from = $this->session->userdata('local_admin_email');
            $mail = $this->email_model->sentMail(10, $replacerArr, $dataArr['email'], $email_from);
            return $insert_id;
	}
	public function adminNewBooking($inputArr,$lastCustomerId){
		
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$user_id			= $this->session->userdata('user_id');
		$currencyId			= $this->session->userdata('local_admin_ses_currency_id');
		$empArr				= $this->employeeDetails($inputArr['employeeId']);
		$srvArr				= $this->serviceDetails($inputArr['serviceId']);
		$subTotal			= $srvArr[0]['service_cost']*$inputArr['serviceQuantity'];
		$bookingData = array( 
				'local_admin_id'				=> $local_admin_id,
				'booking_date_time'				=> date('Y-m-d H:i:s'),
				'customer_id'					=> $lastCustomerId,
				'currency_id'					=> $currencyId,
				'booking_sub_total' 			=> $subTotal,
				'booking_disc_amount'			=> 0,
				'booking_disc_coupon_details'	=> 0,
				'booking_total_tax'				=> 0,
				'booking_tax_dtls_arr'			=> 0,
				'booking_grnd_total'			=> 0,
				'booking_prepayment_amount'		=> 0,
				'booking_prepayment_details'	=> '',
				'booking_comment'				=> '',
				'payment_status'				=> '1',
				'added_by'						=> 3,
				'booking_from'					=> 1,
				'data_added'					=> date('Y-m-d H:i:s'),
				'booking_is_deleted'			=> '0'
		);
		$this->db->insert('app_booking',$bookingData);
		$bookingId = $this->db->insert_id();
		$startTime	= $this->global_mod->gmtTimeReturn($inputArr['bookingTime']);
		$endTime	= date('Y-m-d H:i:s', strtotime('+'.$srvArr[0]['service_duration_min'].' minute ', strtotime($startTime)));;
		$bookingServiceData = array(
				'srvDtls_booking_id'			=> $bookingId,
				'srvDtls_service_id'			=> $srvArr[0]['service_id'],
				'srvDtls_service_name'			=> $srvArr[0]['service_name'],
				'srvDtls_service_cost'			=> $srvArr[0]['service_cost'],
				'srvDtls_service_duration' 		=> $srvArr[0]['service_duration_min'],
				'srvDtls_service_duration_unit'	=> $srvArr[0]['service_duration_unit'],
				'srvDtls_service_start'			=> $startTime,
				'srvDtls_service_end'			=> $endTime,
				'srvDtls_employee_id'			=> $empArr[0]['employee_id'],
				'srvDtls_employee_name'			=> $empArr[0]['employee_name'],
				'srvDtls_booking_status'		=> 2,
				'srvDtls_status_date'			=> date('Y-m-d H:i:s'),
				'srvDtls_service_quantity'		=> $inputArr['serviceQuantity'],
				'srvDtls_rescheduled_child_id'	=> 0,
				'srvDtls_service_description'	=> 'Booked from administator.'
		);
		
		//$bookingServiceData = $this->global_mod->db_parse($bookingServiceData);
		$this->db->insert('app_booking_service_details',$bookingServiceData);
		$bookingDetailsId = $this->db->insert_id();
		if($bookingDetailsId =='' || $bookingDetailsId == 0){
			return 0;
		}else{
			if($inputArr['sendMailClient'] == 'true'){
				
				$local_admin_id = $this->session->userdata('local_admin_id');
				$Appo_Info = $this->AppoDetails($bookingDetailsId);
				
				$unit = $Appo_Info['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
				$start_time = $this->global_mod->localTimeReturn($Appo_Info['srvDtls_service_start']);
            	$end_time 	= $this->global_mod->localTimeReturn($Appo_Info['srvDtls_service_end']);
				$AppointmentInfo = 'Service Name : '.$Appo_Info['srvDtls_service_name'].'<br />'.'Staff name : '.$Appo_Info['srvDtls_employee_name'].'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$Appo_Info['srvDtls_service_duration'].' '.$unit;


				$busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');

				$this->load->model('admin/Cms_model');
				$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
				$cancelpolicy = $this->global_mod->show_to_control($cancellationpolicy);
				
				$site_url = base_url();
				
				//$fname = $this->GetCusInfo($bookingDetailsId,2);
				//$lname = $this->GetCusInfo($bookingDetailsId,3);
				$name = $this->getCustomerByservicedetailsId($bookingDetailsId);
				$fname = $name[0]['cus_fname'];
				$lname = $name[0]['cus_lname'];
				
				$replacerArr = array(
							'{businessname}'			=> $this->session->userdata('ad_name'),
							'{fname}' 					=> $fname,
							'{lname}' 					=> $lname,
							'{appointmentdate}'			=> $start_time,
							'{AppointmentInfo}' 		=> $AppointmentInfo,
							'{businessemail}' 			=> $this->session->userdata('local_admin_email'),
							'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
							'{businessaddress}' 		=> $busi_address,
							'{cancellationpolicy}' 		=> nl2br($cancelpolicy),
							'{cancelAppLink}' 			=> $site_url
							
				);

			$toArr	 = $this->GetCustomermail($bookingId);
			$from  = $this->session->userdata('local_admin_email');
						
			$this->email_model->sentMail(1,$replacerArr,$toArr,$from);                     
			}
			
			return 1;
		}
	}
	public function adminRelation($inputArr){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$sql = "SELECT 
                    * 
                FROM 
                    app_customer_admin_relationship 
                WHERE 
                    local_admin_id = '".$local_admin_id."'
					AND
					customer_id = '".$inputArr['customerId']."'";
        $query = $this->db->query($sql);
        $resultArr = $query->result_array();
		if(COUNT($resultArr)==0){
			$relationshipData = array(
				'local_admin_id'	=> $local_admin_id,
				'customer_id'		=> $inputArr['customerId']
			 );
			$this->db->insert('app_customer_admin_relationship',$relationshipData);	
		}
	}
	public function employeeWiseBlocking($employeeId,$bookingDateTime){
		$sql = "SELECT 
                    * 
                FROM 
                    app_staff_unavailable 
                WHERE 
                    employee_id = '".$employeeId."'
					AND
					DATE_FORMAT(block_date,'%Y-%m-%d') = '".date("Y-m-d",strtotime($bookingDateTime))."'";
        $query = $this->db->query($sql);
        $resultArr = $query->result_array();
		if(COUNT($resultArr)==0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function singleBookingDetails($srvDtls_id){
		$string =' AND srvDtls_id ='.$srvDtls_id;
		$resultArr = $this->global_mod->mainBookingStorePro($string);
		return $resultArr;
	}
	public function appStatusList(){
		$sql = "SELECT 
                    value.code_value_id AS statusId , 
					value.value AS statusValue
                FROM 
                    app_code_value AS value,
					app_code_code AS code 
                WHERE 
                    code.code_code_id = 1
					AND
					value.is_active = 'Y'
					AND
					code.is_active = 'Y'
					AND
					code.code_code_id = value.code_code_id";
        $query = $this->db->query($sql);
        $resultArr = $query->result_array();
		return $resultArr;
	}
	public function serviceDetailsFromBooking($bookingServiceId){
		$string =' AND  srvDtls_id ='.$bookingServiceId;
		$bookingDetails	= $this->mainBookingStorePro($string);
		$serviceDetails = $this->serviceDetails($bookingDetails[0]['srvDtls_service_id']);
		return $serviceDetails;
	}
	public function getAvailableStaffOnService($bookingServiceId){
		$string =' AND srvDtls_id ='.$bookingServiceId;
		$bookingDetails	= $this->mainBookingStorePro($string);
		
		$start	= ' AND service_id ='.$bookingDetails[0]['srvDtls_service_id'];
		$end	= ' DISTINCT employee_id ';
		$staffIdArr = $this->global_mod->mainBizSchedule($start,$end);
		$empArr = array();
		$activeEmp = $this->getActiveStaff($staffIdArr);
		foreach($activeEmp AS $arrKey=>$arrVal){
			$empArr[$arrKey] =  $this->employeeDetails($arrVal['employee_id']);
		}
		return $empArr;
	}
	public function availableTimeSlotGenerate($employeeId,$serviceId,$bookingDate,$timeDiff){
		$start	= ' AND service_id ='.$serviceId;
		$start	.= ' AND employee_id ='.$employeeId;
		$start	.= ' AND day_id ='.date('N', strtotime($bookingDate));
		$end	= ' time_from,time_to ';
		$bizArr = $this->global_mod->mainBizSchedule($start,$end);

		if(count($bizArr) > 0){
            $val = '<select id="choosen_booking_time">';
			$val .= '<option value="">Select</option>';
			foreach($bizArr as $bizVal){
            $start_time	= strtotime($bizVal['time_from'])*1;
            $end_time	= strtotime($bizVal['time_to'])*1;
                for ($j = $start_time; $j <= $end_time; $j+=($timeDiff*60)){
					$currentTime = date("Ymd", strtotime($bookingDate)).date("His",$j);
					if(date("YmdHis")<$currentTime){
						$val .= '<option value="'.date("H:i:s",$j).'">'.date("h:i a",$j).'</option>';
					}
                }
			}
            $val .= '</select>';
        }else{
            $val = '<lebel style="color:red">There is no slot.</lebel>';
        }
        return $val;
	}
	public function customerDetails($bookingServiceId){
		
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql = 'SELECT 
     				cus.cus_fname,
     				cus.cus_lname,
     				user.user_email,
     				cus.cus_mob,
     				city.city_name,
     				region.region_name,
     				country.country_name,
     				cus.cus_address,
     				rel.customer_info
			   FROM
     				app_customer_search cus
			   LEFT JOIN
     				app_cities city
			   ON
     				city.city_id=cus.cus_cityid
			   LEFT JOIN
     				app_regions region
			   ON
    				region.region_id=cus.cus_regionid
			   LEFT JOIN
    				app_countries country
			   ON
    				cus.cus_countryid=country.country_id
			   LEFT JOIN
    				app_password_manager user
			   ON
    				user.user_id=cus.cus_id
			   LEFT JOIN
               		app_customer_admin_relationship rel
               ON
                  	rel.customer_id=cus.cus_id
			   WHERE
                    rel.local_admin_id='.$local_admin_id.'
               AND
     				cus.cus_id=(SELECT 
     								bk.customer_id 
     							FROM 
     								app_booking bk 
     							JOIN 
     								app_booking_service_details srvdtls 
     							ON 
     								srvdtls.srvDtls_booking_id=bk.booking_id 
     							WHERE srvdtls.srvDtls_id="'.$bookingServiceId.'")';
		   
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
       return $Arr;
	}
	public function saveComment($serviceDatailsId,$comment){
		$updateData = array(
					'srvDtls_service_description'	=> $comment
					 );
		$updateData = $this->global_mod->db_parse($updateData);			 
		$this->db->where('srvDtls_id', $serviceDatailsId);
		$this->db->update('app_booking_service_details', $updateData); 
	}
	public function bookingIdWiseBookingDetails($bookingId){
		$string		= ' AND booking_id='.$bookingId;
		$returnArr	=	$this->global_mod->mainBookingStoreProReport($string);
		return $returnArr;
	}
	/*public function bookingIdDetails($bookingId){
		$sql = "SELECT 
                    * 
                FROM 
                    app_booking 
                WHERE 
                    booking_id = ".$bookingId;
        $query = $this->db->query($sql);
        $resultArr = $query->result_array();
		return $resultArr;
	}*/
	
	public function bookingIdDetails($bookingId){
		$sql = 'SELECT  
 					bk.*,
 					cash.* 
				FROM 
 					app_booking AS bk 
				left join
 					app_cash_register AS cash 
				ON
 					bk.booking_id = cash.cash_booking_id 
				where
					bk.booking_id="'.$bookingId.'"';
					
		$query = $this->db->query($sql);
        $resultArr = $query->result_array();
		return $resultArr;			
	}	
	
	public function currencyFormat($money){
        $local_admin_id		= $this->session->userdata('local_admin_id');
		$this->db->select('currency_format_id');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $currencyFormatArr = $query->result_array();
        $currencyFormat = $currencyFormatArr[0]['currency_format_id'];
        
        $money = number_format($money, 2);
        $moneyArr = explode(".",$money);
        
        $integer_money = $moneyArr[0];
        $float_money = $moneyArr[1];
        
        if($currencyFormat == 1){//XX,XXX.XX
            $returnCurrency = $integer_money.".".$float_money;
        }else{//XX.XXX,XX
            $returnCurrency = $float_money.".".$integer_money;
        }
        return $returnCurrency;
    }
	public function saveCommentAgenda($serviceDatailsId,$comment){
		$updateData = array(
		    'booking_comment'	=> $comment
		);
		$updateData = $this->global_mod->db_parse($updateData);
		$this->db->where('booking_id', $serviceDatailsId);
		$this->db->update('app_booking', $updateData); 
	}
	public function agendaCancelAppointment($bookingId){
		$updateData = array(
					'srvDtls_booking_status'	=> 4
					 );
		$this->db->where('srvDtls_booking_id', $bookingId);
		$this->db->update('app_booking_service_details', $updateData); 
	}
	public function agendaStatusfunction($bookId,$typeId){
		$updateData = array(
					'srvDtls_booking_status'	=> $typeId
					 );
		$this->db->where('srvDtls_booking_id', $bookId);
		$this->db->update('app_booking_service_details', $updateData); 
	}
	public function getServiceId($bookingId){
            $this->db->select('srvDtls_id');
            $this->db->from('app_booking_service_details');
            $this->db->where('srvDtls_booking_id', $bookingId); 
            $query = $this->db->get();
            $serviceIdArr = $query->result_array();
            $serviceId = $serviceIdArr[0]['srvDtls_id'];
            return $serviceId;
        }
	public function getBusinessDetails(){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('app_local_admin.business_name, app_local_admin.business_location, app_local_admin.business_description, app_local_admin.business_phone, app_password_manager.user_email, app_local_admin_gen_setting.bkin_can_setin, app_local_admin_gen_setting.bkin_can_mx_tim');
            $this->db->from('app_local_admin');
            $this->db->join('app_password_manager', 'app_password_manager.user_id = app_local_admin.local_admin_id');
            $this->db->join('app_local_admin_gen_setting', 'app_local_admin_gen_setting.local_admin_id = app_local_admin.local_admin_id');
            $this->db->where('app_local_admin.local_admin_id', $local_admin_id); 
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
        }
	public function getLocalAdminDetails(){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('first_name,last_name');
            $this->db->from('app_local_admin');
            $this->db->where('local_admin_id',$local_admin_id);
            $query = $this->db->get();		
            $retArr = $query->result_array();  
            return $retArr;
        }
	public function getCancellationPolicy(){
            $local_admin_id = $this->session->userdata('local_admin_id');
        /*    $this->db->select('cancellation_policy,additional_info');
            $this->db->from('app_appoint_cancellation_policy');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();*/
            
            $this->db->select('cms_dec');
            $this->db->from('app_cms');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
        }
	public function getMaxCancellationTime(){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('bkin_can_mx_tim,bkin_can_setin');
            $this->db->from('app_local_admin_gen_setting');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
        }
	public function getWorkingTime(){
		$result	= $this->global_mod->mainBizSchedule();
        //$result	= $this->global_mod->mainBizSchedule_sr();
		return $result;
	}
	public function checkWorkingTime($val,$currentDate,$currentTime,$chkWorkableTime){
		$localArray= array();
		$counter=0;
		foreach($chkWorkableTime AS $workTime){
            //$bookEndTime	= date('H:i:s', strtotime('+'.$workTime['service_duration_min'].' minutes', strtotime($currentTime)));
			if(	
				$workTime['employee_id'] == $val 
				&& 
				$workTime['day_id'] == date ("N", strtotime($currentDate))
				&&
				strtotime($workTime['time_from']) <= strtotime($currentTime)
				&&
				strtotime($workTime['time_to']) >= strtotime($currentTime)
			  ){
				$localArray[$counter]=$workTime;
				$counter++;
			}	
		}
		return $localArray;
	}
	public function dayInterval(){
		$localAdmin		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
                    day_interval
                FROM 
                    app_local_admin_gen_setting 
                WHERE 
                    local_admin_id = '".$localAdmin."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['day_interval'];
    
	}
	public function dayCellWith(){
		$localAdmin		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
                    day_cellwith
                FROM 
                    app_local_admin_gen_setting 
                WHERE 
                    local_admin_id = '".$localAdmin."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['day_cellwith'];
    
	}
	public function updateCalenderDetails($updateArr){
		$localAdmin		= $this->session->userdata('local_admin_id');
		
		 $sql = "UPDATE 
		 			`app_local_admin_gen_setting` 
		 		SET 
		 			`day_interval` = '".$updateArr['day_interval']."', 
		 			`day_cellwith` = '".$updateArr['day_cellwith']."' 
		 		WHERE 
		 			`local_admin_id` = '".$localAdmin."'";
       $this->db->query($sql);		
	}
	
	public function getOldAppdetails($srvDtls_id){
			
			$this->db->select('srvDtls_rescheduled_child_id');
            $this->db->from('app_booking_service_details');
            $this->db->where('srvDtls_id', $srvDtls_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            
            $this->db->select('*');
            $this->db->from('app_booking_service_details');
            $this->db->where('srvDtls_id', $Arr[0]['srvDtls_rescheduled_child_id']);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
            
		
		
	}
	
	public function getBusiEmail($user_id){
				
       
       			$this->db->select('user_email');
		        $this->db->from('app_password_manager');
		        $this->db->where('user_id',$user_id);
		        $query = $this->db->get();
		        $busi_email = $query->result_array();
	}
	
	public function GetUserEmail($bookingId){
				$sql = 'select 
							e.user_email 
						from 
							app_password_manager e 
						join 
							app_booking b 
						on 
							e.user_id=b.customer_id 
						where 
							b.booking_id="'.$bookingId.'"';
				
				$query = $this->db->query($sql);
        		$return = $query->result_array();
        		return $return[0]['user_email'];		
		
	}
	
	public function AppoDetails($booking_id){
				$this->db->select('*');
	            $this->db->from('app_booking_service_details');
	            $this->db->where('srvDtls_id', $booking_id);
	            $query = $this->db->get();
	            $Arr = $query->result_array();
	            return $Arr[0];
	}
	
	public function GetCusInfo($booking_id,$val,$call_from=''){
				$local_admin_id = $this->session->userdata('local_admin_id');
				
				if($call_from == "agenda_cancel"){
					$sql = "select value from app_local_customer_details where sign_upinfo_item_id='".$val."' and customer_id=(select customer_id from app_booking where local_admin_id='".$local_admin_id."' and booking_id='".$booking_id."')";
				$query = $this->db->query($sql);
        		$return = $query->result_array();
        		
				}else{
					$sql = "select value from app_local_customer_details where sign_upinfo_item_id='".$val."' and customer_id=(select customer_id from app_booking where local_admin_id='".$local_admin_id."' and booking_id=(SELECT srvDtls_booking_id FROM app_booking_service_details WHERE srvDtls_id='".$booking_id."'))";
				$query = $this->db->query($sql);
        		$return = $query->result_array();
        		
				}
				
	            return $return[0]['value'];
	}
	
	public function GetCustomermail($bookingId){
				$local_admin_id = $this->session->userdata('local_admin_id');
				$sql = "select user_email from app_password_manager where user_id=(select customer_id from app_booking where booking_id='".$bookingId."' and local_admin_id='".$local_admin_id."')";
				$query = $this->db->query($sql);
        		$return = $query->result_array();
        		return $return[0]['user_email'];
	}
	
	public function SavePayentAgendaDetails($data){
		
		$Array = array(
					'cash_booking_id'			=> $data['bookingId'],
					'cash_payment_mode'			=> $data['payment_mode'],
					'cash_total_amount'			=> $data['booking_sub_total'],
					'cash_additional_charges'	=> $data['booking_total_tax'],
					'cash_discount'				=> $data['booking_disc_amount'],
					'cash_paid_total'			=> $data['Paid_total'],
					'cash_payment_notes'		=> $data['payment_comment']
				);
		//$Array = $this->global_mod->db_parse($Array);
		$this->db->insert('app_cash_register', $Array); 			
	}
	
	public function ShowPaidDetails($cash_register_id){
	
        $sql = 'SELECT  
 					bk.booking_tax_dtls_arr,
 					bk.booking_sub_total,
 					bk.booking_id,
 					cash.* 
				FROM 
 					app_cash_register AS cash 
				left join
 					app_booking AS bk
				ON
 					bk.booking_id = cash.cash_booking_id 
				where
					bk.booking_id=(SELECT cash_booking_id FROM app_cash_register WHERE cash_register_id="'.$cash_register_id.'" )';
					
		$query = $this->db->query($sql);
        $resultArr = $query->result_array();
		return $resultArr[0];	
        
	}
	
	public function UpdatePaidDetailsModel($id,$data){
		$data = $this->global_mod->db_parse($data);
		$this->db->where('cash_register_id', $id);
		$this->db->update('app_cash_register', $data); 
	}
	
	public function DeleteCashRegisterRow($register_id){
		$this->db->where('cash_register_id', $register_id);
		$this->db->delete('app_cash_register'); 
		return 1;
	}
	
	public function GetPrepaymentSetting(){
		$LocaladminId = $this->session->userdata('local_admin_id');
		$this->db->select('pre_pmnt_setting');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id',$LocaladminId);
        $query = $this->db->get();
        $setting = $query->result_array();
        return $setting;
	}
	
	public function IsTimeExist($employeeId,$bookingDateTime)
	{
		$LocaladminId = $this->session->userdata('local_admin_id');
		$gmt_value = $this->session->userdata('gmt_value');
		$gmt_symbol = $this->session->userdata('gmt_symbol');
		
		$gmt_valuearr = explode(':',$gmt_value);
		$total_time_sec = ($gmt_valuearr[0]*3600)+($gmt_valuearr[1]*60)+$gmt_valuearr[2];
		
		if($gmt_symbol == 0)
		{
			$sign = '+';
		}
		else
		{
			$sign = '-';
		}
		
		$objtimestamp = strtotime($bookingDateTime.' '.$sign.' '.$total_time_sec.' second');
		$chkedtime = date('Y-m-d H:i:s', $objtimestamp);
		
		$time = date('Y-m-d H:i:s', strtotime($bookingDateTime));
		$sql = "SELECT
				srvDtls_id,
				srvDtls_service_duration,
				srvDtls_service_duration_unit,
				srvDtls_service_start,
				srvDtls_service_end
			
			FROM
				app_booking_service_details
			WHERE
				srvDtls_employee_id='".$employeeId."'
			AND
				srvDtls_booking_status NOT IN(4,5,16)
			AND 
				srvDtls_service_start<='".$chkedtime."' ORDER BY srvDtls_service_start DESC LIMIT 1";
		
		$query = $this->db->query($sql);
		$resultArr = $query->result_array();
		
		if(isset($resultArr[0]['srvDtls_service_end']))
		{
			if(strtotime($chkedtime)<strtotime($resultArr[0]['srvDtls_service_end']))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function GetAppointments(){
        $search = '';
        $sr = 0;
        $returnArr = array();
        $ResultArray=array();
        $date_from = date("Y-m-d",strtotime($this->input->post('from_date')));
        $date_to = date("Y-m-d",strtotime($this->input->post('to_date')));

        $select ='';
        $search .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$date_from.'" AS date) AND CAST("'.$date_to.'" AS date)  ';
        $search .= ' ORDER BY DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") ASC';
        $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search);
        
        return $this->_resultArr;
        
    
    }
    
    public function userEmailAddress($serviceId){
		$sql = 'SELECT
      				user.user_email
				from
      				app_password_manager user
				JOIN
      				app_booking book
				ON
      				user.user_id=book.customer_id
				JOIN
     				app_booking_service_details service
				ON
     				service.srvDtls_booking_id=book.booking_id
				WHERE
     				service.srvDtls_id="'.$serviceId.'";';
     				
     	$query = $this->db->query($sql);
        $address = $query->result_array();	
        return $address[0]['user_email'];			
	}
	
	//################################################################
	//#################### PARDCO FUNCTIONS BEGIN ####################
	//################################################################
	
	
	 
	public function booking_always_allowed($local_admin_id)
	{
		$sql=	'SELECT admin_always_allowed 
				FROM app_local_admin_gen_setting 
				WHERE local_admin_id = '.$local_admin_id.';';
		
		$query = $this->db->query($sql);
		$allowed = $query->result_array();	
        return $allowed[0]['admin_always_allowed'];
	}
	
	/*
	 * Turns $booking_array[$b]['booking_status'] into wanted booking style text for color coding in admin calendar, 
	 * Implementation changed to php file in order to allow taking colors from database.
	 * jere
	 */
	public function calendar_booking_status_style($book_status) 
	{
		if ($this -> calender_colors === FALSE)
		{
			$local_admin_id = $this->session->userdata('local_admin_id');
			$ResultArr=array();
			$this->db->select('*');
			$this->db->from('app_custom_calender_colors');
			$this->db->where('local_admin_id', $local_admin_id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$ResultArr['approved_color']	= $row->approved_color;
				$ResultArr['pending_color']		= $row->pending_color;
				$ResultArr['scheduled_color']	= $row->scheduled_color;
				$ResultArr['late_color']		= $row->late_color;
				$ResultArr['noshow_color']		= $row->noshow_color;
				$ResultArr['unknown_color']		= $row->unknown_color;
				//Gradient Lower
				$ResultArr['approved_color_L']	= $row->approved_color_L;
				$ResultArr['pending_color_L']	= $row->pending_color_L;
				$ResultArr['scheduled_color_L']	= $row->scheduled_color_L;
				$ResultArr['late_color_L']		= $row->late_color_L;
				$ResultArr['noshow_color_L']	= $row->noshow_color_L;
				$ResultArr['unknown_color_L']	= $row->unknown_color_L;
			}
			else
			{
				$ResultArr['approved_color']	= 'AB47ED';
				$ResultArr['pending_color']		= '0099FF';
				$ResultArr['scheduled_color']	= 'FF66FF';
				$ResultArr['late_color']		= '966C43';
				$ResultArr['noshow_color']		= 'FFFF99';
				$ResultArr['unknown_color']		= '19FF19';
				//Gradient Lower
				$ResultArr['approved_color_L']	= 'B65EEF';
				$ResultArr['pending_color_L']	= '66C2FF';
				$ResultArr['scheduled_color_L']	= 'FF9FFF';
				$ResultArr['late_color_L']		= 'AD855C';
				$ResultArr['noshow_color_L']	= 'FFFFAD';
				$ResultArr['unknown_color_L']	= '8CFF8C';
			}
			
			$this -> calender_colors = $ResultArr;
		}
		$ResultArr = $this -> calender_colors;
		
		$booking_style='';
		
		switch($book_status)
		{
			case '1': //Approved
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['approved_color_L'] . ' 10%, #' . $ResultArr['approved_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['approved_color_L'] . ' 10%, #' . $ResultArr['approved_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['approved_color_L'] . ' 10%, #' . $ResultArr['approved_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['approved_color_L'] . ' 10%, #' . $ResultArr['approved_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['approved_color_L'] . ' 10%, #' . $ResultArr['approved_color'] . ' 55%) !important;';
				break;
		
			case '2': //pending
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['pending_color_L'] . ' 10%, #' . $ResultArr['pending_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['pending_color_L'] . ' 10%, #' . $ResultArr['pending_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['pending_color_L'] . ' 10%, #' . $ResultArr['pending_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['pending_color_L'] . ' 10%, #' . $ResultArr['pending_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['pending_color_L'] . ' 10%, #' . $ResultArr['pending_color'] . ' 55%) !important;';
				break;
			
			case '7': //scheduled
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['scheduled_color_L'] . ' 10%, #' . $ResultArr['scheduled_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['scheduled_color_L'] . ' 10%, #' . $ResultArr['scheduled_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['scheduled_color_L'] . ' 10%, #' . $ResultArr['scheduled_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['scheduled_color_L'] . ' 10%, #' . $ResultArr['scheduled_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['scheduled_color_L'] . ' 10%, #' . $ResultArr['scheduled_color'] . ' 55%) !important;';
				break;
			
			case '8': //late
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['late_color_L'] . ' 10%, #' . $ResultArr['late_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['late_color_L'] . ' 10%, #' . $ResultArr['late_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['late_color_L'] . ' 10%, #' . $ResultArr['late_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['late_color_L'] . ' 10%, #' . $ResultArr['late_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['late_color_L'] . ' 10%, #' . $ResultArr['late_color'] . ' 55%) !important;';
				break;
			
			case '9': //noshow
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['noshow_color_L'] . ' 10%, #' . $ResultArr['noshow_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['noshow_color_L'] . ' 10%, #' . $ResultArr['noshow_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['noshow_color_L'] . ' 10%, #' . $ResultArr['noshow_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['noshow_color_L'] . ' 10%, #' . $ResultArr['noshow_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['noshow_color_L'] . ' 10%, #' . $ResultArr['noshow_color'] . ' 55%) !important;';
				break;
			
			default: //unknown
				$booking_style =   'background-image: linear-gradient(bottom, #' . $ResultArr['unknown_color_L'] . ' 10%, #' . $ResultArr['unknown_color'] . ' 55%) !important;
									background-image: -o-linear-gradient(bottom, #' . $ResultArr['unknown_color_L'] . ' 10%, #' . $ResultArr['unknown_color'] . ' 55%) !important;
									background-image: -moz-linear-gradient(bottom, #' . $ResultArr['unknown_color_L'] . ' 10%, #' . $ResultArr['unknown_color'] . ' 55%) !important;
									background-image: -webkit-linear-gradient(bottom, #' . $ResultArr['unknown_color_L'] . ' 10%, #' . $ResultArr['unknown_color'] . ' 55%) !important;
									background-image: -ms-linear-gradient(bottom, #' . $ResultArr['unknown_color_L'] . ' 10%, #' . $ResultArr['unknown_color'] . ' 55%) !important;';
				break;
		}
		
		return $booking_style;
	}
	
	public function customerNameFromSearch($cusId){
		$sql = "SELECT
		    		cus_fname,cus_lname
		    	FROM
		    	    app_customer_search
		    	WHERE
		    	    cus_id='".$cusId."'";
		
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
        $str = '';
        if(isset($Arr[0]['cus_fname'])){
			$str .= $Arr[0]['cus_fname'].' ';
		}
		if(isset($Arr[0]['cus_lname'])){
			$str .= $Arr[0]['cus_lname'];
		}
		return $str;
	}
	
	public function getCustomerBybookingId($bookingId){
		$sql = 'SELECT 
      				cus.cus_fname,
     	 			cus.cus_lname
				FROM
     				app_customer_search cus
				JOIN
				     app_booking book
				ON
				     book.customer_id=cus.cus_id
				WHERE
				     book.booking_id="'.$bookingId.'"';
				     
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
	}
	
	public function getCustomerByservicedetailsId($srvDtls_id){
		$sql = 'SELECT 
      				cus.cus_fname,
      				cus.cus_lname
				FROM 
      				app_customer_search cus
				JOIN
				     app_booking book
				ON
				    book.customer_id=cus.cus_id
				JOIN
				   app_booking_service_details srv
				ON
				   srv.srvDtls_booking_id=book.booking_id
				WHERE
				   srv.srvDtls_id="'.$srvDtls_id.'"';
				   
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;		   
	}
	
	public function getShownFields()
	{
		$local_admin_id = $this -> session -> userdata('local_admin_id');
		$fields = array();
		$sql = 'SELECT sign_upinfo_item_id
			FROM `app_local_admin_gen_setting_admin_user_info`
			WHERE `local_admin_id` = ?';
		$result = $this -> db -> query($sql, array($local_admin_id));
		foreach ($result -> result_array() as $row)
		{
			$fields[] = $row['sign_upinfo_item_id'];
		}
		$force_visible = array('1', '2', '3', '9');
		return array_merge($fields, $force_visible);
	}
	
	function get_show_booked_by($local_admin_id)
	{
		$sql = 'SELECT `admin_show_who` FROM `app_local_admin_gen_setting`
			WHERE `local_admin_id` = ?';
		$query = $this->db->query($sql, array($local_admin_id));
		$result = $query -> result_array();
		return (bool)($result[0]['admin_show_who']);
	}
	
	public function appoIspossible($employeeId,$bookingDateTime){
		
		$date = new DateTime($bookingDateTime);
		$bookingDate = $date->format('Y-m-d');
		
		$LocaladminId = $this->session->userdata('local_admin_id');
		$time_difference = $this->session->userdata('gmt_value');
		$gmt_symbol = $this->session->userdata('gmt_symbol');
		
		$time_difference = explode(':',$time_difference);
		
		$total_time_sec = ($time_difference[0]*3600)+($time_difference[1]*60)+$time_difference[2];
		
	    if($gmt_symbol == 0){
			$sign = '+';
		}else{
			$sign = '-';
		}
		$newtimestamp = strtotime($bookingDateTime.' '.$sign.' '.$total_time_sec.' second');
		$chkTime = date('Y-m-d H:i:s', $newtimestamp);
		$dayNum = date('N', strtotime($bookingDate));
		
		
		$sql = 'SELECT DISTINCT
		             details.srvDtls_service_start,
		             details.srvDtls_service_duration,
		             details.srvDtls_service_duration_unit
		        FROM
		            app_booking book
		        JOIN
		        	app_booking_service_details details
		        ON
		           book.booking_id = details.srvDtls_booking_id	    
		        WHERE
		        	book.local_admin_id="'.$LocaladminId.'"
		        AND
		            details.srvDtls_employee_id="'.$employeeId.'"
		        AND
		           details.srvDtls_service_start>=CAST("'.$chkTime.'" AS datetime)              
		        AND
		           DATE_FORMAT(details.srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$chkTime.'" AS date) AND CAST("'.$chkTime.'" AS date) 
		        AND
		           details.srvDtls_booking_status NOT IN(4,5)
		        ORDER BY
		           details.srvDtls_service_start ASC LIMIT 1;
		           ;
		               
		       ';    //CAST("'.$chkdateTime.'" AS datetime)
		$query = $this->db->query($sql);
        $Arr = $query->result_array();   
        
       
        
       if(isset($Arr) && count($Arr) >0){
        	
        	$startTime = new DateTime($Arr[0]['srvDtls_service_start']);
			$nextAppotime = $startTime->format('H:i:s');
			
			$objtimestamp = strtotime($bookingDateTime.' '.$sign.' '.$total_time_sec.' second');
			$clickedTime = date('H:i:s', $objtimestamp);
			
			
			$date_a = new DateTime($nextAppotime);
			$date_b = new DateTime($clickedTime);

			$interval = date_diff($date_a,$date_b);

			$diff = $interval->format('%h:%i:%s');
			

			
			$diffInminExpld = explode(':',$diff);
		
			$diffInmin = ($diffInminExpld[0]*60)+$diffInminExpld[1];
			
			$sql = 'SELECT DISTINCT
						service.service_id
					FROM
					    app_service service
					JOIN
					    app_biz_hours biz
					ON
						service.service_id=biz.service_id
					WHERE
					    biz.local_admin_id="'.$LocaladminId.'"
					AND
						biz.employee_id="'.$employeeId.'"
					AND
						service.service_duration_min<='.$diffInmin.'	
					AND
					 	biz.day_id="'.$dayNum.'"
					AND
					   service.is_active="Y"
					AND
					   service.is_hide="N"    		
					   
					';
			
			
			$query = $this->db->query($sql);
        	$Arr = $query->result_array(); 
        	
        	
        	if(count($Arr) > 0){
				return $Arr;
			}else{
				return 0;
			}
			
		}else{
			$string = '';
			$string .= ' AND employee_id='.$employeeId;
			$string .= ' AND day_id='.$dayNum;
			$string .= ' ORDER BY time_to ASC LIMIT 1';
			
			$result	= $this->global_mod->mainBizSchedule($string);
			
			$lastTime = $result[0]['time_to'];
			$lastChkTime = explode(' ',$bookingDateTime);
			
			///echo $lastTime."<br>";
			//echo $lastChkTime;
			//exit;
			
			$time1 = strtotime($lastChkTime[1]);
			$time2 = strtotime($lastTime);
			$enddiff = $time2 - $time1;
			$enddiff = date('H:i:s', $enddiff);
			
			$enddiffArr = explode(':',$enddiff);
			$endtimeDiff = $enddiffArr[0]*60+$enddiffArr[1];
			
			$objtimestamp = strtotime($bookingDateTime.' '.$sign.' '.$total_time_sec.' second');
			$clickedTime = date('H:i:s', $objtimestamp);
			
			$sql = 'SELECT DISTINCT
						service.service_id
					FROM
					    app_service service
					JOIN
					    app_biz_hours biz
					ON
						service.service_id=biz.service_id
					WHERE
					    biz.local_admin_id="'.$LocaladminId.'"
					AND
						biz.employee_id="'.$employeeId.'"
						
					AND
					 	biz.day_id="'.$dayNum.'"
					AND
					   service.is_active="Y"
					AND
					   service.is_hide="N" 
					AND
                       biz.time_to>"'.$clickedTime.'"
                    AND
                       service.service_duration_min<="'.$endtimeDiff.'" 
					   
					';
			
			$query = $this->db->query($sql);
        	$Arrr = $query->result_array(); 
        	
        	if(count($Arrr) > 0){
				return $Arrr;
				
			}else{
				return 0;
			}
		}
		
	}
	
	public function getServiceBytimespan($serviceIds){
		
		$str	= '';
		foreach($serviceIds as $service){
			$serviceDetails	= $this->global_mod->serviceDetails($service['service_id']);
			
			$bookEndTime	= date('H:i:s', strtotime('+'.$serviceDetails[0]['service_duration_min'].' minutes', strtotime($bookingDateTime)));
			$str .= '<option value="'.$serviceDetails[0]['service_id'].'">'.$serviceDetails[0]['service_name'].'</option>';
		
		}
		return $str;
	}
	
	public function getActiveStaff($empArr){
		$arr = '';
		foreach($empArr AS $val){
			$arr .= $val['employee_id'].',';
		}
		$arr = rtrim($arr, ',');
		
		$sql = 'SELECT
					  employee_id
				FROM
				      app_employee
				WHERE
				     employee_id IN('.$arr.')
				AND
					 is_active !="N"           
					';
		$query = $this->db->query($sql);
       	$Arrr = $query->result_array();	
       	return $Arrr;		
		
	}
}
