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
class User extends Modele {
	const TABLE = 'usager';
    /**
	 * Cette méthode permet de retourner un usager  
	 * 
	 * @param string $username nom d'un usager.
	 * 
	 * @return array information d'un usager
	 */
	public function getUserByUsername($username)
	{
		$res = $this->_db->query('Select * from '. self::TABLE . ' where username="' . $username . '"');
        $row = $res->fetch_assoc();
		return $row;
	}


     /**
	 * Cette méthode permet d'inserer un nouvel usager 
	 * 
	 * @param string $username nom d'un usager.
	 * @param string $password password d'un usager.
	 * 
	 * @return bool retourne true ou false comme résultat de requête
	 */
	public function insertUser($username,$password)
	{
		//TODO : Valider les données.
		
		$requete = "INSERT INTO usager(username,password) VALUES (".
		"'".$username."',".
		"'".$password."')";

        $res = $this->_db->query($requete);
        
		return $res;
	}
	

	 /**
	 * Cette méthode permet de modifier le mot de passe d'un usager 
	 * 
	 
	 * @param string $username nom d'un usager.
	 * @param string $password password d'un usager.
	 * 
	 * @return bool retourne true ou false comme résultat de requête
	 */
	public function updateUser($username, $password)
	{
		//TODO : Valider les données.			
		$requete = "UPDATE usager SET  password='".$password."'  WHERE username='".$username."'";
		
        $res = $this->_db->query($requete);
        
		return $res;
	}
    
	
  
}




?>