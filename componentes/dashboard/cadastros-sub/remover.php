<?php
  session_start();
  include_once('../../../componentes/config.php');
  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:../../../adm.php");


  }
  $nivel = 1;
  $login = $_SESSION['login'];
  $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
  $result9 = $conexao->query($sql7);

  if(mysqli_num_rows($result9) >= 1){
  if(!empty($_GET['id'])){

  $id = $_GET['id'];
  $sqlSelect = "SELECT * FROM cadastro_clientes WHERE id_cliente = $id";
  $result = $conexao->query($sqlSelect);

  if($result->num_rows > 0){
    /** Apaga os registros do usuario do radcheck e do cadastro */
    $sqlDelete = "DELETE radcheck.*,cadastro_clientes.* FROM radcheck INNER JOIN cadastro_clientes on radcheck.username = cadastro_clientes.email_cliente WHERE id_cliente  = $id";
    $result2 = $conexao->query($sqlDelete);

  }
  header("Location:./../cadastros.php?pagina=1");
  }
  else{
    header("Location:./../dashboard.php");
  }
}
?>