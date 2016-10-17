#!/usr/bin/php
<?php

if ($argv[1])
{
	$tab = explode(" ", $argv[1]);
	if (!preg_match("/([Ll]un|[Mm]ercre|[Mm]ar|[Jj]eu|[Vv]endre|[Ss]ame)di$|[Dd]imanche/", $tab[0])
		|| (!ctype_digit($tab[1]) || ($tab[1] > 31 || $tab[1] < 1))
		|| !preg_match("/[Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|([Jj]uin|uillet)|[Aa]out|([Ss]eptem|[Oo]cto|[Nn]ovem|[Dd]ecem)bre/", $tab[2])
		|| (!ctype_digit($tab[3]) || $tab[3] < 1970 ||$tab[3] > 2017))
	{
		echo "Wrong Format\n";
		return;
	}
	$tab_heure = explode(":", $tab[4]);
	if ((!ctype_digit($tab_heure[0]) || $tab_heure[0] < 0 || $tab_heure[0] > 23)
		|| (!ctype_digit($tab_heure[1]) || $tab_heure[1] < 0 || $tab_heure[1] > 59)
		|| (!ctype_digit($tab_heure[2]) || $tab_heure[2] < 0 || $tab_heure[2] > 59))
	{
		echo "Wrong Format\n";
		return;
	}
	$tab[2] = strtolower($tab[2]);
	$tab_month = array(janvier, fevrier, mars, avril, mai, juin, juillet, aout, septembre, octobre, novembre, decembre);
	$i = 0;
	while ($tab[2] != $tab_month[$i])
		$i++;
	date_default_timezone_set("Europe/Paris");
	$time = mktime($tab_heure[0], $tab_heure[1], $tab_heure[2], $i, $tab[1], $tab[3]);
	echo "$time\n";
}

?>
