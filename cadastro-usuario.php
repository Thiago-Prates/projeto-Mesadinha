<?php 
header('Content-Type:text/html; charset=UTF-8');

require_once "classes/Usuarios.php";

$usuario = new Usuarios();

if(isset($_POST["salvar"])){
  $usuario->inserir();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Cadastro Usuario</title>
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container" id="div">
      <form action="cadastro-usuario.php" method="post">
        <h1>Faça o seu cadastro</h1>
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            class="form-control"
            placeholder="Ex: maria@email.com"
            required
          />
        </div>
        <div class="form-group">
          <label for="endereço">Endereço</label>
          <input
            type="text"
            name="endereco"
            class="form-control"
            placeholder="Avenida ou Rua"
            required
          />
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input
            type="tel"
            id="tel"
            name="telefone"
            class="form-control"
            placeholder="(00)00000-0000"
            oninput="mascara_tel()"
            max-length="14"
            required
          />
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" name="senha" class="form-control" required />
        </div>
        <div class="buttons">
          <button class="btn button" name="salvar">Salvar</button>
          <a href="index.php" class="btn button">Voltar</a>
        </div>
      </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mascara.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
