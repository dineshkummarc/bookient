<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Croncontrollers extends Pardco  {
	public function __construct(){
        parent::__construct();
        $this->load->model('croncontrollers_model');
    }	
	
	public function collectingAllBookingAsPerRuls($cronIntval=0){	
		$localAdmin =		$this->croncontrollers_model->findLocalAdmin();
		foreach($localAdmin as $key=>$localAdminArr){
				$localAdminId = $localAdminArr['user_id'];
				
				///Set one start
				$lASettings =		$this->croncontrollers_model->findLocalAdminSettings($localAdminId);
				if($lASettings[0]['sms_alert'] == 1){ //For sms
					$allBooking =		$this->croncontrollers_model->findLocalAdminBooking($localAdminId,$lASettings[0]['sms_alrt_bfr_appo'],$cronIntval);	
					if(count($allBooking)>0){
						$this->croncontrollers_model->insertDataInCronTableSms($allBooking);
					}
				}
				if($lASettings[0]['email_alert'] == 1){ //For Mail
					$allBooking =		$this->croncontrollers_model->findLocalAdminBooking($localAdminId,$lASettings[0]['email_alrt_bfr_appo'],$cronIntval);
					if(count($allBooking)>0){
						$this->croncontrollers_model->insertDataInCronTableEmail($allBooking);
					}
				}
				///Set one end
				
				///Set Two start
				$allPromoData =		$this->croncontrollers_model->findAutoPromotionLocalAdminWise($localAdminId,$cronIntval);
				
				if(count($allPromoData)>0){
					foreach($allPromoData as $key=>$allPromoDataArr){
						$this->croncontrollers_model->findPromotion($allPromoDataArr);
					}
				}			
				///Set two end
				
				///Set three start
				
				
				
				
				///Set three end				
		}
		
		$this->sendCronMail();
		$this->sendCronSms();
		$this->PostOnFacebook();	
	}
		
	public function sendCronSms(){
		
		$allSmsData = $this->croncontrollers_model->selectAllSmsData();
		if(count($allSmsData) >0){
		foreach($allSmsData AS $val=>$allSmsDataArr){
		
		
		$startDetails = array(
		               'cron_messages_status' => 2,
		               'cron_executed_datetime' => date("Y-m-d H:i:s")
		            );
		$this->db->where('cron_id', $allSmsDataArr['cron_id']);
		$this->db->update('app_cron_manager', $startDetails);

		//$user =		$this->config->item('sms_user');
		//$password =	$this->config->item('sms_password');
		//$api_id =	$this->config->item('sms_api_id');

		$user = 'ttuukka';
		$password = 'KaORWZFKJQBegQ';
		$api_id = '3465468';
			
		$baseurl ="http://api.clickatell.com";
	    $respons =	array();
	 
	 	$mobile	= $allSmsDataArr['cron_customer_mobile'];
	    $text	= urlencode($allSmsDataArr['cron_messages']);
	 
	    // auth call
	    $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
	 
	    // do auth call
	    $ret = file($url);
	 
	    // explode our response. return string is on first line of the data returned
	    $sess = explode(":",$ret[0]);
	    if ($sess[0] == "OK") {
	 
	        $sess_id = trim($sess[1]); // remove any whitespace
	        $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$mobile&text=$text";
	 
	        // do sendmsg call
	        $ret = file($url);
	        $send = explode(":",$ret[0]);
	 
	        if ($send[0] == "ID"){
	        	$respons = array(
					               'cron_messages_status' => 3,
					               'cron_sms_respons' => $send[1],
					               'cron_finished_datetime' => date("Y-m-d H:i:s")
					            );
	        	
	        	
	        	
	        } else {
	        	$respons = array(
					               'cron_messages_status' => 4,
					               'cron_sms_respons' => "Send message failed",
					               'cron_finished_datetime' => date("Y-m-d H:i:s")
					            );
	        }
	    }else{
	    		$respons = array(
					               'cron_messages_status' => 4,
					               'cron_sms_respons' => "Authentication failure: ". $ret[0],
					               'cron_finished_datetime' => date("Y-m-d H:i:s")
					            );
	    }

		$this->db->where('cron_id', $allSmsDataArr['cron_id']);
		$this->db->update('app_cron_manager', $respons);
	    }
	    }
		
	}
	
	public function sendCronMail(){
		
		$allSmsData = $this->croncontrollers_model->selectAllEmailData();
		if(count($allSmsData) >0){
		foreach($allSmsData AS $val=>$allSmsDataArr){
			$startDetails = array(
			           'cron_messages_status' => 2,
			           'cron_executed_datetime' => date("Y-m-d H:i:s")
			        );
			$this->db->where('cron_id', $allSmsDataArr['cron_id']);
			$this->db->update('app_cron_manager', $startDetails);
			
			$this->load->library('email');
	        $this->email->from($allSmsDataArr['cron_sender_email']);
	        $this->email->to($allSmsDataArr['cron_customer_email']); 
	        $this->email->subject($allSmsDataArr['cron_subject']);
	        $this->email->message($allSmsDataArr['cron_messages']);	
	        $this->email->set_mailtype("html");
	        $mail = $this->email->send();
	        
	        
			
		if($mail){
				$respons = array(
					               'cron_messages_status' => 3,
					               'cron_email_respons' => "mail send",
					               'cron_finished_datetime' => date("Y-m-d H:i:s")
					            );
			}else{
				$respons = array(
				           'cron_messages_status' => 4,
				           'cron_email_respons' => "Authentication failure: ",
				           'cron_finished_datetime' => date("Y-m-d H:i:s")
				        );
			}
			
			$this->db->where('cron_id', $allSmsDataArr['cron_id']);
			$this->db->update('app_cron_manager', $respons);
			}
		}
		
		

	}
	
	public function PostOnFacebook(){
		$allSmsData = $this->croncontrollers_model->selectAllPostData();
		
		$this->load->library('facebook'); 
		$user = $this->facebook->getUser();
		if($user){
		$ret_obj = $this->facebook->api('/me/feed', 'POST',
		                        array(
		                          'link' => base_url(),
		                          'message' => $str
		                     ));
		}
		
		
	}
	
	
	
	
	
	
	
}




?>