//Grupo:003, Nomes: Francisco Pimenta - 54973, Pedro Quintão - 54971, Miguel Duarte - 54941, João Viana - 55166
"use strict"

function form_handler_I(){
    document.getElementsByClassName("col-12")[0].style.display = "none";
    document.getElementById("flexRadioDefault2").checked = false; 

}

function form_handler_V(){
    document.getElementsByClassName("col-12")[0].style.display = "block";
    document.getElementById("flexRadioDefault1").checked = false; 
}

function fecharPopup () {
    document.getElementsByClassName('popup')[0].style.display = "none";
    
}