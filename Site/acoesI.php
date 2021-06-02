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

            <a class="navbar-brand" href="../Site/index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 10px;" alt="">VoluntárioCOVID19</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link">Ações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="candidatos_a_acao.php">Voluntários</a>
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
                        <input type="submit" name="Logout"
                            class="btn btn-login" value="Logout"> 
                        </form>
            </div>
        </div>
    </nav>

    
   <main id = "fundo">
    <div class="container-fluid pt-4 px-5"> 
            <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="instituiçao" class="form-label text-light">Nome da Instituição</label>
                <input type="text" name = "instituiçao" class="form-control" id="instituiçao">
                </div>
            <div class="col-md-6">
                    <label for="vagas" class="form-label text-light">Vagas</label>
                    <input type="number" name = "vagas" class="form-control" id="vagas">
                </div>
                <div class="col-md-6">
                <label for="funcao" class="form-label text-light">Função</label>
                <input type="text" name = "funcao" class="form-control" id="funcao">
                </div>
                <div class="col-md-6">
                    <label for="area" class="form-label text-light">Area de Interesse</label>
                    <select id="area" name="area" class="form-select mb-3" aria-label="Selecione uma opção">
                        <option selected value = "">Selecione uma opção</option>
                        <option value= 1>Artes e Entretenimento</option>
                        <option value= 2>Atividade Política</option>
                        <option value= 3>Ação Social</option>
                        <option value= 4>Comunicação e Publicidade</option>
                        <option value= 5>Educação</option>
                        <option value= 6>Inovação e Tecnologias</option>
                        <option value= 7>Meio Ambiente e Energias</option>
                        <option value= 8>Moda e Beleza</option>
                        <option value= 9>Saúde e Bem-estar</option>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="populacao" class="form-label text-light">População Alvo</label>
                <select id="populacao" name="populacao" class="form-select mb-3" aria-label="Selecione uma opção">
                        <option selected value="">Selecione uma opção</option>
                        <option value= 1>Crianças</option>
                        <option value= 2>Jovens</option>
                        <option value= 3>Adultos</option>
                        <option value= 4>Idosos</option>
                        <option value= 5>Família</option>
                    </select>
                </div>
            
                <div class="col-md-6 mb-5">
                    <label for="periodo" class="form-label text-light">Periodo do Dia</label>
                    <select id="periodo" name="periodo" class="form-select mb-3" aria-label="Selecione uma opção">
                        <option selected value="">Selecione uma opção</option>
                        <option value= 1>Manhã</option>
                        <option value= 2>Tarde</option>
                        <option value= 3>Noite</option>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="distrito" class="form-label text-light">Distrito</label>
                <input name="distrito" class="form-control mb-3" list="datalistDistrito" id="distrito" placeholder="Escreva para procurar...">
                    <datalist id="datalistDistrito">
                        <option value="Aveiro">
                        <option value="Beja">
                        <option value="Braga">
                        <option value="Bragança">
                        <option value="Castelo Branco">
                        <option value="Coimbra">
                        <option value="Évora">
                        <option value="Faro">
                        <option value="Guarda">
                        <option value="Leiria">
                        <option value="Lisboa">
                        <option value="Portalegre">
                        <option value="Porto">
                        <option value="Santarém">
                        <option value="Setúbal">
                        <option value="Viana do Castelo">
                        <option value="Vila Real">
                        <option value="Viseu">
                    </datalist>
                </div>
                <div class="col-md-6">
                <label for="concelho" class="form-label text-light">Concelho</label>
                <input type="text" name = "concelho" class="form-control" id="concelho">
                </div>
                
                
                <div class="col-md-6 mb-5 mt-5">
                <button type="submit" class="btn btn-recv">Filtrar</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col px-5">
                <?php

                include "../php/openconn.php";
                mysqli_query($conn, "SET NAMES'utf8'");

                function console_log( $data ){
                    echo '<script>';
                    echo 'console.log('. json_encode( $data ) .')';
                    echo '</script>';
                }

                $tabela = 'accao_voluntariado';
                $tabela1 = 'accao_ligacao_voluntariado';
                $tabela2 = 'voluntario registo';
                $headertabela = '<table class="table table-striped table-hover text-center table-light mb-5"> <tr><th>Nome da Instituição</th> <th>Ação</th> <th>Vagas</th> <th>Função</th> 
                <th>Area</th> <th>População</th> <th>Periodo</th><th>Dia</th> <th>Distrito</th> 
                <th>Concelho</th><th>Nome Voluntário</th><th>Apelido</th><th>Email</th></tr>';

                $distrito = htmlspecialchars($_POST['distrito']);
                if ($distrito != '') {
                    console_log($distrito);
                    $sql[] = "distrito = '$distrito'";
                }

                $concelho = htmlspecialchars($_POST['concelho']);
                if ($concelho != '') {
                    $sql[] = "concelho = '$concelho'";
                }

                $funcao = htmlspecialchars($_POST['funcao']);
                if ($funcao != '') {
                    $sql[] = "funcao = '$funcao'";
                }

                $area = htmlspecialchars($_POST['area']);
                if ($area != '') {
                    $sql[] = "nome = '$area'";
                }

                $populacao = htmlspecialchars($_POST['populacao']);
                if ($populacao != '') {
                    $sql[] = "populacao = '$populacao'";
                }

                $vagas = htmlspecialchars($_POST['vagas']);
                if ($vagas != '') {
                    $sql[] = "vagas = '$vagas'";
                }

                $periodo = htmlspecialchars($_POST['periodo']);
                if ($periodo != '') {
                    $sql[] = "periodo = '$periodo'";
                }

                $query = "SELECT DISTINCT nome_inst, nome_acao, vagas, funcao, ai.nome, pa.nome_pop_alvo, ds.nome_dia, pd.nome_periodo, av.distrito, av.concelho, vr.nome, vr.apelido, vr.mail 
                FROM accao_voluntariado av 
                LEFT JOIN accao_ligacao_voluntario alv ON (av.id_accao = alv.id_accao) 
                LEFT JOIN voluntario_registo vr ON (vr.cc = alv.cc) 
                LEFT JOIN horario_acoes ha ON (ha.id = av.id_accao) 
                LEFT JOIN areas_interesse ai ON (av.area = ai.id_area) 
                LEFT JOIN populacao_alvo pa ON (av.populacao = pa.id_pop_alvo) 
                LEFT JOIN horario_acoes h ON (av.id_accao = h.id) 
                LEFT JOIN dia_semana ds ON (ha.dia = ds.id_dia) 
                LEFT JOIN periodo_dia pd ON (ha.periodo = pd.id_periodo)";

                console_log($query);

                if (!empty($sql)) {
                    $query .= ' WHERE ' . implode(' AND ', $sql);
                }

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    $html[] = "<tr><td>" .
                    implode("</td><td>", $row) .
                    "</td></tr>";
                }

                $html = $headertabela . implode("\n", $html) . "</table>";
                console_log($query);

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
</html>
