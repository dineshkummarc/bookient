<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Pardco {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/customer_model');
        /*===================LogIn Security Check===================*/
        $this->global_mod->checkSession();
        /*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_customer',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_customer',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
    }
    public function index(){
		
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $list['employee']=$this->pardco_model->employee();
        $list['service']=$this->pardco_model->service();
        $list['show_all_customer']                          = $this->customer_model->showAllCustomer();
        $list['country']                                    = $this->customer_model->country();
        $list['city']                                       = $this->customer_model->city();
        $list['region']                                     = $this->customer_model->region();
        $list['time_zone']                                  = $this->customer_model->time_zone();
            
        $list['approval_type']                              = $this->customer_model->approval_type();
        $list['checkFieldstatus']                           = $this->customer_model->checkFieldstatus();
        $list['showAllCustomerNameForSearch']               = $this->customer_model->showAllCustomerNameForSearch();
        $list['showAllCustomerName_by_First_Alphabet']      = $this->customer_model->get_AllCustomer();

        $this->load->view('admin/customer/customer',$list);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    
    function ajax_check1(){
        $country_id= $_REQUEST['id'];
        $showregion=$this->customer_model->region_ajax($country_id);
        echo $showregion;
    }
    function ajax_region_check1(){
        $region_id= $_REQUEST['id'];
        $showcity=$this->customer_model->city_ajax($region_id);
        echo $showcity;
    }
    function searchCustomerAjax(){
        $cus_name_search= $this->input->post('cus_name_search');
        $showSearchResult=$this->customer_model->searchCustomer($cus_name_search);
        echo $showSearchResult;
    }
    function selectCustomerAjax(){
    	$customer_id=$this->input->post('customer_id');
        if(!empty($customer_id)){
            $showCustomerDetails = $this->customer_model->selectCustomer($customer_id);
            
         //   echo "<pre>";
          //  print_r($showCustomerDetails);
         //   echo "<pre>";
            
           echo $showCustomerDetails['cus_fname'].'@@'.$showCustomerDetails['cus_lname'].'@@'.$showCustomerDetails['cus_address'].'@@'.$showCustomerDetails['city_name'].'@@'.$showCustomerDetails['region_name'].'@@'.$showCustomerDetails['country_name'].'@@'.$showCustomerDetails['cus_zip'].'@@'.$showCustomerDetails['cus_mob'].'@@'.$showCustomerDetails['cus_phn1'].'@@'.$showCustomerDetails['cus_phn2'].'@@'.$showCustomerDetails['customer_tag'].'@@'.$showCustomerDetails['customer_info'].'@@'.$showCustomerDetails['time_zone_id'].'@@'.$showCustomerDetails['user_email'].'@@'.$showCustomerDetails['email_veri_status'].'@@'.$showCustomerDetails['flag'].'@@'.$showCustomerDetails['customer_id'].'@@'.$showCustomerDetails['link'];
          
           
        }else{
            echo json_encode(array('flag'=>'0'));
        }
    }
    
    function checkEmail(){
        $emailId = $this->input->post('email_id');
        $check = $this->global_mod->checkDuplicatEmailCustomer($emailId);
        if($check == "true"){
            echo 1;
        }
    }
    function displayEditCustomerAjax(){
        $showCustomerDetailsForEdit='';
        if(!empty($_REQUEST['customer_id'])){
            $customer_id=$_REQUEST['customer_id'];
            $showCustomerDetailsForEdit.=$this->customer_model->showDetailsForEditCustomer($customer_id);
            $showCountry=$this->customer_model->countryOfUser($customer_id);
            $showRegion = $this->customer_model->regionOfUser($customer_id);
            
            $showCity=$this->customer_model->cityOfUser($customer_id);
            $showApproval=$this->customer_model->approval_type($customer_id);
            $showCustomerDetailsForEdit.='@@@'.$showCountry.'@@@'.$showRegion.'@@@'.$showCity.'@@@'.$showApproval;
            echo $showCustomerDetailsForEdit;
        }else{
            echo "no";
        }
    }
    function inviteCustomerAjax(){
        $customer_id= $this->input->post('customer_id');
        $user_data=$this->customer_model->inviteCustomer($customer_id);
        $host=$_SERVER['HTTP_HOST'];
        // multiple recipients
        $to  = $user_data['user_email']; // note the comma
        $from = $this->customer_model->local_admin_email();
        //$to .= 'wez@example.com';
        // subject
        $subject = 'Invite To Schedule Online';
        $message="
            <html>
            <head>
            <title>Invite To Schedule Online </title>
            </head>
            <body>
            Dear ".$user_data['cus_fname']." ".$user_data['cus_lname'].",<br/>
            We invite you to schedule your next appointment with Citytech Corp using our Online Appointment System.<br/>
            It is very simpleand you can select the exact service and date you require.<br/>
            Make your appointments at any time, 24 hours a day. No more waiting on the phone.<br/><br/>
            To book appointments you will require to remember the following login details.<br/>
            URL: http://".$host."<br/>
            We hope you will like this new service and look forward to seeing you soon. <br/>
            Thank You. <br/>
            Pardco Team<br/><br/>
            We use Bookient, the most powerful scheduling software on earth which is helping me to grow my business virally. Its free! Click here to try now
            </body>
            </html>
            ";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
        mail($to, $subject, $message, $headers);
        //echo $message;
    }
    function customerAddajax(){
        $insert_list = $_POST;
        if(!empty($_REQUEST['user_email'])){
            $msg=$this->customer_model->customerAdd($insert_list);
            $showAllCustomer=$this->customer_model->showAllCustomer();
            echo $showAllCustomer;
        }else{
            echo "no";
        }
    }
    function deleteCustomerAjax(){
        if(!empty($_REQUEST['customer_id'])){
            $customer_id=$_REQUEST['customer_id'];
            $msg=$this->customer_model->deleteCustomer($customer_id);
            $showAllCustomer=$this->customer_model->showAllCustomer();
            echo $showAllCustomer;
        }else{
            echo "no";
        }
    }
    function addTagAjax(){
        $tag= $this->input->post('tag');
        $customer_id= $this->input->post('customer_id');
        $tag1=$this->customer_model->addTag($tag,$customer_id);
        echo $this->global_mod->db_parse($tag1);
    }
    function addInfoAjax(){
        $info= $this->input->post('info');
        $customer_id= $this->input->post('customer_id');
        $info1=$this->customer_model->addInfo($info,$customer_id);
        echo $this->global_mod->db_parse($info);
    }
    function upcomingAppointmentsAjax(){
        $customer_id= $this->input->post('customer_id');
        $upcomingAppointments=$this->customer_model->upcomingAppointments($customer_id);
        echo $upcomingAppointments;
    }
    function pastAppointmentsAjax(){
        $customer_id= $this->input->post('customer_id');
        $pastAppointments=$this->customer_model->pastAppointments($customer_id);
        echo $pastAppointments;
    }
    //CB#SOG#4-12-2012#PR#S
    function verify_customerAjax(){
        $customer_id= $this->input->post('id');
        $this->customer_model->verify_Customer($customer_id);
    }
    function send_passAjax(){
        $customer_id= $this->input->post('id');
        echo $return = $this->customer_model->send_Pass_to_Ajax($customer_id);
    }

    function selectGroup(){
		$customer_id= $this->input->post('customer_id');
		$return = $this->customer_model->selectGroupDetails($customer_id);
		
			$ste ='';
			$ste.='<div style="display:block; margin-left: 132px;">';
			$ste.='<table>';
			$ste.='<tr>';
			$ste.='<td colspan="2">';
			$ste.='<b>Please select for grouping</b>';
			$ste.='</td>';
			$ste.='</tr>';
        	foreach($return AS $returnArr){
				$ste.='<tr>';
				$ste.='<td>';
				$ste.='<input type="checkbox" class="grpClass" id="cust_';
				$ste.=$returnArr['customertype_id'];
				$ste.='"';
				if($returnArr['typerelation_customer_id'] !=''){
				$ste.=' checked= "checked"';	
				}
				$ste.=' value= "';
				$ste.=$returnArr['customertype_id'];
				$ste.='"';
				$ste.=' />';
				$ste.='</td>';
				$ste.='<td>';
				$ste.=$returnArr['customertype_name'];
				$ste.='</td>';
				$ste.='</tr>';
			}
			$ste.='<tr>';
			$ste.='<td colspan="2" align="center"><br/><input type="button" onClick="saveSelectGroup('.$customer_id.')"  value="submit" class="btn-blue" />&nbsp;&nbsp;<input type="button" onClick="cancelGroup()"  value="Cancel" class="btn-blue" /></td>';
			$ste.='</tr>';
			$ste.='</table></div>';
			
			echo $ste;
    	}
    function personalDetails(){
	$customer_id= $this->input->post('customer_id');
	$return = $this->customer_model->selectPersonalDetails($customer_id);	
			$ste ='';
			$ste.='<div style="display:block; margin-left: 132px;">';
			$ste.='<table>';
			
			$ste.='<tr>';
			$ste.='<td colspan="2">';
			$ste.='<b>Please enter your date of birth</b><br>';
			$ste.='<input type="text" id="birth_'.$customer_id.'" value="'.$return[0]['cus_dob'].'">';
			$ste.='</td>';
			$ste.='</tr>';
			
			$ste.='<tr>';
			$ste.='<td colspan="2">';
			$ste.='<b>Please enter your anniversary date</b><br>';
			$ste.='<input type="text" id="anniversary_'.$customer_id.'" value="'.$return[0]['cus_anv_date'].'">';
			$ste.='</td>';
			$ste.='</tr>';
			
			$ste.='<tr>';
			$ste.='<td colspan="2" align="center"><br/><input type="button" onClick="savePersonalDetails('.$customer_id.')"  value="submit" class="btn-blue" />&nbsp;&nbsp;<input type="button" onClick="cancelGroup()"  value="Cancel" class="btn-blue" /></td>';
			$ste.='</tr>';
			$ste.='</table></div>';
			
			echo $ste;	
	}
    
    
    function change_password(){
        $this->load->database();
        $rtn = '';
        $rtn .='<div style="display:block">
                 <table>
                    <tr>
                        <td colspan="2">
                            <a class="close-ic" href="javascript: cancel_change();"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>'.$this->lang->line("new").':</label>
                        </td>
                        <td>
                            <input type="password" id="new"  style=" width:88%" onFocus="hide_err_or(this.id)"/>
                        </td>
                        <td>
                            <div id="error_new" style="color:#FF0000"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>'.$this->lang->line("confirm").':</label>
                        </td>
                        <td>
                            <input type="password" id="confirm"  style=" width:88%"  onfocus="hide_err_or(this.id)"/>
                        </td>
                        <td>
                            <div id="error_confirm" style="color:#FF0000"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><br/><input type="button" onClick="confirm_password()"  value="'.$this->lang->line("submit").'" class="btn-blue" /></td>
                    </tr>
                </table></div>';
       echo $rtn;
    }
    function save_password(){
        $this->load->database();

        $newpassword = $_REQUEST['new'];
        $customer_id = $_REQUEST['customer_id'];
		$return = $this->customer_model->ChangePasswordModel($customer_id,$newpassword);
		if($return == 1){
			$customerDetails = $this->customer_model->GetUserDetails($customer_id);
			$firstName = $customerDetails[0]['value'];
			$lastName = $customerDetails[1]['value'];
			
		//	echo "<pre>";
		//	print_r($customerDetails);
		//	echo "</pre>";
		//	exit;
			
			$replacerArr = array(
						'{fname}' 					=> $firstName,
						'{lname}' 					=> $lastName,
						'{CurrentPassword}'			=> $newpassword
			);

			$toArr		= $customerDetails[1]['user_email'];	
			$from		= $this->session->userdata('local_admin_email');
			
			
			$this->email_model->sentMail(12,$replacerArr,$toArr,$from);
			echo 1;
		}
        
    }
    function showall_customerAjax(){
        echo $this->customer_model->showAllCustomer();
    }
    function export_excel_csv(){
        ob_clean();
        $data = $this->customer_model->export_excel();
        
        $filename = 'file.xls'; // The file name you want any resulting file to be called.
        #create an instance of the class
        $xls = new ExportXLS($filename);
        #lets set some headers for top of the spreadsheet
        $header[] = $this->lang->line('first_name');
        $header[] = $this->lang->line('last_name');
        $header[] = $this->lang->line('email');
        $header[] = $this->lang->line('address');
        $header[] = $this->lang->line('city');
        $header[] = $this->lang->line('region');
        $header[] = $this->lang->line('country');
        $header[] = $this->lang->line('zip');
        $header[] = $this->lang->line('mobile');
        $header[] = $this->lang->line('phone1');
        $header[] = $this->lang->line('phone2');
        $header[] = $this->lang->line('Date');
        $xls->addHeader($header);
        foreach ($data as $val){
            $row = array();
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_fname);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_lname);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->user_email);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_address);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->city_name);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->region_name);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->country_name);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_zip);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_mob);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_phn1);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->cus_phn2);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val->date_inserted);
            $xls->addRow($row);
        }
        $xls->sendFile();
    }
	function savePersonalDetails(){
		$customer_id			= $this->input->post('customer_id');
		$customer_birth			= $this->input->post('customer_birth');
		$customer_anniversary	= $this->input->post('customer_anniversary');		
		$this->customer_model->savePersonalDetails($customer_id,$customer_birth,$customer_anniversary);		
		echo 1;		
	}
	function saveSelectGroup(){
		$customer_id	= $this->input->post('customer_id');
		$groupIds		= $this->input->post('groupIds');
		$this->customer_model->saveSelectGroup($customer_id,$groupIds);
		echo 1;
	}







}