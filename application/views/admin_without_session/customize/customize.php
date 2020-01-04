<?php include('customize.js.php'); ?>
<?php 
if($all_data !=''){ 
		$CnclTxt=$all_data[0]['cancellation_policy'];
		$AppTxt=$all_data[0]['additional_info'];
		$termAndCondition=$all_data[0]['terms_condition'];
		
		$confirm_booking_email_subject=$all_data[0]['confirm_booking_email_subject'];
		$editor1=$all_data[0]["confirm_booking_email"];	
			
		
		$waiting_fr_approval_email_subject=$all_data[0]['waiting_fr_approval_email_subject'];		
		$editor2=$all_data[0]['waiting_fr_approval_email'];
		
		$sent_after_service_email_subject=$all_data[0]['sent_after_service_email_subject'];		
		$editor3=$all_data[0]['sent_after_service_email'];
		
		$reschedu_an_appoint_email_subject=$all_data[0]['reschedu_an_appoint_email_subject'];	
		$editor4=$all_data[0]['reschedu_an_appoint_email'];
		
		$alert_before_appointment_email_subject=$all_data[0]['alert_before_appointment_email_subject'];	
		$editor5=$all_data[0]['alert_before_appointment_email'];
		
		$alert_appointment_approval_email_subject=$all_data[0]['alert_appointment_approval_email_subject'];	
		$editor6=$all_data[0]['alert_appointment_approval_email'];
		
		$appointment_cancellation_email_subject=$all_data[0]['appointment_cancellation_email_subject'];	
		$editor7=$all_data[0]['appointment_cancellation_email'];
		
		$appointment_denial_email_subject=$all_data[0]['appointment_denial_email_subject'];	
		$editor8=$all_data[0]['appointment_denial_email'];
		
		$login_detail_email_subject=$all_data[0]['login_detail_email_subject'];	
		$editor9=$all_data[0]['login_detail_email'];
				
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
<form action="customize" id="customizeForm" method="POST">
<div id="mainDiv" style="height: auto;">
    <div id="tabContent">
        <table cellspacing="0" cellpadding="0" width="100%" class="insertStaff">
            <tr class="bgImg">
                <td colspan="2" style="padding-bottom: 5px">
                    <div class="wtitle">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="text-align: left; padding: 0px;" class="WizardTitle">
                                    <h1 class="headign-main">Customize</h1>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%" class="aboutPageTable">
                        <!--tr>
                            <td class="aboutPage">
                                <div class="wizardFS">
                                    <span id="PYPolicyDesc">This screen allows you to set your appointment and cancellation policies. It will be displayed at the time of booking.</span>
                                </div>
                            </td>
                            <td class="aboutPage" style="text-align: right; padding-right: 5px; width: 100px;">
                                <a onclick="window.parent.callSubmitBug_xh('http://simosilmu.bookient.com:80/admin/Wizard/Bookient-Policy.aspx')" id="submitBugLink" href="javascript:void(0);">
                                    <span id="MAsubmitbug">Need Help?</span></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="EmptyTd">&nbsp;</td>
                <td valign="top">
                    <table cellspacing="0" cellpadding="5" border="0" width="100%" class="bussinessDetail">
                        <tr>
                            <td colspan="2">
                                <div class="bussinessDetailBlockHeading">
                                    <span id="PYYourCancellationPolicy">1. Your Cancellation Policy.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td class="bussinessDetailInput">&nbsp;
                                <textarea style="padding: 4px;"  onkeyup="checkTextAreaMaxLimit(this.value);" onfocus="_g(this, 'CancellationPolicy');" cols="80" rows="4" id="CnclTxt" name="CnclTxt"><?php echo $CnclTxt; ?></textarea>
                                <div style="font-family: Arial; font-size: 10px; width: 75%; text-align: justify; color: #666666;">
                                    <strong>Tip:</strong> Please use the following code to replace with your data<br>
                                    <strong>{yourphone}</strong> → Replaces your phone number.<br>
                                    <strong>{CancellationHour}</strong> → Replaces your cancellation hours.<br>
                                    <strong>{mail}</strong> → Replaces your email.
                                </div>
                                <br>&nbsp;<span class="txtLimit" id="tagLimitCancel">  1699 characters remaining</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="bussinessDetailBlockHeading">
                                    <span id="PYAdditionalInformation">2. Additional Information.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td class="bussinessDetailInput">&nbsp;
                                <textarea style="padding: 4px;"  onkeyup="checkTextAreaMaxLimit1(this.value);" onfocus="_g(this, 'AppointmentPolicy');" cols="80" rows="4" id="AppTxt" name="AppTxt"><?php echo $AppTxt; ?></textarea>
                                <br>&nbsp;<span class="txtLimit" id="tagLimitAddInfo">  1945 characters remaining</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="bussinessDetailBlockHeading">3. Terms &amp; Condition</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td class="bussinessDetailInput">&nbsp;
                                <textarea style="padding: 4px;" onblur="checkTextAreaMaxLimit();" onkeyup="checkTextAreaMaxLimit2(this.value);" onfocus="_g(this, 'TermsAndCondition');" cols="80" rows="4" id="termAndCondition" name="termAndCondition"><?php echo $termAndCondition; ?></textarea>
                                <br>&nbsp;<span class="txtLimit" id="tagLimittermAndCon">  2481 characters remaining</span>
                            </td>
                        </tr-->
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom">1. Customize emails.</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
                                    Use {Smarty Tags} to replace tags with the value required from the database. e.g.
                                    to show first name use {FNAME}. You can get tags from the drop down in the editor.
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td class="mailTdAppointyMailText">
                                <div style="padding-bottom: 10px; width: 688px">
                                    <div class="spiffyfg">
                                        <div style="margin: 0 17px 0 22px;" class="business-hr-blue-bg-border">
                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                <tr>
                                                    <td align="left">
                                                        1. Email to be sent on Confirm Booking 
                                                        <a   href="javascript:void(0);">      
                                                            <span onclick="showEmailDetails('1');" class="right-arrow" id="arrowright1" style="display: inline;">
                                                                <span class="right-arrow-spn"></span>Edit
                                                            </span>
                                                            <span style="display: none;" onclick="hideEmailDetails('1');" class="down-arrow" id="arrowdown1">
                                                                <span class="down-arrow-spn"></span>Edit
                                                            </span>

                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails1">	
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="confirm_booking_email_subject" maxlength="100" value="<?php echo $confirm_booking_email_subject; ?>" name="confirm_booking_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor1" name="editor1" rows="10"><div id=":c5" class="ii gt"><?php echo $editor1; ?></textarea><input type="button" saveId="1" class="save-btn" id="btn1" value="Save" name="btn1"  >
	                                                <script type="text/javascript">
	                                                    CKEDITOR.replace( 'editor1',
	                                                    {
	                                                        skin : 'kama',
	                                                        height:"400",
	                                                        width:"100%"
	                                                    });	
																										
	                                                </script>
                                                    </div>
                                                    </td>
                                                </tr>
                                                
												
												<tr>
                                                <td align="left">
                                                    2. Email to be sent on Booked but waiting for approval 
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('253');" class="right-arrow" id="arrowright253" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('253');" class="down-arrow" id="arrowdown253">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails253">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="waiting_fr_approval_email_subject" maxlength="100" value="<?php echo $waiting_fr_approval_email_subject; ?>" name="waiting_fr_approval_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor2" name="editor2" rows="10">
                                                            <?php echo $editor2; ?>
                                                     </textarea> 
													 <input type="button" saveId="2" class="save-btn" id="btn2" value="Save" name="btn2"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor2',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												
												<tr>
                                                <td align="left">
                                                    3. Thank you email to be sent after service
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('3');" class="right-arrow" id="arrowright3" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('3');" class="down-arrow" id="arrowdown3">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails3">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="sent_after_service_email_subject" maxlength="100" value="<?php echo $sent_after_service_email_subject; ?>" name="sent_after_service_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor3" name="editor3" rows="10">
														<?php echo $editor3; ?>                                                           
                                                     </textarea> 
													  <input type="button" saveId="3" class="save-btn" id="btn3" value="Save" name="btn3"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor3',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                    1. Email to be send after Rescheduling an appoientemnt
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('4');" class="right-arrow" id="arrowright4" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('4');" class="down-arrow" id="arrowdown4">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails4">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="reschedu_an_appoint_email_subject" maxlength="100" value="<?php echo $reschedu_an_appoint_email_subject; ?> " name="reschedu_an_appoint_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor4" name="editor4" rows="10">
                                                            <?php echo $editor4; ?> 
                                                     </textarea> 
													  <input type="button" saveId="4" class="save-btn" id="btn4" value="Save" name="btn4"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor4',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                   2. Email alert to be send before appointment
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('5');" class="right-arrow" id="arrowright5" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('5');" class="down-arrow" id="arrowdown5">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails5">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="alert_before_appointment_email_subject" maxlength="100" value="<?php echo $alert_before_appointment_email_subject; ?> " name="alert_before_appointment_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor5" name="editor5" rows="10">
                                                              <?php echo $editor5; ?> 
                                                     </textarea> 
													 <input type="button" saveId="5" class="save-btn" id="btn5" value="Save" name="btn5"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor5',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                    3. Email  to be send on appointment approval
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('6');" class="right-arrow" id="arrowright6" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('6');" class="down-arrow" id="arrowdown6">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails6">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="alert_appointment_approval_email_subject" maxlength="100" value=" <?php echo $alert_appointment_approval_email_subject; ?> " name="alert_appointment_approval_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor6" name="editor6" rows="10">
                                                             <?php echo $editor6; ?> 
                                                     </textarea> 
													  <input type="button" saveId="6" class="save-btn" id="btn6" value="Save" name="btn6"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor6',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                    4. Email  to be send on appointment cancellation
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('7');" class="right-arrow" id="arrowright7" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('7');" class="down-arrow" id="arrowdown7">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails7">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="appointment_cancellation_email_subject" maxlength="100" value="<?php echo $appointment_cancellation_email_subject; ?> " name="appointment_cancellation_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor7" name="editor7" rows="10">
                                                            <?php echo $editor7; ?> 
                                                     </textarea> 
													 <input type="button" saveId="7" class="save-btn" id="btn7" value="Save" name="btn7"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor7',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                    5. Email  to be send on appointment denial
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('8');" class="right-arrow" id="arrowright8" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('8');" class="down-arrow" id="arrowdown8">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails8">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="appointment_denial_email_subject" maxlength="100" value="<?php echo $appointment_denial_email_subject; ?> " name="appointment_denial_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor8" name="editor8" rows="10">
                                                            <?php echo $editor8; ?> 
                                                     </textarea> 
													 <input type="button" saveId="8" class="save-btn" id="btn8" value="Save" name="btn8"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor8',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>
												<tr>
                                                <td align="left">
                                                    6. Email  to be send on user registration
                                                    <a href="javascript:void(0);">      
                                                        <span onclick="showEmailDetails('9');" class="right-arrow" id="arrowright9" style="display: inline;">
                                                            <span class="right-arrow-spn"></span>Edit
                                                        </span>
                                                        <span style="display: none;" onclick="hideEmailDetails('9');" class="down-arrow" id="arrowdown9">
                                                            <span class="down-arrow-spn"></span>Edit
                                                        </span>       
                                                    </a>
                                                </td>

                                                </tr>
                                                <tr>

                                                <td>
                                                    <div style="display: none;" class="customize-email" id="customizeEmailDetails9">
                                                        <div class="subjectDiv">
                                                            <span class="SubjectText">Subject:</span>&nbsp;<input type="text" style="width:250px;" id="login_detail_email_subject" maxlength="100" value="<?php echo $login_detail_email_subject; ?> " name="login_detail_email_subject">                                                   
                                                        </div>
                                                    <textarea cols="80" id="editor9" name="editor9" rows="10">
                                                            <?php echo $editor9; ?> 
                                                     </textarea> 
													  <input type="button" saveId="9" class="save-btn" id="btn9" value="Save" name="btn9"  >
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'editor9',
                                                    {
                                                        skin : 'kama',
                                                        height:"400",
                                                        width:"100%"
                                                    });
                                                </script>
                                                    </div>

                                                </td>

                                                </tr>

                                                </table>
                                        </div>
                                    </div>
                                    <b class="spiffy"><b class="spiffy5"></b><b class="spiffy4"></b><b class="spiffy3"></b>
                                        <b class="spiffy2"><b></b></b><b class="spiffy1"><b></b></b></b>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom">
                                   2. Customize Form.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
                                    Create your own custom form, which would be shown to clients at the time of Booking.
                                    e.g. A Dog grooming company can ask for the Dog's name, breed, weight, etc., at
                                    the time of Booking.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">
                                &nbsp;
                            </td>
                            <td style="padding-left: 0px;">
                                <table cellspacing="0" cellpadding="0" border="0" class="RulesAndLayoutTable">
                                    <tr>
                                        <td>
                                            <span id="ASRequireBriefNote">Do you require any extra information with every appointment?</span>
                                        </td>
                                        <td class="AppSelectionRules">
                                            <input type="radio" onclick="toggleMemoText(this.value);" <?php if($pre_booking_frm == 1){?>checked="checked"<?php } ?> name="appointmentNote" id="appointmentNote1" value="1"><label for="appointmentNote1">Yes</label>
                                            <input type="radio" onclick="toggleMemoText(this.value);" <?php if($pre_booking_frm == 0){?>checked="checked"<?php } ?> name="appointmentNote" id="appointmentNote2" value="0"><label for="appointmentNote2">No</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div id="etcInfoSpan" <?php if($pre_booking_frm == 0){?>style="display: none;"<?php } ?>>
                                                <div class="etcInfo" style="display: block;">
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%"  style="background-color: #DBEAF9;">
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 5px; padding-top: 8px;">
                                                                <span id="ASEtcInfoHeading">What information would you like to take from client at the time of booking?</span>&nbsp;
                                                                <small style="color: #C90405;"><i>(click on save button below to save this setting)</i></small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 3px;" class="AppSelectionRules">
                                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Field Name</strong>
                                                                        </td>
                                                                        <td>
                                                                            <strong>Service(s)</strong>
                                                                        </td>
                                                                        <td>
                                                                            <strong>Data Type</strong>
                                                                        </td>
                                                                        <td>
                                                                            <strong>Required</strong>
                                                                        </td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text" id="txtFieldName" name="txtFieldName" onclick="displayBorderNone()">
                                                                        </td>
                                                                        <td>
																		<div class="relative">
                                                                            <div onmouseout="arx(this)" onmouseover="arw(this)" id="cusSerIDBox" class="">
                                                                                <div id="cusSerIDBoxNm">All Services</div>
                                                                                <div id="cusSerIDBoxList" style="display: none;">
                                                                                    <ul id="serviceUl">
                                                                                        <li><input type="checkbox" checked="checked" onclick="displayServices('0')" value="0" class="checkbox" id="applicbl_services_for_0" name="applicbl_services_for_0"> all services </li>
																				<?php if($AllServices !=''){  ?>
																				<?php foreach($AllServices as $data){  ?>
                                                                                        <li><input type="checkbox" onclick="displayServices('<?php echo $data['service_id'];  ?>')" value="<?php echo $data['service_id'];  ?>" class="checkbox" id="applicbl_services_for_<?php echo $data['service_id']; ?>" name="applicbl_services_for_<?php echo $data['service_id']; ?>"><?php echo $data['service_name'];?> </li>  
																				<?php } ?>
																				<?php } ?>
                                                                                    </ul>
                                                                                    <input type="hidden" value="7" id="serviceUlCounter" name="serviceUlCounter">
                                                                                </div>
                                                                            </div>
																			</div>
                                                                        </td>
                                                                        <td>
                                                                            <select onchange="dataType(this.value);" id="ddlDataType">
																			    <?php foreach($All_Data_Type as $data){  ?>
                                                                                <option value="<?php echo $data['data_type_id'];  ?>">
																				    <?php echo $data['name'];  ?>
																				</option>
																				<?php } ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>
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
												                            <input onclick="multiFieldEntry();" class="btn-blue" type="button" value="Add">
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
                                                                                    <b>Options</b>																				
                                                                                    <li id="optn_1" class="optn-cls">																					
                                                                                        <input type="text" class="optionTextBox-cls" value="" id="optionTextBox_1" name="optionTextBox_1" style="width:100px"/>&nbsp;
                                                                                        <a onclick="multiOptionEntry(1);" href="javascript:void(0)">Add</a>
                                                                                        <input type="hidden" id="optn_hdn" name="optn_hdn" value="3"/>
                                                                                    </li>																					
                                                                                    <li id="optn_2" class="optn-cls">																						
                                                                                        <input type="text" class="optionTextBox-cls" id="optionTextBox_2" name="optionTextBox_2"  style="width:100px">	
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <div id="customfield1"></div>
																			<ul class="ul_customField">
                                                                                <li class="cls-field">
																					<table cellspacing="0" cellpadding="0" border="0" width="100%" id="customFieldTbHead" class="customFieldTb customFieldTbHead" style="background-color: #55779A;">
                                                                                        <tr>
																					        <td width="20px"></td>
																					        <td width="150px" style="color: #ffffff">Field Name</td>
																					        <td width="120px" style="color: #ffffff">Service</td>
																					        <td width="150px" style="color: #ffffff">Field Type</td>
																					        <td width="50px" style="color: #ffffff">Required</td>
																					        <td width="30px" align="center" colspan="2" style="color: #ffffff">Action</td>	
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
		$field_name_edit='<input type="text" name="field['.$field_id.'][name]" id="field_name_edit_'.$field_id.'" value="'.$field_name.'" />';

		//services		
		$field_seriveces=$field['services_ids'];
		$counter=0;
		if($field_seriveces !='0'){
			foreach($field_seriveces as $service){		
				$counter=$counter+1;
			}
			$services = $counter." service selected";
			$fldIsChkedVal1='';
		}else{
			$services="All Services";
			$fldIsChkedVal1='checked="checked"';
		}
		$field_service_edit='';	
	$field_service_edit .='<div onmouseout="fieldServiceDropdownHide('.$field_id.')" onmouseover="fieldServiceDropdownShow('.$field_id.')" class="fieldSrvceDropdown_'.$field_id.'" id="fieldSrvceDropdown_'.$field_id.'" ><div class="ser-dropdown-head" id="cusSerIDBoxNm_'.$field_id.'">'.$services.'</div><div id="cusSerIDBoxList_'.$field_id.'" class="ser-position-absolute" style="display: none;"><ul id="serviceUl"><li><input type="checkbox" onclick="fieldDisplayServices(0,'.$field_id.')" value="0" class="checkbox_'.$field_id.'"   id="field_applicbl_services_for_0_'.$field_id.'" name="field['.$field_id.'][service][0]" '.$fldIsChkedVal1.'> all services </li>';

	foreach($AllServices as $data){
		$e_service_id=$data['service_id'];
		$e_service_name=$data['service_name'];
		$fldIsChkedVal='';
		if($field_seriveces !='0'){
			$fldIsChked=in_array($e_service_id,$field_seriveces);
			if($fldIsChked){
				
				$fldIsChkedVal='checked="checked"';			
			}else{
				$fldIsChkedVal='';
				
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
			$option_val_display=$option_val['value'];				
			if($count ==0){
				$add ='<a onclick="fieldMultiOptionEntry('.$field_id.');" href="javascript:void(0)">Add</a>';
			}else{
				$add ='';
			}
			if($count !=0 &&  $count !=1)
			{
				$remove ='<a onclick="fieldMultiOptionRemove('.$field_id.','.$count.');" href="javascript:void(0)">remove</a>';
			}else{
				$remove ='';
			}
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="field-optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">'.$remove.'&nbsp;'.$add.'</li>';	
			$count=$count+1;		
		}
		if($count ==1){		
			$option_val_display='';				
			$add ='';
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="field-optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">&nbsp;'.$add.'</li>';	
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
			$field_option_edit .='<li id="field_optn_'.$field_id.'_'.$count.'" class="optn-cls_'.$field_id.'"><input type="text" class="field-optionTextBox-cls_'.$field_id.'" value="'.$option_val_display.'" id="optionTextBox_'.$field_id.'_'.$count.'"  name="field['.$field_id.'][datatype][option]['.$count.']" style="width:100px">&nbsp;'.$add.'</li>';	
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
		<table id="table_customField_show<?php echo $field_id; ?>" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-view"><tr><td width="20px"></td><td width="150px" id="td_field_name_<?php echo $field_id; ?>"><strong><?php echo $field_name; ?></strong></td><td id="td_service_<?php echo $field_id; ?>" width="120px"><?php echo $services; ?></td><td id="td_datatype_<?php echo $field_id; ?>" width="150px"><strong><?php echo $data_type_idValue; ?></strong></td><td id="td_requre_<?php echo $field_id; ?>" width="50px"><strong><?php echo $requreValue; ?></strong></td><td width="30px"><a onclick="multiFieldEdit(<?php echo $field_id; ?>);" href="javascript:void(0)">Edit</a></td><td width="30px"><a onclick="multiFieldRemove(<?php echo $field_id; ?>);" href="javascript:void(0)">Remove</a></td></tr></table>
			
		<table id="table_customField_edit<?php echo $field_id; ?>" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-edit" style="display:none;"><tr><td width="20px"></td><td width="150px"><strong><?php echo $field_name_edit; ?></strong></td><td width="120px"><?php echo $field_service_edit; ?></td><td width="150px"><strong><?php echo $field_datatype_edit; ?><?php echo $field_option_edit; ?></strong></td><td width="50px"><strong><?php echo $required_edit; ?></strong></td><td width="30px"></td><td width="30px"><a onclick="fieldSave(<?php echo $field_id; ?>);" href="javascript:void(0)">Save</a></td></tr></table>
		
	</li>																																											
	<?php } ?>
<?php } ?>			

<!--###########field End##########-->																					
					
																			</ul>
                                                                            <div style="display: none" id="etcInfoSaveMess">
                                                                                <small style="color: #C90405;"><i>(click on save button below to save this setting)</i></small>
                                                                            </div>
                                                                            <input type="hidden" id="customfield" name="customfield">
                                                                            <div style="padding-top: 10px;">
                                                                                <div>
                                                                                    <input type="checkbox" checked="checked" name="EtcInfoClient" id="EtcInfoClient">
                                                                                    Do you want to allow clients to access information submitted while booking past appointments?&nbsp;
                                                                                </div>
                                                                            </div>
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
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom">3. Set calendar background image.</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
                                    By default the Bookient Logo is displayed as the background image of your calendar. You can add a different image by writing the full image path in the text box below. (i.g. http://www.Bookient.com/images/logo.gif)
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td style="padding-left: 0px;">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>Image path:</td>
                                        <td>
                                            <input type="text" style="width:400px;" id="backgroungImagePath" value="<?php echo $backgroungImagePath; ?>" name="backgroungImagePath">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td style="font-size: 11px; color: #888484; padding: 0px 0px 0px 5px;">eg: http://abc.com/imagename.png</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeadingNoBottom">4. URL of calendar on your site.</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bussinessDetailInput" colspan="2">
                                <div class="bussinessDetailhedingTextHelpWithBottom">
                                    If you are integrating Bookient on your site please enter the URL of that page in the text box below. We will use this URL to redirect users to your desired page after payments, email verifications, ratings, etc. Leave empty if you are not integrating your calendar on your website. By default, users will be redirected to <?php echo base_url();?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">&nbsp;</td>
                            <td style="padding-left: 0px;">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>Widget URL:</td>
                                        <td>
                                            <input type="text" value="<?php echo $pageAddressWidget; ?>"  style="width:400px;" id="pageAddressWidget" name="pageAddressWidget">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td style="font-size: 11px; color: #888484; padding: 0px 0px 0px 5px;">eg: http://www.inglesenmadrid.com/pide-hora/</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 0px;" colspan="2">
                                <div class="bussinessDetailBlockHeading">5. Your social channels.</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px" class="bussinessDetailhedingText">
                                &nbsp;
                            </td>
                            <td style="padding-left: 0px;">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>Facebook page URL:</td>
                                        <td>
                                            <input type="text" value="<?php echo $facebookpageurl; ?>" style="width:400px;" id="facebookpageurl" name="facebookpageurl">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td style="font-size: 11px; color: #888484; padding: 0px 0px 0px 5px;">eg: http://www.facebook.com/Bookient</td>
                                    </tr>
                                    <tr>
                                        <td>Twitter page URL:</td>
                                        <td>
                                            <input type="text" value="<?php echo $twitterpageurl; ?>" style="width:400px;" id="twitterpageurl" name="twitterpageurl">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td style="font-size: 11px; color: #888484; padding: 0px 0px 0px 5px;">eg: http://twitter.com/Bookient</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="EmptyTd">&nbsp;</td>
                <td class="imgSaveNext">
                     <input type="submit" class="btn-blue" id="ImageButton2" value="Save" name="ImageButton2" onclick="checkCustomizeForm();">
                </td>
            </tr>
        </table>
    </div>
</div>
<input type="hidden" id="hdn_service_arr" name="hdn_service_arr"/>
<input type="hidden" id="hdn_datatype_arr" name="hdn_datatype_arr"/>
</form>
</div>