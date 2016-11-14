<?php
use micro\utils\RequestUtils;
class Selenium extends BaseController {
 
    public function __construct() {
        parent::__construct();
    }
 
    public function index() {
        echo "<h1>Hello Selenium</h1>";
        echo "<form method='POST' action='Selenium/post' name='frm' id='frm'>";
        echo "<input type='text' name='text' id='text'></form>";
        
        echo "<form method='POST' action='Selenium/post' name='frm2' id='frm2'>";
        echo "<input type='text' name='text' id='text2'>";
        echo "<input type='submit' id='btSubmit' value='valider'></form>";
    }
 
    public function post(){
        if(RequestUtils::isPost()){
            echo "<div id='result'>".$_POST['text']."</div>";
        }
    }
}