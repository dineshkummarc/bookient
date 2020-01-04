<script type="text/javascript">
	$(document).ready(function(){
		var editorText = CKEDITOR.instances;
		
		
	});

$(function () {
    $('#popup-wrapper').modalPopLite({ openButton: '#clicker', closeButton: '#close-btn' });
});

function select_template(eml_mrktn_templt_id){	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			var Category_id = $("#hdn_categoryid").val();
			$('#selectedtemplateId').val(eml_mrktn_templt_id);
			if(Category_id == ''){
				Category_id = 0;
			}
			$.ajax({
				type: 'POST',
				datatype:'html',
				url:"<?php echo site_url('admin/email_mktg/selectTemplateAjax'); ?>",
				data:"eml_mrktn_templt_id="+eml_mrktn_templt_id,
				data:{"eml_mrktn_templt_id":eml_mrktn_templt_id,'clicked_category':Category_id},
				success:function(rdata){ 
				pr_popup(700);
				$('#front_popup_content').html(rdata);
				 
				} 
			});
		}
	//check login end
	}  
});
	
}

function select_my_template(eml_mrktn_templt_id)
{
	//alert(eml_mrktn_templt_id);
	//$('.openmodalbox').trigger('click');
	$('#selectedTemplate').html('');
	$('#selectedTemplate').show();
	$('#AllTemplate').hide();
	
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
		  url:"<?php echo site_url('admin/email_mktg/selectMyTemplateAjax'); ?>",
		  data:"eml_mrktn_templt_id="+eml_mrktn_templt_id,
		  success:function(rdata)
		  { 
			$("#selectedTemplate").html(rdata);
                        $('#colorSelector_header').ColorPicker({
                            color: '#0000ff',
                            onShow: function (colpkr) {
                                    $(colpkr).fadeIn(500);
                                    return false;
                            },
                            onHide: function (colpkr) {
                                    $(colpkr).fadeOut(500);
                                    return false;
                            },
                            onChange: function (hsb, hex, rgb) {
                                    $('#colorSelector_header div').css('backgroundColor', '#' + hex);
                                     var tmplt_header_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveHeaderColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_header_bgcolor' : tmplt_header_bgcolor },
                                                    success:function(rdata)
                                                    { 
                                                          $("#header_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                                    //alert(hex);
                            }
                        });
                        $('#colorSelector_content').ColorPicker({
                               color: '#0000ff',
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
                                       $('#colorSelector_content div').css('backgroundColor', '#' + hex);
                                       //alert(hex);
                                        var tmplt_body_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveContentColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_body_bgcolor' : tmplt_body_bgcolor },
                                                    success:function()
                                                    { 
                                                          $("#content_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                               }
                        });
                        $('#colorSelector_footer').ColorPicker({
                                color: '#0000ff',
                                onShow: function (colpkr) {
                                        $(colpkr).fadeIn(500);
                                        return false;
                                },
                                onHide: function (colpkr) {
                                        $(colpkr).fadeOut(500);
                                        return false;
                                },
                                onChange: function (hsb, hex, rgb) {
                                        $('#colorSelector_footer div').css('backgroundColor', '#' + hex);
                                        //alert(hex);
                                       var tmplt_footer_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveFooterColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_footer_bgcolor' : tmplt_footer_bgcolor },
                                                    success:function()
                                                    { 
                                                          $("#footer_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                                }
                        });
                
			//alert(rdata); 
		  }
	});
		}
	//check login end
	}  
});	
	
}

function selectCat(eml_mrktn_templt_cat_id){
lightbox_body();
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$("#hdn_categoryid").val(eml_mrktn_templt_cat_id);
			$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/email_mktg/selectCatAjax'); ?>",
				  data:"eml_mrktn_templt_cat_id="+eml_mrktn_templt_cat_id,
				  success:function(rdata){ 
				  	closeLightbox_body();
					$("#showAllTemplate").html(rdata);
				  }
			});
		}
	//check login end
	}  
});
}

function readyTemplate()
{
	//alert("hhh");
	$('#myTemplate').hide();
	$('#showAllTemplate').show();
}

