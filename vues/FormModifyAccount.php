<?php
    if(isset($_SESSION["UserID"])){
         $UserID =  $_SESSION["UserID"];
?>

    <div id="loginAccount">
        <h1>Mon Compte</h1>
        <form method="POST" class="column--center">
            <h2><label for='usager'>Nom d'usager : <b> <em id='usager'> <?php echo $_SESSION["UserID"] ?>   </b></em></label></h2>
			
            <input type="button" value="Modifier le mot de passe" onclick='FormUpdateUser("<?php echo $UserID ?>")' />
			<h2><label for='cellier'> Cellier : </label></h2>
			<select id="cellier" name="cellier" ><option>Choisir Cellier</option></select>
			
			<input type="button" value="Modifier le nom de cellier" onclick='FormUpdateCellierNom(cellier.value)'/>
            <!--<input type="button" value="Modifier le nom de cellier" onclick='Form(cellier.value)'/>-->
        </form>

    </div>


    <?php
    }

?>
<script>
ajaxGetCellierNomFunction();

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

function UpdateCellierNom(id_cellier) {
	
console.log('UpdateCellierNom id_cellier='+id_cellier );
    var cellierNom = document.querySelector('input[name="cellier"]').value;


    var err_message = "";

    if (cellierNom == "") {

        err_message += "Cellier Nom est NULL!<br>";


    } else {

        ajaxUpdateCellierNomFunction(id_cellier);
    }
}

/* function ChoissirLeCellier(id_cellier){
    
	console.log('ChoissirLeCellier');
    var ajaxRequest; // La variable pour Ajax 

    ajaxRequest = new XMLHttpRequest();

    // Créer une fonction qui recevra les données 
    // envoyées par le serveur et mettra à jour 
    // la div dans la page.

    ajaxRequest.onreadystatechange = function() {

        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('monCellierNom');
            console.log(ajaxDisplay);
            ajaxDisplay.innerHTML = ajaxRequest.responseText;
            var temp = trim(ajaxRequest.responseText);

            console.log('repose='+temp)
   /*         if (temp != '"true"') {
                showMessage(ajaxRequest.responseText);
            } else {
                showMessage('Choissir Success!');

            }
*//* 
        }
    } */

    // On récupère les valeurs pour les 
    // transmettre au script serveur.

  

    /* var queryString = "?requete=choissirCellier&id_cellier=" + id_cellier;


    ajaxRequest.open("GET", "./index.php" + queryString, true);
    ajaxRequest.send(null);
} 
*/ 

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

function ajaxUpdateCellierNomFunction(id_cellier) {
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
                // a changer lorsque qu'on mettera en live
                document.location.replace('http://localhost/vino/index.php?requete=SelectionCellier&id=' + id_cellier);


            }

        }
    }

    // On récupère les valeurs pour les 
    // transmettre au script serveur.
    var cellierNom = document.querySelector('input[name="cellier"]').value;
	console.log('cellierNom=' + cellierNom + ' ' + id_cellier);
    var queryString = "?requete=updateCellierNom&id_cellier=" + id_cellier;

    queryString += "&nom=" + cellierNom;
    ajaxRequest.open("GET", "./index.php" + queryString, true);
    ajaxRequest.send(null);
}

function QuitUpdate() {
    location.href = "./index.php";
}

function ajaxGetCellierNomFunction(username1) {
    var ajaxRequest; // La variable pour Ajax 
	var username = trim(document.getElementById('usager').textContent);
	console.log('username=' + username);
    ajaxRequest = new XMLHttpRequest();
		
    // Créer une fonction qui recevra les données 
    // envoyées par le serveur et mettra à jour 
    // la div dans la page.
    ajaxRequest.onreadystatechange = function() {

        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('cellier');
			console.log(ajaxRequest.responseText);
            ajaxDisplay.innerHTML = ajaxRequest.responseText;
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

    <input type="button" value="Modifier" onclick='UpdateUser("<?php echo $UserID ?>")' />
    <input type="button" value="Annuler" onclick='QuitUpdate()' />

	</form>

		<div id="errMessage"></div>`;

		var loginAccount = document.getElementById('loginAccount');
		loginAccount.innerHTML = stringHTML;


}
/*
function FormUpdateCellierNom(username) {
	
	var stringHTML = "";
	stringHTML += `
	<h1>My Account</h1>
		<form method="POST" class="column--center">
			<h2><label for='usager'>Nom d'usager : <b> <em id='usager'> <?php echo $UserID ?>   </b></em></label></h2><br>
            <label for='cellier'>Nom de cellier : </label>

          
            <select id="cellier" name="cellier"></select>
            <input type="button" value="Modify" onclick='UpdateCellierNom("<?php echo $UserID ?>")' />

        </form>
        <div id="errMessage"></div>`;

		var loginAccount = document.getElementById('loginAccount');
		loginAccount.innerHTML = stringHTML;

		ajaxGetCellierNomFunction(username);


}
*/
function FormUpdateCellierNom(id_cellier) {
	console.log('FormUpdateCellierNom id_cellier=' +id_cellier);
	var stringHTML = "";
	stringHTML += `
	<h1>My Account</h1>
		<form method="POST" class="column--center">
			<h2><label for='usager'>Nom d'usager : <b> <em id='usager'> <?php echo $UserID ?>   </b></em></label></h2><br>
            <label for='cellier'>Nom de cellier : <b> </label><br>

            <input type="text" id="cellier" name="cellier" /><br>
            
            <input type="button" value="Modifier" onclick="UpdateCellierNom('`+id_cellier+`')" />
			<input type="button" value="Annuler" onclick='QuitUpdate()' />
        </form>
        <div id="errMessage"></div>`;

		var loginAccount = document.getElementById('loginAccount');
		loginAccount.innerHTML = stringHTML;

		ajaxGetCellierNomFunction(id_cellier);


}

</script>
