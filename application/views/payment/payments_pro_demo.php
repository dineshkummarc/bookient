
<style>
.h5_class{ font:Verdana, Geneva, sans-serif; font-size:12px; color:#930;}
</style>

<div class="wrap">
	<h2 class="text-center"></h2>
            <form class="styled" method="post" action="<?php echo base_url(); ?>payment_pro/do_direct_payment_demo">
                <fieldset>
                      <h5 class="h5_class" id="msg"><?php echo (isset($err_msg) && $err_msg != '')?$err_msg:''; ?></h5>
                      <ol>
					        <li class="form-row"><label>Email:*</label>
                              <input name="email" id="email" type="text" class="text-input"/>
							   <br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">citytech.testerper1@gmail.com</font> for testing]</span>
                            </li>
							
                            <li class="form-row"><label>First Name:*</label>
                              <input name="first_name" id="first_name" type="text" class="text-input"/>
                            </li>

                            <li class="form-row"><label>Last Name:*</label>
                                <input name="last_name" type="text" id="last_name" class="text-input" />
                            </li>

                            <li class="form-row"><label>Address1:*</label>
                                <input name="address1" type="text" id="address1" class="text-input"/>
                            </li>
							
							<li class="form-row"><label>Address2:</label>
                                <input name="address2" type="text" id="address2" class="text-input"/>
                            </li>
							
							<li class="form-row"><label>City:*</label>
                                <input name="city" type="text" id="city" class="text-input"/>
								<br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">Kansas City</font> for testing]</span>
                            </li>
							
							<li class="form-row"><label>State:*</label>
                                <input name="state" type="text" id="state" class="text-input"/>
								<br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">MO</font> for testing]</span>
                            </li>
							
							<li class="form-row"><label>Country:*</label>
                                <input name="coutrycode" type="text" id="countrycode" class="text-input"/>
								<br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">US</font> for testing]</span>
                            </li>
							
							<li class="form-row"><label>Postcode:*</label>
                                <input name="postcode" type="text" id="postcode" class="text-input"/>
								<br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">64111</font> for testing]</span>
                            </li>
							
							<li class="form-row"><label>Phone Number:</label>
                                <input name="phoneno" type="text" id="phoneno" class="text-input"/>
                            </li>
							
							<li class="form-row"><label>Amount:*</label>
                                <input name="amount" type="text" id="amount" class="text-input"/>
                            </li>
							
							<li class="form-row"><label>CC Type:*</label>
                                <select name="cardtype">
									<option value="AmericanExpress">AmericanExpress</option>
									<option value="Discover">Discover</option>
									<option value="Visa">Visa</option>
								    <option value="MasterCard">MasterCard</option>
								</select><br />
								<span style="font-size: 11px;">[Use <font style="color:#34830a">Visa</font> for testing]</span>
                            </li>
							<li class="form-row"><label>Creditcard Number:*</label>
                               <input name="ccnumber" type="text" id="ccnumber" class="text-input"/><br />
							   <span style="font-size: 11px;">
							   [Use <font style="color:#34830a">4853004287982724</font> for testing]</span>
                            </li>
							<li class="form-row"><label>Expiry Date:*</label>
                               <select name="month">
							   	<option value="01">Jan</option>
								<option value="02">Feb</option>
								<option value="03">Mar</option>
								<option value="04">Apr</option>
								<option value="05">May</option>
								<option value="06">Jun</option>
								<option value="07">Jul</option>
								<option value="08">Aug</option>
								<option value="09">Sep</option>
								<option value="10">Oct</option>
								<option value="11">Nov</option>
								<option value="12">Dec</option>
							   </select>
							   <select name="year">
							   <?php for($y=date('Y');$y<date('Y')+18;$y++){
							   	?>
								<option value="<?php echo $y?>"><?php echo $y?></option>
							   <?php  } ?>
							   	</select><br />
								<span style="font-size: 11px;">
							    [Use <font style="color:#34830a">Jun '2018</font> for testing]</span>
                            </li>
							<li class="form-row"><label>CVV:*</label>
                               <input name="cvv" type="text" id="cvv" class="text-input"/>
							   <br />
								<span style="font-size: 11px; padding-left:101px;">
							    [Use <font style="color:#34830a">three digit number</font> for testing]</span>
                            </li>
                            <li >
                              <input type="submit" value="Submit"/>
                            </li>
                            
                      </ol>
                    </fieldset>
            </form>
</div>