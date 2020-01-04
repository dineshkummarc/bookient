<script type="text/javascript">
$(document).ready(function(){
	
	<?php if($DesignOffer !=''){ ?>
		$('#bgColor').val("<?php echo $DesignOffer[0]['background_color']; ?>");
		$('#borColor').val("<?php echo $DesignOffer[0]['border_color']; ?>");
		$('#titleColor').val("<?php echo $DesignOffer[0]['title_color']; ?>");
		$('#descColor').val("<?php echo $DesignOffer[0]['description_color']; ?>");
		
		$('#ImageRepeat').val("<?php echo $DesignOffer[0]['repeat']; ?>");	
		$('#ImagePosition').val("<?php echo $DesignOffer[0]['position']; ?>");
		
		$('#NewPromotionTitle').val("<?php echo $DesignOffer[0]['title']; ?>");
		$('#NewPromotionDescription').val("<?php echo $DesignOffer[0]['description']; ?>");	
		$('.SocialHead').html("<?php echo $DesignOffer[0]['title']; ?>");
		$('.SocialDes').html("<?php echo $DesignOffer[0]['description']; ?>");	
		$('.socialBlockOuter').css('backgroundColor', "<?php echo $DesignOffer[0]['background_color']; ?>");
		$('.socialBlockOuter').css('border-color', "<?php echo $DesignOffer[0]['border_color']; ?>");
		$('.SocialHead').css('color', "<?php echo $DesignOffer[0]['title_color']; ?>");
		$('.SocialDes').css('color',"<?php echo $DesignOffer[0]['description_color']; ?>");
		
		var NewPromotionImage="<?php echo $DesignOffer[0]['image_path']; ?>";
		var ImagePosition="<?php echo $DesignOffer[0]['position']; ?>";
		var ImageRepeat="<?php echo $DesignOffer[0]['repeat']; ?>";
		$('.socialInner').css('background-image', 'url('+NewPromotionImage+')');
		$('.socialInner').css('background-position', ImagePosition);
		$('.socialInner').css('background-repeat', ImageRepeat);
	<?php } ?>				
	
	<?php if($SocialMsg !=''){ ?>
		$('#faceboxMessage').val("<?php echo $SocialMsg[0]['facebook_msg_body']; ?>");
		$('#twitterMessage').val("<?php echo $SocialMsg[0]['twitter_msg_body']; ?>");
		$('#faceboxMessageSpnId').html("<?php echo $SocialMsg[0]['facebook_msg_body']; ?>");
		$('#twitterboxMessageSpnId').html("<?php echo $SocialMsg[0]['twitter_msg_body']; ?>");
	<?php } ?>
	
	value="<?php echo ($SocialMsg !='')?$SocialMsg[0]['facebook_msg_body']:''; ?>";
	var len = value.length;
	if (len >= 410) {
		$('#Limit0').text("0 characters remaining");
	}else {
		$('#Limit0').text(410 - len+" characters remaining");
	}
	
	value="<?php echo ($SocialMsg !='')?$SocialMsg[0]['twitter_msg_body']:''; ?>";
	var len = value.length;
	if (len >= 120) {
		$('#Limit1').text("0 characters remaining");
	}else {
		$('#Limit1').text(120 - len+" characters remaining");
	}
		
});
</script>   
<script type="text/javascript"> 
function showSocialTemplate(tmpId){
	$(".socialBlockOuter").hide();
	$("#socialBlockOuter"+tmpId).show();	
}
</script> 
<script type="text/javascript"> 
function showTitle(value){
	$(".SocialHead").html(value);
	//$("#title").value(value);		
}
function showDescription(value){
	$(".SocialDes").html(value);
	//$("#description").value(value);		
}
</script> 
<script type="text/javascript"> 
function adSetting(){
	$("#advanceSettingTb").toggle();
}
</script>
<script type="text/javascript"> 
function showImg(){
	var NewPromotionImage=$("#NewPromotionImage").val();
	var ImageRepeat=$("#ImageRepeat").val();
	var ImagePosition =$("#ImagePosition").val();
	$('.socialInner').css('background-image', 'url('+NewPromotionImage+')');
	$('.socialInner').css('background-position', ImagePosition);
	$('.socialInner').css('background-repeat', ImageRepeat);
}
</script> 
<script type="text/javascript"> 
$(document).ready(function(){
$('#bgColor').ColorPicker({
                               color: "<?php echo ($DesignOffer !='')?$DesignOffer[0]['background_color']:'#ffffff' ?>",
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
							   $('.socialBlockOuter').css('backgroundColor', '#' + hex);							  	
							   		$('#bgColor').val('#' + hex);		
                               }
							   
                        });
});
						
</script>
<script type="text/javascript"> 
$(document).ready(function(){

$('#borColor').ColorPicker({
                               color: "<?php echo ($DesignOffer !='')?$DesignOffer[0]['border_color']:'#cccccc' ?>",
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
							   $('.socialBlockOuter').css('border-color', '#' + hex);
							   $('#borColor').val('#' + hex);							  								  
                               }
							   
                        });
});
						
</script> 
<script type="text/javascript"> 
$(document).ready(function(){

$('#titleColor').ColorPicker({
                               color: "<?php echo ($DesignOffer !='')?$DesignOffer[0]['title_color']:'#241924' ?>",
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
							   $('.SocialHead').css('color', '#' + hex);
							   $('#titleColor').val('#' + hex);							  								  
                               }
							   
                        });
});
						
</script> 
<script type="text/javascript"> 
$(document).ready(function(){

$('#descColor').ColorPicker({
                               color: "<?php echo ($DesignOffer !='')?$DesignOffer[0]['description_color']:'#241924' ?>",
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
							   $('.SocialDes').css('color', '#' + hex);
							   $('#descColor').val('#' + hex);							  								  
                               }
							   
                        });
});
						
</script> 
<script type="text/javascript"> 
function checkTextAreaMaxLimitfacebook(value){
	$("#faceboxMessageSpnId").html(value);
	//$("#title").value(value);		
	var len = value.length;
	if (len >= 410) {
		$('#Limit0').text("0 characters remaining");
	}else {
		$('#Limit0').text(410 - len+" characters remaining");
	}
}
function checkTextAreaMaxLimittwitter(value){
	$("#twitterboxMessageSpnId").html(value);
	var len = value.length;
	if (len >= 120) {
		$('#Limit1').text("0 characters remaining");
	}else {
		$('#Limit1').text(120 - len+" characters remaining");
	}
}
</script> 

         
