<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership extends Pardco {
	 
	public function __construct(){
		parent::__construct();
		$this->load-> library('pdf/mpdf');
		$this->load->model('admin/membership_model');
		/*===================LogIn Security Check===================*/
		/*
		$logged_in_Status		= $this->session->userdata('logged_in');
		$local_admin_id			= $this->session->userdata('local_admin_id');
		$user_id_local_admin	= $this->session->userdata('user_id_local_admin');
		$is_parent				= $this->session->userdata('is_parent');
		
		if(!$logged_in_Status){
			redirect(base_url().'admin/login');
		}else{
			if($is_parent == 1){
				redirect(base_url().'admin/');
			}else{
				if($user_id_local_admin != $local_admin_id){
					$this->session->sess_destroy();
					redirect(base_url());
				}
			}
		}*/
		 $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
			$this->lang->load('admin_membership',$default_language);
			$this->lang->load('admin_global',$default_language);
			$this->lang->load('page',$default_language);
			$this->lang->load('calendar',$default_language);
        }else{
			$setLanguage = strtolower($this->session->userdata('admin_language'));
			$this->lang->load('admin_membership',$setLanguage);
			$this->lang->load('admin_global',$setLanguage);
			$this->lang->load('page',$setLanguage);
			$this->lang->load('calendar',$setLanguage);
        }
		/*######## End Language #######*/
	}

	public function index(){			
		$this->load->view('admin/header');
		$data['menu_right']				=	$this->pardco_model->pardco_right_menu();
		$data['menu_left']				=	$this->pardco_model->pardco_left_menu();
		$data['pardco_location']		=	$this->pardco_model->pardco_location();
        $data['payment_details']		=	$this->membership_model->getPaymentDetails();      
        $planArr						= 	$this->membership_model->getMembershipPlan();
        $i = 0;
        $plan_id = '';
		
		$data['current_plan_details']		=	$this->membership_model->getActivePlanDetails(); 
		
        $membershipPlanArr = array();
        foreach($planArr as $plan){
            if($plan_id != $plan['plan_id']){
                $j = 0;
                $membershipPlanArr[$i]['plan_id'] = $plan['plan_id'];
                $membershipPlanArr[$i]['plan_name'] = $plan['plan_name'];
                $membershipPlanArr[$i]['plan_desc'] = $plan['plan_desc'];
                $membershipPlanArr[$i]['status'] = $plan['status'];
				$membershipPlanArr[$i]['plan_cost'] = $plan['plan_cost'];
                $membershipPlanArr[$i]['plan_validity'] = $plan['plan_validity'];
                $membershipPlanArr[$i]['is_multilocation'] = $plan['is_multilocation'];
                $membershipPlanArr[$i]['currency_id'] = $plan['currency_id'];
                $membershipPlanArr[$i]['currency_symbol'] = $plan['currency_symbol'];
                $membershipPlanArr[$i]['created_on'] = $plan['created_on'];
                $membershipPlanArr[$i]['membership_order'] = $plan['membership_order'];
                /*
                $membershipPlanArr[$i]['tierprice'][$j]['tierprice_id'] = $plan['tierprice_id'];
                $membershipPlanArr[$i]['tierprice'][$j]['price'] = $plan['price'];
                $membershipPlanArr[$i]['tierprice'][$j]['billing_cycle'] = $plan['billing_cycle'];
                $membershipPlanArr[$i]['tierprice'][$j]['no_of_location'] = $plan['no_of_location'];
                $membershipPlanArr[$i]['tierprice'][$j]['staff_per_location'] = $plan['staff_per_location'];
                $membershipPlanArr[$i]['tierprice'][$j]['additional_cost_location'] = $plan['additional_cost_location'];
				*/
				$tierprice					=	$this->membership_model->getBaseTierprice($plan['plan_id']); 
				$membershipPlanArr[$i]['tierprice']['tierprice_id'] = $tierprice[0]['tierprice_id'];
                $membershipPlanArr[$i]['tierprice']['price'] = $tierprice[0]['price'];
                $membershipPlanArr[$i]['tierprice']['billing_cycle'] = $tierprice[0]['billing_cycle'];
                $membershipPlanArr[$i]['tierprice']['no_of_location'] = $tierprice[0]['no_of_location'];
                $membershipPlanArr[$i]['tierprice']['staff_per_location'] = $tierprice[0]['staff_per_location'];
                $membershipPlanArr[$i]['tierprice']['additional_cost_location'] = $tierprice[0]['additional_cost_location'];
				
				
                $plan_id = $plan['plan_id'];
				
				$featureArr= $this->membership_model->getMembershipFeature($plan_id);
				$f=1;
				foreach($featureArr as $feature){
					 $membershipPlanArr[$i]['feature'][$f]['feature_name'] = $feature['feature_name'];
					 $f++;					
				}
			/*
            }else{
                $i--;
                $membershipPlanArr[$i]['tierprice'][$j]['tierprice_id'] = $plan['tierprice_id'];
                $membershipPlanArr[$i]['tierprice'][$j]['price'] = $plan['price'];
                $membershipPlanArr[$i]['tierprice'][$j]['billing_cycle'] = $plan['billing_cycle'];
                $membershipPlanArr[$i]['tierprice'][$j]['no_of_location'] = $plan['no_of_location'];
                $membershipPlanArr[$i]['tierprice'][$j]['staff_per_location'] = $plan['staff_per_location'];
                $membershipPlanArr[$i]['tierprice'][$j]['additional_cost_location'] = $plan['additional_cost_location'];
			*/			
            }
            $i++;
            $j++;
			
        }
		/*
        echo "<pre>";
        print_r($membershipPlanArr);
        echo "</pre>";
		*/

        $data['membershipPlanArr']				= 	$membershipPlanArr;
		$data['creditDetails']					=	$this->membership_model->getActiveCreditDetails();
		$data['countries']						=	$this->membership_model->getCountries();
		$data['localAdminCountry']				=	$this->membership_model->getLocalAdminCountry();
		$data['currentCredit']					=	$this->membership_model->getCurrentCredit();		
		
		
		$this->load->view('admin/nevigation',$data);
		$this->load->view('admin/membership/membership');
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	public function getReportPrint($plan_subscription_id){
		$data 							=	array();
		$planArr 						=	$this->membership_model->getPayDetails($plan_subscription_id);
		$SuperadminDetails 				=	$this->membership_model->getSuperadminDetails();		
		$data['plan_subscription_id']	=	$plan_subscription_id;
		$data['planArr']				=	$planArr;
		$data['SuperadminDetails']		=	$SuperadminDetails;
		$this->load->view('admin/membership/print',$data);        
	}
	public function planDetails(){
        $planId          				= 	$this->input->post('planId');		
        $planIdArr   					= 	explode("-",$planId);
        $plan_id 						= 	$planIdArr[1];
		$is_multilocation 				= 	$this->input->post('is_multilocation');
        $planDetailsArr 				= 	$this->membership_model->getMembershipDetails($plan_id);
        $package 						= 	'';		
		$data							=	array();
		$data['is_multilocation']		=	$is_multilocation;
		$data['planDetailsArr']			=	$planDetailsArr;
		$data['plan_id']				=	$plan_id;
		/*
		if($is_multilocation ==0){			       
			$this->load->view('admin/membership/non_multilocation_ajax',$data); 
		}
		else{			
			$this->load->view('admin/membership/multilocation_ajax',$data); 
		}
		*/
		$this->load->view('admin/membership/multilocation_ajax',$data); 
	}
   /*
    public function selectPlan(){
		$planData['planId'] 					= 	$this->input->post('planId');
		$planData['tierprice_id'] 				= 	$this->input->post('tierprice_id');
		$planData['pay_cardtype']				=	$this->input->post('pay_cardtype');
		$planData['pay_ccnumber']				=	$this->input->post('pay_ccnumber');
		$planData['pay_month']					=	$this->input->post('pay_month');
		$planData['pay_year']					=	$this->input->post('pay_year');
		$planData['pay_cvv']					=	$this->input->post('pay_cvv');
		$planData['pay_first_name']				=	$this->input->post('pay_first_name');
		$planData['pay_last_name']				=	$this->input->post('pay_last_name');
		$planData['pay_amount']					=	$this->input->post('pay_amount');
		
		$returnData 							= 	$this->membership_model->editPlan($planData);
		
		echo $returnData;
    }
	*/
	public function selectPlanMultilocation(){
		$planData['plan_id']					= 	$this->input->post('plan_id');
		$planData['no_of_location'] 			= 	$this->input->post('no_of_location');
		$planData['staff_per_location_ajax']  	= 	$this->input->post('staff_per_location');
		$planData['billing_cycle_frm_ajax'] 	= 	$this->input->post('billing_cycle');
		$planData['pay_cardtype']				=	$this->input->post('pay_cardtype');
		$planData['pay_ccnumber']				=	$this->input->post('pay_ccnumber');
		$planData['pay_month']					=	$this->input->post('pay_month');
		$planData['pay_year']					=	$this->input->post('pay_year');
		$planData['pay_cvv']					=	$this->input->post('pay_cvv');
		$planData['pay_first_name']				=	$this->input->post('pay_first_name');
		$planData['pay_last_name']				=	$this->input->post('pay_last_name');
		$planData['pay_amount']					=	$this->input->post('pay_amount');
	
		$returnData 						= 	$this->membership_model->editPlanMultilocation($planData);

		echo $returnData;
    }		
	public function changeLocation(){
		$html							=	array();
        $plan_id 						= 	$this->input->post('plan_id');
        $no_of_location 				= 	$this->input->post('no_of_location');
		$html['planDetailsArr']			=	$this->membership_model->getTierBillingCycleByLocation($plan_id,$no_of_location);
		$html['plan_id']				=	$plan_id;
		$this->load->view('admin/membership/change_multilocation_ajax',$html); 
		//echo $html;
    }
	public function changeBillingCycle(){
		$html							=	array();
        $plan_id 						= 	$this->input->post('plan_id');
        $no_of_location 				= 	$this->input->post('no_of_location');
		$billing_cycle_frm_ajax 		= 	$this->input->post('billing_cycle');
		$staff_per_location_ajax		= 	$this->input->post('staff_per_location');		
		$html['planDetailsArr']			=	$this->membership_model->getTierBillingCycleByLocation($plan_id,$no_of_location);
		$html['plan_id']				=	$plan_id;
		$html['billing_cycle_frm_ajax']	=	$billing_cycle_frm_ajax;
		$html['staff_per_location_ajax']=	$staff_per_location_ajax;
		$this->load->view('admin/membership/change_billing_cycle_ajax',$html); 
		//echo $html;
    }
	public function changeStaffPerLocation(){
		$html							=	array();
        $plan_id 						= 	$this->input->post('plan_id');
        $no_of_location 				= 	$this->input->post('no_of_location');
		$staff_per_location_ajax		= 	$this->input->post('staff_per_location');
		$billing_cycle 					= 	$this->input->post('billing_cycle');		
		$planDetailsArr					=	$this->membership_model->getTierBillingCycleByLocation($plan_id,$no_of_location);
		$staff_per_location				=	0;
		$additional_cost_staff			=	'';
		foreach($planDetailsArr as $packageArr){ 				
			if($staff_per_location < $packageArr['staff_per_location']){
				$max_staff_per_location=$packageArr['staff_per_location']; 
			}
			$staff_per_location=$packageArr['staff_per_location'];						
			if($billing_cycle ==$packageArr['billing_cycle']){	
				$additional_cost_staff	= $packageArr['additional_cost_location'];	
				$price=	$packageArr['price'];	
			}			
		}
		$extra_staff= $staff_per_location_ajax-$max_staff_per_location;
		if($extra_staff >0){
			$extra_price=$additional_cost_staff * $extra_staff;
		}
		else{
			$extra_price	= 0;
		}		
		$price=$price + $extra_price;		
		 		
		echo trim(number_format($price, 2, '.', ''));
    }
	public function getCurrentPlanVsNewPlan(){
		$data							=	array();
        $plan_id 						= 	$this->input->post('plan_id');
        $no_of_location 				= 	$this->input->post('no_of_location');
		$billing_cycle 					= 	$this->input->post('billing_cycle');
		$staff_per_location				= 	$this->input->post('staff_per_location');
		$is_multilocation				= 	$this->input->post('is_multilocation');		
		$tierprice_id					= 	$this->input->post('tierprice_id');		
		$currentPlanDetailsArr			=	$this->membership_model->getActivePlanDetails();
		if($is_multilocation ==1){
		$newPlanTierDetailsArr			=	$this->membership_model->getTierBillingCycleByLocation($plan_id,$no_of_location);
		}
		else{
			$newPlanTierDetailsArr		=	$this->membership_model->getTierBillingCycleByBillingCycle($plan_id);
		}
		$newPlanDetailsArr				=	$this->membership_model->getPlanDetails($plan_id);
		
		
		$data['plan_id']				=	$plan_id;
		$data['no_of_location']			=	$no_of_location;		
		$data['billing_cycle']			=	$billing_cycle;
		$data['is_multilocation']		=	$is_multilocation;
		$data['staff_per_location']		=	$staff_per_location;
		$data['currentPlanDetailsArr']	=	$currentPlanDetailsArr;
		$data['newPlanDetailsArr']		=	$newPlanDetailsArr;
		$data['newPlanTierDetailsArr']	=	$newPlanTierDetailsArr;
		//echo $no_of_location;exit;
		$this->load->view('admin/membership/current_new_plan_ajax',$data);		
	}
	public function getCreditsCountryPrice(){
        $credit_id 						= 	$this->input->post('credit_id');
        $country_id 					= 	$this->input->post('country_id');
		$arr							=	$this->membership_model->getCreditsCountryPrice($country_id,$credit_id);	
		if(count($arr) > 0){
			$ret	                    =	json_encode($arr);
		}
		else{
			$ret 	                    = 	'0';
		}
		echo $ret;
		exit;
	}
	public function getPaypalInfo(){
		$data							=	array();
        $credit_id 						= 	$this->input->post('credit_id');
		$data['credit_id']				=	$credit_id;
       	$this->load->view('admin/membership/credit_paypal_html',$data); 
	}
	public function buyCredit(){
		$data							=	array();
		$data['credit_id']				=	$this->input->post('credit_id');
		$data['pay_cardtype']			=	$this->input->post('pay_cardtype');
		$data['pay_ccnumber']			=	$this->input->post('pay_ccnumber');
		$data['pay_month']				=	$this->input->post('pay_month');
		$data['pay_year']				=	$this->input->post('pay_year');
		$data['pay_cvv']				=	$this->input->post('pay_cvv');
		$data['pay_first_name']			=	$this->input->post('pay_first_name');
		$data['pay_last_name']			=	$this->input->post('pay_last_name');
		$data['pay_amount']				=	$this->input->post('pay_amount');
	
		$returnData 					= 	$this->membership_model->buyCredit($data);
		echo $returnData;
    }
	
	
	public function closeTheCurrentInstance(){
		$this->membership_model->closeTheCurrentInstance();
		echo 'done';
	}
				
}