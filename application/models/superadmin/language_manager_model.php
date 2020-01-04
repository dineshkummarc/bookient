<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class language_manager_model extends CI_Model
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
		$this->db->from('languages');
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

        $query = $this->db->get('languages');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($languages_id)
    {
        $query = $this->db->get_where('languages', array('languages_id' => $languages_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('languages', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('languages_id', $data['languages_id']);
		$msgreport = $this->db->update('languages', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('languages_order');
		$query = $this->db->get('languages');
		$order = $query->row_array();
		$data['languages_order'] = $order['languages_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('languages', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('languages_id', $id);
		$a = $this->db->delete('languages');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}

        public function EditLANGUAGE()
	{
		$this->db->select('*');
		$this->db->from('app_languages');
		$this->db->where('languages_id', $this->input->post('languages_id'));
		$query = $this->db->get();
		$LANGUAGEArr = $query->result_array();

		foreach($LANGUAGEArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$LANGUAGEArr['languages_id']      = $row['languages_id'];
			$LANGUAGEArr['language_flag']    = $row['language_flag'];
			$LANGUAGEArr['image']             = $row['image'];
			//$TAXArr['status'] 	     = $row['status'];

		}

		echo json_encode($LANGUAGEArr);

	}

        public function do_upload()
	{
			$config['upload_path'] = './uploads/language';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$return=array();
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$return['error']=$error;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				//$this->load->view('staff', $data);
				$return['data']=$data;
			}
			return $return;
	}

        public function SaveLANGUAGE($POST,$image)
	{
                $rr ="";
                $msgreport;
                $msg;

		$this->db->trans_begin();
		if($POST['languages_id']== '')
		{
                        $this->db->select_max('languages_order');
                        $query = $this->db->get('app_languages');
                        $order = $query->row_array();
                        $new_order = $order['languages_order']+1;
			$data = array(
                                            'languages_name'	=> trim($POST['languagesname']),
                                            'language_flag'		=> trim($POST['languagesname']),
                                            'status'	        => 1,
                                            'image'             =>  $image,
                                            'languages_order'   => $new_order
				      );
			$data =$this->global_mod->db_parse($data);
			$msgreport = $this->db->insert('app_languages',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = "";
			if($image == "")
			{
				$data = array(
			            'language_flag'	=>  trim($POST['languagesname'])
				  );

			}else {
				$data = array(
							'language_flag'	=>  trim($POST['languagesname']),
							'image'   =>  $image
							  );
			}
			$data =$this->global_mod->db_parse($data);
			$this->db->where('languages_id', $POST['languages_id']);
			$msgreport = $this->db->update('app_languages',$this->db->escape($data));
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



        public function ChangeStatusLANGUAGE($id)
        {

		$this->db->select('status');
		$this->db->from('app_languages');
		$this->db->where('languages_id', $id);
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		//echo '<pre>';print_r($StatusArr);exit;

		if($StatusArr[0]['status'] == 1)
		{
			$data = array('status' => 0);

		}
		else
		{
			$data = array('status' => 1);

		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('languages_id', $id);
		$this->db->update('app_languages',$this->db->escape($data));
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

}
?>




