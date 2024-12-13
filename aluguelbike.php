<?php
include 'db.php';
session_start();
$nomeUsuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="aluguelbike.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar Bicicleta - EcoLife</title>
</head>
<body>
<header>
        <nav class="navbar">
        <div class="logo">
    <img src="Imagens/EcoLife-logo.png" alt="ecolife-logo" class="logo-img" draggable="false">
  </div>
          <ul class="menu">
          <li onclick="redirectToHome()">Home</li>
          <li onclick="redirectToBikes()">Bicicletas</li>
          <li onclick="redirectToDestinos()">Destinos</li>
          <li onclick="redirectToAvaliacoes()">Avaliações</li>
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
    <h1>Aluguel de Bicicletas</h1>

    <!-- Botão para abrir o modal -->
    <button class="btn" onclick="openModal()">Alugar Bicicleta</button>

    <div class="modal" id="rentalModal">
        <div class="modal-content">
            <h2>Alugar Bicicleta</h2>

            <label for="rentalTime">Alugar por (horas):</label>
            <input type="number" id="rentalTime" min="1" value="1">

            <br><br>

            <label for="rentalDate">Escolha uma data:</label>
            <input type="date" id="rentalDate">

            <br><br>

            <button id="confirmRental" class="btn" onclick="confirmRental()">Confirmar Aluguel</button>
            <button id="closeModal" class="btn btn-secondary" onclick="closeModal()">Fechar</button>
        </div>
    </div>

    <script>
        // Função para abrir o modal
        function openModal() {
            document.getElementById('rentalModal').style.display = 'block';
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById('rentalModal').style.display = 'none';
        }

        // Função para confirmar o aluguel
        function confirmRental() {
            const rentalTime = document.getElementById("rentalTime").value;
            const rentalDate = document.getElementById("rentalDate").value;

            if (!rentalDate) {
                alert("Por favor, selecione uma data válida.");
                return;
            }

            console.log(`Aluguel confirmado: ${rentalTime} horas no dia ${rentalDate}`);
            alert(`Compra realizada, obrigado pela preferência!\n${rentalTime} horas no dia ${rentalDate}`);

            closeModal();
        }

        // Fechar modal ao clicar fora dele
        window.onclick = function(event) {
            if (event.target === document.getElementById('rentalModal')) {
                closeModal();
            }
        }
    </script>

</body>
</html>
