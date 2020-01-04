<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Preservevariable
{

	public function __construct()
	{

	}

	function clear_preserve_vars(){

		$CI =& get_instance();
		$CI->load->library('session');
		$CI->session->set_userdata('PreserveLink');

	}


	function set_preserve_vars($PreserveLink)
	{
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->session->set_userdata('PreserveLink',$PreserveLink);
		//print
                $CI->session->userdata('PreserveLink');

	}


	function get_preserve_vars()
	{
			$CI =& get_instance();
			$CI->load->library('session');
			$url_finder = array('~');
			$url_replacer = array('/');

			$output = array();
			$arr = explode('/',$CI->session->userdata('PreserveLink'));

			$CI->session->userdata('PreserveLink');

			for($i=0;$i<count($arr);$i++){
			if($i%2==0 && $i!=0)
			$output[$arr[$i-1]] = str_replace($url_finder,$url_replacer,$arr[$i]);
			}

			return $output;
	}



}

