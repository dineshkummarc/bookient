<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_appointments extends CI_Model
{
	
	function upcomingAppointments($customer_id)
	{
	$local_admin_id = $this->session->userdata('local_admin_id');
	$today = date("Y-m-d");
	$sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									emp.employee_name
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
								<td>'.$row->service_cost.'</td>
						  	</tr>';
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
	
	function pastAppointments($customer_id)
	{
	$local_admin_id = $this->session->userdata('local_admin_id');
	$today = date("Y-m-d");
	$sql1=$this->db->query("
							SELECT 	bs.service_start_dt,
									bs.service_name,
									bs.service_cost,
									emp.employee_name
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
					</tr>';
		
		if ($sql1->num_rows() > 0)
		{
			foreach ($sql1->result() as $row)
			{
					$html.='<tr>
								<td>'.$row->service_start_dt.'</td>
								<td>'.$row->employee_name.'</td>
								<td>'.$row->service_name.'</td>
								<td>'.$row->service_cost.'</td>
						  	</tr>';
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

}
?>


