<?php
  session_start();
  include_once('../../../componentes/config.php');
 if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:../../../adm.php");
  }
  $nivel = 3;
  $login = $_SESSION['login'];
  $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
  $result9 = $conexao->query($sql7);

  if(mysqli_num_rows($result9) >= 1){

  /**verifica o numero de pessoas online */
  $logado = $_SESSION['email'];
  $sql = "SELECT * FROM radacct where acctstoptime is NULL";
  $result = $conexao->query($sql);

  /**verifica numero de cadastros */
  $sql2 = "SELECT * FROM cadastro_clientes";
  $result2 = $conexao->query($sql2);

  /**verifica o maior numero de logins */
  $sql3 = "SELECT username, COUNT(username) FROM radacct GROUP BY username";
  $result3 = $conexao->query($sql3);

  $sql4 = "SELECT nome_cliente FROM cadastro_clientes WHERE cast(date(now()) as date) = cast(data_lancamento as date)";
  $result4 = $conexao->query($sql4);

  $sql5 = "SELECT * FROM nas";
  $result5 = $conexao->query($sql5);
  
  }else{
    header("Location:./../dashboard.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro | KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="../../../css/style.css">
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
              <img src="../../../img/logo/KRSv3.svg" alt="">
            </span>
          </a>
        </li>

        <li>
          <a href="./../dashboard.php">
            <span class="navigation-icone">
              <ion-icon name="clipboard-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Dashboard</span>
          </a>
        </li>

        <li>
          <a href="./../minha_conta.php">
            <span class="navigation-icone">
              <ion-icon name="person-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Minha Conta</span>
          </a>
        </li>
        <?php 
        $nivel = 1;
        $login = $_SESSION['login'];
        $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id >= '$nivel' and login_adm = '$login'";
        $result9 = $conexao->query($sql7);
        if(mysqli_num_rows($result9) >= 1){

     
        echo '
        
        <li>
          <a href="#" onclick="ativaMenu()">
            <span class="navigation-icone">
              <ion-icon id="img-cadastro" src="../../../img/geral/cadastro-files-full.svg"></ion-icon>
            </span>
            <span class="navigation-titulo">Cadastros</span>
          </a>
        </li>';

        echo'  
          <li id="navigation-sub">
            <a href="../cadastros.php?pagina=1">
              <span class="navigation-sub-icone">
                <ion-icon name="people-outline"></ion-icon>
              </span>
              <span class="navigation-sub-titulo">Usuarios</span>
            </a>
          </li>';
          $nivel2 = 4;
          $login = $_SESSION['login'];
          $sql8 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel2' and login_adm = '$login'";
          $result10 = $conexao->query($sql8);
             
          if(mysqli_num_rows($result10) >= 1){

          echo '
          <li id="navigation-sub2">
          <a href="../sub-navigation/administradores.php">
            <span class="navigation-sub-icone">
            <ion-icon name="desktop-outline"></ion-icon>
            </span>
            <span class="navigation-sub-titulo">Adms</span>
          </a>
          </li>';}else{
          echo '<li id="navigation-sub2"></li>';
          }
          echo ' 
          <li id="navigation-sub3">
          <a href="../sub-navigation/nas.php">
            <span class="navigation-sub-icone">
            <ion-icon name="wifi-outline"></ion-icon>
            </span>
            <span class="navigation-sub-titulo">NAS</span>
          </a>
          </li>
          ';}?>
           <li>
                <a href="#" onclick="ativaRelatorio()">
                  <span class="navigation-icone">
                    <ion-icon id='img-relatorio' src='../../../img/geral/pasta-relatorio.svg'></ion-icon>
                  </span>
                  <span class="navigation-titulo">Relat??rios</span>
                </a>
              </li>
              <li id="navigation-sub-relatorio">
                <a href="../relatorios/relatorios-completos/relatorio-conexoes-30.php">
                  <span class="navigation-sub-icone">
                    <ion-icon name="documents-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Relat??rio de Conex??es</span>
                </a>
              </li>
      
              <li id="navigation-sub2-relatorio">
                <a href="../relatorios/relatorios-completos/relatorio-usuarios.php">
                  <span class="navigation-sub-icone">
                  <ion-icon name="documents-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Relat??rio de Usu??rios</span>
                </a>
                </li>

                <li id="navigation-sub3-relatorio">
                <a href="../relatorios/relatorios.php">
                  <span class="navigation-sub-icone">
                  <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Outros Relat??rios</span>
                </a>
                </li>
        <li>
          <a href="./../logout.php">
            <span class="navigation-icone">
              <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Sair</span>
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


      <!-- cards -->
      <div class="cardBox">
      <a href="./../online.php">
        <div class="card">
          
          <div>
            <div class="numbers">
            <?php 
             $user_data = mysqli_num_rows($result);
              echo $user_data;
            ?>
            </div>
            <div class="cardsName">Online</div>
          </div>
          <div class="iconBx">
          <ion-icon name="radio-outline"></ion-icon>
          </div>
          
        </div>
        </a>
        <a href="./../cadastros.php?pagina=1">
        <div class="card">
          <div>
            <div class="numbers">
            <?php 
              $user_data = mysqli_num_rows($result2);
              echo $user_data;
            ?>
            </div>
            <div class="cardsName">Cadastros</div>
          </div>
          <div class="iconBx">
          <ion-icon name="people-outline"></ion-icon>
          </div>
        </div>
        </a>
        <div class="card">
          <div>
            <div class="numbers">
              <?php
                $user_data = mysqli_num_rows($result4);
                echo $user_data;
              ?>
              </div>
            <div class="cardsName">Cadastrados Hoje</div>
          </div>
          <div class="iconBx">
            <ion-icon name="person-add-outline"></ion-icon>
          </div>
        </div>
      </div>

      <div class="details-registro">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Cadastro</h2>
          </div>
      <form action="../../../registro-adm.php" method="POST" class="details-formulario-usr d-formulario-usr">
        <div class="informacao-pessoal">
          <h3 class="subtitulo">Informa????es Pessoais</h3>
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
          
            <h3 class="subtitulo">Endere??o</h3>
          

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
              <span class="popuptext" id="myPopupE">Este ser?? seu login de usu??rio</span>
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
        <input type="submit" name="submit" id="submit" value="Enviar" class="btn" onclick="alerta()">
         </form>
        </div>
      </div>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script src="../../../js/script.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="../../../js/form.js"></script>
    <script src="../../../js/navigation.js"></script>
</body>

</html>