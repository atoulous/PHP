<?php
session_start();
include ("../include/db.php");
if (isset($_SESSION['SUCCES']))
{
	echo $_SESSION['SUCCES'];
	unset($_SESSION['SUCCES']);
}
if (isset($_SESSION['ERROR']))
{
	echo $_SESSION['ERROR'];
	unset($_SESSION['ERROR']);
}
$conn = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$conn)
		die("Connextion failed: " . mysqli_connect_error());
if (is_numeric($_POST['idaccount']) && $_POST['submit']=="changepassword" && $_POST['newpw']!="")
{
	$idaccount = $_POST['idaccount'];
	$password = hash('whirlpool', $_POST['newpw']);
	$sql ="UPDATE `user` SET password='$password' WHERE id ='".$idaccount."'";
	echo $sql;
	if (mysqli_query($conn, $sql))
	{
		$_SESSION["SUCCES"] = "Modification reussi";
		//echo "<script> document.location.replace(\"showaccount.php\"); </script>";
	}
	echo mysqli_error($conn)."";
}
else if ($_POST['submit'] == "OK") 
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

	$sql = "SELECT * FROM user";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		while ($line = mysqli_fetch_assoc($result))
		{
			$email = $line['email'];
		$nom = $line['nom'];
		$prenom = $line['prenom'];
		$numero = $line['numero'];
		$adresse = $line['adresse'];
		$codepostal = $line['codepostal'];
		$ville = $line['ville'];
		$idaccount = $line['id'];
		?>
	<html><body>
			<title>Modifier</title>
			<h1 align=center> Modifier ses informations de compte</h1>
			<form action="showaccount.php" style="text-align:center" method="POST">
				<input type="hidden" name="idaccount" value="<?php echo"$idaccount"?>">
			Email: <input type="text" name="email" value="<?php echo"$email"?>">
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
				<input type="submit" name="submit" value="OK">
			</form>
		<form action="showaccount.php" style="text-align:center" method="POST">
				<input type="hidden" name="idaccount" value="<?php echo"$idaccount"?>">
				Nouveau mot de passe: <input type="text" name="newpw" value="<?php echo"$ispw"?>">
				<input type="submit" name="submit" value="changepassword">
		</form>
		<form action="delaccount.php" style="text-align:center" method="POST">
				<input type="hidden" name="idaccount" value="<?php echo"$idaccount"?>">
				<input type="submit" name="submit" value="DELETE">
		</form>
	</body></html>
<?php
		}
	}
	mysqli_close($conn);

?>