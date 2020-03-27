<?php
include_once PATHPUBBEAN . '/SessionBean.php';
include_once 'AbstractDAO.php';
include_once 'UsuarioDAO.php';
class SessionDAO extends AbstractDAO {
	protected $dbprexis = "public_";
	protected $alias = "session";
	protected $tabela = "session";
	protected $idtabela = "idsession";
	protected $campos = array (
			"keysession",
			"idusuario",
			"ip",
			"token",
			"idsession" 
	);
	public $ordernome = "session.ip";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$dbg=0;
		try {
			$query = " UPDATE " . DBPREFIXPUB . $this->tabela () . " SET " . 			//
			" dtmodificacao = now(), " . 			//
			" modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" keysession = ? , " . 			// 4
			" idusuario = ? , " . 			// 5
			" ip = ? ,  " . 			// 6
			" token = ?  " . 			// 7
			" WHERE " . $this->idtabela () . " =  ? "; // 8
			
			$usuarioLoginBean = $this->setoperador ();
			Util::echobr ($dbg, 'SessionDAO $usuarioLoginBean', $usuarioLoginBean );
			if($usuarioLoginBean==null){
				
				$usuarioLoginBean=$bean->getusuario();
			}
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getkeysession () );
			$this->con->setNumero ( 5,  Util::getIdObjeto($bean->getusuario ()) );
			$this->con->setTexto ( 6, $bean->getip () );
			$this->con->setTexto ( 7, $bean->gettoken () );
			$this->con->setNumero ( 8, $bean->getid () );
			
			$this->con->setsql ( $query );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
		try {
			$id = $this->getid ( $this->dbprexis );
			$query = " insert into " . DBPREFIXPUB . $this->tabela () . " ( " . 
			" dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . 			//
			" keysession , " . 			//
			" idusuario , " . 			//
			" ip , " . 			//
			" token , " . 			//
			$this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// keysession
			" ? , " . 			// idusuario
			" ? , " . 			// ip
			" ? , " . 			// token
			" ? )"; // id;
			
			$usuarioLoginBean = $this->setoperador ();
			if($usuarioLoginBean==null){
				$usuarioLoginBean=$bean->getusuario();
			}
			
			$this->con->setTexto ( 1,$usuarioLoginBean->getusuario() );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getkeysession () );
			$this->con->setNumero ( 5, Util::getIdObjeto($bean->getusuario ()) );
			$this->con->setTexto ( 6, $bean->getip () );
			$this->con->setTexto ( 7, $bean->gettoken () );
			$this->con->setNumero ( 8, $id);
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SessionDAO insert", $this->con->getsql () );
			
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$bean = new SessionBean ();
		$usuarioDao = new UsuarioDAO($this->con);
		
		$bean->setid ( $this->getValorArray ( $array, "idsession", null ) );
		$bean->setkeysession ( $this->getValorArray ( $array, "keysession", null ) );
		$bean->setusuario ( $this->getValorArray ( $array, $usuarioDao->idtabela (), $usuarioDao ) );
		
		//$bean->setpagina ( $this->getValorArray ( $array, $paginaDAO->idtabela (), $paginaDAO ) );
		
		$bean->setip ( $this->getValorArray ( $array, "ip", null ) );
		$bean->settoken ( $this->getValorArray ( $array, "token", null ) );
		
		$bean = $this->getLogBeans ( $array, $bean );
		return $bean;
	}
	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		$usuarioDao = new UsuarioDAO($this->con);
		try {
			$query = 
			" SELECT " . 
			$usuarioDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . 
			DBPREFIXPUB . $this->tabelaAlias () . " " . 
			" inner join ".
			DBPREFIXPUB . $usuarioDao->tabelaAlias () . " " . 
			" on " .
			$usuarioDao->idtabelaAlias () . " = " . $this->getalias() . ".idUsuario " .
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SessionDAO findAll", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findById($id) {
		$this->results = new SessionBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $id ) );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByKeySession($keysession) {
		$this->results = new SessionBean ();
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . DBPREFIXPUB . $this->tabelaAlias () . 
			" where " . $this->getalias() . ".keysession = ? ";
			$this->con->setTexto ( 1, $keysession );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
				
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function findByKeySessionToken($keysession,$token) {
		$this->results = new SessionBean ();
		try {
			$query = " SELECT " .
					$this->camposSelect () .
					" FROM " . DBPREFIXPUB . $this->tabelaAlias () .
					" where " . $this->getalias() . ".keysession = ? ". 
					" and   " . $this->getalias() . ".token = ? ";
			$this->con->setTexto ( 1, $keysession );
			$this->con->setTexto ( 2, $token );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
	
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function delete($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SessionDAO delete", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( Util::getIdObjeto($bean->getid ()) );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function limpa() {
		try {
			$usuarioLoginBean = $this->setoperador ();
				
			$query = " DELETE " . 
				" FROM " . DBPREFIXPUB . $this->tabela () . 
				" WHERE  IFNULL(dtmodificacao,dtcriacao) < NOW() - INTERVAL 1 MINUTE ";
			$this->con->clearlistparametros();
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SessionDAO limpa query", $query );
				
			
			$this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
}

?>