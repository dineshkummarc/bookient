<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login_model extends CI_Model{
	public function login_check($user_email,$password){
            $local_admin_id = $this->session->userdata('local_admin_id');
           	$sql="SELECT 
						* 
						FROM 
							app_password_manager
            			WHERE 
							user_email='".$user_email."' 
						AND  
							password='".$password."' 
						AND  
							user_id='".$local_admin_id."' 
						AND 
							user_type='3'";
		    $query = $this->db->query($sql);
		    $status_checkquery =  $this->db->query("SELECT is_active FROM app_local_admin WHERE  local_admin_id='".$local_admin_id."'");
            if($status_checkquery->num_rows() > 0){
                $status_check = $status_checkquery->row();
                //print_r($status_check->is_active);exit;
                $admin_status = $status_check->is_active;
            }else{
                    $admin_status="N";
            }
			//echo $query->num_rows();
            if ($query->num_rows() > 0 && $admin_status =='Y'){
                $row = $query->row();
                if($row->email_veri_status == 1 ){
                    $user_type   = $row->user_type;
                    if($user_type == 3){
                        $this->db->select('app_time_zone.gmt_symbol, app_time_zone.gmt_value');
                        $this->db->from('app_time_zone');
                        $this->db->join('app_local_admin', 'app_local_admin.time_zone_id = app_time_zone.time_zone_id');
                        $query = $this->db->get();
                        $ResArr =  $query->result();
                        $time_diff = (($ResArr[0]->gmt_symbol == 1)?'-':'').$ResArr[0]->gmt_value;
                        
                        $set_user_data = array(
                           'user_name'              => $row->user_name,
                           //'user_name'              => $this->check_name($row->user_id),
                           'user_id'                => $row->user_id,
                           'user_id_local_admin'    => $row->user_id,
                           'user_type'              => $row->user_type,
                           'time_difference'        => $time_diff,
                           'is_super_admin'         => FALSE,
                           'logged_in'              => TRUE,
						   'admin_language' 		=> $this->getDefaultLang($row->user_id)
                        );
                        
                      	//$this->global_mod->GetBusinessDetails($row->user_id);       ///  Get Admin Business Details and create session
                       // $this->global_mod->GetLocalAdminAuth($row->user_id);       ///  Get Admin Business Details and create session
    
                    }else{
                        $set_user_data = array(
                                'user_name'      => $row->user_name,
                                //'user_name'      => $this->check_name($row->user_id),
                                'user_id'        => $row->user_id,
                                'user_type'      => $row->user_type,
                                'is_super_admin' => FALSE,
                                'logged_in'      => TRUE,
								'admin_language' => $this->getDefaultLang($row->user_id)
								
                        );
                    }
	                   $this->session->set_userdata($set_user_data);
	                   return '1';
                }else{
                    $resend_email = array(
                                      'user_id_resend_email'   => $row->user_id
                              );
                    $this->session->set_userdata($resend_email);
                    return '2';
                }
                
                
                
            }else{
              return '0';
            }
	}

    public function check_name($id){
    $this->db->select('first_name');
	$this->db->from('app_local_admin');
	$this->db->where('local_admin_id',$id);
	$query = $this->db->get();
	$ResArr =  $query->result();
	//echo '<pre>';print_r($ResArr[0]->first_name);exit;
            return $ResArr[0]->first_name;
    }
		
	public function getDefaultLang($local_admin_id){
        $this->db->select('app_local_admin_gen_setting.default_language_id,app_languages.languages_name');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->join('app_languages', 'app_languages.languages_id = app_local_admin_gen_setting.default_language_id');
		$this->db->where('local_admin_id',$local_admin_id);			
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			$row     		= $query->row();
			$languages_name = strtolower($row->languages_name);
		}
		else{
			$languages_name	= 'english';
		}			
		return $languages_name;					
    }
     
    public function checkResetPassword(){
		$local_admin_id = $this->session->userdata('local_admin_id');
       	$sql="SELECT 
					f_password
					FROM 
						app_password_manager
        			WHERE  
						user_id='".$local_admin_id."' 
					AND 
						user_type='3'";
	    $query = $this->db->query($sql);
	    $ResArr =  $query->result();
	    if($ResArr[0]->f_password==''){
	    	return FALSE;
	    }else{
	    	return TRUE;
	    }
	}   
        
	public function changePassword($re_pass,$re_nw_pass){
		$this->db->select('*');
		$this->db->from('app_password_manager');
		$this->db->where('f_password',$re_pass);
		$this->db->where('user_type',3);
		$query = $this->db->get();
		$ResArr =  $query->result();
		if(count($ResArr)>0){
			$data = array(
			     		 'f_password' => '',
			     		 'password'=> $re_nw_pass
			 			);
			$this->db->where('user_type', 3);
			$this->db->where('f_password', $re_pass);
			$this->db->update('app_password_manager',$this->db->escape($data));
			echo 1;			
		}else{
			echo 2;
		}
		
	}	
		
}
?>