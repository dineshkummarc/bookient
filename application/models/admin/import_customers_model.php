<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class import_customers_model extends CI_Model
{

	//Johannes wants some phpclasses.org class to be used.
	function csv_to_array($filename='', $delimiter=',')
	{
		if(!file_exists($filename) || !is_readable($filename))
		{
			return FALSE;
		}
		
		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) === FALSE)
		{
			return FALSE;
		}
		
		$header = fgetcsv($handle, 4096, $delimiter);
		while (($row = fgetcsv($handle, 4096, $delimiter)) !== FALSE)
		{
			$data[] = array_combine($header, $row);
			}
			fclose($handle);
		return $data;
	}
}
?>
