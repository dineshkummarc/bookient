<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business extends Pardco {

	public function __construct(){
		parent::__construct();
                error_reporting(0);
		$this->load->model('admin/business_model');
		/*===================LogIn Security Check===================*/
		  /*$logged_in_Status = $this->session->userdata('logged_in');
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
            $this->lang->load('admin_business',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_business',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*######## End Language #######*/
		
		
		
	}

	public function index($success=''){
		
		
		$this->load->view('admin/header');

		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);

		$list=$this->business_model->select_from_db();
		$list['country']=$this->business_model->country();
		
		$region=$this->business_model->region();
		$list['region']=$region;
		$city=$this->business_model->city();
		$list['city']=$city;

		$business_name   		=isset($_REQUEST['business_name'])?$_REQUEST['business_name']:'';
		$business_description	=isset($_REQUEST['business_description'])?$_REQUEST['business_description']:'';
		$page_title  			=isset($_REQUEST['page_title'])?$_REQUEST['page_title']:'';
		$business_tag       	=isset($_REQUEST['business_tag'])?$_REQUEST['business_tag']:'';
		$business_location 		=isset($_REQUEST['business_location'])?$_REQUEST['business_location']:'';
		$region   				=isset($_REQUEST['region'])?$_REQUEST['region']:'';
		$city      				=isset($_REQUEST['city'])?$_REQUEST['city']:'';
		$business_zip_code   	=isset($_REQUEST['business_zip_code'])?$_REQUEST['business_zip_code']:'';
		$business_phone 		=isset($_REQUEST['business_phone'])?$_REQUEST['business_phone']:'';

		$search_array = array("http://","https://");

        $facebook_link 			=isset($_REQUEST['facebook_link'])?$_REQUEST['facebook_link']:'';
		$youtube_link 			=isset($_REQUEST['youtube_link'])?$_REQUEST['youtube_link']:'';
		$google_link 			=isset($_REQUEST['google_link'])?$_REQUEST['google_link']:'';
		$twitter_link 			=isset($_REQUEST['twitter_link'])?$_REQUEST['twitter_link']:'';
		$linkedin_link 			=isset($_REQUEST['linkedin_link'])?$_REQUEST['linkedin_link']:'';

		if( $business_name!='' && $business_description!='' && $page_title!='' ){
			$returndata =$this->business_model->do_upload();
			if(isset($returndata['error'])){
				$data['error'] = $error = $returndata['error'];
                $imgdata['upload_data']['file_name'] = "vacate";
			}else{
				$imgdata=$returndata['data'];
			}
			$BusinessLogo =  $imgdata['upload_data']['file_name'];

			$data = array(
				'business_logo'        => trim($BusinessLogo),
				'business_name'        => trim($business_name),
				'business_description' => trim($business_description),
				'page_title'           => trim($page_title),
				'business_tag'         => trim($business_tag),
				'business_location'    => trim($business_location),
				'business_state_id'    => trim($region),
				'business_city_id'     => trim($city),
				'business_zip_code'    => trim($business_zip_code),
				'business_phone'       => trim($business_phone),
                'facebook_link'	       => trim($facebook_link),
                'youtube_link'	       => trim($youtube_link),
                'google_link'	       => trim($google_link),
                'twitter_link'	       => trim($twitter_link),
                'linkedin_link'	       => trim($linkedin_link)
			);

            if($BusinessLogo =="vacate"){
                unset($data['business_logo']);
            }
			
			$this->business_model->insert_to_db($data);
			redirect(base_url().'admin/business/index/success');
		}
		if($success !=''){
			$success =$this->lang->line('update_success');		
		}else{
			$success='';
		}
		$list['success'] = $success;
		$this->load->view('admin/business/business',$list);

		$footer['link'] 		= $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	 }

	function ajax_region_check(){
	       if(!empty($_REQUEST['id'])){
	               $region_id= $_REQUEST['id'];
	               $city_ajax=$this->business_model->city_ajax($region_id);
	               echo $city_ajax;
	       }else{
	               echo '<option value="">select</option>';
	       }
	}
	
	function ajax_country_check(){
	       if(!empty($_REQUEST['id'])){
	               $country_id= $_REQUEST['id'];
	               $region_ajax=$this->business_model->ajax_country_check($country_id);
	               echo $region_ajax;
	       }else{
	               echo '<option value="">select</option>';
	       }
	}

	public function Remove_pic(){
	        $val = $this->business_model->remove_the_pic();
	        echo $val;
	}
}
