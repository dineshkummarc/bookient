<!-- //CB#SR#08-04-2013#PR#S-->
<script type="text/javascript" src="<?= base_url(); ?>/asset/admin_js/FusionCharts.js"></script>
<div class="rounded_corner" style="width:98%; margin-left:1%">
<h1 class="headign-main"> <?php echo $this->lang->line('headign-main'); ?> </h1>  
<div style="padding-left:12px;padding-top:5px;width:98%">
<div style="text-align: left; vertical-align: top;">
    
</div>
<?php
/*####################################################################################################*/
$i=0;
$arr[0][1] = "Sunday";
$arr[1][1] = "Monday";
$arr[2][1] = "Tuesday";
$arr[3][1] = "Wednesday";
$arr[4][1] = "Thursday";
$arr[5][1] = "Friday";
$arr[6][1] = "Saturday";
//Store sales data
$arr[0][2] = 0;
$arr[1][2] = 0;
$arr[2][2] = 0;
$arr[3][2] = 0;
$arr[4][2] = 0;
$arr[5][2] = 0;
$arr[6][2] = 0;
if(count($ResArr)>0){
	foreach($ResArr as $k=>$v)
	{
		$day = date("w",strtotime($v['booking_date']));
		if($day == 0)
			$arr[0][2]++;
		else if($day == 1)
			$arr[1][2]++;
		else if($day == 2)
			$arr[2][2]++;
		else if($day == 3)
			$arr[3][2]++;
		else if($day == 4)
			$arr[4][2]++;
		else if($day == 5)
			$arr[5][2]++;
		else
			$arr[6][2]++;
		$i++;
	}
}
$graphObj = new Fusioncharts;
echo '<div style="border:0px solid #CCCCCC; width: 100%; margin: 0 0 0 0px;">';
$strXMLbar = "<graph bgcolor='F3F3F3' caption='Weekdaywise Performance' xAxisName='Weekday' yAxisName='Appointments' decimalPrecision='0' formatNumberScale='0' baseFontSize='12'>";
$i=0;
foreach ($arr as $arSubData)
{
    $strXMLbar .= "<set name='".substr($arSubData[1],0,3)."' value='".$arSubData[2]."' color='".$graphObj->getFCColor($i)."' hoverText='".$arSubData[1]."'/>";
    $i++;
}
$strXMLbar .= "</graph>";
echo '<table width="100%" border="0" cellspacing="20" cellpadding="0"><tr><td style="border:1px solid #CCCCCC;">';
echo $graphObj-> renderChart(base_url()."asset/FCF_Column3D.swf", "", $strXMLbar, "weekwise", 1000, 600);
echo '</td></tr>';
//echo '</div>';
$this->load->model('admin/graph_model');
/*####################################################################################################*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$staffArr = $this->graph_model->getStaff();
$noOfStaff = count($staffArr);
$j = 0;
foreach($staffArr as $k=>$v)
{
    $emp = $v['employee_name'];
    $sta[$j][1] = $v['employee_name'];
    $sta[$j][2] = substr_count(serialize($ResArr), $emp)==0?'':(substr_count(serialize($ResArr), $emp));
    $j++;
}
$strXMLbar = "<graph bgcolor='F3F3F3' caption='Staff Performance' xAxisName='Staff Name' yAxisName='Appointments' decimalPrecision='0' formatNumberScale='0' baseFontSize='10'>";
$i=0;
foreach ($sta as $arSubData)
{
    $strXMLbar .= "<set name='".substr($arSubData[1],0,4)."' value='".$arSubData[2]."' color='".$graphObj->getFCColor($i)."' hoverText='".$arSubData[1]."'/>";
    $i++;
}
$strXMLbar .= "</graph>";
//echo '<div style="border:1px solid #022157; width: 350px;">';
echo '<tr><td style="border:1px solid #CCCCCC;">';
echo $graphObj-> renderChart(base_url()."asset/FCF_Column3D.swf", "", $strXMLbar, "staffwise", 1000, 600);
echo '</td></tr>';
//echo '</div>';
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
$serviceArr = $this->graph_model->getService();
$noOfService = count($serviceArr);
$m = 0;
foreach($serviceArr as $k=>$v)
{
    $ser = $v['service_name'];
	//$ser='';
    //$service[$m][1] = substr($v['service_name'],0,4);
	$service[$m][1] = $v['service_name'];
    $service[$m][2] = substr_count(serialize($ResArr), $ser)==0?'':substr_count(serialize($ResArr), $ser);
    $m++;
}
$strXMLbar = "<graph bgcolor='F3F3F3' caption='Service Performance' xAxisName='Service Name' yAxisName='Appointments' decimalPrecision='0' formatNumberScale='0' baseFontSize='12'>";
$i=0;
foreach ($service as $arSubData)
{
    $strXMLbar .= "<set name='".substr($arSubData[1],0,4)."' value='".$arSubData[2]."' color='".$graphObj->getFCColor($i)."' hoverText='".$arSubData[1]."'/>";
    $i++;
}
$strXMLbar .= "</graph>";
//echo '<div style="border:1px solid #022157; width: 350px;">';
echo '<tr><td style="border:1px solid #CCCCCC;">';
echo $graphObj-> renderChart(base_url()."asset/FCF_Column3D.swf", "", $strXMLbar, "servicewise", 1000, 600);
echo '</td></tr></table>';
echo '</div>';
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

/*################      CODE FOR BOOK/CANCEL GRAPH STARTS       ##################*/
/*$arrDatacatd = array();
$arrData1d = array();
$arrData2d = array();   
for($i=1;$i<count($BookedCancelArr);$i++)
{
    $arrDatacatd[$i] = date('j M',strtotime($BookedCancelArr[$i]['info_date']));
    $arrData1d[$i] = $BookedCancelArr[$i]['booking_cnt'];
    $arrData2d[$i] = $BookedCancelArr[$i]['cancel_cnt'];
}
$width = count($BookedCancelArr)<=8?350:count($BookedCancelArr)*50;
   
$strXMLmsbard ="";
$strXMLmsbard .= "<graph bgcolor='F3F3F3' xaxisname='Date' yaxisname='Appointments' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='Booked/Cancel Datewise'>";
$strXMLmsbard .=	"<categories font='Arial' fontSize='11' fontColor='000000'>";
foreach ($arrDatacatd as $arSubData)
{
$strXMLmsbard .= "<category name='".$arSubData."'/>";
}
$strXMLmsbard .= "</categories>";


$strXMLmsbard .=	"<dataset seriesname='Booked' color='" .$graphObj->getFCColor(4) . "'>";
foreach ($arrData1d as $arSubData)
{
$strXMLmsbard .= "<set value='".$arSubData."'/>";
}
$strXMLmsbard .= "</dataset>";

$strXMLmsbard .=	"<dataset seriesname='Cancelled' color='" .$graphObj->getFCColor(10) . "'>";
foreach ($arrData2d as $arSubData)
{
$strXMLmsbard .= "<set value='".$arSubData."'/>";
}
$strXMLmsbard .= "</dataset>";

$strXMLmsbard .= "</graph>";


echo $graphObj-> renderChart(base_url()."asset/FCF_MSColumn3D.swf","",$strXMLmsbard , "BookedCancelled",  $width, "250");*/                        
/*################      CODE FOR BOOK/CANCEL GRAPH ENDS     #################*/

