<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('faq_manager.js.php'); ?>

<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Faq Manager</h1>
        <div class ="tab_listing">
   <div id="add_new_link"  class="margin-adjust">

         <div style="float:right; margin-right:10px; margin-top:-30px;"><input name="" type="button"  class="btn-blue" onclick="hide_show_tbl();" value="+ Add Faq" /></div>
</div>
<div align="left" style="color:#FF0000; margin-left:300px;" ><?=$this->session->flashdata('status_massage')?><?=$status_massage?></div>
<div class="mid_manager_serch" align="right">
 	<form method="POST" name="form_search" id="form_search" action="<?=$page_name?>" onsubmit="return false;">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  	<td width="5%">&nbsp;</td>
			<td width="20%" align="right" valign="middle" >

			 <input name="faq_manager_search" type="text" class="text_input" id="faq_manager_search" value="<?=($faq_manager_search=='Search by FAQ Question and Answer' || $faq_manager_search=='')?'Search by FAQ Question and Answer':$this->global_mod->show_to_control($faq_manager_search); ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by FAQ Question and Answer') this.value=''" onBlur="if(this.value=='') this.value='Search by FAQ Question and Answer'"/>

				<input type="hidden" name="dosearch" value="GO">
			</td>
			<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
			<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?=$page_name?>/doSearch/Y/Is_Process/Y','form_search')" />
			<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?=base_url()?>superadmin/faq_manager';"/>

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
						<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/1/ordertype/<?=$ordertype?><?=$searchLink?>');">FAQ Question</a></strong></span>
						<?=$ReturnSortingArr['DisplaySortingImage'][1]?>
						</td>
                                                <td width="25%" align="center" class="whitetext" valign="middle">
                                                   <span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?=$page_name?>/Is_Process/Y/OrderByID/2/ordertype/<?=$ordertype?><?=$searchLink?>');">FAQ Answer</a></strong></span>
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
					foreach($FaqArr as $faqarr):
						$active_img	= $faqarr->is_active == "Y" ? "true.gif" : "false.gif";
						$active_alt	= $faqarr->is_active =="Y" ? "Active" : "Inactive";
						$status_id 	= 13;
						$i++;
				?>
                                     <?php

                                     $f_ques = (strlen($faqarr->faq_question)>20) ? substr($faqarr->faq_question,0,20).'...' : $faqarr->faq_question;
                                     ?>
				  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
					<td width="40%" height="25px;" align="left" valign="middle" class="padleft">
                                                <?=$f_ques?>
					</td>
                                        <?php
                                            $val = str_replace("&nbsp;",'',strip_tags($faqarr->faq_answer));
                                            $f_ans = (strlen($val)>20) ? substr($val,0,20).'...' : $val;
                                        ?>
                                         <td width="25%" align="center" valign="middle">
                                               <?php echo $this->global_mod->show_to_control($f_ans); ?>
                                        </td>
					<td width="10%" align="center" valign="middle">
					<a href="javascript:;" onClick="ManagerGeneral('<?=base_url()?>superadmin/faq_manager/index/action/activate/record_id/<?=$faqarr->faq_id?>/statusid/<?=$status_id?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?=$searchLink?>')">
	                                <img src="<?=base_url()?>myjs/images/<?=$active_img?>" width="15" height="14" border="0" alt="<?=$active_alt?>" /></a>
					</a>
					</td>



					<td width="10%" align="center" valign="middle"><?=$faqarr->img_rank?></td>
					<td width="10%" align="left" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>

							<td width="50%" align="center" valign="middle">
                                                                 <a href="javascript:void(0);" onclick="edit_faq('<?=$faqarr->faq_id?>');">
									<img src="<?=base_url()?>myjs/images/edit_dark.gif" alt="" width="15" height="14" border="0" />
								</a>
							</td>

						  <td width="50%" align="center" valign="middle">
						  <a href="#" onClick="ConfirmDelete('<?=base_url()?>superadmin/faq_manager/index','<?=$faqarr->faq_id?>','<?=addslashes(htmlspecialchars(stripslashes($faqarr->faq_question)))?>','FAQ:: ')">
						  <img src="<?=base_url()?>myjs/images/delete_icon.gif" border="0" alt="" />
						  </a>
						  </td>
						  </tr>
					</table>

					</td>
				  </tr>
				<? endforeach;?>
				<? if(count($FaqArr)==0): ?>
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
    <td style="width:18%;">FAQ Question : </td>
    <td><input type="text" name="question" id="question" value="" style="width:125%;" class="required"/> &nbsp; <span id="qstn_err" class="error"></span></td>
  </tr>
  <tr>
    <td>Answer : </td>
    <td><textarea cols="80" id="answer" name="answer" rows="10"></textarea> &nbsp; <span id="ans_err"></span>
    <script type="text/javascript">
        CKEDITOR.replace( 'answer',
            {
                skin : 'kama',
                height:"200",
                width:"124%"
            });
    </script>
    <input type="hidden" name="faq_id" id="faq_id" value="" />

    </td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_faq();" />
        &nbsp;
        <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_faq();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>
</div>
