<?php
class Histos extends \_DefaultController {

	public function __construct(){
		parent::__construct();
		$this->title="Occupation journalière des disques";
		$this->model="Historique";
	}
}