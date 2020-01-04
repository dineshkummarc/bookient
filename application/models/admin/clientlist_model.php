<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientlist_model extends CI_Model{
    public $_resultArr;
    public function changeDtFrmat($date)
    {
        $oldDate = $date;
        $arr = explode('/', $oldDate);
        return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
	
    public function check_display_customer($registration_start_date,$registration_end_date,$customer_tag,$customer_status,$getalluser,$no_appointments,$not_booked_betwn,$not_book_from_dt,$not_book_to_dt,$postnumbers,$offset){
    	
    	
        $local_admin_id = $this->session->userdata('local_admin_id');					
        $search='';
        if($registration_start_date !='' && $registration_end_date !='' )	{
                $search .= ' AND DATE_FORMAT(date_inserted,"%Y-%m-%d") BETWEEN CAST("'.$this->changeDtFrmat($registration_start_date).'" AS date) AND CAST("'.$this->changeDtFrmat($registration_end_date).'" AS date)  ';
        }	
        if($customer_tag !=''){
                $search .= " AND rs.customer_tag='".$customer_tag."'";
        }
        if($customer_status !=''){
                $search .= " AND user_status='".$customer_status."' ";
        }	
        if($no_appointments ==1){
                $search .= " AND no_of_booking=0 ";
        }	
        if($not_booked_betwn ==1){
            $cus_ids=$this->notBoodedBwCus($not_book_from_dt,$not_book_to_dt);
            $counter=1;
            if(count($cus_ids)>0)
            {
                foreach($cus_ids as $key=>$val){
                    if($counter ==1){
                        $ids=$val['customer_id'];
                    }
                    else{
                        $ids .=",".$val['customer_id'];					
                    }
                    $counter++;
                }
                $search .=" AND user_id not in (".$ids.")";
            }
        }
        $search .=" ORDER BY date_inserted DESC LIMIT ".$postnumbers." OFFSET ".$offset;
        
        
        $sql1=$this->db->query("SELECT vw.* FROM vw_customerdetails vw,app_customer_admin_relationship rs WHERE rs.customer_id=vw.user_id AND rs.local_admin_id='".$local_admin_id."' ".$search);	
        $finalArray = $sql1->result_array();
        $this->_resultArr = $finalArray;
        //echo "<pre>";print_r($finalArray);echo "</pre>";exit;		
        return $this->geTotaltHtml($finalArray,$offset);		
        												
    }
    
    
    public function notBoodedBwCus($not_book_from_dt , $not_book_to_dt){
        $search = ' AND DATE_FORMAT(booking_date_time,"%Y-%m-%d") BETWEEN CAST("'.$this->changeDtFrmat($not_book_from_dt).'" AS date) AND CAST("'.$this->changeDtFrmat($not_book_to_dt).'" AS date) ';	
        $select=' customer_id';
        $Arr=$this->global_mod->mainBookingStorePro($search,$select);
        return $Arr;
    }

    public function geTotaltHtml($finalArray,$offset){
        $registration_start_date = $this->input->post('regstdate');
        $registration_end_date = $this->input->post('regenddate');
        $customer_tag = $this->input->post('tag');
        $customer_status = $this->input->post('status');
        $getalluser = $this->input->post('getalluser');
        $no_appointments = $this->input->post('no_appointments');
        $not_booked_betwn = $this->input->post('not_booked_betwn');
        $not_book_from_dt = $this->input->post('not_book_from_dt');
        $not_book_to_dt = $this->input->post('not_book_to_dt');
        #########################################################################
        $status = 0;
        
       if($offset == 0){
	   		$html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("client_list")).'</div>';
	        $html .= '
	            <form name="ExportExcel" id="ExportExcel" action="" method="post">
	            <div class="print">
	            <a href="'.site_url('admin/clientlist/getPrint?registration_start_date='.$registration_start_date.'&registration_end_date='.$registration_end_date.'&customer_tag='.$customer_tag.'&customer_status='.$customer_status.'&getalluser='.$getalluser.'&no_appointments='.$no_appointments.'&not_booked_betwn='.$not_booked_betwn.'&not_book_from_dt='.$not_book_from_dt).'&not_book_to_dt='.$not_book_to_dt.'">
	            <img src="/images/print.png" />'.$this->global_mod->db_parse($this->lang->line("prnt_page")).'</a> <a href="JavaScript:void(0);" onClick="exporton()">
	            <img src="/images/export_excel.png" />'.$this->global_mod->db_parse($this->lang->line("xport_2_excel")).'</a>
	            </div></form>';
          

        $html .='<table class="client-list" cellspacing="0" cellpadding="0" width="98%">
            <thead>				  	
                <tr>				  	
                    <th>'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>				  	
                    <th>'.$this->global_mod->db_parse($this->lang->line("client_name")).'</th>				  	
                    <th>'.$this->global_mod->db_parse($this->lang->line("cntct_info")).'</th>			  	
                </tr>				  	
            </thead>				  	
            <tbody>';
         }else{
		 	$html .='<table class="client-list" cellspacing="0" cellpadding="0" width="98%">';
		 }   

        if(count($finalArray) >0){
            $grpdate='';
            $sr=1;		
            foreach ($finalArray as $key=>$result)
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
                if($this->lastBook($result['user_id']) ==0){
                    $lstbk='';
                }
                else{
                    $lstbk='<br/>'.$this->global_mod->db_parse($this->lang->line("last_booked")).'('.DATE("D, M j, Y g:i a", STRTOTIME($this->lastBook($result['user_id']))).')';
                }
                $who_booked = $cus_fname.' '.$cus_lname.'<br>'.$user_email.'<br>Registered on ('.DATE("D, M j, Y g:i a", STRTOTIME($result["date_inserted"])).')'.$lstbk;

                $contact_info = '';
                if($cus_address != '')
                        $contact_info .= $cus_address;
                if($city_name != '')
                        $contact_info .= '<br>'.$city_name;
                else
                        $contact_info .= '<br>No City';
                if($region_name != '')
                        $contact_info .= ', '.$region_name;
                else
                        $contact_info .= ', No Region';
                if($country_name != '')
                        $contact_info .= ', '.$country_name;
                else
                        $contact_info .= ', No Country';
                if($cus_zip != '')
                        $contact_info .= '<br>'.$cus_zip;
                if($cus_mob != '')
                        $contact_info .= '<br>'.$cus_mob.'(M)';
                if($cus_phn1 != '')
                        $contact_info .= '<br>'.$cus_phn1;
                if($cus_phn2 != '')
                        $contact_info .= '<br>'.$cus_phn2;


                if($grpdate !=DATE("j F, Y g:i a", STRTOTIME($result["date_inserted"]))){
                    $html .= '<tr>
                                <td colspan="8">'.DATE("j F, Y g:i a", STRTOTIME($result["date_inserted"])).'</td>
                             </tr>';
                    $grpdate=DATE("j F, Y g:i a", STRTOTIME($result["date_inserted"]));
                }				  
                $html .= ' <tr>
                <!--td>'.$sr.'</td -->
                <td></td>
                <td>'.$who_booked.'</td>
                <td>'.$contact_info.'</td>
                </tr>';
                $sr++;
            }
        }
        else
        {
        	
          $html .= '<tr><td colspan="4" align="center"><strong>'.$this->global_mod->db_parse($this->lang->line("no_data_found")).'.</strong></td></tr>';
          $status = 1;
        }								
        $html .='<tbody></table>';	
        
        return 	$status.'xy#$@'.$html;				 	
    }
	
    public function lastBook($cus_id){
        $search = ' AND customer_id='.$cus_id.' Order by booking_date_time DESC LIMIT 0,1 ';	
        $select=' booking_date_time';
        $Arr=$this->global_mod->mainBookingStorePro($search,$select);
        if(count($Arr) > 0){
            return $Arr[0]['booking_date_time'];		
        }
        else{
            return 0;	
        }
    }
    public function customerStatus()
    {
        
    }
}