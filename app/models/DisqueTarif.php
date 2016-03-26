<?php
/**
 * @Table(name="disque_tarif")
 */
class DisqueTarif extends \Base {
	/**
	 * @Id
	 */
	private $idDisque;
	/**
	 * @Id
	 */
	private $idTarif;


	private $startDate;

	/**
	 * @ManyToOne
	 * @JoinColumn(name="idTarif",className="Tarif",nullable=false)
	 */
	private $tarif;

	/**
	 * @ManyToOne
	 * @JoinColumn(name="idDisque",className="Disque",nullable=false)
	 */
	private $disque;

	public function toString() {
		$this->tarif;
	}

	public function getTarif() {
		return $this->tarif;
	}

	public function setTarif($tarif) {
		$this->tarif=$tarif;
		return $this;
	}

	public function getDisque() {
		return $this->disque;
	}

	public function setDisque($disque) {
		$this->disque=$disque;
		return $this;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setStartDate($startDate) {
		$this->startDate=$startDate;
		return $this;
	}



}