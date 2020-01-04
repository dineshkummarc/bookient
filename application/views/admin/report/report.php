<?php include('report.js.php'); ?>
<div class="rounded_corner_full">
    <h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?></h1>
    <form action="" method="post" name="frm_appointment" id="frm_appointment">
        <div class="report-search">
            <table width="100%" cellpadding="0" cellspacing="0" class="common-tabl">
	            <tr>
    	            <td colspan="2" style="font-size:14px;">
                        <strong><?php echo $this->global_mod->db_parse($this->lang->line('search_type'));?></strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="appointment_type" id="appointment_type"  style="width:199px;">
        	                <option value="1"><?php echo $this->global_mod->db_parse($this->lang->line('appointment_type_1')); ?></option>
                            <option value="2"><?php echo $this->global_mod->db_parse($this->lang->line('appointment_type_2')); ?></option>
                        </select>
                    </td>
                    <td>
                        <select name="display_type" id="display_type">
                            <option value="1"><?php echo $this->global_mod->db_parse($this->lang->line('display_type_1')); ?></option>
                            <option value="2"><?php echo $this->global_mod->db_parse($this->lang->line('display_type_2')); ?></option>
                            <option value="3"><?php echo $this->global_mod->db_parse($this->lang->line('display_type_3')); ?></option>
                        </select>
                    </td>
                </tr>
	            <tr>
    	            <td colspan="2" style="font-size:13px; font-weight:bold;"><strong><?php echo $this->global_mod->db_parse($this->lang->line('select_date')); ?></strong></td>
                </tr>
                <tr>
                    <td><span><?php echo $this->global_mod->db_parse($this->lang->line('from'));?></span><br/>
                        <input id="date_from" name="date_from" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly">
                        <span id="err_from" style="color:red"></span>  
                    </td>
                    <td><span><?php echo $this->global_mod->db_parse($this->lang->line('to_view'));?></span><br/>
        	            <input id="date_to" name="date_to" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly">
                        <span id="err_to" style="color:red"></span>
                    </td>
                </tr>
                <tr>
                     <td><span id="err_rep" style="color:red;font-size:10px;"></span></td>
                </tr>
    
                <tr id="adv_search">
               <td style="color:#022157; font-size:14px; font-weight:bold;" colspan="2" align="center">
                   <a href="javascript:void(0);" onclick="show_hide_tr();"><?php echo $this->global_mod->db_parse($this->lang->line('advanced_search'));?> &raquo;</a>
               </td>
                </tr>
            </table>
            <table width="100%" id="show_hide" class="common-tabl" style="display:none;">
                <tr>
                    <td style=" width:199px;">
                        <select name="service" id="service" >
                            <option value=""><?php echo $this->global_mod->db_parse($this->lang->line('all_services'));?></option>
                            <?php foreach($service_list as $service) { ?>
                            <option value="<?php echo $service['service_id']; ?>"><?php echo $service['service_name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td width="2">
                        <select name="staff" id="staff">
                            <option value=""><?php echo $this->global_mod->db_parse($this->lang->line('all_staffs'));?></option>
                            <?php foreach($staff_list as $staff) { ?>
                            <option value="<?php echo $staff['employee_id']; ?>"><?php echo $staff['employee_name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="status" id="status" style="margin:8px 0 0 0;">
                            <option value=""><?php echo $this->global_mod->db_parse($this->lang->line('all_appointments'));?></option>
                            <option value="1"><?php echo $this->global_mod->db_parse($this->lang->line('paid'));?></option>
                            <option value="2"><?php echo $this->global_mod->db_parse($this->lang->line('not_paid'));?></option>
                            <option value="3"><?php echo $this->global_mod->db_parse($this->lang->line('approved'));?></option>
                            <option value="4"><?php echo $this->global_mod->db_parse($this->lang->line('unapproved'));?></option>
                            <option value="5"><?php echo $this->global_mod->db_parse($this->lang->line('failed'));?></option>
                            <option value="6"><?php echo $this->global_mod->db_parse($this->lang->line('cancelled'));?></option>
                            <option value="7"><?php echo $this->global_mod->db_parse($this->lang->line('not_cancelled'));?></option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="username" id="username" value="" placeholder="<?php echo $this->global_mod->db_parse($this->lang->line('client_username'));?>" onfocus="focusit();" onblur="blurit();" style="margin:8px 0 0 0;"/>
                    </td>
                </tr>
                <tr>
                    <td style="color:#022157; font-size:14px; font-weight:bold;" colspan="2" align="center">
                        <a href="javascript:void(0);" onclick="hide_show_tr();"><?php echo $this->global_mod->db_parse($this->lang->line('basic_search'));?> &raquo;</a>
                    </td>
                </tr>
            </table>
        </div>   
        <table width="100%">
            <tr>
    	        <td colspan="2" align="center">
                    <input type="button" class="btn-blue" name="search" id="search" value="<?php echo $this->global_mod->db_parse($this->lang->line('search'));?>" onclick="serach_appointment()" style=" padding:7px 18px;"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="show_result"></div>