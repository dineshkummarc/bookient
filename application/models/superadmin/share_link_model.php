<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class share_link_model extends CI_Model
{
	function select_from_db()
	{
		$this->load->database();
		$list=array();
		$this->db->select('*');
		$this->db->from('app_superadmin_share_link');
		$sql = $this->db->get();
		$row= $sql->row();
		
		if ($sql->num_rows() > 0)
		{
				$list['superadmin_facebook']       =$row->superadmin_facebook;
				$list['superadmin_youtube']        =$row->superadmin_youtube;
				$list['superadmin_google']         =$row->superadmin_google;
				$list['superadmin_twitter']        =$row->superadmin_twitter;
				$list['superadmin_linkedin']       =$row->superadmin_linkedin;
		}
		else
		{
				$list['superadmin_facebook']       ="";
				$list['superadmin_youtube']        ="";
				$list['superadmin_google']         ="";
				$list['superadmin_twitter']        ="";
				$list['superadmin_linkedin']       ="";
		}
		return $list;
	}	
	
	function insert_to_db($data)
	{
            $this->load->database();
            $this->db->select('*');
            $this->db->from('app_superadmin_share_link');
            $sql = $this->db->get();
            $row= $sql->row();
            if ($sql->num_rows() > 0)
            {	
				$data =$this->global_mod->db_parse($data);				
                $this->db->trans_begin();
                $this->db->update('app_superadmin_share_link', $data); 

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
            else
            {
				$data =$this->global_mod->db_parse($data);
                $this->db->trans_begin();
                $this->db->insert('app_superadmin_share_link', $data); 

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
        }
}
?>