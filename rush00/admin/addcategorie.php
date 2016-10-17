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
	if ($_POST['namecat'] !=""){
		if (preg_match("/^([[:alnum:]]*)$/", $_POST['namecat']) != FALSE){
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
    				die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				$reqname = "SELECT name FROM `categ` WHERE name=\"".$_POST['namecat']."\"";
				$result = mysqli_query($connect, $reqname);
				if (mysqli_num_rows($result) == 0) {
				    // output data of each row
					$sql = "INSERT INTO `categ` (name) VALUES('".$_POST['namecat']."')";
					echo $sql;
					if (mysqli_query($connect, $sql) == FALSE) {
						$_SESSION['ERROR'] = mysqli_error($connect);
						echo '<script language="Javascript">
						document.location.replace("addcategorie.php");
					</script>';
					}
				}
				else {
				    $_SESSION['ERROR'] = "ERROR : Nom du produit déjà utilisé";
				    echo '<script language="Javascript">
						document.location.replace("addcategorie.php");
					</script>';
				}
		}
		else{
			$_SESSION['ERROR'] = "ERROR nom du produit: Le nom du produit ne doit contenir des character alphanunerique.";
			echo '<script language="Javascript">
						document.location.replace("addcategorie.php");
					</script>';
		}
	}
	else if (isset($_POST["submit"])){
			$_SESSION['ERROR'] = "ERROR champs: les champs ne peuvent être vide.";
			echo '<script language="Javascript">
						document.location.replace("addcategorie.php");
					</script>';
	}
	?>
	<form method="post" action="addcategorie.php" enctype="multipart/form-data">
        <input type="text" name="namecat" placeholder="Entrer le nom du produit ..." /><BR />
        <input type="submit" name="submit" value="Enregistrer ce produit"/><BR />
    </form>
	<?php
}
else{
	echo "Restricted Area";
}
?>