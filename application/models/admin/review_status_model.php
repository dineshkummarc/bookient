<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_status_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function GetAll($start,$limit)
    {
    	$local_admin_id		= $this->session->userdata('local_admin_id');
    	$sql = "SELECT 
    				bk.booking_id AS booking_id,
    				bk.customer_id AS customer_id,
    				bk.currency_id AS currency_id,
    				bk.booking_date_time AS booking_date_time,
    				bk.booking_sub_total AS booking_sub_total,
    				bk.booking_disc_amount AS booking_disc_amount,
    				bk.booking_disc_coupon_details AS booking_disc_coupon_details,
    				bk.booking_total_tax AS booking_total_tax,
    				bk.booking_tax_dtls_arr AS booking_tax_dtls_arr,
    				bk.booking_grnd_total AS booking_grnd_total, 
    				bk.booking_prepayment_amount AS booking_prepayment_amount,
    				bk.booking_prepayment_details AS booking_prepayment_details,
    				bk.booking_comment AS booking_comment,
    				srv.srvDtls_service_id AS srvDtls_service_id,
    				srv.srvDtls_service_name AS srvDtls_service_name,
    				srv.srvDtls_service_cost AS srvDtls_service_cost,
    				srv.srvDtls_service_duration AS srvDtls_service_duration,
    				srv.srvDtls_service_duration_unit AS srvDtls_service_duration_unit,
    				srv.srvDtls_service_start AS srvDtls_service_start,
    				srv.srvDtls_service_end AS srvDtls_service_end, 
    				srv.srvDtls_employee_id  AS srvDtls_employee_id,
    				srv.srvDtls_employee_name AS srvDtls_employee_name,
    				srv.srvDtls_booking_status AS srvDtls_booking_status,
    				srv.srvDtls_status_date AS srvDtls_status_date,
    				srv.srvDtls_service_quantity AS srvDtls_service_quantity,
    				srv.srvDtls_service_description AS srvDtls_service_description,
    				rv.review_id AS review_id,
    				rv.local_admin_id AS local_admin_id,
    				rv.comments AS comments,
    				rv.posted_by AS posted_by, 
    				rv.service_id AS service_id,
    				rv.staff_id AS staff_id,
    				rv.is_approve AS is_approve,
    				rv.rating AS rating,
    				rv.posted_on AS posted_on,
    				cust.cus_id  AS user_id,
    						country.country_name AS country_name,
    						city.city_name AS city_name,
    						region.region_name AS region_name, 
    						pass.user_email AS user_email,
    				cust.cus_fname AS cus_fname,
    				cust.cus_lname AS cus_lname, 
    				cust.cus_address AS cus_address,
    				cust.cus_zip AS cus_zip, 
    				cust.cus_mob AS cus_mob,
    				cust.cus_phn1 AS cus_phn1, 
    				cust.cus_phn2 AS cus_phn2 
    			FROM
    				app_booking AS bk,
    				app_booking_service_details AS srv,
    				app_review AS rv,
    				app_customer_search AS cust,
    				app_countries AS country,
    				app_cities AS city,
    				app_regions AS region,
    				app_password_manager AS pass
    			WHERE 
					rv.posted_by = cust.cus_id 
					AND
					rv.srvDtls_id = srv.srvDtls_id 
					AND
					srv.srvDtls_booking_id = bk.booking_id 
					AND
					rv.posted_by = pass.user_id 
					AND
					cust.cus_regionid = region.region_id  
					AND
					cust.cus_countryid = country.country_id 
					AND
					cust.cus_cityid = city.city_id 
					AND
					rv.local_admin_id = '".$local_admin_id."'
					LIMIT ".$start.",".$limit;
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    	


    	
    	
    	
       // $sql = " LIMIT ".$start.",".$limit;
        //return $this->global_mod->reviewWiseReportDetails($sql);	
    }
    public function GetDetails($customer_id)
    {
        // echo '<pre>';print_r(get_object_vars($f));exit;
    }	
    public function get_TotalRecords()
    {
    	$local_admin_id		= $this->session->userdata('local_admin_id');
    	$sql = "SELECT 
    				bk.booking_id AS booking_id,
    				bk.customer_id AS customer_id,
    				bk.currency_id AS currency_id,
    				bk.booking_date_time AS booking_date_time,
    				bk.booking_sub_total AS booking_sub_total,
    				bk.booking_disc_amount AS booking_disc_amount,
    				bk.booking_disc_coupon_details AS booking_disc_coupon_details,
    				bk.booking_total_tax AS booking_total_tax,
    				bk.booking_tax_dtls_arr AS booking_tax_dtls_arr,
    				bk.booking_grnd_total AS booking_grnd_total, 
    				bk.booking_prepayment_amount AS booking_prepayment_amount,
    				bk.booking_prepayment_details AS booking_prepayment_details,
    				bk.booking_comment AS booking_comment,
    				srv.srvDtls_service_id AS srvDtls_service_id,
    				srv.srvDtls_service_name AS srvDtls_service_name,
    				srv.srvDtls_service_cost AS srvDtls_service_cost,
    				srv.srvDtls_service_duration AS srvDtls_service_duration,
    				srv.srvDtls_service_duration_unit AS srvDtls_service_duration_unit,
    				srv.srvDtls_service_start AS srvDtls_service_start,
    				srv.srvDtls_service_end AS srvDtls_service_end, 
    				srv.srvDtls_employee_id  AS srvDtls_employee_id,
    				srv.srvDtls_employee_name AS srvDtls_employee_name,
    				srv.srvDtls_booking_status AS srvDtls_booking_status,
    				srv.srvDtls_status_date AS srvDtls_status_date,
    				srv.srvDtls_service_quantity AS srvDtls_service_quantity,
    				srv.srvDtls_service_description AS srvDtls_service_description,
    				rv.review_id AS review_id,
    				rv.local_admin_id AS local_admin_id,
    				rv.comments AS comments,
    				rv.posted_by AS posted_by, 
    				rv.service_id AS service_id,
    				rv.staff_id AS staff_id,
    				rv.is_approve AS is_approve,
    				rv.rating AS rating,
    				rv.posted_on AS posted_on,
    				cust.cus_id  AS user_id,
    						country.country_name AS country_name,
    						city.city_name AS city_name,
    						region.region_name AS region_name, 
    						pass.user_email AS user_email,
    				cust.cus_fname AS cus_fname,
    				cust.cus_lname AS cus_lname, 
    				cust.cus_address AS cus_address,
    				cust.cus_zip AS cus_zip, 
    				cust.cus_mob AS cus_mob,
    				cust.cus_phn1 AS cus_phn1, 
    				cust.cus_phn2 AS cus_phn2 
    			FROM
    				app_booking AS bk,
    				app_booking_service_details AS srv,
    				app_review AS rv,
    				app_customer_search AS cust,
    				app_countries AS country,
    				app_cities AS city,
    				app_regions AS region,
    				app_password_manager AS pass
    			WHERE 
					rv.posted_by = cust.cus_id 
					AND
					rv.srvDtls_id = srv.srvDtls_id 
					AND
					srv.srvDtls_booking_id = bk.booking_id 
					AND
					rv.posted_by =  pass.user_id 
					AND
					cust.cus_regionid = region.region_id  
					AND
					cust.cus_countryid = country.country_id 
					AND
					cust.cus_cityid = city.city_id 
					AND
					rv.local_admin_id = ".$local_admin_id;
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return count($Arr);
       // $resArr = $this->global_mod->reviewWiseReportDetails();
        //return count($resArr);
    }
}
?>


