<?php
class Business_hour_model extends CI_Model 
{
    public function __construct(){
        $this->load->database();
        $this->load->model('page_model');
    }
    public function get_staff(){//	GET THE LIST OF EXISTING STAFF FROM DATABASE
        $this->db->select('employee_name, employee_id');
        $this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
        $this->db->where('is_active','Y');
        $this->db->order_by("employee_name", "desc"); 
        $query = $this->db->get('employee');
        return $query->result_array();
    }
    public function get_service(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('service_category.category_name,service.service_name,service.service_id');
        $this->db->from('service');
        $this->db->join('service_category', 'service_category.category_id = service.category_id');
        $this->db->where('service.local_admin_id',$local_admin_id);
        $this->db->where('service.is_active','Y');
        $this->db->order_by("service_category.category_name", "asc"); 
        $query = $this->db->get();
        return $query->result_array();
    }	
    public function get_category(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('category_name,category_id');
        $this->db->where('local_admin_id',$local_admin_id);
        $this->db->where('is_active',"Y");
        $query = $this->db->get('service_category');
        return $query->result_array();
    }
    public function get_serv($id){
        $this->db->select('service_name,service_id');
        $this->db->where('category_id', $id);
        $this->db->where('is_active',"Y");
        $query = $this->db->get('service');
        return $query->result_array();
    }
    public function getBusinessHourDetails($biz_hours_id){
        $this->db->select('app_service.service_name, app_employee.employee_name, app_biz_hours.time_from, app_biz_hours.time_to,app_biz_hours.day_id');
        $this->db->from('app_biz_hours');
        $this->db->join('app_employee', 'app_employee.employee_id = app_biz_hours.employee_id');
        $this->db->join('app_service', 'app_service.service_id = app_biz_hours.service_id');
        $this->db->where('app_biz_hours.biz_hours_id',$biz_hours_id);
        $this->db->or_where('app_biz_hours.continuation_id',$biz_hours_id);
        $query = $this->db->get();
        $resultArr = $query->result_array();
        return $resultArr;
    }
    public function checkBusinessHour($serviceId,$staffId,$daysId,$startTime,$endTime){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $timeDiff = $this->global_mod->gmtDifference();
        $offset = substr($timeDiff,0,1);
        $offset = ($offset=="+")?"-":"+";
        $timeval  = substr($timeDiff,1);
        $time_diff = $this->secToHour($timeval);

        $timeFromArr = $this->timeCalculation($startTime,$time_diff,$offset,$daysId);
        $timeFrom = $timeFromArr['returnTime']; // GMT time


        $timeFromField = $this->hourToSec($timeFrom);


        $fromDayId = $timeFromArr['daysId'];//echo "<br>CCC : ".

        $timeToArr = $this->timeCalculation($endTime,$time_diff,$offset,$daysId);

        $timeTo = $timeToArr['returnTime']; // GMT time


        $timeToField = $this->hourToSec($timeTo);
        $toDayId = $timeToArr['daysId'];//echo "<br>DDD : ".
         $returnArr = array();
        if($fromDayId == $toDayId){
            $this->db->select('time_from,time_to');
            $this->db->from('app_biz_hours');
            $this->db->where('service_id',$serviceId);
            $this->db->where('employee_id',$staffId);
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('day_id',$toDayId);
            $query = $this->db->get();
            $resultArr = $query->result_array();

            $k=0;
            foreach($resultArr as $result){
                $chk1  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeTo."' AS TIME) 
                     BETWEEN `time_from` AND `time_to` AND day_id = '".$toDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query1 = $this->db->query($chk1);
                $Arr1 = $query1->result_array();
                $chk2  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeFrom."' AS TIME) BETWEEN `time_from` AND `time_to` AND day_id = '".$toDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query2 = $this->db->query($chk2);
                $Arr2 = $query2->result_array();
                if($Arr1[0]['cnt']==0 && $Arr2[0]['cnt']==0){
                    $returnArr[$k][$toDayId] = "Y";
                }else{
                    $returnArr[$k][$toDayId] = "N";
                    $k++;
                } 
            }
            //$NumRowsEmpBizHr = $query->num_rows();
        }else{

            //$NumRowsEmpBizHr = 0;

            $this->db->select('time_from,time_to');
            $this->db->from('app_biz_hours');
            $this->db->where('service_id',$serviceId);
            $this->db->where('employee_id',$staffId);
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('day_id',$toDayId);
            $query = $this->db->get();
            $resultArr = $query->result_array();

            $k=0;
            foreach($resultArr as $result){
                $chk1  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeTo."' AS TIME) 
                     BETWEEN `time_from` AND `time_to` AND day_id = '".$toDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query1 = $this->db->query($chk1);
                $Arr1 = $query1->result_array();
                $chk2  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeFrom."' AS TIME) BETWEEN `time_from` AND `time_to` AND day_id = '".$toDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query2 = $this->db->query($chk2);
                $Arr2 = $query2->result_array();
                if($Arr1[0]['cnt']==0 && $Arr2[0]['cnt']==0){
                    $returnArr[$k][$toDayId] = "Y";
                }
                else {
                    $returnArr[$k][$toDayId] = "N";
                    $k++;
                }  
            } 
            $this->db->select('time_from,time_to');
            $this->db->from('app_biz_hours');
            $this->db->where('service_id',$serviceId);
            $this->db->where('employee_id',$staffId);
            $this->db->where('local_admin_id',$local_admin_id);
            $this->db->where('day_id',$fromDayId);
            $query = $this->db->get();
            $resultArr = $query->result_array();


            foreach($resultArr as $result){
                $chk1  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeTo."' AS TIME) 
                     BETWEEN `time_from` AND `time_to` AND day_id = '".$fromDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query1 = $this->db->query($chk1);
                $Arr1 = $query1->result_array();
                $chk2  =  "SELECT count(*) cnt FROM app_biz_hours WHERE CAST('".$timeFrom."' AS TIME) BETWEEN `time_from` AND `time_to` AND day_id = '".$fromDayId."' 
                     AND local_admin_id ='".$local_admin_id."' AND service_id= '".$serviceId."' AND employee_id= '".$staffId."' ";
                $query2 = $this->db->query($chk2);
                $Arr2 = $query2->result_array();
                if($Arr1[0]['cnt']==0 && $Arr2[0]['cnt']==0){
                    $returnArr[$k][$fromDayId] = "Y";
                }
                else {
                    $returnArr[$k][$fromDayId] = "N";
                    $k++;
                }  
            } 
        }
        if($k > 0)
            return 0;
        else
            return 1;
    }
    public function hourToSec($timeInHour){
        $timeInHourArr = explode(":",$timeInHour);
        $sec = (isset($timeInHourArr[2]))?$timeInHourArr[2]:0;
        $second = ($timeInHourArr[0]*3600)+($timeInHourArr[1]*60)+$sec;
        return $second;
    }
    public function secToHour($sec){
        $sec = intval($sec);
        $init = $sec;
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;
        return "$hours:$minutes:$seconds";
    }
    public function timeCalculation($time,$timeDiff,$offset,$daysId){
        $returnArr = array();
        $timeArr = explode(":",$time);
        $sec = isset($timeArr[2])?$timeArr[2]:0;
        $time = ($timeArr[0]*3600)+($timeArr[1]*60)+$sec;

        $diffArr = explode(":",$timeDiff);
        $diff_sec = isset($diffArr[2])?$diffArr[2]:0;
        $diff = ($diffArr[0]*3600)+($diffArr[1]*60)+$diff_sec;

        $finalTime = $time+($offset.$diff);
        if($finalTime < 0)
        {
            $finalTime = (24*3600)+$finalTime;
            if($daysId == 1)
            {
                $daysId = 7;
            }
            else
            {
                $daysId = $daysId - 1;
            }
        }
        if($finalTime >= 86401)
        {
            $finalTime = $finalTime-(24*3600);
            if($daysId == 7)
            {
                $daysId = 1;
            }
            else
            {
                $daysId = $daysId + 1;
            }
        }
        $returnArr['daysId'] = $daysId;
        $returnArr['returnTime'] = $this->secToHour($finalTime);
        return $returnArr;
    }
    public function endTimeCalculation($endTime){
        $endTimeSec = $this->hourToSec($endTime);
         if($endTimeSec == 0){
			$finalEndTimeSec = 86399;
		}else{
			$finalEndTimeSec = $endTimeSec - 1;
		}
        $endTimeHour = $this->secToHour($finalEndTimeSec);
        return $endTimeHour;
    }
    public function biz_hour_add($jsondata,$timeArray){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $totRow = count($timeArray);
        $no_of_row = $totRow/2;
        $timeArr = array();
        for( $i=1; $i<=$no_of_row;$i++)
        {           
            foreach($timeArray as $val)
            { 
                $chk_val = $val['name'];
                if( $chk_val == 'timepickerFrom_'.$i) 
                {
                    $timeArr[$i]['timepickerFrom'] = $val['value'];
                }
                if( $chk_val == 'timepickerTo_'.$i) 
                {
                    $timeArr[$i]['timepickerTo'] = $val['value'];
                }              
            }           
        }
        $arrayFormation = json_decode($jsondata, true);

        $timeDiff = $this->global_mod->gmtDifference();
        $offset = substr($timeDiff,0,1);
        $offset = ($offset=="+")?"-":"+";
        $timeval  = substr($timeDiff,1);
        $time_diff = $this->secToHour($timeval);

        $ServiceIdsArray = $arrayFormation['service'];
        $staffIdsArray   = $arrayFormation['staff'];
        $daysIdsArray    = $arrayFormation['days'];
        $this->load->database();
        $this->db->trans_begin();

        foreach($ServiceIdsArray as $serviceId)
        {
            foreach($staffIdsArray as $staffId)
            {
                foreach($daysIdsArray as $daysId)
                {
                    foreach($timeArr as $time)
                    {
                        $timeFrom = $time['timepickerFrom'];
                        $timeTo = $time['timepickerTo'];
                        $timeFromArr = $this->timeCalculation($timeFrom,$time_diff,$offset,$daysId);
                        $timeFrom = $timeFromArr['returnTime'];
                        $fromDayId = $timeFromArr['daysId'];
                        $timeToArr = $this->timeCalculation($timeTo,$time_diff,$offset,$daysId);
                        $timeTo = $timeToArr['returnTime'];
                        $timeTo = $this->endTimeCalculation($timeTo);
                        $toDayId = $timeToArr['daysId'];
                      	
                      //	echo "<pre>";
                      //	echo $fromDayId.'<br>';
                      //	echo $toDayId.'<br>';
                      //	echo $timeFrom.'<br>';
                      //	echo $timeTo.'<br>';
                      //	exit;
                      
                      	
                      	
                        if($fromDayId == $toDayId)
                        {
                            $day = $toDayId;
                            $data = array(
                                'service_id'        => $serviceId,
                                'local_admin_id'    => $local_admin_id,
                                'employee_id'       => $staffId,
                                'day_id'            => $day,
                                'time_from'         => $timeFrom,
                                'time_to'           => $timeTo,
                                'continuation_id'   => 0,
                                'date_added'        => date('Y-m-d'),
                                'date_edited'       => date('Y-m-d')
                            );
                           
                            $this->db->insert('app_biz_hours',$this->db->escape($data));
                        }
                        else
                        {
                            $frmData = array(
                                'service_id'        => $serviceId,
                                'local_admin_id'    => $local_admin_id,
                                'employee_id'       => $staffId,
                                'day_id'            => $fromDayId,
                                'time_from'         => $timeFrom,
                                'time_to'           => "24:00:00",
                                'continuation_id'   => 0,
                                'date_added'        => date('Y-m-d'),
                                'date_edited'       => date('Y-m-d')
                            );
                            
                            $this->db->insert('app_biz_hours',$this->db->escape($frmData));
                            $insertId = $this->db->insert_id();
                            
                            $toData = array(
                                'service_id'        => $serviceId,
                                'local_admin_id'    => $local_admin_id,
                                'employee_id'       => $staffId,
                                'day_id'            => $toDayId,
                                'time_from'         => "0:00:00",
                                'time_to'           => $timeTo,
                                'continuation_id'   => $insertId,
                                'date_added'        => date('Y-m-d'),
                                'date_edited'       => date('Y-m-d')
                            );
                           
                            $this->db->insert('app_biz_hours',$this->db->escape($toData));
                        }
                    }  
                }
            }
        }
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            return true;
        } 
    }
    public function EmployeeNameFetch($employee_id){
            $this->db->select('employee_name');
            $this->db->from('app_employee');
            $this->db->where('employee_id', $employee_id);
            $query = $this->db->get();
            $EmployeeNmArr =  $query->result_array();
            return $EmployeeName = $EmployeeNmArr[0]['employee_name'];
    }
    public function ServiceNameFetch($service_id){
            $this->db->select('service_name');
            $this->db->from('app_service');
            $this->db->where('service_id', $service_id);
            $query = $this->db->get();

            $ServiceIdNameArr = $query->result_array();
            return $service_name =  $ServiceIdNameArr[0]['service_name'];
    }

	
	public function Employee_biz_hour_details($employee_id,$employee_name=''){
		$mainBizHours =  $this->global_mod->getBusinessHourListForAdmin('', array($employee_id), '' );
		
		//echo "<pre>";
		//print_r($mainBizHours);
		//echo "</pre>";
		//exit;
		
		
	
		if($employee_name ==''){
			$EmpName = $this->EmployeeNameFetch($employee_id);
		}else{
			$EmpName = $employee_name;
		}
        
        $StringHtml = '';
        $StringHtml .='<div id="resultContenar"></div>';
        $StringHtml .='<table align="center" width="100%">';
        $StringHtml .='<tr>';
		$StringHtml .='<th colspan="8" align="center" style="background:#55779A; color:#ffffff">'.$this->lang->line("busi_hr_detls").' '.$this->global_mod->db_parse($EmpName).' </th>';
		$StringHtml .='</tr>';
        if(count($mainBizHours) > 0)
        {
		
		$counts = array();
		foreach ($mainBizHours as $key=>$subarr) {

		if (isset($counts[$subarr['service_id']])) {
		$counts[$subarr['service_id']]++;
		}
		else { $counts[$subarr['service_id']] = 1;}

		// Or the ternary one-liner version 
		// instead of the preceding if/else block
		$counts[$subarr['service_id']] = isset($counts[$subarr['service_id']]) ? $counts[$subarr['service_id']]++ : 1;
		}


		
		
            $StringHtml .='<tr>
                                <th>'.$this->lang->line("service_name").'</th>
                                <th><strong>'.$this->lang->line("busi_monday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_tuesday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_wedday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_thrusday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_friday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_satday").'</strong></th>
                                <th><strong>'.$this->lang->line("busi_sunday").'</strong></td>
                          </tr>';
			$tempServiceId =0;
			$output = array();
			$output[1] = array();$output[2] = array();$output[3] = array();$output[4] = array();
			$output[5] = array();$output[6] = array();$output[7] = array();
			$k =1;
			foreach($mainBizHours as $key=>$bizHoursDetails){
			  		
					$service_name = $this->ServiceNameFetch($bizHoursDetails['service_id']);
					if($bizHoursDetails['service_id'] != $tempServiceId){
					$StringHtml .='<tr>';
						$StringHtml .= '<td class="del" valign="top">'.$service_name.'</td>';
						$tempServiceId = $bizHoursDetails['service_id'];
					}
					else
                    {
						//$StringHtml .= '<td></td>';
                    }					
			     
				 $tempArr = array();
				 $tempArr['time_from'] = $bizHoursDetails['time_from'];
				 $tempArr['time_to'] = $bizHoursDetails['time_to'];
				 $tempArr['main_id'] = $bizHoursDetails['main_id'];
				 
			     array_push($output[$bizHoursDetails['day_id']],$tempArr);
							
				if($counts[$tempServiceId] ==$k ){

				   for( $j=1; $j<=7; $j++){
						$StringHtml .= '<td class="del">';
						if(is_array($output[$j]) && count($output[$j]) ){
						$StringHtml .= '<table width="100%">';
							foreach($output[$j] as $val){
							$StringHtml .= '<tr>';
							$StringHtml .= '<td class="del"><div style="position:relative">'.$this->lang->line("frm")." ".$val['time_from'].' <br />'.$this->lang->line("to")." ".$val['time_to'].'<a style="display:none" class="del-icon" href="javascript:void(0)"><img onclick="DeleteSchedule('.$employee_id.','.$val['main_id'].');" src="'.base_url().'images/trash.gif" border="0" height="16px" width="16px"><img onclick="editSchedule('.$employee_id.','.$val['main_id'].');" src="'.base_url().'images/edit.png" border="0" height="16px" width="16px"></a></div></td>';	
							$StringHtml .= '</tr>';
							}					
						$StringHtml .= '</table>';
						
						}
						$StringHtml .= '</td>';
				   }
				
					
					$output = array();
					$output[1] = array();$output[2] = array();$output[3] = array();$output[4] = array();
			$output[5] = array();$output[6] = array();$output[7] = array();
					$k=0;
					$StringHtml .='</tr>';	
				}
				$k++;
               
				
               	  		  
			}			  
        }else{
            $StringHtml .= "<tr><td align='center' colspan='8'>".$this->global_mod->db_parse($this->lang->line('no_data_found'))."!</td></tr>";
        }  
        $StringHtml .='</table>';
        return $StringHtml.'@|^_^|@done';
    }
	public function DeleteBizHours(){
        $this->db->where('biz_hours_id', $this->input->post('id'));
        $this->db->delete('app_biz_hours');

                    $this->db->where('continuation_id', $this->input->post('id'));
        $this->db->delete('app_biz_hours');
        $TableString = $this->Employee_biz_hour_details($this->input->post('emp_id'));
        echo $TableString;
    }
    public function checkBizHrAvil($startTime,$endTime,$bizHrId){
        return 'done';
    }
    public function updateBizHrTime($startTime,$endTime,$bizHrId,$empId,$day_id){
        $timeDiff = $this->global_mod->gmtDifference();
        $offset = substr($timeDiff,0,1);
        $offset = ($offset=="+")?"-":"+";
        $timeval  = substr($timeDiff,1);
        $time_diff = $this->secToHour($timeval);

        $timeFromArr = $this->timeCalculation($startTime,$time_diff,$offset,$day_id);
        $timeFrom = $timeFromArr['returnTime'];
		$fromDayId = $timeFromArr['daysId'];
		
        $timeToArr = $this->timeCalculation($endTime,$time_diff,$offset,$day_id);
        $timeTo = $timeToArr['returnTime'];
        $timeTo = $this->endTimeCalculation($timeTo);
		$toDayId = $timeToArr['daysId'];
		
		
        
        
      //  echo "<pre>";
      //  echo $fromDayId.'<br>';
      //  echo $toDayId.'<br>';
      //  echo $timeFrom.'<br>';
       // echo $timeTo;
       // echo "</pre>";
      
       // exit;
        
     /*   $this->db->update('app_biz_hours', $data, array('biz_hours_id' => $bizHrId));
        $TableString = $this->Employee_biz_hour_details($empId);
        return $TableString;
     */   
     
     if($fromDayId == $toDayId)
    {
    	$data['time_from']			= $timeFrom;
        $data['time_to']			= $timeTo;
        $data['day_id']				= $fromDayId;
        $data['date_edited']		= date('Y-m-d');
        $this->db->update('app_biz_hours', $data, array('biz_hours_id' => $bizHrId));
    }
    else
    { 
    	$data['time_from']		= $timeFrom;
        $data['time_to']		= "24:00:00";
        $data['day_id']			= $fromDayId;
        $data['date_edited']	= date('Y-m-d');
    	$this->db->update('app_biz_hours', $data, array('biz_hours_id' => $bizHrId));
    	
       	
       	$this->db->select('*');
        $this->db->from('app_biz_hours');
        $this->db->where('continuation_id',$bizHrId);
        $query = $this->db->get();
        $resultArr = $query->result_array();
        
       // echo "<pre>";
       // print_r($resultArr);
       // echo "</pre>";
       // exit;
        
        
        if(count($resultArr)>0){
				$toData = array(
		            'day_id'            => $toDayId,
		            'time_from'         => "0:00:00",
		            'time_to'           => $timeTo,
		            'date_edited'       => date('Y-m-d')
        		);
        		$this->db->update('app_biz_hours', $data, array('continuation_id' => $bizHrId));
			
		}else{
			$this->db->select('*');
	        $this->db->from('app_biz_hours');
	        $this->db->where('biz_hours_id',$bizHrId);
	        $query = $this->db->get();
	        $resultArr = $query->result_array();
			
			$local_admin_id = $this->session->userdata('local_admin_id');
			$toData = array(
                        'service_id'        => $resultArr[0]['service_id'],
                        'local_admin_id'    => $local_admin_id,
                        'employee_id'       => $resultArr[0]['employee_id'],
                        'day_id'            => $toDayId,
                        'time_from'         => "0:00:00",
                        'time_to'           => $timeTo,
                        'continuation_id'   => $bizHrId,
                        'date_added'        => date('Y-m-d')
                      );
                       
            $this->db->insert('app_biz_hours',$this->db->escape($toData));
		}
       
    }
    $TableString = $this->Employee_biz_hour_details($empId);
    return $TableString;
     
   }	
    public function DeleteEmpService() {
        $this->db->where('service_id', $this->input->post('service_id'));
        $this->db->where('employee_id', $this->input->post('emp_id'));
        $this->db->delete('app_biz_hours'); 
        $TableString = $this->Employee_biz_hour_details($this->input->post('emp_id'));
        echo $TableString;
    }	
}
?>