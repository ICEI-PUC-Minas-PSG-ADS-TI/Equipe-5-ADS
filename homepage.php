<?php
include 'db.php';
session_start();

$nomeUsuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;
$query = "SELECT * FROM bicicletas";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoLife - Aluguel de Bicicletas</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-image">
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

      <!-- Home -->
        <section id="home">
          <h1 class="project-title">Projeto Eco Life</h1>
          <div class="highlight-image">
            <img src="Imagens/Bicicletahome.jpg" alt="Imagem em destaque de uma bicicleta">
          </div>
        </section>
  
      <!-- Bicicletas -->
       <section id="bicicletas">
      <div class="bike-list">
        <?php while ($bicicletas = mysqli_fetch_assoc($result)): ?>
        <div class="bike-item">
          <img src="<?= $bicicletas['imagem'] ?>" alt="<?= $bicicletas['modelo'] ?>" class="bike-img">
          <div class="bike-info">
            <h3 class="font-weight-bold"><?= $bicicletas['modelo'] ?></h3>
            <p>Valor: R$ <?= number_format($bicicletas['valor']) ?>/hora</p>
            <p>Descrição: <?= $bicicletas['descricao'] ?></p>
            <?php if ($nomeUsuario): ?>
              <button class="btn-alugar">Alugar</button>
        <?php else: ?>
        <button class="btn-alugar" data-bs-toggle="modal" data-bs-target="#loginAlert">Alugar</button>
        <?php endif; ?>
          </div>
        </div>
        <?php endwhile; ?>
    </section>

    <div class="modal fade" id="loginAlert" tabindex="-1" aria-labelledby="loginAlertLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginAlertLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Você precisa estar logado para alugar uma bicicleta.
      </div>
      <div class="modal-footer">
        <a href="cadastro.php" class="btn btn-primary">Fazer Login</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
  
  <!-- Carrossel de destinos -->
  <section id="destinos">
  <h3 class="text-center text-white font-weight-bold">Destinos mais visitados:</h3>
        </section>
  <div id="destinosCarousel" class="carousel slide" data-bs-ride="carousel">
  <!-- Botões de controle anterior/próximo -->
  <button class="carousel-control-prev" type="button" data-bs-target="#destinosCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#destinosCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>

  <!-- Itens do carrossel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Destinos/ufmg.jpg" class="d-block w-100" alt="Destino 1">
      <div class="carousel-caption">
        <h4>Universidade Federal de Minas Gerais</h4>
        <p>Belo Horizonte</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Destinos/lagoadapampulha.jpg" class="d-block w-100" alt="Destino 2">
      <div class="carousel-caption">
        <h4>Lagoa da Pampulha</h4>
        <p>Belo Horizonte</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Destinos/pracadaliberdade.jpg" class="d-block w-100" alt="Destino 3">
      <div class="carousel-caption">
        <h4>Praça da Liberdade</h4>
        <p>Belo Horizonte</p>
      </div>
    </div>
  </div>
</div>

  
    <!-- Avaliações -->
     <section class="avaliacoes">
    <h3 class="text-center text-white">Últimas avaliações:</h3>
        </section>
    <div id="avaliacoes" class="reviews">
      <div class="review">
        <p class="text-center">"Ótima experiência! A bicicleta era confortável e bem cuidada." - Maria S.</p>
      </div>
      <div class="review">
        <p class="text-center">"Destinos incríveis, recomendo para quem ama aventura!" - João P.</p>
      </div>
      <div class="review">
        <p class="text-center">"Serviço excelente, voltarei a usar em breve!" - Ana C.</p>
      </div>
    </div>
  </section>

  <!-- Rodapé -->
  <footer>
    <div class="footer-content">
      <div class="social-media">
        <h4>Siga-nos:</h4>
        <a href="#">Facebook</a>
        <a href="#">Instagram</a>
        <a href="#">Twitter</a>
      </div>
      <div class="about">
        <h4>Sobre o projeto:</h4>
        <p>A EcoLife oferece bicicletas para aluguel com foco em sustentabilidade e turismo consciente.</p>
      </div>
    </div>
  </footer>
  <script>
    function alugarBicicleta() {
      const isUserLoggedIn = <?= json_encode($nomeUsuario !== null); ?>;

      if (!isUserLoggedIn) {
        document.getElementById('loginAlert').classList.remove('d-none');
        window.scrollTo(0, document.getElementById('loginAlert').offsetTop);
      } else {
        alert('Aluguel realizado com sucesso!');
      }
    }
  </script>
  <script src="script.js"></script>
  <script src="index.js"></script>
  <script src="scriptaluguel.js"></script>
</body>
</html>

