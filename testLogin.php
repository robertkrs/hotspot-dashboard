<?php
  session_start();
  if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])){
    //Acessa
    include_once('./componentes/config.php');
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $logado = 1;

    
    //$sql = "SELECT * FROM administracao WHERE login_adm = '$login' and senha_adm = '$senha'";
    
    $sql = "SELECT * FROM administracao WHERE login_adm = '$login' LIMIT 1";
    $result = $conexao->query($sql);
    $result1 = $result->fetch_assoc();
   
   
  
   
      
   
      $sql2 = "SELECT * FROM administracao WHERE login_adm = '$login' LIMIT 1";
      $result2 = $conexao->query($sql2);
      print_r($result2);
    if(password_verify($senha, $result1['senha_adm'])){

      
    }
    else{
      header("location:./adm.php");  
    }
    
  }
  else{
      header("location:./adm.php");  

  }
 

?>