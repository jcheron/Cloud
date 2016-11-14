<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\controllers\Controller;
use micro\utils\RequestUtils;
use micro\views\View;
use Ajax\bootstrap\html\HtmlInput;
/**
 * Contrôleur par défaut (défini dans config => documentRoot)
 * @author jcheron
 * @version 1.2
 * @package cloud.controllers
 */
class Accueil extends Controller {

	/**
	 * Affiche la page par défaut du site
	 * @see BaseController::index()
	 */
	public function index() {
		$isAjax=RequestUtils::isAjax();
		if(!$isAjax){
			$this->loadView("main/vHeader.html",array("infoUser"=>Auth::getInfoUser()));
		}
		$bs=$this->jquery->bootstrap();
		$bt=$bs->htmlButton("bt0","Test Bootstrap");
		$bt->setProperty("data-ajax","myDisques");
		$bt->getOnClick("","#main",["attr"=>"data-ajax"]);
		//$edit=$bs->htmlInput("text1");
		//$edit->onKeypress("var s=$(this).val();$(this).val(s.replace(/[\x00-\x1F\x7F-\x9F]/g, ''));");
		$this->jquery->compile($this->view);
		$this->loadView("main/vDefault.html");
		
    	Jquery::getOn("click","a[data-ajax]","","#main",array("attr"=>"data-ajax"));
		echo Jquery::compile();
		if(!$isAjax){
			$this->loadView("main/vFooter.html");
		}
	}

	/**
	 * Affiche la page de test
	 */
	public function test() {
		$this->loadView("main/vTest");
	}
	/**
	 * Connecte le premier administrateur trouvé dans la BDD
	 */
	public function asAdmin(){
		$_SESSION["user"]=DAO::getOne("Utilisateur", "admin=1");
		$this->index();
	}

	/**
	 * Connecte le premier utilisateur (non admin) trouvé dans la BDD
	 */
	public function asUser(){
		$_SESSION["user"]=DAO::getOne("Utilisateur", "admin=0");
		$this->index();
	}

	/**
	 * Déconnecte l'utilisateur actuel
	 */
	public function disconnect(){
		if(array_key_exists("autoConnect", $_COOKIE)){
			unset($_COOKIE['autoConnect']);
			setcookie("autoConnect", "", time()-3600,"/");
		}
		$_SESSION = array();
		$_SESSION['KCFINDER'] = array(
				'disabled' => true
		);
		$this->index();
	}

	public function getInfoUser(){
		echo Auth::getInfoUser();
	}
}