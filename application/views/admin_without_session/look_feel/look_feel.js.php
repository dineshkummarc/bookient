<script type="text/javascript">
$(document).ready(function(){
    $(".allAppointmentDetailsSpanHide").hide();
});
</script>
<script>
function select_layout(value)
{
    //alert(value);
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/selectLayoutAjax'); ?>",
        data:"value="+value,
        success:function(rdata)
        { 
            if(rdata.trim()=="L"){
                alert("You have successfully apply Left bar layout.");
            }
            if(rdata.trim()=="R"){
                alert("You have successfully apply Right layout.");
            }
            if(rdata.trim()=="T"){
                alert("You have successfully apply Top layout.");
            } 
        }
    });
}
</script>
<script>
function select_theme(value)
{
    //alert(value);
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/selectThemeAjax'); ?>",
        data:"value="+value,
        success:function(rdata)
        { 
            $("#showCustomTheme").hide();
            if(rdata.trim()=="CS1"){
                alert("You have successfully apply Default Theme.");
            }
            if(rdata.trim()=='CS2'){
                alert("You have successfully apply Sweet Green.");
            }
            if(rdata.trim()=='CS3'){
                alert("You have successfully apply Mozo-Gray.");
            }
            if(rdata.trim()=='CS4'){
                alert("You have successfully apply Pol-Orange.");
            }
            if(rdata.trim()=='CCS'){
                alert("You have successfully apply Custom Theme.");
            }
        }
    });
}
</script>
<script>
function showCustomTheme()
{
    $("#showCustomTheme").show();
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/showCustomThemeAjax'); ?>",
        //data:"value="+staffArrJSON,
        success:function(rdata)
        { 
            var obj = jQuery.parseJSON(rdata);
            //alert( obj.name === "John" );
            //alert(obj.background_color);
            $("#background_color").val(obj.background_color);
            $("#aside_color").val(obj.aside_color);
            $("#content_panel_blok_color").val(obj.content_panel_blok_color);
            $("#content_panel_blok_bg_color").val(obj.content_panel_blok_bg_color);
            $("#tab_hover_color").val(obj.tab_hover_color);
            $("#content_panel_outer_color").val(obj.content_panel_outer_color);
            $("#content_panel_head_bg_col").val(obj.content_panel_head_bg_col);
            $("#content_panel_head_brdr_color").val(obj.content_panel_head_brdr_color);
            $("#content_panel_btm_bg_color").val(obj.content_panel_btm_bg_color);
            $("#content_panel_btm_brdr_color").val(obj.content_panel_btm_brdr_color);
        }
    });
}
</script>
<script>
function cancel()
{
    $("#showCustomTheme").hide();
}
</script>
<script>
function save()
{
    var paramsObj = $('#frm_theme').serializeArray();
    params ={};
    $.each(paramsObj, function(i, field){
        params[field.name] = field.value;
    });
    var staffArrJSON =JSON.stringify(params, null, 2);

    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/saveThemeAjax'); ?>",
        data:"value="+staffArrJSON,
        success:function(rdata)
        { 
          alert("You have successfully save custom theme"); 
          $("#showCustomTheme").hide();
        }
    });
}
</script>