<div class="ajouter">
    <form action="index.php" method="get">
        <input type ="hidden" name="requete" value="AjoutCell">
        <input name="nom" placeholder="Insérer le nom du Cellier">
        <input type ="hidden" name="username" value="<?php echo $_GET['User'] ?>">
        <input type="submit" value="Création">
    </form>
</div>