<?php
require_once "lib/nusoap.php";

function VolCandAcao($IDVol, $utilizador, $password, $IDAcao){
	$dbhost = "appserver-01.alunos.di.fc.ul.pt";
    $dbuser = "asw003";
    $dbpass = "grupodosfixes";
    $dbname = "asw003";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}
	



    mysqli_query($conn, "SET NAMES'utf8'");

	$openings = "SELECT vagas FROM accao_voluntariado WHERE id_accao = $IDAcao";
	$tranf = mysqli_query($conn, $openings);                      
    $counter = mysqli_fetch_all($tranf);
    $vagas = intval($counter[0][0]);

	$opening_check = "SELECT COUNT(*) FROM accao_ligacao_voluntario WHERE id_accao = $IDAcao AND aceite = 'S'";
	$resultsel = mysqli_query($conn, $opening_check);
	$counter = mysqli_fetch_all($resultsel);
	$counter_final = intval($counter[0][0]);

	$query = "SELECT nome_inst FROM accao_voluntariado WHERE id_accao = $IDAcao ";
	$resultsel = mysqli_query($conn, $query);
    $list = mysqli_fetch_row($resultsel);
    $nome_inst = $list[0];

	$tele_getter = "SELECT telefone FROM instituicao_registo WHERE nome = '$nome_inst'";
    $resultsel = mysqli_query($conn, $tele_getter);
    $list = mysqli_fetch_row($resultsel);
    $telefone = $list[0];

	$cand_checker = "SELECT COUNT(*) FROM accao_ligacao_voluntario WHERE cc = $IDVol and id_accao = $IDAcao";
	$result_count = mysqli_query($conn, $cand_checker);
	$counter = mysqli_fetch_all($result_count);
	$counter_final_cand = intval($counter[0][0]);
	if($counter_final_cand > 0){
		$html =  "<p class='popup'>Já se candidatou a esta ação<br> <button id='btn-ok' onclick='fecharPopup()' class='btn btn-register'>OK</button></p>";

	}elseif($counter_final < $vagas){
		$insert_query = "INSERT INTO accao_ligacao_voluntario VALUES('$IDVol', '$IDAcao', 'N', $telefone)";
		mysqli_query($conn,$insert_query);
  		$html =  "<p class='popup'>Aceite <br> <button id='btn-ok' onclick='fecharPopup()' class='btn btn-register'>OK</button></p>";
	}else{
		$html =  "<p class='popup'>Negado <br> <button id='btn-ok' class='btn btn-register'>OK</button></p>";
	}

	if($password == "noselec"){
		$html = "";
	}
	mysqli_close($conn);
	return $html;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("VolCandAcao", // nome metodo
array('nome' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#VolCandAcao', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>