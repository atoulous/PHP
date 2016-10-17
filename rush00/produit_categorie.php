<?php
include ("include/db.php");
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
				<li><a href="index.php">Acceuil</a></li>
				<?php 
				if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !=""){
				?>
				<li> <a href="index_panier.php"> Mon panier </a> </li>
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
				<h2>Categories</h2>

				<?php
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
					die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT * FROM `categ`";
				$result = mysqli_query($connect, $reqname);
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
			        	?>
			        	<form style="padding:0; margin:0;" method="post" action="produit_categorie.php" enctype="multipart/form-data">
					        <input type="hidden" name="idcateg" value=<?php echo $row['id'];?> />
					        <input type="submit" name="submit" value="<?php echo $row['name'];?>"/>
					    </form>
			        	<?php
			    	}
				} 
				else {
					echo "Aucun produit !<BR />";
				}
				?>
			</div>
			<div id="content">
				<?php
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
					die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				if (isset($_POST['idcateg']) && $_POST['idcateg'] !="")
				{
					$reqname = "SELECT * FROM `categ` WHERE id='".$_POST['idcateg']."'";
					$result = mysqli_query($connect, $reqname);
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							echo "<h2>".$row['name']."</h2>";
				        		$reqidcat = "SELECT * FROM `prodcat` WHERE idcat='".$row['id']."'";
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
											?>
											<?php
											}
											?><form method="post" action="panier.php" enctype="multipart/form-data">
						            				<input type="hidden" name="idproduct" value=<?php echo $row['id'];?> />
						            				<input type="submit" name="submit" value="Add"/><br />
			        							</form></div><?php
											echo mysqli_error($connect);
										}

									}
								}
								else
									echo "Aucun produit pour cette categorie!";
				        	?>
				        	<?php
				    	}
					} 
					else {
						echo "Aucune categorie ne correspond à votre demande !<BR />";
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
