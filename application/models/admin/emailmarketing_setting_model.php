<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailmarketing_setting_model extends CI_Model{
																
	
	public function GetEmailCategory(){
		$localAdminId = $this->session->userdata('local_admin_id');
		
		$sql = 'SELECT 
    				  DISTINCT cat.emlMrktn_cat_id,cat.emlMrktn_cat_name
				FROM 
    				  app_emlmrktn_category cat
				JOIN
    				  app_emlmrktn_relation rel
				ON
    				  rel.app_emlmrktn_rel_cat_id=cat.emlMrktn_cat_id
				WHERE
    				  rel.app_emlmrktn_rel_localadmin_id="'.$localAdminId.'"
				AND
    				  cat.emlMrktn_cat_status=1
    			';
    			
    	$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;		
	}
	
	public function GetTemplateModel(){
		$TepmCat = $this->input->post('TepmCat');
		$localAdminId = $this->session->userdata('local_admin_id');
		
		$sql = 'SELECT 
     				 temp.app_emlmrktn_tem_id,temp.app_emlmrktn_tem_subject 
				FROM 
     				 app_emlmrktn_template AS temp,
     				 app_emlmrktn_relation AS rel
				WHERE 
     				 temp.app_emlmrktn_tem_id=rel.app_emlmrktn_rel_tmp_id
				AND
     				 rel.app_emlmrktn_rel_cat_id="'.$TepmCat.'"
				AND
     				 rel.app_emlmrktn_rel_localadmin_id="'.$localAdminId.'"
				AND
     				 temp.app_emlmrktn_tem_status=1
				AND
     				 temp.app_emlmrktn_tem_id!=1';
     	$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;			 
	}
	
	public function GetCustomerGroup(){
		
        $localAdminId = $this->session->userdata('local_admin_id');
        $sql = 'SELECT
      				DISTINCT type.customertype_name,
      				rel.typerelation_customertype_id
				FROM
      				app_customertype type
				JOIN
      				app_customer_type_relation rel
				ON
      				rel.typerelation_customertype_id=type.customertype_id
				WHERE
      				rel.typerelation_localadmin="'.$localAdminId.'"
				AND
      				rel.typerelation_status="Y"
				AND
      				type.customertype_status="Y"
				AND
      				type.customertype_isdeleted="Y"
      			';
      	$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;	

	}
	
	public function GetAllcustomersModel(){
		$CusType = $this->input->post('CusType');
		$localAdminId = $this->session->userdata('local_admin_id');
		$sql = 'SELECT 
     				search.cus_fname,
    	 			search.cus_lname,
     				search.cus_id
				FROM
     				app_customer_search search
				JOIN
     				app_customer_type_relation rel
				ON
     				search.cus_id=rel.typerelation_customer_id
				WHERE
     				rel.typerelation_localadmin="'.$localAdminId.'"
				AND
     				rel.typerelation_status="Y"
				AND
     				rel.typerelation_customertype_id="'.$CusType.'"
				';
		$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;
        	
        
	}
	
	public function saveSetting($id,$insertData){
		
		if($id != ''){
			$this->db->where('emlmrktn_setting_id', $id);
			$this->db->update('app_emlmrktn_setting', $insertData); 
		}else{
			$this->db->insert('app_emlmrktn_setting', $insertData);
			return 1;
		}
		
		

	}
	
	public function allEmailSetting(){
		$sql = 'SELECT
     				  setting.emlmrktn_setting_id,
     				  cat.emlMrktn_cat_name,
     				  temp.app_emlmrktn_tem_subject,
     				  cus.customertype_name
				FROM
     				  app_emlmrktn_category cat
				JOIN
    				  app_emlmrktn_setting setting
				ON
    				  setting.emlmrktn_cat_id=cat.emlMrktn_cat_id
				JOIN
    				  app_emlmrktn_template temp
				ON
   					  temp.app_emlmrktn_tem_id=setting.app_emlmrktn_tem_id
				JOIN
   					  app_customertype cus
				ON
   					  setting.customertype_id=cus.customertype_id
    			';
    	$query = $this->db->query($sql);
		$Arr = $query->result_array();
		return $Arr;		
	}
	
	public function GetDataById(){
		$Id = $this->input->post('SettingId');
		$this->db->select('*');
        $this->db->from('app_emlmrktn_setting');
        $this->db->where('emlmrktn_setting_id', $Id);
        $qry = $this->db->get();
        $Arr = $qry->result_array();
        return $Arr;
		
	}
	
	public function DeleteSetting($settingId){
		$this->db->where('emlmrktn_setting_id', $settingId);
		$this->db->delete('app_emlmrktn_setting');
		return 1;
	}
	
	

}
?>


