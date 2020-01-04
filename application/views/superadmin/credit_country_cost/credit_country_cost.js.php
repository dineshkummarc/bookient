<script type="text/javascript">
    $(document).ready(function () {
		$("#staffSettings input[type=text],select,#faq_frm #cke_membership_description").focus(function(){
			$(this).removeAttr('style');
		});
        $('#submitVal').click(function () {
				var error = 0;
				$(".each-input").each(function (i){
					if($(this).val() !=''){	
						var check_val=$(this).val();				
						if(isNaN(check_val) == true){
							$(this).attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
							error++;
						}
											
					}					
				});	
				if(error!=0){
					return false;
				}
				else{
					$('#submitVal').hide();
					$.ajax({
					    type: "POST",
					    url: SITE_URL+'superadmin/credit_country_cost/save',
					    datatype: 'html',
					    data: $("form").serialize(),
					    success: function (credit_id){
					        //alert("Data inserted successfully");
					        window.location.href = SITE_URL+'superadmin/credit_country_cost/index/'+credit_id+'/true';
					    }
					});
				}
        });
    });
</script>

<script type='text/javascript'>
$(function() {
// Stick the #nav to the top of the window
var nav = $('#nav');
var navHomeY = nav.offset().top;
var isFixed = false;
var $w = $(window);
$w.scroll(function() {
	var scrollTop = $w.scrollTop();
	var shouldBeFixed = scrollTop > navHomeY;
	if (shouldBeFixed && !isFixed) {
		$("#nav").addClass('add-bg-color');
		nav.css({
		position: 'fixed',
		top: 0,
		left: nav.offset().left,
		width: nav.width()
		});
		isFixed = true;
	}
	else if (!shouldBeFixed && isFixed) {
		$("#nav").removeClass('add-bg-color');
		nav.css({
		position: 'static'
		});
		isFixed = false;
	}
});
});
</script>