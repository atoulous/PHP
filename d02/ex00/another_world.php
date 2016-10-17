#!/usr/bin/php
<?php

if ($argv[1])
{
	$str = trim($argv[1]);
	$pattern = "/[ \t]+/";
	$str = preg_replace($pattern, " ", $str);
	echo "$str\n";
}

?>
