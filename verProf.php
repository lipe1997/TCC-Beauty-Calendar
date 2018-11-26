<?php
session_start();
$_SESSION["idSalaoCad"] = 0;
function verProf(){
    include"CONEXAO.php";
    $query = "SELECT * from tb_salao_profissional where id_salao = ? limit 1";
    $sql = $con->prepare($query);
    $sql->bind_param('i',$_SESSION["idSalaoCad"]);
    $sql->execute();
    $sql->store_result();
    $resul = $sql->num_rows;
    return $resul;
}
print_r(verProf());