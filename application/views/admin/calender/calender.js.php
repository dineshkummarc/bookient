<script language="javascript" type="text/javascript">
    function check_payment() {
        var taxTotal = 0;
        var grandTotal = 0;
        var frmPay = $("#frm_pay_hidden").val();
        var frmAddi = $("#frm_addi").val();
        var frmDiscount = $("#frm_discount").val();
        $("#right_addi").html(frmAddi);
        $("#right_discount").html(frmDiscount);
        $(".frmTaxes").each(function () {
            var taxRate = ($(this).attr("data-rate"));
            var total = Number(frmPay) + Number(frmAddi) - Number(frmDiscount);
            var tax = total * (taxRate / 100);
            taxTotal += Number(tax);
            $(this).html(tax);
            grandTotal = Number(total) + Number(taxTotal);
        });
        $("#frm_total").html(grandTotal);

        taxTotal = 0;
        grandTotal = 0;
        $(".taxes").each(function () {
            var taxRate = ($(this).attr("data-rate"));
            var total = Number(frmPay) + Number(frmAddi) - Number(frmDiscount);
            var tax = total * (taxRate / 100);
            taxTotal += Number(tax);
            $(this).html(tax);
            grandTotal = Number(total) + Number(taxTotal);
        });
        $("#left_total").html(grandTotal);
    }
    function change_amount() {
        var taxTotal = 0;
        var grandTotal = 0;
        var frmPay = $("#frm_pay").val();
        var frmAddi = $("#frm_addi").val();
        var frmDiscount = $("#frm_discount").val();
        $("#right_addi").html(frmAddi);
        $("#right_discount").html(frmDiscount);
        $(".frmTaxes").each(function () {
            var taxRate = ($(this).attr("data-rate"));
            var total = Number(frmPay) + Number(frmAddi) - Number(frmDiscount);
            var tax = total * (taxRate / 100);
            taxTotal += Number(tax);
            $(this).html(tax);
            grandTotal = Number(total) + Number(taxTotal);
        });
        $("#frm_total").html(grandTotal);
    }
    
	$(function(){
	var windowsHeight = $(window).outerHeight(),
		windowsWidth = $(window).outerWidth(),
		topBarHeight = $('#radioset').height();
		//console.log(windowsHeight);
	if(windowsWidth > 1200){		
	var divHeight = windowsHeight -150;
		$('.responsive-view').css('height',divHeight);	
	
	}
	
	$(window).resize(function(){
		var windowsHeight = $(window).outerHeight(),
		windowsWidth = $(window).outerWidth(),
		topBarHeight = $('#radioset').height();
		//console.log(windowsHeight);
		if(windowsWidth > 1200){		
		var divHeight = windowsHeight -150;
			$('.responsive-view').css('height',divHeight);	
		
		}			  
		});
	});
</script>

<script type="text/javascript">
	
	var jLang ={ 'lang' : 'english' };
	jLang['block_date'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('block_date'));?>";
	jLang['select_date'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('select_date'));?>";
	jLang['repeat_blck_4_multiple_stf'] 		= "<?php echo $this->global_mod->db_parse($this->lang->line('repeat_blck_4_multiple_stf'));?>";
	jLang['block'] 								= "<?php echo $this->global_mod->db_parse($this->lang->line('block'));?>";
	jLang['already_u_hv_open_blck_menu'] 		= "<?php echo $this->global_mod->db_parse($this->lang->line('already_u_hv_open_blck_menu'));?>";
	jLang['set_workable_time'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('set_workable_time'));?>";
	jLang['Difference'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('Difference'));?>";
	jLang['set_row_width'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('set_row_width'));?>";
	jLang['save_btn'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('save_btn'));?>";
	jLang['close_btn'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('close_btn'));?>";
	jLang['an_email_will_b_send_to_review'] 	= "<?php echo $this->global_mod->db_parse($this->lang->line('an_email_will_b_send_to_review'));?>";
	jLang['an_email_will_b_send'] 				= "<?php echo $this->global_mod->db_parse($this->lang->line('an_email_will_b_send'));?>";
	jLang['ur_data_succfully_saved'] 			= "<?php echo $this->global_mod->db_parse($this->lang->line('ur_data_succfully_saved'));?>";
	jLang['err_2_save_Data'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('err_2_save_Data'));?>";
	jLang['this_email_already_used'] 			= "<?php echo $this->global_mod->db_parse($this->lang->line('this_email_already_used'));?>";
	jLang['pls_slct_staff_frm_left_bar'] 		= "<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_staff_frm_left_bar'));?>";
	jLang['click_to_set_availability_or_non'] 	= "<?php echo $this->global_mod->db_parse($this->lang->line('click_to_set_availability_or_non'));?>";
	jLang['hide_details'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('hide_details'));?>";
	jLang['show_details'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('show_details'));?>";
	jLang['do_u_want_2_chng'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('do_u_want_2_chng'));?>";
	jLang['ur_email_has_bn_sent'] 				= "<?php echo $this->global_mod->db_parse($this->lang->line('ur_email_has_bn_sent'));?>";
	jLang['sry_2_send_email'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('sry_2_send_email'));?>";
	jLang['ask_review'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('ask_review'));?>";
	jLang['sry_2_cancel_appo'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('sry_2_cancel_appo'));?>";
	jLang['cancel_appo'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('cancel_appo'));?>";
	jLang['r_u_sure'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('r_u_sure'));?>";
	
	
	jLang['first_name'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('first_name'));?>";
	jLang['last_name'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('last_name'));?>";
	jLang['mobile'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('mobile'));?>";
	jLang['home_no'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('home_no'));?>";
	jLang['work_no'] 							= "<?php echo $this->global_mod->db_parse($this->lang->line('work_no'));?>";
	jLang['slct_country'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('slct_country'));?>";
	jLang['zip'] 								= "<?php echo $this->global_mod->db_parse($this->lang->line('zip'));?>";
	jLang['select_region'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('select_region'));?>";
	jLang['select_city'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('select_city'));?>";
	jLang['select_time'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('select_time'));?>";
	jLang['email'] 								= "<?php echo $this->global_mod->db_parse($this->lang->line('email'));?>";
	jLang['new_appointment'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('new_appointment'));?>";
	jLang['select_customer'] 					= "<?php echo $this->global_mod->db_parse($this->lang->line('select_customer'));?>";
	jLang['reschedule_booking'] 				= "<?php echo $this->global_mod->db_parse($this->lang->line('reschedule_booking'));?>";
	jLang['reschedule'] 						= "<?php echo $this->global_mod->db_parse($this->lang->line('reschedule'));?>";
	
	
	

	
	
</script>