<?php
include_once 'GmailOath.php';
include_once 'Config.php';
session_start();
$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
$getcontact_access=new GmailGetContacts();

$request_token=$oauth->rfc3986_decode($_GET['oauth_token']);
$request_token_secret=$oauth->rfc3986_decode($_SESSION['oauth_token_secret']);
$oauth_verifier= $oauth->rfc3986_decode($_GET['oauth_verifier']);

$contact_access = $getcontact_access->get_access_token($oauth,$request_token, $request_token_secret,$oauth_verifier, false, true, true);

$access_token=$oauth->rfc3986_decode($contact_access['oauth_token']);
$access_token_secret=$oauth->rfc3986_decode($contact_access['oauth_token_secret']);
$contacts= $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true,$emails_count);
/*echo "<pre>";
print_r($contacts);
echo "</pre>";*/
echo '<table><tr><th>Name</th><th>Email</th></tr>';
foreach($contacts as $k => $a)
{
    echo '<tr><td>'.$a['title']['$t'].'</td>';
    $final = end($contacts[$k]);
    foreach($final as $email)
    {
        echo '<td>'.$email["address"] .'</td>';
    }
    echo '</tr>';
} 
echo '</table>';
?>
