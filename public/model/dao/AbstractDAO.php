<?php
include_once PATHPUBBEAN . '/ReturnDataBaseBean.php';
abstract class AbstractDAO {
	protected $con;
	protected $dbprexis;
	protected $tabela;
	protected $campos;
	protected $idtabela;
	protected $ordernome;
	protected $alias;
	protected $array;
	protected $result;
	protected $clt;
	protected $getBeans;
	// protected $camposLog = array("criador", "dtcriacao", "modificador", "dtmodificacao");
	protected $camposLog = array (
			"criador",
			"dtcriacao",
			"modificador",
			"dtmodificacao",
			"dtvalidade",
			"dtinicio" 
	);
	protected $returnDataBaseBean;
	public function __construct($con) {
		$this->con = $con;
		$this->returnDataBaseBean = new ReturnDataBaseBean ();
	}
	
	// // ---------------
	public function sqlSelect($sql) {
		$params = func_get_args ();
		unset ( $params [0] ); // remover o sql dos parametros
		$sql = str_replace ( "%", "$", $sql );
		$sql = $this->PreparaSQL ( $sql, $params );
		$sql = str_replace ( "$", "%", $sql );
		
		return $sql;
	}
	public function sqlUpdate() {
		$sql = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . $this->camposUpdate () . " WHERE " . $this->idtabela () . " =  ? ";
		
		$params = func_get_args ();
		
		$sql = str_replace ( "%", "$", $sql );
		$sql = $this->PreparaSQL ( $sql, $params );
		$sql = str_replace ( "$", "%", $sql );
		
		return $sql;
	}
	public function sqlInsert() {
		$params = func_get_args ();
		$sql = " INSERT INTO " . $this->dbprexis . $this->tabela () . " (   " . $this->camposInsert () . ") " . " VALUES " . " (  ";
		for($count = 0; $count < count ( $params ); $count ++) {
			$sql .= " ?,";
		}
		
		$sql = substr ( $sql, 0, - 1 );
		$sql .= " ); ";
		
		return $sql;
	}
	
	// // ---------------
	public function PreparaSQL($sql, $array_param) {
		foreach ( $array_param as $k => $v ) {
			// $array_param[$k] = $this->mysql_escape_mimic($v);
			// $array_param[$k] = addslashes($v);
			$array_param [$k] = $v;
		}
		return vsprintf ( str_replace ( "?", "'%s'", $sql ), $array_param );
	}
	
	// // ---------------
	public function mysql_escape_mimic($inp) {
		if (is_array ( $inp ))
			return array_map ( __METHOD__, $inp );
		
		if (! empty ( $inp ) && is_string ( $inp )) {
			return str_replace ( array (
					'\\',
					"\0",
					"\n",
					"\r",
					"'",
					'"',
					"\x1a" 
			), array (
					'\\\\',
					'\\0',
					'\\n',
					'\\r',
					"\\'",
					'\\"',
					'\\Z' 
			), $inp );
		}
		
		return $inp;
	}
	public function setoperador() {
		$dbg=0;
		$usuarioLoginBean = null;
		$keysession = isset ( $_GET ['keysession'] ) && $_GET ['keysession'] != "" ? $_GET ['keysession'] : "";
		if ($keysession == "") {
			$keysession = isset ( $_POST ['keysession'] ) && $_POST ['keysession'] != "" ? $_POST ['keysession'] : "";
		}
		Util::echobr ( $dbg, 'AbstractDAO setoperador $keysession', $keysession );
		
		if (isset ( $_SESSION [$keysession] )) {
			Util::echobr ( $dbg, 'AbstractDAO setoperador $_SESSION [$keysession]', $_SESSION [$keysession] );
			$usuarioLoginBean = unserialize ( $_SESSION [$keysession] );
			Util::echobr ( $dbg, 'AbstractDAO setoperador $usuarioLoginBean', $usuarioLoginBean );
			$query = $this->sqlSelect ( " SET @OPERADOR = ? ;", $usuarioLoginBean->getusuario () );
			$this->con->query ( $query );
		}
		return $usuarioLoginBean;
	}
	public function getoperador() {
		$dbg=0;
		$usuarioLoginBean = null;
		$keysession = isset ( $_GET ['keysession'] ) && $_GET ['keysession'] != "" ? $_GET ['keysession'] : "";
		if ($keysession == "") {
			$keysession = isset ( $_POST ['keysession'] ) && $_POST ['keysession'] != "" ? $_POST ['keysession'] : "";
		}
		Util::echobr ( $dbg, 'AbstractDAO setoperador $keysession', $keysession );
		
		if (isset ( $_SESSION [$keysession] )) {
			Util::echobr ( $dbg, 'AbstractDAO setoperador $_SESSION [$keysession]', $_SESSION [$keysession] );
			$usuarioLoginBean = unserialize ( $_SESSION [$keysession] );
			Util::echobr ( $dbg, 'AbstractDAO setoperador $usuarioLoginBean', $usuarioLoginBean );
			$query = $this->sqlSelect ( " SET @OPERADOR = ? ;", $usuarioLoginBean->getusuario () );
			$this->con->query ( $query );
		}
		return $usuarioLoginBean;
	}
	
