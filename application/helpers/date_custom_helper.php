<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('date_format_admin')){
function date_format_admin($date)
{
	if($date=="0000-00-00"||empty($date)|| $date=="00/00/0000")
	{
		return "Unedited";
	}	
	else
	{
		$date_arr=explode("-",$date);
		$date_str=$date_arr[2]."/".$date_arr[1]."/".$date_arr[0];
		return $date_str;
	}	
}
}



if ( ! function_exists('date_format_db')){
function date_format_db($date)
{
	if($date=="0000-00-00"||empty($date)|| $date=="00/00/0000")
	{
		return "Unedited";
	}	
	else
	{
		$date_arr=explode("-",$date);
		$date_str=$date_arr[2]."-".$date_arr[1]."-".$date_arr[0];
		return $date_str;
	}	
}
}