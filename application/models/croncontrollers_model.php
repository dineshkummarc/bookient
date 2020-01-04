<?php
class Croncontrollers_model extends CI_Model {
 
 
////Set one start 
function SmsEmailSendingRules(){
		$sql = "SELECT 	
						local_admin_id,
				 		sms_alart_to_admin,
				 		sms_alart_to_staff,
				 		send_sms_for,
				 		sms_thanks_aftrappo,
				 		sms_alrt_bfr_appo,
				 		sms_alert,
				 		email_alrt_bfr_appo,
				 		email_alert
				FROM
					 	app_local_admin_gen_setting
				WHERE 
			            enable_system = 1";
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
 }

public function findLocalAdmin(){
	$sql = "SELECT 	
					user_id,
					user_name,
					user_email
				FROM
					app_password_manager
				WHERE 
			        email_veri_status = 1
			        AND
			        user_status = 1
			        AND
			        user_type = 3";
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
}
  
public function findLocalAdminSettings($localAdminId){
		$sql = "SELECT 	
					sms_alert, 	
			 		sms_alrt_bfr_appo,  
			 		email_alert,
			 		email_alrt_bfr_appo
				FROM
					app_local_admin_gen_setting
				WHERE 
					local_admin_id	=".$localAdminId."
					AND
			        enable_system = 1";
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
}      

public function findLocalAdminBooking($localAdminId,$settingsMin,$cronIntval){
	$sMin = intval($settingsMin); 
	$eMin = intval($settingsMin)+intval($cronIntval); 
	$startTime	= gmdate("Y-m-d H:i:s", strtotime("+".$sMin." min"));
	$endTime	= gmdate('Y-m-d H:i:s', strtotime("+".$eMin." min"));
		        
			        
		$sql = "SELECT 
				     B.local_admin_id AS local_admin_id,
				     B.booking_id AS booking_id,
				     B.customer_id AS customer_id, 	
				     S.srvDtls_service_id AS service_id,  
			 		 S.srvDtls_service_name AS service_name,
			 		 S.srvDtls_service_start AS service_start,
			 		 S.srvDtls_service_end AS service_end,
			 		 S.srvDtls_service_quantity AS service_quantity,
			 		 S.srvDtls_employee_name AS employee_name
				FROM
     				 app_booking B
				JOIN
     				 app_booking_service_details S
				ON
    				 B.booking_id=S.srvDtls_booking_id
				WHERE
    				 B.local_admin_id='".$localAdminId."'
  				AND
    				 S.srvDtls_booking_status=2
				AND 
    				 S.srvDtls_service_start 
				BETWEEN 
    				 '".$startTime."'
				AND
    				 '".$endTime."'";     
			        
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
}

public function insertDataInCronTableSms($detailsArr){
	
	if(count($detailsArr)> 0){
	foreach($detailsArr AS $key=>$details){
		
	$sql = "SELECT 	
				cus_fname,
				cus_lname,
				cus_mob
			FROM
				app_customer_search
			WHERE 
				cus_id	=".$details['customer_id'];
	$query = $this->db->query($sql);
	$custArr = $query->result_array();
	
	

	$adminSql = "SELECT
					mobile_phone
				FROM
					app_local_admin
				WHERE 
					local_admin_id	=".$details['local_admin_id'];
	$query = $this->db->query($adminSql);
	$admintArr = $query->result_array();
			
	
	$messages ='You hava appointment with '.$details['employee_name'].' for '.$details['service_name'].' service on '.$details['service_start'];	
			
	$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'booking-'.$details['booking_id'],
					   'cron_local_admin_id'				=> $details['local_admin_id'],
					   'cron_customer_id'					=> $details['customer_id'],
					   'cron_customer_name'					=> $custArr[0]['cus_fname'].' '.$custArr[0]['cus_lname'],
					   'cron_alert_type'					=> 1,
					   'cron_subject'						=> '',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> $custArr[0]['cus_mob'],
					   'cron_customer_email'				=> '',
					   'cron_sender_mobile'					=> $admintArr[0]['mobile_phone'],
					   'cron_sender_email'					=> '',
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
		 $this->db->insert('app_cron_manager', $checkFieldstatus_arr); 
	}//end for each
	} 
 }

public function insertDataInCronTableEmail($detailsArr){

	if(count($detailsArr)>0){
		//print_r($detailsArr);		
	foreach($detailsArr AS $key=>$details){
		
	$sql = "SELECT 	
				cus_fname,
				cus_lname
			FROM
				app_customer_search
			WHERE 
				cus_id	=".$details['customer_id'];
	$query = $this->db->query($sql);
	$custArr = $query->result_array();
		
	$adminSql = "SELECT 	
					user_email
				FROM
					app_password_manager
				WHERE 
					user_id	=".$details['local_admin_id'];
	$query = $this->db->query($adminSql);	
	$admintArr = $query->result_array();
	
	$custSql = "SELECT 	
					user_email
				FROM
					app_password_manager
				WHERE 
					user_id	=".$details['customer_id'];
	$query = $this->db->query($custSql);	
	$custoArr = $query->result_array();
	
	
	$busisql = "SELECT
					 business_name
				FROM 
					app_local_admin
				WHERE
				    local_admin_id='".$details['local_admin_id']."'		 
			   ";
			   
	$qry = $this->db->query($busisql);	
	$businame = $qry->result_array();		   
	
	$messages = '<div style="margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;"> 
			
			<div style="padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;"> 
			<div style="text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding-left:10px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;">
			
			<div style="font-size: 1.4em; white-space: nowrap;"><strong>'.$businame[0]['business_name'].' - Appointment Reminder!</strong></div>
			<div style="margin: 1em 0px;"><strong>Hello </strong>'.$custArr[0]['cus_fname'].' '.$custArr[0]['cus_lname'].'<strong>,</strong></div>
			<div style="margin: 1em 0px;padding-left:45px;">You have appointment with '.$details['employee_name'].' for '.$details['service_name'].' service on '.$details['service_start'].'</div></div> 
			';
	
		
	$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'booking-'.$details['booking_id'],
					   'cron_local_admin_id'				=> $details['local_admin_id'],
					   'cron_customer_id'					=> $details['customer_id'],
					   'cron_customer_name'					=> $custArr[0]['cus_fname'].' '.$custArr[0]['cus_lname'],
					   'cron_alert_type'					=> 2,
					   'cron_subject'						=> 'Appointment reminder',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> '',
					   'cron_customer_email'				=> $custoArr[0]['user_email'],
					   'cron_sender_mobile'					=> '',
					   'cron_sender_email'					=> $admintArr[0]['user_email'],
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
			 $this->db->insert('app_cron_manager', $checkFieldstatus_arr);
	}//end for each	
	}
}

public function selectAllSmsData(){
	$sql = "SELECT 	
					*
			FROM
				app_cron_manager
			WHERE 
				cron_alert_type	= 1
				AND
				cron_messages_status= 1";
	$query = $this->db->query($sql);
	$custArr = $query->result_array();
	return $custArr;
} 
 
public function selectAllEmailData(){
	$sql = "SELECT 	
				*
			FROM
				app_cron_manager
			WHERE 
				cron_alert_type	= 2
				AND
				cron_messages_status= 1";
	$query = $this->db->query($sql);
	$custArr = $query->result_array();
	return $custArr;
}
//set one end

///set two start
function findAutoPromotionLocalAdminWise($localAdmin,$cronIntval){
	$Min 		= intval($cronIntval);
	$startTime	= gmdate("H:i:s");
	$endTime	= gmdate('H:i:s', strtotime("+".$Min." min"));  
	//$startTime	= '08:12:20';
	//$endTime	= '09:12:20';
	$sql = "SELECT 	
				*
			FROM
				app_auto_promotion
			WHERE
				auto_promo_status = '1'
				AND 
		        auto_local_admin_id = ".$localAdmin."
		        AND
		        auto_promo_time
		        BETWEEN 
    				 '".$startTime."'
				AND
    				 '".$endTime."' 
		    ORDER BY
		       auto_promo_priority ASC";
	$query = $this->db->query($sql);
	$Arr = $query->result_array();
	return $Arr;	
}

function findPromotion($dataArr){
		$sql = "SELECT 	
					*
				FROM
					app_coupon
				WHERE
					acitive = '1'
					AND 
			        coupon_id = ".$dataArr['auto_promo_linkid'];
		$query = $this->db->query($sql);
		$Arr = $query->result_array();

	$currentGMT	= gmdate("Y-m-d H:i:s");
	$messages	 = '';
	$messages	.= $Arr[0]['coupon_heading'].'\n';
	$messages	.= 'You have a discunt of $'.$Arr[0]['discount_amnt'].'\n';
	$messages	.= 'Please apply under the coupon code to get the offer \n\n\n';
	$messages	.= $Arr[0]['coupon_code'];
	$messages	.= '';
	//echo '<pre>';
	//print_r($Arr);
	///echo '</pre>';
	//echo $messages;
	//exit;
	if($dataArr['auto_promo_type']==1){
		
		$startTime	= gmdate("Y-m-d", strtotime("+1440 min"));
		$endTime	= gmdate("Y-m-d", strtotime("+2880 min"));
		$noDay		= intval(gmdate("N") +1);
		
		$bookingSql = "SELECT 	
							SUM(TIME_TO_SEC(dtl.srvDtls_service_duration)) AS totalsec
						FROM
							app_booking_service_details AS dtl,
							app_booking AS bk
						WHERE
							dtl.srvDtls_booking_id = bk.booking_id 
							AND 
							bk.local_admin_id  =".$dataArr['auto_local_admin_id']." 
							AND 
							CAST(dtl.srvDtls_rescheduled_child_id AS DATE) = 0 
					        AND
					        dtl.srvDtls_service_start
					        BETWEEN 
			    				 '".$startTime."'
							AND
			    				 '".$endTime."' ";
		$bookingQuery = $this->db->query($bookingSql);
		$bookingArr = $bookingQuery->result_array();

		$workingSql = "SELECT 	 
							SUM(TIME_TO_SEC(ADDTIME(CAST('00:00:01' as TIME),TIMEDIFF(time_to,time_from)))) totWorkHr
						FROM
							app_biz_hours
						WHERE
							day_id =".$noDay." 
							AND 
							local_admin_id  =".$dataArr['auto_local_admin_id'];
		$workingQuery = $this->db->query($workingSql);
		$workingQuery = $workingQuery->result_array();
		
		$remaningTime = ((intval($workingQuery[0]['totWorkHr']) - intval($bookingArr[0]['totalsec']))*100)/intval($workingQuery[0]['totWorkHr']);
		
	if($dataArr['auto_promo_priority'] <= $remaningTime){
	
		$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'autoPromotion',
					   'cron_local_admin_id'				=> $dataArr['auto_local_admin_id'],
					   'cron_customer_id'					=> 0,
					   'cron_customer_name'					=> '',
					   'cron_alert_type'					=> 3,
					   'cron_subject'						=> 'Auto Promotion',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> '',
					   'cron_customer_email'				=> '',
					   'cron_sender_mobile'					=> '',
					   'cron_sender_email'					=> '',
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
		 $this->db->insert('app_cron_manager', $checkFieldstatus_arr); 
	}	
	}
	if($dataArr['auto_promo_type']==2){
		
		$startTime	= gmdate("Y-m-d", strtotime("+2880 min"));
		$endTime	= gmdate("Y-m-d", strtotime("+4320 min"));
		$noDay		= intval(gmdate("N") +2);
		
		$bookingSql = "SELECT 	
							SUM(TIME_TO_SEC(dtl.srvDtls_service_duration)) AS totalsec
						FROM
							app_booking_service_details AS dtl,
							app_booking AS bk
						WHERE
							dtl.srvDtls_booking_id = bk.booking_id 
							AND 
							bk.local_admin_id  =".$dataArr['auto_local_admin_id']." 
							AND 
							CAST(dtl.srvDtls_rescheduled_child_id AS DATE) = 0 
					        AND
					        dtl.srvDtls_service_start
					        BETWEEN 
			    				 '".$startTime."'
							AND
			    				 '".$endTime."' ";
		$bookingQuery = $this->db->query($bookingSql);
		$bookingArr = $bookingQuery->result_array();

		$workingSql = "SELECT 	 
							SUM(TIME_TO_SEC(ADDTIME(CAST('00:00:01' as TIME),TIMEDIFF(time_to,time_from)))) totWorkHr
						FROM
							app_biz_hours
						WHERE
							day_id =".$noDay." 
							AND 
							local_admin_id  =".$dataArr['auto_local_admin_id'];
		$workingQuery = $this->db->query($workingSql);
		$workingQuery = $workingQuery->result_array();
		
		$remaningTime = ((intval($workingQuery[0]['totWorkHr']) - intval($bookingArr[0]['totalsec']))*100)/intval($workingQuery[0]['totWorkHr']);
		
	if($dataArr['auto_promo_priority'] <= $remaningTime){
		$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'autoPromotion',
					   'cron_local_admin_id'				=> $dataArr['auto_local_admin_id'],
					   'cron_customer_id'					=> 0,
					   'cron_customer_name'					=> '',
					   'cron_alert_type'					=> 3,
					   'cron_subject'						=> 'Auto Promotion',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> '',
					   'cron_customer_email'				=> '',
					   'cron_sender_mobile'					=> '',
					   'cron_sender_email'					=> '',
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
		 $this->db->insert('app_cron_manager', $checkFieldstatus_arr); 
	}		
	}
	if($dataArr['auto_promo_type']==3){
		$startTime	= gmdate($dataArr['auto_promo_date'], strtotime("+1440 min"));
		$endTime	= gmdate($dataArr['auto_promo_date'], strtotime("+2880 min"));
		$noDay		= gmdate('N', strtotime( $dataArr['auto_promo_date']));

		$bookingSql = "SELECT 	
							SUM(TIME_TO_SEC(dtl.srvDtls_service_duration)) AS totalsec
						FROM
							app_booking_service_details AS dtl,
							app_booking AS bk
						WHERE
							dtl.srvDtls_booking_id = bk.booking_id 
							AND 
							bk.local_admin_id  =".$dataArr['auto_local_admin_id']." 
							AND 
							CAST(dtl.srvDtls_rescheduled_child_id AS DATE) = 0 
					        AND
					        dtl.srvDtls_service_start
					        BETWEEN 
			    				 '".$startTime."'
							AND
			    				 '".$endTime."' ";
		$bookingQuery = $this->db->query($bookingSql);
		$bookingArr = $bookingQuery->result_array();

		$workingSql = "SELECT 	 
							SUM(TIME_TO_SEC(ADDTIME(CAST('00:00:01' as TIME),TIMEDIFF(time_to,time_from)))) totWorkHr
						FROM
							app_biz_hours
						WHERE
							day_id =".$noDay." 
							AND 
							local_admin_id  =".$dataArr['auto_local_admin_id'];
		$workingQuery = $this->db->query($workingSql);
		$workingQuery = $workingQuery->result_array();

		$remaningTime = ((intval($workingQuery[0]['totWorkHr']) - intval($bookingArr[0]['totalsec']))*100)/intval($workingQuery[0]['totWorkHr']);

		if($dataArr['auto_promo_priority'] <= $remaningTime){
		$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'autoPromotion',
					   'cron_local_admin_id'				=> $dataArr['auto_local_admin_id'],
					   'cron_customer_id'					=> 0,
					   'cron_customer_name'					=> '',
					   'cron_alert_type'					=> 3,
					   'cron_subject'						=> 'Auto Promotion',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> '',
					   'cron_customer_email'				=> '',
					   'cron_sender_mobile'					=> '',
					   'cron_sender_email'					=> '',
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
		 $this->db->insert('app_cron_manager', $checkFieldstatus_arr); 
		}	
	}
	
	
	if($dataArr['auto_promo_type']==4){
		$startTime	= gmdate($dataArr['auto_promo_date_srt'], strtotime("+2880 min"));
		$endTime	= gmdate($dataArr['auto_promo_date_end'], strtotime("+4320 min"));
		$noDay		=  gmdate('N', strtotime( $dataArr['auto_promo_date']));
		
		$bookingSql = "SELECT 	
							SUM(TIME_TO_SEC(dtl.srvDtls_service_duration)) AS totalsec
						FROM
							app_booking_service_details AS dtl,
							app_booking AS bk
						WHERE
							dtl.srvDtls_booking_id = bk.booking_id 
							AND 
							bk.local_admin_id  =".$dataArr['auto_local_admin_id']." 
							AND 
							CAST(dtl.srvDtls_rescheduled_child_id AS DATE) = 0 
					        AND
					        dtl.srvDtls_service_start
					        BETWEEN 
			    				 '".$startTime."'
							AND
			    				 '".$endTime."' ";
		$bookingQuery = $this->db->query($bookingSql);
		$bookingArr = $bookingQuery->result_array();

		$workingSql = "SELECT 	 
							SUM(TIME_TO_SEC(ADDTIME(CAST('00:00:01' as TIME),TIMEDIFF(time_to,time_from)))) totWorkHr
						FROM
							app_biz_hours
						WHERE
							day_id =".$noDay." 
							AND 
							local_admin_id  =".$dataArr['auto_local_admin_id'];
		$workingQuery = $this->db->query($workingSql);
		$workingQuery = $workingQuery->result_array();
		
		$remaningTime = ((intval($workingQuery[0]['totWorkHr']) - intval($bookingArr[0]['totalsec']))*100)/intval($workingQuery[0]['totWorkHr']);
		
	if($dataArr['auto_promo_priority'] <= $remaningTime){
		$checkFieldstatus_arr = array(
					   'cron_job_code'						=> 'autoPromotion',
					   'cron_local_admin_id'				=> $dataArr['auto_local_admin_id'],
					   'cron_customer_id'					=> 0,
					   'cron_customer_name'					=> '',
					   'cron_alert_type'					=> 3,
					   'cron_subject'						=> 'Auto Promotion',
					   'cron_messages'						=> $messages,
					   'cron_customer_mobile'				=> '',
					   'cron_customer_email'				=> '',
					   'cron_sender_mobile'					=> '',
					   'cron_sender_email'					=> '',
					   'cron_messages_status'				=> 1,
					   'cron_email_respons'					=> '',
					   'cron_sms_respons'					=> '',
					   'cron_create_datetime'				=> date("Y-m-d H:i:s"),
					   'cron_executed_datetime'				=> '',
					   'cron_finished_datetime'				=> ''
			);
		 $this->db->insert('app_cron_manager', $checkFieldstatus_arr); 
		}			
	}	
}

public function selectAllPostData(){
	$sql = "SELECT 	
				*
			FROM
				app_cron_manager
			WHERE 
				cron_alert_type	= 3
				AND
				cron_messages_status= 1";
	$query = $this->db->query($sql);
	$custArr = $query->result_array();
	return $custArr;
}
///set two end





}



