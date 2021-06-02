<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/logo3.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_styles.css">
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
                        <a class="nav-link" href="index_admin.php">Procurar Instituições</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="voluntario_admin.php">Procurar Voluntários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Procurar Acções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ligacao_int_vol_admin.php">Procurar Correspondências</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main id = "fundo_admin_a">

        <div class="container-fluid px-5 " > 
            <form method="post" class="row g-3">
            
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
                <div class="col-md-6">
                <label for="freguesia" class="form-label text-light">Freguesia</label>
                <input type="text" name = "freguesia" class="form-control" id="freguesia">
                </div>
                <div class="col-md-6">
                    <label for="area" class="form-label text-light">Área de Interesse</label>
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
                <div class="col-md-6">
                    <label for="dia" class="form-label text-light">Dia da Semana</label>
                    <select id="dia" name="dia" class="form-select mb-3" aria-label="Selecione uma opção">
                        <option selected value="">Selecione uma opção</option>
                        <option value= 1>Segunda-feira</option>
                        <option value= 2>Terça-feira</option>
                        <option value= 3>Quarta-feira</option>
                        <option value= 4>Quinta-feira</option>
                        <option value= 5>Sexta-feira</option>
                        <option value= 6>Sábado</option>
                        <option value= 7>Domingo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="periodo" class="form-label text-light">Periodo do Dia</label>
                    <select id="periodo" name="periodo" class="form-select mb-3" aria-label="Selecione uma opção">
                        <option selected value="">Selecione uma opção</option>
                        <option value= 1>Manhã</option>
                        <option value= 2>Tarde</option>
                        <option value= 3>Noite</option>
                    </select>
                </div> 
                <div class="col-md-6 mb-5 mt-5">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col px-5 pb-5">
                <?php

                include "../php/openconn.php";

                mysqli_query($conn, "SET NAMES'utf8'");

                function console_log( $data ){
                    echo '<script>';
                    echo 'console.log('. json_encode( $data ) .')';
                    echo '</script>';
                }

                $tabela = 'accao_voluntariado';
                $headertabela = '<table class="table text-center table-light table-striped table-hover"> <tr> <th>Vagas</th> 
                <th>Função</th> <th>Área</th> <th>População</th> <th>Dia da Semana</th> <th>Periodo</th> <th>Distrito</th> 
                <th>Concelho</th> <th>Freguesia</th> </tr>';

                $distrito = htmlspecialchars($_POST['distrito']);
                if ($distrito) {
                    $sql[] = "distrito = '$distrito'";
                }

                $concelho = htmlspecialchars($_POST['concelho']);
                if ($concelho) {
                    $sql[] = "concelho = '$concelho'";
                }

                $freguesia = htmlspecialchars($_POST['freguesia']);
                if ($freguesia) {
                    $sql[] = "freguesia = '$freguesia'";
                }

                $area = htmlspecialchars($_POST['area']);
                if ($area) {
                    $sql[] = "area = '$area'";
                }

                $populacao = htmlspecialchars($_POST['populacao']);
                if ($populacao) {
                    $sql[] = "populacao = '$populacao'";
                }

                $periodo = htmlspecialchars($_POST['periodo']);
                if ($periodo) {
                    $sql[] = "periodo = '$periodo'";
                }

                $dia = htmlspecialchars($_POST['dia']);
                if ($dia) {
                    $sql[] = "dia = '$dia'";
                }

                $query = "SELECT vagas, funcao, ai.nome, pa.nome_pop_alvo, ds.nome_dia, pd.nome_periodo, distrito, concelho, freguesia FROM accao_voluntariado av
                        LEFT JOIN areas_interesse ai ON (av.area = ai.id_area)
                        LEFT JOIN populacao_alvo pa ON (av.populacao = pa.id_pop_alvo)
                        LEFT JOIN horario_acoes ha ON (av.id_accao = ha.id)
                        LEFT JOIN dia_semana ds ON (ha.dia = ds.id_dia)
                        LEFT JOIN periodo_dia pd ON (ha.periodo = pd.id_periodo)";

                if (!empty($sql)) {
                    $query .= 'WHERE ' . implode('AND', $sql);
                }

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    $html[] = "<tr><td>" .
                    implode("</td><td>", $row) .
                    "</td></tr>";
                }

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
    <script src="../Site/scripts/admin.js"></script>
    
  </body>
</html>


