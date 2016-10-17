#!/usr/bin/php
<?php

if ($argc > 1)
{
	unset($argv[0]);
	$str = implode(" ", $argv);
	$tab = array_filter(explode(" ", $str), strlen);
	$tab = array_values($tab);
	sort($tab);
	$str = implode("\n", $tab);
	echo "$str\n";
}

?>
