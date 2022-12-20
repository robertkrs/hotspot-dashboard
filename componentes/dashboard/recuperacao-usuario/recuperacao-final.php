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
      $sql = "SELECT * FROM cadastro_clientes where id_cliente = '$id'";
      $result = $conexao->query($sql);
      if($user_data = mysqli_num_rows($result) == 1){
        $upt = "UPDATE cadastro_clientes INNER JOIN radcheck on cadastro_clientes.email_cliente = radcheck.username SET senha_cliente = '$senha',  value = '$senha' WHERE id_cliente = '$id'";
        $result2 = $conexao->query($upt);
        
        $token = "UPDATE cadastro_clientes SET token_cliente = '0ERR0R' WHERE id_cliente = '$id'";
        $result3 = $conexao->query($token);

      }
      header("location:http://hotspot.signetx.com.br");

     
    }else{
      print_r("ERRO");
     // header("location:http://hotspot.signetx.com.br");
    }
  }

?>