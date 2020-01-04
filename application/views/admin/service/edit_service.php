<?php include('edit_service.js.php'); ?>

<!--	#####	CODE FOR EDIT SERVICE FORM STARTS	#####	-->
<div class="wrap">
    <form name="edit_service" id="edit_service" class="styled" action="<?php echo base_url();?>admin/service/update_service/<?php echo $service[0]['service_id'];?>" method="post">
        <fieldset>
             <h3><?php echo $this->lang->line('ser_edit_title'); ?></h3>
             <ol>
             	<li class="form-row">
                	<label><?php echo $this->lang->line('ser_category'); ?> : </label><?php echo $this->global_mod->show_to_control($service[0]['category_name']);?>
                    <!--<input type="text" name="cat_name" id="category_1" autocomplete="off" value="" maxlength="30" />-->
                </li>

            	<li class="form-row">
                	<label><?php echo $this->lang->line('ser_add_service'); ?> : </label>
                    <input type="text" name="service_name" id="service_name" autocomplete="off" value="<?php echo $this->global_mod->show_to_control($service[0]['service_name']);?>" class="text-input required" maxlength="30"/>
                </li>
                
                <li class="form-row">
                	<label><?php echo $this->lang->line('ser_cost'); ?> : </label>
                    <input type="text" name="service_cost" id="service_cost" class="text-input required" autocomplete="off" value="<?php echo substr($service[0]['service_cost'], 0, -3);?>" maxlength="55" /> <?php echo $this->lang->line('ser_currency'); ?>
                    <input type="checkbox" name="no_cost" id="no_cost"<?php if($service[0]['no_cost'] == "Y") echo "checked";?> /><?php echo $this->lang->line('ser_no_cost'); ?> 
                </li>

                <li class="form-row">
                	<label><?php echo $this->lang->line('ser_duration'); ?> : </label>
                    <input type="text" name="service_duration" id="service_duration" autocomplete="off" value="<?php echo $service[0]['service_duration'];?>" class="text-input required" maxlength="55" />
                    <select name="service_duration_unit" id="service_duration_unit">
                        <option value="M"<?php if($service[0]['service_duration_unit'] == "M") echo "selected";?>><?php echo $this->lang->line('ser_minute'); ?></option>
                        <option value="H"<?php if($service[0]['service_duration_unit'] == "H") echo "selected";?>><?php echo $this->lang->line('ser_hour'); ?></option>
                    </select>
                </li>
                                 
                <li class="form-row">
                	<label><?php echo $this->lang->line('ser_capacity'); ?>  : </label>
                	<?php if (in_array(46, $this->global_mod->authArray())){	 ?>
                	
                    <input type="text" name="service_capacity" id="service_capacity" autocomplete="off" class="text-input required" value="<?php echo $service[0]['service_capacity'];?>" maxlength="55" />
                    
                    <?php }else{ ?>
					
					 <input type="text" name="service_capacity" id="service_capacity" autocomplete="off" class="text-input required" value="1" maxlength="55" readonly="true" />
					 	
					<?php } ?>
                                        
                </li>
                
                <li class="form-row">
                	<label><?php echo $this->lang->line('ser_description');?> : </label>
                    <textarea name="service_description" id="service_description" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_description,document.add_service.remLen1,125)" onKeyUp="textCounter(document.add_service.service_description,document.add_service.remLen1,125)"><?php echo $this->global_mod->show_to_control($service[0]['service_description']);?></textarea>
					<input readonly type="text" name="remLen1" size="3" value="125"> <?php echo $this->lang->line('ser_char_remain');?>
                </li>
                
                <li class="form-row">
                	<label><?php echo $this->lang->line('ser_tags');?> : </label>
                    <textarea name="service_tags" id="service_tags" class="text-input-staff-txtAra required" onKeyDown="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)" onKeyUp="textCounter(document.add_service.service_tags,document.add_service.remLen2,125)"><?php echo $this->global_mod->show_to_control($service[0]['service_tags']);?></textarea>
					<input readonly type="text" name="remLen2" size="3" value="125"> <?php echo $this->lang->line('ser_char_remain');?>
                </li>
            </ol>
            <button class="btn-submit" type="submit" name="btn-submit" id="btn-submit"><?php echo $this->lang->line('ser_edit');?></button>
        </fieldset>
    </form>
    <div class="formbox_bottom"></div>
    <div class="clear"></div>
</div>
<!--	#####	CODE FOR EDIT SERVICE FORM ENDS	#####	-->