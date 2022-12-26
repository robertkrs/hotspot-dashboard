<?php
  session_start();
  include_once('../../componentes/config.php');
 if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:../../adm.php");
  }
 

  /**verifica o numero de pessoas online Card 1*/
  $sql = "SELECT * FROM radacct where acctstoptime is NULL";
  $result = $conexao->query($sql);

  /**verifica numero de cadastros Card 2*/
  $sql2 = "SELECT * FROM cadastro_clientes ORDER BY data_lancamento DESC";
  $result2 = $conexao->query($sql2);

  /**verifica o maior numero de logins */
  $sql3 = "SELECT username, COUNT(username) FROM radacct GROUP BY username ORDER BY count(username) DESC";
  $result3 = $conexao->query($sql3);

  /**verifica o numero de cadastros diarios Card 3 */
  $sql4 = "SELECT nome_cliente FROM cadastro_clientes WHERE cast(date(now()) as date) = cast(data_lancamento as date)";
  $result4 = $conexao->query($sql4);

   /**verifica o numero de pessoas conectadas por NAS - Grafico 1*/
  $sql5 = "SELECT nas.shortname, count(nas.shortname) FROM nas INNER JOIN radacct ON nas.nasname = radacct.nasipaddress WHERE radacct.acctstoptime is null group by nas.shortname";
  $result5 = $conexao->query($sql5);

  $result6 = $conexao->query($sql5);
