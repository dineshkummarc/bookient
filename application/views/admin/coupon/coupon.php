
<?php include('coupon.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('heading_main')); ?> </h1>

<table width="25%" style="margin-left:42px;margin-top:10px;padding:10px 0px 10px 10px;text-align:left;" >
<tr>
<td><input type="button" name="button1" id="button1" value="<?php echo $this->global_mod->db_parse($this->lang->line('discount_button')); ?>" class="rounded-corners-button-disc" style="cursor:pointer"/></td>
<td><input type="button" name="button2" id="button2" value="<?php echo $this->global_mod->db_parse($this->lang->line('offer_button')); ?>" class="rounded-corners-button-offer" style="cursor:pointer" /></td>
<td></td>
</tr>
</table>

<div id="cover">
<div style="width:36%; float:left;margin-left:42px; ">
<form name="f1" id="f1" method="post" action="<?php echo base_url(); ?>admin/coupon/AddCoupon/">
    <div id="discountcoupontable" class="discount-form">
<table align="left">
<tr><td colspan="3" align="left"><strong class="discount-coupon-head"><?php echo $this->global_mod->db_parse($this->lang->line('coupon_code'));?></strong></td></tr>

<tr><td colspan="3" align="left" id="msg"></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('couponcode_title'));?><strong> : </strong></td>
<td align="left" colspan="2">
<input name="coupon_code" id="coupon_code" type="text" value="" class="text-input-Coupon required" readonly="readonly" style="font-size:12px; height:17px;">
</td>
</tr>


<tr><td colspan="3" align="left"><strong class="discount-coupon-head"><?php echo $this->global_mod->db_parse($this->lang->line('coupon_details'));?></strong></td></tr>
<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('discount'));?><strong> : </strong></td>
<td align="left">
<input name="discount_amnt" id="discount_amnt" type="text" value="" class="text-input-Coupon required" onkeyup="displayDiscount(this.value)">
</td>
<td>
<select id="discount_amnt_setting" name="discount_amnt_setting" style="display: inline; height:22px; margin:-2px 0 0 0"  onchange="displaypercentage(this.value)">
    <option style="display: block;" value="1">%</option>
    <option style="display: block;" value="2"><?php echo $this->session->userdata('local_admin_currency_type'); ?></option>
</select>
<span id="cd_err"></span>
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('coupon_heading'));?><strong> : </strong></td>
<td align="left" colspan="2">
<input name="coupon_heading" id="coupon_heading" type="text" value="" class="text-input-Coupon required" onkeyup="displayTextHeadingDiscount(this.value)">
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('description'));?><strong> : </strong></td>
<td align="left" colspan="2">
<textarea name="coupon_desc" id="coupon_desc" class="text-input-Coupon-txtAra" ></textarea>
</td>
</tr>

<tr>
<td><?php echo $this->lang->line('image_url');?><strong> : </strong></td>
<td align="left" colspan="2">
<input name="coupon_img_url" id="coupon_img_url" type="text" value="" class="text-input-Coupon">
</td>
</tr>
<tr><td colspan="3" align="left" style="color:#666; font-size:10px;">
<?php echo $this->global_mod->db_parse($this->lang->line('notice_1'));?>
</td></tr>

<tr><td colspan="3" align="left"><strong class="discount-coupon-head"><?php echo $this->global_mod->db_parse($this->lang->line('couponterms'));?></strong></td></tr>
<tr>
	<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('auto_promotion'));?><strong> : </strong></td>
	
	<td colspan="2">
		<input type="radio" name="autopromo_radio" id="radio_ys" value="1" onchange="ChangeTerms('terms_details_tbl')" />&nbsp;<strong><?php echo $this->lang->line('yes'); ?></strong>
		<input type="radio" name="autopromo_radio" id="radio_no" value="0" checked="" onchange="ChangeTerms('terms_details_tbl')" />&nbsp;<strong><?php echo $this->lang->line('no');?></strong>
	</td>
</tr>
</table>
<table align="left" id="terms_details_tbl">
<tr>
<td><?php echo $this->lang->line('works_over');?> &nbsp;(<?php echo $this->session->userdata('local_admin_currency_type'); ?>)</td>
<td align="center"><strong>:</strong></td>
<td align="left">
<input name="coupon_works_over" id="coupon_works_over" type="text" value="" class="text-input-Coupon" onkeyup="worksover(this.value)">
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('for'));?></td>
<td>:</td>
<td align="left">
<div class="input-text" id="showdiv" onmouseover="showService()" onmouseout="hideService();" ><?php echo $this->global_mod->db_parse($this->lang->line('any_service'));?></div>

