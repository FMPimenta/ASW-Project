<!--Grupo:003, Nomes: Francisco Pimenta - 54973, Pedro Quintão - 54971, Miguel Duarte - 54941, João Viana - 55166-->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/logo3.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/acoes.css">
  </head>

  <body id="background-alterar">

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="index_user.html"><img src="../Site/img/logo3.png" width="40" style="margin-right: 5px;" alt="Logo VoluntárioCOVID19"> VoluntárioCOVID19</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="acoesI.php">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="candidatos_a_acao.php">Voluntários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alterarI.php">A minha instituição</a>
                        </li>
                    </ul>
                <form action = "../php/logout.php" method = "post">
                        <input type="submit" name="Logout"
                            class="btn btn-login" value="Logout"> 
                </form>
            </div>
        </div>
    </nav>

    <main >

    <h3 id="receiver"></h3>

    <div id="chat">
    </div>

    <div class="central container-fluid px-5 mb-5 mt-4"> 
        <form action="" class="row g-3">
            <div class="col-md-6">
                <input id="msg_env" type="text" class="form-control" id="chat">
            </div>
            <div class="col-md-6">
                <button class="btn btn-env" onclick="sendMsg()">Enviar</button>
            </div>
        </form>
    </div>

    </main>

    <script>

        let last_msg = 0;
        let username;
        getUsername();

        function getUsername() {
            receiverName = localStorage.getItem("receiverN");
            document.getElementById("receiver").innerHTML = "Chat com " + receiverName;

            var xhttp;
            xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    username = this.responseText;
                };
            };

            xhttp.open("GET", "../php/username.php", true);
            xhttp.send();
        }

        function sendMsg() {
            var msg = document.getElementById("msg_env").value;
            var dest = parseInt(localStorage.getItem("receiverP"));

            if (msg.length > 0) {

                var xhttp;
                xhttp = new XMLHttpRequest();
        
                xhttp.open("GET", "../php/enviar_msg.php?m="+msg+"&d="+dest, true);
                xhttp.send();  
            };
        };

        function recvMsg() {
            var dest = parseInt(localStorage.getItem("receiverP"));

            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    if (this.responseText !== "Nada") {
                        var msgs = this.responseText;
                        console.log(msgs);
                        msgs = JSON.parse(msgs);
                        for (i = 0; i < msgs.length; i++) {
                            if (last_msg < msgs[i][2]) {
                                if (msgs[i][1] == username) {
                                    var msg_env = document.createElement("P");
                                    msg_env.innerText = msgs[i][0]; 
                                    msg_env.classList.add("btn-env");
                                    msg_env.classList.add("mx-5");
                                    msg_env.classList.add("capsula");
                                    msg_env.classList.add("text-white");
                                    document.getElementById("chat").appendChild(msg_env);
                                } else {
                                    var msg_rec = document.createElement("P");
                                    msg_rec.innerText = msgs[i][0]; 
                                    msg_rec.classList.add("btn-recv");
                                    msg_rec.classList.add("capsula");
                                    msg_rec.classList.add("text-white");
                                    msg_rec.classList.add("mx-5");
                                    msg_rec.classList.add("align-content-end");
                                    
                                    document.getElementById("chat").appendChild(msg_rec);
                                };

                                last_msg = msgs[i][2];
                            };
                        }; 
                    };
                };
            };

            xhttp.open("GET", "../php/receber_msg.php?s=" + dest, true);
            xhttp.send();
        };

        setInterval(recvMsg, 500);

    </script>

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-md-left">
            <div class="row text-md-left">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-2">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Plataforma</h5>
                    <p>A plataforma VoluntárioCOVID19 permite às instituições registadas encontrar 
                        e recrutar voluntários para os seus projetos e necessidades de voluntariado.</p>
                </div>

        
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Comunidade</h5>
                <p>
                    <a href="#" class="text-white" style="text-decoration: none;"> Voluntário</a>
                </p>
                <p>
                    <a href="#" class="text-white" style="text-decoration: none;"> Instituições</a>
                </p>
                <p>
                    <a href="#" class="text-white" style="text-decoration: none;"> Ações</a>
                </p>         
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Conta</h5>
                <p>
                    <a href="#" class="text-white" style="text-decoration: none;"> A minha conta</a>
                </p>
                <p>
                    <a href="#" class="text-white" style="text-decoration: none;"> Ajuda</a>
                </p>         
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-2">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contactos</h5>
                <p>
                    <i class="fas fa-home mr-3"> </i>  Lisboa, Faculdade de Ciências
                </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i>  voluntariocovid19@gmail.com
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i>  219364726
                </p>
            </div>    
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <img src="../Site/img/logo3.png" width="190" alt="">
            </div>    
            
        </div>

    </footer>