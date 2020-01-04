<?php include('report.js.php'); ?>
<div class="rounded_corner_full">
<h1 class="headign-main"> <?php echo $this->lang->line('headign-main'); ?> </h1>

<form action="" method="post" name="frm_appointment" id="frm_appointment">
    <div class="report-search">
<table width="100%" cellpadding="0" cellspacing="0" class="common-tabl">
	<tr>
    	<td colspan="2" style="font-size:14px;"><strong> <?php echo $this->lang->line('search_type'); ?></strong></td>
    </tr>
    <tr>
        <td>
        <select name="appointment_type" id="appointment_type"  style="width:250px;">
        	<option value="1"><?php echo $this->lang->line('appointment_type_1'); ?></option>
                <option value="2"><?php echo $this->lang->line('appointment_type_2'); ?></option>
        </select>
        </td>
        <td >
        <select name="display_type" id="display_type">
            <option value="1"><?php echo $this->lang->line('display_type_1'); ?></option>
            <option value="2"><?php echo $this->lang->line('display_type_2'); ?></option>
            <option value="3"><?php echo $this->lang->line('display_type_3'); ?></option>
        </select>
        </td>
    </tr>
	<tr>
    	<td colspan="2" style="font-size:13px; font-weight:bold;"><strong>Select Date:</strong></td>
    </tr>
    <tr>
        <td><span>From :</span><br/>
            <input id="date_from" name="date_from" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly" > <span id="err_from" style="color:red"></span>  
        </td>
        <td><span>To :</span><br/>
        	<input id="date_to" name="date_to" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly"><span id="err_to" style="color:red"></span>
        </td>
       
    </tr>
    <tr>
         <td><span id="err_rep" style="color:red;font-size:10px;"></span></td>
    </tr>
    
    <tr id="adv_search">
   <td style="color:#022157; font-size:14px; font-weight:bold;" colspan="2" align="center"><a href="javascript:void(0);" onclick="show_hide_tr();">Advance Search&raquo;</a></td>
    </tr>
</table>
        
        <table width="100%" id="show_hide" class="common-tabl" style="display:none;">

    </div>

    <tr>
        <td style=" width:250px;">
            <select name="service" id="service" >
                <option value="">All Services</option>
                <?php foreach($service_list as $service) { ?>
                <option value="<?php echo $service['service_id']; ?>"><?php echo $service['service_name']; ?></option>
                <?php } ?>
            </select>
        </td>
        <td width="2">
            <select name="staff" id="staff" >
                <option value="">All Staffs</option>
                <?php foreach($staff_list as $staff) { ?>
                <option value="<?php echo $staff['employee_id']; ?>"><?php echo $staff['employee_name']; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <select name="status" id="status" style="margin:8px 0 0 0;">
                <option value="">All Appointments</option>
                <option value="1">Paid</option>
                <option value="2">Not Paid</option>
                <option value="3">Approved</option>
                <option value="4">Unapproved</option>
                <option value="5">Failed</option>
                <option value="6">Canceled</option>
                <option value="7">Not Canceled</option>
            </select>
        </td>
        <td><input type="text" name="username" id="username" value="Client Username" onfocus="focusit();" onblur="blurit();"   style="margin:8px 0 0 0;"/></td>
    </tr>
    <tr>
   <td style="color:#022157; font-size:14px; font-weight:bold;"  colspan="2" align="center"><a href="javascript:void(0);" onclick="hide_show_tr();">Basic Search&raquo;</a></td>
    </tr>
</table>
<table width="100%">
    <tr>
    	<td colspan="2" align="center"><input type="button" class="btn-blue" name="search" id="search" value="Search" onclick="serach_appointment()"  style=" padding:7px 18px;"/></td>
    </tr>
</table>
</form>



</div>

    <div id="show_result">
    </div>