<div class="ajouter">

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
                <p>Type de vin : <input name="types" value="1"></p>
                <p>Pays : <input name="pays" value="Canada"></p>
                <p>Prix : <input name="prix" value="111" ></p>
                <p>Garde : <input name="garde_jusqua" value="1 ans" ></p>
                <p>Notes <input name="notes" value="tata" ></p>
                <input type="hidden" name="idSaq" />

            <button type="submit"  name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            </form>
            </div>
        </div>
    </div>
</div>
