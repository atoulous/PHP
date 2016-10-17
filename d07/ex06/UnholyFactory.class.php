<?php

include_once('Fighter.class.php');

class UnholyFactory {

	private $tab = array();

	public function absorb($guy) {
		if (is_a($guy, Fighter))
		{
			if (in_array($guy, $this->tab))
				print("(Factory already absorbed a fighter of type $guy)".PHP_EOL);
			else {
				print("(Factory absorbed a fighter of type $guy)".PHP_EOL);
				$this->tab[] = $guy;
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)".PHP_EOL);
	}
	public function fabricate($rf) {
		if (in_array($rf, $this->tab)) {
			print("(Factory fabricates a fighter of type $rf)".PHP_EOL);
			if ($rf == "archer")
				$f = new Archer();
			if ($rf == "foot soldier")
				$f = new Footsoldier();
			if ($rf == "assassin")
				$f = new Assassin();
			return($f);
		}
		else
			print("(Factory hasn't absorbed any fighter of type llama)".PHP_EOL);
	}
}

?>
