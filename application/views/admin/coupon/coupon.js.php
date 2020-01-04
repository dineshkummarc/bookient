<script language="javascript">
$(function() {
    $("#aplcbl_date_from").datepicker();
    $("#aplcbl_date_to").datepicker();
    $('#aplcbl_hour_from').timepicker({});
    $('#aplcbl_hour_to').timepicker({});


    $("#aplcbl_date_from_offer").datepicker();
    $("#aplcbl_date_to_offer").datepicker();
    $('#aplcbl_hour_from_offer').timepicker({});
    $('#aplcbl_hour_to_offer').timepicker({});
});

$(document).ready(function() {
    $('#aplcbl_date_from').focus(function(){
        $('#err_c').html('');
    });
    $('#aplcbl_date_to').focus(function(){
        $('#err_c').html('');
    });
    $('#aplcbl_date_from_offer').focus(function(){
        $('#err_c_offer').html('');
    });
    $('#aplcbl_date_to_offer').focus(function(){
        $('#err_c_offer').html('');
    });
    $('#aplcbl_hour_from').focus(function(){
        $('#err_tim').html('');
    });
    $('#aplcbl_hour_to').focus(function(){
        $('#err_tim').html('');
    });
    $('#aplcbl_hour_from_offer').focus(function(){
        $('#err_tim_offer').html('');
    });
    $('#aplcbl_hour_to_offer').focus(function(){
        $('#err_tim_offer').html('');
    });
    $('.ExpiredD').hide();
});

