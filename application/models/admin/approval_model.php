<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_model extends CI_Model{
	
	function showAllbooking()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$list='';
		$query=$this->db->query("   
	   	Select * from (
		SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c1.date_creation as date_inserted,
		c3.country_name as country_name,
		c4.city_name as city_name,
		c5.region_name as region_name,
		c1.user_email as user_email,
		book_ser.service_start_dt  as service_start_dt,
		book_ser.service_start_time  as service_start_time,
		book_ser.booking_status  as booking_status,
		book_ser.booking_service_id  as booking_id,
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS Firstname

     	,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customerLastName
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_status'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_status
	   ,
	   ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_zip
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_mobile
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn1'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_phn1
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn2'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_phn2
	   
  FROM app_password_manager c1 INNER JOIN
       app_local_customer_details c2 INNER JOIN
	   app_booking book INNER JOIN
       app_booking_service book_ser LEFT JOIN
	   app_countries c3 ON c3.country_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_countryid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )
	   LEFT JOIN
	   app_cities c4 ON c4.city_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_cityid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )
	  LEFT JOIN app_regions c5 ON c5.region_id=( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_regionid'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       )

	   where c1.user_type ='1' and 
	         c1.user_id=c2.customer_id and
			 c2.local_admin_id  = '".$local_admin_id."' and
			 book.local_admin_id=c2.local_admin_id  and 
			 book.booking_id=book_ser.booking_id and
			 book.customer_id = c2.customer_id and
	  		 book_ser.booking_status <>4
	   ) as maintable where 1=1");
		
		if ($query->num_rows() > 0)
		{
		
			foreach ($query->result() as $row)
			{
				$list.='<table width="100%"  class="approval-round">';
				$list.='<tr>';
				$list.='<td align="center" style="width:30px;">&nbsp;<input type="checkbox" name="book_chk_name[]" value="'.$row->booking_id.'" class="all_booking" /></td>';
				$list.='<td align="left" style="width:300px;">';
				$list.= $this->global_mod->show_to_control($row->Firstname).' ';
				$list.= $this->global_mod->show_to_control($row->customerLastName);
				$list.= '<br/>'.$this->global_mod->show_to_control($row->country_name).' ';
				$list.= $this->global_mod->show_to_control($row->region_name).' ';
				$list.=$row->city_name.' ';
				if($row->customer_zip !='')
				{
					$list.='('.$row->customer_zip.')';
				}
				$list.='</td>';
				$list.='<td align="left">';
				if($row->customer_mobile !='')
				{
					$list.=$row->customer_mobile.'<br/>';
				}
				if($row->cus_phn1 !='')
				{
					$list.=$row->cus_phn1.'<br/>';
				}
				if($row->cus_phn2 !='')
				{
					$list.=$row->cus_phn2.'<br/>';
				}
				$list.=$row->user_email.'<br/>';
				$list.='</td>';
				$list.='<td align="left" style="width:200px;">'.$this->approval_model->changeDateFrmt($row->service_start_dt).' '.$row->service_start_time.'<br/>';
				if($row->booking_status ==1)
				{
					$display_none_approve='style="display:none;"';
				}
				else
				{
					$display_none_approve='';
				}
				if($row->booking_status ==0 || $row->booking_status ==2)
				{
					$display_none_unapprove='style="display:none;"';
				}
				else
				{
					$display_none_unapprove='';
				}
				
				$list.='<span '.$display_none_approve.' id="approve_'.$row->booking_id.'" class="approval-btn"><a href="javascript:void()" onclick="approve('.$row->booking_id.')" >Approve</a></span>';
				$list.='<span '.$display_none_unapprove.' id="unapprove_'.$row->booking_id.'" class="unapproval-btn" ><a href="javascript:void()" onclick="unapprove('.$row->booking_id.')" >Unapprove</a></span>&nbsp;&nbsp;';
				$list.='<span class="deny-btn" ><a href="javascript:void()" onclick="deny('.$row->booking_id.')" >Deny</a></span><br/>';
				$list.='<span id="appointmentDetailsSpan_'.$row->booking_id.'"><a href="javascript:void()" onclick="appointmentDetails('.$row->booking_id.')">Appointment Details</a></span>';
				$list.='<span id="appointmentDetailsSpanHide_'.$row->booking_id.'" class="allAppointmentDetailsSpanHide"><a href="javascript:void()" onclick="appointmentDetailsHide('.$row->booking_id.')">Appointment Details</a></span>';
				$list.='</td>';
				$list.='</tr>';
				$list.='</table><div class="app-details" id="appointment_details_show'.$row->booking_id.'" ></div>';
			}
			
		}
		else
		{
			$list="No Booking Available";
			
		}
		return $list;
	}																																																		
	function changeStatus($booking_id,$booking_status)
	{
			
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		'booking_status' => $booking_status,
		);
		$this->db->trans_begin();
		$this->db->where('booking_service_id',$booking_id);
		$this->db->update('app_booking_service', $data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			return true;
		} 
	}																				
	function getCancellationPolicy()
	{
          
            
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('cms_dec');
            $this->db->from('app_cms');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
            
        }								
	function getMaxCancellationTime()
	{
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('bkin_can_mx_tim,bkin_can_setin');
            $this->db->from('app_local_admin_gen_setting');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
        }								
	function deny($booking_id)
	{
            $this->load->database();
            $data = array(
                'srvDtls_booking_status' => 4,//canceledByAdmin
            );
            $this->db->trans_begin();
            $this->db->where('srvDtls_booking_id',$booking_id);
            $this->db->update('app_booking_service_details', $data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return 0;
            }
            else
            {
                $this->db->trans_commit();
                return 1;
            } 
	}																		
	function approve($booking_id)
	{
            $this->load->database();
            $data = array(
                'srvDtls_booking_status' => 1,//approved
            );
            $this->db->trans_begin();
            $this->db->where('srvDtls_booking_id',$booking_id);
            $this->db->update('app_booking_service_details', $data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return 0;
            }
            else
            {
                $this->db->trans_commit();
                return 1;
            } 
	}																		
	function getBusinessDetails()
	{
            $local_admin_id = $this->session->userdata('local_admin_id');
            $this->db->select('app_local_admin.business_name, app_local_admin.business_phone, app_local_admin.business_location, app_local_admin.business_description, app_password_manager.user_email, app_local_admin_gen_setting.bkin_can_setin, app_local_admin_gen_setting.bkin_can_mx_tim');
            $this->db->from('app_local_admin');
            $this->db->join('app_password_manager', 'app_password_manager.user_id = app_local_admin.local_admin_id');
            $this->db->join('app_local_admin_gen_setting', 'app_local_admin_gen_setting.local_admin_id = app_local_admin.local_admin_id');
            $this->db->where('app_local_admin.local_admin_id', $local_admin_id); 
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr;
        }										
	function getBookingDetails($booking_id)
	{
            $str = '';
            $str .= ' AND booking_id = '.$booking_id.' ';
            $arr = $this->global_mod->mainBookingStoreProReport($str,$starting='');
            return $arr;
        }					
	function approveAllCheckedBooking($booking_all_id)
	{
            $booking_id_arr=explode(",",$booking_all_id);
            
            $data = array(
                'srvDtls_booking_status' => 1,//approved
            );
            $this->db->where_in('srvDtls_booking_id', $booking_id_arr);
            $this->db->update('app_booking_service_details', $data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
                
                foreach($booking_id_arr as $booking_id){
					//$bookingDetails = $this->approval_model->getBookingDetails($booking_id);
					$bookingDetails = $this->getUserallDetails($booking_id);
					
					//print_r($bookingDetails[0]['srvDtls_service_start']);
				
			        $appoStartDate = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_service_start']));
			        
			        
			        $this->load->model('admin/calender_model');
			        $name = $this->calender_model->getCustomerBybookingId($booking_id);
			        if(isset($name)){
						$cus_fname = ucfirst($name[0]['cus_fname']);
			        	$cus_lname = ucfirst($name[0]['cus_lname']);
					}else{
						$cus_fname = '';
						$cus_lname = '';
					}
			        
			        $customerMail = $bookingDetails[0]['user_email'];
			             
			                
			                /////      QUERY TO GET CANCELLATION POLICY STARTS   //////
			                
			                $cancellationPolicyArr = $this->approval_model->getCancellationPolicy();
			                
			                /*****      QUERY TO GET CANCELLATION POLICY ENDS       *****/
			                /*****      QUERY TO GET MAXIMUM CANCELLATION TIME STARTS       *****/
			                
			                $maxTimeArr = $this->approval_model->getMaxCancellationTime();
			                $maxTime = $maxTimeArr[0]['bkin_can_mx_tim'];
			                if($maxTimeArr[0]['bkin_can_setin'] == 1){
			                    $maxUnit = "Day(s)";
			                }elseif($maxTimeArr[0]['bkin_can_setin'] == 2){
			                    $maxUnit = "Hour(s)";
			                }else{
			                    $maxUnit = "Minute(s)";
			                }
			                $cancellationMaxTime = $maxTime;   
			                
			            /*****      QUERY TO GET MAXIMUM CANCELLATION TIME ENDS     *****/
			                ###############################################
			                    
			                $business_name = $this->session->userdata('ad_name');    
			                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
			                $user_email = $this->session->userdata('ladmin_email');
			                
			                
			                $replacerArr = array( '{businessname}'					=> $business_name,
			                					  '{businessaddress}'				=> $busi_address,
			                					  '{businessemail}'					=> $user_email,
			                					  '{appointmentdate}'				=> $appoStartDate,
			                					  '{fname}'							=> $cus_fname,
			                					  '{lname}'							=> $cus_lname,
			                					  '{cancellationpolicy}'			=> nl2br($cancellationPolicyArr[0]['cms_dec']),
			                					  '{hoursbeforecancellation}'		=> $cancellationMaxTime	
			                
			                );

			        #############################################
			       
			        
			        $mail = $this->email_model->sentMail(3, $replacerArr, $customerMail, $user_email);
				}
                
                
                
                return true;
            } 
	}																		

	function appointmentDetails($booking_id)
	{
	$list='';
		
		$query=$this->db->query("SELECT booking.*,emp.employee_name,ser.service_name
FROM    app_booking_service booking,app_employee emp,app_service ser
WHERE   booking.service_id=ser.service_id AND
		booking.employee_id=emp.employee_id AND
		booking.booking_service_id ='".$booking_id."'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$list.='<div style="text-align:center"> '.$row->service_name.' by '.$row->employee_name.'on '.$this->approval_model->changeDateFrmt($row->service_start_dt).' '.$row->service_start_time.'</div>';
				 //Service1 by staff 5 on Tuesday, September 04, 2012 8:00 AM 
			}
				$list.='<br/>';
		}
	
	return $list;
	}																			

	function changeDateFrmt($date)
	{
	
	$explode=explode('-',$date);
	$change_date=date("F j, Y",mktime(0, 0, 0,$explode[1],$explode[2],$explode[0]));
	return $change_date;
	}	
	
	function findService(){
		$query=$this->db->query("SELECT * from app_service where local_admin_id =".$this->session->userdata('local_admin_id'));
		if ($query->num_rows() > 0){
			$list = 1;
		}else{
			$list = 0;
		}
		return $list;
	}
	function findEmployee(){
		$query=$this->db->query("SELECT * from app_employee where local_admin_id =".$this->session->userdata('local_admin_id'));
		if ($query->num_rows() > 0){
			$list = 1;
		}else{
			$list = 0;
		}
		return $list;
	}
	function findLocaladminDetails(){
		$query=$this->db->query("SELECT * from app_local_admin where local_admin_id =".$this->session->userdata('local_admin_id'));
		$Arr = $query->result_array();
		if (
			$Arr[0]['business_name']==''||
			$Arr[0]['business_description']==''||
			$Arr[0]['page_title']==''||
			$Arr[0]['business_tag']==''||
			$Arr[0]['business_location']==''||
			$Arr[0]['business_city_id']==0 ||
			$Arr[0]['business_state_id'] ==0 ||
			$Arr[0]['business_zip_code']==''||
			$Arr[0]['business_phone']==''
			){
			$list =0;
		}else{
			$list = 1;
		}
		return $list; 
	}
	function findBizHours(){
		$query=$this->db->query("SELECT * from app_biz_hours where local_admin_id =".$this->session->userdata('local_admin_id'));
		if ($query->num_rows() > 0){
			$list = 1;
		}else{
			$list = 0;
		}
		return $list; 
	}		
	
	function GetTimeZone(){
		$query=$this->db->query("SELECT time_zone_id from app_local_admin where local_admin_id =".$this->session->userdata('local_admin_id'));
		$Arr = $query->result_array();
		if($Arr[0]['time_zone_id'] == 158){
			return 0;
		}else{
			return 1;
		}
		
	}		
	
	public function getUserallDetails($bookingId){
		$Sql ='SELECT 
      				details.srvDtls_service_start,
      				user.user_email
				FROM
				      app_booking_service_details details
				JOIN
				      app_booking book
				ON
				      book.booking_id=details.srvDtls_booking_id
				JOIN
				      app_password_manager user
				ON
				     user.user_id=book.customer_id
				WHERE
				     details.srvDtls_booking_id ="'.$bookingId.'"
				ORDER BY details.srvDtls_id DESC LIMIT 1
      			';
      	
      	$query = $this->db->query($Sql);
		$Arr = $query->result_array();
      	return $Arr;		
	}
	
}
?>


