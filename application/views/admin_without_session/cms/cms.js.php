<script type="text/javascript">
$(function() {
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});

function update_info(type){
var comment = $("#"+type).val();
$.ajax({
	  type: 'POST',
	  data: {'cmsType':type, 'comment':comment},
	  url:BASE_URL+"/admin/cms/updateInfo",
	  success:function(datas){
		
		}
	});
}






</script>