<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_gateway_manager_model extends CI_Model
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
		$this->db->from('payment_gateways');
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

        $query = $this->db->get('payment_gateways');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($payment_gateways_id)
    {
        $query = $this->db->get_where('payment_gateways', array('payment_gateways_id' => $payment_gateways_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('payment_gateways', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('payment_gateways_id', $data['payment_gateways_id']);
		$msgreport = $this->db->update('payment_gateways', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('payment_gateways_order');
		$query = $this->db->get('payment_gateways');
		$order = $query->row_array();
		$data['payment_gateways_order'] = $order['payment_gateways_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('payment_gateways', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('payment_gateways_id', $id);
		$a = $this->db->delete('payment_gateways');
		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}

        function usertype($pay_gate_id='')
	{
		$this->load->database();

		$pay_g_id ='';
		$pay_user_type = '';
		if($pay_gate_id !='')
		{
				$query=$this->db->query("SELECT type from app_payment_gateways where payment_gateways_id='".$pay_gate_id."'");
				$row1 = $query->row();
				$pay_user_type=$row1->type;
		}
		else
		{
			$pay_g_id='';
		}


			//$pay_g ='<select name="payment_gateway" id="payment_gateway">
			$pay_g ='<option value="" >----Type---</option>';
			$this->load->database();
			$usertype = array('SuperAdmin','Local Admin','Both');

			//$pay_g .="<option value=".$country_id_selected.">".$country_name."</option></select>";
			foreach ($usertype as $keyid=>$row)
			{

			   if($pay_user_type==$keyid)
				{
				$pay_user_selected='selected="selected"';
				}
				else
				{
					$pay_user_selected="";
				}

			   $pay_g.="<option value=".$keyid." ".$pay_user_selected.">".$row."</option>";
			}

			//$pay_g .='</select>';
			return $pay_g ;
	}

        public function EditPAYMENTGATEWAY()
	{
		$this->db->select('*');
		$this->db->from('app_payment_gateways');
		$this->db->where('payment_gateways_id', $this->input->post('payment_gateways_id'));
		$query = $this->db->get();
		$PAYMENTGATEWAYArr = $query->result_array();

		foreach($PAYMENTGATEWAYArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$PAYMENTGATEWAYArr['payment_gateways_id']      = $row['payment_gateways_id'];
			$PAYMENTGATEWAYArr['payment_gateways_name']    = $row['payment_gateways_name'];
			//$TAXArr['status'] 	     = $row['status'];

		}

		//echo json_encode($LANGUAGEArr);
		return $PAYMENTGATEWAYArr;

	}

        public function SavePAYMENTGATEWAY()
	{
		//echo $this->input->post('paymentgatewayname');exit;
		$this->db->trans_begin();
                $msgreport;
                $msg;
		if($this->input->post('payment_gateways_id') == '')
		{
                        $this->db->select_max('payment_gateways_order');
                        $query = $this->db->get('app_payment_gateways');
                        $order = $query->row_array();
                        $new_order = $order['payment_gateways_order']+1;

			$data = array(
                                        'payment_gateways_name'   => trim($this->input->post('payment_gateways_name')),
                                        'type'                    => trim($this->input->post('type')),
                                        'status'	          => 1,
                                        'date'                    => date('Y-m-d'),
                                        'payment_gateways_order'  => $new_order
                                     );
									 $data =$this->global_mod->db_parse($data);

			$msgreport = $this->db->insert('app_payment_gateways',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = array(
			             'payment_gateways_name'	=> trim($this->input->post('payment_gateways_name')),
						 'type'         => trim($this->input->post('type')),
				     );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('payment_gateways_id', $this->input->post('payment_gateways_id'));
			$msgreport = $this->db->update('app_payment_gateways',$this->db->escape($data));
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


        public function ChangeStatusPAYMENTGATEWAY($id)
        {

		$this->db->select('status');
		$this->db->from('app_payment_gateways');
		$this->db->where('payment_gateways_id', $id);
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
		$this->db->where('payment_gateways_id', $id);
		$this->db->update('app_payment_gateways',$this->db->escape($data));
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