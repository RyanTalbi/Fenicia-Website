<!DOCTYPE html>
<html>
<head>


</head>
<body>
<form action="./charge.php" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element">Credit or debit card</label>
    	<div id="card-element">
      		<!-- a Stripe Element will be inserted here. -->
    		</div>
    		<div id="card-errors">
    			<!-- Used to display form errors -->
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
