<?php
  session_start();
  include_once('../../../componentes/config.php');
  if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:../../../adm.php");


  }
  //verifica o nivel do usuario
  $nivel = 3;
  $login = $_SESSION['login'];
  $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel' and login_adm = '$login'";
  $result9 = $conexao->query($sql7);

  if(mysqli_num_rows($result9) >= 1){

  if(!empty($_GET['id'])){

    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM nas where id = $id";
    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0){
      while($user_data = mysqli_fetch_assoc($result)){
       
        $nasname = $user_data['nasname'];
        $shortname = $user_data['shortname'];
        $description = $user_data['description'];
        $senha = $user_data['secret'];
        
      }
    }
    else{
      header("Location:./cadastro_nas.php");
    }
  }
}
  else{
    header("Location:./../dashboard.php");

  }

  /**verifica o numero de pessoas online */
  
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cadastro | KRS</title>
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
              <img src="../../../img/logo/KRS-logo2.svg" alt="">
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
                <a href="#" onclick="ativaRelatorio()">
                  <span class="navigation-icone">
                    <ion-icon id='img-relatorio' src='../../../img/geral/pasta-relatorio.svg'></ion-icon>
                  </span>
                  <span class="navigation-titulo">Relatórios</span>
                </a>
              </li>
              <li id="navigation-sub-relatorio">
                <a href="../relatorios/relatorios-completos/relatorio-conexoes-30.php">
                  <span class="navigation-sub-icone">
                    <ion-icon name="documents-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Relatório de Conexões</span>
                </a>
              </li>
      
              <li id="navigation-sub2-relatorio">
                <a href="../relatorios/relatorios-completos/relatorio-usuarios.php">
                  <span class="navigation-sub-icone">
                  <ion-icon name="documents-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Relatório de Usuários</span>
                </a>
                </li>

                <li id="navigation-sub3-relatorio">
                <a href="../relatorios/relatorios.php">
                  <span class="navigation-sub-icone">
                  <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                  </span>
                  <span class="navigation-sub-titulo">Outros Relatórios</span>
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
      <!-- details -->
      <div class="adm-registro">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Editar Cadastro</h2> 
          </div>
          <form action="alter_nas.php" method="POST" class="adm-formulario ad-formulario">
          
          <div>
            <input type="text" name="nasname" id="nasname" placeholder="nasname" value="<?php echo $nasname ?>">
          </div>
          <div>
            <input type="text" name="shortname" id="shortname" placeholder="shortname" value="<?php echo $shortname ?>">
          </div>
          <div>
            <input type="text" name="senha" id="senha" placeholder="senha" value="<?php echo $senha ?>">
          </div>
          <div>
            <input type="text" name="desc" id="desc" placeholder="description" value="<?php echo $description ?>">
          </div>
         
          <input type="submit" name="submit" id="submit" value="Enviar" class="btn">
          <input type="hidden" name="id" id="id" value="<?php echo $id ?>" >
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