<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Ranking
{
	var $up_img = "/myjs/images/arrow_up.gif";
	var $down_img = "/myjs/images/arrow_down.gif";

	function clear_error()
	{
		$this->ERROR = "";
	}
	function __construct(){
		//parent::__construct();
		global $CI;
    }

	// Function for prepare original array from database in key - value pair
	public function PrepareOriginalArray($tbl_name,$pkey_field,$order_field){
		global $CI;
		$query = $CI->db->get($tbl_name);
		$result = $query->result();
		$arr = array();
		foreach($result as $row){
			$arr[$row->$pkey_field] = $row->$order_field;
		}

		return $arr;
	}


	// Function for alter original array according to ordering
	function AlterOriginalArray($array,$order_value,$type='UP'){

		$prev_key = '';
		$prev_order = '';
		asort($array);
		foreach($array as $key=>$val){

			switch($type){
				case 'UP':
						if($val==$order_value){
							$array[$key] = $prev_order;
							$array[$prev_key] = $val;
						}else{
							$prev_key = $key;
							$prev_order = $val;
						}
				break;

				case 'DOWN':
						if($val==$order_value){
							$prev_key = $key;
							$prev_order = $val;
						}elseif($val==($order_value+1)){
							$array[$key] = $prev_order;
							$array[$prev_key] = $val;
						}
				break;
			}
		}

		return $array;
	}

	// Function for save ranking in database after re-order
	function saveRanking($array,$tablename,$pkey_field,$order_field){
		global $CI;
		foreach($array as $key=>$val){
			$data[$order_field] = $val;
			$CI->db->where($pkey_field, $key);
	 		$CI->db->update($tablename, $data);
		}
		return;
	}

	// Function for delete ranking from database and re-order other records
	function deleteRanking($array,$tablename,$pkey_field,$order_field,$pkey_value){
		global $CI;
		$CI->db->where($pkey_field, $pkey_value);
		$query =$CI->db->get($tablename);
		$result = $query->row_array();
		$order_value = $result[$order_field];

		foreach($array as $key=>$val){
			if($val > $order_value)
			{
				$data[$order_field] = $val-1;
				$CI->db->where($pkey_field, $key);
	 			$CI->db->update($tablename, $data);
			}
		}
		return;
	}

	// Function for display ranking with UP-DOWN arrow in manager
	function displayRankingImage($array,$order_value,$page){

		$output = '';
		//type = 1 for first element, 2 forlast element, 3 for other element..
		$total = count($array);

		if($total > 1)
		{
			if($order_value=='1'){
				$type = 1;
			}elseif($order_value==$total){
				$type = 2;
			}else{
				$type = 3;
			}

			switch($type){
				case 1:
						$link = '<a href="'.$page.'/type/DOWN/order/'.$order_value.'">';
						$output = $link.'<img border="0" src="'.$this->down_img.'" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				break;

				case 2:
						$link = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$page.'/type/UP/order/'.$order_value.'">';
						$output =  $link.'<img border="0" src="'.$this->up_img.'" /></a>';
				break;

				case 3:
						$link_up = '<a href="'.$page.'/type/UP/order/'.$order_value.'">';
						$link_down = '<a href="'.$page.'/type/DOWN/order/'.$order_value.'">';
						$output = $link_up.'<img border="0" src="'.$this->up_img.'" /></a> &nbsp; '.$link_down.'<img border="0" src="'.$this->down_img.'" /></a>';
				break;
			}
		}
		elseif($total == 1)
		{
			$output = "--";
		}

		return $output;
	}

         function Prepare_OriginalArray($tbl_name,$pkey_field,$order_field,$condition){
		global $CI;

                $CI->db->where($condition);
		$query = $CI->db->get($tbl_name);
		$result = $query->result();
		$arr = array();
		foreach($result as $row){
			$arr[$row->$pkey_field] = $row->$order_field;
		}

		return $arr;
	}

        /*public function PrepareOriginalArray($tbl_name,$pkey_field,$order_field,$condition){

        }*/




}
