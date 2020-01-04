

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

function lastWeek()
{

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

function lastMonth()
{
        $("#reg_date_err").html("");
        $("#date_listing").show();
	var currentTime = new Date();
    /*var dayno= currentTime.getDay() + 1;
	alert(dayno);*/

	var month = currentTime.getMonth();
	var previous_month=month-1;

	//var lastWeekEndday = currentTime.getDate()-dayno;

	var year = currentTime.getFullYear();

$("#reg_dtFrom").val($.datepicker.formatDate('mm/dd/yy',new Date(year, previous_month, 1)));
//alert(date1);
$("#reg_dtTo").val($.datepicker.formatDate('mm/dd/yy',new Date(year, month, 0)));


}

function allClient()
{
$("#reg_date_err").html("");
$("#reg_dtFrom").val('');
//alert(date1);
$("#reg_dtTo").val('');

$("#date_listing").hide();

}

function show_advance_search()
{


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
        $("#reg_date_err").html("To Date should be greater than From Date.");
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
if(not_book_from_dt !="" && not_book_to_dt !="")
{
    var nbook_sDate = new Date(not_book_from_dt);
    var nbook_eDate = new Date(not_book_to_dt);
    if(nbook_eDate < nbook_sDate)
    {
        $("#not_booked_betw_err").html("End Date should be greater than Start Date.");
        return false;
    }

}
//CB#SOG#18-2-2013#PR#E

/**********************************/
//return false;

//alert(status);
$("#search_result").html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br>Loding...</center>')
$.ajax({


	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/clientlist/display_customer'); ?>",
	  //data:"regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&status="+status,
          data:"regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&getalluser="+getalluser+"&no_appointments="+no_appointments+"&not_booked_betwn="+not_booked_betwn+"&not_book_from_dt="+not_book_from_dt+"&not_book_to_dt="+not_book_to_dt,

       success:function(rdata)
        {
		//alert(rdata);
               // /*
		$("#search_result").show();
		$("#search_result").html(rdata);
		//*/
		}


	});




}

	</script>


<script language="javascript" type="text/javascript">
function printon()
{
    // $('#search_result').jqprint();
    window.print();
}


	 function exporton()
         {
            var registrationfrom_date=$("#reg_dtFrom").val();
            var registrationto_date=$("#reg_dtTo").val();
            var clientTag=$("#clientTag").val();
            var status=$("#clientStatus").val();

            var tag=$("#clientTag").val();
            //var status=$("#clientStatus").val();
            var getalluser =0;
            var no_appointments =0;
            var not_booked_betwn = 0;
            if($('#attr_alluser_check').is(':checked')) { getalluser = 1; }
            if($('#attr_user_no_appointment').is(':checked')) { no_appointments = 1; }
            if($('#attr_last_booked_user').is(':checked')) { not_booked_betwn = 1; }
            var not_book_from_dt=$("#not_book_dtFrom").val();
            var not_book_to_dt=$("#not_book_dtTo").val();

//location.href="<?php //echo site_url('admin/clientlist/export_excel_csv'); ?>" +"?regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&clientTag="+clientTag+"&status="+status;
location.href="<?php echo site_url('admin/clientlist/export_excel_csv'); ?>" +"?regstdate="+registrationfrom_date+"&regenddate="+registrationto_date+"&status="+status+"&tag="+tag+"&getalluser="+getalluser+"&no_appointments="+no_appointments+"&not_booked_betwn="+not_booked_betwn+"&not_book_from_dt="+not_book_from_dt+"&not_book_to_dt="+not_book_to_dt;


             }
</script>