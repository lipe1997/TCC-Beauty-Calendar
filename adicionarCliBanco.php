<?php
    function inserirEndereco($complemento,
    $cidade,$bairro,$numero,$rua,$uf){
        include'CONEXAO.php';
        $cidade = strtoupper($cidade);
        $bairro = strtoupper($bairro);
        $rua = strtoupper($rua);
        $complemento = strtoupper($complemento);
        $query = "INSERT INTO tb_endereco(bairro,uf,cidade,logradouro,numero,complemento) 
                VALUES(?,?,?,?,?,?)";
            $SQL = $con->prepare($query);
            $SQL->bind_param("ssssss",$bairro,$uf,$cidade,$rua,$numero,$complemento);
            $oQueHouve = $SQL->execute();
            $id_endereco = $con->insert_id;
            return $id_endereco;
    }
    function inserir_usuario($usuario,$senha){
        include'CONEXAO.php';
        $query = "INSERT INTO tb_loginC(usuario,senha) VALUES(?,?)";
        $SQL = $con->prepare($query);
        $SQL->bind_param("ss",$usuario,$senha);
        $resul = $SQL->execute();
        $id_login = $con->insert_id;
        if($resul){
            return $id_login;
        }
        else{
            return"ERRO AO CADASTRAR USUARIO E SENHA";
        }
    }
    function Cad_Cli($nome,$celular,$cpf,$telefone,$complemento,
    $cidade,$bairro,$numero,$rua,$uf,$foto,$sexo,$usuario,$senha){
        include'CONEXAO.php';
        $id_endereco = inserirEndereco($complemento,
        $cidade,$bairro,$numero,$rua,$uf);
        $id_login = inserir_usuario($usuario,$senha);
        $query = "INSERT INTO tb_cliente(nome,celular,cpf,foto,telefone,
            sexo,id_endereco,id_loginC) VALUES(?,?,?,?,?,?,?,?)";
        $SQL = $con->prepare($query);
        $SQL->bind_param("ssssssii",$nome,$celular,$cpf,
        $foto,$telefone,$sexo,$id_endereco,$id_login);
        $oQueHouve = $SQL->execute();
        if($oQueHouve){
            $msg = "Cliente cadastrado com sucesso";
        }
        else{
            $msg = "Erro ao cadastrar cliente";
        }
        return $msg;
    }
    function verCad($cpf){
        include'CONEXAO.php';
        try{
            $query = "SELECT * FROM tb_cliente WHERE cpf = ? LIMIT 1";
            $SQL = $con->prepare($query);
            $SQL->bind_param("s",$cpf);
            $SQL->execute();
            $SQL->store_result();
            $resultado = $SQL->num_rows();
            $msg = false;
            if($resultado == 1){
                $msg = true;
            }
            return $msg;
        }catch(Exception $ex){
            echo"$ex";
        }
    }
    function verUser($usuario){
        try{
            include'CONEXAO.php';
            $query = "SELECT * from tb_loginC where usuario = ? LIMIT 1";
            $SQL = $con->prepare($query);
            $SQL->bind_param('s',$usuario);
            $SQL->execute();
            $SQL->store_result();
            $resultado = $SQL->num_rows();
            $msg = false;
            $SQL->close();
            $con->close();
            if($resultado > 0){
                $msg = true;
            }
            return $msg;
        }catch(Exception $ex){
            return $ex;
        }
    }
?>