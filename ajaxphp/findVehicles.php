<?php
	require '../connectToDatabase.php';
	
	if(isset($_GET["model"]))
	{
	$model = $_GET["model"]."%";
	if(isset($_GET["startDate"]))
	{
		$startDate = $_GET["startDate"];
	}
	else
	{
		$startDate = date('Y-m-d');
	}
	if(isset($_GET["endDate"]))
	{
		$endDate = $_GET["endDate"];
	}
	else
	{
		$endDate = 	"2100-12-01";
	}
	
	
	$sql = $connection->prepare("SELECT * FROM Voitures WHERE ModeleVehicule LIKE :model AND PlaqueVehicule NOT IN (SELECT PlaqueVehicule FROM Locations WHERE DebutLocation <= :endDate AND FinLocation >= :startDate)");
	$sql->bindParam(":model",$model);
	$sql->bindParam(":startDate",$startDate);
	$sql->bindParam(":endDate",$endDate);
	$sql->execute();
	$vehicles = $sql->fetchAll();

	foreach($vehicles as $row)
	{
		
		$plate = $row["PlaqueVehicule"];
		$imagePath = $row["CheminImage"];
        $rent = $row["LoyerVehicule"];
		$carName = $row["ModeleVehicule"];
?>
		
			<thead class="thead-primary">
				<tr class="text-center">
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th class="bg-primary heading">Loyer hebdomadaire</th>
				</tr>
			</thead>
			<tbody>
			<tr class="">
    				<td class="car-image">
					<div class="img" style="background-image:url('<?php echo $imagePath; ?>');"></div>
    				</td>
    				<td class="product-name">
					<h3><?php echo $carName; ?> 								 
    				</td>
    				<td class="price">
    					<p class="btn-custom"><a href="vehicle.php?plate=<?php echo $plate; ?>">Elle est pour moi !</a></p>
    					<h3><?php echo $rent ?>€</span>
						<span class="per">/par mois</span>
					</h3>
				</td>
			</tbody>

<?php			
		}
	}	 
?>
