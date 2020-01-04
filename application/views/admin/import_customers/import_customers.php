<?php include('import_customers.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main">Import Customers</h1>
	<h2>File to be included</h2>
	<span id="msgInsert"></<span>
	<form action="" method="POST" onsubmit="return false" enctype="multipart/form-data">
		<input type='file' name='csvFile' id='csvFile' accept=".csv">
		<br><br>
		<!--input type="button" onclick="import_customers();" alt="Import" value="Submit" class="btn-blue" style="margin-left:152px;" /-->
		<input type="button"  class="btn-blue" value="submitAd" id="import_customers"/>
	</form>
	<br>
</div>