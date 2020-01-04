<script type="text/javascript">
$(document).ready(function () {
   $("#sub_menu").hide();
   $("#menu").hover(function() {
            $("#sub_menu").show();
        }, function() {
            $("#sub_menu").hide();
        });
	$(".btn").click(function(){
		$('.nav-collpas').toggle();
	})
});


function change_lang(lang_val){
   //pr  window.lang.change('en');
     $.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("customer/customer/Change_lang_Ajax"); ?>',
		   data: { 'val' : lang_val},
		   success: function(data){
                      location.reload();
			}
	});
}
</script>
<?php include('language.php'); ?>
<?php
    $selected_lang = $Ret_Arr_val[0]['languages_name'];//echo "LANGUAGE : ".
    $selected_flag = $Ret_Arr_val[0]['image'];//echo "<br>IMAGE : ".
?>

<div>
<?php if ($show_header) { ?>
  <hgroup id="header">
    <h1 class="logoCon"><a class="block" title="Pardco" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo" /></a></h1>
    <div class="UserCon">
      <?php
		if($logged_in_customer == TRUE){
			echo $this->global_mod->db_parse($this->lang->line('Frontend'));
            if(isset($user_name)){
                print($user_name);
            }
			echo ' !';
		}
      ?>
    </div>
    <div class="clearfix"></div>
  </hgroup>
<?php } ?>
  <div class="clearfix"></div>
  <nav class="navbar" style="position:relative;">
   <button type="button" class="btn btn-navbar" data-toggle="collapse" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
   </button>
   <div class="nav-collpas">
    <ul class="menu" id="lang_log">   
      <?php
       if($this->session->userdata('selected_lang') != '') {
      ?>
      <li id="menu"><a href ="javascript:void(0);"><img src="<?php echo base_url(); ?>uploads/language/<?php echo $this->session->userdata('selected_lang_flag');  ?>"  height="12"/><?php echo $this->session->userdata('selected_lang'); ?></a>
      <?php } else { ?>
      <li id="menu"><a href ="javascript:void(0);"><img src="<?php echo base_url(); ?>uploads/language/<?php echo $selected_flag; ?>" height="12"/><?php echo $selected_lang; ?></a>
     <?php }  ?>
      <ul id="sub_menu">
           <?php
                 foreach($lang_list as $val) {
                     if($this->session->userdata('selected_lang') != '') {
                         if($this->session->userdata('selected_lang') != $val['languages_name'] && $this->session->userdata('selected_lang_flag') != $val['image'] ) {
                                echo '<li><img src="'.base_url().'uploads/language/'.$val['image'].'" alt="language" height="12"/>
                                <a href ="javascript:void(0);" onclick="change_lang('.$val['languages_id'].')" >'.$val['languages_name'].'</a>
                                </li>';
                         }
                     }
                     else {
                         if($selected_lang != $val['languages_name'] && $selected_flag != $val['image'] ) {
                                echo '<li><img src="'.base_url().'uploads/language/'.$val['image'].'" alt="language" height="12"/>
                                <a href ="javascript:void(0);" onclick="change_lang('.$val['languages_id'].')" >'.$val['languages_name'].'</a>
                                </li>';
                         }
                     }
                 }
                ?>
              
        </ul>
      </li>
      <li >
        <a href="javascript:void(0);" style="display:none"></a> </li>
      <?php
	if($logged_in_customer != '')
	{
	?>
      <li > <a href="javascript:void(0);" onclick="OpenBoxAppointmentsInfo()"><?php echo $this->global_mod->db_parse($this->lang->line('myappo')); ?></a> </li>
      <li>
        <?php $val =isset($this->session->userdata['user_id_customer'])?$this->session->userdata['user_id_customer']:""; ?>
        <a href="javascript:void(0);" onclick="OpenBoxmodifyInfo()" ><?php echo $this->global_mod->db_parse($this->lang->line('modifymyinfo')); ?></a> </li>
      <li > <a href="<?php echo base_url(); ?>logout"><?php echo $this->global_mod->db_parse($this->lang->line('logout')); ?></a> </li>
      <?php
	} else { ?>
      <li id="u_log"> <a id="" href="javascript:void(0)" onclick="OpenBoxLogin();"><?php echo $this->global_mod->db_parse($this->lang->line('login')); ?></a>
      <li>
      <li> <a id="" href="javascript:void(0)" onclick="newRegistration();"><?php echo $this->global_mod->db_parse($this->lang->line('newuser')); ?></a>
      
      </li>
      <?php
	}
	?>
      <li>
              
    </ul>
  <div class="clearfix"></div>
    <div id="cus_menu">

    </div>

    </div>
 <div class="clearfix"></div>
  </nav>
  <div class="clearfix"></div>
</div>
<!-- Main header area -->
