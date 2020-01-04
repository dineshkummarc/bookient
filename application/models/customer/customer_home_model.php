<?php
class Customer_Home_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function CustomerLogIn()
	{
		$err = 0;
		
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $this->input->post('user_name'));
		$this->db->where('password', $this->input->post('password'));
		$this->db->where('user_type', 2);
		$query = $this->db->get();
		$UserAuthArr = $query->result_array();
		
		if(count($UserAuthArr) > 0)
		{
			$this->db->select('email_veri_status,user_id');
			$this->db->from('app_password_manager');
			$this->db->where('user_id', $UserAuthArr[0]['user_id']);
			$query = $this->db->get();
			$UserEmailVerArr = $query->result_array();
			
			if($UserEmailVerArr[0]['email_veri_status'] == 1)
			{
				$query ="select user_name,user_id,user_type from app_password_manager where user_type=3 and user_id=(select emp.local_admin_id from app_employee as emp,app_password_manager as pass where emp.employee_id=pass.user_id and pass.user_id=".$UserEmailVerArr[0]['user_id'].")";
				$sql = mysql_query($query);
				$EmpArr = mysql_fetch_array($sql);

				$url = $_SERVER['HTTP_HOST'];
				$url_arr = explode(".",$url);
				
				if($url_arr[0] == $EmpArr['user_name'])
				{
					$set_user_data = array(
						'user_name_customer'   => $EmpArr['user_name'],
						'user_id_customer'     => $EmpArr['user_id'],
						'user_type_customer'   => $EmpArr['user_type'],
						'logged_in_customer'   => TRUE
					); 
					//print_r($set_user_data);
					$this->session->set_userdata($set_user_data);   
					$err = 0;
				}
				else
				{
					$err = 3;
				}
			}
			else
			{
				$err = 2;
			}
		}
		else
		{
			$err = 1;	
		}
		
		return $err;
	}
	
	public function StaffSaveData($img_name,$img_store)
	{
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);
		$local_admin_name = $url_arr[0];
		
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $local_admin_name);
		$query = $this->db->get();
		$LocalAdminArr = $query->result_array();
		

		$this->db->trans_begin();
		
		$data = array(
						'password' 		=> $this->input->post('password'),
						'user_email'	=> $this->input->post('user_email'),
						'date_modified'	=> date('Y-m-d')
				);
		$data = $this->global_mod->db_parse($data);	
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update('app_password_manager',$this->db->escape($data));
		$this->db->last_query();
		
		if($img_name != '')
		{
			$this->db->select('employee_image');
			$this->db->from('app_employee');
			$this->db->where('employee_id', $this->input->post('user_id'));
			$query = $this->db->get();
			$ImageArr = $query->result_array();
			
			$filename = 'uploads/staff/'.$ImageArr[0]['employee_image'];
			
			if (file_exists($filename)) {
				@unlink($filename);
			}
			
			$data = array(
							'local_admin_id' 			=> $LocalAdminArr[0]['user_id'],
							'employee_image'			=> $img_name,
							'employee_image_original'	=> $img_store,
							'employee_name'				=> trim($this->input->post('employee_name')),
							'employee_mobile_no' 		=> trim($this->input->post('employee_mobile_no')),
							'employee_languages'		=> trim($this->input->post('employee_languages')),
							'employee_description'		=> trim($this->input->post('employee_description')),
							'employee_education'		=> trim($this->input->post('employee_education')),
							'employee_membership'		=> trim($this->input->post('employee_membership')),
							'employee_awards'			=> trim($this->input->post('employee_awards')),
							'employee_publications'		=> trim($this->input->post('employee_publications')),
							'date_edited'				=> date('Y-m-d')
					);
		}
		else
		{
			$data = array(
							'local_admin_id' 			=> $LocalAdminArr[0]['user_id'],
							'employee_name'				=> trim($this->input->post('employee_name')),
							'employee_mobile_no' 		=> trim($this->input->post('employee_mobile_no')),
							'employee_languages'		=> trim($this->input->post('employee_languages')),
							'employee_description'		=> trim($this->input->post('employee_description')),
							'employee_education'		=> trim($this->input->post('employee_education')),
							'employee_membership'		=> trim($this->input->post('employee_membership')),
							'employee_awards'			=> trim($this->input->post('employee_awards')),
							'employee_publications'		=> trim($this->input->post('employee_publications')),
							'date_edited'				=> date('Y-m-d')
					);
		}
		
		$this->db->where('employee_id', $this->input->post('user_id'));
		$this->db->update('app_employee',$this->db->escape($data));
		$this->db->last_query();
		
		if ($this->db->trans_status() === FALSE)
		{
			$flag = 0;
			$this->db->trans_rollback();
		}
		else
		{
			$flag = 1;
			$this->db->trans_commit();
		}
		if($flag == 1)
			return $img_name;
		else
			return 0;
	}
	
	public function StaffDetails()
	{
		$this->db->select('app_employee.*,app_password_manager.user_name,app_password_manager.user_email,app_password_manager.password');
		$this->db->from('app_employee');
		$this->db->join('app_password_manager', 'app_employee.employee_id = app_password_manager.user_id AND app_password_manager.user_id ='.$this->session->userdata('user_id_staff'));
		$query = $this->db->get();
		
		$LocalAdminArr = $query->result_array();
		return $LocalAdminArr;
	}
	
	public function WorkSchedule()
	{
		$store_arr = array();
		
		$this->db->select('service_name,app_service.service_id');
		$this->db->from('app_service');
		$this->db->join('app_biz_hours', 'app_biz_hours.service_id = app_service.service_id AND app_biz_hours.employee_id ='.$this->session->userdata('user_id_staff'));
		$this->db->where('app_service.is_active = "Y"');
		$this->db->group_by("service_id");
		$query = $this->db->get();
		
		$ServiceArr = $query->result_array();
		
		$Num = count($ServiceArr);
		
		for($i=0;$i < $Num;$i++)
		{
			$store_arr[$i]['name'] = $ServiceArr[$i]['service_name'];
		}
		
		for($i=0;$i < $Num;$i++)
		{
			$this->db->select('*');
			$this->db->from('app_biz_hours');
			$this->db->where('service_id = '.$ServiceArr[$i]["service_id"]);
			$this->db->where('employee_id = '.$this->session->userdata('user_id_staff'));
			$query = $this->db->get();
			
			$BizHourArr = $query->result_array();
			
			$store_arr[$i]['details'] = $BizHourArr;
		}
		
		return $store_arr;
	}
	
	public function BizDelete()
	{
		$this->db->where('biz_hours_id', $this->input->post('id'));
		$this->db->delete('app_biz_hours'); 
	}
	
	public function ServiceDetails()
	{
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);
		$local_admin_name = $url_arr[0];
		
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $local_admin_name);
		$query = $this->db->get();
		$LocalAdminArr = $query->result_array();
		
		$this->db->select('service_id,service_name');
		$this->db->from('app_service');
		$this->db->where('is_active = "Y"');
		$this->db->where('local_admin_id = '.$LocalAdminArr[0]['user_id']);
		$query = $this->db->get();
		
		$ServicesArr = $query->result_array();
		return $ServicesArr;
	}
	
	public function UpdateServices()
	{
		$srvc_arr = array();
		$err=0;
		
		$this->db->select('service_id');
		$this->db->from('app_biz_hours');
		$this->db->where('employee_id = '.$this->session->userdata('user_id_staff'));
		$this->db->group_by("service_id");
		$query = $this->db->get();
		$ServiceArr = $query->result_array();
		for($i=0; $i < count($ServiceArr); $i++)
		{
			$srvc_arr[$i] = $ServiceArr[$i]['service_id'];
		}
		
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);
		$local_admin_name = $url_arr[0];
		
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_name', $local_admin_name);
		$query = $this->db->get();
		$LocalAdminArr = $query->result_array();
		$rows = count($_REQUEST['day'])-1;
		
		if(in_array($_REQUEST['service'],$srvc_arr))
		{
			$this->db->where('service_id', $_REQUEST['service']);
			$this->db->where('local_admin_id', $LocalAdminArr[0]['user_id']);
			$this->db->where('employee_id', $this->session->userdata('user_id_staff'));
			$this->db->delete('app_biz_hours'); 
			
			for($i=0; $i < $rows; $i++)
			{
				$data = array(
								'service_id'		=> $_REQUEST['service'],
								'local_admin_id'	=> $LocalAdminArr[0]['user_id'],
								'employee_id'		=> $this->session->userdata('user_id_staff'),
								'day_id'			=> $_REQUEST['day'][$i],
								'time_from'			=> $_REQUEST['time_from'],
								'time_to'			=> $_REQUEST['time_to']
						);
				$this->db->trans_begin();
				$this->db->insert('app_biz_hours',$this->db->escape($data));
				$this->db->last_query();
				
				if ($this->db->trans_status() === FALSE)
				{
					$err++;
					$this->db->trans_rollback();
				}
				else
				{
					$this->db->trans_commit();
				}
			}
		}
		else
		{
			for($i=0; $i < $rows; $i++)
			{
				$data = array(
								'service_id'		=> $_REQUEST['service'],
								'local_admin_id'	=> $LocalAdminArr[0]['user_id'],
								'employee_id'		=> $this->session->userdata('user_id_staff'),
								'day_id'			=> $_REQUEST['day'][$i],
								'time_from'			=> $_REQUEST['time_from'],
								'time_to'			=> $_REQUEST['time_to']
						);
				$this->db->trans_begin();
				$this->db->insert('app_biz_hours',$this->db->escape($data));
				$this->db->last_query();
				
				if ($this->db->trans_status() === FALSE)
				{
					$err++;
					$this->db->trans_rollback();
				}
				else
				{
					$this->db->trans_commit();
				}
			}
			
		}
		
		if($err == 0)
			echo 1;
		else
			echo 0;
		/*$WorkScheduleArr = $this->staff_home_model->WorkSchedule();
		
		$html = '';
		$html .= 
		'<tr>
			<th align="center">&nbsp;</th>
			<th align="center">Sunday</th>
			<th align="center">Monday</th>
			<th align="center">Tuesday</th>
			<th align="center">Wednesday</th>
			<th align="center">Thursday</th>
			<th align="center">Friday</th>
			<th align="center">Saturday</th>
		</tr>';
		foreach($WorkScheduleArr as $key=>$val) 
		{
			$html .= '<tr><td>'.$val['name'].'</td>';
			for($i=0; $i <= 6; $i++) 
			{ 
				$biz_hours_id = $val['details'][$i]['biz_hours_id'];
				$time_from = $val['details'][$i]['time_from'];
				$time_to = $val['details'][$i]['time_to'];
				$html .= '<td id="id_'.$biz_hours_id.'" onmouseout="change_back('.$biz_hours_id.');" ><span onmouseover="change_label('.$biz_hours_id.');">from '.$time_from.'<br />to '.$time_to.'</span></td>
					<input type="hidden" id="input_'.biz_hours_id.'" value="from '.$time_from.'<br />to '.$time_to.'">';
			}
			$html .= '</tr>';
		}*/
		
		//echo $html;
	}
	
	public function GetStaffServiceDetils()
	{
		$srv = array();
		$this->db->select('day_id');
		$this->db->from('app_biz_hours');
		$this->db->where('service_id = '.$this->input->post('id'));
		$this->db->where('employee_id = '.$this->session->userdata('user_id_staff'));
		$query = $this->db->get();
		$ServicesArr = $query->result_array();
		for($i=1; $i <= count($ServicesArr); $i++)
		{
			$j = $i-1;
			$srv[$i] = $ServicesArr[$j]['day_id'];
		}
		
		$html = '';
		$html .='Sun<input type="checkbox" name="day[]" id="day[]" value="1" ';
		if(in_array(1,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Mon<input type="checkbox" name="day[]" id="day[]" value="2" ';
		if(in_array(2,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Tue<input type="checkbox" name="day[]" id="day[]" value="3" ';
		if(in_array(3,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Wed<input type="checkbox" name="day[]" id="day[]" value="4" ';
		if(in_array(4,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Thu<input type="checkbox" name="day[]" id="day[]" value="5" ';
		if(in_array(5,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Fri<input type="checkbox" name="day[]" id="day[]" value="6" ';
		if(in_array(6,$srv))
			$html .= 'checked="checked"';
		$html .= '/> Sat<input type="checkbox" name="day[]" id="day[]" value="7" ';
		if(in_array(6,$srv))
			$html .= 'checked="checked"';
		$html .= '/><span id="check_err"></span>';

		echo $html;
	}
}
?>