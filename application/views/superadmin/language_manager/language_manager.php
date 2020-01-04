<?php include('language_manager.js.php'); ?>

<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Language Manager</h1>
         <div class ="tab_listing">
              <div id="add_new_link"  class="margin-adjust">

       <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Language" /></div>
              </div><br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="language_manager_search" type="text" class="text_input" id="language_manager_search" value="<?=($language_manager_search=='Search by Language Name' || $language_manager_search=='')?'Search by Language Name':$this->global_mod->show_to_control($language_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Language Name') this.value=''" onBlur="if(this.value=='') this.value='Search by Language Name'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/language_manager';"/>

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
						<td align="left" valign="middle" height="25px;" class="padleft" width="61%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Language Name</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                                                <td width="10%" align="center" class="whitetext" valign="middle"><strong>Image</strong></td>
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
					foreach($LanguagesArr as $langarr):
						$active_img	= $langarr->status == 1 ? "true.gif" : "false.gif";
						$active_alt	= $langarr->status == 1 ? "Active" : "Inactive";
						$status_id 	= 11;
						$i++;
				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="61%" height="25px;" align="left" valign="middle" class="padleft">
						<?php echo $langarr->language_flag; //$this->global_mod->show_to_control($langarr->languages_name); ?>
					</td>
                                        <td width="10%" align="center" valign="middle">
                                            <img id="langImg" src="<?=base_url()?>uploads/language/<?=$langarr->image?>" alt="" height="18" />
                                        </td>
					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/language_manager/index/action/activate/record_id/<?=$langarr->languages_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/IsNumeric/Y<?=$searchLink?>')">
	<img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>



					<td width="10%" align="center" valign="middle"><?=$langarr->img_rank?></td>
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                                                                <a href="javascript:void(0);" onclick="edit_language('<?=$langarr->languages_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/language_manager/index','<?=$langarr->languages_id?>','<?=addslashes(htmlspecialchars(stripslashes($langarr->languages_name)))?>','Language:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($LanguagesArr)==0): ?>
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
<form name="faq_frm" id="faq_frm" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>superadmin/language_manager/SaveLANGUAGEAjax">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Language Name : </td>
    <td><input type="text" name="languagesname" id="languagesname" value="" style="width:105%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="languages_id" id="languages_id" value="" />
	</td>
  </tr>
   <tr>

    <td>Select image : <br/><div id="add_img"></div></td>
     <td>
     <div id="add_new_staff">
    <input type="file" name="userfile" id="userfile" accept="image/*" class="text-input-staff-txtAra" /><br/> <span id="file_err"></span>
    <?php if(isset($error)) {echo $error;}?>

    </td>
    <td> <span>(Max. upload size is 50 Kb)</span></td>
    </div>
      </td>
  </tr>

  <tr>
  	<td colspan="2" align="center">
    <br/><br/>
    	<input type="button" name="sub_language" id="sub_language" value="Add" class="btn-blue" onclick="submit_language()" />
        &nbsp;
        <input type="button" name="cancel_language" id="cancel_language" value="Cancel" class="btn-gray" onclick="cancl_language();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>
</div>
