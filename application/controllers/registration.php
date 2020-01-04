<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registration extends CI_Controller {

public function __construct(){	
		parent::__construct();
        $this->load->model('registration_model'); 
        $this->load->model('email_verification_model');
		$this->load->model('admin/membership_model');
		
		$default_language = strtolower($this->session->userdata('default_language_type'));
		
		 if($this->session->userdata('selected_lang') == ''){
			$this->lang->load('registration', $default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('selected_lang'));
			$this->lang->load('registration', $setLanguage);
        }
    }
    public function index(){
		$HostName = $this->config->item('base_host');
		$chkHttp	=	explode(".", $HostName);
		
		$profession=$this->registration_model->profession();
		$country=$this->registration_model->country();
		$data['profession']=$profession;
		$data['country']=$country;
		$data['current_url']=$this->config->item('protocol') . $this->config->item('base_host');
		$this->load->view('main/registration/header');
		$this->load->view('main/registration/registration',$data);
		
		$this->load->view('main/registration/footer');
    }
    public function adminRegistration(){
       
        $user_name    =isset($_REQUEST['user_name'])?$_REQUEST['user_name']:'';
        $password     =isset($_REQUEST['password1'])?$_REQUEST['password1']:'';
        $fname        =isset($_REQUEST['firstname'])?$_REQUEST['firstname']:'';
        $lname        =isset($_REQUEST['lastname'])?$_REQUEST['lastname']:'';
        $email        =isset($_REQUEST['email'])?$_REQUEST['email']:'';
        $profession   =isset($_REQUEST['profession'])?$_REQUEST['profession']:'';
        $country      =isset($_REQUEST['country'])?$_REQUEST['country']:'';
        $admin_id     =isset($_REQUEST['admin_id'])?$_REQUEST['admin_id']:'';

		


        if($user_name!='' && $password!='' && $fname!='' && $lname!='' && $email!='' && $profession!='' && $country!=''){
            $encrypt_username =$this->email_verification_model->encrypt_username($user_name);
            $encription_key   =$this->email_verification_model->generateKey();
            /*****      QUERY TO INSERT INTO PASSWORD MANAGER TABLE STARTS      *****/
            $insert_app_password_manager = array( 
                                    'user_type'          => 3,
                                    'user_name'          => $user_name,
                                    'password'           => $password,
                                    'user_email'         => $email,
                                    'email_veri_status'  => 0,
                                    'user_name_enc'      => $encrypt_username,
                                    'encription_key'     => $encription_key,
                                    'date_creation'      => date("Y/m/d"),
                                    'date_modified'      => date("Y/m/d")
            );
           $user_id = $this->registration_model->insert_to_password_manager($insert_app_password_manager);
            /*****      INSERT INTO RELATION TABLE       *****/
            if(!is_numeric($profession)){
            	$profession = $this->global_mod->db_parse($profession);
				$professionId = $this->registration_model->InsertProfession($profession);
				
				if(isset($professionId)){
					$profession = $professionId;
				}
			}
            $data = array(
                                    'local_admin_id'     => $user_id,
                                    'first_name'         => $fname,
                                    'last_name'          => $lname,
                                    'profession_id'      => $profession,
                                    'country_id'         => $country
            );
            $redirect=$this->registration_model->insert_to_db($data);
            
            if($admin_id == ''){
				$insert_app_relation_manager = array( 
								'relation_localadmin_id'			=> $user_id,
								'menu_authorization'				=> 2,
								'is_parent'							=> 0,
								'relation_parent_id'				=> 0
				);
				$this->registration_model->insert_to_relation_manager($insert_app_relation_manager);
			}else{
				$insert_app_relation_manager = array( 
								'relation_localadmin_id'			=> $user_id,
								'menu_authorization'				=> 2,
								'is_parent'							=> 1,
								'relation_parent_id'				=> $admin_id
				);
				$this->registration_model->insert_to_relation_manager($insert_app_relation_manager);
			}
            /*****      QUERY TO INSERT INTO PASSWORD MANAGER TABLE ENDS        *****/

			
			
            /*****      QUERY TO INSERT INTO LOCAL ADMIN TABEL ENDS     *****/
            
            /*****      QUERY TO INSERT INTO CMS TABLE STARTS       *****/
            $cmsData = array(
                        array(
                            'local_admin_id'    =>  $user_id,
                            'cms_type'          =>  'privacypolicy',
                            'cms_dec'           =>  ''
                        ),
                        array(
                            'local_admin_id'    =>  $user_id,
                            'cms_type'          =>  'securityinfo',
                            'cms_dec'           =>  ''
                        ),
                        array(
                            'local_admin_id'    =>  $user_id,
                            'cms_type'          =>  'companyinfo',
                            'cms_dec'           =>  ''
                        )
            );
            $this->registration_model->insert_app_cms($cmsData);
            /*****      QUERY TO INSERT INTO CMS TABLE ENDS     *****/
            /* Insert into Membership plan  details  start */
			$freePlanData = $this->membership_model->getPlanDetails($this -> config -> item('default_plan_id'));
			
			$planArr["plan_name"] = $freePlanData[0]['plan_name'];
			$planArr["plan_details"] = isset($freePlanData[0]['plan_desc'])?$freePlanData[0]['plan_desc']:0;
			$currency_id = isset($freePlanData[0]['currency_id'])?$freePlanData[0]['currency_id']:0;
			
			$featureData = $this->membership_model->getMembershipFeature($this -> config -> item('default_plan_id'),'app_membership_feature.feature_id feature_id, app_membership_feature.feature_name feature_name');
		    $feature_desc	=  json_encode($featureData );
		    $plan_desc		= json_encode($planArr );
			$plandata = array(
			                    'local_admin_id'     => $user_id,
			                    'plan_id'         	 => $this -> config -> item('default_plan_id'),
			                    'is_multilocation'   => 0,
			                    'plan_desc'          => $plan_desc,
			                    'billing_cycle'      => '',
								'no_of_location'     => 0,
			                    'staff_per_location' => 0,
			                    'extra_staff'        => 0,
			                    'total_staff'        => 0,
			                    'currency_id'        => $currency_id,
								'base_price'         => 0,
			                    'base_saving_amt'    => 0,
			                    'base_promo_amt'     => 0,
			                    'base_discount_amt'  => 0,
								'base_total_amt'     => 0,
			                    'price'              => 0,
			                    'saving_amt'         => 0,
			                    'promo_amt'          => 0,
			                    'discount_amt'       => 0,	
								'total_amt'          => 0,
			                    'subscription_date'  => gmdate("Y-m-d H:i:s"),
			                    'plan_expiry_date'   => '0000-00-00',
			                    'feature_desc'       => $feature_desc,
								'payment_method_id'  => 1,
			                    'is_active'          => 1,
			                    'date_added'         => gmdate("Y-m-d")
				
			);
            $this->registration_model->savePlanData($plandata);
            /*****      QUERY TO INSERT INTO SETTINGS TABLE STARTS      *****/
            $qdata = array(
                'local_admin_id'		        => $user_id,
                'enable_system'			        => 1,
                'aprvl_rqrd_pre_payin_mem'	    => 1,
                'aprvl_rqrd_mob_verfd_mem'	    => 1,
                'aprvl_rqrd_mob_non_verfd_mem'	=> 1,
                'no_of_booking'			        => 0,
                'no_of_booking_period'		    => 1,
                'booking_starting_point'	    => 0,
                'no_of_booking_period_from'	    => '0000-00-00',
                'no_of_booking_period_to'	    => '0000-00-00',
                'recurring_appointments'	    => 1,
                'recurring_admin'		        => 1,
                'quantity_appointment_setting'	=> 1,
                'quantity_appointment'		    => 'Unit',
                'allow_international_users'	    => 1,
                'detect_client_timezone'	    => 1,
                'show_service_cost'		        => 1,
                'show_service_time_duration'	=> 1,
                'booked_times_striked'		    => 1,
                'blocked_times_striked_out'	    => 1,

                'clients_name_with_reviews'	    => 1,
                'default_view'			        => 0,
                'cal_strting_weekday'		    => 1,
                'cal_strting_dt'		        => date("Y-m-d"),

                'show_staff_customers'		    => 1,
                'staff_selection_mandatory'	    => 1,
                'staff_order'			        => 1,

                'default_language_id'		    => 1,
                'default_login_typ_id'		    => 2,
                'cal_time_interval_typ'		    => 1,
                'cal_time_interval_variable'	=> 15,

                'adv_bk_min_setting'		    => 2,
                'adv_bk_min_tim'		        => 1,
                'tim_intrvl_btwn_appo_settingin'=> 1,
                'adv_bk_mx_tim'			        => 25,
                'bkin_can_setin'		        => 1,
                'bkin_can_mx_tim'		        => 10,
                'bkin_reschdl_setin'		    => 1,
                'bkin_reschdl_mx_tim'		    => 25,
                'tim_intrvl_btwn_appo'		    => 55,
                'admn_tim_intrvl'		        => 30,

                'sms_alert'			            => 1,
                'sms_alrt_bfr_appo'		        => 20,

                'sms_thanks_aftrappo'		    => 1,
                'send_sms_for'			        => 3,
                'sms_alart_to_admin'		    => 1,
                'sms_alart_to_staff'		    => 1,
                'email_alert'			        => 1,
                'email_alrt_bfr_appo'		    => 55
            );
            $redirect=$this->registration_model->insert_app_local_admin_gen_setting($qdata);
            /*****      QUERY TO INSERT INTO SETTINGS TABLE ENDS        *****/
            
			
			/* Insert into Membership plan  details  ends */

            			/*********** Insert Data in app_design_offer Start **********/
			$app_design_offer = array( 
                                    'local_admin_id'	=> $user_id,
                                    'template_id'		=> 1,
                                    'title'				=> 'Hey, lets get social!',
                                    'description'		=> 'Why come alone? Invite your friends to come along with you. Just click on the button below and invite your friends on Facebook & Twitter.',
                                    'background_color'  => '#dbc414',
                                    'border_color'      => '#cccccc',
                                    'title_color'		=> '#241924',									
									'description_color'	=> '#241924',
                                    'image_path'		=> base_url().'uploads/businesslogo/logo.png',
                                    'repeat'			=> 'no-repeat',
									'position'			=> 'center center',									
                                    'date_added'		=> date("Y/m/d"),
                                    'date_edited'		=> date("Y/m/d")
            );
            $this->registration_model->app_design_offer_manager($app_design_offer);
			/*********** Insert Data in app_design_offer End **********/
            /*****      QUERY TO INSERT INTO THEME TABLE STARTS     *****/
            $insert_app_custom_color_scheme = array(
                                    'theme_name'         => 'CCS',
                                    'local_admin_id'     => $user_id
            );
            $this->registration_model->insert_app_custom_color_scheme($insert_app_custom_color_scheme);
            /*****      QUERY TO INSERT INTO THEME TABLE ENDS       *****/
            /*****      QUERY TO INSERT INTO LOCAL ADMIN TABLE STARTS       *****/
            
            
			            /*****      QUERY TO INSERT INTO POLICY TABLE STARTS        *****/
            $policyData = array(
                        'local_admin_id'                            =>  $user_id,
                        'background_image_url'                      =>  '',
                        'widget_url'                                =>  '',
                        'facebook_page_url'                         =>  'http://www.facebook.com/Bookient',
                        'twitter_page_url'                          =>  'http://twitter.com/Bookient'
            );
            $this->registration_model->insert_app_appoint_cancellation_policy($policyData);
            /*****      QUERY TO INSERT INTO POLICY TABLE ENDS      *****/
			
			

            
            
            
            
            
            $this->registration_model->insert_app_local_admin_gen_setting_clint_signup_info($user_id);
			$redirect=true;
        }else{
            $redirect=false;
        }
        /*****      CODE TO GET SUPER ADMIN USERNAME AND EMAIL ADDRESS STARTS       *****/
        $superArr = $this->registration_model->getSuperAdminDetails();

        /*****      CODE TO GET SUPER ADMIN USERNAME AND EMAIL ADDRESS ENDS     *****/
        if ($redirect== true){
		$host = $this -> config -> item('base_host');
		$to  = $email; // note the comma
		
		/********	CODE TO EMAIL DATA BEGINS		********/
		$subject = 'Email Verification';
		$message='
		<html>
			<head>
				<title>Email Verification</title>
			</head>
			<body>
			<div style="margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;">
				<div style="padding: 5px; margin: 0 auto; width: auto; text-align: left;">
					<img alt="bookient-logo" src="http://bookient.com/images/defult_logo.png" /></div>
						<div style="padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;">
							<div style="margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;">
								<div style="font-size: 1.4em; white-space: nowrap;">
									<p>Dear <strong>'.$fname .' '.$lname .'</strong>,</p>
									<p>Thank you for registering with Bookient!</p>
								</div>
								<div>
									<p>Your account has been created with the following details:</p>
									<div style="border-radius: 5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;">
										<p>Username: <strong>'.$user_name.'</strong><br/>
										Password: <strong>'.$password.'</strong></p>
									</div>
									<p>To activate your account, please verify your email by <a href="'.$user_name.'.'.$host.'/email_verification/VeriFication/'.$encrypt_username.'/'.$encription_key.'">Click here</a></p>
									<p>Or</p>
									<p> Copy and paste the below link <br><a href="#" style="cursor:default;color:#000;text-decoration:none;">'.$user_name.'.'.$host.'/email_verification/VeriFication/'.$encrypt_username.'/'.$encription_key.'</a></p>
									
								</div>
								<h2>Getting started:</h2>
								<div>
									<h3>Admin:</h3>
									<div style="border-radius: 5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;">
										<p>Login URL: <a href="http://'.$user_name.'.'.$host.'/admin">http://'.$user_name.'.'.$host.'/admin</a><br/>
										Email: '.$email.'</p>
									</div>
								</div>
								<div>
									<h3>Customer:</h3>
									<div style="border-radius: 5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;">
										<p>Use and registration URL: <a href="http://'.$user_name.'.'.$host.'">http://'.$user_name.'.'.$host.'</a></p>
									</div>
										<p>Having trouble accessing your account? Please contact <a href="mailto:support@pard.co">support@pard.co</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</body>
		</html>
		';
		/********	CODE TO EMAIL DATA BEGINS		********/
		
	    $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$superArr[0]['user_name'].' <'.$superArr[0]['user_email'].'>' . "\r\n";
		mail($to, $subject, $message, $headers);
		echo 1;
        }
    }
    public function confirmRegistration(){
        $this->load->helper('url');
        $this->load->view('main/registration/usersignup');
    }
    public function check_user_name_ajax(){
        $this->load->model('registration_model');
        $uname = $this->input->post('uname');
        $returndata = $this->registration_model->checkUserName($uname);
        echo $returndata;
    }
    public function checkEmailAjax(){
        $this->load->model('registration_model');
        $email = $this->input->post('email');
        $returndata = $this->registration_model->checkEmail($email);
        echo $returndata;
    }
}
