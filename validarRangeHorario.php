<?php
$_SESSION["horarioJaExistente"] = "";
function ativarComparacao($dia){
    include("CONEXAO.php");
    $horarios_marcados = Array();
    $query = "SELECT agen.horario,serv.duracao,aten.horario_inicio,aten.horario_final
    from tb_agenda agen inner join tb_servico serv on agen.id_profissional = serv.id_profissional 
    inner join tb_atendimento aten on agen.id_profissional = aten.id_profissional
    where agen.id_profissional = ? and agen.dia = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("is",$_SESSION["idFunc"],$dia);
    $SQL->execute();
    $SQL->store_result();
    $result = $SQL->num_rows;
    if($result > 0){
        $SQL->bind_result($horario,$duracao,$inicio,$fim);
        while($SQL->fetch()){
            if(comparacao($duracao,$horario,$inicio,$fim) == "achei"){
                return "achei";
            }
        }
        return "nenhuma interferencia";
    }
    else{
        return "Nenhum resultado encontrado";
    }
}

function comparacao($dura,$horario,$inicio,$fim){
    include"CONEXAO.php";
    $query = "SELECT duracao from tb_servico where id_servico = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("i",$_SESSION["idServico"]);
    $SQL->execute();
    $SQL->bind_result($duracao);
    $dr = "";
    while($SQL->fetch()){
        $dr = $duracao;
    }
    //Convertendo a duração do serviço selecionado para minutos
    $resul = preg_replace("/\d+\:/",null,$dr);
    $resul1 = preg_replace("/\:+\d{2}/",null,$dr);
    if($resul1 != "00"){
        $resul1 =  intval($resul1)*60;
    }
    $resul = intval($resul)+intval($resul1);
    //hora inicial do dia do serviço selecionado
    $inicio= new DateTime($inicio);
    //hora final do dia do serviço selecionado
    $fim = new DateTime($fim);
    //array para guardar todos os valores do horario inicial do dia pelo horario final 
    //com relação a duração do serviço selecionado
    $arrayHorarios = Array();
    //O valor é somado dentro do while, para evitar que repita a hora final
    $i = 0;
    while($inicio->add(new DateInterval('PT'.$resul.'M')) <= $fim) {   
        $arrayHorarios[$i] = clone $inicio;
        $i++;
    }
    $total = $i;
    //Aqui começamos a comparar o range de horarios com os horarios adiquiridos no array anterior
    $array1Em1Min = Array();
    $horario = new DateTime($horario);
    $duraMin = preg_replace("/\d+\:/",null,$dura);
    $duraHr = preg_replace("/\:+\d{2}/",null,$dura);
    if($duraHr != "00"){
        $duraHr =  intval($duraHr)*60;
    }
    $dura = intval($duraMin)+intval($duraHr);
    $fimHorario = clone $horario;
    $fimHorario->add(new DateInterval('PT50M'));
    $i = 0;
    while($horario->add(new DateInterval('PT1M'))<= $fimHorario){
        $array1Em1Min[$i] = clone $horario;
        $i++;
    }
    $msg = "nada encontrado";
    for($i = 0;$i<count($array1Em1Min);$i++){
        for ($i1=$total-1; $i1 >=0; $i1--) { 
            if($arrayHorarios[$i1]->format('H:i') == $array1Em1Min[$i]->format('H:i')){
                $_SESSION["horarioJaExistente"] = (string)$array1Em1Min[$i]->format('H:i');
                $msg =  "achei";
                return $msg;
            }
        }
    }
    return $msg;
}
?>