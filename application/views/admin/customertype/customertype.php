<?php include('customertype.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('heading-main'))?></h1>
        <div class ="tab_listing">
            <div id="add_new_link"  class="margin-adjust">
                 <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ <?php echo $this->global_mod->db_parse($this->lang->line('add_cus_type'))?>" /></div>

       </div><br/><br/>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="customertype_search" type="text" class="text_input" id="customertype_search" value="<?=($tax_manager_search=='Search by Customer Type' || $tax_manager_search=='')?'Search by Customer Type':$this->global_mod->show_to_control($tax_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Customer Type') this.value=''" onBlur="if(this.value=='') this.value='Search by Customer Type'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="<?php echo $this->global_mod->db_parse($this->lang->line('search_btn'))?>" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('reset_btn'))?>" onClick="window.location.href='<?=base_url()?>admin/customertype';"/>

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
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');"><?php echo $this->global_mod->db_parse($this->lang->line('cus_type_name'))?></a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
						<td width="10%" align="center" class="whitetext" valign="middle"><strong><?php echo $this->global_mod->db_parse($this->lang->line('active'))?></strong></td>
						<td width="20%" align="center" class="whitetext" valign="middle" colspan="2"><span class="whitetext"><strong><?php echo $this->global_mod->db_parse($this->lang->line('actions'))?></strong></span></td>
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
	
					foreach($AllCustomers as $Customer):
						
						$active_img	= $Customer->customertype_status == 'Y' ? "true.gif" : "false.gif";
						$active_alt	= $Customer->customertype_status == 'Y' ? "Active" : "Inactive";
						$status_id 	= 5;
						$i++;

				?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="70%" height="25px;" align="left" valign="middle" class="padleft">
						<?php echo $this->global_mod->show_to_control($Customer->customertype_name); ?>
					</td>
					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>admin/customertype/index/action/activate/record_id/<?=$Customer->customertype_id ?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/IsNumeric/Y<?=$searchLink?>')">
	<img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>
					
					<td width="20%" align="center" valign="middle">
						<table width="40%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                                                                <a onclick="edit_tax('<?=$Customer->customertype_id ?>');" href="javascript:void(0);">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="#" onClick="ConfirmDelete('<?=base_url()?>admin/customertype/index','<?=$Customer->customertype_id ?>','<?=addslashes(htmlspecialchars(stripslashes($Customer->customertype_name)))?>','Customer Type:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($AllCustomers)==0): ?>
				<tr bgcolor="#FFFFFF"><td colspan="5" align="center"><?php echo $this->global_mod->db_parse($this->lang->line('no_data_found'))?></td></tr>
				<? endif; ?>
			  </table>
			</td>
		 <td width="2%">&nbsp;</td>
		  </tr>
  </table>
</div>

<div id="paginate" style="padding: 0 30px 0 0 ;padding-left: 50px;padding-left: 35px;"><?=$pagination?></div>
</div><br/>
<div id="add_faq" style="display:none;">


<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;"><?php echo $this->global_mod->db_parse($this->lang->line('cus_type_name'))?> : </td>
    <td><input type="text" name="type_name" id="type_name" value="" style="width:105%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="customertype_id" id="customertype_id" value="" />
	</td>
  </tr>
  <tr>
  	<td><?php echo $this->global_mod->db_parse($this->lang->line('status'))?> : </td>
  	<td>
  		<input type="checkbox" name="type_status" id="type_status" checked=""/>
  	</td>
  </tr>

  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_tax" id="sub_tax" value="<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?>" class="btn-blue" onclick="submit_tax();" />
        &nbsp;
        <input type="button" name="cancel_tax" id="cancel_tax" value="<?php echo $this->lang->line('cancel_btn')?>" class="btn-gray" onclick="cancl_tax();" />
     </td>
  </tr>
</table>
</form>
</div>


</div>
</div>





























