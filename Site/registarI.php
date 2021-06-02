<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/logo3.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/register.css">

    <title>Registo</title>
</head>


<body class="grid-container-register" >

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 5px;" alt="Logo VoluntárioCOVID19"> VoluntárioCOVID19 </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                </ul>
                <a class="btn btn-login" href="../php/login.php">Login</a>
            </div>
        </div>
    </nav>

    <main class="form-register" id="instituicao_background">
        <form method="post">
          
            <img class="rounded mx-auto d-block mb-4 logo_register" src="img/logo5.png" id="logo_register" alt="Logo VoluntárioCOVID19" width="170">
            
            <div id="divHeader" class="mx-auto">
                <h1 class="h1 mb-4 fw-normal">Registo Instituição</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="nome" class="form-label">Nome da Instituição</label>
                        <input type="text" name="nome" id="nome" class="form-control mb-3" placeholder="Nome" required>
                    </div>

                    <div class="col-md-4">
                        <label for="emailInstituicao" class="form-label">Email Instituição</label>
                        <input type="email" name = "email" id="emailInstituicao" class="form-control mb-3" placeholder="Email" required>
                    </div>

                    <div class="col-md-4">
                        <label for="website" class="form-label">Website (Opcional)</label>
                        <input type="url" name = "website" id="website" class="form-control mb-3" placeholder="Website">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="distrito" class="form-label">Distrito</label>
                        <input class="form-control mb-3" name = "distrito" list="datalistDistrito" id="distrito" onkeyup="showHint(this.value)" placeholder="Escreva para procurar..."
                            required>
                
                        <datalist id="datalistDistrito">
        
                        </datalist>
                
                    </div>
                
                    <div class="col-md-4">
                        <label for="concelho" class="form-label">Concelho</label>
                        <input class="form-control mb-3" name = "concelho" type="text" id="concelho" list="datalistConcelho" onkeyup="showHint1(this.value)" placeholder="Escreva para procurar..." required>
                       
                        <datalist id="datalistConcelho">
                        
                        </datalist>
                    
                    </div>
                
                    <div class="col-md-4">
                        <label for="freguesia" class="form-label">Freguesia</label>
                        <input class="form-control mb-3" name = "freguesia" type="text" id="freguesia" list="datalistFreguesias" onkeyup="showHint2(this.value)" placeholder="Escreva para procurar..." required>
                    
                        <datalist id="datalistFreguesias">
                        
                        </datalist>
                    
                    </div>
                </div>

                                <div class="row">
                    <div class="col-md-8">
                        <label for="morada" class="form-label">Morada</label>
                        <input type="text" name = "morada" id="morada" class="form-control mb-3" placeholder="Morada" required>
                    </div>
                
                    <div class="col-md-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" name = "telefone" id="telefone" maxlength="9" class="form-control mb-3" placeholder="Telefone" required>
                    </div>
                
                    <div class="col-md-4">
                        <label for="nomeRepresentante" class="form-label">Nome Representante</label>
                        <input type="text" name = "nome_representante" id="nomeRepresentante" class="form-control mb-3" placeholder="Nome" required>
                    </div>

                    <div class="col-md-4">
                        <label for="emailRepresentante" class="form-label">Email Representante</label>
                        <input type="email" name = "mail_representante" id="emailRepresentante" class="form-control mb-3" placeholder="Email" required>
                    </div>

                    <div class="col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name = "pass" id="password" class="form-control mb-3" placeholder="Password"
                            required>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class = "form-label" for="descricao_instituicao">Descrição Instituição</label>
                        <textarea class="form-control" name="descricao" aria-label="With textarea" rows="2" required></textarea>
                        
                    </div>
                </div>              

                <div class="col-md-2 mx-auto mt-3">
                    <button class="w-100 btn btn-lg btn-register" name="submit" type="submit">Registar</button>
                </div>

            </div>
        </form>
        
    </main>

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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
    <script src="scripts/distrito.js"></script>
    <script src="scripts/concelhos.js"></script>
    <script src="scripts/freguesias.js"></script>

</body>

</html>

<?php

include "openconn.php";

session_start();

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$telefone = $_POST['telefone'];
$morada = $_POST['morada'];
$dist = $_POST['distrito'];
$concelho = $_POST['concelho'];
$freguesia = $_POST['freguesia'];
$mail = $_POST['email'];
$website = $_POST['website'];
$nome_representante = $_POST['nome_representante'];
$mail_representante = $_POST['mail_representante'];
$pass = $_POST['pass'];
$pass = password_hash($pass, PASSWORD_BCRYPT);

$sql = "insert into instituicao_registo(nome, descricao, telefone, morada, distrito, concelho, freguesia, mail, website, nome_representante, mail_representante, pass) 
VALUES (N'$nome', N'$descricao', $telefone, N'$morada', N'$dist', N'$concelho', N'$freguesia', '$mail', '$website', N'$nome_representante', '$mail_representante', '$pass');";

if (isset( $_POST['submit'])){
    if (mysqli_query($conn, $sql)) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $mail;

        $sqlcount = "SELECT COUNT(*) FROM chat_ligacao_utilizadores";
        $resultsel = mysqli_query($conn, $sqlcount);
        $counter = mysqli_fetch_all($resultsel);
        $chatid = intval($counter[0][0]);

        $chatid = $chatid + 1;

        $sqlchatid = "insert into chat_ligacao_utilizadores(chatid, instid) VALUES ($chatid, $telefone);";
        mysqli_query($conn, $sqlchatid);

	    echo "<script>window.location.href='index_userI.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
