<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class share_link extends Pardco {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/share_link_model');
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
		$this->lang->load('business');
		$this->load->view('admin/header');

		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('superadmin/nevigation');

		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		//$this->load->view('admin/left',$list);

		$list=$this->share_link_model->select_from_db();

		$search_array = array("http://","https://");

		$facebook_link 				=isset($_REQUEST['facebook_link'])?str_replace($search_array,"",$_REQUEST['facebook_link']):'';
		$youtube_link 				=isset($_REQUEST['youtube_link'])?str_replace($search_array,"",$_REQUEST['youtube_link']):'';
		$google_link 				=isset($_REQUEST['google_link'])?str_replace($search_array,"",$_REQUEST['google_link']):'';
		$twitter_link 				=isset($_REQUEST['twitter_link'])?str_replace($search_array,"",$_REQUEST['twitter_link']):'';
		$linkedin_link 				=isset($_REQUEST['linkedin_link'])?str_replace($search_array,"",$_REQUEST['linkedin_link']):'';

		if( $facebook_link!='' && $youtube_link!='' && $google_link!='' )
		{
			$data = array
			(
			    //CB#SOG#14-12-2012#PR#S
				'superadmin_facebook'		   => trim($facebook_link),
				'superadmin_google'		   	   => trim($google_link),
				'superadmin_youtube'		   => trim($youtube_link),
				'superadmin_twitter'		   => trim($twitter_link),
				'superadmin_linkedin'		   => trim($linkedin_link)
				//CB#SOG#14-12-2012#PR#S
			);
			$this->share_link_model->insert_to_db($data);
			redirect(base_url().'superadmin/share_link/');
		}
		$this->load->view('superadmin/share_link/share_link',$list);

		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	 }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */