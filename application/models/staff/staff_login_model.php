<?php
class Staff_Login_model extends CI_Model{

	public function StaffLogIn(){
		$err = 0;

		$this->db->select('user_id');
		$this->db->from('app_password_manager');
		$this->db->where('user_email',trim($this->input->post('user_email')));
		$this->db->where('password', trim($this->input->post('password')));
		$this->db->where('user_type', 2);
		$query = $this->db->get();
		$UserAuthArr = $query->result_array();

		if(count($UserAuthArr) > 0){
			$this->db->select('email_veri_status,user_id,user_name,user_type');
			$this->db->from('app_password_manager');
			$this->db->where('user_id', $UserAuthArr[0]['user_id']);
			$query = $this->db->get();
			$UserEmailVerArr = $query->result_array();

			if($UserEmailVerArr[0]['email_veri_status'] == 1){
				$query ="select user_name,user_id from app_password_manager where user_type=3 and user_id=(select emp.local_admin_id from app_employee as emp,app_password_manager as pass where emp.employee_id=pass.user_id and pass.user_id=".$UserEmailVerArr[0]['user_id'].")";
				$sql = mysql_query($query);
				$EmpArr = mysql_fetch_array($sql);

				$url = $_SERVER['HTTP_HOST'];
				$url_arr = explode(".",$url);

				if(strtolower($url_arr[0])==strtolower($EmpArr['user_name'])){
					$set_user_data = array(
						'user_name_staff'   => $this->check_name($UserEmailVerArr[0]['user_id']),
						'user_id_staff'     => $UserEmailVerArr[0]['user_id'],
						'user_type_staff'   => $UserEmailVerArr[0]['user_type'],
						'logged_in_staff'   => TRUE
					);
					$this->session->set_userdata($set_user_data);
					$err = 0;
				}else{
					$err = 3;
				}
			}else{
				$err = 2;
			}
		}else{
			$err = 1;
		}

		return $err;

	}

        public function check_name($id)
        {
                $this->db->select('employee_name');
		$this->db->from('app_employee');
		$this->db->where('employee_id',$id);
		$query = $this->db->get();
		$ResArr =  $query->result();
		//echo '<pre>';print_r($ResArr[0]->employee_name);exit;
                return $ResArr[0]->employee_name;
        }


}
?>