function myTemplate()
{
	//alert("gg");
	$('#myTemplate').show();
	$('#showAllTemplate').hide();
}

function closeAll()
{
	//alert("gg");
	$('#selectedTemplate').hide();
	$('#AllTemplate').show();
}

function editHeader()
{
	//alert("gg");
	$('#header_show').hide();
	$('#header_editor').show();
}

function editContent()
{
	//alert("gg");
	$('#content_show').hide();
	$('#content_editor').show();
}

function editFooter()
{
	//alert("gg");
	$('#footer_show').hide();
	$('#footer_editor').show();
}

function cancelHeader()
{
	//alert("gg");
	$('#header_show').show();
	$('#header_editor').hide();
}

function cancelContent()
{
	//alert("gg");
	$('#content_show').show();
	$('#content_editor').hide();
}

function cancelFooter()
{
	//alert("gg");
	$('#footer_show').show();
	$('#footer_editor').hide();
}

function saveHeader(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["header_area"+uniq_id];
    var value = editor.getData();
    //alert(value);
   
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
             url:"<?php echo site_url('admin/email_mktg/saveHeaderAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_header_content="+value,
              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_header_content' : value },
             success:function(rdata)
             { 
                   $("#email_mktg_header").html(rdata);
                   $('#colorSelector_header').ColorPicker({
                            color: '#0000ff',
                            onShow: function (colpkr) {
                                    $(colpkr).fadeIn(500);
                                    return false;
                            },
                            onHide: function (colpkr) {
                                    $(colpkr).fadeOut(500);
                                    return false;
                            },
                            onChange: function (hsb, hex, rgb) {
                                    $('#colorSelector_header div').css('backgroundColor', '#' + hex);
                                    //alert(hex);
                                     var tmplt_header_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveHeaderColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_header_bgcolor' : tmplt_header_bgcolor },
                                                    success:function(rdata)
                                                    { 
                                                          $("#header_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                            }
                        });
                   //alert(rdata); 
             }
    });
		}
	//check login end
	}  
});
}

function saveContent(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["content"+uniq_id];
    var value = editor.getData();
  
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
             url:"<?php echo site_url('admin/email_mktg/saveContentAjax'); ?>",
              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_body_content' : value },
             success:function(rdata)
             { 
                   $("#email_mktg_content").html(rdata);
                    $('#colorSelector_content').ColorPicker({
                               color: '#0000ff',
                               onShow: function (colpkr) {
                                       $(colpkr).fadeIn(500);
                                       return false;
                               },
                               onHide: function (colpkr) {
                                       $(colpkr).fadeOut(500);
                                       return false;
                               },
                               onChange: function (hsb, hex, rgb) {
                                       $('#colorSelector_content div').css('backgroundColor', '#' + hex);
                                        var tmplt_body_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveContentColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_body_bgcolor' : tmplt_body_bgcolor },
                                                    success:function()
                                                    { 
                                                          $("#content_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                               }
                        });
                   //alert(rdata); 
             }
    });	
		}
	//check login end
	}  
});
}

function saveFooter(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["footer_area"+uniq_id];
    var value = editor.getData();

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
             url:"<?php echo site_url('admin/email_mktg/saveFooterAjax'); ?>",
              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_footer_content' : value },
             success:function(rdata)
             { 
                   $("#email_mktg_footer").html(rdata);
                   //alert(rdata); 
                    $('#colorSelector_footer').ColorPicker({
                                color: '#0000ff',
                                onShow: function (colpkr) {
                                        $(colpkr).fadeIn(500);
                                        return false;
                                },
                                onHide: function (colpkr) {
                                        $(colpkr).fadeOut(500);
                                        return false;
                                },
                                onChange: function (hsb, hex, rgb) {
                                        $('#colorSelector_footer div').css('backgroundColor', '#' + hex);
                                        //alert(hex);
                                       var tmplt_footer_bgcolor ='#' + hex;
                                        $.ajax({
                                                    type: 'POST',
                                                    datatype:'html',
                                                    url:"<?php echo site_url('admin/email_mktg/saveFooterColorAjax'); ?>",
                                                    data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id, 'tmplt_footer_bgcolor' : tmplt_footer_bgcolor },
                                                    success:function()
                                                    { 
                                                          $("#footer_show").css('backgroundColor', '#' + hex);
                                                          //alert(rdata); 
                                                    }
                                          });
                                }
                        });
             }
    });
		}
	//check login end
	}  
});
}

