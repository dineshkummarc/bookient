<?php include('cancelaccount.js.php'); ?>
<div class="rounded_corner" style="width:98%; margin-left:1%">
<h1 class="headign-main"><?php echo $this->lang->line('headign-main'); ?></h1>
<div class="wrap">
	
		<?php /*?><form id="form" class="styled" action="" method="post">
	  	    <fieldset>
			  
			  <ol>
			   <li> Your account will be decativated if you press "OK".<br/><br/></li>
				
			 <br/><br/>
				<li>
				  <span><input type="image" src="" height="70" width="120" alt="OK" value="OK" style="margin-left:166px;font-weight:bold;" onclick="change_status();" /><span>
				</li>
                
			  </ol>
			</fieldset>
		</form><?php */?>
        
        <div class="styled">
         <fieldset>
        Your account will be decativated if you press "OK". <br/><br/><br/><br/>
        <input type="button" value="OK" class="btn-blue"  onclick="change_status();" style="margin-left:160px;font-weight:bold;" />
		</fieldset>
        
        </div>
</div>

</div>