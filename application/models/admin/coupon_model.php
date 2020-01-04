<?php
class Coupon_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function changeDtFrmat($date)
	{
		$oldDate = $date;
		$arr = @explode('/', $oldDate);
		return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
		
		
	}
	
	public function CalDispDtFrmat($date)
	{
		$oldDate = $date;
		$arr = explode('-', $oldDate);
		return $newDate = $arr[1].'/'.$arr[2].'/'.$arr[0];
	}
	
	public function add_coupon($fromData)
	{
		
		$local_admin_id 		= $this->session->userdata('local_admin_id');
		$coupon_type 			= $fromData['coupon_type'];
		
		
		if($coupon_type == 1)
		{
			$discount_amnt_setting 	= ($fromData['discount_amnt_setting'] != "")?$fromData['discount_amnt_setting']:1;
			$discount_amnt 			= ($fromData['discount_amnt'] != "")?$fromData['discount_amnt']:0;
			$mode 					=  $fromData['submit_coupon_mode'];
		}
		else
		{
			$discount_amnt_setting 	= 0;
			$discount_amnt 	        = 0;
			$mode 					=  $fromData['submit_offer_mode'];
		}
		
		$coupon_heading 		= ($fromData['coupon_heading'] != "")?$fromData['coupon_heading']:"";
		$coupon_desc 			= ($fromData['coupon_desc'] != "")?$fromData['coupon_desc']:"";
		$coupon_img_url 		= ($fromData['coupon_img_url'] != "")?$fromData['coupon_img_url']:"";
		
		$coupon_code 			= $fromData['coupon_code'];
		
		$autopromo_radio = $fromData['autopromo_radio'];  //////////////////   IS for autopromotion or not
		
		if($autopromo_radio == 0){
		
			$coupon_works_over 		= ($fromData['coupon_works_over'] != "")?$fromData['coupon_works_over']:0;
			
			
			$serviceUlCounter 		= $fromData['serviceUlCounter'];
			$applicbl_services_forArr = array();
			for($i=1; $i<=$serviceUlCounter; $i++)
			{
				if(array_key_exists("applicbl_services_for_".$i, $fromData))
				{
					$applicbl_services_forArr[] = $fromData["applicbl_services_for_".$i];
				}
			}
			if(count($applicbl_services_forArr) > 0) { $applicbl_services_for	= serialize($applicbl_services_forArr); }
			else { $applicbl_services_for 	= 0; }
			
			
			$empUlCounter 			= $fromData['empUlCounter'];
			$aplcbl_empArr			= array();
			for($j=1; $j<=$empUlCounter; $j++)
			{
				if(array_key_exists("aplcbl_emp_".$j, $fromData))
				{
					$aplcbl_empArr[] = $fromData["aplcbl_emp_".$j];
				}
			}
			if(count($aplcbl_empArr) > 0) { $aplcbl_emp	= serialize($aplcbl_empArr); }
			else { $aplcbl_emp = 0; }
			
			$aplcbl_date_from 			= ($fromData['aplcbl_date_from'] != "")? $this->changeDtFrmat($fromData['aplcbl_date_from']):0;
			$aplcbl_date_to 			= ($fromData['aplcbl_date_to'] != "")? $this->changeDtFrmat($fromData['aplcbl_date_to']):0;
			
			$aplcbl_hour_from 			= ($fromData['aplcbl_hour_from'] != "")?$fromData['aplcbl_hour_from']:0;
			$aplcbl_hour_to 			= ($fromData['aplcbl_hour_to'] != "")?$fromData['aplcbl_hour_to']:0;
			
			$aplcbl_days_on_weekArr		= array();
			for($k=1; $k<=7; $k++)
			{
				if(array_key_exists("aplcbl_days_on_week_".$k, $fromData))
				{
					$aplcbl_days_on_weekArr[] = $fromData["aplcbl_days_on_week_".$k];
				}
			}
			
			if(count($aplcbl_days_on_weekArr) > 0) { $aplcbl_days_on_week	= serialize($aplcbl_days_on_weekArr); }
			else { $aplcbl_days_on_week = 0; }
			
			
			if($coupon_type == 1)
			{
				$first_time_use_only 	= isset($fromData['first_time_use_only'])?$fromData['first_time_use_only']:0;
				$one_time_use_only 		= isset($fromData['one_time_use_only'])?$fromData['one_time_use_only']:0;
			}
			else
			{
				$first_time_use_only 	= isset($fromData['first_time_use_only_offer'])?$fromData['first_time_use_only_offer']:0;
				$one_time_use_only 		= isset($fromData['one_time_use_only_offer'])?$fromData['one_time_use_only_offer']:0;
			}
			$no_of_booking_possible = isset($fromData['no_of_booking_possible'])?$fromData['no_of_booking_possible']:0;
		
		
		$date_of_creation 		= date('Y-m-d');
	
		$data = array(
				'local_admin_id' 			=> $local_admin_id,
				'coupon_type' 				=> $coupon_type,
				'discount_amnt_setting' 	=> $discount_amnt_setting,
				'discount_amnt' 			=> $discount_amnt,
				'coupon_heading' 			=> $coupon_heading,
				'coupon_desc' 				=> $coupon_desc,
				'coupon_img_url' 			=> $coupon_img_url,
				'coupon_works_over' 		=> $coupon_works_over,
				'applicbl_services_for' 	=> $applicbl_services_for,
				'aplcbl_emp' 				=> $aplcbl_emp,
				//'aplcbl_date_from' 			=> ($aplcbl_date_from != "0")?$this->global_mod->gmtTimeReturn($aplcbl_date_from):'0',
				//'aplcbl_date_to' 			=> ($aplcbl_date_to != "0")?$this->global_mod->gmtTimeReturn($aplcbl_date_to):'0',
				'aplcbl_date_from' 			=> $aplcbl_date_from,
				'aplcbl_date_to' 			=> $aplcbl_date_to,
				'aplcbl_hour_from' 			=> $aplcbl_hour_from,
				'aplcbl_hour_to' 			=> $aplcbl_hour_to,
				'aplcbl_days_on_week' 		=> $aplcbl_days_on_week,
				'coupon_code' 				=> $coupon_code,
				'first_time_use_only' 		=> $first_time_use_only,
				'one_time_use_only' 		=> $one_time_use_only,
				'no_of_booking_possible'	=> $no_of_booking_possible,
				'date_of_creation'			=> $date_of_creation,
				'status' 					=> 1,
				'acitive'					=> 1,
				'is_autoPromo'				=> $autopromo_radio
			);
		}
		else{
			
			$date_of_creation 		= date('Y-m-d');
			
			$data = array(
				'local_admin_id' 			=> $local_admin_id,
				'coupon_type' 				=> $coupon_type,
				'discount_amnt_setting' 	=> $discount_amnt_setting,
				'discount_amnt' 			=> $discount_amnt,
				'coupon_heading' 			=> $coupon_heading,
				'coupon_desc' 				=> $coupon_desc,
				'coupon_img_url' 			=> $coupon_img_url,
				'coupon_works_over' 		=> 0,
				'applicbl_services_for' 	=> 0,
				'aplcbl_emp' 				=> 0,
				//'aplcbl_date_from' 			=> ($aplcbl_date_from != "0")?$this->global_mod->gmtTimeReturn($aplcbl_date_from):'0',
				//'aplcbl_date_to' 			=> ($aplcbl_date_to != "0")?$this->global_mod->gmtTimeReturn($aplcbl_date_to):'0',
				'aplcbl_date_from' 			=> 0,
				'aplcbl_date_to' 			=> 0,
				'aplcbl_hour_from' 			=> 0,
				'aplcbl_hour_to' 			=> 0,
				'aplcbl_days_on_week' 		=> 0,
				'coupon_code' 				=> $coupon_code,
				'first_time_use_only' 		=> 0,
				'one_time_use_only' 		=> 0,
				'no_of_booking_possible'	=> 0,
				'date_of_creation'			=> $date_of_creation,
				'status' 					=> 1,
				'acitive'					=> 1,
				'is_autoPromo'				=> $autopromo_radio
			);
			
			
		}
			$data = $this->global_mod->db_parse($data);
			
			$coupon_codeExistChk = $this->couponexistCheck($coupon_code);
			if($mode =="add"){			
				if($coupon_codeExistChk == 1)
				{
					$this->db->trans_begin();
					$this->db->insert('app_coupon',$this->db->escape($data));	

					$this->db->where('coupon_id', $fromData['coupon_id']);
					$this->db->update('app_coupon',$this->db->escape($data));

					
					$this->db->last_query();
					
					if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
					}
					else
					{
						$this->db->trans_commit();
					}
					$Msg = $this->lang->line('data_insrtd_success');
				}
				else
				{
					$Msg = "<span style='color:#F00;'>".$this->lang->line('cpn_code_alrdy_exist')."</span>";
				}
			}
			elseif($mode =="edit"){
				
				$this->db->where('coupon_id', trim($fromData['coupon_id']));
				$this->db->update('app_coupon',$data);	
				
				$Msg = $this->lang->line('data_insrtd_success');
				
			}
			return $Msg;

	}
	public function edit_coupon($coupon_id)
	{		
		$this->db->select('*');
		$this->db->from('app_coupon');
		$this->db->where('coupon_id', $coupon_id);
		$query = $this->db->get();
		$NumRows =  $query->num_rows();
		if($NumRows == 0)
		{
			return 0;
		}
		else
		{
		
		
			$result= $query ->result_array();
			$data = array(
				'coupon_id' 				=> $coupon_id,
				'local_admin_id' 			=> $result[0]['local_admin_id'],
				'coupon_type' 				=> $result[0]['coupon_type'],
				'discount_amnt_setting' 	=> $result[0]['discount_amnt_setting'],
				'discount_amnt' 			=> $result[0]['discount_amnt'],
				'coupon_heading' 			=> $result[0]['coupon_heading'],
				'coupon_desc' 				=> $result[0]['coupon_desc'],
				'coupon_img_url' 			=> $result[0]['coupon_img_url'],
				'coupon_works_over' 		=> $result[0]['coupon_works_over'],
				
				'applicbl_services_for' 	=> $this->fieldValue($result[0]['applicbl_services_for']),
				'aplcbl_emp' 				=> $this->fieldValue($result[0]['aplcbl_emp']),				
				'aplcbl_date_from' 			=> date("m/d/y" ,strtotime( $result[0]['aplcbl_date_from'])),
				'aplcbl_date_to' 			=> date("m/d/y" ,strtotime( $result[0]['aplcbl_date_to'])),
				'aplcbl_hour_from' 			=> $result[0]['aplcbl_hour_from'],
				'aplcbl_hour_to' 			=> $result[0]['aplcbl_hour_to'],
				'aplcbl_days_on_week' 		=> $this->fieldValue($result[0]['aplcbl_days_on_week']),
				'coupon_code' 				=> $result[0]['coupon_code'],
				'first_time_use_only' 		=> $result[0]['first_time_use_only'],
				'one_time_use_only' 		=> $result[0]['one_time_use_only'],
				'no_of_booking_possible'	=> $result[0]['no_of_booking_possible'],
				'date_of_creation'			=> $result[0]['date_of_creation'],
				'date_modify' 				=> $result[0]['date_modify'],
				'status' 					=> 1,
				'acitive'					=> 1,
				'is_autoPromo'				=> $result[0]['is_autoPromo']
			);
		}
		return $data;		
	}
	public function fieldValue($field)
	{
		if($field=='0'){
			$field=$field;	
		}
		else{
			$field=unserialize($field);	
		}
		return $field;
	}
	public function RandomCouponCodeGenaration($type)
	{
			$RandString = "";
			for($i=0; $i<=3; $i++)
			{
				$RandString .=  chr(97 + mt_rand(0, 25));
				$RandString .=  mt_rand(0, 9);
			}
			$query = $this->db->query('SELECT max(coupon_id) as max_id FROM app_coupon WHERE 1');
			$row = $query->row_array();
			$max_id = $row['max_id'] + 1; 
			$max_id = $max_id."S0";
			if($type == 1) {$RandString = "D".$max_id.$RandString;}
			if($type == 2) {$RandString = "O".$max_id.$RandString;}
			
			return $RandString;
	}
	
	
	public function couponexistCheck($code)
	{
		$this->db->select('coupon_id');
		$this->db->from('app_coupon');
		$this->db->where('coupon_code', $code);
		$query = $this->db->get();
		$NumRows =  $query->num_rows();
		if($NumRows == 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	
	public function fetchServiceName($SerId)
	{
		$this->db->select('service_name');
		$this->db->from('app_service');
		$this->db->where('service_id', $SerId);
		$query = $this->db->get();
		$ResArr =  $query->result_array();
		return $serName = @$ResArr[0]['service_name'];
	}
	
	
	
	
	
	
	
	
	public function fetchEmployeName($empId)
	{
		$this->db->select('employee_name');
		$this->db->from('app_employee');
		$this->db->where('employee_id', $empId);
		$query = $this->db->get();
		$ResArr =  $query->result_array();
		
		return $serName = @$ResArr[0]['employee_name'];
	}
	
	
	public function fetchWkDsName($dayId)
	{
		$daysArr = array();
		$daysArr[1] = "Sunday";
		$daysArr[2] = "Monday";
		$daysArr[3] = "Tuesday";
		$daysArr[4] = "Wednesday";
		$daysArr[5] = "Thursday";
		$daysArr[6] = "Friday";
		$daysArr[7] = "Saturday";
		return $daysArr[$dayId];
	}
	
	public function getAllCoupn()
	{
		$this->db->select('*');
		$this->db->from('app_coupon');
		//$this->db->where('status', '1'); 
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
                $this->db->order_by("coupon_id", "desc");
		$query = $this->db->get();
               
		$CouponArray =  $query->result_array();
		
		$CouponArrNum = 0;
		foreach($CouponArray as $val)
		{
			$RetStringSer = "";
			$RetStringEmp = "";
			$RetStringWkDs = "";
			$applicbl_services_forArr = @unserialize($val['applicbl_services_for']);
			$aplcbl_empArr 			  = @unserialize($val['aplcbl_emp']);
			$aplcbl_days_on_weekArr   = @unserialize($val['aplcbl_days_on_week']);
			if(is_array($applicbl_services_forArr))
			{
			    //CB#SOG#12-11-2012#PR#S
			    $count_ser = count($applicbl_services_forArr);
				$iter = 1;
				foreach($applicbl_services_forArr as $serIdArr)
				{   if($count_ser != $iter)
				    {
						$RetStringSer .= $this->fetchServiceName($serIdArr)." , ";
					} else {
					    $RetStringSer .= $this->fetchServiceName($serIdArr);
					}
					$iter++;					
				}
				//CB#SOG#12-11-2012#PR#E
			}
			else
			{
				$RetStringSer = "All Services ";
			}
			if(is_array($aplcbl_empArr))   
			{
			     //CB#SOG#12-11-2012#PR#S
			    $count_emp = count($aplcbl_empArr);
				$iter = 1;
				foreach($aplcbl_empArr as $empIdArr)
				{
				    if($count_emp != $iter)
				    {
						$RetStringEmp .= $this->fetchEmployeName($empIdArr)." , ";
					} else {
					    $RetStringEmp .= $this->fetchEmployeName($empIdArr);
					}
					$iter++;					
				}
				 //CB#SOG#12-11-2012#PR#E
			}
			else
			{
				$RetStringEmp = "All Employees ";
			}
			
			if(is_array($aplcbl_days_on_weekArr))
			{
			     //CB#SOG#12-11-2012#PR#S
				$count_week = count($aplcbl_days_on_weekArr);
				$iter = 1;
				foreach($aplcbl_days_on_weekArr as $WkDsIdArr)
				{
				    if($count_week != $iter)
				    {
						$RetStringWkDs .= $this->fetchWkDsName($WkDsIdArr)." , ";
					} else {
					    $RetStringWkDs .= $this->fetchWkDsName($WkDsIdArr);
					}
				    
					
					$iter++;
				}
				 //CB#SOG#12-11-2012#PR#E
			}
			else
			{
				$RetStringWkDs = "All Days ";
			}
			
			
			$aplcbl_date_from = $val['aplcbl_date_from'];
			$aplcbl_date_to   = $val['aplcbl_date_to'];
			if($aplcbl_date_from == 0 || $aplcbl_date_from == "")
			{
				$dtFromString =  "Till";
			}
			else
			{
				$dtFromString =  "From ".$this->CalDispDtFrmat($aplcbl_date_from);
			}
			
			
			if($aplcbl_date_to == 0 || $aplcbl_date_to == "")
			{
				$dtToString =  "and onwards";
			}
			else
			{
				$dtToString =  "upto  ".$this->CalDispDtFrmat($aplcbl_date_to);
			}
			
			if(($aplcbl_date_to == 0 || $aplcbl_date_to == "") && ($aplcbl_date_from == 0 || $aplcbl_date_from == ""))
			{
				$dtFromString = "Any Dates";
				$dtToString =  "";
			}
			
			
			
			
			
			$aplcbl_hour_from = $val['aplcbl_hour_from'];
			$aplcbl_hour_to   = $val['aplcbl_hour_to'];
			if($aplcbl_hour_from == "00:00" || $aplcbl_hour_from == "")
			{
				$tmeFromString =  "Till";
			}
			else
			{
				$tmeFromString =  "From ".$aplcbl_hour_from;
			}
			
			
			if($aplcbl_hour_to == "00:00" || $aplcbl_hour_to == "")
			{
				$tmeToString =  "and onwards";
			}
			else
			{
				$tmeToString =  "upto  ".$aplcbl_hour_to;
			}
			
			if(($aplcbl_hour_to == "00:00" || $aplcbl_hour_to == "") && ($aplcbl_hour_from == "00:00" || $aplcbl_hour_from == ""))
			{
				$tmeFromString = "Any Time";
				$tmeToString =  "";
			}
			
			
			$CouponArray[$CouponArrNum]['EmployeesArrString'] = $RetStringEmp;
			$CouponArray[$CouponArrNum]['CouponArrString'] = $RetStringSer;
			$CouponArray[$CouponArrNum]['WeekDaysDisp'] = $RetStringWkDs;
			
			$CouponArray[$CouponArrNum]['DateBetweenDisp'] = $dtFromString." ".$dtToString;
			$CouponArray[$CouponArrNum]['TimeBetweenDisp'] = $tmeFromString." ".$tmeToString;
			
			$CouponArrNum++;
		}
		
		
		
		
		return $CouponArray;
	}
	
	
	
	public function delete_coupon($id)
	{
		$this->db->delete('app_coupon', array('coupon_id' => $id)); 
		return $this->db->affected_rows();
	}
	
	
	
	
	public function status_change($status, $id)
	{
		$data = array(
               'status' => $status
         );
		$this->db->where('coupon_id', $id);
		$this->db->update('app_coupon', $data);
		return $this->db->affected_rows();
	}
	function address()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$query = $this->db->query('
								  SELECT l.business_location,r.region_name,l.business_zip_code,c.city_name
								  FROM app_local_admin l,app_cities c,app_regions r 
								  WHERE l.business_city_id=c.city_id AND
								  		l.business_state_id=r.region_id  AND
										l.local_admin_id="'.$local_admin_id.'" 
								  
								  
								  
								  ');
		$row = $query->row_array();
		if($query->num_rows() >0)
		{
		
		$data = array(
						'business_location' 		=> $row['business_location'],
						'business_city_id' 			=> $row['city_name'],
						'region_name' 				=> $row['region_name'],
						'business_zip_code' 		=> $row['business_zip_code']
				);
		}
		else
		{
		
		$data = array(
						'business_location' 		=> "",
						'business_city_id' 			=> "",
						'region_name' 				=> "",
						'business_zip_code' 		=> ""
				);
		}
		return $data;
		
	}
	
	function showTextServices($json_servicesArr)
	{
		$data='';
		$counter=1;
		$len_json_servicesArr=count($json_servicesArr);
		$local_admin_id = $this->session->userdata('local_admin_id');
		foreach($json_servicesArr as $value)
		{
			$query = $this->db->query('
									  SELECT service_name
									  FROM app_service
									  WHERE service_id="'.$value.'"
									  ');
			$row = $query->row_array();
			$data[] =$row['service_name'];
		}
		return $data;
		
	}
	function showTextStaff($json_staffArr)
	{
		
		$data='';
		foreach($json_staffArr as $value)
		{
			$query = $this->db->query('
									  SELECT employee_name
									  FROM app_employee 
									  WHERE employee_id="'.$value.'"
									  ');
			$row = $query->row_array();
			$data[] =$row['employee_name'];
		}
		return $data;
		
	}
	
	
	
	public function getCoupnDetails($cuponId){
		$this->db->select('*');
		$this->db->from('app_coupon');
		$this->db->where('coupon_id', $cuponId); 
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
                $this->db->order_by("coupon_id", "desc");
		$query = $this->db->get();
               
		$CouponArray =  $query->result_array();
		
		return $CouponArray[0];
	}
	
	
}
?>




