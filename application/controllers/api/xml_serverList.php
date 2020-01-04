<?php

class Xml_serverList extends CI_Controller {

	function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');

		$config['functions']['Booking_list'] = array('function' => 'Xml_serverList.getUserInfo');

		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
	
	function getUserInfo($request)
    {
        $username = 'verstas@gmail.com';
        $password = 'citytech';

        $this->load->library('xmlrpc');
    
        $parameters = $request->output_parameters();

        if ($parameters['0'] != $username OR $parameters['1'] != $password){
            return $this->xmlrpc->send_error_message('100', 'Invalid Access');
        }else{
			$response = array(array('nickname'  => array('Smitty','string'),
                                'userid'    => array('99','string'),
                                'url'       => array('http://yoursite.com','string'),
                                'email'     => array('jsmith@yoursite.com','string'),
                                'lastname'  => array('Smith','string'),
                                'firstname' => array('John','string'),
                                'email1' => $parameters['0'],
                                'Pass1' => $parameters['1']
                                ),
                         'struct'); 
            return $this->xmlrpc->send_response($response);
		}
    }
	
	
}
?>