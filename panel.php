<?php
	session_start();
      	require 'connectToDatabase.php';
      	if(isset($_POST["constructor"]) && isset($_POST["model"]) && isset($_POST["plate"]) && isset($_POST["year"]) && isset($_POST["graycardnumber"]) && isset($_POST["color"]) && isset($_POST["rent"]) && isset($_POST["gearbox"]) && isset($_POST["distance"]) && isset($_POST["placesnumber"]) && isset($_POST["doorsnumber"]) && isset($_POST["fuel"]) && $_SESSION["isAdmin"] == 1)
      {
        $targetFolder = "images/cars/";
        $filename = strtolower($_FILES['image']['name']); 
        if(isset($_POST["submit"]))
        {
          $check = getimagesize($_FILES["image"]["tmp_name"]); // On vérifie que le fichier est bien une vraie image
          if($check !== false)
          {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFolder.$filename);
          } 
        }
        $filesystemfilename = $targetFolder.$filename;
        
        
        if(isset($_POST["gps"]))
          $gps = $_POST["gps"];
        else
          $gps = 0;
        if(isset($_POST["airConditioning"]))
          $airConditioning = $_POST["airConditioning"];
        else
          $airConditioning = 0;
        if(isset($_POST["onboardAudio"]))
          $onboardAudio = $_POST["onboardAudio"];
        else
          $onboardAudio = 0;     
          
          
        $plate = $_POST["plate"];
        $model = $_POST["model"];
        $graycardnumber = $_POST["graycardnumber"];
        $constructor = $_POST["constructor"];
        $year = $_POST["year"];
        $color = $_POST["color"];
        $rent = $_POST["rent"];
        $gearbox = $_POST["gearbox"];
        $placesnumber = $_POST["placesnumber"];
        $doorsnumber = $_POST["doorsnumber"];
        $fuel = $_POST["fuel"];
        $description = $_POST["description"];
        $distance = $_POST["distance"];
        
        try
        {
		   $sql = $connection->prepare("INSERT INTO Voitures  VALUES(:plate,:model,:graycardnumber,:constructor,:year,:color,:rent,:imageName,:gearbox,:placesnumber,:doorsnumber,:fuel,:description,:constructor,:distance,:gps,:airConditioning,:onboardAudio)");   
		   $sql->bindParam(":plate",$plate);
		   $sql->bindParam(":model",$model);
		   $sql->bindParam(":graycardnumber",$graycardnumber);
		   $sql->bindParam(":constructor",$constructor);
		   $sql->bindParam(":year",$year);
		   $sql->bindParam(":color",$color);
		   $sql->bindParam(":rent",$rent);
		   $sql->bindParam(":imageName",$filesystemfilename);
		   $sql->bindParam(":gearbox",$gearbox);
		   $sql->bindParam(":placesnumber",$placesnumber);
		   $sql->bindParam(":doorsnumber",$doorsnumber);
		   $sql->bindParam(":fuel",$fuel);
		   $sql->bindParam(":description",$description);
		   $sql->bindParam(":constructor",$constructor);
		   $sql->bindParam(":distance",$distance);
		   $sql->bindParam(":gps",$gps);
		   $sql->bindParam(":airConditioning",$airConditioning); 
		   $sql->bindParam(":onboardAudio",$onboardAudio);
		   $sql->execute();  
       }
       catch(PDOException $exception)
       {
       	   echo "Erreur lors de l'insertion des données dans la base de données : " . $exception->getMessage();
       }
    }
