<!doctype html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/logo3.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/register.css">

    <title>Registo</title>
</head>

<body class="grid-container-register">   

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 5px;" alt="Logo VoluntárioCOVID19"> VoluntárioCOVID19</a>
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
    
    <main class="form-register" id="voluntario_background">
        <img class=" logo_register" src="img/logo5.png" alt="Logo VoluntárioCOVID19"  width="170">
        <form method="post" enctype="multipart/form-data">
            
            <div id="divHeader" class="mx-auto">
                <h1 class="h1 mb-4 fw-normal">Registo Voluntário</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control mb-3" placeholder="Nome" required>
                    </div>

                    <div class="col-md-3">
                        <label for="apelido" class="form-label">Apelido</label>
                        <input type="text" name="apelido" id="apelido" class="form-control mb-3" placeholder="Apelido" required>
                    </div>

                    <div class="col-md-3">
                        <label for="dia_nascimento" class="form-label">Data de Nascimento</label>
                        <div class="input-group mb-3">
                            <input type="number" name="dia_nasc" id="dia_nascimento" class="form-control" placeholder="Dia" aria-label="Dia de Nascimento" required>
                            <input type="number" name="mes_nasc" id="mes_nascimento" class="form-control" placeholder="Mês" aria-label="Mês de Nascimento" required>
                            <input type="number" name="ano_nasc" id="ano_nascimento" class="form-control" placeholder="Ano" aria-label="Ano de Nascimento" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="genero" class="form-label">Género</label>
                        <select id="genero" name="genero" class="form-select mb-3" aria-label="Selecione uma opção" required>
                            <option selected>Selecione uma opção</option>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                            <option value="N">Prefiro não dizer</option>
                        </select>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <div class="input-group mb-3">
                            <input id="telefone" name="telefone" type="tel" class="form-control" maxlength="9" placeholder="Telefone" aria-label="Telefone"
                                aria-describedby="Telefone" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="cc" class="form-label">Cartão de Cidadão</label>
                        <div class="input-group mb-3">
                            <input id="cc" name="cc" type="tel" class="form-control" maxlength="7" placeholder="CC" aria-label="Cartão de Cidadão"
                                aria-describedby="Cartão de Cidadão" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto de Perfil (.png) (Opcional)</label>
                            <input class="form-control" name="fotoPerfil" type="file" id="foto">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cartaConducao" class="form-label">Possui Carta de Condução?</label>
                        <select id="cartaConducao" name="carta_conducao" class="form-select mb-3" aria-label="Selecione uma opção" required>
                            <option selected>Selecione uma opção</option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="distrito" class="form-label">Distrito</label>
                        <input type="text" name="distrito" class="form-control mb-3" list="datalistDistrito" onkeyup="showHint(this.value)" id="distrito" placeholder="Escreva para procurar..." required>                        
            
                        <datalist id="datalistDistrito">
                        
                        </datalist>
                        
                    </div>

                    <div class="col-md-4">
                        <label for="concelho" class="form-label">Concelho</label>
                        <input class="form-control mb-3" type="text" name = "concelho" list="datalistConcelho" onkeyup="showHint1(this.value)" id="concelho" placeholder="Escreva para procurar..." required>
                        
                        <datalist id="datalistConcelho">
                        
                        </datalist>
                    </div>
                
                    <div class="col-md-4">
                        <label for="freguesia" class="form-label">Freguesia</label>
                        <input type="text" class="form-control mb-3" name = "freguesia" list="datalistFreguesias" onkeyup="showHint2(this.value)" id="freguesia" placeholder="Escreva para procurar..." required>
                    
                        <datalist id="datalistFreguesias">
                        
                        </datalist>

                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <label for="email" class="form-label">Endereço Email</label>
                        <input name="email" type="email" id="email" class="form-control mb-3" placeholder="Email" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Password" required>
                    </div>

                    <div class="col-md-3">
                        <label for="confirmPassword" class="form-label">Confirmar Password</label>
                        <input type="password" name="confirmar_password" id="confirmpassword" class="form-control mb-3" placeholder="Confirmar Password" required>
                    </div>

                </div>

                <div class="col-md-2 mx-auto">
                    <button class="w-100 btn btn-lg btn-register" type="submit" name="submit">Registar</button>
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

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

include "openconn.php";

session_start();

$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$dia_nasc = $_POST['dia_nasc'];
$mes_nasc = $_POST['mes_nasc'];
$ano_nasc = $_POST['ano_nasc'];
$data_nasc = $dia_nasc .'-'. $mes_nasc .'-'. $ano_nasc;
$genero = $_POST['genero'];
$telefone = $_POST['telefone'];
$cc = $_POST['cc'];
$carta_conducao = $_POST['carta_conducao'];
$distrito = $_POST['distrito'];
$concelho = $_POST['concelho'];
$freguesia = $_POST['freguesia'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmar_password = $_POST['confirmar_password'];
$password = password_hash($password, PASSWORD_BCRYPT);

$dirfotos = "fotos/";
$foto = $dirfotos . basename($_FILES["fotoPerfil"]["name"]);
console_log($foto);
console_log($_FILES["fotoPerfil"]["tmp_name"]);
if (move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $foto)) {
    console_log("Uploaded");
} else {
    console_log("ERROR: NOT UPLOADED");
}

if (isset( $_POST['submit'])){
    $sql = "insert into voluntario_registo(nome, apelido, data_nascimento, genero, distrito, concelho, freguesia, telefone, cc, carta, mail, pass, foto) 
    VALUES (N'$nome', N'$apelido', STR_TO_DATE('$data_nasc', '%d-%m-%Y'), '$genero', N'$distrito', N'$concelho', N'$freguesia', $telefone, $cc, '$carta_conducao', '$email', '$password', '$foto');";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $email;

        $sqlcount = "SELECT COUNT(*) FROM chat_ligacao_utilizadores";
        $resultsel = mysqli_query($conn, $sqlcount);
        $counter = mysqli_fetch_all($resultsel);
        $chatid = intval($counter[0][0]);

        $chatid = $chatid + 1;

        $sqlchatid = "insert into chat_ligacao_utilizadores(chatid, volid) VALUES ($chatid, $cc);";
        mysqli_query($conn, $sqlchatid);

        echo "<script>window.location.href='index_user.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>