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
			$this->db->from('membership_types');
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
			$this->db->join('app_currency','app_currency.currency_id = app_membership_types.currency_id');
			$this->db->where('status !=', 2);
			$query = $this->db->get('membership_types');
			return $query->result();
    }

    public function get_CatalogArr($membership_type_id){
        $query = $this->db->get_where('membership_types', array('membership_type_id' => $membership_type_id));
        return $query->row();
    }

    public function get_CatalogByUrl($catalog_url){
        $query = $this->db->get_where('membership_types', array('catelog_url' => $catalog_url));
        return $query->row();
    }

    public function deleteCatalog($id){
            $data = array( 'status'=> 2,'membership_order' => -1);
            $this->db->where('membership_type_id', $id);
            $a = $this->db->update('app_membership_types',$this->db->escape($data));
            if($a == 1){
				$result = 6;
			}else{
				$result = 5;
			}      
            return $result;
    }

    public function ChangeStatus($membership_type_id){
		$this->db->select('status');
		$this->db->from('app_membership_types');
		$this->db->where('membership_type_id',$membership_type_id );
		$query = $this->db->get();
		$StatusArr = $query->result_array();

		if($StatusArr[0]['status'] == '1'){
			$data = array('status' => '0');
		}else{
			$data = array('status' => '1');
		}

		$this->db->trans_begin();
		$this->db->where('membership_type_id', $membership_type_id);
		$this->db->update('app_membership_types',$this->db->escape($data));

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();

		}
	}

    public function Edit(){
		$this->db->select('*');
		$this->db->from('app_membership_plan_feature');
		$this->db->where('membership_type_id', $this->input->post('membership_type_id'));
		$query = $this->db->get();
		$RetFeatureArr = $query->result_array();
		$num = count($RetFeatureArr);
		$html = '';
		if($num > 0){
			for($i=0; $i < $num; $i++){
				$index = $i+1;
				$html .= '<input type="text" name="membership_feature_'.$index.'" id="membership_feature_'.$index.'" value="'.$RetFeatureArr[$i]["membership_plan_feature"].'" />&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_feature(\''.$RetFeatureArr[$i]["membership_plan_feature_id"].'\',\''.$this->input->post('membership_type_id').'\')">Delete</a>';

				if($index == $num){
					$html .= '&nbsp;&nbsp;<div id="hide_link_'.$index.'"  class="hide_add" style="text-align:right; width:67%;"><a href="javascript:void(0);" onclick="add_another_box();" ><img src="'.base_url().'images/Add-feature.png" alt="" title="Add Feature" />Add Another Feature</a></div><div id="add_new_feature'.$index.'"></div><input type="hidden" name="feature_num" id="feature_num" value="'.$index.'" />';
				}
			}
		}else{
			$html .= '<input type="text" name="membership_feature_1" id="membership_feature_1" value="" />&nbsp;&nbsp;<div id="hide_link_1"  class="hide_add" style="text-align:right; width:67%;"><a href="javascript:void(0);" onclick="add_another_box();" ><img src="'.base_url().'images/Add-feature.png" alt="" title="Add Feature" />Add Another Feature</a></div><div id="add_new_feature1"></div><input type="hidden" name="feature_num" id="feature_num" value="1" />';
		}

		$this->db->select('*');
		$this->db->from('app_membership_types');
		$this->db->where('membership_type_id', $this->input->post('membership_type_id'));
		$query = $this->db->get();
		$RetArr = $query->result_array();

		foreach($RetArr as $key=>$row){
			$ResArr['membership_name'] = $row['membership_name'];
			$ResArr['membership_amount'] = $row['membership_amount'];
			$ResArr['currency_id'] = $row['currency_id'];
			$ResArr['membership_validity'] = $row['membership_validity'];
			$ResArr['membership_tagline'] = $row['membership_tagline'];
			$ResArr['membership_description'] = $row['membership_description'];
		}
		$ResArr['rplc_id'] = $html;

		return json_encode($ResArr);
	}

    public function get_title(){
            $result=0;
            $this->db->select('*');
            $this->db->from('app_membership_types');
            $this->db->where('membership_name', $this->input->post('title'));
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
                    if($this->input->post('id') == $Ret_Arr_val[0]['membership_type_id'] ){
                     $result=1;
                    }else{
                     $result=0;
                    }
                }
            }
	    echo $result;

        }
    
	public function Save(){
		if($this->input->post('membership_type_id') == ''){
                        $this->db->select_max('membership_order');
                        $query = $this->db->get('app_membership_types');
                        $order = $query->row_array();
                        $new_order = $order['membership_order']+1;
                        $msgreport;
                        $messg;
			$data = array(
						  'membership_name'	        =>	trim($this->input->post('membership_name')),
						  'membership_amount'	    =>	trim($this->input->post('membership_amount')),
						  'currency_id'				=>	trim($this->input->post('currency_id')),
						  'membership_validity '    =>	trim($this->input->post('membership_validity')),
						  'membership_tagline'		=>	trim($this->input->post('membership_tagline')),
						  'membership_description'  =>	trim($this->input->post('membership_description')),
						  'status'					=> 	'1',
						  'created_on'				=>	date("Y-m-d"),
                          'membership_order'        =>  $new_order
						  );
			$this->db->trans_begin();
			$this->db->insert('app_membership_types',$this->db->escape($data));
			$membership_type_id = $this->db->insert_id();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$this->db->trans_commit();
                $msgreport = 1;
			}

			$num_feature = $this->input->post('feature_num');
			for($i=1; $i <= $num_feature; $i++){
				if($this->input->post('membership_feature_'.$i) != ''){
					$data_feature = array( 
											'membership_plan_feature' => $this->input->post('membership_feature_'.$i),
											'membership_type_id' => $membership_type_id, 
											'status' => '1', 
											'created_on' => date("Y-m-d") 
											);
					$this->db->trans_begin();
					$this->db->insert('app_membership_plan_feature',$this->db->escape($data_feature));
					$membership_plan_feature_id = $this->db->insert_id();
					if($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();
					}else{
						$this->db->trans_commit();
                        $msgreport = 1;
					}
				}
			}
            if($msgreport == 1){
				$messg = 2;
			}else{
				$messg = 1;	
				}			
		}else{
			$membership_type_id = $this->input->post('membership_type_id');
			$data = array(
						  'membership_name'	        =>	trim($this->input->post('membership_name')),
						  'membership_amount'	   	=>	trim($this->input->post('membership_amount')),
						  'currency_id'				=>	trim($this->input->post('currency_id')),
						  'membership_validity '	=>	trim($this->input->post('membership_validity')),
						  'membership_tagline'		=>	trim($this->input->post('membership_tagline')),
						  'membership_description'	=>	trim($this->input->post('membership_description')),
						  );
			$this->db->where('membership_type_id', $membership_type_id);
			$this->db->update('app_membership_types',$this->db->escape($data));
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$this->db->trans_commit();
                $msgreport = 1;
			}			
			$this->db->where('membership_type_id', $membership_type_id);
			$this->db->delete('app_membership_plan_feature'); 
			$num_feature = trim($this->input->post('feature_num'));
			for($i=1; $i <= $num_feature; $i++){
				if($this->input->post('membership_feature_'.$i) != ''){
					$data_feature = array( 
										'membership_plan_feature' => $this->input->post('membership_feature_'.$i),
										'membership_type_id' => $membership_type_id,  
										'status' => '1', 
										'created_on' => date("Y-m-d") 
										);
					$this->db->insert('app_membership_plan_feature',$this->db->escape($data_feature));
					if ($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();
					}else{
						$this->db->trans_commit();
                        $msgreport = 1;
					}
				}
			}

           if($msgreport == 1){
		   		$messg = 4;
		   } else{
		   		$messg = 3;
		   }
			
		}
			if($messg == 1){
				$msg = "Add operation unsuccessful. Try again.";
			}elseif($messg == 2){
				$msg = "Added successfully.";
			}elseif($messg == 3){
				$msg = "Change operation unsuccessful. Try again.";
			}elseif($messg == 4){
				$msg = "Updated successfully.";
			}
            $this->session->set_flashdata('status_massage', $msg);
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

	public function get_All_Records($where='',$like='',$id){
		if(!empty($where)){
			$this->db->where($where);
		}     
		if(!empty($like)){
			$this->db->or_like($like);
		}
			$this->db->from('app_membership_plan_subscriptions');
			$this->db->where('membership_type_id', $id);
			return $this->db->count_all_results();
       }

    public function get_AllCat_Arr($start=0,$limit=10,$order_by='',$order_type='',$where='',$like='',$id){
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
			$this->db->from('app_membership_plan_subscriptions');
			$this->db->where('membership_type_id', $id);
			$query = $this->db->get();
			return $query->result();

    }

	public function GetSubscriptionData($plan_subscriptions_id){
		$this->db->select('*');
		$this->db->from('app_membership_plan_subscriptions');
		$this->db->where('plan_subscriptions_id',$plan_subscriptions_id );
		$query = $this->db->get();
		$RetArr = $query->result_array();
	foreach($RetArr as $row){
		$RetArr['plan_subscriptions_id'] = $row['plan_subscriptions_id'];
		$RetArr['sub_plan_desc'] = $row['sub_plan_desc'];
		$RetArr['amount'] = $row['amount'];
		$RetArr['validity'] = $row['validity'];
		$RetArr['extra_validity'] = $row['extra_validity'];
		}
		return json_encode($RetArr);
	}

	public function SaveSubs(){
		$msgreport;
		$msg;
		$this->db->trans_begin();
		if($this->input->post('plan_subscriptions_id') == ''){
		        $this->db->select_max('plan_subscriptions_order');
		        $query = $this->db->get('app_membership_plan_subscriptions');
		        $order = $query->row_array();
		        $new_order = $order['plan_subscriptions_order']+1;
		$data = array(
				  'membership_type_id'	       	=>	$this->input->post('membership_type_id'),
				  'sub_plan_desc'	       		=>	$this->input->post('sub_plan_desc'),
				  'amount'						=>	$this->input->post('amount'),
				  'validity'					=>	$this->input->post('validity'),
				  'extra_validity'				=>	$this->input->post('extra_validity'),
				  'status'						=> 	'1',
				  'date_creation'				=>	date("Y-m-d"),
		          'plan_subscriptions_order'    =>   $new_order
				  );
		$msgreport = $this->db->insert('app_membership_plan_subscriptions',$this->db->escape($data));
		if($msgreport == 1){
			$msg = 2;
		}else{
			$msg = 1;
		}
			
		}else{
			$data = array(
						  'membership_type_id'	       	=>	$this->input->post('membership_type_id'),
						  'sub_plan_desc'	       		=>	$this->input->post('sub_plan_desc'),
						  'amount'						=>	$this->input->post('amount'),
						  'validity'					=>	$this->input->post('validity'),
						  'extra_validity'				=>	$this->input->post('extra_validity'),
						  );
			$this->db->where('plan_subscriptions_id', $this->input->post('plan_subscriptions_id'));
			$msgreport = $this->db->update('app_membership_plan_subscriptions',$this->db->escape($data));
			if($msgreport == 1){
				$msg = 4;
			}else{
				$msg = 3;
			}
			
		}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$this->db->trans_commit();
			}
		if($msg == 1){
			$msg_l = "Add operation unsuccessful. Try again.";
		}elseif($msg == 2){
			$msg_l = "Added successfully.";
		}elseif($msg == 3){
			$msg_l = "Change operation unsuccessful. Try again.";
		}elseif($msg == 4){
			$msg_l = "Updated successfully.";
		}
                         
			$this->session->set_flashdata('status_massage', $msg_l);
	}

	public function delete_Subs($id){
        $this->db->where('plan_subscriptions_id', $id);
        $a = $this->db->delete('membership_plan_subscriptions');
        if($a == 1){
			$result = 6;
		}else{
			$result = 5;
		}       
        return $result;
     }

	public function ChangeStatus_subs($id){
	    $this->db->select('status');
	    $this->db->from('app_membership_plan_subscriptions');
	    $this->db->where('plan_subscriptions_id',$id );
	    $query = $this->db->get();
	    $StatusArr = $query->result_array();

	    if($StatusArr[0]['status'] == '1'){
	            $data = array('status' => '0');
	    }else{
	            $data = array('status' => '1');
	    }

	    $this->db->trans_begin();
	    $this->db->where('plan_subscriptions_id', $id);
	    $this->db->update('app_membership_plan_subscriptions',$this->db->escape($data));

	    if ($this->db->trans_status() === FALSE){
	            $this->db->trans_rollback();
	    }else{
	            $this->db->trans_commit();
	    }
	}

	public function find_children(){
		$id = $this->input->post('membership_type_id');
		$this->db->select('count(*) as rows_count');
		$this->db->from('app_membership_plan_subscriptions');
		$this->db->where('membership_type_id', $id);
		$query = $this->db->get();
		$Ret_Arr_val = $query->result_array();

		$del_res = '';
		if($Ret_Arr_val[0]['rows_count'] == 0){
			$del_res = 0;
		}else{
			$del_res = 1;
		}
			return $del_res;
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
				$CI->db->where($pkey_field, $key);
				$this->db->where('status !=', 2);
				$CI->db->update($tablename, $data);
			}
		}
		return;
	}

	public function get_Currency($id){
		$this->db->select('app_currency.currency_symbol');
		$this->db->from('app_membership_types');
		$this->db->join('app_currency','app_currency.currency_id = app_membership_types.currency_id');
		$this->db->where('app_membership_types.membership_type_id', $id);
		$query = $this->db->get();
		$RetArr = $query->result_array();
		return $RetArr[0]['currency_symbol'];
	}

}


?>