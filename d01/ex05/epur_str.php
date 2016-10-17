#!/usr/bin/php
<?php

if ($argc == 2)
{
	$tab = explode(" ", $argv[1]);
	$tab = array_filter($tab, strlen);
	$tab = array_values($tab);
	$str = implode(" ", $tab);
	echo "$str";
	echo "\n";
}

?>
