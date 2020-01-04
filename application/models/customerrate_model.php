<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerRate_model extends CI_Model
{
    public function __construct(){
        $this->load->database();
    }
    public function business_data($local_admin_id){		
        $this->db->select('business_name,business_logo');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $local_admin_id); 
        $query = $this->db->get();
        $business_name =  $query->result_array();
        return $business_name;
    }
    public function ratingSave($jsondata){
        $this->db->where('local_admin_id', $jsondata['local_admin_id']);
        $this->db->where('posted_by', $jsondata['customer_id']);
        $this->db->where('service_id', $jsondata['service_id']);
        $this->db->where('staff_id', $jsondata['employee_id']);
        $this->db->where('srvDtls_id', $jsondata['srvDtls_id']);
        $this->db->from('app_review');
        $count = $this->db->count_all_results();
        if($count == 0){
            $data = array(
                'local_admin_id'	=> $jsondata['local_admin_id'],
                'comments' 		    => $jsondata['review_comments'],
                'posted_by'		    => $jsondata['customer_id'],
                'service_id'	    => $jsondata['service_id'],
                'staff_id'		    => $jsondata['employee_id'],
                'srvDtls_id'	    => $jsondata['srvDtls_id'],
                'is_approve'	    => '0',
                'rating'	  	    => $jsondata['my_input'],
                'posted_on'		    => date("Y-m-d H:i:s")
            );
            $this->db->trans_begin();
            $this->db->insert('app_review',$this->db->escape($data));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
                return true;
            }
        }else{
            return false;
        }
    }
}
?>