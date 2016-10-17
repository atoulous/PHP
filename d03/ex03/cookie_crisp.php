<?php

$name = $_GET["name"];
$value = $_GET["value"];
$action = $_GET["action"];
$year = 365*24*3600;

if ($name && $value && $action)
{
	if ($action == "set")
		setcookie($name, $value, time() + $year);
	else if ($action == "del")
	{
		setcookie($name, NULL, -1);
	}
	else if ($action == "get" && $_COOKIE[$name])
		echo "$_COOKIE[$name]\n";
}

?>
