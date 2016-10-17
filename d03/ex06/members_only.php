<?php

if (!$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'])
{
	header('WWW-Authenticate: Basic realm="Espace membres"');
	header('HTTP/1.0 401 Unauthorized');
}
else
{
	if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys")
	{
?>
<html><body>
Bonjour Zaz<br />
<?php
		$image = base64_encode(file_get_contents("../img/42.png"));
		echo "<img src='data:image/png;base64,$image'>\n";
?>
</body></html>
<?php
	}
	else
	{
		header('WWW-Authenticate: Basic realm="Espace membres"');
		header('HTTP/1.0 401 Unauthorized');
?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php
	}
}

?>
