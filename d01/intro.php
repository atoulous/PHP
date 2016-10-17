#!/usr/bin/php
<?php

function my_add($p1, $p2)
{
	return $p1 + $p2;
}

echo "Hello World\n";
print("Hello World\n");

$my_var = 42;
$my_str = "World";
$my_tab = array("zero", "un", "deux");
$my_hash = array("key1" => "val1", "key2" => "val2");

echo $my_var.$my_str."\n";

$result = "21" + "21";
echo "$result\n";

$my_tab[0] = "00";

echo $my_tab[0];
echo "\n";
echo $my_hash["key1"]."\n";

print_r($my_tab);

echo my_add("36", "6");
echo "\n";

if ($my_tab[1] == "un")
	echo "ok\n";
else
	echo "ko\n";

echo "$argc\n";
print_r($argv);

foreach ($my_tab as $elem)
{
	echo "$elem\n";
}
echo "\n";

foreach ($argv as $elem)
{
	echo "$elem\n";
}

$my_tab = explode(";", "zero;un;deux");

?>
