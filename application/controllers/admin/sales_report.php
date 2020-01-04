<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales_Report extends Pardco
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/sales_model');
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
            $this->lang->load('admin_sales_report',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_sales_report',$setLanguage);
        }
		/*########End Language#######*/
		
    }
    public function index()
    {
        
		
		//$this->lang->load('admin_sales_report');
        $this->load->model('admin/service_model');
        $data['service_list'] = $this->service_model->get_service();
        $data['currency_list'] = $this->sales_model->get_currency();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->model('admin/staff_model');
        $data['staff_list'] = $this->staff_model->get_all_staff();
        $this->load->library('form_validation');
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $this->load->view('admin/nevigation',$data);

        $data['date'] = date("m/d/Y");
        $this->load->view('admin/sales_report/sales_report',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    public function getReportsAjax()
    {
        echo $this->sales_model->GetReports();
    }
    public function getReportPrint()
    {
        $html = '';
        $_POST=$_GET;
        $this->sales_model->GetReports();
        $arrData = $this->sales_model->_resultArr;
        $currency_type = $_POST['currency_type'];
        #############################################
        $curArr = $this->sales_model->getCurrencysymbol($currency_type);
        $currency_abbriviation = $curArr[0]['currency_abbriviation'];
        #############################################
        if($_POST['display_type'] == 1)//Detail Reports
        {
            $mpdf=new mPDF('','A4-L','','',10,10,10,10,6,3);
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $cnt = 1;
            $Booking_id='';
            $cus_id='';
            $total_cost = 0;
            $gr_total = 0;
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("sales_report").'::'.$this->lang->line("detail_report_from").date("dS F, Y", strtotime($_POST['date_from'])).$this->lang->line("to").date("dS F, Y", strtotime($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                        <th align="left" width="5%">'.$this->lang->line("sl_no").'</th>
                        <th align="left" width="25%">'.$this->lang->line("who_booked").'</th>
                        <th align="left" width="15%">'.$this->lang->line("service").'</th>
                        <th align="left" width="15%">'.$this->lang->line("staff").'</th>
                        <th align="left" width="15%">'.$this->lang->line("appointment_date").'</th>
                        <th align="right" width="10%">'.$this->lang->line("amount").'('.$currency_abbriviation.')</th>
                        <th  width="5%"> </th>
                        <th align="left" width="10%">'.$this->lang->line("info").'</th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $val)
            {
                $cnt = 0;
                $user_email 	= $val['user_email'];
                $cus_fname 		= $this->global_mod->show_to_control($val['cus_fname']);
                $cus_lname 		= $this->global_mod->show_to_control($val['cus_lname']);
                $cus_mob 		= $val['cus_mob'];
                $cus_phn1 		= $val['cus_phn1'];
                $cus_phn2 		= $val['cus_phn2'];
                $cus_address 	= $this->global_mod->show_to_control($val['cus_address']);
                $city_name 		= $this->global_mod->show_to_control($val['city_name']);
                $region_name 	= $this->global_mod->show_to_control($val['region_name']);
                $country_name 	= $this->global_mod->show_to_control($val['country_name']);
                $cus_zip 		= $val['cus_zip'];
                $who_booked 	= $cus_fname." ".$cus_lname."<br>".$user_email."<br>".$this->lang->line("booked_on").$val['booking_date_time'];
                #################################################################
                if($val['srvDtls_service_duration_unit'] == "M")
                    $service = $this->global_mod->show_to_control($val['srvDtls_service_name'])."<br>".$val['srvDtls_service_duration'].$this->lang->line("mins");
                else
                    $service = $this->global_mod->show_to_control($val['srvDtls_service_name']).'<br>'.$val['srvDtls_service_duration'].$this->lang->line("hrs");
                #################################################################
                if($val["srvDtls_booking_status"] == 1)
                    $status = $this->lang->line("approved");
                else
                    $status = $this->lang->line("unapproved");
                #################################################################
                $html .= '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                         <tr>';
                if($Booking_id !=$val["booking_id"] )
                {
                    $html .= '<td align="left" width="5%" valign="top">'.$count.'</td>';
                    $count=$count +1;
                    $cnt++;
                    if($Booking_id !=$val['booking_id'] || $cus_id !=$val['customer_id']){
                        $html .= '<td align="left" width="25%" valign="top">'.$who_booked.'</td>';
                        $cus_id=$val['customer_id'];		
                    }else{
                        $html .= '<td></td>';	
                    }
                    $Booking_id	=$val['booking_id'];
                }else{
                    $html .= '<td></td>';
                    $html .= '<td></td>';
                }
                $html .= '  <td align="left" width="15%" valign="top">'.$service.'</td>
                            <td align="left" width="15%" valign="top">'.$this->global_mod->show_to_control($val['srvDtls_employee_name']).'</td>
                            <td align="left" width="15%" valign="top">'.date("j F, Y g:i a", strtotime($val['srvDtls_service_start'])).'</td>
                            <td align="right" width="10%" valign="top">'.$val['srvDtls_service_cost'].'</td>
                            <th  width="5%"> </th>    
                            <td align="left" width="10%" valign="top">'.$status.'</td>
                          </tr></table>';
                $mpdf->WriteHTML($html);
                $html = '';
                
                $total_cost = $total_cost + $val['srvDtls_service_cost'];
                $num = $count%12; 
                if($num == 0){
                    $cnt = 1;
                    $html ='<table width="100%" cellspacing="0" border="0" cellpadding="0"><tr>';
                    $html .='<td width="75%" align="right">'.$this->lang->line("total").'</td>';
                    $html .='<td width="10%" align="right">'.$currency_abbriviation.' '.$total_cost.'</td>';
                    $html .='<td width="15%" align="right"> </td>';
                    $html .='</tr></table>';
                    $mpdf->WriteHTML($html);
                    $mpdf->AddPage(); 
                    $mpdf->WriteHTML($head);
                    $gr_total += $total_cost;
                    
                    $html = '';
                    $total_cost = 0;
                }
            }
            if($cnt == 0)
            {
                $html ='<table width="100%" cellspacing="0" border="0" cellpadding="0"><tr>';
                $html .='<td width="75%" align="right">'.$this->lang->line("total").'</td>';
                $html .='<td width="10%" align="right">'.$currency_abbriviation.' '.$total_cost.'</td>';
                $html .='<td width="15%" align="right"> </td>';
                $html .='</tr></table>';
                $gr_total += $total_cost;
            }
            $html .='<table width="100%" cellspacing="0" border="0" cellpadding="0"><tr>';
            $html .='<td width="75%" align="right">'.$this->lang->line("grand_total").'</td>';
            $html .='<td width="10%" align="right">'.$currency_abbriviation.' '.$gr_total.'</td>';
            $html .='<td width="15%" align="right"> </td>';
            $html .='</tr></table>';
            
            $mpdf->WriteHTML($html);
            $mpdf->Output('sales_report_detail_view.pdf', 'D');
            exit;
        }
        elseif($_POST['display_type'] == 2)//Group by date
        {
            $mpdf=new mPDF(); //narrow margin
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $gr_app = 0;
            $gr_total = 0;
            $total =0;
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("sales_report").'::'.$this->lang->line("group_by_date_from").DATE("dS F, Y", STRTOTIME($_POST['date_from'])).$this->lang->line("to").DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                        <th align="center" width="8%">'.$this->lang->line("sl_no").'</th>
                        <th align="center" width="22%">'.$this->lang->line("date").'</th>
                        <th align="center" width="22%">'.$this->lang->line("appointments").'</th>
                        <th align="center" width="22%">'.$this->lang->line("users").'</th>
                        <th align="right" width="22%">'.$this->lang->line("amount").'('.$currency_abbriviation.')</th>
                        <th width="4%"></th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $rows)
            {
                $cnt = 0;
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                            <td align="center" width="8%">'.$count.'</td>
                            <td align="center" width="22%">'.date("j F  Y", strtotime($rows["dispdate"])).'</td>
                            <td align="center" width="22%">'.$rows["appointment"].'</td>
                            <td align="center" width="22%">'.$rows["users"].'</td>
                            <td align="right" width="22%">'.$rows["cost"].'</td>    
                            <td width="4%"></td>    
                          </tr></table>';
                $mpdf->WriteHTML($html);
                $html = '';

                $total = $total + $rows["cost"];

                $num = $count%45;
                if($num == 0){
                    $cnt = 1;
                    $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                    $html .= '<tr>
                        <td colspan="3" style="line-height:10px"><hr/></td>           
                      </tr>';
                    $html .= '<tr>
                                <td align="right" width="75%">'.$this->lang->line("total").'</td>
                                <td align="right" width="21%">'.$total.'</td>
                                <td width="4%"></td>     
                              </tr>';
                    $html .= '</table>';

                    $gr_total += $total;
                    $mpdf->WriteHTML($html);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($head);
                    $total = 0;
                }
                $count=$count +1;
            }
            //$html .= '</table>';

            if($cnt == 0)
            {
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html .= '<tr>
                            <td colspan="3" style="line-height:10px"><hr/></td>           
                          </tr>';
                $html .= '<tr>
                            <td align="right" width="75%">'.$this->lang->line("total").'</td>
                            <td align="right" width="21%">'.$total.'</td>
                            <td width="4%"></td>     
                          </tr>';
                $html .= '</table>';
                $gr_total += $total;
            }
            $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html .= '<tr>
                        <td colspan="3"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="3"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td align="right" width="75%">'.$this->lang->line("grand_total").'</td>
                        <td align="right" width="21%">'.$gr_total.'</td>
                        <td width="4%"></td>     
                      </tr>';
            $html .= '</table>';
            $mpdf->WriteHTML($html);
            $mpdf->Output('sales_report_date_view.pdf', 'D');
            exit;
        }
        else//Group by month
        {
            $mpdf=new mPDF(); //narrow margin
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $gr_app = 0;
            $gr_total = 0;
            $total =0;
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("sales_report").':: Group by month from '.DATE("dS F, Y", STRTOTIME($_POST['date_from'])).' to '.DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                        <th align="center" width="8%">'.$this->lang->line("sl_no").'</th>
                        <th align="center" width="22%">'.$this->lang->line("date").'</th>
                        <th align="center" width="22%">'.$this->lang->line("appointments").'</th>
                        <th align="center" width="22%">'.$this->lang->line("users").'</th>
                        <th align="right" width="22%">'.$this->lang->line("amount").'('.$currency_abbriviation.')</th>
                        <th width="4%"></th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $rows)
            {
                $cnt = 0;
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                            <td align="center" width="8%">'.$count.'</td>
                            <td align="center" width="22%">'.date("F  Y", strtotime("01-".$rows["dispdate"])).'</td>
                            <td align="center" width="22%">'.$rows["appointment"].'</td>
                            <td align="center" width="22%">'.$rows["users"].'</td>
                            <td align="right" width="22%">'.$rows["cost"].'</td>    
                            <td width="4%"></td>    
                          </tr></table>';
                $mpdf->WriteHTML($html);
                $html = '';

                $total = $total + $rows["cost"];

                $num = $count%45;
                if($num == 0){
                    $cnt = 1;
                    $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                    $html .= '<tr>
                        <td colspan="3" style="line-height:10px"><hr/></td>           
                      </tr>';
                    $html .= '<tr>
                                <td align="right" width="75%">'.$this->lang->line("total").'</td>
                                <td align="right" width="21%">'.$total.'</td>
                                <td width="4%"></td>     
                              </tr>';
                    $html .= '</table>';

                    $gr_total += $total;
                    $mpdf->WriteHTML($html);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($head);
                    $total = 0;
                }
                $count=$count +1;
            }
            //$html .= '</table>';

            if($cnt == 0)
            {
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html .= '<tr>
                            <td colspan="3" style="line-height:10px"><hr/></td>           
                          </tr>';
                $html .= '<tr>
                            <td align="right" width="75%">'.$this->lang->line("total").'</td>
                            <td align="right" width="21%">'.$total.'</td>
                            <td width="4%"></td>     
                          </tr>';
                $html .= '</table>';
                $gr_total += $total;
            }
            $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html .= '<tr>
                        <td colspan="3"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="3"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td align="right" width="75%">'.$this->lang->line("grand_total").'</td>
                        <td align="right" width="21%">'.$gr_total.'</td>
                        <td width="4%"></td>     
                      </tr>';
            $html .= '</table>';
            $mpdf->WriteHTML($html);
            $mpdf->Output('sales_report_month_view.pdf', 'D');
            exit;
        }
    }
    public function export_excel_csv()
    {
        ob_clean();
        $_POST=$_GET;
        $this->sales_model->GetReports();
        $arrData = $this->sales_model->_resultArr;
        $currency_type = $_POST['currency_type'];
        #############################################
        $curArr = $this->sales_model->getCurrencysymbol($currency_type);
        $currency_abbriviation = $curArr[0]['currency_abbriviation'];
        #############################################
        if($_POST['display_type'] == 1)//Detail Reports
        {
            $filename = 'sales_report_detail_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->lang->line("sl_no");
            $header[] = $this->lang->line("who_booked");
            $header[] = $this->lang->line("service");
            $header[] = $this->lang->line("staff");
            $header[] = $this->lang->line("appointment_date");
            $header[] = $this->lang->line("amount")."(".$currency_abbriviation.")";
            $header[] = $this->lang->line("info");
            $xls->addHeader($header);
            $counter = 1;
            $Booking_id='';
            $cus_id='';
            $total_cost = 0;
            foreach($arrData as $val)
            {
                $user_email 	= $val['user_email'];
                $cus_fname 		= $this->global_mod->show_to_control($val['cus_fname']);
                $cus_lname 		= $this->global_mod->show_to_control($val['cus_lname']);
                $cus_mob 		= $val['cus_mob'];
                $cus_phn1 		= $val['cus_phn1'];
                $cus_phn2 		= $val['cus_phn2'];
                $cus_address 	= $this->global_mod->show_to_control($val['cus_address']);
                $city_name 		= $this->global_mod->show_to_control($val['city_name']);
                $region_name 	= $this->global_mod->show_to_control($val['region_name']);
                $country_name 	= $this->global_mod->show_to_control($val['country_name']);
                $cus_zip 		= $val['cus_zip'];
                $who_booked 	= $cus_fname." ".$cus_lname."\n".$user_email."\n".$this->lang->line("booked_on").$val['booking_date_time'];
                #################################################################
                if($val['srvDtls_service_duration_unit'] == "M")
                    $service = $this->global_mod->show_to_control($val['srvDtls_service_name'])."\n".$val['srvDtls_service_duration'].$this->lang->line("mins");
                else
                    $service = $this->global_mod->show_to_control($val['srvDtls_service_name']).'\n'.$val['srvDtls_service_duration'].$this->lang->line("hrs");
                #################################################################
                if($val["srvDtls_booking_status"] == 1)
                    $status = $this->lang->line("approved");
                else
                    $status = $this->lang->line("unapproved");
                #################################################################
                $row = array();
                if($Booking_id != $val["booking_id"] )
                {
                    $row[] = $counter;
                    $counter++;
                    if($Booking_id != $val['booking_id'] || $cus_id != $val['customer_id']){
                        $row[] = $who_booked;
                        $cus_id = $val['customer_id'];		
                    }else{
                        $row[] = ' ';	
                    }
                    $Booking_id	= $val['booking_id'];	
                }else{
                    $row[] = ' ';	
                    $row[] = ' ';	
                }
                $row[] = $service;
                $row[] = $val['srvDtls_employee_name'];
                $row[] = date("j F, Y g:i a", strtotime($val['srvDtls_service_start']));
                $row[] = $val['srvDtls_service_cost'];
                $row[] = $status;
                $xls->addRow($row);
                $total_cost = $total_cost + $val['srvDtls_service_cost'];
            }
            $row = array();
            $row[] = ' ';
            $row[] = ' ';
            $row[] = ' ';
            $row[] = ' ';
            $row[] = $this->lang->line("total");
            $row[] = $currency_abbriviation." ".$total_cost."\n";
            $row[] = ' ';
            $xls->addRow($row);
        }
        elseif($_POST['display_type'] == 2)//Group by date
        {
            $filename = 'sales_report_date_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->lang->line("sl_no");
            $header[] = $this->lang->line("date");
            $header[] = $this->lang->line("appointments");
            $header[] = $this->lang->line("users");
            $header[] = $this->lang->line("amount")."(".$currency_abbriviation.")";
            $xls->addHeader($header);
            $counter = 1;
            $appointment=0;
            $users=0;
            $total_cost = 0;
            foreach($arrData as $val)
            {
                $row = array();
                $row[] = $counter;
                $row[] = date("j F  Y", strtotime($val['dispdate']));
                $row[] = $val['appointment'];
                $row[] = $val['users'];
                $row[] = $val['cost'];
                $xls->addRow($row);
                $counter++;
                $appointment= $appointment + $val['appointment'];
                $users= $users + $val['users'];
                $total_cost = $total_cost + $val['cost'];
            }
            $row = array();
            $row[] = " ";
            $row[] = " ";
            $row[] = " ";
            $row[] = $this->lang->line("total");
            $row[] = $currency_abbriviation." ".$total_cost."\n";
            $xls->addRow($row);
        }
        else//Group by month
        {
            $filename = 'sales_report_month_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->lang->line("sl_no");
            $header[] = $this->lang->line("date");
            $header[] = $this->lang->line("appointments");
            $header[] = $this->lang->line("users");
            $header[] = $this->lang->line("amount")."(".$currency_abbriviation.")";
            $xls->addHeader($header);
            $counter = 1;
            $appointment=0;
            $users=0;
            $total_cost = 0;
            foreach($arrData as $val)
            {
                $row = array();
                $row[] = $counter;
                $row[] = date("j F  Y", strtotime("01-".$val['dispdate']));
                $row[] = $val['appointment'];
                $row[] = $val['users'];
                $row[] = $val['cost'];
                $xls->addRow($row);
                $counter++;
                $appointment= $appointment + $val['appointment'];
                $users= $users + $val['users'];
                $total_cost = $total_cost + $val['cost'];
            }
            $row = array();
            $row[] = " ";
            $row[] = " ";
            $row[] = " ";
            $row[] = $this->lang->line("total");
            $row[] = $currency_abbriviation." ".$total_cost."\n";
            $xls->addRow($row);
        }
        $xls->sendFile();
    }
}
?>