<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_membership_model extends CI_Model{
	
	function showAllMembershipType()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data='';
		$sql=$this->db->query("
			SELECT 	membership_type_id
			FROM    app_membership_payment_history
			WHERE   local_admin_id ='".$local_admin_id."'
			ORDER BY membership_payment_history_id DESC LIMIT 0,1
		");
		if ($sql->num_rows() > 0)
		{
			$row1 = $sql->row();		
			$local_admin_membership_type_id=$row1->membership_type_id;
		}
		else
		{
			$local_admin_membership_type_id=1;
		}
		
		
		$query=$this->db->query("
			SELECT 	mem.*,
					cur.currency_symbol
			FROM    app_membership_types mem,
					app_currency cur
			WHERE  	cur.currency_id=mem.currency_id AND
					mem.status=1
		");
		if ($query->num_rows() > 0)
		{
			$data.='<table width="100%" cellspaceing="0" cellpadding="0">';
			foreach ($query->result() as $row)
			{
				if($row->membership_type_id==$local_admin_membership_type_id)
				{
					$membership_type_selected='checked="checked"';
				}
				else
				{
					$membership_type_selected="";
				}
				
				$data.='<tr>';
				$data.='<td align="center">
					<input type="radio" name="membership_type" onclick="showMembershipFeature('.$row->membership_type_id.')"'.$membership_type_selected.' />
				</td>';
				$data.='<td style="font-size:14px;font-weight:bold; color:#004E96;">'.$row->membership_name.'</td>';
				$data.='<td>
					<div class="membership-tagline">
						<h5>'.$row->membership_tagline.'</h5>
						<h6>'.$row->membership_description.'</h6>';
				$query_feature=$this->db->query("SELECT	feature.membership_plan_feature	FROM  app_membership_plan_feature as feature,app_membership_plan_type_feature_link as link WHERE 	feature.membership_plan_feature_id=link.membership_plan_feature_id AND link.membership_type_id = ".$row->membership_type_id." AND feature.status = 1");
				if ($query_feature->num_rows() > 0)
				{
					$data.='<ul>';
					foreach($query_feature->result() as $row_feature)
					{
							$data.='<li>'.$row_feature->membership_plan_feature.'</li>';
					}
					$data.='</ul>';
				}
				$data.='</ul>
					</div>
				</td>';
/*							<li>'.$row->membership_description.'</li>
*/				
				//if($row->membership_type_id==1)
				//{
					//$data.='<td >No Charge</td>';
				//}
				//else
				//{
					$data.='<td >'.$row->currency_symbol.'&nbsp;'.$row->membership_amount.' / '.$row->membership_validity.' days</td>';
				//}
				$data.='</tr>';
				$data.='<tr>';
				$data.='<td colspan="4">';
				if($row->membership_type_id==$local_admin_membership_type_id)
				{
					$data.='<div id="membership_feature'.$row->membership_type_id.'" class="local_admin_membership_feature account-overview" >'.$this->upgrade_membership_model->featureDetails($row->membership_type_id).'</div>';
				}
				else
				{
					$data.='<div id="membership_feature'.$row->membership_type_id.'" class="membership_feature account-overview" ></div>';
				}
				
				$data.='</td>';
				$data.='</tr>';				
				$data.='<tr>';
				$data.='<td colspan="4"><div style="border-top:1px solid #e1e1e1;width:100%;margin:10px 0 10px 0;"></div>';
				$data.='</td>';
				$data.='</tr>';				
			}
			$data.='</table>';
		}
		else
		{
			$data='No Premium To Display';
		}
		return $data;
	}
	
	function featureDetails($membership_type_id)
	{
		$data='';
		$temp='';
		
		$query_current=$this->db->query("SELECT cur.currency_symbol FROM app_currency as cur,app_membership_types as mem WHERE mem.currency_id = cur.currency_id AND cur.is_active = 1 AND mem.membership_type_id = ".$membership_type_id);
		if ($query_current->num_rows() > 0)
		{
			foreach ($query_current->result() as $row_current)
			{
				$currency = $row_current->currency_symbol;
			}
		}
		
		$query=$this->db->query("SELECT * FROM app_membership_plan_subscriptions WHERE membership_type_id = ".$membership_type_id." AND status = 1");
		if ($query->num_rows() > 0)
		{
			$data.='<table width=100%  style="padding:10px 10px 10px 10px;">';
			foreach ($query->result() as $row)
			{
				$data.='<tr>';
				$data.='<td align="center">
						<input type="radio" name="membership_feature_select'.$membership_type_id.'" id="membership_feature_select'.$membership_type_id.'" value="'.$row->plan_subscriptions_id.'" checked="checked"/>	
						</td>';
				if($row->extra_validity == '' || $row->extra_validity == 0)
				{$extra_validity = '';}
				else
				{
					$days = $row->extra_validity;
					if($days >= 30)
					{
						$year = 0;
						$months = $days/30;
						$days = $days%30;
						if($months > 12)
						{
							$year = $months/12;
							$months = $months%12;
							$days = $months%30;
						}
						$extra_validity = '<span style="color:#FF0000; font-size:11px;">(';
						if($year != 0)
						{
							if($year > 1)
								$extra_validity .= $year.' Years ';
							else
								$extra_validity .= $year.' Year ';
						}
						if($months > 1)
						{
							$extra_validity .= $months.' Months ';
						}
						else
						{
							$extra_validity .= $months.' Month ';
						}
						if($days != 0)
						{
							if($days > 1)
								$extra_validity .= $days.' Days ';
							else
								$extra_validity .= $days.' Day ';
						}
						
						$extra_validity .= 'Extra)</span>';
					}
					else
					{
						$extra_validity = '<span style="color:#FF0000; font-size:11px;">('.$row->extra_validity.' Days Extra)</span>';
					}	
				}
				
				$data.='<td>'.$row->sub_plan_desc.' '.$extra_validity.'</td>';
				if($row->amount == 0.00 || $row->amount == '' || $row->amount == 0)
				{
					$amount = 'No Charge';
				}
				else
				{
					$amount = $currency.' '.$row->amount;
				}
				
				if($row->validity == 0 || $row->validity == '')
				{
					$validity = '';
				}
				else
				{
					$validity = '/ '.$row->validity.'  '.'days';
				}
				$data.='<td>'.$amount.' '.$validity.'</td>';
				$data.='</tr>';
			}
			if($membership_type_id !=1)
			{
				$data.='<tr style="background:#fff;">';
				$data.='<td align="right">';
				$data.='<td align="right">';
				$data.='<td align="left">';
				$data.='<input type="button" class="btn-blue" value="subscribe" onclick="subcribe('.$membership_type_id.')"';
				$data.='</td>';
				$data.='</tr>';
			}
			
			$data.='</table>';
		}
		else
		{
			$data='No Premium To Display';
		}
		return $data;
	}
}
?>


