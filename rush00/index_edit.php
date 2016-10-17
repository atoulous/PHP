<?php
session_start();
include ("include/db.php");
?>

<html>
	<head>
		<title>La Boutique - Modifier son compte</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>La Boutique</h1>
			</header>
			<ul id="nav">
				<li><a href="index.php">Retourner vers la boutique</a>
			</li></ul>
			<div id="sidebar">
				<ul id="sidebarnav">
				</ul>
			</div>
			<div id="content">
				<h2>Modifier ses informations</h2>
<?php
	$conn = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$conn)
		die("Connextion failed: " . mysqli_connect_error());
	$id = $_SESSION['loggued_on_user'];
	$oldpw = hash('whirlpool', $_POST['oldpw']);
	$sql = "SELECT * FROM user WHERE id='".$id."' AND password='".$oldpw."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		while ($line = mysqli_fetch_assoc($result))
			if ($line['id'] == $id)
				break ;
		$email = $line['email'];
		$nom = $line['nom'];
		$prenom = $line['prenom'];
		$numero = $line['numero'];
		$adresse = $line['adresse'];
		$codepostal = $line['codepostal'];
		$ville = $line['ville'];
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			$email = $_POST['email'];
		if (is_numeric($_POST['numero']))
			$numero = $_POST['numero'];
		if (is_numeric($_POST['codepostal']))
			$codepostal = $_POST['codepostal'];
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['nom']))
			$nom = $_POST['nom'];
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['prenom']))
			$prenom = $_POST['prenom'];
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['newpw']))
			$newpw = hash('whirlpool', $_POST['newpw']);
		if (preg_match("/^(([[:alnum:]])*|(\s))*$/", $_POST['adresse']))
			$adresse = $_POST['adresse'];
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['ville']))
			$ville = $_POST['ville'];
	}
	else
		$_SESSION['ERROR'] = "Ancien mot de passe incorecte";
	if ($id && $_POST['submit'] !="" && $oldpw == $oldpw)
	{
		$sql ="UPDATE `user` SET email='$email', nom='$nom', prenom='$prenom', numero='$numero', password='$newpw', adresse='$adresse', codepostal='$codepostal', ville='$ville' WHERE id ='$id'";
		if (mysqli_query($conn, $sql))
			$_SESSION["SUCCES"] = "Modification reussi";
		else
			$_SESSION['ERROR'] = "Modification fail";
	}
	if ($_SESSION['loggued_on_user'] !=""){
		$conn = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
		if (!$conn)
			die("Connextion failed: " . mysqli_connect_error());
		$id = $_SESSION['loggued_on_user'];
		$oldpw = hash('whirlpool', $_POST['oldpw']);
		$sql = "SELECT * FROM user WHERE id='".$id."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0)
		{
			if ($line = mysqli_fetch_assoc($result)){
			$email = $line['email'];
			$nom = $line['nom'];
			$prenom = $line['prenom'];
			$numero = $line['numero'];
			$adresse = $line['adresse'];
			$codepostal = $line['codepostal'];
			$ville = $line['ville'];
			}
?>
			<form action="index_edit.php" method="POST">
			Email*: <input type="text" name="email" value="<?php echo"$email"?>">
			<br><br>
			Nom: <input type="text" name="nom" value="<?php echo"$nom" ?>">
			<br><br>
			Prenom: <input type="text" name="prenom" value="<?php echo "$prenom"?>">
			<br><br>
			Numero: <input type="text" name="numero" value="<?php echo"$numero"?>">
			<br><br>
			Adresse: <input type="text" name="adresse" value="<?php echo"$adresse"?>">
			<br><br>
			Code Postal: <input type="text" name="codepostal" value="<?php echo"$codepostal"?>">
			<br><br>
			Ville: <input type="text" name="ville" value="<?php echo"$ville"?>">
			<br><br>
			Ancien mot de passe*: <input type="text" name="oldpw" value="<?php?>">
			<br><br>
			Nouveau mot de passe: <input type="text" name="newpw" value="<?php?>">
			<br><br>
			<input type="submit" name="submit" value="OK">
	</body>
</html>
<?php
		}
	}
	mysqli_close($conn);
?>
