<script type="text/javascript">
$(document).ready(function(){
    $('.mainNav > li').first().children().addClass("select");
});
</script>

<script type="text/JavaScript">
function change_status(id){
    $.ajax({
        url: SITE_URL+"page/fn_checkLogInSuperAdmin",
        type: 'POST',
        success: function(result){
            if(result == 0){
                window.location.href = SITE_URL+'superadmin/login';
            }else{
	            $.ajax({
	                type: 'POST',
	                datatype:'html',
	                url: "<?php echo base_url(); ?>superadmin/dashboard/change_status_ajax",
	                data: { 'user_id': id },
	                success:function(rdata){
	                    if(rdata==0){
		                    alert('An Error Occured!Please try again later.');
	                    }else{
		                    var data_arr = rdata.split('(@$@)');
		                    $("#replace_img_"+id).html('<img src="<?php echo base_url(); ?>myjs/images/'+data_arr[0]+'" title="'+data_arr[1]+'" />');
	                    }
	                }
	            });
            }
        }
    });
}
</script>

<script type="text/JavaScript">
function delete_admin(id,name){
	var r=confirm("Delete Local Admin :: "+name+" ?");
	if (r==true){
		$.ajax({
		    type: 'POST',
		    datatype:'html',
		    url: "<?php echo base_url(); ?>superadmin/dashboard/delete_local_admin_ajax",
		    data: { 'user_id': id },
		    success:function(rdata){
		        alert(rdata);
		        /*if(rdata==0){
			        alert('An Error Occured!Please try again later.');
		        }else{
			        var data_arr = rdata.split('(@$@)');
			        $("#replace_img_"+id).html('<img src="<?php //echo base_url(); ?>images/'+data_arr[0]+'" title="'+data_arr[1]+'" />');
		        }*/
		    }
		});
	}
}
</script>

<script type="text/JavaScript">
function update_password(){
	if($.trim($('#new_pass').val()) == ''){
		$('#show_error').html('Required Field');
	}else{
		var r=confirm("Are you sure you want to change the password?");
		if (r==true){
			var user_id = $.trim($('#user_id').val());
			var new_pass =$.trim($('#new_pass').val());
            $.ajax({
                url: SITE_URL+"page/fn_checkLogInSuperAdmin",
                type: 'POST',
                success: function(result){
                    if(result == 0){
                        window.location.href = SITE_URL+'superadmin/login';
                    }else{
                        $.ajax({
			                type: 'POST',
			                datatype:'html',
			                url: "<?php echo base_url(); ?>superadmin/dashboard/update_password_ajax",
			                data: { 'user_id': user_id, 'new_pass': new_pass, 'mail': '0'},
			                success:function(rdata){
			                    if(rdata == 1){
				                    $('#update_password').hide();
			                    }
			                }
		                });
                    }
                }
            });
		}
	}
}
</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/JavaScript">
function update_password_and_mail(){
	if($.trim($('#new_pass').val()) == ''){
		$('#show_error').html('Required Field');
	}else{
		var r=confirm("Are you sure you want to change the password?");
		if (r==true){
			var user_id = $.trim($('#user_id').val());
			var new_pass = $.trim($('#new_pass').val());
            $.ajax({
                url: SITE_URL+"page/fn_checkLogInSuperAdmin",
                type: 'POST',
                result: function(result){
                    alert(result);
                    if(result == 0){
                        window.location.href = SITE_URL+'superadmin/login';
                    }else{
                        $.ajax({
			                type: 'POST',
			                datatype:'html',
			                url: "<?php echo base_url(); ?>superadmin/dashboard/update_password_ajax",
			                data: { 'user_id': user_id, 'new_pass': new_pass, 'mail': '1' },
			                success:function(rdata){
			                    if(rdata == 1){
				                    $('#update_password').hide();
			                    }
			                }
			            });
                    }
                }
            });
		}
	}
}
</script>

