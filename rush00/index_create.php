<?php
session_start();
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
				<li><a href="index_auth.php">Déjà un compte?</a></li></ul>
			<div id="sidebar">
				<ul id="sidebarnav">
				</ul>
			</div>
			<div id="content">
				<h1>Créer un compte</h1>
				<form action="create_account.php" method="POST">
					Email: <input type="text" name="login" value="">
					<br><br>
					Mot de passe: <input type="text" name="passwd" value="">
					<br><br>
					<input type="submit" name="submit" value="OK"></form>
		</div>
	</body>
</html>
