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

        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $id = $_POST['id'];
        
        $sqlAlter = "UPDATE administracao SET login_adm = '$email', senha_adm = '$senha', role_id = '$role' WHERE id_adm = '$id'" ;

        $result = $conexao->query($sqlAlter);
        header("Location:./../sub-navigation/administradores.php");
      }
    }
    else{
      header("Location:./../dashboard.php");
    }
    
?>