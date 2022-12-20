
<?php	

  include_once('../../../../componentes/config.php');

	$html = '<table class="tabela" border=2>';	
	$html .= '<thead class="tabela-head">';
	$html .= '<tr>';
	$html .= '<th>Cliente</th>';
	$html .= '<th>CPF</th>';
	$html .= '<th>Cidade</th>';
	$html .= '<th>IP</th>';
	$html .= '<th>Conexão Inicial</th>';
	$html .= '<th>Conexão Final</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody class="relatorio">';
	
  
	$conexoes_usuarios = " SELECT * FROM radacct inner join cadastro_clientes on radacct.username = cadastro_clientes.email_cliente WHERE datediff(cast(date(now())as date),cast(acctupdatetime as date)) <= 30 group by acctupdatetime";
  
	$conexoes_resultados = mysqli_query($conexao, $conexoes_usuarios);


	while($user_data = mysqli_fetch_assoc($conexoes_resultados)){
		$html .= '<tr><td>'.$user_data['nome_cliente'] . "</td>";
		$html .= '<td>'.$user_data['cpf_cliente'] . "</td>";
		$html .= '<td>'.$user_data['cidade_cliente'] . "</td>";
		$html .= '<td>'.$user_data['framedipaddress'] . "</td>";
		$html .= '<td>'.$user_data['acctstarttime'] . "</td>";
		$html .= '<td>'.$user_data['acctstoptime'] . "</td>";
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
        font-size: 0.75rem;
      }
      .relatorio tr td{
        padding:4px;
        font-size:0.75rem;
      }
      </style>
			<h1 style="text-align: center;">Relatório de Conexões (30 Dias)</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_conexoes.pdf", 
		array(
			"Attachment" => true //Para realizar o download somente alterar para true
		)
	);


?>