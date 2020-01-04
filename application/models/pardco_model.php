<?php
class Pardco_Model extends CI_Model {	
    function customerStatus(){
        $this->load->database();
        $customerStatus='<select name="clientStatus" id="clientStatus" class="text-input required">
                            <option value="" >All</option>';
        $this->load->database();
        $sql=$this->db->query("SELECT cc . *
                                    FROM app_pardco_code_code cc, app_pardco_code_type_master ct
                                    WHERE cc.code_type_master_id = ct.code_type_master_id
                                    AND ct.code = 'Customer_Status' order by cc.code_order");
         foreach ($sql->result() as $row){
            $status_value=$row->code_code;
            $status_show_value=$row->code_value;
            $customerStatus.="<option value=".$status_value.">".$status_show_value."</option>";
         }
        $customerStatus.='</select>';	
        return $customerStatus;		
    }
     
    public function pardco_left_menu(){
	$language_id = $this -> get_admin_language_id($this->db, $this->session->userdata('local_admin_id'));
        $PardcoMenuLeft = array();
        $MenuArrP = array();
        $MenuArrC = array();

	$sql = 'SELECT `menu`.`admin_menu_id`, `menu`.`page_link`, `translation`.`menu_name`
		FROM `app_admin_menu` AS `menu`
		LEFT JOIN `app_admin_menu_translation` AS `translation` ON `menu`.`admin_menu_id` = `translation`.`admin_menu_id`
		WHERE `menu`.`status` = 1
		AND `menu`.`parent` = 0
		AND `menu`.`position` = ?
		AND `menu`.`menu_authorization` = 2
		AND `translation`.`language_id` = ?
		ORDER BY `menu`.`order` ASC';
	$query = $this -> db -> query($sql, array('L', $language_id));
        $ResultArr = $query->result_array();

        $Num = count($ResultArr);

        for($i=0; $i<$Num; $i++){
            $MenuArrP['menu_name'] = $ResultArr[$i]['menu_name'];
            $MenuArrP['page_link'] = $ResultArr[$i]['page_link'];
            $PardcoMenuLeft[$i]['parent'] = $MenuArrP;

	    $sql = 'SELECT `menu`.`admin_menu_id`, `menu`.`page_link`, `translation`.`menu_name`
		FROM `app_admin_menu` AS `menu`
		LEFT JOIN `app_admin_menu_translation` AS `translation` ON `menu`.`admin_menu_id` = `translation`.`admin_menu_id`
		WHERE `menu`.`status` = 1
		AND `menu`.`parent` = ' . $ResultArr[$i]['admin_menu_id'] . '
		AND `menu`.`position` = ?
		AND `menu`.`menu_authorization` = 2
		AND `translation`.`language_id` = ?
		ORDER BY `menu`.`order` ASC';
	    $query = $this -> db -> query($sql, array('L', $language_id));
            $MenuArrC = $query->result_array();
            $PardcoMenuLeft[$i]['child'] = $MenuArrC;
        }	
        return $PardcoMenuLeft;
    }
	
    public function pardco_right_menu(){
	$language_id = $this -> get_admin_language_id($this->db, $this->session->userdata('local_admin_id'));

        $PardcoMenuRight = array();
        $MenuArrP = array();
        $MenuArrC = array();
	
	$sql = 'SELECT `menu`.`admin_menu_id`, `menu`.`page_link`, `translation`.`menu_name`
		FROM `app_admin_menu` AS `menu`
		LEFT JOIN `app_admin_menu_translation` AS `translation` ON `menu`.`admin_menu_id` = `translation`.`admin_menu_id`
		WHERE `menu`.`status` = 1
		AND `menu`.`parent` = 0
		AND `menu`.`position` = ?
		AND `menu`.`menu_authorization` = 2
		AND `translation`.`language_id` = ?
		ORDER BY `menu`.`order` ASC';
	$query = $this -> db -> query($sql, array('R', $language_id));
        $ResultArr = $query->result_array();
        $Num = count($ResultArr);
        for($i=0; $i<$Num; $i++){
            $MenuArrP['menu_name'] = $ResultArr[$i]['menu_name'];
            $MenuArrP['page_link'] = $ResultArr[$i]['page_link'];
            $PardcoMenuRight[$i]['parent'] = $MenuArrP;
	    $sql = 'SELECT `menu`.`admin_menu_id`, `menu`.`page_link`, `translation`.`menu_name`
		FROM `app_admin_menu` AS `menu`
		LEFT JOIN `app_admin_menu_translation` AS `translation` ON `menu`.`admin_menu_id` = `translation`.`admin_menu_id`
		WHERE `menu`.`status` = 1
		AND `menu`.`parent` = ' . $ResultArr[$i]['admin_menu_id'] . '
		AND `menu`.`position` = ?
		AND `menu`.`menu_authorization` = 2
		AND `translation`.`language_id` = ?
		ORDER BY `menu`.`order` ASC';
	    $query = $this -> db -> query($sql, array('R', $language_id));
            $MenuArrC = $query->result_array();
            $PardcoMenuRight[$i]['child'] = $MenuArrC;
        }
        return $PardcoMenuRight;
    }
	
	public function pardco_location(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
        $service = array();
        $sql = "SELECT 
            pass.user_name AS usernm,
            locala.relation_localadmin_id AS localid
        FROM 
            app_password_manager AS pass, 
            app_localadmin_relation AS locala 
        WHERE 
            locala.relation_localadmin_id = pass.user_id AND 
            locala.is_parent = 1 AND 
            locala.relation_parent_id = '".$local_admin_id."'";
      $a = $this->db->query($sql);
       $result = $a->result() ;
       return $result;
	}
	
    public function employee(){
        $local_admin_id		= $this->session->userdata('local_admin_id');
        $employee = array();
        $sql = "SELECT 
            distinct ae.* 
        FROM 
            app_biz_hours AS abh, 
            app_employee AS ae 
        WHERE 
            ae.employee_id = abh.employee_id AND 
            ae.is_active = 'Y' AND 
            abh.local_admin_id = '".$local_admin_id."'";
        $a=$this->db->query($sql);
        if($a->num_rows() > 0){
            foreach ($a->result() as $key=>$row){
                $employee[$key]['name']=$row->employee_name;
                $employee[$key]['id']=$row->employee_id;
            }
        }
        return $employee;
    }																			

    public function service(){
        $local_admin_id		= $this->session->userdata('local_admin_id');
        $service = array();
        $sql = "SELECT 
            distinct ser.* 
        FROM 
            app_biz_hours AS abh, 
            app_service AS ser 
        WHERE 
            ser.service_id = abh.service_id AND 
            ser.is_active = 'Y' AND 
            abh.local_admin_id = '".$local_admin_id."'";
        $a = $this->db->query($sql);
        if(count($a->result()) > 0){
            foreach ($a->result() as $key=>$row){
                $service[$key]['name']=$row->service_name;
                $service[$key]['id']=$row->service_id;
            }
            return $service;
        }
    }																			
	
    public function frontend_menu(){
        $user_login = $this->session->userdata('logged_in_customer');
        $PardcoMenuRight = array();
        $MenuArrP = array();
        $MenuArrC = array();

        if($user_login != ''){
            $this->db->select('admin_menu_id,menu_name,page_link');
            $this->db->from('app_admin_menu');
            $this->db->where('status', 1);
            $this->db->where('parent', 0);
            $this->db->where('position', 'R');
            $this->db->where('menu_authorization', '3');
            $this->db->order_by("order", "asc"); 
            $query = $this->db->get();
            $ResultArr = $query->result_array();

            $Num = count($ResultArr);

            for($i=0; $i<$Num; $i++){
                $MenuArrP['menu_name'] = $ResultArr[$i]['menu_name'];
                $MenuArrP['page_link'] = $ResultArr[$i]['page_link'];
                $PardcoMenuRight[$i]['parent'] = $MenuArrP;

                $this->db->select('menu_name,page_link');
                $this->db->from('app_admin_menu');
                $this->db->where('status', 1);
                $this->db->where('position', 'R');
                $this->db->where('menu_authorization', '3');
                $this->db->where('parent', $ResultArr[$i]['admin_menu_id']);
                $query = $this->db->get();
                $MenuArrC = $query->result_array();
                $PardcoMenuRight[$i]['child'] = $MenuArrC;
            }
        }
        return $PardcoMenuRight ;
    }
	
  /*  public function footer_link_frontend(){
        $LinkArr = array();
        $SuperAdminFooterLink = array();

        $this->db->select('facebook_link,youtube_link,google_link,twitter_link,linkedin_link');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
        $query = $this->db->get();
        $Arr = $query->result_array();

        $SuperAdminFooterLink = $this->footer_link();

        if($Arr[0]['facebook_link'] != ''){
            $LinkArr['facebook_link'] = $Arr[0]['facebook_link'];
        }else{
            $LinkArr['facebook_link'] = $SuperAdminFooterLink['facebook_link'];
        }

        if($Arr[0]['youtube_link'] != ''){
            $LinkArr['youtube_link']  = $Arr[0]['youtube_link'];
        }else{
            $LinkArr['youtube_link'] = $SuperAdminFooterLink['youtube_link'];
        }

        if($Arr[0]['google_link'] != ''){
            $LinkArr['google_link']   = $Arr[0]['google_link'];
        }else{
            $LinkArr['google_link']   =  $SuperAdminFooterLink['google_link'];
        }

        if($Arr[0]['twitter_link'] != ''){
            $LinkArr['twitter_link']  = $Arr[0]['twitter_link'];
        }else{
            $LinkArr['twitter_link']  =   $SuperAdminFooterLink['twitter_link'];
        }

        if($Arr[0]['linkedin_link'] != ''){
            $LinkArr['linkedin_link'] = $Arr[0]['linkedin_link'];
        }else{
            $LinkArr['linkedin_link'] =   $SuperAdminFooterLink['linkedin_link'];
        }
        return $LinkArr;
    }  */
    
    
     public function footer_link_frontend(){
     	$LinkArr = array();
     	$this->db->select('facebook_link,youtube_link,google_link,twitter_link,linkedin_link');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
        $query = $this->db->get();
        $Arr = $query->result_array();
        
        if($Arr[0]['facebook_link'] != ''){
            $LinkArr['facebook_link'] = $Arr[0]['facebook_link'];
        }else{
            $LinkArr['facebook_link'] = '';
        }

        if($Arr[0]['youtube_link'] != ''){
            $LinkArr['youtube_link']  = $Arr[0]['youtube_link'];
        }else{
            $LinkArr['youtube_link'] = '';
        }

        if($Arr[0]['google_link'] != ''){
            $LinkArr['google_link']   = $Arr[0]['google_link'];
        }else{
            $LinkArr['google_link']   =  '';
        }

        if($Arr[0]['twitter_link'] != ''){
            $LinkArr['twitter_link']  = $Arr[0]['twitter_link'];
        }else{
            $LinkArr['twitter_link']  =   '';
        }

        if($Arr[0]['linkedin_link'] != ''){
            $LinkArr['linkedin_link'] = $Arr[0]['linkedin_link'];
        }else{
            $LinkArr['linkedin_link'] =   '';
        }
        return $LinkArr;
        
     }	
    
	
    public function footer_link(){
        $LinkArr = array();

        $this->db->select('*');
        $this->db->from('app_superadmin_share_link');
        $query_super = $this->db->get();
        $Arr_super = $query_super->result_array();

        $this->db->select('facebook_link,youtube_link,google_link,twitter_link,linkedin_link');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
        $query = $this->db->get();
        $Arr = $query->result_array();
        if(count($Arr) > 0){
            $LinkArr['facebook_link'] = ($Arr[0]['facebook_link']!='')?$Arr[0]['facebook_link']:$Arr_super[0]['superadmin_facebook'];
            $LinkArr['youtube_link']  = ($Arr[0]['youtube_link']!='')?$Arr[0]['youtube_link']:$Arr_super[0]['superadmin_youtube'];
            $LinkArr['google_link']   = ($Arr[0]['google_link']!='')?$Arr[0]['google_link']:$Arr_super[0]['superadmin_google'];
            $LinkArr['twitter_link']  = ($Arr[0]['twitter_link']!='')?$Arr[0]['twitter_link']:$Arr_super[0]['superadmin_twitter'];
            $LinkArr['linkedin_link'] = ($Arr[0]['linkedin_link']!='')?$Arr[0]['linkedin_link']:$Arr_super[0]['superadmin_linkedin'];
        }
        return $LinkArr;
    }
	
    public function footer_link_superadmin(){
        $this->load->database();
        $this->load->helper('url');

        $LinkArr = array();

        $this->db->select('*');
        $this->db->from('app_superadmin_share_link');
        $query_super = $this->db->get();
        $Arr_super = $query_super->result_array();

        if(count($Arr_super) > 0){
            $LinkArr['facebook_link'] = $Arr_super[0]['superadmin_facebook'];
            $LinkArr['youtube_link']  = $Arr_super[0]['superadmin_youtube'];
            $LinkArr['google_link']   = $Arr_super[0]['superadmin_google'];
            $LinkArr['twitter_link']  = $Arr_super[0]['superadmin_twitter'];
            $LinkArr['linkedin_link'] = $Arr_super[0]['superadmin_linkedin'];                 
        }
        return $LinkArr;
    }

    public function Check_local_admin($LocalAdminName){
        $this->db->select('user_id');
        $this->db->from('app_password_manager');
        $this->db->where('user_name', $LocalAdminName);
        $query_super = $this->db->get();
        $Arr_super = $query_super->result_array();
        return $Arr_super[0]['user_id'];
    }

	public function gotolocaladminueser($local_id){
        $sql = "SELECT user_name 
        FROM 
            app_password_manager
        WHERE
        	user_id = '".$local_id."'";
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['user_name'];
	}
	 public function admin_language(){
        $this->db->select('*');
        $this->db->from('app_languages');
		$this->db->where('status', 1);
        $query_languages = $this->db->get();
        $Arr_languages= $query_languages->result_array();
        return $Arr_languages;
    }
	
	private function get_admin_language_id()
	{
		$lang = $this -> session -> userdata('admin_language');
		$sql = 'SELECT `languages_id` 
			FROM `app_languages` 
			WHERE `languages_name` = ?';
		$result = $this -> db -> query($sql, array($lang));
		
		if (!$result -> num_rows)
		{
			$this -> config -> item('default_language_id');
		}
		$row = $result -> row();
		return (int) $row -> languages_id;
}
}
?>
