<?php
class Registration_model extends CI_Model
{ 
    function insert_to_password_manager($insert_app_password_manager)
    {
        $this->db->trans_begin();
        $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
        $user_id=$this->db->insert_id();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $user_id;
        }  		
    }
	
	 function insert_to_relation_manager($insert_app_relation_manager)
    {
        $this->db->trans_begin();
        $this->db->insert('app_localadmin_relation',$this->db->escape($insert_app_relation_manager));
        $user_id=$this->db->insert_id();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return $user_id;
        }  		
    }
	
	function app_design_offer_manager($data){
        $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('app_design_offer',$this->db->escape($data));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        } 	
    }

    function insert_app_custom_color_scheme($insert_app_custom_color_scheme)
    {
        $this->db->trans_begin();
        $this->db->insert('app_custom_color_scheme',$this->db->escape($insert_app_custom_color_scheme));
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }  		
    }

    function insert_to_db($data){
        $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('app_local_admin',$this->db->escape($data));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        } 	
    }

    function insert_app_local_admin_gen_setting_clint_signup_info($local_admin_id){
        $this->load->database();
        $insert_list=array(
            'cus_fname' 	=>'2',
            'cus_lname' 	=>'3',
            'cus_address' 	=>'4',
            'cus_countryid'     =>'5',
            'cus_regionid' 	=>'6',
            'cus_cityid' 	=>'7',
            'cus_mob'           =>'9',
            'cus_phn1'          =>'10',
            'cus_phn2'          =>'11',
            'time_zone_id' 	=>'21',
        );
        foreach($insert_list as $key => $sign_upinfo_item_id)  //for each field
        {
            $insert_app_local_admin_gen_setting_clint_signup_info = array(
                       'local_admin_id'         => $local_admin_id,
                       'sign_upinfo_item_id'    => $sign_upinfo_item_id,
                       'mandetory'              => '0',
                       'disp_on_screen'         => '1',
                       'status '                => '1',
            );
            $this->db->trans_begin();
            $this->db->insert('app_local_admin_gen_setting_clint_signup_info',$this->db->escape($insert_app_local_admin_gen_setting_clint_signup_info));

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

    function profession()
    {
        $profession='<select name="profession" id="profession" class="text-input required">
                                          <option value="" >select</option>';  
        $this->load->database();
        $a=$this->db->query("SELECT * from app_profession where is_active='Y'");

        foreach ($a->result() as $row)
        {
            $profession_name=$row->profession_name;
            $profession_id=$row->profession_id;
            $profession.='<option value="'.$profession_id.'">'.$profession_name.'</option>';
        }
        $profession.='</select>';
        return $profession;		
    }

    function country()
    {
        $country='<select name="country" id="country" class="text-input required">
        <option value="" >select</option>';
        $this->load->database();
        $sql=$this->db->query("SELECT * FROM app_countries WHERE is_active='Y' ORDER BY country_name");
        foreach ($sql->result() as $row)
        {
            $country_name=$row->country_name;
            $country_id=$row->country_id;
            $country.="<option value=".$country_id.">".$country_name."</option>";
        }

        $country.='</select>';	
        return $country;		
    }

    public function check_user_name($username)
    {
        $this->load->database();
        $this->db->select('user_id');
        $this->db->from('app_password_manager');
        $this->db->where('user_name', $username);
        $query = $this->db->get();
        $ResArr =  $query->result_array();
        return $CountRes = count($ResArr);
    }

    function insert_app_local_admin_gen_setting($value)
    {
        $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('app_local_admin_gen_setting',$this->db->escape($value));
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

    function insert_app_appoint_cancellation_policy($value)
    {
        $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('app_appoint_cancellation_policy',$this->db->escape($value));
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

    function insert_app_cms($cmsData)
    {
        $this->load->database();
        $this->db->trans_begin();
        foreach($cmsData as $value){
            $this->db->insert('app_cms',$this->db->escape($value));
        }
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

    function checkEmail($email)
    {
        $this->db->where('user_email', $email);
        $this->db->from('app_password_manager');
        $count = $this->db->count_all_results();
        return $count;
    }
    
    public function getSuperAdminDetails(){
        $this->db->select('user_name, user_email');
        $this->db->from('app_password_manager');
        $this->db->where('user_id', $this -> config -> item('superadmin_id'));
        $query = $this->db->get();
        $superArr = $query->result_array();
        return $superArr;
    }
     
    function checkUserName($uname){
        $this->db->where('user_name', $uname);
        $this->db->from('app_password_manager');
        $count = $this->db->count_all_results();
        return $count;
    }
	
	function savePlanData($plandata) {
		$this->db->insert('app_member_plan_subscription',$this->db->escape($plandata));
	}
	
	function InsertProfession($profession){
		$sql = 'SELECT (MAX(profession_order)+1) AS `order` FROM app_profession';
		$query = $this->db->query($sql);
		$order = $query->result();
		
		$sql = 'INSERT INTO app_profession(profession_name,is_active,profession_order) VALUES("'.$profession.'","Y",'.$order[0]->order.')';
		$query = $this->db->query($sql);
		$id = $this->db->insert_id();
		return $id;
		
	}
	
}
