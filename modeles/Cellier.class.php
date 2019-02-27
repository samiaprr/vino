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

	/**
	 * Cette méthode permet d'inserer un nouveau cellier pour un usager
	 * 
	
	 * @param string $username Le username de l'usager.
	 
	 * 

	 * 
	 * @return bool true or false si l'insertion a fonctionnée ou non
	 */
	
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

	/**
	 * Cette méthode permet de retourner une liste de cellier par usager
	 * 
	
	 * @param string $username Le username de l'usager.
	 
	 * 

	 * 
	 * @return array liste de cellier par usager
	 */
	
	public function getCellierByUsername($username)
	{
		$requete = 'Select * from cellier where id_user="' . $username . '"';
     
		
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

	/**
	 * Cette méthode permet de retourner un cellier en particulier 
	 * 
	 * @param int $id_cellier id du cellier
	 * 
	 * 
	 * @return array information d'un cellier
	 */
	
	public function getCellierByid_cellier($id_cellier)
	{
		$requete = 'Select * from cellier where id_cellier="' . $id_cellier . '"';
       
		
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
	
	
	
	/**
	 * Cette méthode permet de modifier le nom du cellier 
	 * 
	 * @param int $id_cellier id du cellier
	 * @param string $nom nom du cellier.
	 * 
	 * @return bool retourne true ou false comme résultat de requête
	 */
	public function updateCellierNom($id_cellier, $nom)
	{
		//TODO : Valider les données.			
		$requete = "UPDATE cellier SET  nom='".$nom."'  WHERE id_cellier='". $id_cellier."'";
		//echo $requete;
        $res = $this->_db->query($requete);
        
		return $res;
	}
    

  
}




?>