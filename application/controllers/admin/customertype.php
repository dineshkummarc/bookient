<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customertype extends Pardco {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper(array('form', 'url'));
		$this->load->library('Changestatus');
        $this->load->model('admin/customertype_model');
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
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_customertype',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_customertype',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
		
	}
	
	
	function index(){

	$doSearch = "";
	$IsPreserved = "";
	$action = $this->input->post('action');

	//fetching parameters from url and converting them to assoc array...
	$parameter = $this->uri->uri_to_assoc(2);
	//print_r($parameter);
	extract($parameter);

	if(empty($tax_manager_search))
		$tax_manager_search = $this->input->post('customertype_search');
	
	//variable init....
	$where = array();
	$like = array();
	$sort = '';
	if (!array_key_exists('page',$parameter))
	$page =  '0';
	$ReturnSortingArr = array();

	$ordertype = 'ASC';
	$OrderByID = '';
	$Is_Process = array_key_exists('Is_Process',$parameter)?$parameter['Is_Process']:'N';

	$searchArr = array();
	$likeArr = array();
	$searchLink = "";
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

	$page_name = base_url().'admin/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/page/'.$page;
	
	$searched = 0;
	
	//Search section starts....
	if(array_key_exists('doSearch',$parameter)){
		if( $tax_manager_search =='Search by Customer Type')
		{
			$tax_manager_search ='';
		}
		if(!empty($tax_manager_search)){
			$likeArr['customertype_name'] 	= urldecode(trim($tax_manager_search));   //<---##
			$searchLink .= "/customertype_search/$tax_manager_search";
			$like = array('customertype_name'=>$tax_manager_search);                  //<---##
		}

		$searchLink .= '/doSearch/Y';
		$parameter['page'] = 0;
		$searched = 1;
	}
	
	// General action for ranking
	$order_array = $this->ranking->PrepareOriginalArray('app_customertype','customertype_id','customertype_id');     //<---##

	if(array_key_exists('type',$parameter)){
		$alter_array = $this->ranking->AlterOriginalArray($order_array,$parameter['order'],$parameter['type']);
		$this->ranking->saveRanking($alter_array,'app_customertype','customertype_id','customertype_id');        //<---##
	}
	
	
	//Search section ends....
	$data['status_massage'] = '';
	if($action == 'delete')
	{
		//$this->ranking->deleteRanking($order_array,'tax_master','tax_master_id','tax_master_order',$record_id);    //<---##
		$Is_Process = $this->input->post('Is_Process');
                //$this->customertype_model->deleteCatalog($record_id);

                //customertype_model
		$msgreport = $this->customertype_model->deleteCatalog($record_id);
		$msg = displayMessage($msgreport);
		$data['status_massage'] = $msg;
	}

	if($action == 'activate')
	{
		//$this->changestatus->ChangeStatus($record_id,$statusid);
                $this->customertype_model->ChangeStatusTAX($record_id);

	}

	//Sorting Section starts....
	if(array_key_exists('OrderByID',$parameter) && array_key_exists('ordertype',$parameter)){
		$sort = '/OrderByID/'.$parameter['OrderByID'].'/ordertype/'.$parameter['ordertype'];
		$ordertype = $parameter['ordertype'];
		$OrderByID = $parameter['OrderByID'];
	}

	$SortingSequenceArr=array(1 => "customertype_name");          //<---##
	$ReturnSortingArr=$this->sorting->Sorting("customertype_id",$SortingSequenceArr,'GO',$OrderByID,$ordertype);  //<---##

	//Sorting Section ends....


	//Pagination Section starts....
	$page = '/page';

	if(!array_key_exists('page',$parameter))
	$parameter['page'] = '0';


	//if($Is_Process=='Y')
	$this->preservevariable->set_preserve_vars($sort.$searchLink.$page.'/'.$parameter['page']);


	$config_pagination['base_url'] = base_url().'admin/'.strtolower(get_class($this)).'/'.__FUNCTION__.$sort.$page;

	$config_pagination['total_rows'] = $this->customertype_model->get_TotalRecords($where,$like);
	$config_pagination['per_page'] = '10';
	$config_pagination['cur_page'] = $parameter['page'];
	$config_pagination['num_links'] = 2;

	$this->pagination->initialize($config_pagination);
	//Pagination Section ends....

	//main query
	$CatalogArr = $this->customertype_model->get_AllCatalogArr($parameter['page'],$config_pagination['per_page'],$ReturnSortingArr['OrderBy'],$ordertype,$searchArr,$likeArr);

	// Ranking Starts here
	$order_array = $this->ranking->PrepareOriginalArray('app_customertype','customertype_id','customertype_name');  //<---##
        //echo '<pre>';
        //print_r($order_array);
        //echo '</pre>';
	for($i=0;$i<count($CatalogArr);$i++){
		if($searched == '' && !array_key_exists('OrderByID',$parameter))
			$CatalogArr[$i]->img_rank = $this->ranking->displayRankingImage($order_array,$CatalogArr[$i]->customertype_id,base_url().'admin/customertype/index/page/'.$parameter['page']);         //<---##
		else
			$CatalogArr[$i]->img_rank = "--";
	}
	// Ranking Ends here
	
	
	
	$data['pagination'] = $this->pagination->create_links();
	$data['page_name'] = $page_name;
	$data['ordertype'] = $ReturnSortingArr['OrderType'];
	$data['OrderByID'] = $OrderByID;
	$data['ReturnSortingArr'] = $ReturnSortingArr;
	$data['Is_Process'] = $Is_Process;
	$data['tax_manager_search'] = $tax_manager_search;
	$data['searchLink'] = $searchLink;

        //echo '<pre>';print_r($data);
	if($Is_Process!='Y') {
		$this->load->view('admin/header');
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

    }
    
    $data['AllCustomers'] = $CatalogArr;
    
    $this->load->view('admin/customertype/customertype',$data);
            if($Is_Process!='Y') {
				$footer['link'] = $this->pardco_model->footer_link();
				$footer['languages'] 	= $this->pardco_model->admin_language();
				$this->load->view('admin/footer',$footer);
            }
	}

	function activate(){
		$parameter = $this->uri->uri_to_assoc(2);
		extract($parameter);
                //print_r($parameter);
		$this->changestatus->ChangeStatus($recordid,$statusid);
		$this->catalog();
	}

        public function EditCustomerAjax()
		{
			$this->customertype_model->EditCustomerType();
		}

        public function SaveTypeAjax()
		{
			$msgreport = $this->customertype_model->SaveCustomerType();
			echo $msgreport;
		}


}