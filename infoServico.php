<?php
    session_start();
    
    $_SESSION["idProfSelecionado"] = 1;
    $_SESSION["idServico"] = 1;
    //$data = $_POST['selecionado'];
    $data = "27 ,Novembro, 2018";
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
            $dia_semana = date('w',strtotime($dia));
            $query = "SELECT agen.horario,aten.horario_inicio,aten.horario_final,serv.duracao
            from tb_agenda agen inner join tb_atendimento aten on agen.id_profissional = aten.id_profissional
            inner join tb_servico serv on serv.id_profissional = aten.id_profissional 
            where aten.dia = ? and agen.dia = ? and agen.id_profissional = ?";
            $SQL = $con->prepare($query);
            $SQL->bind_param("isi",$dia_semana,$dia,$_SESSION["idProfSelecionado"]);
            $SQL->execute();
            $SQL->bind_result($horario,$inicio,$fim,$duracao);
            $info = Array();
            $i = 0;
            while($SQL->fetch()){
                $info["horario"][$i] = $horario;
                $info["inicio"] = $inicio;
                $info["fim"] = $fim;
                $info["duracao"][$i] = $duracao; 
                $i++;
            }
            $info["total"] = $i;
            $arrayHorarios = arrayServHorarioSelecionado($dia);
            //hora inicial do dia do serviço selecionado
            $info["inicio"]= new DateTime($info["inicio"]);
            //hora inicial do dia do serviço selecionado
            $info["fim"]= new DateTime($info["fim"]);
            //usado caso tenha mais de 1 horario cadastrado no mesmo dia 
            $diferenca = 0;
            if(count($info["horario"]) > 1){
                //Aqui o bicho vai pegar tilmais
                $arrayFinal = Array();
                $todos1EM1Minuto = Array();
                for($i = 0;$i < count($info["horario"]);$i++){
                    $resul = preg_replace("/\d+\:/",null,$info["duracao"][$i]);
                    $resul1 = preg_replace("/\:+\d{2}/",null,$info["duracao"][$i]);
                    if($resul1 != "00"){
                        $resul1 =  intval($resul1)*60;
                    }
                    $resul = intval($resul)+intval($resul1);
                    $info["horario"][$i]= new DateTime($info["horario"][$i]);
                    $intervalo = clone $info["horario"][$i];
                    $intervalo = $intervalo->add(new DateInterval('PT'.$resul.'M'));
                    $i1=0;
                    $todos1Em1Minuto[count($todos1EM1Minuto)+1] = (string)$info["horario"][$i]->format('H:i');
                    while($info["horario"][$i]->add(new DateInterval('PT1M'))<=$intervalo){
                        $todos1EM1Minuto[count($todos1EM1Minuto)+1] = (string)$info["horario"][$i]->format('H:i');
                        $i1++;
                    }
                    $diferenca = $resul - $arrayHorarios["duracao"];
                    if($diferenca<0){
                        $diferenca *=-1;
                    }
                }
                $arrayFinal[0] = (string)$info["inicio"]->format('H:i');
                
                while( $info["inicio"]<=$info["fim"]){
                    $contador = true;
                    //$arrayFinal[count($arrayFinal)+1] = (string)$info["inicio"]->format('H:i');
                    for($counter = 0;$counter < count($todos1EM1Minuto);$counter++){
                        if($info["inicio"]->format('H:i')== $todos1EM1Minuto[$counter+1]){
                            $contador = false;
                            return "AQUII";
                        }
                        else{
                            
                        }
                    }
                    $info["inicio"]->add(new DateInterval('PT'.$arrayHorarios["duracao"].'M'));  
                }
                return $arrayFinal;
                
            }
            //caso tenha apenas 1 horario cadastrado no dia que a pessoa escolheu
            else{
                $arrayFinal = Array();
                $array1Em1Minuto = Array();
                $info["horario"][0] = new DateTime($info["horario"][0]);
                //clonando o horario ja marcado para fazer alterações nele sem prejudicar
                //o decorrer do codigo
                $resul = preg_replace("/\d+\:/",null,$info["duracao"][0]);
                $resul1 = preg_replace("/\:+\d{2}/",null,$info["duracao"][0]);
                if($resul1 != "00"){
                    $resul1 =  intval($resul1)*60;
                }
                $resul = intval($resul)+intval($resul1);
                $intervalo = clone $info["horario"][0];
                $intervalo = $intervalo->add(new DateInterval('PT'.$resul.'M'));
                $i=1;
                $array1Em1Minuto[0] = clone $intervalo;
                while($info["horario"][0]->add(new DateInterval('PT1M'))<=$intervalo){
                    $array1Em1Minuto[$i] = (string)$info["horario"][0]->format('H:i');
                    $i++;
                }
                $arrayFinal = $arrayHorarios;
                for($i = 0;$i < count($array1Em1Minuto);$i++){
                    for($i1 = 0;$i1 < count($arrayHorarios);$i1++){
                        if($arrayHorarios[$i1] == $array1Em1Minuto[$i]){
                            unset($arrayFinal[$i1]);
                        }
                    }
                }
                return $arrayFinal;
                
            }
        }
        //Esse script corresponde caso nao aja nada marcado no dia selecionado
        else{
            return arrayServHorarioSelecionado($dia);
        }

    }
    function arrayServHorarioSelecionado($dia){
        include"CONEXAO.php";
        $diasemana_numero = date('w', strtotime($dia));
            $query = "SELECT aten.horario_inicio,aten.horario_final,serv.duracao 
            from tb_atendimento aten inner join tb_servico serv on 
            serv.id_profissional = aten.id_profissional where serv.id_servico = ?
            and aten.id_profissional = ? and aten.dia = ?";
            $info = Array();
            $SQL = $con->prepare($query);
            $SQL->bind_param("iii",$_SESSION["idServico"] ,$_SESSION["idProfSelecionado"],$diasemana_numero);
            $SQL->execute();
            $SQL->bind_result($inicio,$fim,$duracao);
            while($SQL->fetch()){
                $info["inicio"] = $inicio;
                $info["fim"] = $fim;
                $info["duracao"] = $duracao;
            }
            $resul = preg_replace("/\d+\:/",null,$info["duracao"]);
            $resul1 = preg_replace("/\:+\d{2}/",null,$info["duracao"]);
            if($resul1 != "00"){
                $resul1 =  intval($resul1)*60;
            }
            $resul = intval($resul)+intval($resul1);
            //hora inicial do dia do serviço selecionado
            $info["inicio"]= new DateTime($info["inicio"]);
            //hora inicial do dia do serviço selecionado
            $info["fim"]= new DateTime($info["fim"]);
            //array para guardar todos os valores do horario inicial do dia pelo horario final 
            //com relação a duração do serviço selecionado
            $arrayHorarios = Array();
            $arrayHorarios[0] = (string)$info["inicio"]->format('H:i');
            $i = 1;
            
            while($info["inicio"]->add(new DateInterval('PT'.$resul.'M')) <=$info["fim"]){
                $arrayHorarios[$i] = (string)$info["inicio"]->format('H:i') ;
                $i++;
            }
            $SQL->close();
            $con->close();
            $arrayHorarios["duracao"] = $resul;
            return $arrayHorarios;
    }
    echo json_encode(criarArrayDiaSelecionado($diaConvertido));
?>