<?php
  session_start();
  include_once('../../../componentes/config.php');
  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:../../adm.php");

  }
  $nivel = 1;
  $login = $_SESSION['login'];
  $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
  $result9 = $conexao->query($sql7);

  if(mysqli_num_rows($result9) >= 1){

    /**verifica o numero de pessoas online - CARD 1*/
    $logado = $_SESSION['email'];
    $sql = "SELECT * FROM radacct where acctstoptime is NULL";
    $result = $conexao->query($sql);

    /**verifica numero de cadastros  CARD 2*/
    $sql2 = "SELECT * FROM cadastro_clientes";
    $result2 = $conexao->query($sql2);

    /*Verifica o numero de cadastros diarios CARD 3*/
    $sql4 = "SELECT nome_cliente FROM cadastro_clientes WHERE cast(date(now()) as date) = cast(data_lancamento as date)";
    $result4 = $conexao->query($sql4);

    /** Exibe os cadastros */
    if(!empty($_GET['search'])){
      $data = $_GET['search'];
      $sql5 = "SELECT * FROM nas WHERE id_login LIKE '%$data%' OR login_adm  LIKE '%$data%'";
    }
    else{
      $sql5 = "SELECT *, count(id_cliente) FROM nas INNER JOIN cadastro_clientes ON nas.shortname = evento_local GROUP BY shortname";
    }
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
  <title>Relatórios | Signet</title>
  <meta name="description" content="Hotspot Signet">
  <link rel="stylesheet" href="/../../../css/style.css">
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
              <img src="/../../../img/logo/signet-logo2.svg" alt="">
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

        echo'  <li id="navigation-sub">
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

             echo '<li id="navigation-sub2">
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
          <a href="../../logout.php">
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
        <div class="search">
          <label>
            <input type="search" id="pesquisarAdm" placeholder="Procurar">
            <button onclick="searchDataAdm()" class="btn2"><ion-icon name="search-circle-outline"></ion-icon></button>
          </label>
        </div>
        <div class="user">
          <img src="user.jpg">
        </div>
      </div>

  </div>
    <!-- cards -->
    <div class="cardBox">
      <a href="../online.php">
        <div class="card">
          
          <div>
            <div class="numbers">
            <?php 
             $user_data = mysqli_num_rows($result);
              print_r($user_data);
            ?>
            </div>
            <div class="cardsName">Online</div>
          </div>
          <div class="iconBx">
            <ion-icon name="radio-outline"></ion-icon>
          </div>
          
        </div>
        </a>
        <a href="../cadastros.php">
        <div class="card">
          <div>
            <div class="numbers">
            <?php 
              $user_data = mysqli_num_rows($result2);
              print_r($user_data);
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
      <!-- details -->
      <div class="details-relatorios relatorios">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Usuários Cadastrados</h2>
          </div>
          <div>
            
            <ul>
              <a href="#" onclick="relatoriosOp()">
                <li class="relatorio-open">Relatório de Conexão - Por Dias <span><ion-icon id="img-seta" src="../../../img/geral/seta-cima.svg"></ion-icon></span></li>
              </a>
              <li class="relatorio-1" id="relatorio-1">
                
                <form action="./relatorios-personalizados/relatorio-conexoes.php" method="POST">
                  <div>
                    <label for="nome">Email</label>
                    <input type="text" name="nome" id="nome" placeholder="Ex: robert@gmail.com">
                  </div>
                  <div>
                    <label for="dias">Dias</label>
                    <input type="text" name="dias" id="dias" placeholder="Ex: 30" required>
                  </div>
                  <div>
                    <label for="ip">IP do usuário</label>
                    <input type="text" name="ip" id="ip" placeholder="Ex: 192.16.62.10">
                  </div>
                  <input type="submit" name="submit" id="submit" class="btn" value="Enviar"">
                </form>
              </li>

              <a href="./relatorios-completos/relatorio-conexoes-30.php">
                <li>Relatório de Conexão - 30 dias</li>
              </a>
              <!--Relatorio - Data e IP-->
              <a href="#" onclick="relatorios3Op()">
                <li class="relatorio-open">Relatório de Conexão - Por Data<span><ion-icon id="img-seta3" src="../../../img/geral/seta-cima.svg"></ion-icon></span></li>
              </a>
              <li class="relatorio-1" id="relatorio-3">
                
                <form action="./relatorios-personalizados/relatorio-conexoes-data.php" method="POST">
                  <div>
                    <label for="nome">Email</label>
                    <input type="text" name="nome" id="nome" placeholder="Ex: robert@gmail.com">
                  </div>
                  <div>
                    <label for="data">Data</label>
                    <input type="date" name="data" id="data">
                  </div>
                  <div>
                    <label for="ip">IP do usuário</label>
                    <input type="text" name="ip" id="ip" placeholder="Ex: 192.16.62.10">
                  </div>
                  <input type="submit" name="submit" id="submit" class="btn" value="Enviar"">
                </form>
              </li>
              <a href="#" onclick="relatorios2Op()">
                <li>Relatório de Usuários - Personalizado <span><ion-icon id="img-seta2" src="../../../img/geral/seta-cima.svg"></ion-icon></span></li>
              </a>
              <li class="relatorio-1" id="relatorio-2">
                
                <form action="./relatorios-personalizados/relatorio-usuarios.php" class="form-relatorio-2" method="POST">
                  <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Ex: Robert Kennedy">
                  </div>
                  <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Ex: robert@gmail.com">
                  </div>
                  <div>
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="Ex: 144.506.456-18">
                  </div>
                  <div>
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" placeholder="Ex: Caratinga">
                  </div>
                  <div>
                    <label for="data">Data de Criação</label>
                    <input type="date" name="data" id="data" placeholder="Ex: 2022-08-05">
                  </div>
                  <div>
                    <label for="evento">Evento</label>
                    <input type="text" name="evento" id="evento" placeholder="Ex: Evento">
                  </div>
                  <input type="submit" name="submit" id="submit" class="btn" value="Enviar"">
                </form>
              </li>
              
              <a href="./relatorios-completos/relatorio-usuarios.php">
                <li>Relatório de Usuários - Completo</li>
              </a>

              <a href="./relatorios-completos/relatorio-nas.php">
                <li>Relatório NAS</li>
              </a>
              <a href="./relatorios-completos/relatorio-online.php">
                <li>Relatório de Usuários Onlines</li>
              </a>
              <a href="./relatorios-completos/relatorio-mais-acessos.php">
                <li>Relatório Mais Acessos - 30 Dias</li>
              </a>
            
            
            </ul>
            
          </div>
            
           
        </div>
       
        </div>
        
        
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script src="/../../../js/navigation.js"></script>
    <script src="/../../../js/dashboard.js"></script>
    <script src="/../../../js/relatorios.js"></script>
</body>

</html>