<script type="text/javascript">
$(document).ready(function(){
	var editorText = CKEDITOR.instances;		
	$(".save-btn").click(function(){
		$(this).prev('.aftr-save').remove();
		$('<img id="ajax_loder" style="padding:0px 100px 0px 0px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore(this);
		
		var saveId = $(this).attr("saveId");
		//$(this).attr("disabled", true);
		//var id=$(this).attr("id");
		//alert(id);	
		if(saveId ==1){
			var subject=$('#confirm_booking_email_subject').val()	
			var tem_value=CKEDITOR.instances.editor1.getData();		
		}
		if(saveId ==2){
			var subject=$('#waiting_fr_approval_email_subject').val()	
			var tem_value=CKEDITOR.instances.editor2.getData();	
		}
		if(saveId ==3){
			var subject=$('#sent_after_service_email_subject').val()	
			var tem_value=CKEDITOR.instances.editor3.getData();	
		}
		if(saveId ==4){
			var subject=$('#reschedu_an_appoint_email_subject').val()	
			var tem_value=CKEDITOR.instances.editor4.getData();	
		}
		if(saveId ==5){
			var subject=$('#alert_before_appointment_email_subject').val();	
			var tem_value=CKEDITOR.instances.editor5.getData();	
		}
		if(saveId ==6){
			var subject=$('#alert_appointment_approval_email_subject').val();	
			var tem_value=CKEDITOR.instances.editor6.getData();	
		}
		if(saveId ==7){
			var subject=$('#appointment_cancellation_email_subject').val();	
			var tem_value=CKEDITOR.instances.editor7.getData();	
		}
		if(saveId ==8){
			var subject=$('#appointment_denial_email_subject').val();			
			var tem_value=CKEDITOR.instances.editor8.getData();	
		}
		if(saveId ==9){
			var subject=$('#login_detail_email_subject').val();	
			var tem_value=CKEDITOR.instances.editor9.getData();	
		}
		var id=$(this).attr("id");
		$("#"+id).hide();						
		$.ajax({
			type: 'POST',
			datatype:'html',
			url:"<?php echo site_url('admin/customize/ajaxSave'); ?>",
			//data:"saveId="+saveId+"&subject="+subject+"&tem_value="+tem_value,
			data:{ 'saveId' :  saveId, 'subject' : subject, 'tem_value' : tem_value },
			success:function(rdata)
			{					
				//$(id).removeAttr("disabled");
				$("#"+id).show();				
				$("#ajax_loder").remove();
				$('<span class="aftr-save">saved</span>').insertBefore("#"+id);
			}
		});
	});	
	
	
	
	
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customize/ajaxServices'); ?>",
		//data:"saveId="+saveId+"&subject="+subject+"&tem_value="+tem_value,
		//data:{ 'saveId' :  saveId, 'subject' : subject, 'tem_value' : tem_value },
		success:function(rdata)
		{					
			//$(id).removeAttr("disabled");
			$("#hdn_service_arr").val(rdata);				
		}
	});
	
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customize/ajaxDataType'); ?>",
		//data:"saveId="+saveId+"&subject="+subject+"&tem_value="+tem_value,
		//data:{ 'saveId' :  saveId, 'subject' : subject, 'tem_value' : tem_value },
		success:function(rdata)
		{					
			$("#hdn_datatype_arr").val(rdata);				
		}
	});
	
	
				
});
</script>
<script>
function toggleMemoText(val){
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customize/preBookingFormShowHide'); ?>",
		data:{ 'option' :  val},
		success:function(rdata){					
			if($.trim(rdata)==1){
				$("#etcInfoSpan").show();
			}else{
				$("#etcInfoSpan").hide();
			}				
		}
	});		
}
function showEmailDetails(employee_id)
{
	$('.down-arrow').hide();
	$('.right-arrow').show();
	$('.customize-email').hide();
	$('.right-arrow').show();
	$('#arrowdown'+employee_id).show();
	$('#customizeEmailDetails'+employee_id).show();
	$('#arrowright'+employee_id).hide();
	/*
	$.ajax({
		url: "<?php echo base_url(); ?>admin/business_hour/show_biz_hour/"+employee_id,
		type: "POST",
		//data: {jsondata: jObject},
		//dataType: 'json',
		success: function(msg) {
			var result = msg.split('@|^_^|@');
			if(result[1] == 'done'){
				$('#customizeEmailDetails'+employee_id).html(result[0]);
				after_ajax_addi();
			}
		}
	});
	*/
}
function hideEmailDetails(employee_id)
{	
	$('#customizeEmailDetails'+employee_id).hide();
	$('#arrowright'+employee_id).show();
	$('#arrowdown'+employee_id).hide();	
}
function arw(){
	$('#cusSerIDBoxList').show();
}
function arx(){
	$('#cusSerIDBoxList').hide();
}
</script>
<script>
function displayServices(chk_id)
{
	$('#showservice').html("");
	var counter=0;
	$('#cusSerIDBoxNm').html('');
	if(chk_id==0){		
		$(".checkbox").attr('checked', false);
		$("#applicbl_services_for_0").attr('checked', true);
		$('#cusSerIDBoxNm').html("All Services");
	}
	else{
		$("#applicbl_services_for_0").attr('checked', false);
	}
	servicesArr = new Array();
	$("input:checkbox[class=checkbox]:checked").each(function(){
		var value1= $(this).val();
		servicesArr.push(value1);
		counter=counter +1;
	});
	if(chk_id !=0){		
		if(counter  != 0){
			$('#cusSerIDBoxNm').html(counter+" service selected");
		}else{
			$('#cusSerIDBoxNm').html("All Services");
		}
	}
	if(servicesArr.length ==0){
		$("#applicbl_services_for_0").attr('checked', true);
	}
			/*
			var json_servicesArr = JSON.stringify(servicesArr, null, 2);
			$.ajax({
			type: 'POST',
			datatype:'json',
			url:"<?php echo site_url('admin/coupon/showTextServicesAjax'); ?>",
			data:"json_servicesArr="+json_servicesArr,
			success:function(ser)
			{

			 	var obj = jQuery.parseJSON(ser);
			 	services ="";
				var counter =1;
				 $.each(obj, function(index, value) {
				 if(counter > 1) {
						services=value+","+" "+services ;
				} else {
						services=value+" "+services ;
				}
				counter++;

				});
				$('#showservice').html(services);
			}
			});
			*/
}
function dataType(value1){
	$(".optn-cls").each(function(count){
		var id_li=$(this).attr('id');
		//$(this)..children('.optionTextBox-cls').val('');
		if(id_li !='optn_1' &&  id_li !='optn_2'){
			$(this).remove();
		}						
	});
	$('.optionTextBox-cls').val('');		
	if( value1=='4' || value1=='5'){
		$('#multiOptionEntry').show();	
	}else{
		$('#multiOptionEntry').hide();	
	}	
}
function multiOptionEntry(){
	var optn_hdn=$('#optn_hdn').val();
	var prev=optn_hdn-1;
	$('.optn-cls').last().after('<li class="optn-cls" id="optn_'+optn_hdn+'"><input type="text" class="optionTextBox-cls" id="optionTextBox_'+optn_hdn+'" name="optionTextBox_'+optn_hdn+'" style="width:100px"><a onclick="multiOptionRemove('+optn_hdn+');" href="javascript:void(0)">remove</a></li>');	
	var next_value= parseInt(optn_hdn)+1;
	$('#optn_hdn').val(next_value);
	
}
function multiOptionRemove(value2){
	$('#optn_'+value2).remove();			
}
</script>
<script type="text/javascript"> 
function checkTextAreaMaxLimit(value){
	//$("#title").value(value);		
	var len = value.length;
	if (len >= 2000) {
		$('#tagLimitCancel').text("0 characters remaining");
	}else {
		$('#tagLimitCancel').text(2000 - len+" characters remaining");
	}
}
function checkTextAreaMaxLimit1(value){
	var len = value.length;
	if (len >= 2000) {
		$('#tagLimitAddInfo').text("0 characters remaining");
	}else {
		$('#tagLimitAddInfo').text(2000 - len+" characters remaining");
	}
}
function checkTextAreaMaxLimit2(value){
	var len = value.length;
	if (len >= 2500){
		$('#tagLimittermAndCon').text("0 characters remaining");
	}else{
		$('#tagLimittermAndCon').text(2500 - len+" characters remaining");
	}
}
function displayBorderNone(){
	$('#txtFieldName').css('border','1px solid #CCCCCC');
}
</script> 
<script>
/**********************/
function checkCustomizeForm() {
    var amountOfRows = $(".customFieldTb-view tbody tr").length;
    alert("WWW : "+amountOfRows);
    $( "#customizeForm" ).submit(function( event ) {
        if (amountOfRows > 0) {
            alert("LLL : "+amountOfRows);
            return;
        }
        alert("RRR : "+amountOfRows);
        $('#txtFieldName').css('border', '1px solid cyan');
        event.preventDefault();
    });
    /*if(amountOfRows == 0){alert("LLL : "+amountOfRows);
        $('#txtFieldName').css('border', '1px solid red');
        $("#customizeForm").submit(function () {
            return false;
        });
    }else{alert("RRR : "+amountOfRows);
        $( "#customizeForm" ).submit();
    }*/
}
/**********************/
function multiFieldEntry() {
    var optn_hdn = $('#multiField_hdn').val();
    var txtFieldName = $('#txtFieldName').val();
    if (txtFieldName == '') {
        $('#txtFieldName').css('border', '1px solid red');
        return false;
    }
    var ddlDataType = $('#ddlDataType').val();
    if ($('#chkIsRequired').is(":checked")) {
        var requreValue = "Yes";
        var ischecked = 'checked="checked"';
    } else {
        var requreValue = "No";
        var ischecked = '';
    }
    var counter = 0;
    var services = '';
    servicesArr = new Array();
    $("input:checkbox[class=checkbox]:checked").each(function () {
        var value1 = $(this).val();
        servicesArr.push(value1);
        if (value1 == 0) {
            services = "All Services";
            return false;
        }
        counter = counter + 1;
    });

    if (counter != 0) {
        services = counter + " service selected";
    } else {
        services = "All Services";
    }
    var field_option_display = '';
    if (ddlDataType == 1) {
        var ddlDataTypeValue = "TEXT";
        field_option_display = 'style="display: none;"';
    }
    if (ddlDataType == 2) {
        var ddlDataTypeValue = "NUMBER";
        field_option_display = 'style="display: none;"';
    }
    if (ddlDataType == 3) {
        var ddlDataTypeValue = "DATE";
        field_option_display = 'style="display: none;"';
    }
    if (ddlDataType == 4) {
        var ddlDataTypeValue = "RADIO";
    }
    if (ddlDataType == 5) {
        var ddlDataTypeValue = "LIST";
    }
    if (ddlDataType == 6) {
        var ddlDataTypeValue = "CHECK BOX";
        field_option_display = 'style="display: none;"';
    }
    if (ddlDataType == 7) {
        var ddlDataTypeValue = "Heading";
        field_option_display = 'style="display: none;"';
    }

    var prev = optn_hdn - 1;
    var field_name_edit = '<input type="text" name="field[' + optn_hdn + '][name]" id="field_name_edit_' + optn_hdn + '" value="' + txtFieldName + '" />';
    var field_service_edit = ''; //services
    var service_json = $('#hdn_service_arr').val();
    var service_array = $.parseJSON(service_json);
    var fldIsChked1 = jQuery.inArray('0', servicesArr);
    if (fldIsChked1 == "0") {
        var fldIsChkedVal1 = 'checked="checked"';
    } else {
        var fldIsChkedVal1 = '';
    }
    field_service_edit += '<div onmouseout="fieldServiceDropdownHide(' + optn_hdn + ')" onmouseover="fieldServiceDropdownShow(' + optn_hdn + ')" class="fieldSrvceDropdown_' + optn_hdn + '" id="fieldSrvceDropdown_' + optn_hdn + '" ><div class="ser-dropdown-head" id="cusSerIDBoxNm_' + optn_hdn + '">' + services + '</div><div id="cusSerIDBoxList_' + optn_hdn + '" class="ser-position-absolute" style="display: none;"><ul id="serviceUl"><li><input type="checkbox" onclick="fieldDisplayServices(0,' + optn_hdn + ')" value="0" class="checkbox_' + optn_hdn + '"   id="field_applicbl_services_for_0_' + optn_hdn + '" name="field[' + optn_hdn + '][service][0]" ' + fldIsChkedVal1 + '> all services </li>';

    $.each(service_array, function (index, order) {
        var fldIsChked = jQuery.inArray(order.service_id, servicesArr);
        if (fldIsChked == "-1") {
            var fldIsChkedVal = '';
        } else {
            var fldIsChkedVal = 'checked="checked"';
        }
        field_service_edit += '<li><input type="checkbox" ' + fldIsChkedVal + ' onclick="fieldDisplayServices(' + order.service_id + ',' + optn_hdn + ')" value="' + order.service_id + '" class="checkbox_' + optn_hdn + '" id="field_applicbl_services_for_' + order.service_id + '_' + optn_hdn + '" name="field[' + optn_hdn + '][service][' + order.service_id + ']">' + order.service_name + '</li>';
    });
    field_service_edit += '</ul></div></div>';

    var field_datatype_edit = ''; //datatype  
    var datatype_json = $('#hdn_datatype_arr').val();
    var datatype_array = $.parseJSON(datatype_json);
    var field_selected = $('#ddlDataType').val();
    field_datatype_edit += '<select name="field[' + optn_hdn + '][datatype][name]" onchange="fieldDataType(this.value,' + optn_hdn + ');" id="ddlDataType_' + optn_hdn + '">';

    $.each(datatype_array, function (index, order) {
        if (field_selected == order.data_type_id) {
            var fldIsSlecteddVal = 'selected="selected"';
        } else {
            var fldIsSlecteddVal = '';
        }
        field_datatype_edit += '<option ' + fldIsSlecteddVal + ' value="' + order.data_type_id + '">' + order.name + '</option>';
    });
    field_datatype_edit += '</select>';

    var field_option_edit = '';
    field_option_edit += '<div id="fieldmultiOptionEntry_' + optn_hdn + '" ' + field_option_display + '><ul><b>Options</b>';
    var optn_count = '';
    $(".optionTextBox-cls").each(function (count) {
        var optionTextBox_val = $(this).val();
        optn_count = count;
        if (count == 0) {
            var add = '<a onclick="fieldMultiOptionEntry(' + optn_hdn + ');" href="javascript:void(0)">Add</a>';
        } else {
            var add = '';
        }

        if (count != 0 && count != 1) {
            var remove = '<a onclick="fieldMultiOptionRemove(' + optn_hdn + ',' + count + ');" href="javascript:void(0)">remove</a>';
        } else {
            var remove = '';
        }
        field_option_edit += '<li id="field_optn_' + optn_hdn + '_' + count + '" class="optn-cls_' + optn_hdn + '"><input type="text" class="field-optionTextBox-cls_' + optn_hdn + '" value="' + optionTextBox_val + '" id="optionTextBox_' + optn_hdn + '_' + count + '"  name="field[' + optn_hdn + '][datatype][option][' + count + ']" style="width:100px">' + remove + '&nbsp;' + add + '</li>';
    });

    var next_value = parseInt(optn_count) + 1;
    field_option_edit += '<input type="hidden" id="field_optn_hdn_' + optn_hdn + '" name="field_optn_hdn_' + optn_hdn + '" value="' + next_value + '"/></ul></div>';

    var required_edit = '<input type="checkbox" name="field[' + optn_hdn + '][required]" ' + ischecked + ' id="required_edit_' + optn_hdn + '">';

    $('.cls-field').last().after('<li class="cls-field" id="li_customField_' + optn_hdn + '"><table id="table_customField_show' + optn_hdn + '" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-view"><tr><td width="20px"></td><td width="150px" id="td_field_name_' + optn_hdn + '"><strong>' + txtFieldName + '</strong></td><td id="td_service_' + optn_hdn + '" width="120px">' + services + '</td><td id="td_datatype_' + optn_hdn + '" width="150px"><strong>' + ddlDataTypeValue + '</strong></td><td id="td_requre_' + optn_hdn + '" width="50px"><strong>' + requreValue + '</strong></td><td width="30px"><a onclick="multiFieldEdit(' + optn_hdn + ');" href="javascript:void(0)">Edit</a></td><td width="30px"><a onclick="multiFieldRemove(' + optn_hdn + ');" href="javascript:void(0)">Remove</a></td></tr></table><table id="table_customField_edit' + optn_hdn + '" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-edit" style="display:none;"><tr><td width="20px"></td><td width="150px"><strong>' + field_name_edit + '</strong></td><td width="120px">' + field_service_edit + '</td><td width="150px"><strong>' + field_datatype_edit + field_option_edit + '</strong></td><td width="50px"><strong>' + required_edit + '</strong></td><td width="30px"></td><td width="30px"><a onclick="fieldSave(' + optn_hdn + ');" href="javascript:void(0)">Save</a></td></tr></table></li>');
    var next_value = parseInt(optn_hdn) + 1;
    $('#multiField_hdn').val(next_value);
}
</script>
<script>
function multiFieldEdit(value2){
	$('.customFieldTb-edit').hide();
	$('.customFieldTb-view').show();
	$('#table_customField_show'+value2).hide();
	$('#table_customField_edit'+value2).show();	
}
function multiFieldRemove(value2){
	$('#li_customField_'+value2).remove();			
}
function fieldSave(value2){
	var txtFieldName=$('#field_name_edit_'+value2).val();
	var ddlDataType=$('#ddlDataType_'+value2).val();
	if ($('#required_edit_'+value2).is(":checked")){
	 	var requreValue="Yes";
	}else{
		var requreValue="No";
	}	
	var counter=0;
	var services='';
	servicesArr = new Array();
	var chk="checkbox_"+value2;
	$("input:checkbox[class="+chk+"]:checked").each(function(){
		var value1= $(this).val();
		servicesArr.push(value1);
		if(value1 == 0){
			services="All Services";
			return false;
		}
		counter=counter +1;
	});
	
	if(counter != 0){		
		services = counter+" service selected";
	}else{
		services="All Services";
	}
	
	if(ddlDataType ==1){
		var ddlDataTypeValue="TEXT";
	}
	if(ddlDataType ==2){
		var ddlDataTypeValue="NUMBER";
	}
	if(ddlDataType ==3){
		var ddlDataTypeValue="DATE";
	}
	if(ddlDataType ==4){
		var ddlDataTypeValue="RADIO";
	}
	if(ddlDataType ==5){
		var ddlDataTypeValue="LIST";
	}
	if(ddlDataType ==6){
		var ddlDataTypeValue="CHECK BOX";
	}
	if(ddlDataType ==7){
		var ddlDataTypeValue="Heading";
	}
	$('#td_field_name_'+value2).html(txtFieldName);
	$('#td_service_'+value2).html(services);
	$('#td_datatype_'+value2).html(ddlDataTypeValue);
	$('#td_requre_'+value2).html(requreValue);

	$('#table_customField_show'+value2).show();
	$('#table_customField_edit'+value2).hide();			
}
function fieldServiceDropdownShow(optn_hdn){
	$('#cusSerIDBoxList_'+optn_hdn).show();
}
function fieldServiceDropdownHide(optn_hdn){
	$('#cusSerIDBoxList_'+optn_hdn).hide();
}
function fieldDisplayServices(chk_id,optn_hdn){
	$('#showservice').html("");
	var counter=0;
	$('#cusSerIDBoxNm'+optn_hdn).html('');
	if(chk_id==0){		
		$(".checkbox_"+optn_hdn).attr('checked', false);
		$("#field_applicbl_services_for_0_"+optn_hdn).attr('checked', true);
		$('#cusSerIDBoxNm_'+optn_hdn).html("All Services");
	}else{
		$("#field_applicbl_services_for_0_"+optn_hdn).attr('checked', false);
	}
	
	servicesArr = new Array();
	var chk="checkbox_"+optn_hdn;
	$("input:checkbox[class="+chk+"]:checked").each(function(){
		var value1= $(this).val();
		servicesArr.push(value1);
		counter=counter +1;
	});
	if(chk_id !=0){		
		if(counter  != 0){
			$('#cusSerIDBoxNm_'+optn_hdn).html(counter+" service selected");
		}else{
			$('#cusSerIDBoxNm_'+optn_hdn).html("All Services");
		}
	}
	if(servicesArr.length ==0){
		$("#field_applicbl_services_for_0_"+optn_hdn).attr('checked', true);
	}			
}
function fieldMultiOptionEntry(optn_hdn){
	var count=$('#field_optn_hdn_'+optn_hdn).val();
	var prev=count-1;
	$('.optn-cls_'+optn_hdn).last().after('<li id="field_optn_'+optn_hdn+'_'+count+'" class="optn-cls_'+optn_hdn+'"><input type="text" class="optionTextBox-cls_'+optn_hdn+'" value="" id="optionTextBox_'+optn_hdn+'_'+count+'"  name="field['+optn_hdn+'][datatype][option]['+count+']" style="width:100px"><a onclick="fieldMultiOptionRemove('+optn_hdn+','+count+');" href="javascript:void(0)">remove</a></li>');		
	var next_value= parseInt(count)+1;
	$('#field_optn_hdn_'+optn_hdn).val(next_value);	 
}
function fieldMultiOptionRemove(value1,value2){
	$('#field_optn_'+value1+'_'+value2).remove();			
}
function fieldDataType(value1,field_val){
	$(".optn-cls_"+field_val).each(function(count){
		var id_li=$(this).attr('id');		
		var f_id='field_optn_'+field_val+'_0';
		var s_id='field_optn_'+field_val+'_1';
		if(id_li !=s_id && id_li !=f_id ){
			$(this).remove();
		}						
	});
	$(".field-optionTextBox-cls_"+field_val).val('');	
	if( value1=='4' || value1=='5'){
		$('#fieldmultiOptionEntry_'+field_val).show();	
	}else{
		$('#fieldmultiOptionEntry_'+field_val).hide();	
	}	
}
</script>