<?php
header('Content-Type: text/html; charset=utf8');

require_once "classes/Contas.php";
require_once "classes/Categoria.php";

$categoria = new Categoria();
$listaCategoria = $categoria ->listar();

$conta = new Contas(); 
$listaContas = $conta -> listar();

if(isset($_GET["id"])){
  $conta->excluir($_GET["id"]);
} 

if(isset($_POST["salvar"])){
  $conta->inserir();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/CSS" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/CSS" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/CSS" href="css/editar.css">

    <title>Contas</title>
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
    <div class="row">
      <div class="col-lg-5">
        <form action="gerenciar-contas.php" method="post">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="email">Tipo</label>
              <select name="tipo" class="form-control" required>
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
              <button class="btn button" type="submit" name="salvar">Cadastrar</button>
            </div>
        </form>
      </div>
      <div class="col-lg-7">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Categoria</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
            <?php if($listaContas) : 

              foreach($listaContas as $conta) : ?>
                <tr>
                  <td><?php echo $conta->conta; ?></td>
                  <td><?php echo $conta->tipo; ?></td>
                  <td><?php echo $conta->categoria; ?></td>
                  <td>
                    <a href="alterar-contas.php?id=<?php echo $conta->identificacao ;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                    <a href="gerenciar-contas.php?id=<?php echo $conta->identificacao;?>" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
                  </td>
                </tr>
                </tr>
              <?php endforeach; ?>
              <?php else :  ?>
                  <tr>
                    <td colspan="7" align="center"> Nenhum Conta Encontrado</td>
                  </tr>
              <?php endif;  ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

