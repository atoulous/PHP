#!/usr/bin/php
<?php

$nb = preg_match_all("/^toto$/", "toto"); //^debut $fin
echo "$nb\n";
$nb = preg_match("/t[oi]t[oi]/", "efefefetotoftotoefef");
echo "$nb\n";
$nb = preg_match_all("/t[0-9]t[a-m]/", "t1ti");
echo "$nb\n";
$nb = preg_match_all("/t[0-9]+t[a-m]/", "t1ti"); //caractere precedent
echo "$nb\n";
$nb = preg_match_all("/t[0-9]*t[a-m]/", "t65465ti"); //caractere present x fois
echo "$nb\n";
$nb = preg_match_all("/t[0-9]?t[a-m]/", "t6ti"); //? 1 ou 0
echo "$nb\n";
$nb = preg_match_all("/t[0-9]{3}t[a-m]/", "t645ti"); //caractere present 3 fois
echo "$nb\n";
$nb = preg_match_all("/t[^0-9]t[a-m]/", "titi"); //^ tout sauf des chiffes
echo "$nb\n";
$nb = preg_match_all("/t([io])t(\1)/", "titi"); //
echo "$nb\n";

$nom = "key";
$$nom = "val"; //$key = val
echo "$key\n";

$tab = file("test.csv");
foreach ($tab as $elem) // lire un fichier d'un coup
	echo "$elem";
$fd = fopen("test.csv", "r");
while ($line = fgets($fd)) //ligne par ligne
	echo "$line";
fclose($fd);
$fd = fopen("test.csv", "r");
while ($tab = fgetcsv($fd, 0, ";")) //en tableau
	print_r($tab);
fclose($fd);

eval("echo 'Hello World\n';");
//$my_var = fgets(STDIN);
//eval($my_var);

if (0 === "LOLILOL")
	echo "fume\n";
$tab = array("zero", "un");
if (array_search("zero", $tab) !== FALSE)
	echo "found\n";

$c = curl_init("http://wwww.42.fr");
$str = curl_exec($c);
echo "$str";

?>
