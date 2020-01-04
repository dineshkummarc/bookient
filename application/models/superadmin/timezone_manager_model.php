<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class timezone_manager_model extends CI_Model
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
		$this->db->from('time_zone');
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

        $query = $this->db->get('time_zone');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($time_zone_id)
    {
        $query = $this->db->get_where('time_zone', array('time_zone_id' => $time_zone_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('time_zone', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('time_zone_id', $data['time_zone_id']);
		$msgreport = $this->db->update('time_zone', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('time_zone_order');
		$query = $this->db->get('time_zone');
		$order = $query->row_array();
		$data['time_zone_order'] = $order['time_zone_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('time_zone', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('time_zone_id', $id);
		$a = $this->db->delete('time_zone');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}

        public function EditTIMEZONE()
	{
		$this->db->select('*');
		$this->db->from('app_time_zone');
		$this->db->where('time_zone_id', $this->input->post('time_zone_id'));
		$query = $this->db->get();
		$TIMEZONEArr = $query->result_array();

		foreach($TIMEZONEArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$TIMEZONEArr['time_zone_id']     	= $row['time_zone_id'];
			$TIMEZONEArr['time_zone_name']   	= $row['time_zone_name'];
			$TIMEZONEArr['gmt_symbol']   		= $row['gmt_symbol'];
			$TIMEZONEArr['gmt_value']   		= $row['gmt_value'];
			//$TIMEZONEArr['is_active'] 		= $row['is_active'];

		}

		echo json_encode($TIMEZONEArr);

	}

        public function SaveTIMEZONE()
	{
		$this->db->trans_begin();
                $msgreport;
                $msg;
		if($this->input->post('time_zone_id') == '')
		{
                        $this->db->select_max('time_zone_order');
                        $query = $this->db->get('app_time_zone');
                        $order = $query->row_array();
                        $new_order = $order['time_zone_order']+1;
			$data = array(
                                        'time_zone_name'  	=>	trim($this->input->post('time_zone_name')),
										'gmt_symbol'  		=>	trim($this->input->post('gmt_symbol')),
										'gmt_value'  		=>	trim($this->input->post('gmt_value')),
                                        'is_active'	  		=>	'Y',
                                        'time_zone_order' 	=> $new_order
                                        );	
			$data =$this->global_mod->db_parse($data);															
			$msgreport = $this->db->insert('app_time_zone',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = array(
			             'time_zone_name'	=> trim($this->input->post('time_zone_name')),
						 'gmt_symbol'  		=>	trim($this->input->post('gmt_symbol')),
						'gmt_value'  		=>	trim($this->input->post('gmt_value'))
			             );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('time_zone_id', $this->input->post('time_zone_id'));
			$msgreport = $this->db->update('app_time_zone',$this->db->escape($data));
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


        public function get_title()
        {

            $result=0;
            $this->db->select('*');
            $this->db->from('app_time_zone');
            $this->db->where('time_zone_name', $_POST['time_zone_name']);
            $query = $this->db->get();
            $num = $query->num_rows();
            $Ret_Arr_val = $query->result_array();
            //echo  $num;
            if($_POST['time_zone_id'] == '')
            {
                if($num == 0){
                    $result=1;
                } else {
                    $result=0;
                }
            }
            else {
                if($num == 0){
                    $result=1;
                }
                else
                {
                    if($_POST['time_zone_id'] == $Ret_Arr_val[0]['time_zone_id'] )
                    {
                     $result=1;
                    } else {
                     $result=0;
                    }
                }
            }
	    echo $result;

        }


}
?>