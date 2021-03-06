<?php include("clientlist.js.php");?>
<style>

#mainDiv {

}
.boxInput input[type="text"]{ background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    border-radius: 3px 3px 3px 3px;
    margin-bottom: 4px;
    padding:7px;
    width: 50%;}

.boxInput select{ width:195px; padding:7px;}

.appointyPageHeading {
    border-bottom: 1px solid #333333;
    color: #333333;
    cursor: pointer;
    font-size: 14px;
    font-style: normal;
    font-variant: normal;
    font-weight: bold;
    margin-bottom: 5px;
    margin-left: 3px;
    margin-right: 3px;
    padding-bottom: 5px;
    padding-left: 2px;
    padding-top: 1px;
    text-transform: capitalize;
}
.reportSearchBox {
    margin: 10px;
    padding-top: 10px;
}

.popupBox {
    border: 1px solid #C0C0C0;
    margin: 10px;
    padding: 5px 0 43px 0;
    position: relative;
}
.popupBox a {
    text-decoration: underline;
}
.boxhead {
   /* font-size: 13px;
    font-weight: bold;*/
}
.boxInput {
    font-size: 11px;
    padding-bottom: 12px;
}
.boxButton {
    font-size: 11px;
    padding: 7px 7px 0;
    text-align: center;
}
.client-list{ margin-left:1%; border-left:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-top:1px solid #ccc; border-radius:10px;}

.client-list th{background: none repeat scroll 0 0 #022157;
    color: #FFFFFF;
    font-family: "Conv_calibri,Lucida Sans Unicode","Lucida Grande",sans-serif;
    font-size: 13px;
    font-weight: bold;
    padding: 10px;
    text-transform: uppercase; text-align:left;}
	
	
.client-list th:first-child{ width:100px;}

.client-list td{ padding:5px; border-bottom:1px solid #ccc;}

.client-list tr:nth-child(even){ background:#fff}

.print{ display:inline;}

.print a img{ padding:0 4px;}

.print a{ font-size:14px;}

.loading-bar {
	padding: 10px 20px;
	display: block;
	text-align: center;
	box-shadow: inset 0px -45px 30px -40px rgba(0, 0, 0, 0.05);
	border-radius: 5px;
	margin: 20px 0;
	font-size: 2em;
	font-family: "museo-sans", sans-serif;
	border: 1px solid #ddd;
	margin-right: 1px;
	font-weight: bold;
	cursor: pointer;
	position: relative;
	width:500px;
}

</style>


<div class="rounded_corner_full">


<div id="mainDiv">
<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?></div>
<div class="report-search">
<div class="innerdiv">

<div style="margin-left:31px;">
    <h3><?php echo $this->global_mod->db_parse($this->lang->line('registration_date_range')); ?></h3><br />
<form action="" name="" method="post">
<div class="boxInput">
		<div id="date_listing">
                    <table width="100%" border="0">
                       <tr>
                           <td><strong><?php echo $this->global_mod->db_parse($this->lang->line('from')); ?>&nbsp;</strong><br/>
		<input type="text" id="reg_dtFrom" class="" value="" readonly ="readonly" style="border:1px solid #B7B7B7;width: 180px;"></td>
                            <td><strong><?php echo $this->global_mod->db_parse($this->lang->line('to')); ?>&nbsp;</strong><br/>
		<input type="text" id="reg_dtTo" class="" value="" readonly ="readonly" style="border:1px solid #B7B7B7;width: 180px;"></td>
                       </tr>
                        
                    </table>
		
		
		</div>
		<a onClick="" href="javascript:lastWeek()"><?php echo $this->global_mod->db_parse($this->lang->line('last_week')); ?></a>
		 | 
		<a onClick="" href="javascript:lastMonth()"><?php echo $this->global_mod->db_parse($this->lang->line('last_month')); ?></a>
		 | 
                 <a onClick="" href="javascript:allClient()"><?php echo $this->global_mod->db_parse($this->lang->line('all')); ?></a> &nbsp;&nbsp;&nbsp;&nbsp;<span id="reg_date_err" style="color:red;font-size:10px;"></span>

</div>
<div class="boxInput">
			<table cellpadding="0" cellpadding="0" width="100%">
            <tr>
		
		<td>
                    <span class="boxhead"><?php echo $this->global_mod->db_parse($this->lang->line('tags')); ?></span><br/>
                    <input id="clientTag" type="text" style="border:1px solid #B7B7B7;width: 180px;"></td>
                
                <td>
                    <span class="boxhead"><?php echo $this->global_mod->db_parse($this->lang->line('status')); ?></span><br/>
                    <select id="clientStatus">
		<!--<option value="all">All</option>-->
		<option value="1"><?php echo $this->global_mod->db_parse($this->lang->line('verified')); ?></option>
		<option value="0"><?php echo $this->global_mod->db_parse($this->lang->line('unverified')); ?></option>
		</select></td>
        </tr>
        
	<?php //echo  $customer_status;   ?>

        
        </table>
	
</div>
<div id="isAdvancedSearch"  >
<div class="boxhead">
<span id="Span2"><?php echo $this->global_mod->db_parse($this->lang->line('advance_options'));?></span>
</div>
<div class="boxInput">
<input type="radio" name="attr_check" id="attr_alluser_check">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('get_all_user'));?>
</div>
<div class="boxInput">
<input type="radio" name="attr_check" id="attr_user_no_appointment">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('user_with_no_appointment'));?>
</div>
<div class="boxInput">
<input type="radio" name="attr_check" id="attr_last_booked_user">&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('not_booked_between'));?>
</div>
<div class="boxInput">
		<div>
		
		<input type="text" id="not_book_dtFrom" onFocus="check_select()" class="" value="" style="border:1px solid #B7B7B7;width: 180px;">
		<strong><?php echo $this->global_mod->db_parse($this->lang->line('to'));?></strong>
		<input type="text" id="not_book_dtTo" onFocus="check_select()" value="" style="border:1px solid #B7B7B7;width: 180px;">
		</div>
		<a onClick="" href="javascript:lastWeekNotBook()"><?php echo $this->global_mod->db_parse($this->lang->line('last_week'));?></a>
		 | 
		<a onClick="" href="javascript:lastfifteenNotBook()"><?php echo $this->global_mod->db_parse($this->lang->line('last_15_days'));?></a>
		 | 
		<a onClick="" href="javascript:comingWeek()"><?php echo $this->global_mod->db_parse($this->lang->line('coming_week'));?></a> &nbsp;&nbsp;&nbsp;&nbsp;<span id="not_booked_betw_err" style="color:red;font-size:10px;"></span>

</div>
<div class="boxButton" style="color:#022157; font-size:14px; font-weight:bold;">
<a  href="javascript:show_basic_search();"><?php echo $this->global_mod->db_parse($this->lang->line('basic_search'));?> &raquo;</a>
</div>
</div>
<div class="boxButton"  id="advancesearch" style="color:#022157; font-size:14px; font-weight:bold;">
<a  href="javascript:show_advance_search();"><?php echo $this->global_mod->db_parse($this->lang->line('advance_search'));?>&raquo;</a>
</div>
<div class="boxButton">
<input type="button" onClick="searching()" class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('search'));?>" style="padding:6px 12px;">
</div>

</form>
</div>
</div>

    
    
    
</div>
    <div id="search_result" align="center"></div>
    <div id="morebttn" align="center"></div>
</div>
</div>