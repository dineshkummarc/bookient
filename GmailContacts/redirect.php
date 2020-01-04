<?php
session_start();
$_SESSION['rurl'] = $_REQUEST['rurl'] ;

header("Location: https://accounts.google.com/o/oauth2/auth?client_id=992374407199-a2tc5t2gl29lf8nv50cd4r011nik257u.apps.googleusercontent.com&redirect_uri=".$_REQUEST['gurl']."gmail/oauth.php&scope=https://www.google.com/m8/feeds/&response_type=code");
?>