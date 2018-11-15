 <?php
 
session_start();
 function buscarCli(){
	include'CONEXAO.php';
 	$info = array();
 	
 	$query = "SELECT cli.nome, cli.celular,cli.imgFundo,cli.foto, cli.cpf,end.logradouro,end.bairro,
 	end.uf,end.cidade,end.numero,end.complemento from tb_cliente cli 
 	inner join tb_endereco end on cli.id_endereco = end.id_endereco
 	where cli.id_cliente = ?";
	 $SQL = $con->prepare($query);
	 
 	$SQL->bind_param("i",$_SESSION["idCli"]);
 	$SQL->execute();
    $SQL->bind_result($nome,$celular,$imgFundo,$imgPerfil,$cpf,$logradouro,$bairro,$uf,$cidade,$numero,$complemento);
    while($SQL->fetch()){	
    	$info['nome'] = $nome;
		$info['celular'] = $celular;
		$info['imgFundo'] = $imgFundo;
		$info['imgPerfil'] = $imgPerfil;
    	$info['cpf'] = $cpf;
    	$info['logradouro'] = $logradouro;
    	$info['bairro'] = $bairro;
    	$info['uf'] = $uf;
    	$info['cidade'] = $cidade;
    	$info['numero'] = $numero;
    	$info['complemento'] = $complemento;
	}    
	$SQL->close();   
    return $info; 

}
echo json_encode(buscarCli());

?>