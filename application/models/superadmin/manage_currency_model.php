<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  manage_currency_model extends CI_Model
{
	public function GetAllcurrency(){
		$this->db->select('*');
		$this->db->from('app_currency');
		$this->db->where('is_active', 'Y');
		$query = $this->db->get();
		$RetArr = $query->result_array();

		$this->db->select('item_val');
		$this->db->from('app_superadmin_gen_setting');
		$this->db->where('item_name', 'currency_id');
		$query = $this->db->get();
		$selectArr = $query->result_array();
		$selected_val = $selectArr[0]['item_val'];

		$html = '';
		$html.= '<select class="design">';
		foreach($RetArr as $key => $valu){
			if($valu['currency_id'] == $selected_val){
				$html.='<option value="'.$valu['currency_id'].'" selected="selected">'.$valu['currency_name'].'</option>';
			} else {
				$html.='<option value="'.$valu['currency_id'].'">'.$valu['currency_name'].'</option>';
			}
		}
		$html.= '</select>';
		return $html;
	}
	public function Save(){
		//echo $this->input->post('text');
		$data = array( 'item_val' => $this->input->post('text'));
		$data =$this->global_mod->db_parse($data);
        $this->db->where('id',1);
        $this->db->update('app_superadmin_gen_setting',$this->db->escape($data));
        $msg = "Updated successfully.";
        $this->session->set_flashdata('status_massage', $msg);
	}
}
?>