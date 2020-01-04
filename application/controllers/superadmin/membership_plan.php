<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_plan extends Pardco {
	
	public function __construct(){
		
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper(array('form', 'url'));

		$this->load->model('superadmin/membership_plan_model');
		$this->load->model('superadmin/changestatusmod');

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
            $parent_page = $this->uri->segments;
            $val=0;
            if(count($parent_page)== 2){
                $val = 0;
            }else{
                $val = $parent_page[5];
            }
            $this->session->set_userdata('parent_membership_page', $val);


            $doSearch = "";
            $IsPreserved = "";
            $action = $this->input->post('action');

            //fetching parameters from url and converting them to assoc array...
            $parameter = $this->uri->uri_to_assoc(2);
            extract($parameter);

            if(empty($membership_plan_search))
                    $membership_plan_search = $this->input->post('membership_plan_search');


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
                    if($IsPreserved=="Y" && count($this->preservevariable->get_preserve_vars())>0){
                            $parameter = $this->preservevariable->get_preserve_vars();
                            extract($parameter);
                    }else{
                            $this->preservevariable->clear_preserve_vars();
                    }
            /* preserve select ends */

            $page_name = base_url().'superadmin/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/page/'.$page;
            //echo  $page_name;

            $searched = 0;
            //Search section starts....
            if(array_key_exists('doSearch',$parameter)){
                    if( $membership_plan_search =='Search by Membership Title,Amount and Validity')
                    {
                            $membership_plan_search ='';
                    }
                    if(!empty($membership_plan_search)){
                        $likeArr['plan_name'] = urldecode(trim($membership_plan_search));   //<---##
                        $likeArr['plan_validity']  = urldecode(trim($membership_plan_search));   //<---##
                        $likeArr['plan_cost'] 	 = urldecode(trim($membership_plan_search));   //<---##


                        $searchLink .= "/membership_plan_search/$membership_plan_search";
                        $like = array('plan_name'=>$membership_plan_search ,'plan_validity' => $membership_plan_search,'plan_cost' => $membership_plan_search);                  //<---##

                    }

                    $searchLink .= '/doSearch/Y';
                    $parameter['page'] = 0;
                    $searched = 1;
            }

            // General action for ranking
            $condition ="status != 2 AND is_deleted= 'N'";
            $order_array = $this->ranking->Prepare_OriginalArray('membership_plan','plan_id','membership_order',$condition);
            if(array_key_exists('type',$parameter)){
                    $alter_array = $this->ranking->AlterOriginalArray($order_array,$parameter['order'],$parameter['type']);
                    $this->ranking->saveRanking($alter_array,'membership_plan','plan_id','membership_order');      
            }

            //Search section ends....
            $data['status_massage'] = '';
            if($action == 'delete'){
				
                $this->ranking->deleteRanking($order_array,'membership_plan','plan_id','membership_order',$record_id);    //<---##
                $Is_Process = $this->input->post('Is_Process');
                $msgreport = $this->membership_plan_model->deletePlan($record_id);
                //$msg = displayMessage($msgreport);
                if($msgreport == 1){
					$data['status_massage'] = 'Successfully Deleted';
				}
				
            }

            if($action == 'activate'){
                     $this->membership_plan_model->ChangeStatus($record_id);
            }

            //Sorting Section starts....
            if(array_key_exists('OrderByID',$parameter) && array_key_exists('ordertype',$parameter)){
	            $sort = '/OrderByID/'.$parameter['OrderByID'].'/ordertype/'.$parameter['ordertype'];
	            $ordertype = $parameter['ordertype'];
	            $OrderByID = $parameter['OrderByID'];
            }

            $SortingSequenceArr=array(1 => "plan_name",2 => "plan_cost",3=>'plan_validity');          
            $ReturnSortingArr=$this->sorting->Sorting("membership_order",$SortingSequenceArr,'GO',$OrderByID,$ordertype);  

            //Sorting Section ends....

            //Pagination Section starts....
            $page = '/page';

            if(!array_key_exists('page',$parameter))
            $parameter['page'] = '0';


            //if($Is_Process=='Y')
            $this->preservevariable->set_preserve_vars($sort.$searchLink.$page.'/'.$parameter['page']);


            $config_pagination['base_url'] = base_url().'superadmin/'.strtolower(get_class($this)).'/'.__FUNCTION__.$sort.$page;

            $config_pagination['total_rows'] = $this->membership_plan_model->get_TotalRecords($where,$like);
            $config_pagination['per_page'] = '10';
            $config_pagination['cur_page'] = $parameter['page'];
            $config_pagination['num_links'] = 2;

            $this->pagination->initialize($config_pagination);

            //Pagination Section ends....

            //main query
            $CatalogArr = $this->membership_plan_model->get_AllCatalogArr($parameter['page'],$config_pagination['per_page'],$ReturnSortingArr['OrderBy'],$ordertype,$searchArr,$likeArr);

            // Ranking Starts here
            $order_array = $this->ranking->Prepare_OriginalArray('membership_plan','plan_id','membership_order',$condition);   
            for($i=0;$i<count($CatalogArr);$i++){
                    if($searched == '' && !array_key_exists('OrderByID',$parameter))
                            $CatalogArr[$i]->img_rank = $this->ranking->displayRankingImage($order_array,$CatalogArr[$i]->membership_order,base_url().'superadmin/membership_plan/index/page/'.$parameter['page']);         //<---##
                    else
                            $CatalogArr[$i]->img_rank = "--";
            }
            // Ranking Ends here

            $data['selected_val'] = $this->membership_plan_model->get_curr();
            $data['MemArr'] = $CatalogArr;
            $data['pagination'] = $this->pagination->create_links();
            $data['page_name'] = $page_name;
            $data['ordertype'] = $ReturnSortingArr['OrderType'];
            $data['OrderByID'] = $OrderByID;
            $data['ReturnSortingArr'] = $ReturnSortingArr;
            $data['Is_Process'] = $Is_Process;
            $data['membership_plan_search'] = $membership_plan_search;
            $data['searchLink'] = $searchLink;
			$data['billingCycle'] = $this->membership_plan_model->getBillingCycle();
			
			//$data['get_All_Currency'] = $this->membership_plan_model->get_All_Currency();

            if($Is_Process!='Y'){
            $this->load->view('superadmin/header/header');

            $this->load->view('superadmin/nevigation');

            }
            $this->load->view('superadmin/membership_plan/membership_plan',$data);
                if($Is_Process!='Y') {
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
	public function Get_title_Ajax(){
		$this->membership_plan_model->get_title();
	}
	public function SaveAjax(){
		$return=$this->membership_plan_model->Save();
		echo $return;
	}
	public function EditAjax(){
		$ret = $this->membership_plan_model->Edit();
		echo $ret;
	}
}