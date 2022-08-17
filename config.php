<?php
    	$servername = "localhost";
    	$username = "root";
    	$password = "opm#erTéo@oa@?"; 
	
	try
	{
		$connection = new PDO("mysql:host=$servername",$username,$password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS location"; 
		$connection->exec($sql);
		$connection->beginTransaction();
		$sql = "CREATE TABLE IF NOT EXISTS location.Clients(Email VARCHAR(50) primary key, Nom VARCHAR(30), Prenom VARCHAR(30), Rue VARCHAR(50), Ville VARCHAR(50), NumPermis VARCHAR(20), Telephone VARCHAR(15), MOTDEPASSE VARCHAR(200), SIREN VARCHAR(50), Administrateur BOOLEAN, Approuve BOOLEAN)";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.Voitures(PlaqueVehicule VARCHAR(10) , ModeleVehicule VARCHAR(20), NumCGVEHICULE VARCHAR(50), MarqueVehicule VARCHAR(20), AnneeVehicule INTEGER, CouleurVehicule VARCHAR(20), LoyerVehicule FLOAT, CheminImage VARCHAR(100), BoiteVitesse VARCHAR(15), NombrePlaces INTEGER, NombrePortes INTEGER, Carburant VARCHAR(10), Description VARCHAR(1000), Constructeur VARCHAR(100), Kilometrage INTEGER, GPS BOOLEAN, AIRCONDITIONNE BOOLEAN, AUDIO BOOLEAN, PRIMARY KEY(PlaqueVehicule))";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.Locations(Email VARCHAR(50), PlaqueVehicule VARCHAR(10) , DebutLocation DATE, FinLocation DATE, DureeLocation INT, TypeParking VARCHAR(10), PRIMARY KEY(Email, PlaqueVehicule), FOREIGN KEY (Email) REFERENCES Clients(Email), FOREIGN KEY (PlaqueVehicule) REFERENCES Voitures(PlaqueVehicule))";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.DepotsDossiers(Email VARCHAR(50), PermisRenseigne BOOLEAN, SIRENRenseigne BOOLEAN, IdentiteRenseignee BOOLEAN)";
		$connection->exec($sql);
		$sql = "CREATE TABLE location.transactions (`id` int(11) NOT NULL AUTO_INCREMENT,`customer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,`customer_email` varchar(50) 				COLLATE utf8_unicode_ci NOT NULL,'item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,`item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,`item_price` float(10,2) NOT NULL,
`item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,`paid_amount` float(10,2) NOT NULL,`paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,`txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,`payment_status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,`created` datetime NOT NULL,`modified` datetime NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
		$connection->exec($sql);
		$connection->commit();	
		echo "La base de données a été crée avec succès";
	}
	catch(PDOException $exception)
	{
		echo "Une erreur s'est produite lors de la création de la base de données : ".$sql." : ".$exception->getMessage();
	}


	
?>
