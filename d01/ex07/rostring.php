#!/usr/bin/php
<?php

if ($argv[1])
{
	$tab = explode(" ", $argv[1]);
	$tab = array_filter($tab, strlen);
	$tab = array_values($tab);
	$len = count($tab);
	$start = array_shift($tab);
	array_push($tab, $start);
	$i = -1;
	while (++$i <= $len)
	{
		if ($i + 1 < $len)
			echo "$tab[$i] ";
		else if ($i < $len)
			echo "$tab[$i]";
	}
	echo "\n";
}
