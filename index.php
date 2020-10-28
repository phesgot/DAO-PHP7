<?php 

require_once("config.php");

//carrega um usuario
//$usuario = new Usuario();
//$usuario->loadById(5);
//echo $usuario;

// carrega uma lista
//$lista = Usuario::getList();
//echo json_encode($lista);

// carrega uma lista de usuario buscando pelo login
//$search = Usuario::search('to');
//echo json_encode($search);

// carrega um usuario usando o login e a senha
//$usuario = new Usuario();
//$usuario->login('pedro', '1415');
//echo $usuario;

/* INSERT DE UM USUARIO NOVO*/
//$aluno =  new Usuario("mirajá", "*/-+98");
//$aluno->insert();
//echo $aluno;

/*Alterando um usuario*/
//$usuario = new Usuario();
//$usuario->loadById(22);
//$usuario->update('profesor', '-*#$%#¨@%$');
//echo $usuario;

/*Deletando um usuario*/
$usuario = new Usuario();
$usuario->loadById(22);
$usuario->delete();

echo $usuario;

 ?>