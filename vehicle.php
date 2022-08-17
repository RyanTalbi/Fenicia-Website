<?php 
	session_start(); require('connectToDatabase.php');
	$sql = $connection->prepare('SELECT * FROM Voitures WHERE PlaqueVehicule = :plate');                  
	$plate = $_GET["plate"];   
	$sql->bindParam(":plate",$plate);
	$sql->execute();
	$result = $sql->fetch();
	
	
	if(isset($_GET["delete"]))
	{
		$connection->prepare('DELETE FROM Voitures WHERE PlaqueVehicule = :plate');
		$connection->bindParam(':plate',$plate);
		sql->execute();
	}
?>

<!DOCTYPE html>
<html lang="fr">
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
          <a class="navbar-brand" href="index.php">Car<span>Book</span></a>
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
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>Details du véhicule <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Details du véhicule</h1>
          </div>
        </div>
      </div>
    </section>
        

        <section class="ftco-section ftco-car-details">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="car-details">
                     <div class="text text-center">
                    	<span class="subheading"><?php echo $result['ModeleVehicule']; ?></span>
                        <h2><?php echo $result['Constructeur']; ?></h2>
                    </div>
                    <div class="img rounded" style="background-image: url('<?php echo $result['CheminImage']; ?>');"> 
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
                    <div class="text">
                        <h3 class="heading mb-0 pl-3">
                            Kilométrage
                            <span><?php echo $result['Kilometrage']; ?></span>
                        </h3>
                    </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
                    <div class="text">
                        <h3 class="heading mb-0 pl-3">
                            Boîte de vitesse
                            <span><?php echo $result['BoiteVitesse']; ?></span>
                        </h3>
                    </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
                    <div class="text">
                        <h3 class="heading mb-0 pl-3">
                            Sièges
                            <span><?php echo $result['NombrePlaces']; ?></span>
                        </h3>
                    </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
                    <div class="text">
                        <h3 class="heading mb-0 pl-3">
                            Carburant
                            <span><?php echo $result['Carburant']; ?></span>
                        </h3>
                    </div>
                </div>
              </div>
            </div>      
          </div>
        </div>
        <div class="row">
            <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs">
                            <div class="d-flex justify-content-center">
                              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                  <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Review</a>
                                </li>
                              </ul>
                            </div>

                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="features">
                                            <?php if($result[15]){ echo '<li class="check"><span class="ion-ios-checkmark">'; } else { 
                                                echo '<li class="remove"><span class="ion-ios-close">'; }?> </span>GPS</li>                      
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="features">
                                            <?php if($result[16]){ echo '<li class="check"><span class="ion-ios-checkmark">'; } else { 
                                                echo '<li class="remove"><span class="ion-ios-close">'; }?> </span>Air conditionné</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="features">
                                            <?php if($result[17]){ echo '<li class="check"><span class="ion-ios-checkmark">'; } else { 
                                                echo '<li class="remove"><span class="ion-ios-close">'; }?> </span>Système audio intégré</li>
                                        </ul>        
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                              <p><?php echo $result[12]; ?></p>
                            </div>

                            <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                              <div class="row">
                                    <div class="col-md-7">
                                        <h3 class="head">23 Reviews</h3>
                                        <div class="review d-flex">
                                            <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">14 March 2018</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                        <div class="review d-flex">
                                            <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">14 March 2018</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                        <div class="review d-flex">
                                            <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">14 March 2018</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="rating-wrap">
                                            <h3 class="head">Give a Review</h3>
                                            <div class="wrap">
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        (98%)
                                                    </span>
                                                    <span>20 Reviews</span>
                                                </p>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        (85%)
                                                    </span>
                                                    <span>10 Reviews</span>
                                                </p>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        (70%)
                                                    </span>
                                                    <span>5 Reviews</span>
                                                </p>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        (10%)
                                                    </span>
                                                    <span>0 Reviews</span>
                                                </p>
                                                <p class="star">
                                                    <span>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        <i class="ion-ios-star"></i>
                                                        (0%)
                                                    </span>
                                                    <span>0 Reviews</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                       </div>
              </div>
         </div>
      </div>
      <a href="payment.php?plate=<?php echo $_GET['plate']; ?>" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Elle est pour moi !</a><?php if(isset($_SESSION["email"]) && $_SESSION["isAdmin"] == 1){ ?><a href="#.php?delete=<?php echo $_GET['plate']; ?>" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Supprimer ce véhicule.</a> <?php } ?>

    </section>

    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">Notre offre</span>
            <h2 class="mb-2">Nos autres véhicules</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="carousel-car owl-carousel">
    					<?php
							try
							{
								$sql = $connection->prepare("SELECT * FROM Voitures");
								$sql->execute();
								$vehicles = $sql->fetchAll(PDO::FETCH_ASSOC);
								foreach($vehicles as $row)
								{
								?>
							

								<div class="item">
    								<div class="car-wrap rounded ftco-animate">
		    							<div class="img rounded d-flex align-items-end" style="background-image: url('<?php echo $row['CheminImage']; ?>');">

		    							</div>
		    							<div class="text">
		    								<h2 class="mb-0"><a href="#"><?php echo $row['ModeleVehicule']; ?></a></h2>
		    								<div class="d-flex mb-3">
			    								<span class="cat"><?php echo $row['Constructeur']; ?></span>
			    								<p class="price ml-auto"><?php echo $row['LoyerVehicule']; ?> <span>€/mois</span></p>
		    								</div>
		    								<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Réserver</a> <a href="vehicle.php?plate=<?php echo $row['PlaqueVehicule']; ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    							</div>
		    						</div>	
		    					</div>
								<?php
								}		
							}
							catch(PDOException $exception)
							{
								echo "Une erreur s'est produite lors de l'accès à la base de données : ".$exception->getMessage();
							}	
    					?>
    				</div>
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
              <p>Nous croyons qu'il faut rendre la location de voitures facile, pratique et abordable pour tous.Nous nous engageons à offrir à nos clients la meilleure expérience possible.</p>
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
