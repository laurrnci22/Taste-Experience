document.addEventListener('DOMContentLoaded',function (){
    let variable = document.getElementsByClassName("etoiles")
//console.log(variable[0].children[0])

for (let i = 0; i < variable.length; i++) {
    let variableAleatoire = Math.floor(Math.random() * 5) + 1;
    for (let j = 0; j < variable[i].children.length; j++) {
        if(variableAleatoire !== 0){
            variable[i].children[j].style.color = "yellow"
            variableAleatoire = variableAleatoire - 1;
        }
    }
}
})
