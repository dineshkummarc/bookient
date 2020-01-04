<?php
class Email_model extends CI_Model {

	public function getMailBody($contentId){
		$local_admin_id = $this->session->userdata('local_admin_id');
		//$local_lang_id = ($this->session->userdata('default_language_type')=='') ? '1' : $this->session->userdata('default_language_type');
		
		if($this->session->userdata('default_language_type')==''){
			$local_lang_id = 1;
		}else{
			$local_lang_id = $this->getLangId($this->session->userdata('default_language_type'));
		}
		
		$this->db->select('msg_subject, msg_body');
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->where('language_id',$local_lang_id);
		$this->db->where('msg_id',$contentId);
		$query = $this->db->get('app_msg_language');
        $mailArr = $query->result_array();
        
        if(!empty($mailArr)){
			return $mailArr;
		}else{
			$this->db->select('mail_demo_subject AS msg_subject ,mail_demo_content AS msg_body');
			$this->db->where('msg_id',$contentId);
			$this->db->where('is_active ','1');
			$query = $this->db->get('app_email_msg');
        	$mailArr = $query->result_array();
        	return $mailArr;
		}	
	}


	 public function sentMail($contentId, $replacerArr, $toArr, $from, $attachment=''){
		$emailDetails = $this->getMailBody($contentId);
		
		
        $subject = $emailDetails[0]['msg_subject'];
      	$mail_body = $emailDetails[0]['msg_body'];
     	
        foreach($replacerArr as $key=>$val){ 
            if($key == "{businessname}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{fname}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{lname}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			
			if($key == "{businessaddress}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{appointmentStartDate}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{clickurl}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{businessphone}"){
				$mail_body = str_replace($key, $val, $mail_body);
			} 
			if($key == "{cancellationpolicy}"){
				$val = '<br/>'.$val;
				$mail_body = str_replace($key, $val, $mail_body);
			}    
			if($key == "{businessemail}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{businessLink}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{yourfullname}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{AppointmentInfo}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{appointmentdate}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{clientemail}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{OldAppointmentInfo}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{cancelAppLink}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{hoursbeforecancellation}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			if($key == "{CurrentPassword}"){
				$mail_body = str_replace($key, $val, $mail_body);
			}
			
        } 
       	
      	$this->load->library('email');
      	$config['charset'] = 'iso-8859-1';
      	$this->email->initialize($config);
      	
        $this->email->from($from);
        $this->email->to($toArr); 
        $this->email->subject($subject);
        $this->email->message($mail_body);	
        $this->email->set_mailtype("html");
        $mail = $this->email->send();
        
        return $mail; 
    }
	
	public function PromotionalMail($subject, $mail_body, $to,$from){
		
      	$this->load->library('email');
        $this->email->from($from);
        $this->email->to($to); 
        $this->email->subject($subject);
        $this->email->message($mail_body);	
        $this->email->set_mailtype("html");
        $mail = $this->email->send();
        
        return $mail; 
    }

	function getLangId($name){
		$sql = 'SELECT * FROM `app_languages` WHERE `languages_name`="'.$name.'"';
		$this->db->select('languages_id');
		$this->db->where('languages_name',$name);
		$query = $this->db->get('app_languages');
        $return = $query->result_array();
        return $return[0]['languages_id'];
	}

}