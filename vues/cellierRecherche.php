<?php            
        if(isset($_SESSION["UserID"])){

        
                echo "
                <section class='cellier-header column--center'>
            <section id='recherche' class='row--center' >    
            <form  class='filtre row--center' action='index.php?requete=rechercheBouteille' method='POST'>
            <select name='categorie' class='categorieBouteille'>
                <option value='nom'>Nom</option>
                <option value='prix'>Prix</option>
                <option value='types'>Type de vin</option>
                <option value='quantite'>Quantité</option>
                <option value='millesime'>Millesime</option>
                <option value='pays'>Pays</option>
            </select>
            <input type='text' name='recherche'/>
            <input type='submit' value='recherche' />
        </form></section></section> 

        <h1>Résultat de votre recherche</h1>
            ";
        
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
                <button class='btnBoire'>Boire</button>

            </div>
			
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
                <button class='btnBoire'>Boire</button>

            </div>
			
        </div>
        ";  }   
        }
    }
    else{
        echo "<div><h1>Connectez-vous pour avoir accès à votre cellier</h1></div>";
    }
    ?>
