function apply_coupon(couponCode,bookingDetails){

	//var booking_grand_total= $('#booking_grand_total').val();
	var booking_grand_total= $('#subtotal').val();
	var total= $('#for_coupon_total').val();
	$.ajax({
		url: SITE_URL+"page/fnp_applyCouponCode",
		data:{'couponCode':couponCode,'bookingDetails':bookingDetails ,'booking_grand_total':booking_grand_total,'total':total},
		type: "post",
		success: function(result){
			//alert(result);
			obj = jQuery.parseJSON(result);
			if(obj.error == 1){
				$('<lable class="couponMsg" style="color:#FF0000"><br>'+obj.msg+'</lable>').insertAfter('#applyCouponButton');
				$('#discount_coupon_tr').hide();
				$('#discount_coupon').val('');
				$('#final_total_td').html(obj.currency_type+" "+obj.total);
				$('#total').val(total);
			}else{
				$('<lable class="couponMsg" style="color:#396B03"><br>'+obj.msg+'</lable>').insertAfter('#applyCouponButton');
				$('#discount_coupon_tr').show();
				$('#discount_coupon_td').html("-"+obj.currency_type+" "+obj.coupon_amount);			
				$('#discount_coupon').val(obj.coupon_amount);
				$('#final_total_td').html(obj.currency_type+" "+obj.total);
				$('#total').val(obj.total);
				console.log(result);
			}
		}  	
	})
}