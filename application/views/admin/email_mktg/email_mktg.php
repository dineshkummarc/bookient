<script type="text/javascript">
$("#AllTemplate .email-category ul>li").click(function(){
		$("#AllTemplate .email-category ul>li").removeClass('selected');      
        $(this).addClass('selected'); 		
})
$(".top-category ul li").click(function(){
$(".top-category ul li").removeClass("active")	
$(this).addClass("active")


					 })

$(document).ready(function(){
   $('li:first-child').addClass('selected'); 
   $(".top-category li:first-child").addClass('active')


$("#myTemplate .tmplt").mouseenter(function() {
$(this).append('<div class="close-email-temp"><img src="http://demo.pardco.com/images/x-close.png"/></div>');
$("#myTemplate .close-email-temp").click(function () {
 $(this).parent().hide();
});
});
$("#myTemplate .tmplt").mouseleave(function() {  
$('#myTemplate .close-email-temp').remove();
    });


 });

</script>
<style type="text/css">
	.colorpicker{
		z-index:999999 !important;
	}
</style>
<?php include('email_mktg.js.php'); ?>

<div class="rounded_corner_full" style="height:700px;">
<h1 class="headign-main"> <?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?> </h1>
<div id="AllTemplate" >
	<div style="float: right;"><a href="javascript:void(0);" onclick="Add_category()" class="add-customer"><?php echo $this->global_mod->db_parse($this->lang->line('add_new_cat'));?></a></div>
	<div class="email-category">
	<ul>
	<li><a href="javascript:void(0)" onclick="selectCat(0)">ALL</a></li>
	<?php foreach ($showAllCategory as $catArr){ ?>
	<li><a href="javascript:void(0)" onclick="selectCat('<?php echo $catArr['cat_id']; ?>')"><?php echo $catArr['cat_name']; ?></a></li>            <?php } ?>
	</ul> 	
	</div>  
		<div  class="email-template">
			<div id="showAllTemplate" >
				
			<?php foreach ($showAllTemplate as $tempArr){ ?>
				<div class="tmplt">
				<div class="hover_tmplt">
				<span><?php echo $tempArr['tem_subject'];?></span>
				<div class="tmplt-content">	
				<input type="button" class="use-bt1" name="preview_btn" id="preview_btn" value="<?php echo $this->lang->line('preview_btn');?>" onclick="PreviewMailBody('<?php echo $tempArr['tem_id'];?>')" >
				</div>
				</div>
				<div class="use-this">
				<input type="button" class="use-bt" onclick="select_template('<?php echo $tempArr['tem_id'];?>')" value="<?php echo $this->global_mod->db_parse($this->lang->line("use_this")); ?>" >
				</div>
				</div>
			 <?php } ?>
			
			</div>
			<div id="myTemplate" style="display:none;">	 <?php echo $myTemplate; ?></div>              
		</div>
</div>


  <div id="selectedTemplate" style="display: none;" >
    <a href="javascript:void(0);" onclick="saveTemplate()"><?php echo $this->global_mod->db_parse($this->lang->line('save_as_new')); ?></a>&nbsp;
    <a href="javascript:void(0);" onclick="sendTestTemplate()"><?php echo $this->global_mod->db_parse($this->lang->line('send_test')); ?></a>&nbsp;
    <a href="javascript:void(0);" onclick="previewTemplate()"><?php echo $this->global_mod->db_parse($this->lang->line('preview')); ?></a>&nbsp;
    <a href="javascript:void(0);" onclick="sendTemplate()"><?php echo $this->global_mod->db_parse($this->lang->line('send')); ?></a>
    <div id="selectedTemplateShow" ></div>
       
