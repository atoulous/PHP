<?php
include ("auth.php");
session_start();
if (isset($_SESSION['loggued_on_user']) && $_POST['delog'] == "Se déconnecter")
	unset($_SESSION['loggued_on_user']);
?>

<html>
	<head>
		<title>Boutique en ligne</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>Bienvenue sur notre boutique en ligne</h1>
			</header>
			<ul id="nav">
				<li><form action="index_panier.php" method="POST">
					<input type="submit" name="panier" value="Mon panier"></form></li>
				<li><form action="index_edit.php" method="POST">
					<input type="submit" name="edit" value="Mon compte"></form></li>
				<?php 
				if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !=""){
				?>
				<li><form action="logout.php" method="POST">
					<input type="submit" name="delog" value="Se déconnecter"></form></li>
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
				<h1>menu</h1>
				<ul id="sidebarnav">
					<li>Categorie1<br><select name="select">
					<option value="value1">1</option>
					<option value="value2">2</option>
					<option value="value3">3</option>
					</select></li>
					<li>Categorie2<br><select name="select">
					<option value="value1">1</option>
					<option value="value2">2</option>
					<option value="value3">3</option>
					</select></li>
				</ul>
			</div>
			<div id="content">
				<?php
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
					die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				if (isset($_POST['idcateg']) && $_POST['idcateg'] !="")
				{
					$reqname = "SELECT * FROM `categorie` WHERE id='".$_POST['idcateg']."'";
					$result = mysqli_query($connect, $reqname);
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
				        		$reqidcat = "SELECT * FROM `prodcat` WHERE idcateg='".$row['id']."'";
								$resultidcat = mysqli_query($connect, $reqidcat);
								if (mysqli_num_rows($resultidcat) > 0) {
									while($row2 = mysqli_fetch_assoc($resultidcat)) {
										$reqnamecat = "SELECT * FROM `produit` WHERE id='".$row2['idprod']."'";
										$resultnamecat = mysqli_query($connect, $reqnamecat);
										if (mysqli_num_rows($resultnamecat) > 0) {
											while($row3 = mysqli_fetch_assoc($resultnamecat)) {
											?>
								        	<div id="produit">
													<h4><?php echo $row3['name']." ".$row3['prix']."€";?></h4>
													<img src="">
								        	<?php
								        		echo "Categorie(s):<BR>";
												echo "- ".$row['name']."<BR>";
											}
											echo mysqli_error($connect);
										}

									}
								}
								else
									echo "Aucune categorie!";
				        	?>
				        	</div>
				        	<?php
				    	}
					} 
					else {
						echo "Aucun produit !<BR />";
					}
				}
				else
				{
					echo "Utiliser le menu pour choisir une categorie";
				}
				?>
			</div>
			<footer></footer>
		</div>
	</body>
</html>
