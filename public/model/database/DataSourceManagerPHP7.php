<?php
include "ParametroSQL.php";
class DataSourceManager {
	private $result;
	public $link;
	private $con;
	private $con_db;
	private $port = DBPORT;
	private $timeout;
	private $mysqli;
	private $host = DBHOST;
	private $database = DBNAME;
	private $dbusername = DBUSERNAME;
	private $dbpassword = DBPASSWORD;
	private $comparametros = false;
	public $listparametros = array ();
	private $sql;
	private $classPai;
	public function DataSourceManager() {
	}
	/*public function __construct() {
	}*/
	public function getConnection() {
		return $this;
	}
	public function getConn($classPai) {
		$this->setclassPai($classPai);
		return $this;
	}
	public function close($fake) {
		try {
			if (! ($this->result == 1 || $this->result == 0)) {
				mysql_free_result ( $this->result );
			}
			// if( $this->link!=null )
			// mysql_close($this->link);
			
			$this->con = null;
		} catch ( Exception $e ) {
		}
	}
	public function query($query) {
	    $this->getLink();
	    $this->result = mysqli_query($this->link, $query);
		return $this;
	}
	public function fetch_assoc() {
	    
	    return $this->result->fetch_assoc();
	}
	public function rollback() {
		return 0;
	}
	public function commit() {
		return 0;
	}
	
	public function histTable() {
		$dbg = 0;
		// salvar historico automaticamente
		// insert update delete
		// cria automaticamente a tabela de historio
		// caso a tabela principal sofra alteração a de historico e atualizada
		// as datas de criação e modificação são usadas como id
		
		// remove espaço em branco do inicio da query
		$sqlExecute = ltrim($this->getsql()," ");
		
		// remove espaços em branco duplicados
		$sqlExecute = Util::removeDuplicados($sqlExecute," ");
		
		// divide a query nos espaços
		$sqlArr1 = explode(" ",$sqlExecute);
		
		//descobre posição de array que esta o nome da tabela
		$posNomeTable = 1;
		
		//operacao
		$operacao = strtolower($sqlArr1[0]);
		
		if( $operacao=="update"){
			$posNomeTable=1;
		}
		if( $operacao=="insert"){
			$posNomeTable=2;
		}
		if( $operacao=="delete"){
			$posNomeTable=2;
		}
		
		// nome da tabela
		$nomeTable = $sqlArr1[$posNomeTable];
		
		// nome da tabela historico
		$nomeTableHist = "hist_".$nomeTable;
		
		// nome da tabela temporaria
		$nomeTableTemp = "temp_".$nomeTable;
		
		//Monta query para verificar se existe a tabela historico
		$selectTest = "select 1 from ". $nomeTableHist ."  limit 1 ";
		$this->setsql ( $selectTest );
		$result = $this->con->execute ();
		
		//criar table historico não existente.
		if($this->con->affected_rows() < 0){
			$createTable = "CREATE TABLE ". $nomeTableHist ." AS ".
				" select * from ". $nomeTable ." ";
			$result = mysqli_query($this->link, $createTable); 
		}
		
		// prepara query para gravar historico se for insert
		if( $operacao=="insert"){
			Util::echobr ( 0, "DataSourceManager histTable insert ? ",$operacao );
			// troca o nome da tabela para tabela historico
			$sqlArr1[$posNomeTable] = $nomeTableHist;
			// monta query para gravar historico
			$querygravahistorico = implode(" ",$sqlArr1);
			
		}
		
		// prepara query para gravar historico se for update
		if( $operacao=="update" || $operacao=="delete" ){
			Util::echobr ( $dbg, "DataSourceManager histTable update or delete ? ",$operacao );
			// localiza o where para pegar linha a ser atualizada
			$where = "";
			$indexWhere = 0;
			$whereArray;
			for($indexUpdate=0;$indexUpdate<count($sqlArr1);$indexUpdate++){
				if($indexWhere > 0 || strtolower($sqlArr1[$indexUpdate])=="where"){
					$whereArray[$indexWhere] = strtolower($sqlArr1[$indexUpdate]);
					$indexWhere++;
				}
			}
			$where = " ".implode(" ",$whereArray);
			Util::echobr ( $dbg, "DataSourceManager histTable where ",$where );
			// remove tabelas temporarias
			$this->deletarTabelasTemp();
			
			// prepara query para copiar a linha para uma tabela temporaria
			$createTempTable = "CREATE TABLE ". $nomeTableTemp ." AS ".
					" select * from ". $nomeTable ." ". $where;
			//cria temporaria
			$result = mysqli_query($this->link, $createTempTable);
			
			// caso update atualiza a linha antes de salvar historico, caso delete não é necessario
			if( $operacao=="update" ){
				// prepara query para atualizar a linha na tabela temporaria
				$updateTempTableArray = $sqlArr1;
				$updateTempTableArray[1] = $nomeTableTemp ;
				$updateTempTable = implode(" ",$updateTempTableArray);
				
				//atualizar tabela temporaria
				$result = mysqli_query($this->link, $updateTempTable);

			}else{
				$usuarioBean = $this->getoperador();
				$deleteTempTable = " update ".$nomeTableTemp." set ".
						" modificador = '".$usuarioBean->getusuario ()."' , ".
						" dtmodificacao = '" .Util::getTimestamp()." ' " .
						$where;
				
				Util::echobr ( $dbg, "DataSourceManager histTable deleteTempTablehere ",$deleteTempTable );
				//atualizar tabela temporaria
				$result = mysqli_query($this->link, $deleteTempTable);
				
			}
			
			// monta query para gravar historico			
			$querygravahistorico = "insert into ". $nomeTableHist ."  ".
					" select * from ".$nomeTableTemp;
			
		}
		Util::echobr ( $dbg, "DataSourceManager histTable querygravahistorico ",$querygravahistorico );
		
		$result = mysqli_query ($this->link ,$querygravahistorico  );
		//TODO se der erro por ter coluna nova atualizar historico
		
		
		$this->deletarTabelasTemp();
		
	}
	
