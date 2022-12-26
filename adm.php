<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADM | KRS</title>
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
        <h2>Painel Administrador</h2>
      </div>
      <form action="testLogin.php" method="POST" class="autenticacao-formulario formulario">
        <div>
          <input type="text" name="login" id="login" placeholder="login">
        </div>
        <div>

          <input type="password" name="senha" id="senha" placeholder="senha">
        </div>
        <div>
          <input type="submit" name="submit" id="submit" value="Enviar" class="btn">
        </div>
        
      </form>
      <div class= "esq-senha"><a href="./recuperar-senha.php">Esqueceu a senha?</a></div>
     

    </div>
  </main>
</body>

</html>