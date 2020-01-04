<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Alert_report extends Pardco
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        //$this->load->helper('text');
        $this->load->model('admin/alert_report_model');
        $this->load-> library('pdf/mpdf');
        /*===================LogIn Security Check===================*/
      /*  $logged_in_Status = $this->session->userdata('logged_in');
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
            $this->lang->load('admin_alert_report',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_alert_report',$setLanguage);
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
		
		
		$data['business_arr']= $this->alert_report_model->getBusiness();		
		
        $this->load->view('admin/nevigation',$data);
            
        $this->load->view('admin/alert_report/alert_report',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    public function getSms(){
    	$date_from 	= date("Y-m-d",strtotime($this->input->post('date_from')));
       	$date_to 	= date("Y-m-d",strtotime($this->input->post('date_to')));
        $return = $this->alert_report_model->getSms();
        $str ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->global_mod->db_parse($this->lang->line("headign-main")).' ::  '.$this->global_mod->db_parse($this->lang->line("details_report_from")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_from'])).' '.$this->global_mod->db_parse($this->lang->line("to_sml")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
        
        $str .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
        		 <tbody>
        		 	<tr>
        		 		<th align="left" width="10%">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
        		 		<th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("cron_jb_code")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("customer_name")).'</th>
		                <th align="left" width="10%">'.$this->global_mod->db_parse($this->lang->line("alert")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("customer_mobile")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("customer_email")).'</th>
		            </tr>    
        		 
        		';
        $i = 1;	
        
        if(isset($return) && !empty($return)){
        	$url = site_url();
        	$local_admin_id = $this->session->userdata('local_admin_id');
        	$date_from 	= date("Y-m-d",strtotime($this->input->post('date_from')));
       		$date_to 	= date("Y-m-d",strtotime($this->input->post('date_to')));
       		$phone_no = $this->input->post('phone_no');
       		$sent_to = $this->input->post('sent_to');
        	$str .= '<div>
			               <div class="print">
				               <a href="'.site_url('admin/alert_report/getAlertPrint?local_admin_id='.$local_admin_id.'&phone_no='.$phone_no.'&date_from='.$date_from.'&date_to='.$date_to.'&sent_to='.$sent_to).'">
				               <img src="/images/print.png">
				               '.$this->global_mod->db_parse($this->lang->line("print_page")).'
				               </a>
				               <a href="'.site_url('admin/alert_report/getSmsExcel?local_admin_id='.$local_admin_id.'&date_from='.$date_from.'&date_to='.$date_to.'&sent_to='.$sent_to.'&phone_no='.$phone_no).'">
				               <img src="/images/export_excel.png">
				               '.$this->global_mod->db_parse($this->lang->line("export_to_excl")).'
				               </a>
			               </div>
		           </div>';
        	
        	
	        foreach($return as $data){
	        	
	        	$alert = $data['cron_alert_type'] == 1 ? 'SMS' : 'Mail';
				$str .= '<tr>
	        		 		<td align="left" width="10%">'.$i.'</td>
	        		 		<td align="left" width="20%">'.$data['cron_job_code'].'</td>
			                <td align="left" width="20%">'.$data['cron_customer_name'].'</td>
			                <td align="left" width="10%">'.$alert.'</td>
			                <td align="left" width="20%">'.$data['cron_customer_mobile'].'</td>
			                <td align="left" width="20%">'.$data['cron_customer_email'].'</td>
			            </tr>';	
			    
			    $i++;        
				
			}
		}else{
			$str .= '<tr><td colspan="6" align="center" style="font-weight:bold;">'.$this->global_mod->db_parse($this->lang->line('no_data_found')).'</td></tr>';
		}	
        
        $str .= '</tbody></table>';
        echo $str;
     
    }
    public function getAlertPrint(){
        $_POST=$_GET;
       
		$arrData = $this->alert_report_model->getSms();
		
            $str = '';
            ob_clean();
            $mpdf = new mPDF('','A4-L','','',10,10,10,10,6,3);
			//$mpdf=new mPDF();
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $str ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->global_mod->db_parse($this->lang->line("headign-main")).' ::  '.$this->global_mod->db_parse($this->lang->line("details_report_from")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_from'])).' '.$this->global_mod->db_parse($this->lang->line("to_sml")).' '.DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
         
            $str .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
            		<thead>
		            <tr>
		                <th align="left" width="5%">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
		              
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("cron_jb_code")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("customer_name")).'</th>
		                <th align="left" width="5%">'.$this->global_mod->db_parse($this->lang->line("Alert")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("send_to")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("phone_no")).'</th>
		                <th align="left" width="10%">'.'Send Date'.'</th>
		                
		            </tr>';
           
            foreach($arrData as $result)
            { 
                #################################################################
           // $str .= '<tr><td>'.$count.' '.$result['cron_job_code'].' '.$result['cron_customer_name'].' '.$result["cron_alert_type"].' '.$result["cron_customer_email"].' '.$result["cron_customer_mobile"].'<br>'.'</td></tr>';
               $str .= '<tr>
		                    <td align="left"  width="5%">'.$count.'</td>
		                    <td align="left"  width="20%">'.$result['cron_job_code'].'</td>
		                    <td align="left"  width="20%">'.$result['cron_customer_name'].'</td>
		                    <td align="left"  width="5%">'.$alert = $result["cron_alert_type"] == 1 ? "SMS" : "Mail".'</td>
		                    <td align="left"  width="20%">'.$result["cron_customer_email"].'</td>
		                    <td align="left"  width="20%">'.$result["cron_customer_mobile"].'</td>
		                    <td align="left"  width="10%">'.date("j F, Y", STRTOTIME($result["cron_executed_datetime"])).'</td>
		               </tr>';
               // $num = $count%12;
               // if($num == 0){
                  //  $mpdf->AddPage();  
               //     $mpdf->WriteHTML($head);
              //  }
                $count=$count +1;
               // $str .= iconv('ISO-8859-1', 'UTF-8//IGNORE', $str);
              //  $mpdf->WriteHTML($html);
               // $html = '';   
            }
            $str .= '</thead></table>';
        	$str .= iconv('ISO-8859-1', 'UTF-8//IGNORE', $str);
        	$mpdf->WriteHTML(' ');
            $mpdf->WriteHTML($str);
            $mpdf->Output('alert_report_detail_view.pdf', 'D');  
            
         
            exit;     
    }
	public function getSmsExcel(){
	
		ob_clean();
        $_POST=$_GET;
       $arrData =  $this->alert_report_model->getSms();
		
        $filename = 'alert_report_detail_view.xls';
        $xls = new ExportXLS($filename);
        $header[] = "Sl. No.";
        $header[] = "Corn Job Code";
        $header[] = "Alert";
        $header[] = $this->global_mod->db_parse($this->lang->line("send_to"));
        $header[] = $this->global_mod->db_parse($this->lang->line("phone_no"));
        $header[] = "Send Date";
		
        $xls->addHeader($header);
        $counter = 1; 
        foreach($arrData as $result){
           
           $alert = $result["cron_alert_type"] == 1 ? "SMS" : "Mail";
            $row = array();
            $row[] = $counter;
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["cron_job_code"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $alert);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["cron_customer_email"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $result["cron_customer_mobile"]);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', DATE("j F, Y g:i a", STRTOTIME($result["cron_executed_datetime"])));
            $xls->addRow($row);
            $counter++;
        }
		$xls->sendFile();
		
	}										  	
}
?>