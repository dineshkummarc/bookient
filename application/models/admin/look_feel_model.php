<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Look_feel_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this -> calender_colors = FALSE;
	}
	
	function showHeader()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('frontend_header');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->frontend_header;
		}
		return '1';
	}
	
	function showLayout()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('layout');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row();	
			$layout = $row->layout;
		
		
		}
		else
		{
			$layout = 'L';
			
		}
		return $layout;
	}
	
	function selectHeader($value)
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		'frontend_header' => $value,
		);
		$this->db->trans_begin();
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_local_admin_gen_setting', $data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			return $value;
		} 
	}
	
	function selectLayout($value)
	{
			
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		'layout' => $value,
		);
		$this->db->trans_begin();
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_local_admin_gen_setting', $data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			return $value;
		} 
		
	}
		
	function showTheme()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('theme');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row();	
			$theme = $row->theme;
		
		
		}
		else
		{
			$theme = 'CS1';
			
		}
		return $theme;
	}	
	function selectTheme($value)
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		$data = array(
		'theme' => $value,
		);
		$this->db->trans_begin();
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_local_admin_gen_setting', $data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			return $value;
		} 
	}
	
	public function saveThemeData($insert_list)
	{
		$this->load->database();
		$local_admin_id=$this->session->userdata('local_admin_id');
	/*	$insert_list['local_admin_id']=$this->session->userdata('local_admin_id');
		$insert_list['date_added']=date('Y-m-d');
		$insert_list['date_edited']=date('Y-m-d');*/
		
		$this->db->trans_begin();
		$this->db->where('theme_name','CCS');
		$this->db->where('local_admin_id',$local_admin_id);
		$this->db->update('app_custom_color_scheme',$this->db->escape($insert_list));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		} 
	}
	
	public function saveCalendarData($insert_list)
	{
		$this->load->database();
		$local_admin_id=$this->session->userdata('local_admin_id');
		
		$r = $this->db->query('SELECT `local_admin_id` FROM `app_custom_calender_colors` WHERE `local_admin_id` = ?', array($local_admin_id));
		
		if ($r -> num_rows)
		{
			$sql = $this->db->update_string('app_custom_calender_colors', $insert_list, 'local_admin_id = ' . $local_admin_id);
		}
		else
		{
			$insert_list -> local_admin_id = $local_admin_id;
			$sql = $this->db->insert_string('app_custom_calender_colors', $insert_list);
		}
		$this->db->query($sql);
	}
	
	public function resetCalendarData()
	{
		$this->load->database();
		$local_admin_id = $this->session->userdata('local_admin_id');
		
		$r = $this->db->query('SELECT `local_admin_id` FROM `app_custom_calender_colors` WHERE `local_admin_id` = ?', array($local_admin_id));
		
		if ($r -> num_rows)
		{
			$this->db->delete('app_custom_calender_colors', array('local_admin_id' => $local_admin_id));			
		}
		else
		{
			return; //No row in database -- already default
		}
	}
	
	function showCalendarTheme()
	{
		if ($this -> calender_colors === FALSE)
		{
			$local_admin_id = $this->session->userdata('local_admin_id');
			$ResultArr=array();
			$this->db->select('*');
			$this->db->from('app_custom_calender_colors');
			$this->db->where('local_admin_id', $local_admin_id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				$ResultArr['approved_color']	= $row->approved_color;
				$ResultArr['pending_color']		= $row->pending_color;
				$ResultArr['scheduled_color']	= $row->scheduled_color;
				$ResultArr['late_color']		= $row->late_color;
				$ResultArr['noshow_color']		= $row->noshow_color;
				$ResultArr['unknown_color']		= $row->unknown_color;
				//Gradient Lower
				$ResultArr['approved_color_L']	= $row->approved_color_L;
				$ResultArr['pending_color_L']	= $row->pending_color_L;
				$ResultArr['scheduled_color_L']	= $row->scheduled_color_L;
				$ResultArr['late_color_L']		= $row->late_color_L;
				$ResultArr['noshow_color_L']	= $row->noshow_color_L;
				$ResultArr['unknown_color_L']	= $row->unknown_color_L;
			}
			else
			{
				$ResultArr['approved_color']	= 'AB47ED';
				$ResultArr['pending_color']		= '0099FF';
				$ResultArr['scheduled_color']	= 'FF66FF';
				$ResultArr['late_color']		= '966C43';
				$ResultArr['noshow_color']		= 'FFFF99';
				$ResultArr['unknown_color']		= '19FF19';
				//Gradient Lower
				$ResultArr['approved_color_L']	= 'B65EEF';
				$ResultArr['pending_color_L']	= '66C2FF';
				$ResultArr['scheduled_color_L']	= 'FF9FFF';
				$ResultArr['late_color_L']		= 'AD855C';
				$ResultArr['noshow_color_L']	= 'FFFFAD';
				$ResultArr['unknown_color_L']	= '8CFF8C';
			}
			
			$this -> calender_colors = $ResultArr;
		}
		return $this -> calender_colors;
	}
	
	function showCustomTheme()
	{
		$local_admin_id = $this->session->userdata('local_admin_id');
		$ResultArr=array();
		$this->db->select('*');
		$this->db->from('app_custom_color_scheme');
		$this->db->where('theme_name','CCS');
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			$ResultArr['background_color']			= $row->background_color;
			$ResultArr['staffServicePanel_color']	= $row->staffServicePanel_color;
			$ResultArr['staffToolTip_color']		= $row->staffToolTip_color;
			$ResultArr['serviceTooltip_color']		= $row->serviceTooltip_color;
			$ResultArr['tabBG_color']				= $row->tabBG_color;
			$ResultArr['activTabBG_color']			= $row->activTabBG_color;
			$ResultArr['tabContentBGColor_color']	= $row->tabContentBGColor_color;
			$ResultArr['tabHeaderBGColor_color']	= $row->tabHeaderBGColor_color;
			$ResultArr['weekCalBGColor_color']		= $row->weekCalBGColor_color;
			$ResultArr['weekCalfont_color']			= $row->weekCalfont_color;
			$ResultArr['btnBGColor_color']			= $row->btnBGColor_color;
			$ResultArr['btnAcountBGColor_color']	= $row->btnAcountBGColor_color;
		}
		else
		{
			$ResultArr['background_color']			= '';
			$ResultArr['staffServicePanel_color']	= '';
			$ResultArr['staffToolTip_color']		= '';
			$ResultArr['serviceTooltip_color']		= '';
			$ResultArr['tabBG_color']				= '';
			$ResultArr['activTabBG_color']			= '';
			$ResultArr['tabContentBGColor_color']	= '';
			$ResultArr['tabHeaderBGColor_color']	= '';
			$ResultArr['weekCalBGColor_color']		= '';
			$ResultArr['weekCalfont_color']			= '';
			$ResultArr['btnBGColor_color']			= '';
			$ResultArr['btnAcountBGColor_color']	= '';
		}
		return $ResultArr;
	}	
	
}
?>


