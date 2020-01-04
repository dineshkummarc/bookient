<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class credit_manager_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_TotalRecords($where='',$like='')
	{
	if(!empty($where))
		$this->db->where($where);
	if(!empty($like))
		$this->db->or_like($like);
		$this->db->from('app_membership_credits');
	return $this->db->count_all_results();
	}
	
	function get_AllCatalogArr($start=0,$limit=10,$order_by='',$order_type='',$where='',$like='')
    {
		if(!empty($order_by) && !empty($order_type))
			$this->db->order_by($order_by, $order_type);

		if(!empty($where))
			$this->db->where($where);

		if(!empty($like))
			$this->db->or_like($like);
		if($limit)
			$this->db->limit($limit,$start);
         //$this->db->join('app_currency','app_currency.currency_id = app_membership_smscall_dtls.currency_id');
        $query = $this->db->get('app_membership_credits');

        return $query->result();
    }
	
	public function checkpackage()
	{

		//echo '<pre>';print_r($this->input->post('elmentid'));exit;
		$opp_type ="";
		$result;
	    if($this->input->post('elmentid') == "")
		{
			$opp_type ='insert';
			$result = $this->checkpackagenameavailability($this->input->post('action'));
			echo $result;
		}
		else {
			$opp_type ='update';
			$this->db->select('package_name');
			$this->db->from('app_membership_credits');
			$this->db->where('smscall_dtls_id',$this->input->post('elmentid'));
			$query = $this->db->get();
			$selectArr = $query->result_array();
			//echo '<pre>';print_r($selectArr[0]['package_name']);exit;
			if($selectArr[0]['package_name'] == $this->input->post('action'))
			{
				$result = 0;
				echo $result;
			}
			else {
				$result = $this->checkpackagenameavailability($this->input->post('action'));
			     echo $result;
			}

			//echo $opp_type;exit;
			//echo '<pre>';print_r($this->input->post('action'));exit;
	     }


	}
	
	public function checkpackagenameavailability($name)
	{
		$this->db->select('count(*) as rows_count');
		$this->db->from('app_membership_smscall_dtls');
		$this->db->where('package_name',$name);
		$query = $this->db->get();
		$selectArr = $query->result_array();
		//echo '<pre>';print_r($selectArr[0]['rows_count']);exit;
		return $selectArr[0]['rows_count'];

	}
	
