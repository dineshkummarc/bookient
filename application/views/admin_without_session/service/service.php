<?php include('service.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main">SERVICE</h1>
<!--	#####	CODE FOR ADD SERVICE FORM STARTS	#####	-->
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>

    <div id="mainDiv" >
        <div id="tabContent">
            <div class="inner-div">
            <br />
            <h2>1. Add/Update your service details.</h2>
            <br />
             <div class="inner-div">
                 <form name="add_service" id="add_service" method="post">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="12%" valign="top">
                        <label><?php echo $this->lang->line('ser_select_category'); ?> : </label>
                    </td>
                    <td width="42%" >
                        <input type="text" name="cat_name" id="category_1" autocomplete="off" value="" maxlength="30" style="display:none;" class="fld"/>
                        <select name="category" id="category_2" class="fld" style="width:255px;">
                            <option value=""><?php echo $this->lang->line('ser_select_category'); ?> </option>
                            <?php foreach($category as $category_item):?> 
                            <option value="<?php echo $category_item['category_id'];?>"><?php echo $category_item['category_name'];?></option>
                            <?php endforeach ?>
                        </select><br />
                        <input type="hidden" value="0" id="hdn" />
<div id="cat_div" style="color:#F00;font-size:10px;" ></div>
                          <a href="#" class="switch add-customer" rel="category_1"><?php echo $this->lang->line('ser_add_new_category'); ?></a>
                        <a href="#" class="switch add-customer" rel="category_2" style="display:none;"><?php echo $this->lang->line('ser_show_list'); ?></a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_add_service'); ?> : </label>
                    </td>
                    <td colspan="2">
                        <input type="text" name="service_name" id="service_name" autocomplete="off" value="" class="text-input required" maxlength="30" style="width:245px;" />
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_cost'); ?> : </label>
                    </td>
                    <td>
                        <input type="text" name="service_cost" id="service_cost" class="text-input required cost" autocomplete="off" value="" maxlength="55"  style="width:246px;"/> <span style="color:#333"> <?php echo $this->session->userdata('local_admin_currency_type'); ?>&nbsp;<input type="checkbox" name="no_cost" id="no_cost" />&nbsp;<?php echo $this->lang->line('ser_no_cost'); ?> </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_duration'); ?> : </label>
                    </td>
                    <td colspan="2">
                        <input type="text" name="service_duration" id="service_duration" maxlength="3" autocomplete="off" class="text-input required duration" maxlength="55" style="width:247px;" />
                        <select name="service_duration_unit" id="service_duration_unit" style="width:90px;">
                            <option value="M"><?php echo $this->lang->line('ser_minute'); ?></option>
                            <option value="H"><?php echo $this->lang->line('ser_hour'); ?></option>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_capacity'); ?>  : </label>
                    </td>
                    <td colspan="2">
                        <input type="text" name="service_capacity" id="service_capacity" autocomplete="off" class="text-input required capacity" maxlength="55"  style="width:245px;"/>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_description'); ?> : </label>
                    </td>
                    <td>
                        <textarea name="service_description" id="service_description" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_description,document.add_service.remLen1,125)" onKeyUp="textCounter(document.add_service.service_description,document.add_service.remLen1,125)" style="width:245px;"></textarea> <br />

                        <input style="background-color:#F3F3F3; border:none; width:25px;" readonly type="text" name="remLen1" size="3" value="125"> <span style="color:#999"><?php echo $this->lang->line('ser_char_remain');?></span>
                     </td>
                     <td>
                       
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->lang->line('ser_tags');?> : </label>
                    </td>
                    <td>
                        <textarea name="service_tags" id="service_tags" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)" onKeyUp="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)" style="width:245px;"></textarea> <br />
 <input style="background-color:#F3F3F3; border:none; width:25px;" readonly type="text" name="remLen2" size="3" value="125"> 
 <span style="color:#999">
 <?php echo $this->lang->line('ser_char_remain');?></span>
                    </td>
                    <td>
                      
                    </td>
                  </tr>
                  <tr>
                  <td></td>
                  <td><input type="hidden" name="service_update_id" id="service_update_id" value=""  class="btn-blue"/>
                        <button type="button" name="btn-submit" id="btn-submit" onclick="SaveServiceDetails();" class="btn-blue"><?php echo $this->lang->line('ser_add');?></button></td>
                    <td >&nbsp;
                        
                    </td>
                  </tr>
                </table>
                </form>                
             </div>
            </div>
        </div>
    </div>

<div class="formbox_bottom"></div>
<!--	#####	CODE FOR ADD SERVICE FORM ENDS	#####	-->

<!--	#####	CODE FOR VIEW SERVICE FORM STARTS	#####	-->

<div class="" style="width:100%; margin-left:0;">
<br />
<h2>2. Service listing details.</h2>
<div id="service_list">

