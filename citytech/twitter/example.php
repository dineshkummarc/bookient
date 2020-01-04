<?php
// Insert your keys/tokens
$consumerKey = 'YVmljm6QA4X5FMGimEbNw';
$consumerSecret = 'ZAXOaIvKFMq8EYSQwgwREISbQdpVkBE4iIJfudKNBw';
$oAuthToken = '';
$oAuthSecret = '';

// Full path to twitteroauth.php (change oauth to your own path)
//require_once($_SERVER['DOCUMENT_ROOT'].'/oauth/twitteroauth.php');
require_once('twitteroauth.php');
// create new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

// Your Message
$message = "This is a test message.";

// Send tweet 
$x = $tweet->post('statuses/update', array('status' => "$message"));


echo "<pre>";
print_r($x);
echo "hey";
?>