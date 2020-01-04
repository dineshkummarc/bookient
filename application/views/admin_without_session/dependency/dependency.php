<?php include('dependency.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->lang->line('headign-main'); ?></h1>
	<div class="inner-div">
		This screen allows you to set Service Dependencies. It means that if someone books two services that are dependent of each other, then the system will automatically allot dependent service, after non-dependent one.
	</div>
	<br />
	<h2>1. Service selection option.</h2>
	
	<div class="inner-div">
	<table width="46%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="left">Do you want to allow your customers to select multiple services? </td>
		<td align="left">	<select name="selectoption" id="selectoption"   onchange="showdep(this.value)" style="width:74px; margin:6px 0 0 0;">
			<option value="1" <?php echo ($MultipleServicesBooking ==1)?'selected="selected"':''  ?> >Yes</option>
			<option value="0" <?php echo ($MultipleServicesBooking ==0)?'selected="selected"':''  ?> >No</option>
		</select></td>
	  </tr>
	</table>
	</div>
	<br/> 
	<div id="dependency" style="display: <?php echo ($MultipleServicesBooking ==1)?'block':'none'  ?>;">
		<h2>2. Service dependency.</h2>
		<div class="inner-div">	
			<div id="insert_suss" align="center"></div>
				<div id="add_link"> 
				<a href="javascript:void(0);" onclick="showdependency()" class="add-customer">Add Dependency </a>
				</div>
				<br/>
				<div id="add_dependency" style="width:95%; margin:0 auto; display: none;">
					<table width="95%" border="0" cellspacing="10" cellpadding="0">
					  <tr>
						<td  align="left"  width="50%">
							<div id="left_dependency" class="blue-bg">
								<h3>::Services::</h3>
								<div class="depen-scroll">
									<?php echo $nonDependenctService; ?>
								</div>
							</div>
						</td>
						<td align="left" width="50%">
							<div id="right_dependency" class="blue-bg">
								<h3> ::Dependent On::</h3>
								<div class="depen-scroll">
									<?php echo $service; ?>
								</div>
							</div>
						</td>
					  </tr>
					</table>
					<div class="spacer"></div>
					<div  style="width:90%;text-align:center; margin:25px 0;">
						<input type="button" name="add_dependency" class="btn-blue" value="Add Dependency"  onclick="insert_to_db()"/>
						<input type="button" name="cancel" class="btn-gray" value="Cancel"  onclick="cancel()"/>
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
	<div class="spacer"></div>
</div>