function showactive() {
    window.allhide();
    $('#list_item_details').show();
    $('.InactiveD').hide();
    $('.ActiveD').show();
    $('.ExpiredD').hide();
    if($("div:[class*=ActiveD]").length == 0){
        $('#norecords_for_active').show();
    }else{
        var act_div = $("div:[class*=ActiveD]").length;
        var exp_div = $("div.ActiveD.ExpiredD").length;
        if((act_div - exp_div ) < 1){
           $('#norecords_for_active').show();
        }
    }
}
function showInactive() {
    window.allhide();
    $('#list_item_details').show();
    $('.ActiveD').hide();
    $('.InactiveD').show();
    $('.ExpiredD').hide();
    if($("div:[class*=InactiveD]").length == 0){
        $('#norecords_for_inactive').show();
    }else {
        var in_act_div = $("div:[class*=InactiveD]").length;
        var in_exp_div = $("div.InactiveD.ExpiredD").length;
        if((in_act_div - in_exp_div ) < 1){
           $('#norecords_for_inactive').show();
        }
    }
}
function showAll() {
    window.allhide();
    $('#list_item_details').show();
    $('.InactiveD').show();
    $('.ActiveD').show();
    $('.ExpiredD').hide();
    var act_elems = $("div:[class*=ctiveD]").length;
    var exp_elems = $("div:[class~=ExpiredD]").length;

    if(act_elems-exp_elems < 1){
        $('#norecords_for_all').show();
    }
}
function showExpired() {
    window.allhide();
    $('#list_item_details').show();
    $('.InactiveD').hide();
    $('.ActiveD').hide();
    $('.ExpiredD').show();
    if($("div:[class*=ExpiredD]").length == 0){
        $('#norecords_for_expired').show();
    }
}
function allhide(){
    $('#norecords_for_inactive').hide();
    $('#norecords_for_active').hide();
    $('#norecords_for_all').hide();
    $('#norecords_for_expired').hide();
}
$(document).ready(function(){
    $("#hidediv").hide();
    $('#hidestaffdiscount').hide();
    $('#hidedatediscount').hide();

    $("#hidedivoffer").hide();
    $('#hidestaffoffer').hide();
    $('#hidedateoffer').hide();

    $('#offertable').hide();
    $('#discountcoupontable').hide();
    $('#discount_display_text').hide();
    $('#cover').hide();
    $.ajax({
        url: "<?php echo base_url(); ?>admin/coupon/GetRandomCode/1",
        type: "POST",
        success: function(msg){
            $('#coupon_code').val(msg);
        }
    });

    $('#button1').click(function(e){
        $('#discount_percent_type').html("");
        $('#discount_display_text').show();
		$('#submit_coupon_mode').val('add');
		blankFieldValue(1);
        $('#cover').show();
        var discountcoupontableDispSet = $('#discountcoupontable').css('display');
        var offertableDispSet = $('#offertable').css('display');
        if(discountcoupontableDispSet == 'none')
        {
            $('#offertable').hide();
            $('#discountcoupontable').show();
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'admin/login';
					}else{
						$.ajax({
				                url: "<?php echo base_url(); ?>admin/coupon/GetRandomCode/1",
				                type: "POST",
				                success: function(msg) {
				                    $('#coupon_code').val(msg);
				                }
				            });
					}
				//check login end
				}  
			});
        }else{
            $('#discountcoupontable').hide();
            $('#cover').hide();
            $("#first_time_use_only").attr('checked', false);
            $("#one_time_use_only").attr('checked', false);
        }
    });

    $('#button2').click(function(e){
        $('#discount_percent_type').html("Offer");
        $('#discount_display_text').show();
		$('#submit_offer_mode').val('add');
		blankFieldValue(2);
        $('#cover').show();
        var discountcoupontableDispSet = $('#discountcoupontable').css('display');
        var offertableDispSet = $('#offertable').css('display');
        if(offertableDispSet == 'none')
        {
            $('#discountcoupontable').hide();
            $('#offertable').show();
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'admin/login';
					}else{
						 $.ajax({
			                url: "<?php echo base_url(); ?>admin/coupon/GetRandomCode/2",
			                type: "POST",
			                success: function(msg) {
			                    $('#coupon_code_o').val(msg);
			                }
			            });
					}
				//check login end
				}  
			});
        }else{
            $('#offertable').hide();
            $('#cover').hide();
            $("#first_time_use_only_offer").attr('checked', false);
            $("#one_time_use_only_offer").attr('checked', false);
        }
    });
                        
    /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
    $('#discount_amnt').keyup(function () {
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
           this.value = this.value.replace(/[^0-9\.]/g, '');
        }
    });
    /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

    $('#submit_coupon').click(function(e){
        var $formId = $('#f1');
        var formAction = $formId.attr('action');
        var $error = $('<span class="error"></span>');
        var errorcount = 0;

        $('li',$formId).removeClass('error');
        $('span.error').remove();
        $('#f1 .required').each(function(){
            var inputVal = $(this).val();
            var $parentTag = $(this).parent();
            if($.trim(inputVal) == ''){
                $parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"));?>'));
                errorcount++;
            }
        });

        if(errorcount >0){
            return false;
        }

        var datearray =[];
        $('#f1 .datevali').each(function(){
                var inputVal = $(this).val();
                datearray.push(inputVal);
        });
        
        var discountAmt = $('#discount_amnt').val();
        var discountAmtSett = $('#discount_amnt_setting').val();
        if(discountAmtSett == 1 && discountAmt > 100){
            $('#cd_err').html('<?php echo $this->global_mod->db_parse($this->lang->line("discnt_mnt_shld_b_less"));?>');
            errorcount++;
            return false;
        }

        if((datearray[0] == "" & datearray[1] != "")||(datearray[0] != "" & datearray[1] == ""))
        {
            $('#err_c').html('<?php echo $this->global_mod->db_parse($this->lang->line("pls_fl_the_dts_prprly"));?>');
            errorcount++;
            return false;
        }

        var startDate = new Date(datearray[0]);
        var endDate = new Date(datearray[1]);
        if(endDate < startDate ) {
            $('#err_c').html('<?php echo $this->global_mod->db_parse($this->lang->line("end_dt_shld_b_grtr_thn_strt_dt"));?>');
            errorcount++;
            return false;
        }
        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        var time1 = $('#aplcbl_hour_from').val();
        var time2 = $('#aplcbl_hour_to').val();
        
        var timeStartHour = new Date("01/01/2007 " + time1).getHours();
        var timeEndHour = new Date("01/01/2007 " + time2).getHours();
        
        var timeStartMin = new Date("01/01/2007 " + time1).getMinutes();
        var timeEndMin = new Date("01/01/2007 " + time2).getMinutes();
        
        var hourDiff = timeEndHour - timeStartHour;
        var minDiff = timeEndMin - timeStartMin;
        if(time1 != "" && time2 != ""){
            if(hourDiff < 0){
                $('#err_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("end_tm_shld_b_grtr_thn_strt_tm"));?>');
                errorcount++;
                return false;
            }else if(hourDiff == 0){
                if(minDiff <= 0){
                    $('#err_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("end_tm_shld_b_grtr_thn_strt_tm"));?>');
                    errorcount++;
                    return false;
                }
            }
        }
        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        var timearray =[];
        $('#f1 .timevali').each(function(){
            var input_Val = $(this).val();
            timearray.push(input_Val);
        });
        if((timearray[0] == "" & timearray[1] != "")||(timearray[0] != "" & timearray[1] == "")){
            $('#err_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("pls_fl_time_proprly"));?>');
            errorcount++;
            return false;
        }

        e.preventDefault();
        if ($('span.error').length > 0) {
            $('span.error').each(function(){
                // Set the distance for the error animation
                var distance = 5;
                // Get the error dimensions
                var width = $(this).outerWidth();
                // Calculate starting position
                var start = width + distance;
                // Set the initial CSS
                $(this).show().css({
                    display: 'block',
                    opacity: 0,
                    right: -start+'px'
                })
                // Animate the error message
                .animate({
                    right: -width+'px',
                    opacity: 1
                }, 'slow');
            });
        }
        if( errorcount == 0)
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
			                url: $('#f1').attr('action'),
			                data: $('#f1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
			                success: function(data){
			                    //alert(data);
			                    $('#msg').html(data);
			                    $('.tampil_vr').text(data);
			                    window.location.reload(true);
			                }
			            });
					}
				//check login end
				}  
			});
        }
    });
    $('#submit_offer').click(function(e){
        var $formId = $('#f2');
        var formAction = $formId.attr('action');
        var $error = $('<span class="error"></span>');


        var errorcount = 0;

        $('li',$formId).removeClass('error');
        $('span.error').remove();
        $('#f2 .required').each(function(){
            var inputVal = $(this).val();
            var $parentTag = $(this).parent();
            if($.trim(inputVal) == ''){
                $parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"));?>'));
                errorcount++;
            }
        });

        if(errorcount > 0){
            return false;
        }

        var datearray =[];
        $('#f2 .datevalioffer').each(function(){
                var inputVal = $(this).val();
                datearray.push(inputVal);
        });

        var startDate = new Date(datearray[0]);
        var endDate = new Date(datearray[1]);
        if(endDate < startDate ) {
            $('#err_c_offer').html('<?php echo $this->global_mod->db_parse($this->lang->line("strt_dt_shld_b_grtr_thn_end_dt"));?>');
            errorcount++;
        }
                                
        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        var time1 = $('#aplcbl_hour_from_offer').val();
        var time2 = $('#aplcbl_hour_to_offer').val();
        
        var timeStartHour = new Date("01/01/2007 " + time1).getHours();
        var timeEndHour = new Date("01/01/2007 " + time2).getHours();
        
        var timeStartMin = new Date("01/01/2007 " + time1).getMinutes();
        var timeEndMin = new Date("01/01/2007 " + time2).getMinutes();
        
        var hourDiff = timeEndHour - timeStartHour;
        var minDiff = timeEndMin - timeStartMin;
        if(time1 != "" && time2 != ""){
            if(hourDiff < 0){
                $('#err_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("end_tm_shld_b_grtr_thn_strt_tm"));?>');
                errorcount++;
                return false;
            }else if(hourDiff == 0){
                if(minDiff <= 0){
                    $('#err_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("end_tm_shld_b_grtr_thn_strt_tm"));?>');
                    errorcount++;
                    return false;
                }
            }
        }
        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

        var timearray =[];
        $('#f2 .timevalioffer').each(function(){
            var input_Val = $(this).val();
            timearray.push(input_Val);
        });

        if((timearray[0] == "" & timearray[1] != "")||(timearray[0] != "" & timearray[1] == "")){
            $('#err_tim_offer').html('<?php echo $this->global_mod->db_parse($this->lang->line("pls_fl_time_proprly"));?>');
            errorcount++;
            return false;
        }
        e.preventDefault();

        if ($('span.error').length > 0) {
            $('span.error').each(function(){
                // Set the distance for the error animation
                var distance = 5;
                // Get the error dimensions
                var width = $(this).outerWidth();
                // Calculate starting position
                var start = width + distance;
                // Set the initial CSS
                $(this).show().css({
                    display: 'block',
                    opacity: 0,
                    right: -start+'px'
                })
                // Animate the error message
                .animate({
                    right: -width+'px',
                    opacity: 1
                }, 'slow');
            });
        }
        if(errorcount == 0)
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
			                url: $('#f2').attr('action'),
			                data: $('#f2').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
			                success: function(data){
			                   // alert(data);
			                    $('#msg_o').html(data);
			                    window.location.reload(true);
			                }
			            });
					}
				//check login end
				}  
			});
        }
    });

    $('.required').focus(function(){
        var $parent = $(this).parent();
        $parent.removeClass('error');
        $('span.error',$parent).fadeOut();
    });
});

