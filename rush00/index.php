<?php
include("include/db.php");
session_start();
?>

<html>
	<head>
		<title>La Boutique - Home</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>Bienvenue sur La Boutique</h1>
			</header>
			<ul id="nav">
				<li><a href="index.php">Acceuil</a></li>
				<?php 
				if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !=""){
				?>
				<li> <a href="index_panier.php"> Mon panier </a> </li>
				<li> <a href="index_edit.php"> Mon compte </a> </li>
				<li> <a href="logout.php"> Se déconnecter </a></li>
				<li style="float:right"> <a href="index_auth_admin.php"> Admin </a></li>
				<?php }
				else if ($_SESSION['adminlevel'] == "1"){
				?>
				<li><a href="admin/index.php">Page administration</a></li>
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
				<h2>Catégories</h2>
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
				mysqli_close($connect);
				?>
			</div>
			<div id="content">
				<h2>Tous nos produits</h2>
				<?php
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
					die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT * FROM `produit`";
				$result = mysqli_query($connect, $reqname);
				mysqli_error($connect);
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
			        	?>
			        	<div id="produit">
								<h4><?php echo $row['name']." ".$row['prix']."€";?></h4>
								<img src="">
			        	<?php
			        		$reqidcat = "SELECT * FROM `prodcat` WHERE idprod='".$row['id']."'";
							$resultidcat = mysqli_query($connect, $reqidcat);
							if (mysqli_num_rows($resultidcat) > 0) {
								echo "Categorie(s):<BR>";
								while($row2 = mysqli_fetch_assoc($resultidcat)) {
									$reqnamecat = "SELECT * FROM `categ` WHERE id='".$row2['idcat']."'";
									$resultnamecat = mysqli_query($connect, $reqnamecat);
									if (mysqli_num_rows($resultnamecat) > 0) {
										while($row3 = mysqli_fetch_assoc($resultnamecat)) {
											echo "- ".$row3['name']."<BR>";
										}
										echo mysqli_error($connect);
									}

								}?>
								<form method="post" action="panier.php" enctype="multipart/form-data">
            						<input type="hidden" name="idproduct" value=<?php echo $row['id'];?> />
            						<input type="submit" name="submit" value="Add"/><br />
        						</form>
							<?php }
							else{
								echo "<BR>Aucune categorie!<BR>";
								?>
								<form method="post" action="panier.php" enctype="multipart/form-data">
            						<input type="hidden" name="idproduct" value=<?php echo $row['id'];?> />
            						<input type="submit" name="submit" value="Add"/><br />
        						</form>
							<?php 
						}
			        	?>
			        	</div>
			        	<?php
			    	}
				} 
				else {
					echo "Aucun produit !<BR />";
				}
				mysqli_close($connect);
				?>
			</div>
			<footer></footer>
		</div>
	</body>
</html>
