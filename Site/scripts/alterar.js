

function trocarPalavraPasse(tipo) {
    if (tipo == "alterar") {
        document.getElementsByClassName("alterar-password-div-final")[0].style.display = "block";
        document.getElementsByClassName("alterar-password-div-inicial")[0].style.display = "none";
        document.getElementsByClassName("editar-password-background")[0].style.backgroundColor = "rgba(78, 78, 78, 0.980)";
        document.getElementById("alterar-password-btn").style.display = "none";

    } else if (tipo == 'confirmar') {
        document.getElementsByClassName("alterar-password-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-password-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-password-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
        document.getElementById("alterar-password-btn").style.display = "block";

    }  else {
        document.getElementsByClassName("alterar-password-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-password-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-password-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
        document.getElementById("alterar-password-btn").style.display = "block";

    }    
    
}

function trocarEmail(tipo) {
    if (tipo == "alterar") {
        document.getElementsByClassName("alterar-email-div-final")[0].style.display = "block";
       
        document.getElementById("confirmar-alterar-btn").setAttribute("type", "submit");
        $("#newEmailInstituicao").attr("required", true);
        $("#newEmail").attr("required", true);
        document.getElementsByClassName("alterar-email-div-inicial")[0].style.display = "none";
        document.getElementsByClassName("editar-email-background")[0].style.backgroundColor = "rgba(78, 78, 78, 0.980)";
        document.getElementById("alterar-email-btn").style.display = "none";

       
    } else if (tipo == "confirmar"){
        document.getElementsByClassName("alterar-email-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-email-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-email-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
    }  else {
        document.getElementsByClassName("alterar-email-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-email-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-email-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
        document.getElementById("alterar-email-btn").style.display = "block";
    }
    
}

function trocarPerfil(tipo) {
    if (tipo == "alterar") {
        
        document.getElementsByClassName("alterar-perfil-div-final")[0].style.display = "block";
        document.getElementsByClassName("alterar-perfil-div-inicial")[0].style.display = "none";
        document.getElementsByClassName("editar-perfil-background")[0].style.backgroundColor = "rgba(78, 78, 78, 0.980)";
        document.getElementById("alterar-perfil-btn").style.display = "none";

       
    } else if (tipo == "confirmar"){
        document.getElementsByClassName("alterar-perfil-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-perfil-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-perfil-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
    }  else {
        document.getElementsByClassName("alterar-perfil-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-perfil-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-perfil-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
        document.getElementById("alterar-perfil-btn").style.display = "block";
    }   
}

function trocarAreas(tipo) {
    if (tipo == "alterar") {
        
        document.getElementsByClassName("alterar-areas-div-final")[0].style.display = "block";
        document.getElementsByClassName("alterar-areas-div-inicial")[0].style.display = "none";
        document.getElementsByClassName("editar-areas-background")[0].style.backgroundColor = "rgba(78, 78, 78, 0.980)";
        document.getElementById("alterar-areas-btn").style.display = "none";

       
    } else if (tipo == "confirmar"){
        document.getElementsByClassName("alterar-areas-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-areas-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-areas-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
    }  else {
        document.getElementsByClassName("alterar-areas-div-final")[0].style.display = "none";
        document.getElementsByClassName("alterar-areas-div-inicial")[0].style.display = "block";
        document.getElementsByClassName("editar-areas-background")[0].style.backgroundColor = "rgba(155, 155, 155, 0.507)";
        document.getElementById("alterar-areas-btn").style.display = "block";
    }   
}

window.onload = openCheckboxes();

function openCheckboxes() {
    var dia = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
    for (var x = 0; x < dia.length; x++) {
        if ($('input[id="'+ dia[x] +'"]:checked').length > 0) {

            document.getElementById(dia[x] + "-manha").removeAttribute('disabled');
            document.getElementById(dia[x] + "-tarde").removeAttribute('disabled');
            document.getElementById(dia[x] + "-noite").removeAttribute('disabled');
        
        } else {
            $("#"+ dia[x] +"-manha").attr("disabled", true)
            $("#"+ dia[x] +"-tarde").attr("disabled", true)
            $("#"+ dia[x] +"-noite").attr("disabled", true)
        }
    }
}

function checkboxes(dia){

    if ($('input[id="'+ dia +'"]:checked').length > 0) {

        document.getElementById(dia + "-manha").removeAttribute('disabled');
        document.getElementById(dia + "-tarde").removeAttribute('disabled');
        document.getElementById(dia + "-noite").removeAttribute('disabled');

    } else {
        $("#"+ dia +"-manha").attr("disabled", true)
        $("#"+ dia +"-tarde").attr("disabled", true)
        $("#"+ dia +"-noite").attr("disabled", true)

    }

}

var arrayPop = [];
var textoAntigoPop = document.getElementById("populacao_alvo").value;
textoAntigoArrayPop = textoAntigoPop.split(', ');
if (textoAntigoArrayPop[0] == '') {
    textoAntigoArrayPop.splice(0, 1);
}

function populacaoAlvo(id) {
    
    var textoPopulacao = "";
    if ($('input[id="'+ id +'"]:checked').length > 0) {
        textoAntigoArrayPop.push(id);
        
        for (var x = 0; x < textoAntigoArrayPop.length; x++) {
            if (x != textoAntigoArrayPop.length - 1) {
                textoPopulacao = textoPopulacao + textoAntigoArrayPop[x] + ", ";
            } else {
                textoPopulacao = textoPopulacao + textoAntigoArrayPop[x];
            }
        }
        document.getElementById("populacao_alvo").value = textoPopulacao;    
    } else {
        let indexPalavra = textoAntigoArrayPop.indexOf(id);
        textoAntigoArrayPop.splice(indexPalavra, 1);

        for (var x = 0; x < textoAntigoArrayPop.length; x++) {
            if (x != textoAntigoArrayPop.length - 1) {
                textoPopulacao = textoPopulacao + textoAntigoArrayPop[x] + ", ";
            } else {
                textoPopulacao = textoPopulacao + textoAntigoArrayPop[x];
            }
        }
        document.getElementById("populacao_alvo").value = textoPopulacao;

    }
    
    console.log(textoAntigoArrayPop);
}

var arrayAreas = [];
var textoAntigoAreas = document.getElementById("areas_interesse").value;
textoAntigoArrayAreas = textoAntigoAreas.split(', ');

if (textoAntigoArrayAreas[0] == '') {
    textoAntigoArrayAreas.splice(0, 1);
}

function areasInteresse(id) {

    var textoAreas = "";
    if ($('input[id="'+ id +'"]:checked').length > 0) {
        textoAntigoArrayAreas.push(id);

        for (var x = 0; x < textoAntigoArrayAreas.length; x++) {
            if (x != textoAntigoArrayAreas.length - 1) {
                textoAreas = textoAreas + textoAntigoArrayAreas[x] + ", ";
            } else {
                textoAreas = textoAreas + textoAntigoArrayAreas[x];
            }
        }
        document.getElementById("areas_interesse").value = textoAreas;    
    } else {
        let indexPalavra = textoAntigoArrayAreas.indexOf(id)
        textoAntigoArrayAreas.splice(indexPalavra, 1)

        for (var x = 0; x < textoAntigoArrayAreas.length; x++) {
            if (x != textoAntigoArrayAreas.length - 1) {
                textoAreas = textoAreas + textoAntigoArrayAreas[x] + ", ";
            } else {
                textoAreas = textoAreas + textoAntigoArrayAreas[x];
            }
        }
        document.getElementById("areas_interesse").value = textoAreas;

    }
    
    
    console.log(textoAntigoArrayAreas);

}