	private function deletarTabelasTemp(){
		$this->getLink();
		$tables = mysqli_query("SHOW TABLES");
		while ($nomes = mysql_fetch_array($tables)){
			$nome = $nomes[0];			
			$partsArr = explode("_",strtolower($nome));
			$prefixArr = $partsArr[0];
			if($prefixArr=="temp"){
				$querydrop = "drop table ".$nome;
				$result = mysqli_query ( $this->link , $querydrop);
			}
			
		}
		
	}
	
	private function getLink(){ 
	   $this->link = new mysqli(
	        $this->host,
	        $this->dbusername,
	        $this->dbpassword,
	        $this->database
	        );
	    if($this->link->connect_errno){
	        printf("Connect failed: %s\n", $this->link->connect_errno);
	        exit();
	    }
	    $this->charset();
	    return $this->link;
	}
	
	public function execute() {
	    $this->getLink();
	    
		if (! $this->getcomparametros ()) {
			$this->PrepareSQL ();
		}
	    if($this->getclassPai()=='PessoaBusiness00'){
			echo $this->getsql();
		}
		$this->result = mysqli_query($this->link, $this->getsql());
		//$this->result = mysql_query ( $this->getsql (), $this->link ) or die ( 'Query failed: ' . mysql_error () );
		return $this->result;
	}
	public function PrepareSQL($query) {
		// $query = $this->getsql();
		
		if (strlen ( $query ) > 0) {
			
			$listparametros = $this->getlistparametros ();
			$query = str_replace ( "?,", "? ,", $query );
			$query = str_replace ( ",?", ", ?", $query );
			$query = str_replace ( "?)", "? )", $query );
			$query = str_replace ( "(?", "( ?", $query );
			$query = str_replace ( "=?", "= ?", $query );
			
			$queryArr = explode ( " ? ", $query . " " );
			if ((count ( $queryArr ) - 1) == count ( $listparametros )) {
				$query = "";
				foreach ( $listparametros as $k => $v ) {
					$param = $listparametros [$k];
					$querypart = $queryArr [$k - 1];
					$tipo = $param->gettipo ();
					$valor = " " . $param->getvalor () . " ";
					$query .= $querypart . $valor;
				}
				$query .= $queryArr [count ( $queryArr ) - 1];
			} else {
				$query = "<div class='erro'>". $this->getclassPai() . " - Quantidade de parametros errado, Query ? " . (count ( $queryArr ) - 1) . " e listparametros " . count ( $listparametros ) . "." . "Primeiro adicione os parametro a con e depois a query</div>";
			}
			$this->setcomparametros ( true );
			// echo $query;
			// $this->setsql($query);
		}
		return $query;
	}
	function str_replace_first($search, $replace, $subject) {
		$arrayText = explode ( $replace, $search );
		$retorno = "";
		$concatenacom = "?";
		foreach ( $arrayText as $k => $v ) {
			$retorno .= $v;
			if ($k == 0) {
				$concatenacom = $subject;
			} else {
				if ($k < (count ( $arrayText ) - 1)) {
					$concatenacom = "?";
				} else {
					$concatenacom = "";
				}
			}
			$retorno .= $concatenacom;
		}
		return $retorno;
	}
	public function getclassPai() {
		return $this->classPai;
	}
	public function setclassPai($classPai) {
		$this->classPai = $classPai;
	}
	public function getsql() {
		return $this->sql;
	}
	public function setsql($sql) {
		$sql = $this->PrepareSQL ( $sql );
		$this->sql = $sql;
	}
	public function getlistparametros() {
		return $this->listparametros;
	}
	public function setlistparametros($listparametros) {
		$this->listparametros = $listparametros;
	}
	public function clearlistparametros() {
		$this->listparametros = array ();
	}
	public function getparametro($posicao) {
		return $this->listparametros [$posicao];
	}
	public function setparametro($posicao, $parametro) {
		$this->listparametros [$posicao] = $parametro;
	}
	public function setNumero($posicao, $valor) {
		$parametro = new ParametroSQL ();
		$parametro->setNumero ( $posicao, $valor );
		$this->setparametro ( $posicao, $parametro );
	}
	public function setTexto($posicao, $valor) {
		$parametro = new ParametroSQL ();
		$parametro->setTexto ( $posicao, $valor );
		$this->setparametro ( $posicao, $parametro );
	}
	public function setData($posicao, $valor) {
		$parametro = new ParametroSQL ();
		$parametro->setData ( $posicao, $valor );
		$this->setparametro ( $posicao, $parametro );
	}
	public function setBoleano($posicao, $valor) {
		$parametro = new ParametroSQL ();
		$parametro->setBoleano ( $posicao, $valor );
		$this->setparametro ( $posicao, $parametro );
	}
	public function getcomparametros() {
		return $this->comparametros;
	}
	public function setcomparametros($comparametros) {
		$this->comparametros = $comparametros;
	}
	
