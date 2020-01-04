$(function(){
		$(".left-arrow").toggle(function(){
										var src=($(".left-arrow img").attr("src")).replace("left","right");
										$(".leftpanelHold").hide()
										$(".left-arrow img").attr("src",src).parent().css("left","0px");
										
										},function(){
										var src=($(".left-arrow img").attr("src")).replace("right","left");
										$(".leftpanelHold").show()
										$(".left-arrow img").attr("src",src).parent().css("left","240px");
										
										})   
		 $(".tabing ul li").click(function(){
								$(".tabing li a").removeClass("select")
								$("a", this).addClass("select")
								var pos = $(".tabing ul li").index(this);
								$(".text-area-bg textarea").hide().eq(pos).show()
									 return false;
									 })  
		   
})