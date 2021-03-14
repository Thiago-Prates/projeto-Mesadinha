<?php 
header('Content-Type: text/html; charset=utf8');

require_once "classes/Usuarios.php";
$usuario = new Usuarios(); 

if(isset($_GET["id"])) {
  $dadosUsuarios = $usuario->listarID($_GET["id"]);
}

if(isset($_POST["salvar"])){
  $usuario->alterar();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Alterar Usuario</title>
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container" id="div1">
      <form action="alterar-usuario.php?id=<?php echo $dadosUsuarios->id; ?>" method="post">
        <h1>Alterar Usuario</h1>
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control" value="<?php echo $dadosUsuarios->nome; ?>" required />
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            class="form-control"
            value="<?php echo $dadosUsuarios->email; ?>"
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
            value="<?php echo $dadosUsuarios->endereco; ?>"
            placeholder="Avenida ou Rua"
            required
          />
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input
            type="text"
            name="telefone"
            class="form-control"
            value="<?php echo $dadosUsuarios->telefone; ?>"
            placeholder="(00)00000-0000"
            required
          />
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" name="senha" class="form-control" required />
        </div>
        <div class="buttons">
          <button class="btn button" name="salvar">Salvar</button>
          <a href="gerenciar-usuario.php" class="btn button">Voltar</a>
        </div>
      </form>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
