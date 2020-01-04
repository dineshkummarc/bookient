<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {

			j('.required').focus(function(){
				/*var jparent = j(this).parent();
				jparent.removeClass('error');
				j('span.error',jparent).hide();*/
                                j('#qstn_err').html('');
			});

		});
	</script>
<script type="text/javascript">

function submit_profession()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j.trim(j('#professionname').val());
	var hiddenId = j('#profession_id').val();

	var error = 0;
        //alert(inputText);

	if(inputText == "")
	{
                //alert(inputText);
		j('#qstn_err').html('Required Field');
		error++;
                return false;
	}

        if(error == 0)
	{


                var params = { 'professionname' :  inputText,'profession_id' : hiddenId };
                          j.ajax({
                                    type: 'POST',
                                    url: '<?php  echo site_url("superadmin/profession_manager/Get_title_Ajax"); ?>',
                                    data: params,
                                    success: function(data){
                                             //alert(data);
                                            if(data == 1)
                                            {
                                                 var params1 = { 'professionname' :  inputText,'profession_id' : hiddenId };
                                                 j.ajax({
                                                                type: 'POST',
                                                                url: '<?php echo site_url("superadmin/profession_manager/SavePROFESSIONAjax"); ?>',
                                                                data: params1,
                                                                success: function(data1){

                                                                        //alert(data);
                                                                        var url = window.location.protocol + "//" + window.location.host + "/" ;
                                                                        window.location = url+"superadmin/profession_manager/index/IsPreserved/Y";

                                                                     }
                                                     });

                                            }
                                            else
                                            {
                                                   /* var jparentTag = j('#faq_frm #membership_name').parent();
                                                    var jerror = j('<span class="error" style="color:#FF0000;"></span>');
                                                    jparentTag.addClass('error').append(jerror.clone().text('Membership Title already exists.'));*/
                                                    j('#qstn_err').html('Profession Name already exists.');
                                                    return false;
                                            }
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
	j('#profession_id').val('');
	j('#professionname').val('');

	j('#add_new_link').hide();
	j('#qstn_err').html('');

	j("#sub_profession").attr('value', 'Add');

}
</script>



<script type="text/javascript">
function edit_profession(id)
{

	j('.tab_listing').hide();
	j('#add_new_link').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/profession_manager/EditPROFESSIONAjax"); ?>',
		   dataType: 'json',
		   data: { 'profession_id' : id },
		   success: function(data){
			       j('#add_faq').show();

				j('#profession_id').val(data.profession_id);
				j('#professionname').val(data.profession_name);
				j('#qstn_err').html('');

				j("#sub_profession").attr('value', 'Update');

			}
	});
}
</script>

<script type="text/javascript">
    /*
function del_profession(id)
{
	var r = confirm('Are you sure you want to delete this PROFESSION ?');

	if(r == true)
	{
		j.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/profession_manager/DelPROFESSIONAjax"); ?>',
			   data: { 'profession_id' : id },
			   success: function(data){
					j('#profession_listing').html(data);
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
function cancl_profession()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();

}
</script>