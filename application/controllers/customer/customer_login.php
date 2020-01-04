<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_login extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/customer_login_model');
		$this->load->model('customer/customer_registration_model');
	}
	
	public function index()
	{
		$this->load->view('admin/header'); // will modify later
		$this->load->view('customer/customer_login/customer_login');		
		$this->load->view('admin/footer'); // will modify later
	}

	public function CustomerLogInAjax()
	{
            $ret = $this->customer_login_model->CustomerLogIn();
            echo $ret;
	}
	
	public function home()
	{    
		$this->load->view('admin/header'); // will modify later
		$this->load->view('customer/customer_home/customer_home');		
		$this->load->view('admin/footer'); // will modify later
	}
	
	public function customer_check()
	{
		$ret = $this->customer_login_model->CustomerCheck();
		
		if($ret == 1)
		{
			$this->load->view('frontend/header'); // will modify later
			$this->load->view('frontend/page');		
			$this->load->view('frontend/footer'); // will modify later
		}
		else
		{
			$data['err_msg'] = "Authentication Failed.";
			$this->load->view('frontend/header'); // will modify later
			$this->load->view('frontend/page',$data);		
			$this->load->view('frontend/footer'); // will modify later
		}
	}
    
	public function Other_fn(){
		$facebookUser = $this->input->post('fbuid');
		$result = $this->customer_registration_model->facebookUserChecking($facebookUser);
		echo $result;
	}
	   
    public function fn_facebook()
    {
		if($this->input->post('bTime') !=''){
            if(($this->input->post('mobileType') == 'mobile') && ($this->input->post('staffArr')!= '') && ($this->input->post('srvArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $srvfArrM = '';
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['srvArrM']               = $srvfArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')!= '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
                    $srvfArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
					$set_user_data['srvArrM']               = $srvfArrM;
                }else{
					$set_user_data['bTime']                = $this->input->post('bTime');
					$set_user_data['staffArr']             = $this->input->post('staffArr');
					$set_user_data['srvArr']               = $this->input->post('srvArr');	
				} 	
            $this->session->set_userdata($set_user_data);
		}
            
		$set_user_data = array(
		        'email'   		        => $this->input->post('email'),
		        'firstname'     	    => $this->input->post('first_name'),
		        'lastname'   		    => $this->input->post('last_name'),
		        'logged_in_customer'    => TRUE
		);

		 $this->customer_registration_model->faceBook_registration($set_user_data,$this->input->post('username'));

		 $this->session->set_userdata($set_user_data);   
		// header( 'Location:'.base_url() ) ;
		
        }
    
	 public function fn_facebook_now()
    {
		if($this->input->post('bTime') !=''){
            if(($this->input->post('mobileType') == 'mobile') && ($this->input->post('staffArr')!= '') && ($this->input->post('srvArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $srvfArrM = '';
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['srvArrM']               = $srvfArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')!= '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
                    $srvfArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
					$set_user_data['srvArrM']               = $srvfArrM;
                }else{
					$set_user_data['bTime']                = $this->input->post('bTime');
					$set_user_data['staffArr']             = $this->input->post('staffArr');
					$set_user_data['srvArr']               = $this->input->post('srvArr');	
				} 	
            $this->session->set_userdata($set_user_data);
		}
            
		$set_user_data = array(
		        'email'   		        => $this->customer_registration_model->faceBookUserEmail($this->input->post('userName')),
		        'firstname'     	    => $this->input->post('first_name'),
		        'lastname'   		    => $this->input->post('last_name'),
		        'logged_in_customer'    => TRUE
		);

		 $this->session->set_userdata($set_user_data); 
		 $this->customer_registration_model->faceBook_registration($set_user_data,$this->input->post('username'));  

		header( 'Location:'.base_url() ) ;
		exit;
        }
	
	
    public function fn_google(){
    	
		//Added by palash
		if($this->input->post('bTime') !=''){
           // ########################################################################################
            if(($this->input->post('mobileType') == 'mobile') && ($this->input->post('staffArr')!= '') && ($this->input->post('srvArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					/*foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);*/
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
					//$set_user_data['srvArrM']               = $srvfArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $srvfArrM = '';
					/*foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);*/
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					//$set_user_data['staffArrM']             = $staffArrM;
					$set_user_data['srvArrM']               = $srvfArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')!= '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
                    $srvfArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
					$set_user_data['srvArrM']               = $srvfArrM;
                }else{
					$set_user_data['bTime']                = $this->input->post('bTime');
					$set_user_data['staffArr']             = $this->input->post('staffArr');
					$set_user_data['srvArr']               = $this->input->post('srvArr');	
				}
            //########################################################################################
		    /*$session_data = array(
		        'bTime'                => $this->input->post('bTime'),
		        'staffArr'             => $this->input->post('staffArr'),
		        'srvArr'               => $this->input->post('srvArr')
		    );
		    $this->session->set_userdata($session_data);*/ 	
            $this->session->set_userdata($set_user_data);
		}
		//Added by palash
            
            $url = $_SERVER['HTTP_HOST'];
            $url_arr = explode(".",$url);
            require 'lib/google_connect/openid.php';
            try {
                $openid = new LightOpenID('http://'.$url_arr[0].'.'.$url_arr[1].'.com');
             
                    $openid->required = array(
                            'namePerson',
                            'namePerson/first',
                            'namePerson/last',
                            'contact/email',
                    );
                    if(!$openid->mode){
                        if(1){
                            $_SESSION['auth']="Google";
                            $openid->identity = 'https://www.google.com/accounts/o8/id';
                            echo  $openid->authUrl();
                            //header('Location: ' . $openid->authUrl());
                        }
                    }elseif($openid->mode == 'cancel'){
                        echo 'User has cancelled authentication!';
                    }else{
                        $external_login=$openid->getAttributes();
                         
                         
                         
                                                
                        $set_user_data = array(
                                'email'   		        => $external_login['contact/email'],
                                'firstname'     	    => $external_login['namePerson/first'],
                                'lastname'   		    => $external_login['namePerson/last'],
                                'logged_in_customer'    => TRUE
                        );
                       
                       //print_r($returnVal);
                       
                       $returnVal =  $this->customer_registration_model->google_registration($set_user_data);
                        
                        if($returnVal == TRUE){
							header( 'Location:'.base_url() ) ;
						}else{
							header( 'Location:http://palash.com') ;
						}
                        //$this->session->set_userdata($set_user_data);   
						 
                    }
            } catch(ErrorException $e) {
                echo $e->getMessage();
            }
        }




}
?>
