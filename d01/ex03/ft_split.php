<?php
function ft_split($str)
{
	$tab = explode(" ", $str);
	$tab = array_filter($tab, strlen);
	$tab = array_values($tab);
	sort($tab);
	return ($tab);
}

?>
