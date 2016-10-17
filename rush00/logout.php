<?php
session_start();
if (isset($_SESSION['loggued_on_user']))
	unset($_SESSION['loggued_on_user']);
echo '<script language="Javascript">document.location.replace("index.php");</script>';
?>
