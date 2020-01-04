<?php 
//CB#SR#08-04-2013#PR#S
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Graph extends Pardco 
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/graph_model');
        $this->load-> library('fusioncharts');
        /*===================LogIn Security Check===================*/
        /*$logged_in_Status = $this->session->userdata('logged_in');
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
        
        /*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_review_status',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_review_status',$setLanguage);
        }
		/*########End Language#######*/
    }
	
    public function index()
    {
	
        $this->load->helper('url');
        //$this->lang->load('admin_review_status');

        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $list['employee']=$this->pardco_model->employee();
        $list['service']=$this->pardco_model->service();
        //$this->load->view('admin/left',$list);

        $data['ResArr'] = $this->graph_model->GetPerformanceGraph();
        //$data['BookedCancelArr'] = $this->graph_model->GetBookedCancelGraph();
        //$data['AppointmentNoShowArr'] = $this->graph_model->GetAppointmentNoShowGraph();
        $this->load->view('admin/graph/graph',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
}
?>