<script type="text/JavaScript">
function show_update_password_block(id){
	$('#new_pass').val('');
	$('#show_error').html('');
	$('#update_password').show();
	$('#user_id').val(id);
}
</script>

<script type="text/JavaScript">
function hide_update_password_block(){
	$('#update_password').hide();
}
</script>

<script type="text/JavaScript">
function focusit(){
	$('#show_error').html('');
}
</script>

<script type="text/JavaScript">
function update_details(id){
	$.ajax({
	    type: 'POST',
	    datatype:'json',
	    url: "<?php echo base_url(); ?>superadmin/dashboard/update_details_ajax",
	    data: { 'user_id': id },
	    success:function(rdata){
			var data = jQuery.parseJSON( rdata );
			if(data.business_logo != "")
				$('#business_logo').html('<img id="staffImg" src="<?php echo base_url(); ?>uploads/businesslogo/'+data.business_logo+'" height="80" />');
			else
				$('#business_logo').html('<img id="staffImg" src="<?php echo base_url(); ?>uploads/businesslogo/noimage.jpg" height="80" />');
			$('#business_name').val(data.business_name);
			$('#business_description').val(data.business_description);
			$('#page_title').val(data.page_title);
			$('#business_tag').val(data.business_tag);
			$('#business_location').val(data.business_location);
			//$('#business_state_id').val(data.business_state_id);
			//$('#city_name').val(data.city_name);
			//$('#region_name').val(data.region_name);
			//$('#country_name').val(data.country_name);
			$('#business_zip_code').val(data.business_zip_code);
			$('#business_phone').val(data.business_phone);
			$('#region').html(data.region);
			$('#city').html(data.city);
			$('#facebook_link').val(data.facebook_link);
			$('#youtube_link').val(data.youtube_link);
			$('#google_link').val(data.google_link);
			$('#twitter_link').val(data.twitter_link);
			$('#linkedin_link').val(data.linkedin_link);
            var geocoder;
            var map;
            //function initialize() {
			    geocoder = new google.maps.Geocoder();
			    var latlng = new google.maps.LatLng(-34.397, 150.644);
			    var myOptions = {
			        zoom: 12,
			        center: latlng,
			        mapTypeId: google.maps.MapTypeId.ROADMAP
			    }
			    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			    //var address = "<?php //echo $business_location; ?>, <?php //echo $city_name; ?>, <?php //echo $region_name; ?> <?php //echo $business_zip_code; ?>, <?php //echo $country_name; ?>";
		        var address = data.business_location+","+data.business_location+","+data.region_name+" "+data.business_zip_code+","+data.country_name;
			    geocoder.geocode({ 'address': address}, function(results, status){
			        if (status == google.maps.GeocoderStatus.OK) {
				        map.setCenter(results[0].geometry.location);
				        var marker = new google.maps.Marker({
					        map: map,
					        position: results[0].geometry.location
				        });
				        google.maps.event.addListener(marker, 'click', function() {
				            //infowindow.setContent("<h3><?php //echo $business_name; ?></h3><?php //echo $business_location; ?>,<br /><?php //echo $city_name; ?> <?php //echo $business_zip_code; ?><br /> <?php //echo $region_name; ?>,  <?php //echo $country_name; ?>");
				            infowindow.setContent("<h3>"+data.business_name+"</h3>"+data.business_location+",<br />"+data.city_name+" "+data.business_zip_code+"<br />"+ data.region_name+","+ data.country_name);
				            infowindow.open(map, this);
				        });
                        infowindow = new google.maps.InfoWindow();
			        }else{
				        alert("Geocode was not successful for the following reason: " + status);
			        }
			    });
	        //}
            // window.onload = initialize;
		}
	});
	$('#update_details').show();
}
</script>

