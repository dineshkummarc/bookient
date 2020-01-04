<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_Password_model extends CI_Model
{
 
	function RandomString($length){
            $key='';
            $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
            for($i=0; $i < $length; $i++){
                $key .= $keys[array_rand($keys)];
            }
            return $key;
        }							



	public function ForgotPassword(){
		$local_admin_id = $this->session->userdata('local_admin_id');
				
		$this->db->select('user_id,password');
		$this->db->from('app_password_manager');
		$this->db->where('user_type', 3);
		$this->db->where('user_id',$local_admin_id);
		$this->db->where('user_email', $this->input->post('user_email'));
		$query = $this->db->get();
		$UserAuthArr = $query->result_array();
                
		if(count($UserAuthArr) > 0){
			$to  = $this->input->post('user_email'); // note the comma
			
			$this->db->select('user_email');
			$this->db->from('app_password_manager');
			$this->db->where('user_type', 5);
			$query = $this->db->get();		
			$superAdminArr = $query->result_array();
			
			$newPassword = $this->RandomString(20);
			$data = array(
			     		 'f_password' => $newPassword
			 			);
			$this->db->where('user_type', 3);
			$this->db->where('user_email', $this->input->post('user_email'));
			$this->db->where('user_id',$local_admin_id);
			$this->db->update('app_password_manager',$this->db->escape($data));
						
			$subject = 'Password Update Notification';
			
			$message  = '<div style="margin: 0; background-color: #fff; text-align: center; font-size: 14px; line-height: 1.5; color: #333; font-family: Arial; font-weight: normal;">';
			$message .= '<div style="padding: 10px; margin: 0 auto; width: auto; text-align: left; background-color: #004A82;">';
			$message .= '<img alt="logo" src="http://bookient.com/images/logo.png">';
			$message .= '</div>';
			$message .= '<div style="padding: 5px; background-color: #f0f0f0; -webkit-text-size-adjust: none; -ms-text-size-adjust: 100%; font-size: 1em;">';
			$message .= '<div style="margin: 0 auto; text-align: left; width: auto; background-color: #fff; border-radius: 8px; padding: 12px; border-top: solid 8px #742894; border-bottom: solid 8px #742894; border-left: solid 1px #E3E3E3; border-right: solid 1px #E3E3E3;">';
			$message .= '<div>';
			$message .= '<div style="font-size: 1.4em; white-space: nowrap;">';
			$message .= '<strong>Password Update Confirmationn!</strong></div>';
			$message .= '<div>';
			$message .= '<div style="margin: 1em 0px;">';
			$message .= '<strong>Hello </strong>Admin<strong>,</strong></div>';
			$message .= '<div style="margin: 1em 0px;">';
			$message .= 'Here is a notification regarding you login details.';
			$message .= '</div>';
			$message .= '<div style="border-radius:5px; margin: 1em 0px; border: 1px solid #E3E3E3; padding: 10px; background-color: #F6F6F6; white-space: nowrap;">';
			$message .= '<strong>Email		:</strong>'.$this->input->post('user_email');
			$message .= '<br>'; 
			$message .= '<strong>Password	:</strong>'.$newPassword; 
			$message .= '</div>';
			$message .= '<div style="margin: 1em 0px;">';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';
			$message .= '</div>';			
												
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: <'.$superAdminArr[0]['user_email'].'>'."\r\n";
			if(mail($to, $subject, $message, $headers)){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}	
	}																																																																			
}
?>