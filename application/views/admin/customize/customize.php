<?php include('customize.js.php'); ?>
<?php 
if($all_data !=''){ 
		$backgroungImagePath=$all_data[0]['background_image_url'];	
		$pageAddressWidget=$all_data[0]['widget_url'];
		$facebookpageurl=$all_data[0]['facebook_page_url'];	
		$twitterpageurl=$all_data[0]['twitter_page_url'];		
                $pre_booking_frm = $pre_booking_data[0]['pre_booking_frm'];
 	}else{
		$CnclTxt= '';
		$AppTxt='';
		$termAndCondition='';
		
		$confirm_booking_email_subject='';
		$editor1='';
			
		
		$waiting_fr_approval_email_subject='';		
		$editor2='';
		
		$sent_after_service_email_subject='';		
		$editor3='';
		
		$reschedu_an_appoint_email_subject='';
		$editor4='';
		
		$alert_before_appointment_email_subject='';
		$editor5='';
		
		$alert_appointment_approval_email_subject='';
		$editor6='';
		
		$appointment_cancellation_email_subject='';
		$editor7='';
		
		$appointment_denial_email_subject='';	
		$editor8='';
		
		$login_detail_email_subject='';
		$editor9='';
				
		$backgroungImagePath='';
		$pageAddressWidget='';
		$facebookpageurl='';
		$twitterpageurl='';
		
	}
?>	

