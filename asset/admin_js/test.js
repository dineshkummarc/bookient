// sankha js start from here $('html').addClass('js-enable');
$(function(){
	var windowsHeight = $(window).outerHeight(),
		windowsWidth = $(window).outerWidth(),
		topBarHeight = $('#radioset').height();
		console.log(windowsHeight);
	if(windowsWidth > 1200){		
	var divHeight = windowsHeight -150;
		$('.responsive-view').css('height',divHeight);	
	
	}
	
	$(window).resize(function(){
		var windowsHeight = $(window).outerHeight(),
		windowsWidth = $(window).outerWidth(),
		topBarHeight = $('#radioset').height();
		console.log(windowsHeight);
		if(windowsWidth > 1200){		
		var divHeight = windowsHeight -150;
			$('.responsive-view').css('height',divHeight);	
		
		}			  
		});
	});