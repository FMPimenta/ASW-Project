<?php
include "../php/openconn.php";
$cc = $_REQUEST["cc"];
$id = $_REQUEST["id"];

$query = "UPDATE accao_ligacao_voluntario
            SET aceite = 'S'
            WHERE cc = $cc AND id_accao = $id";
mysqli_query($conn, $query);
echo "ACEITE COM SUCSESS"
?>