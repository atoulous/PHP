<?php

if ($_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
{
	$pw = hash('whirlpool', $_POST['passwd']);
	if (file_exists("../private") == FALSE)
		mkdir("../private", 0777, TRUE);
	if (file_exists("../private/passwd") == FALSE)
	{
		$tab = array(array('login' => $_POST['login'], 'passwd' => $pw));
		$tab = serialize($tab);
		file_put_contents("../private/passwd", $tab);
		echo "OK\n";
	}
	else
	{
		$tab = file_get_contents("../private/passwd");
		$tab = unserialize($tab);
		foreach ($tab as $elem)
			if ($_POST['login'] == $elem['login'])
				$IN_FILE = TRUE;
		if (!$IN_FILE)
		{
			$tab[] = array('login' => $_POST['login'], 'passwd' => $pw);
			$tab = serialize($tab);
			file_put_contents("../private/passwd", $tab);
		}
		if ($IN_FILE == TRUE)
			echo "ERROR\n";
		else
			echo "OK\n";
	}
}
else
	echo "ERROR\n";

?>
