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
    
    <!--  Materialize Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->

    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> --> 


    <link href="https://fonts.googleapis.com/css?family=Galada|Istok+Web|Major+Mono+Display|Playfair+Display|Yeseva+One" rel="stylesheet">
    <base href="<?php echo BASEURL; ?>">
    <!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <script src="./js/main.js"></script>
</head>

<body>
    <header>
        <div class="pointsMenu">
            <img src="./images/quatrePoints.png" alt="menu mobile" />

        </div>
        <a href="?requete=accueil"><img id="logo" src="images/logoClear.png" alt="logo de Vino" width="35%" height="35%" /></a>
        <nav>  
          <?php 
            if(!isset($_SESSION["UserID"])){
                echo '<li id="signup"><a href="?requete=FormSignup">Sign Up</a></li>';
                echo '<li id="login"><a href="?requete=FormLogin">Login</a></li>';
            }
            else{
                echo "<li><a href='?requete=accueil'>Mes celliers</a></li>";
                echo "<li id='myaccount'><a href='?requete=FormModifyAccount'>Mon Compte[<span id='UserID'>" .$_SESSION["UserID"] .  "</span>]</a></li>";
                echo "<li id='ajout'><a href='?requete=FormCellier&User=" . $_SESSION["UserID"] . "'>Ajouter un cellier</a></li>";
                echo "<li id='logou'><a href='?requete=Logout'>Se déconnecter</a></li>";
            }
          ?>  
        </nav>

    </header>
    <main>
