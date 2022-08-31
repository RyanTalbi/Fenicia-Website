<?php
    	require 'connectToDatabase.php'; 
	
	try
	{
		$sql = "CREATE DATABASE IF NOT EXISTS location"; 
		$connection->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS location.Clients(Email VARCHAR(50) primary key, Nom VARCHAR(30), Prenom VARCHAR(30), Rue VARCHAR(50), Ville VARCHAR(50), NumPermis VARCHAR(20), Telephone VARCHAR(15), MOTDEPASSE VARCHAR(200), SIREN VARCHAR(50), Administrateur BOOLEAN, Approuve BOOLEAN)";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.Voitures(PlaqueVehicule VARCHAR(10) , ModeleVehicule VARCHAR(20), NumCGVEHICULE VARCHAR(50), MarqueVehicule VARCHAR(20), AnneeVehicule INTEGER, CouleurVehicule VARCHAR(20), LoyerVehicule FLOAT, CheminImage VARCHAR(100), BoiteVitesse VARCHAR(15), NombrePlaces INTEGER, NombrePortes INTEGER, Carburant VARCHAR(10), Description VARCHAR(1000), Constructeur VARCHAR(100), Kilometrage INTEGER, GPS BOOLEAN, AIRCONDITIONNE BOOLEAN, AUDIO BOOLEAN, PRIMARY KEY(PlaqueVehicule))";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.Locations(Email VARCHAR(50), PlaqueVehicule VARCHAR(10) , DebutLocation DATE, FinLocation DATE, DureeLocation INT, TypeParking VARCHAR(10), PRIMARY KEY(Email, PlaqueVehicule), FOREIGN KEY (Email) REFERENCES Clients(Email), FOREIGN KEY (PlaqueVehicule) REFERENCES Voitures(PlaqueVehicule))";
		$connection->exec($sql);
		$sql = "CREATE TABLE  IF NOT EXISTS location.DepotsDossiers(Email VARCHAR(50), PermisRenseigne BOOLEAN, SIRENRenseigne BOOLEAN, IdentiteRenseignee BOOLEAN, FOREIGN KEY (Email) REFERENCES Clients(Email))";
		$connection->exec($sql);
		
		echo "La base de données a été crée avec succès";
	}
	catch(PDOException $exception)
	{
		echo "Une erreur s'est produite lors de la création de la base de données : ".$sql." : ".$exception->getMessage();
	}


	
?>
