<?php

class Report_model extends CI_Model
{
    public $_resultArr;
    public function __construct(){
        $this->load->database(); 
    }
    public function getCustomerInformation($user_id){
        $sql = "SELECT * FROM vw_customerdetails WHERE user_id='".$user_id."'";
        $query = $this->db->query($sql);
        $custArr = $query->result_array();
        return $custArr;
    }
    public function getDailyReport($appointment){
    
    	
        $Arr = $this->_resultArr;
        $appoint_type = $this->input->post('appointment_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $type = ($appoint_type == 1)?$this->lang->line("service_date_wise"):$this->lang->line("booking_date_wise");
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).' :: '.$this->global_mod->db_parse($type.$this->lang->line("detail_report_from")).DATE("dS F, Y", STRTOTIME($date_from)).$this->global_mod->db_parse($this->lang->line("to")).DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        if(count($returnArr) > 0) {
           $html.='<div>
               <form id="ExportExcel" method="post" action="" name="ExportExcel">
               <div class="print">
               <a href="'.site_url('admin/appointment_report/getAppointmentsPrint?appointment_type='.$appoint_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
               <img src="/images/print.png">
               '.$this->global_mod->db_parse($this->lang->line("print")).'
               </a>
               <a onClick="exporton()" href="javascript:void(0);">
               <img src="/images/export_excel.png">
               '.$this->global_mod->db_parse($this->lang->line("export_to_excel")).'
               </a>
               </div>
               </form>
           </div>';
        }
        $html.= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
            <tr>
                <th>'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("who_booked")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("contact_info")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("service")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("staff")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("appointment_date")).'</th>
                <th>'.$this->global_mod->db_parse($this->lang->line("status")).'</th>
                <th></th>
            </tr>';
        $sr=0;
        $grpdate='';
        if(count($returnArr) > 0){
        	$local_admin_id = $this->session->userdata('local_admin_id');
        	
            foreach($returnArr as $key=>$result){
                $sr++;
                $user_email 	= $result['user_email'];
                $cus_fname 		= $result['cus_fname'];
                $cus_lname 		= $result['cus_lname'];
                $cus_mob 		= $result['cus_mob'];
                $cus_phn1 		= $result['cus_phn1'];
                $cus_phn2 		= $result['cus_phn2'];
                $cus_address 	= $result['cus_address'];
                $city_name 		= $result['city_name'];
                $region_name 	= $result['region_name'];
                $country_name 	= $result['country_name'];
                $cus_zip 		= $result['cus_zip'];
                $data_added		= $result["booking_date_time"];
                $who_booked = $cus_fname.' '.$cus_lname.'<br>'.$user_email.'<br>'.'<strong>'.$this->lang->line("booked_on").'</strong>'.$data_added;
                if($result["srvDtls_service_duration_unit"] == 'M')
                    $service = $result["srvDtls_service_name"].'<br>'.$result["srvDtls_service_duration"].$this->lang->line("mins");
                else
                    $service = $result["srvDtls_service_name"].'<br>'.$result["srvDtls_service_duration"].$this->lang->line("hrs");
                $contact_info = '';
                if($cus_address != '')
                    $contact_info .= $cus_address;
                if($city_name != '')
                    $contact_info .= '<br>'.$city_name;
                else
                    $contact_info .= '<br>'.$this->global_mod->db_parse($this->lang->line("no_city"));
                if($region_name != '')
                    $contact_info .= ', '.$region_name;
                else
                    $contact_info .= ','.$this->global_mod->db_parse($this->lang->line("no_region"));
                if($country_name != '')
                    $contact_info .= ', '.$country_name;
                else
                    $contact_info .= ','. $this->global_mod->db_parse($this->lang->line("no_country"));
                if($cus_zip != '')
                    $contact_info .= '<br>'.$cus_zip;
                if($cus_mob != '')
                    $contact_info .= '<br>'.$cus_mob.$this->global_mod->db_parse($this->lang->line("m"));
                if($cus_phn1 != '')
                    $contact_info .= '<br>'.$cus_phn1;
                if($cus_phn2 != '')
                    $contact_info .= '<br>'.$cus_phn2;
                if($result["srvDtls_booking_status"] == 1)
                    $status = $this->global_mod->db_parse($this->lang->line("approved"));
                elseif($result["srvDtls_booking_status"] == 0)
                    $status = $this->global_mod->db_parse($this->lang->line("unapproved"));
                elseif($result["srvDtls_booking_status"] == 4)
                    $status = $this->global_mod->db_parse($this->lang->line("cancelled_by_admin"));
                elseif($result["srvDtls_booking_status"] == 5)
                    $status = $this->global_mod->db_parse($this->lang->line("cancelled_by_user"));
                elseif($result["srvDtls_booking_status"] == 6)
                    $status = $this->global_mod->db_parse($this->lang->line("set_status"));
                elseif($result["srvDtls_booking_status"] == 7)
                    $status = $this->global_mod->db_parse($this->lang->line("as_scheduled"));
                elseif($result["srvDtls_booking_status"] == 8)
                    $status = $this->global_mod->db_parse($this->lang->line("arrived_late")); 
                elseif($result["srvDtls_booking_status"] == 9)
                    $status = $this->global_mod->db_parse($this->lang->line("no_show"));
                elseif($result["srvDtls_booking_status"] == 10)
                    $status = $this->global_mod->db_parse($this->lang->line("gift_cerificates"));
                else
                    $status = ' ';
                if($appointment ==1){
                    if($grpdate !=DATE("j F, Y", STRTOTIME($result["srvDtls_service_start"]))){
                        $html .= '<tr>
                            <td colspan="8">'.DATE("j F, Y", STRTOTIME($result["srvDtls_service_start"])).'</td>
                        </tr>';
                        $grpdate=DATE("j F, Y", STRTOTIME($result["srvDtls_service_start"]));
                    }
                }
                if($appointment ==2){
                    if($grpdate !=DATE("j F, Y", STRTOTIME($result["booking_date_time"]))){
                        $html .= '<tr>
                            <td colspan="8">'.DATE("j F, Y", STRTOTIME($result["booking_date_time"])).'</td>
                        </tr>';
                        $grpdate=DATE("j F, Y", STRTOTIME($result["booking_date_time"]));
                    }
                }
                $html .= '<tr>
                    <td align="center">'.$sr.'</td>
                    <td align="center">'.$who_booked.'</td>
                    <td align="center">'.$contact_info.'</td>
                    <td align="center">'.$service.'</td>
                    <td align="center">'.$result["srvDtls_employee_name"].'</td>
                    <td align="center">'.DATE("j F, Y g:i a", STRTOTIME($result["srvDtls_service_start"])).'</td>
                    <td align="center">'.$status.'</td>
                    <td align="center">
                    	<a href="#" onclick="showMoreDetails('.$result["booking_id"].','.$result["customer_id"].')">'.$this->global_mod->db_parse($this->lang->line("more_details")).'</a>&nbsp;|&nbsp;
                    	<a href="javascript:void('.$result["booking_id"].');" onClick="ask_review('.$result["srvDtls_id"].','.$result["customer_id"].')">'.$this->global_mod->db_parse($this->lang->line("ask_for_review")).'</a>
                    </td>
                </tr>';
            }
        }else{
            $html .= '<tr><td colspan="8" align="center"><strong style="">'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
        }
        $html .= '</table>';
        return $html;
    }
    public function getGroupByDateReport(){
        $Arr = $this->_resultArr;
        $appoint_type = $this->input->post('appointment_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $type = ($appoint_type == 1)?$this->global_mod->db_parse($this->lang->line("service_date_wise")):$this->global_mod->db_parse($this->lang->line("booking_date_wise"));
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).' :: '.$type.$this->global_mod->db_parse($this->lang->line("group_by_date_from")).DATE("dS F, Y", STRTOTIME($date_from)).$this->global_mod->db_parse($this->lang->line("to")).DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        if(count($returnArr) > 0) {
            $html.='<div>
                        <form id="ExportExcel" method="post" action="" name="ExportExcel">
                        <div class="print">
                        <a href="'.site_url('admin/appointment_report/getAppointmentsPrint?appointment_type='.$appoint_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
                        <img src="/images/print.png">
                       '.$this->global_mod->db_parse($this->lang->line("print")).'
                        </a>
                        <a onClick="exporton()" href="javascript:void(0);">
                        <img src="/images/export_excel.png">
                        '.$this->global_mod->db_parse($this->lang->line("export_to_excel")).'
                        </a>
                        </div>
                        </form>
                </div>';
        }
        $html .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
            <tr>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("date")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
            </tr>';
        if(count($returnArr) > 0){
            $count=1;
            $appointment=0;
            $users=0;
            foreach($returnArr as $rows){
                $html .= '<tr>
                    <td align="center">'.$count.'</td>
                    <td>'.DATE("j F  Y", STRTOTIME($rows["dispdate"])).'</td>
                    <td style="padding-left:60px;">'.$rows["appointment"].'</td>
                    <td style="padding-left:32px;">'.$rows["users"].'</td>
                </tr>';
                $appointment= $appointment + $rows["appointment"];
                $users= $users + $rows["users"];
                $count=$count +1;
            }
            $html .= '<tr>
                    <td align="center"></td>
                    <td>'.$this->global_mod->db_parse($this->lang->line("total")).'</td>
                    <td style="padding-left:60px;">'.$appointment.'</td>
                    <td style="padding-left:32px;">'.$users.'</td>
                </tr>';
        }else{
            $html .= '<tr><td colspan="4" align="center"><strong>'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
        }
        $html .= '</table>';
        return  $html;
    }
    public function getGroupByMonthReport(){
        $Arr = $this->_resultArr;
        $appoint_type = $this->input->post('appointment_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $type = ($appoint_type == 1)?$this->lang->line("service_date_wise"):$this->lang->line("booking_date_wise");
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).':: '.$this->global_mod->db_parse($type.$this->lang->line("group_by_month_from")).DATE("dS F, Y", STRTOTIME($date_from)).$this->global_mod->db_parse($this->lang->line("to")).DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        if(count($returnArr) > 0) {
            $html.='<div>
                        <form id="ExportExcel" method="post" action="" name="ExportExcel">
                        <div class="print">
                        <a href="'.site_url('admin/appointment_report/getAppointmentsPrint?appointment_type='.$appoint_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
                        <img src="/images/print.png">
                        '.$this->global_mod->db_parse($this->lang->line("print_page")).'
                        </a>
                        <a onClick="exporton()" href="javascript:void(0);">
                        <img src="/images/export_excel.png">
                       '.$this->global_mod->db_parse($this->lang->line("export_to_excel")).'
                        </a>
                        </div>
                        </form>
                </div>';
        }
        $html .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
            <tr>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("month")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                <th align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
            </tr>';
        if(count($returnArr) > 0){
            $count=1;
            $appointment=0;
            $users=0;
            foreach($returnArr as $rows){
                $html .= '<tr>
                    <td align="center">'.$count.'</td>
                    <td>'.DATE("F  Y", STRTOTIME("01-".$rows["dispdate"])).'</td>
                    <td style="padding-left:60px;">'.$rows["appointment"].'</td>
                    <td style="padding-left:32px;">'.$rows["users"].'</td>
                </tr>';
                $appointment= $appointment + $rows["appointment"];
                $users= $users + $rows["users"];
                $count=$count +1;
            }
            $html .= '<tr>
                    <td align="center"></td>
                    <td>Total</td>
                    <td style="padding-left:60px;">'.$appointment.'</td>
                    <td style="padding-left:32px;">'.$users.'</td>
                </tr>';
        }else{
            $html .= '<tr><td colspan="4" align="center"><strong>'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
        }
        $html .= '</table>';
        return  $html;		
    }
    public function generateReportHtml($type,$appointment){
        if($type==1){
            $html = $this->getDailyReport($appointment);
        }elseif($type==2){
            $html = $this->getGroupByDateReport();
        }elseif($type==3){
            $html = $this->getGroupByMonthReport();
        }
        return $html;
    }
    public function GetAppointments(){
        $search = '';
        $sr = 0;
        $returnArr = array();
        $ResultArray=array();
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));

        if($this->input->post('service') != ''){
            $search .= " and srvDtls_service_id = ".$this->input->post('service');
        }
        if($this->input->post('staff') != ''){
            $search .= " and srvDtls_employee_id = ".$this->input->post('staff');
        }
        if($this->input->post('status') != ''){
            $search .= " and srvDtls_booking_status = ".$this->input->post('status');
        }
        if($this->input->post('username') != 'Client Username' && $this->input->post('username') != ''){
            $this->db->select('user_id');
            $this->db->from('app_password_manager');
            $this->db->where('user_name', $this->input->post('username'));
            $this->db->where('user_type', 1);
            $qry = $this->db->get();
            if($qry->num_rows()){
                $CusArr =  $qry->result_array();
                $search .= " and customer_id = ".$CusArr[0]['user_id'];
            }else{
                $search .= " and customer_id = NULL";
            }
        }
        $select ='';
        if($this->input->post('appointment_type') == 1){	
            $search .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$date_from.'" AS date) AND CAST("'.$date_to.'" AS date)  ';
        }
        if($this->input->post('appointment_type') == 2){// list by booking date		
            $search .= ' AND DATE_FORMAT(booking_date_time,"%Y-%m-%d") BETWEEN CAST("'.$date_from.'" AS date) AND CAST("'.$date_to.'" AS date) ';	
        }

        if($this->input->post('display_type') == 1){
            $search .= ' ORDER BY DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") DESC';
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search);
            
           // echo "<pre>";
           // print_r($this->_resultArr);
           // echo "</pre>";
           // exit;
            
        }
        if($this->input->post('display_type') == 2){// group by date
            if($this->input->post('appointment_type') == 1){	
                $search .= ' group by DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") ';
                $select =  ' DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ';
            }elseif($this->input->post('appointment_type') == 2){    
                $search .= ' group by DATE_FORMAT(booking_date_time,"%Y-%m-%d")';
                $select =  ' DATE_FORMAT(booking_date_time,"%Y-%m-%d") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ';
            }
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search,$select);		
            
            
            
        }
        if($this->input->post('display_type') == 3){
            if($this->input->post('appointment_type') == 1){	
                $search .= ' group by month(srvDtls_service_start) ';
                $select =  ' DATE_FORMAT(srvDtls_service_start,"%m-%Y") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ';
            }elseif($this->input->post('appointment_type') == 2){    
                $search .= ' group by month(booking_date_time)';
                $select =  ' DATE_FORMAT(booking_date_time,"%m-%Y") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ';
            }			
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search,$select);				
        }		
        return $this->generateReportHtml($this->input->post('display_type'),$this->input->post('appointment_type'));	
    }
    
    public function GetReviews(){
    	
    	/*
    	
        $local_admin_id = $this->session->userdata('local_admin_id');
        $host=$_SERVER['HTTP_HOST'];
        $hosr_exp=explode('.',$host);
        $this->db->select('business_name');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $local_admin_id); 
        $query = $this->db->get();
        $business_name =  $query->result_array();

        $this->db->select('user_email,user_name');
        $this->db->from('app_password_manager');
        $this->db->where('user_type', '3'); 
        $this->db->where('user_id', $local_admin_id);
        $query = $this->db->get();
        $user_email =  $query->result_array();

        //$host=$_SERVER['HTTP_HOST'];
        $sql1=$this->db->query("SELECT * FROM vw_customerdetails WHERE user_id='".$this->input->post('cus_id')."'");
        $cus =  $sql1->result_array();
        $b_s_id=$this->input->post('b_s_id');
        $string="AND srvDtls_id=".$this->input->post('b_s_id');
        $book=$this->global_mod->mainBookingStorePro($string);	
        
        #############################################
        $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$this->input->post('cus_id').'/'.$book[0]["srvDtls_service_id"].'/'.$book[0]["srvDtls_employee_id"].'/'.$b_s_id;
        $replacerArr = array();
        array_push($replacerArr, "{fname}:".ucfirst($cus[0]["cus_fname"]));
        array_push($replacerArr, "{lname}:".ucfirst($cus[0]["cus_lname"]));
        array_push($replacerArr, "{appointmentStartDate}:".$book[0]["srvDtls_service_start"]);
        array_push($replacerArr, "{rateBusiness}:".$link);
        array_push($replacerArr, "{businessemail}:".$user_email[0]["user_email"]);
        #############################################
        
        
        $mail = $this->email_model->sentMail(3, $replacerArr, $cus[0]["user_email"], $user_email[0]["user_email"]);
        //mail($to, $subject, $message, $headers);
        if($mail == 1)
        {
            return "Successfully Sent";
        }
        else
        {
            return "Error sending";
        }  */
    }
    public function set_staff($imgdata){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $employee_image =  $imgdata['upload_data']['file_name'];
        if(count($this->input->post()) > 0){
            $insert_app_password_manager = array(
                'user_type'          =>  2,
                'user_name'          =>  $this->input->post('employee_username'),
                'password'           =>  $this->input->post('employee_password'),
                'user_email'         =>  $this->input->post('employee_email'),
                'date_creation'      =>  date("Y/m/d"),
                'date_modified'      =>  date("Y/m/d")
            );
            $insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
            $this->load->database();
            $this->db->trans_begin();
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $user_id=$this->db->insert_id();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
            $data = array(
                'employee_id' 		    => $user_id,
                'local_admin_id' 		=> $local_admin_id,
                'employee_image' 		=> $employee_image,
                'employee_name' 		=> $this->input->post('employee_name'),
                'employee_mobile_no' 	=> $this->input->post('employee_mobile_no'),
                'employee_languages' 	=> $this->input->post('employee_languages'),
                'employee_description' 	=> $this->input->post('employee_description'),
                'employee_education' 	=> $this->input->post('employee_education'),
                'employee_membership' 	=> $this->input->post('employee_membership'),
                'employee_awards' 		=> $this->input->post('employee_awards'),
                'employee_publications' => $this->input->post('employee_publications'),
                'is_active' 			=> 'Y',
                'date_added' 			=> date('Y-m-d'),
                'date_edited' 			=> date('Y-m-d')
            );
            $data = $this->global_mod->db_parse($data);
            $this->load->database();
            $this->db->trans_begin();
            $this->db->insert('app_employee',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return true;
            }
        }
    }
    public function check_user_name($username, $curusrid = '0'){
        $this->db->select('user_name');
        $this->db->from('app_password_manager');
        $this->db->where('user_name', $username);
        $query = $this->db->get();
        $ResArr =  $query->result_array();
        $CountRes = count($ResArr);
        if($curusrid != '0' && $CountRes == 1){
            $this->db->select('user_name');
            $this->db->from('app_password_manager');
            $this->db->where('user_id', $curusrid);
            $query1 = $this->db->get();
            $ResArr1 =  $query1->result_array();
            if($ResArr[0]['user_name'] == $ResArr1[0]['user_name']){
                echo 0;
            }else{
                echo 1;
            }
        }else{
            echo count($ResArr);
        }
    }
    public function get_all_staff(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_employee.*, app_password_manager.*,');
        $this->db->from('app_employee');
        $this->db->join('app_password_manager', 'app_password_manager.user_id = app_employee.employee_id');
        $this->db->where('app_employee.local_admin_id', $local_admin_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function delete_staff($id){
        $this->db->delete('app_employee', array('employee_id' => $id));
        return $this->db->affected_rows();
    }
    public function status_change($status, $id){
        $data = array(
           'is_active' => $status
        );
        $this->db->where('employee_id', $id);
        $this->db->update('app_employee', $data);
        return $this->db->affected_rows();
    }
    public function edit_staff_data($id){
        $this->db->select('app_employee.*, app_password_manager.*,');
        $this->db->from('app_employee');
        $this->db->join('app_password_manager', 'app_password_manager.user_id = app_employee.employee_id');
        $this->db->where('app_employee.employee_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function staff_update($id, $imageChange){
        if(count($this->input->post()) > 0){
            $dataPassManager = array(
                'user_name' 	=> $this->input->post('employee_username'),
                'password' 		=> $this->input->post('employee_password'),
                'user_email' 	=> $this->input->post('employee_email'),
            );
            $dataPassManager = $this->global_mod->db_parse($dataPassManager);
            $this->load->database();
            $this->db->trans_begin();
            $this->db->where('user_id', $id);
            $this->db->update('app_password_manager',$this->db->escape($dataPassManager));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
            $data = array(
                'employee_name' 		=> $this->input->post('employee_name'),
                'employee_mobile_no' 	=> $this->input->post('employee_mobile_no'),
                'employee_languages' 	=> $this->input->post('employee_languages'),
                'employee_description' 	=> $this->input->post('employee_description'),
                'employee_education' 	=> $this->input->post('employee_education'),
                'employee_membership' 	=> $this->input->post('employee_membership'),
                'employee_awards' 		=> $this->input->post('employee_awards'),
                'employee_publications' => $this->input->post('employee_publications'),
                'is_active' 			=> 'Y',
                'date_edited' 			=> date('Y-m-d')
            );
            $data = $this->global_mod->db_parse($data);
            if($imageChange == "Y"){
                $imagefielname =  $_FILES['userfile']['name'];
                $data['employee_image'] = $imagefielname;
            }
            $this->load->database();
            $this->db->trans_begin();
            $this->db->where('employee_id', $id);
            $this->db->update('app_employee',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return true;
            }
        }
    }
    public function get_email_pass($id){
        $this->db->select('user_email, password');
        $this->db->from('app_password_manager');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function sendpasswordViaEmail($returnData){
        $Email = $returnData[0]['user_email'];
        $Pass  = $returnData[0]['password'];
        $to      = $Email;
        $subject = 'Your Password';
        $message = 'Your password is : '.$Pass;
        $headers = 'From: sandipancitytech@gmail.com' . "\r\n" .
                'Reply-To: sandipancitytech@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        return $Emailsent = mail($to, $subject, $message, $headers);
    }
    public function changeDtFrmat($date){
        $oldDate = $date;
        $arr = explode('/', $oldDate);
        return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
    public function add_block_date_data($date_from, $date_to, $blk_dt_employee_id){
        $date = $this->changeDtFrmat($date_from);
        $end_date = $this->changeDtFrmat($date_to);
        $this->db->select('date_serialize');
        $this->db->from('app_staff_unavailable');
        $this->db->where('employee_id', $blk_dt_employee_id);
        $query = $this->db->get();
        $NumRows =  $query->num_rows();
        if($NumRows == 0){
            $DateArrCounter = 0;
            $DateArr = array();
            while (strtotime($date) <= strtotime($end_date)) {
                $DateArrCounter++;
                $DateArr[$DateArrCounter] = $date;
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
            $SerializedDateArray = serialize($DateArr);
        }else{
            $ResData =  $query->result_array();
            $UnserializedData = unserialize($ResData[0]['date_serialize']);
            $DateArrCounter = 0;
            foreach($UnserializedData as $prevData){
                $DateArrCounter++;
                $DateArr[$DateArrCounter] = $prevData;
            }
            while (strtotime($date) <= strtotime($end_date)){
                $DateArrCounter++;
                if (in_array($date, $UnserializedData)){
                    $DateArrCounter--;
                }else{
                    $DateArr[$DateArrCounter] = $date;
                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
            $SerializedDateArray = serialize($DateArr);
        }
        $data = array(
            'employee_id' 		=> $blk_dt_employee_id,
            'date_serialize' 	=> $SerializedDateArray,
            'date_added' 		=> date('Y-m-d'),
            'date_edited' 		=> date('Y-m-d')
        );
        $this->load->database();
        $this->db->trans_begin();
        if($NumRows == 0){
            $this->db->insert('app_staff_unavailable',$this->db->escape($data));
        }else{
            $this->db->where('employee_id', $blk_dt_employee_id);
            $this->db->update('app_staff_unavailable',$this->db->escape($data));
        }
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        }
    }
    public function fetch_blocked_dates($id){
        $this->db->select('date_serialize');
        $this->db->from('app_staff_unavailable');
        $this->db->where('employee_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function add_block_time_data($timepickerFrom, $timepickerTo, $date_of_time_block, $blk_time_employee_id){
        $date_of_time_block = $this->changeDtFrmat($date_of_time_block);
        $this->db->select('unavailable_time_id');
        $this->db->from('app_staff_unavailable_time');
        $this->db->where('employee_id', $blk_time_employee_id);
        $this->db->where('date', $date_of_time_block);
        $query = $this->db->get();
        $NumRows =  $query->num_rows();
        if($NumRows == 0){
            $data = array(
                'employee_id' 	=> $blk_time_employee_id,
                'time_form' 	=> $timepickerFrom,
                'time_to' 		=> $timepickerTo,
                'date' 			=> $date_of_time_block,
                'date_added' 	=> date('Y-m-d'),
                'date_edited' 	=> date('Y-m-d')
            );
            $this->load->database();
            $this->db->trans_begin();
            $this->db->insert('app_staff_unavailable_time',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return true;
            }
        }else{
            $data = array(
                'time_form' 	=> $timepickerFrom,
                'time_to' 		=> $timepickerTo,
                'date_edited' 	=> date('Y-m-d')
            );
            $this->load->database();
            $this->db->trans_begin();
            $this->db->where('employee_id', $blk_time_employee_id);
            $this->db->where('date', $date_of_time_block);
            $this->db->update('app_staff_unavailable_time',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return true;
            }
        }
    }
    public function fetch_blocked_timings($id){
        $this->db->select('*');
        $this->db->from('app_staff_unavailable_time');
        $this->db->where('employee_id', $id);
        $query = $this->db->get();
        $NumRows =  $query->num_rows();
        if($NumRows > 0){
            $ResData =  $query->result_array();
            $RetString = "<table align=\"left\" width=\"30%\">";
            foreach($ResData as $data){
                $ResDate = $data['date'];
                $Res_time_form = $data['time_form'];
                $Res_time_to = $data['time_to'];
                $DeleteId = $data['unavailable_time_id'];
                $employee_id = $data['employee_id'];

                $RetString .=  "<tr>
                                <td>On ".$ResDate."</td>
                                <td>From : ".$Res_time_form."</td>
                                <td>To : ".$Res_time_to."</td>
                                <td><a href=\"javascript:void(0);\" onclick=\"DeleteTimeBlockData(".$DeleteId.",".$employee_id.");\">Delete</a></td>
                                </tr>";
            }
            $RetString .= "</table>";
        }else{
            echo $RetString = $this->global_mod->db_parse($this->lang->line("no_result_found"));
        }
        return $RetString;
    }
    public function blocked_dt_delete($blk_dt_employee_id, $date){
        $this->db->select('date_serialize');
        $this->db->from('app_staff_unavailable');
        $this->db->where('employee_id', $blk_dt_employee_id);
        $query = $this->db->get();
        $NumRows =  $query->num_rows();
        if($NumRows == 0){
            return $RetString = "There is some error processing your request";
        }else{
            $ResData =  $query->result_array();
            $UnserializedData = unserialize($ResData[0]['date_serialize']);
            $DateArrCounter = 0;
            foreach($UnserializedData as $prevData){
                $DateArrCounter++;
                if($prevData == $date){
                    $DateArrCounter--;
                }else{
                    $DateArr[$DateArrCounter] = $prevData;
                }
            }
            $SerializedDateArray = serialize($DateArr);
            $data = array(
                'employee_id' 		=> $blk_dt_employee_id,
                'date_serialize' 	=> $SerializedDateArray,
                'date_edited' 		=> date('Y-m-d')
            );
            $this->load->database();
            $this->db->trans_begin();
            $this->db->where('employee_id', $blk_dt_employee_id);
            $this->db->update('app_staff_unavailable',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return $RetString = "request processed sucessfully";
            }
        }
    }
    public function blocked_time_delete($deletetimeId){
        $this->load->database();
        $this->db->trans_begin();
        $this->db->where('unavailable_time_id', $deletetimeId);
        $this->db->delete('app_staff_unavailable_time');
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        }
    }
    public function CheckValidMinBooking($date='2012-09-11',$time='08:20 PM'){
        $time_arr = explode(" ",$time);
        if($time_arr[1] == 'AM')
            $time_book = $time_arr[0].':00';
        else{
            $time_hr_arr = 	explode(":",$time_arr[0]);
            $hr = 12+$time_hr_arr[0];
            $min = $time_hr_arr[1];
            $time_book = $hr.':'.$min.':00';
        }
        $booking_datetime = $date.' '.$time_book;
        $booking_datetime_timestamp = strtotime("Y-m-d H:i:s");

        $this->db->select('adv_bk_min_setting,adv_bk_min_tim');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
        $query = $this->db->get();
        $NumRows =  $query->num_rows();
        if($NumRows > 0){
            $ResData =  $query->result_array();
            if($ResData[0]['adv_bk_min_setting'] == 1){
                $setting_time = strtotime(mktime(date("H",strtotime($booking_datetime)),date("i",strtotime($booking_datetime)),date("s",strtotime($booking_datetime)),date("d",strtotime($booking_datetime))-$ResData[0]['adv_bk_min_tim'],date("m",strtotime($booking_datetime)),date("Y",strtotime($booking_datetime))));
            }else if($ResData[0]['adv_bk_min_setting'] == 2){
                $setting_time = strtotime(mktime(date("H",strtotime($booking_datetime))-$ResData[0]['adv_bk_min_tim'],date("i",strtotime($booking_datetime)),date("s",strtotime($booking_datetime)),date("d",strtotime($booking_datetime)),date("m",strtotime($booking_datetime)),date("Y",strtotime($booking_datetime))));
            }else if($ResData[0]['adv_bk_min_setting'] == 3){
                $setting_time = strtotime(mktime(date("H",strtotime($booking_datetime)),date("i",strtotime($booking_datetime))-$ResData[0]['adv_bk_min_tim'],date("s",strtotime($booking_datetime)),date("d",strtotime($booking_datetime)),date("m",strtotime($booking_datetime)),date("Y",strtotime($booking_datetime))));
            }
        }
        if($setting_time <= $booking_datetime_timestamp)
            return 1;
        else
            return 0;
    }
    public function Getexcel(){
        echo '<pre>';print_r($_REQUEST);exit;
    }
    public function GetAppointments12(){
        $search = '';
        $sr = 0;
        $returnArr = array();
        //$date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        //$date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $date_from ='2012-12-02';
        $date_to ='2012-12-03';
        if($this->input->post('service') != ''){
            $search .= " and ser.service_id = ".$this->input->post('service');
        }
        if($this->input->post('staff') != ''){
            $search .= " and ser.employee_id = ".$this->input->post('staff');
        }
        if($this->input->post('status') != ''){
            $search .= " and ser.booking_status = ".$this->input->post('status');
        }
        if($this->input->post('username') != 'Client Username'){
            $this->db->select('user_id');
            $this->db->from('app_password_manager');
            $this->db->where('user_name', $this->input->post('username'));
            $this->db->where('user_type', 1);
            $qry = $this->db->get();
            if($qry->num_rows()){
                $CusArr =  $qry->result_array();
                $search .= " and book.customer_id = ".$CusArr[0]['user_id'];
            }else{
                $search .= " and booking.customer_id = NULL";
            }
        }
        if($this->input->post('appointment_type') == 1){
            if($this->input->post('display_type') == 1){
                $query = $this->db->query("SELECT ser.*,book.* FROM app_booking_service_details as ser,app_booking as book WHERE DATE_FORMAT(ser.srvDtls_service_start,'%Y-%m-%d') >= '".$date_from."' AND DATE_FORMAT(ser.srvDtls_service_end,'%Y-%m-%d') <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id".$search);
                $rows = $query->num_rows();
                if($rows > 0){
                    foreach($query->result() as $key=>$NewArray){
                        $ResultArray[$key]['booking_service_id'] = $NewArray->booking_service_id;
                        $ResultArray[$key]['booking_status'] = $NewArray->booking_status;
                        $ResultArray[$key]['service_name'] = $NewArray->service_name;
                        $ResultArray[$key]['service_duration'] = $NewArray->service_duration;
                        $ResultArray[$key]['service_duration_unit'] = $NewArray->service_duration_unit;
                        $staff = $this->db->query("SELECT employee_name FROM app_employee WHERE employee_id = ".$NewArray->employee_id);
                        if(count($staff->result()) > 0){
                            foreach($staff->result() as $Staff){
                                $ResultArray[$key]['staff'] = $Staff->employee_name;
                            }
                        }else{
                            $ResultArray[$key]['staff'] =  'N/A';
                        }

                        $ResultArray[$key]['booking_date'] = date('d M, Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['booking_date_row'] = date('D, d M, Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['data_added'] = date('D, d M, Y',strtotime($NewArray->data_added));

                        $sql1=$this->db->query(" Select * from (
                        SELECT distinct c1.user_id as  user_id,
                        c2.local_admin_id as local_admin_id ,
                        c1.date_creation as date_inserted,
                        c3.country_name as country_name,
                        c4.city_name as city_name,
                        c5.region_name as region_name,
                        c1.user_email as user_email,
                        ( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_fname
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_lname
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_address
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_status'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS customer_status
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_zip
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_mob
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn1'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_phn1
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn2'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_phn2
                        FROM app_password_manager c1 INNER JOIN
                        app_local_customer_details c2 LEFT JOIN
                        app_countries c3 ON c3.country_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_countryid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )
                        LEFT JOIN
                        app_cities c4 ON c4.city_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_cityid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )
                        LEFT JOIN app_regions c5 ON c5.region_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_regionid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )

                        where c1.user_type ='1' and
                            c1.user_id=c2.customer_id and
                            c2.local_admin_id  ='".$this->session->userdata('local_admin_id')."' and
                            c2.customer_id='".$NewArray->customer_id."'
                        ) as maintable where 1=1");

                        foreach($sql1->result() as $Customer)
                        {
                            $ResultArray[$key]['user_email'] 	= $Customer->user_email;
                            $ResultArray[$key]['cus_fname'] 	= $Customer->cus_fname;
                            $ResultArray[$key]['cus_lname'] 	= $Customer->cus_lname;
                            $ResultArray[$key]['cus_mob'] 		= $Customer->cus_mob;
                            $ResultArray[$key]['cus_phn1'] 		= $Customer->cus_phn1;
                            $ResultArray[$key]['cus_phn2'] 		= $Customer->cus_phn2;
                            $ResultArray[$key]['cus_address'] 	= $Customer->cus_address;
                            $ResultArray[$key]['city_name'] 	= $Customer->city_name;
                            $ResultArray[$key]['region_name'] 	= $Customer->region_name;
                            $ResultArray[$key]['country_name'] 	= $Customer->country_name;
                            $ResultArray[$key]['cus_zip'] 		= $Customer->cus_zip;
                        }
                    }
                }
            }else if($this->input->post('display_type') == 2){
                $inc = 0;
                $tot_app = 0;
                $tot_user = 0;
                $qry = $this->db->query("SELECT count(*) as total,book.booking_date_time,count(ser.employee_id) as user FROM app_booking_service_details as ser,app_booking as book WHERE DATE_FORMAT(ser.srvDtls_service_start,'%Y-%m-%d') >= '".$date_from."' AND DATE_FORMAT(ser.srvDtls_service_end,'%Y-%m-%d') <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id ".$search." group by book.booking_date_time");
                $rows = $qry->num_rows();
                if($rows > 0){
                    foreach($qry->result() as $key=>$NewArray){
                            $inc++;
                            $tot_app = $tot_app + $NewArray->total;
                            $tot_user = $tot_user + $NewArray->user;

                            $ResultArray[$key]['sr_no'] 			= $inc;
                            $ResultArray[$key]['total_count'] 		= $NewArray->total;
                            $ResultArray[$key]['booking_date_time'] = date('d M, Y',strtotime($NewArray->booking_date_time));
                            $ResultArray[$key]['total_user'] 		= $NewArray->user;
                    }
                }
            }else if($this->input->post('display_type') == 3){
                $inc = 0;
                $tot_app = 0;
                $tot_user = 0;
                $qry = $this->db->query("SELECT count(*) as total,book.booking_date_time,count(ser.employee_id) as user FROM app_booking_service_details as ser,app_booking as book WHERE DATE_FORMAT(ser.service_start_dt,'%Y-%m-%d') >= '".$date_from."' AND DATE_FORMAT(ser.service_end_dt,'%Y-%m-%d') <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id ".$search." group by month(book.booking_date_time)");
                $rows = $qry->num_rows();
                if($rows > 0){
                    foreach($qry->result() as $key=>$NewArray){
                        $inc++;
                        $tot_app = $tot_app + $NewArray->total;
                        $tot_user = $tot_user + $NewArray->user;
                        $ResultArray[$key]['sr_no'] 			= $inc;
                        $ResultArray[$key]['total_count'] 		= $NewArray->total;
                        $ResultArray[$key]['booking_date_time'] = date('M',strtotime($NewArray->booking_date_time)).' '.date('Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['total_user'] 		= $NewArray->user;
                    }
                }
            }
        }else{
            if($this->input->post('display_type') == 1){
                $query = $this->db->query("SELECT book.*,ser.* FROM app_booking as book,app_booking_service_details as ser WHERE DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) >= '".$date_from."' AND DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id".$search);
                $rows = $query->num_rows();
                if($rows > 0){
                    foreach($query->result() as $key=>$NewArray){
                        $ResultArray[$key]['booking_date'] = date('d M, Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['booking_date_row'] = date('D, d M, Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['data_added'] = date('D, d M, Y',strtotime($NewArray->data_added));
                        $ResultArray[$key]['booking_status'] = $NewArray->booking_status;
                        $ResultArray[$key]['service_name'] = $NewArray->service_name;
                        $ResultArray[$key]['service_duration'] = $NewArray->service_duration;
                        $ResultArray[$key]['service_duration_unit'] = $NewArray->service_duration_unit;

                        $staff = $this->db->query("SELECT employee_name FROM app_employee WHERE employee_id = ".$NewArray->employee_id);
                        if(count($staff->result()) > 0){
                            foreach($staff->result() as $Staff){
                                $ResultArray[$key]['staff'] = $Staff->employee_name;
                            }
                        }else{
                            $ResultArray[$key]['staff'] = 'N/A';
                        }
                        $sql1=$this->db->query(" Select * from (
                        SELECT distinct c1.user_id as  user_id,
                        c2.local_admin_id as local_admin_id ,
                        c1.date_creation as date_inserted,
                        c3.country_name as country_name,
                        c4.city_name as city_name,
                        c5.region_name as region_name,
                        c1.user_email as user_email,
                        ( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_fname
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_lname
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_address
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_status'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS customer_status
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_zip
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_mob
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn1'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_phn1
                        ,( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_phn2'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        ) AS cus_phn2
                        FROM app_password_manager c1 INNER JOIN
                        app_local_customer_details c2 LEFT JOIN
                        app_countries c3 ON c3.country_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_countryid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )
                        LEFT JOIN
                        app_cities c4 ON c4.city_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_cityid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )
                        LEFT JOIN app_regions c5 ON c5.region_id=( SELECT v1.value
                            FROM app_local_customer_details v1
                            JOIN app_local_clint_signup_info a1
                                ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_regionid'
                            WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
                        )
                        where c1.user_type ='1' and
                            c1.user_id=c2.customer_id and
                            c2.local_admin_id  ='".$this->session->userdata('local_admin_id')."' and
                            c2.customer_id='".$NewArray->customer_id."'
                        ) as maintable where 1=1");
                        foreach($sql1->result() as $Customer){
                            $ResultArray[$key]['user_email'] 	= $Customer->user_email;
                            $ResultArray[$key]['cus_fname'] 	= $Customer->cus_fname;
                            $ResultArray[$key]['cus_lname'] 	= $Customer->cus_lname;
                            $ResultArray[$key]['cus_mob'] 		= $Customer->cus_mob;
                            $ResultArray[$key]['cus_phn1'] 		= $Customer->cus_phn1;
                            $ResultArray[$key]['cus_phn2'] 		= $Customer->cus_phn2;
                            $ResultArray[$key]['cus_address'] 	= $Customer->cus_address;
                            $ResultArray[$key]['city_name'] 	= $Customer->city_name;
                            $ResultArray[$key]['region_name'] 	= $Customer->region_name;
                            $ResultArray[$key]['country_name'] 	= $Customer->country_name;
                            $ResultArray[$key]['cus_zip'] 		= $Customer->cus_zip;
                        }
                    }
                }
            }
            else if($this->input->post('display_type') == 2){
                $inc = 0;
                $tot_app = 0;
                $tot_user = 0;

                $qry = $this->db->query("SELECT count(*) as total,book.booking_date_time,count(ser.employee_id) as user FROM app_booking as book,
                app_booking_service_details as ser WHERE DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) >= '".$date_from."' AND DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id ".$search." group by book.booking_date_time");
                $rows = $qry->num_rows();
                if($rows > 0){
                    foreach($qry->result() as $key=>$NewArray){
                        $inc++;
                        $ResultArray[$key]['sr_no'] 			= $inc;
                        $ResultArray[$key]['total_count'] 		= $NewArray->total;
                        $ResultArray[$key]['booking_date_time'] = date('d M, Y',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['total_user'] 		= $NewArray->user;
                    }
                }
            }
            else if($this->input->post('display_type') == 3){
                $inc = 0;
                $tot_app = 0;
                $tot_user = 0;
                $qry = $this->db->query("SELECT count(*) as total,book.booking_date_time,count(ser.employee_id) as user FROM app_booking as book,
                app_booking_service_details as ser WHERE DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) >= '".$date_from."' AND DATE_FORMAT(book.booking_date_time,GET_FORMAT(DATE,'JIS')) <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id ".$search." group by month(book.booking_date_time)");
                $rows = $qry->num_rows();
                if($rows > 0){
                    foreach($qry->result() as $key=>$NewArray){
                        $inc++;
                        $ResultArray[$key]['sr_no'] 			= $inc;
                        $ResultArray[$key]['total_count'] 		= $NewArray->total;
                        $ResultArray[$key]['booking_date_time'] = date('M',strtotime($NewArray->booking_date_time)).' '.date('M',strtotime($NewArray->booking_date_time));
                        $ResultArray[$key]['total_user'] 		= $NewArray->user;
                    }
                }
            }
        }
        $returnArr['date_from'] = date("d",strtotime($this->input->post('date_from')))."-".date("M",strtotime($this->input->post('date_from')))."-".date("Y",strtotime($this->input->post('date_from')));
        $returnArr['date_to'] = date("d",strtotime($this->input->post('date_to')))."-".date("M",strtotime($this->input->post('date_to')))."-".date("Y",strtotime($this->input->post('date_to')));
        if($this->input->post('display_type') == 1){
            $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).'('.$returnArr["date_from"].$this->global_mod->db_parse($this->lang->line("to")).$returnArr["date_to"].','.$this->global_mod->db_parse($this->lang->line("display_type_1")).')</div><br/>
            <div>
                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                <div class="print">
                <a onClick="printon()" href="#">
                <img src="/images/print.png">
                '.$this->global_mod->db_parse($this->lang->line("print")).'
                </a>
                <a onClick="exporton()" href="#">
                <img src="/images/export_excel.png">
                '.$this->global_mod->db_parse($this->lang->line("export_to_excel")).'
                </a>
                </div>
                </form>
            </div>';
            $html.= '<table width="98%"  cellspacing="0" cellpadding="0"  class="list-view">
                <tr>
                    <th>'.$this->global_mod->db_parse($this->lang->line("sr_no")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("who_booked")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("contact_info")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("service")).'/th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("staff")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("appointment_date")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("info")).'</th>
                    <th>'.$this->global_mod->db_parse($this->lang->line("review")).'</th>
                </tr>';
            if($rows > 0){
                foreach($ResultArray as $key=>$result){
                    $sr++;
                    $who_booked = $result["cus_fname"].' '.$result["cus_lname"].'<br>'.$result["user_email"].'<br>'.'<strong>'.$this->lang->line("booked_on").'</strong>'.$result["data_added"];
                    if($result["service_duration_unit"] == 'M')
                        $service = $result["service_name"].'<br>'.$result["service_duration"].$this->lang->line("mins");
                    else
                        $service = $result["service_name"].'<br>'.$result["service_duration"].$this->lang->line("hrs");
                    $contact_info = '';
                    if($result["cus_address"] != '')
                        $contact_info .= $result["cus_address"];
                    if($result["city_name"] != '')
                        $contact_info .= '<br>'.$result["city_name"];
                    else
                        $contact_info .= '<br>'.$this->global_mod->db_parse($this->lang->line("no_city"));
                    if($result["region_name"] != '')
                        $contact_info .= ', '.$result["region_name"];
                    else
                        $contact_info .= ','.$this->global_mod->db_parse($this->lang->line('no_region'));
                    if($result["country_name"] != '')
                        $contact_info .= ', '.$result["country_name"];
                    else
                        $contact_info .= ','.$this->global_mod->db_parse($this->lang->line('no_country'));
                    if($result["cus_zip"] != '')
                        $contact_info .= '<br>'.$result["cus_zip"];
                    if($result["cus_mob"] != '')
                        $contact_info .= '<br>'.$result["cus_mob"].$this->lang->line("m");
                    if($result["cus_phn1"] != '')
                        $contact_info .= '<br>'.$result["cus_phn1"];
                    if($result["cus_mob"] != '')
                        $contact_info .= '<br>'.$result["cus_phn2"];
                    if($result["booking_status"] == 1)
                        $status = $this->global_mod->db_parse($this->lang->line('approved'));
                    else
                        $status = $this->global_mod->db_parse($this->lang->line('unapproved'));

                    $html .= '<tr>
                        <td colspan="8">'.$result["booking_date"].'</td>
                    </tr>
                    <tr>
                        <td>'.$sr.'</td>
                        <td>'.$who_booked.'</td>
                        <td>'.$contact_info.'</td>
                        <td>'.$service.'</td>
                        <td>'.$result["staff"].'</td>
                        <td>'.$result["booking_date_row"].'</td>
                        <td>'.$status.'</td>
                        <td><a href="javascript:void(0);" onClick="ask_review('.$result["booking_service_id"].')">'.$this->global_mod->db_parse($this->lang->line("ask_for_review")).'</a></td>
                    </tr>';
                }
            }
            else{
                $html .= '<tr><td colspan="7" align="center"><strong style=" color:red;">'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
            }
            $html .= '</table>';
        }elseif($this->input->post('display_type') == 2){
            $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).'('.$returnArr["date_from"].$this->global_mod->db_parse($this->lang->line("to")).$returnArr["date_to"].','.$this->global_mod->db_parse($this->lang->line("group_by_date")).')</div>';
            $html .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
                <tr>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("sr_no")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("date")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
                </tr>';
            if($rows > 0){
                foreach($ResultArray as $rows){
                    $html .= '<tr>
                        <td align="center">'.$rows["sr_no"].'</td>
                        <td>'.$rows["booking_date_time"].'</td>
                        <td style="padding-left:60px;">'.$rows["total_count"].'</td>
                        <td style="padding-left:32px;">'.$rows["total_user"].'</td>
                    </tr>';
                }
            }else{
                $html .= '<tr><td colspan="4" align="center"><strong>'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
            }
            $html .= '</table>';
        }elseif($this->input->post('display_type') == 3){
            $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("appointment_report")).'('.$returnArr["date_from"].$this->global_mod->db_parse($this->lang->line("to")).$returnArr["date_to"].','.$this->global_mod->db_parse($this->lang->line("display_type_3")).'.)</div>';
            $html = '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
                <tr>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("sr_no")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("month")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                    <th align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
                </tr>';
            if($rows > 0){
                foreach($ResultArray as $rows){
                    $html .= '<tr>
                        <td align="center">'.$rows["sr_no"].'</td>
                        <td style="padding-left:10px;">'.$rows["booking_date_time"].'</td>
                        <td style="padding-left:60px;">'.$rows["total_count"].'</td>
                        <td style="padding-left:35px;">'.$rows["total_user"].'</td>
                    </tr>';
                }
            }else{
                $html .= '<tr><td colspan="4" align="center"><strong>'.$this->global_mod->db_parse($this->lang->line("no_result_found")).'</strong></td></tr>';
            }
            $html .= '</table>';
        }
        return $html;
    }
    /****       CB#SR#03-04-2013#PR#S     *****/
    public function getStaff(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('employee_id,employee_name');
        $this->db->from('app_employee');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('is_active', 'Y');
        $this->db->order_by("employee_name", "asc"); 
        $query = $this->db->get();
        $ResStaffRecord = $query->result_array();
        if(count($ResStaffRecord) > 0)
            return $ResStaffRecord;
        else
            return array();
    }
    public function getService(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('service_id,service_name');
        $this->db->from('app_service');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('is_active', 'Y');
        $this->db->order_by("service_name", "asc"); 
        $query = $this->db->get();
        $ResServiceRecord = $query->result_array();
        if(count($ResServiceRecord) > 0)
            return $ResServiceRecord;
        else
            return array();
    }
    
    public function GetMoreDetails($bookingId,$customerId,$local_admin_id){
		$this->db->select('pre_booking_field_name,pre_booking_field_value');
        $this->db->from('app_pre_booking_customer_details');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('booking_id', $bookingId);
        $this->db->where('customer_id', $customerId);
        $query = $this->db->get();
        $Record = $query->result_array();
        return $Record;
       
	}
    
    
    
    
    /*****      CB#SR#03-04-2013#PR#E     *****/
}