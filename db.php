<?php

$host = "localhost";
$servername = "ecolifeformulario";
$username = "root";
$password = "";

$con = mysqli_connect($host, $username, $password);
mysqli_select_db($con, $servername);

if (!$con) {
    die("Conexão falhou: " . mysqli_connect_error());
}

?>