<?php  if(isset($category)) { ?>
<div style="position:relative" onmouseover="showService();" onmouseout="hideService();"  >
    <div id="hidediv" style="position:absolute;"   >
    <ul id="serviceUl" >
            <?php $servCounter = 0;?>
            <?php
            foreach($category as $key=>$category_item) {
                foreach($category_item['child'] as $k=>$v) { ?>
                <?php $servCounter++;?>
                    <li><input type='checkbox' name="applicbl_services_for_<?php echo $servCounter;?>" id="applicbl_services_for_<?php echo $v['service_id']; ?>"
                    class='checkbox'  value="<?php echo $v['service_id']; ?>"  onclick="displayServices()"> <?php echo $v['service_name']; ?> </li>
                <?php
                }
            }
            ?>
        </ul>
        <input type="hidden" name="serviceUlCounter" id="serviceUlCounter" value="<?php echo $servCounter;?>" />
    </div>
</div><?php  } ?>
    </td>
</tr>
<tr> <td>&nbsp; </td> <td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank'));?></td> </tr>
<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('by'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
	<div class="input-text" id="showstaffdiscount" onmouseover="showstaff()" onmouseout="hidestaff();" ><?php echo $this->global_mod->db_parse($this->lang->line('any_staff'));?></div>
	<?php  if(count($staff) > 0) { ?>
	<div style="position:relative" onmouseover="showstaff();" onmouseout="hidestaff();"  >
    <div id="hidestaffdiscount" style="position:absolute;"  >
	<ul id="aplcbl_empUl">
    <?php $empCounter = 0;
	?>
	<?php foreach($staff as $staff_item):?>
    <?php $empCounter++;?>
    <li>
    <input type="checkbox" class="staff_checkbox" id="aplcbl_emp_<?php echo $staff_item['employee_id'];?>" name="aplcbl_emp_<?php echo $empCounter;?>"  onclick="displayStaff()"
    value="<?php echo $staff_item['employee_id'];?>"  /> &nbsp; <?php echo $staff_item['employee_name'];?>
    </li>
    <?php endforeach ?>
    </ul>
    <input type="hidden" name="empUlCounter" id="empUlCounter" value="<?php echo $empCounter;?>" />
		</div>
        </div>
		<?php  } ?>
</td>
</tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_1'));?></td></tr>
<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('from'));?></td>

