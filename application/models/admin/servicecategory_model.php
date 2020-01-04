<?php
class Servicecategory_model extends CI_Model{
    public function GetAllservicecategory(){
        $this->db->select('*');
        $this->db->from('app_service_category');
        $this->db->order_by("category_id", "desc");
        $this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
        $query = $this->db->get();
        $LOGINMETHODArr = $query->result_array();

        return $LOGINMETHODArr;  
    }
    public function Saveservicecategory($categoryname,$category_id=''){
    	$categoryname = $this->global_mod->db_parse($categoryname);
		$local_admin_id	= $this->session->userdata('local_admin_id');
           if($category_id == ''){
            $data = array(
                            'category_name'		=> $categoryname,
                            'local_admin_id'	=> $local_admin_id,
                            'is_active'			=> 'Y',
                            'date_added'		=> date('Y-m-d')
                         );
            $this->db->insert('app_service_category',$data);
            $insert_id = $this->db->insert_id();
			if($insert_id >0 || !empty($insert_id)){
            	return 1;
			}else{
				return 0;
			}
        }else{
			
			$data = array(
			                'category_name'      => $categoryname,
			                'date_edited'        => date('Y-m-d')
			             );
			$this->db->where('category_id', $category_id);
			$this->db->update('app_service_category',$data);			
			return 1;
        }
    }
    public function ChangeStatusSERVICECATEGORY(){
        $this->db->select('is_active');
        $this->db->from('app_service_category');
        $this->db->where('category_id', $this->input->post('category_id'));
        $query = $this->db->get();
        $StatusArr = $query->result_array();
        if($StatusArr[0]['is_active'] == 'Y'){
            $data = array('is_active' => 'N');
            $ret = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
        }else{
            $data = array('is_active' => 'Y');
            $ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
        }
        $this->db->trans_begin();
        $this->db->where('category_id', $this->input->post('category_id'));
        $this->db->update('app_service_category',$this->db->escape($data));
        $this->db->last_query();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo 0;
        }else{
            $this->db->trans_commit();
            echo $ret;
        }
    }
    public function EditSERVICECATEGORY(){
        $this->db->select('*');
        $this->db->from('app_service_category');
        $this->db->where('category_id', $this->input->post('category_id'));
        $query = $this->db->get();
        $SERVICECATEGORYArr = $query->result_array();
        foreach($SERVICECATEGORYArr as $row){
            $SERVICECATEGORYArr['category_id']     = $row['category_id'];
            $SERVICECATEGORYArr['category_name']   = $row['category_name'];
        }
        //echo json_encode($SERVICECATEGORYArr);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION   #######################
        $return_ser = serialize($SERVICECATEGORYArr);
        $value = mb_check_encoding($return_ser, 'UTF-8') ? $return_ser : utf8_encode($return_ser);
        $value = preg_replace( '!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $value );
        $value = preg_replace( '/;n;/', ';N;', $value );
        $new_return = unserialize($value);
        echo json_encode($new_return);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION    #######################
    }
    public function DeleteSERVICECATEGORY(){
        $category_id = $this->input->post('category_id');
        $this->db->select('*');
        $this->db->from('app_service');
        $this->db->where('category_id', $this->input->post('category_id'));
        $query = $this->db->get();
        $SERVICECATEGORYArr = $query->result_array();
        foreach($SERVICECATEGORYArr as $row){
            $serviceId = $row['service_id'];
            $this->db->delete('app_biz_hours', array('service_id' => $serviceId));
            $this->db->delete('app_booking_service_details', array('srvDtls_service_id' => $serviceId));
        }
        $this->db->delete('app_service_category', array('category_id' => $category_id));
        //$this->db->delete('app_biz_hours', array('service_id' => $id));
    }
}
?>