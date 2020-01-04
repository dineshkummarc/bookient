<script type="text/javascript">
	$(document).ready(function(){
		var editorText = CKEDITOR.instances;
	});
</script>                
<script type="text/javascript">
$(function () {
    $('#popup-wrapper').modalPopLite({ openButton: '#clicker', closeButton: '#close-btn' });
});
</script>
<script>
function select_template(eml_mrktn_templt_id){
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/email_mktg/selectTemplateAjax'); ?>",
		  data:"eml_mrktn_templt_id="+eml_mrktn_templt_id,
		  success:function(rdata){ 
		  	pr_popup(600);
			$('#front_popup_content').html(rdata);
			//$("#selectedTemplate").html(rdata);
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
</script>
<script>
function select_my_template(eml_mrktn_templt_id)
{
	//alert(eml_mrktn_templt_id);
	//$('.openmodalbox').trigger('click');
	$('#selectedTemplate').html('');
	$('#selectedTemplate').show();
	$('#AllTemplate').hide();
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
</script>
<script>
function selectCat(eml_mrktn_templt_cat_id)
{
	//alert(eml_mrktn_templt_cat_id);
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/email_mktg/selectCatAjax'); ?>",
		  data:"eml_mrktn_templt_cat_id="+eml_mrktn_templt_cat_id,
		  success:function(rdata)
		  { 
			$("#showAllTemplate").html(rdata);
			//alert(rdata); 
		  }
	});
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/email_mktg/selectCatForMyTempltAjax'); ?>",
		  data:"eml_mrktn_templt_cat_id="+eml_mrktn_templt_cat_id,
		  success:function(rdata)
		  { 
			$("#myTemplate").html(rdata);
			//alert(rdata); 
		  }
	});
}
</script>
<script>
function readyTemplate()
{
	//alert("hhh");
	$('#myTemplate').hide();
	$('#showAllTemplate').show();
}
</script>
<script>
function myTemplate()
{
	//alert("gg");
	$('#myTemplate').show();
	$('#showAllTemplate').hide();
}
</script>
<script>
function closeAll()
{
	//alert("gg");
	$('#selectedTemplate').hide();
	$('#AllTemplate').show();
}
</script>
<script>
function editHeader()
{
	//alert("gg");
	$('#header_show').hide();
	$('#header_editor').show();
}
</script>
<script>
function editContent()
{
	//alert("gg");
	$('#content_show').hide();
	$('#content_editor').show();
}
</script>
<script>
function editFooter()
{
	//alert("gg");
	$('#footer_show').hide();
	$('#footer_editor').show();
}
</script>
<script>
function cancelHeader()
{
	//alert("gg");
	$('#header_show').show();
	$('#header_editor').hide();
}
</script>