function saveTemplate(eml_mrktn_templt_id)
{
    var eml_mrktn_templt_cat_id = $('#template_cat').val();
    var tmplt_name  =$('#template_name').val();
    var tmplt_subject  =$('#tmplt_subject').val();
      
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
             url:"<?php echo site_url('admin/email_mktg/saveTemplateAjax'); ?>",
              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id,'eml_mrktn_templt_cat_id' : eml_mrktn_templt_cat_id,
                        'tmplt_name' : tmplt_name,'tmplt_subject' : tmplt_subject},
             success:function()
             { 
                   
                  
                    $(".allPopupdiv").hide();
                   $("#saveTemplate").show();
                    $("#saveTemplate").html("<?php echo $this->global_mod->db_parse($this->lang->line('usr_tmplt_save_success'));?>");
                   $('.openmodalbox').trigger('click');
                   //alert(rdata); 
                    
             }
         });
		}
	//check login end
	}  
});   
   
}

function updateTemplate(eml_mrktn_templt_local_admin_id)
{
  
    var eml_mrktn_templt_cat_id = $('#template_cat').val();
    var tmplt_name  =$('#template_name').val();
    //alert(eml_mrktn_templt_local_admin_id);
   var tmplt_subject  =$('#tmplt_subject').val();
   //alert(tmplt_subject);
    
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
		        url:"<?php echo site_url('admin/email_mktg/updateTemplateAjax'); ?>",
		         data: { 'eml_mrktn_templt_local_admin_id' : eml_mrktn_templt_local_admin_id,'eml_mrktn_templt_cat_id' : eml_mrktn_templt_cat_id,
		                   'tmplt_name' : tmplt_name,'tmplt_subject' : tmplt_subject},
		        success:function()
		        { 
		            $(".allPopupdiv").hide();
		            $("#saveTemplate").show();
		            $("#saveTemplate").html("<?php echo $this->global_mod->db_parse($this->lang->line('usr_tmplt_save_success'));?>");
		            $('.openmodalbox').trigger('click');
		        }
		    });
		}
	//check login end
	}  
});  
}

function previewTemplate(eml_mrktn_templt_id)
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
	             datatype:'html',
	             url:"<?php echo site_url('admin/email_mktg/previewTemplateAjax'); ?>",
	             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
	              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id},
	             success:function(rdata)
	             { 
	                   
	                   $("#previewTemplate").html(rdata);
	                    $(".allPopupdiv").hide();
	                   $("#previewTemplate").show();
	                   $('.openmodalbox').trigger('click');
	                   //alert(rdata); 
	                    
	             }
	    });
		}
	//check login end
	}  
});
}

function sendTestTemplate(eml_mrktn_templt_id)
{
    $(".allPopupdiv").hide();
    $("#sendTestTemplate").show();
    $('.openmodalbox').trigger('click'); 
}

function sendTestMail()
{ 
   var testemail = $("#testemail").val();
   var tmplt_subject  = $('#tmplt_subject').val();
   
   
    if(testemail == '')
	{
		$("#testemail").css("border","1px solid red");
	}
	if(tmplt_subject == '')
	{
		$("#tmplt_subject").css("border","1px solid red");
		//return false;
	}
	if(testemail != '')
	{
		$("#testemail").css("border","");
	}
	if(tmplt_subject != '')
	{
		$("#tmplt_subject").css("border","");
		
	}
	
	
	if(testemail != '' && tmplt_subject != '')
	{
			$("#testemail").css("border","");
			$("#tmplt_subject").css("border","");
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
             url:"<?php echo site_url('admin/email_mktg/sendTestMailAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
              data: { 'testemail' : testemail,'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {                  
                 
				  $("#msg").html(rdata);  
				                    
             }
    });
		}
	//check login end
	}  
});
	}
          
}

