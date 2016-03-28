<?php
use micro\orm\DAO;
/**
 * Classe utilitaire liée aux models
 * @author jcheron
 * @version 1.1
 * @package cloud.my
 */
class ModelUtils {
	/**
	 * Retourne l'occupation de $disque du jour trouvée dans l'historique
	 * @param config du cloud
	 * @param Disque $disque
	 * @return int occupation de $disque
	 */
	public static function getDisqueOccupation($cloud,$disque){
		$result=0;
		$histo=DirectoryUtils::updateDaySize($cloud,$disque);
		if($histo instanceof Historique)
			$result=$histo->getOccupation();
		return $result;
	}

	/**
	 * Retourne le tarif appliqué actuellement à $disque
	 * @param Disque $disque
	 * @return Tarif tarif actuel de $disque
	 */
	public static function getDisqueTarif($disque){
		DAO::getOneToMany($disque, "disqueTarifs");
		$dTarifs=$disque->getDisqueTarifs();
		$lastDate=0;
		$result=null;
		if(sizeof($dTarifs)>0){
			foreach ($dTarifs as $dTarif){
				if($dTarif->getStartDate()>$lastDate)
					$result=$dTarif->getTarif();
			}
		}
		return $result;
	}

	/**
	 * Convertit une unité en nombre d'octets (1 Ko= 1024 o)
	 * @param String $unit unité à convertir (o, Ko, Mo, Go, To, Po)
	 * @return int
	 */
	public static function sizeConverter($unit){
		$units= ["Ko"=>1024,"Mo"=>1024*1024,"Go"=>pow(1024, 3),"To"=>pow(1024, 4),"Po"=>pow(1024,5),"o"=>1];
		return $units[$unit];
	}

	/**
	 * Affiche un tableau d'objets au format HTML
	 * @param array $array Tableau d'objets (doivent implémenter __toString)
	 * @param string $mainTag
	 * @param string $tag
	 * @param string $sep séparateur entre objets
	 * @return string Représentation des objets au format HTML
	 */
	public static function arrayAsHtml($array,$mainTag="div",$tag="span class='label label-info'",$sep="&nbsp;"){
		$result="<{$mainTag}>";
		foreach ($array as $o){
			$result.="<{$tag}>".$o."</{$tag}>".$sep;
		}
		$result.="</{$mainTag}>";
		return $result;
	}
}