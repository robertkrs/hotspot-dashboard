<?php 
session_start();
include_once('../../../componentes/config.php');

    if(isset($_POST['submit'])){
    
      $token = $_POST['token'];
  
      $sql = "SELECT * FROM cadastro_clientes where token_cliente = '$token'";
      $result = $conexao->query($sql);
      if($user_data = mysqli_num_rows($result) == 1){
        while($sql_query = mysqli_fetch_assoc($result)){
          $id = $sql_query['id_cliente'];
        }
      }
      if($user_data = mysqli_num_rows($result) == 0){
        header("location:./token.php");
      }
    }

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADM | Signet</title>
  <meta name="description" content="Hotspot Signet">
  <link rel="stylesheet" href="../../../css/style.css">
  

</head>

<body>
  <header class="header">
    <div class="header-imagem">
      <img src="../../../img/logo/signet-logo.svg" width="190" height="131" alt="logo-signet">
    </div>
    <nav class="header-menu">

    </nav>
  </header>
  <main class="autenticacao-bg">
    <div class="autenticacao container">
      <div class="autenticacao-titulo">
        <h2>Nova Senha</h2>
      </div>
     
      <form action="./recuperacao-final.php" method="POST" class="autenticacao-formulario formulario">
        <div class="n-senha">
          <input type="password" name="senha" id="senha" placeholder="nova senha" required>
        </div>
        <div class="c-senha">
          <input type="password" name="confirma-senha" id="confirma-senha" class="csenha" placeholder="confirmar senha" required>
        </div>
        <div class="id-senha">
          <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
        </div>
        <div id="nova-senha">
          <input type="submit" name="submit" id="submit" value="Enviar" class="btn" onclick="alerta()">
        </div>
      </form> 
     

    </div>
  </main>

    <script src="../../../js/script.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="../../../js/form.js"></script>
</body>

</html>