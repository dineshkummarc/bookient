<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class city_manager_model extends CI_Model
{
    var $title   = '';
    var $content = '';
    var $date    = '';
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	//get total records with/without a given condition...
    function get_TotalRecords($where='',$like=''){

            if(!empty($where))
                    $this->db->where($where);
            if(!empty($like))
                    $this->db->or_like($like);
                    $this->db->from('cities');
                    $this->db->join('regions','regions.region_id = cities.region_id');
                    $this->db->join('countries','countries.country_id = cities.country_id');
                    return $this->db->count_all_results();
	}
	//get all catalog details
    function get_AllCatalogArr($start=0,$limit=10,$order_by='',$order_type='',$where='',$like=''){
		if(!empty($order_by) && !empty($order_type))
			$this->db->order_by($order_by, $order_type);

		if(!empty($where))
			$this->db->where($where);

		if(!empty($like))
			$this->db->or_like($like);
		if($limit)
			$this->db->limit($limit,$start);


                $this->db->from('cities');
                $this->db->join('regions','regions.region_id = cities.region_id');
                $this->db->join('countries','countries.country_id = cities.country_id');
                $query = $this->db->get();

        return $query->result();
    }
	//get catalog details by catalog_id
    function get_CatalogArr($city_id){
        $query = $this->db->get_where('cities', array('city_id' => $city_id));
        return $query->row();
    }
	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url){
        $query = $this->db->get_where('cities', array('catelog_url' => $catalog_url));
        return $query->row();
    }
	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('city_id', $data['city_id']);
		$msgreport = $this->db->update('cities', $data);
		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;
		return $msg;
	}
	function addCatalogDetails($data){
		$this->db->select_max('city_order');
		$query = $this->db->get('cities');
		$order = $query->row_array();
		$data['city_order'] = $order['city_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('cities', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}
	function deleteCatalog($id){
		$this->db->where('city_id', $id);
		$a = $this->db->delete('cities');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}
    function country($city_id=''){
        $this->load->database();
	    if($city_id !=''){
            $query=$this->db->query("SELECT country_id from app_cities where city_id='".$city_id."'");
            $row1 = $query->row();
            $country_name_id=$row1->country_id;
	    }else{
		    $country_name_id='';
	    }
        $country='<select name="country_id" id="cus_countryid" onchange="country_name_change(this.value);" >
        <option value="" >----Country---</option>';
        $this->load->database();
        $sql=$this->db->query("SELECT * FROM app_countries ORDER BY country_name");
        foreach ($sql->result() as $row){
            $country_name=$row->country_name;
            $country_id=$row->country_id;
            if($country_id==$country_name_id){
                $country_id_selected='selected="selected"';
            }else{
                $country_id_selected="";
            }
            $country.="<option value=".$country_id." ".$country_id_selected.">".$country_name."</option>";
        }
		$country.='</select>';
		return $country;
	}
    function region($country_id=''){
        $this->load->database();
        $region='<option value="" >----Select Region---</option>';
        $this->load->database();
        $sql=$this->db->query("SELECT * from app_regions where 	country_id = '".$country_id."'");
        foreach ($sql->result() as $row){
            $region_name=$row->region_name;
            $region_id=$row->region_id;
            $region_id_selected="";
            $region_name_id ="";
            if($region_id==$region_name_id){
                $region_id_selected='selected="selected"';
            }else{
                $region_id_selected="";
            }
            $region.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";
        }
		return $region;
    }
    function regions_under_country($city_id=''){
        $this->load->database();
        $country_name_id ="";
        $region_name_id = "";
        if($city_id !=''){
            $query=$this->db->query("SELECT country_id,region_id  from app_cities where city_id='".$city_id."'");
            $row1 = $query->row();
            $country_name_id=$row1->country_id;
            $region_name_id = $row1->region_id;
        }else{
            //$country_name_id='';
        }
        $allregion = '';
        $this->load->database();
        $sql=$this->db->query("SELECT * from app_regions where 	country_id = '".$country_name_id."'");
        foreach ($sql->result() as $row){
            $region_name=$row->region_name;
            $region_id=$row->region_id;
            $region_id_selected="";

            if($region_id==$region_name_id){
                $region_id_selected='selected="selected"';
            }else{
                $region_id_selected="";
            }
            $allregion.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";
        }
        return $allregion;
    }
    public function EditCITY(){
        $this->db->select('*');
        $this->db->from('app_cities');
        $this->db->where('city_id', $this->input->post('city_id'));
        $query = $this->db->get();
        $CITYArr = $query->result_array();

        foreach($CITYArr as $row){
            $CITYArr['city_id']     = $row['city_id'];
            $CITYArr['city_name']   = $row['city_name'];
            $CITYArr['lat']         = $row['lat'];
            $CITYArr['long'] 	    = $row['long'];
            $CITYArr['city_key']    = $row['city_key'];
            $CITYArr['is_active_s'] = $row['is_active_s'];
        }
        return $CITYArr;
    }
    public function GetCountryName($id){
        $this->db->select('*');
        $this->db->from('app_countries');
        $this->db->where('country_id', $id);
        $query = $this->db->get();
        $RESCArr = $query->result_array();
        $res = $RESCArr[0]['country_name'];
        return $res ;
    }
    public function GetRegionName($id){
        $this->db->select('*');
        $this->db->from('app_regions');
        $this->db->where('region_id', $id);
        $query = $this->db->get();
        $RESRArr = $query->result_array();
        $res = $RESRArr[0]['region_name'];
        return $res ;
    }
    public function SaveCITY(){
        //echo "PPP : ".trim($this->input->post('city_name'));exit;
        $this->db->trans_begin();
        $msgreport;
        $msg;
        if($this->input->post('city_id') == ''){
            $this->db->select_max('city_order');
            $query = $this->db->get('app_cities');
            $order = $query->row_array();
            $new_order = $order['city_order']+1;

            $data = array(
                'country_id'	=>	trim($this->input->post('country_id')),
                'region_id'	    =>	trim($this->input->post('region_id')),
                'city_name'	    =>	trim($this->input->post('city_name')),
                'lat'	        =>	trim($this->input->post('lat')),
                'long'          =>	trim($this->input->post('long')),
                'city_key'	    =>	trim($this->input->post('city_key')),
                'is_active_s'	=>  'Y',
                'city_order'    =>  $new_order
            );
			$data =$this->global_mod->db_parse($data);
            $msgreport = $this->db->insert('app_cities',$this->db->escape($data));
            if($msgreport == 1)
		        $msg = 2;
		    else
		        $msg = 1;
        }else{
            $data = array(
                'country_id'	=>	trim($this->input->post('country_id')),
                'region_id'	    =>	trim($this->input->post('region_id')),
                'city_name'	    =>	trim($this->input->post('city_name')),
                'lat'	        =>	trim($this->input->post('lat')),
                'long'	        =>	trim($this->input->post('long')),
                'city_key'	    =>	trim($this->input->post('city_key')),
            );
			$data =$this->global_mod->db_parse($data);
            $this->db->where('city_id', $this->input->post('city_id'));
            $msgreport = $this->db->update('app_cities',$this->db->escape($data));
            if($msgreport == 1)
			    $msg = 4;
		    else
			    $msg = 3;
        }
        $this->db->last_query();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
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