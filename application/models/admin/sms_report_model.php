<?php

class Sms_Report_model extends CI_Model
{
	public $_resultArr;
    public function __construct(){
        $this->load->database(); 
    }
	public function getBusiness(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
        $sql = "SELECT 
            pass.user_name AS usernm,
            locala.relation_localadmin_id AS localid
        FROM 
            app_password_manager AS pass, 
            app_localadmin_relation AS locala 
        WHERE 
            locala.relation_localadmin_id = pass.user_id AND 
            locala.is_parent = 1 AND 
            locala.relation_parent_id = '".$local_admin_id."'";
      	$a = $this->db->query($sql);
       	$result = $a->result_array() ;
       	return $result;
    }
	
	public function getSms(){
	
		
		$post=$this->input->post();	
		$post['local_admin_id'] = $this->session->userdata('local_admin_id');
		
	
	
	    $this->db->select('*');
        $this->db->from('app_sms_data');
		if($post['date_from'] !='' && $post['date_to'] !=''){
		   	$date_from 	= date("Y-m-d",strtotime($this->input->post('date_from')));
       		$date_to 	= date("Y-m-d",strtotime($this->input->post('date_to')));
       		
       		
			$this->db->where('msg_sent_date_time >=', $date_from);
			$this->db->where('msg_sent_date_time <=', $date_to);
		}
		
		if($post['local_admin_id'] !=''){
			$this->db->where('local_admin_id', $post['local_admin_id']);
		}
		if($post['message_type'] !=''){
			$this->db->where('message_type', $post['message_type']);
		}
		if($post['sent_to'] !=''){
			$this->db->where('sent_to', $post['sent_to']);
		}
		if($post['phone_no'] !=''){
			$this->db->where('phone_no', $post['phone_no']);
		}
		
		$query = $this->db->get();
        $arr=$query->result_array();
		$this->_resultArr = $arr;
		return $this->getReportHtml($arr);		
	}
	public function getReportHtml($returnArr){
        $local_admin_id = $this->input->post('local_admin_id');
        $phone_no       = $this->input->post('phone_no');
        $date_from      = date("Y-m-d",strtotime($this->input->post('date_from')));
        $date_to 		= date("Y-m-d",strtotime($this->input->post('date_to')));
        $sent_to 		= $this->input->post('sent_to');
		$message_type   = $this->input->post('message_type');
        $html ='<div style="text-align:center; font-size:18px; font-weight:700; margin:5px 0;">'.$this->global_mod->db_parse($this->lang->line("headign-main")).' :: '.$this->global_mod->db_parse($this->lang->line("details_report_from")).' '.DATE("dS F, Y", STRTOTIME($date_from)).' '.$this->global_mod->db_parse($this->lang->line("to_sml")).' '.DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
        
		if(count($returnArr) > 0){
           $html.='<div>
		               <form id="ExportExcel" method="post" action="" name="ExportExcel">
			               <div class="print">
				               <a href="'.site_url('admin/sms_report/getSmsPrint?local_admin_id='.$local_admin_id.'&phone_no='.$phone_no.'&date_from='.$date_from.'&date_to='.$date_to.'&sent_to='.$sent_to.'&message_type='.$message_type).'">
				               <img src="/images/print.png">
				               '.$this->global_mod->db_parse($this->lang->line("print_page")).'
				               </a>
				               <a href="'.site_url('admin/sms_report/getSmsExcel?local_admin_id='.$local_admin_id.'&phone_no='.$phone_no.'&date_from='.$date_from.'&date_to='.$date_to.'&sent_to='.$sent_to.'&message_type='.$message_type).'">
				               <img src="/images/export_excel.png">
				               '.$this->global_mod->db_parse($this->lang->line("export_to_excl")).'
				               </a>
			               </div>
		               </form>
		           </div>';
        }
        $html.= '<table width="98%" cellspacing="0" cellpadding="0" class="list-view">
		            <tr>
		                <th align="left" width="5%">'.$this->global_mod->db_parse($this->lang->line("sl_no")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("Business")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("send_to")).'</th>
		                <th align="left" width="15%">'.$this->global_mod->db_parse($this->lang->line("phone_no")).'</th>
		                <th align="left" width="20%">'.$this->global_mod->db_parse($this->lang->line("message")).'</th>
		                <th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("sms_date")).'</th>
						<th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("message_type")).'</th>
		                <th align="left"  width="10%">'.$this->global_mod->db_parse($this->lang->line("event")).'</th>
		            </tr>';
        $sr = 1;
        $grpdate='';
        
       $timeDifference = $this->session->userdata('time_difference');
       $time = explode(':',$timeDifference);
       $timeInmin = ($time[0]*60)+ $time[1];
        
        if(count($returnArr) > 0){		
            foreach($returnArr as $key=>$result){   
            	$addeddate = strtotime("+ ".$timeInmin." minutes", strtotime($result["msg_sent_date_time"]));
            	$formatedDate = date('j F, Y g:i a', $addeddate);
                       
                $html .= '<tr>
		                    <td>'.$sr.'</td>
		                    <td></td>
		                    <!-- td>'.$this->getLocaAdminName($result["local_admin_id"]).'</td -->
		                    <td>'.$result["sent_to"].'</td>
		                    <td>'.$result["phone_no"].'</td>
		                    <td>'.$result["message"].'</td>
		                    <!--td>'.DATE("j F, Y g:i a", STRTOTIME($result["msg_sent_date_time"]+$timeDifference)).'</td-->
		                    <td>'.date('j F, Y g:i a', $addeddate).'</td>
							<td>'.$this->getMsgType($result["message_type"]).'</td>
		                    <td>'.$this->GetEventType($result["event"]).'</td>
		                </tr>';
				$sr = $sr+1;
            }
        } 	
		else{
            $html .= '<tr><td colspan="9" align="center"><strong style="">'.$this->global_mod->db_parse($this->lang->line("no_data_found")).'.</strong></td></tr>';
        }
        $html .= '</table>';
        return $html;
    }
    
    function GetEventType($event){
		
		if($event == 3){
			$return = $this->global_mod->db_parse($this->lang->line('after_booking'));
		}
		if($event == 2){
			$return = $this->global_mod->db_parse($this->lang->line('after_approval'));
		}
		return $return;
		
	}
    
	function getMsgType($message_type){   
		if($message_type == '1'){
			$message_type_ret= $this->global_mod->db_parse($this->lang->line("complete"));
		}
		elseif($message_type == '2'){
			$message_type_ret= $this->global_mod->db_parse($this->lang->line("failed"));
		}
		elseif($message_type == '3'){
			$message_type_ret= $this->global_mod->db_parse($this->lang->line("authentication_failed"));
		}
		return $message_type_ret;
	} 
	function getLocaAdminName($local_admin_id){	
		$this->db->select('*');
        $this->db->from('app_password_manager');
		$this->db->where('user_type', 3);
		$this->db->where('user_id', $local_admin_id);
        $query = $this->db->get();
        $arr=$query->result_array();
		return $arr[0]['user_name'];
	}   
}