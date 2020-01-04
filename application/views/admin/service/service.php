<?php include('service.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?></h1>
<!--	#####	CODE FOR ADD SERVICE FORM STARTS	#####	-->
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>

    <div id="mainDiv" >
        <div id="tabContent">
            <div class="inner-div">
            <br />
            <h2><?php echo $this->global_mod->db_parse($this->lang->line('ser_add_edit')); ?></h2>
            <br />
             <div class="inner-div">
                 <form name="add_service" id="add_service" method="post">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                 
<?php if (in_array(70, $this->global_mod->authArray())){ ?>
                  <tr>
                    <td width="12%" valign="top">
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_select_category')); ?> : </label>
                    </td>
                    <td width="42%" >
                        <input type="text" name="cat_name" id="category_1" autocomplete="off" value="" maxlength="30" style="display:none;" class="fld"/>
                        <select name="category" id="category_2" class="fld" style="width:255px;">
                            <option value=""><?php echo $this->global_mod->db_parse($this->lang->line('ser_select_category')); ?> </option>
                            <?php foreach($category as $category_item):?> 
                            <option value="<?php echo $category_item['category_id'];?>"><?php echo $category_item['category_name'];?></option>
                            <?php endforeach ?>
                        </select>  <span contentId="3" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span><br />
                        <input type="hidden" value="0" id="hdn" />
<div id="cat_div" style="color:#F00;font-size:10px;" ></div>
                          <a href="#" class="switch add-customer" rel="category_1"><?php echo $this->global_mod->db_parse($this->lang->line('ser_add_new_category')); ?></a>
                        <a href="#" class="switch add-customer" rel="category_2" style="display:none;"><?php echo $this->global_mod->db_parse($this->lang->line('ser_show_list')); ?></a>
                    </td>
                  </tr>
<?php }else{ ?>
	<input type="hidden" name="cat_name" id="category_1" autocomplete="off" value="Default" maxlength="30" style="display:none;" class="fld"/>
<?php }?>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_add_service')); ?> : </label>
                    </td>
                    <td colspan="2">
                        <input type="text" name="service_name" id="service_name" autocomplete="off" value="" class="text-input required" maxlength="30" style="width:245px;" />
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_cost')); ?> : </label>
                    </td>
                    <td>
                        <input type="text" name="service_cost" id="service_cost" class="text-input required cost" autocomplete="off" value="" maxlength="55"  style="width:246px;"/> <span style="color:#333"> <?php echo $this->session->userdata('local_admin_currency_type'); ?>&nbsp;<input type="checkbox" name="no_cost" id="no_cost" onchange="changeme()" />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('ser_no_cost')); ?> </span>
						<span contentId="1" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_duration')); ?> : </label>
                    </td>
                    <td colspan="2">
                        <input type="text" name="service_duration" id="service_duration" maxlength="3" autocomplete="off" class="text-input required duration" maxlength="55" style="width:247px;" />
                        <select name="service_duration_unit" id="service_duration_unit" style="width:90px;">
                            <option value="M"><?php echo $this->global_mod->db_parse($this->lang->line('ser_minute_s')); ?></option>
                            <option value="H"><?php echo $this->global_mod->db_parse($this->lang->line('ser_hour_s')); ?></option>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_capacity')); ?>  : </label>
                    </td>
                    <td colspan="2">
                    <?php if (in_array(46, $this->global_mod->authArray())){	 ?>
                        <input type="text" name="service_capacity" id="service_capacity" autocomplete="off" class="text-input required capacity" maxlength="55"  style="width:245px;"/>
                        <?php }else{ ?>
                        <input type="text" name="service_capacity" id="service_capacity" autocomplete="off" class="text-input required capacity" maxlength="55" value="1" readonly="true"  style="width:245px;"/>
                        <?php } ?>
						<span contentId="2" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_description')); ?> : </label>
                    </td>
                    <td>
                        <textarea name="service_description" id="service_description" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_description,document.add_service.remLen1,125)" onKeyUp="textCounter(document.add_service.service_description,document.add_service.remLen1,125)" style="width:245px;"></textarea> <br />

                        <input style="background-color:#F3F3F3; border:none; width:25px;" readonly type="text" name="remLen1" size="3" value="125"> <span style="color:#999"><?php echo $this->global_mod->db_parse($this->lang->line('ser_char_remain'));?></span>
                     </td>
                     <td>
                       
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label><?php echo $this->global_mod->db_parse($this->lang->line('ser_tags'));?> : </label>
                    </td>
                    <td>
                        <textarea name="service_tags" id="service_tags" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)" onKeyUp="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)" style="width:245px;"></textarea> <br />
 <input style="background-color:#F3F3F3; border:none; width:25px;" readonly type="text" name="remLen2" size="3" value="125"> 
 <span style="color:#999">
 <?php echo $this->global_mod->db_parse($this->lang->line('ser_char_remain'));?></span>
                    </td>
                    <td>
                      
                    </td>
                  </tr>
                  <tr>
                  <td></td>
                  <td><input type="hidden" name="service_update_id" id="service_update_id" value=""  class="btn-blue"/>
                        <button type="button" name="btn-submit" id="btn-submit" onclick="SaveServiceDetails();" class="btn-blue"><?php echo $this->global_mod->db_parse($this->lang->line('ser_add'));?></button></td>
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
<h2><?php echo $this->global_mod->db_parse($this->lang->line('ser_listing_details'));?></h2>
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
        	<span id="view_category_1" class="hid"><b><?php echo "<strong>".$i.". ".$this->global_mod->show_to_control($service_item['category_name'])."</strong>"; ?></b></span> &nbsp;
            <!--<span id="view_category_2" class="hid"><input type="text" value="" style="display:none;" /></span>
            <a href="#" class="switch_1" rel="view_category_2">Rename</a>
            <a href="#" class="switch_1" rel="view_category_1" style="display:none;">Save</a>-->
        </td>
    </tr>
	<tr >
    	<th width="15%" align="left"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_service'));?></em></th>
        <th width="10%" align="left"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_time'));?></em></th>
        <th width="7%" align="left"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_cost'));?></em></th>
        <th width="10%" align="center"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_capacity'));?></em></th>
        <th width="35%" align="left"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_description'));?></em></th>
        <th width="23%" align="center"><em><?php echo $this->global_mod->db_parse($this->lang->line('ser_action'));?></em></th>
    </tr>
	<?php $temp_cat = $service_item['category_name']; ?> 
    <?php $i++;} ?>
    <tr id="row_<?php echo $service_item['service_id'];?>">
    	<td align="left"><?php echo $service_item['service_name'];?></td>
    	<td align="left">
		<?php 
		echo $service_item['service_duration']. " ";
        if($service_item['service_duration']>1){
            $min = $this->global_mod->db_parse($this->lang->line('ser_minutes'));
            $hr = $this->global_mod->db_parse($this->lang->line('ser_hours'));
        }else{
            $min = $this->global_mod->db_parse($this->lang->line('ser_minute'));
            $hr = $this->global_mod->db_parse($this->lang->line('ser_hour'));
        }
		echo $service_item['service_duration_unit'] == "M"? $min : $hr;
		?>
        </td>
    	<td align="left"><?php echo $this->session->userdata('local_admin_currency_type').$service_item['service_cost'];?></td>
    	<td align="center"><?php echo $service_item['service_capacity'];?></td>
    	<td align="justify"><?php echo $service_item['service_description'];?></td>
        <td align="center">
		
			<span id="is_hide_<?php echo $service_item['service_id'];?>"> 
			 	<?php echo $service_item['is_hide'] == "Y" ? "<span onclick='hide_confirm(\"N\",\"$service_item[service_id]\")' style='cursor:pointer'>Unhide</span>" : "<span onclick='hide_confirm(\"Y\",\"$service_item[service_id]\")' style='cursor:pointer'>".$this->global_mod->db_parse($this->lang->line('hide'))."</span>";?>
             </span>
		
		
		
        	 <span id="enadis_<?php echo $service_item['service_id'];?>"> 
			 	<?php echo $service_item['is_active'] == "Y" ? "<span onclick='status_confirm(\"N\",\"$service_item[service_id]\")' style='cursor:pointer'>".$this->global_mod->db_parse($this->lang->line('disable'))."</span>" : "<span onclick='status_confirm(\"Y\",\"$service_item[service_id]\")' style='cursor:pointer'>".$this->global_mod->db_parse($this->lang->line('enable'))."</span>";?>
             </span>
             &nbsp;
        	<a href="javascript:void(0)" onclick="GetServiceDetails('<?php echo $service_item['service_id'];?>');"><?php echo $this->global_mod->db_parse($this->lang->line('ser_edit'));?></a> &nbsp;            
            <span onclick="del_confirm(<?php echo $service_item['service_id'];?>)" style="cursor:pointer"><?php echo $this->global_mod->db_parse($this->lang->line('ser_delete'));?></span></td>
        </td>
    </tr>
	
	<tr id="hide_<?php echo $service_item['service_id'];?>" class="ishide" style="display:none;">
    	<td colspan="6">
        <span id="ishiderow_<?php echo $service_item['service_id'];?>">
        	<?php echo $this->global_mod->db_parse($this->lang->line('ser_want'));?><?php echo $service_item['is_hide']=="Y"? $this->global_mod->db_parse($this->lang->line('unhide')) : $this->global_mod->db_parse($this->lang->line('hide'));?>"<?php echo $service_item['service_name'];?>"?<br />
            <font color="#FF0000"><b>
            <?php echo $service_item['is_hide']=="Y"? $this->global_mod->db_parse($this->lang->line('aftr_unhid_ur_clints_wld_b'))." ".$service_item['service_name'].".":$this->global_mod->db_parse($this->lang->line('aftr_hid_clints_wld_nt_b_abl')).' '.$service_item['service_name']." ".$this->global_mod->db_parse($this->lang->line('wld_nt_b_visible_2_clint'))?>
            </b></font><br />
            <?php echo $service_item['is_hide'] == "Y" ? "<span class=\"change_hide\" onclick='change_hide(\"N\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">".$this->global_mod->db_parse($this->lang->line('unhide'))."</span>" : "<span class=\"change_hide\" onclick='change_hide(\"Y\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">".$this->global_mod->db_parse($this->lang->line('hide'))."</span>"; ?>
             &nbsp; &nbsp; 
            <span onclick="hide_status(<?php echo $service_item['service_id'];?>)" style="cursor:pointer"><?php echo $this->global_mod->db_parse($this->lang->line('ser_cancel'));?></span>
        </span>
        </td>
    </tr>
	
	
	
	
	
	
	
    <tr id="status_<?php echo $service_item['service_id'];?>" class="statusdis" style="display:none;">
    	<td colspan="6">
        <span id="enadisrow_<?php echo $service_item['service_id'];?>">
        	<?php echo $this->global_mod->db_parse($this->lang->line('ser_want'));?> <?php echo $service_item['is_active']=="Y"?$this->global_mod->db_parse($this->lang->line('disable')):$this->global_mod->db_parse($this->lang->line('enable_sml'));?> "<?php echo $service_item['service_name'];?>"?<br />
            <font color="#FF0000"><b>
            <?php echo $service_item['is_active']=="Y"?$this->global_mod->db_parse($this->lang->line('aftr_disable_text'))." ".$service_item['service_name'].".":$this->global_mod->db_parse($this->lang->line('aftr_disable_text'))." ".$service_item['service_name']." ".$this->global_mod->db_parse($this->lang->line('would_b_visible'));?>
            </b></font><br />
            <?php echo $service_item['is_active'] == "Y" ? "<span class=\"change_status\" onclick='change_status(\"N\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">".$this->global_mod->db_parse($this->lang->line('disable'))."</span>" : "<span class=\"change_status\" onclick='change_status(\"Y\",\"$service_item[service_id]\",\"$service_item[service_name]\")' style=\"cursor:pointer\">".$this->global_mod->db_parse($this->lang->line('enble_btn'))."</span>"; ?>
             &nbsp; &nbsp; 
            <span onclick="hide_status(<?php echo $service_item['service_id'];?>)" style="cursor:pointer"><?php echo $this->global_mod->db_parse($this->lang->line('ser_cancel'));?></span>
        </span>
        </td>
    </tr>
    <tr id="del_<?php echo $service_item['service_id'];?>" class="deldis" style="display:none;">
    	<td colspan="6">
        	<?php echo $this->global_mod->db_parse($this->lang->line('ser_confirmation'));?><br />
            <font color="#FF0000"><b><?php echo $this->global_mod->db_parse($this->lang->line('ser_post_data'));?> "<?php echo $service_item['service_name'];?>"<?php echo $this->global_mod->db_parse($this->lang->line('ser_deleted'));?> </b></font><br />
            <!--<a href="service/service_delete/<?php //echo $service_item['service_id'];?>">Delete</a> &nbsp; &nbsp; -->
            <span onclick="delete_ajax(<?php echo $service_item['service_id'];?>)" style="cursor:pointer"><?php echo $this->global_mod->db_parse($this->lang->line('ser_delete'));?></span> &nbsp; &nbsp; 
            <span onclick="hide(<?php echo $service_item['service_id'];?>)" style="cursor:pointer"><?php echo $this->global_mod->db_parse($this->lang->line('ser_cancel'));?></span>
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