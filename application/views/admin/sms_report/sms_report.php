<?php include('sms_report.js.php');  ?>
<div class="rounded_corner_full">
    <h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?></h1>
    <form action="" method="post" name="frm_sms" id="frm_sms">
        <div class="report-search">
            <table width="100%" cellpadding="0" cellspacing="0" class="common-tabl">
	            <!--tr>
    	            <td colspan="2" style="font-size:14px;">
                        <strong><?php echo $this->lang->line('select_business');?></strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        < select name="local_admin_id" id="local_admin_id"  style="width:199px;">
						<?php foreach($business_arr as $business){?>
        	                <option value="<?php echo $business['localid']; ?>"><?php echo $business['usernm']; ?></option>
							<?php } ?>
                        </select >
                    </td>                   
                </tr -->
	            <tr>
    	            <td colspan="2" style="font-size:13px; font-weight:bold;"><strong><?php echo $this->global_mod->db_parse($this->lang->line('select_date'))?>:</strong></td>
                </tr>
                <tr>
                    <td><span><?php echo $this->global_mod->db_parse($this->lang->line('from'));?></span><br/>
                        <input id="date_from" name="date_from" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly">
                        <span id="err_from" style="color:red"></span>  
                    </td>
                    <td><span><?php echo $this->global_mod->db_parse($this->lang->line('to'));?></span><br/>
        	            <input id="date_to" name="date_to" type="text" value="<?php echo date("m/d/Y"); ?>" readonly="readonly">
                        <span id="err_to" style="color:red"></span>
                    </td>
                </tr>
                <tr>
                     <td><span id="err_rep" style="color:red;font-size:10px;"></span></td>
                </tr>
    
                <tr id="adv_search">
               <td style="color:#022157; font-size:14px; font-weight:bold;" colspan="2" align="center">
                   <a href="javascript:void(0);" onclick="show_hide_tr();"><?php echo $this->global_mod->db_parse($this->lang->line('advance_search'));?> &raquo;</a>
               </td>
                </tr>
            </table>
            <table width="100%" id="show_hide" class="common-tabl" style="display:none;">
				<tr>
					<td>
						<?php echo $this->global_mod->db_parse($this->lang->line('sent_to'));?>	
					</td>
					<td>
						<?php echo $this->global_mod->db_parse($this->lang->line('phone_no'));?>     
					</td>
				</tr>
                <tr>
					<td>				
                        <select name="sent_to" id="sent_to" >
							<option value=""><?php echo $this->global_mod->db_parse($this->lang->line('all'));?></option>
							<option value="admin"><?php echo $this->global_mod->db_parse($this->lang->line('admin'));?></option>
							<option value="staff"><?php echo $this->global_mod->db_parse($this->lang->line('staff'));?></option>
							<option value="user"><?php echo $this->global_mod->db_parse($this->lang->line('user'));?></option>
                        </select>
                    </td> 
					<td>                                    
                        <input type="text" name="phone_no" id="phone_no" value=""  style="margin:8px 0 0 0;"/>
                    </td>              
                </tr>
				<tr>
					<td>
						<?php echo $this->global_mod->db_parse($this->lang->line('message_type'));?> 
					</td>					
				</tr>
                <tr>
					<td>				
                        <select name="message_type" id="message_type" >
							<option value=""><?php echo $this->global_mod->db_parse($this->lang->line('select'));?></option>
							<option value="1"><?php echo $this->global_mod->db_parse($this->lang->line('complete'));?></option>
							<option value="2"><?php echo $this->global_mod->db_parse($this->lang->line('failed'));?></option>
							<option value="3"><?php echo $this->global_mod->db_parse($this->lang->line('authentication_failed'));?></option>
                        </select>
                    </td> 					             
                </tr>            
                <tr>
                    <td colspan="2" style="color:#022157; font-size:14px; font-weight:bold;" align="center">
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