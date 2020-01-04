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
</script>