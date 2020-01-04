<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_logout extends Pardco
{
	public function __construct()
	{
		parent::__construct();
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

        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('expire_at');
        $this->session->unset_userdata('user_name_staff');
        $this->session->unset_userdata('user_id_staff');
        $this->session->unset_userdata('user_type_staff');
        $this->session->unset_userdata('logged_in_staff');

        $this->session->sess_destroy();
            redirect(base_url());
	}
}
?>