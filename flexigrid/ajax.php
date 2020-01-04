<?php

mysql_connect('localhost', 'citytechsql', 'wpNdwEuVEKZT2Ac5') or die();
mysql_select_db('pardco_appointment');

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();



$run = mysql_query("SELECT * FROM app_password_manager WHERE 1=1  ORDER BY user_id DESC LIMIT ".$postnumbers." OFFSET ".$offset);


while($row = mysql_fetch_array($run)) {
	
	$content = $row['date_creation'];
	
	echo '<h2><a href="'.$row['user_id'].'">'.$row['user_email'].'</a></h2>';
	echo '<p>'.$content.'...</p><hr />';

}

?>