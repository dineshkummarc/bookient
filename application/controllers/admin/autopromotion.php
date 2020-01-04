<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autopromotion extends Pardco
{
	public function __construct(){ 
		parent::__construct();
		$this->load->model('admin/autopromotion_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id){
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_autopromotion',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_autopromotion',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/	
	}
	
	public function index(){			
		$this->load->view('admin/header');
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
				
		$dataArr['promoType']= $this->autopromotion_model->app_promo_type();
		$dataArr['service']= $this->pardco_model->service();
		$dataArr['allOffer']= $this->autopromotion_model->allAutoPromotion();
		$this->load->view('admin/autopromotion/autopromotion', $dataArr);
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
	} 
	
	public function promoTypeWiseOffer(){
		$cuponsType = $this->input->post('promoType');
		$allCupon = $this->autopromotion_model->allCuponDetails($cuponsType);
				$str ='';
		if(count($allCupon)>0){
				$str.='<select class="required" style="width:37%;" name="cuponName" id="cuponName">';
			foreach($allCupon as $allCuponArr){ 
				$str.='<option value="'.$allCuponArr["coupon_id"].'">'.$allCuponArr["coupon_heading"].'</option>'; 
			}
				$str.='</select>';	
		}else{
				$str.='<span style="width:37%; color:red"> Sorry There is no coupon found</span>';
		}

		echo $str;
	}

	public function savepromo(){
		
		$id 											= $this->input->post('promo_edit_id');
		$insertData['auto_promo_title'] 				= $this->input->post('pro_title');
		$insertData['auto_promo_type'] 					= $this->input->post('pro_type');
		
		
		$data = $this->input->post('pro_type_date_srt');
		
		if(isset($data)){
			$insertData['auto_promo_date_srt'] 			= $this->input->post('pro_type_date_srt');
		}	
		
		$data2 = $this->input->post('pro_type_date_end');
		if(isset($data2)){
			$insertData['auto_promo_date_end'] 			= $this->input->post('pro_type_date_end');
		}
		$data3 = $this->input->post('pro_type_date');
		if(isset($data3)){
			$insertData['auto_promo_date'] 				= $this->input->post('pro_type_date');
		}
		
		$insertData['auto_promo_time'] 					= $this->input->post('pro_time');
		$insertData['auto_promo_applyon'] 				= json_encode($this->input->post('pro_service'));
		$insertData['auto_promo_linkon'] 				= $this->input->post('pro_linkType');
		$insertData['auto_promo_linkid'] 				= $this->input->post('cuponName');
		$insertData['auto_promo_remaning_value']	 	= $this->input->post('pro_amount');
		$insertData['auto_promo_remaning_value_type'] 	= $this->input->post('pro_amount_type');
		$insertData['auto_promo_priority'] 				= $this->input->post('pro_priority');
		$insertData['auto_promo_status'] 				= $this->input->post('pro_status');
		
		$return = $this->autopromotion_model->saveAutoPromotion($id,$insertData);   
		
		echo $return;
		
		
	}
	
	public function GetDataForEdit(){
		$return = $this->autopromotion_model->FetchDataById();
		
		$Offer = $return[1];
		
		$str = '<span id="linkContener"><select class="required cWith" name="cuponName" id="cuponName">';		
					
		
		
		
		foreach($Offer as $val){
			$str .= '<option value="'.$val['coupon_id'].'"';
			if($val['coupon_id'] == $return[0]['auto_promo_linkid']){
				$str .= ' selected="" ';
			}
			$str .= '>'.$val['coupon_heading'].'</option>';
		}
		
		$str .= '</select></span> Or <a href="<?php echo base_url(); ?>admin/coupon">Add New offer</a>';
				
		$return[0]['offerbox'] = $str;
		$a = json_encode($return);
		echo $a;
		
		
	}
	
	public function DeletePromo(){
		$promotnId = $this->input->post('promotionId');
		$reutrn = $this->autopromotion_model->DeletePromo($promotnId);
		echo $return;
	}
	
	public function ChangeStatus(){
		$return = $this->autopromotion_model->ChangeStatus();
		echo $return;
	}


}
?>