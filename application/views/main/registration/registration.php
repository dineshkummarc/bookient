<?php include('registration.js.php'); ?>
<?php 
$exp			=	explode('//',$current_url);
$exp1			=	explode('/',$exp[1]);
$url			=	$exp1[0];
?>
<div class="wrap">
    <h2 class="text-center" style="font-size:23px;font-weight: bold;"><?php echo $this->global_mod->db_parse($this->lang->line('reg_heading_registernow')); ?></h2>  
    <form id="form-sign-up" class="from_registred" action="" method="post">
        <fieldset>
            <h3><?php echo $this->global_mod->db_parse($this->lang->line('reg_heading_appointysiteaddress')); ?></h3>
            <ol>
                <li class="form-row"><label><?php echo $this->global_mod->db_parse($this->lang->line('reg_username')); ?>:</label>
                    <input name="user_name" type="text" class="text-input required username" />.<?php echo $url; ?>					
                    <div id="userErr"></div> 
                </li>
                <li class="form-row large_input"><label><?php echo $this->global_mod->db_parse($this->lang->line('reg_email')); ?>:</label>
                    <input name="email" type="text" id="register-email" class="text-input required email" /><div id="err"></div>
                </li>
                <li class="form-row large_input"><label><?php echo $this->lang->line('reg_password'); ?>:</label>
                    <input name="password1" type="password" id="password-1" class="text-input required password" />
                </li>
                <li class="form-row large_input"><label><?php echo $this->lang->line('reg_repeat_password'); ?>:</label>
                    <input name="password2" type="password" id="password-2" class="text-input required password" />
                </li> 
                <br/><br/>
                <h3><?php echo $this->global_mod->db_parse($this->lang->line('reg_heading_administratoraccount')); ?></h3>
                <li class="form-row"><label><?php echo $this->lang->line('reg_name'); ?>:</label>
                    <input name="firstname" placeholder="<?php echo $this->lang->line('reg_first_name')?>" id="firstname" type="text" class="text-input required" /> 
                    <input name="lastname" placeholder="<?php echo $this->lang->line('reg_last_name')?>" type="text" id="lastname" class="text-input required" /></td>
                </li>
                <li class="form-row"><label><?php echo $this->lang->line('reg_profession'); ?>:</label>
                    <?php echo $profession; ?> <a id="otherbtn_prof" href="javascript:void(0);"><?php echo $this->lang->line('reg_other')?></a>
                </li>
                <li class="form-row large_input" style="display:none;" id="other_li">
                		<label></label>
                		<input  type="text" name="other_profession" id="other_profession"/>
                		
                </li>	
                			
                <li class="form-row"><label><?php echo $this->lang->line('reg_country'); ?>:</label>
                    <?php echo $country; ?> 
                </li>
                <li class="button-row">
                    <!--input type="image" src="<?php echo base_url(); ?>images/CreateAccountButton.png" alt="Sign Up" value="OK" class="btn-submit img-swap" width="160px" height="50px"/-->
                    <input type="button" class="btn-blue" value="Create An Account" alt="Go" class="btn-submit-login img-swap" id="btn-submit-register" /> 
                </li>
            </ol>
        </fieldset>

<div class="wrap">
<li class="form-row">
 <a href="http://www.bookient.com"> If not sure > Goto home page www.bookient.com for more info</a>
<br><br> Kayttoonoton opastuksen voit katsoa osoitteesta: <a href="https://youtu.be/YaL-kxguMUA" target="_blank">https://youtu.be/YaL-kxguMUA</a>
 </li>
</div>
    </form>
    
 </div>