 <?php
class Customize_model extends CI_Model 
{
    public function __construct(){
        $this->load->database();
    }
    public function getAllField(){
        $arr=array();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_booking_extra_field');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            $fields =  $query->result_array();
            foreach($fields as $field){
                $field_id=$field['field_id'];
                $arr[$field_id]['field_id']=$field['field_id'];
                $arr[$field_id]['field_name']=$field['field_name'];
                if($field['services_ids'] !='0'){
                        $arr[$field_id]['services_ids']=unserialize($field['services_ids']);
                }
                else{
                        $arr[$field_id]['services_ids']=$field['services_ids'];
                }

                $arr[$field_id]['data_type_id']=$field['data_type_id'];
                $arr[$field_id]['is_required']=$field['is_required'];
                if($field['data_type_id'] == '4' || $field['data_type_id'] == '5'){
                    $this->db->select('*');
                    $this->db->from('app_booking_extra_field_option');
                    $this->db->where('field_id', $field_id);
                    $query = $this->db->get();
                    $NumRows =  $query->num_rows();
                    if($NumRows > 0){
                        $options =  $query->result_array();
                        $counter = 1;
                        foreach($options as $option){
                            $arr[$field_id]['option'][$counter]['option_id']=$option['option_id'];
                            $arr[$field_id]['option'][$counter]['value']=$option['value'];	
                            $arr[$field_id]['option'][$counter]['default_val']=$option['default_val'];	
                            $counter=$counter+1;							
                        }
                    }
                }
            }
        }
        else{
            $arr =  "";			
        }
        return $arr;
    }
    public function getCustomize(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_appoint_cancellation_policy');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            return $Customize = $query->result_array();
        }
        else{
            return $Customize = "";			
        }	
    }
    public function getServices(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('service_id,service_name');
        $this->db->from('app_service');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('is_active', 'Y');
        $query = $this->db->get();
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            return $Services =  $query->result_array();
        }
        else{
            return $Services =  "";			
        }	
    }
    public function getAllDataType(){
        $this->db->select('*');
        $this->db->from('app_datatype',0,6);
        $query = $this->db->get();
        
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            return $DataType =  $query->result_array();
        }
        else{
            return $DataType =  "";			
        }	
    }	
    public function save($postData){
        $local_admin_id = $this->session->userdata('local_admin_id');
        //###########field Start##########
        if(isset($postData['field'])){
            $this->db->select('field_id');
            $this->db->from('app_booking_extra_field');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            $NumRowsSi =  $query->num_rows();
            if($NumRowsSi > 0){
                $field_id =  $query->result_array();
            }else{
                $field_id =  "";			
            }
            $d_id='';
            $counter=1;
            if( $field_id !=''){
                foreach($field_id as $del_id){
                    if($counter !='1'){
                        $d_id .=','.$del_id['field_id'];
                    }else{
                        $d_id .=$del_id['field_id'];
                    }
                }			
            }
            $this->db->trans_begin();
            $this->db->where('local_admin_id', $local_admin_id);
            $this->db->delete('app_booking_extra_field');
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
            if(count($field_id) >0){
                $this->db->trans_begin();
                $this->db->where_in('field_id', $d_id);
                $this->db->delete('app_booking_extra_field_option');
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                }else{
                    $this->db->trans_commit();
                }			
            }

            if(count($postData['field']) >0){		
                foreach($postData['field']  as $field){
                    if(isset($field['required'])){
                        $required='1';		
                    }else{
                        $required='0';
                    }

                    if(count($field['service']) > 0){
                        if(in_array("0",$field['service'])){					
                            $services_serialize='0';
                        }else{						
                            $services_serialize=serialize($field['service']);
                        }
                    }else{
                        $services_serialize='0';		
                    }

                /*    $list = array(
                        'local_admin_id'	  => $local_admin_id,
                        'data_type_id'	      => $field['datatype']['name'],
                        'field_name'	      => $field['name'],
                        'services_ids'	      => $services_serialize,
                        'is_required'	      => $required,			
                    );
                    $this->db->insert('app_booking_extra_field',$this->db->escape($list));
                    $field_id=$this->db->insert_id();
                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                    }else{
                        $this->db->trans_commit();
                    }

                    if($field['datatype']['name'] == '4' || $field['datatype']['name'] == '5'){
                        foreach($field['datatype']['option']  as $option) {
                            if($option !=''){
                                $option_arr = array(
                                    'field_id'	  	 => $field_id,
                                    'value'	         => $option									
                                );
                                $this->db->insert('app_booking_extra_field_option',$this->db->escape($option_arr));
                                if ($this->db->trans_status() === FALSE){
                                    $this->db->trans_rollback();
                                }else{
                                    $this->db->trans_commit();
                                }						
                            }				
                        }					
                    }	   */			
                }
            }	
            /*echo "<pre>";
            print_r($postData['field']);
            echo "</pre>";
            exit;*/
        }
        //###########field End##########

        $this->db->select('customize_id');
        $this->db->from('app_appoint_cancellation_policy');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $row =  $query->result_array();
        $NumRows =  $query->num_rows();
        $data = array(
            'local_admin_id'	  	               		=> $local_admin_id,
            //'cancellation_policy'	               		=> $postData['CnclTxt'],
            //'additional_info'	                   		=> $postData['AppTxt'],
            //'terms_condition'	                   		=> $postData['termAndCondition'],

            //'confirm_booking_email_temp_id'	       	=> $postData['backgroungImagePath'],
            //'confirm_booking_email_subject'	       		=> $postData['confirm_booking_email_subject'],
            'confirm_booking_email'	       			    => $postData['editor1'],

            //'waiting_fr_approval_email_temp_id'	   	=> $postData['facebookpageurl'],
            //'waiting_fr_approval_email_subject'	   		=> $postData['waiting_fr_approval_email_subject'],
            'waiting_fr_approval_email'	  			    => $postData['editor2'],

            //'sent_after_service_email_temp_id'	  	=> $postData['CnclTxt'],
            //'sent_after_service_email_subject'	  		=> $postData['sent_after_service_email_subject'],
            'sent_after_service_email'	  			    => $postData['editor3'],

            //'reschedu_an_appoint_email_temp_id'	  	=> $postData['CnclTxt'],
            //'reschedu_an_appoint_email_subject'	  		=> $postData['reschedu_an_appoint_email_subject'],
            'reschedu_an_appoint_email'	  			    => $postData['editor4'],

            //'alert_before_appointment_email_temp_id'	=> $postData['CnclTxt'],
            //'alert_before_appointment_email_subject'	=> $postData['alert_before_appointment_email_subject'],
            'alert_before_appointment_email'	  		=> $postData['editor5'],

            //'alert_appointment_approval_email_temp_id'=> $postData['CnclTxt'],
            //'alert_appointment_approval_email_subject'	=> $postData['alert_appointment_approval_email_subject'],
            'alert_appointment_approval_email'	  		=> $postData['editor6'],

            //'appointment_cancellation_email_temp_id'	=> $postData['CnclTxt'],
            //'appointment_cancellation_email_subject'	=> $postData['appointment_cancellation_email_subject'],
            'appointment_cancellation_email'	  		=> $postData['editor7'],

            //'appointment_denial_email_temp_id'	  	=> $postData['CnclTxt'],
            //'appointment_denial_email_subject'	  		=> $postData['appointment_denial_email_subject'],
            'appointment_denial_email'	  			    => $postData['editor8'],

            //'login_detail_email_temp_id'	  		    => $postData['CnclTxt'],
            //'login_detail_email_subject'	  		    => $postData['login_detail_email_subject'],
            'login_detail_email'	  			        => $postData['editor9'],				

            'background_image_url'	  			        => $postData['backgroungImagePath'],
            'widget_url'	  				            => $postData['pageAddressWidget'],
            'facebook_page_url'	  				        => $postData['facebookpageurl'],
            'twitter_page_url'	  				        => $postData['twitterpageurl'],
        );
        $data = $this->global_mod->db_parse($data);
        $this->db->trans_begin();
        if($NumRows > 0){
            $this->db->where('local_admin_id', $local_admin_id);
            $this->db->update('app_appoint_cancellation_policy',$this->db->escape($data));
        }else{
            $this->db->insert('app_appoint_cancellation_policy',$this->db->escape($data));				
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
        }
    }
    public function getAjaxSave($saveId,$subject,$tem_value){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('customize_id');
        $this->db->from('app_appoint_cancellation_policy');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $row =  $query->result_array();
        $NumRows =  $query->num_rows();

        if($saveId ==1){
            $data = array(							
                'confirm_booking_email_subject'	=> $subject,
                'confirm_booking_email'	       	=> $tem_value,			
            );
        }
        if($saveId ==2){
            $data = array(
                //'waiting_fr_approval_email_temp_id'	=> $postData['facebookpageurl'],
                'waiting_fr_approval_email_subject'	   	=> $subject,
                'waiting_fr_approval_email'	  		    => $tem_value,
            );
        }
        if($saveId ==3){
            $data = array(
                //'sent_after_service_email_temp_id'	=> $postData['CnclTxt'],
                'sent_after_service_email_subject'	  	=> $subject,
                'sent_after_service_email'	  		    => $tem_value,
            );
        }
        if($saveId ==4){
            $data = array(
                //'reschedu_an_appoint_email_temp_id'	=> $postData['CnclTxt'],
                'reschedu_an_appoint_email_subject'	  	=> $subject,
                'reschedu_an_appoint_email'	  		    => $tem_value,
            );
        }
        if($saveId ==5){
            $data = array(
                //'alert_before_appointment_email_temp_id'	=> $postData['CnclTxt'],
                'alert_before_appointment_email_subject'	=> $subject,
                'alert_before_appointment_email'	  	    => $tem_value,
            );
        }
        if($saveId ==6){
            $data = array(
                //'alert_appointment_approval_email_temp_id'=> $postData['CnclTxt'],
                'alert_appointment_approval_email_subject'	=> $subject,
                'alert_appointment_approval_email'	  	    => $tem_value,
            );
        }
        if($saveId ==7){
            $data = array(
                //'appointment_cancellation_email_temp_id'	=> $postData['CnclTxt'],
                'appointment_cancellation_email_subject'	=> $subject,
                'appointment_cancellation_email'	  	    => $tem_value,
            );
        }
        if($saveId ==8){
            $data = array(
                //'appointment_denial_email_temp_id'	=> $postData['CnclTxt'],
                'appointment_denial_email_subject'	  	=> $subject,
                'appointment_denial_email'	  		    => $tem_value,
            );
        }
        if($saveId ==9){
            $data = array(
                'login_detail_email_subject'	  	=> $subject,
                'login_detail_email'	  		    => $tem_value,												
            );
        }
        $data = $this->global_mod->db_parse($data);
        $this->db->trans_begin();
        if($NumRows > 0){
            $this->db->where('local_admin_id', $local_admin_id);
            $this->db->update('app_appoint_cancellation_policy',$this->db->escape($data));
        }
        else{
            $data['local_admin_id']=$local_admin_id;
            $this->db->insert('app_appoint_cancellation_policy',$this->db->escape($data));				
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }
    public function pre_BookingFormShowHide($value){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array(
           'pre_booking_frm' => $value
        );
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->update('app_local_admin_gen_setting', $data);
        return $value;	
    }	
    public function getPreBookingData(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('pre_booking_frm');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        return $info =  $query->result_array();
    }
    public function getLanguageList(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_languages');
        $this->db->join('app_local_admin_gen_setting_languages', 'app_local_admin_gen_setting_languages.languages_id = app_languages.languages_id');
        $this->db->where('app_local_admin_gen_setting_languages.local_admin_id', $local_admin_id);
        $this->db->where('app_local_admin_gen_setting_languages.status', '1');
        $query = $this->db->get();
        if($query->num_rows() == 0){
			$this->db->select('*');
        	$this->db->from('app_languages');
        	$this->db->where('status', '1');
        	$query = $this->db->get();
		}
        return $query->result_array();
    }
    public function getDefaultLanguage(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('default_language_id');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMsgSave($saveId,$subject,$msg_body,$language_id,$temp_id){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array(
            'msg_subject'   => $subject,
            'msg_body'      => $msg_body,
            'temp_id'       => $temp_id
        );
        $data = $this->global_mod->db_parse($data);
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('msg_id', $saveId);
        $this->db->where('language_id', $language_id);  
        $this->db->update('app_msg_language', $data); 
    }
    /*
    public function getData(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $defaultLanguage = $this->getDefaultLanguage();
        $currentLanguage = $this->session->userdata('customize_language');
        $lang = ($currentLanguage != '')?$currentLanguage:$defaultLanguage[0]['default_language_id'];
        $this->db->select('*');
        $this->db->from('app_msg_language');
        $this->db->join('app_customize', 'app_customize.customize_id = app_msg_language.customize_id','left');
        $this->db->join('app_email_msg', 'app_email_msg.msg_id = app_msg_language.msg_id','left');
        $this->db->where('app_customize.lcal_admin_id', $local_admin_id);
        $this->db->where('app_msg_language.language_id', $lang);
        $query = $this->db->get();
        return $query->result_array();
    }
	*/
	public function getEmailOption($dataEmail){
		
		$defaultLanguage = $this->session->userdata('default_language_type');
		$this->db->select('languages_id');
        $this->db->from('app_languages');
        $this->db->where('languages_name', $defaultLanguage);
        $query = $this->db->get();
        $Arr = $query->result_array();
        $defaultLanguage = $Arr[0]['languages_id'];
		
		
		$sql = "select  
					dMsg.msg_id AS msg_id,
					lMsg.language_id,
					dMsg.purpose AS purpose,
					dMsg.purpose_details AS purpose_details,
					ifnull(lMsg.msg_subject,mail_demo_subject) AS mail_demo_subject,
					ifnull(lMsg.msg_body,mail_demo_content) AS mail_demo_content
				from 
					app_email_msg AS dMsg 
				left join
					app_msg_language AS lMsg 
				on
					dMsg.msg_id = lMsg.msg_id 
				and 
					lMsg.local_admin_id= '".$dataEmail['local_admin_id']."'
				and               
					lMsg.language_id = '".$defaultLanguage."'
				where
					dMsg.is_active= '1'";
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
	}
	
	public function saveMailDetails($data){
		
		
		if($this->chkMailDetails($data) > 0){
			
			$dataArr=array('msg_subject'=>trim($data['mail_subject']),'msg_body'=>trim($data['mail_body']));
			
		//	$dataArr = $this->global_mod->db_parse($dataArr);
			$this->db->where('local_admin_id', $data['local_admin_id']);
			$this->db->where('language_id', $data['language_id']);
			$this->db->where('msg_id', $data['msg_id']);
			$this->db->update('app_msg_language',$dataArr);
			return 0;
		}else{
			$dataArr = array('msg_subject' 	 => trim($data['mail_subject']), 
							'msg_body' 		 => trim($data['mail_body']), 
							'local_admin_id' => $data['local_admin_id'], 
							'language_id' 	 => $data['language_id'], 
							'msg_id'   		 => $data['msg_id']);
			//$dataArr = $this->global_mod->db_parse($dataArr);				
			$this->db->insert('app_msg_language', $dataArr); 
			return $this->db->insert_id();
		}
	}
	
	public function chkMailDetails($data){
		$this->db->select('count(*) As lsCounter');
        $this->db->from('app_msg_language');
        $this->db->where('local_admin_id', $data['local_admin_id']);
        $this->db->where('language_id', $data['language_id']);
        $this->db->where('msg_id', $data['msg_id']);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr[0]['lsCounter'];
	}
	
	
	public function SavecusomizeForm($data){
		$Array = array('local_admin_id'		=> $data['local_admin_id'],
					   'data_type_id'		=> $data['data_type_id'],
					   'field_name'			=> $data['field_name'],
					   'services_ids'		=> $data['services_ids'],
					   'is_required'		=> $data['is_required']
				 );
		//$Array = $this->global_mod->db_parse($Array);	 
		$this->db->insert('app_booking_extra_field',$Array);
		$last_id = $this->db->insert_id();	
		
		if($data['data_type_id'] == 4 || $data['data_type_id'] == 5){
			if($last_id != ''){
				
				if($data['default_val'] != 0){

					$i = 1;
					foreach($data['data_option'] as $val){
						if($i == $data['default_val']){
							$option_array = array('field_id' => $last_id,
											  'value'    => $val,
											  'default_val' => '1'
										);
							//$option_array = $this->global_mod->db_parse($option_array);		
							$this->db->insert('app_booking_extra_field_option ',$option_array);
							$i++;
						}
						else{
							$option_array = array('field_id' 	=>$last_id,
											  	  'value'    	=>$val,
											  	  
										);
							//$option_array = $this->global_mod->db_parse($option_array);				
							$this->db->insert('app_booking_extra_field_option ',$option_array);
							$i++;
						}
					}
				}
				else{
					foreach($data['data_option'] as $val){
						$option_array = array('field_id' =>$last_id,
											  'value'    =>$val
										);
						//$option_array = $this->global_mod->db_parse($option_array);					
						$this->db->insert('app_booking_extra_field_option ',$option_array);
					}
				}
			}
		}	 	
	}
	
	
	
	
	public function SavecusomizeFormEdit($data){
		$Array = array('field_name'		=> $data['field_name'],
					   'data_type_id'	=> $data['data_type_id'],
					   'services_ids'	=> $data['services_ids'],
					   'is_required'	=> $data['is_required']
				 );
		//$Array = $this->global_mod->db_parse($Array); 
		$this->db->where('field_id', $data['field_id']);
		$this->db->where('local_admin_id', $data['local_admin_id']);
		$this->db->update('app_booking_extra_field', $Array); 
		
		if ($this->db->trans_status() === TRUE){
			$this->db->trans_commit();
			
			$this->db->delete('app_booking_extra_field_option', array('field_id' => $data['field_id'])); 
			print_r($data['default_val']);
			
			if($data['default_val'] != 0){
					$i = 1;
					foreach($data['value'] as $val){
						if($i == $data['default_val']){
							$option_array = array('field_id' => $data['field_id'],
											  'value'    => $val,
											  'default_val' => '1'
										);
							//$option_array = $this->global_mod->db_parse($option_array);		
							$this->db->insert('app_booking_extra_field_option ',$option_array);
							$i++;
						}
						else{
							$option_array = array('field_id' 	=>$data['field_id'],
											  	  'value'    	=>$val
											  	  
											  	  
										);
							//$option_array = $this->global_mod->db_parse($option_array);					
							$this->db->insert('app_booking_extra_field_option ',$option_array);
							$i++;
						}
					}
			}	
			else{
				foreach($data['value'] as $val){
					$option_array = array('field_id' 	=>$data['field_id'],
										  'value'    	=>$val 	  
										);
					//$option_array = $this->global_mod->db_parse($option_array);							
					$this->db->insert('app_booking_extra_field_option ',$option_array);
				}	
			}
			
					
			return 1;
			
		}
		
				 
	}


	public function DelcusomizeForm($del_id){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->delete('app_booking_extra_field', array('field_id' => $del_id,'local_admin_id'=>$local_admin_id)); 
		$this->db->delete('app_booking_extra_field_option', array('field_id' => $del_id)); 
		
	}
	
	public function GetByLanguage(){
		$languageId 	= $this->input->post('languageId');
		$msg_id			= $this->input->post('msg_id');
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$this->db->select('*');
        $this->db->from('app_msg_language');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('language_id', $languageId);
        $this->db->where('msg_id',$msg_id);
        $query = $this->db->get();
        if($query->num_rows()>0){
			$Arr = $query->result_array();
			echo $this->global_mod->db_parse($Arr[0]['msg_subject']).'$@#$@#'.$this->global_mod->db_parse($Arr[0]['msg_body']).'$@#$@#'.$Arr[0]['language_id'];
		}else{
			if($languageId == 1){
				$this->db->select('*');
		        $this->db->from('app_email_msg');
		        $this->db->where('msg_id',$msg_id);
		        $query = $this->db->get();
		        $Arr = $query->result_array();
				echo $Arr[0]['mail_demo_subject'].'$@#$@#'.$Arr[0]['mail_demo_content'];
			}else{
				echo 0;
			}
			
		}
        
        
		
		
	}
	
	
}
?>