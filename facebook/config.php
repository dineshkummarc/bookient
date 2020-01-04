<?php
include_once("inc/facebook.php"); //include facebook SDK
######### edit details ##########
$appId = '444272075674092'; //Facebook App ID
$appSecret = 'da8585763133c8d9c809feebab361b70'; // Facebook App Secret
$return_url = 'http://bookient.com/facebook/process.php';  //return url (url to script)
$homeurl = 'http://bookient.com/facebook/';  //return to home
$fbPermissions = 'publish_stream,user_photos';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'fileUpload' => true,
  'cookie' => true

));
$fbuser = $facebook->getUser();
?>