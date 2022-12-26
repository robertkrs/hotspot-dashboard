<?php
   session_start();
  if(isset($_POST['submit'])){
    include_once('../../../componentes/config.php');
    /*$nivel = 3;
    $login = $_SESSION['login'];
    $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
    $result9 = $conexao->query($sql7);

    if(mysqli_num_rows($result9) >= 1){
    */
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    
    $sql = "SELECT * FROM administracao WHERE login_adm = '$email'";
    $sqlx = $conexao->query($sql);
    if(mysqli_num_rows($sqlx) >= 1){
      echo "ERRO CADASTRO EXISTENTE";
      header("location:./cadastro_adm.php");
        }
        
    else{
      $result = mysqli_query($conexao,"INSERT INTO administracao(login_adm,senha_adm,role_id) VALUES ('$email','$senha','0')");
    
      $sqlr2 = "SELECT * FROM administracao WHERE login_adm = '$email'";
      $sqlx = $conexao->query($sqlr2);
      
        if(mysqli_num_rows($sqlx) < 1){
          echo "Cadastro nao efetuado";
          header("location:./cadastro_adm.php");

        }
       
        header("location:./../sub-navigation/administradores.php");

     
    }
 /* }else{
    header("location:./../dashboard.php");

  }*/
}
  
?>