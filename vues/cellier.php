<?php            
        if(isset($_SESSION["UserID"])){

        
                echo "<div class='cellier column--center'>
                        <section class='cellier-header row--center'>
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
            <section>    
            <form class='filtre column--center' action='index.php?requete=rechercheBouteille' method='POST'>
            <p> Recherche :</p>
            <select name='categorie' class='categorieBouteille'>
                <option value='nom'>Nom</option>
                <option value='prix'>Prix</option>
                <option value='types'>Type de vin</option>
                <option value='quantite'>Quantité</option>
                <option value='millesime'>Millesime</option>
                <option value='pays'>Pays</option>
            </select>
            <fieldset class='row--center'>
                <input type='text' name='recherche'>
                <input type='submit' value='recherche' />
            </fieldset>
        </form></section>
            <section>
            <h3> Vos celliers </h3>
            <ul>";
            foreach ($data as $cle => $celli){
                echo "<li><a href='index.php?requete=SelectionCellier&id=" . $celli['id_cellier'] . "'>" . $celli['nom']. "</a></li>";
            }
            echo "</ul></section>";
        
    foreach ($data1 as $cle => $bouteille) {
 
    
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

                <p><a href='" . $bouteille['url_saq'] . "'>Voir SAQ</a></p>
            </div>
            <div class='options' data-id='" . $bouteille['id_bouteille_cellier'] . "'>
                <button class='btnModif'>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>

            </div>
			
        </div>
        ";     
        }
    }
    else{
        echo "<div><h1>Connectez-vous pour avoir accès à votre cellier</h1></div>";
    }
    ?>
