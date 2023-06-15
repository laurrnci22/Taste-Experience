document.addEventListener('DOMContentLoaded',function (e){
    let buttons = document.querySelectorAll('.btn-supp-Ingredient'); // recupere le bouton a supprimer

    buttons.forEach((button) => {
        let text = button.innerHTML; // recupere le text initial
        button.addEventListener("mousemove", function(){
            button.innerHTML = "&#x1F5D1;"; // change le text en code de poubelle
        })
        button.addEventListener("mouseout", function(){
            button.innerHTML = text;
        })

        button.addEventListener("mousedown", function(){ // pour supprimer une recette
            if (confirm("Voulez-vous supprimer cet ingredient ?"))
                button.nextElementSibling.submit();
        })
    })
})


