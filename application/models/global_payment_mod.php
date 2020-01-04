<?php
class Global_payment_mod extends CI_Model {
     
   //1 for paypal & 27 for dotnet
/*	public function getPaymentSettingDetails($paymentType){
	    $local_admin_id = $this->session->userdata('local_admin_id');
	    $Arr = array();
		
		$this->db->select('*');
		$this->db->from('app_payment_gateways_fields');
		$this->db->where('payment_gateways_id', $paymentType);
		$query = $this->db->get();
		$FieldsArr = $query->result_array();
		
		for($j=0;$j < count($FieldsArr);$j++){
			$this->db->select('payment_gateways_values');
			$this->db->from('app_payment_gateways_values');
			$this->db->where('payment_gateways_fields_id', $FieldsArr[$j]['payment_gateways_fields_id']);
			$this->db->where('local_admin_id', $local_admin_id);
			$query = $this->db->get();
			$ValuesArr = $query->result_array();
			$Arr[$j][$FieldsArr[$j]['payment_gateways_fields_id']] = $ValuesArr[0]['payment_gateways_values'];
		}
		
		return $Arr;
	}
	*/
	
	public function sendToPaymentViaPaypal($dataArrIn,$dataStrOut){
		//######################### Paypal settings start #########################
		//$paypal_config = $this->getPaymentSettingDetails(1);
		$paypal = array();
		$paypal['API_UserName']='palash.citytech-facilitator_api1.gmail.com';//$paypal_config[0]['1'];
		$paypal['API_Password']='1392807914';//$paypal_config[1]['7'];
		$paypal['API_Signature']='AFcWxV21C7fd0v3bYYYRCpSSRl31AFYRiI2XDp3D0jSrbnk.9tGu9ViE';//$paypal_config[2]['8'];
		$paypal['API_Endpoint'] ='https://api-3t.sandbox.paypal.com/nvp';
		$paypal['version']='53.0';
		//######################### Paypal settings end #########################
		
		//######################### Customer card details start #########################
		$paymentType		= urlencode("Sale");//urlencode( $_POST['paymentType']);
		$firstName			= urlencode($dataArrIn['fname']);//urlencode( $_POST['fname']);
		$lastName			= urlencode($dataArrIn['lname']);//urlencode( $_POST['lname']);
		$creditCardType		= urlencode($dataArrIn['cardType']);//urlencode( $_POST['creditCardType']);
		$creditCardNumber	= urlencode($dataArrIn['cardNumber']);// urlencode($_POST['creditCardNumber']);
		$expDateMonth		= urlencode($dataArrIn['cardMonth']);//urlencode( $_POST['expDateMonth']);
		$padDateMonth		= str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
		$expDateYear		= urlencode($dataArrIn['cardYear']);//urlencode( $_POST['expDateYear']);
		$cvv2Number			= urlencode($dataArrIn['cardCVV']);//urlencode($_POST['cvv2Number']);
		$amount				= urlencode($dataArrIn['PayAmount']);//urlencode($_POST['ftotal']);
		$currencyCode		= urlencode("USD");
		$customOut			= urlencode($dataStrOut);
		$ipAddress			= $_SERVER['REMOTE_ADDR'];
		//######################### Customer card details end #########################

		$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&COUNTRYCODE=US&CURRENCYCODE=$currencyCode&IPADDRESS=".$ipAddress."&CUSTOM=".$customOut;
		
		$resArray=$this->hash_call("doDirectPayment",$nvpstr,$paypal);		
		$TransactionID= isset($resArray['TRANSACTIONID'])?$resArray['TRANSACTIONID']:'';
		
		$returnArr = array();
		if(!empty($TransactionID)){
		 $resArray =$this->hash_call("GetTransactionDetails","&TransactionID=$TransactionID",$paypal);
			$returnArr['msg']			= 'success';
			$returnArr['transactionId']	= $resArray['TRANSACTIONID'];
			$returnArr['return']		= $resArray['CUSTOM'];
		}else{
			$returnArr['msg']			= 'failed';
		} 
		return $returnArr;
	}

	public function deformatNVP($nvpstr){
	$intial=0;
 	$nvpArray = array();
	while(strlen($nvpstr)){
		//postion of Key
		$keypos= strpos($nvpstr,'=');
		//position of value
		$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

		/*getting the Key and Value values and storing in a Associative Array*/
		$keyval=substr($nvpstr,$intial,$keypos);
		$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
		//decoding the respose
		$nvpArray[urldecode($keyval)] =urldecode( $valval);
		$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
     }
	return $nvpArray;
}

	public function hash_call($methodName,$nvpStr,$paypal){
	//setting the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$paypal['API_Endpoint']);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);

	//NVPRequest for submitting to server
	$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($paypal['version'])."&PWD=".urlencode($paypal['API_Password'])."&USER=".urlencode($paypal['API_UserName'])."&SIGNATURE=".urlencode($paypal['API_Signature']).$nvpStr;

	//setting the nvpreq as POST FIELD to curl
	curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

	//getting response from server
	$response = curl_exec($ch);

	//convrting NVPResponse to an Associative Array
	$nvpResArray=$this->deformatNVP($response);
	$nvpReqArray=$this->deformatNVP($nvpreq);
	$nvpResArray['nvpReqArray']=$nvpReqArray;

	if (curl_errno($ch)) {
		// moving to display page to display curl errors
		  $nvpResArray['curl_error_no']=curl_errno($ch) ;
		  $nvpResArray['curl_error_msg']=curl_error($ch);
	 } else {
			curl_close($ch);
	  }

return $nvpResArray;
}

}