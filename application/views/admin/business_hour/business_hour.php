<?php include('business_hour.js.php'); ?>
<?php
if($current_id !=''){
?>
<script>	
	$(document).ready(function() { 
		var current_id= '<?php echo $current_id ?>';
		showStaffHourDetails(current_id);
	})
</script>
<?php
}
?>
<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->lang->line('headign-main'); ?></h1>

<div class="inner-div">

<table width="99%" cellspacing="0" cellpadding="0">
<tbody><tr>
<td><div align="left"><?php echo $this->lang->line('business_hour_des'); ?></div></td>
<td width="30%" align="right"><!--div align="right"><a href="">Need help?</a></div--></td>
</tr>
</tbody></table>

</div>

<div class="padding-adjust">

<a href="javascript:void(0)"><span id="update_text" onclick="show_service()" class="add-customer"><?php echo $this->lang->line('busi_update');?></span></a>

<div  id="details_div" style="width:98%; padding:0 0 0 2%;display:none; border:1px solid #cccccc; border-radius:5px; margin-bottom:10px;">

<form id="form-biz-hour" name="form-biz-hour" action="<?php echo base_url(); ?>admin/business_hour/add-biz-hour/" method="post" enctype="multipart/form-data">
<table id="details" align="center" border="0" style="display:none;" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td colspan="2" style="background-color:#F2F2F2;"><div class="heading" style=" margin-top:-4px; margin-left:-2.1%"><?php echo $this->lang->line('busi_pls_select');?> <strong><?php echo $this->lang->line('busi_services');?></strong> <?php echo $this->lang->line('busi_tobperform');?></div></td>
    </tr>
    <tr>
    <td colspan="2" align="center" >
    <span id="suss_msg" style="color:#093;font-size:20px;"></span>
    </td>
    </tr>
	<tr>
		<td valign="top" width="50%">
        
        	<div class="business-hr-blue-bg">
            
                    <table width="100%">
                        <tr>
                            <th>
                            <h3>
                            <input id="super" type="checkbox" onchange="toggleChecked()" />
                            ::<?php echo $this->lang->line('busi_service');?>::
							<span id="servicemsg"></span>
                            </h3>
                            </th>
                        </tr>
                        <tr>
                            <td>
                            <div class="business-hr-depen-scroll">
                            <?php if(isset($category)){?>
                                <ul id="services" onclick="serviceResetMsg();">                                   
                                    <?php
                                    foreach($category as $key=>$category_item)
                                    {
                                        echo "<li>
                                        <input type='checkbox' class='checkbox all' value=''> ".$category_item['name']."<ul>";
                                        foreach($category_item['child'] as $k=>$v)
                                        {
                                            echo "<li> &nbsp; &nbsp; <input type='checkbox' class='checkbox children' value='".$v['service_id']."'> ".$v['service_name']."</li>";
                                        }
                                        echo "</ul></li>";
                                    }
                                    ?>
                                </ul>
                                <?php } ?>
                                
                                </div>
                                
                            </td>
                        </tr>
                     </table>
                     
                     </div>
		</td>
		<td valign="top" width="50%">
        	<div class="business-hr-blue-bg">
                <table width="100%">
                        <tr>
                            <th><h3>::<?php echo $this->lang->line('busi_staff');?>:: <span id="staffmsg"></span></h3></th>
                        </tr>
                        <tr>
                            <td>
                            <div class="business-hr-depen-scroll">
                            
                            <ul id="staff" onclick="staffResetMsg();">
                               
				<?php foreach($staff as $staff_item):?>
                                <li>
                                <input type="checkbox" id="staff_<?php echo $staff_item['employee_id'];?>" name="staff_<?php echo $staff_item['employee_id'];?>" 
                                value="<?php echo $staff_item['employee_id'];?>" /> &nbsp;
                                <?php echo $staff_item['employee_name'];?>
                                </li>
                                <?php endforeach ?>
                                
                            </ul>
                            
                            </div>
                            </td>
                        </tr>
                 </table>
            </div>
		</td>
	</tr>
	<tr>
        <td valign="top" colspan="2" align="center">
        	<div class="business-hr-blue-bg-border">
                <table>
	                <tr>
						<th>::<?php echo $this->lang->line('busi_day');?>::</th>
					</tr>
	                <tr>
		                <td>
			                <ul id="days" onclick="daysResetMsg();">
							<li>
				                <input type="checkbox" name="mon" id="mon" value="1"/> <?php echo $this->lang->line('busi_monday');?>&nbsp;&nbsp;&nbsp;  
				                <input type="checkbox" name="tue" id="tue" value="2"/> <?php echo $this->lang->line('busi_tuesday');?>&nbsp;&nbsp;&nbsp;  
				                <input type="checkbox" name="wed" id="wed" value="3"/> <?php echo $this->lang->line('busi_wedday');?>&nbsp;&nbsp;&nbsp;   
				                <input type="checkbox" name="thu" id="thu" value="4"/> <?php echo $this->lang->line('busi_thrusday');?>&nbsp;&nbsp;&nbsp;  
				                <input type="checkbox" name="fri" id="fri" value="5"/> <?php echo $this->lang->line('busi_friday');?>&nbsp;&nbsp;&nbsp;  
				                <input type="checkbox" name="sat" id="sat" value="6"/> <?php echo $this->lang->line('busi_satday');?>&nbsp;&nbsp;&nbsp; 
				                <input type="checkbox" name="sun" id="sun" value="7"/> <?php echo $this->lang->line('busi_sunday');?>&nbsp;&nbsp;&nbsp;
			                </li>
							<li id="daysmsg"></li>
							</ul>                           
		                </td>
	                </tr>
                </table>       
            </div>
        </td>
	</tr>
    <tr>
    <td colspan="2" align="center">
    <div class="business-hr-blue-bg-border">
		<div id="err-dt-st-end"></div>
        <table id="expense_table">
		<tr>
			<th colspan="10" align="center">:: <?php echo $this->lang->line('busi_time');?> ::</th>
		</tr>
        <tr id="trId_1">
			<td>
				&nbsp;<lable style="font-size: 13px;font-weight: bold;">1.</lable>&nbsp;
			</td>
	        <td>
				<?php echo $this->lang->line('busi_time_from');?>
			</td>
	        <td>
				&nbsp;:&nbsp;
			</td>
	        <td>
				<input type="text" id="timepickerFrom_1" name="timepickerFrom_1" value="" class="text-input-bizhours pickTime required"/>
			</td>
	        <td>
				<?php echo $this->lang->line('busi_time_to');?>
			</td>
	        <td>
				&nbsp;:&nbsp;
			</td>
	        <td>
				<input type="text" id="timepickerTo_1" name="timepickerTo_1" value="" class="text-input-bizhours pickTime required"/>
			</td>
			<td>
				&nbsp;
			</td>
        </tr>
        </table>
		</form> 
		<div style="float: left; cursor: pointer; padding:0 0 30px 250px;" onclick="addTime()">
			<img src="<?php echo base_url(); ?>/asset/addtime.png"/>
			<lable style="font-size: 13px;font-weight: bold;"><?php echo $this->lang->line('busi_add_time');?></lable>
		</div>
        </div>
    </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <button class="btn-blue" type="button" name="btn_biz_hour" id="btn_biz_hour" value="Add" ><?php echo $this->lang->line('busi_add_busi_hour');?></button>
        <input class="business-hr-btn-gray" type="button" onclick="close_service()" value="<?php echo $this->lang->line('busi_cancelbtn');?>" name="cancel">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">&nbsp;</td>
    </tr>
