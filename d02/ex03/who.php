#!/usr/bin/php
<?php

date_default_timezone_set("Europe/Paris");
$fd = fopen("/var/run/utmpx", "r");
$tab_who = array();
while ($utmp = fread($fd, 628))
{
	$tab = unpack("a256user/a4id/a32line/ipid/itype/I2time/@/@", $utmp);
	if ($tab["type"] == 7)
	{
		$user = trim($tab["user"]);
		$line = trim($tab["line"]);
		$date = date("M  j H:i", $tab["time1"]);
		$tab_who[] = "$user $line  $date \n";
	}
}
sort($tab_who);
foreach ($tab_who as $elem)
	echo "$elem";

?>
