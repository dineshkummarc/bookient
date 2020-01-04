<script type="text/javascript">
$(document).ready(function(){
    $(".allAppointmentDetailsSpanHide").hide();
});

function select_header(value)
{
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
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/selectHeaderAjax'); ?>",
        data:"value="+value,
        success:function(rdata)
        { 
            if(rdata.trim()=="1"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_header_show'));?>");
            }
            if(rdata.trim()=="0"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_header_hide'));?>");
            }
        }
    });
		}
	//check login end
	}  
});
}

function select_layout(value)
{   
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
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/selectLayoutAjax'); ?>",
        data:"value="+value,
        success:function(rdata)
        { 
            if(rdata.trim()=="L"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_lft_br_layout'));?>");
            }
            if(rdata.trim()=="R"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_right_br_layout'));?>");
            }
            if(rdata.trim()=="T"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_top_layout'));?>");
            } 
        }
    });
		}
	//check login end
	}  
});
}

function select_theme(value)
{
   
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
        datatype:'html',
        url:"<?php echo site_url('admin/look_feel/selectThemeAjax'); ?>",
        data:"value="+value,
        success:function(rdata)
        { 
            $("#showCustomTheme").hide();
            if(rdata.trim()=="CS1"){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_deflt_thm'));?>");
            }
            if(rdata.trim()=='CS2'){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_sweet_grn'));?>");
            }
            if(rdata.trim()=='CS3'){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_mozo_gray'));?>");
            }
            if(rdata.trim()=='CS4'){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_pol_orange'));?>");
            }
            if(rdata.trim()=='CCS'){
                alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_apply_custom_thm'))?>");
            }
        }
    });
		}
	//check login end
	}  
});
}

function showCalendarTheme(){
	$("#showCalendarTheme").show();
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
			datatype:'html',
			url:"<?php echo site_url('admin/look_feel/showCalendarThemeAjax'); ?>",
			success:function(rdata){ 
					var obj = jQuery.parseJSON(rdata);
					$("#approved_color").val(obj.approved_color);
					$("#approved_color_L").val(obj.approved_color_L);
					$("#pending_color").val(obj.pending_color);
					$("#pending_color_L").val(obj.pending_color_L);
					$("#noshow_color").val(obj.noshow_color);
					$("#noshow_color_L").val(obj.noshow_color_L);
					$("#late_color").val(obj.late_color);
					$("#late_color_L").val(obj.late_color_L);
					$("#scheduled_color").val(obj.scheduled_color);
					$("#scheduled_color_L").val(obj.scheduled_color_L);
					$("#unknown_color").val(obj.unknown_color);
					$("#unknown_color_L").val(obj.unknown_color_L);
				}
			});
		}
	//check login end
	}  
});
}


function showCustomTheme(){
    $("#showCustomTheme").show();   
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
			datatype:'html',
			url:"<?php echo site_url('admin/look_feel/showCustomThemeAjax'); ?>",
			success:function(rdata){ 
					var obj = jQuery.parseJSON(rdata);
					$("#background_color").val(obj.background_color);
					$("#staffServicePanel_color").val(obj.staffServicePanel_color);
					$("#staffToolTip_color").val(obj.staffToolTip_color);
					$("#serviceTooltip_color").val(obj.serviceTooltip_color);
					$("#tabBG_color").val(obj.tabBG_color);
					$("#activTabBG_color").val(obj.activTabBG_color);
					$("#tabContentBGColor_color").val(obj.tabContentBGColor_color);
					$("#tabHeaderBGColor_color").val(obj.tabHeaderBGColor_color);
					$("#weekCalBGColor_color").val(obj.weekCalBGColor_color);
					$("#weekCalfont_color").val(obj.weekCalfont_color);
					$("#btnBGColor_color").val(obj.btnBGColor_color);
					$("#btnAcountBGColor_color").val(obj.btnAcountBGColor_color);
				}
			});
		}
	//check login end
	}  
});
}

function cancel()
{
    $("#showCustomTheme").hide();
}

function cal_cancel()
{
    $("#showCalendarTheme").hide();
}

function save(){
    var paramsObj = $('#frm_theme').serializeArray();
    params ={};
    $.each(paramsObj, function(i, field){
        params[field.name] = field.value;
    });
    var staffArrJSON =JSON.stringify(params, null, 2);

    
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
			datatype:'html',
			url:"<?php echo site_url('admin/look_feel/saveThemeAjax'); ?>",
			data:"value="+staffArrJSON,
			success:function(rdata){ 
					alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_save_custom_thm'));?>"); 
					$("#showCustomTheme").hide();
				}
			});
		}
	//check login end
	}  
});
}

function cal_save(){
    var paramsObj = $('#frm_calendar').serializeArray();
    params ={};
    $.each(paramsObj, function(i, field){
        params[field.name] = field.value;
    });
    var staffArrJSON =JSON.stringify(params, null, 2);

    
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
			datatype:'html',
			url:"<?php echo site_url('admin/look_feel/saveCalendarAjax'); ?>",
			data:"value="+staffArrJSON,
			success:function(rdata){ 
					alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_save_custom_thm'));?>"); 
					$("#showCalendarTheme").hide();
				}
			});
		}
	//check login end
	}  
});
}


function cal_reset(){  
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
			datatype:'html',
			url:"<?php echo site_url('admin/look_feel/resetCalendarAjax'); ?>",
			success:function(rdata){ 
					alert("<?php echo $this->global_mod->db_parse($this->lang->line('success_save_custom_thm'));?> - reset"); 
					$("#showCalendarTheme").hide();
				}
			});
		}
	//check login end
	}  
});
}


</script>
