<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_mktg extends Pardco { 
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('admin/email_mktg_model');
        $this->load->model('Email_model');
        /*===================LogIn Security Check===================*/
          $this->global_mod->checkSession();
        /*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_email_mktg',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_email_mktg',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
    }
    public function index(){   
        $data['menu_right']			=	$this->pardco_model->pardco_right_menu();
        $data['menu_left']			=	$this->pardco_model->pardco_left_menu();
        $data['pardco_location']	=	$this->pardco_model->pardco_location();    
        $list['showAllCategory']	=	$this->email_mktg_model->showAllCategory();
        $list['showAllTemplate']	=	$this->email_mktg_model->showAllTemplate();
 	//	$list['myTemplate']			=	$this->email_mktg_model->myTemplate();
		$footer['languages']		=	$this->pardco_model->admin_language();

		$this->load->view('admin/header');
		$this->load->view('admin/nevigation',$data);
		$this->load->view('admin/email_mktg/email_mktg',$list);  
		$this->load->view('admin/footer',$footer);
    }
    
    
    function selectCatAjax() 
    {
        $eml_mrktn_templt_cat_id		= $this->input->post('eml_mrktn_templt_cat_id');
        $showAllTemplate				= $this->email_mktg_model->showAllTemplate($eml_mrktn_templt_cat_id);
        $html='';        
		foreach ($showAllTemplate as $tempArr){ 
			$html .='<div class="tmplt">';
			$html .='<div class="hover_tmplt">';
			$html .='<span>'.$this->global_mod->show_to_control($tempArr['tem_subject']).'</span>';
			$html .='<div class="tmplt-content">';
			$html .='<input type="button" class="use-bt1" name="preview_btn" id="preview_btn" value="Preview" onclick="PreviewMailBody('.$tempArr['tem_id'].')" >';
			$html .='</div>';
			$html .='</div>';
			$html .='<div class="use-this">';
			$html .='<input type="button" class="use-bt" onclick="select_template('.$tempArr['tem_id'].')" value="'.$this->global_mod->db_parse($this->lang->line("use_this")).'" >';
			$html .='</div>';
			$html .='</div>';
		}  
        echo $html;
    }
    function selectCatForMyTempltAjax() 
    {
        $eml_mrktn_templt_cat_id		=$this->input->post('eml_mrktn_templt_cat_id');
        $html					=$this->email_mktg_model->myTemplate($eml_mrktn_templt_cat_id);
        echo $html;
    }
    function selectTemplateAjax() 
    {
        $eml_mrktn_templt_id			= $this->input->post('eml_mrktn_templt_id');
        $clicked_category 				= $this->input->post('clicked_category');
        
        
        $html                           = $this->email_mktg_model->selectTemplate($eml_mrktn_templt_id,$clicked_category);
        echo $html;
    }
    function selectMyTemplateAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $html                                   =$this->email_mktg_model->selectMyTemplate($eml_mrktn_templt_id);
        echo $html;
    }
    function saveHeaderAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_header_content			=$this->input->post('tmplt_header_content');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveHeader($eml_mrktn_templt_id, $tmplt_header_content);
        echo $html;
    }
    function saveContentAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_body_content			=$this->input->post('tmplt_body_content');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveContent($eml_mrktn_templt_id, $tmplt_body_content);
        echo $html;
    }
    function saveFooterAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_footer_content			=$this->input->post('tmplt_footer_content');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveFooter($eml_mrktn_templt_id, $tmplt_footer_content);
        echo $html;
    }
    function saveHeaderColorAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_header_bgcolor			=$this->input->post('tmplt_header_bgcolor');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveHeaderColor($eml_mrktn_templt_id, $tmplt_header_bgcolor);   
    }
    function saveContentColorAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_body_bgcolor			=$this->input->post('tmplt_body_bgcolor');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveContentColor($eml_mrktn_templt_id, $tmplt_body_bgcolor);    
    }
    function saveFooterColorAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $tmplt_footer_bgcolor			=$this->input->post('tmplt_footer_bgcolor');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->saveFooterColor($eml_mrktn_templt_id, $tmplt_footer_bgcolor);  
    }
    function previewTemplateAjax() 
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        //$editor_uniq_id                       =$this->input->post('$editor_uniq_id');
        $html					=$this->email_mktg_model->previewTemplate($eml_mrktn_templt_id);
       echo $html;
    }
    function saveTemplateAjax()
    {
        $eml_mrktn_templt_id			=$this->input->post('eml_mrktn_templt_id');
        $eml_mrktn_templt_cat_id                =$this->input->post('eml_mrktn_templt_cat_id');
        $tmplt_name                             =$this->input->post('tmplt_name');
        $tmplt_subject                          =$this->input->post('tmplt_subject');
        $html					=$this->email_mktg_model->saveTemplate($eml_mrktn_templt_id, $eml_mrktn_templt_cat_id,$tmplt_name,$tmplt_subject);   
    }
    function updateTemplateAjax()
    {
        $eml_mrktn_templt_local_admin_id        =$this->input->post('eml_mrktn_templt_local_admin_id');
        $eml_mrktn_templt_cat_id                =$this->input->post('eml_mrktn_templt_cat_id');
        $tmplt_name                             =$this->input->post('tmplt_name');
        $tmplt_subject                          =$this->input->post('tmplt_subject');
        //echo $tmplt_subject ;
        $html	=$this->email_mktg_model->updateTemplate($eml_mrktn_templt_local_admin_id, $eml_mrktn_templt_cat_id,$tmplt_name,$tmplt_subject);    
    }
    
    function sendTestMailAjax()
    {
        $ToEmailIDList                   = $this->input->post('mail_ids');
        $tmplt_id                        = $this->input->post('tmplt_id');
        
        $html = $this->email_mktg_model->GetMailContent($tmplt_id);
        $mail_subject = $html->app_emlmrktn_tem_subject;
        $mail_body = $html->app_emlmrktn_tem_content;
        $from = $this->session->userdata('ladmin_email');
       	
       	if($ToEmailIDList != ''){
			$ToEmailIDList = explode(',',$ToEmailIDList);
		}
       
        
        for($i = 0;$i<count($ToEmailIDList);$i++){
			$this->Email_model->PromotionalMail($mail_subject, $mail_body, $ToEmailIDList[$i], $from);
		}
        
        echo 1;
        
       // $this->load->model('Email_model');
       
       // echo $mail = $this->Email_model->PromotionalMail($mail_subject, $mail_body, $ToEmailID, $from);
        
        
    }
    function allUserAjax()
    {
        //$testemail                           =$this->input->post('testemail');
        //$tmplt_subject                       =$this->input->post('tmplt_subject');
        $html                                   =$this->email_mktg_model->allUser();
        echo $html;
    }
    function sendMailAjax()
    {
        $json_cuss_arr                           =$this->input->post('json_cuss_arr');
        $tmplt_subject                           =$this->input->post('tmplt_subject');
        $cuss_arr                                =json_decode($json_cuss_arr );  
        $html					 =$this->email_mktg_model->sendMail($cuss_arr,$tmplt_subject);
        echo $html;
    }
    function test()
    {
         $this->load->view('admin/email_mktg/test');     
    }
    function uploadAjax()
    {
        $download = isset($_REQUEST['download'])?$_REQUEST['download']:'';
        if(empty($download) && $download!='download' )
        {
            echo '<form name="upload_form" action="'.site_url('admin/email_mktg/uploadAjax').'" method="post" enctype="multipart/form-data" > 
                        <div class="s-file" style="text-align:center; height: 4px;">'.$this->global_mod->db_parse($this->lang->line("slct_file_to_upld")) .'</div> 
                        <br/>
                        <div class="sample-file" style="text-align:center;">
                            <a href="'.site_url('admin/email_mktg/csvDownload').'?download=download">'.$this->global_mod->db_parse($this->lang->line("clk_here")).'</a>'.$this->global_mod->db_parse($this->lang->line("to_dwnld_smpl_file"))
                        .'</div>
                        <div  style="text-align:center;">
                            <input type="file" name="csv_name">
                            <input type="submit" name="upload" value="Upload"/> 
                        </div>                        
                   </form>';
        }
        $send_mail = isset($_REQUEST['send_mail'])?$_REQUEST['send_mail']:'';
        if(!empty($send_mail) && $send_mail=='Send Mail' )
        {
            foreach($_REQUEST['cus_chkbox_csv'] as $value)
            {
                $csv_hdn_id =isset($_REQUEST['csv_hdn_id'.$value])?$_REQUEST['csv_hdn_id'.$value]:'';
                $html =$this->email_mktg_model->sendMailCsv($csv_hdn_id);
            }
            echo '<div style="text-align:center;">'.$this->global_mod->db_parse($this->lang->line("succ_mail_send")).'</div>';
        } 
        $upload = isset($_REQUEST['upload'])?$_REQUEST['upload']:'';
        if(!empty($upload) && $upload=='Upload' )
        {
            $filename= $_FILES["csv_name"]["name"];
            $path= $_SERVER['DOCUMENT_ROOT']."/csvUpload/";
            $check = explode(".",$filename);
            $e=@$check[1];
            $new_filename=$path.time().$filename;
            if($e=="csv")
            {
                move_uploaded_file($_FILES["csv_name"]["tmp_name"],$new_filename);
                $row = 1;
                $html='<form action="'.site_url('admin/email_mktg/uploadAjax').'" method="post">
                     <input type="submit" name="send_mail"  value="Send Mail">
                    <table class="cus-listing-tabl-csv" width="100%">';
                if (($handle = fopen($new_filename, "r")) !== FALSE) 
                {                    
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                    {
                        $html.='<tr>';
                        $num = count($data);
                        $html.='<td><input type="checkbox" id="cus_chkbox_csv" 
                                class="user_chk_cls_csv"  name="cus_chkbox_csv[]" value="'.$row.'"></td>';
                        for ($c=0; $c < $num; $c++) 
                        {                           
                            $html.='<td>'.$data[$c] . '</td>';
                            if($c ==2)
                            {
                                $html.='<input  type="hidden" id="csv_hdn_id'.$row.'" name="csv_hdn_id'.$row.'" value="'.$data[$c].'"';
                            }
                        }
                        $html.='</tr>';
                        $row++;
                    }
                    fclose($handle);
                }
                $html.='</table><form>';
                echo  $html;
            }
             else 
            {
               echo $this->global_mod->db_parse($this->lang->line("file_is_nt_in_crrct_frmt"));
            }  
       }     
    }
    function csvDownload()
    {
        //ob_end_flush();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=sample.csv");
        header("Content-Transfer-Encoding: binary");
        $cr = "\n";
        $data1= "FirstName".','."LastName".','."Email".$cr;
        $data1.= "test".','."test".','."test@mail.com";        
        echo trim($data1);
        
    }
    function sendMailCsvAjax()
    {
        $json_cuss_arr                           =$this->input->post('json_cuss_arr');
        $tmplt_subject                           =$this->input->post('tmplt_subject');
        $cuss_arr                                =json_decode($json_cuss_arr );  
        $html					 =$this->email_mktg_model->sendMailCsv($cuss_arr,$tmplt_subject);
        echo $html;
    }
    function saveSubjectAjax()
    {
        $tmplt_subject                           =$this->input->post('tmplt_subject');
        $html					 =$this->email_mktg_model->saveSubject($tmplt_subject);
    }
    public function display_customer() 
    {
        $this->load->database();   	
        $registration_start_date=isset($_REQUEST['regstdate'])?$_REQUEST['regstdate']:'';
        $registration_end_date=isset($_REQUEST['regenddate'])?$_REQUEST['regenddate']:'';
        $customer_tag=isset($_REQUEST['tag'])?$_REQUEST['tag']:'';
        $customer_status=isset($_REQUEST['status'])?$_REQUEST['status']:'';
        $cus_rtn=$this->email_mktg_model->check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status);
        echo $cus_rtn;	
    }
    
    public function statusAjax()
    {
        $tmplt_subject                           =$this->input->post('tmplt_subject');
        $html					 =$this->email_mktg_model->customerStatus();
        echo $html;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////
    
   public function saveCategory(){
   		$category_name = trim($this->input->post('category_name'));
   		echo $return = $this->email_mktg_model->SaveCategory($category_name);
   		
   }
   
   public function SaveAsNewTemplate(){
   		$CategoryId = $this->input->post('CategoryId');
   		$Subject = $this->input->post('Subject');
   		$Body = $this->input->post('Body');
   		
   		echo $return = $this->email_mktg_model->SaveAsNewTemplate($CategoryId,$Subject,$Body);
   }
   
   public function previewtemplateview(){
   		$tmplt_id = $this->input->post('tmplt_id');
   		$return ='<img height="50px" src="http://bookient.com/images/back_button.png" style="cursor: pointer;" onclick="select_template('.$tmplt_id.')">';
   		$return .= $this->email_mktg_model->PreviewBodyContent($tmplt_id);
   		echo $return;
   }
   
   function getvaluebysendvalue(){
   		
   		$this->email_mktg_model->getvaluebySendvalue();
   }
   
   function searchBycustomerName(){
   		$this->load->model('admin/calender_model');
   		$searchkey = $_REQUEST['searchkey'];
   		$return = $this->calender_model->customerLocalSearch($searchkey);
   		
   		if(count($return)>0){
			$str = '';
			$str .= '<li><b>Customer List :</b></li><li><div style="width:100%;height:100px;overflow-x:hidden;overflow-y:scroll;"><ul>';
			foreach($return as $val){
				
				$str .= '<li><table width="100%"><tr><td width="15%" valign="center" align="right"><input type="checkbox" name="searchCustomersendmaillist[]" class="checked" value="'.$val['user_email'].'"  /></td><td align="left" width="35%">'.$val['cus_fname'].' '.$val['cus_lname'].'</td><td align="left" width="50%">'.$val['user_email'].'</td></tr></table></li>';
			}
			$str .= '</ul></div></li>';
			$str .= '<li>&nbsp</li>';
			$str .= '<li style="float:right;"><input type="button" name="sendMailtoselectedCustomer" id="sendMailtoselectedCustomer" value="Send mail to selected Customer" onclick="sendMailtoselectedCustomer()" /></li>';
			$str .= '<br>';
			echo $str;
		}
   }
   
   function sendmailTobycusgroup(){
   		$tmplt_id = $this->input->post('tmplt_id');
   		$cusGroup = $this->input->post('cusGroup');
   		
   		$html = $this->email_mktg_model->GetMailContent($tmplt_id);
        $mail_subject = $html->app_emlmrktn_tem_subject;
        $mail_body = $html->app_emlmrktn_tem_content;
        $from = $this->session->userdata('ladmin_email');
       	
       	if($cusGroup != ''){
			$Arr = $this->email_mktg_model->getCuslistBygroup($cusGroup);
			
			foreach($Arr as $val){
				$this->Email_model->PromotionalMail($mail_subject, $mail_body,$val['user_email'],$from);
			}
			echo 1;
			
		}else{
			echo 0;
		}
		
   }
    
    
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */