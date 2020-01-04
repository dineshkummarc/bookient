<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model{

    public $_resultArr;
    public function getCurrencysymbol($currency_id){
        $this->db->select('currency_symbol,currency_abbriviation');
        $this->db->from('app_currency');
        $this->db->where('currency_id', $currency_id); 
        $query = $this->db->get();
        $curr =  $query->result_array();
        return $curr;
    }
    public function get_currency()
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql = "SELECT distinct(ab.currency_id), ac.currency_abbriviation, ac.currency_symbol FROM app_booking AS ab, app_currency AS ac WHERE 
                    ab.local_admin_id = '".$local_admin_id."' AND 
                    ac.currency_id = ab.currency_id";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    public function getDailyReport(){
        $Arr = $this->_resultArr;
        /*
        echo "<pre>";
        print_r($Arr);echo "</pre>";exit;
        */
        $currency_type = $this->input->post('currency_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        #############################################
        $curArr = $this->getCurrencysymbol($currency_type);
        $currency_symbol = $curArr[0]['currency_symbol'];
        #############################################
        
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->lang->line("sales_report").'::'.$this->global_mod->db_parse($this->lang->line("detail_report_from")).DATE("dS F, Y", STRTOTIME($date_from)).'. '.$this->global_mod->db_parse($this->lang->line("to")).DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        if(count($returnArr) > 0) {
            $html.='<div>
                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                <div class="print">
                <a href="'.site_url('admin/sales_report/getReportPrint?currency_type='.$currency_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
                <img src="/images/print.png">
                '.$this->lang->line("print_page").'
                </a>
                <a onClick="exporton()" href="javascript:void(0);">
                <img src="/images/export_excel.png">
                '.$this->lang->line("export_to_excel").'
                </a>
                </div>
                </form>
              </div>';
        }
        $html.= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
          <tr>
                <th width="5%">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th width="25%">'.$this->global_mod->db_parse($this->lang->line("who_booked")).'</th>
                <th width="15%">'.$this->global_mod->db_parse($this->lang->line("service")).'</th>
                <th width="15%">'.$this->global_mod->db_parse($this->lang->line("staff")).'</th>
                <th width="15%">'.$this->global_mod->db_parse($this->lang->line("appointment_date")).'</th>
                <th width="10%" style="text-align:right">'.$this->global_mod->db_parse($this->lang->line("amount")).'('.$currency_symbol.')</th>
                <th width="5%"></td>  
                <th width="10%">'.$this->global_mod->db_parse($this->lang->line("info")).'</th>
          </tr>';
        $sr=1;
        $grpdate='';
        $Booking_id='';
        $cus_id='';
        $total_cost = 0;
        if(count($returnArr) > 0)
        {
            foreach($returnArr as $key=>$result)
            {						  
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
                $data_added     =$result["booking_date_time"];
                
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
                      $contact_info .= '<br>'.$this->lang->line("no_city");
                if($region_name != '')
                      $contact_info .= ', '.$region_name;
                else
                      $contact_info .= ','.$this->lang->line("no_region");
                if($country_name != '')
                      $contact_info .= ', '.$country_name;
                else
                      $contact_info .= ','.$this->lang->line("no_country");
                if($cus_zip != '')
                      $contact_info .= '<br>'.$cus_zip;
                if($cus_mob != '')
                      $contact_info .= '<br>'.$cus_mob.$this->lang->line("m");
                if($cus_phn1 != '')
                      $contact_info .= '<br>'.$cus_phn1;
                if($cus_phn2 != '')
                      $contact_info .= '<br>'.$cus_phn2;

                if($result["srvDtls_booking_status"] == 1)
                      $status = $this->lang->line("approved");
                else
                      $status = $this->lang->line("unapproved");

                if($grpdate !=DATE("j F, Y", STRTOTIME($result["booking_date_time"]))){
                    $html .= '<tr>
                                    <td colspan="8">'.DATE("j F, Y", STRTOTIME($result["booking_date_time"])).'</td>
                             </tr>';
                    $grpdate=DATE("j F, Y", STRTOTIME($result["booking_date_time"]));
                }					
                $html .= ' <tr>';
                if($Booking_id !=$result["booking_id"] )
                {
                    $html .= '<td width="5%">'.$sr.'</td>';
                    $sr++;
                    if($Booking_id !=$result["booking_id"] || $cus_id !=$result["customer_id"]){
                        $html .= '<td width="25%">'.$who_booked.'</td>';
                        $cus_id=$result["customer_id"];		
                    }else{
                        $html .= '<td></td>';	
                    }
                    $Booking_id	=$result["booking_id"];	
                }else{
                    $html .= '<td></td>';	
                    $html .= '<td></td>';	
                }
                $html .= '<td width="15%">'.$service.'</td>
                    <td width="15%">'.$result["srvDtls_employee_name"].'</td>
                    <td width="15%">'.DATE("j F, Y g:i a", STRTOTIME($result["srvDtls_service_start"])).'</td>
                    <td width="10%" align="right">'.$result["srvDtls_service_cost"].'</td>
                    <td width="5%"></td>    
                    <td width="10%">'.$status.'</td>
                  </tr>';
                $total_cost = $total_cost + $result["srvDtls_service_cost"];
                /*if(isset($currency[$result["currency_id"]])){
                    $currency[$result["currency_id"]]= $currency[$result["currency_id"]]+$result["srvDtls_service_cost"];						  	
                }
                else{
                    $currency[$result["currency_id"]] =$result["srvDtls_service_cost"];
                }*/
            }
            $html .='<tr>';
            $html .='<td colspan="5" align="right">'.$this->lang->line("total").'</td>';
            //$tolal='';
            //foreach($currency as $key=>$val){
                  //$tolal .= $val."<br/> ";				  	
            //}
            $html .='<td align="right">'.$currency_symbol.$total_cost.'</td>';
            $html .='<td colspan="2"></td>';
            $html .='</tr>';
            /*echo "<pre>";
            print_r($currency);echo "</pre>";exit;*/
        }
        else
        {
            $html .= '<tr><td colspan="8" align="center"><strong style="">'.$this->lang->line("no_result_found").'</strong></td></tr>';
        }
        $html .= '</table>';
        return $html;
    }
	
    public function getGroupByDateReport(){
        $Arr = $this->_resultArr;
        /*
        echo "<pre>";
        print_r($Arr);echo "</pre>";exit;
        */
        $currency_type = $this->input->post('currency_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        #############################################
        $curArr = $this->getCurrencysymbol($currency_type);
        $currency_symbol = $curArr[0]['currency_symbol'];
        #############################################
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("sales_report")).' :: '.$this->global_mod->db_parse($this->lang->line("group_by_date_from")).' '.date("dS F, Y", strtotime($date_from)).'. '.$this->global_mod->db_parse($this->lang->line("to")).date("dS F, Y", strtotime($date_to)).'</div>';
        if(count($returnArr) > 0) {
           $html.='<div>
                    <form id="ExportExcel" method="post" action="" name="ExportExcel">
                    <div class="print">
                    <a href="'.site_url('admin/sales_report/getReportPrint?currency_type='.$currency_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
                    <img src="/images/print.png">
                    '.$this->lang->line("print_page").'
                    </a>
                    <a onClick="exporton()" href="javascript:void(0);">
                    <img src="/images/export_excel.png">
                    '.$this->lang->line("export_to_excel").'
                    </a>
                    </div>
                    </form>
            </div>';
        }
        $html .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
          <tr>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th width="25%" align="center">'.$this->global_mod->db_parse($this->lang->line("date")).'</th>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
                <th width="15%" style="text-align:right">'.$this->global_mod->db_parse($this->lang->line("amount")).'('.$currency_symbol.')</th>
                <th width="15%" align="center"></th>
          </tr>';
        if(count($returnArr) > 0)
        {
            $count=1;
            $appointment=0;
            $users=0;
            $cost=0;
            $total_cost = 0;
            foreach($returnArr as $rows)
            {
                $html .= '<tr>
                      <td width="15%" align="center">'.$count.'</td>
                      <td width="25%">'.date("j F  Y", strtotime($rows["dispdate"])).'</td>
                      <td width="15%" style="padding-left:60px;">'.$rows["appointment"].'</td>
                      <td width="15%" style="padding-left:32px;">'.$rows["users"].'</td>
                      <td width="15%" align="right" style="padding-left:32px;">'.$rows["cost"].'</td>
                      <td width="15%"></td>    
                  </tr>';
                $appointment= $appointment + $rows["appointment"];
                $users= $users + $rows["users"];
                $cost	= $cost + $rows["cost"];
                $count=$count +1;
                $total_cost = $total_cost + $rows["cost"];
            }
            $html .='<tr>';
            $html .='<td colspan="4" align="right">'.$this->lang->line("total").'</td>';
            $html .='<td align="right">'.$currency_symbol.$total_cost.'</td>';
            $html .='<td align="left" width="15%"></td>';
            $html .='</tr>';
        }
        else
        {
          $html .= '<tr><td colspan="6" align="center"><strong>'.$this->lang->line("no_result_found").'</strong></td></tr>';
        }
        $html .= '</table>';
        return  $html;
    }
	
    public function getGroupByMonthReport(){
        $Arr = $this->_resultArr;
        /*
        echo "<pre>";
        print_r($Arr);echo "</pre>";exit;
        */
        $currency_type = $this->input->post('currency_type');
        $display_type = $this->input->post('display_type');
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));
        $service = $this->input->post('service');
        $staff = $this->input->post('staff');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        #############################################
        $curArr = $this->getCurrencysymbol($currency_type);
        $currency_symbol = $curArr[0]['currency_symbol'];
        #############################################
        $returnArr=$Arr;
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("sales_report")).' :: '.$this->global_mod->db_parse($this->lang->line("group_by_month_from")).' '.DATE("dS F, Y", STRTOTIME($date_from)).'. '.$this->global_mod->db_parse($this->lang->line("to")).DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        if(count($returnArr) > 0) {
            $html.='<div>
                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                <div class="print">
                <a href="'.site_url('admin/sales_report/getReportPrint?currency_type='.$currency_type.'&display_type='.$display_type.'&date_from='.$date_from.'&date_to='.$date_to.'&service='.$service.'&staff='.$staff.'&status='.$status.'&username='.$username).'">
                <img src="/images/print.png">
                '.$this->lang->line("print_page").'
                </a>
                <a onClick="exporton()" href="javascript:void(0);">
                <img src="/images/export_excel.png">
                '.$this->lang->line("export_to_excel").'
                </a>
                </div>
                </form>
            </div>';
        }
        $html .= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
            <tr>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
                <th width="25%" align="center">'.$this->global_mod->db_parse($this->lang->line("month")).'</th>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("appointments")).'</th>
                <th width="15%" align="center">'.$this->global_mod->db_parse($this->lang->line("users")).'</th>
                <th width="15%" style="text-align:right">'.$this->global_mod->db_parse($this->lang->line("amount")).'('.$currency_symbol.')</th>
                <th width="15%"></th>    
            </tr>';
        if(count($returnArr) > 0)
        {
            $count=1;
            $appointment=0;
            $users=0;
            $cost=0;
            $total_cost = 0;
            foreach($returnArr as $rows)
            {
                $html .= '<tr>
                      <td width="15%" align="center">'.$count.'</td>
                      <td width="25%">'.DATE("F  Y", STRTOTIME("01-".$rows["dispdate"])).'</td>
                      <td width="15%" style="padding-left:60px;">'.$rows["appointment"].'</td>
                      <td width="15%" style="padding-left:32px;">'.$rows["users"].'</td>
                      <td width="15%" align="right">'.$rows["cost"].'</td>
                      <td width="15%"></td>    
                </tr>';
                $appointment= $appointment + $rows["appointment"];
                $users= $users + $rows["users"];
                $cost	= $cost + $rows["cost"];
                $count=$count +1;
                $total_cost = $total_cost + $rows["cost"];
            }
            $html .='<tr>';
            $html .='<td colspan="4" align="right">'.$this->lang->line("total").'</td>';
            $html .='<td colspan="1" align="right">'.$currency_symbol.$total_cost.'</td>';
            $html .='</tr>';
        }
        else
        {
            $html .= '<tr><td colspan="5" align="center"><strong>'.$this->lang->line("no_result_found").'</strong></td></tr>';
        }
        $html .= '</table>';
        return  $html;		
    }
	
    public function generateReportHtml($type){
        if($type==1){
            $html = $this->getDailyReport();
        }
        elseif($type==2){
            $html = $this->getGroupByDateReport();
        }
        elseif($type==3){
            $html = $this->getGroupByMonthReport();
        }
        return $html;
    }

    public function GetReports()
    {
        $search = '';
        $sr = 0;
        $returnArr = array();
        $ResultArray=array();
        $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));

        if($this->input->post('currency_type') != '')
        {
            $search .= " and currency_id = ".$this->input->post('currency_type');
        }
        if($this->input->post('service') != '')
        {
            $search .= " and srvDtls_service_id = ".$this->input->post('service');
        }
        if($this->input->post('staff') != '')
        {
            $search .= " and srvDtls_employee_id = ".$this->input->post('staff');
        }
        if($this->input->post('status') != '')
        {
            $search .= " and srvDtls_booking_status = ".$this->input->post('status');
        }
        if($this->input->post('username') != 'Client Username' && $this->input->post('username') != 'Asiakkaan käyttäjätunnus' && $this->input->post('username') != '')
        {
            $this->db->select('user_id');
            $this->db->from('app_password_manager');
            $this->db->where('user_name', $this->input->post('username'));
            $this->db->where('user_type', 1);
            $qry = $this->db->get();
            if($qry->num_rows())
            {
                $CusArr =  $qry->result_array();
                $search .= " and customer_id = ".$CusArr[0]['user_id'];
            }
            else
            {
                $search .= " and customer_id = NULL";
            }
        }
        $select ='';
        $search .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$date_from.'" AS date) AND CAST("'.$date_to.'" AS date)  ';

        if($this->input->post('display_type') == 1)
        {		 
            $search .= ' ORDER BY booking_date_time ASC';
            //echo $search;exit;
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search);
        }
        if($this->input->post('display_type') == 2)  // group by date
        {			
            $search .= ' group by DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") ';
            $select =  ' currency_id,DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ,sum(srvDtls_service_cost) as cost';
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search,$select);		
        }
        if($this->input->post('display_type') == 3)
        {			
            $search .= ' group by month(srvDtls_service_start) ';
            $select =  ' currency_id,DATE_FORMAT(srvDtls_service_start,"%m-%Y") dispdate, count(srvDtls_service_id) as appointment, count(srvDtls_employee_id) as users ,sum(srvDtls_service_cost) as cost';						
            $this->_resultArr = $this->global_mod->mainBookingStoreProReport($search,$select);				
        }		
        return $this->generateReportHtml($this->input->post('display_type'));			
    }

    public function GetReports1()
    {
            $html = "";
            $returnArr = array();
            $count=0;
            $total=0;

            $date_from = date("Y-m-d",strtotime($this->input->post('date_from')));
            $date_to = date("Y-m-d",strtotime($this->input->post('date_to')));

            $returnArr['date_from'] = date("d",strtotime($this->input->post('date_from')))."-".date("M",strtotime($this->input->post('date_from')))."-".date("Y",strtotime($this->input->post('date_from')));
            $returnArr['date_to'] = date("d",strtotime($this->input->post('date_to')))."-".date("M",strtotime($this->input->post('date_to')))."-".date("Y",strtotime($this->input->post('date_to')));

            $search="";
            if($this->input->post('service') != '')
            {
                    $search .= " and service.service_id = ".$this->input->post('service');
            }
            if($this->input->post('staff') != '')
            {
                    $search .= " and service.employee_id = ".$this->input->post('staff');
            }
            if($this->input->post('status') != '')
            {
                    $search .= " and service.booking_status = ".$this->input->post('status');
            }
            if($this->input->post('username') != 'Client Username' && $this->input->post('username') != 'Asiakkaan käyttäjätunnus')
            {
                    $this->db->select('user_id');
                    $this->db->from('app_password_manager');
                    $this->db->where('user_name', $this->input->post('username'));
                    $this->db->where('user_type', 1);
                    $qry = $this->db->get();
                    if($qry->num_rows())
                    {
                            $CusArr =  $qry->result_array();
                            $search .= " and booking.customer_id = ".$CusArr[0]['user_id'];
                    }
                    else
                    {
                            $search .= " and booking.customer_id = NULL";
                    }
            }

            //echo "select booking.*,service.* from app_booking as booking,app_booking_service as service where booking.booking_date_time>='".$date_from."' and booking.booking_date_time<='".$date_to."' and booking.booking_id=service.booking_id and service.booking_status=1";
            if($this->input->post('display_type') == 1)
            {
                    $query = $this->db->query("select booking.*,service.* from app_booking as booking,app_booking_service_details as service where DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') >= '".$date_from."' and DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') <= '".$date_to."' and booking.local_admin_id = ".$this->session->userdata('local_admin_id')."  and booking.booking_id=service.booking_id and service.booking_status=1 ".$search);
                    $rows = $query->num_rows();
                    $html = '<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->lang->line("sales_report").'('.$returnArr["date_from"].$this->lang->line("to").$returnArr["date_to"].','.$this->lang->line("detail_report").')</div>';
                    if($rows > 0)
                    {
                        $html.= '<div>
                                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                                <div class="print">
                                <a onClick="printon()" href="javascript:void(0);">
                                <img src="/images/print.png">
                                '.$this->lang-line("print_page").'
                                </a>
                                <a onClick="exporton()" href="javascript:void(0);">
                                <img src="/images/export_excel.png">
                                '.$this->lang-line("export_to_excel").'
                                </a>
                                </div>
                                </form>
                        </div>
                        ';
                    }
                    $html.= '<table width="98%"  cellspacing="0" cellpadding="0"  class="list-view">
                                              <tr>
                                                    <th>'.$this->lang->line("sr_no").'</th>
                                                    <th>'.$this->lang->line("service_name").'</th>
                                                    <th>'.$this->lang->line("service_duration").'</th>
                                                    <th>'.$this->lang->line("service_cost").'</th>
                                                    <th>'.$this->lang->line("staff").'</th>
                                                    <th>'.$this->lang->line("appointment_date").'</th>
                                              </tr>';
                    if($rows > 0)
                    {
                            foreach($query->result() as $key=>$NewArray)
                            {
                                    $count++;

                                    $total = $total+$NewArray->service_cost;

                                    $this->db->select('employee_name');
                                    $this->db->from('app_employee');
                                    $this->db->where('employee_id', $NewArray->employee_id);
                                    $query1 = $this->db->get();
                                    $EmpArr =  $query1->result_array();

                                    if(count($EmpArr) > 0)
                                    {

                                                    $staff = $EmpArr[0]['employee_name'];

                                                    if($NewArray->service_duration_unit == 'M')
                                                    {
                                                            $unit = $this->lang->line("mins").'.';
                                                    }
                                                    else
                                                    {
                                                            $unit = $this->lang->line("hrs").'.';
                                                    }
                                                    $html .= '<tr>
                                                                            <td style="padding-left:10px;">'.$count.'</td>
                                                                            <td style="padding-left:25px;">'.$NewArray->service_name.'</td>
                                                                            <td style="padding-left:25px;">'.$NewArray->service_duration.' '.$unit.'</td>
                                                                            <td style="padding-left:25px;">'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$NewArray->service_cost.'</td>
                                                                            <td style="padding-left:10px;">'.$staff.'</td>
                                                                            <td style="padding-left:25px;">'.date("m/d/Y",strtotime($NewArray->booking_date_time)).'</td>
                                                                      </tr>';

                                    }
                            }
                            $html .= '<tr><th colspan="6" align="right"><strong>'.$this->lang->line("total_service_cost").': </strong>&nbsp;'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$total.'</th>';
                    }
                    else
                    {
                                    $html .= '<tr><td colspan="6" align="center"><strong>'.$this->lang->line("no_records_found").'</strong></td></tr>';
                    }
            }
            elseif($this->input->post('display_type') == 2)
            {
                    //echo "select count(service.service_name) as services,sum(service.service_cost) as service_cost,booking_date_time from app_booking as booking,app_booking_service as service where booking.booking_date_time>='".$date_from."' and booking.booking_date_time<='".$date_to."' and booking.local_admin_id = ".$this->session->userdata('local_admin_id')." and booking.booking_id=service.booking_id and service.booking_status=1 group by booking.booking_date_time";
                    $query = $this->db->query("select count(service.service_name) as services,sum(service.service_cost) as service_cost,booking.booking_date_time from app_booking as booking,app_booking_service_details as service where DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') >= '".$date_from."' and DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') <= '".$date_to."' and booking.local_admin_id = ".$this->session->userdata('local_admin_id')." and booking.booking_id=service.booking_id and service.booking_status=1 ".$search." group by booking.booking_date_time");
                    $rows = $query->num_rows();

                    $html = '<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->lang->line("sales_report").'('.$returnArr["date_from"].$this->lang->line("to").$returnArr["date_to"].','.$this->lang->line("group_by_date").')</div>';
                    if($rows > 0)
                    {
                        $html.= '<div>
                                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                                <div class="print">
                                <a onClick="printon()" href="#">
                                <img src="/images/print.png">
                               '.$this->lang->line("print_page").'
                                </a>
                                <a onClick="exporton()" href="#">
                                <img src="/images/export_excel.png">
                               '.$this->lang->line("export_to_excel").'
                                </a>
                                </div>
                                </form>
                        </div>
                        ';
                    }
                    $html.= '<table width="98%"  cellspacing="0" cellpadding="0"  class="list-view">
                                              <tr>
                                                    <th align="center">'.$this->lang->line("sr_no").'</th>
                                                    <th align="center">'.$this->lang->line("service_date").'</th>
                                                    <th align="center">'.$this->lang->line("no_of_services").'</th>
                                                    <th align="center">'.$this->lang->line("total_cost").'</th>
                                              </tr>';
                    if($rows > 0)
                    {
                            foreach($query->result() as $key=>$NewArray)
                            {
                                    $count++;
                                    $total = $total+$NewArray->service_cost;

                                    $html .= '<tr>
                                                            <td style="padding-left:10px;">'.$count.'</td>
                                                            <td style="padding-left:20px;">'.date("m/d/Y",strtotime($NewArray->booking_date_time)).'</td>
                                                            <td style="padding-left:30px;">'.$NewArray->services.'</td>
                                                            <td style="padding-left:20px;">'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$NewArray->service_cost.'</td>
                                                      </tr>';
                            }
                            $html .= '<tr><th colspan="4" align="right"><strong>'.$this->lang->line("total_service_cost").': </strong>&nbsp;'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$total.'</th>';

                    }
                    else
                    {
                                    $html .= '<tr><td colspan="4" align="center"><strong>'.$this->lang->line("no_records_found").'</strong></td></tr>';
                    }
            }
            elseif($this->input->post('display_type') == 3)
            {
                    //echo "select count(service.service_name) as service_name,sum(service.service_cost) as service_cost,month(booking_date_time) from app_booking as booking,app_booking_service as service where booking.booking_date_time>='".$date_from."' and booking.booking_date_time<='".$date_to."' and booking.local_admin_id = ".$this->session->userdata('local_admin_id')."  and booking.booking_id=service.booking_id and service.booking_status=1 group by month(booking.booking_date_time)";
                    $query = $this->db->query("select count(service.service_name) as services,sum(service.service_cost) as service_cost,month(booking_date_time) as month from app_booking as booking,app_booking_service_details as service where DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') >= '".$date_from."' and DATE_FORMAT(booking.booking_date_time,'%Y-%m-%d') <= '".$date_to."' and booking.local_admin_id = ".$this->session->userdata('local_admin_id')." and booking.booking_id=service.booking_id and service.booking_status=1 ".$search." group by month(booking.booking_date_time)");
                    $rows = $query->num_rows();

                    $html = '<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->lang->line("sales_report").'('.$returnArr["date_from"].$this->lang->line("to").$returnArr["date_to"].','.$this->lang->line("group_by_month").')</div>';
                    if($rows > 0)
                    {
                        $html.='<div>
                                <form id="ExportExcel" method="post" action="" name="ExportExcel">
                                <div class="print">
                                <a onClick="printon()" href="#">
                                <img src="/images/print.png">
                               '.$this->lang->line("print_page").'
                                </a>
                                <a onClick="exporton()" href="#">
                                <img src="/images/export_excel.png">
                                '.$this->lang->line("export_to_excel").'
                                </a>
                                </div>
                                </form>
                        </div>
                        ';
                    }
                    $html.= '<table width="98%"  cellspacing="0" cellpadding="0"  class="list-view">
                                              <tr>
                                                    <th align="center">'.$this->lang->line("sr_no").'</th>
                                                    <th align="center">'.$this->lang->line("service_month").'</th>
                                                    <th align="center">'.$this->lang->line("no_of_services").'</th>
                                                    <th align="center">'.$this->lang->line("total_cost").'</th>
                                              </tr>';
                    if($rows > 0)
                    {
                            foreach($query->result() as $key=>$NewArray)
                            {
                                    $count++;
                                    $total = $total+$NewArray->service_cost;

                                    $timestamp = mktime(0, 0, 0, $NewArray->month, 1, 2005);
                                    $month = date("M", $timestamp);

                                    $html .= '<tr>
                                                            <td style="padding-left:10px;">'.$count.'</td>
                                                            <td style="padding-left:20px;">'.$month.'</td>
                                                            <td style="padding-left:20px;">'.$NewArray->services.'</td>
                                                            <td style="padding-left:20px;">'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$NewArray->service_cost.'</td>
                                                      </tr>';
                            }
                            $html .= '<tr><th colspan="4" align="right"><strong>'.$this->lang->line("total_service_cost").' : </strong>&nbsp;'.$this->session->userdata('local_admin_currency_type').'&nbsp;'.$total.'</th>';

                    }
                    else
                    {
                                    $html .= '<tr><td colspan="4" align="center"><strong>'.$this->lang->line("no_records_found").'</strong></td></tr>';
                    }
            }

            echo $html;
    }
}
?>