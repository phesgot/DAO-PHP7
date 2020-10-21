<?php 

require_once("config.php");

$sql = new Sql();


$resultado = $sql->select("SELECT * FROM tb_usuario");

echo json_encode($resultado);




 ?>