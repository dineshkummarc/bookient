<?php
class Sms_model extends CI_Model {
   
   function sendSms($to,$body,$userType='',$event=0){
   
   	
   	$user =		$this->config->item('sms_user');
    $password =	$this->config->item('sms_password');
    $api_id =	$this->config->item('sms_api_id');
    
	
	$user = 'ttuukka';
	$password = 'KaORWZFKJQBegQ';
	$api_id = '3465468';
	
	
	
	
	$baseurl ="http://api.clickatell.com";
    $respons =	array();
 
    $text = urlencode($body);
 
    // auth call
    $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
 
    // do auth call
    $ret = file($url);
 
    // explode our response. return string is on first line of the data returned
    $sess = explode(":",$ret[0]);
    if ($sess[0] == "OK") {
 
        $sess_id = trim($sess[1]); // remove any whitespace
        $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
 
        // do sendmsg call
        $ret = file($url);
        $send = explode(":",$ret[0]);
 
        if ($send[0] == "ID") {
        	$respons['type']	= 1;
        	$respons['msg']		= $send[1];
        } else {
        	$respons['type']	= 2;
        	$respons['msg']		= "Send message failed";
        }
    } else {
    	$respons['type']		= 3;
    	$respons['msg']			= "Authentication failure: ". $ret[0];
    }
   
   
    $localAdminId		=	$this->session->userdata('local_admin_id');
    $gmNow = gmdate('Y-m-d H:i:s', time());
    $data = array(
    			 'message_id'			=> $respons['msg'],
    			 'message_type' 		=> $respons['type'],
    			 'local_admin_id'		=> $localAdminId,
    			 'msg_sent_date_time'	=> $gmNow,
    			 'sent_to'				=> $userType,
    			 'phone_no'				=> $to,
    			 'message'				=> $body,
    			 'event'				=> $event
    		);
    $this->db->insert('app_sms_data', $data); 
    
     return $respons;
     
     
    
   }
   
}