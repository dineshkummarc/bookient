<?php

/**
 * Shows how to login as an app.
 *
 * This is a silly example since app access token is already provided by $app->getAccessToken();
 *
 * @author Xavier Barbosa
 * @since 13 February, 2013
 * @link https://developers.facebook.com/docs/howtos/login/login-as-app/
 **/

//use Mute\Facebook\App;

/**
 * Default params
 **/

$app_id = "444272075674092";
$app_secret = "da8585763133c8d9c809feebab361b70";


/**
 * Step 1. Obtain an App Access Token
 **/

$app = new Mute\Facebook\App($app_id, $app_secret);
$params = $app->getOAuth()->getAppAccessToken();

echo 'This app\'s access token is: ' . $params['access_token'];

/**
 * Step 2. Make Requests to the API
 **/

$app_details = $app->get('app', array(
    'access_token' => $params['access_token'],
));

echo '<br />Here is a link to the app ' . $app_details['link'];
