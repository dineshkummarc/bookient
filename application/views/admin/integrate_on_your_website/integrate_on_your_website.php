<?php include('integrate_on_your_website.js.php'); ?>
<!--
<div>
   <a  class="openmodalbox" href="javascript:void(0);">
        <span class="modalboxContent" id="modal_show">
            <h3><?php echo $this->lang->line('m_box_head'); ?></h3>
            <hr />
            <span><?php echo $this->lang->line('m_box_cont'); ?></span>
            <div>
            	<textarea name="iframe_area" id="iframe_area" cols="30" rows="10">
                <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>" width="760px" height="555px" scrolling="auto" frameborder="0" allowtransparency="true"></iframe>
                </textarea>
            </div>
        </span>
    </a>
</div>-->
<div class="tabs" style="display:none">
  <ul style="background-color:white">
    <li><a href="#tabs-1">Widget</a></li>
    <li><a href="#tabs-2">Overlay</a></li>
    <li><a href="#tabs-3">Button</a></li>
  </ul>
  <div id="tabs-1">
   			<!--<h3><?php //echo $this->lang->line('m_box_head'); ?></h3>-->
           <img src="<?php echo base_url(); ?>images/appWidget.png" >
            <span><?php echo $this->lang->line('m_box_cont'); ?></span>
            <div>
            	<textarea name="iframe_area" id="iframe_area" cols="65" >
                <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>" width="760px" height="555px" scrolling="auto" frameborder="0" allowtransparency="true"></iframe>
                </textarea>
            </div>
  </div>
   <?php $exp=explode('.',$_SERVER['HTTP_HOST']); ?>
  <div id="tabs-2">
 
  <textarea name="iframe_overlay" id="iframe_overlay" cols="65" rows="20">
  <?php
 echo  $script="<script type='text/javascript'>
	var pardco = '".$exp[0]."'; // dynamic
	var pardcoHeight = '700';
	var pardcoWidth = '900';
	var ShowSchedulemeImg = true;
	var pardcoDomain ='".$exp[1].".".$exp[2]."'; // dynamic
	//if showSchedulemeImg is set to false then it will override the properties below. This can be used if you want to call overlay from your own custom link.
	var ScheduleMeBgImg = 'http://".$exp[1].".".$exp[2]."/widget/images/scheduleme.png'; 
	var ScheduleMeBg = 'transparent';
	var ScheduleMeWidth = '47';
	var ScheduleMeHeight = '150';
	var ScheduleMePosition = 'right';  // right, left
	// You can also call function ShowPardcoInOverlay() onclick of any tag. 
	// e.g. <a href='javascript:void(0)' onclick='ShowPardcoInOverlay();'>Schedule with us</a>
  </script>
<script type='text/javascript' src='http://".$exp[1].".".$exp[2]."/widget/js/pardcoOverlayGadget.js'></script>";
?>
</textarea>
  
  
  </div>
  <div id="tabs-3">
  	<img src="<?php echo base_url(); ?>widget/images/schedulepardco.png" >
   <textarea cols="65" rows="5" >  
  <?php
    echo  $link='<a href="http://'.$exp[0].'.'.$exp[1].'.'.$exp[2].'/" target="_blank"><img src="http://'.$exp[1].'.'.$exp[2].'/widget/images/schedulepardco.png" alt="" border="0" /></a>';
   ?>
   </textarea>
  </div>
</div>
<div class="rounded_corner">
    <div id="mainDiv" >
        <div id="tabContent">
            <h1 class="headign-main"><span id="innerBussinessHeading"><?php echo $this->lang->line('innerBussinessHeading'); ?></span></h1>
            <h3> <?php echo $this->lang->line('heading'); ?></h3>
            <div class="inner-div">
            <br />
            <h2><?php echo $this->lang->line('item_1'); ?></h2>
            <br />
             <div class="inner-div">
                <h3> <?php echo $this->lang->line('content_1'); ?></h3>     
                <br />
                <input type="button" name="on_website" id="on_website" value="<?php echo $this->lang->line('button_on_website'); ?>" class="btn-blue" onClick="OpenBox1();" />
                <br />
                <br />
                <h3><?php echo $this->lang->line('content_2'); ?></h3>
                <br />
                <a href="<?php echo base_url()."admin/link_to_facebook"; ?>">
                <input type="button" name="on_facebook" id="on_facebook" value="<?php echo $this->lang->line('button_on_facebook'); ?>" class="btn-blue" />
                </a>
             </div>
            </div>
            
            <div class="inner-div">
            <br />
            <h2><?php echo $this->lang->line('item_2'); ?></h2>
            <br />
             <div class="inner-div">
                <h3><?php echo $this->lang->line('content_3'); ?> </h3>     
                <br />

                <script>
                
                function fbs_click() {u=location.hostname;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>

                <input type="button" name="share_facebook" id="share_facebook" value="<?php echo $this->lang->line('button_share_facebook'); ?>" class="btn-blue" onclick="fbs_click()" />
                &nbsp;&nbsp;
                
                
                 
                <script>
                function twitter()
                {//alert("KKK");
                    window.open('https://twitter.com/share?url=https%3A%2F%2F<?php echo $exp[0]; ?>.<?php echo $exp[1];  ?>.<?php echo $exp[2];  ?>','','toolbar=0,status=0,width=626,height=436');
                    return false;
                }
                </script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                <input type="button" name="share_twitter" id="share_twitter" onclick="twitter()" value="<?php echo $this->lang->line('button_share_twitter'); ?>" class="btn-blue" />
             </div>
            </div>
            
            <div class="inner-div">
            <br />
            <h2><?php echo $this->lang->line('invite_contact_gmail'); ?> </h2>
            <br />
             <div class="inner-div">
                <h3><?php echo $this->lang->line('let_know'); ?> </h3>     
                <br />
                <input type="button" name="on_website" id="on_website" value="<?php echo $this->lang->line('import_nd_invite_cntacts'); ?>" class="btn-blue" onClick="importGmailContact();" />
                <br />
             </div>
            </div>
        </div>
    </div>
</div>
<div class="formbox_bottom"></div>

<div class="account-overview" style="width:100%; margin-left:0;">
<div id="service_list">    
</div>
</div>
    
