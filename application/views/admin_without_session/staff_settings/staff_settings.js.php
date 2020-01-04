<script type="text/javascript">
$(document).ready(function() {
    $('#submitVal').click(function(){
        var params ={};
            var paramsObj = $('#staffSettings').serializeArray();
            $.each(paramsObj, function(i, field){
            params[field.name] = field.value;
        });
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
    })
})
</script>