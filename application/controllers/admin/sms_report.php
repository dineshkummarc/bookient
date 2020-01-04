<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sms_report extends Pardco
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        //$this->load->helper('text');
        $this->load->model('admin/sms_report_model');
        $this->load-> library('pdf/mpdf');
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
            $this->lang->load('admin_sms_report',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_sms_report',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
    }
    public function index(){
	
	    
        //$this->lang->load('admin_appointment_report');
        $this->load->model('admin/service_model');
        $data['service_list'] = $this->service_model->get_service();
        $this->load->model('admin/staff_model');
        $data['staff_list'] = $this->staff_model->get_all_staff();
        $this->load->library('form_validation');
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
		
		
		$data['business_arr']= $this->sms_report_model->getBusiness();		
		
        $this->load->view('admin/nevigation',$data);
            
        $this->load->view('admin/sms_report/sms_report',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    public function getSms(){
    	
        echo $this->sms_report_model->getSms();
    }
    public function getSmsPrint(){
        $html = '';
        $_POST=$_GET;
        $this->sms_report_model->getSms();
		$arrData = $this->sms_report_model->_resultArr;
     
            $html = '';
            $mpdf=new mPDF('','A4-L','','',10,10,10,10,6,3);
			//$mpdf=new mPDF();
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->global_mod->db_parse($this->lang->line("headign-main")).' ::  '.$this->global_mod->db_parse($this->lang->line("details_report_from")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_from'])).' '.$this->global_mod->db_parse($this->lang->line("to_sml")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $top = iconv('ISO-8859-1', 'UTF-8//IGNORE', $top);
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" cellpadding="0" border="0">
		            <tr>
		                <th align="left" width="5%">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("Business")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("send_to")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("phone_no")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("message")).'</th>
		                <th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("sms_date")).'</th>
						<th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("message_type")).'</th>
		                <th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("event")).'</th>
		            </tr></table>';
            ################################################################
            $head = iconv('ISO-8859-1', 'UTF-8//IGNORE', $head);
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $result)
            {               
                #################################################################
                $html .= '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                          <tr>
		                    <td align="left"  width="5%">'.$count.'</td>
		                    <td align="left"  width="15%">'.$this->sms_report_model->getLocaAdminName($result["local_admin_id"]).'</td>
		                    <td align="left"  width="15%">'.$result["sent_to"].'</td>
		                    <td align="left"  width="15%">'.$result["phone_no"].'</td>
		                    <td align="left"  width="20%">'.$result["message"].'</td>
		                    <!--td align="left"  width="10%">'.DATE("j F, Y g:i a", STRTOTIME($result["msg_sent_date_time"])).'</td-->
		                    <td align="left"  width="10%">'.date("j F, Y", STRTOTIME($result["msg_sent_date_time"])).'</td>
							<td align="left"  width="10%" >'.$this->sms_report_model->getMsgType($result["message_type"]).'</td>
		                    <td align="left"  width="10%">'.$this->sms_report_model->GetEventType($result["event"]).'</td>
		                	</tr></table>';
             /*   $num = $count%12;
                if($num == 0){
                    $mpdf->AddPage();
                    $head = iconv('ISO-8859-1', 'UTF-8//IGNORE', $head);
                    $mpdf->WriteHTML($head);
                }*/
                $count=$count +1;
                $html = iconv('ISO-8859-1', 'UTF-8//IGNORE', $html);
                $mpdf->WriteHTML($html);
                $html = '';
            }
            $html = iconv('ISO-8859-1', 'UTF-8//IGNORE', $html);
            $mpdf->WriteHTML($html);
            $mpdf->Output('appointment_report_detail_view.pdf', 'D');
            exit;       
    }
	public function getSmsExcel(){
	
		ob_clean();
        $_POST=$_GET;
        $this->sms_report_model->getSms();
		$arrData = $this->sms_report_model->_resultArr;
         $filename = 'sms_report_detail_view.xls';
        $xls = new ExportXLS($filename);
        $header[] = $this->lang->line('sl_no');
        $header[] = $this->lang->line('business');
        $header[] = $this->lang->line('send_to');
        $header[] = $this->lang->line('phone_no');
        $header[] = $this->lang->line('message');
        $header[] = $this->lang->line('sms_date');
		$header[] = $this->lang->line('message_type');
        $header[] = $this->lang->line('event');
        $xls->addHeader($header);
        $counter = 1; 
        foreach($arrData as $result){
           
            $row = array();
            $row[] = $counter;
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $this->sms_report_model->getLocaAdminName($result["local_admin_id"]));
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["sent_to"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["phone_no"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["message"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', DATE("j F, Y g:i a", STRTOTIME($result["msg_sent_date_time"])));
			$row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $this->sms_report_model->getMsgType($result["message_type"]));
			$row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $this->sms_report_model->GetEventType($result["event"]));
            $xls->addRow($row);
            $counter++;
        }
		$xls->sendFile();
		
	}										  	
}
?>