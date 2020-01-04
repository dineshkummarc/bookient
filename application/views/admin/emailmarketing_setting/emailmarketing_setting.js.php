<script type="text/javascript">
	function GetTemplate(tempCatId = 0){

		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
				if(result == 0){
						window.location.href = SITE_URL+'admin/login';
				}else{
					var tem_cat = $('#Emailcategory').val();
					if(tem_cat != 0){
						lightbox_body()
						$.ajax({
							type: 'POST',
							data: {'TepmCat':tem_cat,'tempCatId':tempCatId},
							url:BASE_URL+"/admin/emailmarketing_setting/GetTemplate",
							success:function(datas){
								if(datas != ''){
									$("#TEmp_td").html(datas);
							 		closeLightbox_body();
								}
							}
						});
					}else{
						$("#TEmp_td").html('<?php echo $this->lang->line("selct_tmplt_cat")?>');
					}	
					
				}
			}	
		})		
	}
	
	
	function GetCustomers(ids = 0){
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
				if(result == 0){
						window.location.href = SITE_URL+'admin/login';
				}else{
					var CusType = $('#Customer_type').val();
					if(CusType != 0){
						lightbox_body()
						$.ajax({
							type: 'POST',
							data: {'CusType':CusType,'CustomerIds':ids},
							url:BASE_URL+"/admin/emailmarketing_setting/GetAllcustomers",
							success:function(datas){
								closeLightbox_body();
								if(datas != 1){
									$(".mutliSelect").html(datas);
								}
							}
						});
					}else{
						
					}
				}
			}	
		})
	}
	
	var i = 0;
	function SelectAll(){
		var status = document.getElementById("customer_name").checked;
		
		if(status == true){
			$('.mutliSelect input[type="checkbox"]').each(function() {
				this.checked = true;
				i++;
			})
			$('#curSeleServ').html((i-1)+' <?php echo $this->lang->line("servc_slctd")?>');
		}else{
			$('.mutliSelect input[type="checkbox"]').each(function() {
				this.checked = false;
				
			})
			$('#curSeleServ').html('<?php echo $this->lang->line("slct_custmr_grp")?>');
			i = 0;
		}
	}
	
	function ClearParent(){
		
		$('.mutliSelect input[type="checkbox"]').each(function() {
				if(this.checked == false){
					document.getElementById("customer_name").checked = false;
					//alert(i);
					if(i>0){
						i=i-1;
						$('#curSeleServ').html(i+' <?php echo $this->lang->line("servc_slctd")?>');
					}else{
						$('#curSeleServ').html('<?php echo $this->lang->line("slct_custmr_grp")?>');
						i = 0;
					}
					
				}
				
		})
	}
	
	
</script>
<script type="text/javascript">
function addNewSetting(){
	$('#btnAddPromo, #emailmrktnsetting').toggle();
}


function addNewPromotionCancel(){
	$('#btnAddPromo, #emailmrktnsetting').toggle();
	$('#Emailcategory').val(0);
	$('#TEmp_td').html('<?php echo $this->lang->line("selct_tmplt_cat")?>');
	$('#Customer_type').val(0);
	$('.mutliSelect').html('');
	$('#curSeleServ').html('');
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
				var settingId  = $('#hidden_id').val();
				var error = 0;
				//attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
				
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
				
				var Emailcategory = $("#Emailcategory").val();
				var Template = $("#Template").val();
				var Customer_type = $("#Customer_type").val();
				
				if(Emailcategory == 0 || Template == 0 || Customer_type == 0 || serviceArr == ''){
					if(Emailcategory == 0){
						$("#Emailcategory").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					}
					if(Template == 0){
						$("#Template").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					}
					if(Customer_type == 0){
						$("#Customer_type").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
					}
					if(serviceArr == ''){
						$(".dropdown dt a").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;'); 
					}
					return false;
				}	
					
				
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
					if(result == 0){
							window.location.href = SITE_URL+'admin/login';
					}else{
						//lightbox_body()
						var params = {'Emailcategory':Emailcategory,'Template':Template,'Customer_type':Customer_type,'CusArr':serviceArr,'settingId':settingId};
						$.ajax({
							type: 'POST',
							data: params,
							url:BASE_URL+"/admin/emailmarketing_setting/savepromo",
							success:function(datas){;
								if(datas)
									closeLightbox_body();
									location.reload();	
									//alert(datas);
									
							}
						});
				 }
				}
			})
	}





$( document ).ready(function() {
	
	
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
		$('#curSeleServ').html(cCount+' <?php echo $this->lang->line("servc_slctd")?>');
	}else{
		$('.mutliSelect input[type="checkbox"]').removeProp( "checked" );
		$('#curSeleServ').html('<?php echo $this->lang->line("slct_srvc")?>');
	}
}else{
	var cCount =0;
	$('.mutliSelect input[type="checkbox"]').each(function() {
		if(this.checked == true){
			cCount++;
		}
	});
	if(cCount == 0){
		$('#curSeleServ').html('Select service');
	}else{
		$('#curSeleServ').html(cCount+' Service selected');
	}
}

$('.dropdown a').removeAttr('style');
});

$('.required').change(function(){
	$(this).removeAttr('style');
})

</script>

<script>
	
	function openEditWindow(settingid){
		
		
		$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
			if(result == 0){
					window.location.href = SITE_URL+'admin/login';
			}else{
				//lightbox_body()
				$.ajax({
				type: 'POST',
				data: {'SettingId':settingid},
				url:BASE_URL+"/admin/emailmarketing_setting/GetDataForEdit",
				success:function(datas){
					if(datas){
						//alert(datas);
						//return false;
						closeLightbox_body();
						var obj = $.parseJSON(datas);
						
						$('#btnAddPromo, #emailmrktnsetting').show();
						$('#head').html('<?php echo $this->lang->line("edit_setting")?>');
						$('#btnAddPromo').hide();
						$("#Emailcategory").val(obj[0].emlmrktn_cat_id);
						GetTemplate(obj[0].app_emlmrktn_tem_id);
						$("#Customer_type").val(obj[0].customertype_id);
						var customerIds = $.parseJSON(obj[0].customer_ids);
						GetCustomers(customerIds);
						
						//alert($.parseJSON(obj[0].customer_ids));
					/*	for(var i=0;i<customerIds.length;i++){
							//$("#chk_box_"+customerIds[i]).prop('checked',true);
							alert(customerIds[i]);
							document.getElementById("chk_box_"+customerIds[i]).checked=true;
						}*/
						$('#curSeleServ').html(customerIds.length+' <?php echo $this->lang->line("servc_slctd")?>');
						$('#hidden_id').val(obj[0].emlmrktn_setting_id);
						
						return false;
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
						var action = confirm("<?php echo $this->lang->line('r_u_want_to_del')?>");
						if(action == true){
			
							lightbox_body()
							$.ajax({
								type: 'POST',
								data: {'settingId':id},
								url:BASE_URL+"/admin/emailmarketing_setting/DeleteSetting",
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
	
	
</script -->