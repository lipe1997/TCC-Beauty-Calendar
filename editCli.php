<?php
function valiEdit(){
    include"editCliBanco.php";
    if(!empty($_POST["nome"])){
        $nome = strtoupper($_POST["nome"]);
        }
    else{
        return "CAMPO NOME VAZIO";
    }
    if(!empty($_POST["celular"])){
        $celular = strtoupper($_POST["celular"]);
    }
    else{
        return "CAMPO CELULAR VAZIO";
    }
    if(!empty($_POST["cpf"])){
        $cpf = strtoupper($_POST["cpf"]);
    }
    else{
        return "CAMPO CPF VAZIO";
    }
    if(!empty($_POST["logradouro"])){
        $logradouro = strtoupper($_POST["logradouro"]);
    }
    else{
        return "CAMPO LOGRADOURO VAZIO";
    }
    if(!empty($_POST["bairro"])){
        $bairro = strtoupper($_POST["bairro"]);
    }
    else{
        return "CAMPO BAIRRO VAZIO";
    }
    if(!empty($_POST["cidade"])){
        $cidade = strtoupper($_POST["cidade"]);
    }
    else{
        return "CAMPO CIDADE VAZIO";
    }
    if(!empty($_POST["numero"])){
        $numero = strtoupper($_POST["numero"]);
    }
    else{
        return "CAMPO NÚMERO VAZIO";
    }
    if(!empty($_POST["complemento"])){
        $complemento = strtoupper($_POST["complemento"]);
    }
    else{
        return "CAMPO COMPLEMEMNTO VAZIO";
    }
    $msg = editCliBanco($nome,$celular,$cpf,$logradouro,$bairro,$cidade,$numero,$complemento);
    return $msg;
}
echo valiEdit();
    
?>