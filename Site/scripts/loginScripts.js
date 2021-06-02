//Grupo:003, Nomes: Francisco Pimenta - 54973, Pedro Quintão - 54971, Miguel Duarte - 54941, João Viana - 55166

"use strict";

function toogleButton() {

    if (document.querySelectorAll('input[type=checkbox]:checked').length == 0) {
        $("#tag").fadeIn();
        document.getElementById("tag").innerHTML = "Instituição"; 
        document.getElementsByClassName("btn-login")[0].style.backgroundColor = "#A97CB5"; 
        document.getElementsByClassName("btn-login")[0].style.borderColor = "#A97CB5"; 
        document.getElementById("register-link").style.color = "#A97CB5"; 
        document.getElementById("register-link").href = "../Site/registarI.php"; 

    } else { 
        $("#tag").fadeIn();
        document.getElementById("tag").innerHTML = "Voluntário"; 
        document.getElementsByClassName("btn-login")[0].style.backgroundColor = "#1E9DC6"; 
        document.getElementsByClassName("btn-login")[0].style.borderColor = "#1E9DC6"; 
        document.getElementById("register-link").style.color = "#1E9DC6"; 
        document.getElementById("register-link").href = "../Site/registarV.php"; 

    }
}

/* function popup() {
    if (document.getElementsByClassName("popupErrado")[0].style.display == "block") {
        $(".popupErrado").fadeOut(6000);
    }
}

window.onload = popup(); */
