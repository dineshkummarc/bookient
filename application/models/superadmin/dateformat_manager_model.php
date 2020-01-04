<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dateformat_manager_model extends CI_Model
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
		$this->db->from('date_format');
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

        $query = $this->db->get('date_format');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($tax_master_id)
    {
        $query = $this->db->get_where('date_format', array('date_format_id' => $tax_master_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('date_format', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('date_format_id', $data['date_format_id']);
		$msgreport = $this->db->update('date_format', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('date_format_order');
		$query = $this->db->get('date_format');
		$order = $query->row_array();
		$data['date_format_order'] = $order['date_format_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('date_format', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}
}
?>