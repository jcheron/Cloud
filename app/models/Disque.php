<?php

class Disque extends Base{
	/**
	 * @Id
	 */
	private $id;
	private $nom;
	private $createdAt;

	/**
	 * @ManyToOne
	 * @JoinColumn(name="idUtilisateur",className="Utilisateur",nullable=false)
	 */
	private $utilisateur;

	/**
	 * @OneToMany(mappedBy="tarif",className="DisqueTarif")
	 */
	private $disqueTarifs;

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

	public function getUtilisateur() {
		return $this->utilisateur;
	}

	public function setUtilisateur($utilisateur) {
		$this->utilisateur=$utilisateur;
		return $this;
	}

	public function getTarifs() {
		return $this->tarifs;
	}

	public function setTarifs($tarifs) {
		$this->tarifs=$tarifs;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 * @see Base::toString()
	 */
	public function toString() {
		return $this->nom.":".$this->utilisateur->getLogin();
	}

	public function getDisqueTarifs() {
		return $this->disqueTarifs;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt) {
		$this->createdAt=$createdAt;
		return $this;
	}




}