function editCoupon(coupon_id,coupon_type){
		$('#discount_percent_type').html("");
        $('#discount_display_text').show();
        $('#cover').show();
        var discountcoupontableDispSet = $('#discountcoupontable').css('display');
        var offertableDispSet = $('#offertable').css('display');
        if(coupon_type == '1')
        {
            $('#offertable').hide();
            $('#discountcoupontable').show();
			$('#submit_coupon_mode').val('edit');
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'admin/login';
					}else{
						$.ajax({
				                url: "<?php echo base_url(); ?>admin/coupon/editCoupon/",
								data:{ "coupon_id" : coupon_id},
				                type: "POST",
				                success: function(msg) {
				                	
								//var objText = json_decode(msg);
								var objText = msg.split('@@');
								var length = objText.length;
									if(objText[2]=='1'){
										var formIdCoupon="#f1";
									}	
									else{
										var formIdCoupon="#f2";
									}		
									$(formIdCoupon).find('#coupon_id').val(objText[0]);						
									$(formIdCoupon).find('#coupon_code').val(objText[16]);
									$(formIdCoupon).find('#discount_amnt').val(objText[4]);
									$(formIdCoupon).find('#coupon_heading').val(objText[5]);
									$(formIdCoupon).find('#coupon_desc').val(objText[6]);		
									$(formIdCoupon).find('#coupon_img_url').val(objText[7]);
									
									if(objText.discount_amnt_setting !='0'){
										$(formIdCoupon).find('#discount_amnt_setting').val(objText[3]);
									}
									
									if(objText[21] == 1){
										$(formIdCoupon).find('#radio_ys').prop("checked", true);
										$(formIdCoupon).find('#terms_details_tbl').css('display','none');
									//	if(objText[2]=='1'){
											$(formIdCoupon).find('#terms_details_tbl').css('display','none');
											$(formIdCoupon).find('#coupon_works_over').val('');
											$(formIdCoupon).find('#aplcbl_date_from').datepicker();
											$(formIdCoupon).find('#aplcbl_date_to').datepicker();
											$(formIdCoupon).find('#aplcbl_hour_from').val('');
											$(formIdCoupon).find('#aplcbl_hour_to').val('');
											$(formIdCoupon).find('#no_of_booking_possible').val('');
											$(formIdCoupon).find('#first_time_use_only').prop('checked', false);
											$(formIdCoupon).find('#one_time_use_only').prop('checked', false);
											$(formIdCoupon).find('.checkbox').prop('checked', false);
											$(formIdCoupon).find('.staff_checkbox').prop('checked', false);
											$(formIdCoupon).find('.date_checkbox').prop('checked', false);
											
									/*	}
										else{
											$('#terms_details_ofr_tbl').css('display','none');
										}*/
									}else{
										$('#radio_no').prop("checked", true);
										$(formIdCoupon).find('#coupon_works_over').val(objText[8]);
										
										if(objText[11] !='0' || objText[11] !='01/01/70'){
											$(formIdCoupon).find('#aplcbl_date_from').val(objText[11]);
										}else{
											$(formIdCoupon).find('#aplcbl_date_from').datepicker();
										}
										if(objText[12] !='0' || objText[12] != '01/01/70'){
											$(formIdCoupon).find('#aplcbl_date_to').val(objText[12]);
										}else{
											$(formIdCoupon).find('#aplcbl_date_to').datepicker();
										}
										if(objText[13] !='0'){
											$(formIdCoupon).find('#aplcbl_hour_from').val(objText[13]);
										}
										if(objText[14] !='0'){
											$(formIdCoupon).find('#aplcbl_hour_to').val(objText[14]);
										}
										if(objText[19] !='0'){
											$(formIdCoupon).find('#no_of_booking_possible').val(objText[19]);
										}
										if(objText[17] !='0'){
											$(formIdCoupon).find('#first_time_use_only').prop('checked', true);
										}
										if(objText[18] !='0'){
											$(formIdCoupon).find('#one_time_use_only').prop('checked', true);
										}
										
										if(objText[9] !='0'){	
											var count_arr=0;
										/*	$.each(objText[9], function( key, value ) {
											
												$(formIdCoupon).find('#applicbl_services_for_'+value).prop('checked', true);
												//alert( key + ": " + value );
												count_arr=count_arr + 1;
											});	*/
											var arr = objText[9].split(',');	
											for(var i=0;i<arr.length-1;i++){
												$(formIdCoupon).find('#applicbl_services_for_'+arr[i]).prop('checked', true);
												count_arr=count_arr + 1;
											}
												
											$('#showdiv').html(count_arr+" service selected");								
										}
										else{		
											$('.checkbox').prop('checked', false);																		
											$('#showdiv').html("Any service");										
										}
										
																																				
										if(objText[10] !='0'){									
											var count_arr=0;
											var arr1 = objText[10].split(',');
											/*$.each( objText[10] , function( key, value ) {
												$(formIdCoupon).find('#aplcbl_emp_'+value).prop('checked', true);											
												count_arr=count_arr + 1;
											});		*/
											
											for(var i=0;i<arr1.length-1;i++){
												$(formIdCoupon).find('#aplcbl_emp_'+arr1[i]).prop('checked', true);
												count_arr=count_arr + 1;
											}
											
											$('#showstaffdiscount').html(count_arr+" Staff selected");								
										}
										else{		
											$('.staff_checkbox').prop('checked', false);																		
											$('#showstaffdiscount').html("Any Staff");										
										}
										
																										
										if(objText[15] !='0'){	
											var arr2 = objText[15].split(',');	
											var count_arr=0;
										/*	$.each( objText[15] , function( key, value ) {
												$(formIdCoupon).find('#aplcbl_days_on_week_'+value).prop('checked', true);	
												//$( "#f2" ).find('#aplcbl_days_on_week_'+value).prop('checked', true);
												//alert( key + ": " + value );
												count_arr=count_arr + 1;
											});	*/
											
											for(var i=0;i<arr2.length-1;i++){
												$(formIdCoupon).find('#aplcbl_days_on_week_'+arr2[i]).prop('checked', true);
												count_arr=count_arr + 1;
											}
												
											$('#showdatediscount').html(count_arr+" Date selected");								
										}
										else{		
											$('.date_checkbox').prop('checked', false);																		
											$('#showdatediscount').html("Any Date");										
										}
										
										
										displayServices();
										displayStaff();
										showstartdate();
										showenddate();
										showstarttime();
										showendtime();
										displayDate();
										firsttimeuse();
										onetimeuse();
										displayDiscount(objText[4]);
										displayTextHeadingDiscount(objText[5]);
										worksover(objText[8]);
										$("html, body").animate({ scrollTop: 0 }, 600);
									}	
				                    
				                }
				            });
					}
				//check login end
				}  
			});
			
        }else{
        	
            $('#discountcoupontable').hide();
			$('#offertable').show();
            $('#cover').show();
			$('#submit_offer_mode').val('edit');
            //$("#first_time_use_only").attr('checked', false);
           // $("#one_time_use_only").attr('checked', false);
		   $.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'admin/login';
					}else{
						$.ajax({
				                url: "<?php echo base_url(); ?>admin/coupon/editCoupon/",
								data:{ "coupon_id" : coupon_id},
				                type: "POST",
				                success: function(msg) {
									//alert(msg);
									//var obj = jQuery.parseJSON(msg);
									
									var objText = msg.split('@@');
									
									//var objText = obj;
									//alert(objText.length);
									//alert(objText[0]);
									if(objText[2]=='1'){
										var formIdCoupon="#f1";
									}	
									else{
										var formIdCoupon="#f2";
									}
									$(formIdCoupon).find('#coupon_id').val(objText[0]);								
									$(formIdCoupon).find('#coupon_code_o').val(objText[16]);
									$(formIdCoupon).find('#discount_amnt').val(objText[4]);
									$(formIdCoupon).find('#coupon_heading').val(objText[5]);
									$(formIdCoupon).find('#coupon_desc').val(objText[6]);		
									$(formIdCoupon).find('#coupon_img_url').val(objText[7]);
									
									if(objText[21] == 1){
										
										$(formIdCoupon).find('#radio_ys_discount').prop("checked", true)
										//if(objText[2]=='2'){
											$('#terms_details_ofr_tbl').css('display','none');
											$(formIdCoupon).find('#coupon_works_over').val('');
											//$(formIdCoupon).find('#aplcbl_date_from_offer').val('');
											
											$(formIdCoupon).find('#aplcbl_date_from_offer').datepicker();
											$(formIdCoupon).find('#aplcbl_date_to_offer').datepicker();
											
										//	$(formIdCoupon).find('#aplcbl_date_to_offer').val('');
											$(formIdCoupon).find('#no_of_booking_possible').val('');
											$(formIdCoupon).find('#first_time_use_only').prop('checked', false);
											$(formIdCoupon).find('#one_time_use_only').prop('checked', false);
											$(formIdCoupon).find('.checkbox_offer').prop('checked', false);
											$(formIdCoupon).find('.staff_checkbox_offer').prop('checked', false);
											$(formIdCoupon).find('.date_checkbox').prop('checked', false);
											$(formIdCoupon).find('#one_time_use_only_offer').prop('checked', false);
											$(formIdCoupon).find('#first_time_use_only_offer').prop('checked', false);
											
										//}
									}else{
									
										if(objText[3] !='0'){
											$(formIdCoupon).find('#discount_amnt_setting').val(objText[3]);
										}
										
										
										$(formIdCoupon).find('#coupon_works_over').val(objText[8]);
										
										if(objText[11] !='0' || objText[11] != '01/01/70'){
											$(formIdCoupon).find('#aplcbl_date_from_offer').val(objText[11]);
										}else{
											$(formIdCoupon).find('#aplcbl_date_from_offer').datepicker();
										}
										if(objText[12] !='0' || objText[12] != '01/01/70'){
											$(formIdCoupon).find('#aplcbl_date_to_offer').val(objText[12]);
										}else{
											$(formIdCoupon).find('#aplcbl_date_to_offer').datepicker();
										}
										if(objText[13] !='0'){
											$(formIdCoupon).find('#aplcbl_hour_from_offer').val(objText[13]);
										}
										if(objText[14] !='0'){
											$(formIdCoupon).find('#aplcbl_hour_to_offer').val(objText[14]);
										}
										if(objText[19] !='0'){
											$(formIdCoupon).find('#no_of_booking_possible').val(objText[19]);
										}
										if(objText[17] !='0'){
											$(formIdCoupon).find('#first_time_use_only_offer').prop('checked', true);
										}
										if(objText[18] !='0'){
											$(formIdCoupon).find('#one_time_use_only_offer').prop('checked', true);
										}
										
										
										
										if(objText[9] !='0'){									
											var count_arr=0;
											var a = objText[9].split(',');
											for(var i = 0;i<a.length-1;i++){
												$(formIdCoupon).find('#applicbl_services_for_'+a[i]).prop('checked', true);
												count_arr=count_arr + 1;
											}
										/*	$.each( objText.applicbl_services_for , function( key, value ) {
												$(formIdCoupon).find('#applicbl_services_for_'+value).prop('checked', true);
												//alert( key + ": " + value );
												count_arr=count_arr + 1;
											});	*/
											
												
											$('#showdivoffer').html(count_arr+" service selected");								
										}
										else{		
											$('.checkbox_offer').prop('checked', false);																		
											$('#showdivoffer').html("Any service");										
										}
										
										
										
										
										
										if(objText[10] !='0'){									
											var count_arr=0;
											var b = objText[10].split(',');
										/*	$.each( objText.aplcbl_emp , function( key, value ) {
												$(formIdCoupon).find('#aplcbl_emp_'+value).prop('checked', true);											
												count_arr=count_arr + 1;
											});		*/
											
											for(var i = 0;i<b.length-1;i++){
												$(formIdCoupon).find('#aplcbl_emp_'+b[i]).prop('checked', true);	
												count_arr=count_arr + 1;						
											}
											
											$('#showstaffoffer').html(count_arr+" Staff selected");								
										}
										else{		
											$('.staff_checkbox_offer').prop('checked', false);																		
											$('#showstaffoffer').html("Any Staff");										
										}
										
										
										if(objText[15] !='0'){									
											var count_arr=0;
											var c = objText[15].split(',');
											
										/*	$.each( objText.aplcbl_days_on_week , function( key, value ) {
												$(formIdCoupon).find('#aplcbl_days_on_week_'+value).prop('checked', true);	
												//$( "#f2" ).find('#aplcbl_days_on_week_'+value).prop('checked', true);
												//alert( key + ": " + value );
												count_arr=count_arr + 1;
											});		*/
											
											for(var i = 0;i<c.length-1;i++){
												$(formIdCoupon).find('#aplcbl_days_on_week_'+c[i]).prop('checked', true);	
												count_arr=count_arr + 1;
											}
											
											
											$('#showdateoffer').html(count_arr+" Date selected");								
										}
										else{		
											$('.date_checkbox_offer').prop('checked', false);																		
											$('#showdateoffer').html("Any Date");										
										}
										
										displayServicesoffer();
										displayStaffoffer();
										showstartofferdate();
										showendofferdate();
										showstartoffertime();
										showendoffertime();
										displayDateoffer();
										firsttimeuseoffer();
										onetimeuseoffer();
										displayDiscount(objText[4]);
										displayTextHeadingDiscount(objText[5]);
										worksover(objText[8]);
										
					                    $("html, body").animate({ scrollTop: 0 }, 600);
					                }
				                }
				            });
					}
				//check login end
				}  
			});
        }
		
	}
