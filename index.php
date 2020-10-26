<?php 

require_once("config.php");

$usuario = new Usuario();

$usuario->loadById(5);

echo $usuario;




 ?>