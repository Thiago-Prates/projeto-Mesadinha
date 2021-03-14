<?php 
session_start();
require_once "Conexao.php";
class lancamentos {

  public $cod;
  public $valor;
  public $data;
  public $usuario_id;
  public $conta_id;



  public function inserir() {

    try {
      if(isset($_POST["conta_id"]) && isset($_POST["valor"])){
  
        $this->valor = $_POST["valor"];
        $this->data = date("Y/m/d");
        $this->usuario_id = $_SESSION["usuario_id"];
        $this->conta_id = $_POST["conta_id"];
        
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("insert into lancamento (cod, valor, data, usuario_id, conta_id) values (null,?,?,?,?);");
  
        $sql->execute(array(
          $this->valor,
          $this->data,
          $this->usuario_id,
          $this->conta_id
        ));

        if($sql->rowCount() > 0){
          header("Location: gerenciar-lancamentos.php");
        }
  
      }else{ 
        header("location:gerenciar-lancamentos.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel realizar o Lançamento { $msg->getMessage()}";
    }
  
  }
    
  public function listar() { 
    try {
      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select conta.nome, lancamento.cod,lancamento.valor, date_format(data,'%d/%m/%Y') as data from conta join lancamento on conta.id = lancamento.conta_id order by data");
      $sql->execute();

      if($sql->rowCount() > 0){
        return $result = $sql->fetchAll(PDO::FETCH_CLASS);
      }
    }catch(PDOException $msg){
      echo "Não foi possivel listar os Lançamentos {$msg->getMessage()}";
    }
  }

  public function listarID($cod) {
    try{
      if(isset($cod)){
        $this->cod = $cod;

        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("select * from lancamento where cod = ?");

        $sql->execute(array($this->cod));
        if($sql->rowCount() > 0){
        return $result = $sql->fetchObject(); 
        } 

      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar o lancamento".$msg->getMessage();
    }
  }

  public function excluir($cod) {
    try{
      if(isset($cod)){
        $this->cod = $cod;
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("delete from conta where cod = ?;");
        $sql->execute(array($this->cod));
        if($sql->rowCount() > 0){

          header("location:gerenciar-lancamentos.php");
        }
      }else{
        header("location:gerenciar-lancamentos.php");
      }

    }catch(PDOException $msg){
      echo "Não foi possivel excluir as Contas".$msg->getMessage();
    }
  }

  public function alterar() {
    try{
      if(isset($_POST["salvar"])){
        $this->cod = $_GET["cod"];
        $this->valor = $_POST["valor"];
        $this->data = date("Y/m/d");
        $this->usuario_id = $_SESSION["usuario_id"];
        $this->conta_id = $_POST["conta_id"];
        
      
        $bd = new Conexao();
        $con = $bd->conectar();
        $sql = $con->prepare("update lancamento set valor = ?, data = ?, usuario_id = ?, conta_id = ? where cod = ?;");
        $sql->execute(array(
          $this->valor,
          $this->data,
          $this->usuario_id,
          $this->conta_id,
          $this->cod
        ));

        if($sql->rowCount() > 0) {
          header("location:gerenciar-lancamentos.php");
        }
      }else { 
        header("location:gerenciar-lancamentos.php");
      }
    }catch(PDOException $msg){
      echo "Não foi possivel alterar o Lançamento ".$msg->getMessage();
    }
  }

  public function soma_receita() {
    try{

      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select sum(lancamento.valor) as valor from lancamento join conta on conta.id = lancamento.conta_id where conta.tipo = 'receita';");
      $sql->execute();

      if($sql->rowCount() > 0) {
        $result = $sql->fetchObject();
          // var_dump($result); die();
        $_SESSION["soma_receita"] = $result->valor;
      }
    }catch(PDOException $msg){
      echo "Não foi possivel somar as receitas ".$msg->getMessage();
    }
  }

  public function soma_despesa() {
    try{

      $bd = new Conexao();
      $con = $bd->conectar();
      $sql = $con->prepare("select sum(lancamento.valor) as valor from lancamento join conta on conta.id = lancamento.conta_id where conta.tipo = 'despesa';");
      $sql->execute();

      if($sql->rowCount() > 0) {
        $result = $sql->fetchObject();
          // var_dump($result); die();
        $_SESSION["soma_despesa"] = $result->valor;
      }
    }catch(PDOException $msg){
      echo "Não foi possivel somar as receitas ".$msg->getMessage();
    }
  }



}



?>