function blankFieldValue(coupon_type){
	
									
		if(coupon_type=='1'){
		var formIdCoupon="#f1";
		}	
		else{
		var formIdCoupon="#f2";
		}		
		$(formIdCoupon).find('#coupon_id').val('');						
		$(formIdCoupon).find('#discount_amnt').val('');
		$(formIdCoupon).find('#discount_amnt_setting').val(1);
		$(formIdCoupon).find('#coupon_heading').val('');
		$(formIdCoupon).find('#coupon_desc').val('');		
		$(formIdCoupon).find('#coupon_img_url').val('');																		
		$(formIdCoupon).find('#coupon_works_over').val('');
		$(formIdCoupon).find('#aplcbl_date_from').val('');
		$(formIdCoupon).find('#aplcbl_date_to').val('');
		$(formIdCoupon).find('#aplcbl_hour_from').val('');
		$(formIdCoupon).find('#aplcbl_hour_to').val('');
		$(formIdCoupon).find('#no_of_booking_possible').val('');
		$(formIdCoupon).find('#first_time_use_only').prop('checked', false);
		$(formIdCoupon).find('#one_time_use_only').prop('checked', false);
		$(formIdCoupon).find('#aplcbl_date_from_offer').val('');
		$(formIdCoupon).find('#aplcbl_date_to_offer').val('');
		$(formIdCoupon).find('#aplcbl_hour_from_offer').val('');
		$(formIdCoupon).find('#aplcbl_hour_to_offer').val('');
		$(formIdCoupon).find('#no_of_booking_possible').val('');
		$(formIdCoupon).find('#first_time_use_only_offer').prop('checked', false);
		$(formIdCoupon).find('#one_time_use_only_offer').prop('checked', false);
		$('.checkbox').prop('checked', false);																		
		$('#showdiv').html("Any service");										
		$('.staff_checkbox').prop('checked', false);																			
		$('#showstaffdiscount').html("Any Staff");										
		$('.date_checkbox').prop('checked', false);																		
		$('#showdatediscount').html("Any Date");
		$('#showstaffoffer').html("Any Staff");
		$('#showstaffoffer').html("Any Staff");
		$('#showdivoffer').html("Any service");	
		$('.date_checkbox_offer').prop('checked', false);	
		$('.staff_checkbox_offer').prop('checked', false);	
		$('.checkbox_offer').prop('checked', false);											
									
	}
