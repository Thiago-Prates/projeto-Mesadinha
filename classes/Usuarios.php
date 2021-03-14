<?php 
session_start();
require_once "Conexao.php";

class usuarios {
  
  public $id;
  public $nome;
  public $email;
  public $endereco;
  public $telefone;
  public $senha;

  public function login() {

    try{
      if(isset($_POST["email"]) && isset($_POST["senha"])) {
        $this->email = $_POST["email"]; 
        $this->senha = $_POST["senha"];

        $bd = new Conexao();

        $con = $bd->conectar();

        $sql = $con->prepare("select * from usuario where email = ? and senha = ?");
        $sql->execute(array($this->email, $this->senha));

        if($sql->rowCount() > 0){

          $result = $sql->fetchObject();
          // var_dump($result); die();
          $_SESSION["usuario_id"] = $result->id;
          header("location:dashboard.php");

        }else{
          header("location:index.php");
        }
      }else{
        header("location:index.php");
      }

    }catch(PDOException $msg){
      echo "Não foi possivel fazer o login.{$msg->getMessage()}";
    }


  }

  public function inserir() {

    try {
      if(isset($_POST["nome"]) && isset($_POST["email"])){
  
        $this->nome = $_POST["nome"];
        $this->email = $_POST["email"];
        $this->endereco = $_POST["endereco"];
        $this->telefone = $_POST["telefone"];
        $this->senha = $_POST["senha"];
  
        $bd = new Conexao();
  
        $con = $bd->conectar();
  
        $sql = $con->prepare("insert into usuario(id, nome, email, endereco, telefone, senha) values (null,?,?,?,?,?);");
  
        $sql->execute(array(
          $this->nome,
          $this->email,
          $this->endereco,
          $this->telefone,
          $this->senha
        ));

        if($sql->rowCount() > 0){
          echo "<script> alerta(); </script>";

        }
  
      }else{ 
        header("location:cadastro-usuario.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel cadastrar o usuario { $msg->getMessage()}";
    }
  
  }

  public function listar() { 
    try {
      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select * from usuario");
      $sql->execute();
      if($sql->rowCount() > 0){
        return $result = $sql->fetchAll(PDO::FETCH_CLASS);
      }
    }catch(PDOException $msg){
      echo "Não foi possivel listar os Usuarios {$msg->getMessage()}";
    }
  }

  public function listarID($id) {
    try{
      if(isset($id)){
        $this->id = $id;

        $bd = new Conexao();

        $con = $bd->conectar();

        $sql = $con->prepare("select * from usuario where id = ?");

        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){
        return $result = $sql->fetchObject(); 
        } 

      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar o alnome ".$msg->getMessage();
    }
  }

  public function excluir($id) {
    try{
      if(isset($id)){
        $this->id = $id;
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("delete from usuario where id = ?;");
        $sql->execute(array($this->id));
        if($sql->rowCount() > 0){

          header("location:dashboard.php");
        }
      }else{
        header("location:dashboard.php");
      }

    }catch(PDOException $msg){
      echo "Não foi possivel excluir os Usuarios".$msg->getMessage();
    }
  }

  public function alterar() {
    try{
      if(isset($_POST["salvar"])){
        $this->id = $_GET["id"];
        $this->nome = $_POST["nome"];
        $this->email = $_POST["email"];
        $this->endereco = $_POST["endereco"];
        $this->telefone = $_POST["telefone"];
        $this->senha = $_POST["senha"];
      
        $bd = new Conexao();

        $con = $bd->conectar();

        $sql = $con->prepare("update usuario set nome = ?, email = ?, endereco = ?,
                              telefone = ?, senha = ? where id = ?;");
        $sql->execute(array(
          $this->nome,
          $this->email,
          $this->endereco,
          $this->telefone,
          $this->senha,
          $this->id
        ));

        if($sql->rowCount() > 0) {
          header("location:gerenciar-usuario.php");
        }
      }else { 
        header("location:gerenciar-usuario.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar o alnome ".$msg->getMessage();
    }
  }
}


?>