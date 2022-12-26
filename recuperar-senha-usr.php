<?php 
session_start();
include_once('./componentes/config.php');
include_once('./testlogin.php');
  if(isset($_SESSION['email']) == true){
    header("location:./componentes/dashboard/dashboard.php");
    
  }
 
  if(isset($_POST['submit'])){
    $login = $_POST['login'];

    $sql_code = "SELECT * FROM cadastro_clientes WHERE email_cliente = '$login'";
    $sql_query = $conexao->query($sql_code);
    
    if(mysqli_num_rows($sql_query) > 0){

    
      $novasenha = substr(md5(time()), 0, 6);

      $enviado = mail($login, "Seu codigo", "Seu codigo: ".$novasenha, "FROM: contato3@KRSs.com.br") ;
    
      if($enviado){
        $sql_code = "UPDATE cadastro_clientes SET token_cliente = '$novasenha' WHERE email_cliente = '$login'";
        $sql_query = $conexao->query($sql_code);
      }
      
    }
  
  }
  if(isset($_POST['submit2'])){
    $token = $_POST['token'];

    $sql = "SELECT * FROM administracao where login_adm = $login";
    $result = $conexao->query($sql);
    $result1 = $result->fetch_assoc();
    if(password_verify($token, $result1['senha_adm'])){
      print_r("Funcionou");
    }
 
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar a Senha | KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="./css/style.css">
  

</head>

<body>
  <header class="header">
    <div class="header-imagem">
      <a href="./"><img src="./img/logo/KRSv2.svg" width="150" height="131" alt="logo-KRS"></a>
    </div>
    <nav class="header-menu">

    </nav>
  </header>
  <main class="autenticacao-bg">
    <div class="autenticacao container">
      <div class="autenticacao-titulo">
        <h2>Recuperar a Senha</h2>
      </div>
      <form action="" method="POST" class="autenticacao-formulario formulario">
        <div id="recuperar">
          <input type="email" name="login" id="login" placeholder="seu email">
        </div>
        <div id="recuperar">
          <input type="submit" name="submit" id="submit" value="Enviar" class="btn" onclick="ativaToken()">
        </div>
      </form>
      <?php 
      if($enviado){
       header("location:./componentes/dashboard/recuperacao-usuario/token.php");
      }
      ?>
    </div>
  </main>

   <script src="../../../js/script.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="../../../js/form.js"></script>
</body>

</html>