<div class="rounded_corner_full">
<form name="customizeForm" id="customizeForm" method="POST">
<div id="mainDiv" style="height: auto;">
    <div id="tabContent">
        <table width="100%" class="insertStaff">
            <tr class="bgImg">
                <td colspan="2" style="padding-bottom: 5px">
                    <div class="wtitle">
                        <table border="0" width="100%">
                            <tr>
                                <td style="text-align: left; padding: 0px;" class="WizardTitle">
                                    <h1 class="headign-main"><?php echo $this->lang->line('heading_main')?></h1>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table border="0" width="100%" class="aboutPageTable">
                        <!-- tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom"><?php echo $this->lang->line('customize_choose_language')?>
                                <select name="language_list" id="language_list" onchange="pageReload(this.value)" style="width: 150px;">
                                    <?php
                                    if($this->session->userdata('customize_language') != ""){
                                        $default_language[0]['default_language_id'] = $this->session->userdata('customize_language');
                                        $hiddenField = $this->session->userdata('customize_language');
                                    }else{
                                        $hiddenField = $default_language[0]['default_language_id'];
                                    }
                                    foreach($language_list as $lang){
                                        $selected = ($lang['languages_id'] == $default_language[0]['default_language_id'])?"selected":"";
                                    ?>
                                    <option value="<?php echo $lang['languages_id'];?>" <?php echo $selected;?>><?php echo $lang['languages_name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                </div>
                            </td>
                        </tr -->
                        
        <?php if (in_array(84, $this->global_mod->authArray())){ ?>              
                        
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom"><?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_emails'))?></div>
                                <input type="hidden" name="language" id="language" value="<?php echo $hiddenField; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
                                    <?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_emails_details'))?>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td class="mailTdAppointyMailText">
                                <div style="padding-bottom: 10px; width: 90%">
                                    <div class="spiffyfg">
                                        <div style="margin: 0 17px 0 22px; " class="business-hr-blue-bg-border">
                                        
                                        
<h3><?php echo $this->global_mod->db_parse($this->lang->line("email_customizatn"));?></h3>
<?php echo $this->global_mod->db_parse($this->lang->line("customize_customize_emails_details"));?>
<br>
<br>
 <style>
 	.emailHead{
		background: none repeat scroll 0 0 #969696;
		border-radius: 5px;
		color: #FFFFFF;
		font-size: 13px;
		font-weight: bold;
		margin: 0 8px;
		padding: 8px;
	}
	.emailHead label{
		float: right;
		color:#0000EE;
		font-size: 22px;
		font-weight: bold;
		cursor: pointer;
		padding-right: 20px;
	}
	.htmlContent{
		width:100%;
		margin:20px;
		display: none;
	}

	.emailShortContent{
		border-radius: 5px;
		background: none repeat scroll 0 0 #DBEAF9;
		padding: 0.3em 0.5em;
		vertical-align: middle;
		margin: 10px 20px 0px 20px;
	}
	.clear-hr{
		border-bottom: 1px solid #969696;
		margin: 10px;
	}
 </style>

<?php foreach($getEmailOption as $mainEmailDetails){ ?>

<div class="emailHead">
	<?php echo $mainEmailDetails['purpose']; ?>
	<label onclick="showMailContent(<?php echo $mainEmailDetails['msg_id']; ?>)"> <img src="<?php echo base_url(); ?>asset/admin_image/edit-icon.png" height="25px" width="25px"/><?php echo $this->global_mod->db_parse($this->lang->line("edit_btn"));?></label>
</div>
<div class="emailShortContent">
<?php echo $mainEmailDetails['purpose_details']; ?> 
</div>
<div class="htmlContent" id="htmlContent_<?php echo $mainEmailDetails['msg_id']; ?>">
	<div id="msg_<?php echo $mainEmailDetails['msg_id']; ?>" style="color: #03981D;font-size: 19px;"></div>
	<?php echo $this->global_mod->db_parse($this->lang->line("customize_subject"));?> <input size="100" type="text" name="email_subject_<?php echo $mainEmailDetails['msg_id']; ?>" id="email_subject_<?php echo $mainEmailDetails['msg_id']; ?>" value="<?php echo $this->global_mod->db_parse(trim($mainEmailDetails['mail_demo_subject']));?>"/>&nbsp;&nbsp;
	<span>Email Language :</span>
	<select id="language_list" name="language_list" onchange="GetEmailTemplate(<?php echo $mainEmailDetails["msg_id"];?>,this)">
		<?php
			foreach($language_list as $languages){
		?>
				<option value="<?php echo $languages['languages_id']?>" <?php if($languages['languages_id']==$mainEmailDetails['language_id']){echo 'selected=""';}?>><?php echo $languages['languages_name']?></option>
		<?php		
			}
		
		?>
		
	</select>
	<br><br>
	<textarea id="mainText_<?php echo $mainEmailDetails['msg_id']; ?>" name="mainText_<?php echo $mainEmailDetails['msg_id']; ?>"><?php echo $this->global_mod->db_parse(trim($mainEmailDetails['mail_demo_content'])); ?></textarea>
	<script type="text/javascript">
	CKEDITOR.replace( 'mainText_<?php echo $mainEmailDetails["msg_id"]; ?>',{
	    skin : 'kama',
	    height:"450",
	    width:"96%"
	});											
	</script>
<br>
<input class="btn-blue" type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('save_btn'))?>" onclick="saveMailContent(<?php echo $mainEmailDetails["msg_id"]; ?>);">
</div>
<div class="clear-hr"></div>

<?php } ?>
                                        </div>
                                    </div>
                                    <b class="spiffy"><b class="spiffy5"></b><b class="spiffy4"></b><b class="spiffy3"></b>
                                        <b class="spiffy2"><b></b></b><b class="spiffy1"><b></b></b></b>
                                </div>
                            </td>
                        </tr>
                       
            <?php } ?>
                       
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom">
                                   <?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_form'))?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
									<?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_form_details'))?>
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">
                                &nbsp;
                            </td>
                            <td style="float: left; width: 89%;" >
                            <div class="spiffyfg">
                            	<div style="margin: 0 17px 0 22px; background: none repeat scroll 0 0 #FFFFFF; border: 10px solid #55779A; border-radius: 8px; padding: 9px 10px 0px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr >
                                        <td colspan="2">
                                        <div class="emailHead">
                                            <span id="ASRequireBriefNote"><?php echo $this->global_mod->db_parse($this->lang->line('customize_do_want_extra_info'))?></span>
                                         <span class="AppSelectionRules" style="float: right;margin-right: 43px;">
                                            <input type="radio" onclick="toggleMemoText(this.value);" <?php if($pre_booking_frm == 1){?>checked="checked"<?php } ?> name="appointmentNote" id="appointmentNote1" value="1"><?php echo $this->global_mod->db_parse($this->lang->line('customize_option_yes'))?>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" onclick="toggleMemoText(this.value);" <?php if($pre_booking_frm == 0){?>checked="checked"<?php } ?> name="appointmentNote" id="appointmentNote2" value="0"><?php echo $this->global_mod->db_parse($this->lang->line('customize_option_no'))?>
                                            </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="emailShortContent" id="etcInfoSpan" <?php if($pre_booking_frm == 0){?>style="display: none;"<?php } ?>>
                                                <div class="etcInfo" style="display: block;">
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%"  style="background-color: #DBEAF9;">
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 5px; padding-top: 8px;">
                                                                <span id="ASEtcInfoHeading"><?php echo $this->global_mod->db_parse($this->lang->line('customize_booking_client'))?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 3px;" class="AppSelectionRules">
                                                            
                                                            
                                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td width="30%">
                                                                            <strong><?php echo $this->global_mod->db_parse($this->lang->line('customize_field_name'))?></strong>
                                                                        </td>
                                                                        <td width="20%">
                                                                            <strong><?php echo $this->global_mod->db_parse($this->lang->line('customize_service'))?></strong>
                                                                        </td>
                                                                        <td width="20%">
                                                                            <strong><?php echo $this->global_mod->db_parse($this->lang->line('customize_data_type'))?></strong>
                                                                        </td>
                                                                        <td width="10%" align="center">
                                                                            <strong><?php echo $this->global_mod->db_parse($this->lang->line('customize_required'))?></strong>
                                                                        </td>
                                                                        <td width="20%">
                                                                        &nbsp;
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text" id="txtFieldName" name="txtFieldName" onclick="displayBorderNone()" style="border: 1px solid #CCCCCC; border-radius: 5px; float: left; padding: 2px; width: 90%;">
                                                                        </td>
                                                                        <td>
																		<div class="relative" style="background-color: #FFFFFF;border-radius: 3px;cursor: pointer;min-height: 23px; position: relative;">
                                                                            <div onmouseout="arx(this)" onmouseover="arw(this)" id="cusSerIDBox" class="">
                                                                                <div id="cusSerIDBoxNm"><?php echo $this->global_mod->db_parse($this->lang->line('customize_all_services'))?></div>
                                                                                <div id="cusSerIDBoxList" style="display: none;">
                                                                                    <ul id="serviceUl">
                                                                                        <li><input type="checkbox" checked="checked" onclick="displayServices('0')" value="0" class="checkbox" id="applicbl_services_for_0" name="applicbl_services_for_0"> <?php echo $this->global_mod->db_parse($this->lang->line('customize_all_services_sml'))?> </li>
																				<?php if($AllServices !=''){  ?>
																				<?php foreach($AllServices as $data){  ?>
                                                                                        <li><input type="checkbox" onclick="displayServices('<?php echo $data['service_id'];  ?>')" value="<?php echo $data['service_id'];  ?>" class="checkbox" id="applicbl_services_for_<?php echo $data['service_id']; ?>" name="applicbl_services_for_<?php echo $data['service_id']; ?>"><?php echo $data['service_name'];?> </li>  
																				<?php } ?>
																				<?php } ?>
                                                                                    </ul>
                                                                                    <input type="hidden" value="7" id="serviceUlCounter" name="serviceUlCounter" >
                                                                                </div>
                                                                            </div>
																			</div>
                                                                        </td>
                                                                        <td>
                                                                            <select onchange="dataType(this.value);" id="ddlDataType" style="border: 1px solid #CCCCCC; border-radius: 5px; float: left; padding: 2px; width: 90%;">
																			    <?php foreach($All_Data_Type as $data){  ?>
																			    <?php if($data['data_type_id'] != 7){?>
	                                                                                <option value="<?php echo $data['data_type_id'];  ?>">
																					    <?php echo $data['name'];  ?>
																					</option>
																				<?php } ?>
																				<?php } ?>
                                                                            </select>
                                                                            
                                                                        </td>
                                                                        <td align="center">
                                                                            <input type="checkbox" name="chkIsRequired" id="chkIsRequired" >
                                                                        </td>
                                                                        <td>
																			<?php 
																			if($AllField !=''){ 																		
																				foreach($AllField as $field ){
																					$field_id_add=$field['field_id'];		
																				}
																				$next_field=$field_id_add+1;
																			}else{
																				$next_field=1;
																			}
																			?><!--a onclick="multiFieldEntry();" href="javascript:void(0);">Add</a-->
												                            <input onclick="multiFieldEntry();" class="btn-blue" type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'))?>">
																			<input type="hidden" id="multiField_hdn" name="multiField_hdn" value="<?php echo $next_field; ?>"/>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                        <td colspan="3">
                                                                            <div id="multiOptionEntry" style="display: none;">																				
                                                                                <ul>
                                                                                    <b><?php echo $this->global_mod->db_parse($this->lang->line('customize_options'))?></b>																				
                                                                                    <li id="optn_1" class="optn-cls">																					
                                                                                        <input type="text" class="optionTextBox-cls" value="" id="optionTextBox_1" name="optionTextBox_1" style="width:100px" />&nbsp;
                                                                              			
                                                                                        <a onclick="multiOptionEntry(1);" href="javascript:void(0)"><?php echo $this->global_mod->db_parse($this->lang->line('customize_add_options'))?></a><br />
                                                                                        <input type="radio" name="is_default" id="" value="defaultRadio_1"  />Is default 
                                                                                        <input type="hidden" id="optn_hdn" name="optn_hdn" value="3"/>
                                                                                    </li>																					
                                                                                    <li id="optn_2" class="optn-cls">																						
                                                                                        <input type="text" class="optionTextBox-cls" id="optionTextBox_2" name="optionTextBox_2"  style="width:100px"><br />
                                                                                        <input type="radio" name="is_default" id="" value="defaultRadio_2" />Is default 	
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <div id="customfield1"></div>
																			<ul class="ul_customField" style="width: 100%">
                                                                                <li class="cls-field">
																					<table border="0" id="customFieldTbHead" class="customFieldTb customFieldTbHead" style="background-color: #55779A;" width="100%">
                                                                                        <tr>
																					        <td width="5%"></td>
																					        <td width="30%" style="color: #ffffff"><?php echo $this->global_mod->db_parse($this->lang->line('customize_field_name'))?></td>
																					        <td width="20%" style="color: #ffffff"><?php echo $this->global_mod->db_parse($this->lang->line('customize_listing_service'))?></td>
																					        <td width="15%" style="color: #ffffff"><?php echo $this->global_mod->db_parse($this->lang->line('customize_field_type'))?></td>
																					        <td width="10%" style="color: #ffffff"><?php echo $this->global_mod->db_parse($this->lang->line('customize_required'))?></td>
																					        <td width="20%" align="center" colspan="2" style="color: #ffffff"><?php echo $this->global_mod->db_parse($this->lang->line('customize_action'))?></td>	
																					    </tr>
																					</table>
																			    </li>
																				<li id="li_customField_0" class="cls-field"></li>
<!--###########field Start##########-->		
					
<?php if($AllField !=''){ ?>														
	<?php foreach($AllField as $field ){
		$field_id=$field['field_id'];
		
		//field name
		$field_name=$field['field_name'];
		$field_name_edit='<input type="text" name="field['.$field_id.'][name]" id="field_name_edit_'.$field_id.'" value="'.$this->global_mod->db_parse($field_name).'" />';

		//services		
		$field_seriveces=$field['services_ids'];
		
		
		$counter=0;
		if($field_seriveces != 0){
			foreach($field_seriveces as $service){		
				$counter=$counter+1;
				
			}
			$fldIsChkedVal1='';
			if(count($AllServices) == $counter){
				$services="All Services selected";
				
				$fldIsChkedVal1='checked="checked"';
			}else{
				$services = $counter." service selected";
			}
			
			
			
		}
		/*else{
			
			$services="All Services";
			$fldIsChkedVal1='';
			$fldIsChkedVal1='checked="checked"';
		}*/
		$field_service_edit='';	
	$field_service_edit .='<div onmouseout="fieldServiceDropdownHide('.$field_id.')" onmouseover="fieldServiceDropdownShow('.$field_id.')" class="fieldSrvceDropdown_'.$field_id.'" id="fieldSrvceDropdown_'.$field_id.'" ><div class="ser-dropdown-head" id="cusSerIDBoxNm_'.$field_id.'">'.$services.'</div><div id="cusSerIDBoxList_'.$field_id.'" class="ser-position-absolute" style="display: none;"><ul id="serviceUl"><li>
	<input type="checkbox" onclick="fieldDisplayServices(0,'.$field_id.')" value="0" class="checkbox_'.$field_id.'"   id="field_applicbl_services_for_0_'.$field_id.'" name="field['.$field_id.'][service][0]" '.$fldIsChkedVal1.'> all services </li>';

	foreach($AllServices as $data){
		$e_service_id = $data['service_id'];
		$e_service_name = $data['service_name'];
		$fldIsChkedVal ='';
		if($field_seriveces != '0'){
			
			$fldIsChked = in_array($e_service_id,$field_seriveces);
			if($fldIsChked){
				
				$fldIsChkedVal = 'checked="checked"';			
			}else{
				
				$fldIsChkedVal = '';
				
			}		
		}	
		
		  
		$field_service_edit .='<li><input type="checkbox" '.$fldIsChkedVal.' onclick="fieldDisplayServices('.$e_service_id.','.$field_id.')" value="'.$e_service_id.'" class="checkbox_'.$field_id.'" id="field_applicbl_services_for_'.$e_service_id.'_'.$field_id.'" name="field['.$field_id.'][service]['.$e_service_id.']">'.$e_service_name.'</li>'; 
	}
	$field_service_edit .='</ul></div></div>';
			
	//datatype
	$data_type_id=$field['data_type_id'];
	$field_option_display='';
	if($data_type_id ==1){
		$data_type_idValue="TEXT";
		$field_option_display='style="display: none;"';		
	}
	if($data_type_id ==2){
		$data_type_idValue="NUMBER";
		$field_option_display='style="display: none;"';
	}
	if($data_type_id ==3){
		$data_type_idValue="DATE";
		$field_option_display='style="display: none;"';
	}
	if($data_type_id ==4){
		$data_type_idValue="RADIO";		
	}
	if($data_type_id ==5){
		$data_type_idValue="LIST";		
	}
	if($data_type_id ==6){
		$data_type_idValue="CHECK BOX";
		$field_option_display='style="display: none;"';
	}if($data_type_id ==7){
		$data_type_idValue="Heading";
		$field_option_display='style="display: none;"';
	}
	
	$field_datatype_edit=''; //datatype	edit
	$field_datatype_edit .='<select name="field['.$field_id.'][datatype][name]" onchange="fieldDataType(this.value,'.$field_id.');" id="ddlDataType_'.$field_id.'">';
																																
	foreach($All_Data_Type as $datatype_val) {
		$data_Type_id_e=$datatype_val['data_type_id'];
		$data_Type_name_e=$datatype_val['name'];
		if($datatype_val['data_type_id'] ==$data_type_id){			
			$fldIsSlecteddVal='selected="selected"';			
		}else{	
			$fldIsSlecteddVal='';			
		}
		
		
			$field_datatype_edit .='<option '.$fldIsSlecteddVal.' value="'.$data_Type_id_e.'">'.$data_Type_name_e.'</option>';
		
		            
	}	
	$field_datatype_edit .='</select>';
		
	//option
	$field_option_edit='';	
	$field_option_edit .='<div id="fieldmultiOptionEntry_'.$field_id.'" '.$field_option_display.'><ul><b>Options</b>';
		
	if(isset($field['option'])){																					
		$count=0;
		
		
		
		foreach($field['option'] as $option_val)
		{
			$option_val_display= $this->global_mod->db_parse($option_val['value']);				
			if($count ==0){
				$add ='<a onclick="fieldMultiOptionEntry('.$field_id.');" href="javascript:void(0)">Add</a>';
			}else{
				$add ='';
			}
			if($count !=0 &&  $count !=1)
			{
				$del_option = $count + 1;
				$remove ='<a onclick="fieldMultiOptionRemove('.$field_id.','.$del_option.');" href="javascript:void(0)">remove</a>';
			}else{
				$remove ='';
			}
			$count=$count+1;
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">'.$remove.'&nbsp;'.$add.'<br /><input type="radio" name="is_default_edit" id="" value="'.$count;	
			
			if($option_val['default_val'] == 1){
				$field_option_edit .= '" checked="" />Is Default'.'</li>';
			}else{
				$field_option_edit .= '" />Is Default'.'</li>';
			}
			
			
					
		}
		if($count ==1){		
			$option_val_display='';				
			$add ='';
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">&nbsp;'.$add.'<br /><input type="radio" name="is_default_edit" id="" value="'.$count;	
			
			if($option_val['default_val'] == 1){
				$field_option_edit .= '" checked="" />Is Default'.'</li>';
			}else{
				$field_option_edit .= '" />Is Default'.'</li>';
			}
			
			$count=$count+1;				
		}
	}else{
		$count=0;
		while($count < 2){
			$option_val_display='';				
			if($count ==0){
				$add ='<a onclick="fieldMultiOptionEntry('.$field_id.');" href="javascript:void(0)">Add</a>';
			}else{
				$add ='';
			}
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">&nbsp;'.$add.'</li>';	
			$count=$count+1;		
		}	
	}	
	$next_value = $count;
	$field_option_edit .='<input type="hidden" id="field_optn_hdn_'.$field_id.'" name="field_optn_hdn_'.$field_id.'" value="'.$next_value.'"/></ul></div>';
	
	//require
	$is_required=$field['is_required'];
	if($is_required =='1'){
	 	$requreValue="Yes";
		$ischecked='checked="checked"';
	}else{
		$requreValue="No";
		$ischecked='';
	}
	$required_edit='<input type="checkbox" name="field['.$field_id.'][required]" '.$ischecked.' id="required_edit_'.$field_id.'">';
	?>																			
																				
	<li class="cls-field" id="li_customField_<?php echo $field_id; ?>">	
		<table id="table_customField_show<?php echo $field_id; ?>" border="0" width="100%" class="customFieldTb customFieldTb-view">
		
		<tr>
			<td width="5%"></td>
			<td width="30%" id="td_field_name_<?php echo $field_id; ?>"><strong><?php echo $this->global_mod->db_parse($field_name); ?></strong></td>
			<td width="20%" id="td_service_<?php echo $field_id; ?>" ><?php echo $services; ?></td>
			<td width="15%"  id="td_datatype_<?php echo $field_id; ?>"><strong><?php echo $data_type_idValue; ?></strong></td>
			<td width="10%" id="td_requre_<?php echo $field_id; ?>"><strong><?php echo $requreValue; ?></strong></td>
			<td width="20%" align="center"><a onclick="multiFieldEdit(<?php echo $field_id; ?>);" href="javascript:void(0)"><?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_emails_edit_option'))?></a>&nbsp;&nbsp;&nbsp;<a onclick="multiFieldRemove(<?php echo $field_id; ?>);" href="javascript:void(0)"><?php echo $this->global_mod->db_parse($this->lang->line('customize_customize_option_remove'))?></a></td>
		</tr>
		</table>
			
		<table id="table_customField_edit<?php echo $field_id; ?>" border="0" width="100%" class="customFieldTb customFieldTb-edit" style="display:none;">
		<tr>
			<td width="5%"></td>
			<td width="30%"><strong><?php echo $field_name_edit; ?></strong></td>
			<td width="20%"><?php  echo $field_service_edit; ?></td>
			<td width="15%"><strong><?php echo $field_datatype_edit; ?><?php echo $field_option_edit; ?></strong></td>
			<td width="10%"><strong><?php echo $required_edit; ?></strong></td>
			<td width="20%" align="center">
				<a onclick="fieldSave(<?php echo $field_id; ?>);" href="javascript:void(0)"><?php echo $this->global_mod->db_parse($this->lang->line('customize_option_save'))?></a>&nbsp;&nbsp; 
				<a href="javascript:void(0)" onclick="cancel_edit(<?php echo $field_id; ?>)">Cancel</a>
			</td>
			
		</tr>
	</table>
		
	</li>																																											
	<?php } ?>
<?php } ?>			

<!--###########field End##########-->																					
					
																			</ul>
                                                                            <div style="display: none" id="etcInfoSaveMess">
                                                                                <small style="color: #C90405;"><i><?php echo $this->global_mod->db_parse($this->lang->line('customize_click_savebtn'))?></i></small>
                                                                            </div>
                                                                            <input type="hidden" id="customfield" name="customfield">
                                                                            <div style="padding-top: 10px;">&nbsp;
                                                                                <!-- div>
                                                                                    <input type="checkbox" checked="checked" name="EtcInfoClient" id="EtcInfoClient">
                                                                                    <?php echo $this->lang->line('customize_allow_client_access')?>&nbsp;
                                                                                </div -->
                                                                            </div >
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            	</div>
                            </div>
                            </td>
                        </tr>
        </table>
    </div>
</div>
<input type="hidden" id="hdn_service_arr" name="hdn_service_arr"/>
<input type="hidden" id="hdn_datatype_arr" name="hdn_datatype_arr"/>
</form>

</div>
