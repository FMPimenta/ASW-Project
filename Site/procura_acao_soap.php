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
    <link rel="stylesheet" href="styles/styles.css">
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
                        <li class="nav-item">
                            <a class="nav-link" href="procura_acao_soap.php">Ações por Instituição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="acoes.php">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="instituicoes.php">Instituições</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alterarV.php">A minha conta</a>
                        </li>
                    </ul>


                    <form action = "../php/logout.php" method = "post">
                        <input type="submit" name="Logout"
                            class="btn btn-login" value="Logout"> 
                        </form>

                       
                </div>
            </div>
        </nav>

    <main id = "back_img1">
        <div class="container-fluid px-5 mt-4" > 
            <form method="post" class="row g-3">
            

                <div class="col-md-6">
                <label for="name" class="form-label text-light">Nome da Instituição</label>
                <input type="text" name="name" class="form-control" id="name">
                </div>
                
                
                <div class="col-12 mb-5">
                <button type="submit" class="btn btn-register">Procurar</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col px-5 pb-5">
                <?php


                function console_log( $data ){
                    echo '<script>';
                    echo 'console.log('. json_encode( $data ) .')';
                    echo '</script>';
                }


                require_once "lib/nusoap.php";

                $client = new nusoap_client(
                    'http://appserver-01.alunos.di.fc.ul.pt/~asw003/Projeto-ASW/Site/server.php'
                );
                $name =  $_POST['name'];
                $error = $client->getError();
                $result = $client->call('InfoAcaoVol', array('nome' => $name));	//handle errors


                echo "<h2 id='letras'>Informação sobre as ações da instituição</h2>";
                echo $name;
                /* echo htmlspecialchars($client->response) ; */

                if ($client->fault)
                {   //check faults
                }
                else {    $error = $client->getError();
                        console_log($result);                                    	 //handle errors
                        echo $result;
                }
                ?>
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



    </body>
</html>