<script type="text/javascript">
	$(document).ready(function() {
		$('#afterClick_password #old').focus(function(){
			$("#error_old").html('');
		});
		$("#cus_name_search").focus(function () {
		   $("#cus_name_search").removeClass("blank_error").addClass("search-filed");
		});
	});

	function clr_reg_values(obj_id){
           $('#'+obj_id).next().html('');

           if(obj_id =='cus_fname_2'){
               if($('#'+obj_id).val() == 'First Name'){
                   $('#'+obj_id).val("");
               }
           }

           if(obj_id =='cus_lname_3'){
               if($('#'+obj_id).val() == 'Last Name'){
                   $('#'+obj_id).val("");
               }
           }
           if(obj_id =='cus_zip_8'){
               if($('#'+obj_id).val() == 'Zip'){
                   $('#'+obj_id).val("");
               }
           }
	}
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#add_customer").hide();
	$("#select_customer").hide();
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$("#history").hide();
});

function st(id){
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
					type: 'POST',
					datatype:'html',
					url:"<?php echo site_url('admin/customer/ajax_check1'); ?>",
					data:"id="+id,
					success:function(rdata){
						var data = rdata.split("@@@");
						$("#cus_regionid_6").html(data[0]);
						$("#cus_cityid_7").html(data[1]);
					}
				});
		}
	}  
});
}

function re(id){	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
				type: 'POST',
				datatype:'html',
				url:"<?php echo site_url('admin/customer/ajax_region_check1'); ?>",
				data:"id="+id,
				success:function(rdata){
					$("#cus_cityid_7").html(rdata);
				}
				});
		}
	}  
});
}

function enterKeySubmission(e){
    if (e.keyCode == 13) {
        var tb = document.getElementById("cus_name_search");
        var cus_name_search = tb.value;
        if(cus_name_search != ''){   
            lightbox_body()
	        $.ajax({
		        url: SITE_URL+"page/fn_checkLogInAdmin",
		        type: "post",
		        success: function(result){
		            //check login start
			        if(result == 0){
                        closeLightbox_body()
				        window.location.href = SITE_URL+'admin/login';
			        }else{
				        $.ajax({
				            type: 'POST',
				            datatype:'html',
				            url:"<?php echo site_url('admin/customer/searchCustomerAjax'); ?>",
				            data:"cus_name_search="+cus_name_search,
				            success:function(rdata){
                                closeLightbox_body()
	                            if($.trim(rdata) == "") {
	                                var str = "<?php echo $this->lang->line('no_record_found');?>";
	                                $("#show_all_customer").html(str);
	               //pr                 $('#scrollbar1').tinyscrollbar_update('relative');
	                            } else {
	                                //$('#scrollbar1').tinyscrollbar();
	                                $("#show_all_customer").html(rdata);
	                  //pr              $('#scrollbar1').tinyscrollbar_update('relative');
	                            }
				            }
			            });
			        }
		        }  
	        });
	    }else{
            $("#cus_name_search").removeClass("search-filed").addClass("blank_error");
	    }
        e.preventDefault();
    }
}
function search_customer(){
    var cus_name_search1=$("#cus_name_search").val();
    var cus_name_search=$.trim(cus_name_search1);
	if(cus_name_search != ''){   
        lightbox_body()
	    $.ajax({
		    url: SITE_URL+"page/fn_checkLogInAdmin",
		    type: "post",
		    success: function(result){
			    if(result == 0){
                    closeLightbox_body()
				    window.location.href = SITE_URL+'admin/login';
			    }else{
				    $.ajax({
				        type: 'POST',
				        datatype:'html',
				        url:"<?php echo site_url('admin/customer/searchCustomerAjax'); ?>",
				        data:"cus_name_search="+cus_name_search,
				        success:function(rdata){
                            closeLightbox_body()
	                        if($.trim(rdata) == "") {
	                            var str = "<?php echo $this->lang->line('no_record_found');?>";
	                            $("#show_all_customer").html(str);
	                 //pr           $('#scrollbar1').tinyscrollbar_update('relative');
	                        } else {
	                            //$('#scrollbar1').tinyscrollbar();
	                            $("#show_all_customer").html(rdata);
	                 //pr           $('#scrollbar1').tinyscrollbar_update('relative');
	                        }
				        }
			        });
			    }
		    }  
	    });
	}else{
        $("#cus_name_search").removeClass("search-filed").addClass("blank_error");
	}
}

