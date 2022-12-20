<?php	

  include_once('../../componentes/config.php');

	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>ID</th>';
	$html .= '<th>COD Transação</th>';
	$html .= '<th>Tipo de Pagamento</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$result_transacoes = "SELECT * FROM administracao";
	$resultado_trasacoes = mysqli_query($conexao, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['id_adm'] . "</td>";
		$html .= '<td>'.$row_transacoes['login_adm'] . "</td>";
		$html .= '<td>'.$row_transacoes['senha_adm'] . "</td>";
		
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Celke - Relatório de Transações</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_celke.pdf", 
		array(
			"Attachment" => true //Para realizar o download somente alterar para true
		)
	);

  header("Location:./dashboard.php");

?>