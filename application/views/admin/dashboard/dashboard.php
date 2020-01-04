<?php include('dashboard.js.php'); ?>
<style>
    .highlight { color: #f00 !important; font-weight: bold }
    .highlight2 { color: #090 !important; font-weight: bold }
    .birthday { background: #fff; font-weight: bold }
    .birthday.DynarchCalendar-day-selected { background: #89f; font-weight: bold }
</style>
<!--<a href="javascript:fullevent();" style="float:right;font-size:medium">click</a>-->
<div class="content">
    <a href="javascript:fullevent();" style="float:right;font-size:medium">click</a>
    <div id='calendar'></div>
</div>
<!--<?php //echo $this->lang->line('headign-main'); ?>-->
<div class="openmodalbox">
		<div class="modalboxContent">
                <div id="exixtingEvent"> 
                        <table align="center"  width="98%"><tr>
                        <td align="left"><h3>Appointment Chart</h3></td>
                        <td align="right"><span><a href="#" onclick="deleteThisBooking();">Delete This Booking</a></span></td>
                        </tr></table><br/>
		 <div>
                <span style="font-size:16px; font-weight:bold;" id="eventStart"></span> <br />
                <span style="font-size:14px" id="service_name" ></span><br/>
                <span style="font-size:12px" id="srvcDesc" ></span><br/><br/>
          
                Current Status : <span style="font-weight:bold" id="BookingStatusDisp"></span> &nbsp;&nbsp;&nbsp;&nbsp; <strong>Change status To : </strong> 
                <span id="Approve"><a href="javascript:changeStatus('1');">Approve</a></span> | 
                <span id="Cancel"><a href="javascript:changeStatus('4');">Cancel</a></span> |
                <span id="Completed"><a href="javascript:changeStatus('3');">Completed</a></span>
                <input type="hidden" name="booking_service_id" id="booking_service_id" value="" />
                <input type="hidden" name="booking_id" id="booking_id" value="" />

                <input type="hidden" name="newReg_cust_id" id="newReg_cust_id" value="" />
                </div>
                      <div align="center"  style="border:1px solid;border-color:#B8D8E7;" >
                <strong>By : </strong><span id="employee_name"></span>&nbsp;&nbsp;
                <strong>For : </strong><span id="cust_name"></span>&nbsp;&nbsp;
                <strong>Duration : </strong><span id="service_duration"></span>&nbsp;&nbsp;
                <strong>Cost : $</strong><span id="service_cost"></span>
                </div>
                
                <br/>
                <p align="center">
                <a href="javascript:void(0);" onClick="ask_review('1')">Ask For Review</a></p>
			<!-- put HTML-Content here / BEGIN -->
			<!-- put HTML-Content here / END -->
                </div>
                   <div id="newBooking">
                        <a href="javascript:existing_user();">Existing User</a>&nbsp;&nbsp;
			 <a href="javascript:new_user();">New User</a>
			 <div id="existing_user" style="border:10px solid;border-color:#B8D8E7;padding:10px 0px 10px 10px;">
                             <from name="f2" id="f2" method="post">
			 <table style="width:100%">
                          <tr>
			 <td>
			<div id="search"> Search by First Name, Last Name or Email Address </div>
			 </td>
			 </tr>
			 <tr>
			 <td colspan="2">
                             <input type="text" name="serachkey" id="serachkey"   style="display:inline;background-color:#CCCCCC" size="60px" />
			 </td>
			 </tr>
                          <tr>
			 <td colspan="2">
                             <input type="button" name="submit" value="submit" onclick="ajxCall()"/>
			 </td>
			 </tr>
                          <tr><td colspan="2" id="DispStaffArea"></td></tr>
 			 </table>
                                 </from>
			 </div>
			 <div id="new_user" style="border:10px solid;border-color:#B8D8E7;padding:10px 0px 10px 10px; display: none;">
                             <div id="userregismodule">
			 <form>
			 <table align="center">
			 <tr>
			 <td> Name: </td>
			 <td>
			 <input type="text" id="cus_fname_2"   value="First Name" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='First Name'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
			
			 <input type="text" id="cus_lname_3"    value="Last Name" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='Last Name'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
			 <font color="#CC0000" size="-6"><div id="cus_fname_div" class="required_div"></div></font>
			   </td>
			   </tr>
                           <tr>
                           <td>Mobile:</td>
                         <td>
                         <input type="text" name="cus_mob_9" id="cus_mob_9" value="Mobile" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='Mobile'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
                         <span id="cus_phn1_10_div" class="required_div" ></span>
                         </td>
                         </tr>
                        <tr>
                         <td valign="top">Phone1:</td>
                         <td>
                         <input type="text" name="cus_phn1_10" id="cus_phn1_10" value="Phone1" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='Phone1'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
                         <span id="cus_phn1_10_div" class="required_div" ></span>
                         </td>
                         </tr>
                                                                           <tr>
                         <td valign="top">Phone2:</td>
                         <td>
                         <input type="text" name="cus_phn2_11" id="cus_phn2_11" value="Phone2" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='Phone2'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
                         <span id="cus_phn1_10_div" class="required_div" ></span>
                         </td>
                         </tr>
                         <tr>			
                         <td valign="top">Address:</td>
                         <td>
                         <textarea name="cus_address_4" id="cus_address_4" ></textarea>
                         <span id="cus_address_4_div" class="required_div" >
                         </span>
                         </td>
                         </tr>
			 <tr>
                        <td>Email</td>
                        <td>
                        <input type="text" id="user_email_p" value="Email" onfocus="if(this.value == this.defaultValue)this.value=''" 
                                onblur="if(this.value == '')this.value='Email'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
                                    <font color="#CC0000" size="-6"><div id="user_email_p_div" class="required_div"></div></font>
                                    </td>
                        </tr>
			 </table>
                             <input type="button"  name="book" value="Book Now" style="background-color:#999999" align="right" id="btn-submit_book" onclick="submit1()" />
			 </form>
                             </div>
                             <div id="bookingModule"></div>
			 </div>
                    </div>
		</div>
	</div>