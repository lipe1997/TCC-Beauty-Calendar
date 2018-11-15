<?php
session_start();
function editCliBanco($nome,$celular,$cpf,$logradouro,$bairro,$cidade,$numero,$complemento){
    include"CONEXAO.php";
    editEnd($logradouro,$bairro,$cidade,$numero,$complemento);
    $query = "UPDATE tb_cliente set nome = ?, celular = ?, cpf = ? where id_cliente = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("sssi",$nome,$celular,$cpf,$_SESSION["idCli"]);
    $SQL->execute();
    return "Informações atualizadas com sucesso";
    $SQL->close();
}
function editEnd($logradouro,$bairro,$cidade,$numero,$complemento){
    include'CONEXAO.php';
    $query = "UPDATE tb_endereco set logradouro = ?, bairro = ?, cidade = ?, numero = ?, complemento = ? where id_endereco = ?";
    $SQL = $con->prepare($query);
    $SQL->bind_param("sssssi",$logradouro,$bairro,$cidade,$numero,$complemento,$_SESSION["idCli"]);
    $SQL->execute();

    $SQL->close();

}
?>