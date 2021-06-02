<?php 
include "openconn.php";

session_start(); 

$mail = $_SESSION["username"];

$sql_query = "SELECT * FROM instituicao_registo WHERE mail = N'$mail'";
$result_query = mysqli_query($conn, $sql_query);
$campo_db = mysqli_fetch_array($result_query);

$nome_insituicao = utf8_encode($campo_db['nome']);
$descricao = utf8_encode($campo_db['descricao']);
$telefone = $campo_db['telefone'];
$morada = utf8_encode($campo_db['morada']);
$distrito = utf8_encode ($campo_db['distrito']);
$concelho = utf8_encode ($campo_db['concelho']);
$freguesia = utf8_encode ($campo_db['freguesia']);
$mail_instituicao = $campo_db['mail'];
$website = $campo_db['website'];
$nome_representante =  utf8_encode ($campo_db['nome_representante']);
$mail_representante = $campo_db['mail_representante'];
$password = $campo_db['pass'];

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

console_log($mail);

?>


<!doctype html>
<html lang="pt">

<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/logo3.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/alterarV.css">

    <title>Registo</title>
</head>

<body class="grid-container-register" id="background-alterar">   

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="index.php"><img src="../Site/img/logo3.png" width="40" style="margin-right: 5px;" alt="Logo VoluntárioCOVID19"> VoluntárioCOVID19</a>
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
                            <a class="nav-link">A minha instituição</a>
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
    
    <main class="form-register">
        <img class=" logo_register" src="img/logo5.png" alt="Logo VoluntárioCOVID19"  width="170">
            
            <div id="divHeader" class="mx-auto">
                <h1 class="h1 mb-4 fw-normal">Alterar dados</h1>
            </div>

            <div class="container">
                <div class="px-4 py-4 editar-perfil-background">

                    <form action="../php/alterar_dadosI.php" method="post" >
                        <div class="alterar-perfil-div-inicial">
                            <div class="row ">
            
                                <div class="col-sm-3">
                                    <label for="nome" class="form-label">Nome Instituição </label>
                                    <input type="text" name="nome" class="form-control mb-3" placeholder="Nome" value="<?php echo $nome_insituicao; ?>" disabled>
                                </div>

                                <div class="col-sm-6">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" name = "website" class="form-control mb-3" placeholder="Website" value="<?php echo $website; ?>" disabled>
                                </div>

                                <div class="col-sm-3">

                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group mb-3">
                                        <input name="telefone" type="tel" class="form-control" placeholder="Telefone" aria-label="Telefone"
                                            aria-describedby="Telefone" value="<?php echo $telefone; ?>" disabled>
                                    </div>
                                    
                                </div>
                            
                            </div>
                            <div class="row">

                                <div class="col-sm">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <input name="distrito" class="form-control mb-3" list="datalistDistrito" placeholder="Escreva para procurar..." value="<?php echo $distrito; ?>" disabled>

                                </div>

                                <div class="col-sm">
                                    
                                    <label for="freguesia" class="form-label">Freguesia</label>
                                    <input name="freguesia" class="form-control mb-3" list="datalistFreguesia" placeholder="Freguesia" value="<?php echo $freguesia; ?>" disabled>
                                
                                </div>
                                <div class="col-sm">
                                    <label for="concelho" class="form-label">Concelho</label>
                                    <input name="concelho" class="form-control mb-3" list="datalistFreguesia" placeholder="Concelho" value="<?php echo $concelho; ?>" disabled>
                                    
                                </div>

                            </div>
                        
                            <div class="row">
                                <div class="col-sm">
                                    <label for="morada" class="form-label">Morada</label>
                                    <input type="text" name = "morada" class="form-control mb-3" placeholder="Morada" value="<?php echo $morada; ?>" disabled>
                                </div>

                                <div class="col">
                                    <label for="newEmail" class="form-label">Endereço Email Representante</label>
                                    <input name="newEmail" type="email" class="form-control mb-3" placeholder="Email atual" value="<?php echo $mail_representante; ?>" disabled>
                                </div>

                                <div class="col-sm">
                                    <label for="nomeRepresentante" class="form-label">Nome Representante </label>
                                    <input type="text" name="nomeRepresentante" class="form-control mb-3" placeholder="Nome Representante" value="<?php echo $nome_representante; ?>" disabled>
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm">
                                        <label class = "form-label" for="descricao_instituicao">Descrição Instituição</label>
                                        <textarea class="form-control" name="descricao" aria-label="With textarea" rows="2" placeholder="Descrição" disabled><?php echo $descricao; ?></textarea>
                                </div>
                                
                            </div>
                        </div>

                        <div class="alterar-perfil-div-final">
                            <div class="row ">
            
                                <div class="col-sm-3">
                                    <label for="nome" class="form-label">Nome Instituição </label>
                                    <input type="text" name="nome" id="nome" class="form-control mb-3" placeholder="Nome" value="<?php echo $nome_insituicao; ?>" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" name = "website" id="website" class="form-control mb-3" placeholder="Website" value="<?php echo $website; ?>">
                                </div>

                                <div class="col-sm-3">

                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group mb-3">
                                        <input id="telefone" name="telefone" maxlength="9" type="tel" class="form-control" placeholder="Telefone" aria-label="Telefone"
                                            aria-describedby="Telefone" value="<?php echo $telefone; ?>" required>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <input name="distrito" class="form-control mb-3" list="datalistDistrito" id="distrito" placeholder="Escreva para procurar..." value="<?php echo $distrito ?>" required>

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

                                <div class="col-sm">
                                    
                                    <label for="freguesia" class="form-label">Freguesia</label>
                                    <input name="freguesia" class="form-control mb-3" list="datalistFreguesia" id="freguesia" placeholder="Escreva para procurar..." value="<?php echo $freguesia; ?>" required>
                                    <datalist id="datalistFreguesia">
                                        <option value="Freguesias">
                                    </datalist>
                                </div>
                                <div class="col-sm">
                                    <label for="concelho" class="form-label">Concelho</label>
                                    <input name="concelho" class="form-control mb-3" list="datalistFreguesia" id="concelho" placeholder="Escreva para procurar..." value="<?php echo $concelho; ?>" required>
                                    <datalist id="datalistConcelho">
                                        <option value="Concelho">
                                    </datalist>
                                    
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm">
                                    <label for="morada" class="form-label">Morada</label>
                                    <input type="text" name = "morada" id="morada" class="form-control mb-3" placeholder="Morada" value="<?php echo $morada; ?>" required>
                                </div>

                                <div class="col">
                                    <label for="newEmail" class="form-label">Endereço Email Representante</label>
                                    <input name="newEmail" type="email" id="newEmail" class="form-control mb-3" placeholder="Email atual" value="<?php echo $mail_representante; ?>" required>
                                </div>

                                <div class="col-sm">
                                    <label for="nomeRepresentante" class="form-label">Nome Representante </label>
                                    <input type="text" name="nomeRepresentante" id="nomeRepresentante" class="form-control mb-3" placeholder="Nome Representante" value="<?php echo $nome_representante; ?>" required>
                                </div>
                                
                            </div>

                            <div class="row mb-3">

                                <div class="col-sm">
                                    <label class = "form-label" for="descricao_instituicao">Descrição Instituição</label>
                                    <textarea class="form-control" name="descricao" aria-label="With textarea" rows="2" placeholder="Descrição" ><?php echo $descricao; ?></textarea>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" id="cancelar-alterar-btn" onclick="trocarPerfil('cancelar')" >Cancelar</button>
                                </div>
                                
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" id="confirmar-alterar-btn" type="submit" >Confirmar Alterações</button>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                    <div class="row-sm">
                        <div class="col-md-4 mx-auto mb-1">
                            <button class="w-100 btn btn-lg btn-inst" id="alterar-perfil-btn" onclick="trocarPerfil('alterar')">Editar Perfil</button>
                        </div>
                    </div>
                </div>

                
                
                
                <div class="row mt-4">

                    <div class="col-sm px-4 py-4 editar-email-background">

                        <form action="../php/alterar_dadosI.php" method="post" >

                            <div class="alterar-email-div-inicial">
                                <div class="col-sm">
                                    <label for="currentEmailInstituicao" class="form-label">Endereço Email Instituição</label>
                                    <input type="email" name="currentEmailInstituicao" class="form-control mb-3" placeholder="Email" value="<?php echo $mail_instituicao; ?>" disabled>
                                </div>
    
                            </div>

                            <div class="alterar-email-div-final">

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="currentEmailInstituicao" class="form-label">Endereço Email Instituição</label>
                                        <input type="email" name="currentEmailInstituicao" id="currentEmailInstituicao" class="form-control mb-3" placeholder="Email" value="<?php echo $mail_instituicao; ?>" disabled>
                                    </div>

                                    <div class="col-sm">
                                        <label for="newEmailInstituicao" class="form-label">Novo Email Instituição</label>
                                        <input type="email" name="newEmailInstituicao" id="newEmailInstituicao" class="form-control mb-3" placeholder="Novo Email Instituição" required>
                                    </div>
                                </div>
    
                                <div class="col-sm">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" id="cancelar-alterar-btn" onclick="trocarEmail('cancelar')" >Cancelar</button>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" id="confirmar-alterar-btn" type="submit">Confirmar Email</button>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>
                            
                        </form>

                        <div class="col-sm-7 mx-auto editar-email-background">
                            <button class="w-100 btn btn-lg btn-inst" onclick="trocarEmail('alterar')" id="alterar-email-btn">Alterar Email</button>
                        </div>
                    </div>

                    <div class="col-sm px-4 py-4 editar-password-background">

                        <form action="../php/alterar_dadosI.php" method="post">
                            <div class="alterar-password-div-inicial">
                                <div class="col-sm">
                                    <label for="oldPassword" class="form-label">Password Atual</label>
                                    <input type="password" class="form-control mb-3" placeholder="Password Atual" disabled>
                                </div>

                            </div>

                            <div class="alterar-password-div-final">

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="oldPassword" class="form-label">Password Atual</label>
                                        <input type="password" name="oldPassword" id="oldPassword" class="form-control mb-3" placeholder="Password atual" required>
                                    </div>
                                    <div class="col-sm">
                                        <label for="newPassword" class="form-label">Password Nova</label>
                                        <input type="password" name="newPassword" id="newPassword" class="form-control mb-3" placeholder="Password nova" required>
                                    </div>
        
                                    <div class="col-sm">
                                        <label for="confirmPassword" class="form-label">Confirmar Password Nova</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control mb-3" placeholder="Confirmar password nova" required>
                                    </div>
                                </div>

                                <div class="col-sm">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" id="cancelar-alterar-btn" onclick="trocarPalavraPasse('cancelar')" >Cancelar</button>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" id="confirmar-alterar-btn" onclick="trocarPalavraPasse('confirmar')">Confirmar Palavra-passe</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                        </form>
                        <div class="col-sm-8 mx-auto alterar-password-div-inicial"  >
                            <button class="w-100 btn btn-lg btn-inst" id="alterar-password-btn" onclick="trocarPalavraPasse('alterar')">Alterar Palavra-passe</button>
                        </div>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="scripts/alterar.js"></script>

</body>
</html>