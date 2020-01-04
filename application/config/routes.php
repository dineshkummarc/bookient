<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Bookient
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade Bookient to newer
* versions in the future. You can customise Bookient for your needs and if you find bugs
* please report to us (contact@pard.co) and commit fixed files to Bookient repository.
*
* @copyright  Copyright (c) 2015 www.bookient.com
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/


$HostNameFrRouter =  $_SERVER['HTTP_HOST'];


if( $HostNameFrRouter != "yourdomain.com" &&  $HostNameFrRouter != "www.yourdomain.com" && $HostNameFrRouter != "register.yourdomain.com" ){
	$route['default_controller'] = "page";
}else{
	$route['default_controller'] = "registration";
}



$route['404_override'] = '';


$route['logout'] = 'logout';
$route['logout/(:any)'] = 'logout/$1';

$route['admin/logout'] = 'logout';
$route['admin/logout/(:any)'] = 'logout/$1';

$route['admin'] = 'admin/calender';
$route['superadmin'] = 'superadmin/dashboard';


$route['staff'] = 'staff/staff_login';

