<?php 
session_start();
require_once "Conexao.php";
class categoria {

  public $id;
  public $name;
  public $usuario_id;

  public function inserir() {

    try {
      if(isset($_POST["nome"])){
  
        $this->name = $_POST["nome"];
        $this->usuario_id = $_SESSION["usuario_id"];
        
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("insert into categoria(id, name, usuario_id) values (null,?,?);");
  
        $sql->execute(array(
          $this->name,
          $this->usuario_id
        ));

        if($sql->rowCount() > 0){
          header("location: gerenciar-categorias.php");
        }
  
      }else{ 
        header("location:gerenciar-categorias.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel cadastrar a categoria { $msg->getMessage()}";
    }
  
  }
    
  public function listar() { 
    try {
      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select * from categoria");
      $sql->execute();
      if($sql->rowCount() > 0){
        return $result = $sql->fetchAll(PDO::FETCH_CLASS);
      }
    }catch(PDOException $msg){
      echo "Não foi possivel listar as categorias {$msg->getMessage()}";
    }
  }

  public function listarID($id) {
    try{
      if(isset($id)){
        $this->id = $id;
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("select * from categoria where id = ?");
        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){
        return $result = $sql->fetchObject(); 
        } 

      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar o nome ".$msg->getMessage();
    }
  }

  public function alterar() {
    try{
      if(isset($_POST["salvar"])){
        $this->id = $_GET["id"];
        $this->name = $_POST["nome"];
        $this->usuario_id = $_SESSION["usuario_id"];
      
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("update categoria set name = ?, usuario_id = ?
                              where id = ?;");
        $sql->execute(array(
          $this->name,
          $this->usuario_id,
          $this->id
        ));

        if($sql->rowCount() > 0) {
          header("location:gerenciar-categorias.php");
        }
      }else { 
        header("location:gerenciar-categorias.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar a categoria ".$msg->getMessage();
    }
  }
  
  public function excluir($id) {
    try{
      if(isset($id)){
        $this->id = $id;
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("delete from categoria where id = ?;");
        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){
  
          header("location:gerenciar-categorias.php");
        }
      }else{
        header("location:gerenciar-categorias.php");
      }
  
    }catch(PDOException $msg){
      echo "Não foi possivel excluir os Usuarios".$msg->getMessage();
    }
  }

}




?>