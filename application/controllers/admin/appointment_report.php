<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Appointment_Report extends Pardco
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        //$this->load->helper('text');
        $this->load->model('admin/report_model');
        $this->load->model('admin/calender_model');
        $this->load->model('email_model');
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
            $this->lang->load('admin_appointment_report',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_appointment_report',$setLanguage);
        }
		/*########End Language#######*/
		
		
    }
    public function index(){
	
     //   $this->lang->load('admin_appointment_report');
        $this->load->model('admin/service_model');
        $data['service_list'] = $this->service_model->get_service();
        $this->load->model('admin/staff_model');
        $data['staff_list'] = $this->staff_model->get_all_staff();
        $this->load->library('form_validation');
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);
            
        $this->load->view('admin/report/report',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    public function getAppointments(){
        echo $this->report_model->GetAppointments();
    }
    public function Ask_ReviewAjax(){
      
       
       $srvDtls_id = $this->input->post('b_s_id');
     //  $CustomerId = $this->input->post('cus_id');
       
       $bookingDetails = $this->calender_model->getBookingDetailsServiceWise($srvDtls_id);
       
       
       
            /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
            #############################################
            $customer_id = $bookingDetails[0]['customer_id'];
            $service_id = $bookingDetails[0]['srvDtls_service_id'];
            $employee_id = $bookingDetails[0]['srvDtls_employee_id'];
            $host=$_SERVER['HTTP_HOST'];
            $local_admin_id = $this->session->userdata('local_admin_id');
            $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$customer_id.'/'.$service_id.'/'.$employee_id.'/'.$srvDtls_id;
            
            $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
            
            $this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
       
       $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $bookingDetails[0]['cus_fname'],
								'{lname}' 					=> $bookingDetails[0]['cus_lname'],
								'{appointmentStartDate}'	=> $bookingDetails[0]['srvDtls_service_start'],
								'{businessemail}' 			=> $this->session->userdata('ladmin_email'),
								'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
								'{businessaddress}' 		=> $busi_address,
								'{cancellationpolicy}' 		=> nl2br($cancellationpolicy),
								'{clickurl}' 				=> $link
								
								);
            #############################################
            
            $customer_email = $bookingDetails[0]['user_email'];
            $admin_email = $this->session->userdata('ladmin_email');
         	
            $mail = $this->email_model->sentMail(9, $replacerArr, $customer_email,$admin_email);
       		echo "An Email has been sent to the Customer for Review";
       
       
    }	
    public function getAppointmentsPrint(){
        $html = '';
        $_POST=$_GET;
        $this->report_model->GetAppointments();
        $arrData = $this->report_model->_resultArr;
        if($_POST['display_type'] == 1)//Detail Reports
        {
            $html = '';
            $mpdf=new mPDF('','A4-L','','',10,10,10,10,6,3);
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $type = ($_POST['appointment_type'] == 1)?$this->lang->line("service_date_wise"):$this->lang->line("booking_date_wise");
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("appointment_report").' :: '.$type.$this->lang->line("detail_report_from").DATE("dS F, Y", STRTOTIME($_POST['date_from'])).$this->lang->line("to").DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                        <th align="left" width="5%">'.$this->lang->line("sl_no").'</th>
                        <th align="left" width="25%">'.$this->lang->line("who_booked").'</th>
                        <th align="left" width="25%">'.$this->lang->line("contact_info").'</th>
                        <th align="left" width="10%">'.$this->lang->line("service").'</th>
                        <th align="left" width="10%">'.$this->lang->line("staff").'</th>
                        <th align="left" width="15%">'.$this->lang->line("appointment_date").'</th>
                        <th align="left" width="10%">'.$this->lang->line("status").'</th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $val)
            {
                //$custArr = $this->report_model->getCustomerInformation($val['customer_id']);						  
                $user_email 	= $val['user_email'];
                $cus_fname 	    = $val['cus_fname'];
                $cus_lname 	    = $val['cus_lname'];
                $cus_mob 	    = $val['cus_mob'];
                $cus_phn1 	    = $val['cus_phn1'];
                $cus_phn2 	    = $val['cus_phn2'];
                $cus_address 	= $val['cus_address'];
                $city_name 	    = $val['city_name'];
                $region_name 	= $val['region_name'];
                $country_name 	= $val['country_name'];
                $cus_zip 	    = $val['cus_zip'];
                $who_booked     = $cus_fname." ".$cus_lname."\n".$user_email."\n".$this->lang->line("booked_on").$val['booking_date_time'];
                #################################################################
                if($val['srvDtls_service_duration_unit'] == "M")
                    $service = $val['srvDtls_service_name']."\n".$val['srvDtls_service_duration'].$this->lang->line("mins");
                else
                    $service = $val['srvDtls_service_name'].'\n'.$val['srvDtls_service_duration'].$this->lang->line("hrs");
                #################################################################
                $contact_info = '';
                if($cus_address != '')
                    $contact_info .= $cus_address;
                if($city_name != '')
                    $contact_info .= "\n".$city_name;
                else
                    $contact_info .= "\n".$this->lang->line("no_city");
                if($region_name != '')
                    $contact_info .= ", ".$region_name;
                else
                    $contact_info .= ",".$this->lang->line("no_region");
                if($country_name != '')
                    $contact_info .= ", ".$country_name;
                else
                    $contact_info .= ",".$this->lang->line("no_country");
                if($cus_zip != '')
                    $contact_info .= "\n".$cus_zip;
                if($cus_mob != '')
                    $contact_info .= "\n".$cus_mob.$this->lang->line("m");
                if($cus_phn1 != '')
                    $contact_info .= "\n".$cus_phn1;
                if($cus_phn2 != '')
                    $contact_info .= "\n".$cus_phn2;
                #################################################################
                if($val["srvDtls_booking_status"] == 1)
                    $status = $this->lang->line("approved");
                elseif($val["srvDtls_booking_status"] == 0)
                    $status = $this->lang->line("unapproved");
                elseif($val["srvDtls_booking_status"] == 4)
                    $status = $this->lang->line("cancelled_by_admin");
                elseif($val["srvDtls_booking_status"] == 5)
                    $status = $this->lang->line("cancelled_by_user");
                elseif($val["srvDtls_booking_status"] == 6)
                    $status = $this->lang->line("set_status");
                elseif($val["srvDtls_booking_status"] == 7)
                    $status = $this->lang->line("as_scheduled");
                elseif($val["srvDtls_booking_status"] == 8)
                    $status = $this->global_mod->db_parse($this->lang->line("arrived_late"));
                elseif($val["srvDtls_booking_status"] == 9)
                    $status = $this->lang->line("no_show");
                elseif($val["srvDtls_booking_status"] == 10)
                    $status = $this->lang->line("gift_cerificates");
                else
                    $status = " ";
                #################################################################
                $html .= '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                         <tr>
                            <td align="left" width="5%" valign="top">'.$count.'</td>
                            <td align="left" width="25%" valign="top">'.$who_booked.'</td>
                            <td align="left" width="25%" valign="top">'.$contact_info.'</td>
                            <td align="left" width="10%" valign="top">'.$service.'</td>
                            <td align="left" width="15%" valign="top">'.$val['srvDtls_employee_name'].'</td>
                            <td align="left" width="10%" valign="top">'.date("j F, Y g:i a", strtotime($val['srvDtls_service_start'])).'</td>
                            <td align="left" width="10%" valign="top">'.$status.'</td>
                          </tr></table>';
                $num = $count%12;
                if($num == 0){
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($head);
                }
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
        elseif($_POST['display_type'] == 2)//Group by date
        {
            $mpdf=new mPDF(); //narrow margin
            $wm = base_url();
            $mpdf->SetWatermarkText($wm, 0.02);
            $mpdf->showWatermarkText = true;
            ################################################################
            $count = 1;
            $gr_app = 0;
            $gr_user = 0;
            $appointment =0;
            $type = ($_POST['appointment_type'] == 1)?$this->lang->line("service_date_wise"):$this->lang->line("booking_date_wise");
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("appointment_report").':: '.$type.$this->lang->line("group_by_date_from").DATE("dS F, Y", STRTOTIME($_POST['date_from'])).$this->lang->line("to").DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                    <th align="center" width="25%">'.$this->lang->line("sl_no").'</th>
                    <th align="center" width="25%">'.$this->lang->line("date").'</th>
                    <th align="center" width="25%">'.$this->lang->line("appointments").'</th>
                    <th align="center" width="25%">'.$this->lang->line("users").'</th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $rows)
            {
                $cnt = 0;
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                            <td align="center" width="25%">'.$count.'</td>
                            <td align="center" width="25%">'.date("F  Y", strtotime($rows["dispdate"])).'</td>
                            <td align="center" width="25%">'.$rows["appointment"].'</td>
                            <td align="center" width="25%">'.$rows["users"].'</td>
                          </tr></table>';
                $mpdf->WriteHTML($html);
                $html = '';

                $appointment = $appointment + $rows["appointment"];
                $users = $users + $rows["users"];

                $num = $count%45;
                if($num == 0){
                    $cnt = 1;
                    $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                    $html .= '<tr>
                        <td colspan="4" style="line-height:10px"><hr/></td>           
                      </tr>';
                    $html .= '<tr>
                                <td colspan="2" align="center" width="50%">'.$this->lang->line("total").'</td>
                                <td align="center" width="25%">'.$appointment.'</td>
                                <td align="center" width="25%">'.$users.'</td>
                              </tr>';
                    $html .= '</table>';

                    $gr_app += $appointment;
                    $gr_user += $users;
                    $mpdf->WriteHTML($html);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($head);
                    $appointment = 0;
                    $users = 0;
                }
                $count=$count +1;
            }
            //$html .= '</table>';

            if($cnt == 0)
            {
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html .= '<tr>
                            <td colspan="4" style="line-height:10px"><hr/></td>           
                          </tr>';
                $html .= '<tr>
                            <td colspan="2" align="center" width="50%">'.$this->lang->line("total").'</td>
                            <td align="center" width="25%">'.$appointment.'</td>
                            <td align="center" width="25%">'.$users.'</td>
                          </tr>';
                $html .= '</table>';
                 $gr_app += $appointment;
                 $gr_user += $users;
            }
            $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html .= '<tr>
                        <td colspan="4"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="4"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="2" align="center" width="50%">'.$this->lang->line("grand_total").'</td>
                        <td align="center" width="25%">'.$gr_app.'</td>
                        <td align="center" width="25%">'.$gr_user.'</td>
                      </tr>';
            $html .= '</table>';
            $mpdf->WriteHTML($html);
            $mpdf->Output('appointment_report_date_view.pdf', 'D');
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
            $gr_user = 0;
            $appointment =0;
            $type = ($_POST['appointment_type'] == 1)?$this->lang->line("service_date_wise"):$this->lang->line("booking_date_wise");
            $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("appointment_report").' :: '.$type.$this->lang->line("group_by_date_from").DATE("dS F, Y", STRTOTIME($_POST['date_from'])).$this->lang->line("to").DATE("dS F, Y", STRTOTIME($_POST['date_to'])).'</div>';
            $mpdf->WriteHTML($top);
            $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
                  <tr>
                        <th align="center" width="25%">'.$this->lang->line("sl_no").'</th>
                        <th align="center" width="25%">'.$this->lang->line("month").'</th>
                        <th align="center" width="25%">'.$this->lang->line("appointments").'</th>
                        <th align="center" width="25%">'.$this->lang->line("users").'</th>
                  </tr></table>';
            ################################################################
            $mpdf->WriteHTML($head);
            ################################################################
            foreach($arrData as $rows)
            {
                $cnt = 0;
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                            <td align="center" width="25%">'.$count.'</td>
                            <td align="center" width="25%">'.date("F  Y", strtotime("01-".$rows["dispdate"])).'</td>
                            <td align="center" width="25%">'.$rows["appointment"].'</td>
                            <td align="center" width="25%">'.$rows["users"].'</td>
                          </tr></table>';
                $mpdf->WriteHTML($html);
                $html = '';

                $appointment = $appointment + $rows["appointment"];
                $users = $users + $rows["users"];

                $num = $count%45;
                if($num == 0){
                    $cnt = 1;
                    $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                    $html .= '<tr>
                        <td colspan="4" style="line-height:10px"><hr/></td>           
                      </tr>';
                    $html .= '<tr>
                                <td colspan="2" align="center" width="50%">'.$this->lang->line("total").'</td>
                                <td align="center" width="25%">'.$appointment.'</td>
                                <td align="center" width="25%">'.$users.'</td>
                              </tr>';
                    $html .= '</table>';

                     $gr_app += $appointment;
                     $gr_user += $users;
                    $mpdf->WriteHTML($html);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($head);
                    $appointment = 0;
                    $users = 0;
                }
                $count=$count +1;
            }
            //$html .= '</table>';

            if($cnt == 0)
            {
                $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html .= '<tr>
                            <td colspan="4" style="line-height:10px"><hr/></td>           
                          </tr>';
                $html .= '<tr>
                            <td colspan="2" align="center" width="50%">'.$this->lang->line("total").'</td>
                            <td align="center" width="25%">'.$appointment.'</td>
                            <td align="center" width="25%">'.$users.'</td>
                          </tr>';
                $html .= '</table>';
                 $gr_app += $appointment;
                 $gr_user += $users;
            }
            $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html .= '<tr>
                        <td colspan="4"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="4"><hr/></td>           
                      </tr>';
            $html .= '<tr>
                        <td colspan="2" align="center" width="50%">'.$this->lang->line("grand_total").'</td>
                        <td align="center" width="25%">'.$gr_app.'</td>
                        <td align="center" width="25%">'.$gr_user.'</td>
                      </tr>';
            $html .= '</table>';
            $mpdf->WriteHTML($html);
            $mpdf->Output('appointment_report_month_view.pdf', 'D');
            exit;
        }
    }
    public function getAppointmentsExcel(){
        ob_clean();
        $_POST=$_GET;
        $this->report_model->GetAppointments();
        $arrData = $this->report_model->_resultArr;
        
        if($_POST['display_type'] == 1){//Detail Reports
            $filename = 'appointment_report_detail_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->global_mod->db_parse($this->lang->line("sl_no"));
            $header[] = $this->global_mod->db_parse($this->lang->line("who_booked"));
            $header[] = $this->global_mod->db_parse($this->lang->line("contact_info"));
            $header[] = $this->global_mod->db_parse($this->lang->line("service"));
            $header[] = $this->lang->line("staff");
            $header[] = $this->lang->line("appointment_date");
            $header[] = $this->global_mod->db_parse($this->lang->line("status"));
            $xls->addHeader($header);
            $counter = 1; 
            foreach($arrData as $val){
                //$custArr = $this->report_model->getCustomerInformation($val['customer_id']);						  
                $user_email 	= $val['user_email'];
                $cus_fname 		= $val['cus_fname'];
                $cus_lname 		= $val['cus_lname'];
                $cus_mob 		= $val['cus_mob'];
                $cus_phn1 		= $val['cus_phn1'];
                $cus_phn2 		= $val['cus_phn2'];
                $cus_address 	= $val['cus_address'];
                $city_name 		= $val['city_name'];
                $region_name 	= $val['region_name'];
                $country_name 	= $val['country_name'];
                $cus_zip 	= $val['cus_zip']; 
                $who_booked = $cus_fname." ".$cus_lname.", ".$user_email.", ".$this->global_mod->db_parse($this->lang->line("booked_on")).$val['booking_date_time'];
                #################################################################
                if($val['srvDtls_service_duration_unit'] == "M")
                    $service = $val['srvDtls_service_name']."\n".$val['srvDtls_service_duration'].$this->global_mod->db_parse($this->lang->line("mins"));
                else
                    $service = $val['srvDtls_service_name'].'\n'.$val['srvDtls_service_duration'].$this->global_mod->db_parse($this->lang->line("hrs"));
                #################################################################
                $contact_info = '';
                if($cus_address != '')
                    $contact_info .= $cus_address;
                if($city_name != '')
                    $contact_info .= "\n".$city_name;
                else
                    $contact_info .= "\n".$this->global_mod->db_parse($this->lang->line("no_city"));
                if($region_name != '')
                    $contact_info .= ", ".$region_name;
                else
                    $contact_info .= ",".$this->global_mod->db_parse($this->lang->line("no_region"));
                if($country_name != '')
                    $contact_info .= ", ".$country_name;
                else
                    $contact_info .= ",".$this->global_mod->db_parse($this->lang->line("no_country"));
                if($cus_zip != '')
                    $contact_info .= "\n".$cus_zip;
                if($cus_mob != '')
                    $contact_info .= "\n".$cus_mob.$this->global_mod->db_parse($this->lang->line("m"));
                if($cus_phn1 != '')
                    $contact_info .= "\n".$cus_phn1;
                if($cus_phn2 != '')
                    $contact_info .= "\n".$cus_phn2;

                #################################################################
                if($val["srvDtls_booking_status"] == 1)
                    $status = $this->global_mod->db_parse($this->lang->line("approved"));
                elseif($val["srvDtls_booking_status"] == 0)
                    $status = $this->global_mod->db_parse($this->lang->line("unapproved"));
                elseif($val["srvDtls_booking_status"] == 4)
                    $status = $this->global_mod->db_parse($this->lang->line("cancelled_by_admin"));
                elseif($val["srvDtls_booking_status"] == 5)
                    $status = $this->global_mod->db_parse($this->lang->line("cancelled_by_user"));
                elseif($val["srvDtls_booking_status"] == 6)
                    $status = $this->global_mod->db_parse($this->lang->line("set_status"));
                elseif($val["srvDtls_booking_status"] == 7)
                    $status = $this->global_mod->db_parse($this->lang->line("as_scheduled"));
                elseif($val["srvDtls_booking_status"] == 8)
                    $status = $this->global_mod->db_parse($this->lang->line("arrived_late"));
                elseif($val["srvDtls_booking_status"] == 9)
                    $status = $this->global_mod->db_parse($this->lang->line("no_show"));
                elseif($val["srvDtls_booking_status"] == 10)
                    $status = $this->global_mod->db_parse($this->lang->line("gift_cerificates"));
                else
                    $status = " ";
                #################################################################
                $row = array();
                $row[] = $counter;
                $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $who_booked);
                $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $contact_info);
                $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $service);
                $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $val['srvDtls_employee_name']);
                $row[] = date("j F, Y g:i a", strtotime($val['srvDtls_service_start']));
                $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $status);
                $xls->addRow($row);
                $counter++;
            }
        }
        elseif($_POST['display_type'] == 2)//Group by date
        {
            $filename = 'appointment_report_date_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->global_mod->db_parse($this->lang->line("sl_no"));
            $header[] = $this->global_mod->db_parse($this->lang->line("date"));
            $header[] = $this->global_mod->db_parse($this->lang->line("appointments"));
            $header[] = $this->global_mod->db_parse($this->lang->line("users"));
            $xls->addHeader($header);
            $counter = 1;
            $appointment=0;
            $users=0;
            foreach($arrData as $val)
            {
                $row = array();
                $row[] = $counter;
                $row[] = date("j F  Y", strtotime($val['dispdate']));
                $row[] = $val['appointment'];
                $row[] = $val['users'];
                $xls->addRow($row);
                $counter++;
                $appointment= $appointment + $val['appointment'];
                $users= $users + $val['users'];
            }
            $row = array();
            $row[] = " ";
            $row[] = $this->global_mod->db_parse($this->lang->line("total"));
            $row[] = $appointment;
            $row[] = $users;
            $xls->addRow($row);
        }
        else//Group by month
        {
            $filename = 'appointment_report_month_view.xls';
            $xls = new ExportXLS($filename);
            $header[] = $this->global_mod->db_parse($this->lang->line("sl_no"));
            $header[] = $this->global_mod->db_parse($this->lang->line("month"));
            $header[] = $this->global_mod->db_parse($this->lang->line("appointments"));
            $header[] = $this->global_mod->db_parse($this->lang->line("users"));
            $xls->addHeader($header);
            $counter = 1;
            $appointment=0;
            $users=0;
            foreach($arrData as $val)
            {
                $row = array();
                $row[] = $counter;
                $row[] = date("j F  Y", strtotime("01-".$val['dispdate']));
                $row[] = $val['appointment'];
                $row[] = $val['users'];
                $xls->addRow($row);
                $counter++;
                $appointment= $appointment + $val['appointment'];
                $users= $users + $val['users'];
            }
            $row = array();
            $row[] = " ";
            $row[] = $this->global_mod->db_parse($this->lang->line("total"));
            $row[] = $appointment;
            $row[] = $users;
            $xls->addRow($row);
        }
        $xls->sendFile();
    }	 
    
    public function GetMoreDetails(){
		$bookingId 		= $this->input->post('bookingId');
		$customerId		= $this->input->post('customerId');
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$return = $this->report_model->GetMoreDetails($bookingId,$customerId,$local_admin_id);
		if(isset($return) && !empty($return)){
			$html = '<table width="100%">
						<tr style="border-bottom:2px solid #0069B5;"><th align="left">'.$this->global_mod->db_parse($this->lang->line("more_details")).'</th></tr>';
						foreach($return as $val){
							$html .= '<tr>
											<td style="font-weight:bold;">'.$this->global_mod->db_parse($val["pre_booking_field_name"]).': </td>
											<td>'.$this->global_mod->db_parse($val["pre_booking_field_value"]).'</td>
									  </tr>';
						}	
			$html .= '</table>';
		}else{
			$html = '<span style="font-weight:bold;">'.$this->global_mod->db_parse($this->lang->line("no_details_avail")).'</span>';
		}
		echo $html;
		
		
		
	}
    
    
     	
 }
?>