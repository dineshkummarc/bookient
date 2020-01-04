<script language="javascript" type="text/javascript">
    $(function() {
        $("#rating_simple1").webwidget_rating_sex({
            rating_star_length: '5',
            rating_initial_value: '',
            rating_function_name: '',//this is function name for click
            directory: '<?php echo base_url(); ?>images'
        });

    });
</script>
<script>
    function insertFeedback() {	
	    var $inputs = $('#review-form input, #review-form textarea, #review-form select');
	    var values = {};
	    $inputs.each(function(i, el) {
	    values[el.name] = $(el).val();
	    });
		var valuesJSON =JSON.stringify(values, null, 2);
		//alert(valuesJSON)	
		//alert('hii');
		 
		$.ajax({
			  type: 'POST',
			  data: {'rating_data':valuesJSON },
			  url:"<?php echo site_url('CustomerRate/ratingSave'); ?>",
			  success:function(datas){
				  if(datas ==1){
				  	alert('Thanks for your opinion!');
                                        //window.location.href = '<?php echo base_url(); ?>';
				  	$("#rating_form").html('<font color="#36D62C">Thanks for your opinion!</font>');	
				  }
				  else{
				  	alert('You have already post your rating for this service.');
                                        $("#rating_form").html('<font color="#FF0000">You have already post your rating for this service.</font>');	
				  }			  	  	
			}
		});	
		
		
     
    }
</script>