/*@@@@@@@@@@@@@@@@      CODE FOR APPOINTMENT/NO SHOW GRAPH STARTS       @@@@@@@@@@@@@@@@*/
/*$arr1Datacatd = array();
$arr1Data1d = array();
$arr1Data2d = array();   
for($i=1;$i<count($AppointmentNoShowArr);$i++)
{
    $arr1Datacatd[$i] = date('j M',strtotime($AppointmentNoShowArr[$i]['info_date']));
    $arr1Data1d[$i] = $AppointmentNoShowArr[$i]['booking_cnt'];
    $arr1Data2d[$i] = $AppointmentNoShowArr[$i]['no_show_cnt'];
}
$width1 = count($AppointmentNoShowArr)<=8?350:count($AppointmentNoShowArr)*50;
$strXMLmsbard ="";
$strXMLmsbard .= "<graph bgcolor='F3F3F3' xaxisname='Date' yaxisname='Appointments' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='Appointment/No Show Datewise'>";
$strXMLmsbard .=	"<categories font='Arial' fontSize='11' fontColor='000000'>";
foreach ($arr1Datacatd as $ar1SubData)
{
$strXMLmsbard .= "<category name='".$ar1SubData."'/>";
}
$strXMLmsbard .= "</categories>";


$strXMLmsbard .=	"<dataset seriesname='Appointment' color='" .$graphObj->getFCColor(4) . "'>";
foreach ($arr1Data1d as $ar1SubData)
{
$strXMLmsbard .= "<set value='".$ar1SubData."'/>";
}
$strXMLmsbard .= "</dataset>";

$strXMLmsbard .=	"<dataset seriesname='No Show' color='" .$graphObj->getFCColor(10) . "'>";
foreach ($arr1Data2d as $ar1SubData)
{
$strXMLmsbard .= "<set value='".$ar1SubData."'/>";
}
$strXMLmsbard .= "</dataset>";

$strXMLmsbard .= "</graph>";


echo $graphObj-> renderChart(base_url()."asset/FCF_MSColumn3D.swf","",$strXMLmsbard , "AppointmentNoShow",  $width1, "250");*/
/*@@@@@@@@@@@@@@@@      CODE FOR APPOINTMENT/NO SHOW GRAPH ENDS     @@@@@@@@@@@@@@@@*/
?>
</div>
</div>

</div>

<!-- //CB#SR#08-04-2013#PR#E-->