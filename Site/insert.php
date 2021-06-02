<?php
// Estabelece uma ligação com a base de dados usando o programa openconn.php
// A variável $conn é inicializada com a ligação estabelecida
include "openconn.php";
$query = "insert into pessoa values ('Francisco', 69)";
$res = mysqli_query($conn, $query); 
if ($res) {
  echo "Um novo registo inserido com sucesso";
} else {
  echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
}
// Termina a ligação com a base de dados
mysqli_close($conn);
?>