function unSerData(serializedString){
			var str = decodeURI(serializedString);
			var pairs = str.split('&');
			var obj = {}, p, idx, val;
			for (var i=0, n=pairs.length; i < n; i++) {
			p = pairs[i].split('=');
			idx = p[0];
			 
			if (idx.indexOf("[]") == (idx.length - 2)) {
			// Eh um vetor
			var ind = idx.substring(0, idx.length-2)
			if (obj[ind] === undefined) {
			obj[ind] = [];
			}
			obj[ind].push(p[1]);
			}
			else {
			obj[idx] = p[1];
			}
			}
			return obj;
	}
function DeleteCoupon(CouponId){
	var TblId = "coupDispDivId"+CouponId;
	var r=confirm("<?php echo $this->global_mod->db_parse($this->lang->line('r_u_sure_u_wnt_to_del'));?>")
	if (r==true){	
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				$.ajax({
			    url: "<?php echo base_url(); ?>admin/coupon/deleteCoupon/"+CouponId,
			    type: "POST",
			    success: function(msg) {
				    if (msg == 1){
					    $("#"+TblId).remove();
				    }else{
					    alert('<?php echo $this->global_mod->db_parse($this->lang->line("sm_error_proc_ur_req"));?>');
				    }
			    }
		    });	
			}
		//check login end
		}  
	});
	}
}
function change_status_to_on(id,identifier){
    var status = 1;
   
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				 $.ajax({
			        url: "<?php echo base_url(); ?>admin/coupon/changeStatus/"+status+"/"+id,
			        type: "POST",
			        success: function(msg) {
			            if(msg == 1){
			                $("#on"+id).show();
			                $("#off"+id).hide();
			                $("#coupDispDivId"+id).css('background-color', 'none');
			                $("#coupDispDivId"+id).css('opacity', '100');
			                $("#coupDispscrollId"+id).css("overflow-x", "hidden");
			                $("#coupDispscrollId"+id).css("overflow-y", "auto");
			            }else{
			                alert('<?php echo $this->global_mod->db_parse($this->lang->line("sm_error_proc_ur_req"));?>');
			            }
			        }
			    });
			}
		//check login end
		}  
	});
}
function change_status_to_off(id,identifier){
    var status = 0;
   
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				 $.ajax({
				        url: "<?php echo base_url(); ?>admin/coupon/changeStatus/"+status+"/"+id,
				        type: "POST",
				        success: function(msg) {
				            if (msg == 1){
				                $("#on"+id).hide();
				                $("#off"+id).show();
				                $("#coupDispDivId"+id).css('background-color', '#b9b9b8');
				                $("#coupDispDivId"+id).css('opacity', '0.4');
				                $("#coupDispscrollId"+id).css("overflow", "hidden");
		//pr		                $("#coupDispDivId"+id).attr("class",newclass);
				            }else{
				                alert('<?php echo $this->global_mod->db_parse($this->lang->line("sm_error_proc_ur_req"));?>');
				            }
				        }
				    });
			}
		//check login end
		}  
	});
}
function change_status_to_on_offer(id,identifier){
    var status = 1;
   
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			 $.ajax({
			        url: "<?php echo base_url(); ?>admin/coupon/changeStatus/"+status+"/"+id,
			        type: "POST",
			        success: function(msg){
			            if (msg == 1){
			                $("#on"+id).show();
			                $("#off"+id).hide();
			                $("#coupDispDivId"+id).css('background-color', 'none');
			                $("#coupDispDivId"+id).css('opacity', '100');
			                $("#coupDispscrollId"+id).css("overflow-x", "hidden");
			                $("#coupDispscrollId"+id).css("overflow-y", "auto");
//pr			                $("#coupDispDivId"+id).attr("class",newclass);
			            }else{
			                alert('<?php echo $this->global_mod->db_parse($this->lang->line("sm_error_proc_ur_req"));?>');
			            }
			        }
			    });
		}
	//check login end
	}  
});
}
function change_status_to_off_offer(id,identifier){
    var status = 0;
   
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			 $.ajax({
		        url: "<?php echo base_url(); ?>admin/coupon/changeStatus/"+status+"/"+id,
		        type: "POST",
		        success: function(msg) {
		            if(msg == 1){
		                $("#on"+id).hide();
		                $("#off"+id).show();
		                $("#coupDispDivId"+id).css('background-color', '#b9b9b8');
		                $("#coupDispDivId"+id).css('opacity', '0.4');
		                $("#coupDispscrollId"+id).css("overflow", "hidden");
//pr		                $("#coupDispDivId"+id).attr("class",newclass);
		            }else{
		                alert('<?php echo $this->global_mod->db_parse($this->lang->line("sm_error_proc_ur_req"));?>');
		            }
		        }
		    });
		}
	//check login end
	}  
});
}
function showService(){
    $('#hidediv').show();
    $('#hidestaffdiscount').hide();
    $('#hidedatediscount').hide();
}
function hideService(){
    $('#hidediv').hide();
}
function showstaff(){
    $('#hidestaffdiscount').show();
    $('#hidediv').hide();
    $('#hidedatediscount').hide();
}
function hidestaff(){
    $('#hidestaffdiscount').hide();
}
function showdate(){
    $('#hidediv').hide();
    $('#hidedatediscount').show();
    $('#hidestaffdiscount').hide();
}

function hidedate(){
    $('#hidedatediscount').hide();
}

