<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->model('info_model');
		$this->load->model('page_model');
        $this->load->model('customer/customer_registration_model');
        $this->load->model('payment_pro_model');
        $this->load->model('customer/customer_model');
       $logged_in_Status_customer = $this->session->userdata('logged_in_customer');          
	}
	public function index(){
		 header('Location: ' .base_url());
	}
	public function privacypolicy(){
		$local_admin_id							= $this->customer_registration_model->GetLocalAdmin();
        $this->lang->load('page');
        $data['menu']							= $this->pardco_model->frontend_menu();
        $data['logged_in_customer']             = $this->session->userdata('logged_in_customer');
        $check_bus_hour							= $this->page_model->check_view_user_status();
        $check_user_email_veri                  = $this->page_model->check_user_email_veri_status();
        $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
        $data['lang_list']						= $this->page_model->language_listings($local_admin_id);
        $data['user_name']						= $this->page_model->CustomerName();
        $data['Ret_Arr_val']                    = $this->page_model->SelectedLang();
        $data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        $data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);
        $data['business_logo']                  = $this->page_model->getBusinessLogo($local_admin_id);
        $data['local_admin_settings']           = $this->page_model->getFrontEndSettings($local_admin_id);
        $data['address']						= $this->page_model->getAdminAddress();
        $data['local_admin_email']              = $this->page_model->getLocalAdminEmail();
        $customerLoginId						= $this-> session-> userdata('user_id_customer');
        $data['review_list']                    = $this->page_model->getReviewList(); //array('rating'=>2, 'rating_desc'=>'hello');
        if($customerLoginId !=''){
            $data['customerLoginId'] = $customerLoginId;
        }else{
            $data['customerLoginId'] = 0;
        }
		$data['cms_data']						= $this->info_model->getContent('privacypolicy');
		$data['cms_type']						= 'privacypolicy';
		$dateArr = $this->dateRange();    
		$start_date = $dateArr['start_date'];
		$end_date = $dateArr['end_date'];

		$footer = $this->pardco_model->footer_link_frontend();
		$this->load->view('frontend/headerCms');
		if($check_bus_hour && $check_user_email_veri != 0){
		        $this->load->view('frontend/nevigation',$data);
		}
		$this->load->view('frontend/info', $data);
		$this->load->view('frontend/footer',$footer);
	}
	public function securityinfo(){
		$local_admin_id							= $this->customer_registration_model->GetLocalAdmin();
        $this->lang->load('page');
        $data['menu']							= $this->pardco_model->frontend_menu();
        $data['logged_in_customer']             = $this->session->userdata('logged_in_customer');
        $check_bus_hour							= $this->page_model->check_view_user_status();
        $check_user_email_veri                  = $this->page_model->check_user_email_veri_status();
        $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
        $data['lang_list']						= $this->page_model->language_listings($local_admin_id);
        $data['user_name']						= $this->page_model->CustomerName();
        $data['Ret_Arr_val']                    = $this->page_model->SelectedLang();
        $data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        $data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);
        $data['business_logo']                  = $this->page_model->getBusinessLogo($local_admin_id);
        $data['local_admin_settings']           = $this->page_model->getFrontEndSettings($local_admin_id);
        $data['address']						= $this->page_model->getAdminAddress();
        $data['local_admin_email']              = $this->page_model->getLocalAdminEmail();
        $customerLoginId						= $this-> session-> userdata('user_id_customer');
        $data['review_list']                    = $this->page_model->getReviewList(); //array('rating'=>2, 'rating_desc'=>'hello');
        if($customerLoginId !=''){
            $data['customerLoginId'] = $customerLoginId;
        }else{
            $data['customerLoginId'] = 0;
        }
		$data['cms_data']						= $this->info_model->getContent('securityinfo');
		$data['cms_type']						= 'securityinfo';
		$dateArr = $this->dateRange();    
		$start_date = $dateArr['start_date'];
		$end_date = $dateArr['end_date'];

		$footer = $this->pardco_model->footer_link_frontend();
		$this->load->view('frontend/headerCms');
		if($check_bus_hour && $check_user_email_veri != 0){
		        $this->load->view('frontend/nevigation',$data);
		}
		$this->load->view('frontend/info', $data);
		$this->load->view('frontend/footer',$footer);
	}
	public function companyinfo(){
		$local_admin_id							= $this->customer_registration_model->GetLocalAdmin();
        $this->lang->load('page');
        $data['menu']							= $this->pardco_model->frontend_menu();
        $data['logged_in_customer']             = $this->session->userdata('logged_in_customer');
        $check_bus_hour							= $this->page_model->check_view_user_status();
        $check_user_email_veri                  = $this->page_model->check_user_email_veri_status();
        $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
        $data['lang_list']						= $this->page_model->language_listings($local_admin_id);
        $data['user_name']						= $this->page_model->CustomerName();
        $data['Ret_Arr_val']                    = $this->page_model->SelectedLang();
        $data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        $data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);
        $data['business_logo']                  = $this->page_model->getBusinessLogo($local_admin_id);
        $data['local_admin_settings']           = $this->page_model->getFrontEndSettings($local_admin_id);
        $data['address']						= $this->page_model->getAdminAddress();
        $data['local_admin_email']              = $this->page_model->getLocalAdminEmail();
        $customerLoginId						= $this-> session-> userdata('user_id_customer');
        $data['review_list']                    = $this->page_model->getReviewList(); //array('rating'=>2, 'rating_desc'=>'hello');
        if($customerLoginId !=''){
            $data['customerLoginId'] = $customerLoginId;
        }else{
            $data['customerLoginId'] = 0;
        }
		$data['cms_data']						= $this->info_model->getContent('companyinfo');
		$data['cms_type']						= 'companyinfo';
		$dateArr = $this->dateRange();    
		$start_date = $dateArr['start_date'];
		$end_date = $dateArr['end_date'];

		$footer = $this->pardco_model->footer_link_frontend();
		$this->load->view('frontend/headerCms');
		if($check_bus_hour && $check_user_email_veri != 0){
		        $this->load->view('frontend/nevigation',$data);
		}
		$this->load->view('frontend/info', $data);
		$this->load->view('frontend/footer',$footer);
	}
	public function dateRange($start_date='',$end_date=''){
        $start_dt=($start_date=='')?date("Y-m-d"):$start_date;
        $day = 30;
        $startdatetimestamp = strtotime($start_dt);
        $enddatetimestamp = $startdatetimestamp + $day*24*60*60;
        $end_date = date("Y-m-d", $enddatetimestamp);
        $dateArr['start_date'] = $start_dt;
        $dateArr['end_date'] = $end_date;
        return $dateArr;
    }   
}
/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
