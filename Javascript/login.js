document.addEventListener('DOMContentLoaded',function (){
    
    let form = document.getElementById("login-form");

    form.addEventListener("submit", function(event) {

        let username = document.getElementById("username");
        let password = document.getElementById("password");
        let erreur = document.getElementById("erreur-log");

        if (username.value.trim() === "") {
            erreur.innerHTML = "USERNAME IS EMPTY";
            event.preventDefault();
        }
        else if (password.value.trim() === ""){
            erreur.innerHTML = "PASSWORD IS EMPTY";
            event.preventDefault();
        }
    })
 
 })