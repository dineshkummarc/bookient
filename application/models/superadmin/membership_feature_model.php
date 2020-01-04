<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_feature_model extends CI_Model
{

    var $title   = '';
    var $content = '';
    var $date    = '';

	public function get_TotalRecords($where='',$like=''){
		if(!empty($where)){
			$this->db->where($where);
		}	
		if(!empty($like)){
			$this->db->or_like($like);
		}
			$this->db->where('status !=', 2);
			$this->db->from('app_membership_feature');
			return $this->db->count_all_results();
	}

    public function get_AllCatalogArr($start=0,$limit=10,$order_by='',$order_type='',$where='',$like=''){
		if(!empty($order_by) && !empty($order_type)){
			$this->db->order_by($order_by, $order_type);
		}
		if(!empty($where)){
			$this->db->where($where);
		}
		if(!empty($like)){
			$this->db->or_like($like);
		}			
		if($limit){
			$this->db->limit($limit,$start);
		}
			//$this->db->join('app_currency','app_currency.currency_id = app_membership_feature.currency_id');
			$this->db->where('status !=', 2);
			$query = $this->db->get('app_membership_feature');
			return $query->result();
    }

    public function deletePlan($id){
            //$data = array( 'status'=> 2,'feature_order' => -1);
			//$id=$this->input->post('feature_id');
            $this->db->where('feature_id',$id);
			$a = $this->db->delete('app_membership_feature'); 
            if($a == 1){
				$result = 1;
			}else{
				$result = 0;
			}      
            return $result;
    }

    public function ChangeStatus($feature_id){
		$this->db->select('status');
		$this->db->from('app_membership_feature');
		$this->db->where('feature_id',$feature_id );
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['status'] == '1'){
			$data = array('status' => '0');
		}else{
			$data = array('status' => '1');
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('feature_id', $feature_id);
		$this->db->update('app_membership_feature',$this->db->escape($data));

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();

		}
	}

    public function Edit(){
		
		$ResArr=array();
		$this->db->select('*');
		$this->db->from('app_membership_feature');
		$this->db->where('feature_id', $this->input->post('feature_id'));
		$query = $this->db->get();
		$RetArr = $query->result_array();
		foreach($RetArr as $key=>$row){
			$ResArr['feature_id'] = $row['feature_id'];
			$ResArr['feature_name'] = $row['feature_name'];
			$ResArr['status'] = $row['status'];
		}		
		return json_encode($ResArr);
	 
	}

    public function get_title(){
            $result=0;
            $this->db->select('*');
            $this->db->from('membership_feature');
            $this->db->where('feature_name', $this->input->post('title'));
            $query = $this->db->get();
            $num = $query->num_rows();
            $Ret_Arr_val = $query->result_array();
            //echo  $num;
            if($this->input->post('id') == ''){
                if($num == 0){
                    $result=1;
                }else{
                    $result=0;
                }
            }else {
                if($num == 0){
                    $result=1;
                }else{
                    if($this->input->post('id') == $Ret_Arr_val[0]['feature_id'] ){
                     $result=1;
                    }else{
                     $result=0;
                    }
                }
            }
	    echo $result;

        }
    
	public function Save(){
		if($this->input->post('feature_id') == ''){
                    $this->db->select_max('feature_order');
                    $query = $this->db->get('membership_feature');
                    $order = $query->row_array();
                    $new_order = $order['feature_order']+1;
                    $msgreport;
                    $messg;
			$data = array(
						  'feature_name'	     =>	trim($this->input->post('feature_name')),
						  'status'				 => trim($this->input->post('status')),	
                          'feature_order'        => $new_order
						  );
			$data =$this->global_mod->db_parse($data);
			$this->db->trans_begin();
			$this->db->insert('app_membership_feature',$this->db->escape($data));
			$membership_type_id = $this->db->insert_id();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$messg = 2;
			}else{
				$this->db->trans_commit();
                $messg = 1;
			}
           		
		}else{
			$feature_id = $this->input->post('feature_id');
			$data = array(
						  'feature_name'	    => trim($this->input->post('feature_name')),
						  'status'  			=> trim($this->input->post('status')),						  
						  );
						  $data =$this->global_mod->db_parse($data);
			$this->db->where('feature_id', $feature_id);
			$this->db->update('app_membership_feature',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				  $messg = 4;
			}else{
				$this->db->trans_commit();
                $messg = 3;
			}						
           
			
		}
			if($messg == 1){
				$msg = "Added successfully.";
			}elseif($messg == 3){
				$msg = "Updated successfully.";
			}
            $this->session->set_flashdata('status_massage', $msg);
	}
	
	public function delete_the_Ranking($array,$tablename,$pkey_field,$order_field,$pkey_value){
		global $CI;
		$CI->db->where($pkey_field, $pkey_value);
		$query =$CI->db->get($tablename);
		$result = $query->row_array();
		$order_value = $result[$order_field];

		foreach($array as $key=>$val){
			if($val > $order_value){
				$data[$order_field] = $val-1;
				$data =$this->global_mod->db_parse($data);
				$CI->db->where($pkey_field, $key);
				$this->db->where('status !=', 2);
				$CI->db->update($tablename, $data);
			}
		}
		return;
	}
}


?>