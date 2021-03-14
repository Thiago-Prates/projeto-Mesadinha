<?php 
header('Content-Type: text/html; charset=utf8');

require_once "classes/Lancamentos.php";
require_once "classes/Contas.php";

$lancamento = new Lancamentos(); 

$conta = new Contas();
$listaConta = $conta ->listar();

if(isset($_GET["cod"])) {
  $dadosLancamento = $lancamento->listarID($_GET["cod"]);
}

if(isset($_POST["salvar"])){
  $lancamento->alterar();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <title>Alterar Lançamentos</title>
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container" id="div1">
      <form action="alterar-lancamentos.php?cod=<?php echo $dadosLancamento->cod; ?>" method="post">
            <div class="form-group">
              <label for="conta_id">Conta</label>
              <select name="conta_id" class="form-control" >
                <option value="#">Selecione uma Conta</option>
                <?php foreach ($listaConta as $conta) { ?>
                  <option value="<?php echo $conta->identificacao; ?>"><?php echo $conta->conta; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="valor">Valor</label>
              <input type="number" step="any" name="valor" class="form-control" value="<?php echo $dadosLancamento->valor; ?>" required/>
            </div>
            <div class="buttons">
              <button class="btn button" type="submit" name="salvar">Cadastrar</button>
              <a href="gerenciar-lancamentos.php" class="btn button">Voltar</a>
            </div>
        </form>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