function sendTemplate()
{
    
    $(".allPopupdiv").hide();
    $("#sendTemplate").show();
    $('.openmodalbox').trigger('click'); 
    $("#modalBox #tab1").show();
	$("#modalBox #tab2").hide();
	$("#modalBox #tab3").hide();
	$("#modalBox #registered_Clients").addClass("unselect");
	$("#modalBox #Import_from_Email").removeClass("unselect");
	$("#modalBox #Import_from_CSV_file").removeClass("unselect");
        
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
             url:"<?php echo site_url('admin/email_mktg/allUserAjax'); ?>",
             success:function(rdata)
             {         
                 var obj = jQuery.parseJSON(rdata);
                  $("#modalBox #count_user").html(obj.count);
                  $("#modalBox #all_user").html(obj.html);  
                  $(".user_chk_cls").attr("checked", true);                  
             }
        });
        var tmplt_subject  =$('#tmplt_subject').val();
        $.ajax({
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/saveSubjectAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
             data: { 'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {         
                              
             }
        });
		}
	//check login end
	}  
});
}
</script>
<script type="text/javascript">
function registered_Clients()
{
    $("#modalBox #tab1").show();
    $("#modalBox #tab2").hide();
    $("#modalBox #tab3").hide();
    $("#modalBox #registered_Clients").addClass("unselect");
    $("#modalBox #Import_from_Email").removeClass("unselect");
    $("#modalBox #Import_from_CSV_file").removeClass("unselect");
   
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
		         url:"<?php echo site_url('admin/email_mktg/allUserAjax'); ?>",
		         success:function(rdata)
		         {         
		             var obj = jQuery.parseJSON(rdata);
		              $("#modalBox #count_user").html(obj.count);
		              $("#modalBox #all_user").html(obj.html);  
		              $(".user_chk_cls").attr("checked", true);                  
		         }
		    });
		}
	//check login end
	}  
});
}
</script>

<script type="text/javascript">
function Import_from_Email()
{
    $("#modalBox #tab2").show();
    $("#modalBox #tab1").hide();
    $("#modalBox #tab3").hide();
    $("#modalBox #Import_from_Email").addClass("unselect");
    $("#modalBox #registered_Clients").removeClass("unselect");
    $("#modalBox #Import_from_CSV_file").removeClass("unselect");
}
</script>

<script type="text/javascript">
function Import_from_CSV_file()
{
    $("#modalBox #tab3").show();
    $("#modalBox #tab1").hide();
    $("#modalBox #tab2").hide();
    $("#modalBox #Import_from_CSV_file").addClass("unselect");
    $("#modalBox #Import_from_Email").removeClass("unselect");
    $("#modalBox #registered_Clients").removeClass("unselect");
	
}
</script>
<script>
function selectAll()
{

    $(".user_chk_cls").attr("checked", true);
    var count=0;
    $("input:checkbox[name=cus_chkbox]:checked").each(function()
    {
        count = count+1;

       // var value1= $(this).val();
        //week_arr.push(value1);
    });
    $("#modalBox #count_user").html(count);

}
</script>
<script>
function selectNone()
{

    $(".user_chk_cls").attr("checked", false);
    var count=0;
    $("input:checkbox[name=cus_chkbox]:checked").each(function()
    {
        count = count+1;

       // var value1= $(this).val();
        //week_arr.push(value1);
    });
    $("#modalBox #count_user").html(count);

}
</script>

<script>
function checkSelectedUser()
{
    var count=0;
    $("input:checkbox[name=cus_chkbox]:checked").each(function()
    {
        count = count+1;
        // var value1= $(this).val();
        //week_arr.push(value1);
    });
    $("#modalBox #count_user").html(count);
   // var json_week_arr = JSON.stringify(week_arr, null, 2);

}
    
</script>

