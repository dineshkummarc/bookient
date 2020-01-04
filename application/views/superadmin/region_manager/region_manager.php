<?php include('region_manager.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Region Manager</h1>
          <div class ="tab_listing">
              <div id="add_new_link"  class="margin-adjust">
	 <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Region" /></div>

</div><br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="region_manager_search" type="text" class="text_input" id="region_manager_search" value="<?=($region_manager_search=='Search by Region and Country Name' || $region_manager_search=='')?'Search by Region and Country Name':$region_manager_search; ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Region and Country Name') this.value=''" onBlur="if(this.value=='') this.value='Search by Region and Country Name'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/region_manager';"/>

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
						<td align="left" valign="middle" height="25px;" class="padleft" width="40%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Region Name</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                                                <td width="25%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">Country Name</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][2]?>
                                                </td>
						<td width="9%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
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
					foreach($RegionArr as $regionarr):
						$active_img	= $regionarr->is_actives == "Y" ? "true.gif" : "false.gif";
						$active_alt	= $regionarr->is_actives =="Y" ? "Active" : "Inactive";
						$status_id 	= 10;
						$i++;
				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="40%" height="25px;" align="left" valign="middle" class="padleft">
						<?php echo $regionarr->region_name; ?>
					</td>
                                         <td width="25%" align="center" valign="middle">
                                              <?=$regionarr->country_name?>
                                        </td>
					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/region_manager/index/action/activate/record_id/<?=$regionarr->region_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	                                <img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>



					<td width="10%" align="center" valign="middle"><?=$regionarr->img_rank?></td>
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                                                                 <a href="javascript:void(0);" onclick="edit_region('<?=$regionarr->region_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="javascript:void(0)" onClick="ConfirmDelete('<?=base_url()?>superadmin/region_manager/index','<?=$regionarr->region_id?>','<?=addslashes(htmlspecialchars(stripslashes($regionarr->region_name)))?>','Region:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($RegionArr)==0): ?>
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
	<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
	  <tr>
		<td style="width:18%;">Country Name: &nbsp;</td>
		<td><div id="country" style="border:none"><?php echo $country; ?></div>&nbsp; <span id="con_select_err"></span>
		</td>
	  </tr>
	  <tr>
		<td style="width:18%;">Region Name : </td>
		<td><input type="text" name="regionname" id="regionname" value="" style="width:125%;" /> &nbsp; <span id="name_err"></span>
		 <input type="hidden" name="region_id" id="region_id" value="" />
		</td>
	  </tr>
	  <tr>
		<td style="width:18%;">Region Code : </td>
		<td><input type="text" name="regioncode" id="regioncode" value="" style="width:125%;" /> &nbsp; <span id="code_err"></span>

		</td>
	  </tr>
	   <tr>
		<td colspan="2" align="center">
			<input type="button" name="sub_region" id="sub_region" value="Add" class="btn-blue" onclick="submit_region();" />
			&nbsp;
			<input type="button" name="cancel_region" id="cancel_region" value="Cancel" class="btn-gray" onclick="cancl_region();" />
		 </td>
	  </tr>
	</table>
	</form>
</div>
</div>
</div>
