<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $host = "localhost";
    $servername = "ecolifeformulario";
    $username = "root";
    $password = "";

    echo $nome;

    $con = mysqli_connect($host, $username, $password);
    mysqli_select_db($con, $servername);

    if (!$con) {
        die("ConexÃ£o falhou" . mysqli_connect_error());
    }

    $sql = "INSERT INTO clientes(nome, email, senha) VALUES('$nome', '$email', '$senha')";

    if ($con->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $con->error;
    }

    $con->close();

}
?>