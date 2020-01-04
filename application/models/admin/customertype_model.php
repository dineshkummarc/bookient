<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customertype_model extends CI_Model
{
    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }

	//get total records with/without a given condition...
	function get_TotalRecords($where='',$like=''){
		$localAdminId = $this->session->userdata('local_admin_id');
		if(!empty($where))
			$this->db->where($where);
		if(!empty($like))
			$this->db->or_like($like);
			
		$this->db->where('customertype_localadmin',$localAdminId);
		$this->db->where('customertype_isdeleted','Y');	
		$this->db->from('app_customertype');
		return $this->db->count_all_results();
	}

	//get all catalog details
   function get_AllCatalogArr($start=0,$limit=10,$order_by='',$order_type='',$where='',$like='')
    {
    	$localAdminId = $this->session->userdata('local_admin_id');
		if(!empty($order_by) && !empty($order_type))
			$this->db->order_by($order_by, $order_type);

		if(!empty($where))
			$this->db->where($where);

		if(!empty($like))
			$this->db->or_like($like);
		if($limit)
			$this->db->limit($limit,$start);
			
		$this->db->where('customertype_localadmin',$localAdminId);
		$this->db->where('customertype_isdeleted','Y');
        $query = $this->db->get('app_customertype');

        return $query->result();
    }

	//get catalog details by catalog_id
   /*  function get_CatalogArr($customertype_id)
    {
        $query = $this->db->get_where('app_customertype', array('customertype_id' => $customertype_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('app_customertype', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$this->db->where('customertype_id', $data['customertype_id']);
		$msgreport = $this->db->update('app_customertype', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('tax_master_order');
		$query = $this->db->get('tax_master');
		$order = $query->row_array();
		$data['tax_master_order'] = $order['tax_master_order']+1;

		$msgreport = $this->db->insert('tax_master', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}
*/
	function deleteCatalog($id){
		
		$data = array(
               'customertype_isdeleted' => 'N'
            );

		$this->db->where('customertype_id', $id);
		$a = $this->db->update('app_customertype', $data); 
		
		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}


        public function EditCustomerType()
		{
			$this->db->select('*');
			$this->db->from('app_customertype');
			$this->db->where('customertype_id', $this->input->post('customertype_id'));
			$query = $this->db->get();
			$TAXArr = $query->result_array();
			$data = '';
			foreach($TAXArr as $row)
			{
			    //echo "<pre>";print_r($row);exit;
			/*	$TAXArr['customertype_id']     		= $row['customertype_id'];
				$TAXArr['customertype_name']        = $row['customertype_name'];
				$TAXArr['customertype_status'] 	    = $row['customertype_status'];*/
				$data .= $row['customertype_id'].'ccc';
				$data .= $row['customertype_name'].'ccc';
				$data .= $row['customertype_status'];

			}
			echo $data;
			//echo json_encode($TAXArr);

		}

        public function SaveCustomerType()
		{
			
			$this->db->trans_begin();
	                $msgreport;
	                $msg;
			if($this->input->post('type_id') == '')
			{
				$localAdminId = $this->session->userdata('local_admin_id');
				$data = array(
	                                        'customertype_name'			=> trim($this->input->post('type_name')),
	                                        'customertype_adddate'  	=> date('Y-m-d'),
	                                        'customertype_status'	    =>	$this->input->post('type_status'),
	                                        'customertype_localadmin'	=> $localAdminId
	                                      );
				$data = $this->global_mod->db_parse($data);
				$msgreport = $this->db->insert('app_customertype',$this->db->escape($data));
	                        if($msgreport == 1)
				$msg = 2;
			        else
				$msg = 1;
			}
			else
			{
				$data = array(
				            'customertype_name'					=> trim($this->input->post('type_name')),
					     	'customertype_editdate'      		=> date('Y-m-d'),
					     	'customertype_status'				=> $this->input->post('type_status')

	                         );
	            $data = $this->global_mod->db_parse($data);            
				$this->db->where('customertype_id', $this->input->post('type_id'));
				$msgreport = $this->db->update('app_customertype',$this->db->escape($data));
	                        if($msgreport == 1)
				$msg = 4;
			        else
				$msg = 3;
			}
			$this->db->last_query();
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
	                if($msg == 1)
			   				$msg_l = $this->lang->line('add_opratn_unsuccfl');
	                elseif($msg == 2)
	                         $msg_l = $this->lang->line('add_succflly');
	                elseif($msg == 3)
	                         $msg_l = $this->lang->line('chng_unsuccfl');
	                elseif($msg == 4)
	                         $msg_l = $this->lang->line('updated_succ');

	                 $this->session->set_flashdata('status_massage', $msg_l);

		}
		
		
        public function ChangeStatusTAX($id)
		{

			$this->db->select('customertype_status');
			$this->db->from('app_customertype');
			$this->db->where('customertype_id', $id);
			$query = $this->db->get();
			$StatusArr = $query->result_array();


			if($StatusArr[0]['customertype_status'] == 'Y')
			{
				$data = array('customertype_status' => 'N');
				//$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
			}
			else
			{
				$data = array('customertype_status' => 'Y');
				//$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
			}

			$this->db->trans_begin();
			$this->db->where('customertype_id', $id);
			$this->db->update('app_customertype',$this->db->escape($data));
			$this->db->last_query();

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				//echo 0;
			}
			else
			{
				$this->db->trans_commit();
				//echo $ret;
			}
		}
	
	
	

}
?>