function displayServices(){
    $('#showservice').html("");
    var counter=0;
    $('#showdiv').html('');
    servicesArr = new Array();
    $("input:checkbox[class=checkbox]:checked").each(function(){
        var value1= $(this).val();
        servicesArr.push(value1);
        counter=counter +1;
    });
    if(counter  != 0){
        $('#showdiv').html(counter+" <?php echo $this->global_mod->db_parse($this->lang->line('srvice_slectd'));?>");

    }else{
        $('#showdiv').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_srvices'));?>");
        $('#showservice').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_srvices'));?>");
    }
    var json_servicesArr = JSON.stringify(servicesArr, null, 2);
    
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
			        url:"<?php echo site_url('admin/coupon/showTextServicesAjax'); ?>",
			        data:"json_servicesArr="+json_servicesArr,
			        success:function(ser){
			            var obj = jQuery.parseJSON(ser);
			            services ="";
			            var counter =1;
			            $.each(obj, function(index, value) {
			            if(counter > 1){
			                services=value+","+" "+services ;
			            }else{
			                services=value+" "+services ;
			            }
			            counter++;
			            });
			            $('#showservice').html(services);
			        }
			    });
			}
		//check login end
		}  
	});
}
function displayStaff(){
    $('#showstaff').html("");
    var counter=0;
    $('#showstaffdiscount').html('');
    staffArr = new Array();
    $("input:checkbox[class=staff_checkbox]:checked").each(function(){
        var value1= $(this).val();
        staffArr.push(value1);
        counter=counter +1;
    });

    if(counter  != 0){
        $('#showstaffdiscount').html(counter+" <?php echo $this->global_mod->db_parse($this->lang->line('staff_slectd'));?>");
    }else{
        $('#showstaffdiscount').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_staff'));?>");
        $('#showstaff').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_staff'));?>");
    }
    var json_staffArr = JSON.stringify(staffArr, null, 2);
   
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
		        url:"<?php echo site_url('admin/coupon/showTextStaffAjax'); ?>",
		        data:"json_staffArr="+json_staffArr,
		        success:function(data){
		            var obj = jQuery.parseJSON(data);
		            var staff ="";
		            var counter =1;
		            $.each(obj, function(index, value) {
		                if(counter > 1) {
		                    staff=value+","+" "+staff;
		                } else {
		                    staff=value+" "+staff;
		                }
		                counter++;
		            });
		            $('#showstaff').html(staff);
		        }
		    });
		}
	//check login end
	}  
});
}
function displayDate(){

    var counter=0;
    var dateshow="";
    $('#showdatediscount').html('');
    $('#showWeekday').html("");
    $("input:checkbox[class=date_checkbox]:checked").each(function(){
        var value1= $(this).val();
        counter=counter +1;
        if(value1==7){
            if(dateshow!= "") {
                dateshow+=", Sunday ";
            } else {
                dateshow+=" Sunday ";
            }
        }
        if(value1==1)
        {
            if(dateshow!= "") {
                dateshow+=" , Monday ";
            } else {
                dateshow+=" Monday ";
            }
        }
        if(value1==2){
            if(dateshow!= ""){
                dateshow+=" , Tuesday ";
            }else{
                dateshow+=" Tuesday ";
            }
        }
        if(value1==3){
            if(dateshow!= ""){
                dateshow+=" , Wednesday ";
            }else{
                dateshow+=" Wednesday ";
            }
        }
        if(value1==4){
            if(dateshow!= ""){
                dateshow+=" , Thursday ";
            }else{
                dateshow+=" Thursday ";
            }
        }
        if(value1==5){
            if(dateshow!= ""){
                dateshow+=" , Friday ";
            }else{
                dateshow+=" Friday ";
            }
        }
        if(value1==6){
            if(dateshow!= ""){
                dateshow+=" , Saturday ";
            }else{
                dateshow+=" Saturday ";
            }
        }
    });
    if(counter  != 0){
        $('#showdatediscount').html(counter+" Date selected");
    }
	else{
		$('#showdatediscount').html("Any Day");
	}
    if(dateshow == ''){
        dateshow = ' Any Day';
    }
    $('#showWeekday').html(dateshow);
}
function showServiceoffer(){
    $('#hidedivoffer').show();
    $('#hidestaffoffer').hide();
    $('#hidedateoffer').hide();
}
function hideServiceoffer(){
    $('#hidedivoffer').hide();
}
function showstaffoffer(){
    $('#hidestaffoffer').show();
    $('#hidedivoffer').hide();
    $('#hidedateoffer').hide();
}
function hidestaffoffer(){
    $('#hidestaffoffer').hide();
}
function showdateoffer(){
    $('#hidedivoffer').hide();
    $('#hidedateoffer').show();
    $('#hidestaffoffer').hide();
}
function hidedateoffer(){
    $('#hidedateoffer').hide();
}
function displayServicesoffer(){
    var counter=0;
    $('#showdivoffer').html('');
    $('#showservice').html('');
    servicesArr = new Array();
    $("input:checkbox[class=checkbox_offer]:checked").each(function(){
        var value1= $(this).val();
        servicesArr.push(value1);
        counter=counter +1;
    });
    if(counter  != 0){
        $('#showdivoffer').html(counter+" <?php echo $this->global_mod->db_parse($this->lang->line('srvice_slectd'));?>");
    }else{
        $('#showdivoffer').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_srvices'));?>");
        $('#showservice').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_srvices'));?>");
    }
    var json_servicesArr = JSON.stringify(servicesArr, null, 2);
   
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
		        url:"<?php echo site_url('admin/coupon/showTextServicesAjax'); ?>",
		        data:"json_servicesArr="+json_servicesArr,
		        success:function(ser){
		            var obj = jQuery.parseJSON(ser);
		            services ="";
		            var counter =1;
		            $.each(obj, function(index, value){
		                if(counter > 1) {
		                    services=value+","+" "+services ;
		                }else{
		                    services=value+" "+services ;
		                }
		                counter++;
		            });
		            $('#showservice').html(services);
		        }
		    });
		}
	//check login end
	}  
});
}

