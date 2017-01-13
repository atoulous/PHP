<?php

function auth($login, $passwd)
{
	$tab = file_get_contents("../private/passwd");
	$tab = unserialize($tab);
	$pw = hash('whirlpool', $passwd);
	foreach ($tab as $elem)
		if ($login == $elem['login'] && $pw == $elem['passwd'])
			$match = TRUE;
	if ($match)
		return (TRUE);
	else
		return (FALSE);
}

?>
