<script type="text/javascript">
		j(document).ready(function() {

			j('.required').focus(function(){
				var jparent = j(this).parent();
				jparent.removeClass('error');
				j('span.error',jparent).html('');
			});




                    /*CKEDITOR.instances.membership_description.on('focus', function() {
                        j('#ans_err').html("");
                    });*/

                    CKEDITOR.instances.sub_plan_desc.on('focus', function() {
                        j('#ans_err_subs').html("");
                    });


               });


</script>

<script type="text/javascript">
function hide_show_subs()
{
	j('.tab_listing').hide();
	j('#add_subs').show();
	j('#plan_subscriptions_id').val('');
	CKEDITOR.instances.sub_plan_desc.setData('');
	j('#amount').val('');
	j('#validity').val('');
	j('#extra_validity').val('');
	j('#sub_subs').val('Add');
	//CB#SOG#16-11-2012#PR#S
	j('#add_subs_link').hide();
	 var jformId = j('#subs_frm');
	j('.required',jformId).each(function(){
		var jparent = j(this).parent();
		jparent.removeClass('error');
		j('span.error',jparent).hide();
	});
	j('#ans_err_subs').html('');
	//CB#SOG#16-11-2012#PR#E
}
</script>

<script type="text/javascript">
function cancl_subs()
{
	j('#plan_subscriptions_id').val('');
	CKEDITOR.instances.sub_plan_desc.setData('');
	j('#amount').val('');
	j('#validity').val('');
	j('#extra_validity').val('');
	j('#sub_subs').val('Add');
	j('#add_subs').hide();
	j('.tab_listing').show();
	//CB#SOG#16-11-2012#PR#S
	j('#add_subs_link').show();
	//CB#SOG#16-11-2012#PR#E

}
</script>

<script type="text/javascript">
function edit_subs(plan_subscriptions_id)
{
	j('.tab_listing').hide();
	j('#add_subs').show();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/membership_plan/GetSubscriptionDataAjax"); ?>',
		   dataType: 'json',
		   data: { 'plan_subscriptions_id' : plan_subscriptions_id },
		   success: function(data){
		        //CB#SOG#16-11-2012#PR#S
		        var jformId = j('#subs_frm');
				j('.required',jformId).each(function(){
					var jparent = j(this).parent();
					jparent.removeClass('error');
					j('span.error',jparent).hide();
				});
				j('#ans_err_subs').html('');
				 //CB#SOG#16-11-2012#PR#E

				j('#plan_subscriptions_id').val(plan_subscriptions_id);
				CKEDITOR.instances.sub_plan_desc.setData(data.sub_plan_desc);
				j('#amount').val(data.amount);
				j('#validity').val(data.validity);
				j('#extra_validity').val(data.extra_validity);
				j('#sub_subs').val('Update');

			}
	});
}
</script>

<script type="text/javascript">
function submit_subs()
{
	var editorText = CKEDITOR.instances.sub_plan_desc.getData();
	var hiddenId = j('#plan_subscriptions_id').val();
	var membership_type_id = j('#membership_plan_id').val();
	var error = 0;

	if(j.trim(editorText) == '')
	{
		j('#ans_err_subs').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
		error++;
	}

	var jformId = j('#subs_frm');
	var formAction = jformId.attr('action');
	var jerror = j('<span class="error" style="color:#FF0000;"></span>');

	j('li',jformId).removeClass('error');
	j('span.error').remove();
	j('.required',jformId).each(function(){
		var inputVal = j(this).val();
		var jparentTag = j(this).parent();
		if(j.trim(inputVal) == ''){
			jparentTag.addClass('error').append(jerror.clone().text('Required Field'));
                        error++;
		}
	});
        if(error > 0)
        {
            return false;
        }
	//CB#SOG#17-12-2012#PR#S
	j('.required').each(function(){
		if(j(this).attr('id') == 'amount')
		{
			 var curr_pattern = /^\d+(?:\.\d{0,2})$/ ;
			 var value = j(this).val();
			 if(curr_pattern.test(value) == false) {
				var jparentTag = j(this).parent();
				jparentTag.addClass('error').append(jerror.clone().text('Invalid Currency Format.It should be in 0.00 format.'));
				error++;
                          }
		}
                if(j(this).attr('id') == 'validity')
		{
                    var numbers = /^[0-9]+$/;
                    var value = j(this).val();
                    if(numbers.test(value) == false)
                    {
                       var jparentTag = j(this).parent();
                       jparentTag.addClass('error').append(jerror.clone().text('Validity should be numeric.'));
                       error++;
                    }

                }
                 if(j(this).attr('id') == 'extra_validity')
		{
                    var numbers = /^[0-9]+$/;
                    var value = j(this).val();
                    if(numbers.test(value) == false)
                    {
                       var jparentTag = j(this).parent();
                       jparentTag.addClass('error').append(jerror.clone().text('Extra Validity should be numeric.'));
                       error++;
                    }

                }


	});
	//CB#SOG#17-12-2012#PR#E
	if (j('span.error').length > 0) {
			j('span.error').each(function(){
				var distance = 5;
				var width = j(this).outerWidth();
				var start = width + distance;
				j(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}
	else
	{
		if(error == 0)
		{
			var frmID='#subs_frm';
			var params ={ 'membership_type_id' : membership_type_id };
			var paramsObj = j(frmID).serializeArray();
			j.each(paramsObj, function(i, field){
				if(field.name == 'sub_plan_desc')
					params[field.name] = editorText;
				else
					params[field.name] = j.trim(field.value);
			});

			j.ajax({
				   type: 'POST',
				   url: '<?php echo site_url("superadmin/membership_plan/SaveSubsAjax"); ?>',
				   data: params,
				   success: function(data){
						/*j('#listing_subscription').show();
						j('#listing_subscription').html(data);
						j('#add_subs').hide();

						j('#add_subs_link').show();*/


                                                 //return false;
                                               var url = window.location.protocol + "//" + window.location.host + "/" ;
                                               window.location = url+"superadmin/membership_plan/plan_subscription/<?= $id?>/IsPreserved/Y";



					}
			});
		}
	}
}
</script>

<script type="text/javascript">
function del_subs(id)
{
    jQuery.prompt("Delete this Subscription ?",{

		  callback: function(v,m,f){
			    if(v){

                                    var  url = '<?php echo site_url("superadmin/membership_plan/plan_subscription/id/".$id); ?>';
                                    //alert(url);
                                    Con_firm_Delete(url,id);
                            }
			     else
			     return false;
		  }
                  ,
		  buttons:{Ok:true,Cancel:false},
		  prefix:'extblue'
	});

}
</script>