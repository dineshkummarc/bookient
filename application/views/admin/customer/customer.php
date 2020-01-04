<?php include('customer.js.php'); ?>
<!--palash start-->

<div class="rounded_corner_full">
  
<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('customer_head'));?></h1>
  <div class="inner">
<div id="alphabetlist">
<div id="alphaId0" class="alphaName" onclick="show_all_customers()">#</div>
<?php
//echo'<pre>';print_r($showAllCustomerName_by_First_Alphabet); exit();
$alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
foreach ($alpha as $row){
    if (in_array($row, $showAllCustomerName_by_First_Alphabet)){
        echo '<div id="alphaId'.$row.'" class="alphaName CharBold" onclick="alpha_search(\''.strtolower($row).'\')">'.$row.'</div>';
    }else{
        echo '<div id="alphaId'.$row.'" class="alphaName">'.$row.'</div>';
    }
}
?>
<br/><br/>

</div>
<div style="clear:both;"></div>
<!--palash end-->
<div class="search-top" style="height:60em;">


 <!--LEFT-->
    <div id="search" style="margin:10px 0 0 0px;">
        <form autocomplete="off" id="searchForm">
            <input type="text" id='cus_name_search' class="search-filed" onkeypress="enterKeySubmission(event)" value="" />
            <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('search_btn'));?>" id="#btn-submit-search" onclick="search_customer()" />
        </form>
    </div>
    <div id="scrollbar1">
        <div class="scrollbar">
            <div class="track">
                <div class="thumb"><div class="end"></div></div>
            </div>
        </div>
        <div class="viewport">
            <div class="overview">
                <div id="show_all_customer"><p><?php echo $show_all_customer; ?></p></div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0)" onclick="show_all_customers();"><?php echo $this->global_mod->db_parse($this->lang->line('show_all_cstomr'));?></a>
