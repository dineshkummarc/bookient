<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_overview_model extends CI_Model{
	
	function accountDetails()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$membership_name					='';
		$activation_date					='';
		$deactivation_date					='';
		$membership_amount					='';
		
		$query=$this->db->query("
			SELECT 	payment.membership_type_id,
					payment.activation_date,
					payment.deactivation_date,
					payment.payment_date,
					mem.membership_name,
					mem.membership_amount,
					mem.membership_validity,
					gen.membership_activation_dt
			FROM    app_membership_payment_history payment,
					app_membership_types mem,
					app_local_admin_gen_setting gen
			WHERE   payment.membership_type_id=mem.membership_type_id AND
			 		payment.local_admin_id=gen.local_admin_id AND
					payment.local_admin_id ='".$local_admin_id."'
					ORDER BY payment.membership_payment_history_id DESC LIMIT 0,1
		");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$membership_name					=$row->membership_name;
				$activation_date					=$row->activation_date;
				$deactivation_date					=$row->deactivation_date;
				$membership_amount					=$row->membership_amount;
				$payment_date						=$row->payment_date;
				$membership_validity				=$row->membership_validity;
				$membership_activation_dt			=$row->membership_activation_dt;
				 
			}
			$newDate = strtotime($activation_date .' + '.$membership_validity.' days');
			$next_billing =date('Y-m-d', $newDate);
			
			$list=Array(
					'membership_name' 					=> $membership_name,
					'activation_date'					=> $activation_date,
					'deactivation_date' 				=> $deactivation_date,
					'membership_amount' 				=> $membership_amount,
					'payment_date' 						=> $payment_date,
					'membership_validity' 				=> $membership_validity,
					'membership_activation_dt' 			=> $membership_activation_dt,
					'next_billing' 						=> $next_billing
			
			);
		
			return $list;
				
		}
		else
		{
			$list=Array(
					'membership_name' 					=> "Free",
					'activation_date'					=> "NO",
					'deactivation_date' 				=> "NO",
					'membership_amount' 				=> "NO",
					'payment_date' 						=> "NO",
					'membership_validity' 				=> "NO",
					'membership_activation_dt' 			=> "NO",
					'next_billing' 						=> "NO"
			
			);
			return $list;
		}
		
	}
	
	function showAllTransaction()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data='';
		$query=$this->db->query("
			SELECT 	payment.*,
					mem.membership_name,
					mem.membership_amount,
					mem.membership_validity
			FROM    app_membership_payment_history payment,
					app_membership_types mem
			WHERE   payment.membership_type_id=mem.membership_type_id AND
					payment.local_admin_id ='".$local_admin_id."'
					ORDER BY payment.membership_payment_history_id DESC
		");
		if ($query->num_rows() > 0)
		{
			$data.='<table style="width:100%;">';
			$data.='<tr>';
			$data.='<th align="center" >Membership Name</th>';
			$data.='<th align="center" >Amount Paid</th>';
			$data.='<th align="center" >Payment Date</th>';
			$data.='<th align="center" >Activation Date</th>';
			$data.='<th align="center" >Validity(days)</th>';
			$data.='<th align="center" >Deactivation Date</th>';
			$data.='</tr>';
			foreach ($query->result() as $row)
			{
				$data.='<tr class="">';
				$data.='<td align="center">'.$row->membership_name.'</td>';
				//CB#SOG#17-11-2012#PR#S
				$data.='<td align="center">'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$row->amount_paid.'</td>';
				//CB#SOG#17-11-2012#PR#E
				$data.='<td align="center">'.$row->payment_date .'</td>';
				$data.='<td align="center">'.$row->activation_date.'</td>';
				$data.='<td align="center">'.$row->membership_validity.'</td>';
				$data.='<td align="center">'.$row->deactivation_date.'</td>';
				$data.='</tr>';
			}
			$data.='</table>';
		}
		else
		{
			$data='No transaction to display';
		}
		return $data;
	}
	
	function changeDateFrmt($date)
	{
	
		$explode=explode('-',$date);
		$change_date=date("F j, Y",mktime(0, 0, 0,$explode[1],$explode[2],$explode[0]));
		return $change_date;
		//$this->account_overview_model->changeDateFrmt($row->payment_date);
	}
	
}
?>


