<?php

abstract class Fighter {

	public $nom;

	public function __construct($str) {
		$this->nom = $str;
	}
	public function __toString() {
		return $this->nom;
	}
	abstract public function fight($target);
}

?>
