<?php
session_start();
if ($_GET['submit'] == 'OK')
{
		$_SESSION['login'] = $_GET['login'];
		$_SESSION['passwd'] = $_GET['passwd'];
}
?>
<html><body>
<form action="index.php" align=center>
	Identifiant: <input type="text" name="login" value="<?php echo $_SESSION['login']?>">
	<br><br>
	Mot de passe: <input type="text" name="passwd" value="<?php echo $_SESSION['passwd']?>">
	<br><br>
	<input type="submit" name="submit" value="OK">
</form>
</body></html
