<?php
header('Content-Type: text/html; charset=utf8');

require_once "classes/Contas.php";
require_once "classes/Lancamentos.php";

$conta = new Contas();
$listaConta = $conta ->listar();

$lancamentos = new Lancamentos(); 
$listaLancamentos = $lancamentos -> listar();



if(isset($_GET["cod"])){
  $lancamentos->excluir($_GET["cod"]);
} 

if(isset($_POST["salvar"])){
  $lancamentos->inserir();
}

$lancamentos->soma_receita();
$lancamentos->soma_despesa();

// $tudo = get_defined_vars();
// var_dump($tudo);
// die();
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
    <link rel="stylesheet" type="text/CSS" href="css/valores.css">

    <title>Lançamentos</title>
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
            <?php 
            if((number_format($_SESSION["soma_receita"]+($_SESSION["soma_despesa"]*-1), 2))>0){ 
              echo "<p id='positivo'> R$ ".number_format($_SESSION["soma_receita"]+($_SESSION["soma_despesa"]*-1), 2)."</p>"; 
            }else{
              echo "<p id='negativo'> R$ ".number_format($_SESSION["soma_receita"]+($_SESSION["soma_despesa"]*-1), 2)."</p>"; 
             } 
             ;?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-5">
        <form action="gerenciar-lancamentos.php" method="post">
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
              <input type="number" step="any" name="valor" class="form-control" required/>
            </div>
            <div class="buttons">
              <button class="btn button" type="submit" onclick="Swal.fire({icon:'success',title:'Categoria Salva!',showConfirmButton: false,timer:2000});" name="salvar">Cadastrar</button>
            </div>
        </form>
      </div>
      <div class="col-7">
        <table class="table table-striped table-dark ">
          <thead>
            <tr>
              <th>Conta</th>
              <th>Valor</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <?php if($listaLancamentos) : 

                foreach($listaLancamentos as $lancamentos) : ?>
                  <tr>
                    <td><?php echo $lancamentos->nome; ?></td>
                    <td><?php echo "R$ ".number_format($lancamentos->valor, 2); ?></td>
                    <td><?php echo $lancamentos->data; ?></td>
                    <td>
                      <a href="alterar-lancamentos.php?cod=<?php echo $lancamentos->cod ;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                      <a href="gerenciar-lancamentos.php?cod=<?php echo $lancamentos->cod;?>" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
                    </td>
                  </tr>
                  </tr>
                <?php endforeach; ?>
                <?php else :  ?>
                    <tr>
                      <td colspan="7" align="center"> Nenhum Lançamento Encontrado</td>
                    </tr>
              <?php endif;  ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="js/bootstrap.min.js"></script>

</html>