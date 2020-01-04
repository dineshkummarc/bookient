<?php include('membership.js.php'); ?>
<style>
    ul.tabs {
		float:left;
		list-style:none;
		height:32px;
		width:100%;
		border-radius:8px 0 -50px 0;
		margin:0;
		padding:0;
}

ul.tabs li {
		float:left;
		height:31px;
		line-height:31px;
		border:1px solid #999;
		overflow:hidden;
		position:relative;
		background:#e0e0e0;
		-webkit-border-top-left-radius:8px;
		-webkit-border-top-right-radius:8px;
		-moz-border-radius-topleft:8px;
		-moz-border-radius-topright:8px;
		border-top-left-radius:8px;
		border-top-right-radius:8px;
		margin:0 5px -1px 0;
		padding:0;
}

ul.tabs li a {
		text-decoration:none;
		color:#000;
		display:block;
		font-size:1.2em;
		border:1px solid #fff;
		outline:none;
		-webkit-border-top-left-radius:8px;
		-webkit-border-top-right-radius:8px;
		-moz-border-radius-topleft:8px;
		-moz-border-radius-topright:8px;
		border-top-left-radius:8px;
		border-top-right-radius:8px;
		padding:0 20px;
}

ul.tabs li a:hover {
		background:#ccc;
}

.spiffyfg ul.tabs li.active,.spiffyfg ul.tabs li.active a:hover {
		background:#fff;
		border-bottom:1px solid #fff;
}

.tabContainer {
		border:1px solid #999;
		overflow:hidden;
		clear:both;
		float:left;
		width:100%;
		background:#fff;
		-webkit-border-radius:8px;
		-webkit-border-top-left-radius:0;
		-moz-border-radius:8px;
		-moz-border-radius-topleft:0;
		border-radius:8px;
		border-top-left-radius:0;
}

.tabContent {
		font-size: 12px;
		padding:20px;
}
.tabContent p {
	margin-left:10px;
}
.inner-div-member {
		overflow: auto;
		padding: 8px 10px;
 }
 .membershipContainer {
    border: 5px solid #EBEBEB;
    border-radius: 0 0 4px 4px;
    margin: 10px 11px;
    min-height: 700px;
    padding: .6em 2.5em .6em 1em;
    width: 20%;
}
.membershipFloatLeft {
    float: left;
}

.membershipButton {
    background-color: #CC0000;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    padding: 10px;
    margin:10px;
    width: 100px;
    text-align: center;
}
.membershipbt {
    background-color: #0B85EC;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    padding: 10px;
    margin:10px;
    width: 100px;
    text-align: center;
}
.membershipContainer h1{
	font-size: 30px;
	display: block;
}
.mp_text{
	display: block;
}
.m_price{
	display: block;
	margin-top: 30px;
	text-align: center;
}
.m_price label{
	font-size: 30px;
}
.mb_text{
	display: block;
	text-align: center;
}
.membershipbt{
	display: block;
	margin-top: 30px;
	 margin-left: 101px;
}
#chooseYourMembership{
	width: 100%; 
	display: none;
}
.cMemberShip{
	display: block;
	float: left;
	margin-left: 10px;
}
.cMemberShip span{
	 font-size: 20px;
    font-weight: bold;
}
.cMemberShip u{
    cursor: pointer;
    color: #CC0000;
}

