<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

session_start();

if (isset($_SESSION['username']) && (isset($_SESSION['loggedIn']))){
    if($_SESSION['type_of_login'] == 'inst'){
        header('Location: ../Site/index_userI.html');
    }else{
        header('Location: ../Site/index_user.html');
    }
}else{
    console_log('Not logged in');
} 
?>



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
    <link rel="stylesheet" href="styles/styles.css">

    

    <title>VoluntárioCOVID19</title>
</head>

<body>
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 10px;" alt="">VoluntárioCOVID19</a>
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



    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active back_img" id="back_img1"  >
                
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Voluntários</h1>
                        <p>Deseja juntar-se à nossa comunidade de voluntários?</p>
                        <p><a class="btn btn-lg btn-register" href="registarV.php">Registe-se agora</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item back_img" id="back_img2">
    
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Instituições</h1>
                        <p>Precisa da ajuda dos nossos voluntários?</p>
                        <p><a class="btn btn-lg btn-inst" href="registarI.php">Registe já a sua instituição</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item back_img" id="back_img3">
                
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Ações</h1>
                        <p>Não sabe como pode ajudar?</p>
                        <p><a class="btn btn-lg btn-register" href="#">Verifique as nossas ações a decorrer</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="section-content">
        <div class="container">
            <h2>Bem-vindo!</h2>
            <p class="lead">Nestes tempos tempos de maior dificuldade a nível nacional, nunca foi tão importante 
            a empatia e entreajuda humana. A nossa aplicação tem como objetivo facilitar o processo de voluntariado e 
            agilizar a comunicação entre voluntários e instituições.
            </p>

            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card-group">
                        <div class="card">
                            <img src="img/pai-filha-voluntariado.jpg" class="card-img-top" alt="Father and daughter volunteering">
                            <div class="card-body">
                                <h5 class="card-title">Voluntários</h5>
                                <p class="card-text">Crie o seu perfil de voluntário, onde poderá descrever as suas preferências e disponibilidades,
                                     para uma maior facilidade na atribuição de tarefas e instituições!</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/voluntarios-descarregar.jpg" class="card-img-top" alt="Volunteers unloading a truck">
                            <div class="card-body">
                                <h5 class="card-title">Instituições</h5>
                                <p class="card-text">Crie o perfil da sua instituição, onde poderá descrever os seus requisitos e 
                                    objetivos para uma atribuição de voluntários mais especificos para os seus objetivos!</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="img/voluntarios-sacos.jpg" class="card-img-top" alt="Volunteers looking inside bags">
                            <div class="card-body">
                                <h5 class="card-title">Ações</h5>
                                <p class="card-text">Veja que ações de voluntariado as nossas instituições estão a oferecer, e escolha as suas!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
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

</body>
</html>