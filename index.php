<?php
  header("Content-type:text/html; charset=utf8;");

  require_once "classes/Usuarios.php";
  $usuario = new Usuarios();

  if(isset($_POST["logar"])){
    $usuario->login();
  }

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <title>Login no sistema</title>
  </head>
  <body>
    <div class="container">
      <form action="index.php" method="post">
        <img src="img/login.png" alt="Login" />
        <div class="form-group">
          <label for="email">Email:</label>
          <input
            type="text"
            class="form-control"
            id="email"
            placeholder="Digite seu email"
            name="email"
            required
          />
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label>
          <input
            type="password"
            class="form-control"
            id="senha"
            placeholder="Digite sua senha"
            name="senha"
            required
          />
        </div>

        <div class="buttons">
          <button class="btn button" name="logar" type="submit">Entrar</button>
          <a class="btn button" href="cadastro-usuario.php">Cadastre-se</a>
        </div>
      </form>
    </div>
  </body>
</html>
