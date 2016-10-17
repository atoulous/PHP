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
	if(isset($_POST["submit"]) && isset($_POST['idaccount']) && $_POST['submit'] == "DELETE" && $_POST['idaccount'] !="")
	{
		if (is_numeric($_POST['idaccount']) == TRUE)
		{
			$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
			if (!$connect) {
				die("Connection failed: " . mysqli_connect_error()."<br />");
			}
			$reqname = "DELETE FROM `user` WHERE id='".$_POST['idaccount']."'";
			$result = mysqli_query($connect, $reqname);
			echo '<script language="Javascript">
			document.location.replace("showaccount.php");
			</script>';
		}
	}
}
else{
	echo "Restricted Area";
}