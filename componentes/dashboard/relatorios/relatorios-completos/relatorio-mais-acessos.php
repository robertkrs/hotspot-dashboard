<?php	

  include_once('../../../../componentes/config.php');

	$html = '<table class="tabela" border=2>';	
	$html .= '<thead class="tabela-head">';
	$html .= '<tr>';
	$html .= '<th>Usuário</th>';
	$html .= '<th>Acessos</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody class="relatorio">';
	
  


	$conexoes_usuarios = " SELECT username, COUNT(username) FROM radacct GROUP BY username ORDER BY count(username) DESC";
	$conexoes_resultados = mysqli_query($conexao, $conexoes_usuarios);


	while($user_data = mysqli_fetch_assoc($conexoes_resultados)){
		$html .= '<tr><td>'.$user_data['username']; '</td>';
		$html .= '<td>'.$user_data['COUNT(username)']; '</td>';
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
        padding:4px 12px;
        font-size:1rem;
				text-align:center;
      }
      </style>
			<h1 style="text-align: center;">Relatório de Acessos</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_acessos.pdf", 
		array(
			"Attachment" => true //Para realizar o download somente alterar para true
		)
	);


?>