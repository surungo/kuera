<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHPUBBEAN . '/UsuarioBean.php';
class UsuarioDAO extends AbstractDAO {
	protected $alias = "u";
	protected $tabela = "usuario";
	protected $idtabela = "idusuario";
	protected $campos = array (
			"nome",
			"usuario",
			"senha",
			"email",
			"dtlogin",
			"dtaprovado",
			"dtcancelamento",
			"idperfil",
			"idusuario" 
	);
	protected $ordernome = "u.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function findByUsuarioAndSenha($usuario, $senha) {
		$this->results = new UsuarioBean ();
		try {
			$query = $this->sqlSelect ( " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " WHERE " . " 	u.usuario = ? " . " 	and u.senha = md5( ? ) ", $usuario, $senha );
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function autentica($usuario, $senha) {
		$this->results = new UsuarioBean ();
		try {
			$query = $this->sqlSelect ( " SELECT " . 
			    $this->camposSelect () . 
			    " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . 
			    " WHERE " . 
			    " 	u.usuario = ? " . 
			    " 	and u.senha = md5( ? ) " . 
			    " 	and  IFNULL(u.dtcancelamento , now()+1)  > now() ", $usuario, $senha );
			$result = $this->con->query ( $query );
			if ($result != null) {
				while ( $array = $result->fetch_assoc () ) {
					$this->results = $this->getBeans ( $array );
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function trocasenha($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " senha = md5( ? ) , " . " modificador = ? , " . " dtmodificacao = now() " . " WHERE " . $this->idtabela () . " =  ? ", $bean->getsenha (), $usuarioLoginBean->getusuario (), $bean->getid () );
			
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " modificador = ? , " . " dtmodificacao = now(), " . " nome = ? , " . " email = ? , " . " idperfil = ? , " . " usuario = ? " . " WHERE " . $this->idtabela () . " = ? ", $usuarioLoginBean->getusuario (), $bean->getnome (), $bean->getemail (), $bean->getperfil (), $bean->getusuario (), $bean->getid () );
			
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$id = $this->getid ( DBPREFIXPUB );
			$query = $this->sqlSelect ( " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " " . " (	criador, nome, usuario, senha, email, idperfil, idusuario  ) " . " VALUES " . " (  ? ," . " ? , " . " ? , " . " md5( ? ), " . " ? , " . " ? , " . " ?  );", $usuarioLoginBean->getusuario (), $bean->getusuario (), $bean->getnome (), $bean->getsenha (), $bean->getemail (), $bean->getperfil (), $id );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new UsuarioBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idusuario", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setemail ( $this->getValorArray ( $array, "email", null ) );
		$this->bean->setusuario ( $this->getValorArray ( $array, "usuario", null ) );
		$this->bean->setsenha ( $this->getValorArray ( $array, "senha", null ) );
		$this->bean->setperfil ( $this->getValorArray ( $array, "idperfil", null ) );
		
		$this->getBeansLog ( $array );
		
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "UsuarioDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->clt;
	}
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($id) {
		$results = new UsuarioBean ();
		try {
			$query = $this->sqlSelect ( " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " where " . $this->idtabelaAlias () . " = ? " . " ORDER BY " . $this->ordernome, $id );
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $results;
	}
	public function delete($bean) {
		$results = new UsuarioBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ", $bean->getid () );
			$results = $this->con->query ( $query );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $results;
	}
}

?>