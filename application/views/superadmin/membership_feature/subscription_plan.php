<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('subscription_plan.js.php'); ?>

<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Subscription Plans</h1>
        <div class ="tab_listing">
<?php
$back = $this->session->userdata('parent_membership_page');
//echo $back;
?>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">

	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
	<table width="100%" border="0" cellspacing="5" cellpadding="0">
		 <tr>
		 	<td colspan="2" align="left">
				<input name="" type="button"  class="btn-blue" value="<< Back" onClick="window.location.href='<?=base_url()?>superadmin/membership_plan/index/page/<?=$back ?>';"/>
			</td>
			<td colspan="2" align="right">
				<input name="" type="button"  class="btn-blue" onclick="hide_show_subs();" value="+ Add rate" onClick="window.location.href='<?=base_url()?>superadmin/membership_plan';"/>
			</td>
		 </tr>
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			  <input name="subscription_search" type="text" class="text_input" id="subscription_search" value="<?=($subscription_search=='Subscription Description,Amount and Validity' || $subscription_search=='')?'Subscription Description,Amount and Validity':$subscription_search ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Subscription Description,Amount and Validity') this.value=''" onBlur="if(this.value=='') this.value='Subscription Description,Amount and Validity'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/membership_plan/plan_subscription/<?=$id?>';"/>

			</td>
			<td width="25%" height="35px" align="center">
			<div id="TransMsgDisplay"></div>
			</td>
		  </tr>
		</table>
	</form>
</div>



<div class="menuName">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr>
			<td width="2%">&nbsp;</td>
			<td colspan="6" align="left" valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#95989A">
		  			<tr bgcolor="#95989A">
						<td align="left" valign="middle" height="25px;" class="padleft" width="15%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Subscription Description</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                                                <td width="10%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">Amount</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][2]?>
                                                </td>
                                                <td width="17%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/3/ordertype/<?=$ordertype?><?=$searchLink?>');">Validity</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][3]?>
                                                </td>
                                                <td width="8%" align="center" class="whitetext" valign="middle"><strong>Extra Validity</strong></td>
						<td width="8%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
						<!--<td width="10%" align="center" class="whitetext" valign="middle"><strong>Re-Order</strong></td>-->
						<td width="10%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong>Actions</strong></span></td>
		  			</tr>
		  		</table>
			</td>
			<td width="2%">&nbsp;</td>
		</tr>

		  <tr>
		  <td width="2%">&nbsp;</td>
			<td colspan="6" align="left" valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#95989A">
				<?

					$i = 0;
					foreach($MemArr as $memarr):
						$active_img	= $memarr->status == 1 ? "true.gif" : "false.gif";
						$active_alt	= $memarr->status ==1 ? "Active" : "Inactive";
						$status_id 	= 14;
						$i++;
				?>

				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="15%" height="25px;" align="left" valign="middle" class="padleft">
                                                <?=$memarr->sub_plan_desc?>
					</td>
                                         <td width="15%" align="center" valign="middle">
                                              <?= $curr?> <?=$memarr->amount?>
                                        </td>
                                         <td width="15%" align="center" valign="middle">
                                              <?=$memarr->validity?>
                                        </td>
                                        <td width="15%" align="center" valign="middle">
                                              <?=$memarr->extra_validity?>
                                        </td>

					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/membership_plan/plan_subscription/id/<?=$id?>/action/activate/record_id/<?=$memarr->plan_subscriptions_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	                                <img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>



					<!--<td width="10%" align="center" valign="middle"><?=$ratearr->img_rank?></td>-->
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="50%" align="center" valign="middle">
                                                                 <a href="javascript:void(0);" onclick="edit_subs('<?=$memarr->plan_subscriptions_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
                                                      <a href="#" onClick="del_subs('<?=$memarr->plan_subscriptions_id?>')">
						  <img src="<?= base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
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
		 <td width="2%">&nbsp;</td>
		  </tr>
  </table>
</div>
<br />
<div id="paginate" style="padding: 0 30px 0 0 ;"><?=$pagination?></div>
</div><br/>
<br/>
<input type="hidden" name="membership_plan_id" id="membership_plan_id" value="<?= $id ?>" />


    <div id="listing_subscription">
    </div>
    <div id="add_subs" style="display:none;">
    <form name="subs_frm" id="subs_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
      <tr>
        <td>Subscription Description : </td>
        <td><textarea cols="10" id="sub_plan_desc" name="sub_plan_desc" rows="5"></textarea> &nbsp; <span id="ans_err_subs"></span>
        <script type="text/javascript">
            CKEDITOR.replace( 'sub_plan_desc',
                {
                    skin : 'kama',
                    toolbar : 'Basic',
                    height:"200",
                    width:"72%"
                });
        </script>
        <input type="hidden" name="plan_subscriptions_id" id="plan_subscriptions_id" value="" />
        </td>
      </tr>
      <tr>
        <td>Amount : </td>
        <td><input type="text" name="amount" id="amount" value="" class="required" style="width:73% !important" /></td>
      </tr>
      <tr>
        <td>Validity (Days) : </td>
        <td><input type="text" name="validity" id="validity" value="" class="required" style="width:73% !important" /></td>
      </tr>
      <tr>
        <td>Extra Validity (Days) : </td>
        <td><input type="text" name="extra_validity" id="extra_validity" value="" class="required" style="width:73% !important" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
            <input type="button" name="sub_subs" id="sub_subs" value="Add" class="btn-blue" onclick="submit_subs();" />
            &nbsp;
            <input type="button" name="cancel_subs" id="cancel_subs" value="Cancel" class="btn-gray" onclick="cancl_subs();" />
         </td>
      </tr>
    </table>
    </form>
    </div>
</div>
<br/>
<br/>



</div>
</div>




