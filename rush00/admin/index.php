<?php
include("../include/db.php");
session_start();
if (isset($_SESSION['adminlevel']) && $_SESSION['adminlevel'] == "1")
{
?>
<html>
	<head>
		<title>Boutique en ligne</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="../home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>Page d'administration</h1>
			</header>
			<ul id="nav">
				<li><a href="../index.php">Accueil</a></li>
			</ul>
			<div id="sidebar">
				<li><a href="addproduit.php">Ajouter un produit</a></li>
				<li><a href="showproduit.php">Voir tous les produits</a></li>
				<li><a href="addcategorie.php">Ajouter une categorie</a></li>
				<li><a href="showcategorie.php">Voir toutes les categories</a></li>
				<li><a href="addproduit.php">Ajouter un produit</a></li>
				<li><a href="createaccount.php">Ajouter un compte</a></li>
				<li><a href="showaccount.php">Voir tous les comptes</a></li>
			</div>
			<div id="content">
				Utiliser les menu pour vous balader dans votre espace d'administration.
			</div>
			<footer></footer>
		</div>
	</body>
</html>
<?php 
}
else{
	echo "<h1>RESTRICED AREA <a href='../index.php'>Retourner sur l'index du site</a></h1>";
}
?>
