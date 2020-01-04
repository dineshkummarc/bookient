<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class region_manager_model extends CI_Model
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
       function get_TotalRecords($where='',$like='')
       {

            if(!empty($where))
                    $this->db->where($where);
            if(!empty($like))
                    $this->db->or_like($like);
                    $this->db->from('regions');
                    $this->db->join('countries', 'countries.country_id = regions.country_id');
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


                $this->db->from('regions');
                $this->db->join('countries', 'countries.country_id = regions.country_id');
                $query = $this->db->get();

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($region_id)
    {
        $query = $this->db->get_where('regions', array('region_id' => $region_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('regions', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('region_id', $data['region_id']);
		$msgreport = $this->db->update('regions', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('region_order');
		$query = $this->db->get('regions');
		$order = $query->row_array();
		$data['region_order'] = $order['region_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('regions', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('region_id', $id);
		$a = $this->db->delete('regions');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}

        function country($region_id='')
	{
		$this->load->database();

            if($region_id !='')
            {


                            $query=$this->db->query("SELECT country_id from app_regions where region_id='".$region_id."'");
                            $row1 = $query->row();
                            $country_name_id=$row1->country_id;

            }
            else
            {
                    $country_name_id='';
            }
            //}

            $country='<select name="country_id" id="cus_countryid_5" onchange="status_check();" >
            <option value="" >----Select Country---</option>';
            $this->load->database();
            $sql=$this->db->query("SELECT * from app_countries");
            foreach ($sql->result() as $row)
            {
               $country_name=$row->country_name;
               $country_id=$row->country_id;
               if($country_id==$country_name_id)
                    {
                    $country_id_selected='selected="selected"';
                    }
                    else
                    {
                            $country_id_selected="";
                    }
               $country.="<option value=".$country_id." ".$country_id_selected.">".$country_name."</option>";
            }

            $country.='</select>';
            return $country;
         }

        public function EditREGION()
	{
		$this->db->select('*');
		$this->db->from('app_regions');
		$this->db->where('region_id', $this->input->post('region_id'));
		$query = $this->db->get();
		$REGIONArr = $query->result_array();

		/*foreach($REGIONArr as $row)
		{
			$REGIONArr['region_id']    = $row['region_id'];
			$REGIONArr['region_name']  = $row['region_name'];
			$REGIONArr['is_actives'] 	= $row['is_actives'];
			$REGIONArr['region_code'] 	= $row['region_code'];
		}*/
		//echo json_encode($REGIONArr);
		return $REGIONArr;
	}


        public function SaveREGION()
	{
		$this->db->trans_begin();
                $msgreport;
                $msg;

		if(trim($this->input->post('region_id')) == '')
		{

                        $this->db->select_max('region_order');
                        $query = $this->db->get('app_regions');
                        $order = $query->row_array();
                        $new_order = $order['region_order']+1;

			$data = array(
                                'region_name'	    => trim($this->global_mod->db_parse($_REQUEST['regionname'])),		//<-
                                'is_actives'	    =>	'Y'	,
                                'region_code'	    => 	trim($this->input->post('region_code')),
                                'country_id'	    => trim($this->input->post('country_id')),
                                'region_order'      => $new_order
                                );
		//	$data =$this->global_mod->db_parse($data);
			$msgreport = $this->db->insert('app_regions',$this->db->escape($data));
                        if($msgreport == 1)
			$msg = 2;
		        else
			$msg = 1;
		}
		else
		{
			$data = array(
                                'region_name'	=>	trim($this->global_mod->db_parse($_REQUEST['regionname'])),	//<-
                                'region_code'	=> 	trim($this->input->post('region_code')),
                                'country_id'    => 	trim($this->input->post('country_id'))
                        );
		
			$this->db->where('region_id',trim($this->input->post('region_id')));
			$msgreport = $this->db->update('app_regions',$this->db->escape($data));
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