function addCustomer(){
	$("#history").hide();
	$("#select_customer").hide();
	$("#add_customer_link").hide();
	$("#add_customer").show();
	$("#edit_cus_btn").hide();
	$("#add_cus_btn").show();
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$(".required_div").html(" ");
	$("#user_email_p").val('');
	$("#cus_address_4").val('');
	$("#cus_zip_8").val('Zip');
	$("#cus_phn1_10").val('');
	$("#customer_id").val(0);
    $("#cus_mob_9").val('');
    $("#cus_phn2_11").val('');
}

function verify_customer(id){	
cancelGroup();
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
				type: 'POST',
				data:"id="+id,
				url:"<?php echo site_url('admin/customer/verify_customerAjax'); ?>",
				success:function(rdata){
					if(rdata == 1){
						$("#verify_status").html('');
						$("#verify_status").html('<span>'+'<?php echo $this->lang->line("verified");?>'+'</span>');
					}
				}
			});
		}
	}  
});

}

function send_pass_to_customer(id){	
cancelGroup();
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			lightbox_body();
			$.ajax({
				type: 'POST',
				data:"id="+id,
				url:"<?php echo site_url('admin/customer/send_passAjax'); ?>",
				success:function(rdata){
					if(rdata == 1){
						closeLightbox_body();
						alert('<?php echo $this->lang->line("psswrd_hs_bn_snt_success_2_mail");?>');
					}
				}
			});
		}
	}  
});
}

function displayEditCustomer(customer_id){
cancelGroup();

<?php $this->session->userdata('user_name_customer'); ?>
	$("#select_customer").hide();
	$("#history").hide();
	$("#add_customer_link").hide();
	$("#add_customer").show();
	$("#add_cus_btn").hide();
	$("#edit_cus_btn").show();

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
				  datatype:'html',
				  url:"<?php echo site_url('admin/customer/displayEditCustomerAjax'); ?>",
				  data:"customer_id="+customer_id,
				   success:function(rdata){
					 var data = rdata.split("@@@");
					// alert(data[7]);
					// return false;
					 $("#cus_fname_2").val(data[0]);
					 $("#cus_lname_3").val(data[1]);
					 $("#user_email_p").val(data[2]);
		             $("#user_email_p").attr('disabled','disabled');
					 $("#cus_address_4").val(data[4]);
					 $("#cus_zip_8").val(data[8]);
					 $("#cus_mob_9").val(data[9]);
					 $("#cus_phn1_10").val(data[10])
					 $("#cus_phn2_11").val(data[11])
					 $("#time_zone_id_21").val(data[12])
		             $("#cus_approval_id_22").html(data[18])
					 $("#cus_cityid_7").html(data[17]);
					 $("#cus_regionid_6").html(data[16]);
					 $("#cus_countryid_5").html(data[15]);
					 $("#customer_id").val(customer_id);
					 closeLightbox_body();
					}
			});	
		}
	}  
});
}

function hideAddCustomer(){
 //   $("#add_customer").hide();
  //  $("#add_customer_link").show();
 //   $("#select_customer").hide();
  //  $("#user_email_p").removeAttr("disabled");
  //  $("#loader").html('');
 	location.reload();
}

function addTagShow(){
	$("#add_tag_text").show();
	$("#add_tag_div").hide();
	$("#tag_div").hide();
}
function cancelTag(){
	$("#add_tag_text").hide();
	$("#add_tag_div").show();
	$("#tag_div").show();
}

function addinfoShow(){
	$("#add_info_text").show();
	$("#add_info_div").hide();
	$("#info_div").hide();
}
function cancelinfo(){
	$("#add_info_text").hide();
	$("#add_info_div").show();
	$("#info_div").show();
}

