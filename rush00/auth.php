<?php

include ("include/db.php");
session_start();

function auth($login, $passwd)
{
	if (!$connection = mysqli_connect("localhost", "root", "root", "minishop"))
		die("Connection failed: " . mysqli_connect_error());
	$login = mysqli_real_escape_string($connection, $login);
	$request = "SELECT id, email, password, adminlevel FROM `user` WHERE email='".$login."'";
	if (!$result = mysqli_query($connection, $request))
		echo "fail";
	if (mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
		if ($row["password"] != hash("whirlpool", $passwd))
		{
			mysqli_close($connection);
			return FALSE;
		}
		else
		{
			$_SESSION['loggued_on_user'] = $row['id'];
			$_SESSION['adminlevel'] = $row['adminlevel'];
			$_SESSION['login'] = $row['email'];
		}
	}
	else
	{
		mysqli_close($connection);
		return FALSE;
	}
	mysqli_close($connection);
	return TRUE;
}

if (auth($_POST['login'], $_POST['passwd']) == TRUE)
{
	echo "OK";
	echo '<script language="Javascript">document.location.replace("index.php");</script>';
}
else
	echo "ERROR";

?>
