<?php  include('membership_plan.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Membership Plan Manager</h1>
        <div class ="tab_listing">
<div id="add_new_link" class="margin-adjust">
    <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Membership Plan" /></div>
</div>
<br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="15%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >
			    <input name="membership_plan_search" type="text" class="text_input" id="membership_plan_search" value="<?=($membership_plan_search=='Search by Membership Title,Amount and Validity' || $membership_plan_search=='')?'Search by Membership Title,Amount and Validity':$this->global_mod->show_to_control($membership_plan_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Membership Title,Amount and Validity') this.value=''" onBlur="if(this.value=='') this.value='Search by Membership Title,Amount and Validity'"/>
                <input type="hidden" name="dosearch" value="GO">
			</td>
			<td width="50%" align="left" valign="middle">&nbsp;&nbsp;
			    <input name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			    <input name="" type="button" class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/membership_plan';"/>
			</td>
			<td width="25%" height="35px" align="center">
			    <div id="TransMsgDisplay"></div>
			</td>
		  </tr>
		</table>
    </form>
</div>


<div class="menuName">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="80%" align="left" valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#95989A">
		  			<tr bgcolor="#95989A">
						<td align="left" valign="middle"  class="padleft" width="70%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Membership Plan</a></strong></span><?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>			
						<td width="10%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
						<td width="10%" align="center" class="whitetext" valign="middle"><strong>Re-Order</strong></td>
						<td width="10%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong>Actions</strong></span></td>
		  			</tr>
		  		</table>
			</td>
			<td width="10%">&nbsp;</td>
		</tr>

		  <tr>
		  <td width="10%">&nbsp;</td>
			<td align="left" valign="top" width="80%">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#95989A">
	<?php
		$i = 0;
		//echo "<pre>";
		//print_r($MemArr);
		foreach($MemArr as $memarr):
		$active_img	= $memarr->status == 1 ? "true.gif" : "false.gif";
		$active_alt	= $memarr->status ==1 ? "Active" : "Inactive";
		$status_id 	= 15;
		$i++;
		$f_title = (strlen($memarr->plan_name)>20) ? substr($memarr->plan_name,0,12).'...' : $memarr->plan_name;

	?>

		<tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
			<td width="70%" height="25px;" align="left" valign="middle" class="padleft"><?php echo $this->global_mod->show_to_control($f_title);?></td>
			<td width="10%" align="center" valign="middle"><a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/membership_plan/index/action/activate/record_id/<?=$memarr->plan_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')"><img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a></td>
			
			<td width="10%" align="center" valign="middle"><?php echo $memarr->img_rank; ?></td>
			<td width="10%" align="left" valign="middle">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="50%" align="center" valign="middle"><a href="javascript:void(0);" onclick="edit_plan('<?=$memarr->plan_id?>');"><img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" /></a></td>						
						<td width="50%" align="center" valign="middle">
							<a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/membership_plan/index','<?=$memarr->plan_id?>','<?=addslashes(htmlspecialchars(stripslashes($memarr->plan_name)))?>','Plan:: ')">
								<img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
							</a>
						</td>
					  </tr>
				</table>
			</td>
		</tr>
				<? endforeach;?>
				<? if(count($MemArr)==0): ?>
				<tr bgcolor="#FFFFFF"><td colspan="5" align="center">No Record Found</td></tr>
				<? endif; ?>
			  </table>
			</td>
		 <td width="10%">&nbsp;</td>
		  </tr>
  </table>
</div>
<br />
<div id="paginate" style="padding: 0 30px 0 160px;"><?=$pagination?></div>
</div><br/>
<br/>

<div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table" ><!--class="credit-table"-->
      <tr>
        <td>Membership Plan Title : </td>
        <td><input type="text" name="membership_name" class="required" id="membership_name" value=""/></td>
      </tr>
	  <!--
      <tr>
        <td>Membership Amount($) : </td>
        <td><input type="text" name="membership_amount" class="required" id="membership_amount" value=""/></td>
      </tr>
	  -->
      <tr>
        <td>Membership Description : </td>
        <td><textarea cols="10" id="membership_description" name="membership_description" rows="5"></textarea> &nbsp; <span id="ans_err"></span>
        <script type="text/javascript">
            CKEDITOR.replace( 'membership_description',
                {
                    skin : 'kama',
                    toolbar : 'Basic',
                    height:"200",
                    width:"73%"
                });
        </script>
        </td>
      </tr>
	  <!--
	  <tr>
        <td>Membership Validity (Days) : </td>
        <td><input type="text" name="membership_validity" id="membership_validity" value=""/></td>
      </tr>
	  -->
	  <tr>
        <td>Status : </td>
        <td>			
			<select name="status" id="status">
				<option value="" >-Select-</option>				
				<option value="1" >Enable</option>
				<option value="0" >Disable</option>
			</select>			
		</td>
      </tr>
	  <tr>
        <td>Is Multilocation : </td>
        <td>			
			<select name="is_Multilocation" id="is_multilocation"  onchange="prepareMultilocation(this.value)">
				<!--<option value="" >-Select-</option>	-->		
				<option value="0" >No</option>	
				<option value="1" >Yes</option>				
			</select>			
		</td>
      </tr>
      <tr>
      	<td></td>
      	<td><span style="color:#ff0000;">If Price and Cost/per staff is given 0,it will be treated as Free plan</span></td>
      </tr>
      <tr>
      	<td></td>
      	<td><span style="color:#ff0000;">If Cost/per staff is given 0,admin can not add extra staff</span></td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td>			
			<div id="mul_loc_yes" class="mul-loc-yes" style="display: none;">		
						<table id="mul_loc_yes_table">					
							<tr><td>Billing Cycle</td><td>No Of Location</td><td>No Of Staff</td><td>Price</td><td>Extra Cost/per staff</td><td>&nbsp;</td></tr>
							<tr id="mul_loc_yes_tr_1">					
								<td>
									<!--
									<select class="mul_loc" name="mul_loc[1][billing_cycle]" id="billing_cycle_1">
										<option value="monthly">Monthly	</option>
									</select>
									-->
									<span>Monthly</span>
									<input  type="hidden" name="mul_loc[1][billing_cycle]" id="billing_cycle_1" value="monthly" />
								</td>
								<td>
									<input class="mul_loc" onkeyup="updateOtherLocation(this.value,'1');checkNum(event,this.id)" type="text" name="mul_loc[1][location_num]" id="location_num_1" />
								</td>
								<td>
									<input class="mul_loc" type="text" onkeyup="updateOtherStaff(this.value,'1');checkNum(event,this.id)" name="mul_loc[1][staff_per_location]" id="staff_per_location_1"/>
								</td>
								<td>
									<input class="mul_loc" type="text" name="mul_loc[1][price]" id="price_1" onkeyup="checkNum(event,this.id)"/>
								</td>						
								<td>
									<input class="mul_loc" type="text" name="mul_loc[1][additional_cost_location]" id="additional_cost_location_1" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>&nbsp;</td>					
							</tr>		
										
										
																				
										
							<tr id="mul_loc_yes_tr_2">					
								<td>
									<!--
									<select class="mul_loc" name="mul_loc[1][billing_cycle]" id="billing_cycle_2">
										<option value="helf_yearly">Helf yearly	</option>
									</select>
									-->
									<span>Helf yearly</span>
									<input  type="hidden" name="mul_loc[2][billing_cycle]" id="billing_cycle_2" value="helf_yearly" />
								</td>
								<td>
									<input class="mul_loc" type="hidden" name="mul_loc[2][location_num]" id="location_num_2" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc" type="hidden" name="mul_loc[2][staff_per_location]" id="staff_per_location_2" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc" type="text" name="mul_loc[2][price]" id="price_2" onkeyup="checkNum(event,this.id)"/>
								</td>						
								<td>
									<input class="mul_loc" type="text" name="mul_loc[2][additional_cost_location]" id="additional_cost_location_2" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>&nbsp;</td>					
							</tr>		
							
							
													
							
							<tr id="mul_loc_yes_tr_3" >					
								<td>
									<!--
									<select class="mul_loc" name="mul_loc[1][billing_cycle]" id="billing_cycle_3">
										<option value="yearly">	Yearly</option>
									</select>
									-->
									
									<span>Yearly</span>
									<input   type="hidden" name="mul_loc[3][billing_cycle]" id="billing_cycle_3" value="yearly" />
								</td>
								<td>
									<input class="mul_loc"   type="hidden" name="mul_loc[3][location_num]" id="location_num_3" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc" type="hidden" name="mul_loc[3][staff_per_location]" id="staff_per_location_3" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc" type="text" name="mul_loc[3][price]" id="price_3" onkeyup="checkNum(event,this.id)"/>
								</td>						
								<td>
									<input class="mul_loc" type="text" name="mul_loc[3][additional_cost_location]" id="additional_cost_location_3" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>&nbsp;</td>					
							</tr>					
										
												
						</table>					
				<input type="button" name="mul_loc_yes_add_next" id="mul_loc_yes_add_next" onclick="addNext()" value="Add Another">
				<input type="hidden" name="mul_loc_yes_hdn" id="mul_loc_yes_hdn" value="4">
			</div>
			<div id="mul_loc_no" class="mul-loc-no"  >
						<table id="mul_loc_no_table">					
							<tr><td>Billing Cycle</td><td>No Of Staff</td><td>Price</td><td>Extra Cost/per staff</td><td>&nbsp;</td></tr>
							<tr id="mul_loc_no_tr_1">					
								<td>
								<!--
									<select class="mul_loc_no" name="mul_loc_no[1][billing_cycle]" id="billing_cycle_no_1">
										<?php
										/*										
										//print_r($billingCycle);										
										 foreach($billingCycle as $eachCycle){ ?>
											<option value="<?php echo $eachCycle['code_code'];  ?>">												
												<?php echo $eachCycle['code_value'];  ?>												
											</option>
										<?php }*/ ?>
										
										<option value="monthly">Monthly	</option>										
									</select>
									-->	
									<span>Monthly</span>
									<input  type="hidden"  name="mul_loc_no[1][billing_cycle]" id="billing_cycle_no_1" value="monthly" />							
								</td>	
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[1][staff_per_location]" id="staff_per_location_no_1" onkeyup="checkNum(event,this.id)"/>
								</td>								
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[1][price]" id="price_no_1" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[1][additional_cost_location]" id="additional_cost_location_no_1" onkeyup="checkNum(event,this.id)"/>
								</td>
																					
								<td>&nbsp;</td>					
							</tr>	
							
							
							
							<tr id="mul_loc_no_tr_2">					
								<td>	
								<!--							
									<select class="mul_loc_no" name="mul_loc_no[2][billing_cycle]" id="billing_cycle_no_2">
										<option value="helf_yearly">Helf yearly	</option>
									</select>	
									-->
									<span>Half yearly	</span>
									<input  type="hidden"  name="mul_loc_no[2][billing_cycle]" id="billing_cycle_no_2"  value="helf_yearly" />															
								</td>	
								<td>
									<input class="mul_loc_no" type="hidden" name="mul_loc_no[2][staff_per_location]" id="staff_per_location_no_2" value="0" onkeyup="checkNum(event,this.id)"/>
								</td>								
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[2][price]" id="price_no_2" onkeyup="checkNum(event,this.id)"/>
								</td>	
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[2][additional_cost_location]" id="additional_cost_location_no_2" onkeyup="checkNum(event,this.id)"/>
								</td>													
								<td>&nbsp;</td>					
							</tr>	
							
							
							
							
							<tr id="mul_loc_no_tr_3">					
								<td>	
								<!--								
									<select class="mul_loc_no" name="mul_loc_no[3][billing_cycle]" id="billing_cycle_no_3">
										<option value="yearly">	Yearly</option>
									</select>
									-->
									<span>Yearly	</span>
									<input  type="hidden"  name="mul_loc_no[3][billing_cycle]" id="billing_cycle_no_3" value="yearly" />						
								</td>
								<td>
									<input class="mul_loc_no" type="hidden" name="mul_loc_no[3][staff_per_location]" id="staff_per_location_no_3" value="0" onkeyup="checkNum(event,this.id)"/>
								</td>									
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[3][price]" id="price_no_3" onkeyup="checkNum(event,this.id)"/>
								</td>
								<td>
									<input class="mul_loc_no" type="text" name="mul_loc_no[3][additional_cost_location]" id="additional_cost_location_no_3" onkeyup="checkNum(event,this.id)"/>
								</td>														
								<td>&nbsp;</td>					
							</tr>	
							
						
										
						</table>	
						<!--<input type="button" name="mul_loc_no_add_next" id="mul_loc_no_add_next" onclick="addNextNo()" value="Add Another">-->
				<input type="hidden" name="mul_loc_no_hdn" id="mul_loc_no_hdn" value="4">						
			</div>					
		</td>
      </tr>
     
      <tr>
        <td colspan="2" align="center">
            <input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_plan();" />
            &nbsp;
            <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_plan();" />
			<input type="hidden" name="plan_id" class="required" id="plan_id" value=""/>
         </td>
      </tr>
    </table>
    </form>
    </div>

    <input type="hidden" name="membership_plan_id" id="membership_plan_id" value="" />
</div>
</div>
<div style="display: none;">
<select class="loc_clone" name="loc_clone" id="loc_clone" style="display: none;">
	<?php foreach($billingCycle as $eachCycle){ ?>
		<option value="<?php echo $eachCycle['code_code'];  ?>">												
			<?php echo $eachCycle['code_value'];  ?>												
		</option>
	<?php } ?>
</select>
</div>