function selectCustomer(customer_id){
	cancelGroup();
	$("#upcoming_appointments_link1").addClass("select");
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$("#add_info_div").show();
	$("#add_tag_div").show();
	$("#history").show();
	$("#past_appointments").hide();
	$("#payments").hide();
	$("#tag_div").show();
	$("#info_div").show();
	$("#past_appointments").html("");
	lightbox_body()
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
            closeLightbox_body()
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
		  type: 'POST',
		   dataType: "html",
		  url:"<?php echo site_url('admin/customer/selectCustomerAjax'); ?>",
		  data:"customer_id="+customer_id,
		  success:function(rdata){
		  	
		  	 var Arr = rdata.split('@@'); 
		  	// alert(Arr.length);
		  	// alert(Arr[0]);
		  	// return false;
             closeLightbox_body()
             $("#customer_id").val(Arr[16]);
             if(Arr[15] == 1){	
			 $("#add_customer").hide();
			 $("#add_customer_link").show();
             $("#select_customer").show();
			 }
			 $("#1st_name").html(Arr[0]);
			 $("#last_name").html(Arr[1]);
			 $("#user_email").html(Arr[13]);
			 $("#link").html(Arr[17]);
			 $("#cus_address").html(Arr[2]);
			 $("#cus_city").html(Arr[3]);
			 $("#cus_region").html(Arr[4]);
			 $("#cus_country").html(Arr[5]);
			 $("#cus_zip").html(Arr[6]);
			 $("#cus_mob").html(Arr[7]);
			 $("#cus_phn1").html(Arr[8]);
			 $("#cus_phn2").html(Arr[9]);
			 $("#tag_div").html(Arr[10]);
			 $("#tag").val(Arr[10]);
			 $("#info_div").html(Arr[11]);
			 $("#info").val(Arr[11]);
			 
			 
			                         
             if($("#info_div").html().length==0){
                 $("#add_info_div a").html("<?php echo $this->global_mod->db_parse($this->lang->line('add_info'));?>");
                 $("#add").html("<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?>");
             }else{
                 $("#add_info_div a").html("<?php echo $this->global_mod->db_parse($this->lang->line('edit_info'));?>");
                 $("#add").html("<?php echo $this->global_mod->db_parse($this->lang->line('update_btn'));?>");
             }
             
             if($("#tag_div").html().length==0){
                 $("#tag_div").hide();
             }else{
                 $("#tag_div").show();
             }
             //////////////////////////////////////////////
			$("#upcoming_appointments").show();
			$("#past_appointments").hide();
			$("#payments").hide();
			$("#upcoming_appointments_link1").addClass("select");
			$("#past_appointments_link1").removeClass('select');
			$("#payments_link1").removeClass('select');
			$.ajax({
				type: 'POST',
				datatype:'html',
				url:"<?php echo site_url('admin/customer/upcomingAppointmentsAjax'); ?>",
				data:"customer_id="+customer_id,
				success:function(rdata){
				 $("#upcoming_appointments").html(rdata);
				}
			});
             ////////////////////////////////////////////////
             
		   }
		});
		}
	}  
});
		
			
			
}


function inviteCustomer(customer_id){
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			lightbox_body();
			$.ajax({
				type: 'POST',
				datatype:'html',
				url:"<?php echo site_url('admin/customer/inviteCustomerAjax'); ?>",
				data:"customer_id="+customer_id,
				success:function(rdata){
				  	closeLightbox_body();
					alert("<?php echo $this->lang->line('invitation_mail_sent');?>");
				}
			});
		}
	}  
});
	

}

