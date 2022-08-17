<?php
	require __DIR__ . '/vendor/autoload.php';
?>


<!DOCTYPE html>
<html>
<head>
<title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
	// THIS PAGE SHOULD NOT BE DEPLOYED IN PRODUCTION. IT IS FOR TESTS PURPOSES ONLY. CURL HAVE TO BE INTEGRATED TO PASS THE PRICE BEFORE UPLOADING THIS ONTO THE PRODUCTION SERVER !!!
	if(isset($_GET["plate"]))
	{
		$plate = $_GET["plate"];
		$stripe = new \Stripe\StripeClient('sk_test_51LWXiwFavA2B59TWvssO3cFYPXHCpg5ohuJYGn5oDqbgFXjn8gSnDyRBG5ouoivCPrk8TlCjKwEQRxN4nn2RlXHX00H7btuqCv');
		$product = $stripe->products->create(['name' => 'Location de véhicule',]);
		$price = $stripe->prices->create([
		  'unit_amount' => 100,
		  'currency' => 'eur',
		  'product' => 'prod_MFq752vvZUD54D',
		]);
		$stripe->paymentLinks->create(
		['line_items' => [['price' => $price["id"]	
		,'quantity' => 1]]]
		);
	}	

?>
<form action="./charge.php" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element">Credit or debit card</label>
    	<div id="card-element">
    		</div>
    		<div id="card-errors">
    	</div>
  </div>
  <button>Submit Payment</button>
</form>
<!-- The needed JS files -->
<!-- JQUERY File -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>

</body>
</html>
