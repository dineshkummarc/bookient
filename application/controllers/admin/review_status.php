<?php 
//CB#SOG#29-11-2012#PR#S
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Review_status extends Pardco 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/review_status_model');
        /*===================LogIn Security Check===================*/
        $this->global_mod->checkSession();
        /*===================LogIn Security Check===================*/
    }

    public function index()
    {
       
	   /*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_review_status',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_review_status',$setLanguage);
        }
		/*########End Language#######*/
	    //$this->lang->load('admin_review_status');
        //fetching parameters from url and converting them to assoc array...
	$parameter = $this->uri->uri_to_assoc(2);
        extract($parameter);
        //print_r($parameter);
        
        ############################################################
        /*if(empty($country_manager_search)){
		$country_manager_search = $this->input->post('country_manager_search');
	}*/



	//variable init....
        $IsPreserved = "";
	if (!array_key_exists('page',$parameter))
	$page =  '0';

	$Is_Process = array_key_exists('Is_Process',$parameter)?$parameter['Is_Process']:'N';

	//variable init....

	/* preserve select starts */
		if($IsPreserved=="Y" && count($this->preservevariable->get_preserve_vars())>0)
		{
			$parameter = $this->preservevariable->get_preserve_vars();
			extract($parameter);
		}
		else
		{
			$this->preservevariable->clear_preserve_vars();
		}
	/* preserve select ends */
        ############################################################
        
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);
        ############################################################
        //Pagination Section starts....
	$page = '/page';

	if(!array_key_exists('page',$parameter))
	$parameter['page'] = '0';



	$this->preservevariable->set_preserve_vars($page.'/'.$parameter['page']);


	$config_pagination['base_url'] = base_url().'admin/'.strtolower(get_class($this)).'/'.__FUNCTION__.$page;

	$config_pagination['total_rows'] = $this->review_status_model->get_TotalRecords();
	$config_pagination['per_page'] = '20';
	$config_pagination['cur_page'] = $parameter['page'];
	$config_pagination['num_links'] = 4;

	$this->pagination->initialize($config_pagination);
	//Pagination Section ends....
        ############################################################
        $data['ResArr'] = $this->review_status_model->GetALL($parameter['page'],$config_pagination['per_page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['Is_Process'] = $Is_Process;
        $this->load->view('admin/review_status/review_status',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    //CB#SOG#29-11-2012#PR#E
}
?>