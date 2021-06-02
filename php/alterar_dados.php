<?php

include "openconn.php";

session_start();

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
$email_antigo = htmlspecialchars($_POST['oldEmail']);
$email_novo = htmlspecialchars($_POST['newEmail']);
$foto = htmlspecialchars($_POST['foto']);
$password_antiga = htmlspecialchars($_POST['oldPassword']);
$password_nova = htmlspecialchars($_POST['newPassword']);
$password_hashed_nova = password_hash($password_nova, PASSWORD_BCRYPT);
$confirmar_password = htmlspecialchars($_POST['confirmPassword']);

$mail = $_SESSION["username"];

if ($nome_novo != '') {
    $sql_update = array("UPDATE voluntario_registo SET nome = N'$nome_novo' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET apelido = N'$apelido_novo' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET data_nascimento = STR_TO_DATE('$data_nasc_nova', '%d-%m-%Y') WHERE mail = N'$mail'",
                        "UPDATE voluntario_registo SET genero = N'$genero' WHERE mail = N'$mail'");
    $arrayLength = count($sql_update);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
    }
    header('Location: ../Site/index_user.html');
    
} else if ($telefone != ''){

    $sql_select_cc = "SELECT $cc FROM voluntario_registo";
    $new_cc = mysqli_query($conn, $sql_select_cc);

    if (mysqli_num_rows($new_cc) > 0) {
        header('Location: ../Site/index.html');
    } else {
        $sql_update = array("UPDATE voluntario_registo SET telefone = N'$telefone' WHERE mail = N'$mail'", 
                            "UPDATE voluntario_registo SET cc = '$cc' WHERE mail = N'$mail'", 
                            "UPDATE voluntario_registo SET carta = '$carta_conducao' WHERE mail = N'$mail'");
        $arrayLength = count($sql_update);
        for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
        }
        header('Location: ../Site/index_user.html');
    }
    

} else if ($distrito != '') {
    $sql_update = array("UPDATE voluntario_registo SET distrito = N'$distrito' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET concelho = N'$concelho' WHERE mail = N'$mail'", 
                        "UPDATE voluntario_registo SET freguesia = N'$freguesia' WHERE mail = N'$mail'");
    $arrayLength = count($sql_update);
    for ($x = 0; $x < $arrayLength; $x++) {
        $result = mysqli_query($conn, $sql_update[$x]);
    }
    header('Location: ../Site/index_user.html');

} else if ($email_novo != '') {

    if ($email_antigo == $mail) {
        $sql_update = "UPDATE voluntario_registo SET mail = N'$email_novo' WHERE mail = N'$mail'";
        $result = mysqli_query($conn, $sql_update);
        header('Location: ../Site/index_user.html');
    }  

} else if ($password_antiga != '') {

    $sql = "SELECT * FROM voluntario_registo WHERE mail = N'$mail'";
    $result = mysqli_query($conn, $sql);
    $user_password = mysqli_fetch_array($result);

    if(password_verify($password_antiga, $user_password['pass'])) {
        if ($password_nova == $confirmar_password) {
            $sql_update = "UPDATE voluntario_registo SET pass = N'$password_nova_hashed' WHERE mail = N'$mail'";
            $result = mysqli_query($conn, $sql_update);
            header('Location: ../Site/index_user.html');
        }
        
    } else {
        $_SESSION["error"] = $error;
        header('Location: ../Site/index.html');
        
    }
}

?>