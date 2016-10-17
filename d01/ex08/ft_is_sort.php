<?php

function	ft_is_sort($tab)
{
	$tab2 = $tab;
	sort($tab2);
	$tab2 = array_diff_assoc($tab, $tab2);
	return ($tab2 ? 0 : 1);
}

?>
