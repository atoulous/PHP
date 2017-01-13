<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] === "OK")
{
	$tab = file_get_contents("../private/passwd");
	$tab = unserialize($tab);
	$oldpw = hash('whirlpool', $_POST['oldpw']);
	$newpw = hash('whirlpool', $_POST['newpw']);
	$i = 0;
	foreach ($tab as $elem)
	{
		if ($elem['passwd'] === $oldpw && $elem['login'] === $_POST['login'])
		{
			$MATCH = TRUE;
			$tab[$i]['passwd'] = $newpw;
		}
		$i++;
	}
	if ($MATCH == TRUE)
	{
		$tab = serialize($tab);
		file_put_contents("../private/passwd", $tab);
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";

?>
