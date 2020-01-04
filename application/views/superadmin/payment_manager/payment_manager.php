<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('payment_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main" style="text-align: center;">Payment Manager</h1>

<div id="local_admin_list">
<form name="frm_payment" id="frm_payment">
    </br>
<table style="margin:0px auto;" class="credit-table"  cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Select Local Admin : </strong></td>
    <td>
	<select name="local_admin_id" id="local_admin_id" class="required">
    	<option value="">Choose One</option>
        <?php foreach($local_admin as $row) {
				if($row['last_name'] != '')
					$name = $row['first_name'].' '.$row['last_name'];
				else
					$name = $row['first_name'];
		?>
        <option value="<?php echo $row['local_admin_id']; ?>"><?php echo $name; ?></option>
        <?php } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td><strong>Select Payment Type : </strong></td>
    <td>
	<select name="payment_type" id="payment_type" class="required">
    	<option value="">Choose One</option>
        <option value="1">Credit Payment History</option>
        <option value="2">Membership Payment History</option>
    </select>
    </td>
  </tr>
 <!-- <tr>
    <td><strong>Select Date : </strong></td>
  </tr>-->

   <tr>
    <td><strong> Select Date From :</strong></td>
    <td>
    <input type="text" name="start_date" id="start_date" style="background-color:#CCC;" class="required" readonly="readonly"/>
    &nbsp; &nbsp;  </td>
  </tr>
  <tr>
    <td><strong>Select Date To : </strong></td>
   <td>
     <input type="text" name="end_date" id="end_date" style="background-color:#CCC;" class="required" readonly="readonly" />
    </td>
  </tr>
   <tr>
    <td><span id ="date_chk"></span></td>
  </tr>
  <tr>
      <td>&nbsp;</td>
  	<td ><input type="button" name="sub_payment" id="sub_payment" onclick="GetResultantData();" value="Search" class="btn-blue" />&nbsp;&nbsp;<input type="button" name="cancel_payment" id="cancel_payment" onclick="CancelData();" value="Reset" class="btn-gray" /></td>
  </tr>
</table>
</form>
</div>
<div id="payment_listing">
</div>

</div>

