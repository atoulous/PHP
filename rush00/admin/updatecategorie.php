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
	if ($_POST['namecateg'] !="" && $_POST['idcateg'] !=""){
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['namecateg']) != FALSE){
			if (is_numeric($_POST['idcateg']) != FALSE){
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
    				die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT id FROM `categ` WHERE id=\"".$_POST['idcateg']."\"";
				$result = mysqli_query($connect, $reqname);
				if (mysqli_num_rows($result) == 1) {
					$sql = "UPDATE `categ` SET name='".$_POST['namecateg']."' WHERE id='".$_POST['idcateg']."'";
					if (mysqli_query($connect, $sql) == FALSE) {
						$_SESSION['ERROR'] = mysqli_error($connect);
						echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
					}
					echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
				} else {
				    $_SESSION['ERROR'] = "ERROR : Nom du categorie déjà utilisé";
				    echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
				}
				
			}
			else{
				$_SESSION['ERROR'] = "ERROR prix du categorie: format prix xx.xx (x = Chiffe de 0 à 9)";
				echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
			}
		}
		else{
			$_SESSION['ERROR'] = "ERROR nom du categorie: Le nom du categorie ne doit contenir des character alphanunerique.";
			echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
		}
	}
	else if (isset($_POST["submit"])){
			$_SESSION['ERROR'] = "ERROR champs: les champs ne peuvent être vide.";
			echo '<script language="Javascript">
						document.location.replace("showcategorie.php");
					</script>';
	}
}
else{
	echo "Restricted Area";
}
?>