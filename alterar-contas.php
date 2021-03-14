<?php 
header('Content-Type: text/html; charset=utf8');

require_once "classes/Contas.php";
require_once "classes/Categoria.php";

$conta = new Contas(); 
$categoria = new Categoria();
$listaCategoria = $categoria ->listar();

if(isset($_GET["id"])) {
  $dadosContas = $conta->listarID($_GET["id"]);
}

if(isset($_POST["salvar"])){
  $conta->alterar();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Alterar Contas</title>
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container" id="div1">
      <form action="alterar-contas.php?id=<?php echo $dadosContas->id; ?>" method="post">
        <h1>Alterar Contas</h1>
        <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" value="<?php echo $dadosContas->nome ?>" required />
            </div>
            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select name="tipo" class="form-control" required>
                <option value="#">Selecione o tipo</option>
                <option value="receita">Receita</option>
                <option value="despesa">Despesa</option>
              </select>
            </div>
            <div class="form-group">
              <label for="endereço">Categoria</label>
              <select name="categoria_id" class="form-control" >
                <option value="#">Selecione uma Categoria</option>
                <?php foreach ($listaCategoria as $categoria) { ?>
                  <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->name; ?></option>
                <?php } ?>
              </select>
            </div>
        <div class="buttons">
          <button class="btn button" name="salvar">Salvar</button>
          <a href="gerenciar-contas.php" class="btn button">Voltar</a>
        </div>
      </form>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
