<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_verification extends Pardco {
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('email_verification_model');
	}
	public function index(){
		$this->load->helper('url');
		$this->load->view('main/email_verification/header');
		$Key =$this->email_verification_model->generateKey($user_id);
		$encrypt_username =$this->email_verification_model->encrypt_username('partha');
		$local_admin_id_url = $_SERVER['HTTP_HOST'];
		$this->load->view('main/email_verification/email_verification');
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	public function VeriFication($user_name,$unique_key){
		$this->load->helper('url');
		$this->load->view('main/email_verification/header');
		$msg['msg'] =$this->email_verification_model->verificationCheck($user_name,$unique_key);
		$this->load->view('main/email_verification/email_verification',$msg);
		$this->load->view('main/email_verification/footer');
	}
    public function Veri_fication_user($user_name){
		$this->load->helper('url');
		$this->load->view('main/email_verification/header');
		$msg['msg'] =$this->email_verification_model->verify_user_check($user_name);
		$this->load->view('main/email_verification/email_verification',$msg);
		$this->load->view('main/email_verification/footer');
	}
}