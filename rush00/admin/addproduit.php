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
	if ($_POST['prixprod'] !="" && $_POST['nameprod'] !=""){
		if (preg_match("/^(([[:alnum:]])*|(\s))*$/", $_POST['nameprod']) != FALSE){
			if (preg_match("/^([0-9]+.{1}[0-9]{2})$|^([0-9]+)$/", $_POST['prixprod']) != FALSE){
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
    				die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT name FROM `produit` WHERE name=\"".$_POST['nameprod']."\"";
				$result = mysqli_query($connect, $reqname);
				if (mysqli_num_rows($result) == 0) {
				    // output data of each row
					$sql = "INSERT INTO produit (name, prix) VALUES('".$_POST['nameprod']."', '".$_POST['prixprod']."')";
					echo $sql;
					if (mysqli_query($connect, $sql) == FALSE) {
						$_SESSION['ERROR'] = mysqli_error($connect);
						echo '<script language="Javascript">
						document.location.replace("addproduit.php");
					</script>';
					}
				} else {
				    $_SESSION['ERROR'] = "ERROR : Nom du produit déjà utilisé";
				    echo '<script language="Javascript">
						document.location.replace("addproduit.php");
					</script>';
				}
				
			}
			else{
				$_SESSION['ERROR'] = "ERROR prix du produit: format prix xx.xx (x = Chiffe de 0 à 9)";
				echo '<script language="Javascript">
						document.location.replace("addproduit.php");
					</script>';
			}
		}
		else{
			$_SESSION['ERROR'] = "ERROR nom du produit: Le nom du produit ne doit contenir des character alphanunerique.";
			echo '<script language="Javascript">
						document.location.replace("addproduit.php");
					</script>';
		}
	}
	else if (isset($_POST["submit"])){
			$_SESSION['ERROR'] = "ERROR champs: les champs ne peuvent être vide.";
			echo '<script language="Javascript">
						document.location.replace("addproduit.php");
					</script>';
	}
	?>
	<form method="post" action="addproduit.php" enctype="multipart/form-data">
        <input type="text" name="nameprod" placeholder="Entrer le nom du produit ..." /><BR />
        <input type="text" name="prixprod" placeholder="Entrer le prix du produit ..."/><BR />
        <input type="submit" name="submit" value="Enregistrer ce produit"/><BR />
    </form>
	<?php
}
else{
	echo "Restricted Area";
}
?>