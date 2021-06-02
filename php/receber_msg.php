<?php

include "openconn.php";

session_start();

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
};

$usertype = $_SESSION['type_of_login'];
$msg_para = $_SESSION['userid'];
$otheruser = $_REQUEST["s"];

mysqli_query($conn, "SET NAMES'utf8'");

if ($usertype == "vol") {
    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE volid = $msg_para;";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $msg_para = $chatid[0];

    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE instid = $otheruser;";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $otheruser = $chatid[0];

    $sql = "SELECT msg, msg_de, UNIX_TIMESTAMP(tempo) FROM mensagens WHERE (msg_para = $msg_para AND msg_de = $otheruser) OR (msg_de = $msg_para AND msg_para = $otheruser) ORDER BY UNIX_TIMESTAMP(tempo);";
    $resultmsg = mysqli_query($conn, $sql);
} else {

    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE instid = $msg_para;";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $msg_para = $chatid[0];

    
    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE volid = $otheruser;";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $otheruser = $chatid[0];

    $sql = "SELECT msg, msg_de, UNIX_TIMESTAMP(tempo) FROM mensagens WHERE (msg_para = $msg_para AND msg_de = $otheruser) OR (msg_de = $msg_para AND msg_para = $otheruser) ORDER BY UNIX_TIMESTAMP(tempo);";
    $resultmsg = mysqli_query($conn, $sql);
};

$rows = mysqli_fetch_all($resultmsg);

mysqli_free_result($resultmsg);

mysqli_close($conn);

if (sizeof($rows) > 0) {
    echo json_encode($rows);
} else {
    echo "Nada";
};
?>