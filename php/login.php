<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../Site/img/logo3.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="../Site/styles/login.css">
   

    <title>Login</title>

  </head>
  <body class="grid-container-register">


    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
          

      
          <a class="navbar-brand" href="../Site/index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 5px;" alt="Logo VoluntárioCOVID19"> VoluntárioCOVID19</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
              aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav me-auto mb-2 mb-md-0">
              </ul>
              <a class="btn btn-login-top" href="../php/login.html">Login</a>
          </div>
      </div>
  </nav>
    <main class="form-signin">
        
      <img class="logo_login" src="../Site/img/logo5.png" alt="Logo VoluntárioCOVID19" width="170">

        <form method="post">     
            <h1 class="h3 ml-5 mb-2 text-center fw-normal">Login</h1>
            <label class="switch">
                <input type="checkbox" name="tipo">
                <span class="slider round" onclick="toogleButton()" ><p id="tag"> Voluntário</p></span>
            </label>      
            
            <label for="inputEmail" class="visually-hidden">Email address</label>
            <input type="email" name = "mail" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
            
            <button class="w-100 btn btn-lg btn-login" type="submit">Entrar</button>
        </form>
        <br>
        <p>Ainda não está registado? <a href="../Site/registarV.php" id="register-link"> Registe-se aqui:</a> </p>
       
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Site/scripts/loginScripts.js"></script>
    
  </body>
</html>



<?php

include "openconn.php";

session_start();

$mail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['mail']));
$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pass']));
$error = "username/password incorrect";
if (isset($_POST['mail'])) {
    

    if (isset($_POST['tipo'])){
        $sql = "SELECT * FROM instituicao_registo WHERE mail = N'$mail'";
        $_SESSION['type_of_login'] = 'inst';
    }else{
        $sql = "SELECT * FROM voluntario_registo WHERE mail = N'$mail'";
        $_SESSION['type_of_login'] = 'vol';
    }

    $result = mysqli_query($conn, $sql);
    $user_password = mysqli_fetch_array($result);

    if(password_verify($password, $user_password['pass'])) {
        
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $mail;
        if(isset($_POST['tipo'])){
        echo "<script>window.location.href='../Site/index_userI.html';</script>";
       
        }else{
            echo "<script>window.location.href='../Site/index_user.html';</script>";
    }
    }else {
        $_SESSION["error"] = $error;
        header('Location: ../php/login.php'); 
        echo '<p class="popupErrado"> Email ou palavra-passe incorretos. </p>';
        echo '<script type="text/javascript">  window.onload = function(){
            if (document.getElementsByClassName("popupErrado")[0].style.display != "block") {
                $(".popupErrado").fadeOut(6000);
            }
        }</script>';
           
    }
}

mysqli_close($conn);

?>