function addNewCustomer(){
	var ajaxDataString = "";
	var errorcount = 0;
	var cus_address_4				= 		$("#cus_address_4").val();
	var user_email					=		$("#user_email_p").val();
	ajaxDataString = ajaxDataString+"user_email="+$.trim(user_email);
	var customer_id					=$("#customer_id").val();
	ajaxDataString = ajaxDataString+"&customer_id="+customer_id;
	
	var charexp = /^[a-zA-Z\u00E0\u00C0\u00E2\u00C2\u00E4\u00C4\u00E1\u00C1\u00E9\u00C9\u00E8\u00C8\u00EA\u00CA\u00EB\u00CB\u00EC\u00CC\u00EE\u00CE\u00EF\u00CF\u00F2\u00D2\u00F4\u00D4\u00F6\u00D6\u00F9\u00D9\u00FB\u00DB\u00FC\u00DC\u00E7\u00C7\u00F1]*$/;
	
		var cus_fname_2 = $("#cus_fname_2").val();
		
		if(cus_fname_2 == "First Name" || $.trim(cus_fname_2) == "" ){
		    $("#cus_fname_div").html("<?php echo $this->lang->line('required_fld');?>");
		    errorcount++;
		}
		
	/*	if(!charexp.test(cus_fname_2)){
		    $("#cus_fname_div").html("<?php echo $this->lang->line('only_char_allowed');?>");
		    errorcount++;
		}*/
		ajaxDataString = ajaxDataString+"&cus_fname_2="+$.trim(cus_fname_2);
	
	
		
	
	<?php if($checkFieldstatus['cus_lname'] == 1 ){ ?>
		var cus_lname_3=$("#cus_lname_3").val();
		if(cus_lname_3 =="Last Name" || $.trim(cus_lname_3) =="" ){
		    $("#cus_lname_div").html("<?php echo $this->lang->line('required_fld');?>");
		    errorcount++;
		}
	/*	if(!charexp.test(cus_lname_3)){
		    $("#cus_lname_div").html("<?php echo $this->lang->line('only_char_allowed');?>");
		    errorcount++;
		}*/
		ajaxDataString = ajaxDataString+"&cus_lname_3="+$.trim(cus_lname_3);
	<?php } ?>
	

	
		if($.trim(user_email) == ""){
		        $("#user_email_p_div").html("<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'));?>");
		        errorcount++;
		}
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( user_email ) ){
            $("#user_email_p_div").html("<?php echo $this->global_mod->db_parse($this->lang->line('entr_valid_email'));?>");
            errorcount++;
        }
        
        var cus_mob_9=$("#cus_mob_9").val();
      /*  if($.trim($("#cus_mob_9").val())!==''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_mob_9').val()))
            {
                $('#cus_phn1_10_div').html('<?php echo $this->lang->line("mo_hs_2_b_numeric");?>');
                errorcount++;
            }
        }*/
       
        var cus_phn1_10=$("#cus_phn1_10").val();
       /* if($.trim($("#cus_phn1_10").val())!==''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn1_10').val()))
            {
                $('#cus_phn1_11_div').html('<?php echo $this->lang->line("ph_hs_2_b_numeric");?>');
                errorcount++;
            }
        }*/
       
		var cus_phn2_11=$("#cus_phn2_11").val();
		/*if($.trim($("#cus_phn2_11").val())!==''){
		    var numexp = /^[0-9]+$/;
		    if(!numexp.test($('#cus_phn2_11').val())){
		        $('#cus_phn1_12_div').html('<?php echo $this->lang->line("ph_hs_2_b_numeric");?>');
		        errorcount++;
		    }
		}*/
        
		var cus_countryid_5=$("#cus_countryid_5").val();
		/*if($.trim(cus_countryid_5) == ""){
		        $("#cus_countryid_5_div").html("<?php echo $this->lang->line('required_fld');?>");
		        errorcount++;
		}*/
		var cus_regionid_6=$("#cus_regionid_6").val();
		/*if($.trim(cus_regionid_6) == ""){
		    $("#cus_regionid_6_div").html("<?php echo $this->lang->line('required_fld');?>");
		    errorcount++;
		}*/
		var cus_cityid_7=$("#cus_cityid_7").val();
		/*if($.trim(cus_cityid_7) == ""){
		        $("#cus_cityid_7_div").html("<?php echo $this->lang->line('required_fld');?>");
		        errorcount++;
		}*/
        var time_zone_id_21=$("#time_zone_id_21").val();
		/*if($.trim(time_zone_id_21) == ""){
		    $("#cus_time_zone_id_21_div").html("<?php echo $this->lang->line('required_fld');?>");
		    errorcount++;
		}*/
        var cus_approval_id_22=$("#cus_approval_id_22").val();
		/*if($.trim(cus_approval_id_22) == ""){
		    $("#cus_approval_id_22_div").html("<?php echo $this->lang->line('required_fld');?>");
		    errorcount++;
		}*/
        var cus_zip_8=$("#cus_zip_8").val();
       /* if($.trim(cus_zip_8) == "Zip" || $.trim(cus_zip_8) == ""){
            $('#cus_zip_8_div').html('<?php echo $this->lang->line('required_fld');?>');
            errorcount++;
        }*/
		
		if(errorcount > 0){
		    return false;
		}

     //  	alert(ajaxDataString);
		
		ajaxDataString = ajaxDataString+"&cus_address_4="+$.trim(cus_address_4);
		ajaxDataString = ajaxDataString+"&cus_countryid_5="+$.trim(cus_countryid_5);
		ajaxDataString = ajaxDataString+"&cus_regionid_6="+$.trim(cus_regionid_6);
		ajaxDataString = ajaxDataString+"&cus_cityid_7="+$.trim(cus_cityid_7);
		ajaxDataString = ajaxDataString+"&cus_mob_9="+$.trim(cus_mob_9);
		ajaxDataString = ajaxDataString+"&cus_phn1_10="+$.trim(cus_phn1_10);
		ajaxDataString = ajaxDataString+"&cus_phn2_11="+$.trim(cus_phn2_11);
		ajaxDataString = ajaxDataString+"&time_zone_id_21="+$.trim(time_zone_id_21);
		ajaxDataString = ajaxDataString+"&cus_approval_id_22="+$.trim(cus_approval_id_22);
		
	
	var cus_zip_8=$("#cus_zip_8").val();
       /* if($.trim($("#cus_zip_8").val())!==''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_zip_8').val()))
            {
                $('#cus_zip_8_div').html('<?php echo $this->lang->line("zip_hs_2_b_numeric");?>');
                return false;

            }
        }*/
	ajaxDataString = ajaxDataString+"&cus_zip_8="+$.trim(cus_zip_8);
	
 //  console.log(ajaxDataString);    
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
            url:"<?php echo site_url('admin/customer/checkEmail'); ?>",
            data:"email_id="+user_email,
            success:function(rdata)
            {
                if(customer_id != 0){
                    rdata = 1;
                }
                if(rdata!=1){
                    $("#user_email_p_div").html("<?php echo $this->global_mod->db_parse($this->lang->line('email_alrdy_registered'));?>");
                    return false;
                }else{
                    $('#loader').html('<img src="'+SITE_URL+'/asset/wait_a_min.gif" height="15" width="15" />')
                  	lightbox_body()
                    $.ajax({
                            type: 'POST',
                            datatype:'html',
                            url:"<?php echo site_url('admin/customer/customerAddajax');?>",
                            data:ajaxDataString,
                            success:function(rdata){
                              closeLightbox_body();
                              alert("<?php echo $this->global_mod->db_parse($this->lang->line('data_updated_success'));?>");
                              window.location.reload();
                            }
                    });
                }
            }
        });
		}
	}  
});
}
</script>
<script>
function deleteCustomer(customer_id){
	var conBox = confirm("<?php echo $this->lang->line('r_u_want_to_del');?> " + name+" ?");
	if(conBox){
		
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			lightbox_body();
			$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/deleteCustomerAjax'); ?>",
			  data:"customer_id="+customer_id,
			  success:function(rdata){
				 $("#history").hide();
				 $("#select_customer").hide();
				 closeLightbox_body();
				 alert("<?php echo $this->lang->line('del_success');?>");
				 $("#show_all_customer").html(rdata);
				 $('#scrollbar1').tinyscrollbar();
			  }
		});
		}
	}  
});
	}else{
		return;
	}
}
</script>
<script>
function deleteCustomerCt(customer_id){
	var conBox = confirm("<?php echo $this->lang->line('r_u_want_to_del');?>");
	if(conBox){
		
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			lightbox_body();
			$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/deleteCustomerAjax'); ?>",
			  data:"customer_id="+customer_id,
			  success:function(rdata){
				 closeLightbox_body();
				 alert("<?php echo $this->lang->line('del_success');?>");
				  location.reload();
			  }
		});
		}
	}  
});
	}else{
		return;
	}
}
</script>
<script>
function addTag()
{
	$("#add_tag_text").hide();
	$("#tag_div").show();
	$("#add_tag_div").show();
	var tag=$("#tag").val();
	var customer_id=$("#customer_id").val();
	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
			  type: 'POST',
			  datatype:'json',
			  url:"<?php echo site_url('admin/customer/addTagAjax'); ?>",
			  data:"tag="+tag+"&customer_id="+customer_id,
			  success:function(rdata){
				 $("#tag_div").html(rdata);
			  }
			});
		}
	}  
});
}
</script>
<script>
function addInfo()
{
	$("#info_div").show();
	$("#add_info_text").hide();
	$("#add_info_div").show();
	var info=$("#info").val();
	var customer_id=$("#customer_id").val();
	
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
				  datatype:'json',
				  url:"<?php echo site_url('admin/customer/addInfoAjax'); ?>",
				  data:"info="+info+"&customer_id="+customer_id,
				  success:function(rdata){
					 $("#info_div").html(rdata);
				  }
			});
		}
	}  
});
}
</script>
<script>
function upcomingAppointments(){
	$("#upcoming_appointments").show();
	$("#past_appointments").hide();
	$("#payments").hide();
	$("#upcoming_appointments_link1").addClass("select");
	$("#past_appointments_link1").removeClass('select');
	$("#payments_link1").removeClass('select');

	var customer_id=$("#customer_id").val();
	
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
				  url:"<?php echo site_url('admin/customer/upcomingAppointmentsAjax'); ?>",
				  data:"customer_id="+customer_id,
				  success:function(rdata){
					 $("#upcoming_appointments").html(rdata);
				  }
			});
		}
	//check login end
	}  
});
}
</script>
<script>
function pastAppointments(){
	$("#past_appointments").show();
	$("#upcoming_appointments").hide();
	$("#payments").hide();
	$("#past_appointments_link1").addClass("select");
	$("#payments_link1").removeClass('select');
	$("#upcoming_appointments_link1").removeClass('select');
	var customer_id=$("#customer_id").val();
	
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
				  url:"<?php echo site_url('admin/customer/pastAppointmentsAjax'); ?>",
				  data:"customer_id="+customer_id,
				  success:function(rdata){
					 $("#past_appointments").html(rdata);
				  }
			});
		}
	//check login end
	}  
});
}
</script>
<script>
function payments(){
	$("#payments").show();
	$("#upcoming_appointments").hide();
	$("#past_appointments").hide();
	$("#payments_link1").addClass("select");
	$("#past_appointments_link1").removeClass('select');
	$("#upcoming_appointments_link1").removeClass('select');
}
</script>
<script type="text/javascript">
function cancelGroup(){
	$('.contactDetails').show();
	$('#grouptypediv').html('');
	$('#personalDetails').html('');
	cancel_change();
}
function change_password(){
cancelGroup();	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				lightbox_body();
				$.ajax({
					  type: 'POST',
					  datatype:'html',
					  url:"<?php echo site_url('admin/customer/change_password'); ?>",
					  //data:"name="+email,
				      success:function(rdata){
							$("#change_password").hide();
							$("#afterClick_password").show();
							$("#afterClick_password").css({ 'display': 'block'});
							$("#afterClick_password").html(rdata);
							closeLightbox_body();
						}


	});
		}
	//check login end
	}  
});
}

