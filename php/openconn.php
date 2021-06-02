<?php
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw003";
$dbpass = "grupodosfixes";
$dbname = "asw003";
// Cria a ligação à BD
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// mysql_query($conn, "SET NAMES 'utf8'");

// Verifica a ligação à BD
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}