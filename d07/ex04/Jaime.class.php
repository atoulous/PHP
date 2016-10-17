<?php

include_once('Lannister.class.php');

class Jaime extends Lannister {
	public function sleepWith($carac) {
		if (is_a($carac, Cersei))
			print("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
		if (is_a($carac, Tyrion))
			print("Not even if I'm drunk !".PHP_EOL);
		if (is_a($carac, Sansa))
			print("Let's do this.".PHP_EOL);
	}
}

?>
