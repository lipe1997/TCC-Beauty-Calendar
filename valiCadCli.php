<?php
function validarCadCli(){
    include'adicionarCliBanco.php';
    try{
        $msgErro = "";
        if(!empty($_POST["NOME"])){
            $nome = $_POST["NOME"];
            if(preg_match("/^[\s]/",$nome) || !(preg_match("/^[A-Za-záàâãéèêíïóôõúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ.'\s]+$/",$nome))){
                $msgErro = "CAMPO NOME INVÁLIDO";
                return $msgErro;
             }
        }
        else{
            $msgErro = "CAMPO NOME VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['SEXO'])){
            $sexo = $_POST['SEXO'];
        }
        else{
            $msgErro = "SELECIONE SEU SEXO";
            return $msgErro;
        }
        if(!empty($_POST['CPF'])){
            $cpf = $_POST['CPF'];
            if(preg_match("/^[\s]/",$cpf)|| !(preg_match("/^\d{3}.\d{3}.\d{3}-\d{2}$/",$cpf))){
                $msgErro = "CAMPO CPF INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO CPF VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['CELULAR'])){
            $celular = $_POST['CELULAR'];
            if(preg_match("/^[\s]/",$celular) || !(preg_match("/^\([1-9]{2}\) [9][0-9]{4,5}\-[0-9]{4}$/",$celular))){
                $msgErro = "CAMPO CELULAR INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO CELULAR VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['TELEFONE'])){
            $telefone = $_POST['TELEFONE'];
        }
        else{
            $telefone = "";
        }
        if(!empty($_POST['RUA'])){
            $rua = $_POST['RUA'];
            if(preg_match("/^[\s]/",$rua)){
                $msgErro = "CAMPO LOGRADOURO INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO LOGRADOURO VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['CIDADE'])){
            $cidade = $_POST['CIDADE'];
            if(preg_match("/^[\s]/",$cidade)){
                $msgErro = "CAMPO CIDADE INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO CIDADE VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['NUMERO'])){
            $numero = $_POST['NUMERO'];
            if(preg_match("/^[\s]/",$numero)){
                $msgErro = "CAMPO NÚMERO INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO NUMERO VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['UF'])){
            $uf = $_POST['UF'];
            if(preg_match("/^[\s]/",$uf) ){
                $msgErro = "CAMPO UF INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO UF VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['BAIRRO'])){
            $bairro = $_POST['BAIRRO'];
            if(preg_match("/^[\s]/",$bairro) ){
                $msgErro = "CAMPO BAIRRO INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO BAIRRO VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['COMPLEMENTO'])){
            $complemento = $_POST['COMPLEMENTO'];
            if(preg_match("/^[\s]/",$complemento)){
                $msgErro = "CAMPO COMPLEMENTO INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO COMPLEMENTO VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['USUARIO'])){
            $usuario = $_POST['USUARIO'];
            if(preg_match("/^[\s]/",$usuario)){
                $msgErro = "CAMPO USUARIO INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO USUARIO VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['SENHA'])){
            $senha = $_POST['SENHA'];
            if(preg_match("/^[\s]/",$senha)){
                $msgErro = "CAMPO SENHA INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO SENHA VAZIO";
            return $msgErro;
        }
        if(!empty($_POST['CONFSENHA'])){
            $confsenha = $_POST['CONFSENHA'];
            if(preg_match("/^[\s]/",$confsenha)){
                $msgErro = "CAMPO CONFIRMAR SENHA INVÁLIDO";
                return $msgErro;
            }
        }
        else{
            $msgErro = "CAMPO CONFIRMAR SENHA VAZIO";
            return $msgErro;
        }
        
        if($sexo == "F"){
            $foto = "Imagens/girl.png";
        }
        else{
            $foto = "Imagens/boy.png";
        }
        $boleana = verCad($cpf);
        $boleana2 = verUser($usuario);
        if($msgErro == ""){
            if($boleana == true){
                $msgErro = "CPF JA CADASTRADO";
                return $msgErro;
            }elseif($senha != $confsenha){
                $msgErro = "SENHA E CONFIRMAR SENHA INCOMPAÍVEIS";
                return $msgErro;
            }
            elseif($boleana2 == true){
                $msgErro = "NOME DE USUARIO JA CADASTRADO";
                return $msgErro;
            }
            else{
                $msg = Cad_Cli($nome,$celular,$cpf,$telefone,$complemento,
                $cidade,$bairro,$numero,$rua,$uf,$foto,$sexo,$usuario,$senha);
                return $msg;
            }
        }
        else{
            return $msgErro;
        }
        
    }catch(Exception $e){
        return $e;
    }
}
print_r(validarCadCli());
?>