<?php
class Service extends \Base {
	/**
	 * @Id
	 */
	private $id;

	/**
	 * @Column(name="nom",nullable=true)
	 */
	private $nom=null;
	private $description;
	private $prix;
	public function toString() {
		return (string) $this->nom;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id=$id;
		return $this;
	}

	public function getNom() {
		return $this->nom;
	}

	public function setNom($nom) {
		$this->nom=$nom;
		return $this;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description=$description;
		return $this;
	}

	public function getPrix() {
		return $this->prix;
	}

	public function setPrix($prix) {
		$this->prix=$prix;
		return $this;
	}

}