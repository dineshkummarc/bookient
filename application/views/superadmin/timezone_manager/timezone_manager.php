
<?php include('timezone_manager.js.php'); ?>

<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Time Zone Manager</h1>
      <div class ="tab_listing">
            <div id="add_new_link"  class="margin-adjust">

        <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Time Zone" /></div>
            </div><br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="timezone_manager_search" type="text" class="text_input" id="timezone_manager_search" value="<?=($timezone_manager_search=='Search by Timezone Name' || $timezone_manager_search=='')?'Search by Timezone Name':$this->global_mod->show_to_control($timezone_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Timezone Name') this.value=''" onBlur="if(this.value=='') this.value='Search by Timezone Name'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/timezone_manager';"/>

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
						<td align="left" valign="middle" height="25px;" class="padleft" width="70%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Timezone Name</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
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
				<?
					$i = 0;
					foreach($TimezoneArr as $timezone):
						$active_img	= $timezone->is_active == "Y" ? "true.gif" : "false.gif";
						$active_alt	= $timezone->is_active =="Y" ? "Active" : "Inactive";
						$status_id 	= 2;
						$i++;
				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="70%" height="25px;" align="left" valign="middle" class="padleft">
					
						<?php echo $this->global_mod->show_to_control($timezone->time_zone_name); ?>&nbsp;
						(GMT
							<? echo ($timezone->gmt_symbol == 1)?'+':'-'; ?>										
							<?=$timezone->gmt_value ?>
						) 
					</td>
					<td width="10%" align="center" valign="middle">
					<a href="#" onClick="ManagerGeneral('<?=base_url()?>superadmin/timezone_manager/index/action/activate/record_id/<?=$timezone->time_zone_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	<img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>
					<td width="10%" align="center" valign="middle"><?=$timezone->img_rank?></td>
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                               <a href="javascript:void(0);" onclick="edit_timezone('<?=$timezone->time_zone_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/timezone_manager/index','<?=$timezone->time_zone_id?>','<?=addslashes(htmlspecialchars(stripslashes($timezone->time_zone_name)))?>','Time Zone:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($TimezoneArr)==0): ?>
				<tr bgcolor="#FFFFFF"><td colspan="5" align="center">No Record Found</td></tr>
				<? endif; ?>
			  </table>
			</td>
		 <td width="2%">&nbsp;</td>
		  </tr>
  </table>
</div>
<br />
<div id="paginate" style="padding: 0 30px 0 0 ;"><?=$pagination?></div></div><br/>
<br/>

<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Time Zone Name : </td>
    <td><input type="text" name="timezonename" id="timezonename" value="" style="width:30%;" /> &nbsp;
	(GMT 
	<select id="gmt_symbol" name="gmt_symbol" style="width:10%;">		
		<option value="1">+</option>
		<option value="0">-</option>
	</select>	
	<input type="text" name="gmt_value" id="gmt_value" value="" style="width:30%;" maxlength="8" />
	) 
	
	 <span id="qstn_err" style="color:#FF0000;font-size:10px;"></span>
	 <input type="hidden" name="time_zone_id" id="time_zone_id" value="" />
	
	</td>
  </tr>

  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_timezone" id="sub_timezone" value="Add" class="btn-blue" onclick="submit_timezone();" />
        &nbsp;
        <input type="button" name="cancel_timezone" id="cancel_timezone" value="Cancel" class="btn-gray" onclick="cancl_timezone();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>
</div>



























