<?php

class Exemple {

	const CST1 = 1;
	const CST2 = 2;

	public $publicfoo = 0; // <=== attribut // public = accessible depuis l'ext de la classe
	private $_privateFoo = 'hello'; // private = interne a la classe;

	public function getpublicfoo() { return $this->publicfoo; }
		
	public function setpublicfoo() { $this->publicfoo = $publicfoo; return; }

	public static function doc() {
		return 'This is a sample lass with no real purpose.';
	}

	function __construct( array $kwargs ) {

		if ( $kwargs['arg'] == self::CST1)
			print( 'arg is CST1' . PHP_EOL);
		else if ( $kwargs['arg'] == self::CST2)
			print( 'arg is CST2' . PHP_EOL);
		
		print( 'Constructor called' . PHP_EOL );
		
		print( '$this->publicfoo: ' . $this->publicfoo . PHP_EOL );
		$this->publicfoo = 42;
		print( '$this->publicfoo: ' . $this->publicfoo . PHP_EOL );
		
		print( '$this->_privateFoo: ' . $this->_privateFoo . PHP_EOL );
		$this->_privateFoo = 'world';
		print( '$this->_privateFoo: ' . $this->_privateFoo . PHP_EOL );
		
		$this->publicbar();
		$this->_privatebar();
		
		return;
	}

	function __destruct() { // desinstancier
		print( 'Destructor called' . PHP_EOL );
	return;
	}

	function publicbar() {
		print( 'Method publicbar called' . PHP_EOL );
	return;
	}
	
	private function _privatebar() {
		print( 'Method _privatebar called' . PHP_EOL );
	return;
	}

	public function __toString() {
		return (Exemple());
	}
	
	public function __invoke() {
		return $this->getpuclicfoo() + $this->getpublicfoo;
	}
}

$instance = new Exemple(array('arg' => 42); // instancier

print( '$instance->publicfoo: ' . $instance->publicfoo . PHP_EOL );
$instance->publicfoo = 100;
print( '$instance->publicfoo: ' . $instance->publicfoo . PHP_EOL );

$instance->publicbar();

print( '$instance->_privateFoo: ' . $instance->_privateFoo . PHP_EOL );
$instance->_privateFoo = 100;
print( '$instance->_privateFoo: ' . $instance->_privateFoo . PHP_EOL );

$intance_clone = clone $instance;

$instance_CST1 = new Exemple( array( 'arg' => Exemple::CST1));

$instance->_privatebar();
?>