<script>
function send_mail_btn()
{
   // var count=0;
   var tmplt_subject  =$('#tmplt_subject').val();
   var cuss_arr=new Array();
    $("input:checkbox[name=cus_chkbox]:checked").each(function()
    {
       var value1= $(this).val();
        cuss_arr.push(value1);
    });
    //$("#modalBox #count_user").html(count);
    var json_cuss_arr = JSON.stringify(cuss_arr, null, 2);
    
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
	             url:"<?php echo site_url('admin/email_mktg/sendMailAjax'); ?>",
	             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
	             data: { 'json_cuss_arr' : json_cuss_arr ,'tmplt_subject' : tmplt_subject},
	             success:function(rdata)
	             {         alert(rdata);
	                  //$("#modalBox #msg").html(rdata);            
	             }
	        });
		}
	//check login end
	}  
});
}
    
</script>
<script type="text/javascript" src="http://www.phpletter.com/contents/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript">
function ajaxFileUpload()
{
    $.ajaxFileUpload
    (
        {
            //YOUR URL TO RECEIVE THE FILE
            url: '<?php echo site_url('admin/email_mktg/uploadAjax'); ?>',
            secureuri:false,
            fileElementId:'fileToUpload',
            dataType: 'html',           
            success: function (data)
            {
                alert(data);
            },
            error: function (data)
            {
                alert(data);
            }
        }
    )
    return false;
}
</script>
<script>
function sendMailCsv()
{
    var frame = document.getElementById('iframeId');
    var checkboxes = frame.contentWindow.document.getElementsByName('cus_chkbox_csv');

    for (var i = 0; i < checkboxes.length; i++)
    {
        checkboxes[i].checked = true;
        alert('hi');
    }
    //alert('hi');
   var tmplt_subject  =$('#tmplt_subject').val();
   alert(tmplt_subject);
   var cuss_arr=new Array();
    $("input:checkbox[name=cus_chkbox_csv]:checked").each(function()
    {
       var value= $(this).val();
       var value1= $("#csv_hdn_id"+value).val();
       alert(value1);
        cuss_arr.push(value1);
    });
    //$("#modalBox #count_user").html(count);
    var json_cuss_arr = JSON.stringify(cuss_arr, null, 2);
   
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
             url:"<?php echo site_url('admin/email_mktg/sendMailCsvAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
             data: { 'json_cuss_arr' : json_cuss_arr ,'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {         //alert(rdata);
                  //$("#modalBox #msg").html(rdata);            
             }
     });
		}
	//check login end
	}  
});

}
</script>
<script>
function filter()
{
    var filter_hdn= $("#modalBox #filter_hdn").val(); 
    if(filter_hdn == 1)
    {
        $("#modalBox #filter").show(); 
        $("#modalBox #filter_hdn").val('0'); 
        $("#modalBox .reg_dtFrom").datepicker();
        $("#modalBox .reg_dtTo").datepicker();
        $("#modalBox .not_book_dtFrom").datepicker();
        $("#modalBox .not_book_dtTo").datepicker();
        
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
             url:"<?php echo site_url('admin/email_mktg/statusAjax'); ?>",
             success:function(rdata)
             {         //alert(rdata);
                  $("#modalBox #status_div").html(rdata);            
             }
        });
		}
	//check login end
	}  
});
    }
    else{
        $("#modalBox #filter").hide(); 
        $("#modalBox #filter_hdn").val('1');
    }
}
</script>

<?php //clint list ?>

<script language="javascript" type="text/javascript">
$(document).ready(function() { 
    $("#modalBox #isAdvancedSearch").hide();
    $("#modalBox #search_result").hide();
});
$.datepicker.formatDate('mm/dd/yy');

$(function(){

    $("#modalBox .reg_dtFrom").datepicker();
    $("#modalBox .reg_dtTo").datepicker();
    $("#modalBox .not_book_dtFrom").datepicker();
    $("#modalBox .not_book_dtTo").datepicker();
    //$("#cal_strting_dt").datepicker();
});