?>  
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Fenicia - Free Bootstrap 4 Template by Colorlib</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>    
    	$(document).ready(function(){ }})
    </script>
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
	          <li class="nav-item"><a href="applications.php" class="nav-link">Dossiers en attente</a></li>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>Panel</span></p>
          </div>
        </div>
      </div>
    </section>
		

      <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
        <?php 
        if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1)
        {
        ?>
            <form action="" class="request-form ftco-animate bg-primary" method="post" enctype="multipart/form-data">
                <h2>Ajouter un véhicule</h2>
                <div class="form-group">
                  <label for="" class="label">Marque</label>
                  <input list="constructor" type="text" class="form-control" name="constructor" placeholder="Marque" required />
                  <datalist id="constructor">
			  		  	<option value="Renault">
			 	 		<option value="Peugeot">
			  			<option value="Citroen">
			  			<option value="Volkswagen">
			  			<option value="Dacia">
			  			<option value="Toyota">
			  			<option value="Ford">
			  			<option value="BMW">
			  			<option value="Mercedes">
			  			<option value="Audi">
			  			<option value="Fiat">
			  			<option value="Opel">
			  			<option value="Nissan">
			  			<option value="Hyundai">
					</datalist>
                </div>
                <div class="form-group">
                  <label for="" class="label">Modèle</label>
                  <input type="text" class="form-control" name="model" placeholder="Modèle" required />
                </div>   
                <div class="form-group">
                  <label for="" class="label">Immatriculation</label>
                  <input type="text" class="form-control" name="plate" placeholder="Immatriculation" required />
                </div>
                <div class="form-group">
                  <label for="" class="label">Année</label>
                  <input type="number" class="form-control" name="year" placeholder="Année"  min="1900" max="9999" step="1" value="2022" required />
                </div>
                <div class="form-group">
                  <label for="" class="label">Numéro de carte grise</label>
                  <input type="text" class="form-control" name="graycardnumber" placeholder="Numéro de carte grise">
                </div>
                <div class="form-group">
                  <label for="" class="label">Couleur</label>
                  <input list="color" type="text" class="form-control" name="color" placeholder="Couleur">
                   <datalist id="color">
			  		  	<option value="Blanche">
			 	 		<option value="Noire">
			  			<option value="Grise foncée">
			  			<option value="Grise claire">
			  			<option value="Bleu">
			  			<option value="Rouge">
			  			<option value="Beige">
			  			<option value="Vert">
			  			<option value="Jaune">
					</datalist>
                </div>
                <div class="form-group">
                  <label for="" class="label">Loyer</label>
                  <input type="text" class="form-control" name="rent" placeholder="Loyer">
                </div>
                <div class="form-group">
                  <label for="" class="label">Boite de vitesse</label>
                  <input list="gearbox" type="text" class="form-control" name="gearbox" placeholder="Boite de vitesse">
                  <datalist id="gearbox">
                  	<option value="Automatique">
                  	<option value="Manuelle">
                 </datalist>
                </div>
                <div class="form-group">
                  <label for="" class="label">Nombre de places</label>
                  <input type="text" class="form-control" name="placesnumber" placeholder="Nombre de places">
                </div>
                <div class="form-group">
                  <label for="" class="label">Nombre de portes</label>
                  <input type="text" class="form-control" name="doorsnumber" placeholder="Nombre de portes">
                </div>
                <div class="form-group">
                  <label for="" class="label">Carburant</label>
                  <input list="fuel" type="text" class="form-control" name="fuel" placeholder="Carburant">
                  <datalist id="fuel">
                  	<option value="Essence">
                  	<option value="Diesel">
                  	<option value="Électrique">
                 </datalist>
                </div>
                <div class="form-group">
                  <label for="" class="label">Description du véhicule</label>
                  <input type="text" class="form-control" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                  <label for="" class="label">Image d'illustration</label>
                  <input type="file" name="image">
                </div>
                <div class="form-group">
                  <label for="" class="label">Kilometrage</label>
                  <input type="number" class="form-control" name="distance" placeholder="Kilométrage">
                </div>
                <div class="form-group">
                  <label for="gps">GPS<input type="checkbox" id="vehicle1" name="gps" value="1"></label><br>
                </div>
                <div class="form-group">
                  <label for="gps">Air conditionné><input type="checkbox" id="vehicle1" name="airConditioning" value="1"></label><br>
                </div>
                <div class="form-group">
                  <label>Audio intégré<input type="checkbox" id="vehicle1" name="onboardAudio" value="1"></label><br>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" value="Ajouter" class="btn btn-secondary py-3 px-4">
                </div>
            </form>
          </div>    
        <?php  
        }
        else
        {
          echo "Accès non autorisé.";
        }
      ?> 
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
              <h2 class="ftco-heading-2">Informations</h2>
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
              <h2 class="ftco-heading-2">Support client</h2>
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
              <h2 class="ftco-heading-2">Vous avez une question ?</h2>
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
