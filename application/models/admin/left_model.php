<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class left_model extends CI_Model{
	
	
	function select_from_db()
	{
		$this->load->database();
		$this->load->helper('url');
		
		$sql=$this->db->query("SELECT admin_menu_id,menu_name,page_link FROM app_admin_menu WHERE status = '1' AND parent = '0' ORDER BY `order`");
		
		$menu='<div id="menu"><ul class="menu">';
								 
		foreach ($sql->result() as $row)
		{
			$ParentId=$row->admin_menu_id;
			$ParentpageLink=$row->page_link;
			$sub_menu=$this->db->query("SELECT * FROM app_admin_menu WHERE status = '1' AND parent = '$ParentId' ORDER BY `order"); 
			$NumRows =  $sub_menu->num_rows();
			if($NumRows > 0)
			{
				$menu.='<li><a href="" class="parent"><span>'.$row->menu_name.'</span></a>';
				$menu.='<div class="columns two">
				<ul class="one">';
				foreach ($sub_menu->result() as $row1)
				{
				$menu.='<li><a href="'.base_url().'admin/'.$row1->page_link.'"><span>'.$row1->menu_name.'</span></a></li>';
				
				}
			    $menu.='</ul></div></li>';
			}
			else
			{
				$menu.='<li><a href="'.base_url().'admin/'.$ParentpageLink.'" class="parent"><span>'.$row->menu_name.'</span></a>';
				$menu.='</li>';
			}
			
		}
		$menu.='</ul></div>';
		return $menu;
	}
	
	function employee()
	{
		
		$employee="";		
		$this->load->database();
		$a=$this->db->query("SELECT * from app_employee where is_active='Y'");
		foreach ($a->result() as $row)
		{
			$employee_name=$row->employee_name;
			$employee_id=$row->employee_id;
			$employee.='<li><span><input type="checkbox" name="emp[]" id="emp_'.$employee_id.'" value='.$employee_id.' 
			onclick=javascript:getCalenderview();></span><a href="#">'.$employee_name.'</a></li>';
		}
		return $employee;
	}	
	
	function service()
	{
		
		$service="";		
		$this->load->database();
		$a=$this->db->query("SELECT * from app_service");
		foreach ($a->result() as $row)
		{
			$service_name=$row->service_name;
			$service_id=$row->service_id;
			$service.='<li><span><input type="checkbox" onclick=javascript:getCalenderview(); name="services[]" value='.$service_id.'> </span><a href="#">'.$service_name.'</a></li>';
		}
		return $service;
		
		
	}
		
	
	
}
?>