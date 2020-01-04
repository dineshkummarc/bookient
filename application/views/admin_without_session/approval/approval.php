<?php include('approval.js.php'); ?>
<div class="rounded_corner_full">
    <h1 class="headign-main">Unapproved Appointments</h1>
<?php
if(count($show_all_booking)>0){
?>
&nbsp;&nbsp;<input type="checkbox" value="0" id="ckbCheckAll" name="check_all"/> <?php echo $this->lang->line('chk_box'); ?>
&nbsp;&nbsp;<input type="button" onclick="approveAllCheckedBooking()" value="Approve All Check" class="approval-all"/>
<?php echo $this->lang->line('btn_msg'); ?>
<br/><br/><br/>
<div id='show_all_appointment' style="padding-bottom:10px;">
<table class="client-list" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" width="20%" class="table-bg-head">Username</td>
        <td align="left" width="38%" class="table-bg-head">Contact Info</td>
        <td align="left"width="42%" class="table-bg-head">Time</td>
    </tr>
<?php 
/*echo "<pre>";
print_r($show_all_booking);
echo "</pre>";*/
$booking_id = '';
foreach($show_all_booking as $val)
{
    if($booking_id != $val['booking_id'])
    {
?>
    <tr style="border-bottom:1px solid #cacaca; padding:3px 0;">
        <td>
            <input type="checkbox" name="book_chk_name[]" class="all_booking" value="<?php echo $val['booking_id'];?>">
            <?php echo $val['cus_fname']." ".$val['cus_lname'];?><br/> 
            <?php echo $val['cus_address'].', '.$val['region_name'].', '.$val['city_name'].', '.$val['country_name'].' ('.$val['cus_zip'].')';?>
        </td>
        <td>
            <?php echo $val['cus_mob'];?><br/> 
            <?php echo $val['user_email'];?>
        </td>
        <td>
            <?php echo date("l, dS F, Y g:i A",strtotime($val['booking_date_time']));?><br/>
            <input type="button" style="padding:6px 12px;" value="Approve" class="time-bt" onclick="approve(<?php echo $val['booking_id'];?>)">
            &nbsp; &nbsp;
            <input type="button" style="padding:6px 12px;" value="Deny" class="time-bt" onclick="deny(<?php echo $val['booking_id'];?>)"><br/>
            <a href="#" onclick="showAppointmentDetails(<?php echo $val['booking_id'];?>)">Appointment Details</a>
        </td>
    </tr>
    <tr class="hide_<?php echo $val['booking_id'];?>" style="display:none;" bgcolor="#e3e3e3">
    <td></td>
    <td></td>
        <td align="left">
            <?php echo $val['srvDtls_service_name'].' by '.$val['srvDtls_employee_name'].' on '.date("l, dS F, Y g:i A",strtotime($val['srvDtls_service_start']));?>
        </td>
    </tr>
<?php
    }
    else
    {
?>
    <tr class="hide_<?php echo $val['booking_id'];?>" style="display:none;" bgcolor="#e3e3e3">
    <td></td>
    <td></td>
        <td  align="left">
            <?php echo $val['srvDtls_service_name'].' by '.$val['srvDtls_employee_name'].' on '.date("l, dS F, Y g:i A",strtotime($val['srvDtls_service_start']));?>

        </td>
    </tr>

<?php
    }
    $booking_id = $val['booking_id'];   
}
?>

</table>  
<?php 
}
else{
    echo "There is no unapproved appointments.";
}
?>
</div>
</div>