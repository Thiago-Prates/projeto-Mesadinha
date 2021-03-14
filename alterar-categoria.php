<?php 
header('Content-Type: text/html; charset=utf8');

require_once "classes/Categoria.php";
$categoria = new Categoria(); 

if(isset($_GET["id"])) {
  $dadosCategoria = $categoria->listarID($_GET["id"]);
}

if(isset($_POST["salvar"])){
  $categoria->alterar();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Alterar Categorias</title>
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container" id="div1">
      <form action="alterar-categoria.php?id=<?php echo $dadosCategoria->id; ?>" method="post">
        <h1>Alterar Categoria</h1>
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control" value="<?php echo $dadosCategoria->name; ?>" required />
        </div>
        <div class="buttons">
          <button class="btn button" name="salvar">Salvar</button>
          <a href="gerenciar-categoria.php" class="btn button">Voltar</a>
        </div>
      </form>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
