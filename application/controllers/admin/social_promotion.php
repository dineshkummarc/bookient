<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class social_promotion extends Pardco { 
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/social_promotion_model');
		
        /*===================LogIn Security Check===================*/
         /* $logged_in_Status = $this->session->userdata('logged_in');
          $local_admin_id = $this->session->userdata('local_admin_id');
          $user_id_local_admin = $this->session->userdata('user_id_local_admin');
          if(!$logged_in_Status)
          {
                  redirect(base_url().'admin/login');
          }else{
                  if($user_id_local_admin != $local_admin_id){
                          $this->session->sess_destroy();
                          redirect(base_url());
                  }
          }*/
          $this->global_mod->checkSession();
        /*===================LogIn Security Check===================*/
    }
    public function index()
    {   
	
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_social_promotion',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_social_promotion',$setLanguage);
        }
		/*########End Language#######*/
	
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

		$list['ALLTemplate']= $this->social_promotion_model->getALLTemplate();
		$list['DesignOffer']= $this->social_promotion_model->getDesignOffer();
		$list['SocialMsg']= $this->social_promotion_model->getSocialMsg();
		
        
        $this->load->view('admin/social_promotion/social_promotion',$list);  

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
	public function save()
    {  
	 $local_admin_id = $this->session->userdata('local_admin_id');
	$app_design_offer=Array
						(    
							    'local_admin_id' 					=> $local_admin_id,
							    'template_id' 						=> $this->input->post('teplateRadio'),
							    'title'								=> $_REQUEST['NewPromotionTitle'],
								'description'						=> $_REQUEST['NewPromotionDescription'],
								'background_color'					=>$this->input->post('bgColor'),
								'border_color'						=>$this->input->post('borColor'),
								'title_color'						=>$this->input->post('titleColor'),
								'description_color'					=>$this->input->post('descColor'),
								'image_path'						=>$this->input->post('NewPromotionImage'),
								'repeat'							=>$this->input->post('ImageRepeat'),
								'position'							=>$this->input->post('ImagePosition')
							);	
		
		$this->social_promotion_model->save($app_design_offer);
		$app_promotion_message=Array
							(    
							    'local_admin_id' 					=> $local_admin_id,
							    'facebook_msg_body' 				=> $_REQUEST['faceboxMessage'],
							    'twitter_msg_body'					=> $_REQUEST['twitterMessage']
								
							);	
		$this->social_promotion_model->app_promotion_message_save($app_promotion_message);
		/*				
        echo "<pre>";
		print_r($this->input->post());
		echo "</pre>";
		*/
		redirect(base_url().'admin/social_promotion/index/success');
    }
   
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */