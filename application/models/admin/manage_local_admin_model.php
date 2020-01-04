<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_local_admin_model extends CI_Model 
{
    public function check_admin_status($nameuser)
    {
    	
    	
        $this->db->select('*');
        $this->db->from('app_password_manager');
        $this->db->where('user_id', $nameuser[1]);
		
        $query = $this->db->get();
        $ResArr = $query->result_array();
        $usertype ="superadmin";
        if(md5($ResArr[0]['password'].$ResArr[0]['encription_key']) == $nameuser[2] && md5($usertype) == $nameuser[3])
        {
        	$this->db->select('app_time_zone.gmt_symbol, app_time_zone.gmt_value');
            $this->db->from('app_time_zone');
            $this->db->join('app_local_admin', 'app_local_admin.time_zone_id = app_time_zone.time_zone_id');
            $query = $this->db->get();
            $timeArr =  $query->result();
            $time_diff = (($timeArr[0]->gmt_symbol == 1)?'-':'').$timeArr[0]->gmt_value;
        
            $set_user_data = array(
                'user_name'   			 => $ResArr[0]['user_name'],
                'user_id'     			 => $ResArr[0]['user_id'],
                'user_id_local_admin'    => $ResArr[0]['user_id'],
                'user_type'   			 => $ResArr[0]['user_type'],
                'is_super_admin'		 => true,
                'logged_in'   			 => TRUE,
                'time_difference'        => $time_diff,
                'admin_language'   		 => 'english'
            );
            
           
            $this->session->set_userdata($set_user_data);   
            $this->GetBusinessDetails($nameuser[1]);
            $this->GetLocalAdminAuth($nameuser[1]);
            
           // echo "<pre>";
           // print_r($this->session->all_userdata());
          //  exit;
            
            redirect(base_url().'admin/calender');
        } 
        
    }	
    
    public function GetLocalAdminAuth($local_admin_id){
   $sql = "";
   $sql .="SELECT 
      *
     FROM
      app_member_plan_subscription
     WHERE
      is_active = 'Y'
      AND
      local_admin_id = ".$local_admin_id;
       
   $result=$this->db->query($sql);
   $resultArr = $result->result();   
   $planFuture = json_decode($resultArr[0]->feature_desc, true);
   
   $feature_array = array();
      foreach($planFuture as $key=>$planFutureArr){     
       $feature_array[$key] = $planFutureArr['feature_id'];
            }
             $auth_array = array(
                                      'authKey'   => $feature_array
                              );   
   $this->session->set_userdata($auth_array);
  }
 public function GetBusinessDetails($local_admin_id){
   $sql = "";
   $sql .="SELECT 
      currency.currency_symbol AS currency,
      currency.currency_id AS currency_id,
      currency.currency_abbriviation AS abbriviation,
      gmt.gmt_value AS gmt_value,
      gmt.gmt_symbol AS gmt_symbol,
      time.time_format AS time_format,
      date.date_format AS date_format,
      admin.page_title AS title,
      admin.country_id AS ad_country,
      admin.region_id AS ad_region,
      admin.city_id AS ad_cityId,
      admin.first_name AS ad_fname,
      admin.last_name AS ad_lname,
      admin.home_phone AS ad_hphone,
      admin.work_phone AS ad_wphone,
      admin.mobile_phone AS ad_mobile,
      admin.business_logo AS ad_logo,
      admin.business_name AS ad_name,
      admin.business_location AS ad_location,
      admin.business_city_id AS ad_city,
      admin.business_state_id  AS ad_state,
      admin.business_zip_code  AS ad_zip,
      admin.business_phone AS ad_businessPhone,
      admin.facebook_link AS ad_facebook,
      admin.youtube_link AS ad_youtube,
      admin.google_link AS ad_google,
      admin.twitter_link AS ad_twitter,
      admin.linkedin_link AS ad_linkedin,
      ladmin.user_email AS ladmin_email
     FROM
      app_local_admin AS admin,
      app_currency AS currency,
      app_time_zone AS gmt,
      app_time_format AS time,
      app_date_format AS date,
      app_password_manager As ladmin
     WHERE
      admin.currency_id = currency.currency_id
      AND
      admin.time_zone_id = gmt.time_zone_id
      AND
      admin.time_format_id = time.time_format_id
      AND
      admin.date_format_id = date.date_format_id
      AND
      admin.local_admin_id = ".$local_admin_id."
      AND
      ladmin.user_id = ".$local_admin_id;
     
  
   $result=$this->db->query($sql);
   $resultArr = $result->result();
   $this->session->set_userdata($resultArr[0]);
   
  }
}
?>