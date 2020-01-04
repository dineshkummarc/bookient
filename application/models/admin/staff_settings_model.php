<?php
class staff_settings_model extends CI_Model{
	/*public function __construct(){
		$this->load->database();
	}*/
	public function getEmployeeList(){
		$local_admin_id		= $this->session->userdata('local_admin_id');
	    $sql = "SELECT 
						emp.*,
						sett.* 
                FROM  
                    app_employee AS emp,
					app_staff_settings AS sett
                WHERE 
                    emp.is_active = 'Y' AND 
					emp.employee_id = sett.staff_id AND 
					sett.is_active = 1 AND 
					emp.local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    } 
    public function updateSettings($postArr){
        $ret = 0;
        foreach($postArr as $key=>$val){
            $this->db->where('app_staff_settings_id', $key);
            $this->db->update('app_staff_settings', $val); 
            $ret++;
        }
        return $ret;
    }
}