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
    <link rel="stylesheet" href="styles/styles.css">
  </head>

  <body id="fundo">

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
                            <a class="nav-link" href="acoesI.php">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Voluntários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alterarI.php">A minha instituição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aceitar_candidaturas.php">Aceitar candidaturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="criar_acoes.html">Criar ações</a>
                        </li>
                    </ul>
                    
            <form action = "../php/logout.php" method = "post">
                <input type="submit" name="Logout" class="btn btn-login" value="Logout"> 
            </form>

                    
            </div>
        </div>
    </nav>

    <main >
        <div class="text-light px-5">
            <p><h3>Voluntários com os requisitos para participar nas suas ações</h3></p>
        </div>
    
        <div class="row">
            <div class="col px-5 pb-5">

                <script>
                    function setReceiver(array) {
                        console.log(array);
                        let name = array[0];
                        let cc = parseInt(array[1]);
                        localStorage.setItem("receiverP", cc);
                        localStorage.setItem("receiverN", name);
                        window.location.href = "chatI.php";
                    };
                </script>

                <?php

                    include "../php/openconn.php";

                    function console_log( $data ){
                        echo '<script>';
                        echo 'console.log('. json_encode( $data ) .')';
                        echo '</script>';
                    }

                    session_start();

                    $nome_inst = $_SESSION['username'];

                    $headertabela = '<table class="table text-center table-light table-striped table-hover"> <tr> <th>Ação</th> 
                    <th>Nome Voluntário</th> <th>Telefone</th> <th>Email</th> <th></th> </tr>';

                    $query = "SELECT DISTINCT av.nome_acao, vr.nome, vr.telefone, vr.mail, vr.cc FROM instituicao_registo ir
                            LEFT JOIN accao_voluntariado av ON (ir.nome = av.nome_inst)
                            LEFT JOIN areas_ligacao_voluntario alv ON (av.area = alv.id_area)
                            LEFT JOIN pop_alvo_ligacao_voluntario palv ON (av.populacao = palv.id_pop_alvo)
                            LEFT JOIN horario_acoes ha ON (av.id_accao = ha.id)
                            LEFT JOIN disponibilidade_ligacao_voluntario dlv ON (ha.dia = dlv.dia) AND (ha.periodo = dlv.periodo_dia)
                            LEFT JOIN populacao_alvo pa ON (av.populacao = pa.id_pop_alvo)
                            LEFT JOIN dia_semana ds ON (ha.dia = ds.id_dia)
                            LEFT JOIN periodo_dia pd ON (ha.periodo = pd.id_periodo)
                            LEFT JOIN voluntario_registo vr ON (alv.cc = vr.cc) AND (palv.cc = vr.cc)
                            WHERE ir.mail = '$nome_inst'";

                    $resultsel = mysqli_query($conn, $query);
                    console_log($query);
                    console_log($resultsel);


                    while ($row = mysqli_fetch_array($resultsel, MYSQLI_NUM)) {
                        $arrayNames = array($row[1], array_pop($row));
                        $arrayNames = json_encode($arrayNames);

                        $html[] = "<tr><td>" . implode("</td><td>", $row) .
                        "</td> <td> <button type='button' onclick='setReceiver($arrayNames)' class='btn btn-success'>Chat</button> </td> </tr>";
                    };

                    $html = $headertabela . implode("\n", $html) . "</table>";
                    echo $html;
                    mysqli_close($conn); 
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
                        <a href="alterarI.php" class="text-white" style="text-decoration: none;"> A minha conta</a>
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
    
  </body>
</html>

