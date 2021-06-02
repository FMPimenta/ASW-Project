<?php 
include "openconn.php";

session_start(); 

$mail = $_SESSION["username"];
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$sql_query_voluntario = "SELECT * FROM voluntario_registo WHERE mail = N'$mail'";
$result_query = mysqli_query($conn, $sql_query_voluntario);
$campo_db = mysqli_fetch_array($result_query);  

$cc = $campo_db['cc'];
$sql_query_pop = "SELECT * FROM pop_alvo_ligacao_voluntario WHERE cc = $cc";
$result_query = mysqli_query($conn, $sql_query_pop);
$campo_pop_db = mysqli_fetch_all($result_query);

$sql_query_areas = "SELECT * FROM areas_ligacao_voluntario WHERE cc = $cc";
$result_query = mysqli_query($conn, $sql_query_areas);
$campo_areas_db = mysqli_fetch_all($result_query);

$sql_query_disponibilidade = "SELECT * FROM disponibilidade_ligacao_voluntario WHERE cc = $cc";
$result_query = mysqli_query($conn, $sql_query_disponibilidade);
$campo_disponibilidade_db = mysqli_fetch_all($result_query);

$segunda = 'unchecked';
$terca = 'unchecked';
$quarta = 'unchecked';
$quinta = 'unchecked';
$sexta = 'unchecked';
$sabado = 'unchecked'; 
$domingo = 'unchecked';

$array_dias = array('segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo');
$array_periodo = array('manha', 'tarde', 'noite');

for ($x = 0; $x < count($array_dias); $x++) {
    for ($a = 0; $a < count($array_periodo); $a++) {
        ${$array_dias[$x] . '_' . $array_periodo[$a]} = 'unchecked';  
    }
}

