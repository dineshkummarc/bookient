<script type="text/javascript">
function OpenBox1()
{

     var tabcontent = $('.tabs').html();
     pr_popup(550);
	 $('#front_popup_content').html('<div id="tabs">'+tabcontent+'</div>');
	 $( "#tabs" ).tabs();

}
 $(function() {
    $( "#tabs" ).tabs();
  });
  
function importGmailContact(){
    
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
		$.ajax({
	        type: 'POST',
	        url:"<?php echo site_url('admin/integrate_on_your_website/gmailConnect'); ?>",
	        success:function(rdata)
	        { 
	            alert("test : "+rdata); 
	        }
	    });
		}
	//check login end
	}  
});
}  
  
 
</script>