function cancel_change(){
	 $("#change_password").show();
	 $("#afterClick_password").hide();
 }
function hide_err_or(val){
	 //alert(val);
	 if(val == "old"){
		  $("#error_old").html('');
	 }
	 if(val == "new"){
		  $("#error_new").html('');
	 }
	 if(val == "confirm"){
		  $("#error_confirm").html('');
	 }
 }
function confirm_password(){
	var customer_id = $("#customer_id_val").val();
	var old_password=$("#old").val();
    var new_password=$("#new").val();
	var confirm_password=$("#confirm").val();
    var minimum=5;

   if($.trim(new_password)==''){
	   $("#error_old").hide();
	   $("#error_new").show();
	   $("#error_new").html('<?php echo $this->lang->line("required_fld");?>');
   }else if(new_password.length<=minimum){
	   $("#error_new").html('<?php echo $this->lang->line("psswrd_lngth_shld_b_min_6");?>');
   }else if(confirm_password==''){
		$("#error_new").hide()
		$("#error_confirm").show();
		$("#error_confirm").html('<?php echo $this->lang->line("required_fld");?>');
   }else if(confirm_password.length<=minimum){
	   $("#error_confirm").html('<?php echo $this->lang->line("psswrd_lngth_shld_b_min_6");?>');
   }else if(confirm_password!=new_password){
		$("#error_new").show();
		$("#error_new").html('<?php echo $this->lang->line("nw_psswrd_does_nt_mtch");?>');
		$("#error_confirm").html('<?php echo $this->lang->line("cnfrm_psswrd_does_nt_mtch");?>');
   }else{
		
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			lightbox_body()
			 $.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/save_password'); ?>",
			  /*data:"old="+old_password+"&new="+new_password+"&customer_id="+customer_id,*/
                          data:"new="+new_password+"&customer_id="+customer_id,
			  success:function(rdata){
			  	closeLightbox_body();
				//alert(rdata);
				$("#error_old").hide();
				$("#error_new").hide();
				$("#error_confirm").hide();
				if(rdata==1){
					$("#change_password").show();
					$("#afterClick_password").css('display','none');
					cancel_change();
					$("#success").show();
					alert("<?php echo $this->lang->line('psswrd_chnge');?>");
					//$("#success").html("password changed");
				}else{
					$("#error_old").show();
					$("#error_old").html('<?php echo $this->lang->line("pls_crrctly_entr_ur_crrnt_psswrd");?>');
				}
			}
			});
		}
	//check login end
	}  
});
	}

   }

