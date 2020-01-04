<script type="text/javascript">
$(document).ready(function() {
    $('#submitVal').click(function(){
        var params ={};
            var paramsObj = $('#staffSettings').serializeArray();
            $.each(paramsObj, function(i, field){
            params[field.name] = field.value;
        });

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
            url: '<?php echo base_url(); ?>admin/staff_settings/UpdateStaffSettings',
            data: params,
            success: function(data){
                if(data > 0) 
                {
                    window.location.href = SITE_URL+"admin/staff_settings/index/succ";
                }
            }
        });
		}
	//check login end
	}  
});
    })
})
</script>