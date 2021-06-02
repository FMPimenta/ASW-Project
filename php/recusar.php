<?php
include "../php/openconn.php";
$cc = $_REQUEST["cc"];
$id = $_REQUEST["id"];

$query = "DELETE FROM accao_ligacao_voluntario
            WHERE cc = $cc AND id_accao = $id";
mysqli_query($conn, $query);
echo "RECUSADO COM SUCSESS"
?>