</div>
  
 <?php if(in_array(66, $this->global_mod->authArray())){ ?>      
<div class="rounded_right-corner" style="position:relative;">  <!--RIGHT-->
	<div style="float: right;" class="excel_create"><img alt="Export" src="<?php echo base_url(); ?>/images/export_excel.png"><a href="javascript:void(0);" onclick="exporton()"> <?php echo $this->global_mod->db_parse($this->lang->line('export_to_excl'));?></a></div>
<div>
<?php }?>


    <div id="add_customer_link"><a href="javascript:void(0);" onclick="addCustomer()" class="add-customer"> <?php echo $this->global_mod->db_parse($this->lang->line('add-customer')); ?></a></div>

    <div id="add_customer" class="rounded_corner" style="margin: 20px 10px 10px 10px;border:1px solid #CCCCCC; display: none;">
    <div id="new_user" style="padding:10px 0px 10px 50px;">
        <form name="f1" id="f1" method="post" action="">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
             <td valign="top" width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('first_name'));?></td>
             <td>
            <input type="text" id="cus_fname_2" value ="" onfocus="clr_reg_values(this.id)" class="required" style="float:left; width:40%; margin:0 5px 4px 0;" />
            <span id="cus_fname_div" class="required_div error"> </span></td>
        </tr>

        <?php if($checkFieldstatus['cus_lname'] == 1 ){ ?>
        <tr>
        <td valign="top" width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('last_name'));?></td>
            <td>
             <input type="text" id="cus_lname_3" value=""  onfocus="clr_reg_values(this.id)" class="required"  style="float:left; width:40%; margin:0 5px 4px 0;"/>
            <span id="cus_lname_div" class="required_div error"> </span>
            </td>
        </tr>
        <?php } ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('email'));?></td>
               <td>
                  <input type="text" id="user_email_p"  class="required" style=" width:40%" onfocus="clr_reg_values(this.id)" value="" />
                  <span id="user_email_p_div" class="required_div error"></span>
               </td>
            </tr>
            <?php if($checkFieldstatus['cus_mob'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('mobile'));?></td>
               <td>
                   <input type="text" id="cus_mob_9" onfocus="clr_reg_values(this.id)" value="" style=" width:40%"  />
                   <span id="cus_phn1_10_div" class="required_div error"></span>
               </td>
            </tr>
            <?php } ?>
            <?php if($checkFieldstatus['cus_phn1'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('phone1'));?></td>
               <td>
                   <input type="text" id="cus_phn1_10" onfocus="clr_reg_values(this.id)" value="" style=" width:40%"  />
                   <span id="cus_phn1_11_div" class="required_div error"></span>
               </td>
            </tr>
            <?php } ?>
            <?php if($checkFieldstatus['cus_phn2'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('phone2'));?></td>
               <td>
                   <input type="text" id="cus_phn2_11" onfocus="clr_reg_values(this.id)" value="" style=" width:40%" />
                   <span id="cus_phn1_12_div" class="required_div error"></span>
               </td>
            </tr>
            <?php } ?>
            <?php if($checkFieldstatus['cus_address'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('address'));?></td>
               <td>
                   <textarea id="cus_address_4" style="width:40%"></textarea>
                   <span id="cus_address_4_div" class="required_div error"></span>
               </td>
            </tr>
            <?php } ?>
            <?php //if($checkFieldstatus['cus_country'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('country'));?></td>
               <td valign="top">
                   <?php echo  $country;   ?>
                   <span id="cus_countryid_5_div" style="" class="required_div error"></span>
               </td>
            </tr>
            <?php //} ?>
            <?php //if($checkFieldstatus['cus_region'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('region'));?></td>
               <td>
                   <?php echo  $region;   ?>
                   <span id="cus_regionid_6_div" style="" class="required_div error"></span>
               </td>
            </tr>
            <?php //} ?>
            <?php //if($checkFieldstatus['cus_city'] == 1){ ?>
            <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('city'));?></td>
               <td >
                   <?php echo  $city;   ?>
                   <span id="cus_cityid_7_div" style="" class="required_div error"></span>
               </td>
           </tr>
           <tr>
               <td valign="top"><?php echo $this->global_mod->db_parse($this->lang->line('zip'));?></td>
               <td>
                   <?php //if($checkFieldstatus['cus_zip'] == 1){ ?>
                   <input type="text" id="cus_zip_8" onfocus="clr_reg_values(this.id)" onblur="if(this.value == '')this.value=''" style="float:left; width:40%; margin:0 5px 4px 0;" />
                   <span id="cus_zip_8_div" style="" class="required_div error"></span>
                   <?php //} ?>
               </td>
            </tr>
            <?php //} ?>
            <?php if($checkFieldstatus['time_zone'] == 1){ ?>
            <tr>
               <td><?php echo $this->global_mod->db_parse($this->lang->line('time_zone'));?></td>
               <td>
                   <?php echo  $time_zone;   ?>
                   <span id="cus_time_zone_id_21_div" style="" class="required_div error"></span>
               </td>
            </tr>
		
            <?php } ?>
            <tr>
               <td><?php echo $this->global_mod->db_parse($this->lang->line('approval_type'));?></td>
               <td>
                   <?php echo  $approval_type;   ?>
                   <span id="cus_approval_id_22_div" style="" class="required_div error"></span>
               </td>
            </tr>
			<tr>
			    <td>&nbsp;</td>
			    <td>
                    <div style="margin:15px 0 0 0px;">
                        <span id="add_cus_btn">
                            <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?>" onclick="addNewCustomer()" class="btn-blue"/>
                        </span>
                        <span id="edit_cus_btn">
                            <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('update_btn'));?>" onclick="addNewCustomer()" class="btn-blue" />
                        </span>
                                
                        <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('cancel_btn'));?>" onclick="hideAddCustomer()" class="btn-gray"/>
                        <input type="hidden" name="customer_id" id="customer_id" value="0" />
                        <span id="loader"></span>
                    </div>
                </td>
			</tr>
				</table>

		 </form>
			</div>
			</div>
			<div id="select_customer" class="rounded_corner" style="position:relative; display: none;">
			<div class="headign-main">
				<span id="1st_name"></span>
				<span id="last_name"></span>
			</div>
			
	<table width="63%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>&nbsp;</td>
		<td><div id="link" style="width:100%;"></div></td>
	</tr>	  
	<tr class="contactDetails">
		<td ><img src="<?php echo base_url(); ?>images/mail.png" height="15px" /></td>
		<td><div id="user_email"></div></td>
	</tr>
	<tr class="contactDetails">
		<td><img src="<?php echo base_url(); ?>images/house.png" height="15px" /></td>
		<td><span id="cus_address" ></span></td>
	</tr>

	  <tr class="contactDetails">
	  <td>&nbsp;</td>
	  <td><span id="cus_city"></span>&nbsp;&nbsp;<span id="cus_region" ></span>&nbsp;&nbsp;<span id="cus_country"></span>&nbsp;&nbsp;<span id="cus_zip"></span></td>
	  </tr>

		<tr class="contactDetails">
			<td width="3%"><img src="<?php echo base_url(); ?>images/mobile1.png"  /></td>
			<td><span id="cus_mob"></span></td>
		</tr>

		<tr class="contactDetails">
			<td>&nbsp;</td>
			<td><span id="cus_phn1"></span></td>
		</tr>
		 <tr class="contactDetails">
			<td>&nbsp;</td>
			<td><span id="cus_phn2" ></span></td>
		</tr>
		
		<tr>
			<td colspan="2"><div id="grouptypediv"></div></td></td>
		</tr>
    	<tr>
			<td colspan="2"><div id="personalDetails"></div></td></td>
		</tr>
	</table>


        <br/>


         <div style="position:absolute; top:-9px; right:0px; z-index:9999;"><img src="<?php echo base_url(); ?>images/pin.png"  /></div>

        <div >
        <div class="customer-info">
        <div id="info_div"></div>
        <div id="add_info_text" >
            <textarea id="info" class="demo-information" style="resize: none;"></textarea><br/>
            <a href="javascript:void(0);" onclick="addInfo()" style="font:bold 10px Arial, Helvetica, sans-serif; color:#000;"><span id="add"><?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?></span></a>&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="cancelinfo()" style="font:bold 10px Arial, Helvetica, sans-serif; color:#000;"><?php echo $this->global_mod->db_parse($this->lang->line('cancel_btn'));?></a>
         </div>
        </div>




        </div>





			<div class="customer-tag">
