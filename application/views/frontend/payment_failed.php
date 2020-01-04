<div style="width:510px; margin-left:auto;margin-right:auto; margin-top:100px;">

<p> payment failed!</p>

<?php	
		$str	 = '';
		$str	.= '<div class="socialBlockOuter" id="socialBlockOuter" style="width: 500px;border: 4px solid #ccc;">';
		$str	.= $template[0]['template_body'];
		$str	.= '</div>';
		$str	.= '<div  style="background:#CCCCFF; border-radius:5px; -webkit-border-radius:5px;  -moz-border-radius:5px; padding:10px 20px; margin-top:20px;">';
		$str	.= '<lable style="font-size:15px;">Cancellation Policy</lable></br>';
		$str	.= '<lable style="font-size:10px; text-align:justify;">We understand that special circumstances are unavoidable and a cancellation may be necessary. Please call us at +1234567890 during regular business hours to cancel or reschedule your appointments. Remember, any cancellation and/or rescheduling can be done 24hrs. prior to your appointment.</lable>';
		$str	.= '</div>';
		$str	.= '<script type="text/javascript">';
		$str	.= '$(document).ready(function(){';
		$str	.= 'var fb_link ="http://facebook.com";';
		$str	.= 'var tw_link="http://twitter.com";';
		if(count($design) > 0){
		    $str	.= '$("#bgColor").val("'.$design[0]["background_color"].'");';
		    $str	.= '$("#borColor").val("'.$design[0]["border_color"].'");';
		    $str	.= '$("#titleColor").val("'.$design[0]["title_color"].'");';
		    $str	.= '$("#descColor").val("'.$design[0]["description_color"].'");';
		    $str	.= '$("#ImageRepeat").val("'.$design[0]["repeat"].'");';
		    $str	.= '$("#ImagePosition").val("'.$design[0]["position"].'");';
		    $str	.= '$("#NewPromotionTitle").val("'.$design[0]["title"].'");';
		    $str	.= '$("#NewPromotionDescription").val("'.$design[0]["description"].'");';
		    $str	.= '$(".SocialHead").html("'.$design[0]["title"].'");';
		    $str	.= '$(".SocialDes").html("'.$design[0]["description"].'");';
		    $str	.= '$(".socialBlockOuter").css("backgroundColor", "'.$design[0]["background_color"].'");';
		    $str	.= '$(".socialBlockOuter").css("border-color", "'.$design[0]["border_color"].'");';
		    $str	.= '$(".SocialHead").css("color","'.$design[0]["title_color"].'");';
		    $str	.= '$(".SocialDes").css("color","'.$design[0]["description_color"].'");';
		    $str	.= 'var NewPromotionImage="'.$design[0]["image_path"].'";';
		    $str	.= 'var ImagePosition="'.$design[0]["position"].'";';
		    $str	.= 'var ImageRepeat="'.$design[0]["repeat"].'";';
		    $str	.= '$(".socialInner").css("background-image", "url("+NewPromotionImage+")");';
		    $str	.= '$(".socialInner").css("background-position", ImagePosition);';
		    $str	.= '$(".socialInner").css("background-repeat", ImageRepeat);';		
		    $str	.= '$(".fb_link").attr("href", fb_link);';
		    $str	.= '$(".tw_link").attr("href",tw_link);';
		}
		$str	.= '})';
		$str	.= '</script>';
		$str	.= '<a href="javascript:void(0);" style="float: right;" onclick="pr_popup_close_bt_booking('.$bTime.')"> '.$this->lang->line('click_continue').'...</a>';
	    echo $str;
?>

</div
