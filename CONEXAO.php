<?php 
$bdservidor = '127.0.0.1';
$bdusuario = 'root';
$bdsenha = '';
$bdbanco = 'beauty_calendar';

$con = mysqli_connect($bdservidor, $bdusuario, $bdsenha, $bdbanco);

if( mysqli_connect_errno($con)){
	echo "Problemas para conectar, verifique a conexão!";
	die();
}
?>
