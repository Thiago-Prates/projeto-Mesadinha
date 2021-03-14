<?php 
require_once "Conexao.php";
class contas {

  public $id;
  public $nome;
  public $tipo;
  public $usuario_id;
  public $categoria_id;

  public function inserir() {

    try {
      if(isset($_POST["nome"]) && isset($_POST["tipo"])){
  
        $this->nome = $_POST["nome"];
        $this->tipo = $_POST["tipo"];
        $this->usuario_id = $_SESSION["usuario_id"];
        $this->categoria_id = $_POST["categoria_id"];
        
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("insert into conta(id, nome, tipo, usuario_id, categoria_id) values (null,?,?,?,?);");
  
        $sql->execute(array(
          $this->nome,
          $this->tipo,
          $this->usuario_id,
          $this->categoria_id
        ));

        if($sql->rowCount() > 0){
          header("Location: gerenciar-contas.php");
        }
  
      }else{ 
        header("location:gerenciar-contas.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel cadastrar a conta { $msg->getMessage()}";
    }
  
  }
    
  public function listar() { 
    try {
      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select conta.id as identificacao , conta.nome as conta , conta.tipo, categoria.id ,categoria.name as categoria from conta join categoria on conta.categoria_id = categoria.id");
      $sql->execute();

      if($sql->rowCount() > 0){
        return $result = $sql->fetchAll(PDO::FETCH_CLASS);
      }
    }catch(PDOException $msg){
      echo "Não foi possivel listar as Contas {$msg->getMessage()}";
    }
  }

  public function listarID($id) {
    try{
      if(isset($id)){
        $this->id = $id;

        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("select * from conta where id = ?");

        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){
        return $result = $sql->fetchObject(); 
        } 

      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar a conta ".$msg->getMessage();
    }
  }

  public function excluir($id) {
    try{
      if(isset($id)){
        $this->id = $id;
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("delete from conta where id = ?;");
        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){

          header("location:gerenciar-contas.php");
        }
      }else{
        header("location:gerenciar-contas.php");
      }

    }catch(PDOException $msg){
      echo "Não foi possivel excluir as Contas".$msg->getMessage();
    }
  }

  public function alterar() {
    try{
      if(isset($_POST["salvar"])){
        $this->id = $_GET["id"];
        $this->nome = $_POST["nome"];
        $this->tipo = $_POST["tipo"];
        $this->usuario_id = $_SESSION["usuario_id"];
        $this->categoria_id = $_POST["categoria_id"];
        
      
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("update conta set nome = ?, tipo = ?, usuario_id = ?, categoria_id = ?
                              where id = ?;");
        $sql->execute(array(
          $this->nome,
          $this->tipo,
          $this->usuario_id,
          $this->categoria_id,
          $this->id
        ));

        if($sql->rowCount() > 0) {
          header("location:gerenciar-contas.php");
        }
      }else { 
        header("location:gerenciar-contas.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar a conta ".$msg->getMessage();
    }
  }

}



?>