<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
class ParametroDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "parametro";
	protected $tabela = "parametro";
	protected $idtabela = "idparametro";
	protected $campos = array (
			"valor",
			"codigo",
			"idparametro" 
	);
	protected $ordercodigo = "parametro.codigo";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new ParametroBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = '" .Util::getTimestamp()." ', " . " modificador = ? , " . " dtvalidade = ? , " . " dtinicio = ? , " . " valor = ? , " . " codigo = ?  " . " WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getvalor () );
			$this->con->setTexto ( 5, $bean->getcodigo () );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ParametroDAO update", $this->con->getsql () );
			//$this->con->histTable();
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
	    $dbg=1;
		try {
			$usuarioLoginBean = $this->setoperador ();
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . " valor, " . " codigo, " . $this->idtabela () . " )values ( '" .Util::getTimestamp()." ', " .			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
          " ?, " .      /* dtinicio,*/ 
          " ?, " . 			// valor,
			" ?, " . 			// codigo,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getvalor () );
			$this->con->setTexto ( 5, $bean->getcodigo () );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "ParametroDAO insert", $this->con->getsql () );
			//$this->con->histTable();
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new ParametroBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idparametro", null ) );
		$this->bean->setcodigo ( $this->getValorArray ( $array, "codigo", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
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
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordercodigo;
			$this->con->setsql ( $query );
			// echo $this->con->getsql();
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findAllSort($bean) {
		$this->clt = array ();
		try {
			if ($bean->getsort () != "") {
				$this->ordercodigo = $bean->getsort ();
			}
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordercodigo;
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ParametroDAO findAllSort", $this->con->getsql () );
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
		$this->results = new ParametroBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, $id );
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
	public function findByCodigo($codigo) {
		$this->results = "";
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".codigo = ? ";
			$this->con->setTexto ( 1, $codigo );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ParametroDAO findByCodigo", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array [$this->alias . "_valor"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function existsCodigo($codigo) {
		$this->results = false;
		try {
			$query = " SELECT " . " count(1) total" . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".codigo = ? ";
			$this->con->setTexto ( 1, $codigo );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ParametroDAO existsCodigo", $this->con->getsql () );
			$result = $this->con->execute ();
			
			$this->results = count ( $result->fetch_assoc () ) > 0;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function updateCodigo($codigo, $valor) {
		$this->results = new ParametroBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = CURRENT_TIMESTAMP, " . " modificador = ? , " . " valor = ?  " . " WHERE " . " codigo = ?  ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setTexto ( 2, $valor );
			$this->con->setTexto ( 3, $codigo );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ParametroDAO updateCodigo", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $codigo );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function delete($bean) {
		$this->results = new ParametroBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->histTable();
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}

?>