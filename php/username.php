<?php

include "openconn.php";

mysqli_query($conn, "SET NAMES'utf8'");

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
};

session_start();

$usertype = $_SESSION['type_of_login'];

if ($usertype == "vol") {

    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE volid = $msg_para";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $chatid = $chatid[0];

} else {

    $sql = "SELECT chatid FROM chat_ligacao_utilizadores WHERE instid = $msg_para";
    $resultsel = mysqli_query($conn, $sql);
    $chatid = mysqli_fetch_row($resultsel);
    $chatid = $chatid[0];

};

echo $chatid;
?>