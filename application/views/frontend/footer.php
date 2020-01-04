</div>
<div class="footer">
  <footer class="row">
    <div class="twelve columns">
    	<ul>
        	<li><a href="<?php echo base_url();?>"><?php echo $this->global_mod->db_parse($this->lang->line('home')); ?></a></li>
            <li>|</li>
            <li><a href="<?php echo base_url().'info/privacypolicy';?>"><?php echo $this->global_mod->db_parse($this->lang->line('privacy')); ?></a></li>
            <li>|</li>
            <li><a href="<?php echo base_url().'info/securityinfo';?>"><?php echo $this->global_mod->db_parse($this->lang->line('security')); ?></a></li>
            <li>|</li>
            <li><a href="<?php echo base_url().'info/companyinfo';?>"><?php echo $this->global_mod->db_parse($this->lang->line('cinfo')); ?></a></li>
        </ul>
        <p>&copy; Copyright <a href="http://www.pard.co/" target="_blank">pard.co</a> <?php echo date('Y')?>.<?php echo $this->global_mod->db_parse($this->lang->line('copyr')); ?></p>
   
        <div class="social-icons">
        <?php if($facebook_link != ''){?>
          	<a href="<?php echo 'http://'.$facebook_link; ?>" class="facebook-icon" target="_blank"></a>
        <?php }
        if($youtube_link != ''){
         ?>  
         	 <a href="<?php echo 'http://'.$youtube_link; ?>" class="youtube-icon" target="_blank"></a>
        <?php }
        if($google_link != ''){
        ?>	 
          <a href="<?php echo 'http://'.$google_link; ?>"  class="google-icon" target="_blank"></a>
        <?php }
        if($twitter_link != ''){
        ?>  
          <a href="<?php echo 'http://'.$twitter_link; ?>"  class="twitter-icon" target="_blank"></a>
       <?php }
        if($linkedin_link != ''){
       ?>   
          <a href="<?php echo 'http://'.$linkedin_link; ?>"  class="linkedin-icon" target="_blank"></a>
       <?php }?>   
        </div>
  
    </div>
  </footer>
</div>
</div>
</body>
</html>