$arrayLengthDispo = count($campo_disponibilidade_db);
for ($x = 0; $x < $arrayLengthDispo; $x++) {
    if ($campo_disponibilidade_db[$x][1] == 1) {
        $segunda = 'checked';
        $_POST['segunda'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $segunda_manha = 'checked';
            $_POST['segunda_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $segunda_tarde = 'checked';
            $_POST['segunda_tarde'] = true;
        }else {
            $segunda_noite = 'checked';
            $_POST['segunda_noite'] = true;
        }

    } else if ($campo_disponibilidade_db[$x][1] == 2) {
        $terca = 'checked';
        $_POST['terca'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $terca_manha = 'checked';
            $_POST['terca_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $terca_tarde = 'checked';
            $_POST['terca_tarde'] = true;
        }else {
            $terca_noite = 'checked';
            $_POST['terca_noite'] = true;
        }
    } else if ($campo_disponibilidade_db[$x][1] == 3) {
        $quarta = 'checked';
        $_POST['quarta'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $quarta_manha = 'checked';
            $_POST['quarta_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $quarta_tarde = 'checked';
            $_POST['quarta_tarde'] = true;
        }else {
            $quarta_noite = 'checked';
            $_POST['quarta_noite'] = true;
        }
    } else if ($campo_disponibilidade_db[$x][1] == 4) {
        $quinta = 'checked';
        $_POST['quinta'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $quinta_manha = 'checked';
            $_POST['quinta_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $quinta_tarde = 'checked';
            $_POST['quinta_tarde'] = true;
        }else {
            $quinta_noite = 'checked';
            $_POST['quinta_noite'] = true;
        }
    } else if ($campo_disponibilidade_db[$x][1] == 5) {
        $sexta = 'checked';
        $_POST['sexta'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $sexta_manha = 'checked';
            $_POST['sexta_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $sexta_tarde = 'checked';
            $_POST['sexta_tarde'] = true;
        }else {
            $sexta_noite = 'checked';
            $_POST['sexta_noite'] = true;
        }
    } else if ($campo_disponibilidade_db[$x][1] == 6) {
        $sabado = 'checked';
        $_POST['sabado'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $sabado_manha = 'checked';
            $_POST['sabado_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $sabado_tarde = 'checked';
            $_POST['sabado_tarde'] = true;
        }else {
            $sabado_noite = 'checked';
            $_POST['sabado_noite'] = true;
        }
    } else {
        $domingo = 'checked';
        $_POST['domingo'] = true;
        if ($campo_disponibilidade_db[$x][2] == 1) {
            $domingo_manha = 'checked';
            $_POST['domingo_manha'] = true;
        } else if ($campo_disponibilidade_db[$x][2] == 2) {
            $domingo_tarde = 'checked';
            $_POST['domingo_tarde'] = true;
        }else {
            $domingo_noite = 'checked';
            $_POST['domingo_noite'] = true;
        }
    }
}

$nome = utf8_encode($campo_db['nome']);
$apelido = utf8_encode($campo_db['apelido']);
$data_nasc = $campo_db['data_nascimento'];
$data_nasc_explode = explode('-', $data_nasc);
$ano_nasc = $data_nasc_explode[0];
$mes_nasc = $data_nasc_explode[1];
$dia_nasc = $data_nasc_explode[2];
$genero = $campo_db['genero'];

if ($genero == 'M' || $genero == "Masculino") {
    $genero = "Masculino";
} else if ($genero == 'F' || $genero == "Feminino"){
    $genero = "Feminino";
} else {
    $genero = "Prefiro Não dizer";
}
$telefone = $campo_db['telefone'];

$foto = $campo_db['foto'];
$nome_foto = substr($foto, 6);
if ($foto == "fotos/") {
    $foto = "img/logo5.png";
}

$carta_conducao = $campo_db['carta'];
if ($carta_conducao == 'S' || $carta_conducao == 'Sim') {
    $carta_conducao = "Sim";
} else {
    $carta_conducao = "Não";
}

$distrito = utf8_encode ($campo_db['distrito']);
$concelho = utf8_encode ($campo_db['concelho']);
$freguesia = utf8_encode ($campo_db['freguesia']);

$email = $campo_db['mail'];
$password = $campo_db['pass'];

$criancas = 'unchecked';
$jovens = 'unchecked';
$adultos = 'unchecked';
$idosos = 'unchecked';
$familia = 'unchecked';

$pop_alvo_selecionadas = "";
$arrayLength = count($campo_pop_db);
for ($x = 0; $x < $arrayLength; $x++) {
    if ($campo_pop_db[$x][1] == 1) {
        $criancas = 'checked';
        $pop_alvo_selecionadas .= "Crianças, ";
    } else if ($campo_pop_db[$x][1] == 2) {
        $jovens = 'checked';
        $pop_alvo_selecionadas .= "Jovens, ";
    } else if ($campo_pop_db[$x][1] == 3) {
        $adultos = 'checked';
        $pop_alvo_selecionadas .= "Adultos, ";
    } else if ($campo_pop_db[$x][1] == 4) {
        $idosos = 'checked';
        $pop_alvo_selecionadas .= "Idosos, ";
    } else {
        $familia = 'checked';
        $pop_alvo_selecionadas .= "Família, ";
    } 
}
$pop_alvo_selecionadas = substr($pop_alvo_selecionadas, 0, -2);

$artes = 'unchecked';
$atividade = 'unchecked';
$acao = 'unchecked';
$comunicacao = 'unchecked';
$educacao = 'unchecked';
$inovacao = 'unchecked';
$meio = 'unchecked';
$moda = 'unchecked';
$saude = 'unchecked';
$areas_selecionadas = "";
$arrayLength = count($campo_areas_db);
for ($x = 0; $x < $arrayLength; $x++) {
    if ($campo_areas_db[$x][1] == 1) {
        $artes = 'checked';
        $areas_selecionadas .= "Artes e Entretenimento, ";
    } else if ($campo_areas_db[$x][1] == 2) {
        $atividade = 'checked';
        $areas_selecionadas .= "Atividade Política, ";
    } else if ($campo_areas_db[$x][1] == 3) {
        $acao = 'checked';
        $areas_selecionadas .= "Ação Social, ";
    } else if ($campo_areas_db[$x][1] == 4) {
        $comunicacao = 'checked';
        $areas_selecionadas .= "Comunicação e Publicidade, ";
    } else if ($campo_areas_db[$x][1] == 5) {
        $educacao = 'checked';
        $areas_selecionadas .= "Educação, ";
    } else if ($campo_areas_db[$x][1] == 6) {
        $inovacao = 'checked';
        $areas_selecionadas .= "Inovação e Tecnologias, ";
    } else if ($campo_areas_db[$x][1] == 7) {
        $meio = 'checked';
        $areas_selecionadas .= "Meio Ambiente e Energias, ";
    } else if ($campo_areas_db[$x][1] == 8) {
        $moda = 'checked';
        $areas_selecionadas .= "Moda e Beleza, ";
    } else {
        $saude = 'checked';
        $areas_selecionadas .= "Saúde e Bem-estar, ";
    } 
}

$areas_selecionadas = substr($areas_selecionadas, 0, -2);


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
    
    <main class="form-register" >
        <img class=" logo_register" src="<?php echo $foto; ?>" alt="Foto de Perfil"  width="170">
            
            <div id="divHeader" class="mx-auto">
                <h1 class="h1 mb-4 fw-normal">Os Meus Dados</h1>
            </div>

            <div class="container">

                <div class="px-4 py-4 editar-perfil-background">
                    <form action="alterar_dadosV.php" method="post" enctype="multipart/form-data">
                    
                        <div class="alterar-perfil-div-inicial">
                            <div class="row" >
                                                    
                                <div class="col-sm ">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" name="nome" class="form-control mb-3" placeholder="Nome" value="<?php echo $nome; ?>"  disabled>
                                </div>
                                <div class="col-sm">
                                    <label for="apelido" class="form-label">Apelido</label>
                                    <input type="text" name="apelido" class="form-control mb-3" placeholder="Apelido" value="<?php echo $apelido; ?>" disabled>    
                                </div>
        
                                <div class="col-sm">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group mb-3">
                                        <input name="telefone" type="tel" class="form-control" placeholder="Telefone" aria-label="Telefone"
                                            aria-describedby="Telefone" value="<?php echo $telefone; ?>" disabled>
                                    </div>
                                </div>
        
                                <div class="col-sm">
                                    <label for="genero" class="form-label">Género</label>
                                    <input type="text" name="genero" class="form-control mb-3" placeholder="Género" value="<?php echo $genero; ?>" disabled >
                                </div>
                            
                            </div>
                        
                            <div class="row">
                            
                                <div class="col-sm">
                                    <label for="dia_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="text" name="data_nascimento" class="form-control mb-3" placeholder="Data de Nascimento" value="<?php echo $data_nasc;?>" disabled> 
                                                                
                                </div>
                                <div class="col-sm">
                                    <label for="cc" class="form-label">Cartão de Cidadão</label>
                                    <div class="input-group mb-3">
                                        <input name="cc" type="tel" class="form-control" placeholder="CC" aria-label="Cartão de Cidadão"
                                            aria-describedby="Cartão de Cidadão" value="<?php echo $cc; ?>" disabled>
                                    </div>
                                </div>
        
                                <div class="col-sm">
                                    <label for="cartaConducao" class="form-label">Possui Carta de Condução?</label>
                                    <input type="text" name="carta_conducao" class="form-control mb-3" placeholder="Carta de Condução" value="<?php echo $carta_conducao; ?>" disabled>
                                </div>
                             
                            </div>            
                    
                            <div class="row">
                                
                                <div class="col-sm">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <input name="distrito" class="form-control mb-3" placeholder="Escreva para procurar..." value="<?php echo $distrito; ?>" disabled>
                                    
                                </div>
                                <div class="col-sm">
                                    <label for="concelho" class="form-label">Concelho</label>
                                    <input name="concelho" class="form-control mb-3" placeholder="Escreva para procurar..." value="<?php echo $concelho; ?>" disabled >
                                   
                                </div>
        
                                <div class="col-sm">
                                    <label for="freguesia" class="form-label">Freguesia</label>
                                    <input name="freguesia" class="form-control mb-3" placeholder="Escreva para procurar..." value="<?php echo $freguesia; ?>" disabled>
                                    
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto de Perfil</label>
                                        <input class="form-control" name="foto" type="text" id="foto" placeholder="Local da Foto..." value="<?php echo $nome_foto; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="alterar-perfil-div-final">
                            <div class="row" >
                                                    
                                <div class="col-sm ">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control mb-3" placeholder="Nome" value="<?php echo $nome; ?>" required>
                                </div>
                                <div class="col-sm">
                                    <label for="apelido" class="form-label">Apelido</label>
                                    <input type="text" name="apelido" id="apelido" class="form-control mb-3" placeholder="Apelido" value="<?php echo $apelido; ?>" required>    
                                </div>
        
                                <div class="col-sm">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group mb-3">
                                        <input id="telefone" name="telefone" type="tel" class="form-control" maxlength="9" placeholder="Telefone" aria-label="Telefone"
                                            aria-describedby="Telefone" value="<?php echo $telefone; ?>" required>
                                    </div>
                                </div>
        
                                <div class="col-sm">
                                    <label for="genero" class="form-label">Género</label>
                                    <select id="genero" name="genero" class="form-select mb-3" aria-label="Selecione uma opção" required>
                                        <option selected><?php echo $genero; ?></option>
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
                                        <option value="N">Prefiro não dizer</option>
                                    </select>
                                </div>
                            
                            </div>
                        
                            <div class="row">
                            
                                <div class="col-sm">
                                    <label for="dia_nascimento" class="form-label">Data de Nascimento</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="dia_nasc" id="dia_nascimento" class="form-control" placeholder="Dia" value="<?php echo $dia_nasc; ?>" aria-label="Dia de Nascimento" required>
                                        <input type="number" name="mes_nasc" class="form-control" placeholder="Mês" value="<?php echo $mes_nasc; ?>" aria-label="Mês de Nascimento" required>
                                        <input type="number" name="ano_nasc" class="form-control" placeholder="Ano" value="<?php echo $ano_nasc; ?>" aria-label="Ano de Nascimento" required>
                                    </div>
                                                                
                                </div>
                                <div class="col-sm">
                                    <label for="cc" class="form-label">Cartão de Cidadão</label>
                                    <div class="input-group mb-3">
                                        <input id="cc" name="cc" type="tel" class="form-control" maxlength="7" placeholder="CC" aria-label="Cartão de Cidadão"
                                            aria-describedby="Cartão de Cidadão" value="<?php echo $cc; ?>" required>
                                    </div>
                                </div>
        
                                <div class="col-sm">
                                    <label for="cartaConducao" class="form-label">Possui Carta de Condução?</label>
                                    <select id="cartaConducao" name="carta_conducao" class="form-select mb-3" aria-label="Selecione uma opção" required>
                                        <option selected><?php echo $carta_conducao; ?></option>
                                        <option value="S">Sim</option>
                                        <option value="N">Não</option>
                                    </select>
                                </div>
                             
                            </div>            
                    
                            <div class="row">
                                
                                <div class="col-sm">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <input name="distrito" class="form-control mb-3" list="datalistDistrito" id="distrito" placeholder="Escreva para procurar..." value="<?php echo $distrito; ?>" required>
        
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
                                    <label for="concelho" class="form-label">Concelho</label>
                                    <input name="concelho" class="form-control mb-3" list="datalistFreguesia" id="concelho" placeholder="Escreva para procurar..." value="<?php echo $concelho; ?>" required>
                                    <datalist id="datalistConcelho">
                                        <option value="Concelho">
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
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto de Perfil</label>
                                        <input class="form-control" name="fotoUpload" type="file" id="foto">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" name="neutro" id="cancelar-alterar-btn" onclick="trocarPerfil('cancelar')" >Cancelar</button>
                                </div>
                                
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" name="alterar-perfil" id="confirmar-alterar-btn" type="submit" >Confirmar Alterações</button>
                                </div>
                            </div>
                        </div>
                            

                
                    </form>
                    <div class="row-sm">
                        <div class="col-md-2 mx-auto">
                            <button class="w-100 btn btn-lg btn-register" id="alterar-perfil-btn" onclick="trocarPerfil('alterar')">Editar Perfil</button>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-4 editar-areas-background mt-4">
                    <form action="alterar_dadosV.php" method="post"> 
                    
                        <div class="alterar-areas-div-inicial">
                            <div class="row" >
                                                    
                                <div class="col-sm ">
                                    <div class="row">
                                        <label for="areas_interesse" class="form-label">Áreas de Interesse</label>
                                        <input type="text" name="areas_interesse" class="form-control mb-3" placeholder="Áreas de Interesse" value="<?php echo $areas_selecionadas; ?>"  disabled>
                                        <div class="col-sm-12 mx-auto bg-dark">
                                            <input type="checkbox" <?php echo $artes; ?> class="form-check-input" disabled>
                                            <label>Artes e Entretenimento</label>
                                            <input type="checkbox" <?php echo $atividade; ?> class="form-check-input check1" disabled>
                                            <label>Atividade Política</label>
                                            <input type="checkbox" <?php echo $acao ?> class="form-check-input check2" disabled>
                                            <label>Ação Social</label>
                                            <br>
                                            <input type="checkbox" <?php echo $comunicacao; ?> class="form-check-input" disabled>
                                            <label>Comunicação e Publicidade</label>
                                            <input type="checkbox" <?php echo $educacao; ?> class="form-check-input check" disabled>
                                            <label>Educação</label>
                                            <input type="checkbox" <?php echo $inovacao; ?> class="form-check-input check3" disabled>
                                            <label>Inovação e Tecnologias</label>
                                            <br>
                                            <input type="checkbox" <?php echo $meio; ?> class="form-check-input" disabled>
                                            <label>Meio Ambiente e Energias</label>
                                            <input type="checkbox" <?php echo $moda; ?> class="form-check-input check4" disabled>
                                            <label>Moda e Beleza</label>
                                            <input type="checkbox" <?php echo $saude; ?> class="form-check-input check5" disabled>
                                            <label>Saúde e Bem-estar</label>
                                            

                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <label for="populacao_alvo" class="form-label">População Alvo</label>
                                        <input type="text" name="populacao_alvo" class="form-control mb-3" placeholder="População Alvo" value="<?php echo $pop_alvo_selecionadas; ?>" disabled> 
                                        <div class="col-sm-12 mx-auto bg-dark">
                                            <input type="checkbox" <?php echo $criancas; ?> class="form-check-input " disabled>
                                            <label>Crianças</label>
                                            <input type="checkbox" <?php echo $jovens; ?> class="form-check-input check" disabled>
                                            <label>Jovens</label>
                                            <input type="checkbox" <?php echo $adultos; ?> class="form-check-input check" disabled>
                                            <label>Adultos</label>
                                            <input type="checkbox" <?php echo $idosos; ?> class="form-check-input check" disabled>
                                            <label>Idosos</label>
                                            <input type="checkbox" <?php echo $familia; ?> class="form-check-input check" disabled>
                                            <label>Família</label>
                                    
                                        </div>
                                    </div>
                                   
                                </div> 
        
                                
                                <div class="col-sm">
                                    <label for="disponibilidade" class="form-label">Disponibilidade</label>
                                    <table class="table table-sm table-dark text-center" disabled>
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Dias</th>
                                                <th colspan="3">Período</th>
                                            </tr>
                                            <tr>
                                                <td>Manhã</td>
                                                <td>Tarde</td>
                                                <td>Noite</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Segunda-feira <input type="checkbox" id="segunda" <?php echo $segunda; ?> class="form-check-input" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $segunda_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $segunda_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $segunda_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Terça-feira <input type="checkbox" id="terca" <?php echo $terca; ?> class="form-check-input" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $terca_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $terca_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $terca_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Quarta-feira <input type="checkbox" id="quarta" <?php echo $quarta; ?> class="form-check-input" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quarta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quarta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quarta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Quinta-feira <input type="checkbox" id="quinta" <?php echo $quinta; ?> class="form-check-input" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quinta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quinta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $quinta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Sexta-feira <input type="checkbox" id="sexta" <?php echo $sexta; ?> class="form-check-input" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $sexta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $sexta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $sexta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Sábado <input type="checkbox" id="sabado" class="form-check-input" <?php echo $sabado; ?> <?php echo $certo; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $sabado_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $sabado_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input"<?php echo $sabado_noite; ?>  disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Domingo <input type="checkbox" id="domingo" <?php echo $domingo; ?> class="form-check-input" <?php echo $certo; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $domingo_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $domingo_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" <?php echo $domingo_noite; ?> disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            
                            
                            </div>

                        </div>
    
                        <div class="alterar-areas-div-final">
                            <div class="row" >
                                                    
                                <div class="col-sm ">
                                    <div class="row">
                                        <label for="areas_interesse" class="form-label">Áreas de Interesse</label>
                                        <input type="text" name="areas_interesse" id="areas_interesse" class="form-control mb-3" placeholder="Áreas de Interesse" value="<?php echo $areas_selecionadas; ?>"  disabled>
                                        <div class="col-sm-12 mx-auto bg-dark">
                                            <input type="checkbox" <?php echo $artes; ?> name="artes" id="Artes e Entretenimento" onclick="areasInteresse('Artes e Entretenimento')" class="form-check-input">
                                            <label>Artes e Entretenimento</label>
                                            <input type="checkbox" <?php echo $atividade; ?> name="atividade" id="Atividade Política" onclick="areasInteresse('Atividade Política')" class="form-check-input check1">
                                            <label>Atividade Política</label>
                                            <input type="checkbox" <?php echo $acao; ?> name="acao" id="Ação Social" onclick="areasInteresse('Ação Social')" class="form-check-input check2">
                                            <label>Ação Social</label>
                                            <br>
                                            <input type="checkbox" <?php echo $comunicacao; ?> name="comunicacao" id="Comunicação e Publicidade" onclick="areasInteresse('Comunicação e Publicidade')" class="form-check-input">
                                            <label>Comunicação e Publicidade</label>
                                            <input type="checkbox" <?php echo $educacao; ?> name="educacao" id="Educação" onclick="areasInteresse('Educação')" class="form-check-input check">
                                            <label>Educação</label>
                                            <input type="checkbox" <?php echo $inovacao; ?> name="inovacao" id="Inovação e Tecnologias" onclick="areasInteresse('Inovação e Tecnologias')" class="form-check-input check3">
                                            <label>Inovação e Tecnologias</label>
                                            <br>
                                            <input type="checkbox" <?php echo $meio; ?> name="meio" id="Meio Ambiente e Energias" onclick="areasInteresse('Meio Ambiente e Energias')" class="form-check-input">
                                            <label>Meio Ambiente e Energias</label>
                                            <input type="checkbox" <?php echo $moda; ?> name="moda" id="Moda e Beleza" onclick="areasInteresse('Moda e Beleza')" class="form-check-input check4">
                                            <label>Moda e Beleza</label>
                                            <input type="checkbox" <?php echo $saude ?> name="saude" id="Saúde e Bem-estar" onclick="areasInteresse('Saúde e Bem-estar')" class="form-check-input check5">
                                            <label>Saúde e Bem-estar</label>
                                    
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <label for="populacao_alvo" class="form-label">População Alvo</label>
                                        <input type="text" name="populacao_alvo" class="form-control mb-3" id="populacao_alvo" placeholder="População Alvo" value="<?php echo $pop_alvo_selecionadas; ?>" disabled> 
                                        <div class="col-sm-12 mx-auto bg-dark">
                                            <input type="checkbox" <?php echo $criancas; ?> id="Crianças" name="Criancas" onclick="populacaoAlvo('Crianças')" class="form-check-input">
                                            <label>Crianças</label>
                                            <input type="checkbox" <?php echo $jovens; ?> id="Jovens" name="Jovens" onclick="populacaoAlvo('Jovens')" class="form-check-input check">
                                            <label>Jovens</label>
                                            <input type="checkbox" <?php echo $adultos; ?> id="Adultos" name="Adultos" onclick="populacaoAlvo('Adultos')" class="form-check-input check">
                                            <label>Adultos</label>
                                            <input type="checkbox" <?php echo $idosos; ?> id="Idosos" name="Idosos" onclick="populacaoAlvo('Idosos')" class="form-check-input check">
                                            <label>Idosos</label>
                                            <input type="checkbox" <?php echo $familia; ?> id="Família" name="Família" onclick="populacaoAlvo('Família')" class="form-check-input check">
                                            <label>Família</label>
                                    
                                        </div>
                                    </div>
                                   
                                </div> 
        
                                
                                <div class="col-sm">
                                    <label for="disponibilidade" class="form-label">Disponibilidade</label>
                                    <table class="table table-sm table-dark text-center" >
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Dias</th>
                                                <th colspan="3">Período</th>
                                            </tr>
                                            <tr>
                                                <td>Manhã</td>
                                                <td>Tarde</td>
                                                <td>Noite</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Segunda-feira <input type="checkbox" class="form-check-input" <?php echo $segunda; ?> name="segunda_feira" id="segunda" onclick="checkboxes('segunda')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="segunda_manha" <?php echo $segunda_manha; ?> id="segunda-manha" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="segunda_tarde" <?php echo $segunda_tarde; ?> id="segunda-tarde" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="segunda_noite" <?php echo $segunda_noite; ?> id="segunda-noite" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Terça-feira <input type="checkbox" class="form-check-input" name="terca_feira" <?php echo $terca; ?> id="terca" onclick="checkboxes('terca')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="terca_manha" <?php echo $terca_manha; ?> id="terca-manha" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="terca_tarde" <?php echo $terca_tarde; ?> id="terca-tarde" disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="terca_noite" <?php echo $terca_noite; ?> id="terca-noite" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Quarta-feira <input type="checkbox" class="form-check-input" name="quarta_feira" id="quarta" <?php echo $quarta; ?> onclick="checkboxes('quarta')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="quarta_manha" id="quarta-manha" <?php echo $quarta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="quarta_tarde" id="quarta-tarde" <?php echo $quarta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="quarta_noite" id="quarta-noite" <?php echo $quarta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Quinta-feira <input type="checkbox" class="form-check-input" name="quinta_feira" id="quinta" <?php echo $quinta; ?> onclick="checkboxes('quinta')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="quinta_manha" id="quinta-manha" <?php echo $quinta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="quinta_tarde" id="quinta-tarde" <?php echo $quinta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="quinta_noite" id="quinta-noite" <?php echo $quinta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Sexta-feira <input type="checkbox" class="form-check-input" name="sexta_feira" id="sexta" <?php echo $sexta; ?> onclick="checkboxes('sexta')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="sexta_manha" id="sexta-manha" <?php echo $sexta_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="sexta_tarde" id="sexta-tarde" <?php echo $sexta_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="sexta_noite" id="sexta-noite" <?php echo $sexta_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Sábado <input type="checkbox" class="form-check-input" name="sabado" id="sabado" <?php echo $sabado; ?> onclick="checkboxes('sabado')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="sabado_manha" id="sabado-manha" <?php echo $sabado_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="sabado_tarde" id="sabado-tarde" <?php echo $sabado_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="sabado_noite" id="sabado-noite" <?php echo $sabado_noite; ?> disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Domingo <input type="checkbox" class="form-check-input" name="domingo" id="domingo" <?php echo $domingo; ?> onclick="checkboxes('domingo')"></td>
                                                <td><input type="checkbox" class="form-check-input" name="domingo_manha" id="domingo-manha" <?php echo $domingo_manha; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="domingo_tarde" id="domingo-tarde" <?php echo $domingo_tarde; ?> disabled></td>
                                                <td><input type="checkbox" class="form-check-input" name="domingo_noite" id="domingo-noite" <?php echo $domingo_noite; ?> disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            
                            
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" name="neutro" id="cancelar-alterar-btn" onclick="trocarAreas('cancelar')">Cancelar</button>
                                </div>
                                
                                <div class="col-sm-4 mx-auto">
                                    <button class="w-100 btn btn-lg btn-register" name="botao-editar-areas" id="confirmar-alterar-btn" type="submit" >Confirmar Alterações</button>
                                </div>
                            </div>
                            
                        </div>

                    </form>
                    <div class="row-sm">
                        <div class="col-md-2 mx-auto" >
                            <button class="w-100 btn btn-lg btn-register" id="alterar-areas-btn" onclick="trocarAreas('alterar')">Editar</button>
                        </div>
                    </div>
                </div>
                

                <div class="row mt-4 ">

                    <div class="col-sm px-4 py-4 editar-email-background" >
                        <form action="alterar_dadosV.php" method="post">
                            <div class="alterar-email-div-inicial" >
                                <div class="col-sm ">
                                    <label for="oldEmail" class="form-label">Endereço Email</label>
                                    <input name="oldEmail" type="email" id="oldEmail" class="form-control mb-3" placeholder="Email" value="<?php echo $mail; ?>" disabled>
                                </div>
                                
                            </div>

                            <div class="alterar-email-div-final">
                                <div class="row">
                                    <div class="col-sm ">
                                        <label for="oldEmail" class="form-label">Endereço Email Atual</label>
                                        <input name="oldEmail" type="email" id="oldEmail" class="form-control mb-3" placeholder="Email" value="<?php echo $mail; ?>" disabled>
                                    </div>
                                    <div class="col-sm">
                                        <label for="newEmail" class="form-label">Endereço Email Novo</label>
                                        <input name="newEmail" type="email" id="newEmail" class="form-control mb-3" placeholder="Email novo" required>
                                    </div>
                                </div>
                                

                                <div class="col-sm">

                                    <div class="row">
                                        <div class="col-sm-4 mx-auto">
                                            <button class="w-100 btn btn-lg btn-register" name="neutro" id="cancelar-alterar-btn" onclick="trocarEmail('cancelar')" >Cancelar</button>
                                        </div>
                                        
                                        <div class="col-sm-4 mx-auto">
                                            <button class="w-100 btn btn-lg btn-register" name="alterar-email" id="confirmar-alterar-btn" type="submit" >Confirmar Email</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>

                        <div class="col-sm-7 mx-auto editar-email-background">
                            <button class="w-100 btn btn-lg btn-register" onclick="trocarEmail('alterar')" id="alterar-email-btn">Alterar Email</button>
                        </div>
                    </div>

                    <div class="col-sm px-4 py-4 editar-password-background">
                        <form action="alterar_dadosV.php" method="post">
                            <div class="alterar-password-div-inicial">
                                <div class="col-sm">
                                    <label for="oldPassword" class="form-label">Password Atual</label>
                                    <input type="password" id="oldPassword" class="form-control mb-3" placeholder="Password Atual" disabled>
                                </div>
                                
                            </div>

                            <div class="alterar-password-div-final">

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="oldPassword" class="form-label">Password Atual</label>
                                        <input type="password" name="oldPassword" id="oldPassword" class="form-control mb-3" placeholder="Password Atual" required>
                                    </div>
    
                                    <div class="col-sm">
                                        <label for="newPassword" class="form-label">Password Nova</label>
                                        <input type="password" name="newPassword" id="newPassword" class="form-control mb-3" placeholder="Password Nova" required>
                                    </div>
            
                                    <div class="col-sm">
                                        <label for="confirmPassword" class="form-label">Confirmar Password Nova</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control mb-3" placeholder="Confirmar Password Nova" required>
                                    </div>
                                </div>

                                <div class="col-sm">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" name="neutro" id="cancelar-alterar-btn" onclick="trocarPalavraPasse('cancelar')" >Cancelar</button>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <button class="w-100 btn btn-lg btn-register" name="alterar-password" id="confirmar-alterar-btn" type="submit">Confirmar Palavra-passe</button>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                        </form>

                        <div class="col-sm-8 mx-auto alterar-password-div-inicial"  >
                            <button class="w-100 btn btn-lg btn-register" id="alterar-password-btn" onclick="trocarPalavraPasse('alterar')">Alterar Palavra-passe</button>
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