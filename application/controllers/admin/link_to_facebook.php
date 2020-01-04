<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Link_to_facebook extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/servicecategory_model');
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
		
		$this->lang->load('admin_servicecategory');
		$this->load->library('form_validation');
//$this->load->view('admin/header');
		
//		$data['menu_right']= $this->pardco_model->pardco_right_menu();
//		$data['menu_left']= $this->pardco_model->pardco_left_menu();
//		$data['pardco_location']= $this->pardco_model->pardco_location();
//		$this->load->view('admin/nevigation',$data);
		
//		$list['employee']=$this->pardco_model->employee();
//		$list['service']=$this->pardco_model->service();
//		$this->load->view('admin/left',$list);
             
                
                /****#################################################*****/
                $app_id = '444272075674092';
                $app_secret = 'da8585763133c8d9c809feebab361b70';
                $my_url = 'http://beta.bookient.com/admin/link_to_facebook';

                


               // auth user
               if(empty($_REQUEST["code"])) {
                  $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id=' 
                  . $app_id . '&redirect_uri=' . urlencode($my_url) ;
                  echo("<script>top.location.href='" . $dialog_url . "'</script>");
                }else{
					$code = $_REQUEST["code"];
		
                // get user access_token
                $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
                  . $app_id . '&redirect_uri=' . urlencode($my_url) 
                  . '&client_secret=' . $app_secret 
                  . '&code=' . $code;



                // response is of the format "access_token=AAAC..."
                $access_token = substr(file_get_contents($token_url), 13);

                // run fql query
                $fql_query_url = 'https://graph.facebook.com/'
                  . 'fql?q=SELECT+uid2+FROM+friend+WHERE+uid1=me()'
                  . '&access_token=' . $access_token;
                $fql_query_result = file_get_contents($fql_query_url);
                $fql_query_obj = json_decode($fql_query_result, true);

                // display results of fql query
                echo '<pre>';
                print_r("query results:");
                print_r($fql_query_obj);
                echo '</pre>';

                // run fql multiquery
                $fql_multiquery_url = 'https://graph.facebook.com/'
                  . 'fql?q={"all+friends":"SELECT+uid2+FROM+friend+WHERE+uid1=me()",'
                  . '"my+name":"SELECT+name+FROM+user+WHERE+uid=me()"}'
                  . '&access_token=' . $access_token;
                $fql_multiquery_result = file_get_contents($fql_multiquery_url);
                $fql_multiquery_obj = json_decode($fql_multiquery_result, true);

                // display results of fql multiquery
                echo '<pre>';
                print_r("multi query results:");
                print_r($fql_multiquery_obj);
                echo '</pre>';
                /****#################################################*****/
		}
		//$footer = $this->pardco_model->footer_link();
		//$this->load->view('admin/footer',$footer);
	}
}
?>

