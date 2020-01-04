<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class timezone_manager extends Pardco {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Changestatus');
                $this->load->model('superadmin/timezone_manager_model');
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


	$this->load->model('superadmin/changestatusmod');
	$this->load->library('sorting');
	$this->load->library('ranking');
	$this->load->library('pagination');
	$this->load->library('preservevariable');


	$doSearch = "";
	$IsPreserved = "";
	$action = $this->input->post('action');

	//fetching parameters from url and converting them to assoc array...
	$parameter = $this->uri->uri_to_assoc(2);
	//print_r($parameter);
	extract($parameter);

	if(empty($timezone_manager_search))
		$timezone_manager_search = $this->input->post('timezone_manager_search');


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

	$page_name = base_url().'superadmin/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/page/'.$page;

	$searched = 0;
	//Search section starts....
	if(array_key_exists('doSearch',$parameter)){
		if( $timezone_manager_search =='Search by Timezone Name')
		{
			$timezone_manager_search ='';
		}
		if(!empty($timezone_manager_search)){
		$likeArr['time_zone_name'] 	= urldecode(trim($timezone_manager_search));

		$searchLink .= "/timezone_manager_search/$timezone_manager_search";
		$like = array('time_zone_name'=>$timezone_manager_search);
		}

		$searchLink .= '/doSearch/Y';
		$parameter['page'] = 0;
		$searched = 1;
	}

	// General action for ranking
	$order_array = $this->ranking->PrepareOriginalArray('time_zone','time_zone_id','time_zone_order');

	if(array_key_exists('type',$parameter)){
		$alter_array = $this->ranking->AlterOriginalArray($order_array,$parameter['order'],$parameter['type']);
		$this->ranking->saveRanking($alter_array,'time_zone','time_zone_id','time_zone_order');
	}

	//Search section ends....
	$data['status_massage'] = '';
	if($action == 'delete')
	{
		$this->ranking->deleteRanking($order_array,'time_zone','time_zone_id','time_zone_order',$record_id);
		$Is_Process = $this->input->post('Is_Process');
		$msgreport = $this->timezone_manager_model->deleteCatalog($record_id);
		$msg = displayMessage($msgreport);
		$data['status_massage'] = $msg;
	}

	if($action == 'activate')
	{
		$this->changestatus->ChangeStatus($record_id,$statusid);
	}

	//Sorting Section starts....
	if(array_key_exists('OrderByID',$parameter) && array_key_exists('ordertype',$parameter)){
	$sort = '/OrderByID/'.$parameter['OrderByID'].'/ordertype/'.$parameter['ordertype'];
	$ordertype = $parameter['ordertype'];
	$OrderByID = $parameter['OrderByID'];
	}

	$SortingSequenceArr=array(1 => "time_zone_name");
	$ReturnSortingArr=$this->sorting->Sorting("time_zone_order",$SortingSequenceArr,'GO',$OrderByID,$ordertype);

	//Sorting Section ends....


	//Pagination Section starts....
	$page = '/page';

	if(!array_key_exists('page',$parameter))
	$parameter['page'] = '0';


	//if($Is_Process=='Y')
	$this->preservevariable->set_preserve_vars($sort.$searchLink.$page.'/'.$parameter['page']);


	$config_pagination['base_url'] = base_url().'superadmin/'.strtolower(get_class($this)).'/'.__FUNCTION__.$sort.$page;

	$config_pagination['total_rows'] = $this->timezone_manager_model->get_TotalRecords($where,$like);
	$config_pagination['per_page'] = '10';
	$config_pagination['cur_page'] = $parameter['page'];
	$config_pagination['num_links'] = 2;

	$this->pagination->initialize($config_pagination);
	//Pagination Section ends....

	//main query
	$CatalogArr = $this->timezone_manager_model->get_AllCatalogArr($parameter['page'],$config_pagination['per_page'],$ReturnSortingArr['OrderBy'],$ordertype,$searchArr,$likeArr);

	// Ranking Starts here
	$order_array = $this->ranking->PrepareOriginalArray('time_zone','time_zone_id','time_zone_order');
        //echo '<pre>';
        //print_r($order_array);
        //echo '</pre>';
	for($i=0;$i<count($CatalogArr);$i++){
		if($searched == '' && !array_key_exists('OrderByID',$parameter))
			$CatalogArr[$i]->img_rank = $this->ranking->displayRankingImage($order_array,$CatalogArr[$i]->time_zone_order,base_url().'superadmin/timezone_manager/index/page/'.$parameter['page']);
		else
			$CatalogArr[$i]->img_rank = "--";
	}
	// Ranking Ends here


	$data['TimezoneArr'] = $CatalogArr;
	$data['pagination'] = $this->pagination->create_links();
	$data['page_name'] = $page_name;
	$data['ordertype'] = $ReturnSortingArr['OrderType'];
	$data['OrderByID'] = $OrderByID;
	$data['ReturnSortingArr'] = $ReturnSortingArr;
	$data['Is_Process'] = $Is_Process;
	$data['timezone_manager_search'] = $timezone_manager_search;
	$data['searchLink'] = $searchLink;


	if($Is_Process!='Y') {
	$this->load->view('superadmin/header/header');

        $this->load->view('superadmin/nevigation');

        }
        $this->load->view('superadmin/timezone_manager/timezone_manager',$data);
            if($Is_Process!='Y') {
                //$this->load->view('superadmin/country_manager/footer');

            $footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
            }


	}

	function activate(){
		$parameter = $this->uri->uri_to_assoc(2);
		extract($parameter);
		$this->changestatus->ChangeStatus($recordid,$statusid);
		$this->catalog();
	}

        public function EditTIMEZONEAjax()
	{
		$this->timezone_manager_model->EditTIMEZONE();
	}

        public function SaveTIMEZONEAjax()
	{
		$msgreport = $this->timezone_manager_model->SaveTIMEZONE();
                echo $msgreport;
	}
        public function Get_title_Ajax()
	{
		$this->timezone_manager_model->get_title();
	}

}