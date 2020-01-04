<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->lang->line('headign-main');?></h1>

<div class='save-success'></div>


<span style="width:10%; float: right;" id="btnAddPromo">
	<a href="javascript:void(0);" onclick="addNewSetting()" class="add-customer"><?php echo $this->lang->line('add_setting');?></a>
</span>
<div id="emailmrktnsetting" style="display: none;">
<form id="auto_promotion" method="post" enctype="multipart/form-data">

<h2 id="head"><?php echo $this->lang->line('add_setting');?></h2>
<div class="inner-div">

<table width="55%" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;" >
  <tr>
    <td width="22%"><?php echo $this->lang->line('emlmrktng_tmplt_cat');?> : </td>
    <td>
    	<select class="cWith" name="Emailcategory" id="Emailcategory" onchange="GetTemplate()">
    		<option value="0"><?php echo $this->lang->line('selct_email_cat');?></option>
    		<?php
    			if(isset($EmailCategory)){
					foreach($EmailCategory as $category){
						echo '<option value="'.$category['emlMrktn_cat_id'].'">'.$category['emlMrktn_cat_name'].'</option>';
					}
				}
    		?>
    	</select>
    	<!-- input class="text-input required" type="text" value="" name="pro_title" id="pro_title" -->
    		
    </td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('template');?> : </td>
    <td id="TEmp_td">
    	<?php echo $this->lang->line('selct_tmplt_cat');?>
		<!--select class="required cWith">
		
		</select-->
	</td>
  </tr>
  
  <tr>
    <td width="20%"><?php echo $this->lang->line('custmr_grp');?> : </td>
    <td>
    	<!-- input class="text-input required pickTime cWithc" type="text" value="" name="pro_time" id="pro_time" -->
    	<select class="cWith" id="Customer_type" name="Customer_type" onchange="GetCustomers()">
    		<option value="0" >Select Customer Type</option>
    		<?php
    			if(isset($CustomerType)){
					foreach($CustomerType AS $val){
						echo '<option value="'.$val['typerelation_customertype_id'].'">'.$val['customertype_name'].'</option>';
					}
				}
    		
    		?>
    	</select>
    	
    </td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('customers');?> : </td>
    <td>
		<dl class="dropdown"> 
		<dt>
			<a href="#">
			<span id="curSeleServ"><?php echo $this->lang->line('slct_custmr_grp');?></span>  
			</a>
		</dt>

		<dd>
		<div class="mutliSelect">  
		    
		</div>
		</dd>
		</dl>


	</td>
  </tr>
  
  <tr>
	<td>&nbsp; </td>
	<td>
	      <input type="button" onclick="submitAutoPromoForm()" value="<?php echo $this->lang->line('add_btn');?>" class="btn-blue" style="border: 1px solid #0659A3;display: block; float: left; margin: 0 5px 0 0; min-height: 33px;"> 
	      <button type="button" class="btn-gray" onclick="addNewPromotionCancel()"><?php echo $this->lang->line('cancel_btn');?></button>
	</td>
  </tr>
</table>

</div>
<input type="hidden" name="hidden_id" id="hidden_id" value=""/>
</form>

</div>


<table align="center" width="98%" border="0" class="list-view">
	<thead>
		<tr>
			<th width="5%">&nbsp;</th>
			<th width="30%" align="left"><strong><?php echo $this->lang->line('tmplt_cat');?></strong></th>
			<th width="20%" align="center"><strong><?php echo $this->lang->line('template')?></strong></th>
			<th width="20%" align="center"><strong><?php echo $this->lang->line('customer_type')?></strong></th>
			<th width="20%" align="center"><strong><?php echo $this->lang->line('action_head')?></strong></th>
			<th width="5%">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$str ='';
		if(count($allsetting)>0){
		foreach($allsetting as $settings){ 
		
				$str.='<tr>';
				$str.='<td width="5%"></td>';
				$str.='<td width="30%" align="left">'.$settings["emlMrktn_cat_name"].'</td>';
				$str.='<td width="20%" align="center">'.$settings["app_emlmrktn_tem_subject"].'</td>';
				$str.='<td width="20%" align="center">'.$settings["customertype_name"].'</td>';
				$str.='<td width="20%" align="center">
						<a href="javascript:void(0);" onclick="openEditWindow('.$settings['emlmrktn_setting_id'].')" >'.$this->lang->line("edit_btn").'</a> | 
						<a href="javascript:void(0);" onclick="DeletePromotion('.$settings['emlmrktn_setting_id'].')" >'.$this->lang->line("delete_btn").'</a>
					  </td>';
				$str.='<td width="5%"></td>';
				$str.='</tr>';
			}
		}else{
				$str.='<tr>';
				$str.='<td colspan="6" align="center">'.$this->lang->line("no_data_found").'</td>';
				$str.='</tr>';
		}
		echo $str;
	?>
	</tbody>
</table>
<br>
</div>
<?php include('emailmarketing_setting.js.php'); ?>   
<style>
.dropdown a {
    color:#000000;
}
.dropdown dd, .dropdown dt {
    margin:0px;
    padding:0px;
}
.dropdown ul {
    margin: -1px 0 0 0;
}
.dropdown dd {
    position:relative;
}
.dropdown a, 
.dropdown a:visited {
    color:#000000;
    text-decoration:none;
    outline:none;
    font-size: 12px;
}
.dropdown dt a {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    margin-bottom: 4px; 
    display: block;
    font-size: 16px;
    min-height: 10px;
    overflow: hidden;
    padding: 5px 10px;
    text-align: center;
    width: 294px;
}
.dropdown dt a span, .multiSel span {
    cursor:pointer;
    display:inline-block;
    padding: 0 3px 2px 0;
}
.dropdown dd ul {
    background-color: #B7B7B7;
    border:0;
    color:#000000;
    display:none;
    left:0px;
    font-size: 12px;
    line-height:22px;
    padding: 2px 15px 2px 5px;
    position:absolute;
    top:2px;
    width:294px;
    list-style:none;
    height: 100px;
    overflow: auto;
}
.dropdown span.value {
    display:none;
}
.dropdown dd ul li a {
    padding:5px;
    display:block;
}
.mutliSelect ul li:hover {
    background-color:#CCCCCC;
}
.dropdown dd ul li a:hover {
    background-color:#008CF4;
}
.cWith{
	width:37%  !important;
}
.cWithb{
	width:19%  !important;
}
.cWithc{
	width:15.5%  !important;
}
</style>













