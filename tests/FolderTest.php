<?php
use micro\orm\DAO;
class FolderTest extends \PHPUnit_Framework_TestCase {
	private $config;
	public function setUp(){
		global $config;
		$this->config=$config;
		DAO::connect($config["database"]["dbName"]);
	}
	
	public function testConfigIsOk(){
		$this->assertArrayHasKey("siteUrl", $this->config);
	}

}