<script type="text/javascript">
$(document).ready(function(){
	$(".allAppointmentDetailsSpanHide").hide();});
</script>
<script>
/*function approve(booking_id)
{
	var booking_status=1;
	$("#approve_"+booking_id).hide();
	$("#unapprove_"+booking_id).show();
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/approval/changeStatusAjax'); ?>",
		  data:"booking_id="+booking_id+"&booking_status="+booking_status,
		  success:function(rdata)
		  { 
			//alert(rdata); 
		  }
	});
}*/
</script>
<script>
function unapprove(booking_id)
{
	var booking_status=0;
	$("#unapprove_"+booking_id).hide();
	$("#approve_"+booking_id).show();
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/approval/changeStatusAjax'); ?>",
		  data:"booking_id="+booking_id+"&booking_status="+booking_status,
		  success:function(rdata)
		  { 
			//alert(rdata); 
		  }
	});
}
</script>
<script>
/*function deny(booking_id)
{
	var conBox = confirm("Are you want to deny");
	if(conBox)
	{
		$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/approval/denyAjax'); ?>",
			  data:"booking_id="+booking_id,
			  success:function(rdata)
			  { 
				$("#show_all_appointment").html(rdata);
				$(".allAppointmentDetailsSpanHide").hide();
			  }
		});
	}
}*/
</script>
<script>
    $(document).ready(function(){
        $("#ckbCheckAll").click(function(){
            $(".all_booking").prop("checked",$("#ckbCheckAll").prop("checked"))
        }) 
        $(".all_booking").click(function () {
            if ($(".all_booking").length == $(".all_booking:checked").length) {
                $("#ckbCheckAll").attr("checked", "checked");
            } else {
                $("#ckbCheckAll").removeAttr("checked");
            }
        });
    });
</script>

<script>
function approveAllCheckedBooking()
{
    bookingIdArr = new Array();
    $(".all_booking:checked").each(function()
    {
        var value1= $(this).val();
        /*$("#approve_"+value1).hide();
        $("#unapprove_"+value1).show();*/
        bookingIdArr.push(value1);
    });
    var booking_all_id= bookingIdArr.join(',');
    if(booking_all_id != '')
    {
        $.ajax({
            type: 'POST',
            datatype:'html',
            url:"<?php echo site_url('admin/approval/approveAllCheckedBookingAjax'); ?>",
            data:"booking_all_id="+booking_all_id,
            success:function(result){ 
                if(result == 1){
                    location.reload();
                }
            }
        });
    }
    else
    {
        alert("Please check atleast one appointment to approve!!\nBulk Approval for failed appointment is not allowed.");
    }			
}
</script>
<script>
/*function appointmentDetails(booking_id)
{
	$("#appointmentDetailsSpan_"+booking_id).hide();
	$("#appointmentDetailsSpanHide_"+booking_id).show();
	$("#appointment_details_show"+booking_id).show();
	
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/approval/appointmentDetailsAjax'); ?>",
		  data:"booking_id="+booking_id,
		  success:function(rdata)
		  { 
			$("#appointment_details_show"+booking_id).html(rdata);
		  }
	});
}*/
</script>
<script>
/*function appointmentDetailsHide(booking_id)
{
	$("#appointmentDetailsSpan_"+booking_id).show();
	$("#appointmentDetailsSpanHide_"+booking_id).hide();
	$("#appointment_details_show"+booking_id).hide();
}*/
/*###################################################################*/
function showAppointmentDetails(booking_id){
    $(".hide_"+booking_id).toggle();
}
function approve(booking_id){
    lightbox_body();
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo base_url('admin/approval/approveAjax'); ?>",
        data:"booking_id="+booking_id,
        success:function(result){ 
            if(result == 1){
                closeLightbox_body();
                location.reload();
            }
        }
    });
}
function deny(booking_id){
    lightbox_body();
    //$('#test').html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br>Loding...</center>')
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo base_url('admin/approval/denyAjax'); ?>",
        data:"booking_id="+booking_id,
        success:function(result){ 
            if(result == 1){
                closeLightbox_body();
                location.reload();
            }
        }
    });
}
/*###################################################################*/
</script>