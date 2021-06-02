<?php

include "openconn.php";

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

session_start();

$mail = $_SESSION["username"];

$sql_query = "SELECT * FROM voluntario_registo WHERE mail = N'$mail'";
$result_query = mysqli_query($conn, $sql_query);
$campo_db = mysqli_fetch_array($result_query);

$cc_db = $campo_db['cc'];
$nome_novo = htmlspecialchars($_POST['nome']);
$apelido_novo = htmlspecialchars($_POST['apelido']);
$dia_nasc = htmlspecialchars($_POST['dia_nasc']);
$mes_nasc = htmlspecialchars($_POST['mes_nasc']);
$ano_nasc = htmlspecialchars($_POST['ano_nasc']);
$data_nasc_nova = $dia_nasc .'-'. $mes_nasc .'-'. $ano_nasc;
$genero = htmlspecialchars($_POST['genero']);
$telefone = htmlspecialchars($_POST['telefone']);
$cc = htmlspecialchars($_POST['cc']);
$carta_conducao = htmlspecialchars($_POST['carta_conducao']);
$distrito = htmlspecialchars($_POST['distrito']);
$concelho = htmlspecialchars($_POST['concelho']);
$freguesia = htmlspecialchars($_POST['freguesia']);
$areas_interesse = htmlspecialchars($_POST['areas_interesse']);

$criancas = htmlspecialchars($_POST['Criancas']);
$jovens = htmlspecialchars($_POST['Jovens']);
$adultos = htmlspecialchars($_POST['Adultos']);
$idosos = htmlspecialchars($_POST['Idosos']);
$familia = htmlspecialchars($_POST['Família']);

$segunda_manha = htmlspecialchars($_POST['segunda_manha']);
$segunda = htmlspecialchars($_POST['segunda']);
console_log($criancas);
console_log($jovens);



$artes = htmlspecialchars($_POST['artes']);
$atividade = htmlspecialchars($_POST['atividade']);
$acao = htmlspecialchars($_POST['acao']);
$comunicacao = htmlspecialchars($_POST['comunicacao']);
$educacao = htmlspecialchars($_POST['educacao']);
$inovacao = htmlspecialchars($_POST['inovacao']);
$meio = htmlspecialchars($_POST['meio']);
$moda = htmlspecialchars($_POST['moda']);
$saude = htmlspecialchars($_POST['saude']);

$pop_alvo = htmlspecialchars($_POST['populacao_alvo']);

$email_antigo = htmlspecialchars($_POST['oldEmail']);
$email_novo = htmlspecialchars($_POST['newEmail']);
$password_antiga = htmlspecialchars($_POST['oldPassword']);
$password_nova = htmlspecialchars($_POST['newPassword']);
$password_hashed_nova = password_hash($password_nova, PASSWORD_BCRYPT);
$confirmar_password = htmlspecialchars($_POST['confirmPassword']);

$mail = $_SESSION["username"];


