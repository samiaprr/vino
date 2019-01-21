<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" />	
	</head>
	<body>
<?php
	require("config.php");
	$debut = 0;
	$nombreProduit = 10;
	
	$saq = new SAQ();
	//for($i=0; $i<6;$i++)
	//{
		$nombre = $saq->getProduits($nombreProduit,$debut);
		echo "importation ". $i ." : ". $nombre. "<br>";
	//	$debut += $nombreProduit;	
	//}
	
	
	

?>
</body>
</html>