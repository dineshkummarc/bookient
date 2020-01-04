<?php
class Fusioncharts{	

// Author: Palash Roy(palash.roy@outlook.com).

function encodeDataURL($strDataURL, $addNoCacheStr=false) {
    if ($addNoCacheStr==true) {
		if (strpos($strDataURL,"?")<>0)
			$strDataURL .= "&FCCurrTime=" . Date("H_i_s");
		else
			$strDataURL .= "?FCCurrTime=" . Date("H_i_s");
    }
	return urlencode($strDataURL);
}


function datePart($mask, $dateTimeStr) {
    @list($datePt, $timePt) = explode(" ", $dateTimeStr);
    $arDatePt = explode("-", $datePt);
    $dataStr = "";
    if (count($arDatePt) == 3) {
        list($year, $month, $day) = $arDatePt;
        switch ($mask) {
        case "m": return $month;
        case "d": return $day;
        case "y": return $year;
        }
        return (trim($month . "/" . $day . "/" . $year));
    }
    return $dataStr;
}


function renderChart($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode=false, $registerWithJS=false, $setTransparent="") {
 
	if ($strXML=="")
        $tempData = "//Set the dataURL of the chart\n\t\tchart_$chartId.setDataURL(\"$strURL\")";
    else
        $tempData = "//Provide entire XML data using dataXML method\n\t\tchart_$chartId.setDataXML(\"$strXML\")";

    $chartIdDiv = $chartId . "_pr";
    $ndebugMode = $this->boolToNum($debugMode);
    $nregisterWithJS = $this->boolToNum($registerWithJS);
	$nsetTransparent=($setTransparent?"true":"false");

$render_chart = <<<RENDERCHART

	<!-- START Script Block for Chart $chartId -->
	<div id="$chartIdDiv" align="center">
		Chart.
	</div>
	<script type="text/javascript">	
		//Instantiate the Chart	
		var chart_$chartId = new FusionCharts("$chartSWF", "$chartId", "$chartWidth", "$chartHeight", "$ndebugMode", "$nregisterWithJS");
      chart_$chartId.setTransparent("$nsetTransparent");
    
		$tempData
		//Finally, render the chart.
		chart_$chartId.render("$chartIdDiv");
	</script>	
	<!-- END Script Block for Chart $chartId -->
RENDERCHART;

  return $render_chart;
}

function renderChartHTML($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode=false,$registerWithJS=false, $setTransparent="") {

    $strFlashVars = "&chartWidth=" . $chartWidth . "&chartHeight=" . $chartHeight . "&debugMode=" . boolToNum($debugMode);
    if ($strXML=="")
        $strFlashVars .= "&dataURL=" . $strURL;
    else
        $strFlashVars .= "&dataXML=" . $strXML;
    
    $nregisterWithJS = boolToNum($registerWithJS);
    if($setTransparent!=""){
      $nsetTransparent=($setTransparent==false?"opaque":"transparent");
    }else{
      $nsetTransparent="window";
    }
$HTML_chart = <<<HTMLCHART
	<!-- START Code Block for Chart $chartId -->
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="$chartWidth" height="$chartHeight" id="$chartId">
		<param name="allowScriptAccess" value="always" />
		<param name="movie" value="$chartSWF"/>		
		<param name="FlashVars" value="$strFlashVars&registerWithJS=$nregisterWithJS" />
		<param name="quality" value="high" />
		<param name="wmode" value="$nsetTransparent" />
		<embed src="$chartSWF" FlashVars="$strFlashVars&registerWithJS=$nregisterWithJS" quality="high" width="$chartWidth" height="$chartHeight" name="$chartId" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="$nsetTransparent" />
	</object>
	<!-- END Code Block for Chart $chartId -->
HTMLCHART;

  return $HTML_chart;
}

function boolToNum($bVal) {
    return (($bVal==true) ? 1 : 0);
}

function getFCColor($FC_ColorCounter=0) 
{
	
	$arr_FCColors[0] = "1941A5" ;//Dark Blue
	$arr_FCColors[1] = "AFD8F8";
	$arr_FCColors[2] = "F6BD0F";
	$arr_FCColors[3] = "8BBA00";
	$arr_FCColors[4] = "A66EDD";
	$arr_FCColors[5] = "F984A1" ;
	$arr_FCColors[6] = "CCCC00" ;//Chrome Yellow+Green
	$arr_FCColors[7] = "999999" ;//Grey
	$arr_FCColors[8] = "0099CC" ;//Blue Shade
	$arr_FCColors[9] = "FF0000" ;//Bright Red 
	$arr_FCColors[10] = "006F00" ;//Dark Green
	$arr_FCColors[11] = "0099FF"; //Blue (Light)
	$arr_FCColors[12] = "FF66CC" ;//Dark Pink
	$arr_FCColors[13] = "669966" ;//Dirty green
	$arr_FCColors[14] = "7C7CB4" ;//Violet shade of blue
	$arr_FCColors[15] = "FF9933" ;//Orange
	$arr_FCColors[16] = "9900FF" ;//Violet
	$arr_FCColors[17] = "99FFCC" ;//Blue+Green Light
	$arr_FCColors[18] = "CCCCFF" ;//Light violet
	$arr_FCColors[19] = "669900" ;//Shade of green

	$FC_ColorCounter++;
	return($arr_FCColors[$FC_ColorCounter % count($arr_FCColors)]);
}
}
?>