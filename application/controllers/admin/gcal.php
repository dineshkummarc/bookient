<?php
class Gcal extends Pardco
{
	function __construct(){
	parent::__construct();
	/*===================LogIn Security Check===================*/
	 /* $logged_in_Status = $this->session->userdata('logged_in');
	  $local_admin_id = $this->session->userdata('local_admin_id');
	  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
	  if(!$logged_in_Status){
		  redirect(base_url().'admin/login');
	  }else{
		  if($user_id_local_admin != $local_admin_id){
			  $this->session->sess_destroy();
			  redirect(base_url());
		  }
	  }*/
	  $this->global_mod->checkSession();
	/*===================LogIn Security Check===================*/
	Zend_Loader::loadClass('Zend_Gdata_Calendar');
	Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
	$this->load->model('admin/gcal_model');
	}

	public function index(){
	
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_gcal',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_gcal',$setLanguage);
        }
		/*########End Language#######*/
	
	
		$this->load->view('admin/header');
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		$this->load->view('admin/gcal/gcal', $data);
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}

	public function listCalender(){
		$email				= $this->input->post('gcalEmail');
		$pass				= $this->input->post('gcalPassword');
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($email,$pass, $service);
		$service = new Zend_Gdata_Calendar($client);

		echo "<h1>".$this->lang->line('cal_evn_list_using_query')." </h1>";
		$startDate='2013-09-18';
		$endDate='2013-09-19';
		$query = $service->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		$query->setStartMin($startDate);
		$query->setStartMax($endDate);
		$eventFeed = $service->getCalendarEventFeed($query);
		echo "<ol>";
		foreach ($eventFeed as $event) {
		echo "<li>" . $event->title->text;
		echo "<ul>";
		echo "<li>".$this->lang->line('details').": " .  $event->where[0]->valueString . "</li>";
		echo "<li>".$this->lang->line('details').": " .  $event->content->text . "</li>";
		foreach ($event->when as $when) {
		  echo "<li>".$this->lang->line('start').": " . $when->startTime . "</li>";
		  echo "<li>".$this->lang->line('end').": " . $when->endTime . "</li>";  
		}
		echo "</ul>";
		echo "</li>";
		}
		echo "</ol>";
	}

	public function addCalender(){
		$startDate			= $this->input->post('gcalStartDate').' 00:00:00';
		$endDate			= $this->input->post('gcalEndDate').' 23:59:59';
		$dateArr['start']	= date('Y-m-d H:i:s', strtotime($startDate));
		$dateArr['end']		= date('Y-m-d H:i:s', strtotime($endDate));
		$bookingArr			= $this->gcal_model->getSelectedBooking($dateArr);
		$email				= $this->input->post('gcalEmail');
		$pass				= $this->input->post('gcalPassword');

	foreach($bookingArr AS $bookingVal){
		$title = $bookingVal['srvDtls_service_name'];
		$desc= 'Booking date'.$bookingVal['booking_date_time'].'& Service name '.$bookingVal['srvDtls_service_name'].'& Employee name'.$bookingVal['srvDtls_employee_name'].'& Description'.$bookingVal['srvDtls_service_description']; 
		$where = $this->gcal_model->getBookingLocation($this->session->userdata('local_admin_id'));
		$startDate	= date('Y-m-d', strtotime($bookingVal['srvDtls_service_start']));  
		$startTime	= date('H:i', strtotime($bookingVal['srvDtls_service_start'])); 
		$endDate	= date('Y-m-d', strtotime($bookingVal['srvDtls_service_end']));
		$endTime	= date('H:i', strtotime($bookingVal['srvDtls_service_end'])); 
		$tzOffset	= trim($this->session->userdata('time_difference_gcal'));
ob_start(); $f = fopen('/tmp/debug.bugiend', 'a');
echo '$bookingVal[\'srvDtls_service_start\'] = '; var_dump($bookingVal['srvDtls_service_start']);
echo '$startDate = '; var_dump($startDate);
echo '$startTime = '; var_dump($startTime);
echo 'strtotime($bookingVal[\'srvDtls_service_start\']) = '; var_dump(strtotime($bookingVal['srvDtls_service_start']));
echo '$this->session->userdata(\'time_difference_gcal\') = '; var_dump($this->session->userdata('time_difference_gcal'));
echo '$tzOffset = '; var_dump($tzOffset);
fputs($f, ob_get_contents());
fclose($f); ob_end_clean();
	
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($email, $pass, $service);
		$gdataCal = new Zend_Gdata_Calendar($client);
		$newEvent = $gdataCal->newEventEntry();
		$newEvent->title = $gdataCal->newTitle($title);
		$newEvent->where = array($gdataCal->newWhere($where));
		$newEvent->content = $gdataCal->newContent($desc);
		$when = $gdataCal->newWhen();
		$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}";
		$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}";
		$newEvent->when = array($when);
		$createdEvent = $gdataCal->insertEvent($newEvent);
		$return = $createdEvent->id->text;
		}
	}
}
?>
