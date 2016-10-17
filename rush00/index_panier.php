<?php
include ("include/db.php");
session_start();
?>

<html>
	<head>
		<title>Panier</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>Notre boutique en ligne</h1>
			</header>
			<ul id="nav">
				<li><a href="index.php">Acceuil</a></li>
				<li> <a href="index_panier.php"> Mon panier </a> </li>
				<?php 
				if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !=""){
				?>
				<li> <a href="index_edit.php"> Mon compte </a> </li>
				<li> <a href="logout.php"> Se déconnecter </a></li>
				<?php 
				}
				else
				{
				?>
				<li> <a href="index_create.php"> Créer un compte </a> </li>
				<li> <a href="index_auth.php"> Connexion </a></li>
				<?php
				}
				?>
			</ul>
			<div id="sidebar">
				<ul id="sidebarnav">
				</ul>
			</div>
			<div id="content">
				<?php
				if ($_SESSION["panier"])
				{
				    if (!$connection = mysqli_connect("localhost", "root", "root", "minishop"))
				        die("Connection failed: " . mysqli_connect_error());
				    $shop = unserialize($_SESSION["panier"]);
				    $i = 0;
				    while ($shop[$i])
				    {
				        $resultat = mysqli_query($connection, "SELECT name, prix FROM `produit` WHERE id='".$shop[$i]["idproduct"]."'");
				        if (mysqli_num_rows($resultat) > 0)
				            while ($row = mysqli_fetch_assoc($resultat)){
				                ?>
				                <?php if ($shop[$i]["quantite"] > 0) {echo $row['name'].": ".$row['prix']." &euro; qte: ".$shop[$i]["quantite"]." Prix total ".$shop[$i]["quantite"] * $row['prix']." &euro;<br />";?>
				                <form action="minus.php" method="POST"><input type="hidden" name="idproduct" value=<?php echo $shop[$i]["idproduct"];?> /><input type="submit" value='-'/></form>
				                <form action="plus.php" method="POST"><input type="hidden" name="idproduct" value=<?php echo $shop[$i]["idproduct"];?> /><input type="submit" value='+'/></form>
				                <?php
				            	}
				            }
				        $i++;
				    }?>
				    <form action="addpaniertodb.php" method="POST"><input type="submit" value='Confirmer mon panier'/></form>
					<?php
				}
				else
				{
					$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
					if (!$connect) {
						die("Connection failed: " . mysqli_connect_error()."<br />");
					}
					$reqpanier = "SELECT * FROM `panier` WHERE iduser='".$_SESSION['loggued_on_user']."'";
					$result = mysqli_query($connect, $reqpanier);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)){
								$reqname = "SELECT name, prix FROM `produit` WHERE id='".$row['idprod']."'";
								$resultname = mysqli_query($connect, $reqname);
								$totalallprod = "0";
								if (mysqli_num_rows($resultname) > 0) {
									while($row2 = mysqli_fetch_assoc($resultname)) {
										$total = $row['quantite'] * $row2['prix'];
										$totalallprod += $total;
										echo "Nom du produit: ".$row2['name']." Prix unitaire ".$row2['prix']." quantite: ".$row['quantite']." total: ".$total."<BR>";
										?>
										<form action="minus.php" method="POST"><input type="hidden" name="idproduct" value=<?php echo $row["idprod"];?> /><input type="submit" value='-'/></form>
										<form action="plus.php" method="POST"><input type="hidden" name="idproduct" value=<?php echo $row["idprod"];?> /><input type="submit" value='+'/></form>
										<?php
									}
								}
								echo "Prix total: ".$totalallprod;
							}
						}
						else{
							echo "Votre panier est vide!";
						}
				}
        	?>
			</div>
		</div>
		<footer></footer>
	</body>
</html>
