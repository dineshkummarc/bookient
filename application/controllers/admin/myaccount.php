<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Myaccount extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/myaccount_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id)
			  {
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_myaccount',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_myaccount',$setLanguage);
			$this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
		
		
	}
	public function index($success =''){   
		//$this->lang->load('admin_myaccount');
		
		
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		$data=$this->myaccount_model->select_from_db();
		$currency           = $this->myaccount_model->currency();
		$data['currency']        =$currency;
		$data['profession']      =$this->myaccount_model->profession();
		$currency_format         =$this->myaccount_model->currency();
		$data['currency_format'] =$this->myaccount_model->currency_format();
		$data['time_zone']       =$this->myaccount_model->time_Zone();
		$data['date_format']     =$this->myaccount_model->date_format();
		$data['time_format']     =$this->myaccount_model->time_format();
		$data['country']         =$this->myaccount_model->country();
		$data['city']            =$this->myaccount_model->city();
		$data['region']          =$this->myaccount_model->region();
		if($success !='')
		{
			$success = $this->lang->line('update_success');		
		}
		else{
			$success='';
		}
		$data['success'] = $success;
		$this->load->view('admin/myaccount/myaccount',$data);
		
		$currency              =isset($_REQUEST['currency_id'])?$_REQUEST['currency_id']:'';
		$currencyformat        =isset($_REQUEST['currency_format_id'])?$_REQUEST['currency_format_id']:1;
		$time_Zone             =isset($_REQUEST['time_zone_id'])?$_REQUEST['time_zone_id']:'';
		$time_format           =isset($_REQUEST['time_format_id'])?$_REQUEST['time_format_id']:'';
		$date_format           =isset($_REQUEST['date_format_id'])?$_REQUEST['date_format_id']:'';
		$country               =isset($_REQUEST['country_id'])?$_REQUEST['country_id']:'';
		// We are not going to change this anyway, so why bother...
		$profession            =isset($_REQUEST['profession_id'])?$_REQUEST['profession_id']:'';
		$city                  =isset($_REQUEST['city_id'])?$_REQUEST['city_id']:'';
		$region                =isset($_REQUEST['region_id'])?$_REQUEST['region_id']:'';
		$firstname             =isset($_REQUEST['first_name'])?$_REQUEST['first_name']:'';
		$lastname              =isset($_REQUEST['last_name'])?$_REQUEST['last_name']:'';
		$homephone             =isset($_REQUEST['home_phone2'])?$_REQUEST['home_phone2']:'';
		$workphone             =isset($_REQUEST['work_phone2'])?$_REQUEST['work_phone2']:'';
		$mobilephone           =isset($_REQUEST['mobile_phone2'])?$_REQUEST['mobile_phone2']:'';
		
		if($currency!='' && $currencyformat!='' && $time_Zone!='' && $time_format!='' && $date_format!='' && $country!='' && $profession!='' && $city!='' && $firstname!='' && $lastname!='' )
		{
			
			$data = array(
				'currency_id'        => trim($currency) ,
				'currency_format_id' => trim($currencyformat),
				'time_zone_id'       => trim($time_Zone),
				'time_format_id'     => trim($time_format),
				'date_format_id'     => trim($date_format),
				// We are not going to change this anyway, so why bother...
				//'profession_id'      => trim($profession),
				'country_id'         => trim($country),
				'city_id'            => trim($city),
				'region_id'          => trim($region),
				'first_name'         => trim($firstname),
				'last_name'          => trim($lastname),
				'home_phone'         => trim($homephone),
				'work_phone'         => trim($workphone),
				'mobile_phone'       => trim($mobilephone),
			);
			
			
		   $this->myaccount_model->insert_to_db($data);
		   redirect('/admin/myaccount/index/success');
	    }	
		//$this->load->view('myaccount/myaccount',$list);
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	function change_email(){
		$this->load->database();
			if(!empty($_REQUEST['name'])){
				$name= $_REQUEST['name'];
				$rtn = '';
				$rtn .='<td style=" width:88%;"><input type="text" style=" width:88%;" id="emailbox" value="'.$this->global_mod->show_to_control($name).'"></td><td><a href="javascript: save();" class="save-icon"></a></td><td><a href="javascript: cancel();" class="cancel-icon"></a></td>';
				echo $rtn;	
			}
	}
	function change_password(){
	$this->load->database();
	
		
		$rtn = '';
		$rtn .='<table>
					<tr>
						<td colspan="2">
							<a class="close-ic" href="javascript: cancel_change();"></a>
						</td>
					</tr>
					<tr>
						<td>
							<label>'.$this->lang->line('old').'</label>
						</td>
						<td>
							<input type="password" id="old" style=" width:88%" onfocus="hide_err_or(this.id)" />
						</td>
						<td>
							<div id="error_old" style="color:#FF0000"></div>
						</td>
					</tr>
					<tr>
						<td>
							<label>'.$this->lang->line('new').'</label>
						</td>
						<td>
							<input type="password" id="new"  style=" width:88%" onfocus="hide_err_or(this.id)"/>
						</td>
						<td>
							<div id="error_new" style="color:#FF0000"></div>
						</td>
					</tr>
					<tr>
						<td>
							<label>'.$this->lang->line('confirm').'</label>
						</td>
						<td>
							<input type="password" id="confirm"  style=" width:88%" onfocus="hide_err_or(this.id)"/>
						</td>
						<td>
							<div id="error_confirm" style="color:#FF0000"></div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="button" onclick="confirm_password()"  value="'.$this->lang->line('confirm_btn').'" class="btn-blue" /></td>
					</tr>
				</table>';
	echo $rtn;	
	}
	function save_email(){
		$this->load->database();
		if(!empty($_REQUEST['email']))
		{
			$email= $_REQUEST['email'];
			$this->db->trans_begin();
			$local_admin_id = $this->session->userdata('local_admin_id');
			$this->db->where('user_id',$local_admin_id);
			$this->db->where('user_type',3);
			//$this->db->where('local_admin_id',$local_admin_id);
			$data = array('user_email' => $email );
			$this->db->update('app_password_manager', $data);
			//$local_admin_id=1;
			/*$sql=$this->db->query("SELECT * from local_admin_email where local_admin_id='".$local_admin_id."'");
			foreach ($sql->result() as $row)
			{
			 $local_admin_email=$row->local_admin_email;
			} 
			echo $local_admin_email;*/
			//echo $this->db->last_query();

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo 0;
			}
			else
			{
				$this->db->trans_commit();
				echo $email;
			} 		
		}
	}
	function save_password(){
		$this->load->database();
		
		if(!empty($_REQUEST['old']))
		{
			$oldpassword= $_REQUEST['old'];
			$newpassword= $this->global_mod->db_parse($_REQUEST['new']);
			$local_admin_password = "";
			$local_admin_id = $this->session->userdata('local_admin_id');
			$sql=$this->db->query("SELECT * from app_password_manager  where user_id='".$local_admin_id."'");
			foreach ($sql->result() as $row)
			{
			 	$local_admin_password=$row->password;
			}
			if($local_admin_password==$oldpassword)
			{
				$this->db->trans_begin();
				$this->db->where('user_id',$local_admin_id);
				$this->db->where('user_type',3);
				$data = array('password' =>$newpassword);
				$this->db->update('app_password_manager ', $data);
				if ($this->db->trans_status() === FALSE)
				{
					echo '0';
					$this->db->trans_rollback();
				}
				else
				{
					$this->db->trans_commit();
					echo '1';
				} 		
			}
			else
			{
				echo 0;	
			}
		}
	}
	function ajax_check(){


		$this->load->database();
		$country_id=isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$str=$this->myaccount_model->ajax_check($country_id);
		echo $str;
		
     }
	function ajax_region_check(){


		$this->load->database();
		$region_id=isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$str=$this->myaccount_model->ajax_region_check($region_id);
		echo $str;
     }
}