function displayStaffoffer(){
    var counter=0;
    $('#showstaffoffer').html('');
    $('#showstaff').html('');
    staffArr = new Array();
    $("input:checkbox[class=staff_checkbox_offer]:checked").each(function(){
        var value1= $(this).val();
        staffArr.push(value1);
        counter=counter +1;
    });
    if(counter  != 0){
        $('#showstaffoffer').html(counter+" <?php echo $this->global_mod->db_parse($this->lang->line('staff_slectd'));?>");
    }else{
        $('#showstaffoffer').html("<?php echo $this->global_mod->db_parse($this->lang->line('any_staff'));?>");
    }
    var json_staffArr = JSON.stringify(staffArr, null, 2);
  
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
			        url:"<?php echo site_url('admin/coupon/showTextStaffAjax'); ?>",
			        data:"json_staffArr="+json_staffArr,
			        success:function(data){
			            var obj = jQuery.parseJSON(data);
			            var staff ="";
			            var counter =1;
			            $.each(obj, function(index, value){
			                if(counter > 1) {
			                    staff=value+","+" "+staff;
			                }else{
			                    staff=value+" "+staff;
			                }
			                counter++;
			            });
			            $('#showstaff').html(staff);
			        }
			    });
		}
	//check login end
	}  
});
}
function displayDateoffer(){
    var counter=0;
    var dateshow="";
    $('#showdateoffer').html('');
    $('#showWeekday').html("");
    $("input:checkbox[class=date_checkbox_offer]:checked").each(function(){
        var value1= $(this).val();
        counter=counter +1;
        if(value1==1){
            if(dateshow!= ""){
                dateshow+=", Sunday ";
            }else{
                dateshow+=" Sunday ";
            }
        }
        if(value1==2){
            if(dateshow!= ""){
                dateshow+=" , Monday ";
            }else{
                dateshow+=" Monday ";
            }
        }
        if(value1==3){
            if(dateshow!= ""){
                dateshow+=" , Tuesday ";
            }else{
                dateshow+=" Tuesday ";
            }
        }
        if(value1==4){
            if(dateshow!= ""){
                dateshow+=" , Wednesday ";
            }else{
                dateshow+=" Wednesday ";
            }
        }
        if(value1==5){
            if(dateshow!= ""){
                dateshow+=" , Thursday ";
            }else{
                dateshow+=" Thursday ";
            }
        }

        if(value1==6){
            if(dateshow!= ""){
                dateshow+=" , Friday ";
            }else{
                dateshow+=" Friday ";
            }
        }
        if(value1==7){
            if(dateshow!= ""){
                dateshow+=" , Saturday ";
            }else{
                dateshow+=" Saturday ";
            }
        }
    });
    if(counter  != 0){
        $('#showdateoffer').html(counter+" <?php echo $this->global_mod->db_parse($this->lang->line('date_slctd'));?>");
    }
	else{
		$('#showdateoffer').html("Any Day");
	}
	if(dateshow == ''){
        dateshow = ' Any Day';
    }
    $('#showWeekday').html(dateshow);
	
	
}
function hideCreateDiscount(){
    $('#discountcoupontable').hide();
    $('#discount_display_text').hide();
    $("#first_time_use_only").attr('checked', false);
    $("#one_time_use_only").attr('checked', false);
    $("span.error").html('');
}
function hideCreateOffer(){
    $('#offertable').hide();
    $('#discount_display_text').hide();
    $("#first_time_use_only_offer").attr('checked', false);
    $("#one_time_use_only_offer").attr('checked', false);
    $("span.error").html('');
}
function displayTextHeadingDiscount(value){
    $('#display_heading').html(value);
}
function displayDiscount(value){
    $('#discount_percent').html("");
    var selectedval = $("#discount_amnt_setting option:selected").text();
    if(selectedval =='%'){
        $('#discount_percent_type').html(selectedval+' <?php echo $this->global_mod->db_parse($this->lang->line("off"));?>');
        $('#discount_percent').html(value);
    }else{
        $('#discount_percent_type_rs').html(selectedval);
        $('#discount_percent').html(value+' <?php echo $this->global_mod->db_parse($this->lang->line("off"));?>');
    }
    $('#discount_percent').css('font-weight','bold');
}
function showstartdate(){
    setTimeout(function(){
        var date = $("#aplcbl_date_from").val();
        $('#showstartdate').html('');
        if( date ==''){
            $('#showstartdate').html('<?php echo $this->global_mod->db_parse($this->lang->line("from_any_day"));?>');
        }else{
            $('#showstartdate').html("<?php echo $this->global_mod->db_parse($this->lang->line('from_sml'));?> " + date);
        }
        $('#showstartdate').css('font-weight','bold');
    },300);
}
function showstartofferdate(){
    setTimeout(function(){
        var date = $("#aplcbl_date_from_offer").val();
        $('#showstartdate').html('');
        if( date ==''){
            $('#showstartdate').html('<?php echo $this->global_mod->db_parse($this->lang->line("from_any_day"));?>');
        }else{
            $('#showstartdate').html("<?php echo $this->global_mod->db_parse($this->lang->line('from_sml'));?> " + date);
        }
        $('#showstartdate').css('font-weight','bold');
    },300);
}
function showenddate(){
    setTimeout(function(){
        var date = $("#aplcbl_date_to").val();
        $('#showenddate').html('');
        if( date ==''){
            $('#showenddate').html('<?php echo $this->global_mod->db_parse($this->lang->line("to_any_day"));?>');
        }else{
            $('#showenddate').html("<?php echo $this->global_mod->db_parse($this->lang->line('to_sml'));?> " + date);
        }
        $('#showenddate').css('font-weight','bold');
    },300);
}
function showendofferdate(){
    setTimeout(function(){
        var date = $("#aplcbl_date_to_offer").val();
        $('#showenddate').html('');
        if( date ==''){
            $('#showenddate').html('<?php echo $this->global_mod->db_parse($this->lang->line("to_any_day"));?>');
        }else{
            $('#showenddate').html("<?php echo $this->global_mod->db_parse($this->lang->line('to_sml'));?> " + date);
        }
        $('#showenddate').css('font-weight','bold');
    },300);
}
function showstarttime(){
    setTimeout(function(){
    var date = $("#aplcbl_hour_from").val();
    $('#showstarttime').html("");
    if( date ==''){
        $('#showstarttime').html("<?php echo $this->global_mod->db_parse($this->lang->line('between_any_time'));?>");
    }else{
        $('#showstarttime').html(" <?php echo $this->global_mod->db_parse($this->lang->line('between_sml'));?> " + date);
    }
    $('#showstarttime').css('font-weight','bold');
    },300);
}
function showstartoffertime(){
    setTimeout(function(){
    var date = $("#aplcbl_hour_from_offer").val();
    $('#showstarttime').html("");
    if( date ==''){
        $('#showstarttime').html("<?php echo $this->global_mod->db_parse($this->lang->line('between_any_time'));?>");
    }else{
        $('#showstarttime').html(" <?php echo $this->global_mod->db_parse($this->lang->line('between_sml'));?> " + date);
    }
    $('#showstarttime').css('font-weight','bold');
    },300);
}
function showendtime(){	
    setTimeout(function(){
    var date = $("#aplcbl_hour_to").val();
    $('#showendtime').html("");
    if( date ==''){
        $('#showendtime').html("<?php echo $this->global_mod->db_parse($this->lang->line('and_any_time'));?>");
    }else{
        $('#showendtime').html("and " + date);
    }
    $('#showendtime').css('font-weight','bold');
    },300);
}
function showendoffertime(){
    setTimeout(function(){
    var date = $("#aplcbl_hour_to_offer").val();
    $('#showendtime').html("");
    if( date ==''){
        $('#showendtime').html("<?php echo $this->global_mod->db_parse($this->lang->line('and_any_time'));?>");
    }else{
        $('#showendtime').html("and " + date);
    }
    $('#showendtime').css('font-weight','bold');
    },300);
}
function showstartdateoffer(){
    setTimeout(function(){
        var date = $("#aplcbl_date_from_offer").val();
        $('#showstartdate').html(date);
        $('#showstartdate').css('font-weight','bold');
    },300);
}
function showenddateoffer(){
    setTimeout(function () {
        var date = $("#aplcbl_date_to_offer").val();
        $('#showenddate').html(date);
        $('#showenddate').css('font-weight','bold');
    },300);
}
function showstarttimeoffer(){
    setTimeout(function(){
        var date = $("#aplcbl_hour_from_offer").val();
        $('#showstarttime').html(date);
        $('#showstarttime').css('font-weight','bold');
    },300);
}
function showendtimeoffer(){
    setTimeout(function (){
        var date = $("#aplcbl_hour_to_offer").val();
        $('#showendtime').html(date);
        $('#showendtime').css('font-weight','bold');
    },300);
}
function worksover(value){
    if( value ==''){
        $('#enddate').html(value);
    }else{
        $('#enddate').html("<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('redeemble_ovr'));?>  "+"<?php echo $this->session->userdata('local_admin_currency_type'); ?>" + value+"</li>");
    }
    $('#enddate').css('font-weight','bold');
}
function firsttimeuse(){
    $('#firsttime').html("");
    $('#firsttimeli').hide();
    $("input:checkbox[name=first_time_use_only]:checked").each(function(){
        $('#firsttime').html("<?php echo $this->global_mod->db_parse($this->lang->line('wrks_on_1st_appo_only'));?>");
        $('#firsttimeli').show();
    });
}
function onetimeuse(){
    $('#onettime').html("");
    $('#onetimeli').hide();
    $("input:checkbox[name=one_time_use_only]:checked").each(function(){
        $('#onettime').html("<?php echo $this->global_mod->db_parse($this->lang->line('coupn_cn_b_use_only_once'));?>");
        $('#onetimeli').show();
    });
}
function firsttimeuseoffer(){
    $('#firsttime').html("");
    $('#firsttimeli').hide();
    $("input:checkbox[name=first_time_use_only_offer]:checked").each(function(){
        $('#firsttime').html("<?php echo $this->global_mod->db_parse($this->lang->line('wrks_on_1st_appo_only'));?>");
        $('#firsttimeli').show();
    });
}
function onetimeuseoffer(){
    $('#onettime').html("");
    $('#onetimeli').hide();
    $("input:checkbox[name=one_time_use_only_offer]:checked").each(function(){
        $('#onettime').html("<?php echo $this->global_mod->db_parse($this->lang->line('coupn_cn_b_use_only_once'));?>");
        $('#onetimeli').show();
    });
}
function displaypercentage(value){
    $('#discount_percent_type_rs').html("");
    $('#discount_percent_type').html("");
    if(value == 1){
        $('#discount_percent_type').html("% <?php echo $this->global_mod->db_parse($this->lang->line('Off'));?>");
    }else{
        $('#discount_percent_type_rs').html('<?php 	echo $this->session->userdata('local_admin_currency_type'); ?> ');
        $('#discount_percent_type').html(' Off');
    }
}
</script>

