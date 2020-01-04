<?php

class Xml_clientList extends CI_Controller {

	function index()
	{
 		$this->load->helper('url');
		$server_url = site_url('api/xml_serverList');

		$this->load->library('xmlrpc');

		$this->xmlrpc->server($server_url, 80);
		$this->xmlrpc->method('Booking_list');
		
		$request		= array('verstas@gmail.com','citytech');
		$this->xmlrpc->request($request);

		if (!$this->xmlrpc->send_request()){
			echo $this->xmlrpc->display_error();
		}else{
			echo '<pre>';
			print_r($this->xmlrpc->display_response());
			echo '</pre>';
		}
	}
}
?>