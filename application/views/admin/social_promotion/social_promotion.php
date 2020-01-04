<?php include('social_promotion.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->lang->line('heading_main')?> </h1>


<div id="AllTemplate">
    <form name="form1" method="post" action="<?php echo base_url(); ?>admin/social_promotion/save" id="form1">
    <div id="mainDiv">
        <div id="tabContent" style="padding-left: 5px; padding-right: 5px; width: 97%">
            <div class="bussinessDetail">
                <table width="100%" class="insertStaff" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="aboutSocialPromotion" style="padding-top: 0px">
							<?php echo $this->lang->line('after_head_details')?>
                            
                        </td>
                    </tr>
                    </tbody>					
				</table>
                
                <div class="socialBody">
                    <div class="bussinessDetailBlockHeadingNoBottom extraHd" style="margin-top: 10px;">
                        <?php echo $this->lang->line('attach_an_offer')?></div>
                    <div class="wizardFS extraSbHd">
						<?php echo $this->lang->line('request_your_client')?>
                        
                    </div>
                    <div>
                        <div class="connectConditionOption">
                            <span style="display: none;">
                                <input id="promoteBusiness" type="checkbox" name="promoteBusiness" checked="checked">
                            </span>
                            <table style="width: 100%;">
                                <tbody><tr>
                                    <td class="NewPromotionTextHeadings">
                                        <?php echo $this->lang->line('give')?>
                                    </td>
                                    <td>
                                        <select name="offerType" id="offerType">
											<option selected="selected" value="0"><?php echo $this->lang->line('a_discount')?></option>
											<option value="1"><?php echo $this->lang->line('an_offer')?></option>
											<option value="2"><?php echo $this->lang->line('nothing_bt_request')?></option>
										</select>
                                        <span id="discountValSelSp"><?php echo $this->lang->line('of')?>
                                            <input name="promoteBusinessPer" type="text" value="10" maxlength="2" id="promoteBusinessPer" onblur="checkPromotionForm();" style="width:23px;">
	                                        <select name="offerIn" id="offerIn">
												<option selected="selected" value="0">%</option>
												<option value="1">EUR</option>
											</select>
                                        </span>
                                        <div class="extraSbHd1">
											<?php echo $this->lang->line('appo_book_with')?>
                                            
                                            <img src="../../Images/Stat/Social Promotion.png" alt="" border="0">
                                            <?php echo $this->lang->line('next_to_all')?>
                                        </div>
                                    </td>
                                </tr>
                                </tbody><tbody id="offserUseTbody">
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            <?php echo $this->lang->line('To')?>
                                        </td>
                                        <td>
                                            <select name="promoteToType" id="promoteToType">
												<option selected="selected" value="1"><?php echo $this->lang->line('client')?></option>
												<option value="2"><?php echo $this->lang->line('client')?> &amp; <?php echo $this->lang->line('his_friend')?></option>
											</select>
                                            <div class="extraSbHd1">
												<?php echo $this->lang->line('social_promotion_can_b')?>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            <?php echo $this->lang->line('when')?>
                                        </td>
                                        <td>
                        <select name="offerAppliedOn" id="offerAppliedOn">
							<option selected="selected" value="0"><?php echo $this->lang->line('apply_when_smone_books')?></option>
							<option value="1"><?php echo $this->lang->line('apply_on_promotion')?></option>
						</select>
                                            <div class="extraSbHd1">
												<?php echo $this->lang->line('you_can_decide_when')?>
                                                
                                                <img src="../../Images/Stat/Social Promotion.png" alt="" border="0">
                                                <?php echo $this->lang->line('next_to_it')?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bussinessDetailBlockHeadingNoBottom extraHd" style="margin-top: 40px;">
                        <?php echo $this->lang->line('design_your_offer')?></div>
                    <div class="wizardFS extraSbHd">
						 <?php echo $this->lang->line('this_will_shown')?>
                     </div>
                    <div>
                        <div style="float: left"> <!-- left part -->
                            <div class="NewPromotionFieldSet">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr>
                                        <td class="NewPromotionTextHeadings">
                                            <?php echo $this->lang->line('title')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionText">
                                            <input name="NewPromotionTitle" onkeyup="showTitle(this.value)" type="text" value="Hey, lets get social!" id="NewPromotionTitle" style="width:430px;">
											
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            <?php echo $this->lang->line('description')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionText">
                                            <textarea name="NewPromotionDescription" onkeyup="showDescription(this.value)" rows="5" cols="20" id="NewPromotionDescription" style="height:125px;width:430px;"><?php echo $this->lang->line('why_come_alone')?> &amp; <?php echo $this->lang->line('twitter')?></textarea>
										
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="float: left;">
                                                <a href="javascript:void(0)" onclick="adSetting()" class="advanceOptionLink" id="advanceOptionLink"><?php echo $this->lang->line('advance_setting')?></a>
                                            </div>
                                            <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                                <?php echo $this->lang->line('please_do_not_entr')?>
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
                                                        <?php echo $this->lang->line('color')?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('background')?>
                                                    </td>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('border')?>
                                                    </td>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('title')?>
                                                    </td>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('description')?>
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
                                            <?php echo $this->lang->line('image')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="NewPromotionTextHeadings">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tbody><tr>
                                                    <td class="cssSetting">
                                                         <?php echo $this->lang->line('path')?>
                                                    </td>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('repeat')?>
                                                    </td>
                                                    <td class="cssSetting">
                                                        <?php echo $this->lang->line('position')?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cssSetting">
                                                        <input name="NewPromotionImage" type="text" id="NewPromotionImage" style="width:150px;" onkeyup="showImg()" value="<?php echo ($DesignOffer !='')?$DesignOffer[0]['image_path']:'' ?>">
                                                    </td>
                                                    <td class="cssSetting">
			                                            <select name="ImageRepeat" id="ImageRepeat" onchange="showImg()">
															<option value="no-repeat" ><?php echo $this->lang->line('no')?></option>
															<option  value="repeat"><?php echo $this->lang->line('yes')?></option>
															<option value="repeat-x"><?php echo $this->lang->line('x')?></option>
															<option value="repeat-y"><?php echo $this->lang->line('y')?></option>

														</select>
                                                    </td>
                                                    <td class="cssSetting">													
                                                        <select name="ImagePosition" id="ImagePosition" onchange="showImg()">
															<option value="left top" ><?php echo $this->lang->line('left_top')?></option>
															<option value="left center" ><?php echo $this->lang->line('left_center')?></option>
															<option value="left bottom" ><?php echo $this->lang->line('left_bottom')?></option>
															<option value="center top" ><?php echo $this->lang->line('center_top')?></option>
															<option  value="center center"><?php echo $this->lang->line('center_center')?></option>
															<option value="center bottom"><?php echo $this->lang->line('center_bottom')?></option>
															<option value="right top"><?php echo $this->lang->line('right_top')?></option>
															<option value="right center" ><?php echo $this->lang->line('right_center')?></option>
															<option value="right bottom"><?php echo $this->lang->line('right_bottom')?></option>

														</select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <span class="socialnote"><?php echo $this->lang->line('max_width')?>&nbsp;&nbsp;<?php echo $this->lang->line('max_height')?></span>
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
									}else{
										$display='display:block;';
									}
								}else{
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
                        <?php echo $this->lang->line('design_your_promotn_msg')?></div>
                    <div class="wizardFS extraSbHd">
                        <?php echo $this->lang->line('design_the_msg')?>
                    </div>
               
                    <div>
                        <div>
                            <div class="NewPromotionDiv socialMsgUpper" style="float: left;">
                                <div style="" class="facebookMsgTx">
                                    <div style="font-weight: bold;">
                                        <?php echo $this->lang->line('create_msg_for_fb')?>
                                    </div>
									<div>
                                        <div>
											<textarea name="faceboxMessage" rows="2" cols="20" id="faceboxMessage" onkeyup="checkTextAreaMaxLimitfacebook(this.value);" maxlength="410"  style="height:125px;width:430px;">I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discount to any service offered.</textarea>
										</div>
                                        <div id="Limit0" class="socialnote" style="float: left;">  </div>
                                        <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                            <?php echo $this->lang->line('please_do_not_entr')?>
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
                                            <img alt="User Image" height="50px" width="50px" src="<?php echo base_url(); ?>asset/fbUser.jpg" title="User Image">
                                        </a>
                                        <div style="vertical-align: top; float: left; width: 390px;">
                                            <div>
                                                <div style="color: #3B5998; font-weight: bold; font-size: 11px; cursor: pointer;">
                                                    <?php echo $this->lang->line('fb_user')?>
                                                </div>
                                                <span style="font-size: 11px;" id="faceboxMessageSpnId">
                                                    I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discount to any service offered.</span>
                                                <div>
                                                    <div>
                                                        <div class="faceBookMsg">
                                                        <?php if($this->session->userdata('ad_logo')!=''){  ?>
														<img height="70px" width="70px" src="<?php echo base_url(); ?>/uploads/businesslogo/<?php echo $this->session->userdata('ad_logo'); ?>" alt="">
														<?php } ?>
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
                                       <?php echo $this->lang->line('create_msg_for_twitter')?> </div>
                                    <div>
                                        <div>
											<textarea name="twitterMessage" rows="2" cols="20" id="twitterMessage" onkeyup="checkTextAreaMaxLimittwitter(this.value);" onblur="checkTextAreaMaxLimit(this,120,'Limit1','twitter message');" style="height:125px;width:430px;" maxlength="120">I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discou</textarea>
										</div>
                                        <div id="Limit1" class="socialnote" style="float: left;"> </div>
                                        <div style="float: right; color: #ff0000; font-size: 10px; font-family: arial; font-style: italic;">
                                            <?php echo $this->lang->line('please_do_not_entr')?>
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
                                                <img width="48" height="48" src="<?php echo base_url(); ?>asset/twitterUser.png">
                                            </div>
                                            <div style="float: left; width: 390px;">
                                                <div>
                                                    <span style="font-size: 17px; font-weight: bold;"><?php echo $this->lang->line('twitter_sml')?> <span style="font-size: 12px;
                                                        font-weight: normal;"><?php echo $this->lang->line('user')?></span> </span>
                                                </div>
                                                <div>
                                                    <div style="font-size: 11px;">
                                                        <span id="twitterboxMessageSpnId">
                                                            I have booked a service @Simosilmu {AppointmentDate} {AppointmentTime} ! By clicking this link you will recieve a discou					</span>
                                                        <div style="color: #FF0000;">
                                                          http://<?php echo  $_SERVER['HTTP_HOST']; ?>/</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span><?php echo $this->lang->line('twenty_hrs')?></span>
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
                                <input type="submit" class="btn-blue" name="butSave" value="<?php echo $this->lang->line('save')?>" onclick="return checkPromotionForm();" id="butSave">
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


