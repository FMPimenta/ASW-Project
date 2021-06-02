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
                            <a class="nav-link" href="acoesI.php">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="candidatos_a_acao.php">Voluntários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alterarI.php">A minha instituição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Aceitar candidaturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="criar_acoes.html">Criar ações</a>
                        </li>
                    </ul>


                    <form action = "../php/logout.php" method = "post">
                        <input type="submit" name="Logout"
                            class="btn btn-login" value="Logout"> 
                        </form>

                       
                </div>
            </div>
        </nav>

        <main id = "fundo">
        <div class="row">
            <div class="col px-5 pb-5 pt-5">
                <form method="post">
                <?php 
                    include "../php/openconn.php";

                    session_start();

                    mysqli_query($conn, "SET NAMES'utf8'");

                    function console_log( $data ){
                        echo '<script>';
                        echo 'console.log('. json_encode( $data ) .')';
                        echo '</script>';
                    }
                    $tabela = 'accao_ligacao_voluntario';
                    $headertabela = '<table class="table text-center table-striped table-light table-hover"> <tr> <th>Voluntário</th> <th>Ação</th> <th></th> <th></th> </tr>';

                    $mail = $_SESSION['username'];
                    $tele_getter = "SELECT telefone FROM instituicao_registo WHERE mail = '$mail'";
                    console_log($tele_getter);
                    $resultsel = mysqli_query($conn, $tele_getter);
                    console_log($resultsel);
                    $list = mysqli_fetch_row($resultsel);
                    console_log($list);
                    $telefone = $list[0];
                    console_log($telefone);
                    $sql_query_inst = "SELECT vr.nome, av.nome_acao FROM accao_ligacao_voluntario alv
                                        LEFT JOIN voluntario_registo vr ON (alv.cc = vr.cc)
                                        LEFT JOIN accao_voluntariado av ON (alv.id_accao = av.id_accao)
                                        WHERE inst = $telefone AND aceite = 'N'"; 
                    $left_join = mysqli_query($conn, $sql_query_inst);  
                    $to_print = mysqli_error($conn);
                    console_log($to_print);
                    $vars = "SELECT cc, id_accao FROM accao_ligacao_voluntario WHERE inst = $telefone";
                                            
                    $result_query = mysqli_query($conn, $vars);
                    
                    while ($row = mysqli_fetch_array($left_join, MYSQLI_NUM)) {
                        $vars_i_want = mysqli_fetch_array($result_query, MYSQLI_NUM);
                        $arrayNames = array($vars_i_want[0], $vars_i_want[1]);
                        console_log($arrayNames);
                        $arrayNames = json_encode($arrayNames);
                        $html[] = "<tr><td>" . implode("</td><td>", $row)
                        . "</td> <td> <button type='button' onclick='Aceitar_cand($arrayNames)' class='btn btn-success'>Aceitar</button> </td> <td><button type='button' onclick='Recusar_cand($arrayNames)' class='btn btn-success'>Recusar</button></td> </tr>";
                    };

                    $html = $headertabela . implode("\n", $html) . "</table>";
                    echo $html;
                    
                    mysqli_close($conn);
                    

                    
                ?>
                <script>
                 function Aceitar_cand(array) {
                        
                        let cc = parseInt(array[0]);
                        let id_accao = parseInt(array[1]);
                        var xhttp;
                        xhttp = new XMLHttpRequest();

                        xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            
                            username = this.responseText;
                            
                        };
                        };

                        xhttp.open("GET", "../php/aceitar.php?cc="+cc+"&id="+id_accao, true);
                        xhttp.send();
                    };
                
                    function Recusar_cand(array) {
                        
                        let cc = parseInt(array[0]);
                        let id_accao = parseInt(array[1]);
                        var xhttp;
                        xhttp = new XMLHttpRequest();

                        xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            username = this.responseText;
                            
                        };
                        };

                        xhttp.open("GET", "../php/recusar.php?cc="+cc+"&id="+id_accao, true);
                        xhttp.send();
                    
                    };       
                
                </script>
                </form>
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
                    <img src="./img/logo3.png" width="190" alt="">
                </div>    
               
            </div>
    
        </footer>