	public function camposSelect() {
		$arrayaux = array_merge ( $this->campos, $this->camposLog );
		foreach ( $arrayaux as &$value ) {
			$value = $this->alias . "." . $value . " " . $this->alias . "_" . $value;
		}
		$retorno = implode ( ", ", $arrayaux );
		return $retorno;
	}
	public function camposInsert() {
		$arrayaux = $this->campos;
		// array_pop($arrayaux);
		// $retorno = " criador,dtvalidade " . implode(", ", $arrayaux);
		$retorno = " criador, " . implode ( ", ", $arrayaux );
		return $retorno;
	}
	public function camposUpdate() {
		$arrayaux = $this->campos;
		array_pop ( $arrayaux );
		// $retorno = " modificador = ? ,dtvalidade = ? , " . implode(" = ?, ", $arrayaux) . " = ? ";
		$retorno = " modificador = ? , " . implode ( " = ?, ", $arrayaux ) . " = ? ";
		return $retorno;
	}
	protected function getValorArray($array, $field, $dao) {
		$retorno = null;
		
		if ($dao != null && isset ( $array [$dao->getalias () . "_" . $dao->idtabela ()] ) && $array [$dao->getalias () . "_" . $dao->idtabela ()] != 0) {
			$resultclt [] = $dao->getBeans ( $array );
			$retorno = $resultclt [0];
			
		} else {
			$retorno = isset ( $array [$this->getalias () . "_" . $field] ) ? $array [$this->getalias () . "_" . $field] : null;
			//$retorno = str_replace("\\\\", "", $retorno);
			$retorno = stripslashes($retorno);
			//aspas simples
		}
		return $retorno;
	}
	protected function getBeansLog($array) {
		if (isset ( $array [$this->alias . ".criador"] ))
			$this->bean->setcriador ( $array [$this->alias . ".criador"] );
		if (isset ( $array [$this->alias . ".dtcriacao"] ))
			$this->bean->setdtcriacao ( $array [$this->alias . ".dtcriacao"] );
		if (isset ( $array [$this->alias . ".modificador"] ))
			$this->bean->setmodificador ( $array [$this->alias . ".modificador"] );
		if (isset ( $array [$this->alias . ".dtmodificacao"] ))
			$this->bean->setdtmodificacao ( $array [$this->alias . ".dtmodificacao"] );
		if (isset ( $array [$this->alias . ".dtvalidade"] ))
			$this->bean->setdtvalidade ( $array [$this->alias . ".dtvalidade"] );
		if (isset ( $array [$this->alias . ".dtinicio"] ))
			$this->bean->setdtinicio ( $array [$this->alias . ".dtinicio"] );
	}
	public function tabela() {
		return $this->tabela;
	}
	public function tabelaAlias() {
		return $this->tabela . " " . $this->alias;
	}
	public function idtabela() {
		return $this->idtabela;
	}
	public function idtabelaAlias() {
		return $this->alias . "." . $this->idtabela;
	}
	public function getalias() {
		return $this->alias;
	}
	public function setalias($alias) {
		$this->alias = $alias;
	}
	public function getordernome() {
		return $this->ordernome;
	}
	public function setordernome($ordernome) {
		$this->ordernome = $ordernome;
	}
	public function getdbprexis() {
		return $this->dbprexis;
	}
	public function setdbprexis($dbprexis) {
		$this->dbprexis = $dbprexis;
	}
	protected function whereAtivo() {
		return "  IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND ";
	}
	
