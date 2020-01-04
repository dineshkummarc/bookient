//popup front end
function pr_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="front_popup_content"></span></div>').appendTo('body');
    	}
	var popID = 'front_popup'; //id of popup

    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="pr_popup_close()" src="'+SITE_URL+'/asset/close_pop.png" class="btn_close" border="0" />');

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
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    return false;
}

function commonAlert(){
	lightbox_body()
	$.ajax({
        type: 'POST',
        url:BASE_URL+"/admin/approval/findDetails",
        success:function(datas){
			closeLightbox_body()			
			$('.btn_close').remove();
		
			var dataArr = datas.split("|(^_^)|");
			var arr = [ '/admin/service', '/admin/staff', '/admin/business_hour', '/admin/business', '/admin/myaccount' ];
			if(dataArr[0]==0 || dataArr[1]==0 || dataArr[2]==0 || dataArr[3]==0 || dataArr[4] ==0){
			if($.inArray( window.location.pathname, arr ) == -1){
			pr_popup(350);
			var str = '';
			str += '<div class="preAlert">Please complete under the section to continue booking.</div>';
			str += '<ul class="preList">';
			if(dataArr[4] == 0){
				str += '<li>Please insert Business details</li>';
			}
			if(dataArr[2]==0){
				str += '<li>Please insert booking details</li>';	
			}
			if(dataArr[0]==0){
				str += '<li>Please insert service</li>';
			}
			if(dataArr[1]==0){
				str += '<li>Please insert staff</li>';
			}
			if(dataArr[3]==0){
				str += '<li>Please insert staff time details</li>';
			}
			str += '</ul>';
			str += '<div class="prebutton"><input type="button" value="Go" class="preActionbutton" id="preActionbutton"> </div>';
			
			$('#front_popup_content').html(str);
			$('#admin_popup_content').html(str);
			
			
			$('#preActionbutton').click(function(){ 
				pr_popup_close();
				
				if(dataArr[4] == 0){
					window.location.href = SITE_URL+"admin/myaccount";
				}else{
					if(dataArr[2]==0){
						window.location.href =	SITE_URL+"admin/business";
					}else{
						if(dataArr[0]==0){
							window.location.href = SITE_URL+"admin/service";
						}else{
							if(dataArr[1]==0){
								window.location.href = SITE_URL+"admin/staff";
							}else{
								if(dataArr[3]==0){
									window.location.href = SITE_URL+"admin/business_hour";
								}
							}
					
						}
					}
				}
				
			})
			}
			}/*else{
			setTimeout(function(){ // setting the delay for each keypress
          //  ajaxSearchRequest($type); //runs the ajax request
			    $.ajax({
			        type: 'POST',
			        url:BASE_URL+"/admin/approval/commonAlert",
			        success:function(datas){
			            if($.trim(datas) !=''){
			                var popUpData='<div id="alertPopUpDtls" title="## Alert ##" style="display: none;"><span id="alertPopUpDtls_contenar"></span></div>';
			                if($("#alertPopUpDtls").length == 0 ) {
			                    $('body').append(popUpData);
			                }
			                $("#alertPopUpDtls_contenar").html(datas);
			                setTimeout(function(){
			                    $("#alertPopUpDtls").dialog({
			                        width: 230,
			                        show: "blind",
			                        position:  [1300, 550],
			                        bgiframe: true, 
			                        autoOpen: true,
			                        modal: false,
			                        draggable:false
			                    });
			                    $(".ui-dialog-titlebar-close").remove();
			                    $(".ui-dialog-title").attr('style','padding:0 0 0 60px;');
			                    $('#alertPopUpDtls').parent().attr("id","popupAlert");
			                }, 100) 
			                setTimeout(function(){
			                    $( "#popupAlert" ).effect( "blind" );
			                }, 5000)
			            }		
			        }
			    });
				
				}, 5000);
			}*/
		}
	})
}

function lightbox_body(DivName){
		if($('#lightbox').size() == 0){
			var theLightbox = $('<div id="lightbox"/>');
			var theShadow = $('<div id="lightbox-shadow"/>');
			$(theShadow).click(function(e){
				//closeLightbox();
			});
			if($("#"+DivName).length==''){
				$('.wrapper').append(theShadow);
				$('.wrapper').append(theLightbox);
			}else{
				$('#'+DivName).append(theShadow);
				$('#'+DivName).append(theLightbox);
			}
		}
		$('#lightbox').empty();
		
		$('#lightbox').append('<img src="'+SITE_URL+'/asset/wait_a_min.gif"/><br /><strong>Loading....</strong>');
		
		$('#lightbox').css('top', $(window).scrollTop() + 50 + '%');
		$('#lightbox').show();
		$('#lightbox-shadow').show();
	}
	
function closeLightbox_body(){
		$('#lightbox').remove();
		$('#lightbox-shadow').remove();
		$('#lightbox').empty();
	}

function authAlert(){
	alert('Check Me');
}
	
	
	