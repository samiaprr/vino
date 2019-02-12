<?php
/**
 * Class User
 * Cette classe possède les fonctions de gestion des usager.
 * 
 * @author Ming
 * @version 1.0
 * @update 2019-02-06
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Cellier extends Modele {
	const TABLE = 'cellier';
	
		public function insertCellier($username)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO cellier(id_user,nom) VALUES (".
		"'".$username."',".
		"'".$username."Cellier')";

        $res = $this->_db->query($requete);
        
		return $res;
	}
	
		public function getCellierByUsername($username)
	{
		$requete = 'Select * from cellier where id_user="' . $username . '"';
        $res = $this->_db->query($requete); 
        $row = $res->fetch_assoc();
		return $row;
		
		
	}
	
	public function updateCellierNOm($username, $nom)
	{
		//TODO : Valider les données.			
		$requete = "UPDATE cellier SET  nom='".$nom."'  WHERE id_user='".$username."'";
		//echo $requete;
        $res = $this->_db->query($requete);
        
		return $res;
	}
    
/*    

    
	public function insertUser($username,$password)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO usager(username,password) VALUES (".
		"'".$username."',".
		"'".$password."')";

        $res = $this->_db->query($requete);
        
		return $res;
	}
	

*/	
  
}




?>