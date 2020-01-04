<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Business_hour extends Pardco 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/business_hour_model');
        /*===================LogIn Security Check===================*/
       /* $logged_in_Status = $this->session->userdata('logged_in');
        $local_admin_id = $this->session->userdata('local_admin_id');
        $user_id_local_admin = $this->session->userdata('user_id_local_admin');
        if(!$logged_in_Status)
        {
            redirect(base_url().'admin/login');
        }
        else
        {
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
            $this->lang->load('admin_business_hour',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_business_hour',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
    }
    public function index()
    {
	
		
	
	//ECHO $this->business_hour_model->secToHour(5700);
        $data['staff'] = $this->business_hour_model->get_staff();
        //$data['service'] = $this->business_hour_model->get_service();
        $aaa = $this->business_hour_model->get_category();
        for($i=0;$i<count($aaa);$i++)
        {
            $x = $aaa[$i]['category_id'];
            $data['category'][$x]['name'] = $aaa[$i]['category_name'];
            $data['category'][$x]['child'] = $this->business_hour_model->get_serv($x);
        }

        $this->lang->load('admin_business_hour');
        $this->load->library('form_validation');
        $this->load->view('admin/header');

        $data['current_id']= '';
        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $this->load->view('admin/business_hour/business_hour', $data);//, $data

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
    /*###################palahs roy(comming from ajax)###############################*/
    public function index_ajax($current_id='')
    {
        $data['staff'] = $this->business_hour_model->get_staff();
        //$data['service'] = $this->business_hour_model->get_service();
        $aaa = $this->business_hour_model->get_category();
        for($i=0;$i<count($aaa);$i++)
        {
            $x = $aaa[$i]['category_id'];
            $data['category'][$x]['name'] = $aaa[$i]['category_name'];
            $data['category'][$x]['child'] = $this->business_hour_model->get_serv($x);
        }

        $this->lang->load('admin_business_hour');
        $this->load->library('form_validation');
        $this->load->view('admin/header');

        $data['current_id']= $current_id;
        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $this->load->view('admin/nevigation',$data);

        $this->load->view('admin/business_hour/business_hour', $data);//, $data

        $footer = $this->pardco_model->footer_link();
        $this->load->view('admin/footer',$footer);
    }
    /*###################palahs roy(comming from ajax)###############################*/
    public function add_biz_hour()
    {
        $jsondata = $this->input->post('jsondata');
        $timeArray = $this->input->post('timeArray');
        
        
        $bizHourAdd = $this->business_hour_model->biz_hour_add($jsondata,$timeArray);
        if($bizHourAdd)
        {
            echo $this->lang->line('update_success');
        }
    }
    public function show_biz_hour($employee_id)
    {
		$employee_name = $this->input->post('employee_name');
		//echo $time_difference	= $this->session->userdata('time_difference');
		
        echo $bizHourAdd = $this->business_hour_model->Employee_biz_hour_details($employee_id,$employee_name);
    }
   
    public function del_biz_hour()
    {
        $this->business_hour_model->DeleteBizHours();
    }
    public function del_emp_service()
    {
        $this->business_hour_model->DeleteEmpService();
    }
    public function fn_chlbizHrtime()
    {
        $endTime = $this->input->post('endTime');
        $startTime = $this->input->post('startTime');
        $jsondata = $this->input->post('jsondata');
        $arrayFormation = json_decode($jsondata, true);
        $ServiceIdsArray = $arrayFormation['service'];
        $staffIdsArray   = $arrayFormation['staff'];
        $daysIdsArray    = $arrayFormation['days'];
        $check = 0;
        foreach($ServiceIdsArray as $serviceId)
        {
            foreach($staffIdsArray as $staffId)
            {
                foreach($daysIdsArray as $daysId)
                {
                    /*echo "<br>SERVICE : ".$serviceId;
                    echo "<br>STAFF : ".$staffId;
                    echo "<br>DAY : ".$daysId;
                    echo "<br>START TIME : ".$startTime;
                    echo "<br>END TIME : ".$endTime;*/
                    $checkBizHour = $this->business_hour_model->checkBusinessHour($serviceId,$staffId,$daysId,$startTime,$endTime);
                    if($checkBizHour == 0){
                        $check++;
                    }
                }
            }
        }
        if($check == 0){
            echo 'done';
        }else{
            echo 'error';
        }
    }
    public function editBusinessHour()
    {
        $empId		= $this->input->post('empId');
        $bizHrId	= $this->input->post('bizHrId');
		$bizHrArr	= $this->business_hour_model->getBusinessHourDetails($bizHrId);
			
        $timeDiff = $this->global_mod->gmtDifference();
        
        $offset = substr($timeDiff,0,1);
        $timeval  = substr($timeDiff,1);
        $time_diff = $this->business_hour_model->secToHour($timeval);
        
        
        $fromArr = $this->business_hour_model->timeCalculation($bizHrArr[0]['time_from'],$time_diff,$offset,'');
        $from = date("H:i:s",strtotime($fromArr['returnTime']));
        
        if(count($bizHrArr) == 2)
        	$toArr = $this->business_hour_model->timeCalculation($bizHrArr[1]['time_to'],$time_diff,$offset,'');
        else
        	$toArr = $this->business_hour_model->timeCalculation($bizHrArr[0]['time_to'],$time_diff,$offset,'');	
        
        $toTime = $toArr['returnTime'];
        $to = date("H:i:s",strtotime($toTime)+1);
        //$to = date("H:i:s",strtotime($toTime));
        
      //  echo $from.'<br>';
      //  echo $to;
       // exit;
        
        
        $str='';
        $str.='<table>';
        $str.='<tr>';
        $str.='<th colspan="10" align="center"><div id="biz_hr_pop_update"></div></th>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<th colspan="10" align="center">:: '.$bizHrArr[0]['employee_name'].' '.$this->global_mod->db_parse($this->lang->line("reschedule_time_for")).' '.$bizHrArr[0]['service_name'].' ::</th>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td>';
        $str.=$this->global_mod->db_parse($this->lang->line("busi_time_from"));
        $str.='</td>';
        $str.='<td>';
        $str.='&nbsp;:&nbsp;';
        $str.='</td>';
        $str.='<td>';
        $str.='<input type="text" id="timepickerFrom_update" value="'.$from.'" class="text-input-bizhours pickTime"/>';
        $str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td>';
        $str.=$this->global_mod->db_parse($this->lang->line("busi_time_to"));
        $str.='</td>';
        $str.='<td>';
        $str.='&nbsp;:&nbsp;';
        $str.='</td>';
        $str.='<td>';
        $str.='<input type="text" id="timepickerTo_update" value="'.$to.'" class="text-input-bizhours pickTime"/>';
        $str.='<input type="hidden" id="bizHrId" value="'.$bizHrId.'"/>';
        $str.='<input type="hidden" id="empId" value="'.$empId.'"/>';
        $str.='<input type="hidden" id="day_id" value="'.$bizHrArr[0]['day_id'].'"/>';
        $str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="10" align="center"><button class="btn-blue" id="update_btn_biz_hour">'.$this->global_mod->db_parse($this->lang->line("busi_update")).'</button></td>';
        $str.='</tr>';
        $str.='</table>';

        echo $str;
    }
    public function editBusinessHourUpdate(){
		$startTime	= $this->input->post('startTime');
	    $endTime	= $this->input->post('endTime');
		$empId		= $this->input->post('empId');
        $bizHrId	= $this->input->post('bizHrId');
        $day_id		= $this->input->post('day_id');
        
        $bizHrAvl = $this->business_hour_model->checkBizHrAvil($startTime,$endTime,$bizHrId);
        if($bizHrAvl == 'done'){
            echo $this->business_hour_model->updateBizHrTime($startTime,$endTime,$bizHrId,$empId,$day_id);			
        }else{
            echo 'Time range already exists.@|^_^|@error';
        }
    }
}
?>