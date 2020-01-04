<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Clientlist extends Pardco {

    public function __construct()
    {
            parent::__construct();

            $this->load->helper('url');
            $this->load->database();
            $this->load->model('admin/clientlist_model');
            $this->load-> library('pdf/mpdf');
            /*===================LogIn Security Check===================*/
             /* $logged_in_Status = $this->session->userdata('logged_in');
              $local_admin_id = $this->session->userdata('local_admin_id');
              $user_id_local_admin = $this->session->userdata('user_id_local_admin');
              if(!$logged_in_Status)
              {
                      redirect(base_url().'admin/login');
              }
              else
              {
                      if($user_id_local_admin != $local_admin_id)
                      {
                              $this->session->sess_destroy();
                              redirect(base_url());
                      }
              }*/
              $this->global_mod->checkSession();
            /*===================LogIn Security Check===================*/
            
            /*########Start Language #######*/
			$default_language = 'english'; // it should be local admin language
			if($this->session->userdata('admin_language') == ''){
	            $this->lang->load('admin_clientlist',$default_language);
	            $this->lang->load('admin_global',$default_language);
	        }else{
	            $setLanguage = strtolower($this->session->userdata('admin_language'));
	            $this->lang->load('admin_clientlist',$setLanguage);
	            $this->lang->load('admin_global',$setLanguage);
	        }
			/*########End Language#######*/
    }

    public function index()
    {
        
		
		//$this->lang->load('admin_clientlist');
        $this->load->view('admin/header');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $data['customer_status']= $this->clientlist_model->customerStatus();


        $this->load->view('admin/clientlist/clientlist',$data);

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }

    
    public function display_customer()
    {
    	$postnumbers = $_POST['number'];
    	$offset = explode(',',$_POST['offset']);
    	
    	$registration_start_date 	= isset($offset[1])?$offset[1]:'';
    	$registration_end_date 		= isset($offset[2])?$offset[2]:'';
    	$customer_status 			= isset($offset[3])?$offset[3]:'';
    	$customer_tag				= isset($offset[4])?$offset[4]:'';
    	$getalluser					= isset($offset[5])?$offset[5]:'';
    	$no_appointments			= $offset[6];
    	$not_booked_betwn			= $offset[7];
    	$not_book_from_dt			= $offset[8];
    	$not_book_to_dt				= $offset[9];
    	
        $cus_rtn=$this->clientlist_model->check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status,$getalluser,$no_appointments,$not_booked_betwn,$not_book_from_dt,$not_book_to_dt,$postnumbers,$offset[0]);
        echo $cus_rtn;
        //echo $NewDataTest;
    }

    public function getPrint()
    {
        $_POST=$_GET;
        $local_admin_id = $this->session->userdata('local_admin_id');
        $registration_start_date=isset($_REQUEST['regstdate'])?$_REQUEST['regstdate']:'';
        $registration_end_date=isset($_REQUEST['regenddate'])?$_REQUEST['regenddate']:'';
        $customer_tag=isset($_REQUEST['customer_tag'])?$_REQUEST['customer_tag']:'';
        $customer_status=isset($_REQUEST['customer_status'])?$_REQUEST['customer_status']:'';
        $getalluser=$_REQUEST['getalluser'];
        $no_appointments=$_REQUEST['no_appointments'];
        $not_booked_betwn=isset($_REQUEST['not_booked_betwn'])?$_REQUEST['not_booked_betwn']:'';
        $not_book_from_dt=isset($_REQUEST['not_book_from_dt'])?$_REQUEST['not_book_from_dt']:'';
        $not_book_to_dt=isset($_REQUEST['not_book_to_dt'])?$_REQUEST['not_book_to_dt']:'';
        $this->clientlist_model->check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status,$getalluser,$no_appointments,$not_booked_betwn,$not_book_from_dt,$not_book_to_dt);
        
        $arrData = $this->clientlist_model->_resultArr;
        
        $mpdf=new mPDF('','A4-L','','',10,10,10,10,6,3); //narrow margin
        $wm = base_url();
        $mpdf->SetWatermarkText($wm, 0.02);
        $mpdf->showWatermarkText = true;
        ################################################################
        $count = 1;
        $top ='<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("client_list").'</div>';
        $mpdf->WriteHTML($top);
        $head = '<table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                    <th align="center" width="10%">'.$this->lang->line("sl_no").'</th>
                    <th align="left" width="45%">'.$this->lang->line("client_name").'</th>
                    <th align="left" width="45%">'.$this->lang->line("cntct_info").'</th>
              </tr></table>';
        ################################################################
        $mpdf->WriteHTML($head);
        ################################################################
        $tablehead = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $mpdf->WriteHTML($tablehead);
        foreach($arrData as $result)
        {
            $user_email     = $result['user_email'];
            $cus_fname      = $result['cus_fname'];
            $cus_lname      = $result['cus_lname'];
            $cus_mob        = $result['cus_mob'];
            $cus_phn1       = $result['cus_phn1'];
            $cus_phn2       = $result['cus_phn2'];
            $cus_address    = $result['cus_address'];
            $city_name      = $result['city_name'];
            $region_name    = $result['region_name'];
            $country_name   = $result['country_name'];
            $cus_zip        = $result['cus_zip'];
            
            $who_booked = $cus_fname.' '.$cus_lname."\n".$user_email."\nRegistered on (".DATE("D, M j, Y g:i a", STRTOTIME($result['date_inserted'])).')';

            $contact_info = '';
            if($cus_address != '')
                    $contact_info .= $cus_address;
            if($city_name != '')
                    $contact_info .= "\n".$city_name;
            else
                    $contact_info .= "\nNo City";
            if($region_name != '')
                    $contact_info .= ', '.$region_name;
            else
                    $contact_info .= ', No Region';
            if($country_name != '')
                    $contact_info .= ', '.$country_name;
            else
                    $contact_info .= ', No Country';
            if($cus_zip != '')
                    $contact_info .= "\n".$cus_zip;
            if($cus_mob != '')
                    $contact_info .= "\n".$cus_mob.'(M)';
            if($cus_phn1 != '')
                    $contact_info .= "\n".$cus_phn1;
            if($cus_phn2 != '')
                    $contact_info .= "\n".$cus_phn2;
            ###############################################################   
            $html = '<tr>
                        <td align="center" width="10%" valign="top">'.$count.'</td>
                        <td align="left" width="45%">'.$who_booked.'</td>
                        <td align="left" width="45%">'.$contact_info.'</td>
                      </tr></table>';
            $html = iconv('ISO-8859-1', 'UTF-8', $html);
            $mpdf->WriteHTML($html);
            $html = '';
            $count=$count +1;
        }
        $html .= '</table>';
        
        $mpdf->WriteHTML($html);
        $mpdf->Output('clientlist.pdf', 'D');
        exit;
    }
    function export_excel_csv()
    {
        ob_clean();
        $_POST=$_GET;
        $local_admin_id = $this->session->userdata('local_admin_id');
        $registration_start_date=isset($_REQUEST['regstdate'])?$_REQUEST['regstdate']:'';
        $registration_end_date=isset($_REQUEST['regenddate'])?$_REQUEST['regenddate']:'';
        $customer_tag=isset($_REQUEST['tag'])?$_REQUEST['tag']:'';
        $customer_status=isset($_REQUEST['status'])?$_REQUEST['status']:'';
        $getalluser=$_REQUEST['getalluser'];
        $no_appointments=$_REQUEST['no_appointments'];
        $not_booked_betwn=$_REQUEST['not_booked_betwn'];
        $not_book_from_dt=isset($_REQUEST['not_book_from_dt'])?$_REQUEST['not_book_from_dt']:'';
        $not_book_to_dt=isset($_REQUEST['not_book_to_dt'])?$_REQUEST['not_book_to_dt']:'';
        $this->clientlist_model->check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status,$getalluser,$no_appointments,$not_booked_betwn,$not_book_from_dt,$not_book_to_dt);
        
        $arrData = $this->clientlist_model->_resultArr;
        
        $filename = 'clientlist.xls';
        $xls = new ExportXLS($filename);
        $header[] = $this->global_mod->db_parse($this->lang->line('sl_no'));
        $header[] = $this->global_mod->db_parse($this->lang->line('client_name'));
        $header[] = $this->global_mod->db_parse($this->lang->line('cntct_info'));
        $xls->addHeader($header);
        $counter = 1;
        foreach($arrData as $result)
        {
            $user_email     = $result['user_email'];
            $cus_fname      = $result['cus_fname'];
            $cus_lname      = $result['cus_lname'];
            $cus_mob        = $result['cus_mob'];
            $cus_phn1       = $result['cus_phn1'];
            $cus_phn2       = $result['cus_phn2'];
            $cus_address    = $result['cus_address'];
            $city_name      = $result['city_name'];
            $region_name    = $result['region_name'];
            $country_name   = $result['country_name'];
            $cus_zip        = $result['cus_zip'];
            
            $who_booked = $cus_fname.' '.$cus_lname.", ".$user_email."\nRegistered on (".DATE("D, M j, Y g:i a", STRTOTIME($result['date_inserted'])).')';

            $contact_info = '';
            if($cus_address != '')
                    $contact_info .= $cus_address;
            if($city_name != '')
                    $contact_info .= ", ".$city_name;
            else
                    $contact_info .= ", No City";
            if($region_name != '')
                    $contact_info .= ', '.$region_name;
            else
                    $contact_info .= ', No Region';
            if($country_name != '')
                    $contact_info .= ', '.$country_name;
            else
                    $contact_info .= ', No Country';
            if($cus_zip != '')
                    $contact_info .= ", ".$cus_zip;
            if($cus_mob != '')
                    $contact_info .= ", ".$cus_mob.'(M)';
            if($cus_phn1 != '')
                    $contact_info .= ", ".$cus_phn1;
            if($cus_phn2 != '')
                    $contact_info .= ", ".$cus_phn2;
            ###############################################################    
            $row = array();
            $row[] = $counter;
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $who_booked);
            $row[] = iconv('ISO-8859-1', 'UTF-8//IGNORE', $contact_info);
            $xls->addRow($row);
            $counter++;
        }
        $xls->sendFile();
        exit;
    }


    public function changeDt_Format($date)
    {
            $oldDate = $date;
            //print $oldDate; exit;
            $arr = explode('-', $oldDate);
           //return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
             return $newDate = $arr[0].'-'.$arr[1].'-'.$arr[2];
    }
}