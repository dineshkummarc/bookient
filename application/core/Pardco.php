<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pardco extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$HostName =  $_SERVER['HTTP_HOST'];
		$pathArr = explode('/', $_SERVER['REQUEST_URI']);
		if (strcasecmp($HostName, $this -> config -> item('admin_host')))
		{
			if($pathArr[1] == 'superadmin')
			{
				redirect(base_url('/admin'));				
				return ;
			}
		}
		else
		{
			// Fix hostname issues finding administrative user
			$HostName = $this -> config -> item('base_host');
			
			// We are trying admin-domain with /admin, redirect to /superadmin instead
			if($pathArr[1] == 'admin')
			{
				redirect(base_url('/superadmin'));
				return ;
			}
		}
		
		$chkHttp = explode('.', $HostName);
		$LocalHttp = isset($chkHttp[0]) ? $chkHttp[0] : '';
		
		// Ridiculous hack
		if($pathArr[1] == 'superadmin')
		$LocalAdminUserId = $this -> config -> item('superadmin_id');
		else                  
		$LocalAdminUserId = $this -> global_mod -> Check_local_admin($LocalHttp);
		
		if ($LocalAdminUserId == 0)
		{
			// Local admin was not gound, redirect to frontpage
			redirect($this -> config -> item('protocol') . $this -> config -> item('base_host'));
			return ;
		}
		
		if ((!strcasecmp($HostName, $this -> config -> item('base_host')))
		       	|| (!strcasecmp($HostName, 'www.' . $this -> config -> item('base_host'))))
		{
			// Frontpage, don't set up local admin variables in session
			return ;
		}
		
		$this -> global_mod -> GetLocalAdminAuth($LocalAdminUserId);
		$this -> global_mod -> GetBusinessDetails($LocalAdminUserId);
		
		// Set up the session
		$settings = $this->global_mod->getLocalAdminGenSetting($LocalAdminUserId);
		$address = $this->global_mod->getAdminAddress($LocalAdminUserId);
		$this->global_mod->locationDetails();
		$this->session->set_userdata('ad_country', isset($address[0]['country_name'])?$address[0]['country_name']:'');
		$this->session->set_userdata('ad_region', isset($address[0]['region_name'])?$address[0]['region_name']:'');
		$this->session->set_userdata('ad_fname', $settings->ad_fname);
		$this->session->set_userdata('ad_lname', $settings->ad_lname);
		$this->session->set_userdata('ad_hphone', $settings->ad_hphone);
		$this->session->set_userdata('ad_wphone', $settings->ad_wphone);
		$this->session->set_userdata('ad_mobile', $settings->ad_mobile);
		$this->session->set_userdata('ad_logo', $settings->ad_logo);
		$this->session->set_userdata('ad_name', $settings->ad_name);
		$this->session->set_userdata('ad_location', $settings->ad_location);
		$this->session->set_userdata('ad_city', isset($address[0]['city_name'])?$address[0]['city_name']:'' );
		$this->session->set_userdata('ad_state', $settings->ad_state);
		$this->session->set_userdata('ad_zip', $settings->ad_zip);
		$this->session->set_userdata('ad_businessPhone', $settings->ad_businessPhone);
		$this->session->set_userdata('ad_facebook', $settings->ad_facebook);
		$this->session->set_userdata('ad_youtube', $settings->ad_youtube);
		$this->session->set_userdata('ad_google', $settings->ad_google);
		$this->session->set_userdata('ad_twitter', $settings->ad_twitter);
		$this->session->set_userdata('ad_linkedin', $settings->ad_linkedin);
		$this->session->set_userdata('local_admin_email', $settings->ladmin_email);
		
		$this->session->set_userdata('local_admin_id', $LocalAdminUserId);
		$this->session->set_userdata('title', $settings->title);
		$this->session->set_userdata('local_admin_currency_type', $settings->currency);
		$this->session->set_userdata('local_admin_abbriviation', $settings->abbriviation);
		$time_diff = ($settings->gmt_symbol==0)?'-':'';
		$this->session->set_userdata('time_difference', $time_diff.$settings->gmt_value);
		$this->session->set_userdata('time_difference_sp', $settings->gmt_value);
		$this->session->set_userdata('symbol_sp', $settings->gmt_symbol);
		$pieces = explode(':', $settings->gmt_value);
		$time_diff_gcal = ($settings->gmt_symbol==0) ? '+' : '-';
		$this->session->set_userdata('time_difference_gcal', $time_diff_gcal.$pieces[0].':'.$pieces[1]);
		$language_selected = $this->global_mod->SelectedLang();
		$this->session->set_userdata('default_language_type', strtolower(isset($language_selected[0]['languages_name'])?$language_selected[0]['languages_name']:''  ));
		$this->session->set_userdata('local_admin_ses_currency_id', $settings->currency_id);
		$is_parent = $this->global_mod->is_parent();
		$this->session->set_userdata('is_parent', $is_parent);
		
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ?'2' : '1');
		$this->session->set_userdata('booking_from', $deviceType);
	}
}
?>