	public function getoperador() {
		$usuarioLoginBean = null;
		$keysession = isset ( $_GET ['keysession'] ) && $_GET ['keysession'] != "" ? $_GET ['keysession'] : "";
		if ($keysession == "") {
			$keysession = isset ( $_POST ['keysession'] ) && $_POST ['keysession'] != "" ? $_POST ['keysession'] : "";
		}
		if (isset ( $_SESSION [$keysession] )) {
			$usuarioLoginBean = unserialize ( $_SESSION [$keysession] );
			$query = " SET @OPERADOR = '".$usuarioLoginBean->getusuario ()."' ";
			$this->query ( $query );
		}
		return $usuarioLoginBean;
	}
	
	public function affected_rows(){
	    return mysqli_affected_rows($this->link);
	}
	private function charset(){
	    mysqli_set_charset ( $this->link,PRJCHARSETMYSQL );
	    mysqli_query ( "SET NAMES '" . PRJCHARSETMYSQL . "'" );
	    mysqli_query ( 'SET character_set_connection=' . PRJCHARSETMYSQL );
	    mysqli_query ( 'SET character_set_client=' . PRJCHARSETMYSQL );
	    mysqli_query ( 'SET character_set_results=' . PRJCHARSETMYSQL );
	    return PRJCHARSETMYSQL;
	}
	
}

?> 