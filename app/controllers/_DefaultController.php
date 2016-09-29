<?php
use micro\orm\DAO;
use micro\utils\RequestUtils;
use micro\controllers\Controller;
/**
 * Classe de base des contrôleurs Cloud pour CRUD
 * @author jcheron
 * @version 1.2
 * @package cloud.controllers
 */
class _DefaultController extends Controller {
	use MessagesTrait;
	/**
	 * @var string Classe du modèle associé
	 */
	protected $model;

	/**
	 * @var string zone titre h1 de la page
	 */
	protected $title;

	/**
	 * Affiche la liste des instances de la class du modèle associé $model
	 * @see BaseController::index()
	 */
	public function index($message=null){
		global $config;
		$baseHref=get_class($this);
		if(isset($message)){
			if(is_string($message)){
				$message=new DisplayedMessage($message);
			}
			$message->setTimerInterval($this->messageTimerInterval);
			$this->_showDisplayedMessage($message);
		}
		$objects=DAO::getAll($this->model);
		$this->loadView("main/vObjects.html",array("objects"=>$objects,"model"=>$this->model,"config"=>$config,"baseHref"=>$baseHref));
	}

	/**
	 * Retourne une instance de $className<br>
	 * si $id est nul, un nouvel objet est retourné<br>
	 * sinon l'objet retourné est celui chargé depuis la BDD à partir de l'id $id
	 * @param string $id
	 * @return multitype:$className
	 */
	public function getInstance($id=NULL){
		if(isset($id)){
			$object=DAO::getOne($this->model, $id);
		}else{
			$className=$this->model;
			$object=new $className();
		}
		return $object;
	}

	/**
	 * Affiche le formulaire d'ajout ou de modification d'une instance de $className<br>
	 * L'instance est définie à partir de $id<br>
	 * frm doit utiliser la méthode getInstance() pour obtenir l'instance à ajouter ou à modifier
	 * @see _DefaultController::getInstance()
	 * @param string $id
	 */
	public function frm($id=NULL){
		echo "Non implémenté...";
	}

	/**
	 * Affecte membre à membre les valeurs du tableau associatif $_POST aux membres de l'objet $object<br>
	 * Prévoir une sur-définition de la méthode pour l'affectation des membres de type objet<br>
	 * Cette méthode est utilisée update()
	 * @see _DefaultController::update()
	 * @param multitype:$className $object
	 */
	protected function setValuesToObject(&$object){
		RequestUtils::setValuesToObject($object,$_POST);
	}

	/**
	 * Permet d'exécuter du code après mise à jour de $object
	 * @param mixed $object
	 */
	protected function onUpdate($object){

	}

	/**
	 * Permet d'exécuter du code après ajout de $object
	 * @param mixed $object
	 */
	protected function onAdd($object){

	}

	/**
	 * Permet d'exécuter du code après suppression de $object
	 * @param mixed $object Objet supprimé
	 */
	protected function onDelete($object){

	}

	/**
	 * Met à jour à partir d'un post une instance de $className<br>
	 * L'affectation des membres de l'objet par le contenu du POST se fait par appel de la méthode setValuesToObject()
	 * @see _DefaultController::setValuesToObject()
	 */
	public function update(){
		if(RequestUtils::isPost()){
			$className=$this->model;
			$object=new $className();
			$this->setValuesToObject($object);
			if($_POST["id"]){
				try{
					DAO::update($object);
					$msg=new DisplayedMessage($this->model." `{$object->toString()}` mis à jour");
					$this->onUpdate($object);
				}catch(\Exception $e){
					$msg=new DisplayedMessage("Impossible de modifier l'instance de ".$this->model,"danger");
				}
			}else{
				try{
					DAO::insert($object);
					$msg=new DisplayedMessage("Instance de ".$this->model." `{$object->toString()}` ajoutée");
					$this->onAdd($object);
				}catch(\Exception $e){
					$msg=new DisplayedMessage("Impossible d'ajouter l'instance de ".$this->model,"danger");
				}
			}
			$this->_postUpdateAction($msg);
		}
	}

	/**
	 * Action à exécuter après update
	 * par défaut forward vers l'index du contrôleur en cours
	 * @param array $params
	 */
	protected function _postUpdateAction($params){
		$this->forward(get_class($this),"index",$params);
	}

	/**
	 * Supprime l'instance dont l'id est $id dans la BDD
	 * @param int $id
	 */
	public function delete($id){
		try{
			$object=DAO::getOne($this->model, $id);
			if($object!==NULL){
				DAO::delete($object);
				$msg=new DisplayedMessage($this->model." `{$object->toString()}` supprimé(e)");
				$this->onDelete($object);
			}else{
				$msg=new DisplayedMessage($this->model." introuvable","warning");
			}
		}catch(\Exception $e){
			$msg=new DisplayedMessage("Impossible de supprimer l'instance de ".$this->model,"danger");
		}
		$this->forward(get_class($this),"index",$msg);
	}
	/* (non-PHPdoc)
	 * @see BaseController::initialize()
	 */
	public function initialize() {
		if(!RequestUtils::isAjax()){
			$this->loadView("main/vHeader.html",array("infoUser"=>Auth::getInfoUser()));
			echo "<div class=''>";
			echo "<h1>".$this->title."</h1>";
		}
	}

	/* (non-PHPdoc)
	 * @see BaseController::finalize()
	 */
	public function finalize() {
		if(!RequestUtils::isAjax()){
			echo "</div>";
			$this->loadView("main/vFooter.html");
		}
	}

}