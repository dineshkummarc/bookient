<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Credits_model extends CI_Model{
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function GetAllCreditTypes($country_id)
	{
		$CreditsArr = array();
		
		$this->db->select('*');
		$this->db->from('app_membership_smscall_dtls');
		$this->db->join('app_membership_smscall_rate_dtls', 'app_membership_smscall_rate_dtls.smscall_dtls_id = app_membership_smscall_dtls.smscall_dtls_id');
		$this->db->where('app_membership_smscall_dtls.status', 1);
		$this->db->where('app_membership_smscall_rate_dtls.country_id', $country_id);
		$query = $this->db->get();
		$CreditsArr = $query->result_array();
		
		return $CreditsArr;
	}
	
	public function GetCountryLocalAdmin()
	{
		$this->db->select('country_id');
		$this->db->from('app_local_admin');
		$this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
		$query = $this->db->get();
		$CountryArr = $query->result_array();
		
		return $CountryArr[0]['country_id'];
	}
	
	public function GetRateInfo()
	{
		$this->db->select('sms_rate,call_rate');
		$this->db->from('app_membership_smscall_rate_dtls');
		$this->db->where('country_id', $this->input->post('country_id'));
		$this->db->where('smscall_dtls_id', $this->input->post('credit_type'));
		$query = $this->db->get();
		$ReturnyArr = $query->result_array();
		
		echo $ReturnyArr[0]['sms_rate'].'(@$@)'.$ReturnyArr[0]['call_rate'];
	}
	
	public function GetAllCreditList()
	{
		$this->db->select('*');
		$this->db->from('app_membership_payment_smscall_credit_history');
		$this->db->join('app_membership_smscall_dtls', 'app_membership_smscall_dtls.smscall_dtls_id = app_membership_payment_smscall_credit_history.smscall_dtls_id');
		$this->db->where('app_membership_payment_smscall_credit_history.local_admin_id', $this->session->userdata('local_admin_id'));
		$query = $this->db->get();
		$RetArr = $query->result_array();
		
		return $RetArr;
	}  
	 //CB#SOG#22-1-2013#PR#S
	public function DownloadPdf()
	{
                //echo '<pre>';print_r($_GET);exit;            
		$this->db->select('*');
		$this->db->from('app_membership_payment_smscall_credit_history');
		$this->db->join('app_membership_smscall_dtls', 'app_membership_smscall_dtls.smscall_dtls_id = app_membership_payment_smscall_credit_history.smscall_dtls_id');
		$this->db->where('app_membership_payment_smscall_credit_history.payment_smscall_credit_history_id', $this->input->get('id'));
		$this->db->where('app_membership_payment_smscall_credit_history.local_admin_id', $this->session->userdata('local_admin_id'));
		$query = $this->db->get();
		$PdfArr = $query->result_array();
                //echo '<pre>';print_r($PdfArr);exit;
                
		$html = '<table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid">
		   <tr style=" background-color: #ffffff;">
		   	<td><strong>Date Purchased : </strong></td>
			<td>'.date("m/d/Y",strtotime($PdfArr[0]["date_purchased"])).'</td>
		   </tr>
		   <tr style=" background-color: #f0f0f0;">
		   	<td><strong>Amount($) : </strong></td>
			<td>'.$PdfArr[0]["amount"].'</td>
		   </tr>
		   <tr style=" background-color: #ffffff;">
		   	<td><strong>Credits : </strong></td>
			<td>'.$PdfArr[0]["credit"].'</td>
		   </tr>
		   <tr style=" background-color: #f0f0f0;">
		   	<td><strong>Description : </strong></td>
			<td>'.$PdfArr[0]["description"].'</td>
		   </tr>
		</table>
		';
		//print($html);
		
		$c_file_path = dirname(__FILE__).'\..\..';		
		$basepath = realpath($c_file_path).'\libraries\MPDF54\mpdf.php';
                
		/*if(file_exists($basepath))
		{
		  echo ' ok file exists.';
		}*/
                
		require_once("$basepath");
		$mpdf=new mPDF('utf-8', 'A4');
		$mpdf = new mPDF('en-GB','A4','','',32,25,27,25,16,13);
                $mpdf->useOnlyCoreFonts = true;
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->list_indent_first_level = 0;
                
		//$data = '<p>hello world</p>';	
                
                $mpdf=new mPDF('utf-8','A4');
                $mpdf->WriteHTML($html);
                   
		//$mpdf->Output(BASEPATH."/docs/reciept.pdf");
		$mpdf->Output('reciept.pdf','D');
		//$mpdf->Output();
		exit();               
             
	}
        //CB#SOG#22-1-2013#PR#E
}
