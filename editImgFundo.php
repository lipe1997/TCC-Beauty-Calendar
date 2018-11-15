<?php
session_start();
    function editImgFundo(){
    include"CONEXAO.php";
       
        if(!empty($_FILES['file'])){
            $nome = $_FILES['file']['name'];
            $extensao = strtolower(substr($nome,-3));
            if($extensao != 'jpg' && $extensao != 'png'){
                
            }
            $diretorio = "Imagens/";
            move_uploaded_file($_FILES['file']['tmp_name'],$diretorio.$nome);
            $img = $diretorio.$nome;
            $script = "UPDATE  tb_cliente SET imgFundo = ? where id_cliente = ?";
            $SQL = $con->prepare($script);
            $SQL->bind_param("si",$img,$_SESSION["idCli"]);
            $resultado = $SQL->execute();
            if($resultado){
                return"Imagem alterada com sucesso";
            }
            else{
                return"Erro ao mandar para o banco";
            }
        }
        else{
            return "Selecione uma imagem antes de salvar";
        }
        
        
        
    }
    echo editImgFundo();
?>