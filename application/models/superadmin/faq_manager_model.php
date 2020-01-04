<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faq_manager_model extends CI_Model
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
		$this->db->from('faq');
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

        $query = $this->db->get('faq');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($faq_id)
    {
        $query = $this->db->get_where('faq', array('faq_id' => $faq_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('faq', array('catelog_url' => $catalog_url));
        return $query->row();
    }


    function deleteCatalog($id){
            $this->db->where('faq_id 	', $id);
            $a = $this->db->delete('faq');

            if($a == 1)
                    $result = 6;
            else
                    $result = 5;
            return $result;
    }
    public function EditFAQ()
    {
            $this->db->select('*');
            $this->db->from('app_faq');
            $this->db->where('faq_id', $this->input->post('faq_id'));
            $query = $this->db->get();
            $FAQArr = $query->result_array();

            foreach($FAQArr as $row)
            {
                    $FAQArr['faq_id'] 		= $row['faq_id'];
                    $FAQArr['faq_question'] = $row['faq_question'];
                    $FAQArr['faq_answer'] 	= $row['faq_answer'];
                    $FAQArr['is_active'] 	= $row['is_active'];
            }

            echo json_encode($FAQArr);
    }

    public function SaveFAQ()
	{
		$this->db->trans_begin();
                $msgreport;
                $msg;

		if($this->input->post('faq_id') == '')
		{
                        $this->db->select_max('faq_order');
                        $query = $this->db->get('faq');
                        $order = $query->row_array();
                        $new_order = $order['faq_order']+1;
			$data = array(
						  'faq_question'	=>	trim($this->input->post('question')),
						  'faq_answer'		=>	trim($this->input->post('answer')),
						  'is_active'		=>	'Y',
						  'date_added'		=>	date("Y-m-d"),
                                                  'faq_order'           =>      $new_order
						  );
			$data =$this->global_mod->db_parse($data);
			$msgreport = $this->db->insert('app_faq',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = array(
						  'faq_question'	=>	trim($this->input->post('question')),
						  'faq_answer'		=>	trim($this->input->post('answer')),
						  'date_edited'		=>	date("Y-m-d")
						  );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('faq_id', $this->input->post('faq_id'));
			$msgreport = $this->db->update('app_faq',$this->db->escape($data));
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
}
?>