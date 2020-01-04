<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_verification_model extends CI_Model
{
	
	public function __construct(){
		$this->load->database();
	}
	public function generateKey(){
		$uniqueKey=uniqid('key').uniqid('').uniqid('');
		return $uniqueKey;
	}
	public function encrypt_username($user_name){
		$encrypt_username1=base64_encode($user_name);
		$encrypt_username=str_replace("=","unK468pd",$encrypt_username1);
		return $encrypt_username;
	}
	function verificationCheck($user_name,$unique_key){
		$this->load->database();
		$local_admin_id_sess = $this->session->userdata('local_admin_id');
		$local_admin_id_url  = $_SERVER['HTTP_HOST'];
		$HstNmExploded       = explode(".", $local_admin_id_url);
		$LocalAdminName      = $HstNmExploded[0];
		$LocalAdminUserId    = $this->pardco_model->Check_local_admin($LocalAdminName);
		if($local_admin_id_sess == $LocalAdminUserId)
		{
			$encrypt_username = $user_name;
			$sql1=$this->db->query("select user_name,user_id,encription_key,email_veri_status from app_password_manager Where user_name_enc ='".$encrypt_username."'");
			if ($sql1->num_rows() == 1)
			{
				$row=$sql1->result_array();
				$user_name=$row[0]['user_name'];
				$user_id=$row[0]['user_id'];
				$encription_key=$row[0]['encription_key'];
				$email_veri_status=$row[0]['email_veri_status'];
				if($email_veri_status == 0)
				{
					if($encription_key == $unique_key)
					{
						$chng_status = array(
                            'email_veri_status' => 1,
						);
						$this->db->trans_begin();
						$this->db->where('user_id',$user_id);
						$this->db->update('app_password_manager', $chng_status);
						if ($this->db->trans_status() === FALSE)
						{
							$this->db->trans_rollback();
						}
						else
						{
							$this->db->trans_commit();
						}
						$msg="Email Successfully Verified!! Go to admin panel&nbsp; <a href='".base_url()."admin/calender'>click here </a>";
					}
					else
					{
						$msg="Data modified manualy";
					}
				}
				else
				{
					$msg="You are already a verified member";
				}
			}
			else
			{
				$msg="Data modified manualy";
			}
		}
		else
		{
			$msg = "Wrong Local Admin Selected";
		}
	    return $msg;
	}
    function verify_user_check($user_name){
        $HstNmExploded       = explode("A", $user_name);
        $user_id = $HstNmExploded[1];
        $data = array('email_veri_status' => 1 );
        $this->db->where('user_id', $user_id);
        $this->db->update('app_password_manager', $data);
        $msg;
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg = 'Email cannot be verified. Please register again!';
        }
        else
        {
            $this->db->trans_commit();
            $msg = 'Email Successfully Verified!';
        }
        return $msg;
    }
}
?>