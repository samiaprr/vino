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
		"'".$username."_Cellier_1')";

        $res = $this->_db->query($requete);
        
		return $res;
	}
	
		public function getCellierByUsername($username)
	{
		$requete = 'Select * from cellier where id_user="' . $username . '"';
       // $res = $this->_db->query($requete); 
      //  $row = $res->fetch_assoc();
	//	return $row;
		
				if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['id_user'] = trim(utf8_encode($row['id_user']));
					$row['id_cellier'] = trim(utf8_encode($row['id_cellier']));
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		
		
		return $rows;
		
		
	}

		public function getCellierByid_cellier($id_cellier)
	{
		$requete = 'Select * from cellier where id_cellier="' . $id_cellier . '"';
       // $res = $this->_db->query($requete); 
      //  $row = $res->fetch_assoc();
	//	return $row;
		
				if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['id_user'] = trim(utf8_encode($row['id_user']));
					$row['id_cellier'] = trim(utf8_encode($row['id_cellier']));
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		
		
		return $rows;
		
		
	}
		
	public function updateCellierNom($id_cellier, $nom)
	{
		//TODO : Valider les données.			
		$requete = "UPDATE cellier SET  nom='".$nom."'  WHERE id_cellier='". $id_cellier."'";
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