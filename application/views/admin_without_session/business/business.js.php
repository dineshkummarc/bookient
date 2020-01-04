<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var geocoder;
  var map;
  function initialize() {
			geocoder = new google.maps.Geocoder();
			//var latlng = new google.maps.LatLng(-34.397, 150.644);
			//var latlng = new google.maps.LatLng(12.9833, 77.5833);
			var latlng = new google.maps.LatLng(<?php echo $long; ?>, <?php echo $lat; ?> );
			var myOptions = {
			  zoom: 12,
			  center: latlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			var address = "<?php echo $business_location; ?>, <?php echo $city_name; ?>, <?php echo $region_name; ?> <?php echo $business_zip_code; ?>, <?php echo $country_name; ?>";
			/*var address = "62/9 garfa main rood, kolkata, West Bengal 700075, India";*/


			geocoder.geocode( { 'address': address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
                                        draggable:false,
					position: results[0].geometry.location
				});

				google.maps.event.addListener(marker, 'click', function() {
				  infowindow.setContent("<h3><?php echo $business_name; ?></h3><?php echo $business_location; ?>,<br /><?php echo $city_name; ?> <?php echo $business_zip_code; ?><br /> <?php echo $region_name; ?>,  <?php echo $country_name; ?>");
				  infowindow.open(map, this);
				});

				infowindow = new google.maps.InfoWindow();
			  } else {
				//alert("Geocode was not successful for the following reason: " + status);
			  }

			});

	  }

  window.onload = initialize;
</script>

<script>
function st(id){

		//CB#SOG#09-11-2012#PR#S
			$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/business/ajax_region_check'); ?>",
				  data:"id="+id,
				  success:function(rdata)
					{ //alert(rdata);


					   $("#city").html(rdata);

					}
			});
		//CB#SOG#09-11-2012#PR#E
	}
</script>

<script>
function countChar_des(val){
					var len = val.value.length;
					if (len >= 1000) {
						val.value = val.value.substring(0, 1000);
					}else {
						$('#charNum_des').text(1000 - len+" characters remaining");
					}
};

function countChar_tag(val){
						var len = val.value.length;
						if (len >= 100) {
							val.value = val.value.substring(0, 100);
						}else {
							$('#charNum').text(100 - len+" characters remaining");
						}
};
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
			//alert($(this).attr('id'));
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}

			if($(this).hasClass('business_zip_code') == true){

			    var num1=($.isNumeric(inputVal));
				if($.trim(inputVal) != ''){
				if(num1==false){
				$parentTag.addClass('error').append($error.clone().text(' Enter Numeric Value'));
				}
				}
			}
		});
		$('.social-link',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)"); 					if(inputVal != ''){
				if(urlregex.test(inputVal) ==false){
					$parentTag.addClass('error').append($error.clone().text(' Enter a valid url'));
				}
			}		
		});

		// All validation complete - Check if any errors exist
		// If has errors
		if ($('span.error').length > 0) {

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

function Remove_Pic()
{
             $.ajax({
		   type: 'POST',
		   url: '<?php echo base_url(); ?>admin/business/Remove_pic',
		   //data: params,
		   success: function(data){
                                if(data == 1)
                                {
                                    var staffImgSrc  = "<?php echo base_url(); ?>uploads/businesslogo/noimage.jpg";
                                    $("#staffImg").attr("src",staffImgSrc);
			            $('#staffImg').show();
                                    $('#rem_photo').hide();
                                }
		   }
		});

}

</script>


