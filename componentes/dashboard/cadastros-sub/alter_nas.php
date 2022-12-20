<?php 
    session_start();
    include_once('../../../componentes/config.php');  
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
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

        $nasname = $_POST['nasname'];
        $shortname = $_POST['shortname'];
        $description = $_POST['desc'];
        $senha = $_POST['senha'];
        $id = $_POST['id'];
        
        $sqlAlter = "UPDATE nas SET nasname = '$nasname', shortname = '$shortname', description = '$description', secret = $senha WHERE id = '$id'" ;

        $result = $conexao->query($sqlAlter);
        header("Location:./../sub-navigation/nas.php");
      }
    }
    else{
      header("Location:./../dashboard.php");
    }
    
?>