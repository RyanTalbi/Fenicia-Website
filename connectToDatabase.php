<?php    
	$servername = "localhost";
	$username = "root";
	$password = "opm#erTéo@oa@?";
	$dbname = "location";
	
	
	try
	{
		$connection = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	}
	catch(PDOException $exception)
	{
		echo "Une erreur s'est produite lors de la connexion à la base de données : ".$exception->getMessage();
	}
	
?>
