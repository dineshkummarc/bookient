<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {

			j('#loginname').focus(function(){
				j('#qstn_err').html('');
			});
			j('#loginidentifier').focus(function(){
				j('#identi_err').html('');
			});


		});
	</script>

<script type="text/javascript">

function submit_loginmethod()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j('#loginname').val();
	var inputIdent = j('#loginidentifier').val();
	var hiddenId = j('#login_typ_id').val();
	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error++;
	}

	if(j.trim(inputIdent) == '')
	{
		j('#identi_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error++;
	}
        if(error> 0)
        {
            return false;
        }


	if(error == 0)
	{
		params = { 'login_name' :  inputText,'login_typ_id' : hiddenId,'login_identifier':inputIdent };
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/loginmethod_manager/SaveLOGINMETHODAjax"); ?>',
			   data: params,
			   success: function(data){
			                //alert(data);
                                        var url = window.location.protocol + "//" + window.location.host + "/" ;
                                        window.location = url+"superadmin/loginmethod_manager/index/IsPreserved/Y";

				       /*j('.tab_listing').show();
					j('#faq_listing').html(data);
					j('#add_faq').hide();

					j('#add_new_link').show();*/

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
	j('#loginname').val('');
	j('#loginidentifier').val('');
	j('#login_typ_id').val('');

	j('#add_new_link').hide();
	j('#qstn_err').html('');
        j('#identi_err').html('');
	j("#sub_loginmethod").attr('value', 'Add');

}
</script>


<script type="text/javascript">
function edit_loginmethod(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/loginmethod_manager/EditLOGINMETHODAjax"); ?>',
		   dataType: 'json',
		   data: { 'login_typ_id' : id },
		   success: function(data){

				j('#add_faq').show();
				j('#loginname').val(data.login_name);
				j('#login_typ_id').val(data.login_typ_id);
				j('#loginidentifier').val(data.login_identifier);

				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j('#identi_err').html('');
				j("#sub_loginmethod").attr('value', 'Update');

			}
	});
}
</script>

<script type="text/javascript">
/*
function del_loginmethod(id)
{
	var r = confirm('Are you sure you want to delete this Login Name ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/loginmethod_manager/DelLOGINMETHODAjax"); ?>',
			   data: { 'login_typ_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
					// Paginate table rows
					$('.super-listing-tabl tbody').paginate({
					status: $('#status'),
					controls: $('#paginate'),
					itemsPerPage: 5
					});
				}
		});
	}
}
*/
</script>

<script type="text/javascript">
function cancl_loginmethod()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
}
</script>