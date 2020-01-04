<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dependency_model extends CI_Model{

	function nonDependenctService(){
		$local_admin_id = $this->session->userdata('local_admin_id'); 
		$service="";
		$categorySql="SELECT 
								* 
						FROM 
								app_service_category 
						WHERE 
								local_admin_id='".$local_admin_id."' 
								AND 
								is_active = 'Y'";		
		$category=$this->db->query($categorySql);
		if($category->num_rows() > 0){
			foreach ($category->result() as $row1){
				$category_id=$row1->category_id;
				$aSql = "SELECT 
								* 
							FROM 
								app_service 
							WHERE 
								category_id='".$category_id."' 
								AND 
								local_admin_id='".$local_admin_id."' 
								AND 
								is_active = 'Y'";
				$a=$this->db->query($aSql);
				if($a->num_rows() > 0){	
					$service.="<strong>".$row1->category_name."<br/></strong>";
					foreach ($a->result() as $row){
					$service_name=$row->service_name;
					$service_id=$row->service_id;
					$service.='<input type="radio" style="margin-left:10px" id="nonDependenctService_'.$service_id.'"  onclick="dependentSer(this.value)" class="all_services_on" name="nonDependenctService" value='.$service_id.'> '.$this->global_mod->show_to_control($service_name).'<br>'; 
					}
				}
			}	
		}
						
		return $service;
	}
	 
	function service(){
		$local_admin_id = $this->session->userdata('local_admin_id'); 
		$service="";		
		$categorySql = "SELECT 
								* 
							FROM 
								app_service_category 
							WHERE 
								local_admin_id='".$local_admin_id."' 
								AND 
								is_active = 'Y' ";
		$category=$this->db->query($categorySql);
		if($category->num_rows() > 0){
							 
		foreach ($category->result() as $row1){
			$category_id=$row1->category_id;
			$aSql = "SELECT 
							* 
						FROM 
							app_service 
						WHERE 
							category_id='".$category_id."' 
							AND 
							is_active = 'Y'";
			$a=$this->db->query($aSql);
			if($a->num_rows() > 0){	
					$service.="<strong>".$this->global_mod->show_to_control($row1->category_name)."<br/></strong>";
			foreach ($a->result() as $row){
				  $service_name=$row->service_name;
				  $service_id=$row->service_id;
				  $service.='<input type="checkbox" class="all_services" style="margin-left:10px" id="'.$service_id.'" name="dependency_value" onclick="dependentOnSer(this)"    value='.$service_id.'> '.$this->global_mod->show_to_control($service_name).'<br>';
							  
				}
				}
			}
		}
						
		return $service;
						

	}
	
	function returnAjax($non_dependent_service_id){  
			$local_admin_id = $this->session->userdata('local_admin_id');
			$disabledServices="";
			$querySql = "SELECT 
								* 
							FROM 
									app_dependency 
							WHERE 
									non_dependent_service_id='".$non_dependent_service_id."'  
									AND 
									local_admin_id='".$local_admin_id."' ";	
			$query=$this->db->query($querySql);
								 
			foreach ($query->result() as $row){
				$disabledServices.=$row->dependent_service_id.",";
				}	
			$query1Sql = "SELECT 
								 non_dependent_service_id  
							FROM 
									app_dependency  
							WHERE 
									dependent_service_id`='".$non_dependent_service_id."' 
									AND 
									local_admin_id='".$local_admin_id."' "	;
			$query1=$this->db->query($query1Sql);
								 
			foreach ($query1->result() as $row1){
				  
				  $disabledServices.=$row1->non_dependent_service_id.",";
				}	
			
			return $disabledServices;			
			
	}
        
	function select_from_db(){
		$local_admin_id = $this->session->userdata('local_admin_id');

      	$sql1=$this->db->query("
		select 	service.service_name as service_name_depend,depend.dependency_id ,service_non.service_name as service_name_nondepend 
		from 	app_service service, app_service service_non, app_dependency depend
		Where   service.service_id = depend.dependent_service_id AND 
				service_non.service_id = depend.non_dependent_service_id AND
				depend.local_admin_id='".$local_admin_id."'
				Order by service.service_name 
			");
 			
		$list='';
		$temp="";
		$list.="<table  width='100%'>";
		
		if ($sql1->num_rows() > 0){
			foreach ($sql1->result() as $row){
				if($temp != $row->service_name_depend){
					$list.="<tr><td colspan='3'><ul> <li style=' list-style:disc;'><font style='font-size:16px; text-transform:uppercase'>".$row->service_name_depend."</font><font color='#999999'>".$this->lang->line('depends_on_sml')." </font></li></ul></td></tr>";
					$temp=$row->service_name_depend;
				}
				$list.="<tr>";
				$list.="<td style='padding:0 0 10px 5px; width='10%'></td>";
				$list.="<td style='border-bottom:1px dotted #CCCCCC; width='80%'>".$row->service_name_nondepend."</td>";
				$list.="<td style='border-bottom:1px dotted #CCCCCC;' width='10%'><a href='javascript:void(0);' onclick='deleteDependency(".$row->dependency_id.")'><img src='".base_url()."/images/trash.png'  height='20px' width='20px' alt='delete'/></a></td>";
				$list.="</tr> "; 
			}
			$list.="</table>";
		}else{
			$list='';
		}
		
		return $list;
	}	
	
	function select_custom_from_db()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$sql = 'SELECT `app_booking_extra_field`.`field_id`, `app_booking_extra_field`.`field_name`,
			`app_booking_extra_field_option`.`option_id`, `app_booking_extra_field_option`.`value`,
			`app_dependency_custom`.`message`
			FROM `app_booking_extra_field`
			LEFT JOIN `app_booking_extra_field_option` ON `app_booking_extra_field_option`.`field_id` = `app_booking_extra_field`.`field_id`
			LEFT JOIN `app_dependency_custom` ON `app_booking_extra_field_option`.`option_id` = `app_dependency_custom`.`option_id`
			WHERE `app_booking_extra_field`.`local_admin_id` = ' . $local_admin_id;
		$result = $this -> db -> query($sql);
		
		ob_start();
		echo '<table width="100%">';
		foreach($result -> result() as $row)
		{
			echo '<tr style="border-bottom: 1px dotted #CCCCCC;"><th style="width: 25%">' , $row -> field_name , ': ' , $row -> value , '</th>' , 
				'<td><input type="text" name="option_field_message_' , $row -> option_id , '" value="' , $row -> message , '"></td></tr>';
		}
		echo '</table>';
		
		$result = utf8_decode(ob_get_contents());
		ob_end_clean();
		return $result;
	}
 			
	function selectMultipleServicesBooking(){
		
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->trans_begin();
		$this->db->select('multiple_services_booking');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id',$local_admin_id);
		$query = $this->db->get();
		$row = $query->row();	
		$return =$row->multiple_services_booking;
		return $return ;
		
		
	}
	
	function insert_to_db($value_dependent,$value_dependentOn){
		 
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$value_dependentOn_arr=explode(",",$value_dependentOn);
		$arr_lenght = count($value_dependentOn_arr);
		for ($i=0; $i<=$arr_lenght-2; $i++){
			$data = array(
				'local_admin_id'                  => $local_admin_id,
				'non_dependent_service_id'        => $value_dependentOn_arr[$i],
				'dependent_service_id'            => $value_dependent,
				'date_added'                      => date("Y/m/d"),
				'date_edited'                     => date("Y/m/d")
			);
			
			$this->db->trans_begin();
			$this->db->where('local_admin_id',$local_admin_id);
			$this->db->insert('app_dependency', $data); 
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			} 

		}		
        return $this->lang->line('update_success'); 
		
	}
	
	function get_local_admin_field_ids()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$sql = 'SELECT `app_booking_extra_field`.`field_id`, `app_booking_extra_field_option`.`option_id`
			FROM `app_booking_extra_field`
			LEFT JOIN `app_booking_extra_field_option` ON `app_booking_extra_field_option`.`field_id` = `app_booking_extra_field`.`field_id`
			WHERE `app_booking_extra_field`.`local_admin_id` = ' . $local_admin_id;
		$result = $this -> db -> query($sql);
		$ids = array();
		foreach($result -> result() as $row)
		{
			$ids[] = $row -> option_id;
		}
		return $ids;
	}
	
	function insert_custom_to_db($values)
	{
ob_start(); var_dump($values); $f = fopen('/tmp/debug.values', 'a'); fputs($f, ob_get_contents()); fclose($f); ob_end_clean();
		$local_admin_id = $this->session->userdata('local_admin_id');
		foreach ($values as $id => $value)
		{
			$data = array(
				'option_id'		=> $id,
				'message'		=> $value,
			);
ob_start(); var_dump($data); $f = fopen('/tmp/debug.values', 'a'); fputs($f, ob_get_contents()); fclose($f); ob_end_clean();
			
			$this->db->trans_begin();
			$sql = 'INSERT INTO `app_dependency_custom` (`option_id`, `message`)
				VALUES (?, ?)
				ON DUPLICATE KEY UPDATE 
					`option_id`=VALUES(`option_id`), 
					`message`=VALUES(`message`)';
			
			$query = $this->db->query($sql, array($id, $value));
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			} 

		}
		return $this->lang->line('update_success');
	}
		
	function deleteDependency($del_id){
      
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->where('dependency_id', $del_id);
        $this->db->delete('app_dependency'); 
        return $this->lang->line('update_success'); 
		
	}
	
	function multipleServicesBooking($displayOption){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
			'multiple_services_booking'   => $displayOption
		);
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_local_admin_gen_setting', $data); 
		return $displayOption;	
	}

	function countStaff(){
		$local_admin_id = $this->session->userdata('local_admin_id'); 
		$sql = "SELECT count(DISTINCT  employee_id) AS counter
             FROM
                app_biz_hours
             WHERE local_admin_id = ".$local_admin_id;
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        $noOfstaff = $Arr[0]['counter'];
        return $noOfstaff;
	}

}
?>
