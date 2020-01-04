<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_manager extends Pardco {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/payment_manager_model');
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

	public function index()
	{
		$this->load->helper('url');
		$this->load->database();

		$this->load->view('superadmin/header');
		$this->load->view('superadmin/nevigation');

		$data['local_admin'] = $this->payment_manager_model->GetAllAdmin();
		//$data['all'] =  $this->credit_manager_model->GetAllCredits();
		$this->load->view('superadmin/payment_manager/payment_manager',$data);

		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);

		$this->load->library('session');
	}

	public function SearchFormAjax()
	{
		$data = array();
		$data['local_admin_id'] = $this->input->post('local_admin_id');
		$data['payment_type'] = $this->input->post('payment_type');
		$data['start_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');

		$ret = $this->payment_manager_model->SearchForm($data);
		echo $ret;
	}

	public function ChangeStatusAjax()
	{
		$membership_payment_history_id = $this->input->post('membership_payment_history_id');
		$ret = $this->payment_manager_model->ChangeStatus($membership_payment_history_id);
		echo $ret;
	}
	/*

	public function DelAjax()
	{
		$this->credit_manager_model->Del();
	}

	public function SaveAjax()
	{
		$this->credit_manager_model->Save();
	}

	public function EditAjax()
	{
		$this->credit_manager_model->Edit();
	}

	public function EditRateAjax()
	{
		$smscall_dtls_id = $this->input->post('smscall_dtls_id');
		$retVar = $this->credit_manager_model->EditRate($smscall_dtls_id);
		echo $retVar;
	}

	public function DeleteCreditRateAjax()
	{
		$retVar = $this->credit_manager_model->DeleteCreditRate();
		echo $retVar;
	}

	public function save_call_rate_ajax()
	{
		$retVar = $this->credit_manager_model->save_call_rate();
		echo $retVar;
	}

	public function save_sms_rate_ajax()
	{
		$retVar = $this->credit_manager_model->save_sms_rate();
		echo $retVar;
	}

	public function ChangeStatusRateAjax()
	{
		$retVar = $this->credit_manager_model->ChangeStatusRate();
		echo $retVar;
	}

	public function GetRateValAjax()
	{
		$smscall_rate_dtls_id = $this->input->post('smscall_rate_dtls_id');
		$retVar = $this->credit_manager_model->GetRateVal($smscall_rate_dtls_id);
		echo $retVar;
	}

	public function save_edited_rate_call_ajax()
	{
		$smscall_rate_dtls_id = $this->input->post('smscall_rate_dtls_id');
		$call_rate = $this->input->post('call_rate');

		$retVar = $this->credit_manager_model->save_edited_rate_call($smscall_rate_dtls_id, $call_rate);
		echo $retVar;
	}

	public function save_edited_rate_sms_ajax()
	{
		$smscall_rate_dtls_id = $this->input->post('smscall_rate_dtls_id');
		$sms_rate = $this->input->post('sms_rate');

		$retVar = $this->credit_manager_model->save_edited_rate_sms($smscall_rate_dtls_id, $sms_rate);
		echo $retVar;
	}

	public function cancel_edited_rate_call_ajax()
	{
		$smscall_rate_dtls_id = $this->input->post('smscall_rate_dtls_id');
		$retVar = $this->credit_manager_model->get_call_rate($smscall_rate_dtls_id);
		echo $retVar;
	}

	public function cancel_edited_rate_sms_ajax()
	{
		$smscall_rate_dtls_id = $this->input->post('smscall_rate_dtls_id');
		$retVar = $this->credit_manager_model->get_sms_rate($smscall_rate_dtls_id);
		echo $retVar;
	}*/
}