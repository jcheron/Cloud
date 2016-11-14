<?php
class FirstTest extends \PHPUnit_Framework_TestCase {
	
	public function testOk(){
		$this->assertEquals(2, 1+1);
	}
	
	public function testNotOk(){
		$this->assertGreaterThanOrEqual(10, 10);
	}
}