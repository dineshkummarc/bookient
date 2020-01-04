<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class integrate_on_your_website extends Pardco 
{
    public function __construct()
    {
        parent::__construct();
     //   $this->load->helper('GmailContacts/GmailConnect');
        $this->load->model('admin/integrate_on_your_website_model');
        /*===================LogIn Security Check===================*/
       /* $logged_in_Status = $this->session->userdata('logged_in');
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
    }
    public function index()
    { 
	
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_integrate_on_your_website',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_integrate_on_your_website',$setLanguage);
        }
		/*########End Language#######*/
		
        $this->load->view('admin/header');
       // $this->lang->load('admin_integrate_on_your_website');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $this->load->view('admin/integrate_on_your_website/integrate_on_your_website', $data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    public function gmailConnect()
    {
        echo "KKK";
    }
}
?>