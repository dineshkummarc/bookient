<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->model('superadmin/dashboard_model');
		$this->load->model('admin/business_model');
		$this->lang->load('business');
		/*===================LogIn Security Check===================*/

                $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
                $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                $this->output->set_header('Pragma: no-cache');
                $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

                $logged_in_Status = $this->session->userdata('super_logged_in');
                if(!$logged_in_Status)
                {
                        redirect(base_url().'superadmin/login');
                }

		/*===================LogIn Security Check===================*/
	}
	public function index(){

		$this->load->view('superadmin/header');
		$this->load->view('superadmin/nevigation');

		$business_name   			=isset($_REQUEST['business_name'])?$_REQUEST['business_name']:'';
		$business_description		=isset($_REQUEST['business_description'])?$_REQUEST['business_description']:'';
		$page_title  				=isset($_REQUEST['page_title'])?$_REQUEST['page_title']:'';
		$business_tag       		=isset($_REQUEST['business_tag'])?$_REQUEST['business_tag']:'';
		$business_location 			=isset($_REQUEST['business_location'])?$_REQUEST['business_location']:'';
		$region   					=isset($_REQUEST['region'])?$_REQUEST['region']:'';
		$city      					=isset($_REQUEST['city'])?$_REQUEST['city']:'';
		$business_zip_code   		=isset($_REQUEST['business_zip_code'])?$_REQUEST['business_zip_code']:'';
		$business_phone 			=isset($_REQUEST['business_phone'])?$_REQUEST['business_phone']:'';

		$search_array = array("http://","https://");

		$facebook_link 				=isset($_REQUEST['facebook_link'])?str_replace($search_array,"",$_REQUEST['facebook_link']):'';
		$youtube_link 				=isset($_REQUEST['youtube_link'])?str_replace($search_array,"",$_REQUEST['youtube_link']):'';
		$google_link 				=isset($_REQUEST['google_link'])?str_replace($search_array,"",$_REQUEST['google_link']):'';
		$twitter_link 				=isset($_REQUEST['twitter_link'])?str_replace($search_array,"",$_REQUEST['twitter_link']):'';
		$linkedin_link 				=isset($_REQUEST['linkedin_link'])?str_replace($search_array,"",$_REQUEST['linkedin_link']):'';

		if( $business_name!='' && $business_description!='' && $page_title!='' )
		{
			$returndata =$this->business_model->do_upload();
			if(isset($returndata['error']))
			{
				$data['error'] = $error = $returndata['error'];
				$imgdata['upload_data']['file_name'] = "noimage.jpg";
			}
			else
			{
				$imgdata=$returndata['data'];
			}
			$BusinessLogo =  $imgdata['upload_data']['file_name'];

			$data = array
			(
				'business_logo'        => $BusinessLogo,
				'business_name'        => $business_name,
				'business_description' => $business_description,
				'page_title'           => $page_title,
				'business_tag'         => $business_tag,
				'business_location'    => $business_location,
				'business_state_id'    => $region,
				'business_city_id'     => $city,
				'business_zip_code'    => $business_zip_code,
				'business_phone'       => $business_phone,
				'facebook_link'		   => $facebook_link,
				'youtube_link'		   => $youtube_link,
				'google_link'		   => $google_link,
				'twitter_link'		   => $twitter_link,
				'linkedin_link'		   => $linkedin_link
			);

			$this->business_model->insert_to_db($data);
			redirect(base_url().'superadmin/dashboard/');
		}

		$data['all'] = $this->dashboard_model->GetAllLocalAdmin();
		$this->load->view('superadmin/dashboard/dashboard',$data);

		//$footer = $this->pardco_model->footer_link();
		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);

		$this->load->library('session');
	}
	public function email_varify(){
		$this->dashboard_model->email_varify();
	}
	public function delete_account(){
		$this->dashboard_model->delete_account();
	}
	public function change_status_ajax(){
		$this->dashboard_model->change_status();
	}
	public function delete_admin_ajax(){
		$this->dashboard_model->delete_admin();
	}
	public function update_password_ajax(){
		$this->dashboard_model->update_password();
	}
	public function update_details_ajax(){
		$this->dashboard_model->select_from_db();
	}
	public function update_staff_ajax(){
		$this->dashboard_model->get_all_staff();
	}
	public function change_status_staff_ajax(){
		$this->dashboard_model->change_status_staff();
	}
	public function update_service_ajax(){
		$this->dashboard_model->get_all_service();
	}
	public function change_status_service_ajax(){
		$this->dashboard_model->change_status_service();
	}
	public function manage_local_admin_ajax(){
        $base = base_url();
        $this->session->set_userdata('root_url',$base);
        $return = $this->dashboard_model->manage_local_admin();
        echo $return;
	}
	
	public function logout(){
		$this->session->unset_userdata('logged_in_customer');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('last_activity');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('local_admin_id');
        $this->session->unset_userdata('local_admin_currency_type');
        $this->session->unset_userdata('default_language_type');
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('user_name_customer');
        $this->session->unset_userdata('user_id_customer');
        $this->session->unset_userdata('user_type_customer');
        $this->session->unset_userdata('logged_in_customer');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_id_local_admin');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('customize_language');
        
        
        $this->session->unset_userdata('is_super_admin');
        $this->session->unset_userdata('super_logged_in');
        $this->session->unset_userdata('expire_at');
        $this->session->unset_userdata('super_user_name');
        $this->session->unset_userdata('super_user_id');
        $this->session->unset_userdata('super_user_type');
        $this->session->unset_userdata('root_url');
        
        
		  $this->session->unset_userdata('user_fname_customer');
		  $this->session->unset_userdata('user_lname_customer');
		  $this->session->unset_userdata('user_mobile_customer');
		  $this->session->unset_userdata('user_phone1_customer');
		  $this->session->unset_userdata('user_phone2_customer');
		  $this->session->unset_userdata('user_address_customer');
		  $this->session->unset_userdata('user_zip_customer');
		  $this->session->unset_userdata('user_zone_id_customer');
		  $this->session->unset_userdata('user_email_customer');
		  $this->session->unset_userdata('authKey');
		  
		  $this->session->sess_destroy();


            redirect(base_url().'superadmin/login');
	}
}