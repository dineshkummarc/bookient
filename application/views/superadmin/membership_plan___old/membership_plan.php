<?php include('membership_plan.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Membership Manager</h1>
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
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >
			    <input name="membership_plan_search" type="text" class="text_input" id="membership_plan_search" value="<?=($membership_plan_search=='Search by Membership Title,Tagline and Amount' || $membership_plan_search=='')?'Search by Membership Title,Tagline and Amount':$membership_plan_search ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Membership Title,Tagline and Amount') this.value=''" onBlur="if(this.value=='') this.value='Search by Membership Title,Tagline and Amount'"/>
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
			<td width="2%">&nbsp;</td>
			<td colspan="6" align="left" valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#95989A">
		  			<tr bgcolor="#95989A">
						<td align="left" valign="middle" height="25px;" class="padleft" width="15%"><span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Membership Title</a></strong></span><?=$ReturnSortingArr['DisplaySortingImage'][1]?></td>
						<td width="15%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">Membership Tagline</a></strong></span><?=$ReturnSortingArr['DisplaySortingImage'][2]?></td>
						<td width="15%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/3/ordertype/<?=$ordertype?><?=$searchLink?>');">Amount</a></strong></span><?=$ReturnSortingArr['DisplaySortingImage'][3]?></td>
						<td width="8%" align="center" class="whitetext" valign="middle"><strong>Validity</strong></td>
						<td width="8%" align="center" class="whitetext" valign="middle"><strong>Add Plan Subscriptions</strong></td>
						<td width="8%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
						<td width="10%" align="center" class="whitetext" valign="middle"><strong>Re-Order</strong></td>
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
	<?php
		$i = 0;
		foreach($MemArr as $memarr):
		$active_img	= $memarr->status == 1 ? "true.gif" : "false.gif";
		$active_alt	= $memarr->status ==1 ? "Active" : "Inactive";
		$status_id 	= 15;
		$i++;
		$f_title = (strlen($memarr->membership_name)>20) ? substr($memarr->membership_name,0,12).'...' : $memarr->membership_name;
		$f_result = (strlen($memarr->membership_tagline)>25) ? substr($memarr->membership_tagline,0,25).'...' : $memarr->membership_tagline;
	?>

		<tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
			<td width="15%" height="25px;" align="left" valign="middle" class="padleft"><?=$f_title?></td>
			<td width="15%" align="center" valign="middle"><?=$f_result?></td>
			<td width="15%" align="center" valign="middle"><?=$memarr->currency_symbol?> <?=$memarr->membership_amount?></td>
			<td width="8%" align="center" valign="middle"><?=$memarr->membership_validity?></td>
			<td align="center" width="8%" ><!--a href="<?=base_url()?>superadmin/membership_plan/plan_subscription/<?=$memarr->membership_type_id?>"--><img src="<?php echo base_url(); ?>images/add.png" alt="Rate Manager" title="Rate Manager" /><!--/a--></td>
			<td width="10%" align="center" valign="middle"><a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/membership_plan/index/action/activate/record_id/<?=$memarr->membership_type_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')"><img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a></td>
			<td width="10%" align="center" valign="middle"><?=$memarr->img_rank?></td>
			<td width="10%" align="left" valign="middle">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" align="center" valign="middle"><a href="javascript:void(0);" onclick="edit_plan('<?=$memarr->membership_type_id?>');"><img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" /></a></td>
				<td width="50%" align="center" valign="middle"><a href="#" onClick="del_plan('<?=$memarr->membership_type_id?>','<?=addslashes(htmlspecialchars(stripslashes($memarr->membership_name)))?>')"><img src="<?= base_url()?>myjs/images/delete_icon.gif" border="0" alt="" /></a></td>
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

<div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table" ><!--class="credit-table"-->
      <tr>
        <td>Membership Title : </td>
        <td><input type="text" name="membership_name" class="required" id="membership_name" value=""/></td>
      </tr>
      <tr>
        <td>Membership Tagline : </td>
        <td><input type="text" name="membership_tagline" class="required" id="membership_tagline" value=""/></td>
      </tr>
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
        <input type="hidden" name="membership_type_id" class="required" id="membership_type_id" value=""/>
        </td>
      </tr>
      <tr>
        <td>Membership Amount : </td>
        <td><input type="text" name="membership_amount" class="required" id="membership_amount" value=""/></td>
      </tr>
        <tr>
        <td><!--Currency : --> </td>
        <td>
            <span><?php //echo $val['currency_symbol']; ?></span>
            <input type="hidden" name="currency_id" id="currency_id" value="<?php echo $selected_val; ?>"/>
        </td>
      </tr>
      <tr>
        <td>Membership Validity (Days) : </td>
        <td><input type="text" name="membership_validity" id="membership_validity" value=""/></td>
      </tr>
      <tr>
        <td>Add Feature : </td>
        <td id="edit_mode">
        <input type="text" name="membership_feature_1"  id="membership_feature_1" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
        <div id="hide_link_1"  class="hide_add" style="text-align:right; width:67%;"><a href="javascript:void(0);" onclick="add_another_box();" ><img src="<?php echo base_url(); ?>images/Add-feature.png" alt="" title="Add Feature" /> Add Another Feature</a></div>
        <div id="add_new_feature1" class="membership_feature_hide" >
        </div>
         <input type="hidden" name="feature_num" id="feature_num" value="1" />
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
            <input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_plan();" />
            &nbsp;
            <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_plan();" />
         </td>
      </tr>
    </table>
    </form>
    </div>

    <input type="hidden" name="membership_plan_id" id="membership_plan_id" value="" />
</div>
</div>
