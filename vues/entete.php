<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Un petit verre de vino</title>

    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">

    <meta name="description" content="Un petit verre de vino">
    <meta name="author" content="Jonathan Martel (jmartel@cmaisonneuve.qc.ca)">

    <link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Galada|Istok+Web|Major+Mono+Display|Playfair+Display|Yeseva+One" rel="stylesheet">
    <base href="<?php echo BASEURL; ?>">
    <!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <script src="./js/main.js"></script>
</head>

<body>
    <header class="row--center">

        <nav>

            <div class="pointsMenu">
                <img src="./images/quatrePoints.png" alt="menu mobile" />

            </div>


            <img src="images/logoClear.png" alt="logo de Vino" width="35%" height="35%" />
            <ul>
                <li><a href="?requete=accueil">Mon cellier</a></li>
                <li><a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a></li>
                <li id="signup"><a href="?requete=FormSignup">Sign Up</a></li>
                <li id="login"><a href="?requete=FormLogin">Login</a></li>
                <li id="logout"><a href="?requete=Logout">Logout</a></li>
                <li id="myaccount"><a href="?requete=FormModifyAccount">My Account[<span id="UserID">
<?php
	if(isset($_SESSION["UserID"]))
            {
                $UserID=$_SESSION["UserID"] ;
            }
            else
            {
                 $UserID="NULL";
            }
			echo $UserID;

?></span>]</a></li>

            </ul>
        </nav>
        <form class="filtre" action="?requete=triBouteille" method="POST">
            <p> Trier les bouteille dans le cellier.</p>
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
    </header>
    <main>
