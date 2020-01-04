<script>
$( document ).ready(function() {
 commonAlert();
});
</script>
<pre>
	<?php //print_r($this->session->all_userdata());?>
</pre>
<style>
	#ddmMyHome{
		 font:bold 12px Arial, Helvetica, sans-serif; 
		 color:#fff; 
		 margin:15px 15px 0 0; 
		 text-align:right;
	}
</style> 
<div class="maincontainer">
<div class="navigation">
	<!--/*@@@@@@@@@@ Auth part start @@@@@@@@@@*/-->
	<?php
	$validMenuLeft = array(34,36,39);
	if (in_array(67, $this->global_mod->authArray())){
		array_push($validMenuLeft,57);
		array_push($validMenuLeft,58);
	}
	/*if (in_array(63, $this->global_mod->authArray())){
		array_push($validMenuLeft,43);
	}*/
	if (in_array(62, $this->global_mod->authArray())){
		array_push($validMenuLeft,60);
		array_push($validMenuLeft,44);
	}
	if (in_array(61, $this->global_mod->authArray())){
		array_push($validMenuLeft,45);
	}
	if (in_array(60, $this->global_mod->authArray())){
		array_push($validMenuLeft,42);
	}
	if (in_array(59, $this->global_mod->authArray())){
		array_push($validMenuLeft,42);
	}
	if (in_array(41, $this->global_mod->authArray())){
		array_push($validMenuLeft,59);
	}
	if (in_array(43, $this->global_mod->authArray())){
		array_push($validMenuLeft,52);
	}
	if (in_array(40, $this->global_mod->authArray())){
		array_push($validMenuLeft,43);
	}
	if (in_array(42, $this->global_mod->authArray())){
		array_push($validMenuLeft,35);
		array_push($validMenuLeft,37);
		array_push($validMenuLeft,38);
	}
	if (in_array(83, $this->global_mod->authArray())){
		array_push($validMenuLeft,40);
	}
	?>
	<!--/*@@@@@@@@@@ Auth part end   @@@@@@@@@@*/-->
	
<ul class="mainNav"> 
    <?php foreach($menu_left as $left_menu){ ?>
    <li> 
    <?php if($left_menu['parent']['menu_name'] == 'Graph'){ ?>				
	<?php	if (in_array(33, $this->global_mod->authArray())){	?>	
			<a href="<?php echo base_url(); ?>admin/<?php echo $left_menu['parent']['page_link']; ?>"><?php echo $left_menu['parent']['menu_name']; ?></a>
	<?php }else{ ?>
			<a href="<?php echo base_url(); ?>admin/upgradeAuth"><?php echo $left_menu['parent']['menu_name']; ?></a>
	<?php 	} ?>
	<?php }else{ ?>
		<a href="<?php echo base_url(); ?>admin/<?php echo $left_menu['parent']['page_link']; ?>"><?php echo $left_menu['parent']['menu_name']; ?></a>
	<?php } ?>
    <ul>
	<?php foreach($left_menu['child'] as $left_menu_child){ ?>
<?php if (in_array($left_menu_child['admin_menu_id'], $validMenuLeft)){ ?>		
		<li><a  href="<?php echo base_url()."admin/".$left_menu_child['page_link']; ?>"><?php echo $left_menu_child['menu_name']; ?></a></li>
	<?php }else{ ?>	
		<li><a  href="<?php echo base_url()."admin/upgradeAuth"; ?>"><?php echo $left_menu_child['menu_name']; ?></a></li>
	<?php } ?>		
    <?php } ?>
	</ul>

    </li>
    <?php } ?>
</ul>




	<!--/*@@@@@@@@@@ Auth part start @@@@@@@@@@*/-->
	<?php
	$validMenu = array(2,3,4,6,8,10,13,45,46,50,56);
	if (in_array(85, $this->global_mod->authArray())){
		array_push($validMenu,53);
	}
	if (in_array(75, $this->global_mod->authArray())){
		array_push($validMenu,15);
	}
	if (in_array(71, $this->global_mod->authArray())){
		array_push($validMenu,9);
	}
	if (in_array(34, $this->global_mod->authArray())){
		array_push($validMenu,51);
	}
	if (in_array(44, $this->global_mod->authArray())){
		array_push($validMenu,48);
	}
	if ($this->session->userdata('is_multilocation') !=0){
		array_push($validMenu,55);
	}
	
	?>
	<!--/*@@@@@@@@@@ Auth part end   @@@@@@@@@@*/-->
