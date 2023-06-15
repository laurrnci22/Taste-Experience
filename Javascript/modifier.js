function Modifier(pen, formulaire, btnSupprimer){ // fonction pour modifier le nom
    pen.addEventListener("click", function(event){
        formulaire.style.zIndex = 6;
    })
    annuler(formulaire, btnSupprimer)
}
function annuler(formulaire, btnSupprimer){

    btnSupprimer.addEventListener("click", function(event){
        formulaire.style.zIndex = -1;
    })

}
function modifierNom(){
    let pen = document.getElementById('pen_name');
    let formulaire = document.getElementById("modifierNom");
    let btnSupprimer = document.getElementById("annulerButtonNom");

    Modifier(pen, formulaire, btnSupprimer);
}
function imagesModifier(){
    let pen = document.getElementById('penImages');
    let formulaire = document.getElementById("modifierImage");
    let btnSupprimer = document.getElementById("annulerButtonImage");

    Modifier(pen, formulaire,btnSupprimer);
}

function tagModifier(){
    let pen = document.getElementById('pen_tag');
    let formulaire = document.getElementById("modifierTag");
    let btnSupprimer = document.getElementById("annulerButtonTag");
    Modifier(pen, formulaire,btnSupprimer);
}
function modifierIngredient(){
    let pens = document.querySelectorAll('.ingredientsModifier');
    let btnsSupprimer = document.querySelectorAll(".annulerButtonIngredient");
    pens.forEach((pen, indice) => {

        Modifier(pen, pen.parentElement.nextElementSibling,btnsSupprimer[indice]);

    })
}
function modifierDescription(){
    let pen = document.getElementById('pen_description');
    let formulaire = document.getElementById("modifDescription");
    let btnSupprimer = document.getElementById("annulerButtonDescription");

    Modifier(pen, formulaire,btnSupprimer);
}

function afficherCreate(){
    let button = document.getElementById("ajouter_Ingredient_message");
    let formulaire = document.getElementById("formulaire-ajouter-ingredient");
    let btnSupprimer = document.getElementById("annulerButtonAjoutIngredient");
    Modifier(button, formulaire,btnSupprimer)
}

function afficherNouveauIngredient(){
    let button = document.getElementById("creerIngredient");
    let formulaire = document.getElementById("ajout-ingredient-form");
    let btnSupprimer = document.getElementById("annulerButtonAjoutIngre");

    Modifier(button, formulaire,btnSupprimer)

}


function createIngredient(){
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function (){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = JSON.parse(httpRequest.response)
                alert("Lingredient a ete ajouter dans la liste des ingredient")
                location.reload();

            }
            else
                alert("l'ingredient n'a pas ete ajoute");
        }
    }

    let formulaire = document.getElementById("ajout-ingredient-form")

    formulaire.addEventListener('submit', function (event){

        event.preventDefault() // bloquer le comportement par défaut du submit

        // s'ils existent, on peut récupérer la méthode et l'action (url) sur les attributs du form
        let method = formulaire.getAttribute("method")
        let url = formulaire.getAttribute("action")
        httpRequest.open(method, url)

        // constructeur avec le formulaire en paramètre
        let data = new FormData(formulaire)
        formulaire.style.zIndex = -1;


        formulaire.children[1].firstElementChild.value = "";
        formulaire.children[1].firstElementChild.nextElementSibling.nextElementSibling.value = "";

        httpRequest.send(data)
    })
}



document.addEventListener('DOMContentLoaded',function (){

   modifierNom();
    imagesModifier();
    modifierIngredient();
    afficherCreate();
    afficherNouveauIngredient();
    modifierDescription();
    tagModifier();
    createIngredient();



    // createIngredient();



})