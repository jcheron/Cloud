<?php
use micro\db\Database;

class Install{
	private static $db;
	private static function dbExists($dbName){
		$query=self::$db->query("show databases like '{$dbName}'");
		return $query->fetch();
	}
	
	private static function connect(){
		self::$db=new Database("");
		self::$db->connect();
	}
	
	public static function checkDb($dbName){
		self::connect();
		if(self::dbExists($dbName)){
			echo "la base {$dbName} existe<br>";
		}
		$sql=file_get_contents(ROOT.'database/cloud.sql');
		$sql=preg_replace("/CREATE DATABASE IF NOT EXISTS `(.*?)`/i", "CREATE DATABASE IF NOT EXISTS `{$dbName}`", $sql);
		$sql=preg_replace("/USE `(.*?)`;/i", "USE `{$dbName}`;", $sql);
		$sql=explode(";", $sql);
		foreach ($sql as $str){
			try{
				if(preg_match("/-- (.*?)\r\n/", $str,$matches)!==false){
					if(sizeof($matches)>0)
						echo $matches[1]."<br>";
				}
				self::$db->execute($str.";");
			}catch(Exception $e){
					
			}
		}
	}
	
	public static function run(){	
		echo "<h1>Installation</h1>";
		global $config;
		if(array_key_exists("siteUrl", $config)){
			echo "<ul>";
			echo "<li>".$config["siteUrl"]."</li>";
			echo "<li>".phpversion()."</li>";
			echo "</ul>";
			self::checkDb("cloud3");

		}else{
			$content='return array(
				"siteUrl"=>"http://127.0.0.1/myCloud/");';
			file_put_contents(ROOT.DS."config2.php", $content);
		}
	}
}

Install::run();