<?php
    session_start();
    
    $_SESSION["idProfSelecionado"] = 1;
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
        $SQL->close();
        $con->close();
    }
    function criarArrayDiaSelecionado($dia){
        include"CONEXAO.php";
        if(valiDiaIgual($dia) == "existe"){

        }
        else{
            $diasemana_numero = date('w', strtotime($dia));
            $query = "SELECT aten.horario_inicio,aten.horario_final,serv.duracao 
            from tb_atendimento aten inner join tb_servico serv on 
            serv.id_profissional = aten.id_profissional where serv.id_servico = ?
            and aten.id_profissional = ? and aten.dia = ?";
            $SQL = $con->prepare($query);
            $SQL->bind_param("ii",$_SESSION["idServico"] ,$_SESSION["idProfSelecionado"],$diasemana_numero);
            $SQL->execute();
            $SQL->bind_result($inicio,$fim,$duracao);
            while($SQL->fetch()){
                
            }
        }
    }
    echo json_encode();
?>