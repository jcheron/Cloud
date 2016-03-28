<?php
class Tarif extends \Base {
	/**
	 * @Id
	 */
	protected $id;

    /**
     * @var string
     */
    protected $quota;

    /**
     * @var double
     */
    protected $coutDepassement;

    /**
     * @var double
     */
    protected $prix;

    /**
     * @var string
     */
    protected $unite;

    /**
     * @var double
     */
    protected $margeDepassement;

	public function toString() {
		return "prix : ".
    	sprintf('%01.2f', $this->prix)."&euro;, Marge de dépassement : ".
    	sprintf('%01.2f',$this->margeDepassement*100)."%, coût : ".
    	sprintf('%01.2f', $this->coutDepassement)."&euro;";
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id=$id;
		return $this;
	}

	public function getQuota() {
		return $this->quota;
	}

	public function setQuota($quota) {
		$this->quota=$quota;
		return $this;
	}

	public function getCoutDepassement() {
		return $this->coutDepassement;
	}

	public function setCoutDepassement($coutDepassement) {
		$this->coutDepassement=$coutDepassement;
		return $this;
	}

	public function getPrix() {
		return $this->prix;
	}

	public function setPrix($prix) {
		$this->prix=$prix;
		return $this;
	}

	public function getUnite() {
		return $this->unite;
	}

	public function setUnite($unite) {
		$this->unite=$unite;
		return $this;
	}

	public function getMargeDepassement() {
		return $this->margeDepassement;
	}

	public function setMargeDepassement($margeDepassement) {
		$this->margeDepassement=$margeDepassement;
		return $this;
	}

}