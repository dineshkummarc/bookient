<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_appointments_model extends CI_Model
{
	
	function upcomingAppointments()
	{
	$customer_id=$this->session->userdata('user_id_customer');	
	$local_admin_id = $this->session->userdata('local_admin_id');
	$today = date("Y-m-d");
	$sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									bs.booking_service_id,
									bs.booking_status,
									emp.employee_name,
									b.booking_id 
							FROM 	app_booking_service_details bs,
									app_booking b,
									app_employee emp
							WHERE 	bs.srvDtls_service_start > '".$today."' AND
									bs.employee_id =emp.employee_id AND
									b.customer_id ='".$customer_id."' AND
									b.booking_id =bs.booking_id AND
									b.local_admin_id='".$local_admin_id."'
							");
					
		$html='<table width="100%" border="0" cellspacing="1" cellpadding="0">
		<tr class="silver">
		<th>Date</th>
		<th> Staff </th>
		<th> Service </th>
		<th>Amount Paid </th>
		<th>Booking Status </th>
		<th>Cancel </th>
		</tr>
		';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
	
					$html.='<tr>
								<td>'.$row->service_start_dt.'</td>
								<td>'.$row->employee_name.'</td>
								<td>'.$row->service_name.'</td>
								<td>'.$row->service_cost.'</td>';
								if($row->booking_status ==1)
								{
									$html.='<td>Aproved</td>';
								}
								if($row->booking_status ==2)
								{
									$html.='<td>Pending</td>';
								}
								if($row->booking_status ==4)
								{
									$html.='<td>Cmpleted</td>';
								}
								if($row->booking_status ==0)
								{
									$html.='<td>Unapproved</td>';
								}
								if($row->booking_status ==4)
								{
									$html.='<td>Canceled By Admin</td>';
								}
								if($row->booking_status ==5)
								{
									$html.='<td>Cancelled By User</td>';
								}
								
								if($row->booking_status ==3 || $row->booking_status ==0 || $row->booking_status ==4 || $row->booking_status ==5 )
								{
									$html.='<td><span style="color:#F00">cancel<span></td>';
								}
								else
								{
									$html.='<td onclick="cancelAppointments('.$row->booking_service_id.')">cancel</td>';
								}
					$html.='</tr>';
			}				
		
		}
		else
		{
			$html.='<tr>
						<td colspan="4" align="center">No Upcoming Booking Available</td>
					</tr>';
		}
		$html.='</table>';
		return $html;
	
	}
	
	function pastAppointments()
	{
	$customer_id=$this->session->userdata('user_id_customer');	
	$local_admin_id = $this->session->userdata('local_admin_id');
	$today = date("Y-m-d");
	$sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									bs.booking_service_id,
									bs.booking_status,
									emp.employee_name,
									b.booking_id 
							FROM 	app_booking_service_details bs,
									app_booking b,
									app_employee emp
							WHERE 	bs.srvDtls_service_start < '".$today."' AND
									bs.employee_id =emp.employee_id AND
									b.customer_id ='".$customer_id."' AND
									b.booking_id =bs.booking_id AND
									b.local_admin_id='".$local_admin_id."'
							");
					
		$html='<table width="100%" border="0" cellspacing="1" cellpadding="0">
					<tr class="silver">
						<th>Date</th>
						<th> Staff </th>
						<th> Service </th>
						<th>Amount Paid </th>
						<th>Booking Status </th>
					</tr>';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
					$html.='<tr>
								<td>'.$row->service_start_dt.'</td>
								<td>'.$row->employee_name.'</td>
								<td>'.$row->service_name.'</td>
								<td>'.$row->service_cost.'</td>';
						  	
							
							if($row->booking_status ==1)
								{
									$html.='<td>Aproved</td>';
								}
								if($row->booking_status ==2)
								{
									$html.='<td>Pending</td>';
								}
								if($row->booking_status ==4)
								{
									$html.='<td>Cmpleted</td>';
								}
								if($row->booking_status ==0)
								{
									$html.='<td>Unapproved</td>';
								}
								if($row->booking_status ==4)
								{
									$html.='<td>Canceled By Admin</td>';
								}
								if($row->booking_status ==5)
								{
									$html.='<td>Cancelled By User</td>';
								}
								$html.='</tr>';
			}				
		}
		else
		{
			$html.='<tr>
						<td colspan="4" align="center">No Past Booking Available</td>
					</tr>';
		}
		$html.='</table>';
		return $html;
	}
	
	function cancelAppointments($booking_service_id)
	{
		$customer_id=$this->session->userdata('user_id_customer');	
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		'booking_status' => 5,
		);
		$this->db->trans_begin();
		$this->db->where('booking_service_id',$booking_service_id);
		$this->db->update('app_booking_service_details', $data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			
		} 
	}

}
?>


