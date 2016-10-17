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
	if(isset($_POST["submit"]) && isset($_POST['idcateg']) && $_POST['submit'] == "X" && $_POST['idcateg'] !="")
	{
		if (is_numeric($_POST['idcateg']) == TRUE)
		{
			$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
			if (!$connect) {
				die("Connection failed: " . mysqli_connect_error()."<br />");
			}
			$reqname = "DELETE FROM `categ` WHERE id='".$_POST['idcateg']."'";
			$result = mysqli_query($connect, $reqname);
			echo '<script language="Javascript">
			document.location.replace("showcategorie.php");
			</script>';
		}
	}
}
else{
	echo "Restricted Area";
}
?>