/*	public function Save()
	{

		$this->db->trans_begin();
		$msgreport;
        $messg;
		if($this->input->post('action') == '')
		{
                        $this->db->select_max('app_membership_credits');
                        $query = $this->db->get('app_membership_credits');
                        $order = $query->row_array();
						return $order;
                        $new_order = $order['smscall_dtls_order']+1;
			$data = array(
						  'package_name'	=>	trim($this->input->post('package_name')),
						  'amount'			=>	trim($this->input->post('amount')),
						  'credit'			=>	trim($this->input->post('credit')),
						  'description'		=>	trim($this->input->post('description')),
						   //'description'		=>	str_replace("&nbsp;","",$this->input->post('description')),
						  'status'			=> 	'1',
						  'date_creation'	=>	date("Y-m-d"),
						  'currency_id'     =>  $selected_val,
                                                  'smscall_dtls_order' => $new_order
						  );

			$msgreport = $this->db->insert('app_membership_smscall_dtls',$this->db->escape($data));
                        if($msgreport == 1)
			$messg = 2;
		        else
			$messg = 1;
		}
		else
		{
			$data = array(
						  'package_name'	=>	trim($this->input->post('package_name')),
						  'amount'			=>	trim($this->input->post('amount')),
						  'credit'			=>	trim($this->input->post('credit')),
						  'description'		=>	trim($this->input->post('description')),
						  //'description'		=>	str_replace("&nbsp;","",$this->input->post('description')),
						  'currency_id'     =>  $selected_val
						  );

			//str_replace("&nbsp;","",$string);
			$this->db->where('smscall_dtls_id', $this->input->post('smscall_dtls_id'));
			$msgreport = $this->db->update('app_membership_smscall_dtls',$this->db->escape($data));
                        if($msgreport == 1)
			$messg = 4;
		        else
			$messg = 3;
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
                if($messg == 1)
		   $msg = "Add operation unsuccessful. Try again.";
                elseif($messg == 2)
                         $msg = "Added successfully.";
                elseif($messg == 3)
                         $msg = "Change operation unsuccessful. Try again.";
                elseif($messg == 4)
                         $msg = "Updated successfully.";


                $this->session->set_flashdata('status_massage', $msg);         

		}*/
		
		
		public function save_credit($action,$credit_id,$credit_title,$editorText,$amount,$credit){
			$this->db->trans_begin();
			$msgreport;
        	$messg;
			if($action == "Add"){
				
				$this->db->select_max('credit_order');
	            $query = $this->db->get('app_membership_credits');
	            $order = $query->row_array();
				if($order['credit_order'] == ''){
					$credit_order = 1;
				}
				else{
					$credit_order = $order['credit_order']+1;
				}
				
				$data = array(
							  'package_name'	=>	$credit_title,
							  'package_desc'	=>	$editorText,
							  'credits'			=>	$credit,
							  'base_amt'        =>  $amount,
							  'credit_order'    =>  $credit_order,
							  'status'			=> 	'1'
							  );
				$data =$this->global_mod->db_parse($data);
				$msgreport = $this->db->insert('app_membership_credits',$this->db->escape($data));
	            if($msgreport == 1)
					$messg = 1;
			    else
					$messg = 2;
			
			}
			if($action == "Edit"){
			
				$data = array(
              				 'package_name'	=>	$credit_title,
							 'package_desc'	=>	$editorText,
							 'credits'		=>	$credit,
							 'base_amt'     =>  $amount,
           	   );
				$data =$this->global_mod->db_parse($data);
				$this->db->where('credit_id', $credit_id);
				$this->db->update('app_membership_credits',$this->db->escape($data)); 
				
				 if($msgreport == 1)
					$messg = 3;
		         else
					$messg = 4;
			}	
			
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
			
            if($messg == 1)
		  		 $msg = "Added successfully.";
            elseif($messg == 2)
                 $msg = "Add operation unsuccessful. Try again.";
            elseif($messg == 3)
                 $msg = "Change operation unsuccessful. Try again.";
            elseif($messg == 4)
                 $msg = "Updated successfully.";
		  

            $this->session->set_flashdata('status_massage', $msg); 	
			
			
			
			
		}
		
		
		
		public function ChangeStatus($id)
		{
			$this->db->select('status');
			$this->db->from('app_membership_credits');
			$this->db->where('credit_id', $id);
			$query = $this->db->get();
			$StatusArr = $query->result_array();


			if($StatusArr[0]['status'] == '1')
			{
				$data = array('status' => '0');
			}
			else
			{
				$data = array('status' => '1');
			}
			$data =$this->global_mod->db_parse($data);
			$this->db->trans_begin();
			$this->db->where('credit_id', $id);
			$this->db->update('app_membership_credits',$this->db->escape($data));
			$this->db->last_query();

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}
	
	
		public function Edit($credit_id)
		{
			$this->db->select('*');
			$this->db->from('app_membership_credits');
			$this->db->where('credit_id', $credit_id);
			$query = $this->db->get();
			$RetArr = $query->result_array();
			
			foreach($RetArr as $row)
			{
				$RetArr['credit_id'] 	= $row['credit_id'];
				$RetArr['package_name'] 	= $row['package_name'];
				$RetArr['base_amt'] 			= $row['base_amt'];
				$RetArr['credits'] 			= $row['credits'];
				$RetArr['package_desc'] 		= $row['package_desc'];
			}
			
			
			echo json_encode($RetArr);
			
		}
		

		function deleteCatalog($id)
		{
            $this->db->where('credit_id', $id);
            $a = $this->db->delete('app_membership_credits');

            if($a == 1)
                    $result = 6;
            else
                    $result = 5;
            return $result;
    	}
		
		function Deletechild($credit_id){
			$a = $this->db->delete('app_membership_credits_country_price', array('credit_id' => $credit_id)); 
			return $a;
		}
	
	
}
?>