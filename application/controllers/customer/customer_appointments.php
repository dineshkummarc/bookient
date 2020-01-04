<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_appointments extends Pardco { 
     
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('customer/customer_appointments_model');
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
	 
	public function upcomingAppointmentsAjax()
	{
			$RetArray = $this->customer_appointments_model->upcomingAppointments();
			//$RetArray="ggggggggggggg";
			echo $RetArray;
	}
	public function pastAppointmentsAjax()
	{
			$RetArray = $this->customer_appointments_model->pastAppointments();
			//$RetArray="ggggggggggggg";
			echo $RetArray;
	}
	public function cancelAppointmentsAjax()
	{
		$booking_service_id=$_REQUEST['booking_service_id'];
		$Ret = $this->customer_appointments_model->cancelAppointments($booking_service_id);
		$RetArray = $this->customer_appointments_model->upcomingAppointments();
		//$RetArray="ggggggggggggg";
		echo $RetArray;
	}
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */