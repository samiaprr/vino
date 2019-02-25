<section >
    <h1>Votre liste d'achat</h1>
    <table class='listeAchat'>
        <tr>
            <thead>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </thead>
        </tr>
        <tbody>
        <?php 
        foreach($dataListeAchat as $cle => $bouteille){
            echo "<tr>
                    <td><img class='listeAchat-img' src='https:" . $bouteille['image'] . "'></td>
                    <td class='description-listeAchat column--center'>    
                        <p class='nom'>Nom: " . 
                        $bouteille['nom'] . "
                        </p>
                        <p class='type'>Type: " . 
                                $bouteille['types'] . "
                        </p>
                        <p class='prix'>Prix: " . 
                            $bouteille['prix'] . "
                        </p>
                        <p><a href='" . $bouteille['url_saq'] . "'>Voir SAQ</a></p>
                    </td>
                    <td><button class='btnRetraitListeAchat' data-id='" . $bouteille['id_bouteille_cellier'] . "'>Supprimer de la liste</button></td>
            </tr>";
        }
        
        ?>
        </tbody>
        <tr>
        
        </tr>
    
    
    </table>

</section>
