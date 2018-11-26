<?php
session_start();
$_SESSION["idProfSelecionado"] = 1;
// function buscarAgendados($dia){
//     include"CONEXAO.php";
//     $query = "SELECT aten.horario_inicio, aten.horario_final, agen.horario,ser.duracao
//             from tb_atendimento aten inner join tb_agenda agen on 
//             age.id_profissional = aten.id_profissional
//             inner join tb_servico ser on ser.id_profissional = aten.id_profissional
//              where aten.id_profissional = ? and
//             id_servico = ? and aten.dia = ? and agen.dia = ?";
// }
function valiDiaIgual($dia){
    include"CONEXAO.php";
    $query = "SELECT *from tb_agenda where dia = ? and id_profissional = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("si",$dia,$_SESSION["idProfSelecionado"]);
    $SQL->execute();
    $SQL->store_result();
    $result = $SQL->num_rows;
    if($result > 0){
        return "existe";
    }
    else{
        return "não existe";
    }
}
?>