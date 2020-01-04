



<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('credit_manager.js.php'); ?>


<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Credit Manager</h1>
        <div class ="tab_listing">
<div id="add_new_link" class="margin-adjust">

    <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Credit" /></div>
</div>

<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="credit_manager_search" type="text" class="text_input" id="credit_manager_search" value="<?=($credit_manager_search=='Search by Credit Title,Description and Amount' || $credit_manager_search=='')?'Search by Credit Title,Description and Amount':$this->global_mod->show_to_control($credit_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Credit Title,Description and Amount') this.value=''" onBlur="if(this.value=='') this.value='Search by Credit Title,Description and Amount'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/credit_manager';"/>

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
						<td align="left" valign="middle" height="25px;" class="padleft" width="15%">
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">Package Title</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                                                <td width="15%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">Package Description</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][2]?>
                                                </td>
												
												<td width="5%" align="center" class="whitetext" valign="middle"><span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/3/ordertype/<?=$ordertype?><?=$searchLink?>');">Credits</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][3]?></td>
												
                                                <td width="13%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/4/ordertype/<?=$ordertype?><?=$searchLink?>');">Base Amount</a></strong></span>
						   <?=$ReturnSortingArr['DisplaySortingImage'][4]?>
                                                </td>
                                                
                                                
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
				<?
					$i = 0;
                                        //echo '<pre>';print_r($CreditArr);exit();
					foreach($CreditArr as $credarr):
						$active_img	= $credarr->status == 1 ? "true.gif" : "false.gif";
						$active_alt	= $credarr->status ==1 ? "Active" : "Inactive";
						$status_id 	= 14;
						$i++;
				?>

				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="15%" height="25px;" align="left" valign="middle" class="padleft">
                                        <?php echo $this->global_mod->show_to_control($credarr->package_name); ?>
					</td>
                                         <td width="15%" align="center" valign="middle">
                                              <?php echo $this->global_mod->show_to_control($credarr->package_desc); ?>
                                        </td>
                                         <td width="5%" align="center" valign="middle">
                                              <!--?=$credarr->currency_symbol?--> <?=$credarr->credits?>
                                        </td>
                                        
                                       <td align="center" width="13%" valign="middle" >
                                            	<?php echo $credarr->base_amt ?>
                                       </td>

					<td width="8%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/credit_manager/index/action/activate/record_id/<?=$credarr->credit_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	                                <img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					
					</td>


						<td width="10%" align="center" valign="middle"><?=$credarr->img_rank?></td>
					<!--td width="10%" align="center" valign="middle"><?=$credarr->credit_order?></td-->
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="30%" align="center" valign="middle">
                                                                 <a href="javascript:void(0);" onclick="edit_credit('<?=$credarr->credit_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <!--td width="50%" align="center" valign="middle">
                                                      <a href="#" onClick="del_credit('<?=base_url()?>superadmin/credit_manager/index','<?=$credarr->credit_id?>','<?=addslashes(htmlspecialchars(stripslashes($credarr->package_name)))?>')">
						  <img src="<?= base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td-->
						  
						  <td width="30%" align="center" valign="middle">
						  		<a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/credit_manager/index','<?=$credarr->credit_id?>','<?=addslashes(htmlspecialchars(stripslashes($credarr->package_name)))?>','Package:: ')">
									<img src="<?= base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
								</a>
						  </td>
						  
						  <td>
						  	<a href="<?php echo base_url()?>superadmin/credit_country_cost/index/<?php echo $credarr->credit_id?>">View Cost</a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($CreditArr)==0): ?>
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
</div><br/  >
<br/>

<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td>Credit Title : </td>
    <td>
		<input type="text" name="package_name" id="package_name" value="" class="required" /><br /><span id="ans_err"></span>
	</td>
  </tr>
  <tr>
    <td valign="top">Credit Description : </td>
    <td><textarea cols="10" id="description" name="description" rows="5"></textarea> &nbsp; <span id="ans_err1"></span>
    <script type="text/javascript">
        CKEDITOR.replace( 'description',
            {
                skin : 'kama',
                toolbar : 'Basic',
                height:"200",
                width:"68%"
            });
    </script>
    <input type="hidden" name="credit_id" id="credit_id" value="" /  >
	<input  type="hidden" name="action" id="action" value=""/>
    </td>
  </tr>
  <tr>
    <td>Credit Amount :</td>
    <td><input type="text" name="amount" id="amount" value="" class="required" /><br /><span id="ans_err2"></span></td>
  </tr>
  <tr>
    <td>Credit : </td>
    <td><input type="text" name="credit" id="credit" value="" class="required" /><br /><span id="ans_err3"></span></td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_credit();" />
        &nbsp;
        <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_credit();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>
</div>