.AjaxContener{
	background-color: #FFFFFF;
    border: 5px solid #FFFFFF;
    margin: 30px 0 0 5px;
    min-height: 206px;
    width: 100%;
    display:none;  
}
.membershipDetailCompare{
	width: 40%;
	float: left;
}
.plandclss{
	font-size: 14px;
	font-weight: bold;
	line-height: 20px;
}
.futureClass{
	margin-top: 0px;
}
.futureClass li{
	/*margin: 0px 0px 0px 110px;*/
}
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
.pakageHeading{
    font-size: 16px;
    margin-bottom: 5px;
}
#Subscription ul{
	margin-left: 100px;
}
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
.compareHeading{
	font-size: 18px;
	font-weight: bold;
	border-bottom:2px solid #022157;
}
.membershipDetailCompareto{
	width: 48%;
	float: left;
	min-height: 112px;
	padding:5px;
	font-size: 12px;
	border:1px solid #999;
}
.membershipDetailComparefrom{
	width: 48%;
	float: left;
	font-size: 12px;
	padding:5px;
	min-height: 112px;
	border:1px solid #999;
}
.compareHeadingSub{
	background-color: #DADADA;
	font-size: 16px;
	text-align: center;
}
.radioContener{
	background: none repeat scroll 0 0 #B7B7B7;
    border-radius: 5px;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: bold;
    margin: 10px 0;
    padding: 8px;
}
.payBooking{
	height: 25px;
    width: 230px;
}

