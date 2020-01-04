<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_allocation_model extends CI_Model{
    public function getMembershipFeature(){
        $this->db->select('*');
        $this->db->from('app_membership_feature');
        $this->db->where('status', 1);
        $this->db->order_by("feature_order", "asc"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMembershipPlan(){
        $this->db->select('*');
        $this->db->from('app_membership_plan');
        $this->db->where('status', 1);
        $this->db->where('is_deleted', 'N');
        $this->db->order_by("membership_order", "asc"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    public function planFeatureRelation(){
        $this->db->select('*');
        $this->db->from('app_membership_plan_feature_relation');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function planFeatureRelationInsert($relationArr){
        $data = array();
        $this->db->truncate('app_membership_plan_feature_relation'); 
        foreach($relationArr as $relationKey=>$relationVal){
            $relArr = explode("_",$relationKey);
            $data = array(
               'plan_id' => $relArr[0],
               'feature_id' => $relArr[1]
            );
			$data =$this->global_mod->db_parse($data);
            $this->db->insert('app_membership_plan_feature_relation', $data); 
        }
        return 1;
    }
}
?>