<?php 
session_start();
include_once('../../../componentes/config.php');

  

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADM | KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="../../../css/style.css">
  

</head>

<body>
  <header class="header">
    <div class="header-imagem">
      <a href=""><img src="../../../img/logo/KRSv2.svg" width="150" height="131" alt="logo-KRS"></a>
    </div>
    <nav class="header-menu">

    </nav>
  </header>
  <main class="autenticacao-bg">
    <div class="autenticacao container">
      <div class="autenticacao-titulo">
        <h2>Insira o Codigo</h2>
      </div>

     <!-- -->
      <form action="./recuperacao-senha.php" method="POST" class="autenticacao-formulario formulario">
        <div id="token2">
          <input type="text" name="token" id="token" placeholder="Coloque o codigo">
        </div>    
        <div id="token2">
          <input type="submit" name="submit" id="submit" value="Enviar" class="btn">
        </div>
      </form>

    </div>
  </main>

   <script src="../../../js/script.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="../../../js/form.js"></script>
</body>

</html>