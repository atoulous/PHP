<?php

class NightsWatch {

	public function recruit($guy) {
		if (method_exists($guy, fight))
			$guy->fight();
	}
	public function fight() {}
}

?>
