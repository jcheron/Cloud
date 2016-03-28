<?php
/**
 * Représente un utilisateur
 * @author jcheron
 * @version 1.1
 * @package helpdesk.models
 */
class Utilisateur extends Base{
	/**
	 * @Id
	 */
	private $id;
	private $login="";
	private $password="";
	private $mail="";
	private $tel;
	private $admin=false;
	private $createdAt;

	/**
	 * @OneToMany(mappedBy="utilisateur",className="Disque")
	 */
	private $disques;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id=$id;
		return $this;
	}

	public function getLogin() {
		return $this->login;
	}

	public function setLogin($login) {
		$this->login=$login;
		return $this;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password=$password;
		return $this;
	}

	public function getMail() {
		return $this->mail;
	}

	public function setMail($mail) {
		$this->mail=$mail;
		return $this;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public function setAdmin($admin) {
		$this->admin=$admin;
		return $this;
	}

	public function getTel() {
		return $this->tel;
	}

	public function setTel($tel) {
		$this->tel=$tel;
		return $this;
	}

	public function toString(){
		$uType="Utilisateur";
		$p="";
		if($this->admin){
			$uType="Administrateur";
		}
		return $p.$this->mail. "-".$this->login." (".$uType.")";
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt) {
		$this->createdAt=$createdAt;
		return $this;
	}

	public function getDisques() {
		return $this->disques;
	}

	public function setDisques($disques) {
		$this->disques=$disques;
		return $this;
	}



}