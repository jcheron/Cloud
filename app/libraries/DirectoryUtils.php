<?php
use micro\orm\DAO;
/**
 * Classe de gestion des fichiers/dossiers
 * @author jcheron
 * @version 1.1
 * @package cloud.my
 **/

class DirectoryUtils {

	/**
	 * Scan le contenu d'un dossier $dir de manière récursive à partie de $rootDir
	 * @param String $dir
	 * @param String $rootDir
	 * @return array
	 */
	public static function scan($dir,$rootDir){
		$files = array();
		if(file_exists($dir)){
			foreach(scandir($dir) as $f) {
				if(!$f || $f[0] == '.') {
					continue;
				}
				if(is_dir($dir . '/' . $f)) {
					$files[] = array(
							"name" => $f,
							"type" => "folder",
							"path" => substr($dir . '/' . $f,strlen($rootDir)),
							"items" => self::scan($dir . '/' . $f,$rootDir)
					);
				}else {
					$files[] = array(
							"name" => $f,
							"type" => "file",
							"path" => $dir . '/' . $f,
							"size" => filesize($dir . '/' . $f)
					);
				}
			}
		}
		return $files;
	}

	/**
	 * Recherche de manière récursive la taille de $dir
	 * @param String $dir
	 * @return number
	 */
	public static function scanForSize($dir){
		$size = 0;
		if(file_exists($dir)){
			foreach(scandir($dir) as $f) {
				if(!$f || $f[0] == '.') {
					continue;
				}
				if(is_dir($dir . '/' . $f)) {
					$size+=self::scanForSize($dir . '/' . $f);
				}else {
					$size+=filesize($dir . '/' . $f);
				}
			}
		}
		return $size;
	}

	/**
	 * Met à jour l'historique du jour de $disque et retourne l'instance d'Historique correspondant
	 * @param String $cloud accès par $config->cloud dans un contrôleur
	 * @param Disque $disque
	 * @return Historique
	 */
	public static function updateDaySize($cloud,$disque){
		$size=DirectoryUtils::scanForSize($cloud["root"].$cloud["prefix"].$disque->getUtilisateur()->getLogin()."/".$disque->getNom());
		$histo=DAO::getAll("Historique","idDisque=".$disque->getId()." AND DATE(`date`) = CURDATE() ORDER BY `date` DESC",false);

		if(sizeof($histo)>0){
			$histo=$histo[0];
			if($histo->getOccupation()!=$size){
				$histo->setOccupation($size);
				DAO::update($histo);
			}
		}else{
			$histo=new Historique();
			$histo->setIdDisque($disque->getId());
			$histo->setOccupation($size);
			$histo->setDate(date('Y-m-d'));
			DAO::insert($histo);
		}
		return $histo;
	}
	/**
	 * Met à jour l'historique de tous les disques
	 * @param array $cloud Configuration du Cloud, accès par $this->config->cloud dans un contrôleur
	 */
	public static function updateAllDaySize($cloud){
		$disques=DAO::getAll("Disque");
		foreach ($disques as $disque){
			$histo=self::updateDaySize($cloud,$disque);
			echo $disque." mise à jour...(".$histo->getOccupation().")<br>";
		}
	}

	/**
	 * Formate un nombre $size en octets
	 * @param nimber $size
	 * @param number $precision
	 * @return string
	 */
	public static function formatBytes($size, $precision = 2){
		$base = log($size, 1024);
		$suffixes = array('o', 'Ko', 'Mo', 'Go', 'To');
		return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
	}

	/**
	 * Supprime le fichier $f
	 * @param String $f Chrmin du fichier à supprimer
	 * @return boolean
	 */
	public static function deleteFile($f){
		$result=false;
		if(realpath($f)!=false){
			try{
				$result=unlink(realpath($f));
			}catch (\Exception $e){
				$result=false;
			}
		}
		return $result;
	}

	/**
	 * Crée le dossier correspondant à pathname
	 * @param String $pathname
	 * @return boolean
	 */
	public static function mkDir($pathname){
		$result=true;
		try{
			$result= mkdir($pathname);
		}catch (\Exception $e){
			$result=false;
		}
		return $result;
	}
}