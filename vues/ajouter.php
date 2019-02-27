<div class="ajouter">
<h2>Si la bouteille ne provient pas de la SAQ. <a title="form ajout" href="index.php?requete=ajouterNouvelleBouteilleCellierNonLister" >Cliquez-ici</a></h2>

    <div class="nouvelleBouteille" vertical layout>
        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
            <div>
          
            <form action="index.php?requete=ajouterNouvelleBouteilleSaq" method="POST">
                <p>Nom : <span data-id="" class="nom_bouteille" ></span></p>
                <input type="hidden" name="nom" />
                <p>Millesime : <input name="millesime" value="2010"></p>
                <p>Quantite : <input name="quantite" value="1"></p>
                <p>Date achat : <input name="date_achat" value="1"></p>
                <p>Pays : <input name="pays" value="Canada"></p>
                <p>Prix : <input name="prix" value="111" ></p>
                <p>Choisir le cellier 
                        <select name='celly'>
                        <?php
                        foreach ($resultat as $cle => $celli){
                        echo "<option value='" . $celli['id_cellier'] . "'";
                        echo ">" .$celli['nom']. "</option>";
                        }
                        ?>
                        </select></p>
                <p>Couleur du vin
                        <select name='types'>
                            <option value="1">Rouge</option>
                            <option value="2">Blanc</option>
                            <option value="3">Rosé</option>
                        </select></p>
                <p>Garde : <input name="garde_jusqua" value="1 ans" ></p>
                <p>Notes <input name="notes" value="tata" ></p>
                <input type="hidden" name="idSaq"/>
                

            <button type="submit">Ajouter la bouteille</button>
            </form>
            </div>
        </div>
    </div>
</div>
