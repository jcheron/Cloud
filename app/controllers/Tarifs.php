<?php
class Tarifs extends \_DefaultController {
	public function isValid(){
		return Auth::isAuth();
		//une modification
	}
	public function onInvalidControl(){
		$this->messageDanger("Vous n'êtes pas autorisé à afficher cette page !",3000,false);
		exit;
	}
	public function __construct() {
		parent::__construct ();
		$this->model="Tarif";
		$this->title="Tarifs";
	}
	
	public function frm($id=NULL){
		if(Auth::isAdmin()){
			$tarif=$this->getInstance($id);
			$this->loadView("Tarifs/edit.html",array("tarif"=>$tarif));
		}else{
			$this->onInvalidControl();
		}
	}
}