<script>
	function shareFacebook(cuponId,cuponType){
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
		        url:"<?php echo site_url('admin/coupon/shareFacebook'); ?>",
		        data:  { cuponId: cuponId , cuponType: cuponType },
		        success:function(resultData){
				u=location.hostname;
				t=document.title;
				window.open('http://www.facebook.com/sharer.php?t=hello&u='+u,'sharer','toolbar=0,status=0,width=626,height=436');
				return false;
		        }
		    });
	}
	//check login end
	}  
	});	
	}
	
	function shareTwitter(cuponId,cuponType){
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
		        url:"<?php echo site_url('admin/coupon/shareTwitter'); ?>",
		        data:  { cuponId: cuponId , cuponType: cuponType },
		        success:function(resultData){
				window.open('https://twitter.com/share?text='+$.trim(resultData),'','toolbar=0,status=0,width=626,height=436');
		        }
		    });
	}
	//check login end
	}  
	});			
	}
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>

<script>
	
	function ChangeTerms(id){
		
		if(document.getElementById('radio_ys').checked){
			
			document.getElementById(id).style.display = 'none'; 
		}else{
			
			document.getElementById(id).style.display = 'block'; 
		}
	}
	
	function ChangeTermsDiscount(table_id){
		if(document.getElementById('radio_ys_discount').checked){
			
			document.getElementById(table_id).style.display = 'none'; 
		}else{
			
			document.getElementById(table_id).style.display = 'block'; 
		}
	}
	
</script>


<script type="text/javascript">
	function json_decode(str_json) {
		
  //       discuss at: http://phpjs.org/functions/json_decode/
  //      original by: Public Domain (http://www.json.org/json2.js)
  // reimplemented by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: T.J. Leahy
  //      improved by: Michael White
  //        example 1: json_decode('[ 1 ]');
  //        returns 1: [1]

  /*
    http://www.JSON.org/json2.js
    2008-11-19
    Public Domain.
    NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.
    See http://www.JSON.org/js.html
  */

  var json = this.window.JSON;
  		
  if (typeof json === 'object' && typeof json.parse === 'function') {
    try {
      return json.parse(str_json);
    } catch (err) {
      if (!(err instanceof SyntaxError)) {
        throw new Error('Unexpected error type in json_decode()');
      }
      this.php_js = this.php_js || {};
      this.php_js.last_error_json = 4; // usable by json_last_error()
      return null;
    }
  }

  var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
  var j;
  var text = str_json;

  // Parsing happens in four stages. In the first stage, we replace certain
  // Unicode characters with escape sequences. JavaScript handles many characters
  // incorrectly, either silently deleting them, or treating them as line endings.
  cx.lastIndex = 0;
  if (cx.test(text)) {
    text = text.replace(cx, function(a) {
      return '\\u' + ('0000' + a.charCodeAt(0)
        .toString(16))
        .slice(-4);
    });
  }

  // In the second stage, we run the text against regular expressions that look
  // for non-JSON patterns. We are especially concerned with '()' and 'new'
  // because they can cause invocation, and '=' because it can cause mutation.
  // But just to be safe, we want to reject all unexpected forms.
  // We split the second stage into 4 regexp operations in order to work around
  // crippling inefficiencies in IE's and Safari's regexp engines. First we
  // replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
  // replace all simple value tokens with ']' characters. Third, we delete all
  // open brackets that follow a colon or comma or that begin the text. Finally,
  // we look to see that the remaining characters are only whitespace or ']' or
  // ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.
  if ((/^[\],:{}\s]*$/)
    .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
      .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
      .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

    // In the third stage we use the eval function to compile the text into a
    // JavaScript structure. The '{' operator is subject to a syntactic ambiguity
    // in JavaScript: it can begin a block or an object literal. We wrap the text
    // in parens to eliminate the ambiguity.
    j = eval('(' + text + ')');
	
    return j;
  }

  this.php_js = this.php_js || {};
  this.php_js.last_error_json = 4; // usable by json_last_error()
  return null;
}

</script>

