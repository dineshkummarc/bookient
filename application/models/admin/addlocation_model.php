<?php
class Addlocation_model extends CI_Model{ 
	 
	  public function ck_currentPlan_mod(){
			$local_admin_id		= $this->session->userdata('local_admin_id');
	        $sql = "SELECT 
	                    * 
	                FROM 
	                    app_member_plan_subscription 
	                WHERE 
	                    local_admin_id = '".$local_admin_id."' AND 
	                    is_active = 'Y'";
	        $query = $this->db->query($sql);
	        $Arr = $query->result_array();
	        return $Arr;
	    }
}
?>