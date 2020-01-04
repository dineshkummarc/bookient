<?php include('review_status.js.php'); ?>
<script type="text/javascript">
function show_det(val){
	//alert(val);
	
	$('#'+ val).next('.det_i').toggle();	
}
</script>
<?php 
  //echo '<pre>';print_r($ResArr);exit; ?>
<div class="rounded_corner_full">
    <h1 class="headign-main"> Reviews </h1>
    <?php 
    $counter=1; 
    ?>
    <?php 
    foreach($ResArr as $result){ 
    $outer = ($counter == count($ResArr))?"review-outer-none":"review-outer";
    //review-outer-none    
    ?>
    
    <div class="<?php echo $outer;?>">
        <table>		
            <tr>	 	
                <td>
                    <div class="ratting-box">
                        <input name="my_input" value="3" id="rating_simple<?php echo $counter; ?>" type="hidden">		
                        <div class="spacer"></div>
                    </div> 
                    by <?php echo (isset($result['cus_fname']))?$result['cus_fname']:''; ?>
                       <?php echo (isset($result['cus_lname']))?$result['cus_lname']:''; ?>
                    <br/>   
                    <?php echo DATE("jS F, Y", STRTOTIME($result['posted_on'])); ?> 			
                </td>				
                <td>
                    <?php echo $result['comments'];?>				
                </td>				
            </tr>				
        </table>
        <div class="review-inner">
            <a class="review-view-details-link" href="javascript:void(0);"> View Details</a>
            <div class="review-view-details" style="display: none;">
                <table width="30%" border="0" cellspacing="3" cellpadding="0">		
                    <tr>	 	
                        <td>
                            <?php echo (isset($result['user_email']))?$result['user_email']:''; ?>	<br/>
                            <?php echo (isset($result['cus_address']))?$result['cus_address']:''; ?><br/>
                            <?php echo (isset($result['cus_mob']))?"(M)".$result['cus_mob']:''; ?>&nbsp;
                            <?php echo (isset($result['cus_phn1']))?"(H)".$result['cus_phn1']:''; ?>&nbsp;
                            <?php echo (isset($result['cus_phn2']))?"(W)".$result['cus_phn2']:''; ?>&nbsp;	

                        </td>				
                        <td>
                            <?php echo (isset($result['srvDtls_service_start']))?DATE("jS F, Y g:i a", STRTOTIME($result['srvDtls_service_start'])):''; ?>	<br/>
                            <?php echo (isset($result['srvDtls_service_name']))?$result['srvDtls_service_name']:''; ?>
                            <?php echo (isset($result['srvDtls_service_duration']))?$result['srvDtls_service_duration']:''; ?>
                            <?php echo ($result['srvDtls_service_duration_unit'] =="M")?"min":''; ?>&nbsp;by&nbsp;
                            <?php echo (isset($result['srvDtls_employee_name']))?$result['srvDtls_employee_name']:''; ?>&nbsp;from&nbsp;
                            <?php echo (isset($result['srvDtls_service_start']))?DATE("g:i a", STRTOTIME($result['srvDtls_service_start'])):''; ?>
                        </td>				
                    </tr>				
                </table>
            </div>	
        </div>
    </div>
    <?php $counter=$counter+1; } ?>
    <div id="paginate" style="padding: 0 30px 0 0 ;"><?=$pagination?></div>
</div>
 <!-- //DATE("j F, Y g:i a", STRTOTIME($result['posted_on']))-->