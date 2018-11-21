<?php
    session_start();
    
    $_SESSION["idFunc"] = 1;
    $_SESSION["idServico"] = 1;
    $data = $_POST['selecionado'];
        $traco = str_replace(",","-",$data);
        $traco = str_replace(" ","",$traco);
        $mes = preg_replace("/\d/",null,$traco);
        $mes = str_replace("-",null,$mes);
        switch($mes){
            case "Janeiro":
            $traco = str_replace("Janeiro","1",$traco);
            break;
            case "Fevereiro":
            $traco = str_replace("Fevereiro","2",$traco);
            break;
            case "Março":
            $traco = str_replace("Março","3",$traco);
            break;
            case "Abril":
            $traco = str_replace("Abril","4",$traco);
            break;
            case "Maio":
            $traco = str_replace("Maio","5",$traco);
            break;
            case "Junho":
            $traco = str_replace("Junho","6",$traco);
            break;
            case "Julho":
            $traco = str_replace("Julho","7",$traco);
            break;
            case "Agosto":
            $traco = str_replace("Agosto","8",$traco);
            break;
            case "Setembro":
            $traco = str_replace("Setembro","9",$traco);
            break;
            case "Outubro":
            $traco = str_replace("Outubro","10",$traco);
            break;
            case "Novembro":
            $traco = str_replace("Novembro","11",$traco);
            break;
            case "Dezembro":
            $traco = str_replace("Dezembro","12",$traco);
            break;
        }
        $diaConvertido= date("Y-m-d",strtotime($traco));
        $diasemana_numero = date('w', strtotime($diaConvertido));
        $lala = horarioDia($diasemana_numero,$diaConvertido);
        function horarioDia($diaSemana,$diaConvertido){
            include"CONEXAO.php";
            include_once"validarRangeHorario.php";
            
            $info = Array();
            $query = "SELECT aten.horario_inicio, aten.horario_final, serv.duracao 
            from tb_atendimento aten inner join tb_servico serv on 
            aten.id_profissional = serv.id_profissional inner join tb_profissional pro
            where pro.id_profissional = ? and aten.dia = ? and serv.id_servico = ?";
            $SQL = $con->prepare($query);
            $SQL->bind_param("iii",$_SESSION["idFunc"],$diaSemana,$_SESSION["idServico"]);
            $SQL->execute();
            $SQL->bind_result($inicio,$fim,$duracao);
            while($SQL->fetch()){
                $info["inicio"] = $inicio;
                $info["fim"] = $fim;
                $info["duracao"] = $duracao;
            }
            $info["achado"] = "";
            if(ativarComparacao($diaConvertido) == "achei"){
                $info["achado"] = $_SESSION["horarioJaExistente"];
            }
            $SQL->close();
            return $info;
        }
    echo json_encode($lala);
?>