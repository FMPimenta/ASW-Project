<?php
include "openconn.php";


function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

session_start();

$nome_acao = $_POST['nome_ação'];
$distrito_acao = $_POST['distrito_ação'];
$freguesia_acao = $_POST['freguesia_ação'];
$concelho_acao = $_POST['concelho_ação'];
$descricao_acao = $_POST['descricao_ação'];
$num_vagas_acao = $_POST['num_vagas'];
$areas_acao = $_POST['area_interesse'];
$pop_alvo = $_POST['populacao_alvo'];
$dia_semana = $_POST['dia_semana'];
$periodo_dia = $_POST['periodo_semana'];


if($pop_alvo == 'Crianças'){
    $pop_query = 1;
}
if($pop_alvo == 'Jovens'){
    $pop_query = 2;
}
if($pop_alvo == 'Adultos'){
    $pop_query = 3;
}
if($pop_alvo == 'Família'){
    $pop_query = 5;
}
if($pop_alvo == 'Idosos'){
    $pop_query = 4;
}


if($areas_acao == 'Artes e Entretenimento'){
    $area_query = 1;
}
if($areas_acao == 'Atividade Política'){
    $area_query = 2;
}
if($areas_acao == 'Ação Social'){
    $area_query = 3;
}
if($areas_acao == 'Comunicação e Publicidade'){
    $area_query = 4;
}
if($areas_acao == 'Educação'){
    $area_query = 5;
}
if($areas_acao == 'Inovação e Tecnologias'){
    $area_query = 6;
}
if($areas_acao == 'Meio Ambiente e Energias'){
    $area_query = 7;
}
if($areas_acao == 'Moda e Beleza'){
    $area_query = 8;
}
if($areas_acao == 'Saúde e Bem-estar'){
    $area_query = 9;
}



$dia_semana1 = $_POST['segunda_feira'];
$dia_semana2 = $_POST['terca_feira'];
$dia_semana3 = $_POST['quarta_feira'];
$dia_semana4 = $_POST['quinta_feira'];
$dia_semana5 = $_POST['sexta_feira'];
$dia_semana6 = $_POST['sabado_feira'];
$dia_semana7 = $_POST['domingo_feira'];

$segunda_array = array();
$terca_array = array();
$quarta_array = array();
$quinta_array = array();
$sexta_array = array();
$sabado_array = array();
$domingo_array = array();

if (isset($_POST['segunda_feira'])){
    if(isset($_POST['segunda_manha'])){
        $new = array_push($segunda_array, 1);
        }if(isset($_POST['segunda_tarde'])){
            $new = array_push($segunda_array, 2);
            }if(isset($_POST['segunda_noite'])){
                $new = array_push($segunda_array, 3);
                }
}

if (isset($_POST['terca_feira'])){
    if(isset($_POST['terca_manha'])){
        $new = array_push($terca_array, 1);
        }if(isset($_POST['terca_tarde'])){
            $new = array_push($terca_array, 2);
            }if(isset($_POST['terca_noite'])){
                $new = array_push($terca_array, 3);
                }
}

if (isset($_POST['quarta_feira'])){
    if(isset($_POST['quarta_manha'])){
        $new = array_push($quarta_array, 1);
        }if(isset($_POST['quarta_tarde'])){
            $new = array_push($quarta_array, 2);
            }if(isset($_POST['quarta_noite'])){
                $new = array_push($quarta_array, 3);
                }
}

if (isset($_POST['quinta_feira'])){
    if(isset($_POST['quinta_manha'])){
        $new = array_push($quinta_array, 1);
        }if(isset($_POST['quinta_tarde'])){
            $new = array_push($quinta_array, 2);
            }if(isset($_POST['quinta_noite'])){
                $new = array_push($quinta_array, 3);
                }
}

if (isset($_POST['sexta_feira'])){
    if(isset($_POST['sexta_manha'])){
        $new = array_push($sexta_array, 1);
        }if(isset($_POST['sexta_tarde'])){
            $new = array_push($sexta_array, 2);
            }if(isset($_POST['sexta_noite'])){
                $new = array_push($sexta_array, 3);
                } 
}

if (isset($_POST['sabado_feira'])){
    if(isset($_POST['sabado_manha'])){
        $new = array_push($sabado_array, 1);
        }if(isset($_POST['sabado_tarde'])){
            $new = array_push($sabado_array, 2);
            }if(isset($_POST['sabado_noite'])){
                $new = array_push($sabado_array, 3);
                } 
}

if (isset($_POST['domingo_feira'])){
    if(isset($_POST['domingo_manha'])){
        $new = array_push($domingo_array, 1);
        }if(isset($_POST['domingo_tarde'])){
            $new = array_push($domingo_array, 2);
            }if(isset($_POST['domingo_noite'])){
                $new = array_push($domingo_array, 3);
                } 
}
 







$mail_insti = $_SESSION['username'];

$sql = "SELECT COUNT(*) FROM accao_voluntariado";
$resultsel = mysqli_query($conn, $sql);
$counter = mysqli_fetch_all($resultsel);
$id_accao = intval($counter[0][0]);

$id_accao = $id_accao + 1;

$sql_query_inst = "SELECT * FROM instituicao_registo WHERE mail = N'$mail_insti'";
$result_query = mysqli_query($conn, $sql_query_inst);
$campo_db = mysqli_fetch_array($result_query);
$nome_insti = $campo_db['nome'];


$sql = "insert into accao_voluntariado(id_accao, nome_inst, nome_acao, distrito, concelho, freguesia, funcao, area, populacao, vagas) 
        VALUES (N'$id_accao' ,N'$nome_insti' ,N'$nome_acao',N'$distrito_acao', N'$concelho_acao', N'$freguesia_acao', N'$descricao_acao', N'$area_query', N'$pop_query', N'$num_vagas_acao');";
$result = mysqli_query($conn, $sql);






if(count($segunda_array) != 0){                      
    for ($i = 0; $i < count($segunda_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 1, N'$segunda_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($terca_array) != 0){                      
    for ($i = 0; $i < count($terca_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 2, N'$terca_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($quarta_array) != 0){                      
    for ($i = 0; $i < count($quarta_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 3, N'$quarta_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($quinta_array) != 0){                      
    for ($i = 0; $i < count($quinta_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 4, N'$quinta_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($sexta_array) != 0){                      
    for ($i = 0; $i < count($sexta_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 5, N'$sexta_array[$i]);";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($sabado_array) != 0){                      
    for ($i = 0; $i < count($sabado_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 6, N'$sabado_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}
if(count($domingo_array) != 0){                      
    for ($i = 0; $i < count($domingo_array); $i++)  {
        $sql = "insert into horario_acoes(id, dia, periodo) 
        VALUES (N'$id_accao', 7, N'$domingo_array[$i]');";
        $result = mysqli_query($conn, $sql);
    }
}




header('Location: ../Site/criar_acoes.html'); 


?>