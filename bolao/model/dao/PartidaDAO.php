<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
class PartidaDAO extends AbstractDAO {
	protected $dbprexis = "bolao_";
	protected $alias = "partida";
	protected $tabela = "partida";
	protected $idtabela = "idpartida";
	protected $campos = array (
        "texto",
        "nome",
        "placar1",
        "placar2",
	    "peso",
	    "dtpartida",
	    "idpartida" 
	);
	protected $ordernome = "partida.dtpartida desc,  partida.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new PartidaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = 
			 " UPDATE " . $this->dbprexis . $this->tabela () . 
			 " SET " . 
			" dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" texto = ? , " . 
			" nome = ?  ," . 
			" placar1 = ?  ," .
			" placar2 = ?  ," .
			" peso = ?  ," .
			" dtpartida = ?  " .
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->gettexto() );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setNumero ( 6, $bean->getplacar1 () );
			$this->con->setNumero ( 7, $bean->getplacar2 () );
			$this->con->setNumero ( 8, $bean->getpeso () );
			$this->con->setData ( 9, $bean->getdtpartida () );
			$this->con->setNumero ( 10, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			// echo "Partida: ".$this->con->getsql();
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
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . 
			 			$this->dbprexis . $this->tabela () . 
			 			" ( " . 
			 			" dtcriacao, " . 
			 			" criador, " . 
			 			" dtvalidade, " . 
			 			" dtinicio, " . 
			 			" texto, " . 
			 			" nome, " . 
			 			" placar1, " .
                        " placar2,  " .
                        " peso, " .
                        " dtpartida, " . 
                        $this->idtabela () . 
                        " )values ( " . 
                        " now(), " . 		// dtcriacao,
            			" ?, " . 			// criador,
            			" ?, " . 			// dtvalidade,
            			" ?, " . 			// dtinicio,
            			" ?, " . 			// texto,
            			" ?, " . 			// nome,
            			" ?, " . 			// placar1,
            			" ?, " . 			// placar2,
            			" ?, " . 			// peso,
            			" ?, " . 			// dtpartida,
            			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->gettexto() );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setNumero ( 6, $bean->getplacar1 () );
			$this->con->setNumero ( 7, $bean->getplacar2 () );
			$this->con->setNumero ( 8, $bean->getpeso () );
			$this->con->setData ( 9, $bean->getdtpartida () );
			$this->con->setNumero ( 10, $bean->getid () );
			$this->con->setsql ( $query );
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
		$this->bean = new PartidaBean ();
		
		$this->bean->setid ( $this->getValorArray ( $array, "idpartida", null ) );
		$this->bean->settexto ( $this->getValorArray ( $array, "texto", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setplacar1 ( $this->getValorArray ( $array, "placar1", null ) );
		$this->bean->setplacar2 ( $this->getValorArray ( $array, "placar2", null ) );
		$this->bean->setpeso ( $this->getValorArray ( $array, "peso", null ) );
		$this->bean->setdtpartida ( $this->getValorArray ( $array, "dtpartida", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAll() {
	    $this->clt = array ();
	    try {
	        $query = " SELECT " . $this->camposSelect () .
	        " FROM " . $this->dbprexis . $this->tabelaAlias () .
	        " ORDER BY " . $this->ordernome;
	        $this->con->setsql ( $query );
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
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" ORDER BY " . $this->ordernome;
			
			$this->con->setsql ( $query );
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
	    $this->results = new PartidaBean ();
	    try {
	        $query = " SELECT " . $this->camposSelect () .
	        " FROM " . $this->dbprexis . $this->tabelaAlias () .
	        " where " . $this->idtabelaAlias () . " = ? ";
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
	
	public function ultima() {
	    $this->results = new PartidaBean ();
	    try {
	        $query = " SELECT " . $this->camposSelect () .
	        " FROM " . $this->dbprexis . $this->tabelaAlias () .
	        " order by " . $this->alias.".dtpartida ";
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
		$this->results = new PartidaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . 
			" FROM " . $this->dbprexis . $this->tabela () . 
			" WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
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