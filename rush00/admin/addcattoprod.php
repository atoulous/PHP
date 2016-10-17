<?php
if (session_id() == ""){ 
	session_start();
}
include("../include/db.php");
if (isset($_SESSION['ERROR'])){
	echo $_SESSION['ERROR'];
	unset($_SESSION['ERROR']);
}
if (isset($_SESSION['adminlevel']) && isset($_SESSION['login']) && $_SESSION['adminlevel'] == "1" && $_SESSION['login'] !=""){
	if ($_POST['namecat'] !="" && $_POST['idprod'] !="" && $_POST['submit'] == "Ajouter une categorie"){
		if (is_numeric($_POST['idprod']) == TRUE && is_numeric($_POST['namecat']) == TRUE)
		{
			$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
			if (!$connect) {
    			die("Connection failed: " . mysqli_connect_error()."<br />");
			}
			$reqname = "SELECT id FROM `prodcat` WHERE idcat='".$_POST['namecat']."' AND idprod='".$_POST['idprod']."'";
			$result = mysqli_query($connect, $reqname);
			if (mysqli_num_rows($result) == 0) {
			    // output data of each row
				$sql = "INSERT INTO prodcat (idcat, idprod) VALUES('".$_POST['namecat']."', '".$_POST['idprod']."')";
				echo $sql;
				if (mysqli_query($connect, $sql) == FALSE) {
					$_SESSION['ERROR'] = mysqli_error($connect);
					echo '<script language="Javascript">
					document.location.replace("showproduit.php");
				</script>';
				}
			}
			else{
				$_SESSION['ERROR'] = "Ce produit contient deja cette categorie !";
				echo '<script language="Javascript">
					document.location.replace("showproduit.php");
				</script>';
			}
		}
	}
	else if (isset($_POST["submit"])){
			//$_SESSION['ERROR'] = "ERROR champs: les champs ne peuvent être vide.";
			echo $_POST['idprod'];
			echo $_POST['namecat'];
			/*echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';*/
	}
}
else{
	echo "Restricted Area";
}
?>