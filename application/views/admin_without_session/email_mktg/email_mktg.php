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

<?php include('email_mktg.js.php'); ?>

<div class="rounded_corner_full" style="height:700px;">
<h1 class="headign-main"> Email Marketing </h1>
<div id="AllTemplate" >

			<div class="top-category">
            <ul>
          	<li><a href="javascript:void(0);" onclick="readyTemplate()"> Ready-to-send Templates</a></li>
           	<li> <a href="javascript:void(0);" onclick="myTemplate()">  My Templates</a></li>
            </ul>
			</div>
            

            
         <div class="email-category">   <?php echo $showAllCategory; ?></div>  

         
			<div  class="email-template">
            <div id="showAllTemplate" >	 <?php echo $showAllTemplate; ?></div>

            <div id="myTemplate" style="display:none;">	 <?php echo $myTemplate; ?></div>
               
            </div>
        

</div>


  <div id="selectedTemplate" style="display: none;" >
    <a href="javascript:void(0);" onclick="saveTemplate()">Save As(New)</a>&nbsp;
    <a href="javascript:void(0);" onclick="sendTestTemplate()">Send Test</a>&nbsp;
    <a href="javascript:void(0);" onclick="previewTemplate()">Preview</a>&nbsp;
    <a href="javascript:void(0);" onclick="sendTemplate()">Send</a>
    <div id="selectedTemplateShow" ></div>
       
</div>

    <a  class="openmodalbox" href="javascript:void(0);">
        <span class="modalboxContent" id="modal_show">
            <div id="saveTemplate" class="allPopupdiv" style="display: none;">                                
            </div> 
            <div id="sendTestTemplate" class="allPopupdiv"  style="display: none;"> 
                <div id="msg" style="color: green;text-align: center;"></div>
                <label for="testemail">Email:</label>
                <input type="text" name="test-email" maxlength="500" id="testemail" 
                       style="border:1px solid #B7B7B7;width:400px;border-radius: 3px 3px 3px 3px;">
                <input type="button" onclick="sendTestMail();" value="Send">
            </div> 
            <div id="previewTemplate" class="allPopupdiv"  style="display: none;">                                
            </div> 
            <div id="sendTemplate" class="allPopupdiv"  style="display: none;"> 
                <div id="tab_panel"> <!--login_panel -->
                    <div class="logintabs">
                        <ul id="clickme-ul">
                        <li onclick="registered_Clients()" id="registered_Clients"> Registered Clients</li>
                        <!--<li onclick="Import_from_Email()" id="Import_from_Email">Import from Email</li> -->
                        <li onclick="Import_from_CSV_file()" id="Import_from_CSV_file">Import from CSV file</li>
                        </ul>
                    </div>
                    <div class="allLoginText">               
                        <div id="tab1"> 
                            <div id="send_mail_div">
                                
                                Campaign will go to<br/>
                                <span id="count_user"></span>&nbsp; recipient(s)<br/>
                                in this segment<br/>
                                <input type="button" id="send_mail_btn" value="Send Mail" onclick="send_mail_btn()" >or 
                                <button onclick="filter()">Filter recipient</button> <br/>
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
                                                    <strong>From :&nbsp;</strong>
                                                    <input type="text"  class="reg_dtFrom" value="" style="border:1px solid #B7B7B7;width: 173px;">
                                                    <strong>To:&nbsp;</strong>
                                                    <input type="text" class="reg_dtTo" value="" style="border:1px solid #B7B7B7;width: 173px;">
                                                    </div>
                                                    <input type="button" onClick="javascript:lastWeek()" value="Last week" > 
                                                     | 
                                                    <input type="button" onClick="javascript:lastMonth()" value="Last month" >
                                                     | 
                                                    <input type="button" onClick="javascript:allClient()" value="All" > 

                                    </div>
                                    <div class="boxInput">
                                                            <table cellpadding="0" cellpadding="0" width="100%" border="0">
                                                <tr>
                                                    <td><span class="boxhead">Tags </span></td>
                                                    <td><input id="clientTag" type="text" style="border:1px solid #B7B7B7;width: 180px;"></td>
                                            </tr>

                                                    <tr>
                                            <td><span class="boxhead">Status </span></td>
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
                                    <span id="Span2">Advance Options</span>
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_alluser_check">&nbsp;Get All User:
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_user_no_appointment">&nbsp;Users With no appiontment:
                                    </div>
                                    <div class="boxInput">
                                    <input type="radio" name="attr_check" id="attr_last_booked_user">&nbsp;Not booked between:
                                    </div>
                                    <div class="boxInput">
                                                    <div>

                                                    <input type="text"  onFocus="check_select()" class="not_book_dtFrom" value="" style="border:1px solid #B7B7B7;width: 180px;">
                                                    <strong>to</strong>
                                                    <input type="text"  class="not_book_dtTo" onFocus="check_select()" value="" style="border:1px solid #B7B7B7;width: 180px;">
                                                    </div>
                                                    <input type="button" onClick="javascript:lastWeekNotBook()" value="Last week"> 
                                                     | 
                                                    <input type="button" onClick="javascript:lastfifteenNotBook()" value="Last 15 Days"> 
                                                     | 
                                                    <input type="button" onClick="javascript:comingWeek()" value="Coming Week">

                                    </div>
                                    <div class="boxButton" style="float:right;" >
                                    <input type="button"  onclick="javascript:show_basic_search();" value="Basic Search »">
                                    </div>
                                    </div>
                                    <div class="boxButton">
                                    <input type="button" onClick="searching()" class="btn-blue" value="Search">
                                    </div>
                                    <div class="boxButton" style="float:right;" id="advancesearch" >
                                    <input type="button"  onclick="javascript:show_advance_search();" value="Advance Search »">
                                    </div>
                                    </form>
                                    </div>

                                    </div>



                                    </div>
                                    </div>
                                    </div>

                            </div>
                            
                            <div id="all_user"></div>
                            <div id="loader" style="display: none;">hi</div>
                        </div>  
                        <div id="tab2" style="display:none"> 
                             <form id="form_login" class="styled" method="post">                            
                                <fieldset>                             
                                  <ol>
                                    <li style="width:155px;" class="form-row">                                  
                                        <div id="msg_t"></div>                                 
                                    </li >
                                    <li class="form-row"><label>Email:</label>
                                        <input name="email" id="email" type="text" class="text-input required" />
                                    </li>
                                    <li class="form-row"><label>Password:</label>
                                        <input name="password" type="password" id="password" class="text-input required password" />
                                    </li>
                                    <li>
                                        <div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
                                    </li>
                                    <li  style="text-align:right;">
                                        <input type="button" value="Import Contacts" onclick="importContact();" class="btn-gray-popup" style="margin-right:10px" />
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