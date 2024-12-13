<?php
include 'db.php';
session_start();
$nomeUsuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;
if (isset($_POST['nomeaval']) && isset($_POST['descricaoaval'])) {
$nome = $_POST['nomeaval'];
$descricao = $_POST['descricaoaval'];

$sql = "INSERT INTO avaliacoes (nome, descricao) VALUES ('$nome', '$descricao')";

if ($con->query($sql) === TRUE) {
    echo "Avaliação inserida com sucesso!";
} else {
    echo "Erro ao inserir avaliação: " . $conn->error;
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avaliações - EcoLife</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-image">
  <header>
    <nav class="navbar">
    <div class="logo">
    <img src="Imagens/EcoLife-logo.png" alt="ecolife-logo" draggable="false">
  </div>
      <ul class="menu">
        <li onclick="redirectToHome()">Home</a></li>
        <li onclick="redirectToBikes()">Bicicletas</a></li>
        <li onclick="redirectToDestinos()">Destinos</a></li>
        <li onclick="redirectToAvaliacoes()">Avaliações</a></li>
        <div class="btn-group">
        <?php if ($nomeUsuario): ?>
        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userButton">
          <i class="bi bi-person"></i><span><?php echo $nomeUsuario ? "Olá, $nomeUsuario" : "Login"; ?></span>
        </button>
        <div id="logoutMenu" class="dropdown-menu">
        <button onclick="window.location.href='logout.php'" class="dropdown-item" type="button">Sair</a>
        <?php else: ?>
          <a href="cadastro.php" class="btn btn-warning"><span>Login</span></a>
  <?php endif; ?>
</div>
      </div>
</div>
  </ul>
    </nav>
  </header>
  <div class="container mt-5 text-center">
        <h1 class="text-white">Formulário de Avaliação</h1>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nome" class="form-label text-white">Nome</label>
                <input type="text" id="nome" name="nomeaval" class="form-control" placeholder="Digite seu nome" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label text-white">Descrição</label>
                <textarea id="descricao" name="descricaoaval" rows="4" class="form-control" placeholder="Descreva sua avaliação" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2 w-100">Enviar</button>
        </form>
    </div>
        </body>
        <script src="script.js"></script>
        <script src="index.js"></script>
