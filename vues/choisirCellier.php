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
        }else{
        echo "<div><h1>Connectez-vous pour avoir accès à votre cellier</h1></div>";
    }
    ?>
