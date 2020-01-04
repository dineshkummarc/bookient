<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class MY_Sorting
	{				
		var $ERROR = "";		
		function clear_error()
		{
			$this->ERROR = "";
		}
			
		function Sorting($DefaultOrderName,$SortingArr,$do_order="",$OrderByID=0,$OrderType="ASC")
		{	
			$OrderTypePreserve = '';
			if(!empty($OrderByID))
			{						
				$OrderType=$OrderType=="ASC"?"DESC":"ASC";								 
				$OrderByName=$SortingArr[$OrderByID];						
				$OrderBySql ="$OrderByName";
				
				$OrderTypePreserve=$OrderType=="ASC"?"DESC":"ASC";
				$OrderLink="/OrderByID/$OrderByID/OrderType/$OrderTypePreserve";
			}
			else
			{
				$OrderBySql ="$DefaultOrderName";
				$OrderType=$OrderType=="ASC"?"DESC":"ASC";
				$OrderLink="/OrderByID/$OrderByID/OrderType/$OrderTypePreserve";
			}							
			
			$DisplaySortingImage=array();
			foreach($SortingArr as $key =>$val)
			{
				$SortingImage="";				
				if($OrderByID==$key)
				{											
					if($OrderType=="ASC") 
						$SortingImage="<img src='".base_url()."myjs/images/order_down.gif' border='0' align='absmiddle'>";
					else if($OrderType=="DESC")
						$SortingImage="<img src='".base_url()."myjs/images/order_up.gif' border='0' align='absmiddle'>";
				}									
				$DisplaySortingImage[$key]=$SortingImage;				
			}	
			
			$return_arr['OrderBy']=$OrderBySql;
			$return_arr['OrderLink']=$OrderLink;
			$return_arr['OrderType']=$OrderType;
			$return_arr['DisplaySortingImage']=$DisplaySortingImage;		
			
			return $return_arr;							
		}				
				
	}	
