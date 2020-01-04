<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_Password_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}
        
        
        
        
        function RandomString($length) 
        {
            $key='';
            $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
            for($i=0; $i < $length; $i++) 
            {
                $key .= $keys[array_rand($keys)];
            }
            return $key;
        }
        
        
        

	public function ForgotPassword()
	{
		//CB#SOG#10-12-2012#PR#S
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('user_email');
		$this->db->from('app_password_manager');
		$this->db->where('user_id',$local_admin_id);
		$query = $this->db->get();		
		$Ret_Arr_val = $query->result_array();       
		//echo '<pre>';print_r($Ret_Arr_val[0]['user_email']);exit;
		$email_from = $Ret_Arr_val[0]['user_email'];
		
		$this->db->select('user_id,password');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $this->input->post('user_name'));
		$this->db->where('user_type', 2);
		$this->db->where('user_email', $this->input->post('user_email'));
		$query = $this->db->get();
		$UserAuthArr = $query->result_array();
                
                
                
                
                $newPassword = $this->RandomString(20);
                $data = array(
                              'password' => $newPassword
                         );
                     $this->db->where('user_name', $this->input->post('user_name'));
                     $this->db->where('user_type', 2);
                     $this->db->where('user_email', $this->input->post('user_email'));
                     $this->db->update('app_password_manager',$this->db->escape($data));
                
                
                
                
                
                
                
                
                
                
                
                
		
		if(count($UserAuthArr) > 0)
		{
			$to  = $this->input->post('user_email'); // note the comma
			$subject = 'Password Notification';
			$message = '
			<html>
			<head>
			  <title>Password Notification</title>
			</head>
			<body>
			  <p>Dear SuperAdmin,</p><br>
			  <p>Here is a notification regarding you login details.</p><br>
			  <table>
				<tr>
				  <th>User Name : </th><td>'.$this->input->post('user_name').'</td>
				</tr>
				<tr>
				  <th>Password : </th><td>'.$newPassword.'</td>
				</tr>
			  </table>
			</body>
			</html>
			';
			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: <'.$email_from.'>'."\r\n";
			if(mail($to, $subject, $message, $headers))
				echo 1;
		}
		else
			echo 0;
	}
	//CB#SOG#10-12-2012#PR#E
}
?>