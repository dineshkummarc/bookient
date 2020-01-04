<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main'));?></h1>

<div class='save-success'></div>


<span style="width:10%; float: right;" id="btnAddPromo">
	<a href="javascript:void(0);" onclick="addNewPromotion()" class="add-customer"><?php echo $this->global_mod->db_parse($this->lang->line('addpromo_btn'));?></a>
</span>
<div id="autoPromotionContent" style="display: none;">
<form id="auto_promotion" method="post" enctype="multipart/form-data">

<h2 id="head"><?php echo $this->global_mod->db_parse($this->lang->line('addpromo_btn'));?></h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('promotn_title'));?></td>
    <td><input class="text-input required" type="text" value="" name="pro_title" id="pro_title"></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('promotn_type'));?></td>
    <td>
		<select class="required cWith" onchange="chkType(this.value);" name="pro_type" id="pro_type">
		<?php foreach($promoType as $promoTypeArr){ echo '<option value="'.$promoTypeArr["promo_type_id"].'">'.$promoTypeArr["promo_type_name"].'</option>'; } ?>
		</select>
	</td>
  </tr>
  <tr id="typDate" style="display: none;">
    <td width="20%">&nbsp;</td>
    <td><input class="text-input required cWithc datePic" type="text" value="" name="pro_type_date" id="pro_type_date"></td>
  </tr>
  <tr id="typDate2" style="display: none;">
    <td width="20%">&nbsp;</td>
    <td>
    	<input class="text-input required cWithc datePic" type="text" value="" name="pro_type_date_srt" id="pro_type_date_srt">
    	&nbsp;To&nbsp;
    	<input class="text-input required cWithc datePic" type="text" value="" name="pro_type_date_end" id="pro_type_date_end">
    </td>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('promotn_time'));?></td>
    <td><input class="text-input required pickTime cWithc" type="text" value="" name="pro_time" id="pro_time"></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('promotn_apply_on'));?></td>
    <td>
		<dl class="dropdown"> 
		<dt>
			<a href="#">
			<span id="curSeleServ"><?php echo $this->global_mod->db_parse($this->lang->line('select_service'));?></span>  
			</a>
		</dt>

		<dd>
		<div class="mutliSelect">  
		    <ul>
		    <li><input type="checkbox" name="services_name" id="services_name" value="0" /> Select all </li>
		 <?php foreach($service as $serviceArr){ echo '<li><input type="checkbox" id="chk_box_'.$serviceArr["id"].'" value="'.$serviceArr["id"].'" /> &nbsp;'.$serviceArr["name"].'</li>';} ?>
		    </ul>
		</div>
		</dd>
		</dl>


	</td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('promotn_link_to'));?></td>
    <td><select class="required cWith" onchange="getOffer(this.value);" name="pro_linkType" id="pro_linkType">
    		<option value="0">Select promotion </option>
			<option value="1"> Discount Coupon </option>
			<option value="2"> Offer coupon </option>
		</select>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td id="offer_td"><span id="linkContener">
    		<select class="required cWith" name="cuponName" id="cuponName">
				<option value="0">Select offer</option>
			</select>
		</span>
		Or
		<a href="<?php echo base_url(); ?>admin/coupon"><?php echo $this->global_mod->db_parse($this->lang->line('add_new_offer'));?></a>
	</td>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('promotn_remaining'));?> </td>
    <td>
    	<input class="text-input required cWithc" type="text" value="" name="pro_amount" id="pro_amount">
    	&nbsp; <?php echo $this->global_mod->db_parse($this->lang->line('percentage'));?> [%]
    	<!--select class="required cWithb" name="pro_amount_type" id="pro_amount_type">
			<option value="1">Percentage [%]</option>
			<option value="2"><?php echo $this->session->userdata('abbriviation');?> [<?php echo $this->session->userdata('currency');?>]</option>
		</select-->
    </td>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('promotn_priority'));?></td>
    <td><input class="text-input required cWithc" type="text" value="" name="pro_priority" id="pro_priority"></td>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('promotn_status'));?></td>
    <td><input type="checkbox" name="pro_status" id="pro_status"></td>
  </tr>
  <tr>
	<td>&nbsp; </td>
	<td>
	      <input type="button" onclick="submitAutoPromoForm()" value="<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'));?>" class="btn-blue" style="border: 1px solid #0659A3;display: block; float: left; margin: 0 5px 0 0; min-height: 33px;"> 
	      <button type="button" class="btn-gray" onclick="addNewPromotionCancel()"><?php echo $this->global_mod->db_parse($this->lang->line('cancel_btn'));?></button>
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
			<th width="50%" align="left"><strong><?php echo $this->global_mod->db_parse($this->lang->line('promotn_name'));?></strong></th>
			<th width="10%" align="center"><strong><?php echo $this->global_mod->db_parse($this->lang->line('priority'));?></strong></th>
			<th width="10%" align="center"><strong><?php echo $this->global_mod->db_parse($this->lang->line('status'));?></strong></th>
			<th width="20%" align="center"><strong><?php echo $this->global_mod->db_parse($this->lang->line('action'));?></strong></th>
			<th width="5%">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$str ='';
		if(count($allOffer)>0){
		foreach($allOffer as $allOfferArr){ 
		
		
			if($allOfferArr['auto_promo_status'] == '1') {
            $status = '<span id="replace_status_'.$allOfferArr["auto_promo_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
        }else{
            $status = '<span id="replace_status_'.$allOfferArr["auto_promo_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
        }
		
		
		
				$str.='<tr>';
				$str.='<td></td>';
				$str.='<td align="left">'.$allOfferArr["auto_promo_title"].'</td>';
				$str.='<td align="center">'.$allOfferArr["auto_promo_priority"].'</td>';
				$str.='<td align="center">'.'<a href="javascript:void(0);" onclick="change_Promostatus('.$allOfferArr["auto_promo_id"].','.$allOfferArr['auto_promo_status'].');">'.$status.'</a>'.'</td>';
				$str.='<td align="center">
						<a href="javascript:void(0);" onclick="openEditWindow('.$allOfferArr['auto_promo_id'].')" >'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a> | 
						<a href="javascript:void(0);" onclick="DeletePromotion('.$allOfferArr['auto_promo_id'].')" >'.$this->global_mod->db_parse($this->lang->line("del_btn")).'</a>
					  </td>';
				$str.='<td></td>';
				$str.='</tr>';
			}
		}else{
				$str.='<tr>';
				$str.='<td colspan="6" align="center">'.$this->global_mod->db_parse($this->lang->line('no_data_found')).'.</td>';
				$str.='</tr>';
		}
		echo $str;
	?>
	</tbody>
</table>
<br>
</div>
<?php include('autopromotion.js.php'); ?>   
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













