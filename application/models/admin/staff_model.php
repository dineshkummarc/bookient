<?php
class Staff_model extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}
	public function do_upload(){
        $config['upload_path'] = './uploads/staff';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '50';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $return=array(); 
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
            $return['error']=$error;
        }else{
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('staff', $data);
            $return['data']=$data;
        }
        return $return;
    }
    public function set_staff($imgdata){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $employee_image =  $imgdata['upload_data']['file_name'];
        
        if(count($this->input->post()) > 0){
            $insert_app_password_manager = array(
							                'user_type'          => 2,
							                'user_name'          => trim($_REQUEST['employee_username']),
							                'password'           => trim($_REQUEST['employee_password']),
							                'user_email'         => trim($this->input->post('employee_email')),
							                'email_veri_status'  => '1',
							                'date_creation'      => date("Y/m/d"),
							                'date_modified'      => date("Y/m/d")
            );
           $insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
            $this->db->trans_begin();
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $user_id=$this->db->insert_id();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        
            $data = array(
                'employee_id' 			=> $user_id,
                'local_admin_id' 		=> $local_admin_id,
                'employee_image' 		=> $employee_image,
                'employee_name' 		=> trim($_REQUEST['employee_name']),
                'employee_mobile_no' 	=> trim($_REQUEST['employee_mobile_no']),
                'employee_languages' 	=> trim($_REQUEST['employee_languages']),
                'employee_description' 	=> trim($_REQUEST['employee_description']),
                'employee_education' 	=> trim($_REQUEST['employee_education']),
                'employee_membership' 	=> trim($_REQUEST['employee_membership']),
                'employee_awards' 		=> trim($_REQUEST['employee_awards']),
                'employee_publications' => trim($_REQUEST['employee_publications']),
                'is_active' 			=> 'Y',
                'date_added' 			=> date('Y-m-d'),
                'date_edited' 			=> date('Y-m-d')
            );
			//$data = $this->global_mod->db_parse($data);
			
		//	echo "<pre>";
		//	print_r($data);
		//	echo mb_detect_encoding($_REQUEST['employee_name']);
		//	echo "</pre>";
		//	exit;
			
			//$query = $this->db->query($sql);
            $this->db->trans_begin();
            $this->db->insert('app_employee',$this->db->escape($data));     
                 
			$dataSettings = array(
                'staff_id' 			=> $user_id,
                'is_active' 		=> '1'
            );
            $this->db->insert('app_staff_settings',$dataSettings); 

            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                return true;
            }
        }
	}
    public function check_user_name($username, $curusrid = 0){
        $this->db->select('user_name');
        $this->db->from('app_password_manager');
        $this->db->where('user_name', $username);
        $this->db->where('user_type',2);

        $query = $this->db->get();
        $ResArr =  $query->result_array();

        $CountRes = count($ResArr);

        if($curusrid != 0 && $CountRes == 1){
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
		$this->db->order_by('employee_id', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}
	public function delete_staff($id){
		$this->db->delete('app_staff_settings', array('staff_id' => $id));
		$this->db->delete('app_employee', array('employee_id' => $id));
        $this->db->delete('app_biz_hours', array('employee_id' => $id));
        $this->db->delete('app_booking_service_details', array('srvDtls_employee_id' => $id));
        $this->db->delete('app_password_manager', array('user_id' => $id));
		return $this->db->affected_rows();
	}
	public function status_change($status, $id){
		$statusVal = ($status =='Yes')?1:0;
		$dataVal = array(
            'is_active' => $statusVal
        );
		$this->db->where('staff_id', $id);
		$this->db->update('app_staff_settings', $dataVal);
		
		$statusVal = ($status =='Yes')?'Y':'N';
		$data = array(
            'is_active' => $statusVal
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
				'user_name' 		=> trim($this->input->post('employee_username')),
				'password' 			=> trim($this->input->post('employee_password')),
				'user_email' 		=> trim($this->input->post('employee_email')),
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
				'employee_name' 		=> trim($_REQUEST['employee_name']),
				'employee_mobile_no' 	=> trim($this->input->post('employee_mobile_no')),
				'employee_languages' 	=> trim($_REQUEST['employee_languages']),
				'employee_description' 	=> trim($_REQUEST['employee_description']),
				'employee_education' 	=> trim($_REQUEST['employee_education']),
				'employee_membership' 	=> trim($_REQUEST['employee_membership']),
				'employee_awards' 		=> trim($_REQUEST['employee_awards']),
				'employee_publications' => trim($_REQUEST['employee_publications']),
				'is_active' 			=> 'Y',
				'date_edited' 			=> date('Y-m-d')
			);
			
			
			
			//$data = $this->global_mod->db_parse($data);
			if($imageChange == "Y"){
				$imagefielname =  $_FILES['userfile']['name'];
				$data['employee_image'] = $imagefielname;
			}
			$this->load->database();
			$this->db->trans_begin();
			$this->db->where('employee_id', $id);
			$this->db->update('app_employee',$data);
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
        //CB#SOG#11-12-2012#PR#S
		$Email = $returnData[0]['user_email'];
		$Pass  = $returnData[0]['password'];

		$to      = $Email;
		$subject = 'Your Password';
		$message = 'Your password is : '.$Pass;
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('user_email');
		$this->db->from('app_password_manager');
		$this->db->where('user_id',$local_admin_id);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();
		//echo '<pre>';print_r($Ret_Arr_val[0]['user_email']);exit;
		$email_from = $Ret_Arr_val[0]['user_email'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: <'.$email_from.'>'."\r\n";
		return $Emailsent = mail($to, $subject, $message, $headers);
        //CB#SOG#11-12-2012#PR#E
	}
	public function changeDtFrmat($date){
		$oldDate = $date;
		$arr = explode('/', $oldDate);
		return $newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
	}
	public function add_block_date_data($date_from, $date_to, $blk_dt_employee_id){
        $date = $this->changeDtFrmat($date_from);
        $end_date = $this->changeDtFrmat($date_to);
        if(strtotime($date) > strtotime($end_date)){
            $return = 0;
        }else{
            $this->db->select('block_date');
            $this->db->from('app_staff_unavailable');
            $this->db->where('employee_id', $blk_dt_employee_id);
            $query = $this->db->get();
            $NumRows = $query->num_rows();
                
            if($NumRows == 0){// IF RECORD IS INSERTED FOR FIRST TIME
                $DateArrCounter = 0;
                $DateArr = array();
                while (strtotime($date) <= strtotime($end_date)) {
                    $DateArrCounter++;
                    $DateArr[$DateArrCounter] = $date;
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                //$SerializedDateArray = serialize($DateArr);
            }else{// IF RECORD IS INSERTED FOR NEXT TIME
                $DateArr = array();
                $ResData =  $query->result_array();
                $DateArrCounter = 0;
                foreach($ResData as $previousData){
                    $DateArrCounter++;
                    $preDateArr[$DateArrCounter] = $previousData['block_date'];
                }
                while(strtotime($date) <= strtotime($end_date)) {
                    $DateArrCounter++;
                    if (in_array($date, $preDateArr)){
                        $DateArrCounter--;
                    }else{
                        $DateArr[$DateArrCounter] = $date;
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
            }
            foreach($DateArr as $val){
                $data = array(
                    'employee_id' 	=> $blk_dt_employee_id,
                    'block_date'        => $val,
                    'date_added' 	=> date('Y-m-d H:i:s')
                );
                $this->load->database();
                $this->db->trans_begin();
                /*****      CODE TO CHECK DATA FROM BLOCK TIME TABLE STARTS     *****/
                $this->db->select('unavailable_time_id');
                $this->db->from('app_staff_unavailable_time');
                $this->db->where('date', $val);
                $this->db->where('employee_id', $blk_dt_employee_id);
                $query = $this->db->get();
                $blockTimeIdArr =  $query->result_array();
                if(count($blockTimeIdArr)>0){
                    foreach($blockTimeIdArr as $delId){
                        $this->db->select('continuation_id');
                        $this->db->from('app_staff_unavailable_time');
                        $this->db->where('unavailable_time_id', $delId['unavailable_time_id']);
                        $query2 = $this->db->get();
                        $conIdArr = $query2->result_array();
                        if(count($conIdArr)>0){
                            $this->db->where('unavailable_time_id', $conIdArr[0]['continuation_id']);
                            $this->db->delete('app_staff_unavailable_time');   
                        }
                        /*########################################################*/
                        $this->db->select('unavailable_time_id');
                        $this->db->from('app_staff_unavailable_time');
                        $this->db->where('continuation_id', $delId['unavailable_time_id']);
                        $query2 = $this->db->get();
                        $conIdArr2 = $query2->result_array();
                        if(count($conIdArr2)>0){
                            $this->db->where('unavailable_time_id', $conIdArr2[0]['unavailable_time_id']);
                            $this->db->delete('app_staff_unavailable_time');   
                        }
                        $this->db->where('unavailable_time_id', $delId['unavailable_time_id']);
                        $this->db->delete('app_staff_unavailable_time');   
                    }
                }
                /*****      CODE TO CHECK DATA FROM BLOCK TIME TABLE ENDS       *****/
                /*****      CODE FOR INSERTION STARTS       *****/
                $this->db->insert('app_staff_unavailable',$this->db->escape($data));
                /*****      CODE FOR INSERTION ENDS     *****/
            }
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $return = 1;
            }
        }
        echo $return;
	}
	public function fetch_blocked_dates($id){
		$data='';
		$list='';
		$this->db->select('block_date');
        $this->db->from('app_staff_unavailable');
        $this->db->where('employee_id',$id);
        $query = $this->db->get();
        $resArr = $query->result_array();
		$dateArr = array();
		if (count($resArr) > 0){
            foreach($resArr as $value){
                array_push($dateArr,$value['block_date']);
            }
		}
		rsort($dateArr);
		foreach($dateArr as $myval){
            $list.= $myval.'@@@';
		}

		$this->db->select('employee_name');
		$this->db->from('app_employee');
		$this->db->where('employee_id', $id);
		$QryEmpNm = $this->db->get();
		if ($QryEmpNm->num_rows() > 0){
			$ResEmployeeName = $QryEmpNm->row();
			$EmployeeName = $ResEmployeeName->employee_name;
		}else{
			$EmployeeName = "";
		}
		$data=$EmployeeName.'#####'.$list;
		return $data;
	} 
    public function secToHour($sec){
        $sec = intval($sec);
        $hours = floor($sec / 3600);
        $minutes = floor(($sec / 60) % 60);
        $seconds = $sec % 60;
        return "$hours:$minutes:$seconds";
    }
    public function timeCalculation($time,$timeDiff,$offset,$daysId){
        $returnArr = array();
        $timeArr = explode(":",$time);
        $time = ($timeArr[0]*3600)+($timeArr[1]*60);
            
        $diffArr = explode(":",$timeDiff);
        $diff = ($diffArr[0]*3600)+($diffArr[1]*60);
            
        $finalTime = $time+($offset.$diff);
        if($finalTime < 0)
        {
            $finalTime = (24*3600)+$finalTime;
            $daysId = date('Y-m-d', strtotime($daysId . ' - 1 day'));
        }
        if($finalTime >= 86400)
        {
            $finalTime = $finalTime-(24*3600);
            $daysId = date('Y-m-d', strtotime($daysId . ' + 1 day'));
        }
        $returnArr['day'] = $daysId;
        $returnArr['returnTime'] = $this->secToHour($finalTime);
        return $returnArr;
    }
    public function hourToSec($timeInHour){
        $timeInHourArr = explode(":",$timeInHour);
        $sec = (isset($timeInHourArr[2]))?$timeInHourArr[2]:0;
        $second = ($timeInHourArr[0]*3600)+($timeInHourArr[1]*60)+$sec;
        return $second;
    }
    public function endTimeCalculation($endTime){
        $endTimeSec = $this->hourToSec($endTime);
        $finalEndTimeSec = $endTimeSec - 1;
        $endTimeHour = $this->secToHour($finalEndTimeSec);
        return $endTimeHour;
    }
	public function add_block_time_data($timepickerFrom, $timepickerTo, $date_of_time_block, $blk_time_employee_id){
        $date_of_time_block = $this->changeDtFrmat($date_of_time_block);

        $time_from_arr = explode(":",$timepickerFrom);
        $time_from = $time_from_arr[0].'.'.$time_from_arr[1];

        $time_to_arr = explode(":",$timepickerTo);
        $time_to = $time_to_arr[0].'.'.$time_to_arr[1];
            
        /****************************/
        $timeDiff = $this->global_mod->gmtDifference();//   FETCH LOCAL ADMIN TIME DIFFERENCE WITH RESPECT TO THE GMT
        $offset = substr($timeDiff,0,1);
        $offset = ($offset=="+")?"-":"+";
        $timeval  = substr($timeDiff,1);
        $time_diff = $this->secToHour($timeval);
            
        $timeFromArr = $this->timeCalculation($timepickerFrom,$time_diff,$offset,$date_of_time_block);
        $timepickerFrom = $timeFromArr['returnTime'];
        $dateFrom = $timeFromArr['day'];
            
        $timeToArr = $this->timeCalculation($timepickerTo,$time_diff,$offset,$date_of_time_block);
        $timepickerTo = $timeToArr['returnTime'];
        $timepickerTo = $this->endTimeCalculation($timepickerTo);
            
        $dateTo = $timeToArr['day'];
        /****************************/

        if($time_from < $time_to){
            /*$this->db->select('unavailable_time_id');
            $this->db->from('app_staff_unavailable_time');
            $this->db->where('employee_id', $blk_time_employee_id);
            $this->db->where('date', $date_of_time_block);
            $query = $this->db->get();
            $NumRows =  $query->num_rows();

            if($NumRows == 0)
            {*/
                if($dateFrom == $dateTo)
                {
                    $data = array(
                        'employee_id' 	=> $blk_time_employee_id,
                        'time_form' 	=> $timepickerFrom,
                        'time_to' 		=> $timepickerTo,
                        'date' 		=> $dateTo,
                        'date_added' 	=> date('Y-m-d'),
                        'date_edited' 	=> date('Y-m-d')
                    );
                    $this->db->insert('app_staff_unavailable_time',$this->db->escape($data));
                }else{
                    $data = array(
                        'employee_id' 	=> $blk_time_employee_id,
                        'time_form' 	=> $timepickerFrom,
                        'time_to' 		=> "23:59:59",
                        'date' 		=> $dateFrom,
                        'date_added' 	=> date('Y-m-d'),
                        'date_edited' 	=> date('Y-m-d')
                    );
                    $this->db->insert('app_staff_unavailable_time',$this->db->escape($data));
                    $insertId = $this->db->insert_id();
                    $data = array(
                        'employee_id' 	=> $blk_time_employee_id,
                        'time_form' 	=> "0:00",
                        'time_to' 		=> $timepickerTo,
                        'date' 		=> $dateTo,
                        'continuation_id'   => $insertId,
                        'date_added' 	=> date('Y-m-d'),
                        'date_edited' 	=> date('Y-m-d')
                    );
                    $this->db->insert('app_staff_unavailable_time',$this->db->escape($data));
                }
                    
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                }else{
                    $this->db->trans_commit();
                    $return = 1;
                }
            //}
            /*else
            {
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
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $this->db->trans_commit();
                    $return = 1;
                }
            }*/
        }else{
            $return = 0;
        }
        echo $return;
	}
	public function fetch_blocked_timings($id){
        $timeDiff = $this->global_mod->gmtDifference();//   FETCH LOCAL ADMIN TIME DIFFERENCE WITH RESPECT TO THE GMT
        $offset = substr($timeDiff,0,1);
        $timeval  = substr($timeDiff,1);
            
        $arr = $this->global_mod->staffBlockingStoreProAdmin();
        $NumRows = 0;
        foreach($arr as $val){
            if($val['unavailable_time_id'] != 0){
                $NumRows++;
            }
        }
        if($NumRows > 0){    
            $RetString = "<div class='account-overview'><table width='100%'>";
            $RetString .=  "<tr>
                                <th align='left'>".$this->lang->line('on_for_listing')."</td>
                                <th align='left'>".$this->lang->line('from_for_listing')."</td>
                                <th align='left'>".$this->lang->line('to_for_listing')."</td>
                                <th align='left'>".$this->lang->line('Staff_delete')."</td>
                            </tr>";
            foreach($arr as $data){
                if($data['unavailable_time_id'] != 0){
                    $employee_id = $data['employee_id'];
					if($data['time_form'] =='24:00:00'){
						$frm_date='00:00:00';
						$block_date=date('Y-m-d', strtotime('+1 day', strtotime($data['block_date'])));
					}
					else{
						$frm_date=$data['time_form'];
						$block_date=$data['block_date'];
						
					}
					
					
                    $RetString .= "<tr>
                                    <td>".$block_date."</td>
                                    <td>".$frm_date."</td>
                                    <td>".$data['time_to']."</td>
                                    <td><a href=\"javascript:void(0);\" onclick=\"DeleteTimeBlockData(".$data['unavailable_time_id'].",".$data['employee_id'].");\">".$this->lang->line('Staff_delete')."</a></td>
                                    </tr>";
                }
	        }
            $RetString .= "</table></div>";
            $flag=1;
        }else{
            $flag=0;
            $RetString = $this->lang->line('no_data_found');
        }

        $this->db->select('employee_name');
        $this->db->from('app_employee');
        $this->db->where('employee_id', $id);
        $QryEmpNm = $this->db->get();
        if ($QryEmpNm->num_rows() > 0){
            $ResEmployeeName = $QryEmpNm->row();
            $EmployeeName = $ResEmployeeName->employee_name;
        }else{
            $EmployeeName ='';
        }

        if($flag == 1){
            $data=$EmployeeName.'#####'.$RetString;
			//$data = $RetString;
        }else{
            $data = $RetString;
        }
        return $data;
	}
	public function blocked_dt_delete($blk_dt_employee_id, $date){
        $this->db->where('block_date', $date);
        $this->db->where('employee_id', $blk_dt_employee_id);
        $this->db->from('app_staff_unavailable');
        $NumRows = $this->db->count_all_results();

        if($NumRows == 0){
            return $RetString = $this->lang->line('req_proc_err');
        }else{
            $this->db->where('employee_id', $blk_dt_employee_id);
            $this->db->where('block_date', $date);
            $this->db->delete('app_staff_unavailable');
            return 1;
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
    //CB#SOG#5-3-2013#PR#S
    public function remove_the_pic($eId){
        $data = array('employee_image' => 'noimage.jpg');
        $this->load->database();
        $this->db->trans_begin();
        $this->db->where('employee_id', $eId);
        $this->db->update('app_employee',$this->db->escape($data));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return 1;
        }
    }
    //CB#SOG#5-3-2013#PR#E
}
?>