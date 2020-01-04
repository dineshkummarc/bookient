<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tax_manager_model extends CI_Model
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
	if(!empty($where))
		$this->db->where($where);
	if(!empty($like))
		$this->db->or_like($like);
		$this->db->from('tax_master');
	return $this->db->count_all_results();
	}

	//get all catalog details
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

        $query = $this->db->get('tax_master');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($tax_master_id)
    {
        $query = $this->db->get_where('tax_master', array('tax_master_id' => $tax_master_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('tax_master', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('tax_master_id', $data['tax_master_id']);
		$msgreport = $this->db->update('tax_master', $data);

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
		$data =$this->global_mod->db_parse($data);

		$msgreport = $this->db->insert('tax_master', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('tax_master_id', $id);
		$a = $this->db->delete('tax_master');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}


        public function EditTAX()
	{
		$this->db->select('*');
		$this->db->from('app_tax_master');
		$this->db->where('tax_master_id', $this->input->post('tax_master_id'));
		$query = $this->db->get();
		$TAXArr = $query->result_array();

		foreach($TAXArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$TAXArr['tax_master_id']     = $row['tax_master_id'];
			$TAXArr['tax_title']        = $row['tax_title'];
			//$TAXArr['status'] 	     = $row['status'];

		}

		echo json_encode($TAXArr);

	}

        public function SaveTAX()
	{
		$this->db->trans_begin();
                $msgreport;
                $msg;
		if($this->input->post('tax_master_id') == '')
		{

                        $this->db->select_max('tax_master_order');
                        $query = $this->db->get('tax_master');
                        $order = $query->row_array();
                        $new_order = $order['tax_master_order']+1;

			$data = array(
                                        'tax_title'	=> trim($this->input->post('tax_title')),
                                        'date_added'  => date('Y-m-d'),
                                        'date_edited' => '0000-00-00',
                                        'tax_master_order'  => $new_order,
                                        'status'	    =>	1
                                      );
			$data =$this->global_mod->db_parse($data);
			$msgreport = $this->db->insert('app_tax_master',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = array(
			             'tax_title'	=> trim($this->input->post('tax_title')),
				     'date_edited'      => date('Y-m-d')

                                     );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('tax_master_id', $this->input->post('tax_master_id'));
			$msgreport = $this->db->update('app_tax_master',$this->db->escape($data));
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
		   $msg_l = "Add operation unsuccessful. Try again.";
                elseif($msg == 2)
                         $msg_l = "Added successfully.";
                elseif($msg == 3)
                         $msg_l = "Change operation unsuccessful. Try again.";
                elseif($msg == 4)
                         $msg_l = "Updated successfully.";

                 $this->session->set_flashdata('status_massage', $msg_l);



	}
        public function ChangeStatusTAX($id)
	{

		$this->db->select('status');
		$this->db->from('app_tax_master');
		$this->db->where('tax_master_id', $id);
		$query = $this->db->get();
		$StatusArr = $query->result_array();


		if($StatusArr[0]['status'] == 1)
		{
			$data = array('status' => 0);
			//$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
		}
		else
		{
			$data = array('status' => 1);
			//$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('tax_master_id', $id);
		$this->db->update('app_tax_master',$this->db->escape($data));
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