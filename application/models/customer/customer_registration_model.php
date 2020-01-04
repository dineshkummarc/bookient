<?php
class Customer_Registration_model extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}
	public function GetLocalAdmin(){
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);

		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $url_arr[0]);
		$query = $this->db->get();
		$LocalAdminArr = $query->result_array();

		return $LocalAdminArr[0]['user_id'];
	}
    public function Check_User(){
            $username = $_POST['user_name'];
            $this->db->select('count(*) as rows_count');
            $this->db->from('app_password_manager');
            $this->db->where('user_name',$username);
            $this->db->where('user_type',3);
            $query = $this->db->get();
            $UserAuthArr = $query->result_array();
            echo $UserAuthArr[0]['rows_count'];

        }
	public function CustomerLogIn(){
		$err = 0;
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $this->input->post('user_name'));
		$this->db->where('password', $this->input->post('password'));
		$this->db->where('user_type', 2);
		$query = $this->db->get();
		$UserAuthArr = $query->result_array();

		if(count($UserAuthArr) > 0)
		{
			$this->db->select('email_veri_status,user_id');
			$this->db->from('app_password_manager');
			$this->db->where('user_id', $UserAuthArr[0]['user_id']);
			$query = $this->db->get();
			$UserEmailVerArr = $query->result_array();

			if($UserEmailVerArr[0]['email_veri_status'] == 1)
			{
				$query ="select user_name,user_id,user_type from app_password_manager where user_type=3 and user_id=(select emp.local_admin_id from app_employee as emp,app_password_manager as pass where emp.employee_id=pass.user_id and pass.user_id=".$UserEmailVerArr[0]['user_id'].")";
				$sql = mysql_query($query);
				$EmpArr = mysql_fetch_array($sql);

				$url = $_SERVER['HTTP_HOST'];
				$url_arr = explode(".",$url);

				if($url_arr[0] == $EmpArr['user_name'])
				{
					$set_user_data = array(
						'user_name_customer'   => $EmpArr['user_name'],
						'user_id_customer'     => $EmpArr['user_id'],
						'user_type_customer'   => $EmpArr['user_type'],
						'logged_in_customer'   => TRUE
					);
                    ###################################################################################
                    if(($this->input->post('mobileType') == 'mobile') && ($this->input->post('staffArr')!= '') && ($this->input->post('srvArr')== '')){
					    $ls_Emp = '';
					    $ls_Srv = '';
                        $staffArrM = '';
					    foreach($this->input->post('staffArr') AS $lsEmp){
		                   $ls_Emp	.= $lsEmp.",";
		                }
					    $staffArrM		.=substr_replace($ls_Emp ,"",-1);
					    /*foreach($this->input->post('srvArr') AS $lsSrv){
		                   $ls_Srv	.= $lsSrv.",";
		                }
					    $srvfArrM		.=substr_replace($ls_Srv ,"",-1);*/
					
					    $set_user_data['bDateM']                = $this->input->post('bDate');
					    $set_user_data['bTimeM']                = $this->input->post('bTime');
					    $set_user_data['latestContentM']        = $this->input->post('contentType');
					    $set_user_data['staffArrM']             = $staffArrM;
					    //$set_user_data['srvArrM']               = $srvfArrM;
				    }elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')== '')){
					    $ls_Emp = '';
					    $ls_Srv = '';
                        $srvfArrM = '';
					    /*foreach($this->input->post('staffArr') AS $lsEmp){
		                   $ls_Emp	.= $lsEmp.",";
		                }
					    $staffArrM		.=substr_replace($ls_Emp ,"",-1);*/
					    foreach($this->input->post('srvArr') AS $lsSrv){
		                   $ls_Srv	.= $lsSrv.",";
		                }
					    $srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					    $set_user_data['bDateM']                = $this->input->post('bDate');
					    $set_user_data['bTimeM']                = $this->input->post('bTime');
					    $set_user_data['latestContentM']        = $this->input->post('contentType');
					    //$set_user_data['staffArrM']             = $staffArrM;
					    $set_user_data['srvArrM']               = $srvfArrM;
				    }elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')!= '')){
					    $ls_Emp = '';
					    $ls_Srv = '';
                        $staffArrM = '';
                        $srvfArrM = '';
					    foreach($this->input->post('staffArr') AS $lsEmp){
		                   $ls_Emp	.= $lsEmp.",";
		                }
					    $staffArrM		.=substr_replace($ls_Emp ,"",-1);
					    foreach($this->input->post('srvArr') AS $lsSrv){
		                   $ls_Srv	.= $lsSrv.",";
		                }
					    $srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					    $set_user_data['bDateM']                = $this->input->post('bDate');
					    $set_user_data['bTimeM']                = $this->input->post('bTime');
					    $set_user_data['latestContentM']        = $this->input->post('contentType');
					    $set_user_data['staffArrM']             = $staffArrM;
					    $set_user_data['srvArrM']               = $srvfArrM;
                    }else{
					    $set_user_data['bTime']                = $this->input->post('bTime');
					    $set_user_data['staffArr']             = $this->input->post('staffArr');
					    $set_user_data['srvArr']               = $this->input->post('srvArr');	
				    }
                    ###################################################################################
					//print_r($set_user_data);
					$this->session->set_userdata($set_user_data);
					$err = 0;
				}
				else
				{
					$err = 3;
				}
			}
			else
			{
				$err = 2;
			}
		}
		else
		{
			$err = 1;
		}

		return $err;
	}
	public function StaffSaveData($img_name,$img_store){
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);
		$local_admin_name = $url_arr[0];

		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $local_admin_name);
		$query = $this->db->get();
		$LocalAdminArr = $query->result_array();


		$this->db->trans_begin();

		$data = array(
						'password' 		=> $this->input->post('password'),
						'user_email'	=> $this->input->post('user_email'),
						'date_modified'	=> date('Y-m-d')
				);
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update('app_password_manager',$this->db->escape($data));
		$this->db->last_query();

		if($img_name != '')
		{
			$this->db->select('employee_image');
			$this->db->from('app_employee');
			$this->db->where('employee_id', $this->input->post('user_id'));
			$query = $this->db->get();
			$ImageArr = $query->result_array();

			$filename = 'uploads/staff/'.$ImageArr[0]['employee_image'];

			if (file_exists($filename)) {
				@unlink($filename);
			}

			$data = array(
							'local_admin_id' 			=> $LocalAdminArr[0]['user_id'],
							'employee_image'			=> $img_name,
							'employee_image_original'	=> $img_store,
							'employee_name'				=> trim($this->input->post('employee_name')),
							'employee_mobile_no' 		=> trim($this->input->post('employee_mobile_no')),
							'employee_languages'		=> trim($this->input->post('employee_languages')),
							'employee_description'		=> trim($this->input->post('employee_description')),
							'employee_education'		=> trim($this->input->post('employee_education')),
							'employee_membership'		=> trim($this->input->post('employee_membership')),
							'employee_awards'			=> trim($this->input->post('employee_awards')),
							'employee_publications'		=> trim($this->input->post('employee_publications')),
							'date_edited'				=> date('Y-m-d')
					);
		}
		else
		{
			$data = array(
							'local_admin_id' 			=> $LocalAdminArr[0]['user_id'],
							'employee_name'				=> trim($this->input->post('employee_name')),
							'employee_mobile_no' 		=> trim($this->input->post('employee_mobile_no')),
							'employee_languages'		=> trim($this->input->post('employee_languages')),
							'employee_description'		=> trim($this->input->post('employee_description')),
							'employee_education'		=> trim($this->input->post('employee_education')),
							'employee_membership'		=> trim($this->input->post('employee_membership')),
							'employee_awards'			=> trim($this->input->post('employee_awards')),
							'employee_publications'		=> trim($this->input->post('employee_publications')),
							'date_edited'				=> date('Y-m-d')
					);
		}
		$data = $this->global_mod->db_parse($data);
		$this->db->where('employee_id', $this->input->post('user_id'));
		$this->db->update('app_employee',$this->db->escape($data));
		$this->db->last_query();

		if ($this->db->trans_status() === FALSE)
		{
			$flag = 0;
			$this->db->trans_rollback();
		}
		else
		{
			$flag = 1;
			$this->db->trans_commit();
		}
		if($flag == 1)
			return $img_name;
		else
			return 0;
	}
	public function checkFieldstatus($local_admin_id){
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
		}
		else
		{
			$checkFieldstatus_arr = array();
		}
		return $checkFieldstatus_arr;
	}
	public function country($local_admin_id){
		$query=$this->db->query("SELECT country_id from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row1 = $query->row();
		$country_name_id=$row1->country_id;

		$country='<select name="country_id_5" id="cus_countryid_5" class="text-input required" onfocus="clr_reg_values(this);" onChange="chan_ge_country_status(this.value);" >
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
	public function region($local_admin_id){
		$query=$this->db->query("SELECT region_id from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row1 = $query->row();
		$region_name_id=$row1->region_id;

		$region='<select name="region_id_6" id="cus_regionid_6" onfocus="clr_reg_values(this);"  onChange="chan_ge_region_status(this.value)" class="required" >
		<option value="">---Select Region---</option>';

		$sql=$this->db->query("SELECT * from app_regions");
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
	public function city($local_admin_id){
		$query=$this->db->query("SELECT city_id from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row1 = $query->row();
		$city_name_id=$row1->city_id;

		$city='<select name="city_id_7" id="cus_cityid_7" class="required" onfocus="clr_reg_values(this);" >
		<option value="">-----Select City-----</option>';

		 $sql=$this->db->query("SELECT * from app_cities");
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
	public function time_Zone($local_admin_id){
		$sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		$row1 = $sql->row();
		$time_zone_name_id=$row1->time_zone_id;

		$time_zone='<select name="time_zone_id_21" id="cus_time_zone_id_21" class="text-input required" onfocus="clr_reg_values(this);">
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
	public function SaveRegistrationData($insert_list){       
        $local_admin_id         = $insert_list['local_admin_id'];
        $user_name              = trim($insert_list['cus_fname_2']);
        $password               = trim($insert_list['ori_pass']);
        $self_registration      = $insert_list['self_registration'];
        $local_admin_id_sess    = $this->session->userdata('local_admin_id');
        $register_from = ($self_registration == 1)?2:4;
        $this->db->select('user_email');
        $this->db->from('app_password_manager');
        $this->db->where('user_id',$local_admin_id_sess);
        $query = $this->db->get();
        $ResArr =  $query->result();

        $Sender_email = $ResArr[0]->user_email;

		$insert_app_password_manager = array(
		    'user_type'          => 1,
		    'register_from'      => $register_from,
		    'user_name'          => $user_name,
		    'password'           => $password,
		    'user_email'         => trim($insert_list['user_email']),
		    'email_veri_status'	 => 0,
		    'user_status'		 => 1,
		    'date_creation'      => date("Y/m/d"),
		    'date_modified'      => date("Y/m/d")
		);
		$insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
		$this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
		$customer_id = $this->db->insert_id();

		$updateData = array();
		$updateData['cus_id'] = $customer_id;
		if (array_key_exists("cus_fname_2", $insert_list)) {
		$updateData['cus_fname'] = $insert_list['cus_fname_2'];
		}
		if (array_key_exists("cus_lname_3", $insert_list)) {
		$updateData['cus_lname'] = $insert_list['cus_lname_3'];
		}
		if (array_key_exists("cus_address_4", $insert_list)) {
		$updateData['cus_address'] = $insert_list['cus_address_4'];
		}
		if (array_key_exists("country_id_5", $insert_list)) {
		$updateData['cus_countryid'] = ($insert_list['country_id_5']==0)?'':$insert_list['country_id_5'];
		}
		if (array_key_exists("region_id_6", $insert_list)) {
		$updateData['cus_regionid'] = ($insert_list['region_id_6']==0)?'':$insert_list['region_id_6'];
		}
		if (array_key_exists("city_id_7", $insert_list)) {
		$updateData['cus_cityid'] = ($insert_list['city_id_7']==0)?'':$insert_list['city_id_7'];
		}
		if (array_key_exists("cus_zip_8", $insert_list)) {
		$updateData['cus_zip'] = $insert_list['cus_zip_8'];
		}
		if (array_key_exists("cus_mob_9", $insert_list)) {
		$updateData['cus_mob'] = $insert_list['cus_mob_9'];
		}
		if (array_key_exists("cus_phn1_10", $insert_list)) {
		$updateData['cus_phn1'] = $insert_list['cus_phn1_10'];
		}
		if (array_key_exists("cus_phn2_11", $insert_list)) {
		$updateData['cus_phn2'] = $insert_list['cus_phn2_11'];
		}

		$updateData['cus_status'] = 1;

		if (array_key_exists("time_zone_id_21", $insert_list)) {
		$updateData['time_zone_id'] = $insert_list['time_zone_id_21'];
		}
		$updateData = $this->global_mod->db_parse($updateData);
		$this->db->insert('app_customer_search',$updateData);
		$search_id = $this->db->insert_id();
		
		
		$insert_app_customer_admin_relationship = array(
		    'local_admin_id'	=> $local_admin_id,
		    'customer_id'		=> $customer_id,
		    'search_id'			=> $search_id
		);
		$this->db->insert('app_customer_admin_relationship',$this->db->escape($insert_app_customer_admin_relationship));


		$firstName="";

        if($insert_list['cus_fname_2'] != ''){
            $firstName=$insert_list['cus_fname_2'];
        }else{
            $firstName='User';
        }
        
        if($insert_list['cus_lname_3'] != ''){
			$last_name = $insert_list['cus_lname_3'];
		}else{
			$last_name = '';
		}
        $SITE_URL = base_url();
        $full_name = $this->session->userdata('ad_fname').' '.$this->session->userdata('ad_lname');
        
        $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $firstName,
								'{lname}' 					=> $last_name,
								'{businessLink}' 			=> $SITE_URL,
								'{clientemail}' 			=> $insert_list['user_email'],
								'{yourfullname}' 			=> $full_name
								
								);
		$toArr		= $insert_list['user_email'];	
		$from		= $this->session->userdata('local_admin_email');				
        $this->email_model->sentMail(10,$replacerArr,$toArr,$from);
		/****************login part strat*****************/
		$bTime = isset($insert_list['bTime'])?$insert_list['bTime']:'';
		$staffArr = isset($insert_list['staffArr'])?$insert_list['staffArr']:'';
		$srvArr = isset($insert_list['srvArr'])?$insert_list['srvArr']:'';
		$set_user_data = array(
		    'user_name_customer'	=> $user_name,
		    'user_id_customer'		=> $customer_id,
		    'user_type_customer'	=> 1,
		    'logged_in_customer'	=> TRUE   
		);
		if($this->input->post('mobileType') == 'mobile'){
			$ls_Emp = '';
			$ls_Srv = '';
			foreach($this->input->post('staffArr') AS $lsEmp){
		        $ls_Emp	.= $lsEmp.",";
		    }
			$staffArrM		.=substr_replace($ls_Emp ,"",-1);
			foreach($this->input->post('srvArr') AS $lsSrv){
		        $ls_Srv	.= $lsSrv.",";
		    }
			$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
				
			$set_user_data['bDateM']                = $this->input->post('bDate');
			$set_user_data['bTimeM']                = $this->input->post('bTime');
			$set_user_data['latestContentM']        = $this->input->post('contentType');
			$set_user_data['staffArrM']             = $staffArrM;
			$set_user_data['srvArrM']               = $srvfArrM;
		}else{
			$set_user_data['reg_bTime']			= $bTime;
			$set_user_data['reg_staffArr']		= $staffArr;
			$set_user_data['reg_srvArr']		= $srvArr;
		}
		$this->session->set_userdata($set_user_data);
		/***************login part end******************/
            echo "Successfully Registered";

	}
	public function changeregion($country_id){
		$region='
		<option value="">---Select Region---</option>';

		$sql=$this->db->query("SELECT * from app_regions where country_id = ".$country_id);
		foreach ($sql->result() as $row)
		{
			$region_name=$row->region_name;
			$region_id=$row->region_id;
			$region.="<option value=".$region_id.">".$region_name."</option>";

		}

		return $region;
	}
	public function changecity($c_id){
		$city='<option value="">---Select Region---</option>';

		$sql=$this->db->query("SELECT * from app_cities where region_id = ".$c_id);
		foreach ($sql->result() as $row)
		{
			$city_name=$row->city_name;
			$city_id=$row->city_id;
			$city.="<option value=".$city_id.">".$city_name."</option>";

		}
		return $city;
	}  
    public function google_registration($set_user_data){

    $Sender_email	= $this->session->userdata('local_admin_email');
    $local_admin_id	= $this->session->userdata('local_admin_id');

	$host			= $_SERVER['HTTP_HOST'];
	$email			= isset($set_user_data['email'])?$set_user_data['email']:'';
	$firstname 		= isset($set_user_data['firstname'])?$set_user_data['firstname']:'';
	$lastname		= isset($set_user_data['lastname'])?$set_user_data['lastname']:'';
					
 	$sql=	"SELECT	
					pass.user_id AS user_id,
					count(*) AS number 
			FROM
					app_customer_admin_relationship	AS rel,
					app_password_manager			AS pass
			WHERE
					pass.user_type = 1
					AND
					rel.customer_id = pass.user_id     
					AND
					rel.local_admin_id =".$local_admin_id."
					AND
					pass.user_email ='".$email."'";
	
	$query_check = $this->db->query($sql);
	$userExists = $query_check->result_array();

	if($userExists[0]['number']>0){	
		$customerData = $this->LoadCustomerById($userExists[0]['user_id']);

	    $sessionData = array(
                                'user_name_customer'		=> $firstname,
		                        'user_id_customer'			=> isset($customerData['user_id'])?$customerData['user_id']:'',
		                        'user_type_customer'		=> 1,
		                        'logged_in_customer'		=> TRUE,
		                        'user_fname_customer'		=> $firstname,
		                        'user_lname_customer'		=> $lastname,
		                        'user_mobile_customer'		=> isset($customerData['cus_mob'])?$customerData['cus_mob']:'',
		                        'user_phone1_customer'		=> isset($customerData['cus_phn1'])?$customerData['cus_phn1']:'',
		                        'user_phone2_customer'		=> isset($customerData['cus_phn2'])?$customerData['cus_phn2']:'',
		                        'user_address_customer'		=> isset($customerData['cus_address'])?$customerData['cus_address']:'',
		                        'user_zip_customer'			=> isset($customerData['customer_zip'])?$customerData['customer_zip']:'',
		                        'user_zone_id_customer'		=> isset($customerData['time_zone_id'])?$customerData['time_zone_id']:'',
		                        'user_email_customer'		=> $email,
		                        'email'   		        	=> $email,
								'firstname'     	    	=> $firstname,
								'lastname'   		    	=> $lastname                       
                        );
	    $this->session->set_userdata($sessionData);
	    $customer_id = $userExists[0]['user_id'];
	}else{
			$local_password = $this->randomPassword();
            $insert_app_password_manager = array(
                'user_type'          => 1,//    USER TYPE CUSTOMER
                'register_from'      => 3,//    REGISTERED BY SELF USING GOOGLE ACCOUNT
                'user_name'          => $firstname,
                'password'           => $local_password,
                'user_email'         => $email,
                'email_veri_status'  => 1,
                'user_status'        => 1,
                'date_creation'      => date("Y-m-d"),
                'date_modified'      => date("Y-m-d")
            );
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $customer_id = $this->db->insert_id();

                      
			$insertData = array();
			$insertData['cus_id'] = $customer_id;
			$insertData['cus_fname'] = $firstname;
			$insertData['cus_lname'] = $lastname;			
			$updateData = $this->global_mod->db_parse($insertData);
			$this->db->insert('app_customer_search',$updateData);
			$search_id = $this->db->insert_id();


			$insert_app_customer_admin_relationship = array(
			'local_admin_id'	=> $local_admin_id,
			'customer_id'		=> $customer_id,
			'search_id'			=> $search_id
			);
			$this->db->insert('app_customer_admin_relationship',$this->db->escape($insert_app_customer_admin_relationship));
			
			$sessionData = array(
                                'user_name_customer'		=> $firstname,
		                        'user_id_customer'			=> $customer_id,
		                        'user_type_customer'		=> 1,
		                        'logged_in_customer'		=> TRUE,
		                        'user_fname_customer'		=> $firstname,
		                        'user_lname_customer'		=> $lastname,
		                        'user_mobile_customer'		=> '',
		                        'user_phone1_customer'		=> '',
		                        'user_phone2_customer'		=> '',
		                        'user_address_customer'		=> '',
		                        'user_zip_customer'			=> '',
		                        'user_zone_id_customer'		=> '',
		                        'user_email_customer'		=> $email,
								'email'   		        	=> $email,
								'firstname'     	    	=> $firstname,
								'lastname'   		    	=> $lastname
                        );
	    	$this->session->set_userdata($sessionData);	

			$to  = isset($set_user_data['email'])?$set_user_data['email']:'';
			$subject = 'Google login confirmation';
				 
			$message  = '<html>';
			$message .= '<head>';
			$message .= '<title>Google login confirmation</title>';
			$message .= '</head>';
			$message .= '<body>';
			$message .= '<div style="margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;">';
			$message .= '<div style="padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;">';
			$message .= '<div style="margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;">';
			$message .= '<div style="border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;">';
			$message .= '<p><b>Hello '.$firstname.' '.$lastname.',</b><br>';
			$message .= 'We invite you to schedule your next appointment with '.$host.' using our Online Appointment System. It is very simple and you can select the exact service and date you require. Make your appointments at any time, 24 hours a day. No more waiting on the phone.
			To book appointments you will be required to remember the following login details.</p>';
			$message .= '<p><b>Here are your login details:</b><br>';
			$message .= '<b>URL: </b>  '.$host.' <br>';
			$message .= '<b>Email: </b>  '.$set_user_data["email"].' <br>';
			$message .= '<b>Password: </b>'.$local_password.' <br></p>';
			$message .= 'We hope you will like this new service and look forward to seeing you soon.<br>';
			$message .= 'Thank You.';

			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</body>';
			$message .= '</html>';
                     
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Bookient Administrator <'.$Sender_email.'>'. "\r\n";
            mail($to, $subject, $message, $headers);
        }
        
        if($customer_id >0){
			return TRUE;
		}
        
    }
    
	public function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
		    $n = rand(0, $alphaLength);
		    $pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}	
	public function UpdateCustomerData($insert_list){
		
            $local_admin_id         = $insert_list['local_admin_id'];
            $user_id                = isset($insert_list['user_id'])?$insert_list['user_id']:0;
            $password               = trim($insert_list['ori_pass']);
            $conf_password 			= trim($insert_list['conf_pass']);
            $local_admin_id_sess    = $this->session->userdata('local_admin_id');
            if(!empty($password) && !empty($conf_password)){
            	
            	if($password == $conf_password){
					$insert_app_password_manager = array(
                                                    'password' => $this->global_mod->db_parse($password)
                                               );
	                $this->db->where('user_id', $user_id);
	                $this->db->update('app_password_manager',$this->db->escape($insert_app_password_manager));
				}	                 
            }
            
            $updateData=array();					
			if (array_key_exists("cus_fname_2", $insert_list)) {
					$updateData['cus_fname'] = $insert_list['cus_fname_2'];
			}
			if (array_key_exists("cus_lname_3", $insert_list)) {
					$updateData['cus_lname'] = $insert_list['cus_lname_3'];
			}
			if (array_key_exists("cus_address_4", $insert_list)) {
					$updateData['cus_address'] = $insert_list['cus_address_4'];
			}
			if (array_key_exists("country_id_5", $insert_list)) {
					$updateData['cus_countryid'] = ($insert_list['country_id_5']==0)?'':$insert_list['country_id_5'];
			}
			if (array_key_exists("region_id_6", $insert_list)) {
					$updateData['cus_regionid'] = ($insert_list['region_id_6']==0)?'':$insert_list['region_id_6'];
			}
			if (array_key_exists("city_id_7", $insert_list)) {
					$updateData['cus_cityid'] = ($insert_list['city_id_7']==0)?'':$insert_list['city_id_7'];
			}
			if (array_key_exists("cus_zip_8", $insert_list)) {
					$updateData['cus_zip'] = $insert_list['cus_zip_8'];
			}
			if (array_key_exists("cus_mob_9", $insert_list)) {
					$updateData['cus_mob'] = $insert_list['cus_mob_9'];
			}
			if (array_key_exists("cus_phn1_10", $insert_list)) {
					$updateData['cus_phn1'] = $insert_list['cus_phn1_10'];
			}
			if (array_key_exists("cus_phn2_11", $insert_list)) {
					$updateData['cus_phn2'] = $insert_list['cus_phn2_11'];
			}
			if (array_key_exists("time_zone_id_21", $insert_list)) {
					$updateData['time_zone_id'] = $insert_list['time_zone_id_21'];
			}
			
			$this->db->where('cus_id', $user_id);
			$this->db->update('app_customer_search',$updateData);
            
            echo "Updated Successfully";
	}
	public function chkLogin($local_admin_id){
		$this->db->select('login_typ_id');
		$this->db->from('app_local_admin_gen_setting_login_typ');
		$this->db->where('status', '1');
		$this->db->where('local_admin_id',$local_admin_id);
		$query = $this->db->get();
		$app_logins =  $query->result_array();
		$arr=array();
		
		foreach ($app_logins as $app_login)
		{
			$arr[] = $app_login['login_typ_id'];
		}	
		return 	$arr;
	}
    public function checkRegistrationInformation($local_admin_id){
        $this->db->select('sign_upinfo_item_id');
        $this->db->from('app_local_admin_gen_setting_clint_signup_info');
        $this->db->where('status','1');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
		$app_reg =  $query->result_array();
		$regArr=array();
        foreach ($app_reg as $app_reg_data)
		{
			$regArr[] = $app_reg_data['sign_upinfo_item_id'];
		}	
		return 	$regArr;
    }
	public function facebookUserChecking($set_user_data){
		$this->db->select('*');
        $this->db->from('app_password_manager');
        $this->db->where('facebook_uid',$set_user_data);
        $query = $this->db->get();
        $UserAuthArr = $query->result_array();
        return count($UserAuthArr);
	}	
	public function faceBookUserEmail($userName){
		$this->db->select('user_email');
        $this->db->from('app_password_manager');
        $this->db->where('facebook_uid',$userName);
        $query = $this->db->get();
        $UserAuthArr = $query->result_array();
        return $UserAuthArr[0]['user_email'];
	}
	public function faceBook_registration($set_user_data,$username){      
        $local_admin_id_sess = $this->session->userdata('local_admin_id');
		
		$Sender_email	= $this->session->userdata('local_admin_email');
	    $local_admin_id	= $this->session->userdata('local_admin_id');

		$host			= $_SERVER['HTTP_HOST'];
		$email			= isset($set_user_data['email'])?$set_user_data['email']:'';
		$firstname 		= isset($set_user_data['firstname'])?$set_user_data['firstname']:'';
		$lastname		= isset($set_user_data['lastname'])?$set_user_data['lastname']:'';
		
		$sql=	"SELECT	
					pass.user_id AS user_id,
					count(pass.*) AS number
				FROM
					app_customer_admin_relationship	AS rel,
					app_password_manager			AS pass
				WHERE
					pass.user_type = 1
					AND
					rel.customer_id = pass.user_id     
					AND
					rel.local_admin_id =".$local_admin_id."
					AND
					pass.user_email ='".$email."'";

		$query_check = $this->db->query($sql);
		$userExists = $query_check->result_array();      

		if($userExists[0]['number']>0){	
			$customerData = $this->LoadCustomerById($userExists[0]['user_id']);
			$sessionData = array(
			                    'user_name_customer'		=> $userExists[0]['firstname'],
			                    'user_id_customer'			=> isset($userData[0]['user_id'])?$userData[0]['user_id']:'',
			                    'user_type_customer'		=> 1,
			                    'logged_in_customer'		=> TRUE,
			                    'user_fname_customer'		=> $firstname,
			                    'user_lname_customer'		=> $lastname,
			                    'user_mobile_customer'		=> isset($customerData['cus_mob'])?$customerData['cus_mob']:'',
			                    'user_phone1_customer'		=> isset($customerData['cus_phn1'])?$customerData['cus_phn1']:'',
			                    'user_phone2_customer'		=> isset($customerData['cus_phn2'])?$customerData['cus_phn2']:'',
			                    'user_address_customer'		=> isset($customerData['cus_address'])?$customerData['cus_address']:'',
			                    'user_zip_customer'			=> isset($customerData['customer_zip'])?$customerData['customer_zip']:'',
			                    'user_zone_id_customer'		=> isset($customerData['time_zone_id'])?$customerData['time_zone_id']:'',
			                    'user_email_customer'		=> $email,
			                    'email'   		        	=> $email,
								'firstname'     	    	=> $firstname,
								'lastname'   		    	=> $lastname                       
			            );

			$this->session->set_userdata($sessionData);   
		
		}else{
           
			$local_password = $this->randomPassword();           
	        $insert_app_password_manager = array(
		            'user_type'          => 1,//    USER TYPE CUSTOMER
		            'register_from'      => 4,//    REGISTERED BY SELF USING FACEBOOK ACCOUNT
		            'user_name'          => $firstname,
		            'password'           => $local_password,
		            'user_email'         => $email,
					'facebook_uid'       => $username,
		            'email_veri_status'  => 0,
		            'user_status'        => 1,
		            'date_creation'      => date("Y-m-d"),
		            'date_modified'      => date("Y-m-d")
	        );
            $insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $customer_id = $this->db->insert_id();
            
            
            $updateData = array();
			$updateData['cus_id']		= $customer_id;
			$updateData['cus_fname']	= $this->global_mod->db_parse($firstname);
			$updateData['cus_lname']	= $this->global_mod->db_parse($lastname);	
			$this->db->insert('app_customer_search',$updateData);
            $search_id = $this->db->insert_id();


			$insert_app_customer_admin_relationship = array(
			'local_admin_id'	=> $local_admin_id,
			'customer_id'		=> $customer_id,
			'search_id'			=> $search_id
			);
			$this->db->insert('app_customer_admin_relationship',$this->db->escape($insert_app_customer_admin_relationship));
			
			$sessionData = array(
                                'user_name_customer'		=> $firstname,
		                        'user_id_customer'			=> $customer_id,
		                        'user_type_customer'		=> 1,
		                        'logged_in_customer'		=> TRUE,
		                        'user_fname_customer'		=> $firstname,
		                        'user_lname_customer'		=> $lastname,
		                        'user_mobile_customer'		=> '',
		                        'user_phone1_customer'		=> '',
		                        'user_phone2_customer'		=> '',
		                        'user_address_customer'		=> '',
		                        'user_zip_customer'			=> '',
		                        'user_zone_id_customer'		=> '',
		                        'user_email_customer'		=> $email,
								'email'   		        	=> $email,
								'firstname'     	    	=> $firstname,
								'lastname'   		    	=> $lastname
                        );
	    	$this->session->set_userdata($sessionData);


			$to  = $email;
			$subject = 'Facebook login confirmation';
			$encription_key ='PQRST55A'.$customer_id.'A425MNOP';
				 
			$message  = '<html>';
			$message .= '<head>';
			$message .= '<title>Facebook login confirmation</title>';
			$message .= '</head>';
			$message .= '<body>';
			$message .= '<div style="margin: 0; background-color:#f0f0f0; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;">';
			$message .= '<div style="padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;">';
			$message .= '<div style="margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;">';
			$message .= '<div style="border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6;">';
			$message .= '<p><b>Welcome to Bookient,</b><br>';
			$message .= 'Thank you for signing up for a bookient.';
			$message .= '<p>Here are your login details:</p>';
			$message .= '<b>Email: </b>  '.$email.' <br>';
			$message .= '<b>Password: </b>'.$local_password.' <br>';
			$message .= '<b>To Verify your email please: </b> <a href="'.$host.'/email_verification/Veri_fication_user/'.$encription_key.'" target="_blank">Click here....</a><br>';
			$message .= '</p>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</body>';
			$message .= '</html>';
			         
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Bookient Administrator <'.$Sender_email.'>'. "\r\n";
			mail($to, $subject, $message, $headers);
        }
    }
	public function LoadCustomerById($cus_id){

		$local_admin_id = $this->session->userdata('local_admin_id');
		$customerData=array();
		 $new_sql = "SELECT	
							cust.cus_id					AS user_id,
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
							cust.cus_id = rel.customer_id
							AND
							pass.user_id = cust.cus_id
							AND
							rel.local_admin_id =".$local_admin_id."
							AND
							cust.cus_id =".$cus_id;
		$sql1	=$this->db->query($new_sql);		
		$row	= $sql1->row();
		if ($sql1->num_rows() > 0){
			  
			    $customerData['user_id'] = isset($row->user_id)?$row->user_id:'';
				$customerData['cus_fname'] = isset($row->cus_fname)?$row->cus_fname:'';
				$customerData['cus_lname'] = isset($row->cus_lname)?$row->cus_lname:'';
			    $customerData['cus_mob']  = isset($row->cus_mob)?$row->cus_mob:'';
				$customerData['cus_phn1'] = isset($row->cus_phn1)?$row->cus_phn1:'';
				$customerData['cus_phn2'] = isset($row->cus_phn2)?$row->cus_phn2:'';
				$customerData['cus_address'] = isset($row->cus_address)?$row->cus_address:'';
				$customerData['cus_countryid'] = isset($row->cus_countryid)?$row->cus_countryid:0;
				$customerData['cus_regionid'] = isset($row->cus_regionid)?$row->cus_regionid:0;
				$customerData['cus_cityid'] = isset($row->cus_cityid)?$row->cus_cityid:0;
				$customerData['customer_zip'] = isset($row->customer_zip)?$row->customer_zip:'';
				$customerData['time_zone_id'] = isset($row->time_zone_id)?$row->time_zone_id:'';
				$customerData['user_email'] = isset($row->user_email)?$row->user_email:'';
				$customerData['email_veri_status'] = isset($row->email_veri_status )?$row->email_veri_status :'';
			
		}
		return $customerData;
	} 

}
?>