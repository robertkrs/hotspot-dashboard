<?php
 /* session_start();
  include_once('./componentes/config.php');
  

  *verifica o numero de pessoas online 
  $logado = $_SESSION['email'];
  $sql = "SELECT * FROM radacct WHERE acctstoptime is NULL";
  $result = $conexao->query($sql);

  /**verifica numero de cadastros 
  $sql2 = "SELECT * FROM cadastro_clientes";
  $result2 = $conexao->query($sql2);

  /**verifica o maior numero de logins 
  $sql3 = "SELECT username, COUNT(username) FROM radacct GROUP BY username";
  $result3 = $conexao->query($sql3);

  $sql4 = "SELECT nome_cliente FROM cadastro_clientes WHERE cast(date(now()) as date) = cast(data_lancamento as date)";
  $result4 = $conexao->query($sql4);
 
  $sql5 = "SELECT * FROM nas";
  $result5 = $conexao->query($sql5);
*/

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro | KRS</title>
  <link rel="stylesheet" href="./css/style.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

</head>

<body id="navegacao">
  <header class=navigation>
    <nav>
      <ul>
        <li>
          <a href="">
            <span class="navigation-icone">
              <ion-icon name="wifi-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">
              <img src="../../../img/logo/KRS (2).svg" alt="">
            </span>
          </a>
        </li>

        <li>
          <a href="http://hotspot.KRSx.com.br">
            <span class="navigation-icone">
              <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Voltar</span>
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- main -->
    <main class="main">
      <div class="topbar">
        <div class="toggle">
          <ion-icon name="menu-outline"></ion-icon>
        </div>     
      </div>

      <!-- details -->
      <div class="details-registro">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Cadastro</h2>
          </div>
      <form action="registro.php" method="POST" class="details-formulario-usr d-formulario-usr">
        <div class="informacao-pessoal">
          <h3 class="subtitulo">Informações Pessoais</h3>
          <div>
            <input type="text" name="nome" id="nome" placeholder="nome completo" required>
          </div>
          <div>
            <input type="text" name="cpf" id="cpf" placeholder="cpf" required>
          </div>
          <div class="data-form" >
            <div class="popup" onclick="myFunction()">   
              <ion-icon name="help-circle-outline"></ion-icon>
              <span class="popuptext" id="myPopup">Data de Nascimento</span>
            </div>
            <input type="date" name="data" id="data" required>
          </div>
        </div>
        
        <div class="informacao-endereco">
          
            <h3 class="subtitulo">Endereço</h3>
          

          <div>
            <input type="text" name="cep" id="cep" placeholder="cep" onblur="pesquisacep(this.value)">
          </div>
          <div>
            <input type="text" name="estado" id="estado" placeholder="estado">
          </div>
          <div>
            <input type="text" name="cidade" id="cidade" placeholder="cidade"">
          </div>
          <div>
            <input type="text" name="bairro" id="bairro" placeholder="bairro">
          </div>
          <div>
            <input type="text" name="rua" id="rua" placeholder="rua">
          </div>
          <div>
            <input type="text" name="numero" id="numero" placeholder="numero residencial">
          </div>
        </div>
        
        <div class="informacao-login">
            <h3 class="subtitulo">Contato/Login/Senha</h3>
          
          <div>
            <input type="tel" name="telefone" id="telefone" maxlength="11" placeholder="celular">
          </div>
          <div class="email-form">
           <div class="popup" onclick="myFunctionE()">   
              <ion-icon name="help-circle-outline"></ion-icon>
              <span class="popuptext" id="myPopupE">Este será seu login de usuário</span>
            </div>
            <input type="email" name="email" id="email" placeholder="email / login" required>
          </div>
          <div class = "d-senhas">
          <div class="n-senha">
            <input type="password" name="senha" id="senha" placeholder="nova senha" required>
          </div>
            <div class="c-senha">
              <input type="password" name="confirma-senha" id="confirma-senha" class="csenha" placeholder="confirma senha" required>
            </div>
          </div>
          <div class="select-usr">
           
            <select name="nas" id="nas" required>
              <optgroup label = "UNIDADES">
                <?php
                  while($user_data = mysqli_fetch_assoc($result5)){
                    echo "<option value='$user_data[shortname]'>$user_data[shortname]</option>";
                  }
                ?>
                
              </optgroup>
              
            </select>

          </div>
        </div>

        <div class="detail-check">
          <input type="checkbox" name="check" id="check" class="check" onclick="checkado(), uncheck()">
          <label for="check">Eu aceito os <a href="" onclick="janela()"> Termos e Condições.</a></label>
        </div>
        <input type="submit" name="submit" id="submit" value="Enviar" class="btn3" onclick="alerta()">
        
      </form>
        </div>
      </div>
    
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script src="../../../js/script.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="../../../js/form.js"></script>

</body>

</html>