</table>
</div>
<div class="business-hr-blue-bg-border" style="margin: 0 17px 0 22px;">

<table cellpadding="0" cellspacing="0" width="100%">
<?php $Counter = 0; ?>
<?php foreach($staff as $staff_item):?>
<?php $Counter++; ?>
<tr >
    <td align="left">
        <a href="javascript:void(0);" style="float:left; text-decoration:none">
        <!--  onblur="hideStaffHourDetails('<?php //echo $staff_item['employee_id'];?>')"-->
        
            <span id="arrowright<?php echo $staff_item['employee_id'];?>" class="right-arrow" onclick="showStaffHourDetails('<?php echo $staff_item['employee_id'];?>','<?php echo $staff_item['employee_name'];?>');">
				<?php echo $Counter;?>&nbsp;<?php echo $staff_item['employee_name'];?><?php echo $this->lang->line('busi_name_busi_hour');?> <span class="right-arrow-spn"></span>
            </span>
            <span id="arrowdown<?php echo $staff_item['employee_id'];?>" class="down-arrow" onclick="hideStaffHourDetails('<?php echo $staff_item['employee_id'];?>');" style="display:none;">
				<?php echo $Counter;?>&nbsp;<?php echo $staff_item['employee_name']; ?><?php echo $this->lang->line('busi_name_busi_hour');?> <span class="down-arrow-spn"></span>
            </span>
        
        </a>
    </td>

</tr>
<tr><td>
	<div id="DispStaffHourDetails<?php echo $staff_item['employee_id'];?>"  class="business-hour" style="display:none;"></div>
    
</td></tr>
<?php endforeach ?>
</table>

</div>
<br>
</div>

