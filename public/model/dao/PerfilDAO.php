<?php
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once 'AbstractDAO.php';
class PerfilDAO extends AbstractDAO {
	public $alias = "per";
	public $tabela = "perfil";
	public $idtabela = "idperfil";
	public $campos = array (
			"nome",
			"idpagina",
			"idperfil" 
	);
	public $ordernome = "per.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " UPDATE " . DBPREFIXPUB . $this->tabela () . " SET nome = ?, " . " idpagina = ?, " . " modificador = ? , " . " dtmodificacao = now() " . " WHERE " . $this->idtabela () . " =  ? ", $bean->getnome (), $bean->getpaginacapa (), $usuarioLoginBean->getusuario (), $bean->getid () );
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
			$query = $this->sqlSelect ( " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " (	criador, nome, idpagina, idperfil) " . " VALUES " . " ( ?, ?, ?, ? )", $usuarioLoginBean->getusuario (), $bean->getnome (), $bean->getpaginacapa (), $id );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$bean = new PerfilBean ();
		$bean->setid ( $this->getValorArray ( $array, "idperfil", null ) );
		$bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$bean->setpaginacapa ( $this->getValorArray ( $array, "idpagina", null ) );
		$bean = $this->getLogBeans ( $array, $bean );
		return $bean;
	}
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "BateriaDAO findAllAtivo", $this->con->getsql () );
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
			$query = $this->sqlSelect ( " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome );
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($bean) {
		$results = new PerfilBean ();
		$result = null;
		try {
			$query = $this->sqlSelect ( 
					" SELECT " . 
					$this->camposSelect () . 
					" FROM " . DBPREFIXPUB . $this->tabelaAlias () . 
					" where " . $this->idtabelaAlias () . " =  ? " . 
					" ORDER BY " . $this->ordernome, Util::getIdObjeto($bean) );
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
		$this->results = new PerfilBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = $this->sqlSelect ( " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ", $bean->getid () );
			$this->results = $this->con->query ( $query );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}
?>