<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dashboard_model extends CI_Model
{
	public function GetAllLocalAdmin(){
		
		$sql = "SELECT 
					ls.local_admin_id AS local_admin_id,
					ls.first_name AS first_name,
					ls.last_name AS last_name,
					ls.home_phone AS home_phone,
					ls.work_phone AS work_phone,
					ls.mobile_phone AS mobile_phone,
					ls.business_name AS business_name,
					ls.country_id AS country_id,
					ls.region_id AS region_id,
					ls.city_id AS city_id,
					ls.is_email_verified AS is_email_verified,
					ls.is_active AS is_active,
					apm.user_name AS user_name
		        FROM 
		            app_local_admin AS ls,
		            app_password_manager apm  
		        WHERE 
			      apm.user_id = ls.local_admin_id
			      AND 
			      apm.user_type = '3'";
				  
		$query = $this->db->query($sql);
		$AdminArr = $query->result_array();
		/*$this->db->select('local_admin_id,
							first_name,
							last_name,
							home_phone,
							work_phone,
							mobile_phone,
							business_name,
							country_id,
							region_id,
							city_id,
							is_email_verified,
							is_active');
		$this->db->from('app_local_admin');
		$query = $this->db->get();
		$AdminArr = $query->result_array();*/
		$RetArr = array();
		if(count($AdminArr)>0){
			foreach($AdminArr as $key=>$Row){
				$RetArr[$key]['local_admin_id'] = $Row['local_admin_id'];
				$RetArr[$key]['user_name'] = $Row['user_name'];
				if($Row['is_active'] == 'Y'){
					$RetArr[$key]['is_active_img'] = 'true.gif';
					$RetArr[$key]['is_active_alt'] = 'Active';
				}else{
					$RetArr[$key]['is_active_img'] = 'false.gif';
					$RetArr[$key]['is_active_alt'] = 'Inactive';
				}
				if($Row['first_name'] != ''){
					$RetArr[$key]['first_name'] = $Row['first_name'];
				}else{
					$RetArr[$key]['first_name'] = '';
				}			
				if($Row['last_name'] != ''){
					$RetArr[$key]['last_name'] = $Row['last_name'];
				}else{
					$RetArr[$key]['last_name'] = '';
				}	
				if($Row['home_phone'] != ''){
					$RetArr[$key]['home_phone'] = $Row['home_phone'];
				}else{
					$RetArr[$key]['home_phone'] = 'N/A';
				}
				if($Row['work_phone'] != ''){
					$RetArr[$key]['work_phone'] = $Row['work_phone'];
				}else{
					$RetArr[$key]['work_phone'] = 'N/A';
				}	
				if($Row['mobile_phone'] != ''){
					$RetArr[$key]['mobile_phone'] = $Row['mobile_phone'];
				}else{
					$RetArr[$key]['mobile_phone'] = 'N/A';
				}
				if($Row['business_name'] != ''){
					$RetArr[$key]['business_name'] = $Row['business_name'];
				}else{
					$RetArr[$key]['business_name'] = 'N/A';
				}
				$uid = $Row['local_admin_id'];
				$RetArr[$key]['is_email_verified'] = $this->check_email_veri_status($uid);

				$this->db->select('city_name');
				$this->db->from('app_cities');
				$this->db->where('city_id', $Row['city_id']);
				$query = $this->db->get();
				$CityyArr = $query->result_array();
				$RetArr[$key]['city_name'] = $CityyArr[0]['city_name'];

				$this->db->select('region_name');
				$this->db->from('app_regions');
				$this->db->where('region_id', $Row['region_id']);
				$query = $this->db->get();
				$RegionArr = $query->result_array();
				$RetArr[$key]['region_name'] = $RegionArr[0]['region_name'];

				$this->db->select('country_name');
				$this->db->from('app_countries');
				$this->db->where('country_id', $Row['country_id']);
				$query = $this->db->get();
				$CountryArr = $query->result_array();
				$RetArr[$key]['country_name'] = $CountryArr[0]['country_name'];
			}
		}
		return $RetArr;
	}
	public function email_varify(){
		$data = array('email_veri_status' => 1);
		$this->db->where('user_id',$this->input->post('user_id') );
		$this->db->update('app_password_manager',$data);
	}
	public function delete_account(){
		$this->db->where('user_id',$this->input->post('user_id') );
		$this->db->delete('app_password_manager'); 
	}
	public function change_status(){
		$this->db->select('is_active');
		$this->db->from('app_local_admin');
		$this->db->where('local_admin_id', $this->input->post('user_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['is_active'] == 'Y'){
			$data = array('is_active' => 'N');

			$is_active_img = 'false.gif';
			$is_active_alt = 'Inactive';
		}else{
			$data = array('is_active' => 'Y');

			$is_active_img = 'true.gif';
			$is_active_alt = 'Active';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('local_admin_id', $this->input->post('user_id'));
		$this->db->update('app_local_admin',$this->db->escape($data));
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo 0;
		}else{
			$this->db->trans_commit();
			echo $is_active_img.'(@$@)'.$is_active_alt;
		}
	}
	public function check_email_veri_status($id){
	    $this->db->select('email_veri_status');
		$this->db->from('app_password_manager');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		return $StatusArr[0]['email_veri_status'];
		/*$result='';
		if(isset($StatusArr[0]['email_veri_status']) && $StatusArr[0]['email_veri_status'] == 1){
			$result = 'Verified';
		}else {
			$result = 'Not Verified';
		}
		return $result;*/
	}
	public function delete_local_admin($local_admin_id){
		/*$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_tax_local_admin');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_dependency');


		$this->db->select('booking_id');
		$this->db->from('app_booking');
		$this->db->where('local_admin_id',$local_admin_id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$del_book_id=$row->booking_id;
			$this->db->where('booking_id', $del_book_id);
			$this->db->delete('app_booking_service');

		}
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_booking');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_clint_signup_info ');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_languages');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_admin_gen_setting_login_typ ');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_local_customer_details ');




		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_membership_payment_history');

		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->delete('app_membership_payment_smscall_credit_history'); */






		/*$this->db->select('id');
		$this->db->from('app_local_admin');
		$this->db->where('local_admin_id', $this->input->post('user_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();*/
	}
	public function update_password(){
		$this->db->trans_begin();
		$data = array('password' => $this->input->post('new_pass'));
		$data =$this->global_mod->db_parse($data);
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->where('user_type', 3);
		$this->db->update('app_password_manager',$this->db->escape($data));
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo 0;
		}else{
			$this->db->trans_commit();
			if($this->input->post('mail') == 1){
                /*****      CODE TO GET SUPER ADMIN DETAILS STARTS      *****/
                $superAdminArr = $this->getSuperAdminDetails();
                /*****      CODE TO GET SUPER ADMIN DETAILS ENDS       *****/
				$this->db->select('user_email, first_name');
				$this->db->from('app_password_manager');
				$this->db->join('app_local_admin', 'app_local_admin.local_admin_id = app_password_manager.user_id');
				$this->db->where('app_password_manager.user_id', $this->input->post('user_id'));
				$query = $this->db->get();
				$UserArr = $query->result_array();
				$to  = $UserArr[0]['user_email'];
				$subject = 'Password Notification';
				$message = '
				<html>
				<head>
				  <title>Password Notification</title>
				</head>
				<body>
				  <p>Dear '.$UserArr[0]['first_name'].',</p><br>
				  <p>Here is a notification regarding your login details. Your current login password has been changed by the superadmin. Please check the details below.</p><br>
				  <table>
					<tr>
					  <th>Password : </th><td>&nbsp;'.$this->input->post('new_pass').'</td>
					</tr>
				  </table>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$superAdminArr[0]['user_name'].' <'.$superAdminArr[0]['user_email'].'>' . "\r\n";
				if(mail($to, $subject, $message, $headers)){
					echo 1;
				}else{
					echo 0;
				}	
			}
		}
	}
    public function getSuperAdminDetails(){
        $this->db->select('user_name,user_email');
		$this->db->from('app_password_manager');
		$this->db->where('user_id', 5);
		$query = $this->db->get();
		$superArr = $query->result_array();
        return $superArr;
    }
	public function region($id){
		$local_admin_id = $id;
		$this->load->database();
		//$local_admin_id=1;
		$query=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");

		if ($query->num_rows() > 0){
		    $row = $query->row();
		    $business_state_id=$row->business_state_id;
			$local_admin_country_id = $row->country_id ;
		}


		$region='<select name="region" id="region" onChange="st(this.value)" class="required" style="width:38%;">
		<option value="" >select</option>';

		$this->load->database();

		$sql=$this->db->query("SELECT * from app_regions where country_id='".$local_admin_country_id."'");

		foreach ($sql->result() as $row){
			$region_name=$row->region_name;
			$region_id=$row->region_id;

			if($region_id==$business_state_id){
				$region_id_selected="selected";
			}else{
				$region_id_selected="";
			}
			$region.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";
		}
		$region.='</select>';
		return $region;
	}
    public function city($id){
		$this->load->database();
		$local_admin_id = $id;
		$query=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		if ($query->num_rows() > 0){
		    $row = $query->row();
			$business_city_id=$row->business_city_id;
			$local_admin_country_id=$row->country_id;
		}


		$city='<select name="city" id="city" class="required" style="width:38%;">
		<option value="">select</option>';

		$this->load->database();

		$sql=$this->db->query("SELECT * from app_cities where country_id='".$local_admin_country_id."'");

		foreach ($sql->result() as $row){
			$city_name=$row->city_name;
			$city_id=$row->city_id;

			if($city_id==$business_city_id){
				$city_id_selected="selected";
			}else{
				$city_id_selected="";
			}
			$city.="<option value=".$city_id." ".$city_id_selected.">".$city_name."</option>";

		}

		$city.='</select>';
		return $city;
	}
	public function select_from_db(){
		$this->load->database();
		$local_admin_id = $this->input->post('user_id');
		$sql=$this->db->query("SELECT st.*, region.region_name, c.country_name, city.city_name FROM app_local_admin st, app_regions region, app_countries c, app_cities city WHERE c.country_id=st.country_id AND region.region_id=st.region_id AND city.city_id=st.city_id AND st.local_admin_id='".$local_admin_id."'");
		$list=array();

		foreach ($sql->result() as $row){
			$list['business_name']       =	$row->business_name;
			$list['business_description']=	$row->business_description;
			$list['page_title']          =	$row->page_title;
			$list['business_tag']        =	$row->business_tag;
			$list['business_location']   =	$row->business_location;
			$list['business_state_id']   =	$row->business_state_id;
			$list['city_name']           =	$row->city_name;
			$list['region_name']         =	$row->region_name;
			$list['country_name']        =	$row->country_name;
			$list['business_zip_code']   =	$row->business_zip_code;
			$list['business_phone']      =	$row->business_phone;
			$list['business_logo']       =	$row->business_logo;
			$list['facebook_link']       =	$row->facebook_link;
			$list['youtube_link']        =	$row->youtube_link;
			$list['google_link']         =	$row->google_link;
			$list['twitter_link']        =	$row->twitter_link;
			$list['linkedin_link']       =	$row->linkedin_link;
		}

		$list['region']=$this->region($this->input->post('user_id'));
		$list['city']=$this->city($this->input->post('user_id'));

		echo json_encode($list);
	}
	public function get_all_staff(){
		$this->db->select('*');
		$this->db->from('app_employee');
		$this->db->where('local_admin_id', $this->input->post('user_id'));
		$query = $this->db->get();
		$StaffArr = $query->result_array();
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		          <tr>
			        <th>Sl. No.</th>
			        <th>Full Name</th>
			        <th>Phone No.(Mob.)</th>
			        <th>Languages</th>
			        <th>Description</th>
			        <th>Education</th>
			        <th>Membership</th>
			        <th>Awards</th>
			        <th>Status</th>
		          </tr>';
		if(count($StaffArr) > 0)
		{
			foreach($StaffArr as $key=>$row)
			{
				$sl_no = $key+1;
				if($row["is_active"] == 'Y')
					$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
				else
					$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
				$html .=
				'<tr>
					<td align="center">'.$sl_no.'</td>
					<td align="center">'.$row["employee_name"].'</td>
					<td align="center">'.$row["employee_mobile_no"].'</td>
					<td align="center">'.$row["employee_languages"].'</td>
					<td align="center">'.$row["employee_description"].'</td>
					<td align="center">'.$row["employee_education"].'</td>
					<td align="center">'.$row["employee_membership"].'</td>
					<td align="center">'.$row["employee_awards"].'</td>
					<td align="center"><a href="javascript:void(0);" onclick="change_status_staff(\''.$row["employee_id"].'\')"><span id="staff_status_'.$row["employee_id"].'">'.$status.'</span></a></td>
				 </tr>';
			}
		}
		else
		{
			$html .= '<tr><td colspan="9" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';
		echo $html;
	}
	public function change_status_staff(){
		$this->db->select('is_active');
		$this->db->from('app_employee');
		$this->db->where('employee_id', $this->input->post('employee_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['is_active'] == 'Y'){
			$data = array('is_active' => 'N');

			$is_active_img = 'close.png';
			$is_active_alt = 'Inactive';
		}else{
			$data = array('is_active' => 'Y');

			$is_active_img = 'tick.png';
			$is_active_alt = 'Active';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('employee_id', $this->input->post('employee_id'));
		$this->db->update('app_employee',$this->db->escape($data));
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo 0;
		}else{
			$this->db->trans_commit();
			echo $is_active_img.'(@$@)'.$is_active_alt;
		}
	}
	public function get_all_service(){
		$this->db->select('*');
		$this->db->from('app_service');
		$this->db->where('local_admin_id', $this->input->post('user_id'));
		$query = $this->db->get();
		$StaffArr = $query->result_array();

		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <tr>
			<th>Sl. No.</th>
			<th>Full Name</th>
			<th>Phone No.(Mob.)</th>
			<th>Languages</th>
			<th>Description</th>
			<th>Education</th>
			<th>Membership</th>
			<th>Awards</th>
			<th>Status</th>
		  </tr>';
		if(count($StaffArr) > 0){
			foreach($StaffArr as $key=>$row){
				$sl_no = $key+1;

				if($row["is_active"] == 'Y'){
					$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
				}else{
					$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
				}
					

				$html .=
				'<tr>
					<td align="center">'.$sl_no.'</td>
					<td align="center">'.$row["employee_name"].'</td>
					<td align="center">'.$row["employee_mobile_no"].'</td>
					<td align="center">'.$row["employee_languages"].'</td>
					<td align="center">'.$row["employee_description"].'</td>
					<td align="center">'.$row["employee_education"].'</td>
					<td align="center">'.$row["employee_membership"].'</td>
					<td align="center">'.$row["employee_awards"].'</td>
					<td align="center"><a href="javascript:void(0);" onclick="change_status_service(\''.$row["employee_id"].'\')"><span id="staff_status_'.$row["employee_id"].'">'.$status.'</span></a></td>
				 </tr>';
			}
		}else{
			$html .= '<tr><td colspan="9" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';

		echo $html;
	}
	public function change_status_service(){
		$this->db->select('is_active');
		$this->db->from('app_employee');
		$this->db->where('employee_id', $this->input->post('employee_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['is_active'] == 'Y'){
			$data = array('is_active' => 'N');

			$is_active_img = 'close.png';
			$is_active_alt = 'Inactive';
		}else{
			$data = array('is_active' => 'Y');

			$is_active_img = 'tick.png';
			$is_active_alt = 'Active';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('employee_id', $this->input->post('employee_id'));
		$this->db->update('app_employee',$this->db->escape($data));
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo 0;
		}else{
			$this->db->trans_commit();
			echo $is_active_img.'(@$@)'.$is_active_alt;
		}
	}
	public function manage_local_admin(){
		$this->db->select('*');
		$this->db->from('app_password_manager');
		$this->db->where('user_id', $this->input->post('local_admin_id'));
		$this->db->where('user_type', '3');
		$query = $this->db->get();
		$ResArr = $query->result_array();

        $usertype ="superadmin";
        $ori_key = $ResArr[0]['user_name'].'FghJU435GFGsjdn790'.$ResArr[0]['user_id'].'FghJU435GFGsjdn790'.md5($ResArr[0]['password'].$ResArr[0]['encription_key']).'FghJU435GFGsjdn790'.md5($usertype);
		$set_user_data = array(
			'user_name'   			 => $ResArr[0]['user_name'],
			'user_id'     			 => $ResArr[0]['user_id'],
			'user_id_local_admin'    => $ResArr[0]['user_id'],
			'user_type'   			 => '3',
			'is_super_admin'		 => TRUE,
			'logged_in'   			 => TRUE,
			'encription_key'         => $ResArr[0]['encription_key'],
			'type'                   => 'superadmin'
		);
	   return $ori_key;
	}
}
?>