


<!DOCTYPE html>
<!--Grupo:003, Nomes: Francisco Pimenta - 54973, Pedro Quintão - 54971, Miguel Duarte - 54941, Gonçalo Ferreira - 55166-->

<html lang="pt-pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="img/logo3.png">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body class="grid-container-register">
      
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                
                <a class="navbar-brand" href="index_user.html"><img src="../Site/img/logo3.png" width="40" style="margin-right: 10px;" alt="">VoluntárioCOVID19</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="acoes.php">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Instituições</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Voluntários</a>
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

        <main id="voluntario_background">
            <div class="row px-3 pt-5 text-light">
                <h1> As ações compátiveis com as suas preferências: </h1>
            </div>
        
        <div class="row">
            <div class="col px-5 pb-5">
                <?php 

                include "openconn.php";

                mysqli_query($conn, "SET NAMES'utf8'");

                session_start(); 

                $mail = $_SESSION["username"];
                function console_log( $data ){
                    echo '<script>';
                    echo 'console.log('. json_encode( $data ) .')';
                    echo '</script>';
                }



                $tabela = 'accao_voluntariado';
                $headertabela = '<table class="table text-center table-striped table-light table-hover mt-5"> <tr> <th>Instituição</th>  
                <th>Ação</th> <th>Área Interesse</th> <th>População Alvo</th> <th>Dia da Semana</th> <th>Periodo Dia</th> <th>Distrito</th> 
                <th>Concelho</th> <th>Freguesia</th> <th>Vagas</th> <th></th> </tr>';

                $query = "SELECT DISTINCT av.nome_inst, av.nome_acao, ai.nome, pa.nome_pop_alvo, ds.nome_dia, pd.nome_periodo, av.distrito, av.concelho, av.freguesia, av.vagas FROM voluntario_registo vr
                            LEFT JOIN areas_ligacao_voluntario alv ON (vr.cc = alv.cc)
                            LEFT JOIN pop_alvo_ligacao_voluntario palv ON (vr.cc = palv.cc)
                            LEFT JOIN disponibilidade_ligacao_voluntario dlv ON (vr.cc = dlv.cc)
                            LEFT JOIN accao_voluntariado av ON (alv.id_area = av.area) AND (palv.id_pop_alvo = av.populacao)
                            LEFT JOIN horario_acoes ha ON (ha.id = av.id_accao) AND (ha.dia = dlv.dia) AND (ha.periodo = dlv.periodo_dia)
                            LEFT JOIN areas_interesse ai ON (av.area = ai.id_area)
                            LEFT JOIN dia_semana ds ON (ha.dia = ds.id_dia)
                            LEFT JOIN periodo_dia pd ON (ha.periodo = pd.id_periodo)
                            LEFT JOIN populacao_alvo pa ON (av.populacao = pa.id_pop_alvo)
                            WHERE vr.mail = '$mail'";
                        
                if (!empty($sql)) {
                    $query .= 'WHERE ' . implode('AND', $sql);
                }

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    $html[] = "<tr> <td>" . implode("</td><td>", $row) . "</td> <td> <button class='btn btn-success'>Candidatar</button> </td> </tr>";
                }

                $html = $headertabela . implode("\n", $html) . "</table>";
                echo $html;

                ?>
            </div>
        </div>
        
          
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




    </body>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</html>

