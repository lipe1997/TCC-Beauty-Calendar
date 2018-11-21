<?php

session_start();
$_SESSION["idFunc"] = 1;
function diasTrabalhados(){
    include"CONEXAO.php";
    $query = "SELECT dia from tb_atendimento where id_profissional = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("i",$_SESSION["idFunc"]);
    $SQL->execute();
    $SQL->bind_result($dia);
    $diaTodos = Array();
    $i = 0;
    while($SQL->fetch()){
        switch($dia){
            case 0:
            $diaTodos["domingo"] = $dia;
            break;
            case 1:
            $diaTodos["segunda"] = $dia;
            break;
            case 2:
            $diaTodos["terca"] = $dia;
            break;
            case 3:
            $diaTodos["quarta"] = $dia;
            break;
            case 4:
            $diaTodos["quinta"] = $dia;
            break;
            case 5:
            $diaTodos["sexta"] = $dia;
            break;
            case 6:
            $diaTodos["sabado"] = $dia;
            break;
        }
    }
    $SQL->close();
    return $diaTodos;
}
echo json_encode(diasTrabalhados());
?>