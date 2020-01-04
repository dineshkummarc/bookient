<!-- JavaScript -->
<script>
function test(){
    var editorText = CKEDITOR.instances.answer.getData();
    alert(editorText);
}
</script>
<script type="text/javascript">
j(document).ready(function() {
    j('#question').focus(function(){
	    j('#qstn_err').html('');
	    //j('#ans_err').html('');
    });
	CKEDITOR.instances.answer.on('focus', function() {
        j('#ans_err').html("");
    });
});
</script>
<script type="text/javascript">
function submit_faq()
{
	var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j.trim(j('#question').val().replace(/<\/?[^>]+(>|j)/g, ""));
	var hiddenId = j('#faq_id').val();
	var error = 0;

        //alert(CKEDITOR.instances.answer.getData());

        var regex = /(<([^>]+)>)/ig;
        var result = editorText.replace(regex, "").replace(/&nbsp;/gi,'');
        result = j.trim(result);

        /*
	editorText = j(editorText).clone().find("script,noscript,style").remove().end().html();
        editorText = editorText.replace("&nbsp;","/nbsp;/");
        */


        /*
          editorText = editorText.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "");
          editorText = editorText.replace("&nbsp;","/nbsp;/");
        */

       inputText =  inputText.replace(/ +(?= )/g,'');
       //editorText =  editorText.replace(/ +(?= )/g,'');

	if(inputText == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;">Required Field</span>');
		error++;
	}
	if(result =='')
	{
		j('#ans_err').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
		error++;
	}

        if(error > 0)
	{
             return false;
        }

	if(error == 0)
	{
		params = { 'question' :  inputText, 'answer' : editorText, 'faq_id' : hiddenId };
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/faq_manager/SaveFAQAjax"); ?>',
			   data: params,
			   success: function(data){
				        var url = window.location.protocol + "//" + window.location.host + "/" ;
                                        window.location = url+"superadmin/faq_manager/index/IsPreserved/Y";
				}
		});
	}
}
</script>

<script type="text/javascript">
function hide_show_tbl()
{
	j('.tab_listing').hide();
	j('#add_faq').show();
	j('#faq_id').val('');
	j('#question').val('');
	CKEDITOR.instances.answer.setData('');
	j('#add_new_link').hide();
	j('#qstn_err').html('');
	j('#ans_err').html('');
	j("#sub_faq").attr('value', 'Add');



}
</script>


<script type="text/javascript">
function edit_faq(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/faq_manager/EditFAQAjax"); ?>',
		   dataType: 'json',
		   data: { 'faq_id' : id },
		   success: function(data){

				j('#add_faq').show();
				j('#faq_id').val(data.faq_id);
				j('#question').val(data.faq_question);
				CKEDITOR.instances.answer.setData(data.faq_answer);
				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j('#ans_err').html('');
				j("#sub_faq").attr('value', 'UPDATE');

			}
	});
}
</script>

<script type="text/javascript">
/*function del_faq(id)
{
	var r = confirm('Are you sure you want to delete this FAQ ?');

	if(r == true)
	{
		j.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/faq_manager/DelFAQAjax"); ?>',
			   data: { 'faq_id' : id },
			   success: function(data){
					j('#faq_listing').html(data);
					j('.super-listing-tabl tbody').paginate({
						status: j('#status'),
						controls: j('#paginate'),
						itemsPerPage: 5
			        });
				}
		});
	}
}*/
</script>

<script type="text/javascript">
function cancl_faq()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
}
</script>