<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class loginmethod_manager_model extends CI_Model
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
                              $this->db->from('app_logins');
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

                      $query = $this->db->get('app_logins');

                      return $query->result();
                  }

                      //get catalog details by catalog_id
                  function get_CatalogArr($login_typ_id)
                  {
                      $query = $this->db->get_where('app_logins', array('login_typ_id' => $login_typ_id));
                      return $query->row();
                  }

                      //get catalog details by catalog_id
                  function get_CatalogByUrl($catalog_url)
                  {
                      $query = $this->db->get_where('app_logins', array('catelog_url' => $catalog_url));
                      return $query->row();
                  }

                      //save catalog details
                      function saveCatalogDetails($data){
					  $data =$this->global_mod->db_parse($data);
                              $this->db->where('login_typ_id', $data['login_typ_id']);
                              $msgreport = $this->db->update('app_logins', $data);

                              if($msgreport == 1)
                                      $msg = 4;
                              else
                                      $msg = 3;

                              return $msg;
                      }

                      function addCatalogDetails($data){
                              $this->db->select_max('login_order');
                              $query = $this->db->get('app_logins');
                              $order = $query->row_array();
                              $data['login_order'] = $order['login_order']+1;
							$data =$this->global_mod->db_parse($data);
                              $msgreport = $this->db->insert('app_logins', $data);

                              if($msgreport == 1)
                                      $msg = 2;
                              else
                                      $msg = 1;
                              return $msg;
                      }

                      function deleteCatalog($id){
                              $this->db->where('login_typ_id', $id);
                              $a = $this->db->delete('app_logins');
                              if($a == 1)
                                      $result = 6;
                              else
                                      $result = 5;
                              return $result;
                      }

                        public function EditLOGINMETHOD()
                        {
                                $this->db->select('*');
                                $this->db->from('app_logins');
                                $this->db->where('login_typ_id', $this->input->post('login_typ_id'));
                                $query = $this->db->get();
                                $LOGINMETHODArr = $query->result_array();
                                foreach($LOGINMETHODArr as $row)
                                {
                                        $LOGINMETHODArr['login_typ_id']          = $row['login_typ_id'];
                                        $LOGINMETHODArr['login_name']            = $row['login_name'];
                                        $LOGINMETHODArr['login_identifier']      = $row['login_identifier'];
                                }
                                echo json_encode($LOGINMETHODArr);
                        }

                        public function SaveLOGINMETHOD()
                        {
                                $this->db->trans_begin();
                                 $msgreport;
                                 $msg;
                                if($this->input->post('login_typ_id') == '')
                                {
                                        $this->db->select_max('login_order');
                                        $query = $this->db->get('app_logins');
                                        $order = $query->row_array();
                                        $new_order = $order['login_order']+1;
                                        $data = array(
                                                        'login_name'	     => trim($this->input->post('login_name')),
                                                        'login_identifier'   => trim($this->input->post('login_identifier')),
                                                        'status'	     =>	1,
                                                        'login_order'        =>  $new_order
                                                 );
										$data =$this->global_mod->db_parse($data);
                                        $msgreport = $this->db->insert('app_logins',$this->db->escape($data));
                                        if($msgreport == 1)
                                        $msg = 2;
                                        else
                                        $msg = 1;
                                }
                                else
                                {
                                        $data = array(
                                                        'login_name'	     => trim($this->input->post('login_name')),
                                                        'login_identifier'   => trim($this->input->post('login_identifier'))
                                                );
												$data =$this->global_mod->db_parse($data);
                                        $this->db->where('login_typ_id', $this->input->post('login_typ_id'));
                                        $msgreport = $this->db->update('app_logins',$this->db->escape($data));
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

                        public function ChangeStatusLOGINMETHOD($id)
                        {

                                $this->db->select('status');
                                $this->db->from('app_logins');
                                $this->db->where('login_typ_id', $id);
                                $query = $this->db->get();
                                $StatusArr = $query->result_array();
                                if($StatusArr[0]['status'] == 1)
                                {
                                        $data = array('status' => 0);

                                }
                                else
                                {
                                        $data = array('status' => 1);

                                }
								$data =$this->global_mod->db_parse($data);
                                $this->db->trans_begin();
                                $this->db->where('login_typ_id', $id);
                                $this->db->update('app_logins',$this->db->escape($data));
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




	}
?>