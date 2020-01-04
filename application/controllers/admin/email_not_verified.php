<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_not_verified extends Pardco {

	
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/email_not_verified_model');
		$this->load->model('email_verification_model');	
		/*===================LogIn Security Check===================*/
		  $user_id_resend_email=$this->session->userdata('user_id_resend_email');
		  if(!$user_id_resend_email)
		  {
			  redirect(base_url().'admin/login');
		  }
		/*===================LogIn Security Check===================*/
	}
	public function index()
	{
	      $this->lang->load('admin_email_not_verified');
	      $this->load->helper('url');
          $this->load->database();
		  $this->load->view('admin/header');
		  $this->load->view('admin/email_not_verified/email_not_verified');
		  $footer = $this->pardco_model->footer_link();
		  $this->load->view('admin/footer',$footer);
		  $this->load->library('session');
	}
	public function resendEmailAjax()
	{    
		 $UserDetails      =$this->email_not_verified_model->findUserDetails();
		 
		if($UserDetails!="0")
		{
			$encription_key=$UserDetails['encription_key'];
			$encrypt_username=$UserDetails['encrypt_username'];
			$email=$UserDetails['user_email'];
			$user_name=$UserDetails['user_name'];
			$fname=$UserDetails['first_name'];
			$lname=$UserDetails['last_name'];
			
			$host=$_SERVER['HTTP_HOST'];
			$to  = $email; // note the comma
			$subject = 'Email Verification';
			$message='
			<html>
			<head>
			<title>Email Verification</title>
			</head>
			<body>
			Dear '.$fname .' '.$lname .',<br/> 
			username: '.$user_name.'<br/>
			To Verify your email please 
			<a href="'.$host.'/email_verification/VeriFication/'.$encrypt_username.'/'.$encription_key.'">click here</a>
			</body>
			</html>
			';		
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Pardco Group <bookient@gmail.com>' . "\r\n";
			//mail($to, $subject, $message, $headers);
			if(mail($to, $subject, $message, $headers))
			{
				$resend_status=1;
			}
			else
			{
			   $resend_status=0;
			}
				
		}
		else
		{
			 $resend_status=0;
		}
		
		if($resend_status=='1')
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
