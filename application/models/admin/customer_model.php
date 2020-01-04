<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

    public function showAllCustomer(){
        $list ='';
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql1=$this->db->query("SELECT	
										cust.cus_id			AS customer_id,
										cust.cus_fname		AS cus_fname,
										cust.cus_lname		AS cus_lname,
										cust.cus_mob		AS cus_mob,
										pass.register_from	AS register_from
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
										rel.local_admin_id =".$local_admin_id);

        if ($sql1->num_rows() > 0){
            foreach ($sql1->result() as $row){
                $icon = '';
                $title = '';
                $register_from = $row->register_from;
                if($register_from == 1){
                    $icon = 'admin_registered.png';
                    $title = 'Created By Admin';
                }elseif($register_from == 2){
                    $icon = 'self_registered.png';
                    $title = 'Self Registered';
                }elseif($register_from == 3){
                    $icon = 'google_registered.png';
                    $title = 'Self Registered using Google Account';
                }elseif($register_from == 4){
                    $icon = 'facebook_registered.png';
                    $title = 'Self Registered using Facebook Account';
                }
                $registeredFromIcon = '<img src="'.base_url().'/images/'.$icon.'" height="14" width="14" title="'.$title.'">';
                $list.='<div class="select-customer" onclick="selectCustomer('.$row->customer_id.')">';
                $list.='<table width="100%"><tr>';
                $list.='<td>'.$registeredFromIcon.'<span>&nbsp;'.ucfirst($row->cus_fname).'</span> &nbsp;&nbsp;';
                $list.='<span>'.ucfirst($row->cus_lname).'</span></td>';
                $list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_mob.'</div></td>';
                $list.='</tr></table>';
                $list.='</div>';
            }
        }else{
            $list='';
        }

        return $list;
    }
    public function showAllCustomerNameForSearch(){
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
    public function checkFieldstatus(){
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

                                       'cus_fname'     => $cus_fname,
                                       'cus_lname'     => $cus_lname,
                                       'cus_address'   => $cus_address,
                                       'cus_country'   => $cus_country,
                                       'cus_region'    => $cus_region,
                                       'cus_city'      => $cus_city,
                                       'cus_zip'       => $cus_zip,
                                       'cus_mob'       => $cus_mob,
                                       'cus_phn1'      => $cus_phn1,
                                       'cus_phn2'      => $cus_phn2,
                                       'time_zone'     => $time_zone_id,
                    );
                    return $checkFieldstatus_arr;
            }

            else
            {
                    $list='';
            }
    }
    public function checkFieldExistance($local_admin_id,$customer_id,$sign_upinfo_item_id){
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
    public function getBusinessDetails(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_local_admin.business_name, app_local_admin.business_location, app_local_admin.business_description, app_password_manager.user_email, app_local_admin_gen_setting.bkin_can_setin, app_local_admin_gen_setting.bkin_can_mx_tim');
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
    public function getCustomerDetails($customerId){
        $sign_upinfo_item_id = array(2, 3);
        $this->db->select('value');
        $this->db->from('app_local_customer_details');
        $this->db->where('customer_id',$customerId);
        $this->db->where_in('sign_upinfo_item_id', $sign_upinfo_item_id);
        $query = $this->db->get();		
        $Ret_Arr_val = $query->result_array();  
        return $Ret_Arr_val;
    }   
    //PR
    public function customerAdd($insert_list){
        $local_admin_id = $this->session->userdata('local_admin_id');
        
        
        if($insert_list['customer_id']!=0){ //update part
            
            
            $customer_id	= $insert_list['customer_id'];
            $user_email 	= $insert_list['user_email'];
            $data = array(
                'user_email'        => $user_email,
                'approval_status'   => $insert_list['cus_approval_id_22'],
            );
            
            $data = $this->global_mod->db_parse($data);           
            $this->db->where('user_id',$customer_id);
            $this->db->where('user_type',1);
            $this->db->update('app_password_manager', $data);

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
			if (array_key_exists("cus_countryid_5", $insert_list)) {
					$updateData['cus_countryid'] = ($insert_list['cus_countryid_5']==0)?'':$insert_list['cus_countryid_5'];
			}
			if (array_key_exists("cus_regionid_6", $insert_list)) {
					$updateData['cus_regionid'] = ($insert_list['cus_regionid_6']==0)?'':$insert_list['cus_regionid_6'];
			}
			if (array_key_exists("cus_cityid_7", $insert_list)) {
					$updateData['cus_cityid'] = ($insert_list['cus_cityid_7']==0)?'':$insert_list['cus_cityid_7'];
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
			$updateData = $this->global_mod->db_parse($updateData);
			$this->db->where('cus_id', $insert_list['customer_id']);
			$this->db->update('app_customer_search',$updateData);   
            
        }else{// DURING INSERTION OF NEW CUSTOMER
            
            
            $password = uniqid('pass_');
            $insert_app_password_manager = array(
                'user_type'          => 1,
                'register_from'      => 1,
                'user_name'          => $insert_list['cus_fname_2'],
                'password'           => $password,
                'user_email'         => $insert_list['user_email'],
                'approval_status'    => $insert_list['cus_approval_id_22'],
                'email_veri_status'	 => 1,
                'user_status'		 => 1,
                'date_creation'      => date("Y/m/d"),
                'date_modified'      => date("Y/m/d")
            );
            $insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $customer_id = $this->db->insert_id();
           
			$srcData = array(				
			    'cus_fname'			=> $insert_list['cus_fname_2'],
			    'cus_lname'			=> $insert_list['cus_lname_3'],
			    'cus_address'		=> $insert_list['cus_address_4'],
			    'cus_countryid'		=> ($insert_list['cus_countryid_5']=='')?'':$insert_list['cus_countryid_5'],
			    'cus_regionid' 		=> ($insert_list['cus_regionid_6']=='')?'':$insert_list['cus_regionid_6'],
			    'cus_cityid'		=> ($insert_list['cus_cityid_7'] =='')?'':$insert_list['cus_cityid_7'],		    
			    'cus_zip'			=> $insert_list['cus_zip_8'],
			    'cus_mob'			=> $insert_list['cus_mob_9'],
			    'cus_phn1'			=> $insert_list['cus_phn1_10'],
			    'cus_phn2'			=> $insert_list['cus_phn2_11'],
			    'created_by'		=> $local_admin_id,
			    'cus_status'		=> 1,
			    'time_zone_id'		=> '',
			    'cus_id'			=> $customer_id
			);
			$srcData = $this->global_mod->db_parse($srcData);
			$this->db->insert('app_customer_search',$srcData);
			$search_id = $this->db->insert_id();
           
            $insert_app_customer_admin_relationship = array(
                'local_admin_id'	=> $local_admin_id,
                'customer_id'		=> $customer_id,
                'search_id'			=> $search_id
            );
            $this->db->insert('app_customer_admin_relationship',$this->db->escape($insert_app_customer_admin_relationship));

            /*****      Sending Mail     *****/
            $localAdminDetails	= $this->getLocalAdminDetails();
            $localAdminFullName = ucfirst($localAdminDetails[0]['first_name']).' '.ucfirst($localAdminDetails[0]['last_name']);
            $firstName			= $insert_list['cus_fname_2'];
            $lastName			= $insert_list['cus_lname_3'];
            $replacerArr = array(
						'{fname}' 					=> $firstName,
						'{lname}' 					=> $$lastName,
						'{CurrentPassword}'			=> $password
						);
			$toArr		= $insert_list['user_email'];	
			$from		= $this->session->userdata('local_admin_email');		
			$this->email_model->sentMail(12,$replacerArr,$toArr,$from);
        }

        if($insert_list['customer_id']!=0){
            $returnText = $this->lang->line("update_successfully");
        }else{
            $returnText = $this->lang->line("successfully_insrtd");
        }
        return $returnText;
    }
        
    public function inviteCustomer($customer_id){
    $this->load->database();
    $local_admin_id = $this->session->userdata('local_admin_id');
    $cus_fname='';
    $cus_lname='';
    $query=$this->db->query("select user_email from app_password_manager Where user_id ='".$customer_id."' and  user_type ='1'");
    $row= $query->row();
    $email=$row->user_email;
    $query1=$this->db->query("select sign_upinfo_item_id,value from app_local_customer_details Where local_admin_id ='".$local_admin_id."' and
                                customer_id ='".$customer_id."' and (sign_upinfo_item_id ='2' or sign_upinfo_item_id ='3') ");
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
    public function test(){
            return $this->checkFieldExistance(1,5,3);
            //$this->checkFieldExistance($local_admin_id,$row->customer_id,$row->sign_upinfo_item_id);
    }
    public function country($customer_id=''){
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
            $query=$this->db->query("SELECT value from app_local_customer_details where 
                                        sign_upinfo_item_id='5' and customer_id='".$customer_id."'");
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

        $country='<select name="country_id" id="cus_countryid_5" onfocus="clr_reg_values(this.id)" class="text-input required" onChange="st(this.value)" style=" width:41.3%;">
        <option value="" >----Select Country---</option>';
        $this->load->database();
        $sql=$this->db->query("SELECT * from app_countries");
        foreach ($sql->result() as $row)
        {
            $country_name= $this->global_mod->show_to_control($row->country_name);
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
    public function region($customer_id=''){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        if($customer_id !='')
        {
            $query=$this->db->query("SELECT value from app_local_customer_details
                where 
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
            $query=$this->db->query("SELECT region_id,country_id from app_local_admin where local_admin_id='".$local_admin_id."'");
            $row1 = $query->row();
            $region_name_id=$row1->region_id;
            $country_id = $row1->country_id;
        }

        $region='<select name="region_id" id="cus_regionid_6" onfocus="clr_reg_values(this.id)"  onChange="re(this.value)" class="required" style=" width:41.3%;">
        <option value="">---Select Region---</option>';
        if($customer_id != ''){
            /*****      QUERY TO GET CUSTOMER COUNTRY STARTS        *****/
            $qry_country=$this->db->query("SELECT value FROM app_local_customer_details WHERE customer_id = '".$customer_id."' AND sign_upinfo_item_id = '5'");
            $row_country = $qry_country->row();
            $country_id = $row_country->value;
            /*****      QUERY TO GET CUSTOMER COUNTRY ENDS      *****/
        }
        $sql=$this->db->query("SELECT * FROM app_regions WHERE country_id = '".$country_id."'");
        foreach ($sql->result() as $row)
        {
            $region_name = $this->global_mod->show_to_control($row->region_name);
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
    public function city($customer_id=''){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        if($customer_id !='')
        {
            $query=$this->db->query("SELECT value from app_local_customer_details
                where 
                      sign_upinfo_item_id='7' and
                      customer_id='".$customer_id."'");
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
            $query=$this->db->query("SELECT region_id, city_id from app_local_admin where local_admin_id='".$local_admin_id."'");
            $row1 = $query->row();
            $city_name_id=$row1->city_id;
            $region_id=$row1->region_id;
        }
        $city='<select name="city_id" id="cus_cityid_7" class="required" onfocus="clr_reg_values(this.id)"  style="width:41.3%; margin:0 5px 4px 0;">
                    <option value="">-----Select City-----</option>';
        if($customer_id != ''){
            /*****      QUERY TO GET CUSTOMER REGION STARTS        *****/
            $qry_region=$this->db->query("SELECT value FROM app_local_customer_details WHERE customer_id = '".$customer_id."' AND sign_upinfo_item_id = '6'");
            $row_region=$qry_region->row();
            $region_id = $row_region->value;
            /*****      QUERY TO GET CUSTOMER REGION ENDS      *****/
        }
        $sql=$this->db->query("SELECT * FROM app_cities WHERE region_id = '".$region_id."'");
        foreach ($sql->result() as $row)
        {
            $city_name = $this->global_mod->show_to_control($row->city_name);
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
    public function time_Zone(){
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
            $row1 = $sql->row();
            $time_zone_name_id=$row1->time_zone_id;
            $time_zone='<select name="time_zone_id" id="time_zone_id_21" onfocus="clr_reg_values(this.id)" class="text-input required" style="background-color:#FFFFCC;border:1px solid #3366FF;width:41.3%;">
                                      <option value="">----------------Select Timezone----------------</option>';
            $this->load->database();
            $a=$this->db->query("SELECT * from app_time_zone WHERE is_active = 'Y' ORDER BY time_zone_name");
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
    public function approval_type($customer_id=''){
            $this->load->database();
            $local_admin_id = $this->session->userdata('local_admin_id');
            if($customer_id !=''){
                //echo "HHH : SELECT * from app_password_manager where user_id='$customer_id'";
                $sql=$this->db->query("SELECT * from app_password_manager where user_id='$customer_id'");
                $row1 = $sql->row();
                $approval_status=$row1->approval_status;	
            }else{
                $approval_status = '';
            }
            $approval='<select name="cus_approval_id_22" id="cus_approval_id_22" class="text-input required" style="width:41.3%;background-color:#FFFFCC;border:1px solid #3366FF;">
                                      <option value="">----------------Select Approval Type----------------</option>';
            $this->load->database();
            $a=$this->db->query("SELECT * from app_customer_approval_type");		
            foreach ($a->result() as $row)
            {
                    $approval_id=$row->approval_id;
                    $approval_type=$row->approval_type;
                    if($approval_id==$approval_status)
                    {
                            $approval_id_selected="selected";
                    }
                    else
                    {
                            $approval_id_selected="";
                    }  
                    $approval.="<option value=". $approval_id." ".$approval_id_selected.">".$approval_type."</option>";
            }
            $approval.='</select>';
            return $approval;	
    }   
    public function selectCustomer($customer_id){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql1=$this->db->query("SELECT	
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
										pass.user_id =".$customer_id);
                         
		$customerArr	= array();
		$row			= $sql1->row();
        if ($sql1->num_rows() > 0){
                $customerArr['cus_fname']			= $row->cus_fname;
                $customerArr['cus_lname']			= $row->cus_lname;
                $customerArr['cus_address']			= $row->cus_address;
                $customerArr['city_name']			= $this->fn_city($row->cus_cityid);
                $customerArr['region_name']			= $this->fn_region($row->cus_regionid);
                $customerArr['country_name']		= $this->fn_country($row->cus_countryid);
                $customerArr['cus_zip']				= $row->cus_zip;
                $customerArr['cus_mob']				= $row->cus_mob;
                $customerArr['cus_phn1']			= $row->cus_phn1;
                $customerArr['cus_phn2']			= $row->cus_phn2;
                $customerArr['customer_tag']		= $row->customer_tag;
                $customerArr['customer_info'] 		= $row->customer_info;
                $customerArr['time_zone_id'] 		= $row->time_zone_id;
                $customerArr['user_email'] 			= $row->user_email;
                $customerArr['email_veri_status'] 	= $row->email_veri_status;
                $customerArr['flag'] 				= 1;
                $customerArr['customer_id'] 		= $customer_id;
           }
                
                
                $link = '';
                
            	$link.='<span id ="edit_custo"><a href="javascript:void(0);" onclick="displayEditCustomer('.$customer_id.')"> '.$this->lang->line('edit_customer').' </a></span>';
            if($row->email_veri_status == 0){
                $link.='<span id ="verify_status">&nbsp|&nbsp<a id="very_cus" href="javascript:void(0);" onclick="verify_customer('.$customer_id.')">'.$this->lang->line("unverified").'</a></span>';
            }else{
                $link.='<span id ="verify_status">&nbsp|&nbsp<span>'.$this->lang->line("verified").'</span></span>';
            }
           		$link.='&nbsp|&nbsp<a href="javascript:void(0);" onclick="send_pass_to_customer('.$customer_id.')">'.$this->global_mod->db_parse($this->lang->line("send_password")).'</a>';
            	$link.='<span id="change_password">';
            	$link.=' | <a id="show-pass" href="javascript:void(0);" onclick="change_password('.$customer_id.')">'.$this->global_mod->db_parse($this->lang->line("chng_password")).'</a>';
            	$link.='</span>';
            	$link.='&nbsp|&nbsp<a href="javascript:void(0);" onclick="addEditGroup('.$customer_id.')"> '.$this->global_mod->db_parse($this->lang->line('edit_group')).'</a>';
            	$link.='&nbsp|&nbsp<a href="javascript:void(0);" onclick="deleteCustomerCt('.$customer_id.')"> Delete Customer </a>';
            	//$link.='&nbsp|&nbsp<a href="javascript:void(0);" onclick="personalDetails('.$customer_id.')"> '.$this->global_mod->db_parse($this->lang->line('personal_details')).'</a>';
           		$link.='<span id="success" style="display:none"></span>';
            	$link.='<input type="hidden" id="customer_id_val" value="'.$customer_id.'"/>';
            	$link.='<span id="afterClick_password" style="display:none; width: 300px;" ></span>';
            	$link.='<span id="editGroup" ></span>';
            	
            	$customerArr['link'] = $link;
       	return $customerArr;
    }   
    public function fn_city($cityId){
    	if($cityId !=''){
		$this->db->select('city_name');
		$this->db->from('app_cities');
		$this->db->where('city_id',$cityId);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();
		return $Ret_Arr_val[0]['city_name'];
		}else{
		return '';	
		}
	}   
    public function fn_country($country_id){
    	if($country_id !=''){
		$this->db->select('country_name');
		$this->db->from('app_countries');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();
		return $Ret_Arr_val[0]['country_name'];
		}else{
		return '';	
		}
		
	}   
    public function fn_region($region_id){
    	if($region_id !=''){
		$this->db->select('region_name');
		$this->db->from('app_regions');
		$this->db->where('region_id',$region_id);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();
		return $Ret_Arr_val[0]['region_name'];
		}else{
		return '';	
		}
	}
	public function selectGroupDetails($customer_id){
		$local_admin_id = $this->session->userdata('local_admin_id');
			$Sql="SELECT * FROM ( 
           					(SELECT 
           							customertype_id as customertype_id, 
           							customertype_name as customertype_name , 
           							".$customer_id." as typerelation_customer_id 
							FROM 
								app_customertype 
							WHERE 
								customertype_localadmin=0 
							)UNION( 
							SELECT 
								a.customertype_id as customertype_id, 
								a.customertype_name as customertype_name, 
								b.typerelation_customer_id as typerelation_customer_id 
							FROM 
								app_customertype a 
							LEFT JOIN 
								app_customer_type_relation b 
							ON 
								a.customertype_id = b.typerelation_customertype_id 
								AND 
								b.typerelation_customer_id= ".$customer_id." 
							WHERE 
								a.customertype_localadmin= ".$local_admin_id."
								AND 
								a.customertype_status = 'Y' 
								AND 
								a.customertype_isdeleted = 'Y' 
							) 
						) maintable";
		                 
		$query = $this->db->query($Sql);
		$Arr = $query->result_array();
		
		return $Arr;
	}	   
    public function showDetailsForEditCustomer($customer_id){
    	if($customer_id !=''){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql1=$this->db->query("SELECT	
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
										pass.user_id =".$customer_id);
                         
		$customerArr	= array();
		$row			= $sql1->row();
		
	
		
        if ($sql1->num_rows() > 0){
                $cus_fname			= $row->cus_fname;
                
                $cus_lname			= $row->cus_lname;
                $cus_address		= $row->cus_address;
                $cus_city			= $this->fn_city($row->cus_cityid);
                $cus_region			= $this->fn_region($row->cus_regionid);
                $cus_country		= $this->fn_country($row->cus_countryid);
                $cus_zip			= $row->cus_zip;
                $cus_mob			= $row->cus_mob;
                $cus_phn1			= $row->cus_phn1;
                $cus_phn2			= $row->cus_phn2;
                $customer_tag		= $row->customer_tag;
                $customer_info 		= $row->customer_info;
                $time_zone 			= $row->time_zone_id;
                $user_email 		= $row->user_email;
                $approval 			= $row->email_veri_status;
           }
  
          // $link='[<a href="javascript:void(0);" onclick="inviteCustomer('.$customer_id.')">Invite to schedule online</a>&nbsp|&nbsp;<a href="javascript:void(0);" onclick="displayEditCustomer('.$customer_id.')">Edit Customer </a>&nbsp|&nbsp;<a href="javascript:void(0);" onclick="deleteCustomer('.$customer_id.')">Delete Customer </a>]';
            $link='';
            $list=$cus_fname.'@@@'.$cus_lname.'@@@'.$user_email.'@@@'.$link.'@@@'.$cus_address.'@@@'.$cus_city.'@@@'.$cus_region.'@@@'.$cus_country.'@@@'.$cus_zip.'@@@'.$cus_mob.'@@@'.$cus_phn1.'@@@'.$cus_phn2.'@@@'.$time_zone.'@@@'.$customer_tag.'@@@'.$customer_info;
        }else{
            $list='';
        }
        return $list;
    }  
    public function deleteCustomer($del_cus_id){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        /*****      DELETE FROM RELATIONSHIP TABLE STARTS       *****/
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('customer_id',$del_cus_id);
        $this->db->delete('app_customer_admin_relationship');
        /*****      DELETE FROM RELATIONSHIP TABLE ENDS     *****/
        return "Deleted successfully";
    }
    public function region_ajax($country_id){
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
    public function city_ajax($region_id){
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
    //PR
    public function searchCustomer($cus_name_search){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $list='';
        $cu='';
        $trimmed_cus_name_search = trim(addslashes($cus_name_search));
        $qry = "  SELECT	
						cust.cus_id			AS customer_id,
						cust.cus_fname		AS cus_fname,
						cust.cus_lname		AS cus_lname,
						cust.cus_mob		AS cus_mob,
						pass.register_from	AS register_from
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
						(cust.cus_fname like '".$trimmed_cus_name_search."%' 
						OR
						cust.cus_lname like '".$trimmed_cus_name_search."%' 
						OR
						cust.cus_mob like '".$trimmed_cus_name_search."%' )";
             
        $sql1=$this->db->query($qry);
        $list='';
        if ($sql1->num_rows() > 0){
            foreach ($sql1->result() as $row){
                $icon = '';
                $title = '';
                $register_from = $row->register_from;
                if($register_from == 1){
                    $icon = 'admin_registered.png';
                    $title = 'Created By Admin';
                }elseif($register_from == 2){
                    $icon = 'self_registered.png';
                    $title = 'Self Registered';
                }elseif($register_from == 3){
                    $icon = 'google_registered.png';
                    $title = 'Self Registered using Google Account';
                }elseif($register_from == 4){
                    $icon = 'facebook_registered.png';
                    $title = 'Self Registered using Facebook Account';
                }
                $registeredFromIcon = '<img src="'.base_url().'/images/'.$icon.'" height="14" width="14" title="'.$title.'">';
                $list.='<div style="border-bottom:1px dashed #CCCCCC;height:40px;padding-left:10px;width:220px" class="select-customer" onclick="selectCustomer('.$row->customer_id.')">';
                $list.='<table width="100%"><tr>';
                $list.='<td>'.$registeredFromIcon.'<span>&nbsp;'.$row->cus_fname.' </span>&nbsp;';
                $list.='<span>'.$row->cus_lname.'</span></td>';
                $list.='<td align="right"><div style="text-align:right;color:#999999;">'.$row->cus_mob.'</div></td>';
                $list.='</tr></table>';
                $list.='</div>';
            }
        }else{
            $list='';
        }
        return $list;
    }
    public function addTag($tag,$customer_id){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array(
                    'customer_tag' => $tag
                );
        $data = $this->global_mod->db_parse($data);     
        $this->db->trans_begin();
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('customer_id', $customer_id);
        $this->db->update('app_customer_admin_relationship', $data); 
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
    public function addInfo($info,$customer_id){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array(
                   'customer_info' => $info
                );
        $data = $this->global_mod->db_parse($data);     
        $this->db->trans_begin();
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('customer_id', $customer_id);
        $this->db->update('app_customer_admin_relationship', $data); 
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
    public function upcomingAppointments($customer_id){
        $str = '';
        $str .= ' AND customer_id = '.$customer_id;
        $str .= ' AND srvDtls_service_start >= now()';
        $sql1=$this->global_mod->mainBookingStorePro($str);
        $html='<table width="100%" border="1" cellspacing="1" cellpadding="0">
        <tr class="silver">
            <th width="20%">'.$this->global_mod->db_parse($this->lang->line("date")).'</th>
            <th width="25%">'.$this->global_mod->db_parse($this->lang->line("Staff")).'</th>
            <th width="25%">'.$this->global_mod->db_parse($this->lang->line("service")).'</th>
            <th width="20%" align="right">'.$this->global_mod->db_parse($this->lang->line("amnt_paid")).'('.$this->session->userdata('local_admin_currency_type').') </th>
            <th width="10%">&nbsp;</th>    
        </tr>
        ';
        if (count($sql1) > 0)
        {
            foreach ($sql1 as $row)
            {
                $html.='<tr>
                            <td width="20%" align="center">'.$row['srvDtls_service_start'].'</td>
                            <td width="25%" align="center">'.$row['srvDtls_employee_name'].'</td>
                            <td width="25%" align="center">'.$row['srvDtls_service_name'].'</td>
                            <td width="20%" align="right">'.$row['srvDtls_service_cost'].'</td>
                            <td width="10%">&nbsp;</td>    
                       </tr>';
            }
        }
        else
        {
            $html.='<tr>
                        <td colspan="4" align="center">'.$this->lang->line("no_upcming_bking_avilable").'</td>
                   </tr>';
        }
        $html.='</table>';
        return $html;
    }
    public function pastAppointments($customer_id){
        $str = '';
        $str .= ' AND customer_id = '.$customer_id;
        $str .= ' AND srvDtls_service_start < now()';
        $sql1=$this->global_mod->mainBookingStorePro($str);
        $html='<table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr class="silver">
                <th>'.$this->global_mod->db_parse($this->lang->line("date")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("Staff")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("service")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("amnt_paid")).'</th>
            </tr>';
        if (count($sql1) > 0)
        {
            foreach ($sql1 as $row)
            {
                $html.='<tr>
                            <td align="center">'.$row['srvDtls_service_start'].'</td>
                            <td align="center">'.$this->global_mod->show_to_control($row['srvDtls_employee_name']).'</td>
                            <td align="center">'.$this->global_mod->show_to_control($row['srvDtls_service_name']).'</td>
                            <td align="center">'.$row['srvDtls_service_cost'].'</td>
                       </tr>';
            }
        }
        else
        {
            $html.='<tr>
                        <td colspan="4" align="center">'.$this->lang->line("no_past_bking_available").'</td>
                   </tr>';
        }
        $html.='</table>';
        return $html;
    }
    public function verify_Customer($customer_id){
       $data = array(
               'email_veri_status' => 1
            );
       $this->db->where('user_id',$customer_id);
       $this->db->update('app_password_manager',$data);
       echo '1';
    }
    public function send_Pass_to_Ajax($customer_id){
            $this->db->select('user_email,user_name,password');
            $this->db->from('app_password_manager');
            $this->db->where('user_id ',$customer_id);
            $query = $this->db->get();

            $Ret_Arr_val = $query->result_array();
    //echo '<pre>';print_r($Ret_Arr_val[0]);

            $names = array(2,3);
            $this->db->select('value');
            $this->db->from('app_local_customer_details');
            $this->db->where('customer_id ',$customer_id);
            $this->db->where_in('sign_upinfo_item_id', $names);
            $query1 = $this->db->get();
            $Ret_Arr_val_q = $query1->result_array();
    //echo '<pre>';print_r($Ret_Arr_val_q);

        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('user_email');
        $this->db->from('app_password_manager');
        $this->db->where('user_id ',$local_admin_id);
        $query2 = $this->db->get();

        $Ret_Arr_val_rr = $query2->result_array();
        //echo '<pre>';print_r($Ret_Arr_val_rr[0]['user_email']);exit;
        $from = $Ret_Arr_val_rr[0]['user_email'];

        /*****      QUERY TO GET LOCAL ADMIN DETAILS STARTS     *****/
        $localAdminDetails = $this->getLocalAdminDetails();
        $localAdminFullName = ucfirst($localAdminDetails[0]['first_name']).' '.ucfirst($localAdminDetails[0]['last_name']);
        /*****      QUERY TO GET LOCAL ADMIN DETAILS ENDS       *****/
        /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
        
        /*****      QUERY TO GET BUSINESS DETAILS ENDS      *****/
       
        #############################################
        
        
      
       $replacerArr = array(
						'{fname}' 					=> $Ret_Arr_val_q[0]['value'],
						'{lname}' 					=> $Ret_Arr_val_q[1]['value'],
						'{CurrentPassword}'			=> $Ret_Arr_val[0]['password']
						
			);

		$toArr		= $Ret_Arr_val[0]['user_email'];	
		$from		= $this->session->userdata('local_admin_email');
		
		$this->email_model->sentMail(12,$replacerArr,$toArr,$from);
		return 1;
    }
    public function local_admin_email(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('user_email');
        $this->db->from('app_password_manager');
        $this->db->where('user_id ',$local_admin_id);
        $query2 = $this->db->get();

        $Ret_Arr_val_rr = $query2->result_array();
        $from = $Ret_Arr_val_rr[0]['user_email'];
        return $from;
    }     
    //PR
    public function get_AllCustomer(){
            $result = array();
            $local_admin_id = $this->session->userdata('local_admin_id');
            $sql1=$this->db->query("SELECT	cust.cus_id AS user_id,
                                    		UPPER(SUBSTR(cust.cus_fname,1,1)) AS cus_fname
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
											rel.local_admin_id =".$local_admin_id);
                                                                                                
            if($sql1->num_rows() > 0){
                foreach ($sql1->result() as $row){
                    $result[] = $row->cus_fname;
                }
                    $result = array_unique($result);
            }
            return $result;
    }
    public function export_excel(){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql1=$this->db->query("SELECT * 
                            FROM 
                                vw_customerdetails vwc,
                                app_customer_admin_relationship rel
                            WHERE
                                vwc.user_id = rel.customer_id AND
                                rel.local_admin_id = '".$local_admin_id."'
                            ORDER BY 
                                vwc.user_id ASC
                              ");
        return $sql1->result();
    }  
    public function ChangePasswordModel($customer_id,$newpassword){
		$local_user_password = "";
        $sql=$this->db->query("SELECT * from app_password_manager  where user_id='".$customer_id."'");
        foreach ($sql->result() as $row){
            $local_user_password=$row->password; 
        }
        $this->db->trans_begin();
        $this->db->where('user_id',$customer_id);
        $this->db->where('user_type',1);
        $data = array('password' =>$newpassword);
        $data = $this->global_mod->db_parse($data);
        $this->db->update('app_password_manager ', $data);
        if ($this->db->trans_status() === FALSE){
            //echo '0';
            $this->db->trans_rollback();
            return 0;
        }else{
            $this->db->trans_commit();
           // echo '1';
           return 1;
        }
	}	
	public function GetUserDetails($customerid){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql = 'select 
   					c.value,user.user_email 
				FROM 
  					app_local_customer_details AS c
				LEFT JOIN
  					app_password_manager AS user
				ON 
					c.customer_id=user.user_id
				WHERE	
  					c.local_admin_id="'.$local_admin_id.'" 
  				AND
  					c.customer_id="'.$customerid.'"
  				AND
  					c.sign_upinfo_item_id IN(2,3)';
  					
		$query = $this->db->query($sql);
        $return = $query->result_array();		
        return $return;
		
	}	
	public function savePersonalDetails($customer_id,$customer_birth,$customer_anniversary){
	 $data = array(
                'cus_dob'        => $customer_birth,
                'cus_anv_date'   => $customer_anniversary
            );
            $this->db->where('cus_id',$customer_id);
            $this->db->update('app_customer_search', $data);		
	}	
	public function saveSelectGroup($customer_id,$groupIds){
		$pieces = explode(",", $groupIds);
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->where('typerelation_customer_id', $customer_id);
		$this->db->where('typerelation_localadmin',$local_admin_id);
		$this->db->delete('app_customer_type_relation');
		foreach($pieces AS $piecesArr=>$val){
			
			$insert= array(
			    'typerelation_customer_id'		=> $customer_id,
			    'typerelation_customertype_id'	=> $val,
			    'typerelation_localadmin'		=> $local_admin_id
			);
			$this->db->insert('app_customer_type_relation',$this->db->escape($insert));			
		}		
	}
	public function selectPersonalDetails($customer_id){
			$Sql="SELECT cus_dob,cus_anv_date FROM app_customer_search WHERE cus_id=".$customer_id;		                 
		$query = $this->db->query($Sql);
		$Arr = $query->result_array();
		return $Arr;
	}		
	public function countryOfUser($customerId){
		$sql1 = 'SELECT
                      cus_countryid
                 FROM
                 	  app_customer_search
                 WHERE
                      cus_id="'.$customerId.'"';
        $query = $this->db->query($sql1);
        $nameCountry = $query->result_array();  
        
        if(count($nameCountry)== 0){
			$local_admin_id = $this->session->userdata('local_admin_id');
			$sql = 'SELECT
						 country_id
					FROM
						app_local_admin
					WHERE
						local_admin_id="'.$local_admin_id.'"		 
				    ';
			$query = $this->db->query($sql);
        	$Arr = $query->result_array();	
        	$nameCountry[0]['cus_countryid'] = $Arr[0]['country_id'];  
			
		}
		
		
		$sql = 'SELECT 
		             country_id,
		             country_name
		        FROM
		             app_countries
		        WHERE
		             is_active="Y"
		       ';
		$query = $this->db->query($sql);
        $country = $query->result_array();   
        
         
        
        $countryDesign ='<select name="country_id" id="cus_countryid_5" onfocus="clr_reg_values(this.id)" class="text-input required" onChange="st(this.value)" style=" width:41.3%;">
        <option value="" >----Select Country---</option>';
        foreach($country AS $val){
        	if(isset($nameCountry)){
				if($val['country_id'] == $nameCountry[0]['cus_countryid'])
	            {
	                $country_id_selected="selected";
	            }
	            else
	            {
	                $country_id_selected="";
	            }
			}	
        	
        	
           $countryDesign.="<option value=".$val['country_id']." ".$country_id_selected.">".$val['country_name']."</option>";
      
		}
		$countryDesign.='</select>';
		return $countryDesign;
                   
	}	
	public function regionOfUser($customerId){
		
		$sql = 'SELECT 
		             cus_regionid,
		             cus_countryid
		        FROM
		             app_customer_search
		        WHERE
		             cus_id="'.$customerId.'"
		       ';
		$query = $this->db->query($sql);
        $country = $query->result_array();
        
        if($country[0]['cus_countryid'] != ''){
			$sql1 = 'SELECT
        				region_id,
        				region_name
        		 FROM 
        		     	app_regions
        		 WHERE
        		 		country_id="'.$country[0]['cus_countryid'].'"
        		 AND
        		 		is_actives="Y"		    	
                ';
            $query = $this->db->query($sql1);
        	$regions = $query->result_array(); 
		}else{
			$local_admin_id = $this->session->userdata('local_admin_id');
			$sql = 'SELECT 
      						r.region_id,
      						r.region_name
					FROM
      						app_regions r
					JOIN
      						app_local_admin admin
					ON
      						admin.country_id=r.country_id
					WHERE
      						admin.local_admin_id="'.$local_admin_id.'" 
				    ';
			$query = $this->db->query($sql);
        	$regions = $query->result_array();	
        	
		}
		
		 $region ='<select name="region_id" id="cus_regionid_6" onfocus="clr_reg_values(this.id)"  onChange="re(this.value)" class="required" style=" width:41.3%;">
        <option value="">---Select Region---</option>';
        
        foreach($regions AS $val){
			
            if($val['region_id'] == $country[0]['cus_regionid'])
            {
                $region_id_selected="selected";
            }
            else
            {
                $region_id_selected="";
            }
            $region.="<option value=".$val['region_id']." ".$region_id_selected.">".$val['region_name']."</option>";
        }
        $region.='</select>';
        return $region;	
	}	
	public function cityOfUser($customer_id){
		$sql = 'SELECT
					  cus_cityid,
					  cus_regionid
				FROM
					  app_customer_search
				WHERE
					  cus_id="'.$customer_id.'"	  	  
				';
		$query = $this->db->query($sql);
        $cityId = $query->result_array();	
        
        if($cityId[0]['cus_regionid'] != ''){
			$sql1 = 'SELECT
							city_id,
							city_name
					 FROM
					 		app_cities
					 WHERE
					 		region_id="'.$cityId[0]['cus_regionid'].'"				
					';
			$query = $this->db->query($sql1);
        	$cities = $query->result_array();	
        	
        	
		}	
		else{
			$local_admin_id = $this->session->userdata('local_admin_id');
			$sql = 'SELECT 
      						c.city_id,
      						c.city_name
					FROM
      						app_cities c
					JOIN
      						app_local_admin admin
					ON
      						admin.region_id=c.region_id
					WHERE
      						admin.local_admin_id="'.$local_admin_id.'" 
				    ';
			$query = $this->db->query($sql);
        	$cities = $query->result_array();
		}
		$city='<select name="city_id" id="cus_cityid_7" class="required" onfocus="clr_reg_values(this.id)"  style="width:41.3%; margin:0 5px 4px 0;">
                    <option value="">-----Select City-----</option>';
       
        foreach ($cities as $row)
        {
            
            if($row['city_id'] == $cityId[0]['cus_cityid'])
            {
                $city_id_selected="selected";
            }
            else
            {
                $city_id_selected="";
            }
            $city.="<option value=".$row['city_id']." ".$city_id_selected.">".$row['city_name']."</option>";
        }
        $city.='</select>';	
		
		return $city;	
	}
}
?>