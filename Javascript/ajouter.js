function ajoutIngredientSucces(response){
    /*ajout dans l'ingredient dans la liste deroulante */
    let select = document.getElementById("choixIngredients")
    let option = document.createElement("option");
    option.text = response.nomIngredient;
    option.value = response[1].idIngredient;
    select.options.add(option);
    alert("l'ingredient a ete ajoute");
}

function ajoutcategoriesSucces(response){
    let listecategorie = document.getElementById("listeCategorie");

    // Creation de nouveau node

    let nodeFormCheck = document.createElement("div");
    nodeFormCheck.classList.add("form-check");
    let nodeCheckBox = document.createElement("input");
    nodeCheckBox.type = "checkbox";
    nodeCheckBox.classList.add("form-check-input");
    nodeCheckBox.classList.add("check");
    nodeCheckBox.id = response[1].idCategorie;
    nodeCheckBox.value =  response[1].idCategorie;
    nodeCheckBox.name = "categorie[]";

    let nodeLabel = document.createElement("label");
    nodeLabel.classList.add("form-check-label")
    nodeLabel.htmlFor =  response.nomCategorie;
    nodeLabel.innerHTML =  response.nomCategorie;

    nodeFormCheck.append(nodeCheckBox)
    nodeFormCheck.append(nodeLabel)
    listecategorie.append(nodeFormCheck);

    alert("La categorie a ete ajoutee");
}

function createCategorie(){
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function (){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = JSON.parse(httpRequest.response)
                ajoutcategoriesSucces(response);
                let formulaire = document.getElementById("ajout-categorie-form")

                annulerValider(formulaire)

            }
            else
                alert("La categorie n'a pas ete ajoutee");


        }
    }
    let formulaire = document.getElementById("ajout-categorie-form") // recupere le formulaire

    formulaire.addEventListener('submit', function (event) {

        event.preventDefault() // bloquer le comportement par défaut du submit

        // s'ils existent, on peut récupérer la méthode et l'action (url) sur les attributs du form
        let method = formulaire.getAttribute("method")
        let url = formulaire.getAttribute("action")
        httpRequest.open(method, url)

        // constructeur avec le formulaire en paramètre
        let data = new FormData(formulaire)

        //pour rien afficher une fois que la categorie est inseree
        formulaire.firstElementChild.nextElementSibling.firstElementChild.value =  "";
        httpRequest.send(data)
    })

}
function ajoutIngredients(){
    let ingredientBtn = document.getElementById("ajout-ingre") // recupere le button ajout

    let form = document.getElementById("ajout-recette-form"); // recupere le formulaire d'ajout de recette
    let liste = document.getElementById('listeIngredient'); //Recupere la liste des ingredients

    ingredientBtn.addEventListener("click", function() {
        /*recupere les informations */
        let name = document.getElementById("choixIngredients");
        let  qte = document.getElementById("qte");
        let unite = document.getElementById("unite");
        let idNom = document.getElementById("choixIngredients")

        /* Creation d'un objet d'ingredient */
        let monIngredient = {id: idNom.value, unite: unite.value, quantite:qte.value};

        let nodeIngredients = document.createElement("input"); // creation d'un input
        nodeIngredients.name = "ingredient[]"; // ajoute ce nom dans la liste de name nom-ingredient
        nodeIngredients.value=JSON.stringify(monIngredient) ; // donne comme valeur la valeur de nom
        nodeIngredients.type = "hidden"; // met le input a hidden pour ne pas l'afficher
        form.append(nodeIngredients)

        let divNode = document.createElement("div");
        divNode.classList.add("ingredientClass");

        let divNom = document.createElement("div")
        let  divunite = document.createElement("div")
        let divqte  = document.createElement("div")

        divNom.innerText = name.options[name.selectedIndex].text;
        divunite.innerHTML = unite.value;
        divqte.innerHTML = qte.value;
        divNode.append(divNom);
        divNode.append(divunite);
        divNode.append(divqte);

        unite.value = "";
        qte.value = "";

        liste.append(divNode);
    })
}

function createIngredient(){
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function (){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = JSON.parse(httpRequest.response)
                ajoutIngredientSucces(response) // action a faire si la requette a ete un succes
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

        annuler(formulaire)

        httpRequest.send(data)
    })
}
function Modifier(pen, formulaire){
    pen.addEventListener("click", function(event){
        formulaire.style.zIndex = 6;
    })
    annuler(formulaire);
}
function annuler(form){

    let buttons = document.querySelectorAll(".annulerBtn");
    buttons.forEach((btn) => {
        btn.addEventListener("click", function(event){
            form.style.zIndex = -1;
        })
    })
}

function annulerValider(form){

    let buttons = document.querySelectorAll(".ValiderBtn");
    buttons.forEach((btn) => {
        btn.addEventListener("click", function(event){
            form.style.zIndex = -1;
        })
    })
}
function afficherCreate(){
    let button = document.getElementById("creerIngredient");
    let formulaire = document.getElementById("ajout-ingredient-form");
    Modifier(button, formulaire)
}

function AfficherCreateCategorie(){
    let button = document.getElementById("creerCategorie");
    let formulaire = document.getElementById("ajout-categorie-form");
    Modifier(button, formulaire)

}
document.addEventListener('DOMContentLoaded',function (){
    let body=  document.body;
    body.classList.add("position-relative")
    afficherCreate();
    createIngredient();
    ajoutIngredients();
    createCategorie();
    AfficherCreateCategorie();
})

