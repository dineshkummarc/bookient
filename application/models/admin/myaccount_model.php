<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Myaccount_model extends CI_Model{  
    function insert_to_db($data){             
	    $this->load->database();
	    $this->db->trans_begin();
	 //   $data = $this->global_mod->db_parse($data);
	    
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $this->db->where('local_admin_id',$local_admin_id);
	    $this->db->update('app_local_admin', $data); 
		
	    if ($this->db->trans_status() === FALSE)
	    {
		    $this->db->trans_rollback();
	    }
	    else
	    {
		    $this->db->trans_commit();
		    return true;
	    } 	
    }
	function ajax_check($country_id){
	if(!empty($country_id)){
		//$country_id= $_REQUEST['id'];
		$str = '';
		$b=$this->db->query("SELECT * from app_countries where country_id='$country_id'");
		foreach ($b->result() as $row1)
								{
								
								$country_dial_prefix=$row1->country_dial_prefix;
								
								}
		$a=$this->db->query("SELECT * from app_regions where country_id='$country_id'");
		$str .='<option value="" >select</option>';								 
									   foreach ($a->result() as $row)
								{
								 $region_id=$row->region_id;
									   //$country_code=$row->country_code;
									   $region_name=$row->region_name;
		
		$str .='<option value="'.$region_id.'" >'.$region_name.'</option>';
			 }		
		$str.='@@@'.$country_dial_prefix;
		return $str;
		}
		else
		{
		$str = '<option value="" >select</option>';
		return $str;
		}
	
	
	
	}
	function ajax_region_check($region_id){
	if(!empty($region_id)){
		//$region_id= $_REQUEST['id'];
		$str = '';
		$a=$this->db->query("SELECT * from app_cities where region_id='$region_id' and is_active_s='Y'");
		
		$str .='<option value="" >select</option>';	
		
									   foreach ($a->result() as $row)
								{
								 $city_id=$row->city_id;
									   //$country_code=$row->country_code;
									   $city_name=$row->city_name;
		
		$str .='<option value="'.$city_id.'" >'.$city_name.'</option>';
			 }		
		
		echo $str;
		}
		else
		{
		echo '<option value="" >select</option>';
		}
	
	
	
	
	}
	function select_from_db(){
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		$sqlUnPass=$this->db->query("SELECT * from app_password_manager where user_id='".$local_admin_id."'");
		$list=array();
		foreach ($sql->result() as $row)
		{   
			$list['currency_id']			=$row->currency_id;
			$list['currency_format_id']		=$row->currency_format_id;
			$list['profession_id']			=$row->profession_id;
			$list['time_zone_id']			=$row->time_zone_id;
			$list['time_format_id']			=$row->time_format_id;
			$list['date_format_id']			=$row->date_format_id;
			$list['country_id']				=$row->country_id;
			$list['region_id']				=$row->region_id;
			$list['city_id']				=$row->city_id;
			$list['first_name']				=$row->first_name;
			$list['last_name']				=$row->last_name;
			$list['home_phone']				=$row->home_phone;
			$list['work_phone']				=$row->work_phone;
			$list['mobile_phone']			=$row->mobile_phone;
		}
		$this->db->select('country_dial_prefix');
		$this->db->from('app_countries');
		$this->db->where('country_id', $list['country_id']	);
		$query = $this->db->get();
		
		$Ret_Arr_val = $query->result_array();
		
        //echo '<pre>';print_r($Ret_Arr_val[0]['country_dial_prefix']);exit;
		$list['local_admin_phn_code'] = $Ret_Arr_val[0]['country_dial_prefix'];
		
		foreach ($sqlUnPass->result() as $row2)
		{  
			$list['local_admin_username']	=$row2->user_name;
		    $list['local_admin_email']		=$row2->user_email;
		}
		//echo $list;
		return $list;
	}	 
    function profession(){
	$this->load->database();
	$local_admin_id = $this->session->userdata('local_admin_id');
	$sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
	foreach ($sql->result() as $row)
	{
	 		$profession_name_id=$row->profession_id;
	}
			$profession='<select name="profession_id" id="profession_id" class="text-input required">
						  <option value="" >select</option>';
						
			$this->load->database();
			$a=$this->db->query("SELECT * from app_profession where is_active='Y'");
								 
			foreach ($a->result() as $row)
				{
					
				  $profession_name=$row->profession_name;
				  $profession_id=$row->profession_id;
				  if($profession_id==$profession_name_id)
		{
			$profession_id_selected="selected";
		}
		else
		{
			$profession_id_selected="";
		}
				  $profession.="<option value=".$profession_id." ".$profession_id_selected.">".$profession_name."</option>";
							  
				}
						
			$profession.="</select>";
			return $profession;			

	}
    function country(){
	    
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		
	    foreach ($sql->result() as $row)
	    {
		    $country_name_id=$row->country_id;
	    }
	    
	   
	    
        $country='<select name="country_id" id="country_id" class="text-input required" onChange="st(this.value)">
		<option value="" >select</option>';
		
					
		$sql=$this->db->query("SELECT * from app_countries where is_active='Y' Order by country_name");
								 
		foreach ($sql->result() as $row)
		{
			$country_name=$row->country_name;
			$country_id=$row->country_id;
			if($country_id==$country_name_id)
		    {
			    $country_id_selected="selected";
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
	function region(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		
	    foreach ($sql->result() as $row)
	    {
		    $region_name_id	=$row->region_id;
		    $country_id		=$row->country_id;
	    }
        $region='<select name="region_id" id="region_id" class="text-input required" onChange="re(this.value)">
            <option value="">-Select Region-</option>';			
	    $this->load->database();
	    $sql=$this->db->query("SELECT * from app_regions where country_id='".$country_id."' and is_actives='Y'");		 
	    foreach ($sql->result() as $row)
	    {
	        $region_name=$row->region_name;
	        $region_id=$row->region_id;
	        if($region_id==$region_name_id)
	        {
		        $region_id_selected="selected";
	        }
	        else
	        {
		        $region_id_selected="";
	        }
	        $region.="<option value=".$region_id." ".$region_id_selected.">".$region_name."</option>";				 
	    }
						
	    $region.='</select>';	
	    return $region;		
	}	
	function city(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
		
	    foreach ($sql->result() as $row)
	    {
		    $city_name_id	= $row->city_id;
		    $country_id		= $row->country_id;
		    $region_id		= $row->region_id;
	    }
        $city='<select name="city_id" id="city_id" class="text-input required" >
            <option value="">-Select City-</option>';
		$this->load->database();
		$sql=$this->db->query("SELECT * from app_cities where country_id='".$country_id."' and region_id='".$region_id."' and is_active_s='Y'");				 
        foreach ($sql->result() as $row)
        {
            $city_name=$row->city_name;
            $city_id=$row->city_id;
            if($city_id==$city_name_id)
            {
                $city_id_selected="selected";
            }
            else
            {
                $city_id_selected="";
            }
            $city.="<option value=".$city_id." ".$city_id_selected.">".$city_name."</option>";	 
        }			
	    $city.='</select>';	
	    return $city;		
	}	
	public function currency(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
	    foreach ($sql->result() as $row)
	    {
		    $currency_name_id=$row->currency_id;
	    }
	    $currency='<select name="currency_id" id="currency_id" class="text-input required">
					<option value="" >select</option>';			
		$this->load->database();
		$a=$this->db->query("SELECT * from app_currency");		 
		foreach ($a->result() as $row){
            $currency_id=$row->currency_id;
            $currency_name=$row->currency_name;
            $currency_symbol=$row->currency_symbol;
            if($currency_id==$currency_name_id)
            {
                $currency_id_selected="selected";
            }
            else
            {
                $currency_id_selected="";
            }
            $currency.="<option value=". $row->currency_id." ".$currency_id_selected.">".
            $currency_name."(". $currency_symbol.")"."</option>";     
        }		
	    $currency.='</select>';	
	    return $currency;	
	}
    function currency_format(){
        $this->load->database();
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
        foreach ($sql->result() as $row){
            $currency_format_name_id=$row->currency_format_id;
        }
        $currency_format='<select name="currency_format_id" id="currency_format_id" class="text-input required">
            <option value="" >select</option>';			
        $this->load->database();	
        $a=$this->db->query("SELECT * from app_currency_format");					 
        foreach ($a->result() as $row)
        {
            $currency_format_id=$row->currency_format_id;
            $currency_format_name=$row->currency_format;
            if($currency_format_id==$currency_format_name_id)
            {
                $currency_format_id_selected="selected";
            }
            else
            {
                $currency_format_id_selected="";
            }
            $currency_format.="<option value=". $row->currency_format_id." ".$currency_format_id_selected.">".
            $currency_format_name."</option>";			       
        }	
        $currency_format.='</select>';	
        return $currency_format;	
    }
	function time_Zone(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
	    foreach ($sql->result() as $row)
	    {
		    $time_zone_name_id=$row->time_zone_id;
	    }
	    $time_zone='<select name="time_zone_id" id="time_zone_id" class="text-input required">
					<option value="">--Select Timezone--</option>';	
		$this->load->database();
		$a=$this->db->query("SELECT * FROM app_time_zone WHERE is_active = 'Y' ORDER BY time_zone_name");	 
		foreach ($a->result() as $row){
			$time_zone_id=$row->time_zone_id;
			$time_zone_name=$row->time_zone_name;
            $gmtSymbol = $row->gmt_symbol;
            $gmtValue = $row->gmt_value;
            $sign = ($gmtSymbol == 1)?"+":"-";
			if($time_zone_id==$time_zone_name_id){
                $time_zone_id_selected="selected";
            }else{
                $time_zone_id_selected="";
            }  
			$time_zone.="<option value=". $time_zone_id." ".$time_zone_id_selected.">".$time_zone_name." (GMT".$sign.$gmtValue.")</option>";      
		}	
		$time_zone.='</select>';	
		return $time_zone;	
	}
	function time_format(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
	    foreach ($sql->result() as $row)
	    {
		    $time_format_name_id=$row->time_format_id;
	    }
	    $time_format='<select name="time_format_id" id="time_format_id" class="text-input required">
					<option value="" >select</option>';
		$this->load->database();
		$a=$this->db->query("SELECT * from app_time_format where is_active='Y'");
		foreach ($a->result() as $row)
		{
			$time_format_id=$row->time_format_id;
			$time_format_name=$row->time_format;
			if($time_format_id==$time_format_name_id)
            {
                $time_format_id_selected="selected";
            }
            else
            {
                $time_format_id_selected="";
            }
			$time_format.="<option value=".$time_format_id." ".$time_format_id_selected.">".
			$time_format_name."</option>";			       
		}	
		$time_format.='</select>';	
		return $time_format;	
	}
	function date_format(){
	    $this->load->database();
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $sql=$this->db->query("SELECT * from app_local_admin where local_admin_id='".$local_admin_id."'");
	    foreach ($sql->result() as $row)
	    {
		    $date_format_name_id=$row->date_format_id;
	    }
	    $date_format='<select name="date_format_id" id="date_format_id" class="text-input required">
					    <option value="" >select</option>';
		$this->load->database();
		$a=$this->db->query("SELECT * from app_date_format where is_active='Y'");
		foreach ($a->result() as $row)
		{
			$date_format_id=$row->date_format_id;
			$date_format_name=$row->date_format;
			if($date_format_id==$date_format_name_id)
            {
                $date_format_id_selected="selected";
            }
            else
            {
                $date_format_id_selected="";
            }
			$date_format.="<option value=".$date_format_id." ". $date_format_id_selected.">".
			$date_format_name."</option>";			       
		}			
		$date_format.='</select>';	
		return $date_format;	
	}
}