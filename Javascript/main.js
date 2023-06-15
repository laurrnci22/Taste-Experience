function addMenu(){
    let categorie= document.querySelectorAll('.categorieRecettes');
    let Mn = document.getElementById("menu")
    categorie.forEach((menu, indice) => {
        // menu.setAttribute('id', "ID_"+ menu.children[0].innerHTML.split(" ").join(""));

    let new_node = document.createElement('a');
    let text_n = menu.children[0].innerHTML.split(" ").join("");
    new_node.innerHTML = text_n;

    new_node.classList.add("item-menu");
    let lienText = "#ID_"+text_n;
    new_node.href = lienText

    Mn.append(new_node);
    let lienIdText = "ID_"+text_n;
    menu.children[0].setAttribute('id', lienIdText)
    })
}

function soumissionRecette(){
    let recettes_form = document.querySelectorAll('.item-cadre');

    recettes_form.forEach((recette) => {
        recette.addEventListener("click", function(){
            recette.submit()
        })
    })
}
document.addEventListener('DOMContentLoaded',function (){
    soumissionRecette();
})