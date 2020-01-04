

<script language="javascript" type="text/javascript">


$(document).ready(function() {

        $("#isAdvancedSearch").hide();

        $("#reg_dtFrom").focus(function () {
                 $("#reg_date_err").html("");
        });
        $("#reg_dtTo").focus(function () {
                 $("#reg_date_err").html("");
        });
        $("#not_book_dtFrom").focus(function () {
                $("#not_booked_betw_err").html("");
       });
       $("#not_book_dtTo").focus(function () {
                $("#not_booked_betw_err").html("");
       });

});
$.datepicker.formatDate('mm/dd/yy');

$(function() {

		$("#reg_dtFrom").datepicker();
		$("#reg_dtTo").datepicker();
		$("#not_book_dtFrom").datepicker();
		$("#not_book_dtTo").datepicker();
		//$("#cal_strting_dt").datepicker();
	});

function lastWeek(){

        $("#reg_date_err").html("");
        $("#date_listing").show();
	var currentTime = new Date();
    var dayno= currentTime.getDay() + 1;
	//alert(dayno);

	var month = currentTime.getMonth();

	var lastWeekEndday = currentTime.getDate()-dayno;

	var year = currentTime.getFullYear();

$("#reg_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday-6)));
//alert(date1);
$("#reg_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday)));


}

function lastMonth(){
	$("#reg_date_err").html("");
	$("#date_listing").show();
	var currentTime = new Date();
	var month = currentTime.getMonth();
	var previous_month=month-1;
	var year = currentTime.getFullYear();

$("#reg_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, previous_month, 1)));
$("#reg_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, 0)));
}

function allClient(){
	$("#reg_date_err").html("");
	$("#reg_dtFrom").val('');
	$("#reg_dtTo").val('');
	$("#date_listing").hide();
}

function show_advance_search(){
	$("#isAdvancedSearch").show();
	$("#advancesearch").hide();
}

function show_basic_search()
{


$("#advancesearch").show();
$("#isAdvancedSearch").hide();


}

function check_select()

{
//alert("hi");
$("#attr_last_booked_user").attr('checked','checked');

}

function lastWeekNotBook()
{
        $("#not_booked_betw_err").html("");
	$("#attr_last_booked_user").attr('checked','checked');

	var currentTime = new Date();
    var dayno= currentTime.getDay() + 1;
	//alert(dayno);

	var month = currentTime.getMonth();

	var lastWeekEndday = currentTime.getDate()-dayno;

	var year = currentTime.getFullYear();

$("#not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday-6)));
//alert(date1);
$("#not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, lastWeekEndday)));


}

function lastfifteenNotBook()
{
        $("#not_booked_betw_err").html("");
	$("#attr_last_booked_user").attr('checked','checked');
	var currentTime = new Date();
	var day=currentTime.getDate();
	var fifteendayLater=currentTime.getDate()-15;
	var month = currentTime.getMonth();
	var year = currentTime.getFullYear();
	$("#not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, day)));
	$("#not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, fifteendayLater)));

}

function comingWeek()
{

$("#not_booked_betw_err").html("");
$("#attr_last_booked_user").attr('checked','checked');
var currentTime = new Date();
    var dayno= currentTime.getDay();
	var daydiff=6-dayno;
	//alert(daydiff);

	var month = currentTime.getMonth();

	var nextWeekStartday = currentTime.getDate()+(daydiff+1);

	var year = currentTime.getFullYear();

$("#not_book_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, nextWeekStartday)));
//alert(date1);
$("#not_book_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, nextWeekStartday+6)));




}

function searching()
{
	
	
	

//CB#SOG#18-2-2013#PR#S
$("#search_result").html("");
var registrationfrom_date=$("#reg_dtFrom").val();
var registrationto_date=$("#reg_dtTo").val();

if(registrationfrom_date !="" && registrationto_date !="")
{
    var reg_sDate = new Date(registrationfrom_date);
    var reg_eDate = new Date(registrationto_date);

    if(reg_eDate < reg_sDate)
    {
        $("#reg_date_err").html("<?php echo $this->global_mod->db_parse($this->lang->line('to_dt_shld_b_grtr_thn_frm_dt'));?>");
        return false;
    }

}




var clientTag=$("#clientTag").val();
//var status=$("#clientStatus").val();
var tag=$("#clientTag").val();
var status=$("#clientStatus").val();
var getalluser =0;
var no_appointments =0;
var not_booked_betwn = 0;
if($('#attr_alluser_check').is(':checked')) { getalluser = 1; }
if($('#attr_user_no_appointment').is(':checked')) { no_appointments = 1; }
if($('#attr_last_booked_user').is(':checked')) { not_booked_betwn = 1; }
var not_book_from_dt=$("#not_book_dtFrom").val();
var not_book_to_dt=$("#not_book_dtTo").val();
if(not_book_from_dt !="" && not_book_to_dt !=""){
    var nbook_sDate = new Date(not_book_from_dt);
    var nbook_eDate = new Date(not_book_to_dt);
    if(nbook_eDate < nbook_sDate){
        $("#not_booked_betw_err").html("<?php echo $this->global_mod->db_parse($this->lang->line('end_dt_shld_b_grtr_thn_strt_dt'));?>");
        return false;
    }

}

//$("#search_result").html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br>Loding...</center>')
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			
			$('#search_result').scrollPagination({

				nop     : 10, // The number of posts per scroll to be loaded
				offset  : 0, // Initial offset, begins at 0 in this case
				error   : 'No More record!', // When the user reaches the end this is the message that is
				                            // displayed. You can change this if you want.
				delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
				               // This is mainly for usability concerns. You can alter this as you see fit
				scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
				               // but will still load if the user clicks.
			
			});
			
			
		/*	$.ajax({
					type: 'POST',
					datatype:'html',
					url:"<?php echo site_url('admin/clientlist/display_customer'); ?>",
					data:"regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&getalluser="+getalluser+"&no_appointments="+no_appointments+"&not_booked_betwn="+not_booked_betwn+"&not_book_from_dt="+not_book_from_dt+"&not_book_to_dt="+not_book_to_dt,
					success:function(rdata){
					$("#search_result").show();
					$("#search_result").html(rdata);
					}
				});  */
		}
	//check login end
	}  
});   

}

	</script>


<script language="javascript" type="text/javascript">
function printon(){
    window.print();
}


	 function exporton()
         {
            var registrationfrom_date=$("#reg_dtFrom").val();
            var registrationto_date=$("#reg_dtTo").val();
            var clientTag=$("#clientTag").val();
            var status=$("#clientStatus").val();

            var tag=$("#clientTag").val();
            var getalluser =0;
            var no_appointments =0;
            var not_booked_betwn = 0;
            if($('#attr_alluser_check').is(':checked')) { getalluser = 1; }
            if($('#attr_user_no_appointment').is(':checked')) { no_appointments = 1; }
            if($('#attr_last_booked_user').is(':checked')) { not_booked_betwn = 1; }
            var not_book_from_dt=$("#not_book_dtFrom").val();
            var not_book_to_dt=$("#not_book_dtTo").val();

location.href="<?php echo site_url('admin/clientlist/export_excel_csv'); ?>" +"?regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&getalluser="+getalluser+"&no_appointments="+no_appointments+"&not_booked_betwn="+not_booked_betwn+"&not_book_from_dt="+not_book_from_dt+"&not_book_to_dt="+not_book_to_dt;


             }
</script>

<script type="text/javascript">
	(function($) {
	
	$.fn.scrollPagination = function(options) {
		
		var settings = { 
			nop     : 15, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			error   : 'No More record!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
		}
		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}
		
		// For each so that we keep chainability.
		return this.each(function() {		
			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var offset = $settings.offset;
			var busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = 'Scroll for more or click here';
			else $initmessage = 'Click for more';
			
			// Append custom messages and extra UI
			$('#morebttn').append('<div id="load_bar" class="loading-bar" style="display:none;">'+$initmessage+'</div>');
			
			function getData() {
				var registrationfrom_date=$("#reg_dtFrom").val();
				var registrationto_date=$("#reg_dtTo").val();
				var clientTag=$("#clientTag").val();
				
				var tag=$("#clientTag").val();
				var status=$("#clientStatus").val();
				var getalluser =0;
				var no_appointments =0;
				var not_booked_betwn = 0;
				if($('#attr_alluser_check').is(':checked')) { getalluser = 1; }
				if($('#attr_user_no_appointment').is(':checked')) { no_appointments = 1; }
				if($('#attr_last_booked_user').is(':checked')) { not_booked_betwn = 1; }
				var not_book_from_dt=$("#not_book_dtFrom").val();
				var not_book_to_dt=$("#not_book_dtTo").val();
				if(not_book_from_dt !="" && not_book_to_dt !=""){
				    var nbook_sDate = new Date(not_book_from_dt);
				    var nbook_eDate = new Date(not_book_to_dt);
				   

				}
				
				
				// Post data to ajax.php
				$.post("<?php echo site_url('admin/clientlist/display_customer')?>", {
						
					action        : 'scrollpagination',
				    number        : $settings.nop,
				    offset        : offset+','+registrationfrom_date+','+registrationto_date+','+status+','+tag+','+getalluser+','+no_appointments+','+not_booked_betwn+','+not_book_from_dt+','+not_book_to_dt,
					    
				}, function(data) {
					
					// Change loading bar content (it may have been altered)
					$this.find('.loading-bar').html($initmessage);
						
					// If there is no data returned, there are no more posts to be shown. Show error
					if(data == "") { 
						$this.find('.loading-bar').html($settings.error);	
					}
					else {
						data = data.split('xy#$@');
						
						// Offset increases
					    offset = offset+$settings.nop; 
						    
						// Append the data to the content div
					   //	$this.find('#search_result').append(data);
					   	$('#search_result').append(data[1]);
					   	if(data[0] == 0){
							$("#load_bar").css('display','block');
						}else{
							$("#load_bar").css('display','none');
						}
						
						// No longer busy!	
						busy = false;
					}	
						
				});
					
			}	
			
			getData(); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					
					// Check the user is at the bottom of the element
					if($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
						
						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're loading posts
						$this.find('.loading-bar').html('Loading ........');
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData();
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$('.loading-bar').click(function() {
			
				if(busy == false) {
					busy = true;
					getData();
				}
			
			});
			
		});
	}

})(jQuery);
</script>