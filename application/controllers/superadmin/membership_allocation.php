<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_allocation extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Changestatus');
        $this->load->model('superadmin/membership_allocation_model');
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

	function index(){
        $featureArr = $this->membership_allocation_model->getMembershipFeature();
        $planArr = $this->membership_allocation_model->getMembershipPlan();
        $planFeatureRelationArr = $this->membership_allocation_model->planFeatureRelation();
        echo "<pre>";
        //print_r($planFeatureRelationArr);
        echo "</pre>";
	    $data['featureArr'] = $featureArr;
        $data['planArr'] = $planArr;
        $data['planFeatureRelationArr'] = $planFeatureRelationArr;
	    $this->load->view('superadmin/header/header');
        $this->load->view('superadmin/nevigation');
        $this->load->view('superadmin/membership_allocation/membership_allocation',$data);
        $footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	}

    function relationInsert(){
        $relationArr = $this->input->post();
        $this->membership_allocation_model->planFeatureRelationInsert($relationArr);
    }
}