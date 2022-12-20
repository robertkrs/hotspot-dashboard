<?php
  session_start();
  include_once('config.php');
  /*if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header("Location:index.html");
  }
  */

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

 
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Signet</title>
  <link rel="stylesheet" href="./css/style.css">
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
            <span class="navigation-titulo">Signet</span>
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
          <a href="">
            <span class="navigation-icone">
              <ion-icon name="people-outline"></ion-icon>
            </span>
            <span class="navigation-titulo">Minha Conta</span>
          </a>
        </li>
        <li>
          <a href="">
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
  <main>
    <main class="main">
      <div class="topbar">
        <div class="toggle">
          <ion-icon name="menu-outline"></ion-icon>
        </div>
        <div class="search">
          <label>
            <input type="text" placeholder="Procurar">
            <ion-icon name="search-circle-outline"></ion-icon>
          </label>
        </div>
        <div class="user">
          <img src="user.jpg">
        </div>
      </div>


      <!-- cards -->
      <div class="cardBox">
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
            <ion-icon name="eye-outline"></ion-icon>
          </div>
        </div>
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
          <ion-icon name="person-add-outline"></ion-icon>
          </div>
        </div>
        <div class="card">
          <div>
            <div class="numbers">585</div>
            <div class="cardsName">Comments</div>
          </div>
          <div class="iconBx">
            <ion-icon name="chatbubbles-outline"></ion-icon>
          </div>
        </div>
      </div>

      <div class="graphBox">
        <div class="box">
          <canvas id="myChart"></canvas>
        </div>
        <div class="box">
          <canvas id="myEarnings"></canvas>
        </div>
        
        
      </div>
      <!-- details -->
      <div class="details">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Usuarios Cadastrados</h2>
            <a href="#" class="btn">View All</a>
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
            <tbody>

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
            <!--
              <tr>
                <td>Star Refrigerator</td>
                <td>$1200</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr>
              <tr>
                <td>Speakers</td>
                <td>$620</td>
                <td>Paid</td>
                <td><span class="status return">Return</span></td>
              </tr>
              <tr>
                <td>Hp Laptop</td>
                <td>$110</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
              </tr>
              <tr>
                <td>Apple Watch</td>
                <td>$1200</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr>
              <tr>
                <td>Wall Fan</td>
                <td>$110</td>
                <td>Paid</td>
                <td><span class="status pending">Pending</span></td>
              </tr>
              <tr>
                <td>Adidas Shoes</td>
                <td>$620</td>
                <td>Paid</td>
                <td><span class="status return">Return</span></td>
              </tr>
              <tr>
                <td>Denim Shirts</td>
                <td>$110</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
              </tr>
              <tr>
                <td>Casual Shoes</td>
                <td>$575</td>
                <td>Paid</td>
                <td><span class="status pending">Pending</span></td>
              </tr>
              <tr>
                <td>Wall Fan</td>
                <td>$110</td>
                <td>Paid</td>
                <td><span class="status pending">Pending</span></td>
              </tr>
              <tr>
                <td>Denim Shirts</td>
                <td>$110</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
              </tr>
              <tr>
                <td>Star Refrigerator</td>
                <td>$1200</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr> -->
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
              echo "<td>".$user_data['username']; "</td>";
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
  <script src="/js/charts.js"></script>
    <script src="/js/dashboard.js"></script>
</body>

</html>