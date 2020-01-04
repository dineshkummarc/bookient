<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
            $this->load->database();
    }
    public function getAllBooking()
    {
        $ResArr = "";	
        $local_admin_id = $this->session->userdata('local_admin_id');
        $Sql = "SELECT * FROM 
                ( 	
                        SELECT DISTINCT a.*, b.`employee_name`,d.`booking_date_time`,
                        CONCAT( 
                                ( 	SELECT v1.value
                                        FROM   app_local_customer_details v1 
                                        JOIN   app_local_clint_signup_info a1
                                        ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                                        WHERE   v1.customer_id =d.customer_id ORDER BY 1 LIMIT 1
                                ) 
                                ,' ',
                                (   SELECT v1.value
                                        FROM   app_local_customer_details v1 
                                        JOIN   app_local_clint_signup_info a1
                                        ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                                        WHERE  v1.customer_id =d.customer_id ORDER BY 1 LIMIT 1
                                ) 
                        ) AS cust_name,
                        (
                                SELECT v1.value
                                FROM   app_local_customer_details v1 
                                JOIN   app_local_clint_signup_info a1
                                ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_address'
                                WHERE   v1.customer_id =d.customer_id ORDER BY 1 LIMIT 1
                        ) AS cus_address,
                        (
                                SELECT v1.value
                                FROM   app_local_customer_details v1 
                                JOIN   app_local_clint_signup_info a1
                                ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_zip'
                                WHERE   v1.customer_id =d.customer_id ORDER BY 1 LIMIT 1
                        ) AS cus_zip,
                        (
                                SELECT v1.value
                                FROM   app_local_customer_details v1 
                                JOIN   app_local_clint_signup_info a1
                                ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_mob'
                                WHERE   v1.customer_id =d.customer_id ORDER BY 1 LIMIT 1
                        ) AS cus_mob
                        FROM (`app_booking_service_details` 		AS a, 
                                `app_employee`                  AS b, 
                                `app_local_customer_details` 	AS c,
                                `app_booking`                   AS d) 
                        WHERE  a.`employee_id` 		= b.`employee_id` 
                        AND    d.`customer_id`		= c.`customer_id`
                        AND    a.`booking_id`		= d.`booking_id`
                        AND    d.`local_admin_id` 	= '$local_admin_id'
                        AND    d.`booking_is_deleted`           = '0'
                ) AS maintable where 1=1 ";		
        $ServcBookingList = $this->db->query($Sql);
        if ($ServcBookingList->num_rows() > 0)
        {
                $ResArr = $ServcBookingList->result_array();
        }
        return $ResArr;
    }
    public function statusChangeAjax($status, $booking_service_id)
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array( 'booking_status' => $status,);
        $this->db->trans_begin();
        $this->db->where('local_admin_id',$local_admin_id);
        $this->db->where('booking_service_id',$booking_service_id);
        $this->db->update('app_booking_service_details', $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        $AffectedRows = $this->db->affected_rows();
        if($AffectedRows == 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function getSelectedBookingAjax($empvalArr="", $servicesArr="")
    {
            $local_admin_id = $this->session->userdata('local_admin_id');
            $TotEmpSelected = count($empvalArr);
            $TotSerSelected = count($servicesArr);
            $EmpCounter = 0;
            $SerCounter = 0;
            
            
            echo ">>>>".$TotSerSelected."<<<<<<<br /><br /><br /><br />";
            if(!is_array($empvalArr))
            {
                    $EmpSortStr = "";
            }
            else
            {
                    $EmpSortStr = " AND (";
                    foreach(is_array($empvalArr) && $empvalArr AS $empId)
                    {
                        $EmpCounter++;
                        if($EmpCounter == $TotEmpSelected)
                        {
                                $EmpSortStr .= " a.`employee_id` = '$empId' ";
                        }
                        else
                        {
                                $EmpSortStr .= " a.`employee_id` = '$empId' OR ";
                        }
                    }
                    $EmpSortStr .= " ) ";
            }
            if(!is_array($servicesArr))
            {
                    $SerSortStr = "";
            }
            else
            {
                    $SerSortStr = " AND (";
                    foreach($servicesArr AS $SerId)
                    {
                        $SerCounter++;
                        if($SerCounter == $TotSerSelected)
                        {
                                $SerSortStr .= " a.`service_id` = '$SerId' ";
                        }
                        else
                        {
                                $SerSortStr .= " a.`service_id` = '$SerId' OR ";
                        }
                    }
                    $SerSortStr .= " ) ";
            }
            $Sql = "SELECT * FROM 
                    ( 	
                        SELECT DISTINCT a.*, b.`employee_name`,
                        CONCAT( 
                                    (       SELECT v1.value
                                            FROM   app_local_customer_details v1 
                                            JOIN   app_local_clint_signup_info a1
                                            ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                                            WHERE   v1.customer_id =a.customer_id ORDER BY 1 LIMIT 1
                                    ), 
                                    ' ',
                                    (       SELECT v1.value
                                            FROM   app_local_customer_details v1 
                                            JOIN   app_local_clint_signup_info a1
                                            ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                                            WHERE   v1.customer_id =a.customer_id ORDER BY 1 LIMIT 1
                                    ) 
                        ) AS cust_name
                        FROM (`app_booking_service_details`         AS a, 
                              `app_employee`                AS b, 
                              `app_local_customer_details`  AS c,
                              `app_booking`                 AS d)
                        WHERE  a.`employee_id`              = b.`employee_id` 
                        AND    a.`customer_id`              = c.`customer_id`
                        AND    a.`booking_id`               = d.`booking_id`
                        AND    d.`local_admin_id`           = '$local_admin_id'
                        AND    d.`is_deleted`               = '0'
                        ".$EmpSortStr."
                        ".$SerSortStr."
                    ) AS maintable where 1=1 ";
            $ServcBookingList = $this->db->query($Sql);
            if ($ServcBookingList->num_rows() > 0)
            {
                    $ResArr = $ServcBookingList->result_array();
                    $strTosend = "";
                    $k=1;
                    $cnt = count($ResArr);
                    foreach($ResArr as $IndiServDtls)
                    {
                        $booking_service_id     = $IndiServDtls['booking_service_id'];
                        $StartDt                = $IndiServDtls['service_start_dt'];
                        $EndDt                  = $IndiServDtls['service_end_dt'];
                        $StrtTim                = $IndiServDtls['service_start_time'];
                        $EndtTim                = $IndiServDtls['service_end_time'];
                        $service_name           = $IndiServDtls['service_name'];
                        $srvcDesc               = $IndiServDtls['service_description'];
                        $local_admin_id         = $IndiServDtls['local_admin_id'];
                        $booking_id             = $IndiServDtls['booking_id'];
                        $service_id             = $IndiServDtls['service_id'];
                        $service_cost           = $IndiServDtls['service_cost'];
                        $employee_id            = $IndiServDtls['employee_id'];
                        $cust_name              = $IndiServDtls['cust_name']; 
                        $employee_name          = $IndiServDtls['employee_name'];
                        $service_duration       = $IndiServDtls['service_duration'];
                        $service_duration_unit  = $IndiServDtls['service_duration_unit'];
                        $booking_status         = $IndiServDtls['booking_status'];

                        if($booking_status == 0)     {$BookingStatusDisp = "unapproved";}
                        elseif($booking_status == 1) {$BookingStatusDisp = "aproved";}
                        elseif($booking_status == 2) {$BookingStatusDisp = "pending";}
                        elseif($booking_status == 3) {$BookingStatusDisp = "Cmpleted";}
                        elseif($booking_status == 4) {$BookingStatusDisp = "canceledByAdmin";}
                        elseif($booking_status == 5) {$BookingStatusDisp = "CancelledByUser";}

                        $ExplodeArrStartDate = explode("-",$StartDt);
                        $StartDateY = $ExplodeArrStartDate[0];
                        $StartDateM = $ExplodeArrStartDate[1]-1;
                        $StartDateD = $ExplodeArrStartDate[2];

                        $ExplodeArrEndDate = explode("-",$EndDt);
                        $EndDateY 	= $ExplodeArrEndDate[0];
                        $EndDateM 	= $ExplodeArrEndDate[1]-1;
                        $EndDateD 	= $ExplodeArrEndDate[2];

                        $ExplodeArrStrtTim = explode(":",$StrtTim);
                        $StrtTimH 	= $ExplodeArrStrtTim[0];
                        $StrtTimM 	= $ExplodeArrStrtTim[1];
                        $StrtTimS 	= $ExplodeArrStrtTim[2];

                        $ExplodeArrEndtTim = explode(":",$EndtTim);
                        $EndtTimH 	= $ExplodeArrEndtTim[0];
                        $EndtTimM 	= $ExplodeArrEndtTim[1];
                        $EndtTimS 	= $ExplodeArrEndtTim[2];

                        $strTosend .=	"{";
                        $strTosend .=	"booking_service_id: ".$booking_service_id.",";
                        $strTosend .=	"local_admin_id: ".$local_admin_id.","; 
                        $strTosend .=	"booking_id: ".$booking_id.","; 
                        $strTosend .=	"service_id: ".$service_id.","; 
                        $strTosend .=	"service_cost: ".$service_cost.",";
                        $strTosend .=	"cust_name: '".$cust_name."',";
                        $strTosend .=	"employee_name: '".$employee_name."',";
                        $strTosend .=	"BookingStatusDisp: '".$BookingStatusDisp."',";

                        $strTosend .=	"service_duration: '".$service_duration." ".$service_duration_unit."',";
                        $strTosend .=	"booking_status: ".$booking_status.","; 
                        $strTosend .=	"title: '".$service_name." :: ".$srvcDesc."  FOR: ".$cust_name." ; BY: ".$employee_name." ; FROM: ".$StrtTim." ; TO: ".$EndtTim."',";

                        $strTosend .=	"service_name: '".$service_name."',";
                        $strTosend .=	"srvcDesc: '".$srvcDesc."',";

                        $strTosend .=	"start: new Date(".$StartDateY.", ".$StartDateM.", ".$StartDateD.", ".$StrtTimH.", ".$StrtTimM."),";
                        $strTosend .=	"end: new Date(".$EndDateY.", ".$EndDateM.", ".$EndDateD.", ".$EndtTimH.", ".$EndtTimM."),";
                        $strTosend .=	"allDay: false";

                        if($cnt !=$k)
                        $strTosend .=	"},";
                        else
                        $strTosend .=	"}";
                        $k++;
                    } 
            }
            else
            {
                    $strTosend = 0;
            }
            return $strTosend;
    }
    public function getSelectedBookingAjaxRepopulate()
    {
            $local_admin_id = $this->session->userdata('local_admin_id');

            $EmpCounter = 0;
            $SerCounter = 0;

            $Sql = "SELECT * FROM 
                    ( 	
                        SELECT DISTINCT a.*, b.`employee_name`,
                        CONCAT( 
                                (     SELECT v1.value
                                      FROM   app_local_customer_details v1 
                                      JOIN   app_local_clint_signup_info a1
                                      ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                                      WHERE   v1.customer_id =a.customer_id ORDER BY 1 LIMIT 1
                                  ),
                                  ' ',
                                  (   SELECT v1.value
                                      FROM   app_local_customer_details v1 
                                      JOIN   app_local_clint_signup_info a1
                                      ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                                      WHERE   v1.customer_id =a.customer_id ORDER BY 1 LIMIT 1
                                  ) 
                        ) AS cust_name
                        FROM (`app_booking_service_details`         AS a, 
                              `app_employee`                AS b, 
                              `app_local_customer_details`  AS c,
                              `app_booking`                 AS d) 
                        WHERE  a.`employee_id`              = b.`employee_id` 
                        AND    a.`customer_id`              = c.`customer_id`
                        AND    a.`booking_id`               = d.`booking_id`
                        AND    d.`local_admin_id`           = '$local_admin_id'
                        AND    d.`is_deleted`               = '0'
                     ) AS maintable where 1=1 ";
            $ServcBookingList = $this->db->query($Sql);
            if ($ServcBookingList->num_rows() > 0)
            {
                    $ResArr = $ServcBookingList->result_array();
                    $strTosend = "";

                    $k=1;
                    $cnt = count($ResArr);
                    foreach($ResArr as $IndiServDtls)
                    {
                        $booking_service_id     = $IndiServDtls['booking_service_id'];
                        $StartDt                = $IndiServDtls['service_start_dt'];
                        $EndDt                  = $IndiServDtls['service_end_dt'];
                        $StrtTim                = $IndiServDtls['service_start_time'];
                        $EndtTim                = $IndiServDtls['service_end_time'];
                        $service_name           = $IndiServDtls['service_name'];
                        $srvcDesc               = $IndiServDtls['service_description'];
                        $local_admin_id         = $IndiServDtls['local_admin_id'];
                        $booking_id             = $IndiServDtls['booking_id'];
                        $service_id             = $IndiServDtls['service_id'];
                        $service_cost           = $IndiServDtls['service_cost'];
                        $employee_id            = $IndiServDtls['employee_id'];
                        $cust_name              = $IndiServDtls['cust_name']; 
                        $employee_name          = $IndiServDtls['employee_name'];
                        $service_duration       = $IndiServDtls['service_duration'];
                        $service_duration_unit  = $IndiServDtls['service_duration_unit'];
                        $booking_status         = $IndiServDtls['booking_status'];

                        if($booking_status == 0) {$BookingStatusDisp = "unapproved";}
                        elseif($booking_status == 1) {$BookingStatusDisp = "aproved";}
                        elseif($booking_status == 2) {$BookingStatusDisp = "pending";}
                        elseif($booking_status == 3) {$BookingStatusDisp = "Cmpleted";}
                        elseif($booking_status == 4) {$BookingStatusDisp = "canceledByAdmin";}
                        elseif($booking_status == 5) {$BookingStatusDisp = "CancelledByUser";}

                        $ExplodeArrStartDate = explode("-",$StartDt);
                        $StartDateY = $ExplodeArrStartDate[0];
                        $StartDateM = $ExplodeArrStartDate[1]-1;
                        $StartDateD = $ExplodeArrStartDate[2];

                        $ExplodeArrEndDate = explode("-",$EndDt);
                        $EndDateY 	= $ExplodeArrEndDate[0];
                        $EndDateM 	= $ExplodeArrEndDate[1]-1;
                        $EndDateD 	= $ExplodeArrEndDate[2];

                        $ExplodeArrStrtTim = explode(":",$StrtTim);
                        $StrtTimH 	= $ExplodeArrStrtTim[0];
                        $StrtTimM 	= $ExplodeArrStrtTim[1];
                        $StrtTimS 	= $ExplodeArrStrtTim[2];

                        $ExplodeArrEndtTim = explode(":",$EndtTim);
                        $EndtTimH 	= $ExplodeArrEndtTim[0];
                        $EndtTimM 	= $ExplodeArrEndtTim[1];
                        $EndtTimS 	= $ExplodeArrEndtTim[2];

                        $strTosend .=	"{";
                        $strTosend .=	"booking_service_id: ".$booking_service_id.",";
                        $strTosend .=	"local_admin_id: ".$local_admin_id.","; 
                        $strTosend .=	"booking_id: ".$booking_id.","; 
                        $strTosend .=	"service_id: ".$service_id.","; 
                        $strTosend .=	"service_cost: ".$service_cost.",";
                        $strTosend .=	"cust_name: '".$cust_name."',";
                        $strTosend .=	"employee_name: '".$employee_name."',";
                        $strTosend .=	"BookingStatusDisp: '".$BookingStatusDisp."',";

                        $strTosend .=	"service_duration: '".$service_duration." ".$service_duration_unit."',";
                        $strTosend .=	"booking_status: ".$booking_status.","; 
                        $strTosend .=	"title: '".$service_name." :: ".$srvcDesc."  FOR: ".$cust_name." ; BY: ".$employee_name." ; FROM: ".$StrtTim." ; TO: ".$EndtTim."',";
                        $strTosend .=	"service_name: '".$service_name."',";
                        $strTosend .=	"srvcDesc: '".$srvcDesc."',";

                        $strTosend .=	"start: new Date(".$StartDateY.", ".$StartDateM.", ".$StartDateD.", ".$StrtTimH.", ".$StrtTimM."),";
                        $strTosend .=	"end: new Date(".$EndDateY.", ".$EndDateM.", ".$EndDateD.", ".$EndtTimH.", ".$EndtTimM."),";
                        $strTosend .=	"allDay: false";

                        if($cnt !=$k)
                        $strTosend .=	"},";
                        else
                        $strTosend .=	"}";
                        $k++;
                    }
            }
            else
            {
                    $strTosend = 0;
            }
            return $strTosend;
    }
    public function ExistingUsersajax($searchKey,$timeavailable)
    {
        $strTosend = "";
        $local_admin_id = $this->session->userdata('local_admin_id');
        $Sql = "SELECT * FROM 
                    ( 	
                            SELECT DISTINCT a.*,
                            CONCAT( 
                                    ( 	SELECT v1.value
                                        FROM   app_local_customer_details v1 
                                        JOIN   app_local_clint_signup_info a1
                                        ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                                        WHERE  v1.local_admin_id  = b.local_admin_id and v1.customer_id =a.user_id ORDER BY 1 LIMIT 1
                                     ),
                                     ' ',
                                     (   SELECT v1.value
                                        FROM   app_local_customer_details v1 
                                        JOIN   app_local_clint_signup_info a1
                                        ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                                        WHERE  v1.local_admin_id  = b.local_admin_id and v1.customer_id =a.user_id ORDER BY 1 LIMIT 1
                                      ) 
                            ) AS cust_name
                            FROM (`app_password_manager` 	AS a, 
                                  `app_local_customer_details` 	AS b) 
                            WHERE  a.`user_type` 		= '1' 
                            AND    a.`user_status`		= '1'
                    ) AS maintable where 1=1 AND cust_name LIKE '%".$searchKey."%' ";
            $query = $this->db->query($Sql);
            $ResArr = $query->result_array();
            if ($query->num_rows() > 0)
            {
                $strTosend.= '<br /><br /><span style="font-size: 15;font-weight: bold;">Select An User</span><br />';
                foreach ($ResArr as $row)
                {
                 $cust_name  	= $row['cust_name'];
                 $user_id 	= $row['user_id'];
                 $strTosend.= '<input type="radio" name="customer_id" id="customer_id" value="'.$user_id.'" />'.$cust_name.'<br />';
                }   
            }
            $staffList = $this->db->query("SELECT	DISTINCT a.*  
                                FROM	app_employee a, app_biz_hours b 
                                WHERE	a.local_admin_id = b.local_admin_id 
                                AND		a.employee_id = b.employee_id 
                                AND		a.is_active ='Y' 
                                AND		a.local_admin_id ='$local_admin_id' ORDER BY a.employee_name asc");
            
             if($timeavailable == 0)
             {
                $CurTime = strtotime("00:00:00");
                $EndTime = strtotime("23:59:59");
                $IntervalMin = 30;
                $IntervalInSec = $IntervalMin * 60;
                $TimeIntervalCounter = 0;
                $strTosend.= '<br /><br /><span style="font-size: 15;font-weight: bold;">Select A Time</span><br />';
                $strTosend.= '<select name="timeslot" id="timeslot">';
                for($i=$CurTime; $i<=$EndTime; $i = $i+$IntervalInSec)
                {
                        //echo date('h:i A',$i)."<br /><br />";
                        $TimeSlot =  date('h:i A',$i);
                        if($TimeSlot == "12:00 AM") {$TimeSlot = "00:00 AM";}
                         $strTosend.= '<option value="'.$TimeSlot.'">'.$TimeSlot.'</option>';
                        $TimeIntervalCounter++;
                }
                $strTosend.= '</select><br /><br /><br />';
             }
             $FinalSending = "";
             if($query->num_rows() > 0)
             {

                 $FinalSending .= '<from name="f3" id="f3" method="post">';
                 $FinalSending .= $strTosend;
                 $FinalSending .= '<input type="button" name="submit" class="btn-blue" value="submit" onclick="ajxCallForBookingAdmin()"/>';
                 $FinalSending .= '</from>';
                 return $FinalSending;
             }
             else 
             {
                    return $NoData= '<br /><br /><span style="font-size: 15;font-weight: bold;">No Data Found</span><br />';
             }
    }
    public function TaxDetailsArr($ItemSubCost)
    {
        $TaxDtlsArr= array();
        $TotTaxAmnt = 0;
        $TaxItemCounter = 0;
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('tax_master_id,tax_rate, not_in_list_title');
        $this->db->from('app_tax_local_admin');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('status', '1');
        $query1 = $this->db->get();
        $resArr = $query1->result_array();
        foreach($resArr as $Val)
        {
            $TaxItemCounter++;
            if($Val['tax_master_id'] != 0)
            {
                $this->db->select('tax_title');
                $this->db->from('app_tax_master');
                $this->db->where('tax_master_id', $Val['tax_master_id']);
                $query = $this->db->get();
                $row=$query->row();
                $tax_title=$row->tax_title;
            }
            else
            {
                $tax_title=$Val['not_in_list_title'];
            }
            $tax_rate = $Val['tax_rate'];
            $TaxAmount = $ItemSubCost * ($tax_rate / 100);
            //$TotTaxAmnt += $TaxAmount;
            $TaxDtlsArr[$TaxItemCounter]['tax_title'] = $tax_title;
            $TaxDtlsArr[$TaxItemCounter]['tax_rate'] = $Val['tax_rate'];
            $TaxDtlsArr[$TaxItemCounter]['TaxAmount'] = $TaxAmount;
        }
        return  $TaxDtlsArr;
    }
    public function calculateEndTimeServEntry($service_duration,$dateInArray,$TimeSlot)
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $time_in_24_hour_format  = date("H:i:s", strtotime($TimeSlot));
        $exp_time=explode(':',$time_in_24_hour_format );
        $hour=$exp_time[0];
        $min=$exp_time[1];
        $check_time_to_str_to_time = mktime(date($hour,strtotime($dateInArray)),
                                            date($min,strtotime($dateInArray))+$service_duration,
                                            date("s",strtotime($dateInArray)),
                                            date("m",strtotime($dateInArray)),
                                            date("d",strtotime($dateInArray)),
                                            date("Y",strtotime($dateInArray))
                                        );
        $time_in_24_hour_format_end_time = date("H:i:s", $check_time_to_str_to_time );
        return $time_in_24_hour_format_end_time;
    }
    public function calculateEndDateServEntry($service_duration,$dateInArray,$TimeSlot)
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $time_in_24_hour_format  = date("H:i:s", strtotime($TimeSlot));
        $exp_time=explode(':',$time_in_24_hour_format );
        $hour=$exp_time[0];
        $min=$exp_time[1];
        $check_time_to_str_to_time = mktime(date($hour,strtotime($dateInArray)),
                                            date($min,strtotime($dateInArray))+$service_duration,
                                            date("s",strtotime($dateInArray)),
                                            date("m",strtotime($dateInArray)),
                                            date("d",strtotime($dateInArray)),
                                            date("Y",strtotime($dateInArray))
                                        );
        $SerEndDate = date("Y-m-d", $check_time_to_str_to_time );
        return $SerEndDate;
    }
    public function adminBookingInsertAjax($customer_id, $employee_id, $service_id, $bookingDate, $TimeSlot)
    {//echo "CUSTOMER : ".$customer_id." EMPLOYEE : ".$employee_id." SERVICE : ".$service_id." DATE : ".$bookingDate." TIME : ".$TimeSlot;exit;
    /****///$TimeSlot = $TimeSlot.":00";
        $date = date("Y-m-d", strtotime($bookingDate));

        $data_added         = date('Y-m-d');
        $date_edited        = date('Y-m-d');
        $local_admin_id     = $this->session->userdata('local_admin_id');

        $this->db->select('time_zone_id');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $row = $query->row();
        $time_zone_id=$row->time_zone_id;
        $booking_date_time = date('Y-m-d H:i:s');
//exit;
        $discount_amnt          = 0;
        $discount_coupon_dtls   = '';
        $prepayment_amount      = "";
        $prepayment_details     = "";

        $this->db->select('*');
        $this->db->from('app_service');
        $this->db->where('service_id', $service_id);
        $query = $this->db->get();
        $row=$query->row();

        $service_cost           = $row->service_cost;
        $service_name           = $row->service_name;
        $service_duration       = $row->service_duration;
        $service_duration_unit  = $row->service_duration_unit;
        $service_description    = $row->service_description;
        $service_start_dt       = $date;
        $service_duration_min   = $row->service_duration_min;

        $service_start_dt       = $date;
        $service_start_time     = $TimeSlot;
        
        

        $service_end_dt = $this->calculateEndDateServEntry($service_duration,$service_start_dt,$service_start_time);
        $service_start_time_24hourFormat = date("H:i:s", strtotime($service_start_time));
        $service_end_time_24hourFormat = $this->calculateEndTimeServEntry($service_duration_min,$service_start_dt,$service_start_time);

        $ItemSubCost = $service_cost;
        $TaxDetailsArr = $this->TaxDetailsArr($ItemSubCost);
        $TotTax = 0;
        foreach($TaxDetailsArr as $TotItemTax)
        {
                $TotTax += $TotItemTax['TaxAmount'];
        }
        $grndTot = ($ItemSubCost - $discount_amnt ) + $TotTax;
 
        $tax_dtls_arr       = json_encode($TaxDetailsArr);

        $insert_app_booking = array(
                                'local_admin_id'         =>$local_admin_id,
                                'time_zone_id'           =>$time_zone_id,
                                'booking_date_time'      =>$booking_date_time,
                                'customer_id'            =>$customer_id,
                                'Item_sub_cost'          =>$ItemSubCost,
                                'discount_amnt'          =>$discount_amnt,
                                'discount_coupon_dtls'   =>$discount_coupon_dtls,
                                'total_tax'              =>$TotTax,
                                'tax_dtls_arr'           =>$tax_dtls_arr,
                                'grnd_tot'               =>$grndTot,
                                'prepayment_amount'      =>$prepayment_amount,
                                'prepayment_details'     =>$prepayment_details,
                                'data_added'             =>$data_added,
                                'date_edited'            =>$date_edited
                             );
        $insert_app_booking = $this->global_mod->db_parse($insert_app_booking);                    
        $this->load->database();
        $this->db->trans_begin();
        $this->db->insert('app_booking',$this->db->escape($insert_app_booking));
        $booking_id=$this->db->insert_id();

        if($booking_id > 0 )
        {
                   $insert_app_booking_service = array(
                    'local_admin_id '		=>$local_admin_id,
                    'booking_id'		=>$booking_id,
                    'service_id'		=>$service_id,
                    'customer_id'		=>$customer_id,
                    'service_name'		=>$service_name,
                    'service_cost'		=>$service_cost,
                    'service_duration'		=>$service_duration,
                    'service_duration_unit'     =>$service_duration_unit,
                    'service_start_dt'		=>$service_start_dt,
                    'service_end_dt'		=>$service_end_dt,
                    'service_start_time'        =>$service_start_time_24hourFormat,
                    'service_end_time'		=>$service_end_time_24hourFormat,
                    'employee_id'		=>$employee_id,
                    'service_description'       =>$service_description
                    );
                    $insert_app_booking_service = $this->global_mod->db_parse($insert_app_booking_service);
                    $this->db->insert('app_booking_service_details',$this->db->escape($insert_app_booking_service));
        }

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return 0;
        }
        else
        {
                $this->db->trans_commit();
                return 1;
        }
    }
    function customerAdd($cus_fname_2, $cus_lname_3, $user_email, $cus_mob_9, $cus_phn1_10, $cus_phn2_11, $cus_address_4)
    {
            $insert_list = array();
            $local_admin_id               = $this->session->userdata('local_admin_id');
            $insert_list['cus_fname_2']   = $cus_fname_2;
            $insert_list['cus_lname_3']   = $cus_lname_3;
            $insert_list['user_email']    = $user_email;
            $insert_list['cus_mob_9']     = $cus_mob_9;
            $insert_list['cus_phn1_10']   = $cus_phn1_10;
            $insert_list['cus_phn2_11']   = $cus_phn2_11;
            $insert_list['cus_address_4'] = $cus_address_4;
            $this->db->select('*');
            $this->db->from('app_local_admin');
            $this->db->where('local_admin_id', $local_admin_id);
            $query = $this->db->get();
            foreach ($query->result() as $row)
            {
                $cus_countryid_5    =is_numeric($row->country_id)?$row->country_id:'0';
                $cus_regionid_6     =is_numeric($row->region_id)?$row->region_id:'0';
                $cus_cityid_7       =is_numeric($row->city_id)?$row->city_id:'0';
                $cus_zip_8          =is_numeric($row->business_zip_code)?$row->business_zip_code:'0';
                $time_zone_id_21    =is_numeric($row->time_zone_id)?$row->time_zone_id:'0';
            }              

            $insert_list['cus_countryid_5']   = $cus_countryid_5;
            $insert_list['cus_regionid_6']    = $cus_regionid_6;
            $insert_list['cus_cityid_7']      = $cus_cityid_7;
            $insert_list['cus_zip_8']         = $cus_zip_8;
            $insert_list['time_zone_id_21']   = $time_zone_id_21;

            $local_admin_id = $this->session->userdata('local_admin_id');
            $insert_app_password_manager = array(
                                       'user_type'          => 1,
                                       'user_name'          => uniqid('un_'),
                                       'password'           => uniqid('pass_'),
                                       'user_email'         => $user_email,
                                       'date_creation'      => date("Y/m/d"),
                                       'date_modified'      => date("Y/m/d")
            );
            $insert_app_password_manager = $this->global_mod->db_parse($insert_app_password_manager);
            $this->db->trans_begin();
            $this->db->insert('app_password_manager',$this->db->escape($insert_app_password_manager));
            $customer_id=$this->db->insert_id();
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } 
            foreach($insert_list as $key => $value)  //for each field
            {
                    $result = explode('_',$key);
                    $len=count($result);
                    $sign_upinfo_item_id=$result[$len-1];

                    if(is_numeric($sign_upinfo_item_id) && $value!='' )
                    {
                            $insert_app_local_customer_details = array(
                                       'local_admin_id'          => $local_admin_id,
                                       'sign_upinfo_item_id'     => $sign_upinfo_item_id,
                                       'customer_id'             => $customer_id,
                                       'value'                   => $value,
                                       'date_inserted'           => date("Y/m/d"),
                                       'date_edited'             => date("Y/m/d")
                            );
                            $insert_app_local_customer_details = $this->global_mod->db_parse($insert_app_local_customer_details);
                            $this->db->trans_begin();
                            $this->db->insert('app_local_customer_details',$this->db->escape($insert_app_local_customer_details));

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
            return $customer_id;
    }
    public function nwlyRegstrdExistingUsersAjax($newReg_cust_id,$timeavailable)
    {
        $strTosend = "";
        $local_admin_id = $this->session->userdata('local_admin_id');
        $Sql = "SELECT * FROM 
                    ( 	
                        SELECT DISTINCT a.*,
                        CONCAT( 
                                    ( 	SELECT v1.value
                                            FROM   app_local_customer_details v1 
                                            JOIN   app_local_clint_signup_info a1
                                            ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                                            WHERE  v1.local_admin_id  = b.local_admin_id and v1.customer_id =a.user_id   ORDER BY 1 LIMIT 1
                                    ),
                                    ' ',
                                    (   SELECT v1.value
                                            FROM   app_local_customer_details v1 
                                            JOIN   app_local_clint_signup_info a1
                                            ON     a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                                            WHERE  v1.local_admin_id  = b.local_admin_id and v1.customer_id =a.user_id  ORDER BY 1 LIMIT 1
                                    ) 
                        ) AS cust_name
                        FROM (`app_password_manager`        AS a, 
                              `app_local_customer_details`  AS b) 
                        WHERE  a.`user_type`                = '1' 
                        AND    a.`user_status`              = '1'
                        AND    a.`user_id`                  = '$newReg_cust_id'
                    ) AS maintable where 1=1 ";
                $query = $this->db->query($Sql);
                $ResArr = $query->result_array();
                if ($query->num_rows() > 0)
                {
                    $strTosend.= '<br /><span style="font-size: 15;font-weight: bold;">User</span><br />';
                    foreach ($ResArr as $row)
                    {
                     $cust_name  	= $row['cust_name'];
                     $user_id 	= $row['user_id'];
                     $strTosend.= '<input type="radio" name="customer_id" id="customer_id" checked="checked" value="'.$user_id.'" />'.$cust_name.'<br />';
                    }   
                }
                $staffList = $this->db->query("SELECT	DISTINCT a.*  
                                                FROM	app_employee a, app_biz_hours b 
                                                WHERE	a.local_admin_id = b.local_admin_id 
                                                AND		a.employee_id = b.employee_id 
                                                AND		a.is_active ='Y' 
                                                AND		a.local_admin_id ='$local_admin_id' ORDER BY a.employee_name asc");
                if ($staffList->num_rows() > 0)
                {
                   $strTosend.= '<br /><br /><span style="font-size: 15;font-weight: bold;">Select A Staff</span><br />';
                    $ResArr = $staffList->result_array();
                    foreach($ResArr as $IndiStaff)
                    {
                        $employee_name 	= $IndiStaff['employee_name'];
                        $employee_id 	= $IndiStaff['employee_id'];
                        $strTosend.= '<input type="radio" name="employee_id" id="employee_id" value="'.$employee_id.'" />'.$employee_name.'<br />';
                    }
                 }
                 $queryUnqSer = $this->db->query("SELECT DISTINCT b.* 
                                        FROM   app_biz_hours a, app_service  b 
                                        WHERE  a.service_id	   = b.service_id AND
                                        a.local_admin_id = '$local_admin_id' AND 
                                        b.is_active		 = 'Y'");

                 if ($queryUnqSer->num_rows() > 0)
                {
                   $strTosend.= '<br /><br /><span style="font-size: 15;font-weight: bold;">Select A Service</span><br />';
                    $ResArrserser = $queryUnqSer->result_array();
                    foreach($ResArrserser as $Indiserv)
                    {
                        $ser_name 	= $Indiserv['service_name'];
                        $ser_id 	= $Indiserv['service_id'];
                        $strTosend.= '<input type="radio" name="service_id" id="employee_id" value="'.$ser_id.'" />'.$ser_name.'<br />';
                    }
                 }
                 if($timeavailable == 0)
                 {
                    $CurTime = strtotime("00:00:00");
                    $EndTime = strtotime("23:59:59");
                    $IntervalMin = 30;
                    $IntervalInSec = $IntervalMin * 60;
                    $TimeIntervalCounter = 0;
                    $strTosend.= '<br /><br /><span style="font-size: 15;font-weight: bold;">Select A Time</span><br />';
                    $strTosend.= '<select name="timeslot" id="timeslot">';
                    for($i=$CurTime; $i<=$EndTime; $i = $i+$IntervalInSec)
                    {
                            //echo date('h:i A',$i)."<br /><br />";
                            $TimeSlot =  date('h:i A',$i);
                            if($TimeSlot == "12:00 AM") {$TimeSlot = "00:00 AM";}
                             $strTosend.= '<option value="'.$TimeSlot.'">'.$TimeSlot.'</option>';
                            $TimeIntervalCounter++;
                    }
                    $strTosend.= '</select><br /><br /><br />';
                 }
                 $FinalSending = "";
                 if($query->num_rows() > 0 && $staffList->num_rows() > 0 && $queryUnqSer->num_rows() > 0)
                 {
                     $FinalSending .= '<from name="f3" id="f3" method="post">';
                     $FinalSending .= $strTosend;
                     $FinalSending .= '<input type="button" name="submit" class="btn-blue" value="submit" onclick="ajxCallForBookingAdmin()"/>';
                     $FinalSending .= '</from>';
                     return $FinalSending;
                 }
                 else 
                 {
                        return $NoData= '<br /><br /><span style="font-size: 15;font-weight: bold;">No Data Found</span><br />';
                 }
    }
    public function  deleteThisBookingajax($booking_id)
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $data = array(
                        'is_deleted' => '1',
                );
        $this->db->trans_begin();
        $this->db->where('local_admin_id',$local_admin_id);
        $this->db->where('booking_id',$booking_id);
        $this->db->update('app_booking', $data);
        $AffectedRows = $this->db->affected_rows();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
        }

        if($AffectedRows == 1)
        {
                return 1;
        }
        else
        {
                return 0;
        }
   }   
    public function  deleteAgendaBookingajax($booking_id)
    {
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('booking_service_id',$booking_id);
        $this->db->delete('app_booking_service_details');

        $AffectedRows = $this->db->affected_rows();
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
        }

        if($AffectedRows == 1)
        {
                return 1;
        }
        else
        {
                return 0;
        }
   }
    public function  agendaDataAjax()
    {
    $ServcBkinDtls = $this->getAllBooking();
    $RetData = "";
    $RetData .= '  <table align="left" style="width: 99%">';
    $Counter = 0;
    foreach($ServcBkinDtls as $IndiServDtls)
    {
        $Counter++;
        $booking_service_id     = $IndiServDtls['booking_service_id'];
        $StartDt                = $IndiServDtls['service_start_dt'];
        $EndDt                  = $IndiServDtls['service_end_dt'];
        $StrtTim                = $IndiServDtls['service_start_time'];
        $EndtTim                = $IndiServDtls['service_end_time'];
        $service_name           = $IndiServDtls['service_name'];
        $srvcDesc               = $IndiServDtls['service_description'];
        $local_admin_id         = $IndiServDtls['local_admin_id'];
        $booking_id             = $IndiServDtls['booking_id'];
        $service_id             = $IndiServDtls['service_id'];
        $service_cost           = $IndiServDtls['service_cost'];
        $employee_id            = $IndiServDtls['employee_id'];
        $cust_name              = $IndiServDtls['cust_name']; 
        $employee_name          = $IndiServDtls['employee_name'];
        $cus_address            = $IndiServDtls['cus_address']; 
        $cus_zip                = $IndiServDtls['cus_zip']; 
        $cus_mob                = $IndiServDtls['cus_mob'];
        $booking_date_time      = $IndiServDtls['booking_date_time']; 
        $service_duration       = $IndiServDtls['service_duration'];
        $service_duration_unit  = $IndiServDtls['service_duration_unit'];

        $booking_status= $IndiServDtls['booking_status'];
        if($booking_status == 0)       {$BookingStatusDisp = "unapproved";}
        elseif($booking_status == 1)   {$BookingStatusDisp = "aproved";}
        elseif($booking_status == 2)   {$BookingStatusDisp = "pending";}
        elseif($booking_status == 3)   {$BookingStatusDisp = "Cmpleted";}
        elseif($booking_status == 4)   {$BookingStatusDisp = "canceledByAdmin";}
        elseif($booking_status == 5)   {$BookingStatusDisp = "CancelledByUser";}

        $ExplodeArrStartDate = explode("-",$StartDt);
        $StartDateY = $ExplodeArrStartDate[0];
        $StartDateM = $ExplodeArrStartDate[1]-1;
        $StartDateD = $ExplodeArrStartDate[2];

        $ExplodeArrEndDate = explode("-",$EndDt);
        $EndDateY 	= $ExplodeArrEndDate[0];
        $EndDateM 	= $ExplodeArrEndDate[1]-1;
        $EndDateD 	= $ExplodeArrEndDate[2];

        $ExplodeArrStrtTim = explode(":",$StrtTim);
        $StrtTimH 	= $ExplodeArrStrtTim[0];
        $StrtTimM 	= $ExplodeArrStrtTim[1];
        $StrtTimS 	= $ExplodeArrStrtTim[2];

        $ExplodeArrEndtTim = explode(":",$EndtTim);
        $EndtTimH 	= $ExplodeArrEndtTim[0];
        $EndtTimM 	= $ExplodeArrEndtTim[1];
        $EndtTimS 	= $ExplodeArrEndtTim[2];


          $RetData .= '  <tr id="tr'.$booking_service_id.'">
            <td align="left"> 
                <table align="left" style="width: 99%; border: 1px solid #999999">
                   <tr>
                       <td align="left" style="width: 11%"> 
                       <strong>['.$Counter.'] ON '.date("dM, Y", strtotime($StartDt)).'<br /> AT '.$StrtTim.'<br />'.$service_name.'<br />BY '.$employee_name.'<br />
                       FOR '.$cust_name.'</strong></td> 
                       <td align="left">Service Desc: <br />'.$srvcDesc.'</td>
                       <td align="left">Cost:<br /> '.$service_cost.'</td>
                       <td align="left">Service Duration:<br />'.$service_duration.''.$service_duration_unit.'</td>
                       <td align="left">Service Start Date and Time:<br />'.date("dM, Y", strtotime($StartDt)).' @ '.$StrtTim.'</td>
                       <td align="left">Service End Date and Time:<br />'.date("dM, Y", strtotime($EndDt)).' @ '.$EndtTim.'</td>

                       <td align="left">Customer Address:<br />'.$cus_address.'<br />'.$cus_zip.'
                       <br /><br />Customer Mobile Number:<br />'.$cus_mob.'
                       </td>
                       <td align="left">Booking Date and Time:<br />'.$booking_date_time.'</td>
                       <td align="left" style="width: 18%">
                       <strong>Current Status:</strong><br /><span id="BookingStatusDispAgenda'.$booking_service_id.'">'.$BookingStatusDisp.'</span><br /><br />
                       <strong>Change Status:</strong><br />
                       <a href="javascript:changeStatusAgenda(4, '.$booking_service_id.');">Cancel</a>  | 
                       <a href="javascript:changeStatusAgenda(1, '.$booking_service_id.');"">Approve</a>                                                          | 
                       <a href="javascript:changeStatusAgenda(3, '.$booking_service_id.');"">Complete</a>                                                         | 
                       <a href="javascript:deleteThisBookingAgenda('.$booking_service_id.');"">Delete</a> 
                        </td>
                </table>  
           </td>
         </tr>';
      } 
     $RetData .= '</table>';
	 
     return $RetData;
   }
    public function make_timezone($val)
    {
       $time1=explode("Z",$val);
       $time2= explode(".",$time1[0]);
       $timewz=$time2[0];
       $timewt=explode("T",$timewz);
       $date=$timewt[0];
       $time=$timewt[1];
       $timeexact=explode(":",$time);
       $hour=$timeexact[0];
       $min=$timeexact[1];
       $sec=$timeexact[2];
       $dateexact=explode("-",$date);
       $year=$dateexact[0];
       $month=$dateexact[1];
       $day=$dateexact[2];
       $timestamp=date('Ymd\THis\Z', mktime($hour,$min,$sec,$month,$day,$year));

       return   $timestamp;
    }                                
}
?>