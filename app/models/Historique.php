<?php
/**
 * @Table(name="historique")
 */
class Historique extends Base{
	/**
	 * @Id
	 */
	private $idDisque;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idDisque",className="Disque",nullable=false)
	 */
	private $disque;
	/**
	 * @Id
	 */
	private $date;
	private $occupation;

	public function getDisque() {
		return $this->disque;
	}

	public function setDisque($disque) {
		$this->disque=$disque;
		return $this;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date=$date;
		return $this;
	}

	public function getOccupation() {
		return $this->occupation;
	}

	public function setOccupation($occupation) {
		$this->occupation=$occupation;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 * @see Base::toString()
	 */
	public function toString() {
		return $this->disque." (".$this->occupation.")";
	}

	public function getIdDisque() {
		return $this->idDisque;
	}

	public function setIdDisque($idDisque) {
		$this->idDisque=$idDisque;
		return $this;
	}


}