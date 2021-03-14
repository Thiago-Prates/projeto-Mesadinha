<?php
header('Content-Type: text/html; charset=utf8');
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/valores.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <title>Dashboard</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Controle Financeiro Pessoal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Usuarios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="gerenciar-usuario.php">Perfil</a>
              <a class="dropdown-item" href="gerenciar-usuario.php">Alterar Senha</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Gerenciar Cadastros
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="gerenciar-contas.php">Contas</a>
              <a class="dropdown-item" href="gerenciar-categorias.php">Categorias</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gerenciar-lancamentos.php">Lançamentos</a>
          </li>
        </ul>
    </nav>

    <div class="container">
      <div class="row valores">
        <div class="col-3 valor">
            <h2>Receita</h2>
            <p><?php echo "R$ ".number_format($_SESSION["soma_receita"], 2) ;?></p>
        </div>
        <div class="col-3 valor">
            <h2>Despesa</h2>
            <p><?php echo "R$ ".number_format($_SESSION["soma_despesa"]*-1, 2) ;?></p>
        </div>
        <div class="col-3 valor">
            <h2>Total</h2>
            <p><?php echo "R$ ".number_format($_SESSION["soma_receita"]+($_SESSION["soma_despesa"]*-1), 2) ;?></p>
        </div>
      </div>
    </div>

    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
