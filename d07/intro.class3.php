<?php
class ExempleA {

	public function __construct() {
		print('Constructor ExempleA called'.PHP_EOL);
	}

	public function __destruct() {
		print('Destructor ExempleA called'.PHP_EOL);
		return;
	}

	public function foo() {
		print('Function foo from class A' . $this->att.PHP_EOL);
	}
	
	public function test() {
		self::foo();
		return;
	}
}

class ExempleB extends ExempleA {

	public function __construct() {
		print('Constructor ExempleB called'.PHP_EOL);
		return;
	}
	public function __destruct() {
		print('Destructor ExempleB called'.PHP_EOL);
		return;
	}
	
	public function foo() {
		print('Function foo from class B' . $this->att.PHP_EOL);
		return;
	}

}

$instanceA = new ExempleA();
$instanceB = new ExempleB();

$instanceA->foo();
$instanceB->foo();

$instanceA->test();
$instanceB->test();
?>
