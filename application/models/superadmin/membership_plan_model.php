<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_plan_model extends CI_Model
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
			$this->db->where('is_deleted !=', 'Y');
			$this->db->from('app_membership_plan');
			return $this->db->count_all_results();
	}
	public function getBillingCycle(){
		$this->db->select('*');
		$this->db->from('app_pardco_code_code');
		$this->db->where('code_type_master_id', '7');
		$this->db->order_by('code_order', 'asc');
		$query = $this->db->get();
		$selectArr = $query->result_array();
		return $selectArr;
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
			//$this->db->join('app_currency','app_currency.currency_id = app_membership_plan.currency_id');
			$this->db->where('status !=', 2);
			$this->db->where('is_deleted =', 'N');
			$query = $this->db->get('app_membership_plan');
			return $query->result();
    }
    public function deletePlan($id){
        
       $data = array(
               	'is_deleted' => 'Y'
               );

	  $this->db->where('plan_id', $id);
	  $a = $this->db->update('app_membership_plan', $data);  
        if($a == 1){
			$result = 1;
		}else{
			$result = 0;
		}      
        return $result;
    }

    public function ChangeStatus($plan_id){
		$this->db->select('status');
		$this->db->from('app_membership_plan');
		$this->db->where('plan_id',$plan_id );
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['status'] == '1'){
			$data = array('status' => '0');
		}else{
			$data = array('status' => '1');
		}
			$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('plan_id', $plan_id);
		$this->db->update('app_membership_plan',$this->db->escape($data));

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}
	}
    public function Edit(){
		$ResArr=array();
		$this->db->select('*');
		$this->db->from('app_membership_plan');
		$this->db->where('plan_id', $this->input->post('plan_id'));
		$query = $this->db->get();
		$RetArr = $query->result_array();
		foreach($RetArr as $key=>$row){
			$ResArr['plan_id'] = $row['plan_id'];
			$ResArr['plan_name'] = $row['plan_name'];
			$ResArr['plan_cost'] = $row['plan_cost'];
			$ResArr['currency_id'] = $row['currency_id'];
			$ResArr['plan_validity'] = $row['plan_validity'];
			$ResArr['currency_id'] = $row['currency_id'];
			$ResArr['plan_desc'] = $row['plan_desc'];
			$ResArr['status'] = $row['status'];
			$ResArr['is_multilocation'] = $row['is_multilocation'];
		}
		
		$this->db->select('*');
		$this->db->from('app_membership_plan_tierprice');
		$this->db->where('plan_id', $this->input->post('plan_id'));
		$this->db->order_by('tierprice_id', 'asc');
		$query = $this->db->get();
		$tierprice = $query->result_array();	
		$count=1;
		$tierArr=array();
		foreach($tierprice as $mul_location){
				
			$tierArr[$count]['billing_cycle'] = $mul_location['billing_cycle'];
			$tierArr[$count]['location_num'] = $mul_location['no_of_location'];
			$tierArr[$count]['staff_per_location'] = $mul_location['staff_per_location'];
			$tierArr[$count]['price'] = $mul_location['price'];
			$tierArr[$count]['additional_cost_location'] = $mul_location['additional_cost_location'];
			$count=$count+1;
		}			
		$ResArr['tierprice']=$tierArr;
		return json_encode($ResArr); 
	}

    public function get_title(){
            $result=0;
            $this->db->select('*');
            $this->db->from('membership_plan');
            $this->db->where('plan_name', $this->input->post('title'));
            $this->db->where('is_deleted', 'N');
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
                    if($this->input->post('id') == $Ret_Arr_val[0]['plan_id'] ){
                     $result=1;
                    }else{
                     $result=0;
                    }
                }
            }
	    echo $result;
	}  
	public function Save(){
	//echo "<pre>"; print_r($this->input->post('mul_loc'));exit();
		$post =$this->input->post();
		if($this->input->post('plan_id') == ''){
			
					$sql = 'SELECT MAX(membership_order) AS MaxOrder FROM app_membership_plan WHERE is_deleted="N"';
					$query = $this->db->query($sql);
					$order = $query->result_array();
					
                    $new_order = $order[0]['MaxOrder']+1;
                    $msgreport;
                    $messg;
			$data = array(
				'plan_name'	        	=>	trim($this->input->post('membership_name')),
				'plan_cost'	    		=>	trim($this->input->post('membership_amount')),
				'currency_id'			=>	1,
				'plan_validity '    	=>	trim($this->input->post('membership_validity')),
				'plan_desc'  			=>	trim($this->input->post('membership_description')),
				'is_multilocation'  	=>	$this->input->post('is_Multilocation'),
				'status'				=> 	trim($this->input->post('status')),	
				'created_on'			=>	date("Y-m-d"),
                'membership_order'      =>  $new_order
			);
			$data =$this->global_mod->db_parse($data);
			$this->db->trans_begin();
			$this->db->insert('membership_plan',$this->db->escape($data));
			$membership_plan_id = $this->db->insert_id();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$messg = 2;
			}else{
				$this->db->trans_commit();
				$this->saveTierPrice($post,$membership_plan_id, "add");
                $messg = 1;
			}
		}else{
			$plan_id = $this->input->post('plan_id');
			$data = array(
				'plan_name'	        	=>	trim($this->input->post('membership_name')),
				'plan_cost'	    		=>	trim($this->input->post('membership_amount')),
				'currency_id'			=>	1,
				'plan_validity '    	=>	trim($this->input->post('membership_validity')),
				'is_multilocation'  	=>	$this->input->post('is_Multilocation'),
				'plan_desc'  			=>	trim($this->input->post('membership_description')),
				'status'  				=>	trim($this->input->post('status')),						  
			);
			$data =$this->global_mod->db_parse($data);
			$this->db->where('plan_id', $plan_id);
			$this->db->update('app_membership_plan',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				  $messg = 4;
			}else{
				$this->db->trans_commit();
				$this->saveTierPrice($post,$plan_id, "edit");
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
	public function saveTierPrice($post='',$membership_plan_id,$mode){
		if($mode =='edit'){
			$this->db->where('plan_id',$membership_plan_id);
			$a = $this->db->delete('app_membership_plan_tierprice'); 
		}
		
		$is_Multilocation=$post['is_Multilocation'];
		if($is_Multilocation == 1){	
			$mul_locations=$post['mul_loc'];	
			foreach($mul_locations as $mul_location=>$value){
				if($mul_location=='1'){
					$is_base_price=1;
				}
				else{
					$is_base_price=0;
				}
				$data = array(
					'plan_id'	        			=>	$membership_plan_id,
					'billing_cycle'	        		=>	trim($mul_locations[$mul_location]['billing_cycle']),
					'no_of_location'	    		=>	trim($mul_locations[$mul_location]['location_num']),
					'staff_per_location'			=>	trim($mul_locations[$mul_location]['staff_per_location']),
					'price '    					=>	trim($mul_locations[$mul_location]['price']),
					'additional_cost_location'  	=>	trim($mul_locations[$mul_location]['additional_cost_location']),
					'is_base_price'  				=>	$is_base_price
				);
				$data =$this->global_mod->db_parse($data);
				$this->db->trans_begin();
				$this->db->insert('app_membership_plan_tierprice',$this->db->escape($data));
				if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$messg = 2;
				}else{
					$this->db->trans_commit();
	                $messg = 1;
				}	           						
			}			
		}elseif($is_Multilocation == 0){
			$mul_locations=$post['mul_loc_no'];
			foreach($mul_locations as $mul_location=>$value){
			if($mul_location=='1'){
				$is_base_price=1;
			}
			else{
				$is_base_price=0;
			}
				$data = array(
					'plan_id'	        			=>	$membership_plan_id,
					'billing_cycle'	        		=>	trim($mul_locations[$mul_location]['billing_cycle']),
					'no_of_location'	    		=>	'',
					'staff_per_location'			=>	trim($mul_locations[$mul_location]['staff_per_location']),
					'price'    					    =>	trim($mul_locations[$mul_location]['price']),
					'additional_cost_location'  	=>	trim($mul_locations[$mul_location]['additional_cost_location']),
					'is_base_price'  				=>	$is_base_price
				);
				$data =$this->global_mod->db_parse($data);
				$this->db->trans_begin();
				$this->db->insert('app_membership_plan_tierprice',$this->db->escape($data));
				if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$messg = 2;
				}else{
					$this->db->trans_commit();
	                $messg = 1;
				}
			}
		}
	}
	public function get_curr(){
        $this->db->select('item_val');
        $this->db->from('app_superadmin_gen_setting');
        $this->db->where('item_name', 'currency_id');
        $query = $this->db->get();
        $selectArr = $query->result_array();
        $selected_val = $selectArr[0]['item_val'];
        return $selected_val;
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