<?php include('dateformat_manager.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Date Format Manager</h1>
	<div class ="tab_listing">        
		<div align="left" style="color:#FF0000; margin-left:300px;" ><?php echo $this->session->flashdata('status_massage'); ?><?php echo $status_massage; ?></div>
		<div class="mid_manager_serch" align="right">
		 	<form method="POST" name="form_search" id="form_search" action="<?php echo $page_name; ?>" onsubmit="return false;">
				<table width="100%" border="0" cellspacing="5" cellpadding="0">
				  <tr>
				  	<td width="5%">&nbsp;</td>
					<td width="20%" align="right" valign="middle" >

					 <input name="dateformat_manager_search" type="text" class="text_input" id="dateformat_manager_search" value="<?php echo ($dateformat_manager_search=='Search by Date Format' || $dateformat_manager_search=='')?'Search by Date Format':$dateformat_manager_search; ?>" style="width: 700px;" size="150" onFocus="if(this.value=='Search by Date Format') this.value=''" onBlur="if(this.value=='') this.value='Search by Date Format'"/>

						<input type="hidden" name="dosearch" value="GO">
					</td>
					<td  width="50%" align="left" valign="middle" >&nbsp;&nbsp;
					<input  name="submitdosearch" value="Search" type="button" class="btn-blue" onClick="ManagerGeneralForm('<?php echo $page_name; ?>/doSearch/Y/Is_Process/Y','form_search')" />
					<input name="" type="button"  class="btn-blue" value="Reset" onClick="window.location.href='<?php echo base_url(); ?>superadmin/dateformat_manager';"/>

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
								<span class="whitetext"><strong><a href="javascript:;" onClick="ManagerGeneral('<?php echo $page_name; ?>/Is_Process/Y/OrderByID/1/ordertype/<?php echo $ordertype; ?><?php echo $searchLink; ?>');">Date Format</a></strong></span>
								<?php echo $ReturnSortingArr['DisplaySortingImage'][1]; ?>
								</td>
								<td width="10%" align="center" class="whitetext" valign="middle"><strong>Active</strong></td>
								<td width="10%" align="center" class="whitetext" valign="middle"><strong>Re-Order</strong></td>
								
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
							foreach($DateformatArr as $dtformat):
								$active_img	= $dtformat->is_active == "Y" ? "true.gif" : "false.gif";
								$active_alt	= $dtformat->is_active =="Y" ? "Active" : "Inactive";
								$status_id 	= 6;
								$i++;
						?>
						  <tr <?php if($i%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
							<td width="70%" height="25px;" align="left" valign="middle" class="padleft">
								<?php echo $dtformat->date_format; ?>
							</td>
							<td width="10%" align="center" valign="middle">
							<a href="javascript:void(0)" onClick="ManagerGeneral('<?php echo base_url(); ?>superadmin/dateformat_manager/index/action/activate/record_id/<?php echo $dtformat->date_format_id; ?>/statusid/<?php echo $status_id; ?>/viewtype/catalogmanager/Is_Process/Y/IsPreserved/Y/<?php echo $searchLink; ?>')">
			                      <img src="<?php echo base_url(); ?>myjs/images/<?php echo $active_img; ?>" width="15" height="14" border="0" alt="<?php echo $active_alt; ?>" /></a>
							</a>
							</td>
							<td width="10%" align="center" valign="middle"><?php echo $dtformat->img_rank; ?></td>
							
						  </tr>
						<?php endforeach;?>
						<?php if(count($DateformatArr)==0): ?>
						<tr bgcolor="#FFFFFF"><td colspan="5" align="center">No Record Found</td></tr>
						<?php endif; ?>
					  </table>
					</td>
				 <td width="2%">&nbsp;</td>
				  </tr>
		  </table>
		</div>
		<br />
		<div id="paginate" style="padding: 0 30px 0 0 ;"><?php echo $pagination; ?></div>
	</div>		
	<br/><br/>
</div>
</div>