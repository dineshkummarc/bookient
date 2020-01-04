<?php include('social_promotion.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main">Social Promotion </h1>


<div id="AllTemplate">
    <form name="form1" method="post" action="<?php echo base_url(); ?>admin/social_promotion/save" id="form1">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTc3MTk5MDMyNQ9kFgICAQ9kFgICBA8QZA8WAmYCARYCEAUBJQUBMGcQBQNFVVIFATFnZGQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgkFFEFsbG93U29jaWFsUHJvbW90aW9uBQ9wcm9tb3RlQnVzaW5lc3MFB2xheW91dDEFB2xheW91dDIFB2xheW91dDIFB2xheW91dDMFB2xheW91dDMFB2xheW91dDQFB2xheW91dDRm3PxD+P9aM0sIeZm/ADpWpvTLgQ==">
</div>

<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWKALft9/ZBQK4wJfJDgLtkuj1BgLy4Oq3AQLt4Oq3AQLs4Oq3AQL79srLDgLZuL6pBQLGuL6pBQKG3KirCQKH3KirCQK7ivHpAwKkivHpAwLC1OurCALbvs6hCAL/3/CkBALIl/uMCALUjvu4CALTtaTfCAKQuvXnDwLJzeSvDgKYoYb1BgLP0dzNAQLP0bCmCQKQl+a0BALd+u7RBALY6damBQK3pY3vCAL2/qKLBgLN/obgCgKP5oDMAQKM38CuBwL34fOkCwKHy9XqDAK4vPuXCQLdlZmABwKeta6XDgKD1MiJDwLwqqyIDgK2gPC7BbOHAm9/n9uToWujlYJ8eaJC+Rnk">
</div>
    <div id="mainDiv">
        <div id="tabContent" style="padding-left: 5px; padding-right: 5px; width: 97%">
            <div class="bussinessDetail">
                <table width="100%" class="insertStaff" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="aboutSocialPromotion" style="padding-top: 0px">
                            Reward your customers for inviting their friends. Once you activate the "Social
                            Promotion" feature, your clients will see an offer to invite their friends on the
                            "Thank you" page, shown after the "Booking Confirmation" page. With a single click
                            your message can be promoted on their social networking channels. This will act
                            as a personal invitation. We highly recommend it!
                        </td>
                    </tr>
                    </tbody>					
				</table>
                <div class="connectCondition">
                    <div class="socialPromotinDv">
                        <div>
                            <span class="connectMsg">Social promotion is </span><a href="javascript:void(0)" class="on onOffBtCl"></a><span style="display: none;">
                                    <input id="AllowSocialPromotion" type="checkbox" name="AllowSocialPromotion" checked="checked"></span>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>
                
                <div class="socialBody">
                    <div class="bussinessDetailBlockHeadingNoBottom extraHd" style="margin-top: 10px;">
                        1. Attach an Offer</div>
                    <div class="wizardFS extraSbHd">
                        Request your clients to invite their friends after booking. Offer an incentive to
                        motivate your clients to invite their friends. You can offer a discount to your
                        regular service price, or a value added service/goods.
                    </div>
                    <div>
                        <div class="connectConditionOption">
                            <span style="display: none;">
                                <input id="promoteBusiness" type="checkbox" name="promoteBusiness" checked="checked">
                            </span>
                            <table style="width: 100%;">
                                <tbody><tr>
                                    <td class="NewPromotionTextHeadings">
                                        Give
                                    </td>
                                    <td>
                                        <select name="offerType" id="offerType">
											<option selected="selected" value="0">A discount</option>
											<option value="1">An offer</option>
											<option value="2">Nothing but request</option>
										</select>
                                        <span id="discountValSelSp">of
                                            <input name="promoteBusinessPer" type="text" value="10" maxlength="2" id="promoteBusinessPer" onblur="checkPromotionForm();" style="width:23px;">
	                                        <select name="offerIn" id="offerIn">
												<option selected="selected" value="0">%</option>
												<option value="1">EUR</option>
											</select>
                                        </span>
                                        <div class="extraSbHd1">
                                            Appointments booked with a "Social Promotion Offer" will not be applied automatically.
                                            Administrators and staff will see an
                                            <img src="../../Images/Stat/Social Promotion.png" alt="" border="0">
                                            next to all eligible bookings with the "Social Promotion" feature.
                                        </div>
                                    </td>
                                </tr>
                                </tbody><tbody id="offserUseTbody">
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            To
                                        </td>
                                        <td>
                                            <select name="promoteToType" id="promoteToType">
												<option selected="selected" value="1">Client</option>
												<option value="2">Client &amp; his Friend</option>
											</select>
                                            <div class="extraSbHd1">
                                                Social Promotion can be given to both, the person who promotes (referred as "Client"
                                                here) and the person who books as a result of "Social Promotion" (referred as "Client's
                                                Friend" here). For example, A Hot Air Ballooning company can either offer a "5%
                                                discount" to the person who promotes their service/business, or the person who books
                                                after seeing the promotion, or to both.
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            When
                                        </td>
                                        <td>
                        <select name="offerAppliedOn" id="offerAppliedOn">
							<option selected="selected" value="0">Apply when someone books from an invitation</option>
							<option value="1">Apply on promotion</option>
						</select>
                                            <div class="extraSbHd1">
                                                You can decide when this "Social Promotion" offer will be valid. You can offer a
                                                "Free Welcome Drink" to anybody who promotes your business/service or offer a "$5
                                                Cashback" only when someone books an appointment from the promotion. All bookings
                                                eligible for a "Social Promotion" offer will have a
                                                <img src="../../Images/Stat/Social Promotion.png" alt="" border="0">
                                                next to it.
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bussinessDetailBlockHeadingNoBottom extraHd" style="margin-top: 40px;">
                        2. Design your Offer</div>
                    <div class="wizardFS extraSbHd">
                        This will be shown on the "Thank You" page after booking. Make it as creative as
                        you can.</div>
                    <div>
                        <div style="float: left"> <!-- left part -->
                            <div class="NewPromotionFieldSet">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr>
                                        <td class="NewPromotionTextHeadings">
                                            Title
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionText">
                                            <input name="NewPromotionTitle" onkeyup="showTitle(this.value)" type="text" value="Hey, lets get social!" id="NewPromotionTitle" style="width:430px;">
											
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            Description
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionText">
                                            <textarea name="NewPromotionDescription" onkeyup="showDescription(this.value)" rows="5" cols="20" id="NewPromotionDescription" style="height:125px;width:430px;">Why come alone? Invite your friends to come along with you. Just click on the button below and invite your friends on Facebook &amp; Twitter.</textarea>
										
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="float: left;">
                                                <a href="javascript:void(0)" onclick="adSetting()" class="advanceOptionLink" id="advanceOptionLink">Advance setting</a>
                                            </div>
                                            <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                                Please do not enter HTML tag
                                            </div>
                                            <div style="clear: both;"></div>
                                        </td>
                                    </tr>
                                </tbody></table>
                                <table cellpadding="0" id="advanceSettingTb" style="display: none;"  cellspacing="0" border="0">
                                    <tbody><tr>
                                        <td class="NewPromotionTextHeadings">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tbody>													
												<tr>
                                                    <td class="cssSetting" colspan="4">
                                                        Color:
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cssSetting">
                                                        Background
                                                    </td>
                                                    <td class="cssSetting">
                                                        Border
                                                    </td>
                                                    <td class="cssSetting">
                                                        Title
                                                    </td>
                                                    <td class="cssSetting">
                                                        Description
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cssSetting">
                                                        <input name="bgColor" type="text" value="#ffffff" id="bgColor" style="width:50px;">
                                                    </td>
                                                    <td class="cssSetting">
                                                        <input name="borColor" type="text" value="#cccccc" id="borColor" style="width:50px;">
                                                    </td>
                                                    <td class="cssSetting">
                                                        <input name="titleColor" type="text" value="#241924" id="titleColor" style="width:50px;">
                                                    </td>
                                                    <td class="cssSetting">
                                                        <input name="descColor" type="text" value="#241924" id="descColor" style="width:50px;">
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            Image
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tbody><tr>
                                                    <td class="cssSetting">
                                                        Path
                                                    </td>
                                                    <td class="cssSetting">
                                                        Repeat
                                                    </td>
                                                    <td class="cssSetting">
                                                        Position
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cssSetting">
                                                        <input name="NewPromotionImage" type="text" id="NewPromotionImage" style="width:150px;" onkeyup="showImg()" value="<?php echo ($DesignOffer !='')?$DesignOffer[0]['image_path']:'' ?>">
                                                    </td>
                                                    <td class="cssSetting">
			                                            <select name="ImageRepeat" id="ImageRepeat" onchange="showImg()">
															<option value="no-repeat" >No</option>
															<option  value="repeat">Yes</option>
															<option value="repeat-x">X</option>
															<option value="repeat-y">Y</option>

														</select>
                                                    </td>
                                                    <td class="cssSetting">													
                                                        <select name="ImagePosition" id="ImagePosition" onchange="showImg()">
															<option value="left top" >left top</option>
															<option value="left center" >left center</option>
															<option value="left bottom" >left bottom</option>
															<option value="center top" >center top</option>
															<option  value="center center">center center</option>
															<option value="center bottom">center bottom</option>
															<option value="right top">right top</option>
															<option value="right center" >right center</option>
															<option value="right bottom">right bottom</option>

														</select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <span class="socialnote">Max. Width: 100px&nbsp;&nbsp;Max. Height: 200px</span>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>
                                <span class="arrowOutter"></span><span class="arrowInner"></span>
                            </div>
                        </div> 
                        <div style="float: left;width:510px"><!-- right part -->                          
                            <div class="socialBlockMain">  
								<?php
								$display='';
								$counter =1;
								 foreach($ALLTemplate as $template){ ?>
									<div class="socialBlockOuter" id="socialBlockOuter<?php echo $template['template_id']; ?>"
								<?php	
								if($DesignOffer!=''){
									if($DesignOffer[0]['template_id'] !=$template['template_id']){
										$display='display:none;';
									}
									else{
										$display='display:block;';
									}
								}
								else{
									if($counter !=1){
										$display='display:none;';
									}																		
								} 								
								?>									
								style="border:4px solid #ccc;<?php echo $display; ?>"	>  										
							        <?php echo  $template['template_body'];  ?> 
									</div>       
								<?php $counter=$counter+1; } ?>
                            </div>
                            <div style="float: right;">
							<table cellspacing="0" cellpadding="0" border="0">
                                        <tbody><tr>
							<?php 
							$counter =1;
							foreach($ALLTemplate as $template){	?>
							<td class="layoutTD">
                                 <label for="layout1">
                                      <img src="<?php echo base_url()?>uploads/social_icon/<?php echo $template['social_icon']; ?>"/>
									  </label>
                            </td>															   																	
							<?php $counter=$counter+1;	} ?>  
							</tr>	
							<tr>
							<?php 
							$counter =1;
							foreach($ALLTemplate as $template){	?>																					<td class="layoutTD padBot">			   				
								<input type="radio" value="<?php echo $template['template_id']; ?>"  name="teplateRadio" onclick="showSocialTemplate(<?php echo $template['template_id']; ?>)" 
								<?php	if($DesignOffer!=''){
									if($DesignOffer[0]['template_id'] ==$template['template_id']){
										echo 'checked=""';
									}
								}
								else{
									if($counter ==1){
										echo 'checked=""';
									}																		
								} 								
								?>									
								/>
								</td>
							<?php $counter=$counter+1;	} ?>  
							
                                  </tr>
								  </tbody>
								  </table>
                           
                            </div>
                            <div style="clear: both;">
                            </div>                            
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                    <div class="bussinessDetailBlockHeadingNoBottom  extraHd" style="margin-top: 20px;">
                        3. Design your promotion message:</div>
                    <div class="wizardFS extraSbHd">
                        Design the message to be promoted on your client's Social Channels. You can use
                        smarty tags like {AppointmentDate}
                    </div>
               
                    <div>
                        <div>
                            <div class="NewPromotionDiv socialMsgUpper" style="float: left;">
                                <div style="" class="facebookMsgTx">
                                    <div style="font-weight: bold;">
                                        Create Message to be posted on Facebook
                                    </div>
									<div>
                                        <div>
											<textarea name="faceboxMessage" rows="2" cols="20" id="faceboxMessage" onkeyup="checkTextAreaMaxLimitfacebook(this.value);" maxlength="410"  style="height:125px;width:430px;">I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discount to any service offered.</textarea>
										</div>
                                        <div id="Limit0" class="socialnote" style="float: left;">  </div>
                                        <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                            Please do not enter HTML tag
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                                <span class="arrowOutter"></span><span class="arrowInner"></span>
                            </div>
                            <div class="NewPromotionDiv" style="float: left;">
                                <div style="position: relative;" class="socialMsgLook">
                                    <div class="showspiral">
                                    </div>
                                    <div style="padding: 15px; margin-bottom: 15px;">
                                        <a href="javascript:void(0)" style="float: left; margin-right: 10px">
                                            <img alt="User Image" src="<?php echo base_url(); ?>Images/fbUser.gif" title="User Image">
                                        </a>
                                        <div style="vertical-align: top; float: left; width: 390px;">
                                            <div>
                                                <div style="color: #3B5998; font-weight: bold; font-size: 11px; cursor: pointer;">
                                                    Facebook User
                                                </div>
                                                <span style="font-size: 11px;" id="faceboxMessageSpnId">
                                                    I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discount to any service offered.</span>
                                                <div>
                                                    <div>
                                                        <div class="faceBookMsg">
                                                            <img src="https://www.appointy.com/assets/AppointyImages/28929/LogoImage.jpg" alt="">
                                                            <div style="width: 280px; float: left;">
                                                                <div>
                                                                    <div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;">
                            </div>
                        </div>
                        <div>
                            <div class="NewPromotionDiv socialMsglower" style="float: left;">
                                <div class="facebookMsgTx">
                                    <div style="font-weight: bold;">
                                        Create Message to be posted on Twitter</div>
                                    <div>
                                        <div>
											<textarea name="twitterMessage" rows="2" cols="20" id="twitterMessage" onkeyup="checkTextAreaMaxLimittwitter(this.value);" onblur="checkTextAreaMaxLimit(this,120,'Limit1','twitter message');" style="height:125px;width:430px;" maxlength="120">I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discou</textarea>
										</div>
                                        <div id="Limit1" class="socialnote" style="float: left;"> </div>
                                        <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                            Please do not enter HTML tag
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                                <span class="arrowOutter"></span><span class="arrowInner"></span>
                            </div>
                            <div class="NewPromotionDiv" style="float: left;">
                                <div style="position: relative;" class="socialMsgLook">
                                    <div class="showspiral">
                                    </div>
                                    <div style="padding: 15px; margin-bottom: 15px;">
                                        <div>
                                            <div style="float: left; margin-right: 10px;">
                                                <img width="48" height="48" src="<?php echo base_url(); ?>Images/twitterUser.png">
                                            </div>
                                            <div style="float: left; width: 390px;">
                                                <div>
                                                    <span style="font-size: 17px; font-weight: bold;">twitter <span style="font-size: 12px;
                                                        font-weight: normal;">user</span> </span>
                                                </div>
                                                <div>
                                                    <div style="font-size: 11px;">
                                                        <span id="twitterboxMessageSpnId">
                                                            I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discou</span>
                                                        <div style="color: #FF0000;">
                                                          http://<?php echo  $_SERVER['HTTP_HOST']; ?>/</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span>20 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 600px;">
            <center>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td>
                            <div id="IAgreeBtn-rnd" title="Create My Account" class="IAgreeBtn rndBtn btn-standard" onmouseover="changeBotton(this,1)" onmouseout="changeBotton(this,0)">
                                <span class="ct"><span class="cl"></span></span>
                                <input type="submit" class="btn-blue" name="butSave" value="Save" onclick="return checkPromotionForm();" id="butSave">
                                <span class="cb"><span class="cl"></span></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <span id="lblmsg" style="color:Red;font-family:Verdana;font-size:10pt;"></span>
                        </td>
                    </tr>
                </tbody></table>
            </center>
        </div>
        <div class="clear">
        </div>
    </div>
    </form>
</div>
 
 </div>


