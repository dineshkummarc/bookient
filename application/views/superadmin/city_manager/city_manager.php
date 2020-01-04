<?php include('city_manager.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">City Manager</h1>
         <div class ="tab_listing">
             <div id="add_new_link"  class="margin-adjust">
             <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add City" /></div>
         </div><br/><br/>
 <?php
  $status_massage;
   $msg;
  $parameter = $this->uri->uri_to_assoc(2);
   //print_r($parameter);
   if (array_key_exists('msg', $parameter)) {
      $messg = $parameter['msg'];
      if($messg == 1)
		   $msg = "Add operation unsuccessful. Try again.";
	  elseif($messg == 2)
		   $msg = "Added successfully.";
	  elseif($messg == 3)
		   $msg = "Change operation unsuccessful. Try again.";
	  elseif($messg == 4)
		   $msg = "Updated successfully.";

      $status_massage = $msg;
    //echo $status_massage;
   }
    ?>
<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle">
			    <input name="city_manager_search" type="text" class="text_input" id="city_manager_search" value="<?=($city_manager_search=='Search by City ,Region and Country Name' || $city_manager_search=='')?'Search by City ,Region and Country Name':$this->global_mod->show_to_control($city_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by City ,Region and Country Name') this.value=''" onBlur="if(this.value=='') this.value='Search by City ,Region and Country Name'"/>
				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			    <input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			    <input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/city_manager';"/>
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
						<td align="left" valign="middle" height="25px;" class="padleft" width="20%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">City Name</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                        <td width="20%" align="center" class="whitetext" valign="middle">
                            <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">Region Name</a></strong></span>
	<?=$ReturnSortingArr['DisplaySortingImage'][2]?>
                        </td>
                        <td width="20%" align="center" class="whitetext" valign="middle">
                            <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/3/ordertype/<?=$ordertype?><?=$searchLink?>');">Country Name</a></strong></span>
	<?=$ReturnSortingArr['DisplaySortingImage'][3]?>
                        </td>
						<td width="9%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
						<td width="10%" align="center" class="whitetext" valign="middle"><strong>Re-Order</strong></td>
						<td width="20%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong>Actions</strong></span></td>
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
					foreach($CityArr as $cityarr):
						$active_img	= $cityarr->is_active_s == "Y" ? "true.gif" : "false.gif";
						$active_alt	= $cityarr->is_active_s =="Y" ? "Active" : "Inactive";
						$status_id 	= 12;
						$i++;
				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="20%" height="25px;" align="left" valign="middle" class="padleft">
						<?php echo $cityarr->city_name; ?>
					</td>
                                        <td width="20%" height="25px;" align="center" valign="middle" class="padleft">
						<?php echo $cityarr->region_name; ?>
					</td>
                                         <td width="20%" align="center" valign="middle">
                                              <?php echo $cityarr->country_name; ?>
                                        </td>
					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/city_manager/index/action/activate/record_id/<?=$cityarr->city_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	                                <img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>



					<td width="10%" align="center" valign="middle"><?=$cityarr->img_rank?></td>
					<td width="20%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                                                                 <a href="javascript:void(0);" onclick="edit_region('<?=$cityarr->city_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/city_manager/index','<?=$cityarr->city_id?>','<?=addslashes(htmlspecialchars(stripslashes($cityarr->city_name)))?>','City:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($CityArr)==0): ?>
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
    <td><div id="country" style="border:none"><?php echo $country; ?></div>&nbsp; <span id="con_select_err"></span></td>
  </tr>
  <tr>
    <td style="width:18%;">Region Name: &nbsp;</td>
    <td><div id="region" style="border:none"><select name="region_id" id="cus_regionid_5" onchange="region_change();" ><option value="" >----Region---</option></select></div>&nbsp; <span id="region_select_err"></span></td>
  </tr>
   <tr>
    <td style="width:19%;">City Name: &nbsp; </td>
    <td><input type="text" name="cityname" id="cityname" value="" style="width:105%;" /> &nbsp; <span id="name_err"></span>
	 <input type="hidden" name="city_id" id="city_id" value="" />
	</td>
  </tr>
  <tr>
    <td style="width:18%;">City Key: &nbsp; </td>
    <td><input type="text" name="citykey" id="citykey" value="" style="width:105%;" /> &nbsp; <span id="key_err"></span></td>
  </tr>
  <tr>
    <td style="width:18%;">Lattitude : </td>
    <td><input type="text" name="latt" id="latt" value="" style="width:105%;" /> &nbsp; <span id="latt_err"></span></td>
  </tr>
  <tr>
    <td style="width:18%;">Longitude : </td>
    <td><input type="text" name="longi" id="longi" value="" style="width:105%;" /> &nbsp; <span id="longi_err"></span></td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_region" id="sub_region" value="Add" class="btn-blue" onclick="submit_region();" />&nbsp;
        <input type="button" name="cancel_region" id="cancel_region" value="Cancel" class="btn-gray" onclick="cancl_region();" />
    </td>
  </tr>
</table>
</form>
</div>
</div>
</div>