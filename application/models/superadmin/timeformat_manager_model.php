<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class timeformat_manager_model extends CI_Model
{
	public function GetAllTIMEFORMAT()
	{
		$this->db->select('*');
		$this->db->from('app_time_format');
                $this->db->order_by('time_format_id','desc');
		$query = $this->db->get();
		$TIMEFORMATArr = $query->result_array();

		$html = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="" bgcolor="#95989A" >
		  <tr bgcolor="#95989A">
			<th align="center">Sl.No.</th>
			<th align="center">Time Format</th>
			<th align="center">Status</th>
			<!--<th align="center">Edit</th>
			<th align="center">Delete</th>-->
		  </tr>';
		if(count($TIMEFORMATArr) > 0)
		{
			$sl_no = 1;
                        $i = 0;
			foreach($TIMEFORMATArr as $key=>$row)
			{
			    //print_r($row);exit;

                                $bg_color = ($i%2 == 0) ? "#FFFFFF" :"#EFF1F2" ;
				if($row['is_active'] == 'Y') {
					$status = '<span id="replace_status_'.$row["time_format_id"].'"><img src="'.base_url().'myjs/images/true.gif" alt="Active" title="Active" /></span>';
				} else {
					$status = '<span id="replace_status_'.$row["time_format_id"].'"><img src="'.base_url().'myjs/images/false.gif" alt="Inactive" title="Inactive" /></span>';
				}
				$html .= '<tr bgcolor="'.$bg_color.'">
					<td align="center">'.$sl_no.'</td>
					<td align="center">'.$row['time_format'].'</td>
					<td align="center">
					<a href="javascript:void(0);" onclick="change_status(\''.$row["time_format_id"].'\');">'.$status.'</a>
					</td>
					<!--<td align="center"><a href="javascript:void(0);" onclick="edit_timeformat(\''.$row['time_format_id'].'\');">
                    <img src="'.base_url().'images/edit.png" alt="Edit" title="Edit" />
                    </a></td>
                    <td align="center"><a href="javascript:void(0);" onclick="del_timeformat(\''.$row['time_format_id'].'\');">
                    <img src="'.base_url().'images/trash-delete.gif" alt="Delete" title="Delete" />-->
                    </a></td>
				  </tr>';
				  $sl_no++;
                                  $i++;
			}
		}
		else
		{
			$html .= '<tr><td colspan="4" align="center">No Records Found</td></tr>';
		}
		$html .= '</table>';

		return $html;
	}


	public function SaveTIMEFORMAT()
	{
		$this->db->trans_begin();
		if($this->input->post('time_format_id') == '')
		{
			$data = array(
                                        'time_format'     => trim($this->input->post('time_format')),
                                        'is_active'	    =>	'Y'
                                        );
			$data =$this->global_mod->db_parse($data);
			$this->db->insert('app_time_format',$this->db->escape($data));
		}
		else
		{
			$data = array(
			            'time_format'	=>	trim($this->input->post('time_format'))
				 );
			$data =$this->global_mod->db_parse($data);
			$this->db->where('time_format_id', $this->input->post('time_format_id'));
			$this->db->update('app_time_format',$this->db->escape($data));
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

	public function DelTIMEFORMAT()
	{

		$this->db->where('time_format_id', $this->input->post('time_format_id'));
		$this->db->delete('app_time_format');
	}

	public function ChangeStatusTIMEFORMAT()
	{

		$this->db->select('is_active');
		$this->db->from('app_time_format');
		$this->db->where('time_format_id', $this->input->post('time_format_id'));
		$query = $this->db->get();
		$StatusArr = $query->result_array();
		//echo '<pre>';print_r($StatusArr);exit;

		if($StatusArr[0]['is_active'] == 'Y')
		{
			$data = array('is_active' => 'N');
			$ret = '<img src="'.base_url().'myjs/images/false.gif" alt="Inctive" title="Inctive" />';
		}
		else
		{
			$data = array('is_active' => 'Y');
			$ret = '<img src="'.base_url().'myjs/images/true.gif" alt="Active" title="Active" />';
		}
		$data =$this->global_mod->db_parse($data);
		$this->db->trans_begin();
		$this->db->where('time_format_id', $this->input->post('time_format_id'));
		$this->db->update('app_time_format',$this->db->escape($data));
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

	public function EditTIMEFORMAT()
	{
		$this->db->select('*');
		$this->db->from('app_time_format');
		$this->db->where('time_format_id', $this->input->post('time_format_id'));
		$query = $this->db->get();
		$TIMEFORMATArr = $query->result_array();

		foreach($TIMEFORMATArr as $row)
		{
		    //echo "<pre>";print_r($row);exit;
			$TIMEFORMATArr['time_format_id']     = $row['time_format_id'];
			$TIMEFORMATArr['time_format']       = $row['time_format'];
			//$TAXArr['status'] 	     = $row['status'];

		}

		echo json_encode($TIMEFORMATArr);

	}
	/**/

}
?>