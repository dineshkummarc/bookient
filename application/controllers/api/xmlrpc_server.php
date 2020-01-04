<?php

class Xmlrpc_server extends CI_Controller {

	function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');

		$config['functions']['Greetings'] = array('function' => 'Xmlrpc_server.process');

		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}


	function process($request)
	{
		$parameters = $request->output_parameters();
		$response = array(
							array(
									'enami'		=> $parameters['0'],
									'password'	=> $parameters['1'],
									'i_respond' => 'Not bad at all.'),
							'struct');

		return $this->xmlrpc->send_response($response);
	}
}
?>