<?php
    if(isset($_SESSION["UserID"])){

?>

    <div id="loginAccount">
        <h1>My Account</h1>
        <form method="POST" class="column--center">
            <h2><label for='usager'>Nom d'usager : <b> <em> <?php echo $UserID ?>   </b></em></label></h2><br>

            <input type="button" value="Modify Mot de Passs" onclick='FormUpdateUser("<?php echo $UserID ?>")' />
			<input type="button" value="Modify Nom de Cellier" onclick='FormUpdateCellierNom("<?php echo $UserID ?>")' />
        </form>

    </div>


    <?php
    }

?>
<script>
function showMessage(message) {

    var showMessage = document.getElementById('errMessage');
    showMessage.innerHTML = message;


    var count = (function() {
        var timer;
        var i = 0;

        function change(tar) {
            i++;

            var num = 1 - i / 100;
            showMessage.style.opacity = num;
            if (i === tar) {
                clearTimeout(timer);
                return false;
            }
            timer = setTimeout(function() {
                change(tar)
            }, 100)


        }
        return change;
    })()


    count(100);

}



function trim(str) {　　
    return str.replace(/(^\s*)|(\s*$)/g, "");　　
}

 function UpdateUser(username) {
	

    var password = document.querySelector('input[name="mdp"]').value;
    var password2 = document.querySelector('input[name="mdp2"]').value;

    var err_message = "";

    if (password == "") {

        err_message += "Password est NULL!<br>";

    }
    if (password != password2) {

        err_message += "Password est différent!<br>"
    }

    if (err_message != "") {

        showMessage(err_message);

    } else {

        ajaxUpdateUserFunction(username);
    }
}

function UpdateCellierNom(username) {
	

    var cellierNom = document.querySelector('input[name="cellier"]').value;


    var err_message = "";

    if (cellierNom == "") {

        err_message += "Cellier Nom est NULL!<br>";


    } else {

        ajaxUpdateCellierNomFunction(username);
    }
}


function ajaxUpdateUserFunction(username) {
    var ajaxRequest; // La variable pour Ajax 

    ajaxRequest = new XMLHttpRequest();

    // Créer une fonction qui recevra les données 
    // envoyées par le serveur et mettra à jour 
    // la div dans la page.
    ajaxRequest.onreadystatechange = function() {

        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('errMessage');
            //ajaxDisplay.innerHTML = ajaxRequest.responseText;
            var temp = trim(ajaxRequest.responseText);

            if (temp != '"true"') {
                showMessage(ajaxRequest.responseText);
            } else {
                showMessage('Update Success!');

            }

        }
    }

    // On récupère les valeurs pour les 
    // transmettre au script serveur.

    var password = document.querySelector('input[name="mdp"]').value;

    var queryString = "?requete=updateUser&username=" + username;

    queryString += "&password=" + password;
    ajaxRequest.open("GET", "./index.php" + queryString, true);
    ajaxRequest.send(null);
}

function ajaxUpdateCellierNomFunction(username) {
    var ajaxRequest; // La variable pour Ajax 

    ajaxRequest = new XMLHttpRequest();

    // Créer une fonction qui recevra les données 
    // envoyées par le serveur et mettra à jour 
    // la div dans la page.
    ajaxRequest.onreadystatechange = function() {

        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('errMessage');
            //ajaxDisplay.innerHTML = ajaxRequest.responseText;
            var temp = trim(ajaxRequest.responseText);

            if (temp != '"true"') {
                showMessage(ajaxRequest.responseText);
            } else {
                showMessage('Update Success!');

            }

        }
    }

    // On récupère les valeurs pour les 
    // transmettre au script serveur.
    var cellierNom = document.querySelector('input[name="cellier"]').value;
    var queryString = "?requete=updateCellierNom&username=" + username;

    queryString += "&nom=" + cellierNom;
    ajaxRequest.open("GET", "./index.php" + queryString, true);
    ajaxRequest.send(null);
}

function QuitUpdate() {
    location.href = "./index.php";
}

function ajaxGetCellierNomFunction(username) {
    var ajaxRequest; // La variable pour Ajax 

    ajaxRequest = new XMLHttpRequest();
		
    // Créer une fonction qui recevra les données 
    // envoyées par le serveur et mettra à jour 
    // la div dans la page.
    ajaxRequest.onreadystatechange = function() {

        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('cellier');
			console.log(ajaxRequest.responseText);
            ajaxDisplay.value = ajaxRequest.responseText;
           var temp = trim(ajaxRequest.responseText);
		 
/*
            if (temp != '"true"') {
                showMessage(ajaxRequest.responseText);
            } else {
                showMessage('Update Success!');

            }*/

        }
    }

    // On récupère les valeurs pour les 
    // transmettre au script serveur.

    var queryString = "?requete=getCellierNom&username=" + username;

    ajaxRequest.open("GET", "./index.php" + queryString, true);
    ajaxRequest.send(null);
}

function FormUpdateUser(username) {
	
	var stringHTML = "";
	stringHTML += `
	<h1>My Account</h1>
	<form method="POST" class="column--center">
    <h2><label for="usager">Nom d'usager : <b> <em> <?php echo $UserID ?>   </b></em></label></h2><br>

    <label for="password">Nouveau Mot de passe : </label>
    <input type="password" name="mdp" /><br>
    <label for="password">Répéter Mot de passe : </label>
    <input type="password" name="mdp2" />

    <input type="button" value="Modify" onclick='UpdateUser("<?php echo $UserID ?>")' />

	</form>

		<div id="errMessage"></div>`;

		var loginAccount = document.getElementById('loginAccount');
		loginAccount.innerHTML = stringHTML;


}

function FormUpdateCellierNom(username) {
	
	var stringHTML = "";
	stringHTML += `
	<h1>My Account</h1>
		<form method="POST" class="column--center">
            <label for='cellier'>Nom de cellier : <b> </label><br>

            <input type="text" id="cellier" name="cellier" /><br>
            
            <input type="button" value="Modify" onclick='UpdateCellierNom("<?php echo $UserID ?>")' />

        </form>
        <div id="errMessage"></div>`;

		var loginAccount = document.getElementById('loginAccount');
		loginAccount.innerHTML = stringHTML;

		ajaxGetCellierNomFunction(username);


}


</script>
