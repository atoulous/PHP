<?php 
if (session_id() == ""){ 
	session_start();
}
include("include/db.php");
if ($_SESSION['panier'] !="" && $_SESSION['loggued_on_user'] !=""){
	$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error()."<br />");
	}
	$i = 0;
	$panier = unserialize($_SESSION['panier']);
	echo "test";
	while ($panier[$i])
	{
		if ($panier[$i]['quantite'] > 0){
			$sql="INSERT INTO `panier` (idprod, iduser, quantite) VALUES(".$panier[$i]['idproduct'].", ".$_SESSION['loggued_on_user'].", ".$panier[$i]['quantite'].")";
			echo $sql;
			if (mysqli_query($connect, $sql) == FALSE){
				echo mysqli_error($connect);
			}
		}
		$i++;
	}
	unset($_SESSION['panier']);
	mysqli_close($connect);
}
?>