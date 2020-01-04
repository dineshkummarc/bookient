<?php
class Membership_model extends CI_Model
{
	public function getSuperadminDetails(){
        $this->db->select('*');
        $this->db->from('app_superadmin_details');
        $this->db->join('app_regions', 'app_regions.region_id = app_superadmin_details.region_id');
        $this->db->join('app_cities', 'app_cities.city_id = app_superadmin_details.city_id');
		$this->db->join('app_countries', 'app_countries.country_id = app_superadmin_details.country_id');
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }
	public function getPlanData($plan_id=0){
        $this->db->select('*');
        $this->db->from('app_membership_plan');
       // $this->db->join('app_membership_plan_tierprice', 'app_membership_plan_tierprice.plan_id = app_membership_plan.plan_id');
        $this->db->join('app_currency', 'app_currency.currency_id = app_membership_plan.currency_id');
        $this->db->where('app_membership_plan.status',1);
		if( !empty($plan_id) ) 
			$this->db->where('app_membership_plan.plan_id',$plan_id);
			
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }  
    public function getPlanDetails($plan_id){
		$this->db->select('*');
		$this->db->from('app_membership_plan');
		$this->db->where('plan_id',$plan_id);
		$this->db->where('is_deleted','N');

		$query = $this->db->get();
		$resultArr = $query->result_array();
		return $resultArr;
    }
    public function getMembershipPlan(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$Sql = "SELECT 
						* 
					FROM 
						(`app_membership_plan`) 
					JOIN 
						`app_currency` 
					ON 
						`app_currency`.`currency_id` = `app_membership_plan`.`currency_id` 
					WHERE 
						`app_membership_plan`.`status` = 1
					AND
						`app_membership_plan`.`is_deleted` = 'N'
					ORDER BY
						`app_membership_plan`.`membership_order` ASC";
		$query = $this->db->query($Sql);
		$Arr = $query->result_array();
		return $Arr;    
    }
	public function getBaseTierprice($plan_id){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
        $this->db->where('plan_id',$plan_id);
		$this->db->where('is_base_price',1);
			
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }
    public function getMembershipDetails($plan_id){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
        $this->db->where('plan_id',$plan_id);
		$this->db->order_by('tierprice_id','asc');
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }
	public function getMembershipFeature($plan_id, $sel='app_membership_feature.*'){
		$this->db->select($sel);
        $this->db->from('app_membership_plan_feature_relation');
        $this->db->join('app_membership_feature', 'app_membership_feature.feature_id = app_membership_plan_feature_relation.feature_id');
        $this->db->where('app_membership_plan_feature_relation.plan_id',$plan_id);
		$this->db->where('app_membership_feature.status','1');
		$this->db->order_by('app_membership_feature.feature_order','asc');
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
		
	}
    public function getPaymentDetails(){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_member_plan_subscription.plan_subscription_id,app_member_plan_subscription.subscription_date,app_member_plan_subscription.plan_expiry_date,app_member_plan_subscription.total_amt,app_currency.currency_symbol,app_membership_plan.plan_name');
        $this->db->from('app_member_plan_subscription');
        $this->db->join('app_membership_plan', 'app_membership_plan.plan_id = app_member_plan_subscription.plan_id');
        $this->db->join('app_currency', 'app_currency.currency_id = app_member_plan_subscription.currency_id');
        //$this->db->where('app_member_plan_subscription.is_active','Y');
		$this->db->where('app_member_plan_subscription.local_admin_id',$local_admin_id);
		$this->db->order_by('app_member_plan_subscription.subscription_date','desc');				
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $this->getPaymentHtml($resultArr);
    }
	public function getPaymentHtml($payment_details){
		$html='<table width="70%" class="list-view">
	    			<tr>
	    				<th style="width:150px; text-align:left" >'.$this->global_mod->db_parse($this->lang->line("date_of_payment")).'</th>
	    				<th style="width:150px; text-align:left">'.$this->global_mod->db_parse($this->lang->line("membrshp_type")).'</th>
	    				<th style="width:150px; text-align:left">'.$this->global_mod->db_parse($this->lang->line("membrship_valid_till")).'</th>
	    				<th style="width:130px; text-align:right">'.$this->global_mod->db_parse($this->lang->line("amnt_paid")).'</th>
	    				<th style="width:150px; text-align:center">&nbsp;</th>
	    			</tr>';
		foreach($payment_details as $paymentDetailsArr){    
			$html .='<tr>';
				$html .='<td nowrap="true">'.date('n/j/Y g:i:s',strtotime($paymentDetailsArr['subscription_date'])).'</td>';
				$html .='<td  align="left">'.ucfirst($paymentDetailsArr['plan_name']).'</td>';
				$html .='<td  align="left">'.date('n/j/Y g:i:s',strtotime($paymentDetailsArr['plan_expiry_date'])).'</td>';
				$html .='<td  align="right">'.$paymentDetailsArr['currency_symbol'].$paymentDetailsArr['total_amt'].'</td>';
				//$html .='<td><a href="'.base_url('admin/membership/getReportPrint/'.$paymentDetailsArr['plan_subscription_id']).'">Print</a></td>';
				$html .='<td  align="center"><a style="cursor:pointer" title="Print" onclick="window.open(\''.base_url('admin/membership/getReportPrint/'.$paymentDetailsArr['plan_subscription_id']).'\',\'\',\'width=600\')" >'.$this->lang->line("print").'</a></td>';				
			$html .='</tr>';
		}
	    $html .='</table>';
		return $html;
	}
    public function getPayDetails($plan_subscription_id){
        $this->db->select('*');
        $this->db->from('app_member_plan_subscription');
        $this->db->join('app_membership_plan', 'app_membership_plan.plan_id = app_member_plan_subscription.plan_id');
        $this->db->join('app_currency', 'app_currency.currency_id = app_member_plan_subscription.currency_id');
        $this->db->where('app_member_plan_subscription.plan_subscription_id',$plan_subscription_id);
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }
	public function editPlanMultilocation($planData){	
		$dataArrIn['fname']			= $planData['pay_first_name'];
		$dataArrIn['lname']			= $planData['pay_last_name'];
		$dataArrIn['cardType']		= $planData['pay_cardtype'];
		$dataArrIn['cardNumber']	= $planData['pay_ccnumber'];
		$dataArrIn['cardMonth']		= $planData['pay_month'];	
		$dataArrIn['cardYear']		= $planData['pay_year'];
		$dataArrIn['cardCVV']		= $planData['pay_cvv'];
		$dataArrIn['PayAmount']		= $planData['pay_amount'];
		$dataStrOut = 'hello';
		$returnPayment = $this->global_payment_mod->sendToPaymentViaPaypal($dataArrIn,$dataStrOut);
		if($returnPayment['msg']=='success'){
	  	$plan_id							= 	$planData['plan_id'];
        $no_of_location 					= 	$planData['no_of_location'];
		$staff_per_location_ajax  		    = 	$planData['staff_per_location_ajax'];
		$billing_cycle_frm_ajax 			= 	$planData['billing_cycle_frm_ajax'];
		
		$local_admin_id 					= 	$this->session->userdata('local_admin_id');
		$planDetails 						= 	$this->getPlanDetails($plan_id);
	//	$planDesc 							= 	$planDetails[0]['plan_desc'];
		$freePlanData = $this->getPlanDetails($plan_id);

		$planArr["plan_name"] = $freePlanData[0]['plan_name'];
		$planArr["plan_details"] = isset($freePlanData[0]['plan_desc'])?$freePlanData[0]['plan_desc']:0;
		$currency_id = isset($freePlanData[0]['currency_id'])?$freePlanData[0]['currency_id']:0;
		$featureData = $this->getMembershipFeature($plan_id,'app_membership_feature.feature_id feature_id, app_membership_feature.feature_name feature_name');
		$feature_desc	=  json_encode($featureData );
		$plan_desc		= json_encode($planArr );
		
		
		$planDetailsArr = $this->membership_model->getTierBillingCycleByLocation($plan_id,$no_of_location);
		$staff_per_location=0;
		$max_staff_per_location=0;
		foreach($planDetailsArr as $packageArr){ 			
			if($staff_per_location < $packageArr['staff_per_location']){
				$max_staff_per_location=$packageArr['staff_per_location']; 
			}
			$staff_per_location=$packageArr['staff_per_location'];
			
			$billing_cycle =$packageArr['billing_cycle'];					
			if($billing_cycle =="monthly"){	
				$monthlyRate 	= $packageArr['price'];	
				$display_billing_cycle="Monthly";		
			}
			elseif($billing_cycle =="helf_yearly"){
				$helfYearlyRate = $packageArr['price'];
				$display_billing_cycle="Half Yearly";						
			}
			elseif($billing_cycle =="yearly"){
				$yearlyRate 	= $packageArr['price'];
				$display_billing_cycle="Yearly";					
			}
			if($billing_cycle_frm_ajax ==$packageArr['billing_cycle']){	
				$additional_cost_staff	= $packageArr['additional_cost_location'];		
			}
		} 	
		
		
		$extra_staff	= 	$staff_per_location_ajax - $max_staff_per_location;
		if($extra_staff >0){
			$extra_price	=	$additional_cost_staff * $extra_staff;
		}
		else{
			$extra_price	= 0;
		}		
		$newDate1 = gmdate('Y-m-d');
									
		if($billing_cycle_frm_ajax =="monthly"){	
			$saving 				= '0.0';		
			$price					= $monthlyRate + $extra_price;
			$newDate = gmdate("Y-m-d", strtotime($newDate1 ." +1 month") );
		}
		elseif($billing_cycle_frm_ajax =="helf_yearly"){
			$price					= $helfYearlyRate + $extra_price;
			$yearlyRateByMonth 		= $monthlyRate*12;
			$yearlyRateByHalf 		= $helfYearlyRate*2;
			$saving 				= ($yearlyRateByMonth-$yearlyRateByHalf)/2;
			$newDate 				= gmdate("Y-m-d", strtotime($newDate1 ." +6 month") );						
		}
		elseif($billing_cycle_frm_ajax =="yearly"){
			$price					= $yearlyRate +$extra_price;
			$yearlyRateByMonth 		= $monthlyRate*12;
			$saving 				= $yearlyRateByMonth-$yearlyRate;
			$newDate 				= gmdate("Y-m-d", strtotime($newDate1 ." +12 month") );					
		}								
        $data = array(
           'is_active' => 'N'
        );
		
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->update('app_member_plan_subscription', $data); 
        $dataArr = array(
            'local_admin_id'    =>  $local_admin_id,
            'plan_id'           =>  $plan_id,
			'is_multilocation'  =>  1,
            'plan_desc'         =>  $plan_desc,
            'billing_cycle'     =>  $billing_cycle_frm_ajax,
			'no_of_location'    =>  $no_of_location,
			'staff_per_location'=>  $max_staff_per_location,
			'extra_staff'		=>  $extra_staff,
			'total_staff'		=>  $staff_per_location_ajax,
            'currency_id'       =>  '1',			
			'base_price'       	=>  $price,
			'base_saving_amt'   =>  $saving,
			'base_promo_amt'    =>  '0.00',
			'base_discount_amt' =>  '0.00',
			'base_total_amt'    =>  $price,
			'price'       		=>  $price,
			'saving_amt'       	=>  $saving,
			'promo_amt'       	=>  '0.00',
			'discount_amt'      =>  '0.00',			
            'total_amt'         =>  $price,
            'subscription_date' =>  gmdate('Y-m-d H:i:s'),
            'plan_expiry_date'  =>  $newDate,
            'feature_desc'      =>  $feature_desc,
            'payment_method_id' =>  '1',
            'is_active'         =>  'Y',
            'date_added'        =>  gmdate('Y-m-d')
        );		       		  	
        $this->db->insert('app_member_plan_subscription', $dataArr); 
       $lastId= $this->db->insert_id();
       if($lastId>0){
	   		$strRet =TRUE;
	   }else{
	   		$strRet =FALSE;
	   }
       }else{//payment sucess
       	
       		$strRet =FALSE;
       }
      return $strRet;
    }
	public function getTierpriceDetails($plan_id,$tierprice_id){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
		$this->db->where('plan_id',$plan_id);
        $this->db->where('tierprice_id',$tierprice_id);
        $query 		= $this->db->get();
        $resultArr 	= $query->result_array();
        return $resultArr;
    }
	public function getTierBillingCycle($plan_id,$billing_cycle){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
		$this->db->where('plan_id',$plan_id);
        $this->db->where('billing_cycle',$billing_cycle);
        $query 		= $this->db->get();
        $resultArr 	= $query->row();		
        return $resultArr->price;
    }
	public function getTierBillingCycleByBillingCycle($plan_id){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
		$this->db->where('plan_id',$plan_id);
        //$this->db->where('billing_cycle',$billing_cycle);
        $query 		= $this->db->get();
        $resultArr 	= $query->result_array();
        return $resultArr;
    }
	public function getTierBillingCycleByLocation($plan_id,$location){
        $this->db->select('*');
        $this->db->from('app_membership_plan_tierprice');
		$this->db->where('plan_id',$plan_id);
        $this->db->where('no_of_location',$location);
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }		
	public function getActivePlanDetails(){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_member_plan_subscription');
        $this->db->where('local_admin_id',$local_admin_id);
		$this->db->where('is_active','Y');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	//################Credit section start##################
	
	public function getActiveCreditDetails(){
        $this->db->select('*');
        $this->db->from('app_membership_credits');
		$this->db->where('status','1');
		$this->db->order_by('credit_order','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	public function getCurrentCredit(){
        $this->db->select('credit_id');
        $this->db->from('app_membership_credits_subscription');
		$this->db->order_by('credit_subscription_id','desc');
		$this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['credit_id'];
    }
	public function getCountries(){
	
        $this->db->select('*');
        $this->db->from('app_countries');
		$this->db->where('is_active','Y');
		$this->db->order_by('country_order','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	public function getLocalAdminCountry(){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_local_admin.country_id,app_countries.country_name');
        $this->db->from('app_local_admin');
		$this->db->join('app_countries', 'app_countries.country_id = app_local_admin.country_id');
        $this->db->where('app_local_admin.local_admin_id',$local_admin_id);
		$this->db->where('app_local_admin.is_active','Y');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	public function getCreditsCountryPrice($country_id,$credit_id,$credit_service_id=0){
        $this->db->select('*');
        $this->db->from('app_membership_credits_country_price');
		$this->db->join('app_countries', 'app_countries.country_id = app_membership_credits_country_price.country_id');
        $this->db->where('app_membership_credits_country_price.country_id',$country_id);
		$this->db->where('app_membership_credits_country_price.credit_id',$credit_id);
		if($credit_service_id !=0){
			$this->db->where('app_membership_credits_country_price.credit_service_id',$credit_service_id);
		}	
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	public function buyCredit($data){

		$credit_id					= $data['credit_id'];
		$buyCreditDetails 			= $this->membership_model->getBuyCreditDetails($credit_id);
		
		$dataArrIn['fname']			= $data['pay_first_name'];
		$dataArrIn['lname']			= $data['pay_last_name'];
		$dataArrIn['cardType']		= $data['pay_cardtype'];
		$dataArrIn['cardNumber']	= $data['pay_ccnumber'];
		$dataArrIn['cardMonth']		= $data['pay_month'];	
		$dataArrIn['cardYear']		= $data['pay_year'];
		$dataArrIn['cardCVV']		= $data['pay_cvv'];
		$dataArrIn['PayAmount']		= $buyCreditDetails[0]['base_amt'];
		$dataStrOut = 'hello';
		$returnPayment = $this->global_payment_mod->sendToPaymentViaPaypal($dataArrIn,$dataStrOut);
		if($returnPayment['msg']=='success'){								
			$return 						=	array();				
			$return['local_admin_id']		= 	$this->session->userdata('local_admin_id');
			$return['credit_id']			=	$credit_id;
			$return['package_name']			= 	$buyCreditDetails[0]['package_name'];
			$return['package_desc']			= 	$buyCreditDetails[0]['package_desc'];
			$return['base_amt']				= 	$buyCreditDetails[0]['base_amt'];
			$return['amount']				= 	$buyCreditDetails[0]['base_amt'];
			$return['payment_date']			= 	gmdate('Y-m-d');
			$return['date_added']			= 	gmdate('Y-m-d');			
			
			$this->db->trans_begin();
			$this->db->insert('app_membership_credits_subscription',$this->db->escape($return));		
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}			
			$this->membership_model->updateCreditsInventory($buyCreditDetails[0]['credits']);		
			$strRet =TRUE;
		}else{     	
       		$strRet =FALSE;
       }
	   return $strRet;
	}
	public function getBuyCreditDetails($credit_id){
        $this->db->select('*');
        $this->db->from('app_membership_credits');
		$this->db->where('credit_id',$credit_id);
		$this->db->where('status','1');
        $query = $this->db->get();
        $result = $query->result_array();		
        return $result;
    }
	
	public function updateCreditsInventory($amount){
		$data=array();
		$local_admin_id=$this->session->userdata('local_admin_id');
				
		$this->db->select('*');
		$this->db->from('app_membership_credits_inventory ');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$result = $query->result_array();
		$NumRows =  $query->num_rows();

		$this->db->trans_begin();
		if($NumRows == 0)
		{
			$data['local_admin_id']				= 	$local_admin_id;
			$data['available_credits']			= 	$amount;
			$this->db->insert('app_membership_credits_inventory',$this->db->escape($data));
		}
		else
		{
			$data['local_admin_id']				= 	$local_admin_id;
			$data['available_credits']			= 	$amount + $result[0]['available_credits'];
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->update('app_membership_credits_inventory',$this->db->escape($data));
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
    }

	public function closeTheCurrentInstance(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		       'is_active' => 'N'
		    );
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->update('app_local_admin', $data); 
		
		$dataPlan = array(
		       'is_active' => 'N'
		    );
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->update('app_member_plan_subscription', $dataPlan);

		$freePlanData = $this->getPlanDetails(89);		
		$planArr["plan_name"]		= $freePlanData[0]['plan_name'];
		$planArr["plan_details"]	= isset($freePlanData[0]['plan_desc'])?$freePlanData[0]['plan_desc']:0;
		$currency_id				= isset($freePlanData[0]['currency_id'])?$freePlanData[0]['currency_id']:0;			
		$featureData				= $this->getMembershipFeature(89,'app_membership_feature.feature_id feature_id, app_membership_feature.feature_name feature_name');
	    $feature_desc				= json_encode($featureData );
	    $plan_desc					= json_encode($planArr );
		$plandata = array(
                'local_admin_id'     => $local_admin_id,
                'plan_id'         	 => 89,
                'is_multilocation'   => 0,
                'plan_desc'          => $plan_desc,
                'billing_cycle'      => '',
				'no_of_location'     => 0,
                'staff_per_location' => 0,
                'extra_staff'        => 0,
                'total_staff'        => 0,
                'currency_id'        => $currency_id,
				'base_price'         => 0,
                'base_saving_amt'    => 0,
                'base_promo_amt'     => 0,
                'base_discount_amt'  => 0,
				'base_total_amt'     => 0,
                'price'              => 0,
                'saving_amt'         => 0,
                'promo_amt'          => 0,
                'discount_amt'       => 0,	
				'total_amt'          => 0,
                'subscription_date'  => gmdate("Y-m-d H:i:s"),
                'plan_expiry_date'   => '0000-00-00',
                'feature_desc'       => $feature_desc,
				'payment_method_id'  => 1,
                'is_active'          => 'Y',
                'date_added'         => gmdate("Y-m-d")
			
		);
		$this->db->insert('app_member_plan_subscription',$plandata);
		$this->session->sess_destroy();	
	}

}
?>