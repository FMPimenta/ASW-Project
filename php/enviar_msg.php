<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

session_start();

include "openconn.php";

mysqli_query($conn, "SET NAMES'utf8'");

$msg = $_REQUEST["m"];
$receiverid = $_REQUEST["d"];

if ($msg !== "" & $receiverid !== "") {
    
    $usertype = $_SESSION['type_of_login'];
    $sql = "SELECT COUNT(*) FROM mensagens";
    $resultsel = mysqli_query($conn, $sql);
    $counter = mysqli_fetch_all($resultsel);
    $id_msg = intval($counter[0][0]);
    
    $id_msg = $id_msg + 1;

    if ($usertype == "vol") {

        $cc = $_SESSION['userid'];
        
        $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE volid = $cc";
        $resultsel = mysqli_query($conn, $sql);
        $chatid = mysqli_fetch_row($resultsel);
        $msg_de = $chatid[0];

        $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE instid = $receiverid";
        $resultsel = mysqli_query($conn, $sql);
        $chatid = mysqli_fetch_row($resultsel);
        $msg_para = $chatid[0];

        $sql = "insert into mensagens(id_msg, msg_de, msg_para, msg) VALUES ($id_msg, $msg_de, $msg_para, N'$msg');";
        $resultins = mysqli_query($conn, $sql);
        mysqli_close($conn);

    } else {

        $telefone = $_SESSION['userid'];
        
        $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE instid = $telefone";
        $resultsel = mysqli_query($conn, $sql);
        $chatid = mysqli_fetch_row($resultsel);
        $msg_de = $chatid[0];

        
        $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE volid = $receiverid";
        $resultsel = mysqli_query($conn, $sql);
        $chatid = mysqli_fetch_row($resultsel);
        $msg_para = $chatid[0];
        
        $sql = "insert into mensagens(id_msg, msg_de, msg_para, msg) VALUES ($id_msg, $msg_de, $msg_para, '$msg');";
        $resultins = mysqli_query($conn, $sql);
        
        mysqli_close($conn);

    }

    echo "Mensagem enviada";
} else {
    echo "ERRO: Mensagem não enviada";
};

?>