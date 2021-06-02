<?php
require_once "lib/nusoap.php";

function InfoAcaoVol($nome){
	$dbhost = "appserver-01.alunos.di.fc.ul.pt";
    $dbuser = "asw003";
    $dbpass = "grupodosfixes";
    $dbname = "asw003";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}
	
    mysqli_query($conn, "SET NAMES'utf8'");
	
	$sql = "SELECT av.nome_acao, av.distrito, av.concelho, av.freguesia, av.funcao, ai.nome, pa.nome_pop_alvo, ds.nome_dia, pd.nome_periodo FROM accao_voluntariado av
	LEFT JOIN areas_interesse ai ON (av.area = ai.id_area) 
	LEFT JOIN populacao_alvo pa ON (av.populacao = pa.id_pop_alvo) 
	LEFT JOIN horario_acoes ha ON (av.id_accao = ha.id) 
	LEFT JOIN dia_semana ds ON (ha.dia = ds.id_dia) 
	LEFT JOIN periodo_dia pd ON (ha.periodo = pd.id_periodo) 
	WHERE av.nome_inst = '$nome'";



	
	$result=mysqli_query($conn,$sql);
    $headertabela='<table class="table text-center table-light table-striped table-hover"> <tr> <th>Nome Ação</th> 
                    <th>Distrito</th> <th>Concelho</th> <th>Freguesia</th> <th>Objetivo</th> <th>Área de Interesse</th> 
                    <th>População Alvo</th> <th>Dia</th> <th>Periodo do dia</th></tr>';
                    
	while($row=mysqli_fetch_array($result,MYSQLI_NUM))
	{
		$html[] = "<tr><td>" .
                    implode("</td><td>", $row) .
                    "</td></tr>";
	}
	$html = $headertabela . implode("\n", $html) . "</table>";
	// echo $html;
	mysqli_close($conn);
	return $html;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("InfoAcaoVol", // nome metodo
array('nome' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#InfoAcaoVol', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>