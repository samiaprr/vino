<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			if(!(isset($_SESSION['UserID'])) && $_GET['requete'] != "FormSignup" && $_GET['requete'] != "FormLogin" && $_GET['requete'] != "signup" && $_GET['requete'] != "login"){
				
				$this->accueil();
			}else{
			switch ($_GET['requete']) {
				case 'listeBouteille':
					$this->listeBouteille();
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterNouvelleBouteilleSaq':
					$this->ajouterNouvelleBouteilleSaq();
					break;
				case 'ajouterNouvelleBouteilleCellierNonLister':
					$this->ajouterNouvelleBouteilleCellierNonLister();
				break;					
				case 'ajouterBouteilleCellier':
					$this->ajouterBouteilleCellier();
					break;
				case 'ModificationFormulaire':
					$this->FormModif();
					break;
				case 'ModifBouteille':
					$this->ModifBouteille();
					break;
				case 'boireBouteilleCellier':
					$this->boireBouteilleCellier();
					break;
				case 'FormSignup':
					$this->FormSignup();
					break;
				case 'FormLogin':
					$this->FormLogin();
					break;
				case 'FormModifyAccount':
					$this->FormModifyAccount();
					break;		
				case 'signup':
					$this->signup($_GET['username'],$_GET['password']);
					//$this->accueil();
					break;
				case 'login':
					$this->login($_GET['username'],$_GET['password']);
					break;
				case 'updateUser':
					$this->updateUser($_GET['username'],$_GET['password']);
					break;
				case 'updateCellierNom':
					$this->updateCellierNom($_GET['id_cellier'],$_GET['nom']);
					break;
				case "Logout":
					$this->Logout();
					$this->accueil();
					break;

				case 'getCellierNom':
					$this->getCellierNom($_GET['username']);
					break;
				case 'monCellier':
					$this->monCellier();
					break;

                case 'choissirCellier':
					$this->choissirCellier($_GET['id_cellier']);
					break;
					
				case "FormCellier":
					$this->formAjoutCellier($_GET['User']);
					break;
				case "AjoutCell":
					$this->AjoutCell($_GET['nom'],$_GET['username']);
					break;			
				case 'triBouteille':
				//	var_dump($_POST["categorie"]);
				//	var_dump($_POST["ordre"]);
					$this->triBouteille();
					break;
				case 'rechercheBouteille':
					//	var_dump($_POST["categorie"]);
					//	var_dump($_POST["ordre"]);
					$this->rechercheBouteille();
					break;
				case 'SelectionCellier':
					$this->SelectCellier($_GET['id']);
					break;
				case 'SuppressionCellier':
					$this->SuppressionCellier($_GET['Id']);
					break;
				case 'ajoutListeAchat':
						$this->ajoutListeAchat();
					break;
				case 'voirListeAchat':
					$this->afficheListeAchatParUsager();
					break;
				case 'retirerListeAchat':
						$this->retirerListeAchat();
				break;
				case 'ajouterBouteilleNonLister':
					$this->ajouterBouteilleNonLister();
					break;
				default:
					$this->accueil();
					break;
			}
		}
	}

	private function ajouterBouteilleNonLister()
	{
		var_dump($_POST);
		var_dump($_FILES['fichier']);
		if (isset($_POST["submit"])) {
            $repertoire = "images/";
            //vous pouvez changer le nom du fichier si vous voulez, ici
            $nomFichier = $repertoire . $_SESSION["UserID"]. basename($_FILES["fichier"]["name"]);
            $uploadOk = true;
            $imageType = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fichier"]["tmp_name"]);
            if ($check !== false) {
                echo "Le fichier est une image - " . $check["mime"] . ".";
                $uploadOk = true;
            } else {
                echo "Le fichier n'est pas une image.";
                $uploadOk = false;
            }


            // Vérifier la taille du fichier
            if ($_FILES["fichier"]["size"] > 5000000) {
                echo "Le fichier est trop gros.";
                $uploadOk = false;
            }

            // Vérifier le type du fichier
            if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
                && $imageType != "gif") {
                echo "Désolé, les extensions acceptées sont jpg, png, jpeg et gif.";
                $uploadOk = false;
            }


            // S'il y a erreur, donner un msg d'erreur.
            if ($uploadOk == false) {
                echo "Upload impossible.";
                // if everything is ok, try to upload file
			} 
				var_dump($nomFichier);
            if (file_exists($nomFichier)) {
                echo "Le fichier existe déjà.";
				$uploadOk == false;
				$bte = new Bouteille();
				$data = $bte->cellierParUsager($_SESSION['UserID']);
				//var_dump($_POST);
				$data1 = $bte->ajouterNouvelleBouteilleNonLister($_POST["nom_bouteille"],$_POST["date_achat"],$_POST["garde_jusqua"],$_POST["pays"],$_POST["notes"],$_POST["prix"],$_POST["types"],$_POST["quantite"],$_POST["millesime"],$_SESSION["idCell"],$nomFichier);
				//var_dump($data1);
				header('Location: index.php?requete=monCellier');
            }
			else {
                if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $nomFichier)) {
                    echo "Le fichier " . $nomFichier . " a été téléchargé.";
                    $bte = new Bouteille();
				$data = $bte->cellierParUsager($_SESSION['UserID']);
				//var_dump($_POST);
				$data1 = $bte->ajouterNouvelleBouteilleNonLister($_POST["nom_bouteille"],$_POST["date_achat"],$_POST["garde_jusqua"],$_POST["pays"],$_POST["notes"],$_POST["prix"],$_POST["types"],$_POST["quantite"],$_POST["millesime"],$_SESSION["idCell"],$nomFichier);
				header('Location: index.php?requete=monCellier');




                } else {
                    echo "Erreur d'upload.";
                }
            }

        }
	}
		private function SuppressionCellier()
		{
			$bte = new Bouteille();
			$bte->SuppressionCellier($_GET['Id']);
		}

		private function rechercheBouteille()
		{

			$bte = new Bouteille();
			$data = $bte->cellierParUsager($_SESSION['UserID']);
			$data1 = $bte->getRechercheBouteille($_POST["categorie"],$_POST["recherche"],$_SESSION['UserID'],$_SESSION["idCell"]);
			// var_dump($data1);
			include("vues/entete.php");
			include("vues/cellierRecherche.php");
			include("vues/pied.php");
		}

		private function SelectCellier($id)
		{
			if(isset($_SESSION["UserID"])){
				$username = $_SESSION["UserID"];
				$_SESSION["idCell"] = $id;
				$bte = new Bouteille();
				$data1 = $bte->getListeBouteilleCellierByIdCellier($id);
				$data = $bte->cellierParUsager($username);
				$dataListeAchat = $bte->listeAchatParUsager($username);
				
				include("vues/entete.php");
				include("vues/cellier.php");
				include("vues/pied.php");
			}
			else{
				//Si la personne n'est pas connecté
				$this->FormLogin();
			}
                  

		}
	/*	private function ajouterBouteilleNonLister()
		{
			// var_dump($_SESSION["UserID"]);
			if(isset($_SESSION["UserID"])){
				var_dump($_POST['ajouterBouteilleCellier']);
				var_dump($_POST['fichier']);

				//$bte = new Bouteille();
				//$data = $bte->cellierParUsager($_SESSION['UserID']);
				//var_dump($_POST);
				//$data1 = $bte->ajouterNouvelleBouteilleSaq($_POST["idSaq"],$_POST["date_achat"],$_POST["garde_jusqua"],$_POST["nom"],$_POST["pays"],$_POST["notes"],$_POST["prix"],$_POST["types"],$_POST["quantite"],$_POST["millesime"],$_SESSION["idCell"]);
				//var_dump($data1);
				//header('Location: index.php?requete=monCellier');
			}else{
				//$this->monCellier();
			}
		}
		*/

		private function ajouterNouvelleBouteilleSaq()
		{
			var_dump($_SESSION["UserID"]);
			if(isset($_SESSION["UserID"])){
				//var_dump($_POST);
				$bte = new Bouteille();
				$data = $bte->cellierParUsager($_SESSION['UserID']);
				//var_dump($_POST);
				$data1 = $bte->ajouterNouvelleBouteilleSaq($_POST["idSaq"],$_POST["date_achat"],$_POST["garde_jusqua"],$_POST["nom"],$_POST["pays"],$_POST["notes"],$_POST["prix"],$_POST["types"],$_POST["quantite"],$_POST["millesime"],$_SESSION["idCell"]);
				//var_dump($data1);
				header('Location: index.php?requete=monCellier');
			}else{
				$this->monCellier();
			}
		}

		private function triBouteille()
		{
			if(isset($_SESSION["UserID"])){
				$bte = new Bouteille();
				$data = $bte->cellierParUsager($_SESSION['UserID']);
				// var_dump($_SESSION);
				$data1 = $bte->getTriBouteille($_POST["categorie"],$_POST["ordre"], $_SESSION['UserID'], $_SESSION["idCell"]);
				include("vues/entete.php");
				include("vues/cellier.php");
				include("vues/pied.php");
			}else{
				$this->monCellier();
			}
		}

		private function accueil()
		{
			//var_dump($_SESSION);
			//Si la personne est connecté
			if(isset($_SESSION["UserID"])){
				$username = $_SESSION["UserID"];
				$bte = new Bouteille();
				$data = $bte->cellierParUsager($_SESSION['UserID']);
				include("vues/entete.php");
				include("vues/choisirCellier.php");
				include("vues/pied.php");
			}
			else{
				//Si la personne n'est pas connecté
				$this->FormLogin();
			}
                 
		}

		
		private function monCellier()
		{
			$bte = new Bouteille();
			$username = $_SESSION["UserID"];
			if(isset($_SESSION["idCell"])){
				$id_cellier = $_SESSION["idCell"];
				//var_dump($id_cellier);
				//var_dump($_SESSION["idCell"]);
				$data = $bte->cellierParUsager($username);
				$data1 = $bte->getListeBouteilleCellierByIdCellier($id_cellier);

			}else{
				$data = $bte->cellierParUsager($username);
				 $data1 = $bte->getListeBouteilleCellier();
				
			}
			
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}
		
		

		private function formAjoutCellier()
		{
			include("vues/entete.php");
			include("vues/formAjoutCellier.php");
			include("vues/pied.php");     
		}

		private function AjoutCell()
		{
			$bte = new Bouteille();
			$data = $bte->AjoutCellier($_GET['nom'],$_GET['username']);
			$this->accueil();
			// a changer lorsque qu'on mettera en live
			//header("Location: http://localhost/TestPush/vino/");
			
		}


		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();
            
            echo json_encode($cellier);
                  
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}

		private function FormModif()
		{		
			$bte = new Bouteille();
			$infos = $bte->bouteilleParId($_GET['Id']);
			include("vues/entete.php");
			include("vues/modif.php");
			include("vues/pied.php");		

		}
		private function ajouterNouvelleBouteilleCellierNonLister()
		{	

				$bte = new Bouteille();
				$resultat = $bte->cellierParUsager($_SESSION["UserID"]);
				include("vues/entete.php");
				include("vues/ajouterNonLister.php");
				include("vues/pied.php");
			
			 
		}
		private function ajouterNouvelleBouteilleCellier()
		{	
			// echo $_SESSION['id_cellier'];
			$body = json_decode(file_get_contents('php://input'));
			// var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				//var_dump($_POST['data']);
				
				//var_dump($data);
				$resultat = $bte->ajouterBouteilleCellier($body,$_SESSION['id_cellier']);
				echo json_encode($resultat);
			}
			else{
				$bte = new Bouteille();
				$resultat = $bte->cellierParUsager($_SESSION["UserID"]);
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
			 
		}

		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}

		private function ModifBouteille()
		{
			$bte = new Bouteille();
			$resultat = $bte->ModifBouteille($_POST);
			
			if (isset($erreur)) {
				$this->FormModif($erreur);
			}
			else{
				$this->SelectCellier($_POST['id']);
			}
			
		}

		private function ajoutListeAchat()
		{
			$idUser = $_SESSION["UserID"];

			$body = json_decode(file_get_contents('php://input'));

			$id_bouteille_cellier = $body->id_bouteille_cellier;

			$bte = new Bouteille();

			$resultatAjoutListeAchat = $bte->ajoutListeAchat($id_bouteille_cellier, $idUser);

			echo json_encode($resultatAjoutListeAchat);

			return $resultatAjoutListeAchat;

		}

		private function retirerListeAchat()
		{
			$idUser = $_SESSION["UserID"];

			$body = json_decode(file_get_contents('php://input'));

			$id_bouteille_cellier = $body->id_bouteille_cellier;

			$bte = new Bouteille();

			$resultatRetraitListeAchat = $bte->retraitListeAchat($idUser, $id_bouteille_cellier);

			echo json_encode($resultatRetraitListeAchat);

			return $resultatRetraitListeAchat;
		}

		private function afficheListeAchatParUsager()
		{
			$idUser = $_SESSION["UserID"];

			$bte = new Bouteille();

			$dataListeAchat = $bte->listeAchatParUsager($idUser);

			include("vues/entete.php");
			include("vues/listeAchat.php");
			include("vues/pied.php");

			
		}

        private function FormSignup()
        {
			include("vues/entete.php");
			include("vues/FormSignup.php");
			include("vues/pied.php");
        }		
		private function signup($username,$password)
		{
            $u = new User();
			$resultat = $u->getUserByUsername($username);
            
            if(!$resultat){
				$passwordEncrypte = password_hash($password, PASSWORD_DEFAULT);
				$res = $u->insertUser($username,$passwordEncrypte);
				//$res = $u->insertUser($username,$password);
                if($res){
					$this->creeCellier($username);
                    echo json_encode('Signup Success!');
                }else{
                     echo json_encode($res);
                }
            }else
            {
                echo json_encode('Username already Signup');
            }
            //$resultat = $u->getAllUser();
            
			//echo json_encode($resultat);
            /*
			echo 'signup' . $username . ' ' . $password;
			if(trim($username) != "" && trim($password) != "")
			{
				 $passwordEncrypte = password_hash($password, PASSWORD_DEFAULT);
				//insérer dans la BD
				//InsertUser($_POST["username"],$passwordEncrypte);
				echo $passwordEncrypte;
			}
			else
			{
				echo 'Signup error';
			}*/
		}

        private function creeCellier($username)
        {
			$c = new Cellier();
			$resultat = $c->insertCellier($username);
		
        }
		
		private function getCellierNom($username)
        {
			$c = new Cellier();
			$donnees["celliers"] = $c->getCellierByUsername($username);

			foreach($donnees["celliers"]  as $c)
			{
				echo "<option value='{$c['id_cellier']}'>{$c['nom']}</option>";
			
			}
			
        }
		
        private function FormLogin()
        {
			include("vues/entete.php");
			include("vues/FormLogin.php");
			include("vues/pied.php");
        }

        private function FormModifyAccount()
        {
			include("vues/entete.php");
			include("vues/FormModifyAccount.php");
			include("vues/pied.php");
        }		
		
        private function choissirCellier($id_cellier)
        {
					
					$c = new Cellier();
					$donnees["celliers"] = $c->getCellierByid_cellier($id_cellier);

					foreach($donnees["celliers"]  as $c)
					{
						$_SESSION["id_cellier"] =$c['id_cellier'];
						$_SESSION["cellier_nom"] =$c['nom'];
					}
					

					echo ($c['nom']);    
                   
            
        }
    
		private function login($username,$password)
		{
			$u = new User();
			$resultat = $u->getUserByUsername($username);
            
            if(!$resultat){
    
                echo json_encode('Username pas correct!');

            }else
            {

				
				//if (password_verify($password, $hash)) {
					if (password_verify($password, $resultat['password'])) {
						// Pass
						$c = new Cellier();
					$donnees["celliers"] = $c->getCellierByUsername($username);

					foreach($donnees["celliers"]  as $c)
					{
						$_SESSION["id_cellier"] =$c['id_cellier'];
						$_SESSION["cellier_nom"] =$c['nom'];
					}
					
					$_SESSION["UserID"] = $username;
					echo json_encode('true');
						
					}
					else {
						echo json_encode('Password pas correct!');
						// Invalid
					}
			/*
			if($resultat['password'] != $password){
					echo json_encode('Password pas correct!');
				}else{
					
					$c = new Cellier();
					$donnees["celliers"] = $c->getCellierByUsername($username);

					foreach($donnees["celliers"]  as $c)
					{
						$_SESSION["id_cellier"] =$c['id_cellier'];
						$_SESSION["cellier_nom"] =$c['nom'];
					}
					
					$_SESSION["UserID"] =$username;
					echo json_encode('true');
				}*/
            }
			
		}
		
		private function updateUser($username,$password)
		{
			$u = new User();
			$resultat = $u->updateUser($username,$password);
            
            if(!$resultat){
    
                echo json_encode('Username pas correct!');
				  

            }else
            {

					
				echo json_encode('true');
			
            }
			
			
		}
		
		private function updateCellierNom($id_cellier,$nom)
		{
			$c = new Cellier();
			$resultat = $c->updateCellierNom($id_cellier,$nom);
            
            if(!$resultat){
    
                echo json_encode('Username pas correct!');
				  

            }else
            {

					
				echo json_encode('true');
			
            }
			
			
		}		
		
		private function Logout(){
			// Détruit toutes les variables de session
			$_SESSION = array();

			// Si vous voulez détruire complètement la session, effacez également
			// le cookie de session.
			// Note : cela détruira la session et pas seulement les données de session !
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}

			// Finalement, on détruit la session.
		//	session_destroy();
			
			
		}

		
}
?>















