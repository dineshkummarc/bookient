<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_mkt_manager_model extends CI_Model
{
	public function GetAllCategory()
	{
		$this->db->select('*');
		$this->db->from('app_eml_mrktn_templt');
	
		$query = $this->db->get();
		$CategoryArr = $query->result_array();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		 <thead><tr>
			<th align="left">Sl.No.</th>
			<th align="left">Category Name</th>					
			
			<th align="center">Edit</th>
			<!--<th align="center">Delete</th>-->
		  </tr></thead>';
		if(count($CategoryArr) > 0)
		{
			$sl_no = 1;				
			foreach($CategoryArr as $key=>$row)
			{   
			    //print_r($row);exit;
				
				
							
				$html .= '<tr>
					<td align="left">'.$sl_no.'</td>
					<td align="left">'.$row['tmplt_name'].'</td>					
					<td align="center"><a href="javascript:void(0);" onclick="edit_timezone(\''.$row['eml_mrktn_templt_id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_timezone(\''.$row['eml_mrktn_templt_id'].'\');">
                    <!--<img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
                    </a></td>-->
				  </tr>';
				  $sl_no++;
			}
		}
		else
		{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table><div id="status"></div><div id="paginate"></div>';
		
		return $html;
	}
	

	public function SaveTIMEZONE()
	{
		$this->db->trans_begin();
		if($this->input->post('eml_mrktn_templt_id') == '')
		{
			$data = array(
						  'eml_mrktn_templt_cat_id' => $this->input->post('cat_type'),
						  'tmplt_name'	=>	$this->input->post('tmplt_name'),						 			  
						  'tmplt_header_content' => $this->input->post('headcont'),
						  'tmplt_header_bgcolor' => '#'.$this->input->post('head_bg_color'),
						   'tmplt_body_content' => $this->input->post('bodycont'),
						  'tmplt_body_bgcolor' => '#'.$this->input->post('body_bg_color'),
						     'tmplt_footer_content' => $this->input->post('footcont'),
						  'tmplt_footer_bgcolor' => '#'.$this->input->post('foot_bg_color')
						  );
			$data =$this->global_mod->db_parse($data);
			$this->db->insert('app_eml_mrktn_templt',$this->db->escape($data));
		}
		else
		{
			$data = array(
						  'eml_mrktn_templt_cat_id' => $this->input->post('cat_type'),
						  'tmplt_name'	=>	$this->input->post('tmplt_name'),						 			  
						  'tmplt_header_content' => $this->input->post('headcont'),
						 
						   'tmplt_body_content' => $this->input->post('bodycont'),
						  
						     'tmplt_footer_content' => $this->input->post('footcont')
						 
						  );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('eml_mrktn_templt_id', $this->input->post('eml_mrktn_templt_id'));
			$this->db->update('app_eml_mrktn_templt',$this->db->escape($data));
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
		
		
		
		
	}
	
	function category($region_id='')
	{
	$this->load->database();	
	if($region_id !='')
	{
		
		
			$query=$this->db->query("SELECT  eml_mrktn_templt_cat_id from app_eml_mrktn_templt where eml_mrktn_templt_id='".$region_id."'");
			$row1 = $query->row();		
			$country_name_id=$row1->eml_mrktn_templt_cat_id;
			
	}
	else
	{
		$country_name_id='';
	}
		//}
		
		$country='<option value="" >----Select Category---</option>';
		$this->load->database();
		$sql=$this->db->query("SELECT * from app_eml_mrktn_templt_cat");
		foreach ($sql->result() as $row)
		{
		   $country_name=$row->cat_name;
		   $country_id=$row->eml_mrktn_templt_cat_id;
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
		
		$country.='';	
		return $country;		
	}
	
	
	/*
	public function DelTIMEZONE()
	{
		$this->db->where('time_zone_id', $this->input->post('time_zone_id'));
		$this->db->delete('app_time_zone'); 
	}
	
	public function ChangeStatusTIMEZONE()
	{
	    //print($this->input->post('city_id'));exit; 
		$this->db->select('is_active');
		$this->db->from('app_time_zone');
		$this->db->where('time_zone_id', $this->input->post('time_zone_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		
		//echo "<pre>";print_r($StatusArr);exit; 
		if($StatusArr[0]['is_active'] == 'Y')
		{
			$data = array('is_active' => 'N');
			$ret = '<img src="'.base_url().'images/close.png" alt="Inctive" title="Inctive" />';
		}
		else
		{
			$data = array('is_active' => 'Y');
			$ret = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
		}
		
		$this->db->trans_begin();
		$this->db->where('time_zone_id', $this->input->post('time_zone_id'));
		$this->db->update('app_time_zone',$this->db->escape($data));
		$this->db->last_query();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo 0;
		}
		else
		{
			$this->db->trans_commit();
			echo $ret;
		}
	}
	*/
	public function EditTIMEZONE()
	{
		$cate = $this->category($this->input->post('cat_zone_id'));
		
		
		$this->db->select('*');
		$this->db->from('app_eml_mrktn_templt');
		$this->db->where('eml_mrktn_templt_id', $this->input->post('cat_zone_id'));
		$query = $this->db->get();
		$TIMEZONEArr = $query->result_array();
		
		foreach($TIMEZONEArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$TIMEZONEArr['eml_mrktn_templt_id']     = $row['eml_mrktn_templt_id'];			
			$TIMEZONEArr['tmplt_name']  = $row['tmplt_name'];					
			$TIMEZONEArr['tmplt_header_content'] 	= $row['tmplt_header_content'];
			$TIMEZONEArr['tmplt_header_bgcolor'] 	= $row['tmplt_header_bgcolor'];
			
			$TIMEZONEArr['tmplt_body_content'] 	= $row['tmplt_body_content'];
			$TIMEZONEArr['tmplt_footer_content'] 	= $row['tmplt_footer_content'];
			
			
		}		
		$TIMEZONEArr['slect_val'] 	= $cate;
		//echo '<pre>';print_r($TIMEZONEArr);exit;
		echo json_encode($TIMEZONEArr);
		
	}
	

}
?>