</div>

    <a  class="openmodalbox" href="javascript:void(0);">
        <span class="modalboxContent" id="modal_show">
            <div id="saveTemplate" class="allPopupdiv" style="display: none;">                                
            </div> 
           
            <div id="previewTemplate" class="allPopupdiv"  style="display: none;">                                
            </div> 
            <div id="sendTemplate" class="allPopupdiv"  style="display: none;"> 
                <div id="tab_panel"> <!--login_panel -->
                    <div class="logintabs">
                        <ul id="clickme-ul">
                        <li onclick="registered_Clients()" id="registered_Clients"> <?php echo $this->global_mod->db_parse($this->lang->line('registered_clients')); ?> </li>
                        <!--<li onclick="Import_from_Email()" id="Import_from_Email">Import from Email</li> -->
                        <li onclick="Import_from_CSV_file()" id="Import_from_CSV_file"><?php echo $this->global_mod->db_parse($this->lang->line('import_frm_csv')); ?></li>
                        </ul>
                    </div>
                    <div class="allLoginText">               
                        <div id="tab1"> 
                            <div id="send_mail_div">
                                
                                <?php echo $this->global_mod->db_parse($this->lang->line('campain_will_go_to')); ?><br/>
                                <span id="count_user"></span>&nbsp; <?php echo $this->global_mod->db_parse($this->lang->line('recipients')); ?><br/>
                                <?php echo $this->global_mod->db_parse($this->lang->line("in_this_sgment"));?><br/>
                                <input type="button" id="send_mail_btn" value="Send Mail" onclick="send_mail_btn()" ><?php echo $this->global_mod->db_parse($this->lang->line("or"));?> 
                                <button onclick="filter()"><?php echo $this->global_mod->db_parse($this->lang->line('filter_recipient')); ?></button> <br/>
                                <input type="hidden" value="1" id="filter_hdn">
                            </div>
                            <div id="filter" style="display: none;">                              
                                <div style="width:98%; margin:0 auto">
                                    <div id="mainDiv">
                                    </div>
                                    <div class="reportSearchBox">
                                    <div style="width: 480px;">
                                    <div class="popupBox">
                                    

                                    <div class="inner-div">
                                    <form action="" name="" method="post">
                                    <div class="boxInput">
                                                    <div>
                                                    <strong><?php echo $this->global_mod->db_parse($this->lang->line('from')); ?>&nbsp;</strong>
                                                    <input type="text"  class="reg_dtFrom" value="" style="border:1px solid #B7B7B7;width: 173px;">
                                                    <strong><?php echo $this->global_mod->db_parse($this->lang->line('to')); ?>&nbsp;</strong>
                                                    <input type="text" class="reg_dtTo" value="" style="border:1px solid #B7B7B7;width: 173px;">
                                                    </div>
                                                    <input type="button" onClick="javascript:lastWeek()" value="<?php echo $this->global_mod->db_parse($this->lang->line('last_week')); ?>" > 
                                                     | 
                                                    <input type="button" onClick="javascript:lastMonth()" value="<?php echo $this->global_mod->db_parse($this->lang->line('last_month')); ?>" >
                                                     | 
                                                    <input type="button" onClick="javascript:allClient()" value="<?php echo $this->global_mod->db_parse($this->lang->line('all')); ?>" > 

                                    </div>
                                    <div class="boxInput">
                                                            <table cellpadding="0" cellpadding="0" width="100%" border="0">
                                                <tr>
                                                    <td><span class="boxhead"><?php echo $this->global_mod->db_parse($this->lang->line('tags')); ?> </span></td>
                                                    <td><input id="clientTag" type="text" style="border:1px solid #B7B7B7;width: 180px;"></td>
                                            </tr>

                                                    <tr>
                                            <td><span class="boxhead"><?php echo $this->global_mod->db_parse($this->lang->line('status')); ?> </span></td>
                                                    <!--<select id="clientStatus">
                                                    <option value="all">All</option>
                                                    <option value="verified">Verified</option>
                                                    <option value="unverified">Unverified</option>
                                                    </select>-->
                                                    <td>
                                                        <?php //echo  $customer_status;   ?>
                                                        <div id="status_div"></div>
                                                    </td>

                                            </tr>

                                            </table>

                                    </div>
                                    <div id="isAdvancedSearch" style="display: none;"  >
                                    <div class="boxhead">
                                    <span id="Span2"><?php echo $this->global_mod->db_parse($this->lang->line('advance_options')); ?></span>
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_alluser_check">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('get_All_user')); ?>
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_user_no_appointment">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('users_with_no_appo')); ?>
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_last_booked_user">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('not_booked_between')); ?>
                                    </div>
                                    <div class="boxInput">
                                                    <div>

                                                    <input type="text"  onFocus="check_select()" class="not_book_dtFrom" value="" style="border:1px solid #B7B7B7;width: 180px;">
                                                    <strong><?php echo $this->global_mod->db_parse($this->lang->line('to_sml')); ?></strong>
                                                    <input type="text"  class="not_book_dtTo" onFocus="check_select()" value="" style="border:1px solid #B7B7B7;width: 180px;">
                                                    </div>
                                                    <input type="button" onClick="javascript:lastWeekNotBook()" value="<?php echo $this->global_mod->db_parse($this->lang->line('last_week')); ?>"> 
                                                     | 
                                                    <input type="button" onClick="javascript:lastfifteenNotBook()" value="<?php echo $this->global_mod->db_parse($this->lang->line('last_fifteendays')); ?>"> 
                                                     | 
                                                    <input type="button" onClick="javascript:comingWeek()" value="<?php echo $this->global_mod->db_parse($this->lang->line('coming_week')); ?>">

                                    </div>
                                    <div class="boxButton" style="float:right;" >
                                    <input type="button"  onclick="javascript:show_basic_search();" value="<?php echo $this->global_mod->db_parse($this->lang->line('basic_search')); ?>">
                                    </div>
                                    </div>
                                    <div class="boxButton">
                                    <input type="button" onClick="searching()" class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('search')); ?>">
                                    </div>
                                    <div class="boxButton" style="float:right;" id="advancesearch" >
                                    <input type="button"  onclick="javascript:show_advance_search();" value="<?php echo $this->global_mod->db_parse($this->lang->line('advance_search')); ?>">
                                    </div>
                                    </form>
                                    </div>

                                    </div>



                                    </div>
                                    </div>
                                    </div>

                            </div>
                            
                            <div id="all_user"></div>
                            <div id="loader" style="display: none;"><?php echo $this->global_mod->db_parse($this->lang->line('hi')); ?></div>
                        </div>  
                        <div id="tab2" style="display:none"> 
                             <form id="form_login" class="styled" method="post">                            
                                <fieldset>                             
                                  <ol>
                                    <li style="width:155px;" class="form-row">                                  
                                        <div id="msg_t"></div>                                 
                                    </li >
                                    <li class="form-row"><label><?php echo $this->global_mod->db_parse($this->lang->line('email')); ?></label>
                                        <input name="email" id="email" type="text" class="text-input required" />
                                    </li>
                                    <li class="form-row"><label><?php echo $this->global_mod->db_parse($this->lang->line('password')); ?></label>
                                        <input name="password" type="password" id="password" class="text-input required password" />
                                    </li>
                                    <li>
                                        <div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
                                    </li>
                                    <li  style="text-align:right;">
                                        <input type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('import_contacts')); ?>" onclick="importContact();" class="btn-gray-popup" style="margin-right:10px" />
                                    </li>                                   
                                  </ol>
                                </fieldset>
                            </form>
                         </div>
                        <div id="tab3" style="display:none;"> 
                            <iframe src="<?php echo site_url('admin/email_mktg/uploadAjax'); ?>" id="iframeId"  height="220px" width="490px"></iframe>                              
                        </div>                       
                 </div>
            </div>
            </div>      
        </span>
    </a>
</div>
<input type="hidden" name="hdn_categoryid" id="hdn_categoryid" value="" />
<input type="hidden" name="selectedtemplateId" id="selectedtemplateId" value="" />

<script type="text/javascript">
$("#AllTemplate .email-category ul>li").click(function(){
		$("#AllTemplate .email-category ul>li").removeClass('selected');      
        $(this).addClass('selected'); 		
})
$(".top-category ul li").click(function(){
$(".top-category ul li").removeClass("active")	
$(this).addClass("active")

				 })

$(document).ready(function(){
$("#AllTemplate .email-category ul>li").addClass('selected');

 });

</script>