/**verifica o numero de pessoas conectadas nos ultimos 7 dias - Grafico 2*/
  $sql6 = "SELECT cast(acctupdatetime as date), count(acctupdatetime) FROM radacct WHERE datediff(cast(date(now())as date),cast(acctupdatetime as date)) <= 7 group by cast(acctupdatetime as date)";
  $result7 = $conexao->query($sql6);
  $result8 = $conexao->query($sql6);

  while($user_data = mysqli_fetch_assoc($result8)){ 
                      
    $res1[] = $user_data['cast(acctupdatetime as date)'];
    
  }
 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | KRS</title>
  <meta name="description" content="Hotspot KRS">
  <link rel="stylesheet" href="../../css/style.css">
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
              <img src="../../img/logo/KRS-logo2.svg" alt="">
            </span>
          </a>
        </li>

        <li>
          <a href="">
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
        $sql7 = "SELECT * FROM administracao INNER JOIN role_permissions ON administracao.role_id = role_permissions.role_id where perm_id >= '$nivel' and login_adm = '//$login'";
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

          echo '
          <li id="navigation-sub2">
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
        <!--
        <div class="search">
          <label>
            <input type="search" id="pesquisar" placeholder="Procurar">
            <button onclick="searchData()" class="btn2"><ion-icon name="search-circle-outline"></ion-icon></button>
          </label>
        </div>
        <div class="user">
          <img src="user.jpg">
        </div>
        -->
      </div>


      <!-- cards -->
      <div class="cardBox">
      <a href="./online.php">
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
        <a href="#cadastro">
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
            <div class="cardsName">Cads/Hoje</div>
          </div>
          <div class="iconBx">
            <ion-icon name="person-add-outline"></ion-icon>
          </div>
        </div>
       
      </div>

      <div class="graphBox">
        <div class="box">
          <canvas id="myChart"></canvas>
        </div>
        <script type="text/javascript">
          var ctx = document.getElementById("myChart").getContext("2d");
          var myChart = new Chart(ctx, {
            type: "pie",
            data: {
              labels: ["<?php 
                  while($user_data2 = mysqli_fetch_assoc($result5)){
                      echo $user_data2['shortname'];
                      
                  }?>",],
              datasets: [
                {
                  label: "Estabelecimentos Online",
                  data: [<?php 
                  while($user_data = mysqli_fetch_assoc($result6)){
                      echo $user_data['count(nas.shortname)'];
                      echo ",";
                  }?>,],
                  backgroundColor: [
                    "rgba(74, 216, 255,0.5)",
                    "rgba(235, 108, 35, 0.5)",
                    "rgba(6, 86, 39, 0.5)",
                    "rgba(255, 161, 0, 0.5)",
                    
                  ],
                  borderColor: [
                    "rgba(74, 216, 255,0.7)",
                    "rgba(235, 108, 35, 0.7)",
                    "rgba(6, 86, 39, 0.7)",
                    "rgba(255, 161, 0, 0.7)",
                  
                  ],
                  borderWidth: 1,
                },
              ],
            },
            options: {
              responsive: true,
            },
          });
         </script>
        <div class="box2">
          <canvas id="myEarnings"></canvas>
        </div>
        <script type="text/javascript">
          const earning = document.getElementById("myEarnings").getContext("2d");
          var myChart = new Chart(earning, {
            type: "bar",
            data: {
              labels: ["<?php 
                  echo $res1[0];
                  ?>" , "<?php 
                  echo $res1[1];
                  ?>","<?php 
                  echo $res1[2];
                  ?>","<?php 
                  echo $res1[3];
                  ?>","<?php 
                  echo $res1[4];
                  ?>","<?php 
                  echo $res1[5];
                  ?>","<?php 
                  echo $res1[6];
                  ?>",],
              datasets: [
                {
                
                  label:"Conexões Diarias",
                  data: [<?php 
                  while($user_data = mysqli_fetch_assoc($result7)){
                      echo $user_data['count(acctupdatetime)'];
                      echo ",";
                  }?>,],
                  backgroundColor: [
                    "rgba(255, 99, 132, 0.5)",
                    "rgba(54, 162, 235, 0.5)",
                    "rgba(255, 206, 86, 0.5)",
                    "rgba(75, 192, 192, 0.5)",
                    "rgba(153, 102, 255, 0.5)",
                    "rgba(255, 159, 64, 0.5)",
                  ],
                  borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                  ],
                  borderWidth: 1,
                },
                
              ],
            },
            options: {
              responsive: true,
            },
          });

        </script>
        
      </div>
      <!-- details -->
      <div class="details">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Ultimos Usuários Cadastrados</h2>
            <div class="btn">
            <a href="./cadastros.php?pagina=1"><ion-icon name="people-outline"></ion-icon>Todos os Usuarios</a>
            </div>
          </div>
          <table>
            <thead>
              <tr>
                <td>Nome</td>
                <td>CPF</td>
                <td>Telefone</td>
                <td>CEP</td>
              </tr>
            </thead>
            <tbody id ="cadastro">

            <?php 
            $i = 0;
              while($user_data = mysqli_fetch_assoc($result2) and $i < 10){
                $i++;
                echo '<tr>';
                echo '<td>'.$user_data['nome_cliente'];'</td>';
                echo '<td>'.$user_data['cpf_cliente'];'</td>';
                echo '<td>'.$user_data['telefone_cliente'];'</td>';
                echo '<td>'.$user_data['cep_cliente'];'</td>';
                echo '</tr>';
              }
            ?>
           
            </tbody>
          </table>
        </div>
        
        <!-- New Customers -->
        <div class="recentCustomers">
          <div class="cardHeader">
            <h2>Mais Acessos</h2>
          </div>
          <table>
            <?php 
            
              $i = 0;
              while($user_data = mysqli_fetch_assoc($result3) and $i < 10){
              $i++;
              echo "<tr>";
              echo "<td>";
              echo "<div>";
              echo "<ion-icon name='person-circle-outline' class='imgBx'>";"</ion-icon>";
              echo "</div>";
              echo "</td>";
              echo "<td class='email-customers'>".$user_data['username']; "</td>";
              echo "<td>".$user_data['COUNT(username)']; "</td>";
              echo "</tr>";
            }
            
            ?>
          </table>
        </div>

      </div>
    
    </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    
    <script src="../../js/dashboard.js"></script>
    <script src="../../js/navigation.js"></script>
</body>

</html>