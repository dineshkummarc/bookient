<?php
class Business_hour_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	public function get_staff()
	{//	GET THE LIST OF EXISTING STAFF FROM DATABASE
	
		$this->db->select('employee_name, employee_id');
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
		$this->db->where('employee_id',$this->session->userdata('user_id_staff'));
		$this->db->order_by("employee_name", "desc"); 
		$query = $this->db->get('employee');
		return $query->result_array();
	}

	public function get_service()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('service_category.category_name,service.service_name,service.service_id');
		$this->db->from('service');
		$this->db->join('service_category', 'service_category.category_id = service.category_id');
		$this->db->where('service.local_admin_id',$local_admin_id);
		$this->db->order_by("service_category.category_name", "asc"); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_category()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('category_name,category_id');
		$this->db->where('local_admin_id',$local_admin_id);
		$query = $this->db->get('service_category');
		return $query->result_array();
	}

	public function get_serv($id)
	{
		$this->db->select('service_name,service_id');
		$this->db->where('category_id', $id);
		$query = $this->db->get('service');
		return $query->result_array();
	}
	
	public function biz_hour_add($jsondata)
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$arrayFormation = json_decode($jsondata, true);
		
		//echo '<pre>';print_r($arrayFormation);exit;
		
		$ServiceIdsArray = $arrayFormation['service'];
		$staffId   			=$this->session->userdata('user_id_staff');
		$daysIdsArray    = $arrayFormation['days'];
		$timeFrom    	 = $arrayFormation['timeFrom'][0];
		$timeTo      	 = $arrayFormation['timeTo'][0];
		$this->load->database();
		$this->db->trans_begin();
		foreach($ServiceIdsArray as $serviceId)
		{
			//foreach($staffIdsArray as $staffId)
			//{
				foreach($daysIdsArray as $daysId)
				{
				    //echo '<pre>';print($daysId);exit;
					$this->db->select('biz_hours_id');
					$this->db->from('app_biz_hours');
					$this->db->where('service_id', $serviceId);
					$this->db->where('employee_id', $staffId);
					$this->db->where('local_admin_id',$local_admin_id);
					$this->db->where('day_id',$daysId);
					$query = $this->db->get();
					$NumRowsEmpBizHr =  $query->num_rows(); 
					
					//echo '<pre>';print($NumRowsEmpBizHr);exit;
					
					if($NumRowsEmpBizHr > 0)
					{
						$data = array(
						'time_from' 	 => $timeFrom,
						'time_to'		 => $timeTo,
						'date_edited' 	 => date('Y-m-d')
						);
						$this->db->where('service_id', $serviceId);
						$this->db->where('employee_id', $staffId);
						$this->db->where('day_id', $daysId);
						$this->db->where('local_admin_id',$local_admin_id);
						$this->db->update('app_biz_hours',$this->db->escape($data));
					}
					else
					{
						$data = array(
						'service_id' 	 => $serviceId,
						'local_admin_id' => $local_admin_id,
						'employee_id' 	 => $staffId,
						'day_id' 		 => $daysId,
						'time_from' 	 => $timeFrom,
						'time_to'		 => $timeTo,
						'date_added' 	 => date('Y-m-d'),
						'date_edited' 	 => date('Y-m-d')
						);
						
						$this->db->insert('app_biz_hours',$this->db->escape($data));
						//echo'<pre>';print_r($data);exit;
					}
				}
			//}
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			return true;
		} 
	}
	
	public function EmployeeNameFetch($employee_id)
	{
		$this->db->select('employee_name');
		$this->db->from('app_employee');
		$this->db->where('employee_id', $this->session->userdata('user_id_staff'));
		$query = $this->db->get();
		$EmployeeNmArr =  $query->result_array();
		return $EmployeeName = $EmployeeNmArr[0]['employee_name'];
	}
	
	public function ServiceNameFetch($service_id)
	{
		$this->db->select('service_name');
		$this->db->from('app_service');
		$this->db->where('service_id', $service_id);
		$query = $this->db->get();
		
		$ServiceIdNameArr = $query->result_array();
		return $service_name =  $ServiceIdNameArr[0]['service_name'];
	}
	
	public function Employee_biz_hour_details($employee_id)
	{
		
		//echo $employee_id;exit;
		//$employee_id= $this->session->userdata('user_id_staff');
		$StringHtml = "";
		$StringHtml .='<table align="center" width="100%">';
		$EmpName = $this->EmployeeNameFetch($employee_id);
		$StringHtml .='<tr><th colspan="8" align="center" style="background:#55779A; color:#ffffff">Business hour Details of '.$EmpName.' </th></tr>';
		$this->db->select('service_id');
		$this->db->distinct('service_id');
		$this->db->from('app_biz_hours');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
		$query = $this->db->get();
		$NumRows =  $query->num_rows(); 
		if($NumRows > 0)
		{
			$StringHtml .='<tr>
							<th>SERVICE NAME</th>
							<th><strong>Monday</strong></th>
							<th><strong>Tuesday</strong></th>
							<th><strong>Wednesday</strong></th>
							<th><strong>Thursday</strong></th>
							<th><strong>Friday</strong></th>
							<th><strong>Saturday</strong></th>
							<th><strong>Sunday</strong></td>
							</tr>';
			$ServiceIdsArray = $query->result_array();
			
			
			foreach($ServiceIdsArray as $serviceId)
			{
				$IndiServiceId = $serviceId['service_id'];
				$service_name = $this->ServiceNameFetch($IndiServiceId);
				$this->db->select('*');
				$this->db->from('app_biz_hours');
				$this->db->where('employee_id', $employee_id);
				$this->db->where('service_id', $IndiServiceId);
				$this->db->order_by("day_id"); 
				$query2 = $this->db->get();
				$ServiceTimeArr = $query2->result_array();
				//echo'<pre>';print_r($ServiceTimeArr);exit;
				
				
				$CurDayId =1;
				$ArrayCounter = 0;
				$StringHtml .='<tr>';
				$StringHtml .= '<td class="del">'.$service_name.'<a style=" display:none"  class="del-icon" href="#" onclick="DeleteServiceRow('.$employee_id.','.$serviceId["service_id"].');"><img src="'.base_url().'images/trash.gif"></a></td>';
				for($i=1; $i<=7; $i++)
				{
					if(isset($ServiceTimeArr[$ArrayCounter]) && count($ServiceTimeArr[$ArrayCounter]) )
					{
					    $ServiceTimeDet = $ServiceTimeArr[$ArrayCounter];
					    $dayId = $ServiceTimeDet['day_id'];
						$oriday_id ;
						foreach($ServiceTimeArr as $val) {
						}
						
						if($dayId == $CurDayId) //<---
						//if(isset($dayId))
						{
						   $StringHtml .= '<td class="del"> FROM: '.$ServiceTimeDet['time_from'].' <br />TO: '.$ServiceTimeDet['time_to'].'<a style=" display:none"  class="del-icon" href="javascript:void(0)" onclick="DeleteSchedule('.$employee_id.','.$ServiceTimeDet["biz_hours_id"].');"><img src="'.base_url().'images/trash.gif" ></a></td>';
						   $ArrayCounter++;
						  // <img src="'.base_url().'images/trash-delete.gif">
						}
						else
						{
							$StringHtml .= '<td>&nbsp;</td>';
						}
					}
					else{
						$StringHtml .= '<td>&nbsp;</td>';	
					}
					
					
					
					$CurDayId++;;
				}
				$StringHtml .='</tr>';
			}
		}
		else
		{
			$StringHtml .= "<tr><td align='center' colspan='8'>No Data found!</td></tr>";
		}
		$StringHtml .='</table>';
		//echo'<pre>';print($StringHtml);exit;
		return $StringHtml;
	}
	
	public function DeleteBizHours()
	{
		
		$this->db->where('biz_hours_id', $this->input->post('id'));
		$this->db->delete('app_biz_hours'); 
		
		$TableString = $this->Employee_biz_hour_details($this->input->post('emp_id'));
		
		echo $TableString;
	}
	
	public function DeleteEmpService()
	{
		$this->db->where('service_id', $this->input->post('service_id'));
		$this->db->where('employee_id', $this->input->post('emp_id'));
		$this->db->delete('app_biz_hours'); 
		
		$TableString = $this->Employee_biz_hour_details($this->input->post('emp_id'));
		
		echo $TableString;
	}
	
	
}
?>























