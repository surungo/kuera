<?php
include_once PATHPUBBEAN . '/PaginaBean.php';
include_once 'AbstractDAO.php';
include_once PATHPUBDAO . '/SistemaDAO.php';
class PaginaDAO extends AbstractDAO {
	protected $alias = "pa";
	protected $tabela = "pagina";
	protected $idtabela = "idpagina";
	protected $campos = array (
			"nome",
			"url",
			"ordem",
			"hierarquia",
			"target",
			"visivel",
			"ativo",
			"idsistema",
			"idpagina" 
	);
	public $ordernome = "pa.ordem";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function findByUsuario($idusuario) {
		$clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . "   pp.nome pnome, " . "   u.usuario usuario " . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . "   inner join " . DBPREFIXPUB . "pagina_perfil ppp on " . "     ppp.idpagina = " . $this->alias . ".idpagina " . "   inner join " . DBPREFIXPUB . "perfil pp on " . "     ppp.idperfil = pp.idperfil " . "   inner join " . DBPREFIXPUB . "usuario u on " . "     u.idperfil = pp.idperfil " . " where u.idusuario =  ? ".
				//" 	or ".$this->alias.".url = 'Logoff' ".
				" ORDER BY " . $this->ordernome . " ASC ";
			$this->con->setTexto ( 1, $idusuario );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $clt;
	}
	public function findByPerfil($idperfil) {
		$clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . "   inner join " . DBPREFIXPUB . "pagina_perfil ppp on " . "     ppp.idpagina = " . $this->idtabelaAlias () . " " . "   inner join " . DBPREFIXPUB . "perfil pp on " . "     ppp.idperfil = pp.idperfil " . " where pp.idperfil =  ? " . " ORDER BY " . $this->ordernome . " ASC ";
			
			$this->con->setNumero ( 1, $idperfil );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $clt;
	}
	public function findByNotPerfil($idperfil) {
		$clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " WHERE " . $this->idtabelaAlias () . " NOT IN( " . "     SELECT s.idpagina " . "     FROM " . DBPREFIXPUB . "pagina_perfil s " . "     where s.idperfil = ?  ) " . " ORDER BY " . $this->ordernome . " ASC ";
			$this->con->setNumero ( 1, $idperfil );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $clt;
	}
	public function verificaUsuarioPagina($idusuario, $idpagina) {
		$results = new PaginaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " , " . "   pp.nome pnome, " . "   u.usuario usuario " . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . "   inner join " . DBPREFIXPUB . "pagina_perfil ppp on " . "     ppp.idpagina = " . $this->alias . ".idpagina " . "   inner join " . DBPREFIXPUB . "perfil pp on " . "     ppp.idperfil = pp.idperfil " . "   inner join " . DBPREFIXPUB . "usuario u on " . "     u.idperfil = pp.idperfil " . " where u.idusuario =  ? " . "   and " . $this->idtabelaAlias () . " = ? " . " 	or " . $this->alias . ".url = 'Logoff' " . " ORDER BY " . $this->ordernome . " DESC ";
			$this->con->setNumero ( 1, $idusuario );
			$this->con->setNumero ( 2, $idpagina );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $results;
	}
	public function findByUrl($url) {
		$results = new PaginaBean ();
		try {
			$sistemaDAO = new SistemaDAO ( $this->con );
			
			$query = " SELECT " . $sistemaDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $sistemaDAO->tabelaAlias () . ", " . DBPREFIXPUB . $this->tabelaAlias () . " " . " where " . " url = ? " . " and " . $this->getalias () . ".idsistema = " . $sistemaDAO->idtabelaAlias ();
			
			$this->con->setTexto ( 1, $url );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SistemaDAO findByUrl query", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $results;
	}
	public function update($bean) {
		$results = new PaginaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " nome =  trim(?) , " . " url = trim(?) , " . " ordem = ? , " . " hierarquia = ? , " . " target = ? , " . " visivel = trim(?) , " . " ativo = trim(?) , " . " idsistema = ? , " . " modificador = ? , " . " dtmodificacao = now() " . " WHERE " . $this->idtabela () . " =  ? ;";
			$this->con->setTexto ( 1, $bean->getnome () );
			$this->con->setTexto ( 2, $bean->geturl () );
			$this->con->setNumero ( 3, $bean->getordem () );
			$this->con->setNumero ( 4, $bean->gethierarquia () );
			$this->con->setNumero ( 5, $bean->gettarget () );
			$this->con->setTexto ( 6, $bean->getvisivel () );
			$this->con->setTexto ( 7, $bean->getativo () );
			$this->con->setNumero ( 8, $bean->getsistema () );
			$this->con->setTexto ( 9, $usuarioLoginBean->getusuario () );
			$this->con->setNumero ( 10, $bean->getid () );
			
			$this->con->setsql ( $query );
			$this->con->execute ();
			// echo "Pagina: ".$this->con->getsql();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
		$results = new PaginaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$id = $this->getid ( DBPREFIXPUB );
			$query = " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " (	" . $this->camposInsert () . " )" . " VALUES " . " ( ?, trim(?), trim(?), ?, ?, ?, ?, ?, ?, ? );";
			
			$this->con->clearlistparametros ();
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setTexto ( 2, $bean->getnome () );
			$this->con->setTexto ( 3, $bean->geturl () );
			$this->con->setNumero ( 4, $bean->getordem () );
			$this->con->setNumero ( 5, $bean->gethierarquia () );
			$this->con->setNumero ( 6, $bean->gettarget () );
			$this->con->setTexto ( 7, $bean->getvisivel () );
			$this->con->setTexto ( 8, $bean->getativo () );
			$this->con->setTexto ( 9, $bean->getsistema () );
			$this->con->setNumero ( 10, $id );
			
			$this->con->setsql ( $query );
			$this->con->execute ();
			// $this->con->PrepareSQL();
			// echo "Pagina: ".$this->con->getsql();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$bean = new PaginaBean ();
		
		$bean->setid ( $this->getValorArray ( $array, "idpagina", null ) );
		$bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$bean->seturl ( $this->getValorArray ( $array, "url", null ) );
		$bean->sethierarquia ( $this->getValorArray ( $array, "hierarquia", null ) );
		$bean->settarget ( $this->getValorArray ( $array, "target", null ) );
		$bean->setvisivel ( $this->getValorArray ( $array, "visivel", null ) );
		$bean->setativo ( $this->getValorArray ( $array, "ativo", null ) );
		$bean->setordem ( $this->getValorArray ( $array, "ordem", null ) );
		
		$sistemaDAO = new SistemaDAO ( $this->con );
		$bean->setsistema ( $this->getValorArray ( $array, $sistemaDAO->idtabela (), $sistemaDAO ) );
		
		$bean = $this->getLogBeans ( $array, $bean );
		
		return $bean;
	}
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PaginaDAO findAllAtivo", $this->con->getsql () );
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
		$clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			// echo "Pagina: ".$this->con->getsql();
			
			while ( $array = $result->fetch_assoc () ) {
				$clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $clt;
	}
	public function findById($id) {
		$results = new PaginaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " where " . $this->idtabelaAlias () . " = ? " . " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $id );
			
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			// echo "Pagina: ".$this->con->getsql();
			
			while ( $array = $result->fetch_assoc () ) {
				$results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $results;
	}
	public function delete($bean) {
		$results = new PaginaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			$results = $this->con->query ( $query );
			$this->con->setNumero ( 1, $bean->getid () );
			
			$this->con->setsql ( $query );
			$this->con->execute ();
			// echo "Pagina: ".$this->con->getsql();
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $results;
	}
}
?>