	protected function whereAtivoData($coluna) {
		return " IFNULL(" . $coluna . ",now()) < NOW() + INTERVAL 1 SECOND ";
	}

	protected function getid($dbprexis) {
		$atualizado = 0;
		$id = 0;
		try {
			while ( $atualizado == 0 ) {
				// pega sequencia
				$query = " select max(id) max" . " from " . DBPREFIXPUB . "sequence" . " where tabela = '" . $dbprexis . $this->tabela . "' ;";
				$result = $this->con->query ( $query );
				while ( $array = $result->fetch_assoc () ) {
					$id = (isset ( $array ['max'] ) ? $array ['max'] : 0);
				}
				// echo "id".$id;
				// se sequencia para esta tabela n�o existir cria sen�o atualiza
				if ($id == 0) {
					// pega o max da tabela e adiciona 1, se n�o encontra usa id 1
					$query = " select max(" . $this->idtabela . ")+1 max" . " from " . $dbprexis . $this->tabela;
					$result = $this->con->query ( $query );
					while ( $array = $result->fetch_assoc () ) {
						$id = (isset ( $array ['max'] ) ? $array ['max'] : 1);
					}
					
					// cria sequence para tabela
					$query = "insert into  " . DBPREFIXPUB . "sequence" . " ( id , tabela ) values " . " (" . $id . ",'" . $dbprexis . $this->tabela . "')";
					$result = $this->con->query ( $query );
					$atualizado = 0;
				} else {
					// verifica duplicado
					$query = " select " . $this->idtabela . " id" . " from " . $dbprexis . $this->tabela . " where " . $this->idtabela . " = " . $id;
					// echo "<br>duplo".$query;
					$result = $this->con->query ( $query );
					while ( $array = $result->fetch_assoc () ) {
						$query = " select max(" . $this->idtabela . ") id" . " from " . $dbprexis . $this->tabela;
						// echo "<br>max".$query;
						$result = $this->con->query ( $query );
						while ( $array = $result->fetch_assoc () ) {
							$id = (isset ( $array ['id'] ) ? $array ['id'] + 1 : 1);
						}
					}
					// atualiza sequence se possivel
					$query = " update " . DBPREFIXPUB . "sequence" . " set id = " . ($id + 1) . " where tabela = '" . $dbprexis . $this->tabela . "' ;";
					$result = $this->con->query ( $query );
					$atualizado = $this->con->affected_rows();
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $id;
	}
	public function getLogBeans($array, $bean) {
		if (isset ( $array [$this->alias . '_criador'] ))
			$bean->setcriador ( $array [$this->alias . '_criador'] );
		
		if (isset ( $array [$this->alias . '_dtcriacao'] ))
			$bean->setdtcriacao ( $array [$this->alias . '_dtcriacao'] );
		
		if (isset ( $array [$this->alias . '_modificador'] ))
			$bean->setmodificador ( $array [$this->alias . '_modificador'] );
		
		if (isset ( $array [$this->alias . '_dtmodificacao'] ))
			$bean->setdtmodificacao ( $array [$this->alias . '_dtmodificacao'] );
		
		if (isset ( $array [$this->alias . '_dtvalidade'] ))
			$bean->setdtvalidade ( $array [$this->alias . '_dtvalidade'] );
		
		if (isset ( $array [$this->alias . '_dtinicio'] ))
			$bean->setdtinicio ( $array [$this->alias . '_dtinicio'] );
		
		return $bean;
	}
	public function nullNumber($valor) {
		return ($valor == null) ? 0 : $valor;
	}
	public function getreturnDataBaseBean() {
		return $this->returnDataBaseBean;
	}
	public function setreturnDataBaseBean($returnDataBaseBean) {
		$this->returnDataBaseBean = $returnDataBaseBean;
	}
	
	// // For�a a classe que extende (a subclasse) a definir esse m�todo
	// abstract protected function pegarValor();
	// abstract protected function valorComPrefixo( $prefixo );
	// // M�todo comum
	// public function imprimir() {
	// print $this->pegarValor();
	// }
}

?>