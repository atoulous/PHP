#!/usr/bin/php
<?php

function to_upp($tab)
{
	$str = strtoupper($tab[0]);
	return ($str);
}

function find_link($tab)
{
	$pattern = array("/title=[\"|']\K.*?[\"|']/", "/>(.|\s)*?</");
	$str = preg_replace_callback($pattern, to_upp, $tab[0]);
	return ($str);
}

if ($argv[1])
{
	$str = file_get_contents($argv[1]);
	$pattern = "/<a(.|\s)*?<\/a>/";
	$str = preg_replace_callback($pattern, find_link, $str);
	echo($str);
}

?>
