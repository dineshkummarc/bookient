<?php include('dependency.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->lang->line('headign-main'); ?></h1>
	<div class="inner-div">
		<?php echo $this->lang->line('dependency_head_details'); ?>
	</div>
	<br />
	<h2><?php echo $this->lang->line('dependency_ser_selectn_optn'); ?></h2>
	
	<div class="inner-div">
	<table width="46%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="left"><?php echo $this->lang->line('dependency_to_allow_multiple_service'); ?> </td>
		<td align="left">	<select name="selectoption" id="selectoption"   onchange="showdep(this.value)" style="width:74px; margin:6px 0 0 0;">
			<option value="1" <?php echo ($MultipleServicesBooking ==1)?'selected="selected"':''  ?> ><?php echo $this->lang->line('dependency_option_yes'); ?></option>
			<option value="0" <?php echo ($MultipleServicesBooking ==0)?'selected="selected"':''  ?> ><?php echo $this->lang->line('dependency_option_no'); ?></option>
		</select></td>
	  </tr>
	</table>
	</div>
	<br/> 
	<div id="dependency" style="display: <?php echo ($MultipleServicesBooking ==1)?'block':'none'  ?>;">
		<h2><?php echo $this->lang->line('dependency_service_dependency'); ?></h2>
		<div class="inner-div">	
			<div id="insert_suss" align="center"></div>
				<div id="add_link"> 
				<a href="javascript:void(0);" onclick="showdependency()" class="add-customer"><?php echo $this->lang->line('dependency_add_dependency'); ?> </a>
				</div>
				<br/>
				<div id="add_dependency" style="width:95%; margin:0 auto; display: none;">
					<table width="95%" border="0" cellspacing="10" cellpadding="0">
					  <tr>
						<td  align="left"  width="50%">
							<div id="left_dependency" class="blue-bg">
								<h3>::<?php echo $this->lang->line('dependency_services_listing'); ?>::</h3>
								<div class="depen-scroll">
									<?php echo $nonDependenctService; ?>
								</div>
							</div>
						</td>
						<td align="left" width="50%">
							<div id="right_dependency" class="blue-bg">
								<h3> ::<?php echo $this->lang->line('dependency_dependenton_listing'); ?>::</h3>
								<div class="depen-scroll">
									<?php echo $service; ?>
								</div>
							</div>
						</td>
					  </tr>
					</table>
					<div class="spacer"></div>
					<div  style="width:90%;text-align:center; margin:25px 0;">
						<input type="button" name="add_dependency" class="btn-blue" value="<?php echo $this->lang->line('dependency_add_dependencybtn'); ?>"  onclick="insert_to_db()"/>
						<input type="button" name="cancel" class="btn-gray" value="<?php echo $this->lang->line('dependency_cancel_dependencybtn'); ?>"  onclick="cancel()"/>
					</div>
					<div class="spacer"></div>
				 </div>
			</div>
		<div class="inner-div">	
			<div id="show_all_dependency"   <?php if($showDependency ==""){ ?>  style="display:none;"<?php } else { echo 'class="show-dependency"'; } ?> > 
				<div style="background:#fff;">
					<?php echo $showDependency; ?>
				</div>
			</div>
		</div>
	</div>
	<div id="custom_dependency" style="display: block;">
		<h2><?php echo $this->lang->line('dependency_custom_service_dependency'); ?></h2>
		<div id="insert_custom_suss" align="center"></div>
		<div class="inner-div">
			<?php echo $this->lang->line('dependency_custom_details'); ?>
		</div>
		<div class="inner-div">	
			<div id="insert_custom_suss" align="center"></div>
			</div>
		</div>
		<div class="inner-div">	
			<div id="show_all_custom_dependency"   <?php if($showCustomDependency ==""){ ?>  style="display:none;"<?php } else { echo 'class="show-dependency"'; } ?> > 
				<div style="background:#fff;">
					<form id="custom_send_form" action="<?php echo base_url(); ?>admin/dependency/insert_custom_to_db_Ajax" method="post">
						<?php echo $showCustomDependency; ?>
					</form>
				</div>
			</div>
			<div  style="width:90%;text-align:center; margin:25px 0;">
				<input type="button" name="add_custom_dependency" class="btn-blue" value="<?php echo $this->lang->line('dependency_add_custom'); ?>"  onclick="insert_custom_to_db()"/>
				<input type="button" name="cancel" class="btn-gray" value="<?php echo $this->lang->line('dependency_cancel_dependencybtn'); ?>"  onclick="cancel()"/>
			</div>
		</div>
	</div>
	<div class="spacer"></div>
</div>
