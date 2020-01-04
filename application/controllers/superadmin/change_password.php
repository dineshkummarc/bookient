<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password extends Pardco {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/change_password_model');


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
		$this->load->view('superadmin/change_password/change_password');

		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);

		$this->load->library('session');
	}

	public function change_password_ajax()
	{
		$this->change_password_model->change_password();
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
