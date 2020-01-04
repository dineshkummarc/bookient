

jQuery(document).ready(function ($) {
    $("#USDbox").attr('value', '1.00');
 
    $(".currency_box").bind("keypress", function (event) {
        var charCode = event.which;
        if (charCode <= 13) return true;
        var keyChar = String.fromCharCode(charCode);
        return /[0-9.]/.test(keyChar);
    });


});	

function reform_chk(){
	var lsIndex = 0;
	$('input[type=text]').each(function () {
            var data = "";
            data = $(this).val();
            var data1 = $.trim(data);
            if (data1 == '') {
                var currency_id = this.id;
                var span_id = currency_id + '_error';
                $("#" + span_id).text("Required field");
				//event.preventDefault();
				lsIndex ++;
            }
        });
        if(lsIndex >0){
			return false;
		}
}
		
		
		
		
 	