</script>

<script>
function show_all_customers(){
lightbox_body()
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	    //check login start
		if(result == 0){
            closeLightbox_body()
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
				type: 'POST',
				url:"<?php echo site_url('admin/customer/showall_customerAjax'); ?>",
				success:function(rdata){
                    closeLightbox_body()
		            $("#show_all_customer").html("");
		            $("#show_all_customer").html(rdata);
		            $("#cus_name_search").val("");
	//pr	            $('#scrollbar1').tinyscrollbar_update('relative');
		            $("#cus_name_search").removeClass("blank_error").addClass("search-filed");
				}
			});	
		}
	//check login end
	}  
});

}
 //CB#SOG#28-1-2013#PR#E
</script>
<script>
function alpha_search(key){
	$('#cus_name_search').val(key);

var cus_name_search=$.trim(key);
	if(cus_name_search != ''){

lightbox_body()
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
            closeLightbox_body()
			window.location.href = SITE_URL+'admin/login';
		}else{
                $.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/searchCustomerAjax'); ?>",
			  data:"cus_name_search="+cus_name_search,
			  success:function(rdata)
			  {
                // alert(rdata);
                closeLightbox_body()
                if($.trim(rdata) == "") {
                    var str = "<?php echo $this->lang->line('no_data_found');?>";
                    $("#show_all_customer").html(str);
     //pr               $('#scrollbar1').tinyscrollbar_update('relative');
                } else {
                //$('#scrollbar1').tinyscrollbar();
                $("#show_all_customer").html(rdata);
    //pr            $('#scrollbar1').tinyscrollbar_update('relative');

                }

			  }
		});
		}
	//check login end
	}  
});
	}else{
            //alert("Plese Enter Something");
            $("#cus_name_search").removeClass("search-filed").addClass("blank_error");
	}


}
function exporton(){
    location.href = "<?php echo site_url('admin/customer/export_excel_csv'); ?>" ;
 }
