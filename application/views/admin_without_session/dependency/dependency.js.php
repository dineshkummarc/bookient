
<script>
function showdep(displayOptipn){
	$("#insert_suss").html("");
	$("#add_dependency").hide();		
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
			
}
	
function showdependency(){
	$("#insert_suss").html("");
	$("#add_link").hide();
	$("#add_dependency").show();
}
	
function cancel(){
	$("#insert_suss").html("");
	$("#add_dependency").hide();
	$("#add_link").show();
}	

function multilineTrim(htmlString){
   return htmlString.split("\n").map($.trim).filter(function(line) { return line != "" }).join("\n");
}

function deleteDependency(del_id){
	$("#insert_suss").html("");
	if(confirm("Are you sure to break dependency ?")) {
	$.ajax({
			type: 'POST',
			datatype:'html',
			 url: SITE_URL+'admin/dependency/deleteDependencyAjax',
			data:{'del_id':del_id},
			success:function(rdata){ 
				 var TrimmedData =  multilineTrim(rdata)
				 if(TrimmedData == ""){
					 $("#show_all_dependency").hide();
					 $("#insert_suss").html("Sorry, Unable to Changes.");
				 }else{
					 $("#show_all_dependency").html(rdata);
					 $(".all_services").attr("disabled", false);
					 $(".all_services_on").attr("disabled", false);
					 $(".all_services").attr('checked', false);
					 $(".all_services_on").attr('checked', false);
                     $("#insert_suss").html("Changes have been successfully saved");
				 }
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
					 $("#insert_suss").html("Changes have been successfully saved");
				}
		});
	}else{
	alert("Plese select service on both side");
	}			
}
</script>