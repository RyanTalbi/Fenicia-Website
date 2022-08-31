<?php session_start();
	require 'connectToDatabase.php';
	if(isset($_SESSION["email"]))
	{
		try
		{
			$sql = $connection->prepare("DELETE FROM DepotsDossiers WHERE email = :email");
			$sql->bindParam(":email",$_SESSION["email"]);
			$sql->execute();
			$sql = $connection->prepare("DELETE FROM Clients WHERE email = :email");
			$sql->bindParam(":email",$_SESSION["email"]);
			$sql->execute();
		}
		catch(PDOException $exception)
		{
			echo "Erreur lors de la suppression de votre compte : ".$exception->getMessage();
		}
	}	
?>
