<?php            
        if(isset($_SESSION["UserID"])){

        
                echo "<div class='cellier column--center'>
                    <section class='row--center' id='choix-cellier'>
                    <form action='index.php' method='GET'>
            <input type='hidden' name='requete' value='SelectionCellier'/>
            <select name='id'>";
            foreach ($data as $cle => $celli){
                echo "<option value='" . $celli['id_cellier'] . "'";
                if(isset($_GET['id']) && ($_GET['id'] == $celli['id_cellier'])){
                     echo "selected";
                } 
                echo ">" .$celli['nom']. "</option>";
            }
            echo "</select><input type='submit' value='Choisir cellier'></form></section>";
                      echo "<section class='cellier-header column--center'><section id='triage' class='row--center'>
                            <form class='filtre row--center' action='?requete=triBouteille' method='POST'>
                                <p> Trier:</p>
                                <select name='categorie' class='categorieBouteille'>
                                    <option value='nom'>Nom</option>
                                    <option value='prix'>Prix</option>
                                    <option value='types'>Type de vin</option>
                                    <option value='quantite'>Quantité</option>
                                    <option value='millesime'>Millesime</option>
                                    <option value='pays'>Pays</option>
                                </select>
                <select name='ordre' class='ordre'>
				<option value='ASC'>Croissant</option>
				<option value='DESC'>Décroissant</option>				
			    </select>
            <input type='submit' value='filtre' />
            </form>
            </section>
            <section id='recherche' class='row--center'>    
            <form class='filtre row--center' action='index.php?requete=rechercheBouteille' method='POST'>
            <select name='categorie' class='categorieBouteille'>
                <option value='nom'>Nom</option>
                <option value='prix'>Prix</option>
                <option value='types'>Type de vin</option>
                <option value='quantite'>Quantité</option>
                <option value='millesime'>Millesime</option>
                <option value='pays'>Pays</option>
            </select>
            
                <input type='text' name='recherche'>
                <input type='submit' value='recherche' />
                 </form></section>
            </section>
            ";


            if(empty($data1)){
                echo "<div>
                    <h1> Ce cellier est vide </h1>
                </div>";   
            }
            if(isset($_SESSION["idCell"]))
            {
                $trouver = false;
                 echo " <a id='ajouterBouteilleCellier' href='?requete=ajouterNouvelleBouteilleCellier'>Ajouter une bouteille au cellier</a>";

    foreach ($data1 as $cle => $bouteille) {
 
        if($bouteille["code_saq"] == NULL){
            echo    "<div class='bouteille column--center' data-quantite='' data-id='" . $bouteille['id_bouteille_cellier'] . "'>
            <img class='bouteille--img' src='" . $bouteille['image'] . "'>

            <h1>" . 
                 $bouteille['nom'] . "
            </h1>
            <button class='voir-plus'>Voir plus</button>
            <div class='description column--center'>
                <p class='nom'>Nom :" . 
                    $bouteille['nom'] . "
                </p>
                <p class='quantite'>Quantité : <strong class='int'>" . $bouteille['quantite'] . "</strong></p>
                <p class='pays'>Pays :" . 
                    $bouteille['pays'] . "
                </p>
                <p class='type'>Type :" . 
                    $bouteille['types'] . "
                </p>
                <p class='millesime'>Millesime :" . 
                   $bouteille['millesime'] . "
                </p>
                <p class='prix'>Prix :" . 
                    $bouteille['prix'] . "
                </p>
                <p class='notes'>Notes :" . 
                    $bouteille['notes'] . "
                </p>

            </div>
            <div class='options' data-id='" . $bouteille['id_bouteille_cellier'] . "'>
                <button class='btnModif'>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>";
                 if(empty($dataListeAchat)){
                    echo "<button class='btnListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Ajout à la liste d'achat</button>";
                    
                } else {
                    foreach($dataListeAchat as $cle => $bouteilleListe){
                        if($bouteille['id_bouteille_cellier'] == $bouteilleListe['id_bouteille_cellier']){
                            $trouver = true;
                        }
                    }
                    if($trouver){
                        echo "<button class='btnRetraitListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Retrait de la liste d'achat</button>";

                    } else {
                        echo "<button class='btnListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Ajout à la liste d'achat</button>";

                    }
                }
                echo "</div>
			
        </div>
        "; 

        }else{
        echo    "<div class='bouteille column--center' data-quantite='' data-id='" . $bouteille['id_bouteille_cellier'] . "'>
            <img class='bouteille--img' src='https:" . $bouteille['image'] . "'>

            <h1>" . 
                 $bouteille['nom'] . "
            </h1>
            <button class='voir-plus'>Voir plus</button>
            <div class='description column--center'>
                <p class='nom'>Nom :" . 
                    $bouteille['nom'] . "
                </p>
                <p class='quantite'>Quantité : <strong class='int'>" . $bouteille['quantite'] . "</strong></p>
                <p class='pays'>Pays :" . 
                    $bouteille['pays'] . "
                </p>
                <p class='type'>Type :" . 
                    $bouteille['types'] . "
                </p>
                <p class='millesime'>Millesime :" . 
                   $bouteille['millesime'] . "
                </p>
                <p class='prix'>Prix :" . 
                    $bouteille['prix'] . "
                </p>
                <p class='notes'>Notes :" . 
                    $bouteille['notes'] . "
                </p>

                <p><a href='" . $bouteille['url_saq'] . "'>Voir SAQ</a></p>
            </div>
            <div class='options' data-id='" . $bouteille['id_bouteille_cellier'] . "'>
                <button class='btnModif'>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>";
                
                if(empty($dataListeAchat)){
                    echo "<button class='btnListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Ajout à la liste d'achat</button>";
                    
                } else {
                    foreach($dataListeAchat as $cle => $bouteilleListe){
                        if($bouteille['id_bouteille_cellier'] == $bouteilleListe['id_bouteille_cellier']){
                            $trouver = true;
                        }
                    }
                    if($trouver){
                        echo "<button class='btnRetraitListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Retrait de la liste d'achat</button>";

                    } else {
                        echo "<button class='btnListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Ajout à la liste d'achat</button>";

                    }
                }
                echo "</div>
			
        </div>
        ";  }   
        
            }
    
        }
   
    }
    else{
        echo "<div><h1>Connectez-vous pour avoir accès à votre cellier</h1></div>";
    }
    ?>
