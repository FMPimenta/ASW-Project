<?php

include "openconn.php";

session_start();
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$mail = $_SESSION["username"];

$nome_instituicao_novo = htmlspecialchars($_POST['nome']);
$nome_rep_novo = htmlspecialchars($_POST['nomeRepresentante']);
$email_novo = htmlspecialchars($_POST['newEmailInstituicao']);
$website = htmlspecialchars($_POST['website']);
$distrito = htmlspecialchars($_POST['distrito']);
$concelho = htmlspecialchars($_POST['concelho']);
$freguesia = htmlspecialchars($_POST['freguesia']);
$telefone = htmlspecialchars($_POST['telefone']);
$morada = htmlspecialchars($_POST['morada']);
$email_novo_representante = htmlspecialchars($_POST['newEmail']);
$password_antiga = htmlspecialchars($_POST['oldPassword']);
$password_nova = htmlspecialchars($_POST['newPassword']);
$password_hashed_nova = password_hash($password_nova, PASSWORD_BCRYPT);
$confirmar_password = htmlspecialchars($_POST['confirmPassword']);
$descricao = htmlspecialchars($_POST['descricao']);



console_log($mail);

if ($password_antiga != '') {
        
    $sql = "SELECT * FROM instituicao_registo WHERE mail = N'$mail'";
    $result = mysqli_query($conn, $sql);
    $user_password = mysqli_fetch_array($result);

    if(password_verify($password_antiga, $user_password['pass'])) {
        if ($password_nova == $confirmar_password) {
            $sql_update = "UPDATE voluntario_registo SET pass = N'$password_hashed_nova' WHERE mail = N'$mail'";
            $result = mysqli_query($conn, $sql_update);
            header('Location: ../Site/alterarI.php');
        }
        
    } else {
        $_SESSION["error"] = $error;
        header('Location: ../Site/index.html');
        
    }

} else if ($email_novo != '') {

    $sql_update = "UPDATE instituicao_registo SET mail = N'$email_novo' WHERE mail = N'$mail'";
    $result = mysqli_query($conn, $sql_update);
    $_SESSION["username"] = $email_novo;

    header('Location: ../Site/alterarI.php');

}

if ($nome_instituicao_novo != '') {
    
    if ($descricao == '') {
        $sql_select = "SELECT * FROM instituicao_registo WHERE mail = N'$mail'";
        $result = mysqli_query($conn, $sql_select);
        $descricao_bd = mysqli_fetch_array($result);
        $descricao = utf8_encode($descricao_bd['descricao']);
    } 

    $sql_update = array("UPDATE instituicao_registo SET nome = N'$nome_instituicao_novo' WHERE mail = N'$mail'", 
                        "UPDATE instituicao_registo SET website = N'$website' WHERE mail = N'$mail'",
                        "UPDATE instituicao_registo SET telefone = N'$telefone' WHERE mail = N'$mail'", 
                        "UPDATE instituicao_registo SET morada = N'$morada' WHERE mail = N'$mail'", 
                        "UPDATE instituicao_registo SET distrito = N'$distrito' WHERE mail = N'$mail'", 
                        "UPDATE instituicao_registo SET concelho = N'$concelho' WHERE mail = N'$mail'", 
                        "UPDATE instituicao_registo SET freguesia = N'$freguesia' WHERE mail = N'$mail'",
                        "UPDATE instituicao_registo SET mail_representante = N'$email_novo_representante ' WHERE mail = N'$mail'",
                        "UPDATE instituicao_registo SET nome_representante = N'$nome_rep_novo' WHERE mail = N'$mail'",
                        "UPDATE instituicao_registo SET descricao = N'$descricao' WHERE mail = N'$mail'");                       

    $arrayLength = count($sql_update);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
    }

    header('Location: ../Site/alterarI.php');
    
}

?>