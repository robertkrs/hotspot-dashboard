<?php
  session_start();
  include_once('../../componentes/config.php');
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

    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    /**pegar numero da pagina */
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 0;

    //Setar a quantidade de itens por pagina
    $qnt_result_pg = 20;
    
    //calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;


    //Paginção - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(id_cliente) AS num_result FROM cadastro_clientes";
    $resultado_pg = mysqli_query($conexao, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];

    //Quantidade de pagina 
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

  //Limitar os links antes e depois
    $max_links = 2;
    
  }
  else{
    header("Location:./dashboard.php");
  }

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
    $sql5 = "SELECT * FROM cadastro_clientes WHERE nome_cliente LIKE '%$data%' OR cpf_cliente LIKE '%$data%' OR cidade_cliente LIKE '%$data%'";
  }
  else{
    $sql5 = "SELECT * FROM cadastro_clientes limit $inicio, $qnt_result_pg";
  }
  $result5 = $conexao->query($sql5);


  
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuários | KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="../../css/style.css">
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
              <img src="../../img/logo/KRSv3.svg" alt="">
            </span>
          </a>
        </li>

        <li>
          <a href="./dashboard.php">
            <span class="navigation-icone">
              <ion-icon name="clipboard-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Dashboard</span>
          </a>
        </li>

        <li>
          <a href="./minha_conta.php">
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
              <ion-icon id="img-cadastro" src="../../img/geral/cadastro-files-full.svg"></ion-icon>
            </span>
            <span class="navigation-titulo">Cadastros</span>
          </a>
        </li>';

        echo'  
            <li id="navigation-sub">
              <a href="./cadastros.php?pagina=1">
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
              <a href="./sub-navigation/administradores.php">
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
              <a href="./sub-navigation/nas.php">
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
              <ion-icon id='img-relatorio' src='../../img/geral/pasta-relatorio.svg'></ion-icon>
            </span>
            <span class="navigation-titulo">Relatórios</span>
          </a>
        </li>
        <li id="navigation-sub-relatorio">
          <a href="./relatorios/relatorios-completos/relatorio-conexoes-30.php">
            <span class="navigation-sub-icone">
              <ion-icon name="documents-outline"></ion-icon>
            </span>
            <span class="navigation-sub-titulo">Relatório de Conexões</span>
          </a>
        </li>
 
        <li id="navigation-sub2-relatorio">
          <a href="./relatorios/relatorios-completos/relatorio-usuarios.php">
            <span class="navigation-sub-icone">
            <ion-icon name="documents-outline"></ion-icon>
            </span>
            <span class="navigation-sub-titulo">Relatório de Usuários</span>
          </a>
          </li>

          <li id="navigation-sub3-relatorio">
          <a href="./relatorios/relatorios.php">
            <span class="navigation-sub-icone">
            <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
            </span>
            <span class="navigation-sub-titulo">Outros Relatórios</span>
          </a>
          </li>
        <li>
          <a href="./logout.php">
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
            <input type="search" id="pesquisarC" placeholder="Procurar">
            <button onclick="searchData()" class="btn2"><ion-icon name="search-circle-outline"></ion-icon></button>
          </label>
        </div>
        <div class="user">
          <img src="user.jpg">
        </div>
      </div>

  </div>
    <!-- cards -->
    <div class="cardBox">
      <a href="./online.php">
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
        <a href="./cadastros.php">
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
      <div class="details-users">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Usuários Cadastrados</h2>
            
          </div>
          <table>
            <thead>
              <tr>
                <td>Nome</td>
                <td>Email</td>
                <td>CPF</td>
                <td>Cidade</td>
                <td>Nascimento</td>
                <td>Telefone</td>
                <td></td>
                <td></td>
              </tr>
            </thead>
            <tbody id ="cadastro">

            <?php 
              
              while($user_data = mysqli_fetch_assoc($result5)){
                
                echo '<tr>';
                echo '<td>'.$user_data['nome_cliente'];'</td>';
                echo '<td>'.$user_data['email_cliente'];'</td>';
                echo '<td>'.$user_data['cpf_cliente'];'</td>';
                echo '<td>'.$user_data['cidade_cliente'];'</td>';
                echo '<td>'.$user_data['nascimento_cliente'];'</td>';
                echo '<td>'.$user_data['telefone_cliente'];'</td>';
                $nivel2 = 2;
                $login = $_SESSION['login'];
                $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel2' and login_adm = '$login'";
                $result9 = $conexao->query($sql7);
                if(mysqli_num_rows($result9)){
                  echo "<td>
                <a href='./cadastros-sub/editar.php?id=$user_data[id_cliente]'><ion-icon src='../../img/geral/editar.svg'></ion-icon></a></td>";
                }
                $nivel3 = 4;
                $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id = '$nivel3' and login_adm = '$login'";
                $result9 = $conexao->query($sql7);
                if(mysqli_num_rows($result9)){
                  echo "<td>
                  <a href='./cadastros-sub/remover.php?id=$user_data[id_cliente]' onclick='return (confirm(\"Quer mesmo excluir esse registro?\"))'><ion-icon src='../../img/geral/remover.svg'></ion-icon</a></td>"; 
                } 
                echo '</tr>';

              }
            ?>
            </tbody>
          </table>
        </div>
        <div class="paginas">
        <?php 
          echo "<a href='cadastros.php?pagina=1'>Primeira Pagina</a>"; 
          for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant++){
            if($pag_ant >= 1){
              echo "<a href='cadastros.php?pagina=$pag_ant'>$pag_ant</a>"; 

            }
          }
          echo "$pagina";

          for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
            if($pag_dep <= $quantidade_pg){
              echo "<a href='cadastros.php?pagina=$pag_dep'>$pag_dep</a> ";
            }
          }
          echo "<a href='cadastros.php?pagina=$quantidade_pg'>Ultima Pagina</a>"; 
        ?> 
       </div>
        <div class="cadastrar-plus">
          <a href="/componentes/dashboard/cadastros-sub/registrar.php"><ion-icon src='../../img/geral/plus.svg'></a>
        </div>
        </div>
        
        
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../../js/dashboard.js"></script>
    <script src="../../js/search.js"></script>
    <script src="../../js/navigation.js"></script>
</body>

</html>