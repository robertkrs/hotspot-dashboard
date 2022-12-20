
<?php	

include_once('../../../../componentes/config.php');

$html = '<table class="tabela" border=2>';	
$html .= '<thead class="tabela-head">';
$html .= '<tr>';
$html .= '<th>Usuario</th>';
$html .= '<th>Conexão Inicial</th>';
$html .= '<th>Conexão Final</th>';
$html .= '<th>IP Address</th>';
$html .= '<th>MAC</th>';
$html .= '<th>NAS</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody class="relatorio">';




$conexoes_usuarios = " SELECT * FROM radacct INNER JOIN nas on radacct.nasipaddress = nas.nasname WHERE acctstoptime IS NULL";

$conexoes_resultados = mysqli_query($conexao, $conexoes_usuarios);


while($user_data = mysqli_fetch_assoc($conexoes_resultados)){
  $html .= '<tr><td>'.$user_data['username'] . "</td>";
  $html .= '<td>'.$user_data['acctstarttime'] . "</td>";
  $html .= '<td>'.$user_data['acctupdatetime'] . "</td>";
  $html .= '<td>'.$user_data['framedipaddress'] . "</td>";
  $html .= '<td>'.$user_data['callingstationid'] . "</td>";
  $html .= '<td>'.$user_data['shortname'] . "</td>";
  $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader
require_once("./../../../../dompdf/autoload.inc.php");

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('

    <style>
    .tabela{
      margin: 0 auto;
    }
    .tabela-head tr th{
      font-size: 1rem;
    }
    .relatorio tr td{
      padding:4px 4px;
      font-size:0.9rem;
      text-align:center;
    }
    </style>
    <h1 style="text-align: center;">Relatório de Usuários Online</h1>
    '. $html .'
  ');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
  "relatorio_online.pdf", 
  array(
    "Attachment" => true //Para realizar o download somente alterar para true
  )
);


?>