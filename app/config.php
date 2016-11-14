<?php
use Ajax\php\micro\JsUtils;
use Ajax\Bootstrap;
return array(
		"siteUrl"=>"http://127.0.0.1/myCloud/",
		"documentRoot"=>"Accueil",
		"database"=>[
				"dbName"=>"cloud",
				"serverName"=>"127.0.0.1",
				"port"=>"3306",
				"user"=>"root",
				"password"=>""
		],
		"debug"=>false,
		"onStartup"=>function($action){
		},
		"directories"=>["libraries"],
		"templateEngine"=>'micro\views\engine\Twig',
		"templateEngineOptions"=>array("cache"=>false),
		"test"=>true,
		"cloud"=>array('root'=>'files/',
				'prefix'=>'srv-'),
		"di"=>["jquery"=>function(){
				$jquery=new JsUtils();
				$jquery->bootstrap(new Bootstrap());
				return $jquery;
			}
			]
);
