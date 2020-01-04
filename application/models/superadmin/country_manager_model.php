<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class country_manager_model extends CI_Model
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
		$this->db->from('countries');
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

        $query = $this->db->get('countries');

        return $query->result();
    }

	//get catalog details by catalog_id
    function get_CatalogArr($country_id)
    {
        $query = $this->db->get_where('countries', array('country_id' => country_id));
        return $query->row();
    }

	//get catalog details by catalog_id
    function get_CatalogByUrl($catalog_url)
    {
        $query = $this->db->get_where('countries', array('catelog_url' => $catalog_url));
        return $query->row();
    }

	//save catalog details
	function saveCatalogDetails($data){
		$data =$this->global_mod->db_parse($data);
		$this->db->where('country_id', $data['country_id']);
		$msgreport = $this->db->update('countries', $data);

		if($msgreport == 1)
			$msg = 4;
		else
			$msg = 3;

		return $msg;
	}

	function addCatalogDetails($data){
		$this->db->select_max('country_order');
		$query = $this->db->get('countries');
		$order = $query->row_array();
		$data['country_order'] = $order['country_order']+1;
		$data =$this->global_mod->db_parse($data);
		$msgreport = $this->db->insert('countries', $data);

		if($msgreport == 1)
			$msg = 2;
		else
			$msg = 1;
		return $msg;
	}

	function deleteCatalog($id){
		$this->db->where('country_id', $id);
		$a = $this->db->delete('countries');

		if($a == 1)
			$result = 6;
		else
			$result = 5;
		return $result;
	}
        public function EditCOUNTRY()
	{
		$this->db->select('*');
		$this->db->from('app_countries');
		$this->db->where('country_id', $this->input->post('country_id'));
		$query = $this->db->get();
		$COUNTRYArr = $query->result_array();

		foreach($COUNTRYArr as $row)
		{
			$COUNTRYArr['country_id']    		   = $row['country_id'];
			$COUNTRYArr['country_name']  		   = $row['country_name'];
			$COUNTRYArr['is_active']     		   = $row['is_active'];
			$COUNTRYArr['country_code']     	   = $row['country_code'];
			$COUNTRYArr['country_dial_prefix']     = $row['country_dial_prefix'];
		}

		echo json_encode($COUNTRYArr);
		
	}

        public function get_cou_name()
        {
            
            $result=0;
            $dial_return = 0;
            
        ////////////////////  Duplicate Country Name check /////////////////////    
            
            $this->db->select('country_id');
            $this->db->from('app_countries');
            $this->db->where('country_name', $_POST['countryname']);
            $query = $this->db->get();
            $num = $query->num_rows();
            $Ret_Arr_val = $query->result_array();
            
      ////////////////////   Duplicate Country Name check  ///////////////////////     
      ///////////////////	 Duplicate Dial prefix check   //////////////////////
       
            $this->db->select('country_id,country_dial_prefix');
            $this->db->from('app_countries');
            $this->db->where('country_dial_prefix', $_POST['dial_prefix']);
            $query = $this->db->get();
            $num_rows = $query->num_rows();
            $Ret_Arr = $query->result_array();
           
    
    /////////////////////	Duplicate Dial prefix check End  //////////////////////      
    /////////////////////	Duplicate Country Code check   //////////////////////   
            $this->db->select('country_id,country_code');
            $this->db->from('app_countries');
            $this->db->where('country_code', $_POST['country_code']);
            $query = $this->db->get();
            $code_rows = $query->num_rows();
            $Ret_code = $query->result_array();
            
     /////////////////////	Duplicate Country Code check End   //////////////////////        
            
            if($_POST['country_id'] == '')
            {
                if($num == 0){
                    $result = 1;
                } else {
                    $result = 0;
                }
                
	            if($num_rows == 0){
	                $dial_return = 1;
	            } else {
	                $dial_return = 0;
	            }
	           
	            $code_return = $code_rows == 0 ? 1 : 0;
                
                
            }
            else {
                if($num == 0){
                    $result = 1;
                }
                else
                {
                    if($_POST['country_id'] == $Ret_Arr_val[0]['country_id'] )
                    {
                     $result = 1;
                    } else {
                     $result = 0;
                    }
                }
                
                if($num_rows == 0){
                    $dial_return = 1;
                }  
                else{
                	if($_POST['country_id'] == $Ret_Arr[0]['country_id'])
                    {
                     $dial_return = 1;
                    } else {
                     $dial_return = 0;
                    }
					
				}  
				
				if($code_rows == 0){
                    $code_return = 1;
                }  
                else{
                	if($_POST['country_id'] == $Ret_code[0]['country_id'])
                    {
                     $code_return = 1;
                    } else {
                     $code_return = 0;
                    }
					
				} 
				
				
            }
	    echo $result.'_'.$dial_return.'_'.$code_return;
             //echo '<pre>';print_r($Ret_Arr_val[0]);exit;
        }

        public function SaveCOUNTRY()
		{
			$this->db->trans_begin();
	                $msgreport;
	                $msg;
			if($this->input->post('country_id') == '')
			{

	                        $this->db->select_max('country_order');
	                        $query = $this->db->get('countries');
	                        $order = $query->row_array();
	                        $new_order = $order['country_order']+1;
				$data = array(
							  'country_name'		=>	trim($this->input->post('countryname')),		//<-
							  'is_active'			=>	'Y',
	                          'country_order'       =>  $new_order,
	                          'country_dial_prefix'	=>  trim($this->input->post('dial_prefix')),
	                          'country_code'		=>  trim($this->input->post('country_code'))
					     );
				$data =$this->global_mod->db_parse($data);
				$msgreport = $this->db->insert('app_countries',$this->db->escape($data));
	                        if($msgreport == 1)
				$msg = 2;
			        else
				$msg = 1;
			}
			else
			{
				$data = array(
				              'country_name'		=>	trim($this->input->post('countryname')),
				              'country_dial_prefix'	=>  trim($this->input->post('dial_prefix'))	//<-
							  );
				$this->db->where('country_id', $this->input->post('country_id'));
				$data =$this->global_mod->db_parse($data);
				$msgreport = $this->db->update('app_countries',$this->db->escape($data));
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