<?php
function valiLoginC(){
    include"loginC-S_Banco.php";
    if(!empty($_POST['usuario'])){
        $usuario = $_POST['usuario'];
    }
    else{
        return "Campo usuario vazio";
    }
    if(!empty($_POST['senha'])){
        $senha = $_POST['senha'];
    }else{
        return "Campo senha vazio";
    }
    return loginC($usuario,$senha);
}
echo valiLoginC();
?>