<html>
<head>
	<title>Checkout</title>
</head>
<body>
	
	<h1>Checkout</h1>
	<?php 
	$attributes = array('id' => 'payment-form');
	echo form_open('backend/midtrans/vtweb/vtweb_checkout'); ?>
		
			<button class="submit-button" type="submit">Submit Payment</button>
	<?php 
	echo form_close(); ?>
</body>
</html>