/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
</style>
<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line("heading_main"))?> </h1>
<div class="inner-div-member">
<p><?php echo $this->global_mod->db_parse($this->lang->line("upfrd_ac_to_activt"))?> </p>
<div>
<!--Tab start-->
<ul class="tabs">
  	<li><a href="#Subscription"><?php echo $this->global_mod->db_parse($this->lang->line("subscription"))?></a></li>
    <li><a href="#Credits"><?php echo $this->global_mod->db_parse($this->lang->line("buy_credits"))?></a></li>
 </ul>
 <div class="tabContainer">
   	<div id="Subscription" class="tabContent">
	    <?php
		$currentPlanDetails = $this->membership_model->getActivePlanDetails();
		//echo '<pre>';
		//print_r($currentPlanDetails);
		
		//echo '</pre>';
		//echo $currentPlanDetails[0]['plan_id'];
		$planData= json_decode($currentPlanDetails[0]['plan_desc'], true);
		
		?>
    	<h2><?php echo $this->global_mod->db_parse($this->lang->line("currnt_membrship"))?></h2>
    	<p>
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("plan_name"))?> : <span style="font-weight: normal;"><?php echo $planData['plan_name']; ?></span></span><br>
    		
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("plan_details"))?> :</span><?php echo nl2br(trim($planData['plan_details'])); ?><br/>		<?php if($currentPlanDetails[0]['plan_id']!=89){ ?>
    		
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("no_of_location"))?> :</span><span style="font-weight: normal;"><?php echo ($currentPlanDetails[0]['is_multilocation']==0)?'0':$currentPlanDetails[0]['is_multilocation']; ?></span><br/>
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("billing_cycle"))?> : <span style="font-weight: normal;"><?php echo ($currentPlanDetails[0]['billing_cycle']=='')?'Nil':$currentPlanDetails[0]['billing_cycle']; ?></span></span><br/>
    <?php } ?>	
    <?php
     $type_p =  ($currentPlanDetails[0]['base_total_amt']==0)?'Free':$currentPlanDetails[0]['base_total_amt']; 
     if($type_p !='Free'){
	 	if($currentPlanDetails[0]['currency_id'] ==1){	$type_p = '$ '.$type_p;	}
	 	if($currentPlanDetails[0]['currency_id'] ==2){	$type_p = '&#x20B9; '.$type_p;	}
	 	if($currentPlanDetails[0]['currency_id'] ==10){	$type_p = '	Y '.$type_p;	}
	 	if($currentPlanDetails[0]['currency_id'] ==12){	$type_p = $type_p.' &euro;';	}
	 }
    ?>	
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("price"))?> : <span style="font-weight: normal;"><?php echo $type_p ; ?></span></span><br/>
    	  	
    	
    		
    		<span class="plandclss"><?php echo $this->global_mod->db_parse($this->lang->line("feature_desc"))?> :</span>
    		<ul class="futureClass">
    		<?php 
    		$planFuture	= json_decode($currentPlanDetails[0]['feature_desc'], true);
    		$myNo=0;
    		foreach($planFuture as $planFutureArr){
    			$myNo++;
    			echo '<li>'.$myNo.') '.$planFutureArr['feature_name'].'</li>';
            }
    		?>
    		</ul>
    		<br/>
    	</p>
    	
    	<h2><?php echo $this->global_mod->db_parse($this->lang->line("payment_info"))?></h2>
    	<p>
    	<?php if($currentPlanDetails['total_amt']== 0 ){ ?>
			<?php echo $this->global_mod->db_parse($this->lang->line("thr_is_no_paying_src"))?>
		<?php }else{ ?>
			 <?php echo $this->global_mod->db_parse($this->lang->line("u_r_paying_thrgh_ppal"))?><a href="javascript:void(0);" onclick="memberChangemaymentSource()"><?php echo $this->global_mod->db_parse($this->lang->line("chng_paymnt_src"))?></a>
		<?php }?>
    	</p>
    	<div id="chooseYourMembership" class="membershipOptionContainer">
    	<div class="cMemberShip"><span><?php echo $this->global_mod->db_parse($this->lang->line("slct_ur_membrshp"))?></span>( <u><?php echo $this->global_mod->db_parse($this->lang->line("currnt_membrship_ul"))?></u> ) </div>
    	<div class="clear"></div>
        <?php
         foreach($membershipPlanArr as $membership_plan){
         ?>
		 <?php 
		 $plan_cost_display = $membership_plan['tierprice']['price'];		 
		 ?>
    	<div class="membershipContainer membershipFloatLeft" <?php if($currentPlanDetails[0]['plan_id'] == $membership_plan['plan_id']){ ?>style="background-color: #EFFF79;" <?php } ?> >
    		<h1><?php echo $membership_plan['plan_name'];?></h1>
    		<span class="mp_text"><?php echo $membership_plan['plan_desc'];?></span>
    		<?php if($currentPlanDetails[0]['plan_id'] != $membership_plan['plan_id']){ ?>  		
    		<?php if($membership_plan['plan_id'] != 89){ ?>   		 		
    		<span class="m_price"><label><?php echo $membership_plan['currency_symbol'].$plan_cost_display;?> /month</label>  </span>   	
    		<?php } ?> 
    		<?php } ?>   		
    		<div class="planDtsCont">  		
    		<?php if($currentPlanDetails[0]['plan_id'] != $membership_plan['plan_id']){ ?>
    		<?php if($membership_plan['plan_id'] != 89){ ?> 
    		<div class="membershipbt" is_multilocation="<?php echo $membership_plan['is_multilocation'];?>" for="plan-<?php echo $membership_plan['plan_id'];?>"> <?php echo $this->global_mod->db_parse($this->lang->line("choose_plan"))?> </div>
    		<?php }else{ ?>
    		<br>
    		<?php } ?>
    		<?php }else{ ?>  		
    		<br><br>
			<?php } ?>
    			<ul style="margin-left: 7px; text-align: left;">
				<?php 
				$len=count($membership_plan['feature']); 
				if($len >0){
					$No=0;			
					foreach($membership_plan['feature'] as $feature ){ 
						$No++;
				?>
						<li><?php echo $No.') '. $feature['feature_name']; ?></li>						
				<?php 
					} 
				} 
				?>
    			</ul>
    		</div>
    		<div id="plan-<?php echo $membership_plan['plan_id'];?>" class="AjaxContener"></div>
    	</div>
    	<?php } ?>
    	<div class="clear"></div>
    	<br>
    	<p>
    		<h1><?php echo $this->global_mod->db_parse($this->lang->line("need_to_cancel_ur_ac"))?> </h1>
    		<br>
    		<b>Ready to say goodbye?</b> <br>Once your account is cancelled, you will no longer be able to access it and your existing subscription will deleted. We are not responsibale to refund you money.If you agree to delete your account then <u onclick="closeTheCurrentInstance()" style="cursor: pointer;">click here</u>. 
    		<!--br><?php echo $this->lang->line("rdy_2_say_fdby")?><br>
			<p>
			<?php echo $this->lang->line("in_ordr_2_cncl_ur_ac")?>
			<?php echo $this->lang->line("if_u_hv_alrdy_ccld")?>
			
			</p-->
	
    	</p>
    	</div>
    	<div id="SourceShowHide" >
	    	<h2><?php echo $this->global_mod->db_parse($this->lang->line("membrship_suggctn"))?></h2>
	    	<p>
			<ul>
				<li># <?php echo $this->global_mod->db_parse($this->lang->line("got_mltipl_locatns"))?> <u onclick="memberChangePlan()" style="cursor: pointer;"> <?php echo $this->global_mod->db_parse($this->lang->line("upgrd_2_entrprice_membrshp"))?>	</u></li> 
				<!--li># <?php echo $this->lang->line("buy_credits")?>  <u><?php echo $this->lang->line("buy_credits")?></u></li-->
			</ul>
	    	</p>
	    	<div class="membershipButton" id="memberChangePlan" onclick="memberChangePlan()"> <?php echo $this->global_mod->db_parse($this->lang->line("chng_plan"))?> </div>
	    	<br>
			<div id="msg"></div>
	    	<div id="all_listing">
			<?php echo $payment_details; ?>
			</div>
    	</div>
    	
    </div>
    <!-- / END #Subscription -->
    
    <div id="Credits" class="tabContent">
		<div id="credits_msg"></div>
    	<p>
		 <p ><h1><?php echo $this->global_mod->db_parse($this->lang->line("u_hv_0_credt_in_ur_ac"))?></h1><a href="#"><?php echo $this->global_mod->db_parse($this->lang->line("my_membership"))?></a></p>
