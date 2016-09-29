<?php
trait MessagesTrait {
	/**
	 * @var int durée en millisecondes d'affichage des messages d'information
	 */
	protected $messageTimerInterval=5000;
	
	/**
	 * Affiche un message Alert bootstrap
	 * @param DisplayedMessage $message
	 */
	public function _showDisplayedMessage($message,$asString=false){
		return $this->_showMessage($message->getContent(),$message->getType(),$message->getTimerInterval(),$message->getDismissable(),true,$asString);
	}
	
	/**
	 * Affiche un message Alert bootstrap
	 * @param string $message texte du message
	 * @param string $type type du message (info, success, warning ou danger)
	 * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
	 * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
	 */
	public function _showMessage($message,$type="success",$timerInterval=0,$dismissable=true,$visible=true,$asString=false){
		$datas=array(
				"message"=>$message,"type"=>$type,"dismissable"=>$dismissable,"timerInterval"=>$timerInterval,"visible"=>$visible
				
		);
		return $this->loadView("main/vInfo",$datas,$asString);
	}
	
	/**
	 * Affiche un message Alert bootstrap de type success
	 * @param string $message texte du message
	 * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
	 * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
	 */
	public function messageSuccess($message,$timerInterval=0,$dismissable=true,$asString=false){
		return $this->_showMessage($message,"success",$timerInterval,$dismissable,true,$asString);
	}
	
	/**
	 * Affiche un message Alert bootstrap de type warning
	 * @param string $message texte du message
	 * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
	 * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
	 */
	public function messageWarning($message,$timerInterval=0,$dismissable=true,$asString=false){
		return $this->_showMessage($message,"warning",$timerInterval,$dismissable,true,$asString);
	}
	
	/**
	 * Affiche un message Alert bootstrap de type danger
	 * @param string $message texte du message
	 * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
	 * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
	 */
	public function messageDanger($message,$timerInterval=0,$dismissable=true,$asString=false){
		return $this->_showMessage($message,"danger",$timerInterval,$dismissable,true,$asString);
	}
	/**
	 * Affiche un message Alert bootstrap de type info
	 * @param string $message texte du message
	 * @param number $timerInterval durée en millisecondes d'affichage du message (0 pour que le message reste affiché)
	 * @param string $dismissable si vrai, l'alert dispose d'une croix de fermeture
	 */
	public function messageInfo($message,$timerInterval=0,$dismissable=true,$asString=false){
		return $this->_showMessage($message,"info",$timerInterval,$dismissable,true,$asString);
	}
}