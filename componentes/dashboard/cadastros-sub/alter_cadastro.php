<?php 
    session_start();
    include_once('../../../componentes/config.php');  
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      header("Location:../../../adm.php");

    }
    $nivel = 2;
    $login = $_SESSION['login'];
    $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
    $result9 = $conexao->query($sql7);

    if(mysqli_num_rows($result9) >= 1){
      if(isset($_POST['submit'])){

        
        
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
        $id = $_POST['id'];
        
      
        
      $sqlAlter2 = "UPDATE radcheck inner join cadastro_clientes on radcheck.username = cadastro_clientes.email_cliente AND radcheck.value = cadastro_clientes.senha_cliente SET radcheck.username = '$email', radcheck.value = '$senha',nome_cliente = '$nome', cpf_cliente = '$cpf', nascimento_cliente = '$data', telefone_cliente = '$telefone',  estado_cliente = '$estado', cep_cliente = '$cep', cidade_cliente = '$cidade', bairro_cliente = '$bairro', rua_cliente = '$rua', numero_cliente = '$numero' ,email_cliente = '$email', senha_cliente = '$senha' where cadastro_clientes.id_cliente = '$id'";

        $result2 = $conexao->query($sqlAlter2);

        header("Location:./../cadastros.php?pagina=1");
      }
   }else{
      header("Location:./../dashboard.php");
    }
    
?>