function check_mail(email){
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
		        url:"<?php echo site_url('admin/customer/checkEmail'); ?>",
		        data:"email_id="+email,
		        success:function(rdata)
		        {
		            alert(rdata); 
		        }
		    });
		}
	//check login end
	}  
});
    
} 
</script>
<script>
function addEditGroup(cust_id){
cancelGroup()
$('.contactDetails').hide();
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
			datatype:'html',
			url:"<?php echo site_url('admin/customer/selectGroup'); ?>",
			data:"&customer_id="+cust_id,
			success:function(rdata){
				closeLightbox_body();
				$('#grouptypediv').html(rdata);

		}
		});
	}
}  
});

}
function personalDetails(cust_id){
cancelGroup()
$('.contactDetails').hide();
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
					datatype:'html',
					url:"<?php echo site_url('admin/customer/personalDetails'); ?>",
					data:"&customer_id="+cust_id,
					success:function(rdata){
						closeLightbox_body();
						$('#personalDetails').html(rdata);
				}
				});
			}
		}  
	});
}

function savePersonalDetails(customerId){
	var birth		= $('#birth_'+customerId).val();
	var anniversary	= $('#anniversary_'+customerId).val();
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
					datatype:'html',
					url:"<?php echo site_url('admin/customer/savePersonalDetails'); ?>",
					data:"&customer_id="+customerId+"&customer_birth="+birth+"&customer_anniversary="+anniversary,
					success:function(rdata){
						closeLightbox_body();
						cancelGroup()
				}
				});
			}
		}  
	});	
}

function saveSelectGroup(customerId){
	var workId = Array();
	var i=0;
	$('.grpClass').each(function() {	
		if($(this).is(':checked')) {
            workId[i]=$(this).val();
            i++;
         }
	});
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
					datatype:'html',
					url:"<?php echo site_url('admin/customer/saveSelectGroup'); ?>",
					data:"&customer_id="+customerId+"&groupIds="+workId,
					success:function(rdata){
						closeLightbox_body();
						cancelGroup()
				}
				});
			}
		}  
	});	
}

</script>