<script>
function cancelContent()
{
	//alert("gg");
	$('#content_show').show();
	$('#content_editor').hide();
}
</script>
<script>
function cancelFooter()
{
	//alert("gg");
	$('#footer_show').show();
	$('#footer_editor').hide();
}
</script>
<script>
function saveHeader(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["header_area"+uniq_id];
    var value = editor.getData();
    //alert(value);
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
</script>
<script>
function saveContent(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["content"+uniq_id];
    var value = editor.getData();
    //alert(value);
    $.ajax({
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/saveContentAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
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
</script>
<script>
function saveFooter(eml_mrktn_templt_id , uniq_id)
{
    var editor= CKEDITOR.instances["footer_area"+uniq_id];
    var value = editor.getData();
    //alert(value);
    $.ajax({
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/saveFooterAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
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
</script>
<script>
function saveTemplate(eml_mrktn_templt_id)
{
   
 /*
    var uniq_id_header= $("#uniq_id_header").val();
    var editor= CKEDITOR.instances["header_area"+uniq_id_header];
    var tmplt_header_content = editor.getData();
    alert(tmplt_header_content);

    var uniq_id_header= $("#uniq_id_header").val();
    var editor= CKEDITOR.instances["content"+uniq_id_header];
    var tmplt_body_content = editor.getData();
    alert(tmplt_body_content);

    var uniq_id_header= $("#uniq_id_header").val();
    var editor= CKEDITOR.instances["footer_area"+uniq_id_header];
    var tmplt_footer_content = editor.getData();
    alert(tmplt_footer_content);*/
    var eml_mrktn_templt_cat_id = $('#template_cat').val();
    var tmplt_name  =$('#template_name').val();
    var tmplt_subject  =$('#tmplt_subject').val();
    //alert(tmplt_name);
   
         $.ajax({
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/saveTemplateAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
              data: { 'eml_mrktn_templt_id' : eml_mrktn_templt_id,'eml_mrktn_templt_cat_id' : eml_mrktn_templt_cat_id,
                        'tmplt_name' : tmplt_name,'tmplt_subject' : tmplt_subject},
             success:function()
             { 
                   
                  
                    $(".allPopupdiv").hide();
                   $("#saveTemplate").show();
                    $("#saveTemplate").html("User template successfully saved.");
                   $('.openmodalbox').trigger('click');
                   //alert(rdata); 
                    
             }
         });
        
   
}
</script>
<script>
function updateTemplate(eml_mrktn_templt_local_admin_id)
{
  
    var eml_mrktn_templt_cat_id = $('#template_cat').val();
    var tmplt_name  =$('#template_name').val();
    //alert(eml_mrktn_templt_local_admin_id);
   var tmplt_subject  =$('#tmplt_subject').val();
   //alert(tmplt_subject);
    $.ajax({
        type: 'POST',
        datatype:'html',
        url:"<?php echo site_url('admin/email_mktg/updateTemplateAjax'); ?>",
        //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
         data: { 'eml_mrktn_templt_local_admin_id' : eml_mrktn_templt_local_admin_id,'eml_mrktn_templt_cat_id' : eml_mrktn_templt_cat_id,
                   'tmplt_name' : tmplt_name,'tmplt_subject' : tmplt_subject},
        success:function()
        { 


            $(".allPopupdiv").hide();
            $("#saveTemplate").show();
            $("#saveTemplate").html("User template successfully saved.");
            $('.openmodalbox').trigger('click');
           //alert(rdata); 

        }
    });
        
   
}
</script>
<script>
function previewTemplate(eml_mrktn_templt_id)
{
    
   
    //alert(value);
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
</script>

<script>
function sendTestTemplate(eml_mrktn_templt_id)
{
    $(".allPopupdiv").hide();
    $("#sendTestTemplate").show();
    $('.openmodalbox').trigger('click'); 
}
</script>

<script>
function sendTestMail()
{
    
   var testemail = $("#modalBox #testemail").val();
    //alert(testemail);
    var tmplt_subject  =$('#tmplt_subject').val();
    $.ajax({
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/sendTestMailAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
              data: { 'testemail' : testemail,'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {                  
                  $("#modalBox #msg").html(rdata);                    
             }
    });
}
</script>


<script>
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
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/allUserAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
             // data: { 'testemail' : testemail,'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {         
                 var obj = jQuery.parseJSON(rdata);
                  $("#modalBox #count_user").html(obj.count);
                  $("#modalBox #all_user").html(obj.html);  
                  $(".user_chk_cls").attr("checked", true);                  
             }
        });
        var tmplt_subject  =$('#tmplt_subject').val();
        //alert(tmplt_subject);
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
         type: 'POST',
         datatype:'html',
         url:"<?php echo site_url('admin/email_mktg/allUserAjax'); ?>",
         //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
         // data: { 'testemail' : testemail,'tmplt_subject' : tmplt_subject},
         success:function(rdata)
         {         
             var obj = jQuery.parseJSON(rdata);
              $("#modalBox #count_user").html(obj.count);
              $("#modalBox #all_user").html(obj.html);  
              $(".user_chk_cls").attr("checked", true);                  
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
    
</script>
<script type="text/javascript" src="http://www.phpletter.com/contents/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript">
function ajaxFileUpload()
{
    alert("1");
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
             type: 'POST',
             datatype:'html',
             url:"<?php echo site_url('admin/email_mktg/statusAjax'); ?>",
             //data:"eml_mrktn_templt_id="+eml_mrktn_templt_id+"&tmplt_body_content="+value,
             //data: { 'json_cuss_arr' : json_cuss_arr ,'tmplt_subject' : tmplt_subject},
             success:function(rdata)
             {         //alert(rdata);
                  $("#modalBox #status_div").html(rdata);            
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
</script>
