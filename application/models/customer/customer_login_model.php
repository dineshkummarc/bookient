<?php
class Customer_Login_model extends CI_Model 
{
	public function CustomerLogIn(){
            
		$err = 0;
        $local_admin_id = $this->session->userdata('local_admin_id');
		$ls_user		= trim($this->input->post('user_name'));
		$ls_pass		= trim($this->input->post('password'));
		
		$sql_ls="SELECT	
						pass.user_id	AS user_id
				 FROM
						app_customer_admin_relationship	AS rel,
						app_password_manager			AS pass
				 WHERE
						pass.user_type = 1 
						AND
						pass.user_status = 1 
						AND
						rel.customer_id = pass.user_id      
						AND
						pass.user_email ='".$ls_user."'
						AND
						pass.password ='".$ls_pass."' 
						AND
						rel.local_admin_id =".$local_admin_id;

		$query = $this->db->query($sql_ls);
        $UserAuthArr = $query->result_array();


		if(count($UserAuthArr) > 0){
			$this->db->select('email_veri_status,user_id,user_name,user_type');
			$this->db->from('app_password_manager');
			$this->db->where('user_id', $UserAuthArr[0]['user_id']);
			$query = $this->db->get();
			$UserEmailVerArr = $query->result_array();

			$customerData = $this->LoadCustomerById($UserEmailVerArr[0]['user_id']);
            $cus_countryid = isset($customerData['cus_countryid'])?$customerData['cus_countryid']:0;
            $cus_regionid  = isset($customerData['cus_regionid'])?$customerData['cus_regionid']:0;
            $region = $this->page_model->getRegion($cus_countryid);
            $cityArr = $this->page_model->getCity($cus_regionid);
			
                $set_user_data = array(
                        'user_name_customer'		=> $UserEmailVerArr[0]['user_name'],
                        'user_id_customer'			=> $UserEmailVerArr[0]['user_id'],
                        'user_type_customer'		=> $UserEmailVerArr[0]['user_type'],
                        'logged_in_customer'		=> TRUE,
                        'user_fname_customer'		=> isset($customerData['cus_fname'])?$customerData['cus_fname']:'',
                        'user_lname_customer'		=> isset($customerData['cus_lname'])?$customerData['cus_lname']:'',
                        'user_mobile_customer'		=> isset($customerData['cus_mob'])?$customerData['cus_mob']:'',
                        'user_phone1_customer'		=> isset($customerData['cus_phn1'])?$customerData['cus_phn1']:'',
                        'user_phone2_customer'		=> isset($customerData['cus_phn2'])?$customerData['cus_phn2']:'',
                        'user_address_customer'		=> isset($customerData['cus_address'])?$customerData['cus_address']:'',
                        'user_zip_customer'			=> isset($customerData['customer_zip'])?$customerData['customer_zip']:'',
                        'user_zone_id_customer'		=> isset($customerData['time_zone_id'])?$customerData['time_zone_id']:'',
                        'user_email_customer'		=> isset($customerData['user_email'])?$customerData['user_email']:''                 
                );
				if(($this->input->post('mobileType') == 'mobile') && ($this->input->post('staffArr')!= '') && ($this->input->post('srvArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')== '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $srvfArrM = '';
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['srvArrM']               = $srvfArrM;
				}elseif(($this->input->post('mobileType') == 'mobile') && ($this->input->post('srvArr')!= '') && ($this->input->post('staffArr')!= '')){
					$ls_Emp = '';
					$ls_Srv = '';
                    $staffArrM = '';
                    $srvfArrM = '';
					foreach($this->input->post('staffArr') AS $lsEmp){
		               $ls_Emp	.= $lsEmp.",";
		            }
					$staffArrM		.=substr_replace($ls_Emp ,"",-1);
					foreach($this->input->post('srvArr') AS $lsSrv){
		               $ls_Srv	.= $lsSrv.",";
		            }
					$srvfArrM		.=substr_replace($ls_Srv ,"",-1);
					
					$set_user_data['bDateM']                = $this->input->post('bDate');
					$set_user_data['bTimeM']                = $this->input->post('bTime');
					$set_user_data['latestContentM']        = $this->input->post('contentType');
					$set_user_data['staffArrM']             = $staffArrM;
					$set_user_data['srvArrM']               = $srvfArrM;
                }else{
					$set_user_data['bTime']                = $this->input->post('bTime');
					$set_user_data['staffArr']             = $this->input->post('staffArr');
					$set_user_data['srvArr']               = $this->input->post('srvArr');	
				}
                $this->session->set_userdata($set_user_data);   
                $err = $UserEmailVerArr[0]['user_id'];
		}else{
			$err = 0;	
		}
		return $err;
		
	}	
	public function CustomerCheck(){
		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_email', $this->session->userdata('email'));
		$query = $this->db->get();
		$UserArr = $query->result_array();
		
		if(count($UserArr) > 0){
			$return = 1;
		}else{
			$return = 0;
		}
	}
	
	public function LoadCustomerById($cus_id){

		$local_admin_id = $this->session->userdata('local_admin_id');
		$customerData=array();
		$sql1=$this->db->query("SELECT	
										cust.cus_id					AS user_id,
										cust.cus_fname				AS cus_fname,
										cust.cus_lname				AS cus_lname,
										cust.cus_address			AS cus_address,
										cust.cus_countryid			AS cus_countryid,
										cust.cus_regionid			AS cus_regionid,
										cust.cus_cityid				AS cus_cityid,
										cust.cus_zip				AS cus_zip,
										cust.cus_mob				AS cus_mob,
										cust.cus_phn1				AS cus_phn1,
										cust.cus_phn2				AS cus_phn2,
										cust.time_zone_id			AS time_zone_id,
										rel.customer_tag			AS customer_tag,
										rel.customer_info			AS customer_info,
										pass.user_email				AS user_email,
										pass.email_veri_status		AS email_veri_status
								FROM
										app_customer_search				AS cust,
										app_customer_admin_relationship	AS rel,
										app_password_manager			AS pass
								WHERE
										cust.cus_id = rel.customer_id
										AND
										pass.user_id = cust.cus_id
										AND
										rel.local_admin_id =".$local_admin_id."
										AND
										cust.cus_id =".$cus_id);
	
		
		$row			= $sql1->row();
		if ($sql1->num_rows() > 0){
			  
			    $customerData['user_id'] = isset($row->user_id)?$row->user_id:'';
				$customerData['cus_fname'] = isset($row->cus_fname)?$row->cus_fname:'';
				$customerData['cus_lname'] = isset($row->cus_lname)?$row->cus_lname:'';
			    $customerData['cus_mob']  = isset($row->cus_mob)?$row->cus_mob:'';
				$customerData['cus_phn1'] = isset($row->cus_phn1)?$row->cus_phn1:'';
				$customerData['cus_phn2'] = isset($row->cus_phn2)?$row->cus_phn2:'';
				$customerData['cus_address'] = isset($row->cus_address)?$row->cus_address:'';
				$customerData['cus_countryid'] = isset($row->cus_countryid)?$row->cus_countryid:0;
				$customerData['cus_regionid'] = isset($row->cus_regionid)?$row->cus_regionid:0;
				$customerData['cus_cityid'] = isset($row->cus_cityid)?$row->cus_cityid:0;
				$customerData['customer_zip'] = isset($row->customer_zip)?$row->customer_zip:'';
				$customerData['time_zone_id'] = isset($row->time_zone_id)?$row->time_zone_id:'';
				$customerData['user_email'] = isset($row->user_email)?$row->user_email:'';
				$customerData['email_veri_status'] = isset($row->email_veri_status )?$row->email_veri_status :'';
			
		}
		return $customerData;
	} 

}
?>