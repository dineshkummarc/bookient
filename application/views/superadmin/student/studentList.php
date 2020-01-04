<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<link href="<?php echo base_url(); ?>style/style.css" rel="stylesheet" type="text/css" />
<style>
	body {
 background-color: #fff;
 margin: 0px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 10px;
 font-weight: bold;
 margin: 0px 0 2px 0;
 padding: 5px 0 6px 0;
}
div.content {
	padding:2px 5px;
}


div.content div.data table {
	border:2px solid #000;
	background:#fff;
	width:60%;
}
div.content div.data table td {
	font-size:8pt;
	padding:5px 5px;
	border-bottom:1px solid #ddd;
	text-align: left;
}

div.paging {
	font-size: 7pt;
	margin:5px 0px;
	width:60%;
	text-align:right;
}
div.paging a {
	color:#900;
	text-transform: uppercase;
	text-decoration: none;
}
div.paging a:hover {
	color:#c00;
}
div.paging b {
	color:#900;
}

</style>

</head>
<body>
	<div class="content">
		<h1>Example Insert Update and delete</h1>

		






		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<div class="paging"><?php echo $pagination; ?></div>

		<br />
		<?php echo anchor('Student/add/','<button>Add new students</button>',array('class'=>'add')); ?>
	</div>
</body>
</html>