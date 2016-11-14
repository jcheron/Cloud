<?php
class SeleniumTest extends \AjaxUnitTest {
	public static function setUpBeforeClass(){
		parent::setUpBeforeClass();
		self::get("Selenium/index");
	}
	
	public function testDefault(){
		$this->assertPageContainsText("Hello Selenium");
		$this->assertTrue($this->elementExists("#frm"));
		$this->assertTrue($this->elementExists("#text"));
	}
	
	public function testPost(){
		$this->getElementById("text")->sendKeys("okay");
		$this->getElementById("text")->sendKeys("\xEE\x80\x87");
		SeleniumTest::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertEquals("okay",$this->getElementById("result")->getText());
	}
	
	public function testClick(){
		self::get("Selenium/index");
		$this->getElementById("text2")->sendKeys("test click");
		$this->getElementById("btSubmit")->click();
		SeleniumTest::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertEquals("test click",$this->getElementById("result")->getText());
	}
}