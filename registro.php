<?php

  if(isset($_POST['submit'])){
    include_once('./componentes/config.php');
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $telefone = $_POST['telefone'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaConfirma = $_POST['confirma-senha'];
    $evento = $_POST['nas'];

    $sql = "SELECT * FROM cadastro_clientes WHERE email_cliente = '$email' OR cpf_cliente = '$cpf'";
    $sqlx = $conexao->query($sql);

  
    if($senha != $senhaConfirma){
      header("location:index.php");
      
    }   
   else{
    if(mysqli_num_rows($sqlx) >= 1){
      echo "ERRO CADASTRO EXISTENTE";
      header("location:index.php");
    }
    else{
      $result = mysqli_query($conexao,"INSERT INTO cadastro_clientes(nome_cliente,cpf_cliente,nascimento_cliente,telefone_cliente,estado_cliente,cep_cliente,cidade_cliente,bairro_cliente,rua_cliente,numero_cliente,email_cliente,senha_cliente,evento_local) VALUES ('$nome','$cpf','$data','$telefone','$estado','$cep','$cidade','$bairro','$rua','$numero','$email','$senha','$evento')");
    
      $sqlr2 = "SELECT * FROM cadastro_clientes WHERE email_cliente = '$email'";
      $sqlx = $conexao->query($sqlr2);
     
        if(mysqli_num_rows($sqlx) < 1){
          echo "Cadastro nao efetuado";
          header("location:index.php");
        }
        else{
          $result2 =  mysqli_query($conexao,"INSERT INTO radcheck(username,attribute,op,value) VALUES ('$email','Cleartext-Password',':=','$senha')");
        }
      }

      header("location:http://hotspot.signetx.com.br");
    }  
	 
    
  }
  
?>