<?php echo $this->global_mod->db_parse($this->lang->line("these_crdts_wl_b_used"))?><a href="#"><?php echo $this->global_mod->db_parse($this->lang->line("know_more"))?></a><br>
		<?php echo $this->global_mod->db_parse($this->lang->line("these_crdts_wl_b_used"))?> <?php echo $this->global_mod->db_parse($this->lang->line("know_more"))?><br>
		<a href="#"><?php echo $this->global_mod->db_parse($this->lang->line("ur_credit_usage_report"))?></a>  <?php echo $this->global_mod->db_parse($this->lang->line("or"))?> <a href="#"><?php echo $this->global_mod->db_parse($this->lang->line("credt_purchs_histry"))?></a> <br>
		<p>
			<table class="list-view" width="80%">
			<?php if(count($creditDetails) >0){ ?>						
    			<tr>
    				<th> <?php echo $this->global_mod->db_parse($this->lang->line("packages"))?> </th>
    				<th> 	<?php echo $this->global_mod->db_parse($this->lang->line("amount"))?> </th>
    				<th> 	<?php echo $this->global_mod->db_parse($this->lang->line("credits"))?> </th>
    				<th> 	<?php echo $this->global_mod->db_parse($this->lang->line("descriptn"))?> </th>
    				<th>&nbsp;</th>
    			</tr>
				<?php 
						if(!$currentCredit){
							$currentCredit =$creditDetails[0]['credit_id'];
						}					
				?>
				<?php  foreach($creditDetails as $credit){ ?>
					<?php 
						$checked=($currentCredit ==$credit['credit_id'])?'checked=""':'';
						$diplay=($currentCredit ==$credit['credit_id'])?'':'style="display: none;"';
					
					 ?>
	    			<tr>
	    				<td nowrap="true"><input class="credit-id" <?php echo $checked; ?>  type="radio" value="<?php echo $credit['credit_id']; ?>" id="credit_id_<?php echo $credit['credit_id']; ?>" name="credit_id" onclick="showDetails(<?php echo $credit['credit_id']; ?>)" ><label for="credit_id_<?php echo $credit['credit_id']; ?>"><?php echo $credit['package_name']; ?></label></td>
	    				<td>$<?php echo $credit['base_amt']; ?> </td>
	    				<td><?php echo $credit['credits']; ?> </td>
	    				<td> 	<?php echo $credit['package_desc']; ?>  </td>
	    				<td><a href="javascript:void(0);" onclick="showDetails(<?php echo $credit['credit_id']; ?>)"><?php echo $this->global_mod->db_parse($this->lang->line("buy_credits"))?></a></td>
	    			</tr>
					<tr class="purchase-option-tr" <?php echo $diplay; ?> id="purchase_option_<?php echo $credit['credit_id']; ?>">				
						<td colspan="5">						
							<div class="purchase-option">								
								<div id="purchaseOption1">								
									<div style="" id="purchaseCreditOption" class="creditPaymentOption">
								        <?php echo $this->global_mod->db_parse($this->lang->line('pay_through'))?>
								        <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('paypal'))?>" onclick="selectCredit(<?php echo $credit['credit_id']; ?>)" class="PurchaseCreditButton" id="BuyButton">
								        <!--or 								        
								        <input type="button" onclick="__chx()" value="Link Credit Card" class="PurchaseCreditButton">								-->        
								    </div>									
								</div>								
							</div>
							<div style="" class="country-id" id="country_id_<?php echo $credit['credit_id']; ?>">								
								<select class="CountryDdlBox" onchange="changeCountry(this.value,'<?php echo $credit['credit_id']; ?>')" id="CountryDdl<?php echo $credit['credit_id']; ?>">	
									<?php foreach($countries as $country){ ?>
									<?php $selected=($localAdminCountry[0]['country_id']==$country['country_id'])?'selected=""':''; ?>
										<option <?php echo $selected; ?> value="<?php echo $country['country_id']; ?>">											
											<?php echo $country['country_name']; ?>											
										</option>
									<?php } ?>
								</select>		
							</div>					
						</td>		
					</tr>
					<tr  <?php echo $diplay; ?> id="credit_details_<?php echo $credit['credit_id']; ?>" class="credit-details-tr"   >						
						<td colspan="5">						
							<div class="credit-details">
							<?php 
							$creditsCountryPriceSms=$this->membership_model->getCreditsCountryPrice($localAdminCountry[0]['country_id'],$credit['credit_id'],2);
							$creditsCountryPriceCall=$this->membership_model->getCreditsCountryPrice($localAdminCountry[0]['country_id'],$credit['credit_id'],1);		
		?>								
								<div style="display: block;" id="note<?php echo $credit['credit_id']; ?>" class="smsAndCallChargesDiv">
                                    <div style="padding-bottom: 5px; padding-top: 5px;">
                                        1). <span><?php echo $this->global_mod->db_parse($this->lang->line('one_cl_in'))?></span> 
										<span id="creditCallChargeCountry<?php echo $credit['credit_id']; ?>"><?php echo $creditsCountryPriceCall[0]['country_name'] ?></span>
											
										<span><?php echo $this->global_mod->db_parse($this->lang->line('costs'))?></span> 
										<span id="callcharge<?php echo $credit['credit_id']; ?>"><?php echo $creditsCountryPriceCall[0]['cost'] ?></span>&nbsp; <?php echo $this->lang->line('cents')?> (<span><?php echo $this->global_mod->db_parse($this->lang->line('approx'))?></span>).
                                    </div>
                                    <div>
                                        2). <span><?php echo $this->global_mod->db_parse($this->lang->line('one_sms_in'))?></span>
										 <span id="creditSMAChargeCountry<?php echo $credit['credit_id']; ?>"><?php echo $creditsCountryPriceSms[0]['country_name'] ?></span>
										 	
										 <span><?php echo $this->global_mod->db_parse($this->lang->line('costs'))?></span> 
										 <span id="smscharge<?php echo $credit['credit_id']; ?>"><?php echo $creditsCountryPriceSms[0]['cost'] ?></span>&nbsp; <?php echo $this->global_mod->db_parse($this->lang->line('cents'))?> (<span><?php echo $this->global_mod->db_parse($this->lang->line('approx'))?></span>).
                                    </div>
                                </div>															
							</div>						
						</td>					
					</tr>
    			<?php } ?>
			<?php } ?>	
    		</table>
		</p>

    	</p>
    </div>
    <!-- / END #Credits -->
 </div>
<!--Tab end-->
</div>
</div>

</div>