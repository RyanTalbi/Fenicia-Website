<?php 
	session_start(); require 'connectToDatabase.php'; 
	if(isset($_SESSION["email"]))
	{
		$sql = $connection->prepare('SELECT * FROM Clients WHERE email = :email'); 
		$sql->bindParam(":email",$_SESSION["email"]);
		$sql->execute();
		$result = $sql->fetch();
		$street = $result["Rue"];
		$city = $result["Ville"];
		$phoneNumber = $result["Telephone"];
		$email = $result["Email"];
		
		
		$sql = $connection->prepare('SELECT * FROM DepotsDossiers WHERE email = :email');
		$sql->bindParam(":email",$email);
		$sql->execute();
		$result = $sql->fetch();
		if($result)
		{
			$sirenAlreadyGiven = $result["SIRENRenseigne"];
			$licenseAlreadyGiven = $result["PermisRenseigne"];
			$idAlreadyGiven = $result["IdentiteRenseignee"];
		}
		else
		{
			$sirenAlreadyGiven = true;
			$licenseAlreadyGiven = true;
			$idAlreadyGiven = true;
		}
	}
	
	$badDriverLicenseMime = false;
	$badIdCardMime = false;
	$badSIRENMime = false;
	$targetFolder = "applications/".$_SESSION["email"]."/";

	if(isset($_FILES["driverLicense"]) && $_FILES['driverLicense']['size'] != 0)
	{
        	if(mime_content_type($_FILES['driverLicense']['tmp_name']) != "application/pdf")
		{	
			$badDriverLicenseMime = true;
		}
		else
		{
           		move_uploaded_file($_FILES['driverLicense']['tmp_name'], $targetFolder."permisConduire.pdf");
           		$sql = $connection->prepare("UPDATE DepotsDossiers SET PermisRenseigne=1 WHERE email = :email");
           		$sql->bindParam(":email",$_SESSION["email"]);
           		$sql->execute(); 
           	}	
	}
	if(isset($_FILES["SIREN"]) && $_FILES['SIREN']['size'] != 0)
	{

		if(mime_content_type($_FILES['SIREN']['tmp_name']) != "application/pdf")
		{
			$badSIRENMime = true;
		}
		else
		{
			move_uploaded_file($_FILES['SIREN']['tmp_name'], $targetFolder."SIREN.pdf");
			$sql = $connection->prepare("UPDATE DepotsDossiers SET SIRENRenseigne=1 WHERE email = :email");
           		$sql->bindParam(":email",$_SESSION["email"]);
           		$sql->execute(); 
		}	
	}
	if(isset($_FILES["idCard"]) && $_FILES['idCard']['size'] != 0)
	{
		if(mime_content_type($_FILES['idCard']['tmp_name']) != "application/pdf")
		{
			$badIdCardMime = true;
		}
		else
		{
			move_uploaded_file($_FILES['idCard']['tmp_name'], $targetFolder."identite.pdf");
			$sql = $connection->prepare("UPDATE DepotsDossiers SET IdentiteRenseignee=1 WHERE email = :email");
           		$sql->bindParam(":email",$_SESSION["email"]);
           		$sql->execute(); 
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
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
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Fe<span>nicia</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Accueil</a></li>
	          <li class="nav-item"><a href="vehicles.php" class="nav-link">Véhicules</a></li>
	          <?php if(isset($_SESSION["isAdmin"]) and $_SESSION["isAdmin"] == 1){ ?>
	          <li class="nav-item"><a href="panel.php" class="nav-link">Panel d'administration des véhicules</a></li>
	          <li class="nav-item"><a href="applications.php" class="nav-link">Membres en attente</a></li>
	          <?php } ?>
	          <?php if(!isset($_SESSION['email'])){  ?> <li class="nav-item"><a href="login.php" class="nav-link">Se connecter</a></li> <?php }
	          else { ?>
	          	<li class="nav-item"><a href="profile.php" class="nav-link">Mon profil</a></li>
	          	<li class="nav-item"><a href="logout.php" class="nav-link">Se déconnecter</a></li>
	          <?php } ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>Mon profil <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Votre profil </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
        	<div class="col-md-4">
        		<div class="row mb-5">
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-map-o"></span>
			          	</div>
			            <p><span>Adresse :</span> <?php echo $street . " " .$city ?></p>
			          </div>
		          </div>
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-mobile-phone"></span>
			          	</div>
			            <p><span>Téléphone:</span><?php echo $phoneNumber; ?></a></p>
			          </div>
		          </div>
		          <div class="col-md-12">
		          	<div class="border w-100 p-4 rounded mb-2 d-flex">
			          	<div class="icon mr-3">
			          		<span class="icon-envelope-o"></span>
			          	</div>
			            <p><span>Email:</span><?php echo $email; ?></p>
			          </div>
		          
		          

				  <form class="request-form ftco-animate bg-primary" action="" method="post"  enctype="multipart/form-data">
				  	<h3>Mes documents : </h3>  
						<div class="input-group mb-3">
							<label class="label">Attestation SIREN
								<input type="file" class="form-control" id="inputGroupFile02" name="SIREN">
							</label>
							<?php if($sirenAlreadyGiven){ ?> <p> Vous avez déjà renseigné ce document </p> <?php } ?>
							<?php if($badSIRENMime){ ?><div class="alert alert-danger" role="alert">Merci d'insérer un pdf.</div><?php } ?>
						<div class="input-group mb-3">
							<label class="label">Permis de conduire
								<input type="file" class="form-control" id="inputGroupFile03" name="driverLicense">
							</label>
							<?php if($licenseAlreadyGiven){ ?> <p> Vous avez déjà renseigné ce document </p> <?php } ?>
							<?php if($badDriverLicenseMime){ ?><div class="alert alert-danger" role="alert">Merci d'insérer un pdf.</div><?php } ?>
						</div>
						<div class="input-group mb-3">
							<label class="label">Justificatif d'identité
								<input type="file" class="form-control" id="inputGroupFile04" name="idCard">
							</label>
							<?php if($idAlreadyGiven){ ?> <p> Vous avez déjà renseigné ce document </p> <?php } ?>
							<?php if($badIdCardMime){ ?><div class="alert alert-danger" role="alert">Merci d'insérer un pdf.</div><?php } ?>
						</div>
						<input type="submit" value="Envoyer le formulaire"/>
				  </form>    
				</div>
		 	</div>
	    </div>
	    <a id="deleteAccount" href="deleteAccount.php" class="link-danger">Supprimer mon compte ( Cette action est irréversible )</a>
    </div>
          <div class="col-md-8 block-9 mb-md-5">
            <form action="#" class="bg-light p-5 contact-form">
            	<h2>Besoin d'aide ?</h2>
              	<div class="form-group">
                	<input type="text" class="form-control" placeholder="Objet">
              	</div>
              	<div class="form-group">
                	<textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              	</div>
              	<div class="form-group">
                	<input type="submit" value="Envoyer un message" class="btn btn-primary py-3 px-5">
              	</div>
            </form>
          
          </div>
        </div>
        
      </div>
    </section>
	

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
              <p>Nous croyons qu'il faut rendre la location de voitures facile, pratique et abordable pour tous. Nous nous engageons à offrir à nos clients la meilleure expérience possible.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
