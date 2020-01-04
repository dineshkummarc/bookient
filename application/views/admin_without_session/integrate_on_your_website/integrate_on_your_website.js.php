<script type="text/javascript">
function OpenBox1()
{
	//$('.openmodalbox').trigger('click');
	/* if ($("#tabs").length == 0 ) {
	    var tabcontent = $('.tabs').html();
		alert(tabcontent);
		$('<div id="tabs">'+tabcontent+'</div>').appendTo('body');
		$( "#tabs" ).tabs();
  } */
     var tabcontent = $('.tabs').html();
     pr_popup(550);
	 $('#front_popup_content').html('<div id="tabs">'+tabcontent+'</div>');
	 $( "#tabs" ).tabs();
	 
	 
  /*
$( "#tabs" ).dialog({
    modal: true, 
    title: 'Accept appointments on your website', 
    autoOpen: true,
                width: 400
    });
	*/
}
 $(function() {
    $( "#tabs" ).tabs();
  });
  
function importGmailContact(){
    $.ajax({
        type: 'POST',
        //datatype:'html',
        url:"<?php echo site_url('admin/integrate_on_your_website/gmailConnect'); ?>",
        //data:"booking_id="+booking_id+"&booking_status="+booking_status,
        success:function(rdata)
        { 
            alert("test : "+rdata); 
        }
    });
}  
  
 
</script>