<ul class="otherNav">
	<li><span id="ddmMyHome">Welcome <?php echo $this->session->userdata('user_name'); ?>!</span></li>
	<?php foreach($menu_right as $right_menu){ ?>
	<?php if ($right_menu['parent']['menu_name'] == 'Logout') { ?>
	<li><a href="<?php echo base_url()."admin/".$right_menu['parent']['page_link']; ?>"><?php echo $right_menu['parent']['menu_name']; ?></a></li>
	<?php  } else {  ?>
	<li>
		<a href="javascript:void(0)"><?php echo $right_menu['parent']['menu_name']; ?></a>
	<?php }  ?> 
	<?php if(count($right_menu['child']) > 0 ){ ?>
	
	<ul>
		<?php foreach($right_menu['child'] as $right_menu_child){ ?>	
<?php if($this->session->userdata('is_parent') == 0){ ?>
	<?php if (in_array($right_menu_child['admin_menu_id'], $validMenu)){?>
			<li>
			<?php if($right_menu_child['menu_name'] == 'Add Location'){  ?>
			<?php if (in_array(86, $this->global_mod->authArray())){ ?>
			<?php if ($this->session->userdata('is_multilocation') !=0 && ($this->session->userdata('no_of_location') >= $this->session->userdata('total_no_location'))){?>
			<a href="<?php echo $right_menu_child['page_link']; ?>"><?php echo $right_menu_child['menu_name']; ?></a>
			<?php }else{ ?>
			<a href="<?php echo base_url(); ?>admin/upgradeAuth"><?php echo $right_menu_child['menu_name']; ?></a>
			<?php } ?>
			<?php }else{ ?>
			<a href="<?php echo base_url(); ?>admin/upgradeAuth"><?php echo $right_menu_child['menu_name']; ?></a>
			<?php } ?>
			<?php }else{ ?>
			<a href="<?php echo base_url()."admin/".$right_menu_child['page_link']; ?>"><?php echo $right_menu_child['menu_name']; ?></a>	
			<?php } ?>	
			
			</li>
	<?php }else{ ?>
			<li><a href="<?php if($right_menu_child['menu_name'] != 'Add Location'){ echo base_url().'admin/upgradeAuth';}else{echo base_url().'admin/upgradeAuth';}?>"><?php echo $right_menu_child['menu_name']; ?></a></li>
	<?php } ?>
		
		<?php 
				}else{ 
				if($right_menu_child['admin_menu_id']!=55 && $right_menu_child['admin_menu_id']!=56){
		?>		
		
		<li><a href="<?php if($right_menu_child['menu_name'] != 'Add Location'){ echo base_url()."admin/";} echo $right_menu_child['page_link']; ?>"><?php echo $right_menu_child['menu_name']; ?></a></li>
		
	<?php }} ?>
	<?php 
	if (in_array(86, $this->global_mod->authArray())){
	if ($this->session->userdata('is_multilocation') !=0 && ($this->session->userdata('no_of_location') >= $this->session->userdata('total_no_location'))){ ?>
	<!--///local admin link start///-->
	<?php if($right_menu_child['admin_menu_id']==55 && count($pardco_location)>0){ ?>
	<?php foreach($pardco_location as $location){ ?>
	<li><a href="#" onclick="goToSubPage('<?php echo $location->localid ;?>')"> <?php echo $location->usernm ;?></a></li>
	<?php } ?>
	<?php } ?>
	<!--/// local admin link end///-->
	<?php } }?>
		<?php }?>
	</ul> 
	<?php } ?>
    </li>
    <?php }
    if($this->session->userdata('is_super_admin')){ ?>
       <li ><a href="<?php echo base_url()."admin/back_to_super"; ?>"><span>Back to Super Admin Dashboard</span></a></li>
    <?php } ?>
</ul>

<div class="spacer"></div>
</div>
</div>