<script type="text/JavaScript">
$(document).ready(function() {
   $('#btn-submit1').click(function(e){
	    // Declare the function variables:
		// Parent form, form URL, email regex and the error HTML
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$($formId).removeClass('error');
		$('span.error').remove();

		// Validate all inputs with the class "required"
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if(inputVal == ''){
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}
		    if($(this).hasClass('business_zip_code') == true){
			    var num1=($.isNumeric(inputVal));
			    if(inputVal != ''){
				    if(num1==false){
				        $parentTag.addClass('error').append($error.clone().text(' Enter Numeric Value'));
				    }
			    }
		    }
		});
		// All validation complete - Check if any errors exist
		// If has errors
		if ($('span.error').length > 0){
			$('span.error').each(function(){
				// Set the distance for the error animation
				/*var distance = 10;

				// Get the error dimensions
				var width = $(this).outerWidth();

				// Calculate starting position
				var start = width + distance;

				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'

				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');*/
			});
		} else {
			$formId.submit();
		}
		// Prevent form submission
		e.preventDefault();
	});

	// Fade out error message when input field gains focus
	$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
});
</script>

<script type="text/javascript">
function update_staff(id)
{
	$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url: "<?php echo base_url(); ?>superadmin/dashboard/update_staff_ajax",
			  data: { 'user_id': id },
			  success:function(rdata)
			  {
			  	$('#staff_tbl').html(rdata);
			  }
			});
}
</script>

<script type="text/javascript">
function change_status_staff(id)
{
	$.ajax({
	  type: 'POST',
	  datatype:'html',
	  url: "<?php echo base_url(); ?>superadmin/dashboard/change_status_staff_ajax",
	  data: { 'employee_id': id },
	  success:function(rdata)
	  {
		if(rdata==0)
		{
			alert('An Error Occured!Please try again later.');
		}
		else
		{
			var data_arr = rdata.split('(@$@)');

			$("#staff_status_"+id).html('<img src="<?php echo base_url(); ?>images/'+data_arr[0]+'" title="'+data_arr[1]+'" />');
		}
	  }
	});
}
</script>

<script type="text/javascript">
function update_service(id)
{
	$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url: "<?php echo base_url(); ?>superadmin/dashboard/update_service_ajax",
			  data: { 'user_id': id },
			  success:function(rdata)
			  {
			  	$('#service_tbl').html(rdata);
			  }
	});
}
</script>

<script type="text/javascript">
function change_status_service(id)
{
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url: "<?php echo base_url(); ?>superadmin/dashboard/change_status_service_ajax",
		  data: { 'user_id': id },
		  success:function(rdata)
		  {
			if(rdata==0)
			{
				alert('An Error Occured!Please try again later.');
			}
			else
			{
				var data_arr = rdata.split('(@$@)');


				$("#staff_status_"+id).html('<img src="<?php echo base_url(); ?>myjs/images/'+data_arr[0]+'" title="'+data_arr[1]+'" />');
			}
		  }
	});
}
</script>

<script type="text/javascript">
function manage_local_admin(id)
{
	$.ajax({
	    type: 'POST',
	    datatype:'html',
	    url: "<?php echo base_url(); ?>superadmin/dashboard/manage_local_admin_ajax",
	    data: { 'local_admin_id': id },
	    success:function(rdata)
	    {
	        var element = [];
	        element = rdata.split("FghJU435GFGsjdn790");
	        if(rdata == '')
	        {
		        alert('Sorry!!!');
	        }
	        else
	        {
                var path = window.location.host;
                var count = path.split(".").length - 1;
                if (count== 1)
                {
                    var url =  window.location.protocol + "//"+element[0]+"."+window.location.host + "/admin/manage_local_admin/check_user_access/"+rdata;
                    window.location.href =  url;
                }
                else
                {
                    var url =  window.location.protocol + "//"+window.location.host + "/admin/manage_local_admin/check_user_access/"+rdata;
                    window.location.href =  url;
                }
	        }
	    }
	});
}
</script>