<td align="center"><strong>:</strong></td>
<td align="left" colspan="3">
<input type="text" id="aplcbl_date_from" name="aplcbl_date_from" value="" class="text-input-Coupon-DtPikr datevali"  onblur="showstartdate()" />
<?php echo $this->global_mod->db_parse($this->lang->line('to'));?> :  <input type="text" id="aplcbl_date_to" name="aplcbl_date_to" value="" class="text-input-Coupon-DtPikr datevali" onblur="showenddate()"/>
</td>
</tr>
<tr><td>&nbsp; </td><td colspan="2" align="left" style="color:#666; font-size:8px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_2'));?></td></tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; padding:0 0 0 19px;"><span id="err_c" style="color: #f00;font-size:10px;"></span></td></tr>
<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('between'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
 <input type="text" id="aplcbl_hour_from" name="aplcbl_hour_from" value="" class="text-input-Coupon-DtPikr timevali" onblur="showstarttime()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="text" id="aplcbl_hour_to" name="aplcbl_hour_to" value="" class="text-input-Coupon-DtPikr timevali" onblur="showendtime()"/>
 <br/><span id="err_tim" style="color: #f00; font-size:10px;"></span>
</td>
</tr>

<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_3'));?></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('on'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">

<div class="input-text" id="showdatediscount" onmouseover="showdate()" onmouseout="hidedate();" ><?php echo $this->global_mod->db_parse($this->lang->line('any_date'));?></div>

<div style="position:relative" onmouseover="showdate();" onmouseout="hidedate();"  >
<div id="hidedatediscount" style="position:absolute;" >

<ul id="aplcbl_days_on_weekUl">
<li><input type="checkbox" name="aplcbl_days_on_week_1" id="aplcbl_days_on_week_1" value="1" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('sunday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_2" id="aplcbl_days_on_week_2" value="2" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('monday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_3" id="aplcbl_days_on_week_3" value="3" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('tuesday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_4" id="aplcbl_days_on_week_4" value="4" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('wednesday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_5" id="aplcbl_days_on_week_5" value="5" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('thursday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_6" id="aplcbl_days_on_week_6" value="6" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('friday');?></li>
<li><input type="checkbox" name="aplcbl_days_on_week_7" id="aplcbl_days_on_week_7" value="7" onclick="displayDate()" class="date_checkbox" /><?php echo $this->lang->line('saturday');?></li>
</ul>

</div>
</div>

</td>
</tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_4'));?></td></tr>

<tr><td colspan="3" align="left">
<input type="checkbox" name="first_time_use_only" id="first_time_use_only" value="1" onclick="firsttimeuse()">
<?php echo $this->global_mod->db_parse($this->lang->line('valid_1'));?>
</td></tr>

<tr><td colspan="3" align="left">
<input type="checkbox" name="one_time_use_only" id="one_time_use_only" value="1" onclick="onetimeuse()">
<?php echo $this->global_mod->db_parse($this->lang->line('valid_2'));?>
</td></tr>

<tr><td colspan="3" align="left">
<?php echo $this->global_mod->db_parse($this->lang->line('first'));?>
<input type="text" id="no_of_booking_possible" name="no_of_booking_possible" value="0" class="text-input-Coupon-DtPikr"/>
<?php echo $this->global_mod->db_parse($this->lang->line('bookings'));?>
</td></tr>
</table>
<table align="left">
<tr><td></td><td colspan="2" align="left"><br />

<input type="button" name="submit_coupon" id="submit_coupon"  class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('savecoupon'));?>" />
<input type="hidden" name="submit_coupon_mode" id="submit_coupon_mode" value="add"/>
<input type="hidden" name="coupon_id" id="coupon_id" value=""/>
<input type="button" name="cancel_discount" id="cancel_discount" class="btn-gray" value="<?php echo $this->global_mod->db_parse($this->lang->line('cancel'));?>" onclick="hideCreateDiscount()" />
</td></tr>
</table>
    <div class="spacer"></div>
</div>
    
<input type="hidden" name="coupon_type" id="coupon_type" value="1" />
</form>

<form name="f2" id="f2" method="post" action="<?php echo base_url(); ?>admin/coupon/AddCoupon/">
    <div id="offertable" class="offer-form">
<table align="left"  >
<tr><td colspan="3" align="left"><strong class="offer-coup-head"><?php echo $this->global_mod->db_parse($this->lang->line('offer_coupon'));?></strong></td></tr>

<tr><td colspan="3" align="left" id="msg_o"></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('couponcode_title_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
<input name="coupon_code" id="coupon_code_o" type="text" value="" readonly="readonly" class="text-input-Coupon required" >
</td>
</tr>

<tr><td colspan="3" align="left"><strong class="offer-coup-head"><?php echo $this->global_mod->db_parse($this->lang->line('coupon_details_o'));?></strong></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('coupon_heading_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
<input name="coupon_heading" id="coupon_heading" type="text" value="" class="text-input-Coupon required" onkeyup="displayTextHeadingDiscount(this.value)"  >
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('description_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
<textarea name="coupon_desc" id="coupon_desc" class="text-input-Coupon-txtAra required"></textarea>
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('image_url_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
<input name="coupon_img_url" id="coupon_img_url" type="text" value="" class="text-input-Coupon">
</td>
</tr>
<tr><td colspan="3" align="left" style="color:#666; font-size:10px;">
 <?php echo $this->global_mod->db_parse($this->lang->line('notice_1_o'));?>
</td></tr>
<tr><td colspan="3" align="left"><strong class="offer-coup-head"><?php echo $this->global_mod->db_parse($this->lang->line('couponterms_o'));?> </strong></td></tr>

<tr>
	<td align="left">Auto Promotion<strong> : </strong></td>
	
	<td>
		<input type="radio" name="autopromo_radio" id="radio_ys_discount" value="1" onchange="ChangeTermsDiscount('terms_details_ofr_tbl')" />&nbsp;<strong>Yes</strong>
		<input type="radio" name="autopromo_radio" id="radio_no_discount" value="0" checked="" onchange="ChangeTermsDiscount('terms_details_ofr_tbl')" />&nbsp;<strong>No</strong>
	</td>
</tr>
</table>
<table align="left" id="terms_details_ofr_tbl">
<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('works_over_o'));?> &nbsp;(<?php echo $this->session->userdata('local_admin_currency_type'); ?>)</td>
<td align="center"><strong>:</strong></td>
<td align="left">
<input name="coupon_works_over" id="coupon_works_over" type="text" value="" class="text-input-Coupon" onkeyup="worksover(this.value)">
</td>
</tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('for_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">

<div class="input-text" id="showdivoffer" onmouseover="showServiceoffer()" onmouseout="hideServiceoffer();" ><?php echo $this->global_mod->db_parse($this->lang->line('any_service_o'));?></div>

<?php  if(isset($category)) { ?>

<div style="position:relative" onmouseover="showServiceoffer();" onmouseout="hideServiceoffer();"  >
    <div id="hidedivoffer" style="position:absolute;">

<ul id="serviceUl">
    	<?php $servCounter = 0;?>
		<?php
		foreach($category as $key=>$category_item) {
			foreach($category_item['child'] as $k=>$v) { ?>
            <?php $servCounter++;?>
				<li><input type='checkbox' name="applicbl_services_for_<?php echo $servCounter;?>" id="applicbl_services_for_<?php echo $v['service_id']; ?>"
                class='checkbox_offer'  value="<?php echo $v['service_id']; ?>" onclick="displayServicesoffer()"  > <?php echo $v['service_name']; ?> </li>
			<?php
			}
		}
		?>
	</ul>

    <input type="hidden" name="serviceUlCounter" id="serviceUlCounter" value="<?php echo $servCounter;?>" />

    </div>

    </div>
<?php  } ?>
</td>
</tr>
<tr> <td>&nbsp; </td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_o'));?></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('by_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">

<div class="input-text" id="showstaffoffer" onmouseover="showstaffoffer()" onmouseout="hidestaffoffer();" ><?php echo $this->global_mod->db_parse($this->lang->line('any_staff_o'));?></div>
	<?php  if(count($staff) > 0) { ?>
	<div style="position:relative" onmouseover="showstaffoffer();" onmouseout="hidestaffoffer();"  >
    <div id="hidestaffoffer" style="position:absolute;" >

<ul id="aplcbl_empUl">
    <?php $empCounter = 0;?>
	<?php foreach($staff as $staff_item):?>
    <?php $empCounter++;?>
    <li>
    <input type="checkbox" id="aplcbl_emp_<?php echo $staff_item['employee_id'];?>" name="aplcbl_emp_<?php echo $empCounter;?>"  onclick="displayStaffoffer()" class="staff_checkbox_offer"
    value="<?php echo $staff_item['employee_id'];?>" /> &nbsp; <?php echo $staff_item['employee_name'];?>
    </li>
    <?php endforeach ?>
    </ul>
    <input type="hidden" name="empUlCounter" id="empUlCounter" value="<?php echo $empCounter;?>" />
    </div>
    </div>
    <?php  } ?>
</td>
</tr>
<tr><td>&nbsp; </td><td colspan="2" align="left" style="color:#666; font-size:10px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_1_o'));?></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('from_o'));?></td>

<td align="center"><strong>:</strong></td>
<td align="left" colspan="3">
<input type="text" id="aplcbl_date_from_offer" name="aplcbl_date_from" value="" class="text-input-Coupon-DtPikr datevalioffer" onblur="showstartofferdate()" />
<?php echo $this->global_mod->db_parse($this->lang->line('to_o'));?> :  <input type="text" id="aplcbl_date_to_offer" name="aplcbl_date_to" value="" class="text-input-Coupon-DtPikr datevalioffer" onblur="showendofferdate()"/>
</td>
</tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_2_o'));?></td></tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; padding:0 0 0 19px;"><span id="err_c_offer" style="color: #f00;font-size:10px;"></span></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('between_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
 <input type="text" id="aplcbl_hour_from_offer" name="aplcbl_hour_from" value="" class="text-input-Coupon-DtPikr timevalioffer"  onblur="showstartoffertime()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="text" id="aplcbl_hour_to_offer" name="aplcbl_hour_to" value="" class="text-input-Coupon-DtPikr timevalioffer" onblur="showendoffertime()"/><br />
 <span id="err_tim_offer" style="color: #f00; font-size:10px;"></span>
</td>
</tr>
<tr><td>&nbsp;</td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px;"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_3_o'));?></td></tr>

<tr>
<td><?php echo $this->global_mod->db_parse($this->lang->line('on_o'));?></td>
<td align="center"><strong>:</strong></td>
<td align="left">
<div class="input-text" id="showdateoffer" onmouseover="showdateoffer()" onmouseout="hidedateoffer();"><?php echo $this->global_mod->db_parse($this->lang->line('any_date_o'));?></div>

	<div style="position:relative" onmouseover="showdateoffer();" onmouseout="hidedateoffer();"  >
    <div id="hidedateoffer" style="position:absolute;" >

<input type="checkbox" name="aplcbl_days_on_week_1" id="aplcbl_days_on_week_1" value="1"  onclick="displayDateoffer()" class="date_checkbox_offer"/><?php echo $this->lang->line('sunday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_2" id="aplcbl_days_on_week_2" value="2" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('monday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_3" id="aplcbl_days_on_week_3" value="3" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('tuesday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_4" id="aplcbl_days_on_week_4" value="4" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('wednesday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_5" id="aplcbl_days_on_week_5" value="5" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('thursday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_6" id="aplcbl_days_on_week_6" value="6" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('friday_o');?><br />
<input type="checkbox" name="aplcbl_days_on_week_7" id="aplcbl_days_on_week_7" value="7" onclick="displayDateoffer()" class="date_checkbox_offer" /><?php echo $this->lang->line('saturday_o');?><br />

</div>
</div>

</td>
</tr>
<tr><td>&nbsp; </td><td colspan="2" align="left" style="color:#666; font-size:10px; padding:0 0 0 19px"><?php echo $this->global_mod->db_parse($this->lang->line('leave_blank_4_o'));?></td></tr>

<tr><td colspan="3" align="left">
<input type="checkbox" name="first_time_use_only_offer" id="first_time_use_only_offer" value="1" onclick="firsttimeuseoffer()">
<?php echo $this->global_mod->db_parse($this->lang->line('valid_1_o'));?>
</td></tr>

<tr><td colspan="3" align="left">
<input type="checkbox" name="one_time_use_only_offer" id="one_time_use_only_offer" value="1" onclick="onetimeuseoffer()">
<?php echo $this->global_mod->db_parse($this->lang->line('valid_2_o'));?>
</td></tr>

<tr><td colspan="3" align="left">
<?php echo $this->global_mod->db_parse($this->lang->line('first_o'));?>
<input type="text" id="no_of_booking_possible" name="no_of_booking_possible" value="0" class="text-input-Coupon-DtPikr"/>
<?php echo $this->global_mod->db_parse($this->lang->line('bookings_o'));?>
</td></tr>
</table>
<table align="left">
<tr><td></td><td colspan="2" align="left">
<input type="submit" name="submit_offer" id="submit_offer" mode="add" class="rounded-corners-coupon-offer" value="<?php echo $this->global_mod->db_parse($this->lang->line('saveoffer_o'));?>" />
<input type="hidden" name="submit_offer_mode" id="submit_offer_mode" value="add"/>
<input type="hidden" name="coupon_id" id="coupon_id" value=""/>
<input type="button" name="cancel_offer" id="cancel_offer" class="btn-gray" value="<?php echo $this->global_mod->db_parse($this->lang->line('cancel_o'));?>" onclick="hideCreateOffer()" />
</td></tr>
</table>
<div class="spacer"></div>
    </div>
        
<input type="hidden" name="coupon_type" id="coupon_type" value="2" />
</form>
</div>

<div id="discount_display_text" style="width:50%; float:left; margin:1% 0 0 5%">

<div class="DiscountCouponarea">
    <div class="coupon-preview">
        <?php echo $this->global_mod->db_parse($this->lang->line('preview'));?>
    </div>
    <div class="DiscountCouponData">
        <div class="mainDiscPopup">
            <div class="mainDiscPopupHd">
                <div class="mainDiscPopupHdAmout">
                    <span id="display_heading"></span>
                </div>
                <div class="mainDiscPopupHdAddr">
			<?php
			$b_loc =($business_address['business_location'] != '') ? $business_address['business_location'].', ' : $business_address['business_location'];
			$b_city = ($business_address['business_city_id'] != '') ? $business_address['business_city_id'].', ' : $business_address['business_city_id'];
			$b_region = ($business_address['region_name'] != '') ? $business_address['region_name'].',' : $business_address['region_name'];
			$b_zipcode = ($business_address['business_zip_code'] != '') ? ' ('.$business_address['business_zip_code'].')' : $business_address['business_zip_code'];
            echo $b_loc.$b_city.$b_region.$b_zipcode;  
            ?>
				</div>
            </div>
            <div class="mainDiscPopupDisc">
                <div class="mainDiscPopupDiscLeftImg">
                    <img width="133px" id="discImgTemplayout" src="<?php echo base_url();?>images/ftd_nice_day.jpg" />
                </div>
                <div class="mainDiscPopupDiscLeft">
                <ul>
                <li> <span id="discount_percent_type_rs"></span><span id="discount_percent"></span> <span id="discount_percent_type"></span> &nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('listing_bulleton'));?> <span id="showservice"><?php echo $this->global_mod->db_parse($this->lang->line('any_service'));?></span> <?php echo $this->global_mod->db_parse($this->lang->line('with'));?> <span id="showstaff"><?php echo $this->global_mod->db_parse($this->lang->line('any_staff'));?></span></li>
				<li> <?php echo $this->global_mod->db_parse($this->lang->line('works_on'));?><span id="showWeekday"> <?php echo $this->global_mod->db_parse($this->lang->line('any_day'));?></span> <span id="showstartdate"><?php echo $this->global_mod->db_parse($this->lang->line('from_any_day'));?></span> <span id="showenddate"><?php echo $this->global_mod->db_parse($this->lang->line('to_any_day'));?></span> <span id="showstarttime"> <?php echo $this->global_mod->db_parse($this->lang->line('between_any_time'));?> </span> <span id="showendtime"><?php echo $this->global_mod->db_parse($this->lang->line('and_any_time'));?></span></li>
                <li id="firsttimeli" style="display:none"> <span id="firsttime"></span></li>
                <li id="onetimeli" style="display:none"> <span id="onettime"></span></li>
                <!--<li>Redeemable over <span id="enddate"></span></li> -->

				<span id="enddate"></span>
                </ul>
                </div>
                <div class="mainDiscPopupDiscRight">
                    <div class="bookNowBtImgBox">
                        <a href="javascript:void(0)"><?php echo $this->global_mod->db_parse($this->lang->line('schedule'));?> </a>
                        <div class="clear">
                        </div>
                    </div>

                </div>
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<span class="view-state">View:
<a id="idactive" href="javascript:void(0)" onclick="showactive()"><?php echo $this->lang->line('active_button'); ?></a> |
<a id="idinactive" href="javascript:void(0)" onclick="showInactive()"><?php echo $this->lang->line('inactive_button'); ?></a> |
<a id="idshowall" href="javascript:void(0)" onclick="showAll()"><?php echo $this->lang->line('all_button'); ?></a> |
<a id="idexpired" href="javascript:void(0)" onclick="showExpired()"><?php echo $this->lang->line('expired_button'); ?></a>
</span>
<!-- ---------Listing--------------------------->
<div id ="list_item_details" align="left" style="width:100%; height:100%; float:left;">

<?php foreach($allCoupon as $val) { ?>

<?php
$ClassControl = "";
$CurStatus = $val['status'];
$title ="";

$is_expired_val ="";
if($val['DateBetweenDisp']!= 'Any Dates '){
	$ddate = explode('upto',$val['DateBetweenDisp']);
	$ydate = date("Y-m-d", strtotime($ddate[1]));
	$now = mktime(0, 0, 0);
	$expires = strtotime($ydate);
    $curr = strtotime(date("Y-m-d"));
	if ( $now - $expires > 0){
		$is_expired_val = "ExpiredD";
	}else{
        if($now - $expires == 0) {
            //$timefmt ='From 05:00 upto 12:00';
            $timefmt = $val['TimeBetweenDisp'];
            $ss_time = explode('From',$timefmt);
            $act_time = explode('upto',$ss_time[1]);
            if($act_time[1] != 0){
                $endt_ime = explode(':',$act_time[1]);
                $endt_in_mins = $endt_ime[0]*60 + $endt_ime[1];

                $local_time = explode(':',date('H:i'));
                $curr_local_time_mins = $local_time[0]*60 + $local_time[1];
                if($endt_in_mins < $curr_local_time_mins) {
                    $is_expired_val = "ExpiredD";
                }else{
                    $is_expired_val = "";
                }
            }else{
                $is_expired_val = "";
            }
        }else{
		    $is_expired_val = "";
        }
	}
}

if($CurStatus == '1')
{
	$changedStatus = "0";
	$ClassControl = "ActiveD";
}
else
{
	$changedStatus = "1";
	$ClassControl = "InactiveD";
}
?>

<?php if($val['coupon_type'] == 1) {?>

<div class="blue-bg-coupon <?php echo $ClassControl?> <?php echo $is_expired_val ?>" <?php echo $CurStatus==1?'style="background-color:none; opacity:100;"':'style="background-color:#b9b9b8; opacity:0.4;"'; ?> id="coupDispDivId<?php echo $val['coupon_id']?>">

	<div class="coupon-code"><strong><?php echo $val['coupon_code'];?></strong></div>
 <div class="scroll-hide" id="coupDispscrollId<?php echo $val['coupon_id']?>"   <?php echo $CurStatus!=1?'style="overflow:hidden;"':''; ?>>
<table align="left" class="list-table" id="coupDispTblId<?php echo $val['coupon_id']?>">

<?php } else  { ?>

<div class="green-bg-coupon <?php echo $ClassControl?> <?php echo $is_expired_val ?>" <?php echo $CurStatus==1?'style="background-color:none; opacity:100;"':'style="background-color:#b9b9b8; opacity:0.4;"'; ?> id="coupDispDivId<?php echo $val['coupon_id']?>">
<div  class="coupon-code"><strong><?php echo $val['coupon_code'];?></strong></div>
 <div class="scroll-hide" id="coupDispscrollId<?php echo $val['coupon_id']?>" <?php echo $CurStatus!=1?'style="overflow:hidden;"':''; ?>>

<table align="left"  class="list-table"<?php //echo $CurStatus==1?'bgcolor="#00A5FF"':'bgcolor="#0065B7"'; ?>  id="coupDispTblId<?php echo $val['coupon_id']?>">
<?php } ?>

<tr>
<td style="font-size:16px;" colspan="3">
    <table width="100%">
    <?php ?><tr>
    <td width="70%">

    <?php if($val['coupon_type'] == 1) {?><span style="color:#3063A2"><?php echo $this->global_mod->db_parse($this->lang->line('coupon_code')); ?></span>
	<div class="coup-head"><?php echo $val['coupon_heading'];?></div>
	<?php
	} else  { ?><span style="color:#339D5B"><?php echo $this->lang->line('offer_coupon'); ?></span>
	<div class="offer-head"><?php echo $val['coupon_heading'];?></div>
	<?php } ?>
    <div class="des"><?php echo $val['coupon_desc'];?></div>
    </td>
    <td width="30%">
    <?php
    	$url=@getimagesize($val['coupon_img_url']);
    	if(!is_array($url)) {$ImgSrc = base_url().'images/coupons.png';}else{ $ImgSrc = $val['coupon_img_url'];}
    ?>
    <img src="<?php echo $ImgSrc?>" title="Coupon image" class="auto-width" />
    </td>
    </tr><?php ?>
    </table>
</td>
</tr>

<tr>
	<?php
        if($val['coupon_type'] == 1) {
            $discount_amnt 		   =  $val['discount_amnt'];
            $discount_amnt_setting =  $val['discount_amnt_setting'];
            if($discount_amnt_setting == 1) {$Setting = " %";}
			else {$Setting = $this->session->userdata('local_admin_currency_type');}

            $DisString =  $discount_amnt.$Setting.' off on';
        }
        else{
            $DisString =  "Offer on";
        }
    ?>
	<td align="left" colspan="3"> <div class="listing-bullet"><img src="<?php echo base_url();?>images/tick.png" /></div>
		<strong><?php echo $DisString; ?></strong>
        <strong><?php echo $val['CouponArrString'];?></strong><?php echo $this->global_mod->db_parse($this->lang->line('with')); ?>
        <strong><?php echo $val['EmployeesArrString'];?></strong>
        <?php echo $this->lang->line('for_any_client'); ?>
    </td>
</tr>
<tr>
	<td align="left" colspan="3"><div class="listing-bullet"><img src="<?php echo base_url();?>images/tick.png" /></div> <?php echo $this->global_mod->db_parse($this->lang->line('works_on')); ?>
        <strong><?php echo $val['WeekDaysDisp'];?></strong>
        <strong><?php echo $val['DateBetweenDisp'];?></strong>
        <strong><?php echo $val['TimeBetweenDisp'];?></strong> <br/><br/>
    </td>
</tr>

<?php if($val['first_time_use_only'] == 1){?>
<tr><td style="font-size:12px;" colspan="3" align="left"><div class="listing-bullet"> <img src="<?php echo base_url();?>images/tick.png" /></div> <?php echo $this->global_mod->db_parse($this->lang->line('valid_for_oneday')); ?></td></tr>
<?php } ?>
<?php if($val['one_time_use_only'] == 1){?>
<tr><td style="font-size:12px;" colspan="3" align="left"> <div class="listing-bullet"><img src="<?php echo base_url();?>images/tick.png" /></div> <?php echo $this->global_mod->db_parse($this->lang->line('valid_for_onetime')); ?></td></tr>
<?php } ?>
<?php if($val['no_of_booking_possible'] > 0){?>
<tr><td style="font-size:12px;" colspan="3" align="left"><div class="listing-bullet"> <img src="<?php echo base_url();?>images/tick.png" /></div><?php echo $this->global_mod->db_parse($this->lang->line('coupon_used_for_first')); ?>  <strong><?php echo $val['no_of_booking_possible'];?></strong> <?php echo $this->lang->line('booking_sml'); ?></td></tr>
<?php } ?>


</table>
&nbsp;&nbsp;&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('created_on')); ?> &nbsp;
<span>
<?php
echo date("F d,Y", strtotime($val['date_of_creation']));
?>
</span>
</div>
<div style="margin:8px 0 0 0; width:317px; position:relative;">
<div style=" float: left;">
	<img style="cursor: pointer;" onclick="shareFacebook('<?php echo $val['coupon_id']?>','<?php echo $val['coupon_type']?>')" width="22px" height="22px" title="Share with facebook" src="<?php echo base_url();?>images/facebook.png" />
	<img style="cursor: pointer;" onclick="shareTwitter('<?php echo $val['coupon_id']?>','<?php echo $val['coupon_type']?>')" width="22px" height="22px" title="Share with twitter" src="<?php echo base_url();?>images/twitter.png" />
</div>
<div style=" float: right;"> 	
<a href="javascript:void(0);" onclick="editCoupon('<?php echo $val['coupon_id']?>','<?php echo $val['coupon_type']?>');" >
<img height="21px" width="21px" src="<?php echo base_url();?>images/edit-icon.png"  title="Edit" /></a>


<?php 
if($val['coupon_type'] == 1) {
?>
	<a href="javascript:void(0);">
    <img  title="Inctive" src="<?php echo base_url();?>images/rr.png" id="off<?php echo $val['coupon_id']?>"  <?php if($CurStatus == 1){?>style="display:none;"<?php } ?> onclick="change_status_to_on('<?php echo $val['coupon_id'];?>',this.id);" />
    </a>

    <a href="javascript:void(0);">
    <img title="Active" src="<?php echo base_url();?>images/gg.png" id="on<?php echo $val['coupon_id']?>" <?php if($CurStatus == 0){?>style="display:none;"<?php } ?> onclick="change_status_to_off('<?php echo $val['coupon_id'];?>',this.id);"/>
	</a>

<?php
}else{
?>
    <a href="javascript:void(0);">
    <img title="Inctive" src="<?php echo base_url();?>images/rr.png" id="off<?php echo $val['coupon_id']?>"  <?php if($CurStatus == 1){?>style="display:none;"<?php } ?> onclick="change_status_to_on_offer('<?php echo $val['coupon_id'];?>',this.id);" />
	</a>

    <a href="javascript:void(0);">
    <img title="Active" src="<?php echo base_url();?>images/gg.png"  id="on<?php echo $val['coupon_id']?>" <?php if($CurStatus == 0){?>style="display:none;"<?php } ?> onclick="change_status_to_off_offer('<?php echo $val['coupon_id'];?>',this.id);"/>
	</a>
<?php
}
?>

<a href="javascript:void(0);" onclick="DeleteCoupon('<?php echo $val['coupon_id']?>');" >
<img src="<?php echo base_url();?>images/couponcross.png"  title="Delete" /></a>


</div>

</div>
</div>

<?php }  ?>
<div id="norecords_for_active" style=" display:none; margin: 12px 20px 3px 15px; background-color: #CCFFFF; padding: 8px; border: 1px dashed rgb(254, 191, 2);"><?php echo $this->global_mod->db_parse($this->lang->line('no_active_dis_coupon_found')); ?></div>
<div id="norecords_for_inactive" style="display:none; margin: 12px 20px 3px 15px; background-color: #CCFFFF; padding: 8px; border: 1px dashed rgb(254, 191, 2);"><?php echo $this->global_mod->db_parse($this->lang->line('no_inactive_coupon_found')); ?></div>
<div id="norecords_for_all" style="display:none; margin: 12px 20px 3px 15px; background-color: #CCFFFF; padding: 8px; border: 1px dashed rgb(254, 191, 2);"><?php echo $this->global_mod->db_parse($this->lang->line('no_dis_coupon_found')); ?></div>
<div id="norecords_for_expired" style="display:none; margin: 12px 20px 3px 15px; background-color: #CCFFFF; padding: 8px; border: 1px dashed rgb(254, 191, 2);"><?php echo $this->global_mod->db_parse($this->lang->line('no_expired_dis_coupon_found')); ?></div>
</div>

</div>



