<?php include('dashboard.js.php'); ?>
<!--<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}
	.content{
		width:75%;
		float:left;
		display:block;
	}	

</style>-->
<style>
.highlight { color: #f00 !important; font-weight: bold }
.highlight2 { color: #090 !important; font-weight: bold }
.birthday { background: #fff; font-weight: bold }
.birthday.DynarchCalendar-day-selected { background: #89f; font-weight: bold }
</style>
<a href="javascript:fullevent();" style="float:right;font-size:medium">click</a>
<div class="content">
    <div id='calendar'></div>
</div>

<div class="openmodalbox">
       
		<div class="modalboxContent">
		<h3>Book Your Appointment</h3><br/><br/>
		 <div id="eventStart" ></div>
		 <div id="eventTitle" style="border:1px solid;border-color:#B8D8E7;" ><h2></h2></div><br/>
		 <br/><br/>
		     <a href="javascript:existing_user();">Existing User
			 </a>&nbsp;&nbsp;
			 <a href="javascript:new_user();">New User
			 </a>
			 
			 <div id="existing_user" style="border:10px solid;border-color:#B8D8E7;padding:10px 0px 10px 10px;">
			 <table style="width:100%">
			 <tr>
			 <td>
			<div id="search">
             Search by First name or <br/>
			 Last name or Email or Phone
			 </div>
			 </td>
			 <td>
			 <input type="checkbox" value="1" id="global_search" onclick="global_search_f(this.value)" /> Global Search
             </td>
			 </tr>
			 <tr>
			 <td colspan="2">
			  <input type="text"   value="search" onfocus="if(this.value == this.defaultValue)this.value=''" onblur="if(this.value == '')this.value='search'" style="display:inline;background-color:#CCCCCC" size="60px" />
			 </td>
			 </tr>
			 </table>
			 </div>
			 
			 
			 
			 <div id="new_user" style="border:10px solid;border-color:#B8D8E7;padding:10px 0px 10px 10px;">
			 <form>
			 <table align="center">
			 <tr>
			 <td>
			 Name:
			 </td>
			 <td>
			 <input type="text" id="cus_fname_2"   value="First Name" onfocus="if(this.value == this.defaultValue)this.value=''" onblur="if(this.value == '')this.value='First Name'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
			
			 <input type="text" id="cus_lname_3"    value="Last Name" onfocus="if(this.value == this.defaultValue)this.value=''" onblur="if(this.value == '')this.value='Last Name'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" class="required" />
			 <font color="#CC0000" size="-6"><div id="cus_fname_div" class="required_div">
		     </div></font>
			   </td>
			   </tr>
			 <tr>
             <td>
			 Email
			
			 </td>
             <td>
			 <input type="text" id="user_email_p"  style="background-color:#CCCCCC" border="1"  size="45px" class="required" class="required"   />
			 <font color="#CC0000" size="-6"><div id="user_email_p_div" class="required_div"></div></font>
			 </td>
             </tr>
			 <tr><td>

			 Phone
			 
			 </td><td>
			 <input type="text" id="cus_phn1_10"  style="background-color:#CCCCCC" border="1" size="45px"/>
			  <div id="cus_phn1_10_div">
		     </div>
			 </td></tr>
			 <tr>			
			 <td>

             Address:
		
			 </td><td>
			 <input type="text" id="cus_address_4"  style="background-color:#CCCCCC" border="1" size="45px"/>
			  <div id="cus_address_4_div">
		     </div>
			 </td></tr>
			 <tr>			
			 <td >
			 </td>
			 <td>
			 <?php echo  $country;   ?> 
			 </td>
             </tr>
			 <tr>
			 <td></td>
			 <td>
			 <?php echo  $region;   ?>
			 </td>
             </tr>
			 <tr>
			 <td></td>
			 <td>
			
			 <?php echo  $city;   ?> 
			  <input type="text" id="cus_zip_8"    value="Zip" onfocus="if(this.value == this.defaultValue)this.value=''" onblur="if(this.value == '')this.value='Zip'" style="display:inline;background-color:#CCCCCC" border="1" size="20px" />
			 </td>
			 </tr>
			 <tr>			
			 <td >
			 </td>
			 <td>

             
			 <?php echo  $time_zone;   ?> 
			 </td></tr>
			 
			 </table>
				  		
				
				
			
			 
			  <input type="button"  name="book" value="Book Now" style="background-color:#999999" align="right" id="btn-submit_book" onclick="submit1()" />
			 </form>
			 </div>
			<!-- put HTML-Content here / BEGIN -->
			
			<!-- put HTML-Content here / END -->
			
		</div>
		
</div>

