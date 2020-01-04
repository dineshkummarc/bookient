<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business_model extends CI_Model{
	public function do_upload(){
		$config['upload_path']   	= './uploads/businesslogo';
		$config['allowed_types']	= 'gif|jpg|jpeg|png';
		$config['max_size']		    = '0';
		$config['max_width']  		= '0';
		$config['max_height']  		= '0';
		$return=array();
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			$return['error']=$error;
		}else{
			$data = array('upload_data' => $this->upload->data());
			//$this->load->view('staff', $data);
			$return['data']=$data;
		}
                //echo '<pre>';print_r($return);exit;
		return $return;
	}

	function select_from_db(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql=$this->db->query("SELECT 
										st.*, 
										region.region_name, 
										c.country_name, 
										city.city_name,
										city.lat,
										city.long 
							  FROM 
										app_local_admin st, 
										app_regions region, 
										app_countries c, 
										app_cities city 
							 WHERE 
							 			c.country_id=st.country_id 
							 			AND 
							 			region.region_id=st.business_state_id 
							 			AND 
							 			city.city_id=st.business_city_id 
							 			AND 
							 			st.local_admin_id='".$local_admin_id."'");
		$list=array();

		foreach ($sql->result() as $row){
			$list['business_name']       =$row->business_name;
			$list['business_description']=$row->business_description;
			$list['page_title']          =$row->page_title;
			$list['business_tag']        =$row->business_tag;
			$list['business_location']   =$row->business_location;
			$list['business_state_id']   =$row->business_state_id;
			$list['city_name']           =$row->city_name;
			$list['region_name']         =$row->region_name;
			$list['country_name']        =$row->country_name;
			$list['business_zip_code']   =$row->business_zip_code;
			$list['business_phone']      =$row->business_phone;
			$list['business_logo']       =$row->business_logo;
			$list['facebook_link']       =$row->facebook_link;
			$list['youtube_link']        =$row->youtube_link;
			$list['google_link']         =$row->google_link;
			$list['twitter_link']        =$row->twitter_link;
			$list['linkedin_link']       =$row->linkedin_link;
			$list['lat']       			=$row->lat;
			$list['long']       =$row->long;
		}

		return $list;
	}

	function insert_to_db($data){
		
		//$data = $this->global_mod->db_parse($data);
        $local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->trans_begin();
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_local_admin', $data);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
			return true;
		}

	}

	function region(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$query=$this->db->query("SELECT 
										* 
								 from 
								 		app_local_admin 
								 where 
								 		local_admin_id='".$local_admin_id."'");

		if ($query->num_rows() > 0){
		    $row = $query->row();
		    $business_state_id=$row->business_state_id;
			$local_admin_country_id = $row->country_id ;
		}


		$region='<select name="region" id="region" onChange="st(this.value)" class="required" style="width:38%;">
		<option value="" >select</option>';


		$sql=$this->db->query("SELECT 
									* 
							   from 
							   		app_regions 
							   where 
							   		country_id='".$local_admin_country_id."' AND is_actives='Y'");

		foreach ($sql->result() as $row){
			$region_name=$row->region_name;
			$region_id=$row->region_id;

			if($region_id==$business_state_id){
				$region_id_selected="selected";
			}else{
				$region_id_selected="";
			}
			$region.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";

		}

		$region.='</select>';
		return $region;
	}

        function city(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$query=$this->db->query("SELECT 
										* 
									from 
										app_local_admin 
									where 
										local_admin_id='".$local_admin_id."'");
		
		if ($query->num_rows() > 0){
		    $row = $query->row();
			$business_city_id		= $row->business_city_id;
			$local_admin_country_id = $row->country_id;
			$region_id				= $row->region_id;
		}


		$city=  '<select name="city" id="city" class="required" style="width:38%;">
				<option value="" >select</option>';

		$sql=$this->db->query("SELECT 
									* 
								from 
									app_cities 
								where 
									country_id='".$local_admin_country_id."' and region_id='".$region_id."' and is_active_s='Y'");

		foreach ($sql->result() as $row){
			$city_name=$row->city_name;
			$city_id=$row->city_id;

			if($city_id==$business_city_id){
				$city_id_selected="selected";
			}else{
				$city_id_selected="";
			}
			$city.="<option value=".$city_id." ".$city_id_selected.">".$city_name."</option>";

		}

		$city.='</select>';
		return $city;
	}

	function city_ajax($region_id){
		$str = '';
		$a=$this->db->query("SELECT * from app_cities where region_id='$region_id' and is_active_s='Y'");
		$str .='<option value="">select</option>';
		foreach ($a->result() as $row){
			$city_id=$row->city_id;
			$city_name=$row->city_name;
			$str .='<option value="'.$city_id.'" >'.$city_name.'</option>';
		}
		return $str;
	}

    public function remove_the_pic(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        /*****      QUERY TO GET BUSINESS LOGO STARTS       *****/
        $this->db->select('business_logo');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        $logo = $Arr[0]['business_logo'];
        unlink("uploads/businesslogo/".$logo);
        /*****      QUERY TO GET BUSINESS LOGO ENDS     *****/
        $data = array('business_logo' => '');
        $this->db->trans_begin();
        $this->db->where('local_admin_id',$local_admin_id);
        $this->db->update('app_local_admin',$this->db->escape($data));
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return 1;
        }
    }
    
    public function country(){
    	$local_admin_id = $this->session->userdata('local_admin_id');
		$str  = '';
		$str .=  '<select name="counter" id="counter" class="required" style="width:38%;" onchange="selectstates(this.value)">';
		$str .=  '<option value="" >select</option>';
		
		$sql = $this->db->query("SELECT country_id FROM app_local_admin WHERE local_admin_id='".$local_admin_id."'");
		foreach ($sql->result() as $row){
			$countryId = $row->country_id;
			
		}
		
		$a=$this->db->query("SELECT 
									* 
								from 
									app_countries 
								where 
									is_active='Y' 
									Order By 
									country_order ASC");
		foreach ($a->result() as $row){
			
			if($countryId == $row->country_id){
				$selected = 'selected=""';
			}else{
				$selected = '';
			}
			
			$str .='<option value="'.$row->country_id.'" '.$selected.' >'.$row->country_name.'</option>';
		}
		
		$str .= '';
		return $str;
	}
    
    public function ajax_country_check($countryId){
		$country ='<option value="" >select</option>';


		$sql=$this->db->query("SELECT 
										* 
							   from 
							   			app_regions 
							   where 
							   			country_id='".$countryId."'");

		foreach ($sql->result() as $row){
			$region_name=$row->region_name;
			$region_id=$row->region_id;
			$country.="<option value=".$region_id.">".$this->global_mod->show_to_control($region_name)."</option>";

		}
		return $country;
	}
    
    
    
    
    
    
}
?>