<?php
include_once PATHPUBBEAN . '/SequenceBean.php';
include_once 'AbstractDAO.php';
class SequenceDAO extends AbstractDAO {
	protected $dbprexis = "public_";
	protected $alias = "sequence";
	protected $tabela = "sequence";
	protected $idtabela = "idsequence";
	protected $campos = array (
			"tabela",
			"id" 
	);
	public $ordernome = "sequence.tabela";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function reset($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " id =  0  " . " WHERE " . " tabela =  ? ";
			
			$this->con->setTexto ( 1, $bean->gettabela () );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "SequenceDAO reset", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			//
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " UPDATE " . DBPREFIXPUB . $this->tabela () . " " . " SET " . " tabela =  ? , " . " modificador = ? , " . " dtmodificacao = now() " . " WHERE " . $this->idtabela () . " =  ? ", $bean->gettalela (), $usuarioLoginBean->getusuario (), $bean->getid () );
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
			$query = $this->sqlSelect ( " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " (	" . $this->camposInsert () . " )" . " VALUES " . " ( ?, ?, ? );", $usuarioLoginBean->getusuario (), $bean->gettabela (), $id );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$bean = new SequenceBean ();
		$bean->setid ( $this->getValorArray ( $array, "id", null ) );
		$bean->settabela ( $this->getValorArray ( $array, "tabela", null ) );
		
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
		$clt = array ();
		try {
			$query = " SELECT " . $this->getalias () . ".id " . $this->getalias () . "_id, " . $this->getalias () . ".tabela " . $this->getalias () . "_tabela " . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
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
		$results = new SequenceBean ();
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
	public function delete($tabela) {
		$this->results = new SequenceBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = "TRUNCATE TABLE kart_inscrito";
			$this->con->setsql ( $query );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $tabela );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Truncate. Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			
			$query = " DELETE " . " FROM public_sequence WHERE " . " tabela = 'kart_inscrito' ";
			
			$this->con->setsql ( $query );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $tabela );
			$this->returnDataBaseBean->setmensagem ( $this->returnDataBaseBean->getmensagem () . "<span class='azul'>Delete. Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}
?>