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
						  datatype:'html',
						  url:"<?php echo site_url('admin/business/ajax_region_check'); ?>",
						  data:"id="+id,
						  success:function(rdata){ 
							   $("#city").html(rdata);
							}
					});
				}
			//check login end
			}  
		});
	}
</script>

<script>
function countChar_des(val){
					var len = val.value.length;
					if (len >= 1000) {
						val.value = val.value.substring(0, 1000);
					}else {
						$('#charNum_des').text(1000 - len+" <?php echo $this->lang->line('char_remaining')?>");
					}
};

function countChar_tag(val){
						var len = val.value.length;
						if (len >= 100) {
							val.value = val.value.substring(0, 100);
						}else {
							$('#charNum').text(100 - len+" <?php echo $this->lang->line('char_remaining')?>");
						}
};
</script>

<script type="text/JavaScript">
$(document).ready(function() {

   		$('#btn-submit1').click(function(e){
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error"></span>');

		$($formId).removeClass('error');
		$('span.error').remove();

		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			
			var $parentTag = $(this).parent();
			//alert($(this).attr('id'));
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text("<?php echo $this->lang->line('required_fld')?>"));
			}

			if($(this).hasClass('business_zip_code') == true){

			    var num1=($.isNumeric(inputVal));
				if($.trim(inputVal) != ''){
				if(num1==false){
				$parentTag.addClass('error').append($error.clone().text(" <?php echo $this->lang->line('entr_numeric_val')?>"));
				}
				}
			}
		});
		
		$('.social-link',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)"); 					if(inputVal != ''){
				if(urlregex.test(inputVal) ==false){
					$parentTag.addClass('error').append($error.clone().text(" <?php echo $this->lang->line('entr_valid_url')?>"));
				}
			}		
		});

		if ($('span.error').length > 0) {
			$('span.error').each(function(){
			});
		} else {
			$formId.submit();
		}
			e.preventDefault();
	});

	$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
});
</script>
<script type="text/javascript">
function Remove_Pic(){         
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
				   url: '<?php echo base_url(); ?>admin/business/Remove_pic',
				   success: function(data){
		                    if(data == 1){
		                        var staffImgSrc  = "<?php echo base_url(); ?>uploads/businesslogo/noimage.jpg";
		                        $("#staffImg").attr("src",staffImgSrc);
		           				$('#staffImg').show();
		                        $('#rem_photo').hide();
		                    }
				   }
				});
			}
		//check login end
		}  
	});

}

function selectstates(stId){
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
						  datatype:'html',
						  url:"<?php echo site_url('admin/business/ajax_country_check'); ?>",
						  data:"id="+stId,
						  success:function(rdata){ 
							   $("#region").html(rdata);
							}
					});
				}
			//check login end
			}  
		});
}

</script>


