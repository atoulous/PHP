<?php
if (session_id() == ""){ 
	session_start();
}
include("../include/db.php");
if (isset($_SESSION['ERROR'])){
	echo $_SESSION['ERROR'];
	unset($_SESSION['ERROR']);
}
if (isset($_SESSION['SUCCES'])){
	echo $_SESSION['SUCCES'];
	unset($_SESSION['SUCCES']);
}
if (isset($_SESSION['adminlevel']) && isset($_SESSION['login']) && $_SESSION['adminlevel'] == "1" && $_SESSION['login'] !=""){

	if ($_POST['passwd'] && filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
	{
		$conn = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
		if (!$conn)
			die("Connection failed: " . mysqli_connect_error());

		$sql = "SELECT id, email, password FROM user";
		$result = mysqli_query($conn, $sql);
		$match_email = FALSE;
		$match = FALSE;
		$email = $_POST['login'];
		$pw = hash('whirlpool', $_POST['passwd']);

		if (mysqli_num_rows($result) > 0)
		{
			while ($line = mysqli_fetch_assoc($result))
			{
				if ($line['email'] == $email && $line['password'] != $pw)
					$match_email = TRUE;
				if ($line['email'] == $email && $line['password'] == $pw)
					$match = TRUE;
			}
		}
		if ($match_email == FALSE && $match == FALSE)
		{
			$sql = "INSERT INTO user (email, password, adminlevel) VALUE ('$email', '$pw', '0')";
			if (mysqli_query($conn, $sql)){
				$_SESSION["SUCCES"] = "Inscription reussi";
			}
		}
		if ($match)
			$_SESSION["ERROR"] = "Compte deja existant";
		else if ($match_email)
			$_SESSION["ERROR"] = "Email deja assimile a un compte";
		mysqli_close($conn);
	}?>
	<form action="createaccount.php" method="POST">
		Email: <input type="text" name="login" value="">
		<br><br>
		Mot de passe: <input type="text" name="passwd" value="">
		<br><br>
		<input type="submit" name="submit" value="OK">
		</form>
	</div><?php
}
else{
	$_SESSION['ERROR'] = "RESTRICTED AREA";
}

?>