<?php

include_once('Lannister.class.php');

class Tyrion extends Lannister {
	public function sleepWith($carac) {
		if (is_a($carac, Cersei))
			print("Not even if I'm drunk !".PHP_EOL);
		if (is_a($carac, Jaime))
			print("Not even if I'm drunk !".PHP_EOL);
		if (is_a($carac, Sansa))
			print("Let's do this.".PHP_EOL);
	}
}

?>
