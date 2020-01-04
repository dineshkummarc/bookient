<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends Pardco { 
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('customer/customer_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status)
		  {
			  redirect(base_url().'admin/login');
		  }
		  else
		  {
			  if($user_id_local_admin != $local_admin_id)
			  {
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		/*===================LogIn Security Check===================*/
	}
	public function index(){   
		$this->load->helper('url');
		$this->load->database();
		//$this->lang->load('business');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('admin/nevigation',$data);

		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('admin/left',$list);
		
		$list['show_all_customer']					=$this->customer_model->showAllCustomer();
		$list['country']         					=$this->customer_model->country();
		$list['city']            					=$this->customer_model->city();
		$list['region']          					=$this->customer_model->region();
		$list['time_zone']       					=$this->customer_model->time_zone();
		$list['checkFieldstatus']       			=$this->customer_model->checkFieldstatus();
		$list['showAllCustomerNameForSearch']       =$this->customer_model->showAllCustomerNameForSearch();
		//$this->load->view('admin/customer/customer',$list);  
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	function ajax_check1(){
		$country_id= $_REQUEST['id'];
		$showregion=$this->customer_model->region_ajax($country_id);
		echo $showregion;
	}
	function ajax_region_check1(){
	    $region_id= $_REQUEST['id'];
	    $showcity=$this->customer_model->city_ajax($region_id);
	    echo $showcity;
	}
	function searchCustomerAjax(){
	    $cus_name_search= $this->input->post('cus_name_search');
	    $showSearchResult=$this->customer_model->searchCustomer($cus_name_search);
	    echo $showSearchResult;
	}
	function selectCustomerAjax(){
	    if(!empty($_REQUEST['customer_id']))
	    {
		    $customer_id=$_REQUEST['customer_id'];
		    $showCustomerDetails=$this->customer_model->selectCustomer($customer_id);
		    echo $showCustomerDetails;
	    }
	    else
	    {
		    echo "no";
	    }
	}
	function displayEditCustomerAjax(){
		$customer_id = $this->session->userdata('user_id_customer');
	    //echo $_REQUEST['customer_id']; exit;
	    $showCustomerDetailsForEdit='';
	    if($customer_id !="")
	    {
		    //$customer_id=$_REQUEST['customer_id'];
		    $showCustomerDetailsForEdit.=$this->customer_model->showDetailsForEditCustomer($customer_id);
		    $showCountry=$this->customer_model->country($customer_id);
		    $showRegion=$this->customer_model->region($customer_id);
		    $showCity=$this->customer_model->city($customer_id);
		    $showCustomerDetailsForEdit.='@@@'.$showCountry.'@@@'.$showRegion.'@@@'.$showCity;
		    $resulytant = $this->customer_model->displayAppointments($showCustomerDetailsForEdit,$customer_id);
		    echo $resulytant;
		    //echo $showCustomerDetailsForEdit;
	    }
	    else
	    {
		    echo "no";
	    }
	}
	function displayAppointments($output){
		//echo '<pre>';print_r($output);exit;
	}
	public function showRegionAjax(){
		$country_id=$this->input->post('country_id');
		$region=$this->customer_model->region($country_id);
		echo $region;
	}
	public function findRegionAjax(){
		$country_id=$this->input->post('country_id');
		$region=$this->customer_model->changeregion($country_id);
		//echo '<pre>';print_r($region);exit;
			
		echo $region;
	}
	public function findCityAjax(){
		$region_id=$this->input->post('region_id');
		$city=$this->customer_model->changecity($region_id);
		//echo '<pre>';print_r($region);exit;
			
		echo $city;
	}
	function inviteCustomerAjax(){
	    $customer_id= $this->input->post('customer_id');
	    $user_data=$this->customer_model->inviteCustomer($customer_id);
	    $host=$_SERVER['HTTP_HOST'];
	    // multiple recipients
	    $to  = $user_data['user_email']; // note the comma
	    //$to .= 'wez@example.com';
	    // subject
	    $subject = 'Email Verification';
	    $message="
	    <html>
	    <head>
	    <title>Email Verification</title>
	    </head>
	    <body>
	    Dear ".$user_data['cus_fname']." ".$user_data['cus_lname'].",<br/> 
	    We invite you to schedule your next appointment with Citytech Corp using our Online Appointment System.<br/> 
	    It is very simpleand you can select the exact service and date you require.<br/> 
	    Make your appointments at any time, 24 hours a day. No more waiting on the phone.<br/><br/> 
	    To book appointments you will require to remember the following login details.<br/>
	    URL: http://".$host."<br/>
	    username: ".$user_data['user_email']."<br/>
	    password: Generate your password.<br/><br/>
	    We hope you will like this new service and look forward to seeing you soon. <br/>
	    Thank You. <br/>
	    sandipan Mandal<br/>
	    Citytech Corp <br/><br/> 
	    We use Bookient, the most powerful scheduling software on earth which is helping me to grow my business virally. Its free! Click here to try now
	    </body>
	    </html>
	    ";		
	    $headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $headers .= 'From: Sandipan Mandal <sandipancitytech@gmail.com>' . "\r\n";
	    mail($to, $subject, $message, $headers);
	    //echo $message;
	}
	function  customerAddajax(){
	    $insert_list = $_POST;
	    if(!empty($_REQUEST['user_email'])){
		    $msg=$this->customer_model->customerAdd($insert_list);
		    $showAllCustomer=$this->customer_model->showAllCustomer();
		    echo $showAllCustomer;
	    }else{
		    echo "no";
	    }
	}
	function deleteCustomerAjax(){
	    if(!empty($_REQUEST['customer_id']))
	    {
		    $customer_id=$_REQUEST['customer_id'];
		    $msg=$this->customer_model->deleteCustomer($customer_id);
		    $showAllCustomer=$this->customer_model->showAllCustomer();
		    echo $showAllCustomer;
	    }
	    else
	    {
		    echo "no";
	    }
	}
	function addTagAjax(){
	    $tag= $this->input->post('tag');
	    $customer_id= $this->input->post('customer_id');
	    $tag1=$this->customer_model->addTag($tag,$customer_id);
	    echo $tag1;
	}
	function addInfoAjax(){
	    $info= $this->input->post('info');
	    $customer_id= $this->input->post('customer_id');
	    $info1=$this->customer_model->addInfo($info,$customer_id);
	    echo $info;
	}
	function upcomingAppointmentsAjax(){
	    $customer_id= $this->input->post('customer_id');
	    $upcomingAppointments=$this->customer_model->upcomingAppointments($customer_id);
	    echo $upcomingAppointments;
	}
	function pastAppointmentsAjax(){
	    $customer_id= $this->input->post('customer_id');
	    $pastAppointments=$this->customer_model->pastAppointments($customer_id);
	    echo $pastAppointments;
	}
	function SaveCustAjax(){
	    $info1= $this->customer_model->SaveInformation($_POST['output']) ;
	}
	function delete_this_CustomerAjax(){	 
	    $customer_id= $this->input->post('customer_id');
	    $this->customer_model->delete_this_customer($customer_id);
	}
    function Change_lang_Ajax(){
        $this->customer_model->Change_lang();
    }
}	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */