/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */
const BaseURL = window.location.origin + window.location.pathname;

//const BaseURL = "http://127.0.0.1/vino/";
console.log(BaseURL);
window.addEventListener('load', function() {
    const BaseURL = window.location.origin + window.location.pathname;
   

    document.querySelectorAll(".btnBoire").forEach(function(element) {
        

        element.addEventListener("click", function(evt) {
            // Je disabled le btn ajouter le temps de la requête.
            element.disabled = true;
            // Je vais chercher la quantite de cette bouteille.
            let quantite = evt.composedPath();
            
            quantite = quantite[2].children[3].children[1];
            

            quantite = quantite.firstElementChild;
            qt = quantite.innerHTML;
            
            let id = evt.target.parentElement.dataset.id;
            let requete = new Request(BaseURL + "?requete=boireBouteilleCellier", {
                method: 'POST',
                body: '{"id": ' + id + '}'
            });

            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        
                        return response.json();
                        
                    } else {
                        throw new Error('Erreur');
                    }
                })
                .then(response => {
                    // Si la reponse est Ok changer la quantité dans le cellier sans recharger la page.
                    
                    if (parseInt(qt) == 0) {
                        quantite.innerHTML = parseInt(qt);
                        // Je reéactive le bouton pour un ajout futur.
                        element.disabled = false;

                    } else {
                        quantite.innerHTML = parseInt(qt) - 1;
                        element.disabled = false;
                    }

                }).catch(error => {
                    console.error(error);
                });
        })

    });

    document.querySelectorAll(".btnModif").forEach(function(element) {
       
        element.addEventListener("click", function(evt) {
            let id = evt.target.parentElement.dataset.id;
            let url = ("?requete=ModificationFormulaire&Id=" + id);
            window.location.href = url;
        });
    });

    document.querySelectorAll(".btnAjouter").forEach(function(element) {
       
        element.addEventListener("click", function(evt) {
            let id = evt.target.parentElement.dataset.id;
            let requete = new Request(BaseURL + "?requete=ajouterBouteilleCellier", {
                method: 'POST',
                body: '{"id": ' + id + '}'
            });
            
            element.disabled = true;
            
            // Je vais chercher la quantite de cette bouteille.
            
            let quantite = evt.composedPath();
           
            
            quantite = quantite[2].children[3].children[1];
            

            quantite = quantite.firstElementChild;
            qt = quantite.innerHTML;
            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        
                        return response.json();
                    } else {
                        throw new Error('Erreur');
                    }
                })
                .then(response => {
                    
                    // Si la reponse est Ok changer la quantité dans le cellier sans recharger la page.
                    quantite.innerHTML = parseInt(qt) + 1;
                    // Je reéactive le bouton pour un ajout futur.
                    element.disabled = false;

                    
                }).catch(error => {
                    console.error(error);
                });
        })

    });

    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
    
    let liste = document.querySelector('.listeAutoComplete');

    if (inputNomBouteille) {
        inputNomBouteille.addEventListener("keyup", function(evt) {
            
            let nom = inputNomBouteille.value;
            liste.innerHTML = "";
            if (nom) {
                let requete = new Request(BaseURL + "?requete=autocompleteBouteille", {
                    method: 'POST',
                    body: '{"nom": "' + nom + '"}'
                });
                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response => {

                        response.forEach(function(element) {
                            liste.innerHTML += "<li data-id='" + element.id + "'>" + element.nom + "</li>";
                        })
                    }).catch(error => {
                        console.error(error);
                    });
            }


        });

        let bouteille = {
            nom: document.querySelector(".nom_bouteille"),
            millesime: document.querySelector("[name='millesime']"),
            quantite: document.querySelector("[name='quantite']"),
            date_achat: document.querySelector("[name='date_achat']"),
            types: document.querySelector("[name='types']"),
            pays: document.querySelector("[name='pays']"),
            prix: document.querySelector("[name='prix']"),
            garde_jusqua: document.querySelector("[name='garde_jusqua']"),
            notes: document.querySelector("[name='notes']"),
           

        };
        liste.addEventListener("click", function(evt) {
            
            if (evt.target.tagName == "LI") {
                
                bouteille.nom.innerHTML = evt.target.innerHTML;
               
                liste.innerHTML = "";
                inputNomBouteille.value = "";

                var idSaq = document.querySelector("[name='idSaq']");
                var nom = document.querySelector("[name='nom']");
                nom.value = evt.target.innerHTML;
                idSaq.value = evt.target.dataset.id;

            }
        });
    }

    //Menu Mobile
    let btnMenuMobile = document.querySelector(".pointsMenu > img");
    let menu = document.querySelector("nav");

    
    btnMenuMobile.addEventListener("click", function() {
        menu.classList.toggle("active");
    });

    // Description expanding 

    document.querySelectorAll(".voir-plus").forEach(function(element) {

        if (element) {
            element.addEventListener("click", function(e) {
                
                let divDescription = next(e.target);
                divDescription.classList.toggle("active-flex");
                fadeIn(divDescription);
            });
        }

    })

    //ajout à liste d'achat'

    document.querySelectorAll(".btnListeAchat").forEach(function(element){
        if (element) {
            element.addEventListener("click", function(e) {
                

                $id_bouteille = this.getAttribute("data-id");


                let requete = new Request(BaseURL + "?requete=ajoutListeAchat", {
                    method: 'POST',
                    body: '{"id_bouteille_cellier": ' + $id_bouteille + '}'
                });

                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            let res = response.json();
                            window.location.reload(true);
                            return res;
                        } else {
                            throw new Error('Erreur');
                        }

                    }).catch(error => {
                        console.error(error);
                    });


            
            });
        }

    });

    // Retrait liste d'achat 

    document.querySelectorAll(".btnRetraitListeAchat").forEach(function(element){
        if (element) {
            element.addEventListener("click", function(e) {
    

                $id_bouteille = this.getAttribute("data-id");


                let requete = new Request(BaseURL + "?requete=retirerListeAchat", {
                    method: 'POST',
                    body: '{"id_bouteille_cellier": ' + $id_bouteille + '}'
                });

                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {
                            let res = response.json();
            
                            return res;
                        } else {
                            throw new Error('Erreur');
                        }

                    })
                    .then( response =>
                        {
                            window.location.reload(true);
                    }).catch(error => {
                        console.error(error);
                    });


            
            });
        }

    });


});



/* http://youmightnotneedjquery.com/ pour cette fonction  */ 
function fadeIn(el) {
    el.style.opacity = 0;

    var last = +new Date();
    var tick = function() {
        el.style.opacity = +el.style.opacity + (new Date() - last) / 400;
        last = +new Date();

        if (+el.style.opacity < 1) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
        }
    };

    tick();
}

function next(elem) {
    do {
        elem = elem.nextSibling;
    } while (elem && elem.nodeType !== 1);
    return elem;
}