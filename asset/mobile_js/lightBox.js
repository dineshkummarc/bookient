function pr_popup(popWidth) {
	
	if ($("#front_popup").length == 0 ) {
		$( "body" ).append('<div id="front_popup" class="popup_block"><span id="front_popup_content"><img src="/asset/mobile_css/images/ajax-loader.gif" border="0" /></span></div>');
    	}
	var popID = 'front_popup'; //id of popup
	var popUpHeight = $('#' + popID).height();
	
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="pr_popup_close()" src="/asset/mobile_css/images/close_pop.png" class="btn_close" border="0" />');

	if(popUpHeight==0){
		var popMargTop = '40%';
	}else{
		var popMargTop = (popUpHeight / 2);
	}

    var popMargLeft = '-'+Number(popWidth)/2+'px';
   var popMargTop = '-'+Number(popUpHeight)/2 +'%';
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });
    $(".popup_block").css("margin-left",popMargLeft);
    $(".popup_block").css("margin-top",popMargTop);

    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
    return false;
}