<?php 

require_once("config.php");

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	} 

	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	/*metodo para setar dados*/
	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


/*Retorna um usuario*/
	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE idusuario = :ID", array(
			":ID"=>$id));

		if(count($results) > 0){

			$this->setData($results[0]);
		}
	}


/*Exibe uma lista */
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
		":SEARCH"=>"%".$login."%"));
	}




/* insert no banco e retorna id*/
	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
	));

		if(count($results) > 0){
			$this->setData($results[0]);
		}
	}

/* metodo construtor*/
public function __construct($login = "", $senha = ""){

	$this->setDeslogin($login);
	$this->setDessenha($senha);
}


// carrega um usuario usando o login e a senha
	public function login($login, $password){
		
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));
		if(count($results) > 0){

			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou senha invalidos");
			
		}
	}

	/*update*/

	public function update($login, $senha){
		$sql =  new Sql();

			$this->setDeslogin($login);
			$this->setDessenha($senha);

		$sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}



/*Transforma o objeto em string*/
	public function __toString(){

		return json_encode(array( 
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y  H:i:s")
		));
	}

}


 ?>