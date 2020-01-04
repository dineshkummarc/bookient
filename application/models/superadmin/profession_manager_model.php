<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profession_manager_model extends CI_Model
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
		$this->db->from('profession');
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

        $query = $this->db->get('profession');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($profession_id)
    {
        $query = $this->db->get_where('profession', array('profession_id' => $profession_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('profession', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('profession_id', $data['profession_id']);
		$msgreport = $this->db->update('profession', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('profession_order');
		$query = $this->db->get('profession');
		$order = $query->row_array();
		$data['profession_order'] = $order['profession_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('profession', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('profession_id', $id);
		$a = $this->db->delete('profession');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}

        public function EditPROFESSION()
	{
		$this->db->select('*');
		$this->db->from('app_profession');
		$this->db->where('profession_id', $this->input->post('profession_id'));
		$query = $this->db->get();
		$PROFESSIONArr = $query->result_array();

		foreach($PROFESSIONArr as $row)
		{
			$PROFESSIONArr['profession_id']    = $row['profession_id'];
			$PROFESSIONArr['profession_name']  = $row['profession_name'];
			$PROFESSIONArr['is_active'] 	   = $row['is_active'];
		}

		echo json_encode($PROFESSIONArr);
	}

        public function SavePROFESSION()
	{
		$this->db->trans_begin();
                $msgreport;
                $msg;
		if($this->input->post('profession_id') == '')
		{
                        $this->db->select_max('profession_order');
                        $query = $this->db->get('app_profession');
                        $order = $query->row_array();
                        $new_order = $order['profession_order']+1;
			$data = array(
						  'profession_name'	=>	trim($this->input->post('professionname')),		//<-
						  'is_active'		=>	'Y',
                          'profession_order'    =>     $new_order
						  );
			$data =$this->global_mod->db_parse($data);
			$msgreport = $this->db->insert('app_profession',$this->db->escape($data));
                        if($msgreport == 1)
                        $msg = 2;
                        else
                        $msg = 1;
		}
		else
		{
			$data = array(
			              'profession_name'	=>	trim($this->input->post('professionname'))	//<-
						  );
						  $data =$this->global_mod->db_parse($data);
			$this->db->where('profession_id', $this->input->post('profession_id'));
			$msgreport = $this->db->update('app_profession',$this->db->escape($data));
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
            $this->db->from('app_profession');
            $this->db->where('profession_name', $_POST['professionname']);
            $query = $this->db->get();
            $num = $query->num_rows();
            $Ret_Arr_val = $query->result_array();
            //echo  $num;
            if($_POST['profession_id'] == '')
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
                    if($_POST['profession_id'] == $Ret_Arr_val[0]['profession_id'] )
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