<?php
include 'db.php';
session_start();
$nomeUsuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Estações - EcoLife</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="mapadebikes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-image">
    <header>
        <nav class="navbar">
        <div class="logo">
    <img src="Imagens/EcoLife-logo.png" alt="ecolife-logo" class="w-25" draggable="false">
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
    

    <div class="map-container">
        <div class="header">Mapa de Estações de Bicicletas</div>
        <div id="map"></div>
    </div>

    <!-- script do Leaflet.js para integrar o mapa -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="script.js"></script>
    <script>
        // inicializar o mapa com uma localizacao no meio
        const map = L.map('map').setView([-19.852457, -43.977664], 13);

        // adiciona o tile layer do OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // marcadores
        const stations = [
            { name: 'Estação 1', coords: [-19.843496, -43.969553] },
            { name: 'Estação 2', coords: [-19.854821, -44.004056] },
            { name: 'Estação 3', coords: [-19.868876, -43.976058] }
        ];

        // loop para adicionar cada estação ao mapa
        stations.forEach(station => {
            L.marker(station.coords)
                .addTo(map)
                .bindPopup(`<b>${station.name}</b><br>Bikes disponíveis.`);
        });
    </script>
            <script src="index.js"></script>
</body>
</html>
