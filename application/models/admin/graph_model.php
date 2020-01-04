<?php 
//CB#SR#08-04-2013#PR#S
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Graph_model extends CI_Model
{
    public function GetPerformanceGraph(){
		$dateArr["start"]	= '2013-07-01';
		$dateArr["end"]		= '2013-07-31';
		$string		="";
		$string = 'AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$dateArr["start"].'" AS date) AND CAST("'.$dateArr["end"].'" AS date) ';
		$returnArr	=	$this->global_mod->mainBookingStorePro($string);
        /*$date_to = date("Y-m-d H:i:s");
        $date_from = date("Y-m-d H:i:s",strtotime('-30 days',strtotime($date_to)));*/
        $date_from = "2013-03-01";
        $date_to = "2015-01-01";
        $query = $this->db->query("SELECT ser.*,book.* FROM app_booking_service_details as ser,app_booking as book WHERE DATE_FORMAT(ser.srvDtls_service_start,'%Y-%m-%d') >= '".$date_from."' AND DATE_FORMAT(ser.srvDtls_service_end,'%Y-%m-%d') <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.srvDtls_booking_id = book.booking_id");
        $rows = $query->num_rows();
         
        //echo '<pre>';print_r($query->result());echo '</pre>';//exit;
        if($rows > 0){
            foreach($query->result() as $key=>$NewArray){
                $ResultArray[$key]['booking_service_id'] = $NewArray->srvDtls_service_id;
                $ResultArray[$key]['booking_status'] = $NewArray->srvDtls_booking_status;
                $ResultArray[$key]['service_name'] = $NewArray->srvDtls_service_name;
                $ResultArray[$key]['service_duration'] = $NewArray->srvDtls_service_duration;
                $ResultArray[$key]['service_duration_unit'] = $NewArray->srvDtls_service_duration_unit;
                $ResultArray[$key]['booking_id'] = $NewArray->srvDtls_booking_id;

                $staff = $this->db->query("SELECT employee_name FROM app_employee WHERE employee_id = ".$NewArray->srvDtls_employee_id);
                if(count($staff->result()) > 0){
                    foreach($staff->result() as $Staff){
                        $ResultArray[$key]['staff'] = $Staff->employee_name;
                    }
                }else{
                    $ResultArray[$key]['staff'] =  'N/A';
                }
                /*$ResultArray[$key]['booking_date'] = date('d M, Y',strtotime($NewArray->booking_date_time));
                $ResultArray[$key]['booking_date_row'] = date('D, d M, Y',strtotime($NewArray->booking_date_time));*/
                $ResultArray[$key]['booking_date'] = date('d M, Y',strtotime($NewArray->srvDtls_service_start));
                $ResultArray[$key]['booking_date_row'] = date('D, d M, Y',strtotime($NewArray->srvDtls_service_start));
                $ResultArray[$key]['data_added'] = date('D, d M, Y',strtotime($NewArray->data_added));  
            }
            return $ResultArray;
        }
    }
    public function GetAppointmentGraph(){
        $date_from = "2013-03-01";
        $date_to = "2015-05-01";
        echo "SELECT ser.*,book.* FROM app_booking_service as ser,app_booking as book WHERE DATE_FORMAT(ser.service_start_dt,'%Y-%m-%d') >= '".$date_from."' AND DATE_FORMAT(ser.service_end_dt,'%Y-%m-%d') <= '".$date_to."' and book.local_admin_id = ".$this->session->userdata('local_admin_id')." and ser.booking_id = book.booking_id and ser.status = 1";
        $query = $this->db->query("SELECT count( * ) , ser.service_start_dt
                                        FROM app_booking_service AS ser, app_booking AS book
                                        WHERE DATE_FORMAT( ser.service_start_dt, '%Y-%m-%d' ) >= '2013-04-01'
                                        AND DATE_FORMAT( ser.service_end_dt, '%Y-%m-%d' ) <= '2013-04-30'
                                        AND ser.local_admin_id = '6'
                                        AND ser.booking_id = book.booking_id
                                        GROUP BY ser.service_start_dt");
        $rows = $query->num_rows();
    }
    public function getStaff(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('employee_id,employee_name');
        $this->db->from('app_employee');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('is_active', 'Y');
        $this->db->order_by("employee_name", "asc"); 
        $query = $this->db->get();
        $ResStaffRecord = $query->result_array();
        if(count($ResStaffRecord) > 0)
            return $ResStaffRecord;
        else
            return array();
    }
    public function getService(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('service_id,service_name');
        $this->db->from('app_service');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('is_active', 'Y');
        $this->db->order_by("service_name", "asc"); 
        $query = $this->db->get();
        $ResServiceRecord = $query->result_array();
        if(count($ResServiceRecord) > 0)
            return $ResServiceRecord;
        else
            return array();
    }
}
//CB#SR#08-04-2013#PR#E
?>