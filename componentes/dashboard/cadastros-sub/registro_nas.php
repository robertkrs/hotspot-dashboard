<?php
   session_start();
  if(isset($_POST['submit'])){
    include_once('../../../componentes/config.php');
    $nivel = 3;
    $login = $_SESSION['login'];
    $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
    $result9 = $conexao->query($sql7);

    if(mysqli_num_rows($result9) >= 1){
    
    $nasname = $_POST['nasname'];
    $shortname = $_POST['shortname'];
    $description = $_POST['desc'];
    $senha = $_POST['senha'];
    
    
    $sql = "SELECT * FROM nas WHERE nasname = '$nasname' OR shortname = '$shortname'";
    $sqlx = $conexao->query($sql);
    if(mysqli_num_rows($sqlx) >= 1){
      echo "ERRO CADASTRO EXISTENTE";
      header("location:./cadastro_nas.php");
        }
        
    else{
      $result = mysqli_query($conexao,"INSERT INTO nas(nasname,shortname,type,secret,description) VALUES ('$nasname','$shortname','other','$senha','$description')");
    
      $sqlr2 = "SELECT * FROM nas WHERE nasname = '$nasname' OR shortname = '$shortname'";
      $sqlx = $conexao->query($sqlr2);
      
        if(mysqli_num_rows($sqlx) < 1){
          echo "Cadastro nao efetuado";
          header("location:./cadastro_nas.php");

        }
       
        header("location:./../sub-navigation/nas.php");

     
    }
  }else{
    header("location:./../dashboard.php");

  }
}
  
?>