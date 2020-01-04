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
				  url:"<?php echo site_url('admin/approval/changeStatusAjax'); ?>",
				  data:"booking_id="+booking_id+"&booking_status="+booking_status,
				  success:function(rdata)
				  { 
					//alert(rdata); 
				  }
			});
		}
	//check login end
	}  
});
	
}
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
			            url:"<?php echo site_url('admin/approval/approveAllCheckedBookingAjax'); ?>",
			            data:"booking_all_id="+booking_all_id,
			            success:function(result){ 
			            	closeLightbox_body();
			                if(result == 1){
			                    //location.reload();
			                }
			            }
			        });
				}
			//check login end
			}  
		});
    }
    else
    {
        alert("<?php echo $this->lang->line('pls_chk_atlst_one_appo_to_approv');?>"+"\n"+"<?php echo $this->lang->line('bulk_approv_4_faild_appo_is_nt_allwd');?>");
    }			
}
</script>

<script>

function showAppointmentDetails(booking_id){
    $(".hide_"+booking_id).toggle();
}
function approve(booking_id){
    lightbox_body();
    
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
		//check login end
		}  
	});
}
function deny(booking_id){
    lightbox_body();
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
		//check login end
		}  
	});
}
/*###################################################################*/
</script>