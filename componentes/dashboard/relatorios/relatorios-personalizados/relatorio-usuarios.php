
<?php	

include_once('../../../../componentes/config.php');

$html = '<table class="tabela" border=2>';	
$html .= '<thead class="tabela-head">';
$html .= '<tr>';
$html .= '<th>ID</th>';
$html .= '<th>Nome</th>';
$html .= '<th>CPF</th>';
$html .= '<th>Nascimento</th>';
$html .= '<th>CEP</th>';
$html .= '<th>Telefone</th>';
$html .= '<th>Email</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody class="relatorio">';

$nome = $_POST['nome'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$data = $_POST['data'];
$cpf = $_POST['cpf'];
$evento = $_POST['evento'];

$conexoes_usuarios = " SELECT * FROM cadastro_clientes where nome_cliente like '%$nome%' and email_cliente like '%$email%' and cpf_cliente like '%$cpf%' and data_lancamento like '%$data%'and cidade_cliente like '%$cidade%' and evento_local like '%$evento%'";
$conexoes_resultados = mysqli_query($conexao, $conexoes_usuarios);
while($user_data = mysqli_fetch_assoc($conexoes_resultados)){
  $html .= '<tr><td>'.$user_data['id_cliente'] . "</td>";
  $html .= '<td>'.$user_data['nome_cliente'] . "</td>";
  $html .= '<td>'.$user_data['cpf_cliente'] . "</td>";
  $html .= '<td>'.$user_data['nascimento_cliente'] . "</td>";
  $html .= '<td>'.$user_data['cep_cliente'] . "</td>";
  $html .= '<td>'.$user_data['telefone_cliente'] . "</td>";
  $html .= '<td>'.$user_data['email_cliente'] . "</td>";
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
        font-size: 0.70rem;
      }
      .relatorio tr td{
        padding:4px;
        font-size:0.60rem;
        text-align:center;
      }
    </style>
    <h1 style="text-align: center;">Relatório de Usuários Cadastrados Personalizado</h1>
    '. $html .'
  ');

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
  "relatorio_usuarios.pdf", 
  array(
    "Attachment" => true //Para realizar o download somente alterar para true
  )
);


?>