<div id="tag_div" class="tag_show"></div>
			
			
			 <div id="add_tag_text" style="color:#999999;">

				<textarea style="background-color:#FFFFCC;border:1px solid #3366FF;resize:none;" id="tag"></textarea><br/>
                                <a href="javascript:void(0);" onclick="addTag()"><?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?></a>&nbsp; &nbsp; &nbsp;
				<a href="javascript:void(0);" onclick="cancelTag()"><?php echo $this->global_mod->db_parse($this->lang->line('cancel_btn'));?></a>
			 </div>
<div class="spacer"></div>
 <div id="add_tag_div" style="color:#999999;float:left;width:30%;">
				<a href="javascript:void(0);" onclick="addTagShow()"><?php echo $this->global_mod->db_parse($this->lang->line('add_tag'));?></a>
 </div>

<div style="float:right;width:20%;margin-right: 10px;"> <span id="add_info_div" style="color:#999999;float:right;">
				<a href="javascript:void(0);" onclick="addinfoShow()"><?php echo $this->lang->line('add_info');?></a>
			 </span></div>
    <div class="spacer"></div> 
			</div>
<div>
			</div>



			</div>
			<div class="spacer"></div>

			<div id="history" class="history-area" style="display: none;">
				<div class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('history'));?></div>
				<div class="tabing_customer" style="margin:0 0 0 10px;">
				<ul>
				<li><span id="upcoming_appointments_link" class="select"><a href="javascript:void(0);" onclick="upcomingAppointments()" id="upcoming_appointments_link1"><?php echo $this->global_mod->db_parse($this->lang->line('upcoming_appo'));?></a></span></li>
				<li><span id="past_appointments_link" ><a href="javascript:void(0);" onclick="pastAppointments()" id="past_appointments_link1"><?php echo $this->global_mod->db_parse($this->lang->line('past_appo'));?></a></span></li>
				<li><span id="payments_link"><a href="javascript:void(0);" onclick="payments()" id="payments_link1"><?php echo $this->global_mod->db_parse($this->lang->line('payments'));?></a></span></li>
				</ul>
				</div>

					<div id="appointments_history" style="margin:2px 0 0 9px;">
						<div id="upcoming_appointments" class="App-details"></div>
						<div id="past_appointments" class="App-details"></div>
						<div id="payments"><?php echo $this->global_mod->db_parse($this->lang->line('payment'));?></div>
					</div>
			</div>
</div>
</div>
<div class="spacer"></div>
</div>
</div>