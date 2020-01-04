<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends Pardco
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $super_admin_logout = 0;
        if (array_key_exists('super_user_type', $this->session->userdata)) {
            $super_admin_logout = $this->session->userdata['super_user_type'];
        }
        $this->session->set_userdata(array('logged_in_customer' => '','default_language_type'=>''));
        unset($this->session->userdata);

		if(isset($_COOKIE["logged_in_customer_cookie"]))
		{
			setcookie("logged_in_customer_cookie", "", time() - 3600);
		}

        $this->session->unset_userdata('logged_in_customer');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('last_activity');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('local_admin_id');
        $this->session->unset_userdata('local_admin_currency_type');
        $this->session->unset_userdata('default_language_type');
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('user_name_customer');
        $this->session->unset_userdata('user_id_customer');
        $this->session->unset_userdata('user_type_customer');
        $this->session->unset_userdata('logged_in_customer');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_id_local_admin');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('customize_language');
        
        
        $this->session->unset_userdata('is_super_admin');
        $this->session->unset_userdata('super_logged_in');
        $this->session->unset_userdata('expire_at');
        $this->session->unset_userdata('super_user_name');
        $this->session->unset_userdata('super_user_id');
        $this->session->unset_userdata('super_user_type');
        $this->session->unset_userdata('root_url');
        
        
		$this->session->unset_userdata('user_fname_customer');
		$this->session->unset_userdata('user_lname_customer');
		$this->session->unset_userdata('user_mobile_customer');
		$this->session->unset_userdata('user_phone1_customer');
		$this->session->unset_userdata('user_phone2_customer');
		$this->session->unset_userdata('user_address_customer');
		$this->session->unset_userdata('user_zip_customer');
		$this->session->unset_userdata('user_zone_id_customer');
		$this->session->unset_userdata('user_email_customer');
		$this->session->unset_userdata('authKey');
		
		$this->session->sess_destroy();


            redirect(base_url());

	}
}
?>