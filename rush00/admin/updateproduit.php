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
	if ($_POST['prixprod'] !="" && $_POST['nameprod'] !="" && $_POST['idprod'] !=""){
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['nameprod']) != FALSE){
			if (preg_match("/^([0-9]+.{1}[0-9]{2})$|^([0-9]+)$/", $_POST['prixprod']) != FALSE){
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
    				die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT id FROM `produit` WHERE id=\"".$_POST['idprod']."\"";
				$result = mysqli_query($connect, $reqname);
				if (mysqli_num_rows($result) == 1) {
					$sql = "UPDATE produit SET name='".$_POST['nameprod']."', prix='".$_POST['prixprod']."' WHERE id='".$_POST['idprod']."'";
					if (mysqli_query($connect, $sql) == FALSE) {
						$_SESSION['ERROR'] = mysqli_error($connect);
						echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
					}
					echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
				} else {
				    $_SESSION['ERROR'] = "ERROR : Nom du produit déjà utilisé";
				    echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
				}
				
			}
			else{
				$_SESSION['ERROR'] = "ERROR prix du produit: format prix xx.xx (x = Chiffe de 0 à 9)";
				echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
			}
		}
		else{
			$_SESSION['ERROR'] = "ERROR nom du produit: Le nom du produit ne doit contenir des character alphanunerique.";
			echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
		}
	}
	else if (isset($_POST["submit"])){
			$_SESSION['ERROR'] = "ERROR champs: les champs ne peuvent être vide.";
			echo '<script language="Javascript">
						document.location.replace("showproduit.php");
					</script>';
	}
}
else{
	echo "Restricted Area";
}
?>