<table class="list-view" align="center" border="0" width="98%">
    <?php 
	$temp_cat = "";
	$i = 1;
	foreach($service as $service_item):
	if($temp_cat != $service_item['category_name']) {
	?><!--service_id-->
    <tr style="background-color: #A7BDEA;">
    	<td colspan="6">
        	<span id="view_category_1" class="hid"><b><?php echo "<strong>".$i.". ".$service_item['category_name']."</strong>"; ?></b></span> &nbsp;
            <!--<span id="view_category_2" class="hid"><input type="text" value="" style="display:none;" /></span>
            <a href="#" class="switch_1" rel="view_category_2">Rename</a>
            <a href="#" class="switch_1" rel="view_category_1" style="display:none;">Save</a>-->
        </td>
    </tr>
	<tr >
    	<th width="15%" align="center"><em>Service</em></th>
        <th width="10%" align="center"><em>Time</em></th>
        <th width="7%" align="center"><em>Cost</em></th>
        <th width="10%" align="center"><em>Capacity</em></th>
        <th width="35%" align="left"><em>Description</em></th>
        <th width="23%" align="center"><em>Action</em></th>
    </tr>
	<?php $temp_cat = $service_item['category_name']; ?> 
    <?php $i++;} ?>
    <tr id="row_<?php echo $service_item['service_id'];?>">
    	<td align="center"><?php echo $service_item['service_name'];?></td>
    	<td align="center">
		<?php 
		echo $service_item['service_duration']. " ";
                if($service_item['service_duration']>1)
                {
                    $min = "Minutes";
                    $hr = "Hours";
                }
                else
                {
                    $min = "Minute";
                    $hr = "Hour";
                }
		echo $service_item['service_duration_unit'] == "M"? $min : $hr;
		?>
        </td>
    	<td align="center"><?php echo $this->session->userdata('local_admin_currency_type'); ?>&nbsp;<?php echo $service_item['service_cost'];?></td>
    	<td align="center"><?php echo $service_item['service_capacity'];?></td>
    	<td align="justify"><?php echo $service_item['service_description'];?></td>
        <td align="center">
        	 <span id="enadis_<?php echo $service_item['service_id'];?>"> <?php echo $service_item['is_active'] == "Y" ? "<span onclick='status_confirm(\"N\",\"$service_item[service_id]\")' style='cursor:pointer'>Disable</span>" : "<span onclick='status_confirm(\"Y\",\"$service_item[service_id]\")' style='cursor:pointer'>Enable</span>";?>
             </span>
             &nbsp;
        	<a href="javascript:void(0)" onclick="GetServiceDetails('<?php echo $service_item['service_id'];?>');">Edit</a> &nbsp;            
            <span onclick="del_confirm(<?php echo $service_item['service_id'];?>)" style="cursor:pointer">Delete</span></td>
        </td>
    </tr>
    <tr id="status_<?php echo $service_item['service_id'];?>" class="statusdis" style="display:none;">
    	<td colspan="6">
        <span id="enadisrow_<?php echo $service_item['service_id'];?>">
        	Are you sure to <?php echo $service_item['is_active']=="Y"?"disable":"enable";?> "<?php echo $service_item['service_name'];?>"?<br />
            <font color="#FF0000"><b>
            <?php echo $service_item['is_active']=="Y"?"After disabling, your clients would not be able to book \"$service_item[service_name]\".":"After enabling, $service_item[service_name] would be visible to client.";?>
            </b></font><br />
            <?php echo $service_item['is_active'] == "Y" ? "<span class=\"change_status\" onclick='change_status(\"N\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">Disable</span>" : "<span class=\"change_status\" onclick='change_status(\"Y\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">Enable</span>"; ?>
             &nbsp; &nbsp; 
            <span onclick="hide_status(<?php echo $service_item['service_id'];?>)" style="cursor:pointer">Cancel</span>
        </span>
        </td>
    </tr>
    <tr id="del_<?php echo $service_item['service_id'];?>" class="deldis" style="display:none;">
    	<td colspan="6">
        	Are you sure to delete?<br />
            <font color="#FF0000"><b>All past data corresponding to "<?php echo $service_item['service_name'];?>" would be DELETED.</b></font><br />
            <!--<a href="service/service_delete/<?php //echo $service_item['service_id'];?>">Delete</a> &nbsp; &nbsp; -->
            <span onclick="delete_ajax(<?php echo $service_item['service_id'];?>)" style="cursor:pointer">Delete</span> &nbsp; &nbsp; 
            <span onclick="hide(<?php echo $service_item['service_id'];?>)" style="cursor:pointer">Cancel</span>
        </td>
    </tr>
    <?php 
	endforeach 
	?>
</table>
</div>
</div>
<br>
</div>