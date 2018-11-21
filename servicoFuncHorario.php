<?php
session_start();
    function select(){
        $data = $_POST['dia'];
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
            $traco = str_replace("Maior","5",$traco);
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
        
        return horariosDisponiveis($diaConvertido);
    }
    function horariosDisponiveis($dia){
        include"CONEXAO.php";
        $diaSemana = date('w',strtotime($dia));
        $query = "SELECT horario_inicio, horario_final from
         tb_atendimento where dia = ? ";
        $SQL = $con->prepare($query);
        $SQL->bind_param("i",$diaSemana);
        $SQL->execute();
        $SQL->bind_result($inicio,$fim);
        $info = Array();
        while($SQL->fetch()){
            $info["inicio"] = $inicio;
            $info["fim"] = $fim;
        }
        return $horario;
    }
    print_r(diasTrabalhados());
?>