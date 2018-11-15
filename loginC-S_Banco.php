<?php
session_start();
function loginC($usuario,$senha){
    include"CONEXAO.php";

    $query = "SELECT id_login_cliente from tb_loginC where usuario = ? and senha = ? ";
    $SQL = $con->prepare($query);
    $SQL->bind_param("ss",$usuario,$senha);
    $SQL->execute();
    $SQL->bind_result($id_loginC);
    $SQL->store_result();
    $resultado = $SQL->num_rows();
    if($resultado > 0 ){
        while($SQL->fetch()){
            $_SESSION["idCli"] = $id_loginC;
        }
        return "Usuario encontrado com sucesso";
    }
    else{
        return "Usuario não encontrado na base de dados,\n
         se não for cadastrado, aperte no botão cadastrar-se";
    }
}
?>