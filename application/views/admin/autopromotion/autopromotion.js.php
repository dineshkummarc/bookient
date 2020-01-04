<script type="text/javascript">
function addNewPromotion(){
	$('#btnAddPromo, #autoPromotionContent').toggle();
}

function addNewPromotionCancel(){
	$('#btnAddPromo, #autoPromotionContent').toggle();
}

function chkType(typeId){
	$("#typDate").hide();
	$("#typDate2").hide();
	if(typeId == 3){
		$("#typDate").show();
	}	
	if(typeId == 4){
		$("#typDate2").show();
	}
}

function getOffer(promoType){
	lightbox_body()
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
			$.ajax({
				type: 'POST',
				data: {'promoType':promoType},
				url:BASE_URL+"/admin/autopromotion/promoTypeWiseOffer",
				success:function(datas){;
					$("#linkContener").html(datas);
					 closeLightbox_body();
				}
			});
		}
	})	
}

	
function submitAutoPromoForm(){
				var promotnId = $('#hidden_id').val();
				
				var serviceArr=[];
				var lsService='';
				var i =0;
				$('.mutliSelect input[type="checkbox"]').each(function() {
					if($(this).is(':checked')){
						
						if($(this).val() != 0){
						serviceArr[i]=$(this).val();
							i++;
						}	
					}
				});
				
					
				
				var pro_title		=	$('#pro_title');
				var pro_type		=	$('#pro_type');
				var pro_type_date	=	$('#pro_type_date');
				var pro_time		=	$('#pro_time');
				var pro_linkType	=	$('#pro_linkType');
				var cuponName		=	$('#cuponName');
				var pro_amount		=	$('#pro_amount');
				var pro_amount_type	=	$('#pro_amount_type');
				var pro_priority	=	$('#pro_priority');
				
				
				
				
				var error = 0;
				if(pro_title.val() == ''){
					pro_title.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(pro_type.val() == ''){
					pro_type.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				else{
					if(pro_type.val() == 3){
						var pro_type_date = $('#pro_type_date').val();
						if(pro_type_date == ''){
							$('#pro_type_date').attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
							error++;
						}
					}
					
					if(pro_type.val() == 4){
						var pro_type_date_srt = $('#pro_type_date_srt').val();
						var pro_type_date_end = $('#pro_type_date_end').val();
						if(pro_type_date_srt == ''){
							$('#pro_type_date_srt').attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
							error++;
						}
						if(pro_type_date_end == ''){
							$('#pro_type_date_end').attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
							error++;
						}
					}
				}
				
				
				if(pro_time.val() == ''){
					pro_time.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				
				if(serviceArr == ''){
					$('.dropdown a').attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(pro_linkType.val() == 0){
					pro_linkType.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(cuponName.val() == 0){
					cuponName.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(pro_amount.val() == ''){
					pro_amount.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(pro_amount_type.val() == ''){
					pro_amount_type.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
				if(pro_priority.val() == ''){
					pro_priority.attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					error++;	
				}
	
	if(error >0){
		
	}else{
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
			if(result == 0){
					window.location.href = SITE_URL+'admin/login';
			}else{
				lightbox_body()
				var params ={};
				
				if(promotnId != ''){
					
					params['promo_edit_id'] = promotnId;
				}
				
				params['pro_title'] 		= pro_title.val();
				params['pro_type'] 			= pro_type.val();
				
				if(params['pro_type'] == 3){
					params['pro_type_date']	= $('#pro_type_date').val();
				}
				
				if(params['pro_type'] == 4){
					params['pro_type_date_srt'] = $('#pro_type_date_srt').val();
					params['pro_type_date_end'] = $('#pro_type_date_end').val();
				}
				
				params['pro_time'] 			= pro_time.val();
			
				params['pro_service'] 		= serviceArr;
				params['pro_linkType']	 	= pro_linkType.val();
				params['cuponName'] 		= cuponName.val();
				params['pro_amount'] 		= pro_amount.val();
				params['pro_amount_type'] 	= $('#pro_amount_type').val();
				params['pro_priority'] 		= pro_priority.val();
				params['pro_status'] 		= ($('#pro_status').is(':checked'))?1 : 0;
				

			$.ajax({
				type: 'POST',
				data: params,
				url:BASE_URL+"/admin/autopromotion/savepromo",
				success:function(datas){;
					if(datas)
						closeLightbox_body();
						location.reload();	
				}
			});
		 }
		}
	})
	}
}




$( document ).ready(function() {
	$('#pro_type_date').datepicker({dateFormat: "yy-mm-dd"});
	 $( "#pro_type_date_srt" ).datepicker({
		defaultDate: "+1w",
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		onClose: function( selectedDate ) {
		$( "#pro_type_date_end" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#pro_type_date_end" ).datepicker({
		defaultDate: "+1w",
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		onClose: function( selectedDate ) {
		$( "#pro_type_date_srt" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	
	$('.pickTime').timepicker({timeFormat: 'hh:mm:ss'});//,second: 59

});

</script>

<script type="text/javascript">

$(".dropdown dt a").on('click', function () {
	$(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function () {
	$(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
	return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function (e) {
	var $clicked = $(e.target);
	if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});


$('.mutliSelect input[type="checkbox"]').on('click', function () {
if($(this).val() ==0){
	if($(this).is(':checked')) {
		var cCount =0;
		$('.mutliSelect input[type="checkbox"]').each(function() {
		this.checked = true;
		cCount++;
		});
		cCount = cCount-1;
		$('#curSeleServ').html(cCount+' <?php echo $this->global_mod->db_parse($this->lang->line("service_selectd"))?>');
	}else{
		$('.mutliSelect input[type="checkbox"]').removeProp( "checked" );
		$('#curSeleServ').html('<?php echo $this->global_mod->db_parse($this->lang->line("select_service"))?>');
	}
}else{
	var cCount =0;
	$('.mutliSelect input[type="checkbox"]').each(function() {
		if(this.checked == true){
			cCount++;
		}
	});
	if(cCount == 0){
		$('#curSeleServ').html('<?php echo $this->global_mod->db_parse($this->lang->line("select_service"))?>');
	}else{
		$('#curSeleServ').html(cCount+' <?php echo $this->global_mod->db_parse($this->lang->line("service_selectd"))?>');
	}
}

$('.dropdown a').removeAttr('style');
});

$('.required').change(function(){
	$(this).removeAttr('style');
})

</script>

<script>
	
	function openEditWindow(promotionid){
		
		
		$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
			if(result == 0){
					window.location.href = SITE_URL+'admin/login';
			}else{
				lightbox_body()
				$.ajax({
				type: 'POST',
				data: {'promotionId':promotionid},
				url:BASE_URL+"/admin/autopromotion/GetDataForEdit",
				success:function(datas){
					if(datas){
						closeLightbox_body();
						var obj = $.parseJSON(datas);
						
						$('#btnAddPromo, #autoPromotionContent').show();
						$('#head').html('Edit promotion');
						$('#btnAddPromo').hide();
						$('#pro_title').val(obj[0].auto_promo_title);
						$('select[name^="pro_type"] option[value='+obj[0].auto_promo_type+']').attr("selected","selected");
						
						if(obj[0].auto_promo_type == 3){
							$("#typDate").show();
							$("#pro_type_date").val(obj[0].auto_promo_date);
							
						}
						if(obj[0].auto_promo_type == 4){
							$("#typDate").hide();
							$("#typDate2").show();
							$('#pro_type_date_srt').val(obj[0].auto_promo_date_srt);
							$('#pro_type_date_end').val(obj[0].auto_promo_date_end);
						}
						
						$('#pro_time').val(obj[0].auto_promo_time);
						
						var serviceId = $.parseJSON(obj[0].auto_promo_applyon);
						
						
						for(var i=0;i<serviceId.length;i++){
							$("#chk_box_"+serviceId[i]).prop("checked", true);
						}
						$('#curSeleServ').html(serviceId.length+' Service selected');
						$('select[name^="pro_linkType"] option[value='+obj[0].auto_promo_linkon+']').attr("selected","selected");
						
						$('#offer_td').html(obj[0].offerbox);
						$('#pro_amount').val(obj[0].auto_promo_remaning_value);
						$('#pro_priority').val(obj[0].auto_promo_priority);
						if(obj[0].auto_promo_status == '1'){
							$('#pro_status').attr('checked',true);
						}
						$('#hidden_id').val(obj[0].auto_promo_id);
						$('.btn-blue').val('Edit');
						
					}
						
				}
			})
		   }
		}
	})
	
		
	}
	
	function DeletePromotion(id){
		$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
					if(result == 0){
							window.location.href = SITE_URL+'admin/login';
					}else{
						var action = confirm("<?php echo $this->global_mod->db_parse($this->lang->line('r_u_want_to_del'))?>");
						if(action == true){
			
							lightbox_body()
							$.ajax({
								type: 'POST',
								data: {'promotionId':id},
								url:BASE_URL+"/admin/autopromotion/DeletePromo",
								success:function(datas){
									if(datas){
										closeLightbox_body();
										location.reload();
									}	
								}
							})	
						}
					}			
			    }	
		})
	}
	
	function change_Promostatus(protionId,curr_status){
	
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
				if(result == 0){
						window.location.href = SITE_URL+'admin/login';
				}else{
					var status = curr_status == 1 ? '0' : '1';
				//	lightbox_body()
						$.ajax({
							type: 'POST',
							data: {'promotionId':protionId,'status':status},
							url:BASE_URL+"/admin/autopromotion/ChangeStatus",
							success:function(datas){
								if(datas){
									//closeLightbox_body();
									location.reload();
						
								}	
							}
						})
				}	
			}	
		})		
	}
	
	
</script>