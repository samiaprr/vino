<?php
/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele {
	const TABLE = 'vino__bouteille';

	// /**
	//  * Cette méthode permet de retourner la liste de toutes les bouteilles 
	//  *  
	//  * 
	//  * @return array liste de bouteille
	//  */
	// public function getListeBouteille()
	// {
		
	// 	$rows = Array();
	// 	$res = $this->_db->query('Select * from '. self::TABLE);
	// 	if($res->num_rows)
	// 	{
	// 		while($row = $res->fetch_assoc())
	// 		{
	// 			$rows[] = $row;
	// 		}
	// 	}
		
	// 	return $rows;
	// }
	

	// /**
	//  * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	//  * 
	//  * @param string $nom La chaine de caractère à rechercher
	//  * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	//  * 
	//  * @throws Exception Erreur de requête sur la base de données 
	//  * 
	//  * @return array id et nom de la bouteille trouvée dans le catalogue
	//  */
	// public function getListeBouteilleCellier()
	// {
		
	// 	$rows = Array();
	// 	$requete ='SELECT 
	// 		c.id as id_bouteille_cellier,
	// 			c.id_bouteille_saq, 
	// 			c.date_achat, 
	// 			c.garde_jusqua, 
	// 			c.notes, 
	// 			c.prix, 
	// 			c.quantite,
	// 			c.millesime, 
	// 			b.id,
	// 			c.nom, 
	// 			b.types, 
	// 			b.image, 
	// 			b.code_saq, 
	// 			b.url_saq, 
	// 			c.pays, 
	// 			b.description,
	// 			t.types 
	// 				from bouteille__cellier c 
	// 				INNER JOIN vino__saq b ON c.id_bouteille_saq = b.id
	// 				INNER JOIN vino__types t ON t.id = b.types
	// 					'; 
	// 	if(($res = $this->_db->query($requete)) ==	 true)
	// 	{
	// 		if($res->num_rows)
	// 		{
	// 			while($row = $res->fetch_assoc())
	// 			{
	// 				$row['nom'] = trim(utf8_encode($row['nom']));
	// 				$rows[] = $row;
	// 			}
	// 		}
	// 	}
	// 	else 
	// 	{
	// 		throw new Exception("Erreur de requête sur la base de donnée", 1);
	// 		 //$this->_db->error;
	// 	}
		
		
		
	// 	return $rows;
	// }


	 /**
	  * Cette méthode permet de retourner une liste de bouteille par cellier sélectionné
	  * 
	   
	  * @param integer $id_cellier L'id du cellier'.
	  * 
	  * @throws Exception Erreur de requête sur la base de données 
	  * 
	  * @return array liste de bouteille du cellier
	  */
	
	public function getListeBouteilleCellierByCellier($id_cellier)
	{
		
		$rows = Array();
		$requete ='SELECT 
			c.id as id_bouteille_cellier,
				c.id_bouteille_saq, 
				c.date_achat, 
				c.garde_jusqua, 
				c.notes, 
				c.prix, 
				c.quantite,
				c.millesime, 
				b.id,
				c.nom, 
				b.types, 
				b.image, 
				b.code_saq, 
				b.url_saq, 
				c.pays, 
				b.description,
				t.types 
					from bouteille__cellier c 
					INNER JOIN vino__saq b ON c.id_bouteille_saq = b.id
					INNER JOIN vino__types t ON t.id = b.types
					INNER JOIN cellier l ON l.id_cellier = c.id_cellier
					WHERE l.id_cellier="' . $id_cellier . '"
						'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
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
	 * Cette méthode permet de retourner les résultats de recherche  des bouteilles dans le cellier
	 * 
	 * @param string $recherche La recherche de l'usager
	 * @param integer $id_cellier L'id du cellier'.
	 * @param string $userID Le username de l'usager.<
	 * @param string $categorie categorie de la recherche'.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
	public function getRechercheBouteille($categorie,$recherche,$userID, $idCellier)
	{
		$rows = Array();
		$categorie = $this->_db->real_escape_string($categorie);
		$recherche = $this->_db->real_escape_string($recherche);
		$userID = $this->_db->real_escape_string($userID);
		$idCellier = $this->_db->real_escape_string($idCellier);

		 // echo $userID;
		$requete ='SELECT 
		c.id as id_bouteille_cellier,
			c.id_bouteille_saq, 
			c.date_achat, 
			c.garde_jusqua, 
			c.notes, 
			c.prix, 
			c.quantite,
			c.millesime, 
			b.id,
			c.nom, 
			b.types, 
			b.image, 
			b.code_saq, 
			b.url_saq, 
			c.pays, 
			b.description,
			t.types 
				from bouteille__cellier c 
				JOIN vino__saq b ON c.id_bouteille_saq = b.id
				JOIN vino__types t ON t.id = b.types
				JOIN cellier ce ON ce.id_cellier = c.id_cellier
				JOIN usager u ON u.username = ce.id_user WHERE u.username = "'. $userID .'" AND c.'.$categorie.' LIKE "%'.$recherche.'%" AND ce.id_cellier = '.$idCellier; 
		if(($res = $this->_db->query($requete)) == true){
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					//var_dump($row);
					$rows[] = $row;
				}
			}	
		}
	//	var_dump($rows);
		return $rows;
	}



	/**
	 * Cette méthode permet de sortir tous les infos d'un cellier spécifique
	 * 
	 * @param integer $id le id d'un cellier
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array Tous les infos du cellier a ce ID spécifique
	 */
	public function getListeBouteilleCellierByIdCellier($id)
	{
		
		$rows = Array();
		$requete ='SELECT 
			c.id as id_bouteille_cellier,
				c.id_bouteille_saq, 
				c.date_achat, 
				c.garde_jusqua, 
				c.notes, 
				c.prix, 
				c.quantite,
				c.millesime, 
				b.id,
				c.nom, 
				b.types, 
				b.image, 
				b.code_saq, 
				b.url_saq, 
				c.pays, 
				b.description,
				t.types 
					from bouteille__cellier c 
					INNER JOIN vino__saq b ON c.id_bouteille_saq = b.id
					INNER JOIN vino__types t ON t.id = b.types
					INNER JOIN cellier l ON l.id_cellier = c.id_cellier
					INNER JOIN usager u ON u.username = l.id_user
					WHERE l.id_cellier="' . $id . '"
						'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
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
	 * Cette méthode permet de retourner les résultats de triage des bouteilles dans le cellier
	 * 
	 * @param string $recherche La recherche de l'usager
	 * @param integer $id_cellier L'id du cellier'.
	 * @param string $userID Le username de l'usager.<
	 * @param string $categorie categorie de la recherche'.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
	public function getTriBouteille($categorie,$ordre,$userID,$idCellier)
	{
		$rows = Array();
		$categorie = $this->_db->real_escape_string($categorie);
		$ordre = $this->_db->real_escape_string($ordre);
		$userID = $this->_db->real_escape_string($userID);
		$idCellier = $this->_db->real_escape_string($idCellier);


		$requete ='SELECT 
		c.id as id_bouteille_cellier,
			c.id_bouteille_saq, 
			c.date_achat, 
			c.garde_jusqua, 
			c.notes, 
			c.prix, 
			c.quantite,
			c.millesime, 
			b.id,
			c.nom, 
			b.types, 
			b.image, 
			b.code_saq, 
			b.url_saq, 
			c.pays, 
			b.description,
			t.types 
				from bouteille__cellier c 
				INNER JOIN vino__saq b ON c.id_bouteille_saq = b.id
				INNER JOIN vino__types t ON t.id = b.types 
				INNER JOIN cellier ce ON ce.id_cellier = c.id_cellier
				INNER JOIN usager u ON u.username = ce.id_user WHERE u.username = "'. $userID .'" AND ce.id_cellier = '.$idCellier .'
				ORDER BY '. $categorie . ' '.$ordre; 
		if(($res = $this->_db->query($requete)) == true){
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					//var_dump($row);
					$rows[] = $row;
				}
			}	
		}
	
		return $rows;
	}
 
	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
	public function autocomplete($nom, $nb_resultat=10)
	{
		
		$rows = Array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);

		
		$requete ="SELECT id, nom FROM vino__saq where LOWER(nom) like LOWER('%". $nom ."%') LIMIT 0,". $nb_resultat; 
		 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
					
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de données", 1);
			 
		}
		
		
		
		return $rows;
	}
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier qui ne provient pas de la SAQ.
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterNouvelleBouteilleNonLister($nom,$date_achat,$garde_jusqua,$pays,$notes,$prix,$types,$quantite,$millesime,$idCellier,$nomFichier)
	{
		//TODO : Valider les données.
		//var_dump($data);	

		$requete = "INSERT INTO vino__saq(image,types) VALUES (".
		"'".$nomFichier."',".	
		"'".$types."')";
		$res = $this->_db->query($requete);
		var_dump($res);
		$requete2 = "SET @last_id_in_vino__saq = LAST_INSERT_ID()";
		$res2 = $this->_db->query($requete2);
		var_dump($res2);

		$requete3 = "INSERT INTO bouteille__cellier(id_bouteille_saq,date_achat,garde_jusqua,nom, pays,notes,prix,types,quantite,millesime,id_cellier) 
		VALUES (@last_id_in_vino__saq,".
		"'".$date_achat."',".
		"'".$garde_jusqua."',".
		"'".$nom."',".
		"'".$pays."',".
		"'".$notes."',".
		"'".$prix."',".
		"'".$types."',".
		"'".$quantite."',".
		"'".$millesime."',".
		"'".$idCellier."');";
		$res3 = $this->_db->query($requete3);
		var_dump($res3);

		return $res3;
	}
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	 public function ajouterNouvelleBouteilleSaq($idSaq,$date_achat,$garde_jusqua,$nom,$pays,$notes,$prix,$types,$quantite,$millesime,$idCellier)
	{
		
		//var_dump($data);	
		
		$requete = "INSERT INTO bouteille__cellier(id_bouteille_saq,date_achat,garde_jusqua,nom, pays,notes,prix,types,quantite,millesime,id_cellier) VALUES (".
		"'".$idSaq."',".
		"'".$date_achat."',".
		"'".$garde_jusqua."',".
		"'".$nom."',".
		"'".$pays."',".
		"'".$notes."',".
		"'".$prix."',".
		"'".$types."',".
		"'".$quantite."',".
		"'".$millesime."',".
		"'".$idCellier."')";
		//var_dump($requete);
        $res = $this->_db->query($requete);
        
		return $res;
	}
	
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
					
		$requete = "UPDATE bouteille__cellier SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE id = ". $id;
		//echo $requete;
        $res = $this->_db->query($requete);
        
		return $res;
	}
	/**
	 * Cette méthode met à jour une certaine bouteille qui a été modifié
	 * 
	 * @param void $data void reçoit tous les paramètres en GET du formulaire de modification
	 * 
	 * @return Boolean Succès ou échec de la modification.
	 */
	public function ModifBouteille($data)
	{
		//$erreur = "";

		//Doit refaire les validations
		/*if(strlen($data['nom'] > 40) || strlen($data['notes'] > 40) || strlen($data['pays'] > 40)){
			$erreur += "Un de vos champs contient trop de caractères<br>";
		}
		
		if(!is_numeric($data['millesime']) || !is_numeric($data['quantite']) || !is_numeric($data['prix'])){
			$erreur += "Veuillez entrez une valeur numérique dans les champs millesime/quantité et prix<br>";
		}

		//Si il y a des erreurs
		if($erreur !== ""){
			return $erreur;
		}
		else{*/
			$requete = "UPDATE bouteille__cellier
			SET
			nom = '". $data['nom'] ."',
			millesime = ". $data['millesime'] .",
			quantite = ". $data['quantite'] .",
			date_achat = '". $data['date_achat'] ."',
			garde_jusqua = '". $data['garde_jusqua'] ."',
			prix = ". $data['prix'] .",
			notes = '". $data['notes'] ."',
			pays = '". $data['pays'] ."'
			WHERE id =" .$data['id'];

			$res = $this->_db->query($requete);
			
			return $res;
		}
	

	/**
	 * Cette méthode nous donne tous les infos d'une bouteille spécifique
	 * 
	 * @param int $id est l'id de la bouteille en question
	 * 
	 * @return void le résultat de la requête
	 */
	public function bouteilleParId($id)
	{
		$requete = "SELECT * FROM `bouteille__cellier` WHERE id =". $id;
        $res = $this->_db->query($requete); 
		return $res;
	}
	/**
	 * Cette méthode permet de créer un cellier pour un certain usager
	 * 
	 * @param string $nom nom du cellier
	 * @param string $username username de l'usager
	 * 
	 * 
	 * @return void résultat de la requête
	 */
	public function AjoutCellier($nom, $username)
	{
		$requete = "INSERT INTO cellier (id_user,nom) VALUES ('" . $username . "','" .  $nom . "')";
		//var_dump($requete);
        $res = $this->_db->query($requete); 
		return $res;
	}
	/**
	 * Cette méthode permet de trouver tous infos d'un cellier d'un usager spécifique
	 * 
	 * @param string $username de  l'usager
	 * 
	 * 
	 * @return array retourne tous les infos des celliers
	 */
	public function cellierParUsager($username)
	{
		$requete = "SELECT * from cellier where id_user = '" . $username . "'";
		$res = $this->_db->query($requete); 
		return $res;
	}

	/**
	 * Méthode qui supprime un cellier à l'aide du ID envoyé en paramètre
	 * 
	 * @param string $id = Id du cellier
	 * 
	 * 
	 * @return array retourne true ou false comme résultat de requête
	 */
	public function SuppressionCellier($id)
	{
		$requete = "DELETE FROM cellier WHERE id_cellier ='" . $id . "'";
		$res = $this->_db->query($requete); 
		return $res;
	}

	/**
	 * Méthode qui ajoute une bouteille sur la liste d'achat de l'usager
	 * 
	 * @param string $idUser = nom d'utilisateur de l'usager
	 * 
	 * @param int $id_bouteille_cellier = id de la bouteille
	 * 
	 * @return bool retourne true ou false comme résultat de requête
	 */

	public function ajoutListeAchat($id_bouteille_cellier, $idUser)
	{
		$requete = "INSERT INTO listeAchat VALUES ($id_bouteille_cellier , '". $idUser ."')";

		$res = $this->_db->query($requete); 

		return $res;

	}

	/**
	 * Méthode qui supprime une bouteille de la liste d'achat
	 * 
	 * @param string $idUser = nom d'utilisateur de l'usager
	 * 
	 * @param int $id_bouteille_cellier = id de la bouteille
	 * 
	 * @return array retourne true ou false comme résultat de requête
	 */
	public function retraitListeAchat($idUser, $id_bouteille_cellier)
	{
		$requete = "DELETE FROM listeAchat WHERE id_bouteille_cellier ='" . $id_bouteille_cellier . "' AND id_user = '". $idUser ."'";

		$res = $this->_db->query($requete); 

		return $res;
	}

	/**
	 * Cette méthode permet de sortir la liste d'achat d'un usager
	 *
	 * 
	 * @return array Tous les infos du cellier a ce ID spécifique
	 */

	 public function listeAchatParUsager($idUser) 
	 {
		$requete = "SELECT * FROM bouteille__cellier b 
		JOIN listeAchat ON b.id = listeAchat.id_bouteille_cellier
		JOIN vino__saq v ON b.id_bouteille_saq = v.id 
		WHERE listeAchat.id_user = '". $idUser."'";

		$res = $this->_db->query($requete); 

		return $res;
	 }
}




?>