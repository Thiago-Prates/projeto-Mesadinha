<?php
header('Content-Type: text/html; charset=utf8');

require_once "classes/Categoria.php";

$categoria = new Categoria(); 
$listaCategoria = $categoria -> listar();

if(isset($_GET["id"])){
  $categoria->excluir($_GET["id"]);
} 

if(isset($_POST["salvar"])){
  $categoria->inserir();
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

    <title>Gerenciar Categorias</title>
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
        <form action="gerenciar-categorias.php" method="post">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" required />
            </div>
            <div class="buttons">
              <button class="btn button" type="submit" name="salvar">Cadastrar</button>
            </div>
        </form>
      </div>
      <div class="col-lg-7">
        <table class="table table-striped table-dark">
          <thead>
              <th>Nome</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <?php if($listaCategoria) : 

                foreach($listaCategoria as $categoria) : ?>
                  <tr>
                    <td><?php echo $categoria->name ?></td>
                    <td>
                      <!-- utilizar o link para criar um URl e trabalhar com paramentro do tipo GET -->
                      <a href="alterar-categorias.php?id=<?php echo $categoria->id;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                      <a href="gerenciar-categorias.php?id=<?php echo $categoria->id;?>" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
                    </td>
                  </tr>
                  </tr>
                <?php endforeach; ?>
                <?php else :  ?>
                    <tr>
                      <td colspan="7" align="center"> Nenhum Categoria Encontrado</td>
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

