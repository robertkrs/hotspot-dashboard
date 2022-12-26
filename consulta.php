<?php
  session_start();
  include_once('config.php');
  /*if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:index.html");
  }
  */
  $logado = $_SESSION['email'];
  $sql = "SELECT * FROM radacct";
  $result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotspot - KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <header class="header">
    <div class="header-imagem">
      <a href="./"><img src="./img/logo/KRSv2.svg" width="150" height="131" alt="logo-KRS"></a>
    </div>
    <nav class="header-menu">
      <ul>
        <li><a href="./index.html">Autenticar</a></li>
        <li><a href="./registrar.html">Registrar-se</a></li>
        <li class='header-sair'><a href="./logout.php">Sair</a></li>
      </ul>
    </nav>
  </header>
  <main class="tabela-bg">
    <table class="tabela container">
      <thead>
        <tr>
          <th scope="coluna">ip</th>
          <th scope="coluna">usuario</th>

          <th scope="coluna">mac</th>
            <th scope="coluna">conexão inicial</th>
            <th scope="coluna">conexão final</th>
      
        </tr>
      </thead>
      <tbody>
      <?php
          while($user_data = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$user_data['nasipaddress'];"</td>";
            echo "<td>".$user_data['username'];"</td>";
            echo "<td>".$user_data['callingstationid'];"</td>";
            echo "<td>".$user_data['acctstarttime'];"</td>";
            echo "<td>".$user_data['acctstoptime'];"</td>";

          }
        ?>
      </tbody>
    </table>
  </main>
  
</body>

</html>