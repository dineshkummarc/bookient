<!-- JavaScript -->
<script type="text/javascript">
	j(document).ready(function() {

			j('#languagesname').focus(function(){
				j('#qstn_err').html('');
			});
                        j('#userfile').focus(function(){
				j('#file_err').html('');
			});

	});
</script>



<script type="text/javascript">


function submit_language()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j('#languagesname').val();
	var hiddenId = j('#languages_id').val();
	var file_path = j('#userfile').val();
        //var file = j('#userfile').get(0).files[0];

	//var serialized = $('#faq_frm').serialize();

	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}

        if(error > 0)
        {
            return false;
        }
        if(file_path != "")
        {
                var extall="jpg,jpeg,gif,png";
                ext = file_path.split('.').pop().toLowerCase();
                if(parseInt(extall.indexOf(ext)) < 0)
                {
                        //alert('Extension support : ' + extall);
                        j('#file_err').html('<span style="color:#FF0000;font-size:10px;">Extension support :' + extall+' only.</span>');
                        error++;
                        return false;
                }
                var file_size = j('#userfile').get(0).files[0];
                //alert(file_size.size);
                 if(file_size.size > 51200)//51200 bytes = 50Kb
                 {
                      j('#file_err').html('<span style="color:#FF0000;font-size:10px;">Max. upload size is 50 Kb</span>');
                        error++;
                        return false;
                 }


        }




	if(error == 0) {
		j('#faq_frm').submit();

	}

	/*if(error == 0)
	{
		params = { 'languages_name' :  inputText,'languages_id' : hiddenId};
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/language_manager/SaveLANGUAGEAjax"); ?>',
			   data: params,
			   success: function(data){
			   //alert(data);
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
					$('.super-listing-tabl tbody').paginate({
						status: $('#status'),
						controls: $('#paginate'),
						itemsPerPage: 5
					});
					//CB#SOG#15-11-2012#PR#S
					$('#add_new_link').show();
					//CB#SOG#15-11-2012#PR#E
				}
		});
	}*/
}
</script>

<script type="text/javascript">
function hide_show_tbl()
{
	j('.tab_listing').hide();
	j('#add_faq').show();
	j('#languagesname').val('');
	j('#languages_id').val('');

	j('#add_new_link').hide();
	j('#qstn_err').html('');
        j('#userfile').val('');


	j("#sub_language").attr('value', 'Add');

	j('#add_img').html('');
}
</script>



<script type="text/javascript">
function edit_language(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/language_manager/EditLANGUAGEAjax"); ?>',
		   dataType: 'json',
		   data: { 'languages_id' : id },
		   success: function(data){
			   //alert(data);
			    j('#add_faq').show();
				j('#add_faq').show();
				j('#languages_id').val(data.languages_id);
				j('#languagesname').val(data.language_flag);
                                 j('#userfile').val('');
				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j("#sub_language").attr('value', 'Update');


				var path = '<?php echo base_url(); ?>uploads/language/'+data.image;



				j('#add_img').html('<img id="staffImg" src="'+path+'" height="18"/>');



			}
	});
}
</script>

<script type="text/javascript">
/*function del_language(id)
{
	var r = confirm('Are you sure you want to delete this Language ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/language_manager/DelLANGUAGEAjax"); ?>',
			   data: { 'languages_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
					$('.super-listing-tabl tbody').paginate({
						status: $('#status'),
						controls: $('#paginate'),
						itemsPerPage: 5
					});
				}
		});
	}
}*/
</script>

<script type="text/javascript">
function cancl_language()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();

}
</script>

