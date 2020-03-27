<?php
include_once PATHPUBBEAN . '/SistemaBean.php';
include_once 'AbstractDAO.php';
class SistemaDAO extends AbstractDAO {
	protected $alias = "si";
	protected $tabela = "sistema";
	protected $idtabela = "idsistema";
	protected $campos = array (
			"nome",
			"codigo",
			"idsistema" 
	);
	public $ordernome = "si.idsistema";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " nome =  ? , " . " codigo = ? , " . " modificador = ? , " . " dtmodificacao = now() " . " WHERE " . $this->idtabela () . " =  ? ", $bean->getnome (), $bean->getcodigo (), $usuarioLoginBean->getusuario (), $bean->getid () );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			//
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$id = $this->getid ( DBPREFIXPUB );
			$query = $this->sqlSelect ( " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " (	" . $this->camposInsert () . " )" . " VALUES " . " ( ?, ?, ?, ? );", $usuarioLoginBean->getusuario (), $bean->getnome (), $bean->getcodigo (), $id );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$bean = new SistemaBean ();
		
		$bean->setid ( $this->getValorArray ( $array, "idsistema", null ) );
		$bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$bean->setcodigo ( $this->getValorArray ( $array, "codigo", null ) );
		
		$bean = $this->getLogBeans ( $array, $bean );
		return $bean;
	}
	// metodos padr�o
	public function findAll() {
		$clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $clt;
	}
	public function findById($id) {
		$results = new SistemaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " where " . $this->idtabelaAlias () . " = " . $id . " ORDER BY " . $this->ordernome;
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
		$results = new SistemaBean ();
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