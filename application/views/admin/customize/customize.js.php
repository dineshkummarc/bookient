<script type="text/javascript">
    $(document).ready(function () {
        var editorText = CKEDITOR.instances;
        $(".save-btn").click(function () {
            $(this).prev('.aftr-save').remove();
            $('<img id="ajax_loder" style="padding:0px 100px 0px 0px;" height="25px" src="' + SITE_URL + 'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore(this);

            var saveId = $(this).attr("saveId");
            if (saveId == 1) {
                var subject = $('#subject_1').val();
                var tem_value = CKEDITOR.instances.editor1.getData();
                var temp_id = $('#temp_id_1').val();
            }
            if (saveId == 2) {
                var subject = $('#subject_2').val();
                var tem_value = CKEDITOR.instances.editor2.getData();
                var temp_id = $('#temp_id_2').val();
            }
            if (saveId == 3) {
                var subject = $('#subject_3').val();
                var tem_value = CKEDITOR.instances.editor3.getData();
                var temp_id = $('#temp_id_3').val();
            }
            if (saveId == 4) {
                var subject = $('#subject_4').val();
                var tem_value = CKEDITOR.instances.editor4.getData();
                var temp_id = $('#temp_id_4').val();
            }
            if (saveId == 5) {
                var subject = $('#subject_5').val();
                var tem_value = CKEDITOR.instances.editor5.getData();
                var temp_id = $('#temp_id_5').val();
            }
            if (saveId == 6) {
                var subject = $('#subject_6').val();
                var tem_value = CKEDITOR.instances.editor6.getData();
                var temp_id = $('#temp_id_6').val();
            }
            if (saveId == 7) {
                var subject = $('#subject_7').val();
                var tem_value = CKEDITOR.instances.editor7.getData();
                var temp_id = $('#temp_id_7').val();
            }
            if (saveId == 8) {
                var subject = $('#subject_8').val();
                var tem_value = CKEDITOR.instances.editor8.getData();
                var temp_id = $('#temp_id_8').val();
            }
            if (saveId == 9) {
                var subject = $('#subject_9').val();
                var tem_value = CKEDITOR.instances.editor9.getData();
                var temp_id = $('#temp_id_9').val();
            }
            var id = $(this).attr("id");
            var language = $('#language').val();
            //$("#" + id).hide();
            $.ajax({
                url: SITE_URL + "page/fn_checkLogInAdmin",
                type: "post",
                success: function (result) {
                    //check login start
                    if (result == 0) {
                        window.location.href = SITE_URL + 'admin/login';
                    } else {
                        $.ajax({
                            type: 'POST',
                            datatype: 'html',
                            url: SITE_URL + "admin/customize/ajaxSave",
                            //data: { 'saveId': saveId, 'subject': msg_subject, 'msg_body': tem_value, 'language_id': language, 'temp_id': temp_id },
                            data: { 'saveId': saveId, 'subject': subject, 'msg_body': tem_value, 'language_id': language, 'temp_id': temp_id },
                            success: function (rdata) {
                                $("#" + id).show();
                                $("#ajax_loder").remove();
                                $('<span class="aftr-save">saved</span>').insertBefore("#" + id);
                            }
                        });
                    }
                    //check login end
                }
            });
        });

        /*$.ajax({
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
        url:"admin/customize/ajaxServices')",
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
        url:"admin/customize/ajaxDataType",
        //data:"saveId="+saveId+"&subject="+subject+"&tem_value="+tem_value,
        //data:{ 'saveId' :  saveId, 'subject' : subject, 'tem_value' : tem_value },
        success:function(rdata)
        {                   
        $("#hdn_datatype_arr").val(rdata);              
        }
        });
        }
        //check login end
        }  
        }); */

    });
</script>
<script>
function toggleMemoText(val){
	
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
	//check login end
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
		$('#cusSerIDBoxNm').html("<?php echo $this->lang->line('customize_all_services');?>");
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
			$('#cusSerIDBoxNm').html(counter+" <?php echo $this->lang->line('srvice_slected');?>");
		}else{
			$('#cusSerIDBoxNm').html("<?php echo $this->lang->line('customize_all_services');?>");
		}
	}
	if(servicesArr.length ==0){
		$("#applicbl_services_for_0").attr('checked', true);
	}		
}
function dataType(value1){
	$(".optn-cls").each(function(count){
		var id_li=$(this).attr('id');
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
	$('.optn-cls').last().after('<li class="optn-cls" id="optn_'+optn_hdn+'"><input type="text" class="optionTextBox-cls" id="optionTextBox_'+optn_hdn+'" name="optionTextBox_'+optn_hdn+'" style="width:100px"><a onclick="multiOptionRemove('+optn_hdn+');" href="javascript:void(0)"><?php echo $this->lang->line("customize_customize_option_remove")?></a><br /><input type="radio" name="is_default" id="" value="defaultRadio_'+optn_hdn+'" />Is default</li>');	
	var next_value= parseInt(optn_hdn)+1;
	$('#optn_hdn').val(next_value);
	
}
function multiOptionRemove(value2){
	$('#optn_'+value2).remove();			
}
</script>
<script type="text/javascript"> 
function checkTextAreaMaxLimit(value){		
	var len = value.length;
	if (len >= 2000) {
		$('#tagLimitCancel').text("0 "+"<?php echo $this->lang->line('chars_remain');?>");
	}else {
		$('#tagLimitCancel').text(2000 - len+" <?php echo $this->lang->line('chars_remain');?>");
	}
}
function checkTextAreaMaxLimit1(value){
	var len = value.length;
	if (len >= 2000) {
		$('#tagLimitAddInfo').text("0 "+"<?php echo $this->lang->line('chars_remain');?>");
	}else {
		$('#tagLimitAddInfo').text(2000 - len+" <?php echo $this->lang->line('chars_remain');?>");
	}
}
function checkTextAreaMaxLimit2(value){
	var len = value.length;
	if (len >= 2500){
		$('#tagLimittermAndCon').text("0 "+"<?php echo $this->lang->line('chars_remain');?>");
	}else{
		$('#tagLimittermAndCon').text(2500 - len+" <?php echo $this->lang->line('chars_remain');?>");
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
    $( "#customizeForm" ).submit(function( event ) {
        if (amountOfRows > 0) {
            alert("LLL : "+amountOfRows);
            return;
        }
        $('#txtFieldName').css('border', '1px solid cyan');
        event.preventDefault();
    });
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
        var requreValue = 1;
        var ischecked = 'checked="checked"';
    } else {
        var requreValue = 0;
        var ischecked = '';
    }
    var counter = 0;
    var services = '';
    servicesArr = new Array();
    $("input:checkbox[class=checkbox]:checked").each(function () {
        var value1 = $(this).val();
        servicesArr.push(value1);
        if (servicesArr == 0) {
            services = "All Services";
            
            return false;
        }
        counter = counter + 1;
    });
	
	if(ddlDataType == 4 || ddlDataType == 5){
		var err_cnt = 0;
		var DataoptionArr = new Array();
		$(".optionTextBox-cls").each(function() {
			if($.trim($(this).val()) == ''){
				var new_id = this.id;
				$("#"+new_id).css('border', '1px solid red');
				err_cnt =1;
			}
			else{
				DataoptionArr.push($(this).val());
			}
	    	    
	    	
		});
		if(err_cnt == 1){
			return false;
		}
		
		lightbox_body();
		
	}
	var access_info = 0;
	if($("#EtcInfoClient").is(':checked')){
		access_info = 1;
	}else{
		access_info = 0;
	}
	
	var is_default_val = 0;
	is_default_val = $('input[name=is_default]:checked', '#customizeForm').val();
	
	
	
	if(is_default_val != undefined){
		var is_default = is_default_val.split('_');	
		is_default = is_default[1];	
	}
	else{
		var is_default = 0;
	}
	
	
	if(ddlDataType == 4 || ddlDataType == 5){
		var data = {'field_name':txtFieldName,'optn_hdn':optn_hdn,'fld_datatype':ddlDataType,'service_code':servicesArr,'data_option':DataoptionArr,'requreValue':requreValue,'access_info':access_info,'default_val':is_default};
	}else{
		var data = {'field_name':txtFieldName,'optn_hdn':optn_hdn,'fld_datatype':ddlDataType,'service_code':servicesArr,'requreValue':requreValue,'access_info':access_info};
	}
	
	
	
		$.ajax({
	            type: 'POST',
	            datatype: 'html',
	            url: BASE_URL + 'admin/customize/saveCustomizeformData',
	            data: data,
	            success: function (rdata) {
	                location.reload();
	                
	            }
	        });
	
	
	
	
	
	
	
	
	
	
	

  /*  if (counter != 0) {
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
    field_service_edit += '<div onmouseout="fieldServiceDropdownHide(' + optn_hdn + ')" onmouseover="fieldServiceDropdownShow(' + optn_hdn + ')" class="fieldSrvceDropdown_' + optn_hdn + '" id="fieldSrvceDropdown_' + optn_hdn + '" ><div class="ser-dropdown-head" id="cusSerIDBoxNm_' + optn_hdn + '">' + services + '</div><div id="cusSerIDBoxList_' + optn_hdn + '" class="ser-position-absolute" style="display: none;"><ul id="serviceUl"><li><input type="checkbox" onclick="fieldDisplayServices(0,' + optn_hdn + ')" value="0" class="checkbox_' + optn_hdn + '"   id="field_applicbl_services_for_0_' + optn_hdn + '" name="field[' + optn_hdn + '][service][0]" ' + fldIsChkedVal1 + '> '+'<?php echo $this->lang->line("customize_all_services_sml");?>'+' </li>';

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
    
    

    $('.cls-field').last().after('<li class="cls-field" id="li_customField_' + optn_hdn + '"><table id="table_customField_show' + optn_hdn + '" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-view"><tr><td width="20px"></td><td width="150px" id="td_field_name_' + optn_hdn + '"><strong>' + txtFieldName + '</strong></td><td id="td_service_' + optn_hdn + '" width="120px">' + services + '</td><td id="td_datatype_' + optn_hdn + '" width="150px"><strong>' + ddlDataTypeValue + '</strong></td><td id="td_requre_' + optn_hdn + '" width="50px"><strong>' + requreValue + '</strong></td><td width="30px"><a onclick="multiFieldEdit(' + optn_hdn + ');" href="javascript:void(0)">'+'<?php echo $this->lang->line("edit_btn");?>'+'</a></td><td width="30px"><a onclick="multiFieldRemove(' + optn_hdn + ');" href="javascript:void(0)">'+'<?php echo $this->lang->line("customize_customize_option_remove");?>'+'</a></td></tr></table><table id="table_customField_edit' + optn_hdn + '" cellspacing="0" cellpadding="0" border="0" width="100%" class="customFieldTb customFieldTb-edit" style="display:none;"><tr><td width="20px"></td><td width="150px"><strong>' + field_name_edit + '</strong></td><td width="120px">' + field_service_edit + '</td><td width="150px"><strong>' + field_datatype_edit + field_option_edit + '</strong></td><td width="50px"><strong>' + required_edit + '</strong></td><td width="30px"></td><td width="30px"><a onclick="fieldSave(' + optn_hdn + ');" href="javascript:void(0)">'+'<?php echo $this->lang->line("save_btn");?>'+'</a></td></tr></table></li>');
    var next_value = parseInt(optn_hdn) + 1;
    $('#multiField_hdn').val(next_value);
    
   
    */
   
}


function SetVal(){
	var val = $(this).val();
	alert(val);
	return false;
}

</script>
<script>
    function multiFieldEdit(value2) {
        $('.customFieldTb-edit').hide();
        $('.customFieldTb-view').show();
        $('#table_customField_show' + value2).hide();
        $('#table_customField_edit' + value2).show();
    }
    function multiFieldRemove(value2) {
        //$('#li_customField_' + value2).remove();
        var a = confirm("<?php echo $this->lang->line('r_u_want_to_del')?>");
        if(a == true){
			$.ajax({
	            type: 'POST',
	            datatype: 'html',
	            url: BASE_URL + 'admin/customize/saveCustomizeformDelete',
	            data: {'id':value2},
	            success: function (rdata) {
	               location.reload();
	               //alert(rdata);
	                
	            }
	   	    });
		}
        
    }
    
  //////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////  
  //customize form edit ////////////////////////////
  
  
    function fieldSave(value2) {
    	
        var txtFieldName = $('#field_name_edit_' + value2).val();
        if($.trim(txtFieldName) == ''){
			$('#field_name_edit_' + value2).css('border', '1px solid red');
			return false;
		}
        var ddlDataType = $('#ddlDataType_' + value2).val();
        if ($('#required_edit_' + value2).is(":checked")) {
            var requreValue = 1;
        } else {
            var requreValue = 0;
        }
        var counter = 0;
        var services = '';
        servicesArr = new Array();
        var chk = "checkbox_" + value2;
        $("input:checkbox[class=" + chk + "]:checked").each(function () {
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
        
        
        if(ddlDataType == 4 || ddlDataType == 5){
		var err_cnt = 0;
		var DataoptionArr = new Array();
		
		$(".optionTextBox-cls_"+value2).each(function() {
			if($.trim($(this).val()) == ''){
				var new_id = this.id;
				$("#"+new_id).css('border', '1px solid red');
				err_cnt =1;
			}
			else{
				DataoptionArr.push($(this).val());
			}
		});
		 
		if(err_cnt == 1){
			return false;
		}
		
	}
	 
		var is_default_val = $('input[name=is_default_edit]:checked', '#customizeForm').val();
		if(is_default_val == undefined){
			is_default_val = 0;
		}
		
        var data = {'field_id':value2,'data_type_id':ddlDataType,'field_name':txtFieldName,'services_ids':servicesArr,'is_required':requreValue,'value':DataoptionArr,'default_val':is_default_val};
       
        
        $.ajax({
	            type: 'POST',
	            datatype: 'html',
	            url: BASE_URL + 'admin/customize/saveCustomizeformDataEdit',
	            data: data,
	            success: function (rdata) {
	                location.reload();
	               //alert(rdata);
	                
	                
	            }
	    });
	       
        
	
        
        
/*
        if (ddlDataType == 1) {
            var ddlDataTypeValue = "TEXT";
        }
        if (ddlDataType == 2) {
            var ddlDataTypeValue = "NUMBER";
        }
        if (ddlDataType == 3) {
            var ddlDataTypeValue = "DATE";
        }
        if (ddlDataType == 4) {
            var ddlDataTypeValue = "RADIO";
        }
        if (ddlDataType == 5) {
            var ddlDataTypeValue = "LIST";
        }
        if (ddlDataType == 6) {
            var ddlDataTypeValue = "CHECK BOX";
        }
        if (ddlDataType == 7) {
            var ddlDataTypeValue = "Heading";
        }
        $('#td_field_name_' + value2).html(txtFieldName);
        $('#td_service_' + value2).html(services);
        $('#td_datatype_' + value2).html(ddlDataTypeValue);
        $('#td_requre_' + value2).html(requreValue);

        $('#table_customField_show' + value2).show();
        $('#table_customField_edit' + value2).hide();*/
    }
    
    
    
    function cancel_edit(id){
		//$('.customFieldTb-edit').show();
       // $('.customFieldTb-view').hide();
       $("#table_customField_edit"+id).hide();
       $("#table_customField_show"+id).show();
	}
    
  //////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////  
    
    function fieldServiceDropdownShow(optn_hdn) {
        $('#cusSerIDBoxList_' + optn_hdn).show();
    }
    
    
    
    function fieldServiceDropdownHide(optn_hdn) {
        $('#cusSerIDBoxList_' + optn_hdn).hide();
    }
    
    
    function fieldDisplayServices(chk_id, optn_hdn) {
        $('#showservice').html("");
        var counter = 0;
        $('#cusSerIDBoxNm' + optn_hdn).html('');        
        if (chk_id == 0) {  
            $(".checkbox_" + optn_hdn).attr('checked', false);
            $("#field_applicbl_services_for_0_" + optn_hdn).attr('checked', true);
            $('#cusSerIDBoxNm_' + optn_hdn).html("<?php echo $this->lang->line('customize_all_services');?>");
        } else {
            $("#field_applicbl_services_for_0_" + optn_hdn).attr('checked', false);
        }

        servicesArr = new Array();
        var chk = "checkbox_" + optn_hdn;
        $("input:checkbox[class=" + chk + "]:checked").each(function () {
            var value1 = $(this).val();
            servicesArr.push(value1);
            counter = counter + 1;
        });
        if (chk_id != 0) {
            if (counter != 0) {
                $('#cusSerIDBoxNm_' + optn_hdn).html(counter + " <?php echo $this->lang->line('srvice_slected');?>");
            } else {
                $('#cusSerIDBoxNm_' + optn_hdn).html("<?php echo $this->lang->line('customize_all_services');?>");
            }
        }
        
        
        if (servicesArr.length == 0 || servicesArr == '') {
            $("#field_applicbl_services_for_0_"+optn_hdn).attr('checked', true);
        }
    }
    
    
    
    function fieldMultiOptionEntry(optn_hdn) {
    	
        var count = $('#field_optn_hdn_' + optn_hdn).val();
        var prev = count - 1;
      
      	
        var next_cnt = parseInt(count) + 1;
       
        
        $('.optn-cls_' + optn_hdn).last().after('<li id="field_optn_' + optn_hdn + '_' + next_cnt + '" class="optn-cls_' + optn_hdn + '"><input type="text" class="optionTextBox-cls_' + optn_hdn + '" value="" id="optionTextBox_' + optn_hdn + '_' + next_cnt + '"  name="field[' + optn_hdn + '][datatype][option][' + next_cnt + ']" style="width:100px"><a onclick="fieldMultiOptionRemove(' + optn_hdn + ',' + next_cnt + ');" href="javascript:void(0)">'+'<?php echo $this->lang->line("customize_customize_option_remove");?>'+'</a><br /><input type="radio" name="is_default_edit" id="" value="'+next_cnt+'" /><?php echo $this->lang->line("is_default")?></li>');
     
        var next_value = parseInt(count) + 1;
        $('#field_optn_hdn_' + optn_hdn).val(next_value);
    }
    
    
    
    
    function fieldMultiOptionRemove(value1, value2) {
    	alert(value1+' '+value2);
        $('#field_optn_' + value1 + '_' + value2).remove();
    }
    
    function fieldDataType(value1, field_val) {
        $(".optn-cls_" + field_val).each(function (count) {
            var id_li = $(this).attr('id');
            var f_id = 'field_optn_' + field_val + '_0';
            var s_id = 'field_optn_' + field_val + '_1';
            if (id_li != s_id && id_li != f_id) {
                $(this).remove();
            }
        });
        $(".field-optionTextBox-cls_" + field_val).val('');
        if (value1 == '4' || value1 == '5') {
            $('#fieldmultiOptionEntry_' + field_val).show();
        } else {
            $('#fieldmultiOptionEntry_' + field_val).hide();
        }
    }
    
    function saveData() {
        var backgroungImagePath = $('#backgroungImagePath').val();
        var pageAddressWidget = $('#pageAddressWidget').val();
        var facebookpageurl = $('#facebookpageurl').val();
        var twitterpageurl = $('#twitterpageurl').val();
        //alert("TEST : " + facebookpageurl);
        $.ajax({
            type: 'POST',
            datatype: 'html',
            url: BASE_URL + 'admin/customize/saveCustomizeData',
            data: { 'backgroungImagePath': backgroungImagePath, 'pageAddressWidget': pageAddressWidget, 'facebookpageurl': facebookpageurl, 'twitterpageurl': twitterpageurl },
            success: function (rdata) {
                //alert("TESTY");
            }
        });
    }
</script>


<!-- ################################################################################################################-->
<!-- ##################################### Email customization part start ############################################-->
<!-- ################################################################################################################-->
<script>
	function showMailContent(tmplId){
		var workingId = $("#htmlContent_"+tmplId);
		if(workingId.is(":visible")){
			workingId.hide();
		} else { 
			$(".htmlContent").hide();
			workingId.show(); 
		}
	}
	
	function saveMailContent(tmplId){
		//lightbox_body()
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'admin/login';
				}else{
				var mail_language = '';
				var mail_subject	= $("#email_subject_"+tmplId).val();
				var mail_body		= CKEDITOR.instances['mainText_'+tmplId].getData();
				mail_language   = $('#language_list option:selected').val();
				lightbox_body()
				$.ajax({
			            type: 'POST',
			            datatype: 'html',
			            url: BASE_URL + 'admin/customize/saveMailData',
			            data: { 'mail_subject': mail_subject, 'mail_body': mail_body, 'msg_id': tmplId,'mail_language':mail_language },
			            success: function (rdata) {
			            	
			            	closeLightbox_body();
			            	//alert(rdata);	
			                if(parseInt(rdata) > 0){
			                	$('#msg_'+tmplId).html('');
								$('#msg_'+tmplId).html('<?php echo $this->global_mod->db_parse($this->lang->line("ur_mail_cntnt_insrtd_success"));?>');
							}else{
								$('#msg_'+tmplId).html('');
								$('#msg_'+tmplId).html('<?php echo $this->global_mod->db_parse($this->lang->line("ur_mail_cntnt_update_success"));?>');
							}
			            }
			        }																								);	
				}
			//check login end
			}  
		});
	}
	function pageReload(langId) {
        $.ajax({
            url: SITE_URL + "admin/customize/mailFormat",
            type: "POST",
            data: { 'langId': langId },
            dataType: 'html',
            success: function (msg) {
                window.location.reload();
            }
        });
    }
    
    
    function GetEmailTemplate(msgId,language_list){
    	
    	var languageId = language_list.value;
    	
    	$.ajax({
            url: SITE_URL + "admin/customize/GetEmailTemplateByLanguage",
            type: "POST",
            data: { 'languageId': languageId,'msg_id':msgId},
            dataType: 'html',
            success: function(msg){
            	
            	if(msg == 0){
					$("#email_subject_"+msgId).val('');
					CKEDITOR.instances['mainText_'+msgId].setData('');
					//CKEDITOR.instances.editor8.setData('');
				}
				else{
					var ReturnData = msg.split('$@#$@#');
					
					$("#email_subject_"+msgId).val(ReturnData[0]);
					CKEDITOR.instances['mainText_'+msgId].setData(ReturnData[1]);
					$("#language_list").val(ReturnData[2]);
				}
               // window.location.reload();
            }
        });
		
	}
    
    
</script>
<!-- ################################################################################################################-->
<!-- ##################################### Email cusomization part end ##############################################-->
<!-- ################################################################################################################-->
