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
 font-size: 8px;
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
 font-size: 8px;
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
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<?php echo validation_errors(); ?>
<?php echo form_open($action); ?>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo (isset($Student['id']))?$Student['id']:''; ?>"/></td>
				<input type="hidden" name="id" value="<?php echo (isset($Student['id']))?$Student['id']:''; ?>"/>
			</tr>
			<tr>
				<td valign="top">name<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value="<?php echo (set_value('name'))?set_value('name'):$Student['name']; ?>"/>
				<?php echo form_error('name'); ?></td>
			</tr>
			<tr>
				<td valign="top">Address</td>
				<td><input type="text" name="address" class="text" value="<?php echo set_value('address')?set_value('address'):$Student['address']; ?>"/>
				<?php echo form_error('address'); ?></td>
			</tr>
			<tr>
				<td valign="top">Gender<span style="color:red;">*</span></td>
				<td><input type="radio" name="gender" value="M" <?php echo set_radio('gender', 'M', TRUE); ?>/> Male
					<input type="radio" name="gender" value="F" <?php echo set_radio('gender', 'F'); ?>/> Female
					<?php echo form_error('gender'); ?></td>
			</tr>
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)<span style="color:red;">*</span></td>
				<td><input type="text" name="date_of_birth" class="text" value="<?php echo (set_value('date_of_birth'))?set_value('date_of_birth'):$Student['date_of_birth']; ?>"/>

				<?php echo form_error('date_of_birth'); ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>

	</form>


		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>