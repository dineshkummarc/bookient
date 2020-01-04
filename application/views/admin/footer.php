</div>
<div class="clear"></div>
</div>
</div>
  </div><!-- wrapper end -->
<style>
	.select-style {
    border: 1px solid #ccc;
    width: 160px;
    border-radius: 3px;
    overflow: hidden;
    background: #fafafa url("img/icon-select.png") no-repeat 90% 50%;
    margin-right: 20px;
}

.select-style select {
    padding: 5px 8px;
    width: 130%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
    outline: none;
}
</style>  
  
  
  
  
<div style="float: right; font-size:12px;">
  
 <b>Current language -
<?php $this->session->set_userdata('current_url', current_url());?>
<?php 
$sess_admin_language=$this->session->userdata('admin_language');
$admin_language=(isset($sess_admin_language))?$sess_admin_language:''; 
?>
<select class="select-style"  name="admin_language" id="admin_language" onchange="window.location.href='<?php echo base_url(); ?>admin/change_language/index/'+this.value">
	<?php foreach($languages as $language){ ?>
		<?php $languages_name=strtolower($language['languages_name']); ?>
		<option  <?php echo ($admin_language==$languages_name)?'selected=""':''; ?> value="<?php echo strtolower($language['languages_name']); ?>" ><?php echo $language['languages_name']; ?></option>			
	<?php } ?>
</select>
</div>
  </div>

</body>
</html>
