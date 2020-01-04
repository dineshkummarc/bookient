
<script>
function showdep(displayOptipn){
	$("#insert_suss").html("");
	$("#add_dependency").hide();		
	
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				$.ajax({
				url: SITE_URL+"admin/dependency/chk_staffCounter",
				type: "post",
				success: function(result){
					if(result >1){
						//start	
							$.ajax({
							  url: SITE_URL+"admin/dependency/displayOption",
							  data:{'display':displayOptipn},
							  type: "post",
							  success: function(result){
								if(result == 1){
									$("#dependency").show();
									$('#add_link').show();
								}else{
									$("#dependency").hide();
								}	
							  }  	
							})
						//end
					}else{
						$('#selectoption option:eq(1)').prop('selected', true);
						alert('Please add more than one staff to avail this feature.');
					}	
					}
				})
			}
		//check login end
		}  
	});
			
}
	
function showdependency(){
	$("#insert_suss").html("");
	$("#add_link").hide();
	$("#add_dependency").show();
}

function showcustomdependency(){
	$("#insert_custom_suss").html("");
	$("#add_custom_link").hide();
	$("#add_custom_dependency").show();
}
	
function cancel(){
	$("#insert_suss").html("");
	$("#insert_custom_suss").html("");
	$("#add_dependency").hide();
	$("#add_link").show();
}	

function multilineTrim(htmlString){
   return htmlString.split("\n").map($.trim).filter(function(line) { return line != "" }).join("\n");
}

function deleteDependency(del_id){
	$("#insert_suss").html("");
	if(confirm("<?php echo $this->lang->line('brks_dependency')?>")) {

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
			 url: SITE_URL+'admin/dependency/deleteDependencyAjax',
			data:{'del_id':del_id},
			success:function(rdata){ 
				 var TrimmedData =  multilineTrim(rdata)
				 if(TrimmedData == ""){
					 $("#show_all_dependency").hide();
					 $("#insert_suss").html("<?php echo $this->lang->line('unable_to_chnge')?>");
				 }else{
					 $("#show_all_dependency").html(rdata);
					 $(".all_services").attr("disabled", false);
					 $(".all_services_on").attr("disabled", false);
					 $(".all_services").attr('checked', false);
					 $(".all_services_on").attr('checked', false);
                     $("#insert_suss").html("<?php echo $this->lang->line('update_success')?>");
				 }
			}
			});
		}
	//check login end
	}  
});
	}
}

function dependentSer(option_value){
	$("#insert_suss").html("");
	$(".all_services").attr("disabled", false);
	$(".all_services_on").attr("disabled", false);
	$("#"+option_value).attr("disabled", true);
	$("#"+option_value).attr('checked', false);

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
			  url: SITE_URL+"admin/dependency/disabledCheckAjax",
			  data:{"option_value":option_value},
			  success:function(rdata){ 
				var data = rdata.split(",");
				$.each(data, function(i, item) {
					var itm=parseInt(item);
					$("#"+itm).attr("disabled", true);
					$("#"+itm).attr('checked', false);
					});
				}
		});
		}
	//check login end
	}  
});
}

function dependentOnSer(option_value){
	$("#insert_suss").html("");
	$(".all_services_on").attr("disabled", false);
	  
	$("input:checkbox[name=dependency_value]:checked").each(function(){
		var value1=$(this).val();
		$("#nonDependenctService_"+value1).attr("disabled", true);
	 
	});
}

function insert_to_db(){
	var value_dependent=$('input[name=nonDependenctService]:checked').val();
	var value2=''; 
	$("input:checkbox[name=dependency_value]:checked").each(function(){
		var value_dependentOn=$(this).val();
		value2=value_dependentOn+","+value2;
	});
	if(value_dependent !=undefined && value2 != ''){
		
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
			  url: SITE_URL+"admin/dependency/insert_to_db_Ajax",
			  data:{"value_dependent":value_dependent, "value_dependentOn":value2},
			  success:function(rdata){ 
					 $("#show_all_dependency").show();
					 $("#show_all_dependency").addClass("show-dependency");
					 $(".all_services").attr("disabled", false);
					 $(".all_services_on").attr("disabled", false);
					 $(".all_services").attr('checked', false);
					 $(".all_services_on").attr('checked', false);
					 $("#show_all_dependency").html(rdata);
					 $("#insert_suss").html("<?php echo $this->lang->line('update_success')?>");
				}
		});
		}
	//check login end
	}  
});
	}else{
	alert("<?php echo $this->lang->line('sel_service_on_both_side')?>");
	}			
}

function insert_custom_to_db(){

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
			  data:$('#custom_send_form').serialize(),
			  datatype:'html',
			  url: SITE_URL+"admin/dependency/insert_custom_to_db_Ajax",
			  success:function(rdata){ 
					 $("#insert_custom_suss").html(rdata + "<?php echo $this->lang->line('update_success')?>");
				}
		});
		}
	//check login end
	}  
});
}
</script>
