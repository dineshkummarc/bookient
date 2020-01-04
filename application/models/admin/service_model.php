<?php

class Service_model extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}
	public function get_service_details(){//	GET THE LIST OF EXISTING CATEGORY FROM DATABASE
		$this->db->select('*');
		$this->db->order_by("service_name", "asc");
		$this->db->where('is_active','Y');
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
		$query = $this->db->get('app_service');

		return $query->result_array();
	}
	public function get_category(){//	GET THE LIST OF EXISTING CATEGORY FROM DATABASE
		$this->db->order_by("category_name", "asc");
		$this->db->where('is_active','Y');
		$this->db->where('local_admin_id',$this->session->userdata('local_admin_id'));
		$query = $this->db->get('service_category');

		return $query->result_array();
	}
	public function set_service(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$err = 0;

                // <editor-fold>
		$this->load->database();
		$this->db->trans_begin();
		$var=trim($this->input->post('service_cost'));
		$service_cost = isset($var) ? trim($this->input->post('service_cost')) : 0;
		$no_cost = isset($var) ? "Y" : "N";
                // </editor-fold>

		if(trim($this->input->post('service_duration_unit')) == "M")
		{
			$service_duration_min = trim($this->input->post('service_duration'));
		}
		elseif(trim($this->input->post('service_duration_unit')) == "H")
		{
			$service_duration_min = trim($this->input->post('service_duration')) * 60;
		}

		//$cat_name = isset($this->input->post('cat_name'))?$this->input->post('cat_name'):$this->input->post('category');
		if(trim($this->input->post('cat_name')) != "")//	WHEN NEW CATEGORY IS ADDED
		{
			$data = array(
				'category_name' => trim($this->input->post('cat_name')),
				'local_admin_id' => $local_admin_id,
				'is_active' => 'Y',
				'date_added' => date('Y-m-d')
			);
			
			$data = $this->global_mod->db_parse($data);
			$insert_category = $this->db->insert('service_category', $data);
			$inserted_id = $this->db->insert_id();//	TO GET INSERTED ID

            
			$data = array(
				'category_id' => $inserted_id,
				'local_admin_id' => $this->session->userdata('local_admin_id'),
				'service_name' => trim($this->global_mod->db_parse($this->input->post('service_name'))),
				'service_cost' => $service_cost,
				'no_cost' => $no_cost,
				'service_duration' => trim($this->input->post('service_duration')),
				'service_duration_unit' => trim($this->input->post('service_duration_unit')),
				'service_duration_min' => $service_duration_min,
				'service_capacity' => trim($this->input->post('service_capacity')),
				'service_description' => trim($this->global_mod->db_parse($this->input->post('service_description'))),
				'service_tags' => trim($this->global_mod->db_parse($this->input->post('service_tags'))),
				'is_active' => 'Y',
				'date_added' => date('Y-m-d'),
				'date_edited' => date('Y-m-d')
			);
		}
		else//	WHEN A CATEGORY IS CHOOSEN FROM DROP DOWN
		{
          // header('Content-Type: text/html; charset=ISO-8859-15');
          // mb_internal_encoding('ISO-8859-15');
			$service_name = $this->global_mod->db_parse($this->input->post('service_name'));  
			$data = array(
				'category_id' => trim($this->input->post('category')),
				'local_admin_id' => $this->session->userdata('local_admin_id'),
				'service_name' => $service_name,
				'service_cost' => $service_cost,
				'no_cost' => $no_cost,
				'service_duration' => trim($this->input->post('service_duration')),
				'service_duration_unit' => trim($this->input->post('service_duration_unit')),
				'service_duration_min' => $service_duration_min,
				'service_capacity' => trim($this->input->post('service_capacity')),
				'service_description' => trim($this->global_mod->db_parse($this->input->post('service_description'))),
				'service_tags' => trim($this->global_mod->db_parse($this->input->post('service_tags'))),
				'is_active' => 'Y',
				'date_added' => date('Y-m-d'),
				'date_edited' => date('Y-m-d')
			);
		}
		if($this->input->post('service_update_id') == '')
		{
			$this->db->insert('app_service', $this->db->escape($data));
		}
		else
		{
			$this->db->where('service_id', $this->input->post('service_update_id'));
			$this->db->update('app_service', $this->db->escape($data));
		}
		$this->db->last_query();
		if ($this->db->trans_status() === FALSE)
		{
			$err = 1;
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}
		echo $err;
	}
	public function get_service(){
		$this->db->select('service_category.category_name,service.service_name,service.service_cost,service.service_capacity,service.service_duration,service.service_duration_unit,service.service_description,service.is_active,service.is_hide,service.service_id');
		$this->db->from('service');
		$this->db->join('service_category', 'service_category.category_id = service.category_id');
		$this->db->where('service.local_admin_id',$this->session->userdata('local_admin_id'));
		$this->db->order_by("service_category.category_name", "asc");

		$query = $this->db->get();
		return $query->result_array();
	}
	public function change_service_status($status, $id){
		$data = array(
            'is_active' => $status
        );
		$this->db->where('service_id', $id);
		$this->db->update('service', $data);
	}
	public function delete_service($id){
		$this->db->delete('service', array('service_id' => $id));
	}
	public function edit_service($id){
		$this->db->select('service.service_id,service.service_name,service.service_cost,service.no_cost,service.service_duration,service.service_duration_unit,service.service_capacity,service.service_description,service.service_tags,service_category.category_name');
		$this->db->from('service');
		$this->db->join('service_category', 'service_category.category_id = service.category_id');
		$this->db->where('service.service_id', $id);

		$query = $this->db->get();
		return $query->result_array();
	}
	public function service_update($id){
		$this->db->trans_begin();
		if($this->input->post('service_cost') == 0)//	WHEN NO COST CHECKBOX IS CHECKED
		{
			$data = array(
						'service_name' => $this->input->post('service_name'),
						'service_cost' => '0',
						'no_cost' => 'Y',
						'service_duration' => $this->input->post('service_duration'),
						'service_duration_unit' => $this->input->post('service_duration_unit'),
						'service_capacity' => $this->input->post('service_capacity'),
						'service_description' => $this->input->post('service_description'),
						'service_tags' => $this->input->post('service_tags'),
						'date_edited' => date('Y-m-d')
				);
		}
		else//	WHEN NO COST CHECKBOX IS NOT CHECKED
		{
			$data = array(
						'service_name' => $this->input->post('service_name'),
						'service_cost' => $this->input->post('service_cost'),
						'service_duration' => $this->input->post('service_duration'),
						'service_duration_unit' => $this->input->post('service_duration_unit'),
						'service_capacity' => $this->input->post('service_capacity'),
						'service_description' => $this->input->post('service_description'),
						'service_tags' => $this->input->post('service_tags'),
						'date_edited' => date('Y-m-d')
				);
		}
		$this->db->where('service_id', $id);
		$this->db->update('service', $data);
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
	public function change_service_status_ajax($status,$id,$name){
		$return_text = array();
		$data = array(
               'is_active' => $status
            );
		$this->db->where('service_id', $id);
		$result = $this->db->update('service', $data);
		if($status == "Y")
		{
			$return_text['grid'] = "<span onclick='status_confirm(\"N\",\"$id\")' style='cursor:pointer'>".$this->lang->line('disable')."</span> &nbsp;";
			$return_text['row'] = $this->lang->line('ser_want')." ".$this->lang->line('disable_sml')." ".$name."?<br />
			<font color=\"#FF0000\"><b>".
			$this->lang->line('aftr_disable_text')." ".$name.".
			</b></font><br />
			<span class=\"change_status\" onclick='change_status(\"N\",\"$id\",\"$name\")' style=\"cursor:pointer\">".$this->lang->line('disable')."</span>
			&nbsp; &nbsp;
            <span onclick=\"hide_status($id)\" style=\"cursor:pointer\">".$this->lang->line('ser_cancel')."</span>
			</span>";
		}
		else
		{
			$return_text['grid'] = "<span onclick='status_confirm(\"Y\",\"$id\")' style='cursor:pointer'>".$this->lang->line('enable')."</span> &nbsp;";
			$return_text['row'] = $this->lang->line('ser_want')." ".$this->lang->line('ser_wantenable_sml')." ".$name."?<br />
			<font color=\"#FF0000\"><b>".
			$this->lang->line('aftr_enable')." ".$name." ".$this->lang->line('would_b_visible')
			."</b></font><br />
			<span class=\"change_status\" onclick='change_status(\"Y\",\"$id\",\"$name\")' style=\"cursor:pointer\">".$this->lang->line('enable')."</span>
			&nbsp; &nbsp;
            <span onclick=\"hide_status($id)\" style=\"cursor:pointer\">".$this->lang->line('ser_cancel')."</span>
			</span>";
		}
		return $return_text;
	}
	
	public function change_service_hide_ajax($status,$id,$name){
		$return_text = array();
		$data = array(
               'is_hide' => $status
            );
		$this->db->where('service_id', $id);
		$result = $this->db->update('service', $data);
		if($status == "Y")
		{
			$return_text['grid'] = "<span onclick='hide_confirm(\"N\",\"$id\")' style='cursor:pointer'>".$this->lang->line('unhide')."</span> &nbsp;";
			$return_text['row'] = $this->lang->line('ser_want')." ".$this->lang->line('disable_sml')." ".$name."?<br />
			<font color=\"#FF0000\"><b>".
			$this->lang->line('aftr_disable_text')." ".$name.".
			</b></font><br />
			<span class=\"change_hide\" onclick='change_hide(\"N\",\"$id\",\"$name\")' style=\"cursor:pointer\">".$this->lang->line('unhide')."</span>
			&nbsp; &nbsp;
            <span onclick=\"hide_hide_field($id)\" style=\"cursor:pointer\">".$this->lang->line('ser_cancel')."</span>
			</span>";
		}
		else
		{
			$return_text['grid'] = "<span onclick='hide_confirm(\"Y\",\"$id\")' style='cursor:pointer'>".$this->lang->line('hide')."</span> &nbsp;";
			$return_text['row'] = $this->lang->line('ser_want')." ".$this->lang->line('ser_wantenable_sml')." ".$name."?<br />
			<font color=\"#FF0000\"><b>".
			$this->lang->line('aftr_enable')." ".$name." ".$this->lang->line('would_b_visible')
			."</b></font><br />
			<span class=\"change_hide\" onclick='change_hide(\"Y\",\"$id\",\"$name\")' style=\"cursor:pointer\">".$this->lang->line('hide')."</span>
			&nbsp; &nbsp;
            <span onclick=\"hide_hide_field($id)\" style=\"cursor:pointer\">".$this->lang->line('ser_cancel')."</span>
			</span>";
		}
		return $return_text;
	}
	public function ajax_delete($id){
        $this->db->delete('app_biz_hours', array('service_id' => $id));
        $this->db->delete('app_booking_service_details', array('srvDtls_service_id' => $id));
		$result = $this->db->delete('service', array('service_id' => $id));
		return 1;
	}
	public function GetServiceDetails(){
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('service_id', $this->input->post('service_id'));
		$query = $this->db->get();
		$ServiceArray = $query->result_array();

		$service_id = $ServiceArray[0]['service_id'];
		$category_id = $ServiceArray[0]['category_id'];
		$service_name = $ServiceArray[0]['service_name'];
		$service_cost = $ServiceArray[0]['service_cost'];
		$no_cost = $ServiceArray[0]['no_cost'];
		$service_duration = $ServiceArray[0]['service_duration'];
		$service_duration_unit = $ServiceArray[0]['service_duration_unit'];
		$service_duration_min = $ServiceArray[0]['service_duration_min'];
		$service_capacity = $ServiceArray[0]['service_capacity'];
		$service_description = $ServiceArray[0]['service_description'];
		$service_tags = $ServiceArray[0]['service_tags'];

		$returnArr = array();
		$returnArr['service_id'] = $service_id;
		$returnArr['category_id'] = $category_id;
		$returnArr['service_name'] = $service_name;
		$returnArr['service_cost'] = $service_cost;
		$returnArr['no_cost'] = $no_cost;
		$returnArr['service_duration'] = $service_duration;
		$returnArr['service_duration_unit'] = $service_duration_unit;
		$returnArr['service_capacity'] = $service_capacity;
		$returnArr['service_description'] = $service_description;
		$returnArr['service_tags'] = $service_tags;

		//echo json_encode($returnArr);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION   #######################
        $return_ser = serialize($returnArr);
        $value = mb_check_encoding($return_ser, 'UTF-8') ? $return_ser : utf8_encode($return_ser);
        $value = preg_replace( '!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $value );
        $value = preg_replace( '/;n;/', ';N;', $value );
        $new_return = unserialize($value); 
        echo json_encode($new_return);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION    #######################
	}
}
?>