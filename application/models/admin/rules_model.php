<?php
class Rules_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_clint_signup_info()
	{
		$this->db->select('sign_upinfo_item_id, info_item_name');
		$this->db->from('app_local_clint_signup_info');
		$this->db->where('info_status', '1');
		$this->db->where('front_disp', '1');
		$this->db->where('sign_upinfo_item_id != 5');
		$this->db->where('sign_upinfo_item_id != 6');
		$this->db->where('sign_upinfo_item_id != 7');
		$this->db->where('sign_upinfo_item_id != 8');
		$this->db->order_by("info_item_name", "ASC"); 
		$query = $this->db->get();
		return $app_local_clint_signup_info =  $query->result_array();
	}
	
	public function get_clint_edit_info()
	{
		$this->db->select('sign_upinfo_item_id, info_item_name');
		$this->db->from('app_local_clint_signup_info');
		$this->db->where('info_status', '1');
		$this->db->where('front_disp', '1');
		//$this->db->where('sign_upinfo_item_id != 5');
		//$this->db->where('sign_upinfo_item_id != 6');
		//$this->db->where('sign_upinfo_item_id != 7');
		//$this->db->where('sign_upinfo_item_id != 8');
		$this->db->order_by("info_item_name", "ASC"); 
		$query = $this->db->get();
		return  $query->result_array();
	}
	
	public function get_admin_user_show_field_info()
	{
		$this->db->select('sign_upinfo_item_id, info_item_name');
		$this->db->from('app_local_clint_signup_info');
		$this->db->where('sign_upinfo_item_id != 2');
		$this->db->where('sign_upinfo_item_id != 3');
		$this->db->where('sign_upinfo_item_id != 9');
		$this->db->where('info_status', '1');
		$this->db->where('front_disp', '1');
		$this->db->order_by("info_item_name", "ASC"); 
		$query = $this->db->get();
		return  $query->result_array();
	}
	
	public function get_language_list()
	{
		$this->db->select('languages_id, languages_name');
		$this->db->from('app_languages');
		$this->db->where('status', '1');
		$this->db->order_by("languages_name", "ASC"); 
		$query = $this->db->get();
		return $app_languages =  $query->result_array();
	}
	
	public function get_login_types()
	{
		$this->db->select('login_typ_id, login_name, login_identifier');
		$this->db->from('app_logins');
		$this->db->where('status', '1');
		$this->db->order_by("login_name", "ASC"); 
		$query = $this->db->get();
		return $app_logins =  $query->result_array();
	}
	
	public function changeDtFrmat($date)
	{
		$oldDate = $date;
		$arr = explode('/', $oldDate);
		return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
	}
	
	public function CalDispDtFrmat($date)
	{
		$oldDate = $date;
		$arr = explode('-', $oldDate);
		return $newDate = $arr[1].'/'.$arr[2].'/'.$arr[0];
	}
	
	public function rules_add()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		//$local_admin_id  =  $this->input->post('local_admin_id');
		$enable_system  =  $this->input->post('site_enb');
		$aprvl_rqrd_pre_payin_mem  =  $this->input->post('aprvl_rqrd_pre_payin_mem');
		$aprvl_rqrd_mob_verfd_mem  =  $this->input->post('aprvl_rqrd_mob_verfd_mem');
		$aprvl_rqrd_mob_non_verfd_mem  =  $this->input->post('aprvl_rqrd_mob_non_verfd_mem');
		$applyAdvanceBookingRule  =  $this->input->post('applyAdvanceBookingRule');
		if($applyAdvanceBookingRule == 1)
		{
			$no_of_booking = $this->input->post('no_of_booking');
			$no_of_booking_period = $this->input->post('no_of_booking_period');
			if($no_of_booking_period != 1 || $no_of_booking_period != 2)
			{
				$no_of_booking_period_from_Dformted  =  $this->input->post('no_of_booking_period_from');
				if($no_of_booking_period_from_Dformted != "")
				{
					$no_of_booking_period_from  =  $this->changeDtFrmat($no_of_booking_period_from_Dformted);
				}
				else
				{
					$no_of_booking_period_from  = '0000-00-00';
				}
				
				$no_of_booking_period_to_Dformted  =  $this->input->post('no_of_booking_period_to');
				if($no_of_booking_period_to_Dformted != "")
				{
					$no_of_booking_period_to  =  $this->changeDtFrmat($no_of_booking_period_to_Dformted);
				}
				else
				{
					$no_of_booking_period_to  = '0000-00-00';
				}
				
				if($no_of_booking_period == 4 || $no_of_booking_period == 5 || $no_of_booking_period == 6)
				{
					if($no_of_booking_period == 4)
					{
						$booking_starting_point  =  $this->input->post('MonthDateSelection');
					}
					if($no_of_booking_period == 5)
					{
						$booking_starting_point  =  $this->input->post('weekDaySelection');
					}
					if($no_of_booking_period == 6)
					{
						$booking_starting_point  =  $this->input->post('MonthSelection');
					}
				}
			}
		}
		else
		{
			$no_of_booking = 0;
		}
		
		$recurring_appointments  =  $this->input->post('recurring_appointments');
		$recurring_admin  =  $this->input->post('recurring_admin');
		$quantity_appointment_setting  =  $this->input->post('quantity_appointment_setting');
		$quantity_appointment  =  $this->input->post('quantity_appointment');
		
		
		$allow_international_users  =  $this->input->post('allow_international_users');
		if($allow_international_users  == 1)
		{
			$detect_client_timezone     =  $this->input->post('detect_client_timezone');	
		}
		
		$show_service_cost  		 =  $this->input->post('show_service_cost');
		$show_service_time_duration  =  $this->input->post('show_service_time_duration');
		$booked_times_striked  		 =  1;
		
		if($booked_times_striked  == 1)
		{
		    $blocked_times_striked_out  = 1;
		}
		
		
		$clients_name_with_reviews  =  $this->input->post('clients_name_with_reviews');
		$default_view  =  $this->input->post('default_view');
		$cal_strting_weekday  =  $this->input->post('cal_strting_weekday');
		
		$cal_strting_dt_Dformted  =  $this->input->post('cal_strting_dt');
		if($cal_strting_dt_Dformted != "")
		{
			$cal_strting_dt  =  $this->changeDtFrmat($cal_strting_dt_Dformted);
			
		}
		else
		{
			$cal_strting_dt  = '0000-00-00';
		}
		
		
		
		$admin_always_allowed = $this->input->post('admin_always_allowed');
		if ((!is_numeric($admin_always_allowed)) || (($admin_always_allowed != 1) && ($admin_always_allowed != 0)))
		{
			$admin_always_allowed = 0;
		}
		
		$admin_show_who = $this->input->post('admin_show_who');
		if ((!is_numeric($admin_show_who)) || (($admin_show_who != 1) && ($admin_show_who != 0)))
		{
			$admin_show_who = 1;
		}
		
		$show_staff_customers  =  $this->input->post('show_staff_customers');
		//$staff_selection_mandatory  =  $this->input->post('staff_selection_mandatory');
		//$staff_order  =  $this->input->post('staff_order');
		if($show_staff_customers  == 1)
		{
		   $staff_selection_mandatory  =  $this->input->post('staff_selection_mandatory');
		  
		   if($staff_selection_mandatory  == 1)
		   {
			    $staff_selection_mandatory  =  $this->input->post('staff_selection_mandatory');
				$staff_order  =  0;	
		   }
		   else{
		    	$staff_selection_mandatory  =  $this->input->post('staff_selection_mandatory');
		   		$staff_order  =  $this->input->post('staff_order');	
		   }
		   
		}
		else
		{
			$staff_order  =  $this->input->post('staff_order');	
			$staff_selection_mandatory  =  0;
		}
		
	
		$this->db->trans_begin();
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_clint_signup_info');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		} 
		$sign_upinfo_item  =  $this->input->post('sign_upinfo_item');
		
		
		foreach($sign_upinfo_item as $value)
		{
			$data = array(
				'local_admin_id'	  => $local_admin_id,
				'sign_upinfo_item_id' => $value,
				'type'                => 'S',
				'mandetory'			  => '0',
				'disp_on_screen'	  => '1',
				'status'			  => '1',
			);
			$this->db->trans_begin();
			$this->db->insert('app_local_admin_gen_setting_clint_signup_info',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}
		
		
		$edit_info_item  =  $this->input->post('edit_info_item');
		foreach($edit_info_item as $value)
		{
			$data = array(
				'local_admin_id'	  => $local_admin_id,
				'sign_upinfo_item_id' => $value,
				'type'                => 'E',
				'mandetory'			  => '0',
				'disp_on_screen'	  => '1',
				'status'			  => '1',
			);
			$this->db->trans_begin();
			$this->db->insert('app_local_admin_gen_setting_clint_signup_info',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}
		
		$edit_admin_user_info_item  =  $this->input->post('edit_admin_user_info_item');
		$this -> db -> trans_begin();
		$sql = 'DELETE FROM `app_local_admin_gen_setting_admin_user_info`
				WHERE `local_admin_id` = ?';
		$this -> db -> query($sql, array($local_admin_id));
		
		$values = array();
		$sql = array();
		foreach ($edit_admin_user_info_item as $id)
		{
			$sql[] = '(?, ?, 0, 1, 1)';
			$values[] = $local_admin_id;
			$values[] = $id;
		}
		
		if (!empty($sql))
		{	
			$sql = 'INSERT INTO `app_local_admin_gen_setting_admin_user_info` 
				(`local_admin_id`, `sign_upinfo_item_id`, `mandetory`, `disp_on_screen`, `status`) 
				VALUES ' . implode(', ', $sql);
			
			$this -> db -> query($sql, $values);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		} 

		$this->db->trans_begin();
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_languages');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		} 
		
		$language_list  =  $this->input->post('language_list');
		foreach($language_list as $languages)
		{
			$data = array(
				'local_admin_id'	  => $local_admin_id,
				'languages_id' => $languages,
				'status'			  => '1',
			);
			$this->db->trans_begin();
			$this->db->insert('app_local_admin_gen_setting_languages',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}
		$default_language_id  =  $this->input->post('default_language_id');
		
		
		$this->db->trans_begin();
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_login_typ');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		} 
		
		$language_list  =  $this->input->post('language_list');
		
		$login_typ_list  =  $this->input->post('login_typ');
		foreach($login_typ_list as $login_typ)
		{
			$data = array(
				'local_admin_id'	  => $local_admin_id,
				'login_typ_id' => $login_typ,
				'status'			  => '1',
			);
			$this->db->trans_begin();
			$this->db->insert('app_local_admin_gen_setting_login_typ',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}
		$default_login_typ_id  =  $this->input->post('default_login_typ_id');
		
			
		$cal_time_interval_typ  =  $this->input->post('cal_time_interval_typ');
		if($cal_time_interval_typ == 2 || $cal_time_interval_typ == 3)
		{
			if($cal_time_interval_typ == 2 )
			{
				$cal_time_interval_variable  =  $this->input->post('cal_time_interval_variable_2');
			}
			if($cal_time_interval_typ == 3 )
			{
				$cal_time_interval_variable  =  $this->input->post('cal_time_interval_variable_3');
			}
			
			
		}
		else{
				$cal_time_interval_variable='15';
		}
		
		$adv_bk_min_setting  =  $this->input->post('adv_bk_min_setting');
		$adv_bk_min_tim  =  $this->input->post('adv_bk_min_tim');
		
		$bkin_can_mx_tim  =  $this->input->post('bkin_can_mx_tim');
		$bkin_can_setin  =  $this->input->post('bkin_can_setin');
		
		$bkin_reschdl_mx_tim  =  $this->input->post('bkin_reschdl_mx_tim');
		$bkin_reschdl_setin  =  $this->input->post('bkin_reschdl_setin');
		
		
		$adv_bk_mx_tim  =  $this->input->post('adv_bk_mx_tim');
		
		$tim_intrvl_btwn_appo  =  $this->input->post('tim_intrvl_btwn_appo');
		$tim_intrvl_btwn_appo_settingin  =  $this->input->post('tim_intrvl_btwn_appo_settingin');
		
		$admn_tim_intrvl  =  $this->input->post('admn_tim_intrvl');
		
		
		$sms_alert  =  $this->input->post('sms_alrt_bfr_appo_chk');
		if($sms_alert == 1)
		{
			$sms_alrt_bfr_appo  =  $this->input->post('sms_alrt_bfr_appo');
		}
		else
		{
			$sms_alert = 0;
		}
		
		
		$sms_thanks_aftrappo  =  $this->input->post('sms_thanks_aftrappo');
		$send_sms_for  =  $this->input->post('send_sms_for');
		
		
		$sms_alart_to_admin  =  $this->input->post('sms_alart_to_admin');
		$sms_alart_to_staff  =  $this->input->post('sms_alart_to_staff');
		
		
		$email_alert  =  $this->input->post('email_alrt_bfr_appo_chk');
		
		if($email_alert == 1)
		{
			$email_alrt_bfr_appo  =  $this->input->post('email_alrt_bfr_appo');
		}
		else
		{
			$email_alert = 0;
		}
		//$booking_starting_point  =  $this->input->post('MonthSelection');
		$hours_type			= $this->input->post('hours_type');
		$show_block_timinig = $this->input->post('show_block_timinig');
		
		$data = array(
			'local_admin_id'					=> $local_admin_id,
			'enable_system'						=> $enable_system,
			'aprvl_rqrd_pre_payin_mem'			=> $aprvl_rqrd_pre_payin_mem,
			'aprvl_rqrd_mob_verfd_mem'			=> $aprvl_rqrd_mob_verfd_mem,
			'aprvl_rqrd_mob_non_verfd_mem'		=> $aprvl_rqrd_mob_non_verfd_mem,
			'no_of_booking'						=> $no_of_booking,
			'no_of_booking_period'				=> isset($no_of_booking_period)?$no_of_booking_period:1,
			'booking_starting_point'			=> isset($booking_starting_point)?$booking_starting_point:0,
			'no_of_booking_period_from'			=> isset($no_of_booking_period_from)?$no_of_booking_period_from:'0000-00-00',
			'no_of_booking_period_to'			=> isset($no_of_booking_period_to)?$no_of_booking_period_to:'0000-00-00',
			'recurring_appointments'			=> $recurring_appointments,
			'recurring_admin'					=> $recurring_admin,
			'quantity_appointment_setting'		=> $quantity_appointment_setting,
			'quantity_appointment'				=> isset($quantity_appointment)?$quantity_appointment:0,
			
			'allow_international_users'			=> $allow_international_users,
			'detect_client_timezone'			=> isset($detect_client_timezone)?$detect_client_timezone:0,
			
			'show_service_cost'					=> $show_service_cost,
			'show_service_time_duration'		=> $show_service_time_duration,
			'booked_times_striked'				=> $booked_times_striked,
			'blocked_times_striked_out'			=> isset($blocked_times_striked_out)?$blocked_times_striked_out:0,
			
			'clients_name_with_reviews'			=> $clients_name_with_reviews,
			'default_view'						=> $default_view,
			'cal_strting_weekday'				=> $cal_strting_weekday,
			'cal_strting_dt'					=> $cal_strting_dt,
			
			'admin_always_allowed'				=> isset($admin_always_allowed)?$admin_always_allowed:0,
			'admin_show_who'				=> isset($admin_show_who)?$admin_show_who:1,
			'show_staff_customers'				=> isset($show_staff_customers)?$show_staff_customers:0,
			'staff_selection_mandatory'			=> isset($staff_selection_mandatory)?$staff_selection_mandatory:0,
			'staff_order'						=> isset($staff_order)?$staff_order:0,
			
			'default_language_id'				=> isset($default_language_id)?$default_language_id:0,
			'default_login_typ_id'				=> isset($default_login_typ_id)?$default_login_typ_id:0,
			'cal_time_interval_typ'				=> $cal_time_interval_typ,
			'cal_time_interval_variable'		=> isset($cal_time_interval_variable)?$cal_time_interval_variable:0,
			
			'adv_bk_min_setting'				=> $adv_bk_min_setting,
			'adv_bk_min_tim'					=> $adv_bk_min_tim,
			'tim_intrvl_btwn_appo_settingin'	=> $tim_intrvl_btwn_appo_settingin,
			'adv_bk_mx_tim'						=> $adv_bk_mx_tim,
			'bkin_can_setin'					=> $bkin_can_setin,
			'bkin_can_mx_tim'					=> $bkin_can_mx_tim,
			'bkin_reschdl_setin'				=> $bkin_reschdl_setin,
			'bkin_reschdl_mx_tim'				=> $bkin_reschdl_mx_tim,
			'tim_intrvl_btwn_appo'				=> $tim_intrvl_btwn_appo,
			'admn_tim_intrvl'					=> $admn_tim_intrvl,
			
			'sms_alert'							=> isset($sms_alert)?$sms_alert:0,
			'sms_alrt_bfr_appo'					=> isset($sms_alrt_bfr_appo)?$sms_alrt_bfr_appo:0,
			
			'sms_thanks_aftrappo'				=> isset($sms_thanks_aftrappo)?$sms_thanks_aftrappo:0,
			'send_sms_for'						=> ($send_sms_for != "")?$send_sms_for:0,
			'sms_alart_to_admin'				=> isset($sms_alart_to_admin)?$sms_alart_to_admin:0,
			'sms_alart_to_staff'				=> isset($sms_alart_to_staff)?$sms_alart_to_staff:0,
			'email_alert'						=> isset($email_alert)?$email_alert:0,
			'email_alrt_bfr_appo'				=> isset($email_alrt_bfr_appo)?$email_alrt_bfr_appo:0,
			'hours_type'						=> isset($hours_type)?$hours_type:0,
			'show_block_timinig'				=> isset($show_block_timinig)?$show_block_timinig:0
			);
			
			//print_r($data);
			//exit;
			$this->db->select('local_admin_gen_setting_id');
			$this->db->from('app_local_admin_gen_setting');
			$this->db->where('local_admin_id', $local_admin_id);
			$query = $this->db->get();
			$NumRows =  $query->num_rows();
			
			
			
			$this->db->trans_begin();
			if($NumRows == 0)
			{
					$this->db->insert('app_local_admin_gen_setting',$this->db->escape($data));
			}
			else
			{
				$this->db->where('local_admin_id', $local_admin_id);
				$this->db->update('app_local_admin_gen_setting',$this->db->escape($data));
			}

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
	}
	

	
	function select_from_db()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		
		
		//$this->CalDispDtFrmat($no_of_booking_period_from_Dformted);
		
		
		$this->db->select('sign_upinfo_item_id,type');
		$this->db->from('app_local_admin_gen_setting_clint_signup_info');
		$this->db->where('local_admin_id', $local_admin_id);
		//$this->db->where('type', 'S');
		
		$querySignUp = $this->db->get();
		$NumRowsSi =  $querySignUp->num_rows();
                $SignUpArr=array();
		if($NumRowsSi > 0)
		{
			$ResSignUp = $querySignUp ->result_array();
			$SignUpArr=array();
			$editInfoArr = array();
			$counterChkSignUp = 0;
			$counterEdit =0;
			foreach ($ResSignUp as $SignUp)
			{
			    if($SignUp['type']=='E')
			     {
				 $editInfoArr[$counterEdit] = $SignUp['sign_upinfo_item_id'];
				 $counterEdit++;
				 }
				else 
                 {
				   $SignUpArr[$counterChkSignUp] = $SignUp['sign_upinfo_item_id'];
				 
				   $counterChkSignUp++;
				  } 
			}
		}
		
		$adminNoInfoArr = array();
		$sql = 'SELECT sign_upinfo_item_id
			FROM `app_local_admin_gen_setting_admin_user_info`
			WHERE `local_admin_id` = ?';
		$result = $this -> db -> query($sql, array($local_admin_id));
		foreach ($result -> result_array() as $row)
		{
			$adminNoInfoArr[] = $row['sign_upinfo_item_id'];
		}
		
		$this->db->select('languages_id');
		$this->db->from('app_local_admin_gen_setting_languages');
		$this->db->where('local_admin_id', $local_admin_id);
		$queryLang = $this->db->get();
		$NumRows =  $queryLang->num_rows();
		if($NumRows > 0)
		{
			$ResLang = $queryLang ->result_array();
			$langArr=array();
			$counterChk = 0;
			foreach ($ResLang as $Lang)
			{
				$langArr[$counterChk] = $Lang['languages_id'];
				$counterChk++;
			}
		}
		
		$this->db->select('login_typ_id');
		$this->db->from('app_local_admin_gen_setting_login_typ');
		$this->db->where('local_admin_id', $local_admin_id);
		$querylogin = $this->db->get();
		$NumRowsLogIn =  $querylogin->num_rows();
		if($NumRowsLogIn > 0)
		{
			$ResLogin = $querylogin ->result_array();
			$LogInArr=array();
			$counterChklogin = 0;
			foreach ($ResLogin as $login)
			{
				$LogInArr[$counterChklogin] = $login['login_typ_id'];
				$counterChklogin++;
			}
		}
		
		$NumRows =  $query->num_rows();
		if($NumRows == 1)
		{
			$list=array();
			foreach ($query ->result() as $row)
			{
				$list['local_admin_id']                      =$row->local_admin_id;
				$list['enable_system']                       =$row->enable_system;
				$list['aprvl_rqrd_pre_payin_mem']            =$row->aprvl_rqrd_pre_payin_mem;
				
				$list['aprvl_rqrd_mob_verfd_mem']            =$row->aprvl_rqrd_mob_verfd_mem;
				$list['aprvl_rqrd_mob_non_verfd_mem']        =$row->aprvl_rqrd_mob_non_verfd_mem;
				
				$list['no_of_booking']                       =$row->no_of_booking;
				$list['no_of_booking_period']                =$row->no_of_booking_period;
				$list['booking_starting_point']              =$row->booking_starting_point;
				$list['no_of_booking_period_from']           =$this->CalDispDtFrmat($row->no_of_booking_period_from);
				$list['no_of_booking_period_to']             =$this->CalDispDtFrmat($row->no_of_booking_period_to);
				$list['recurring_appointments']              =$row->recurring_admin;
				$list['recurring_admin']                     =$row->recurring_appointments;
				$list['quantity_appointment_setting']        =$row->quantity_appointment_setting;
				$list['quantity_appointment']                =$row->quantity_appointment;
				
				$list['allow_international_users']           =$row->allow_international_users;
				$list['detect_client_timezone']              =$row->detect_client_timezone;
				$list['show_service_cost']                   =$row->show_service_cost;
				$list['show_service_time_duration']          =$row->show_service_time_duration;
				
				
				$list['booked_times_striked']                =$row->booked_times_striked;
				$list['blocked_times_striked_out']           =$row->blocked_times_striked_out;
				
				$list['clients_name_with_reviews']           =$row->clients_name_with_reviews;
				$list['default_view']                        =$row->default_view;
				
				$list['cal_strting_weekday']                 =$row->cal_strting_weekday;
				$list['cal_strting_dt']                      =$this->CalDispDtFrmat($row->cal_strting_dt);
				$list['admin_show_who']			     =$row->admin_show_who;
				$list['admin_always_allowed']		     =$row->admin_always_allowed;
				$list['show_staff_customers']                =$row->show_staff_customers;
				$list['staff_selection_mandatory']           =$row->staff_selection_mandatory;
				$list['staff_order']                         =$row->staff_order;
				
				
				$list['default_language_id']                 =$row->default_language_id;
				$list['default_login_typ_id']                =$row->default_login_typ_id;
				$list['cal_time_interval_typ']               =$row->cal_time_interval_typ;
				$list['cal_time_interval_variable']          =$row->cal_time_interval_variable;
				
				$list['adv_bk_min_setting']					=$row->adv_bk_min_setting;
				$list['adv_bk_min_tim']						=$row->adv_bk_min_tim;
				$list['tim_intrvl_btwn_appo_settingin']		=$row->tim_intrvl_btwn_appo_settingin;
				$list['adv_bk_mx_tim']						=$row->adv_bk_mx_tim;
				$list['bkin_can_setin']						=$row->bkin_can_setin;
				$list['bkin_can_mx_tim']					=$row->bkin_can_mx_tim;
				$list['bkin_reschdl_setin']					=$row->bkin_reschdl_setin;
				$list['bkin_reschdl_mx_tim']				=$row->bkin_reschdl_mx_tim;
				$list['tim_intrvl_btwn_appo']				=$row->tim_intrvl_btwn_appo;
				$list['admn_tim_intrvl']					=$row->admn_tim_intrvl;
				
				
				$list['sms_alert']                   		 =$row->sms_alert;
				$list['sms_alrt_bfr_appo']                   =$row->sms_alrt_bfr_appo;
				$list['sms_thanks_aftrappo']                 =$row->sms_thanks_aftrappo;
				$list['send_sms_for']                        =$row->send_sms_for;
				$list['sms_alart_to_admin']                  =$row->sms_alart_to_admin;
				$list['sms_alart_to_staff']                  =$row->sms_alart_to_staff;
				$list['email_alert']                         =$row->email_alert;
				$list['email_alrt_bfr_appo']                 =$row->email_alrt_bfr_appo;
				$list['hours_type']                 		 =$row->hours_type;
				$list['show_block_timinig']                  =$row->show_block_timinig;
				
				$list['sign_upinfo_item']                	 = $SignUpArr;
				$list['edit_info_item_arr']                	     = $editInfoArr;
				$list['user_show_field_arr']			= $adminNoInfoArr;
				
				$list['language_list']                		 =isset($langArr)?$langArr:"";
				$list['login_typ']                		     =isset($LogInArr)?$LogInArr:"";
			}
		}
		else
		{
			$list = 0;
		}
		return $list;
		
	}	
	function staffOrder()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');		
		$this->db->select('value');
		$this->db->from('app_code_value');
		$this->db->where('code_code_id', 2);
		$querylogin = $this->db->get();
		$NumRowsLogIn =  $querylogin->num_rows();
		$staffOrderArr=array();
		if($NumRowsLogIn > 0)
		{
			$ResLogin = $querylogin ->result_array();	
			foreach ($ResLogin as $key=>$value)
			{
				$staffOrderArr[]=$value['value'];
			}
		}
		return 	$staffOrderArr;
	}
	public function getAllSmsCountry(){
        $this->db->select('app_countries.*');
        $this->db->from('app_membership_credits_country_price');
		$this->db->join('app_countries','app_countries.country_id = app_membership_credits_country_price.country_id');
		$this->db->where('app_membership_credits_country_price.credit_service_id', 2);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function getSmsRate($country_id=''){
		if($country_id==''){
			$country_id=$this->get_local_admin_country();
		}
        $this->db->select('*');
        $this->db->from('app_membership_credits_country_price');
		$this->db->where('credit_service_id', 2);
		$this->db->where('country_id', $country_id);
        $query = $this->db->get();
        $arr=$query->result_array();
		return isset($arr[0]['cost'])?$arr[0]['cost']:0;
    }
	
	public function get_local_admin_country(){

		$local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('country_id');
        $this->db->from('app_local_admin');
		$this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $arr=$query->result_array();
		return isset($arr[0]['country_id'])?$arr[0]['country_id']:0;
	
    }
	
	
}
?>
