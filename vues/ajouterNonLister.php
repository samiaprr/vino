<div class="ajouter">
    <div class="nouvelleBouteille" vertical layout>

            <div>
          
            <form action="index.php?requete=ajouterBouteilleNonLister" method="POST" enctype="multipart/form-data">
                <p>Nom : <input name="nom_bouteille" value="Test"></p>
				<label>Sélectionnez une image :</label>
                <input type="file" name="fichier">

                <p>Millesime : <input name="millesime" value="2010"></p>
                <p>Quantite : <input name="quantite" value="1"></p>
                <p>Date achat : <input name="date_achat" value="1"></p>
                <p>Type de vin : 
                                <select name='types' class='types'>
                                    <option value='1' selected>Vin Rouge</option>
                                    <option value='2'>Vin Blanc</option>
                                    <option value='3'>Vin rosé</option>
                                </select></p>                <p>Pays : <input name="pays" value="Canada"></p>
                <p>Prix : <input name="prix" value="111" ></p>
                <p>Garde : <input name="garde_jusqua" value="1 ans" ></p>
                <p>Notes <input name="notes" value="tata" ></p>

                <input type="hidden"  name="action" value="ajouterBouteilleNonLister">
                <input type="submit" value="Ajouter la Bouteille" name="submit">
            </form>

            </div>
        </div>
    </div>
</div>
