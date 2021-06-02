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
                    <li class="nav-item">
                        <a class="nav-link">Procurar Voluntários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accoes_admin.php">Procurar Acções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ligacao_int_vol_admin.php">Procurar Correspondências</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main id = "fundo_admin_v">

        <div class="container-fluid px-5 " > 
            <form method="post" class="row g-3">
            

                <div class="col-md-6">
                <label for="inputEmail4" class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                <label for="Nome" class="form-label text-light">Nome</label>
                <input type="text" name = "nome"  class="form-control" id="Nome">
                </div>
                <div class="col-md-6">
                <label for="concelho" class="form-label text-light">Concelho</label>
                <input type="text" name = "concelho" class="form-control" id="concelho">
                </div>
                <div class="col-md-6">
                    <label for="distrito" class="form-label text-light">Distrito</label>
                    <input type="text" name = "distrito" class="form-control" id="distrito">
                </div>
                <div class="col-12">
                    <label for="inputState" class="form-label text-light">Faixa etária</label>
                    <select id="inputState" class="form-select">
                    <option selected>Selecione uma</option>
                    <option>15-20</option>
                    <option>20-25</option>
                    <option>25-30</option>
                    <option>30-35</option>
                    <option>36-40</option>
                    <option>41-45</option>
                    <option>46-50</option>
                    <option>51-55</option>
                    <option>56-60</option>
                    <option>61-65</option>
                    <option>66-70</option>
                    <option>71-75</option>
                    <option>76-80</option>
                    <option>81-85</option>
                    <option>86-90</option>
                    <option>91-95</option>
                    <option>96-100</option>
                    </select>
                
                </div>
                <div class="col-12 mb-5">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col px-5 pb-5">
                <?php

                include "../php/openconn.php";

                function console_log( $data ){
                    echo '<script>';
                    echo 'console.log('. json_encode( $data ) .')';
                    echo '</script>';
                }

                mysqli_query($conn, "SET NAMES'utf8'");

                $tabela = 'voluntario_registo';
                $headertabela = '<table class="table text-center table-striped table-light table-hover"> <tr> <th>Nome</th> 
                <th>Apelido</th> <th>Data de Nascimento</th> <th>Genero</th> <th>Distrito</th> 
                <th>Concelho</th> <th>Freguesia</th> <th>Telefone</th> <th>Cartão de Cidadão</th>
                <th>Carta de Condução</th> <th>Email</th> <th>Password</th> <th>Foto</th></tr>';

                $nome = htmlspecialchars($_POST['nome']);
                if ($nome) {
                    $sql[] = "nome = '$nome'";
                }

                $apelido = htmlspecialchars($_POST['apelido']);
                if ($apelido) {
                    $sql[] = "apelido = '$apelido'";
                }

                //$dia_nasc = htmlspecialchars($_POST['dia_nasc']);
                //$mes_nasc = htmlspecialchars($_POST['mes_nasc']);
                //$ano_nasc = htmlspecialchars($_POST['ano_nasc']);
                //$data_nasc_nova = $dia_nasc .'-'. $mes_nasc .'-'. $ano_nasc;

                $genero = htmlspecialchars($_POST['genero']);
                if ($genero) {
                    $sql[] = "genero = '$genero'";
                }

                $telefone = htmlspecialchars($_POST['telefone']);
                if ($telefone) {
                    $sql[] = "telefone = '$telefone'";
                }

                $cc = htmlspecialchars($_POST['cc']);
                if ($cc) {
                    $sql[] = "cc = '$cc'";
                }

                $carta_conducao = htmlspecialchars($_POST['carta_conducao']);
                if ($carta_conducao) {
                    $sql[] = "carta = '$carta_conducao'";
                }

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

                $email = htmlspecialchars($_POST['email']);
                if ($email) {
                    $sql[] = "mail = '$email'";
                }

                $query = "SELECT * FROM $tabela ";

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
                console_log($result);
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

