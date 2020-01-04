//popup front end
function pr_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="front_popup_content"></span></div>').insertAfter($(".cms_content"));
    	}
	var popID = 'front_popup'; //id of popup
    
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="pr_popup_close()" src="'+img_url()+'front_image/close_pop.png" class="btn_close" border="0" />');

	if($('#' + popID).height()==0){
		var popMargTop = 200;
	}else{
		var popMargTop = ($('#' + popID).height() + 80) / 2;
	}
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
    return false;
}
//Close Popups and Fade Layer
function pr_popup_close() {
    if($('#countdown').length > 0){
        for (var i = 1; i < 400; i++)
        window.clearInterval(i);
        var bookingData=$('#tempBookingData').serializeArray();
	$.ajax({
                url: SITE_URL+"page/deleteTempData",
                data:{bookingData:bookingData},
                type: "post" 	
		})
    }
	
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    return false;
}
function img_url(){
	//live url
	 imageUrl=SITE_URL+'asset/';
	//local url
	//var imageUrl='';
	return imageUrl;
}
function app_popup_close() {
    if($('#countdown').length > 0){
        for (var i = 1; i < 400; i++)
        window.clearInterval(i);
        var bookingData=$('#tempBookingData').serializeArray();
	$.ajax({
                url: SITE_URL+"page/deleteTempData",
                data:{bookingData:bookingData},
                type: "post" 	
		})
    }
	
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function () {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    var hidden = $("#counter").val();
    if(hidden > 0){
        location.reload();
    }
    return false;
}
function app_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="front_popup_content"></span></div>').insertAfter($("#tab-container"));
    	}
	var popID = 'front_popup'; //id of popup

    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="app_popup_close()" src="'+img_url()+'front_image/close_pop.png" class="btn_close" border="0" />');

	if($('#' + popID).height()==0){
		var popMargTop = 200;
	}else{
		var popMargTop = ($('#' + popID).height() + 80) / 2;
	}
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
    return false;
}