<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class webinfo_manager_model extends CI_Model
{
	public function GetAllFAQ()
	{
		$this->db->select('*');
		$this->db->from('app_webinfo');
		$query = $this->db->get();
		$FAQArr = $query->result_array();
		
		return $FAQArr;
	}
	
	public function SaveFAQ()
	{
		$this->db->trans_begin();
		if($this->input->post('faq_id') == '')
		{
			$data = array(
                                        'name'      =>	trim($this->input->post('question')),
                                        'content'   =>	trim($this->input->post('answer')),
						 
				      );
			$data =$this->global_mod->db_parse($data);
			$this->db->insert('app_webinfo',$this->db->escape($data));
		}
		else
		{
			$data = array(
                                        'name'	      =>	trim($this->input->post('question')),
                                        'content'     =>	trim($this->input->post('answer')),

                                      );
			$data =$this->global_mod->db_parse($data);						  
			$this->db->where('id', $this->input->post('faq_id'));
			$this->db->update('app_webinfo',$this->db->escape($data));
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
		
		$FAQArr = $this->GetAllFAQ();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <thead><tr>
			<th align="left">Sl.No.</th>
			<th align="left">FAQ Question</th>
			<th align="left">FAQ Answer</th>
			
			<th align="center">Edit</th>
			<th align="center">Delete</th>
		  </tr></thead>';
		if(count($FAQArr) > 0)
		{
			
			$sl_no = 1;
			foreach($FAQArr as $key=>$row)
			{
				
				/*
				if($row['is_active'] == 'Y') {
					//$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
					$status = '<span id="replace_status_'.$row["faq_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
				} else {
					//$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
					$status = '<span id="replace_status_'.$row["faq_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
				}*/
				$f_ques = $row['name'];
                                $val = str_replace("&nbsp;",'',strip_tags($row['content']));
                                $f_ans = (strlen($val)>20) ? substr($val,0,20).'...' : $val;
				$html .= '<tr>
					<td align="left">'.$sl_no.'</td>
					<td align="left">'.$f_ques.'</td>
					<td align="left">'.$f_ans.'</td>										
					<td align="center"><a href="javascript:void(0);" onclick="edit_faq(\''.$row['id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_faq(\''.$row['id'].'\');">
                    <img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
                    </a></td>
				  </tr>';
				  $sl_no++;
			}
		}
		else
		{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table><div id="status"></div><div id="paginate"></div>';
		
		echo $html;
	}
	
	public function DelFAQ()
	{
		$this->db->where('id', $this->input->post('faq_id'));
		$this->db->delete('app_webinfo'); 
		
		$FAQArr = $this->GetAllFAQ();
		
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
		  <thead><tr>
			<th align="left">Sl.No.</th>
			<th align="left">FAQ Question</th>
			<th align="left">FAQ Answer</th>			
			<th align="center">Edit</th>
			<th align="center">Delete</th>
		  </tr></thead>';
		if(count($FAQArr) > 0)
		{
			foreach($FAQArr as $key=>$row)
			{
				$sl_no = $key+1;
				
				/*if($row['is_active'] == 'Y') {
					//$status = '<img src="'.base_url().'images/tick.png" alt="Active" title="Active" />';
					$status = '<span id="replace_status_'.$row["faq_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
				} else {
					//$status = '<img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" />';
					$status = '<span id="replace_status_'.$row["faq_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
				}*/
				$f_ques = $row['name'];
                                $val = str_replace("&nbsp;",'',strip_tags($row['content']));
                                $f_ans = (strlen($val)>20) ? substr($val,0,20).'...' : $val;
				$html .= '<tr>
					<td align="left">'.$sl_no.'</td>
					<td align="left">'.$f_ques.'</td>
					<td align="left">'.$f_ans.'</td>
					
					<td align="center"><a href="javascript:void(0);" onclick="edit_faq(\''.$row['id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_faq(\''.$row['id'].'\');">
                    <img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />
                    </a></td>
				  </tr>';
			}
		}
		else
		{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table><div id="status"></div><div id="paginate"></div>';
		echo $html;
	}
	/*
	public function ChangeStatusFAQ()
	{
		$this->db->select('is_active');
		$this->db->from('app_faq');
		$this->db->where('faq_id', $this->input->post('faq_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		
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
		$this->db->where('faq_id', $this->input->post('faq_id'));
		$this->db->update('app_faq',$this->db->escape($data));
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
	public function EditFAQ()
	{
		$this->db->select('*');
		$this->db->from('app_webinfo');
		$this->db->where('id', $this->input->post('faq_id'));
		$query = $this->db->get();
		$FAQArr = $query->result_array();
                
		//echo '<pre>';print_r($FAQArr);exit;
		foreach($FAQArr as $row)
		{
			$FAQArr['id'] 	= $row['id'];
			$FAQArr['name'] = $row['name'];
                        $FAQArr['content'] = $row['content'];
			
		}
		
		echo json_encode($FAQArr);
	}
         
         
}
?>