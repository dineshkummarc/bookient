<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Addlocation extends Pardco{
	public function __construct(){ 
		parent::__construct();
		$this->load->model('admin/addlocation_model');
		$this->load->model('registration_model'); 
        $this->load->model('email_verification_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id){
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_addlocation',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_addlocation',$setLanguage);
        }
		/*########End Language#######*/
		
		
	}
	
	public function fn_addlocation(){
		
		if($this->ck_currentPlan() == 1){
			if($this->chk_isCurrentPaln() == 0){
				$str= $this->lang->line("cn_nt_add_more_thn_1_loc").' <a href="javascript:void(0);" onclick="goToMemberShip()">'.$this->lang->line("upgrade_ur_ac").'</a>';
			}else{
				$str =$this->addLocationHTML();
			}
			
		}else{
			$str = $this->lang->line("rht_nw_u_hv_nt_memshp").' '.'<a href="javascript:void(0);" onclick="goToMemberShip()">'.$this->lang->line("pls").' '.$this->lang->line("upgrade_ur_ac").'</a>';
		}
		
		echo $str;
	}
	
	public function ck_currentPlan(){
		//1 for admin in paln; 0 for not in plan
	//	$inPlan = $this->addlocation_model->ck_currentPlan_mod();
	//	return count($inPlan);
	return 1;
	}
	
	public function chk_isCurrentPaln(){
		return 1; //1 for in plan; 0 for excluding plan
	}
	
	public function addLocationHTML(){
	$str ='<form id="form-sign-up" class="from_registred_admin" action="" method="post">';
	$str .='<fieldset>';
	$str .='<h3>'.$this->lang->line('heading_main').'</h3>';
	$str .='<ol>';
	$str .='<li class="form-row"><label>'.$this->lang->line('url').'</label>';
	$str .='<input name="user_name" type="text" class="text-input required username" />.bookient.com';
	$str .=' <div id="userErr"></div> ';
	$str .='</li>';
	$str .='<li class="form-row large_input"><label>'.$this->lang->line('email').'</label>';
	$str .='<input name="register-email" type="text" id="register-email" class="text-input required email" /><div id="err"></div>';
	$str .='</li>';
	$str .='<li class="form-row large_input"><label>'.$this->lang->line('password').'</label>';
	$str .='<input name="password1" type="password" id="password-1" class="text-input required password" />';
	$str .='</li>';
	$str .='<li class="form-row large_input"><label>'.$this->lang->line('repeat_password').'</label>';
	$str .='<input name="password2" type="password" id="password-2" class="text-input required password" />';
	$str .='</li> ';
	$str .='<br/><br/>';
	$str .='<h3>'.$this->lang->line('administrator_ac').'</h3>';
	$str .='<li class="form-row"><label>'.$this->lang->line('name').'</label>';
	$str .='<input name="firstname" placeholder="First name" id="firstname" type="text" class="text-input required" /> ';
	$str .='<input name="lastname" placeholder="Last name" type="text" id="lastname" class="text-input required" />';
	$str .='</li>';
	$str .='<li class="form-row"><label>'.$this->lang->line('profession').'</label>';
	$str .=$this->registration_model->profession();
	$str .='</li>';
	$str .='<li class="form-row"><label>'.$this->lang->line('country').'</label>';
	$str .=$this->registration_model->country();
	$str .='</li>';
	$str .='<li class="button-row">';
	$str .='<input type="hidden" id="localAdmin" value="'.$this->session-> userdata('user_id').'"></input>';
	$str .='<input type="button" class="btn-blue" value="'.$this->lang->line('create_ac_btn').'" alt="Go" class="btn-submit-login img-swap" id="btn-submit-register" /> ';
	$str .='</li>';
	$str .='</ol>';
	$str .='</fieldset>';
	$str .='</form>';
	return $str;
	}
	
	
	
	
	
}
?>