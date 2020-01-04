<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerRate extends Pardco {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('customerrate_model');
    }
    public function index()
    {
        $this->load->helper('url');
        //$this->load->view('main/customerRate/header');
        $this->load->view('main/customerRate/header');
        $local_admin_id_url = $_SERVER['HTTP_HOST'];
        //$this->load->view('main/customerRate/customerRate');
        $this->load->view('frontend/customerRate');
        $footer = $this->pardco_model->footer_link();
        //$this->load->view('main/customerRate/footer');
        $this->load->view('frontend/footer');
    }
    public function rating($local_admin_id=0,$customer_id=0,$service_id=0,$employee_id=0,$srvDtls_id=0,$language='')
    {
        $this->load->helper('url');
        $this->lang->load('customerrate',$language);
        //$this->load->view('main/customerRate/header');
        $this->load->view('frontend/header');
        $data['business_data'] =$this->customerrate_model->business_data($local_admin_id);
        $data['local_admin_id'] =$local_admin_id;
        $data['customer_id'] =$customer_id;
        $data['service_id'] =$service_id;
        $data['employee_id'] =$employee_id;
        $data['srvDtls_id'] =$srvDtls_id;
        //$this->load->view('main/customerRate/customerRate',$data);
        $this->load->view('frontend/customerRate',$data);
        $footer = $this->pardco_model->footer_link();
        //$this->load->view('main/customerRate/footer');
        $footer = $this->pardco_model->footer_link_frontend();
        //$this->load->view('frontend/footer',$footer);
    }
    public function ratingSave()
    {
        $jsondata =$this->input->post('rating_data');
        $return = $this->customerrate_model->ratingSave(json_decode($jsondata, true));
        if($return){
            echo '1';
        }else{
            echo '0';
        }
    }
}