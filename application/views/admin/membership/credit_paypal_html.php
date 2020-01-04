<?php
	$str='';
        $str.='<form name="frm_paymentDetails_credits" id="frm_paymentDetails_credits" method="post" onsubmit="return false;">';        
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bookung_tab">';
        $str.='<tr class="booking_tab_row_top">';
        $str.='<td align="left"><b>'.$this->lang->line('mobile_payment_details').' :</b></td>';//Payment details
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left"><hr style="width:100%;"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td>';
            $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_first_name').':<label style="color:#FF0000">*</label></td>';//First Name
            $str.='<td width="60%" align="left"><input value="" name="pay_first_name" id="pay_first_name" type="text" class="payBooking pf_required" onkeydown="validate_name(event)"/></td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_last_name').':<label style="color:#FF0000">*</label></td>';//Last Name
            $str.='<td width="60%" align="left"><input value="" name="pay_last_name" id="pay_last_name" type="text" class="payBooking pf_required" onkeydown="validate_name(event)"/></td>';
            $str.='</tr>';

            //$str.='<tr>';
            //$str.='<td width="40%" align="left">'.$this->lang->line('mobile_amount').':<label style="color:#FF0000">*</label></td>';//Amount
            //$str.='<td width="60%" align="left"><input name="pay_amount" id="pay_amount" type="text" class="payBooking pf_required" value="'.$price.'" /></td>';//readonly 
           //$str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_cc_type').':<label style="color:#FF0000">*</label></td>';//CC Type
            $str.='<td width="60%" align="left">';
                    $str.='<select id="pay_cardtype" name="pay_cardtype" class="payBookingSelect payBooking_select pf_required">';
                    $str.='<option value="">Select Card</option>';
                    $str.='<option value="Visa">Visa</option>';
                    $str.='<option value="MasterCard">MasterCard</option>';
                    $str.='<option value="Discover">Discover</option>';
                    $str.='<option value="Amex">American Express</option>';
                    $str.='</select>';
            $str.='</td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_creditcard_number').':<label style="color:#FF0000">*</label></td>';//Creditcard Number
            $str.='<td width="60%" align="left"><input value="4070441618074408" name="pay_ccnumber" id="pay_ccnumber" type="text" class="payBooking pf_required" /></td>';//onkeydown="isNumber(event)"
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_expiry_date').':<label style="color:#FF0000">*</label></td>';//Expiry Date
            $str.='<td width="60%" align="left">';
                    $str.='<select id="pay_month" name="pay_month" class="payBookingSelect payBooking_select_sm pf_required">';
                    $str.='<option value="">'.$this->lang->line('mobile_select_month').'</option>';//Select Month
                    $str.='<option value="1">'.$this->lang->line('cal_jan').'</option>';//Jan
                    $str.='<option value="2">'.$this->lang->line('cal_feb').'</option>';//Feb
                    $str.='<option value="3">'.$this->lang->line('cal_mar').'</option>';//Mar
                    $str.='<option value="4">'.$this->lang->line('cal_apr').'</option>';//Apr
                    $str.='<option value="5">'.$this->lang->line('cal_may').'</option>';//May
                    $str.='<option value="6">'.$this->lang->line('cal_jun').'</option>';//Jun
                    $str.='<option value="7">'.$this->lang->line('cal_jul').'</option>';//Jul
                    $str.='<option value="8">'.$this->lang->line('cal_aug').'</option>';//Aug
                    $str.='<option value="9">'.$this->lang->line('cal_sep').'</option>';//Sep
                    $str.='<option value="10">'.$this->lang->line('cal_oct').'</option>';//Oct
                    $str.='<option value="11">'.$this->lang->line('cal_nov').'</option>';//Nov
                    $str.='<option value="12">'.$this->lang->line('cal_dec').'</option>';//Dec
                    $str.='</select> &nbsp;&nbsp;';
                    $str.='<select id="pay_year" name="pay_year" class="payBookingSelect payBooking_select_sm pf_required">';
                    $str.='<option value="">'.$this->lang->line('mobile_select_year').'</option>';//Select Year
                    for($y=date('Y');$y<date('Y')+18;$y++){
                        $str.='<option value="'.$y.'">'.$y.'</option>';
                    }
                    $str.='</select>';
            $str.='</td>';
            $str.='</tr>';
            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->lang->line('mobile_cvv').':<label style="color:#FF0000">*</label></td>';//CVV
            $str.='<td width="60%" align="left"><input value="341" name="pay_cvv" id="pay_cvv" type="text" class="payBooking pf_required" maxlength="3" onkeydown="isNumber(event)"/></td>';
            $str.='</tr>';
            $str.='</table>';
            $str.='</td>';	
    		$str.='</tr>';
            $str.='<tr class="booking_tab_row_footer">';
	    $str.='<td align="center">';
	    
	  
		$str.='<div onclick="chooseCredit('.$credit_id.')" style="margin-left: 180px; text-align: center; margin-top: 20px;" class="membershipButton">Update</div>';
		
		$str.='</td>';//Payment
	    $str.='</tr>';
	    $str.='</table>';          
	            
	    $str.='</form>'; 
	   	echo $str;
?>