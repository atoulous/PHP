#!/usr/bin/php
<?php
while (1)
{
	echo "Entrez un nombre: ";
	$nbr = trim(fgets(STDIN));
	if (feof(STDIN))
	{
		echo "^D\n";
		exit();
	}
	if (is_numeric($nbr) == FALSE)
	{
		echo "'$nbr' n'est pas un chiffre\n";
	}
	else
	{
		if ($nbr % 2 == 1)
			echo "Le chiffre $nbr est Impair\n";
		if ($nbr % 2 == 0)
			echo "Le chiffre $nbr est Pair\n";
	}
}
