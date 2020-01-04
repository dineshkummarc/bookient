<?php  include('membership_feature.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Membership Feature Manager</h1>
        <div class ="tab_listing">
<!--div id="add_new_link" class="margin-adjust">
    <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Membership Feature" /></div>
</div-->
<br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >
			    <input name="membership_feature_search" type="text" class="text_input" id="membership_feature_search" value="<?=($membership_feature_search=='Search by Membership feature tittle' || $membership_feature_search=='')?'Search by Membership feature tittle':$this->global_mod->show_to_control($membership_feature_search) ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Membership feature tittle') this.value=''" onBlur="if(this.value=='') this.value='Search by Membership feature tittle'"/>
                <input type="hidden" name="dosearch" value="GO">
			</td>
			<td width="50%" align="left" valign="middle">&nbsp;&nbsp;
			    <input name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			    <input name="" type="button" class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/membership_feature';"/>
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
						<td align="left" valign="middle" height="25px;" class="padleft" width="70%"><span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Membership Feature</a></strong></span><?=$ReturnSortingArr['DisplaySortingImage'][1]?></td>			
						<td width="10%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
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
					$f_title = (strlen($memarr->feature_name)>170) ? substr($memarr->feature_name,0,170).'...' : $memarr->feature_name;
				?>
				<tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="70%" height="25px;" align="left" valign="middle" class="padleft"><?php echo $this->global_mod->show_to_control($f_title); ?></td>
					<td width="10%" align="center" valign="middle"><a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/membership_feature/index/action/activate/record_id/<?=$memarr->feature_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')"><img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a></td>
					<td width="10%" align="center" valign="middle"><?=$memarr->img_rank?></td>
					<td width="10%" align="center" valign="middle">
						<table width="" border="0" cellspacing="0" cellpadding="0">
					  	<tr>
							<td width="" align="center" valign="middle"><a href="javascript:void(0);" onclick="edit_plan('<?=$memarr->feature_id?>');"><img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" /></a></td>
						<!--td width="" align="center" valign="middle">
							<a href="javascript:void(0);" onClick="ConfirmDelete('<?=base_url()?>superadmin/membership_feature/index','<?=$memarr->feature_id?>','<?=addslashes(htmlspecialchars(stripslashes($memarr->feature_name)))?>','feature:: ')"><img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" /></a>
						</td-->
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
<style>
	.lsTextArea{
		width: 474px; 
		height: 130px;
	}
</style>
<div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table" ><!--class="credit-table"-->
      <tr>
        <td valign="top">Membership Feature Title : </td>
        <td>
        	<!--input type="text" name="feature_name" class="required" id="feature_name" value=""/-->
        	<textarea name="feature_name" class="required lsTextArea" id="feature_name"></textarea>
        </td>
      </tr>	 
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
      	<td></td>
        <td align="left">
            <input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_plan();" />
            &nbsp;
            <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_plan();" />
			<input type="hidden" name="feature_id" class="required" id="feature_id" value=""/>
         </td>
      </tr>
    </table>
    </form>
    </div>

    <input type="hidden" name="membership_feature_id" id="membership_feature_id" value="" />
</div>
</div>