function lastWeek()	
{

    var currentTime = new Date();
    var dayno= currentTime.getDay() + 1;
    var month = currentTime.getMonth();
    var lastWeekEndday = currentTime.getDate()-dayno;
    var year = currentTime.getFullYear();
    $("#modalBox .reg_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday-6)));
    $("#modalBox .reg_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday)));
}

function lastMonth()	
{
    var currentTime = new Date();
    var month = currentTime.getMonth();
    var previous_month=month-1;
    var year = currentTime.getFullYear();
    $("#modalBox .reg_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, previous_month, 1)));
    $("#modalBox .reg_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, 0)));
}

function allClient()
{
    $("#modalBox .reg_dtFrom").val('');
    $("#modalBox .reg_dtTo").val('');
}

function show_advance_search()
{
    $("#modalBox #isAdvancedSearch").show();
    $("#modalBox #advancesearch").hide();
}	

function show_basic_search()
{
    $("#modalBox #advancesearch").show();
    $("#modalBox #isAdvancedSearch").hide();
}

function check_select()
{
    $("#modalBox #attr_last_booked_user").attr('checked','checked');

}

function lastWeekNotBook()	
{
    $("#modalBox #attr_last_booked_user").attr('checked','checked');
    var currentTime = new Date();
    var dayno= currentTime.getDay() + 1;
    var month = currentTime.getMonth();
    var lastWeekEndday = currentTime.getDate()-dayno;
    var year = currentTime.getFullYear();
    $("#modalBox .not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday-6)));
    $("#modalBox .not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday)));
}

function lastfifteenNotBook()	
{
    $("#modalBox #attr_last_booked_user").attr('checked','checked');
    var currentTime = new Date();
    var day=currentTime.getDate();
    var fifteendayLater=currentTime.getDate()-15;
    var month = currentTime.getMonth();
    var year = currentTime.getFullYear();
    $("#modalBox .not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, day)));
    $("#modalBox .not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, fifteendayLater)));

}

function comingWeek()
{
    $("#modalBox #attr_last_booked_user").attr('checked','checked');
    var currentTime = new Date();
    var dayno= currentTime.getDay();
    var daydiff=6-dayno;
    var month = currentTime.getMonth();
    var nextWeekStartday = currentTime.getDate()+(daydiff+1);
    var year = currentTime.getFullYear();
    $("#modalBox .not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, nextWeekStartday)));
    $("#modalBox .not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, nextWeekStartday+6)));
}

function searching() 
{
    var registrationfrom_date=$("#modalBox .reg_dtFrom").val();
    var registrationto_date=$("#modalBox .reg_dtTo").val();
    var clientTag=$("#modalBox #clientTag").val();
    var status=$("#modalBox #clientStatus").val();
    var tag=$("#modalBox #clientTag").val();
    var status=$("#modalBox #clientStatus").val();
    //alert(status);
   
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
		            url:"<?php echo site_url('admin/email_mktg/display_customer'); ?>",
		            data:"regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&status="+status,
		            success:function(rdata)
		            { 
		                $("#modalBox #filter_hdn").val('1');
		                $("#modalBox #filter").hide();
		                var obj = jQuery.parseJSON(rdata);
		                $("#modalBox #count_user").html(obj.count);
		                $("#modalBox #all_user").html(obj.html);  
		                $(".user_chk_cls").attr("checked", true); 
		            }
		    });
		}
	//check login end
	}  
});
}	
</script>

<script type="text/javascript">
	
	function Add_category(){
		pr_popup(550);
		
		var html = '<div class="registration-div"><form><table><thead><span style="color: #365F0B !important;font-weight:bold;"><?php echo $this->global_mod->db_parse($this->lang->line("add_new_cat"))?></span></thead><tr><td><?php echo $this->global_mod->db_parse($this->lang->line("cat_name"))?> :</td><td><input type="text" name="category_name" id="category_name" size="30px"  /><br /><span id="err_span"></span></td></tr><tr><td></td><td><input type="button" name="Add_btn" value="<?php echo $this->global_mod->db_parse($this->lang->line("add_btn"))?>" class="btn-gray-popup" onclick="submit_category()"  />&nbsp;<input type="button" name="cancel_btn" value="<?php echo $this->global_mod->db_parse($this->lang->line("cancel_btn"))?>" class="btn-gray-popup" onclick="close_popup()" /></td></tr></table></form></div>';
		
		$("#front_popup_content").html(html);
	}
	
	function submit_category(){
		$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				var category_name = $("#category_name").val();
				category_name = $.trim(category_name);
				if(category_name == ''){
					$("#err_span").html('Required Field');
					$("#err_span").css('color','#ff0000');
					return false;
				}else{
					pr_popup_close()
					lightbox_body();
					$.ajax({
			             type: 'POST',
			             datatype:'html',
			             url:"<?php echo site_url('admin/email_mktg/SaveCategory'); ?>",
			             data:{'category_name':category_name},
			             success:function(rdata)
			             {         
			             	if(rdata == 1){
			             		$('#fade , .popup_block').fadeOut(function() {
			        				$('#fade, .btn_close').remove();  //fade them both out
			        				window.location = window.location.pathname;
			    				});
								
							}         
			             }
					})
				
				}
			}	
		}
		})	
			
	}
	
	function close_popup(){
		
	    $('#fade , .popup_block').fadeOut(function() {
	        $('#fade, .btn_close').remove();  //fade them both out
	    });
	    return false;

	}
	
	function pr_popup_close(){
		$('#fade , .popup_block').fadeOut(function() {
			$('#front_popup_content').html('');			
			$('#fade, .btn_close').remove();  //fade them both out
		});
	}
	
	
	function SaveAsNew(eml_mrktn_templt_id,clicked_category){
		//alert(eml_mrktn_templt_id+' '+clicked_category);
		var tmplt_subject = $("#tmplt_subject").val();
		tmplt_subject = $.trim(tmplt_subject);
		var text = CKEDITOR.instances['tmplt_body'].getData();
		
		if(tmplt_subject == ''){
			$("#sub_err").html('Required Field');
			$("#sub_err").css('color','#ff0000');
			return false;
		}else{
			$("#sub_err").html('');
			
			$.ajax({
	             type: 'POST',
	             datatype:'html',
	             url:SITE_URL+'admin/email_mktg/SaveAsNewTemplate',
	             data:{'CategoryId':clicked_category,'Subject':tmplt_subject,'Body':text},
	             success:function(rdata){  
	             	if(rdata == 1){
	             		$('#fade , .popup_block').fadeOut(function() {
	        				$('#fade, .btn_close').remove();  //fade them both out
	        				window.location = window.location.pathname;
	    				});
						
					}         
	             }
				})
				
		}
		
	}
	
	
	function ShowMailArea(){
		
		$(".email_menu").css('display','none');
		$(".email_sender_menu").css('display','none');
		$("#TestMailArea").css('display','block');
	}
	
	function ShowMailAreaRev(){
		$("#TestMailArea").css('display','none');
		$("#searchlistingArea").css('display','none');
		$("#listarea").css('display','none');
		$(".email_sender_menu").css('display','block');
		
		$(".email_menu").css('display','block');
		$("#test_sender_mail").css('border','1px solid #CCCCCC');
		$("#test_sender_mail").val('');
		$("input:radio").attr("checked", false);
		
	}
	
	function PreviewMailBody(eml_mrktn_templt_id){
	lightbox_body();
	$.ajax({
	         type: 'POST',
	         datatype:'html',
	         url:SITE_URL+'admin/email_mktg/previewtemplateview',
	         data:{'tmplt_id':eml_mrktn_templt_id},
	         success:function(rdata){ 
	         	closeLightbox_body(); 
	         	pr_popup(700);
	         	$('#front_popup_content').html('');
	         	$('#front_popup_content').html(rdata);
	         }
	})
	}
	
	function SendTestMail(tmplt_id){
		pr_popup_close()
		lightbox_body();
		var test_sender_mail = $("#test_sender_mail").val();
		test_sender_mail = $.trim(test_sender_mail);
		if(test_sender_mail == ''){
			$("#test_sender_mail").css('border','1px solid #ff0000');
			return false;
		}else{
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
				if(testEmail.test(test_sender_mail)){
					$.ajax({
				             type: 'POST',
				             datatype:'html',
				             url:"<?php echo site_url('admin/email_mktg/sendTestMailAjax'); ?>",
				             data:{'EmailID':test_sender_mail,'tmplt_id':tmplt_id},
				             success:function(rdata)
				             { 
								closeLightbox_body();
				             	alert("Email is Sent.");
				             	$("#test_sender_mail").css('border','1px solid #FFFFFF');
				             	$("#TestMailArea").css('display','none');
								$(".email_menu").css('display','block');
				             }
					})
				}	
				else{
					$("#test_sender_mail").css('border','1px solid #ff0000');
					return false;
				}
		}	
	}
	
	function openList(alldata){
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
			
				if(result == 0){
					window.location.href = SITE_URL+'admin/login';
				}else{
					sendValue = alldata.value;
					$.ajax({
				             type: 'POST',
				             datatype:'html',
				             url:"<?php echo site_url('admin/email_mktg/getvaluebysendvalue'); ?>",
				             data:{'sendValue':sendValue},
				             success:function(rdata)
				             {
				             	$('#searchlistingArea').css('display','none');
				             	$('#listarea').css('display','block'); 
				             	$("#listarea").html(rdata);
								//alert(rdata);
								return false;
				             }
					})
				}	
			}
		})	
	}
	
	
	function searchCustomer(){
		var searchkey = $("#searchkey").val();
		searchkey = $.trim(searchkey);
		if(searchkey != ''){
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
					             url:"<?php echo site_url('admin/email_mktg/searchBycustomerName'); ?>",
					             data:{'searchkey':searchkey},
					             success:function(rdata)
					             {
					             	$('#searchlistingArea').css('display','block'); 
					             	$("#searchlistingArea").html(rdata);
									//alert(rdata);
									return false;
					             }
						})
					}	
				}
			})
		}else{
			return false;
		}	
	}
	
	function sendMailtoselectedCustomer(){
		lightbox_body();
		var chkmailId = '';
		$('.checked:checked').each(function() {
		  chkmailId += $(this).val() + ",";
		});
		chkmailId = chkmailId.slice(0,-1);
		if(chkmailId != ''){
			var selectedtemplateId = $("#selectedtemplateId").val();
			
			$.ajax({
		             type: 'POST',
		             datatype:'html',
		             url:"<?php echo site_url('admin/email_mktg/sendTestMailAjax'); ?>",
		             data:{'tmplt_id':selectedtemplateId,'mail_ids':chkmailId},
		             success:function(rdata)
		             {
		             	closeLightbox_body();
		             	//$('#searchlistingArea').css('display','block'); 
		             	//$("#searchlistingArea").html(rdata);
						if(rdata == 1){
							alert("Mail send successfully");
						}
						return false;
		             }
			})
			
		}else{
			alert("Select atleast one Customer name");
			return false;
		}
		
	}
	
	function sendmailtocusgroup(){
		lightbox_body();
		var cusGroup = '';
		$('.typelistclass:checked').each(function() {
		  cusGroup += $(this).val() + ",";
		});
		cusGroup = cusGroup.slice(0,-1);
		if(cusGroup != ''){
			var selectedtemplateId = $("#selectedtemplateId").val();
			$.ajax({
		             type: 'POST',
		             datatype:'html',
		             url:"<?php echo site_url('admin/email_mktg/sendmailTobycusgroup'); ?>",
		             data:{'tmplt_id':selectedtemplateId,'cusGroup':cusGroup},
		             success:function(rdata)
		             {
		             	
		             	closeLightbox_body();
		             	//$('#searchlistingArea').css('display','block'); 
		             	//$("#searchlistingArea").html(rdata);
						if(rdata == 1){
							alert("Mail send successfully");
						}
		             }
			})
		}else{
			alert("Select atleast one group");
			return false;
		}
	}
	
	
</script>

