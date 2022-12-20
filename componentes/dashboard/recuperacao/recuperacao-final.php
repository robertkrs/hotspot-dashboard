<?php 
session_start();
include_once('../../../componentes/config.php');

  if(isset($_POST['submit'])){
    if(empty($_POST['id'])){
      header("location:./recuperacao-senha.php");
    }
    $id = $_POST['id'];
    $senha = $_POST['senha'];
    $senhac = $_POST['confirma-senha'];
    if($senha == $senhac){
      $sql = "SELECT * FROM administracao where id_adm = '$id'";
      $result = $conexao->query($sql);
      $cripto = password_hash($senha, PASSWORD_DEFAULT);
      if($user_data = mysqli_num_rows($result) == 1){
        $upt = "UPDATE administracao SET senha_adm = '$cripto' WHERE id_adm = '$id'";
        $result2 = $conexao->query($upt);
        $token = "UPDATE administracao SET token_adm = '0ERR0ADM' WHERE id_adm = '$id'";
        $result3 = $conexao->query($token);
      }
      header("location:../../../adm.php");
     
    }else{
      print_r("NUm deu");
    }
  }

?>