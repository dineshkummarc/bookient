<script>
$( document ).ready(function() {
commonAlert();
});
</script> 
<div class="maincontainer">
<div class="navigation">
<ul class="otherNav">
    <li class=""><span style="font:bold 12px Arial, Helvetica, sans-serif; color:#fff; margin:15px 15px 0 0; text-align:right;" id="ddmMyHome">Welcome <?php echo $this->session->userdata('user_name'); ?>!</span></li>
    <?php
	foreach($menu_right as $right_menu){
	?>
		<?php if ($right_menu['parent']['menu_name'] == 'Logout') { ?>
    <li class=""><a href="<?php echo base_url()."admin/".$right_menu['parent']['page_link']; ?>"><?php echo $right_menu['parent']['menu_name']; ?></a>
		<?php  } else {  ?>
	<li class=""><a href="javascript:void(0)"><?php echo $right_menu['parent']['menu_name']; ?></a>
		<?php }  ?> 
    <ul>
		<?php
		foreach($right_menu['child'] as $right_menu_child){
		?>
        <li class="">
        <a id="" href="<?php echo base_url()."admin/".$right_menu_child['page_link']; ?>"><?php echo $right_menu_child['menu_name']; ?></a>
        </li>
        <?php } ?>
      </ul> 
    </li>
    <?php } ?>
	<?php if($this->session->userdata('is_super_admin'))
    {
    ?>
        <li class=""><a href="<?php echo base_url()."admin/back_to_super"; ?>"><span>Back to Super Admin Dashboard</span></a></li>
    <?php
    } ?>
</ul>

<ul class="mainNav"> 
    <?php
	foreach($menu_left as $left_menu){
	?>
    <li> <a href="<?php echo base_url(); ?>admin/<?php echo $left_menu['parent']['page_link']; ?>"><?php echo $left_menu['parent']['menu_name']; ?></a>
    <ul>
    	<?php
            foreach($left_menu['child'] as $left_menu_child){
	?>
		  <li class=""><a id="" href="<?php echo base_url()."admin/".$left_menu_child['page_link']; ?>"><?php echo $left_menu_child['menu_name']; ?></a></li>
        <?php } ?>
	</ul>

    </li>
    <?php } ?>
<div class="spacer"></div>
</ul>
</div>
</div>