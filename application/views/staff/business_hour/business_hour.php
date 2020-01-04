<?php include('business_hour.js.php'); ?>
<div class="rounded_corner_full">

<h1 class="headign-main">Business hour</h1>
<div class="inner-div">

<table width="99%" cellspacing="0" cellpadding="0">
<tbody><tr>
<td><div align="left">Pardco gives you the flexibility to set your custom business hours. You can set your staff's schedule to perform services on different hours, and on different days of the week. Please select services, staff who provide those services, and times/days when the services can be performed. Repeat this process to add multiple entries.</div></td>
<td width="30%" align="right"><div align="right"><a href="">Need help?</a></div></td>
</tr>
</tbody></table>

</div>

<div class="padding-adjust">

<a href="javascript:void(0)"><span id="update_text" onclick="show_service()" class="add-customer"><?php echo $this->lang->line('busi_update');?></span></a>

<div  id="details_div" style="width:98%; padding:0 0 0 2%;display:none; border:1px solid #cccccc; border-radius:5px; margin-bottom:10px;">

<!--<form id="form-biz-hour" name="form-biz-hour" action="<?php //echo base_url(); ?>admin/business_hour/add-biz-hour/" method="post" enctype="multipart/form-data">-->
<form id="form-biz-hour" name="form-biz-hour" action="<?php echo base_url(); ?>admin/business_hour/add_biz_hour/" method="post" enctype="multipart/form-data">
<table id="details" align="center" border="0" style="display:none;" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td colspan="2" style="background-color:#F2F2F2;"><div class="heading" style=" margin-top:-4px; margin-left:-2.1%">Please select <strong>service{s}</strong> to be performed.</div></td>
    </tr>
    <tr>
    <td colspan="2" align="center" >
    <span id="suss_msg" style="color:#093;" ></span>
    </td>
    </tr>
	<tr>
		<td valign="top" width="50%">
        
        	<div class="business-hr-blue-bg">
            
                    <table width="100%" >
                        <tr>
                            <th>
                            <h3>
                            <input id="super" type="checkbox" onclick="toggleChecked(this.checked)" />
                            ::<?php echo $this->lang->line('busi_service');?>::
                            </h3>
                            </th>
                        </tr>
                        <tr>
                            <td>
                            <div class="business-hr-depen-scroll">
                            <?php if(isset($category)){?>
                                <ul id="services" onclick="serviceResetMsg();">
                                    <li id="servicemsg"></li>
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
		
	</tr>
	<tr>
        <td valign="top" colspan="2" align="left">
        
        <div class="business-hr-blue-bg-border">
        
        
                            <table>
                            <tr><th>::<?php echo $this->lang->line('busi_day');?>::</th></tr>
                            <tr>
                            <td>
                            <ul id="days" onclick="daysResetMsg();"><li>
                            <input type="checkbox" name="mon" id="mon" value="1"/> Monday&nbsp;&nbsp;&nbsp;  
                            <input type="checkbox" name="tue" id="tue" value="2"/> Tuesday&nbsp;&nbsp;&nbsp;  
                            <input type="checkbox" name="wed" id="wed" value="3"/> Wednesday&nbsp;&nbsp;&nbsp;   
                            <input type="checkbox" name="thu" id="thu" value="4"/> Thursday&nbsp;&nbsp;&nbsp;  
                            <input type="checkbox" name="fri" id="fri" value="5"/> Friday&nbsp;&nbsp;&nbsp;  
                            <input type="checkbox" name="sat" id="sat" value="6"/> Saturday&nbsp;&nbsp;&nbsp; 
                            <input type="checkbox" name="sun" id="sun" value="7"/> Sunday&nbsp;&nbsp;&nbsp;
                            </li><li id="daysmsg"></li></ul>                           
                            </td>
                            </tr>
                            </table>
                            
                            </div>
        </td>
	</tr>

    <tr>
    <td colspan="2" align="left">
    <div class="business-hr-blue-bg-border">
        <table>
        <tr>
        <td>Time From</td>
        <td>:</td>
        <td><input type="text" id="timepickerFrom" name="timepickerFrom" value="" class="text-input-bizhours required"/></td>
        <td>Time To</td>
        <td>:</td>
        <td><input type="text" id="timepickerTo" name="timepickerTo" value="" class="text-input-bizhours required"/></td>
        </tr>
        
 
        </table>
        
        </div>
    </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        
        <button class="btn-blue" type="button" name="btn_biz_hour" id="btn_biz_hour" value="Add" >Add Business Hour</button>
        <input class="business-hr-btn-gray" type="button" onclick="close_service()" value="Cancel" name="cancel">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">&nbsp;</td>
    </tr>
</table>
</form>


</div>





<div class="business-hr-blue-bg-border" style="  margin: 0 17px 0 22px;">

<table cellpadding="0" cellspacing="0" width="100%">
<?php $Counter = 0; ?>
<?php foreach($staff as $staff_item):?>
<?php $Counter++; ?>
<tr >
    <td align="left">
        <a href="javascript:void(0);" style="float:left; text-decoration:none">
        <!--  onblur="hideStaffHourDetails('<?php //echo $staff_item['employee_id'];?>')"-->
        
            <span id="arrowright<?php echo $staff_item['employee_id'];?>" class="right-arrow" onclick="showStaffHourDetails('<?php echo $staff_item['employee_id'];?>');">
				<?php echo $Counter;?>&nbsp;<?php echo $staff_item['employee_name'];?>'s Business hour <span class="right-arrow-spn"></span>
            </span>
            <span id="arrowdown<?php echo $staff_item['employee_id'];?>" class="down-arrow" onclick="hideStaffHourDetails('<?php echo $staff_item['employee_id'];?>');" style="display:none;">
				<?php echo $Counter;?>&nbsp;<?php echo $staff_item['employee_name'];?>'s Business hour <span class="down-arrow-spn"></span>
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

</div>
<div style="height:30px;"></div>
</div>