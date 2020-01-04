<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_model extends CI_Model{
	function showAllCustomer(){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query("Select * from (
		SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c2.customer_id as customer_id ,
		c1.date_creation as date_inserted,
		c1.user_email as user_email,
		
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_fname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_lname
	   ,
	 ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_mob
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
       app_local_customer_details c2 
	   where c1.user_type ='1' and 
	         c1.user_id=c2.customer_id and
			 c2.local_admin_id  ='".$local_admin_id."'
   ) as maintable where 1=1");

		$list='';
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				
				
				$list.='<div  class="select-customer" onclick="selectCustomer('.$row->customer_id.')">';
				$list.='<table width="100%"><tr>';
				$list.='<td><span><font size="-6">'.$row->cus_fname.' </font></span>';
				$list.='<span>'.$row->cus_lname.'</span></td>';
				$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_mob.'</div></td>';
				if ($row->cus_mob =='')
				{
					$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_phn1.'</div></td>';
				}
				if ($row->cus_phn1 =='' && $row->cus_mob =='')
				{
					$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_phn2.'</div></td>';
				}
				$list.='</tr></table>';
				$list.='</div>';
			}
		
		}
		else
		{
			$list='';
		}
		
		return $list;
	}
	function showAllCustomerNameForSearch(){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query("select value,sign_upinfo_item_id from app_local_customer_details
	Where local_admin_id ='".$local_admin_id."' and sign_upinfo_item_id=2");
		$customer_name = array();
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				if ($row->sign_upinfo_item_id ==2)
				{
					array_push($customer_name,$row->value);
				}
			}
		}
		else
		{
			$customer_name='';
		}
		
		return $customer_name;
	}		
	function checkFieldstatus(){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$temp       	=0;
		$cus_fname  	=0;
		$cus_lname		=0;
		$user_email		=0;
		$cus_address	=0;
		$cus_mob		=0;
		$cus_city		=0;
		$cus_region		=0;
		$cus_country	=0;
		$cus_zip		=0;
		$cus_phn1		=0;
		$cus_phn2		=0;
		$time_zone_id	=0;
	
		$sql1=$this->db->query("select sign_upinfo_item_id from app_local_admin_gen_setting_clint_signup_info
	Where local_admin_id ='".$local_admin_id."' order by sign_upinfo_item_id");
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				
				if ($row->sign_upinfo_item_id ==2)
				{
					$cus_fname=1;
				}
				if ($row->sign_upinfo_item_id ==3)
				{
					$cus_lname=1;
				}
				if ($row->sign_upinfo_item_id ==4)
				{
					$cus_address=1;
				}
				if ($row->sign_upinfo_item_id ==7)
				{
					$cus_city=1;
				}
				
				if ($row->sign_upinfo_item_id ==6)
				{
					$cus_region=1;
				}
				if ($row->sign_upinfo_item_id ==5)
				{
					$cus_country=1;
				}
				if ($row->sign_upinfo_item_id ==8)
				{
					$cus_zip=1;
				}
				if ($row->sign_upinfo_item_id ==9)
				{
					$cus_mob=1;
				}
				if ($row->sign_upinfo_item_id ==10)
				{
					$cus_phn1=1;
				}
				if ($row->sign_upinfo_item_id ==11)
				{
					$cus_phn2=1;
				}
				if ($row->sign_upinfo_item_id ==21)
				{
					$time_zone_id=1;
				}
			
			}
			$checkFieldstatus_arr = array(
					
					   'cus_fname'                       => $cus_fname,
					   'cus_lname'                       => $cus_lname,
					   'cus_address'                     => $cus_address,
					   'cus_country'                     => $cus_country,
					   'cus_region'                      => $cus_region,
					   'cus_city'                        => $cus_city,
					   'cus_zip'                         => $cus_zip,
					   'cus_mob'                      	 => $cus_mob,
					   'cus_phn1'                      	 => $cus_phn1,
					   'cus_phn2'                      	 => $cus_phn2,
					   'time_zone'                       => $time_zone_id, 
			);
			
			return $checkFieldstatus_arr;
		}		
		else
		{
			$list='';
		}
	
	}	
	function checkFieldExistance($local_admin_id,$customer_id,$sign_upinfo_item_id){
		$sql=$this->db->query("select value from app_local_customer_details
		Where local_admin_id ='".$local_admin_id."' AND customer_id ='".$customer_id."' AND 
		sign_upinfo_item_id = '".$sign_upinfo_item_id."'");
		if ($sql->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function customerAdd($insert_list){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');   
		
		if($insert_list['customer_id']!=0)
		{
		
			$customer_id=$insert_list['customer_id'];
			$user_email =$insert_list['user_email'];
			$data = array(
			'user_email' => $user_email,
			);
			$data = $this->global_mod->db_parse($data);
			$this->db->trans_begin();
			$this->db->where('user_id',$customer_id);
			$this->db->where('user_type',1);
			$this->db->update('app_password_manager', $data);
			
			if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
			else
				{
					$this->db->trans_commit();
				} 
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->where('customer_id', $customer_id);
			$this->db->where('sign_upinfo_item_id !=',19);
			$this->db->where('sign_upinfo_item_id !=',20);
			$this->db->delete('app_local_customer_details'); 
		}
		else
		{
			$insert_app_password_manager = array(
						   'user_type'          => 1,
						   'user_name'          => uniqid('un_'),
						   'password'           => uniqid('pass_'),
						   'user_email'         => $insert_list['user_email'],
						   'date_creation'      => date("Y/m/d"),
						   'date_modified'      => date("Y/m/d")
			);
			$insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
			$this->db->trans_begin();
			$this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
			$customer_id=$this->db->insert_id();
				
			if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
			else
				{
					$this->db->trans_commit();
					
				} 
		}
		foreach($insert_list as $key => $value)  //for each field
		{
			$result = explode('_',$key);
			$len=count($result);
			$sign_upinfo_item_id=$result[$len-1];
			
			if(is_numeric($sign_upinfo_item_id) && $value!='' )
			{
				$insert_app_local_customer_details = array(
					   'local_admin_id'          => $local_admin_id,
					   'sign_upinfo_item_id'     => $sign_upinfo_item_id,
					   'customer_id'             => $customer_id,
					   'value'                   => $value,
					   'date_inserted'           => date("Y/m/d"),
					   'date_edited'             => date("Y/m/d")
				);
				$insert_app_local_customer_details = $this->global_mod->db_parse($insert_app_local_customer_details);
				$this->db->trans_begin();
				$this->db->insert('app_local_customer_details',$this->db->escape($insert_app_local_customer_details));
							
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
				else
				{
					$this->db->trans_commit();
				} 
			}
		}
		return "Successfully Inserted";
	}
	function inviteCustomer($customer_id){
	$this->load->database();
	$local_admin_id = $this->session->userdata('local_admin_id');
	$cus_fname='';
	$cus_lname='';
	$query=$this->db->query("select user_email from app_password_manager Where user_id ='".$customer_id."' and  user_type ='1'");
	$row= $query->row();
	$email=$row->user_email;
	$query1=$this->db->query("select sign_upinfo_item_id,value from app_local_customer_details Where local_admin_id ='".$local_admin_id."' and customer_id ='".$customer_id."' and (sign_upinfo_item_id ='2' or sign_upinfo_item_id ='3') ");
	foreach ($query1->result() as $row1)
		{
			if ($row1->sign_upinfo_item_id ==2)
			{
				$cus_fname=$row1->value;
			}
			
			if ($row1->sign_upinfo_item_id ==3)
			{
				$cus_lname= $row1->value;
			}
		}
	$user_data = array( 
			"user_email" => $email , 
			"cus_fname"	 => $cus_fname,
			"cus_lname"	 => $cus_lname
			);
	
	return $user_data;
	}
	function test(){
		return $this->checkFieldExistance(1,5,3);  
		//$this->checkFieldExistance($local_admin_id,$row->customer_id,$row->sign_upinfo_item_id);
	}	
	function country($customer_id=''){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		
		foreach ($sql->result() as $row)
		{
		$country_name_id=$row->country_id;
		}
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		if($customer_id !='')
		{
			$query=$this->db->query("SELECT value from app_local_customer_details where local_admin_id='".$local_admin_id."' and sign_upinfo_item_id='5' and customer_id='".$customer_id."'");
			if ($query->num_rows() > 0)
			{
				$row1 = $query->row();		
				$country_name_id=$row1->value;
			}
			else
			{
				$country_name_id="";
			}
		}
		else
		{
	
			$query=$this->db->query("SELECT country_id from app_local_admin where local_admin_id='".$local_admin_id."'");
			$row1 = $query->row();		
			$country_name_id=$row1->country_id;
		}
		
		$country='<select name="country_id" id="cus_countryid_5_info" class="text-input required" onfocus="clr_reg_values()" onChange="country_status(this.value)" style=" width:42%;">
		<option value="" >----Select Country---</option>';
		$this->load->database();
		$sql=$this->db->query("SELECT * from app_countries");
		foreach ($sql->result() as $row)
		{
		   $country_name=$row->country_name;
		   $country_id=$row->country_id;
		   if($country_id==$country_name_id)
			{
				$country_id_selected="selected";
			}
			else
			{
				$country_id_selected="";
			}
		   $country.="<option value=".$country_id." ".$country_id_selected.">".$country_name."</option>";
		}
		
		$country.='</select>';	
		return $country;		
	}
	function region($customer_id=''){
		
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		if($customer_id !='')
		{
		$query=$this->db->query("SELECT value from app_local_customer_details 
		where local_admin_id='".$local_admin_id."' and
		sign_upinfo_item_id='6' and
		customer_id='".$customer_id."'
		");
			if ($query->num_rows() > 0)
			{
				$row1 = $query->row();		
				$region_name_id=$row1->value;
			}
			else
			{
				$region_name_id="";
			}
		}
		else
		{
			$query=$this->db->query("SELECT region_id from app_local_admin where local_admin_id='".$local_admin_id."'");
			$row1 = $query->row();		
			$region_name_id=$row1->region_id;
		}
		
		$region='<select name="region_id" id="cus_regionid_6_info" onChange="region_status(this.value)" onfocus="clr_reg_values()" class="required" style=" width:42%;">
		<option value="">---Select Region---</option>';
		
		$query_con=$this->db->query("SELECT value from app_local_customer_details 
		where local_admin_id='".$local_admin_id."' and
		sign_upinfo_item_id='5' and
		customer_id='".$customer_id."'
		");
		
		$cus_country = $query_con->row();
		$cus_country_id = $cus_country->value;
		//echo '<pre>';print_r($cus_country_id);exit;

		
		
		
		
		$sql=$this->db->query("SELECT * from app_regions where country_id =".$cus_country_id." ");
		foreach ($sql->result() as $row)
		{
			$region_name=$row->region_name;
			$region_id=$row->region_id;
			if($region_id==$region_name_id)
			{
				$region_id_selected="selected";
			}
			else
			{
				$region_id_selected="";
			}
			$region.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";
			
		}
		
		$region.='</select>';	
		return $region;		
	}
	function changeregion($customer_id){
		$this->load->database();
		$region='
		<option value="">---Select Region---</option>';
		
		$sql=$this->db->query("SELECT * from app_regions where country_id = ".$customer_id);
		foreach ($sql->result() as $row)
		{
			$region_name=$row->region_name;
			$region_id=$row->region_id;			
			$region.="<option value=".$region_id.">".$region_name."</option>";
			
		}		
		
		return $region;	
	}
	function changecity($c_id){
		
		$this->load->database();
		$city='<option value="">---Select Region---</option>';
		
		$sql=$this->db->query("SELECT * from app_cities where region_id = ".$c_id);
		foreach ($sql->result() as $row)
		{
			$city_name=$row->city_name;
			$city_id=$row->city_id;			
			$city.="<option value=".$city_id.">".$city_name."</option>";
			
		}		
		//echo '<pre>';print_r($city);exit;
		return $city;	
	}
	function city($customer_id=''){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		if($customer_id !='')
		{
			$query=$this->db->query("SELECT value from app_local_customer_details 
			where local_admin_id='".$local_admin_id."' and
				  sign_upinfo_item_id='7' and
				  customer_id='".$customer_id."'
			
			");
			if ($query->num_rows() > 0)
			{
				$row1 = $query->row();		
				$city_name_id=$row1->value;
			}
			else
			{
				$city_name_id="";
			}
		}
		else
		{
			$query=$this->db->query("SELECT city_id from app_local_admin where local_admin_id='".$local_admin_id."'");
			$row1 = $query->row();		
			$city_name_id=$row1->city_id;
		}
		$city = "";
		$city.='<select name="city_id" id="cus_cityid_7_info" class="required"  onChange="city_status(this.value)"  onfocus="clr_reg_values()"style="width:42%; margin:0 5px 4px 0;">
		<option value="">-----Select City-----</option>';
		
		$query_con=$this->db->query("SELECT value from app_local_customer_details 
		where local_admin_id='".$local_admin_id."' and
		sign_upinfo_item_id IN('5','6') and
		customer_id='".$customer_id."'
		");
		
		$cus_result = $query_con->result();		
		//echo '<pre>';
		//print_r($cus_result);
		//echo '</pre>';
		//exit;
		
		
		$cus_country_id = $cus_result[0]->value; //
		$cus_region_id = $cus_result[1]->value; //
		
		
				 
				
		 $sql=$this->db->query("SELECT * from app_cities where country_id = ".$cus_country_id." AND region_id = ".$cus_region_id);
		 foreach ($sql->result() as $row)
			{
				   $city_name=$row->city_name;
				   $city_id=$row->city_id;
					if($city_id==$city_name_id)
						{
							$city_id_selected="selected";
						}
						else
						{
							$city_id_selected="";
						}
				   $city.="<option value=".$city_id." ".$city_id_selected.">".$city_name."</option>";
			}
		$city.='</select>';	
		return $city;		
	}
	//CB#SOG#22-11-2012#PR#S
	function displayAppointments($output,$customer_id){
		 
		 $checkFieldstatus = $this->checkFieldstatus();
		 //echo '<pre>';print_r($checkFieldstatus);exit;
		 $result = explode('@@@',$output);
		 
		 
		 
		 // echo '<pre>';print_r($output);exit;
		  //echo '<pre>';print_r($result);exit;
		$this->db->select('password');
		$this->db->from('app_password_manager');
		$this->db->where('user_id',$customer_id);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();		
        //echo '<pre>';print_r($Ret_Arr_val[0]['password']);exit;
		$password = $Ret_Arr_val[0]['password'];
		  
		 
		 $html = '';
		 $html.='<div>    
					<div class="myinfo-div">
						<div id="new_user" style="padding:10px 0px 10px 50px;"> 
							 <form name="f1" id="f1info" method="post" action="">
							  <table width="100%" cellpadding="0" cellspacing="0" border="0">';
							  if($checkFieldstatus['cus_fname'] == 1 ){
								$html.='<tr>
										 <td valign="top" width="20%">
										 First Name:
										 </td>
										 <td>						
							 <input type="text" id="cus_fname_2_in" onfocus="clr_values(this);"  value="'.$result[0].'"  class="required" style="float:left; width:40%; margin:0 5px 4px 0;" />
							<span id="cus_fname_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;"></span>
										
										   </td>
									   </tr>';
								} 
							 if($checkFieldstatus['cus_lname'] == 1 ){
								 
								 $html.='  <tr>
											 <td valign="top" width="20%">
											 Last Name:
											 </td>
											 <td>					
						
								 <input type="text" id="cus_lname_3_in"  value="'.$result[1].'" class="required" onfocus="clr_values(this);"  style="float:left; width:38%; margin:0 5px 4px 0;"/>
								 <span id="cus_lname_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;"> </span>
								  
								
								   </td>
							   </tr>  ';
							 }
							 
							 $html.='<tr>
									 <td valign="top">
									 Email
									 </td>
									 <td>
										<input type="text" value="'.$result[2].'" id="user_email_my_info_in"  class="required" onfocus="clr_values(this);" style="width:40%" />  
									 <span id="user_email_p_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;"></span>
									 </td>
								 </tr> 	 ';
							if($checkFieldstatus['cus_mob'] == 1){
								 $html.=' <tr>
										 <td valign="top">
										 Mobile
										 </td>
										 <td>
										 <input type="text" onfocus="clr_values(this);" id="cus_mob_9_in" value="'.$result[9].'" />
										 <span id="cus_phn1_10_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;"></span>
										 </td>
									 </tr>';							
							}
							if($checkFieldstatus['cus_phn1'] == 1){
								 $html.='
								  <tr>
									 <td valign="top">
									 Phone1
									 </td>
									 <td>
									 <input type="text" onfocus="clr_values(this);" id="cus_phn1_10_in" value="'.$result[10].'" />
									 <span id="cus_phn1_11_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;" ></span>
									 </td>
								 </tr>
								 ';
							}
							if($checkFieldstatus['cus_phn2'] == 1){
								$html.='<tr>
											 <td valign="top">
											 Phone2
											 </td>
											 <td>
											 <input type="text" onfocus="clr_values(this);" id="cus_phn2_11_in" value="'.$result[11].'" />
											 <span id="cus_phn1_12_div" class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;"></span>
											 </td>
										 </tr>';
								
							}
							if($checkFieldstatus['cus_address'] == 1){
								$html.='<tr>			
											 <td valign="top">
											 Address:
											 </td>
											 <td>
											 <textarea id="cus_address_4_in" onfocus="clr_values(this);" >'.$result[4].'</textarea>
											 <span id="cus_address_4_div" class="required_div" style="display: block; opacity: 1; right: -287px;font-size:11px;" >
											 </span>
											 </td>
										 </tr>';
							}
							//if($checkFieldstatus['cus_country'] == 1){ 
							    $html.=' <tr>			
										 <td valign="top">
										 Country
										 </td>
										 <td valign="top">
										'.$result[15].'
										 <span id="cus_countryid_5_div" class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;"></span>
										 </td>
									 </tr>';
										
							//}
							/*if($checkFieldstatus['cus_region'] == 1){*/
								$html.=' <tr>
									 <td valign="top">Region1</td>
									 <td>
									'.$result[16].'
				<span id="cus_regionid_6_div" class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;"></span>
									 </td>
								 </tr>';
							/*}*/
							/*if($checkFieldstatus['cus_city'] == 1){*/
								$html.=' <tr>
											 <td valign="top">City</td>
											 <td >
											 '.$result[17].'
					<span id="cus_cityid_7_div"  class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;"></span>
											 </td>
										  </tr>	';
							/*}*/
							/*if($checkFieldstatus['cus_zip'] == 1){*/
								$html.='   <tr>
								  <td valign="top">
								  Zip
								  </td>
								  <td>  <input type="text" id="cus_zip_8_in" onfocus="clr_values(this);" value="'.$result[8].'"  style="float:left; width:37%; margin:0 5px 4px 0;" />
								   <span id="cus_zip_8_div" class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;" ></span>
								   </td>					  
								  </tr>
										';
							/*} */
							/*
							if($checkFieldstatus['time_zone'] == 1){
								$html.='  <tr>			
											 <td >Time Zone
											 </td>
											 <td>											     
											<input type="text" id="time_zone_id_21_in"  value="'.$result[12].'"  style="float:left; width:37%; margin:0 5px 4px 0;" /> 
											 </td>
										  </tr>';
							}*/
							if($checkFieldstatus['time_zone'] == 1){
								$html.='  <tr>			
											 <td >Time Zone
											 </td>
											 <td>											     
											 '.$this->get_timezone($result[12]).'
											 <span id="cus_time_zone_div" class="required_div" style="color:#CC0000;display: block; opacity: 1; right: -287px;font-size:11px;"></span>
											 </td>
										  </tr>';
							}
							
						  $html.='         <tr>			
											 <td>Password
											 </td>
											  <td > 											 
			   <input id="cus_pass_word" readonly="readonly" type="password" style="float:left; width:37%; margin:0 5px 4px 0;border: 1px solid #CCCCCC !important;" value="'.$password.'">
											  
										  </tr>';
						  $html.='         <tr>			
											 <td> New Password
											 </td>
							 <td > <input type="password" style="float:left; width:37%; margin:0 5px 4px 0;border: 1px solid #CCCCCC !important;" onfocus="clr_values(this);" id="cus_new_pass_word" value="" />
											  <span id="cus_new_pass_word_div" class="required_div" ></span> </td>
										  </tr>';
						   $html.='         <tr>			
											 <td> Confirm New Password
											 </td>
							 <td > <input type="password" style="float:left; width:37%; margin:0 5px 4px 0;border: 1px solid #CCCCCC !important;" onfocus="clr_values(this);" id="cus_conf_pass_word" value="" />
											  <span id="cus_conf_pass_word_div" class="required_div" ></span> </td>
										  </tr>';
							
							  $html.='</table>
							
							 <div style="margin:15px 0 0 170px;">
							 <span style="margin:15px 15px 0 -120px;">
							  <a onclick="delete_this_customer('.$this->session->userdata('user_id_customer').')" href="javascript:void(0);">Delete this Account</a>
							</span>
								 <span id="edit_cus_btn"> 
									<input type="button"   value="Update"  onclick="updateCustomer()" class="btn-blue" />
								 </span>
								
								  <input type="button" value="Cancel" class="closeModalBox btn-gray" href="javascript:void(0)" />
								  <input type="hidden" name="customer_id" id="customer_id" value="'.$this->session->userdata('user_id_customer').'" />
							  </div>
							  <!--onclick="hideAddCustomer()" -->
							  
							 </form>
						</div>
					</div>
               
                  </div>				 
				 ';
				 return $html;
				 //print($html);exit;
		 
	}
	//CB#SOG#22-11-2012#PR#E
	function get_timezone($sel_id){
		$this->load->database();		
		$time_zone='<select name="time_zone_id" id="time_zone_id_21_in" onChange="timezone_status_chan_ge()" class="text-input required" style="background-color:#FFFFCC;border:1px solid #3366FF;">
					  <option value="" >----------------Select Timezone----------------</option>';
		$this->load->database();
		$a=$this->db->query("SELECT * from app_time_zone");
		
		foreach ($a->result() as $row)
		{
			$time_zone_id=$row->time_zone_id;
			$time_zone_name=$row->time_zone_name;
			if($time_zone_id==$sel_id)
			{
				$time_zone_id_selected="selected";
			}
			else
			{
				$time_zone_id_selected="";
			}  
			$time_zone.="<option value=". $time_zone_id." ".$time_zone_id_selected.">".$time_zone_name."</option>";
		}
		$time_zone.='</select>';	
		return $time_zone;	
		
		
	}
	function time_Zone(){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row1 = $sql->row();
		$time_zone_name_id=$row1->time_zone_id;		
		$time_zone='<select name="time_zone_id" id="time_zone_id_21" class="text-input required" style="background-color:#FFFFCC;border:1px solid #3366FF;">
					  <option value="" >----------------Select Timezone----------------</option>';
		$this->load->database();
		$a=$this->db->query("SELECT * from app_time_zone");		
		foreach ($a->result() as $row)
		{
			$time_zone_id=$row->time_zone_id;
			$time_zone_name=$row->time_zone_name;
			if($time_zone_id==$time_zone_name_id)
			{
				$time_zone_id_selected="selected";
			}
			else
			{
				$time_zone_id_selected="";
			}  
			$time_zone.="<option value=". $time_zone_id." ".$time_zone_id_selected.">".
			$time_zone_name."</option>";
		}
		$time_zone.='</select>';	
		return $time_zone;	
	}		
	function selectCustomer($customer_id){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query(" Select * from (
		 SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c1.date_creation as date_inserted,
		c3.country_name as country_name,
		c4.city_name as city_name,
		c5.region_name as region_name,
		c1.user_email as user_email,
		
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_fname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_lname
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_address
	  
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
       ) AS cus_mob
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
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_info'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_info
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'time_zone_id'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS time_zone_id
  FROM app_customer_admin_relationship c6, app_password_manager c1 INNER JOIN
       app_local_customer_details c2 LEFT JOIN
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
                 c1.user_id=c6.customer_id AND
			 c6.local_admin_id  ='".$local_admin_id."' and
			 c2.customer_id='".$customer_id."'
		
	   ) as maintable where 1=1");
		
		$cus_fname='';
		$cus_lname='';
		$user_email='';
		$cus_address='';
		$cus_mob='';
		$cus_phn1='';
		$cus_phn2='';
		$cus_city='';
		$cus_region='';
		$cus_country='';
		$cus_zip='';
		$time_zone='';
		$customer_tag='';
		$customer_info=''; 
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				
				$cus_fname=$row->cus_fname ;
				$cus_lname=$row->cus_lname;
				$cus_address=$row->cus_address;
				$cus_city=$row->city_name;
				if ($row->region_name !='')
				{
					$cus_region=','.$row->region_name;
				}
				if ($row->country_name !='')
				{
					$cus_country=','.$row->country_name;
				}
				if ($row->customer_zip !='')
				{
					$cus_zip='('.$row->customer_zip.')';
				}
				$cus_mob=$row->cus_mob;
				$cus_phn1=$row->cus_phn1;
				$cus_phn2=$row->cus_phn2;
				$customer_tag=$row->customer_tag;
				$customer_info=$row->customer_info;
				$time_zone=$row->time_zone_id;
				$user_email=$row->user_email;
			}
			$link='[<a href="javascript:void(0);" onclick="inviteCustomer('.$customer_id.')">Invite to schedule online</a>&nbsp|&nbsp;
			<a href="javascript:void(0);" onclick="displayEditCustomer('.$customer_id.')">Edit Customer </a>&nbsp|&nbsp;
			<a href="javascript:void(0);" onclick="deleteCustomer('.$customer_id.')">Delete Customer </a>]';
			
			$list=$cus_fname.'@@@'.$cus_lname.'@@@'.$user_email.'@@@'.$link.'@@@'.$cus_address.'@@@'.$cus_city.'@@@'.$cus_region.'@@@'.$cus_country.'@@@'.$cus_zip.'@@@'.$cus_mob.'@@@'.$cus_phn1.'@@@'.$cus_phn2.'@@@'.$time_zone.'@@@'.$customer_tag.'@@@'.$customer_info;

		}
		else
		{
			$list='';
		}
		return $list;
	}
	function showDetailsForEditCustomer($customer_id){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query(" Select * from (
		 SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c1.date_creation as date_inserted,
		c3.country_name as country_name,
		c4.city_name as city_name,
		c5.region_name as region_name,
		c1.user_email as user_email,
		
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_fname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_lname
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_address
	  
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
       ) AS cus_mob
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
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_info'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_info
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'time_zone_id'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS time_zone_id
  FROM app_password_manager c1 INNER JOIN
       app_local_customer_details c2 LEFT JOIN
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
			 c2.local_admin_id  ='".$local_admin_id."' and
			 c2.customer_id='".$customer_id."'
		
	   ) as maintable where 1=1");
		
		$cus_fname='';
		$cus_lname='';
		$user_email='';
		$cus_address='';
		$cus_mob='';
		$cus_phn1='';
		$cus_phn2='';
		$cus_city='';
		$cus_region='';
		$cus_country='';
		$cus_zip='';
		$time_zone='';
		$customer_tag='';
		$customer_info='';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				
				$cus_fname=$row->cus_fname ;
				$cus_lname=$row->cus_lname;
				$cus_address=$row->cus_address;
				$cus_city=$row->city_name;
				if ($row->region_name !='')
				{
					$cus_region=','.$row->region_name;
				}
				if ($row->country_name !='')
				{
					$cus_country=','.$row->country_name;
				}
				if ($row->customer_zip !='')
				{
					$cus_zip=$row->customer_zip;
				}
				$cus_mob=$row->cus_mob;
				$cus_phn1=$row->cus_phn1;
				$cus_phn2=$row->cus_phn2;
				$customer_tag=$row->customer_tag;
				$customer_info=$row->customer_info;
				$time_zone=$row->time_zone_id;
				$user_email=$row->user_email;
			}
			$link='[<a href="javascript:void(0);" onclick="inviteCustomer('.$customer_id.')">Invite to schedule online</a>&nbsp|&nbsp;
			<a href="javascript:void(0);" onclick="displayEditCustomer('.$customer_id.')">Edit Customer </a>&nbsp|&nbsp;
			<a href="javascript:void(0);" onclick="deleteCustomer('.$customer_id.')">Delete Customer </a>]';
			
			$list=$cus_fname.'@@@'.$cus_lname.'@@@'.$user_email.'@@@'.$link.'@@@'.$cus_address.'@@@'.$cus_city.'@@@'.$cus_region.'@@@'.$cus_country.'@@@'.$cus_zip.'@@@'.$cus_mob.'@@@'.$cus_phn1.'@@@'.$cus_phn2.'@@@'.$time_zone.'@@@'.$customer_tag.'@@@'.$customer_info; 
			
		

		}
		else
		{
			$list='';
		}
		return $list;
	}
	function deleteCustomer($del_cus_id){ 
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->where('customer_id', $del_cus_id);
		$this->db->delete('app_local_customer_details'); 
		$this->db->where('user_id', $del_cus_id);
		$this->db->where('user_type',1);
		$this->db->delete('app_password_manager'); 
		return "Deleted successfully";
	}
	function region_ajax($country_id){
		$this->load->database();
		$str='';
		$query=$this->db->query("SELECT * from app_regions where country_id='$country_id'");
		if ($query->num_rows() > 0)
		{
			$str .='<option value="" >------------------Select Region------------------</option>';								 
			foreach ($query->result() as $row)
			{
				$region_id=$row->region_id;
				$region_name=$row->region_name;
				$str .='<option value="'.$region_id.'" >'.$region_name.'</option>';
			}	
			
			$str_city='<option value="" >-----Select City-----</option>';	 
			$str.='@@@'.$str_city;	
		}
		else
		{
			$str .='<option value="" >------------------Select Region------------------</option>';
			$str_city='<option value="" >-----Select City-----</option>';	 
			$str.='@@@'.$str_city;	
		}
		return $str;
	}
	function city_ajax($region_id){
		$this->load->database();
		$str ='';
		$a=$this->db->query("SELECT * from app_cities where region_id='$region_id'");
		$str .='<option value="" >-----Select City-----</option>';								 
		foreach ($a->result() as $row)
		{
			$city_id=$row->city_id;
			$city_name=$row->city_name;
			$str .='<option value="'.$city_id.'" >'.$city_name.'</option>';
		}		
		return $str;
	}
	function searchCustomer($cus_name_search){
		
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$list='';
		$cu='';
		$trimmed_cus_name_search = trim($cus_name_search);
	 	$qry = "Select * from (
		 SELECT distinct c1.user_id as  user_id,
        c2.local_admin_id as local_admin_id ,
		c2.customer_id as customer_id ,
		c1.date_creation as date_inserted,
		
		c1.user_email as user_email,
		
       ( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_fname

     ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_lname
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS cus_address
	  
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
       ) AS cus_mob
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
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_tag'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_tag
	   ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'customer_info'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS customer_info
	    ,( SELECT v1.value
           FROM app_local_customer_details v1 
           JOIN app_local_clint_signup_info a1
             ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'time_zone_id'
          WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
       ) AS time_zone_id
  FROM app_password_manager c1 INNER JOIN
       app_local_customer_details c2 
	   where c1.user_type ='1' and 
	         c1.user_id=c2.customer_id 
   ) as maintable where 1=1 AND  maintable.local_admin_id  ='1' and  maintable.cus_fname like '".$trimmed_cus_name_search."%'";
	
		$sql1=$this->db->query($qry);
		$list='';
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
				
				
				$list.='<div style="border-bottom:1px dashed #CCCCCC;height:40px;padding-left:10px;width:220px" onclick="selectCustomer('.$row->customer_id.')">';
				$list.='<table width="100%"><tr>';
				$list.='<td><span><font size="-6">'.$this->global_mod->show_to_control($row->cus_fname).' </font></span>';
				$list.='<span>'.$this->global_mod->show_to_control($row->cus_lname).'</span></td>';
				$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_mob.'</div></td>';
				if ($row->cus_mob =='')
				{
					$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_phn1.'</div></td>';
				}
				if ($row->cus_phn1 =='')
				{
					$list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_phn2.'</div></td>';
				}
				$list.='</tr></table>';
				$list.='</div>';
			}
		}
		else
		{
			$list='';
		}
	
		return $list;
	}
	function addTag($tag,$customer_id){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query("select value from app_local_customer_details
	Where local_admin_id ='".$local_admin_id."'and customer_id ='".$customer_id."' and sign_upinfo_item_id='19'");
		
		if ($sql1->num_rows() > 0)
		{
		    $data = array(
			'value' => $this->global_mod->db_parse($tag),
			);
			
			$this->db->trans_begin();
			$this->db->where('local_admin_id',$local_admin_id);
			$this->db->where('customer_id',$customer_id);
			$this->db->where('sign_upinfo_item_id',19);
			$this->db->update('app_local_customer_details', $data);
			if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
			else
				{
					$this->db->trans_commit();
					return $tag;
				} 
			
		
		}
		else
		{
			 $data = array(
				'local_admin_id' 		  => $local_admin_id,
				'customer_id' 			  => $customer_id,
				'sign_upinfo_item_id' 	   => 19,
				'value'						=> $tag,
				'date_inserted'           => date("Y/m/d"),
				'date_edited'             => date("Y/m/d")
				
				);
				$data = $this->global_mod->db_parse($data);
				$this->db->trans_begin();
				$this->db->insert('app_local_customer_details', $data);
				if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
					}
				else
					{
						$this->db->trans_commit();
						return $tag;
					} 
		}
		
		
	}
	function addInfo($info,$customer_id){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql1=$this->db->query("select value from app_local_customer_details
	Where local_admin_id ='".$local_admin_id."'and customer_id ='".$customer_id."' and sign_upinfo_item_id='20'");
		
		if ($sql1->num_rows() > 0)
		{
		    $data = array(
			'value' => $this->global_mod->db_parse($info),
			);
			$this->db->trans_begin();
			$this->db->where('local_admin_id',$local_admin_id);
			$this->db->where('customer_id',$customer_id);
			$this->db->where('sign_upinfo_item_id',20);
			$this->db->update('app_local_customer_details', $data);
			if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
			else
				{
					$this->db->trans_commit();
					return $info;
				} 
			
		
		}
		else
		{
			 $data = array(
				'local_admin_id' 		  => $local_admin_id,
				'customer_id' 			  => $customer_id,
				'sign_upinfo_item_id' 	  => 20,
				'value'					  => $info,
				'date_inserted'           => date("Y/m/d"),
				'date_edited'             => date("Y/m/d")
				
				);
				$data = $this->global_mod->db_parse($data);
				$this->db->trans_begin();
				$this->db->insert('app_local_customer_details', $data);
				if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
					}
				else
					{
						$this->db->trans_commit();
						return $info;
					} 
		}
		
		
	}
	function upcomingAppointments($customer_id){
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $today = date("Y-m-d");
	    $sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									emp.employee_name
							FROM 	app_booking_service_details bs,
									app_booking b,
									app_employee emp
							WHERE 	bs.srvDtls_service_start > '".$today."' AND
									bs.employee_id =emp.employee_id AND
									b.customer_id ='".$customer_id."' AND
									b.booking_id =bs.booking_id AND
									b.local_admin_id='".$local_admin_id."'
							");
					
		$html='<table width="100%" border="0" cellspacing="1" cellpadding="0">
		<tr class="silver">
		<th>Date</th>
		<th> Staff </th>
		<th> Service </th>
		<th>Amount Paid </th>
		</tr>
		';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
	
					$html.='<tr>
								<td>'.$row->service_start_dt.'</td>
								<td>'.$this->global_mod->show_to_control($row->employee_name).'</td>
								<td>'.$this->global_mod->show_to_control($row->service_name).'</td>
								<td>'.$row->service_cost.'</td>
						  	</tr>';
			}				
		
		}
		else
		{
			$html.='<tr>
						<td colspan="4" align="center">No Upcoming Booking Available</td>
					</tr>';
		}
		$html.='</table>';
		return $html;
	
	}	
	function pastAppointments($customer_id){
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $today = date("Y-m-d");
	    $sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									emp.employee_name
							FROM 	app_booking_service_details bs,
									app_booking b,
									app_employee emp
							WHERE 	bs.srvDtls_service_start < '".$today."' AND
									bs.employee_id =emp.employee_id AND
									b.customer_id ='".$customer_id."' AND
									b.booking_id =bs.booking_id AND
									b.local_admin_id='".$local_admin_id."'
							");
					
		$html='<table width="100%" border="0" cellspacing="1" cellpadding="0">
					<tr class="silver">
						<th>Date</th>
						<th> Staff </th>
						<th> Service </th>
						<th>Amount Paid </th>
					</tr>';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
					$html.='<tr>
								<td>'.$row->service_start_dt.'</td>
								<td>'.$this->global_mod->show_to_control($row->employee_name).'</td>
								<td>'.$this->global_mod->show_to_control($row->service_name).'</td>
								<td>'.$row->service_cost.'</td>
						  	</tr>';
			}				
		}
		else
		{
			$html.='<tr>
						<td colspan="4" align="center">No Past Booking Available</td>
					</tr>';
		}
		$html.='</table>';
		return $html;
	}
	function SaveInformation($result){
		$c_id = $result[12];
		$i=0;
		
		for($i=0;$i<count($result);$i++)
		{
			if($i != 2) {
				if($i < 12 ) {
					$this->modify_client_info_details($i,$result[$i],$c_id);
				}
			} else {
				$list_val = explode('@@@@',$result[$i]);
				//echo $result[$i];exit;
				$sql9=$this->db->query("update app_password_manager set user_email = '".$list_val[0]."' where user_id = ".$c_id." ");
				if(trim($list_val[1]) != "")
				{
					$sql19=$this->db->query("update app_password_manager set password = '".$list_val[1]."' where user_id = ".$c_id." ");
				}
			}
		}		
	}
	function modify_client_info_details($key,$data,$c_id) {
		//echo '<pre>';print_r($result);exit;
		$local_admin_id = $this->session->userdata('local_admin_id');
		$val;
		if($key == 0) 
		{
			$val = 2;
		}
		if($key == 1) 
		{
			$val = 3;
		}
		// no 2
		if($key == 3) 
		{
			$val = 9;
		}
		if($key == 4) 
		{
			$val = 10;
		}
		if($key == 5) 
		{
			$val = 11;
		}
		if($key == 6) 
		{
			$val = 4;
		}
		if($key == 7) 
		{
			$val = 5;
		}
		if($key == 8) 
		{
			$val = 6;
		}
		if($key == 9) 
		{
			$val = 7;
		}
		if($key == 10) 
		{
			$val = 8;
		}
		if($key == 11) 
		{
			$val = 21;
		}
		
		
		$sql1=$this->db->query("select * from app_local_customer_details where customer_id = ".$c_id." AND local_admin_id = ".$local_admin_id." AND sign_upinfo_item_id = ".$val."");
		if ($sql1->num_rows() > 0) {
			$sql2=$this->db->query("update app_local_customer_details set value = '".$data."', date_edited = '".date('Y-m-d')."' where local_admin_id = ".$local_admin_id." AND sign_upinfo_item_id = ".$val." AND customer_id = ".$c_id."");		
	    } else {
			if($data != "") {
			$sql3=$this->db->query("insert into app_local_customer_details VALUES ('','".$local_admin_id."','".$val."','".$c_id."','".$data."','".date('Y-m-d')."','".date('Y-m-d')."')");
			
			}
			
		}
  }
    function delete_this_customer($customer_id){	
                $data = array(
                     'user_status' => 0              
                  );
              $this->db->where('user_id',$customer_id);
              $this->db->update('app_password_manager', $data);
        }
    function Change_lang(){	
        $prod = $this->input->post('val');
        $this->db->select('languages_name,languages_id,image');
        $this->db->from('app_languages');
        $this->db->where('languages_id',$prod);
        $query = $this->db->get();		
        $Ret_Arr_val = $query->result_array();

        $set_lang = array(
            'selected_lang_id'=>  $prod,
            'selected_lang' => $Ret_Arr_val[0]['languages_name'],
            'selected_lang_flag' => $Ret_Arr_val[0]['image']
        );
        $this->session->set_userdata($set_lang);   
    } 
  	function LoadCustomerById($cus_id){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $sql="SELECT	
					pass.user_id			AS user_id,
					cust.cus_fname			AS cus_fname,
					cust.cus_lname			AS cus_lname,
					cust.cus_mob			AS cus_mob,
					cust.cus_phn1			AS cus_phn1,
					cust.cus_phn2			AS cus_phn2,
					cust.cus_address		AS cus_address,
					cust.cus_countryid		AS cus_countryid,
					cust.cus_regionid		AS cus_regionid,
					cust.cus_zip			AS customer_zip,
					cust.time_zone_id		AS time_zone_id,
					cust.cus_mob			AS cus_mob,
					pass.user_email			AS user_email,
					pass.email_veri_status	AS email_veri_status
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
					pass.user_id =".$cus_id;
		
		$sql1			= $this->db->query($sql);
		$customerData	= array();
		$row			= $sql1->row();
        if($sql1->num_rows() > 0){		
			$customerData['user_id'] = isset($row->user_id)?$row->user_id:'';
			$customerData['cus_fname'] = isset($row->cus_fname)?$this->global_mod->show_to_control($row->cus_fname):'';
			$customerData['cus_lname'] = isset($row->cus_lname)?$this->global_mod->show_to_control($row->cus_lname):'';
			$customerData['cus_mob']  = isset($row->cus_mob)?$row->cus_mob:'';
			$customerData['cus_phn1'] = isset($row->cus_phn1)?$row->cus_phn1:'';
			$customerData['cus_phn2'] = isset($row->cus_phn2)?$row->cus_phn2:'';
			$customerData['cus_address'] = isset($row->cus_address)?$this->global_mod->show_to_control($row->cus_address):'';
			$customerData['cus_countryid'] = isset($row->cus_countryid)?$row->cus_countryid:0;
			$customerData['cus_regionid'] = isset($row->cus_regionid)?$row->cus_regionid:0;
			$customerData['customer_zip'] = isset($row->customer_zip)?$row->customer_zip:'';
			$customerData['time_zone_id'] = isset($row->time_zone_id)?$row->time_zone_id:'';
			$customerData['user_email'] = isset($row->user_email)?$row->user_email:'';
			$customerData['email_veri_status'] = isset($row->email_veri_status )?$row->email_veri_status :'';
		}		
		return $customerData;		
	} 
    function mobileLoadCustomerById($cus_id){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $qry="SELECT	
					pass.user_id			AS user_id,
					cust.cus_fname			AS cus_fname,
					cust.cus_lname			AS cus_lname,
					cust.cus_mob			AS cus_mob,
					cust.cus_phn1			AS cus_phn1,
					cust.cus_phn2			AS cus_phn2,
					cust.cus_address		AS cus_address,
					cust.cus_countryid		AS cus_countryid,
					cust.cus_regionid		AS cus_regionid,
					cust.cus_zip			AS customer_zip,
					cust.time_zone_id		AS time_zone_id,
					cust.cus_mob			AS cus_mob,
					pass.user_email			AS user_email,
					pass.email_veri_status	AS email_veri_status
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
					pass.user_id =".$cus_id;
		$sql1=$this->db->query($qry);
		
		if ($sql1->num_rows() > 0)
		{
			return $sql1->result();
		}
		
	}  
	
	public function GetEditSetting(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$this->db->select('*');
		$this->db->from('app_local_admin_gen_setting_clint_signup_info');
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->where('type', 'E');
		$this->db->where('status', 1);
		$this->db->where('disp_on_screen', 1);
		$query = $this->db->get();
		$Arr = $query->result_array();
		$return = array();
		foreach($Arr as $val){
			array_push($return,$val['sign_upinfo_item_id']);
		}
		
		return $return;
		
	}
}
?>