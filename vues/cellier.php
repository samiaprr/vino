<div class="cellier column--center">
    <section class="cellier-header row--center">
        <form class="filtre row--center" action="?requete=triBouteille" method="POST">
            <p> Trier:</p>
            <select name="categorie" class="categorieBouteille">
				<option value="nom">Nom</option>
				<option value="prix">Prix</option>
				<option value="types">Type de vin</option>
				<option value="quantite">Quantité</option>
				<option value="millesime">Millesime</option>
				<option value="pays">Pays</option>

			</select>

            <select name="ordre" class="ordre">
				<option value="ASC">Croissant</option>
				<option value="DESC">Décroissant</option>				
			</select>
            <input type="submit" value="filtre" />
        </form>
    </section>
    <?php
foreach ($data as $cle => $bouteille) {
 
    ?>
        <div class="bouteille column--center" data-quantite="" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
            <img class="bouteille--img" src="https:<?php echo $bouteille['image'] ?>">

            <h1>
                <?php echo $bouteille['nom'] ?>
            </h1>
            <button class="voir-plus">Voir plus</button>
            <div class="description column--center">
                <p class="nom">Nom :
                    <?php echo $bouteille['nom'] ?>
                </p>
                <p class="quantite">Quantité : <strong class="int"><?php echo $bouteille['quantite'] ?></strong></p>
                <p class="pays">Pays :
                    <?php echo $bouteille['pays'] ?>
                </p>
                <p class="type">Type :
                    <?php echo $bouteille['types'] ?>
                </p>
                <p class="millesime">Millesime :
                    <?php echo $bouteille['millesime'] ?>
                </p>
                <p class="prix">Prix :
                    <?php echo $bouteille['prix'] ?>
                </p>

                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
            </div>
            <div class="options" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                <button class='btnModif'>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>

            </div>
        </div>
        <?php


}

?>
</div>
