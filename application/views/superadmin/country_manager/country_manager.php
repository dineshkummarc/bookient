<?php include('country_manager.js.php'); ?>

<div id="records_listing">
<div class="superadmin_rounded_corner">
    <h1 class="headign-main-superadmin">Country Manager</h1>
    <div class ="tab_listing">
        <div id="add_new_link"  class="margin-adjust">

        <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Country" /></div>
    </div><br/><br/>


<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="2%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="country_manager_search" type="text" class="text_input" id="country_manager_search" value="<?=($country_manager_search=='Search by Country Name' || $country_manager_search=='')?'Search by Country Name':$this->global_mod->show_to_control($country_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Country Name') this.value=''" onBlur="if(this.value=='') this.value='Search by Country Name'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" nowrap="true">&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/country_manager';"/>

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
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Countery Name</a></strong></span>
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
					foreach($CountryArr as $country):
						$active_img	= $country->is_active == "Y" ? "true.gif" : "false.gif";
						$active_alt	= $country->is_active =="Y" ? "Active" : "Inactive";
						$status_id 	= 1;
						$i++;
				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="70%" height="25px;" align="left" valign="middle" class="padleft">
						<?php echo $this->global_mod->show_to_control($country->country_name); ?>
					</td>
					<td width="10%" align="center" valign="middle">
					<a href="#" onClick="ManagerGeneral('<?=base_url()?>superadmin/country_manager/index/action/activate/record_id/<?=$country->country_id?>/statusid/<?=$status_id?>/viewtype/country_manager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	<img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>
					<td width="10%" align="center" valign="middle"><?=$country->img_rank?></td>
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">

                                                                <a onclick="edit_country('<?=$country->country_id?>');" href="javascript:void(0);">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <?php
						 	$url = base_url().'superadmin/country_manager/index';
						 	
						 ?>
						  <a href="#" onClick="checkCountryForeign('<?php echo $url."',".$country->country_id.",'".addslashes(htmlspecialchars(stripslashes($country->country_name)))."',"."'Country:: '"?>)">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($CountryArr)==0): ?>
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
<br><br>
</div>
<div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
      <tr>
        <td style="width:22%;">Country Name : </td>
        <td><input type="text" name="countryname" id="countryname" value="" style="width:70%;" class="required" /> <br /> <span id="qstn_err"></span>
         <input type="hidden" name="country_id" id="country_id" value="" />
        </td>
      </tr>
      <tr>
      	<td>Country Code : </td>
      	<td>
      		<input type="text" name="country_code" id="country_code" style="width: 10%;" class="" /> <br /> <span id="qstn_err2"></span>
      	</td>
      </tr>
      <tr>
      	<td>Dial Prefix :</td>
      	<td>
      		<input type="text" name="dial_prefix" id="dial_prefix" style="width: 10%;" /><br /> <span id="qstn_err1"></span>
      	</td>
      </tr>

      <tr>
        <td colspan="2" align="center">
            <input type="button" name="sub_country" id="sub_country" value="Add" class="btn-blue" onclick="submit_country();" />
            &nbsp;
            <input type="button" name="cancel_country" id="cancel_country" value="Cancel" class="btn-gray" onclick="cancl_country();" />
         </td>
      </tr>
    </table>
    </form>
    </div>
    </div>
</div>