if (isset($_POST['alterar-password'])) {
    if ($password_nova == $confirmar_password) {
        
        $sql = "SELECT * FROM voluntario_registo WHERE mail = N'$mail'";
        $result = mysqli_query($conn, $sql);
        $user_password = mysqli_fetch_array($result);
    
        if(password_verify($password_antiga, $user_password['pass'])) {
            if ($password_nova == $confirmar_password) {
                $sql_update = "UPDATE voluntario_registo SET pass = N'$password_hashed_nova' WHERE mail = N'$mail'";
                $result = mysqli_query($conn, $sql_update);
                header('Location: ../Site/alterarV.php');
            }
            
        } else {
            $_SESSION["error"] = $error;
            header('Location: ../Site/index.php');
            
        }
        
    }

} else if (isset($_POST['alterar-email'])) {

    $sql_update = "UPDATE voluntario_registo SET mail = N'$email_novo' WHERE mail = N'$mail'";
    $result = mysqli_query($conn, $sql_update);
    $_SESSION["username"] = $email_novo;

    header('Location: ../Site/alterarV.php');
     

} else if (isset($_POST['botao-editar-areas'])) {

    $sql_select_pop = "SELECT $cc_db FROM pop_alvo_ligacao_voluntario";
    $sql_select_areas = "SELECT $cc_db FROM areas_ligacao_voluntario";
    $sql_select_disponibilidade = "SELECT $cc_db FROM disponibilidade_ligacao_voluntario";


    $old_pop = mysqli_query($conn, $sql_select_pop);
    $old_area = mysqli_query($conn, $sql_select_areas);
    $old_disponibilidade = mysqli_query($conn, $sql_select_disponibilidade);
    $sql_update = array('');

    $sql_delete = array("DELETE FROM pop_alvo_ligacao_voluntario WHERE cc = $cc_db;",
                        "DELETE FROM areas_ligacao_voluntario WHERE cc = $cc_db;",
                        "DELETE FROM disponibilidade_ligacao_voluntario WHERE cc = $cc_db;");
    
    $arrayLength = count($sql_delete);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_delete[$x]);
    }
    
    if ($criancas == 'on') {
        array_push($sql_update, "INSERT INTO pop_alvo_ligacao_voluntario VALUES($cc_db, 1)");
    } 
    if ($jovens == 'on') {
        array_push($sql_update, "INSERT INTO pop_alvo_ligacao_voluntario VALUES($cc_db, 2)");
    } 
    if ($adultos == 'on') {
        array_push($sql_update, "INSERT INTO pop_alvo_ligacao_voluntario VALUES($cc_db, 3)");
    } 
    if ($idosos == 'on') {
        array_push($sql_update, "INSERT INTO pop_alvo_ligacao_voluntario VALUES($cc_db, 4)");
    } 
    if ($familia == 'on') {
        array_push($sql_update, "INSERT INTO pop_alvo_ligacao_voluntario VALUES($cc_db, 5)");
    }   

    if ($artes == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 1)");
    } 
    if ($atividade == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 2)");
    } 
    if ($acao == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 3)");
    } 
    if ($comunicacao == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 4)");
    } 
    if ($educacao == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 5)");
    } 
    if ($inovacao== 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 6)");
    } 
    if ($meio == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 7)");
    } 
    if ($moda == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 8)");
    } 
    if ($saude == 'on') {
        array_push($sql_update, "INSERT INTO areas_ligacao_voluntario VALUES($cc_db, 9)");
    } 
  

    $arrayLength = count($sql_update);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
    }


    $dia_semana1 = $_POST['segunda_feira'];
    $dia_semana2 = $_POST['terca_feira'];
    $dia_semana3 = $_POST['quarta_feira'];
    $dia_semana4 = $_POST['quinta_feira'];
    $dia_semana5 = $_POST['sexta_feira'];
    $dia_semana6 = $_POST['sabado'];
    $dia_semana7 = $_POST['domingo'];
    
    $segunda_array = array();
    $terca_array = array();
    $quarta_array = array();
    $quinta_array = array();
    $sexta_array = array();
    $sabado_array = array();
    $domingo_array = array();
    
    if (isset($_POST['segunda_feira'])){
        if(isset($_POST['segunda_manha'])){
            $new = array_push($segunda_array, 1);
        }
        if(isset($_POST['segunda_tarde'])){
            $new = array_push($segunda_array, 2);
        }
        if(isset($_POST['segunda_noite'])){
            $new = array_push($segunda_array, 3);
        }
    }
    
    if (isset($_POST['terca_feira'])){
        if(isset($_POST['terca_manha'])){
            $new = array_push($terca_array, 1);
        }
        if(isset($_POST['terca_tarde'])){
            $new = array_push($terca_array, 2);
        }
        if(isset($_POST['terca_noite'])){
            $new = array_push($terca_array, 3);
        }
    }
    
    if (isset($_POST['quarta_feira'])){
        if(isset($_POST['quarta_manha'])){
            $new = array_push($quarta_array, 1);
        }
         if(isset($_POST['quarta_tarde'])){
            $new = array_push($quarta_array, 2);
        }
        if(isset($_POST['quarta_noite'])){
            $new = array_push($quarta_array, 3);
        }
    }
    
    if (isset($_POST['quinta_feira'])){
        if(isset($_POST['quinta_manha'])){
            $new = array_push($quinta_array, 1);
        }
        if(isset($_POST['quinta_tarde'])){
            $new = array_push($quinta_array, 2);
        }
        if(isset($_POST['quinta_noite'])){
            $new = array_push($quinta_array, 3);
        }
    }
    
    if (isset($_POST['sexta_feira'])){
        if(isset($_POST['sexta_manha'])){
            $new = array_push($sexta_array, 1);
        }
        if(isset($_POST['sexta_tarde'])){
            $new = array_push($sexta_array, 2);
        }
        if(isset($_POST['sexta_noite'])){
            $new = array_push($sexta_array, 3);
        } 
    }
    if (isset($_POST['sabado'])){
        if(isset($_POST['sabado_manha'])){
            $new = array_push($sabado_array, 1);
        }
        if(isset($_POST['sabado_tarde'])){
            $new = array_push($sabado_array, 2);
        }
        if(isset($_POST['sabado_noite'])){
            $new = array_push($sabado_array, 3);
        } 
    }
    
    if (isset($_POST['domingo'])){
        if(isset($_POST['domingo_manha'])){
            $new = array_push($domingo_array, 1);
        }
        if(isset($_POST['domingo_tarde'])){
            $new = array_push($domingo_array, 2);
        }
        if(isset($_POST['domingo_noite'])){
            $new = array_push($domingo_array, 3);
        } 
    }
        

    if(count($segunda_array) != 0){               
                     
        for ($i = 0; $i < count($segunda_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 1, $segunda_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($terca_array) != 0){                      
        for ($i = 0; $i < count($terca_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 2, $terca_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($quarta_array) != 0){                      
        for ($i = 0; $i < count($quarta_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 3, $quarta_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($quinta_array) != 0){                      
        for ($i = 0; $i < count($quinta_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 4, $quinta_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($sexta_array) != 0){                      
        for ($i = 0; $i < count($sexta_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 5, $sexta_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($sabado_array) != 0){                      
        for ($i = 0; $i < count($sabado_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 6, $sabado_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    if(count($domingo_array) != 0){                      
        for ($i = 0; $i < count($domingo_array); $i++)  {
            $sql = "INSERT INTO disponibilidade_ligacao_voluntario VALUES ($cc_db, 7, $domingo_array[$i]);";
            $result = mysqli_query($conn, $sql);
        }
    }
    
    header('Location: ../Site/alterarV.php');

} else if (isset($_POST['alterar-perfil'])){

    $dirfotos = "fotos/";
    $foto = $dirfotos . basename($_FILES["fotoUpload"]["name"]);
    console_log($foto);
    console_log($_FILES["fotoUpload"]["tmp_name"]);
    if (move_uploaded_file($_FILES["fotoUpload"]["tmp_name"], $foto)) {
        console_log("Uploaded");
    } else {
        console_log("ERROR: NOT UPLOADED");
    }

    $sql_update = array("UPDATE voluntario_registo SET nome = N'$nome_novo' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET apelido = N'$apelido_novo' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET data_nascimento = STR_TO_DATE('$data_nasc_nova', '%d-%m-%Y') WHERE mail = N'$mail'",
                        "UPDATE voluntario_registo SET telefone = N'$telefone' WHERE mail = N'$mail'",
                        "UPDATE voluntario_registo SET distrito = N'$distrito' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET concelho = N'$concelho' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET freguesia = N'$freguesia' WHERE mail = N'$mail'",
                        "UPDATE voluntario_registo SET foto = N'$foto' WHERE mail = N'$mail'");

    if ($genero != "") {
        if ($genero == "Masculino") {
            $genero = 'M';
        } else if ($genero == "Feminino") {
            $genero = 'F';
        } else if ($genero == 'Prefiro Não dizer'){
            $genero = 'N';
        }
        array_push($sql_update, "UPDATE voluntario_registo SET genero = N'$genero' WHERE mail = N'$mail'");
    } 

    if ($carta_conducao == 'Sim' || $carta_conducao == 'S') {
        $carta_conducao = 'S';
        array_push($sql_update, "UPDATE voluntario_registo SET carta = '$carta_conducao' WHERE mail = N'$mail'");
    } else if ($carta_conducao == 'Não' || $carta_conducao == 'N'){
        $carta_conducao = 'N';
        array_push($sql_update, "UPDATE voluntario_registo SET carta = '$carta_conducao' WHERE mail = N'$mail'");
    }

    $arrayLength = count($sql_update);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
    }

    $sql_select_cc = "SELECT $cc FROM voluntario_registo";
    $new_cc = mysqli_query($conn, $sql_select_cc);

    

    if (mysqli_num_rows($new_cc) > 0) {
        header('Location: ../Site/alterarV.php');
    } else {
        $sql_update = "UPDATE voluntario_registo SET cc = N'$cc' WHERE mail = N'$mail'";
        $result = mysqli_query($conn, $sql_update);
    }    
} else if (isset($_POST['neutro'])) {
    header('Location: ../Site/alterarV.php');
}

?>