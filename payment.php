<?php
	require __DIR__ . '/vendor/autoload.php';
?>


<!DOCTYPE html>
<html>
<head>


</head>
<body>
<?php
	// THIS PAGE SHOULD NOT BE DEPLOYED IN PRODUCTION. IT IS FOR TESTS PURPOSES ONLY. CURL HAVE TO BE INTEGRATED TO PASS THE PRICE BEFORE UPLOADING THIS ONTO THE PRODUCTION SERVER !!!
	if(isset($_GET["plate"]) && isset($_GET["model"]))
	{
		$plate = $_GET["plate"];
		$model = $_GET["model"];
		$rentingPrice = $_GET["price"];
		
		$stripe = new \Stripe\StripeClient("sk_test_51LWXiwFavA2B59TWvssO3cFYPXHCpg5ohuJYGn5oDqbgFXjn8gSnDyRBG5ouoivCPrk8TlCjKwEQRxN4nn2RlXHX00H7btuqCv");
		$product = $stripe->products->create([
	  	'name' => 'Car rent, plate : '.$plate.' model : '.$model,
	  	'description' => '€'.$rentingPrice.' payment',
		]);
		echo "Success! Here is your starter subscription product id: " . $product->id . "\n";

		$price = $stripe->prices->create([
	  	'unit_amount' => $rentingPrice,
	  	'currency' => 'eur',
	  	'recurring' => ['interval' => 'month'],
	  	'product' => $product['id'],
		]);
		echo "Success! Here is your premium subscription price id: " . $price->id . "\n";
		var_dump($price);
		echo $price['id'];
		$id = $price['id'];
		
		$stripe->paymentLinks->create(
		  ['line_items' => [['price' => $id
		, 'quantity' => 1]]]
		);
		echo $paymentLink['url'];
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
