<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteBean.php';

include_once 'InscritoDAO.php';
include_once 'CampeonatoDAO.php';
include_once 'CategoriaDescarteDAO.php';
include_once 'CategoriaDAO.php';

class DescarteDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "descarte";
	protected $tabela = "descarte";
	protected $idtabela = "iddescarte";
	protected $campos = array (
			"idcampeonato",
			"sigla",
			"nome",
			"numero",
			"quantidade",
			"iddescarte" 
	);
	protected $ordernome = "descarte.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new DescarteBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . 			//
			" dtmodificacao = now(), " . 			//
			" modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idcampeonato = ? , " . 			// 4
			" sigla = ? , " . 			// 5
			" nome = ?, " . 			// 6
			" numero = ? ,  " . 			// 7
			" quantidade = ?  " . 			// 7
			" WHERE " . $this->idtabela () . " =  ? "; // 8
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setNumero ( 7, $bean->getnumero () );
			$this->con->setNumero ( 8, $bean->getquantidade () );
			$this->con->setNumero ( 9, $bean->getid () );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteDAO update", $this->con->getsql () );
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
			$usuarioLoginBean = $this->setoperador ();
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 			//
			" ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . 			//
			" idcampeonato , " . 			//
			" sigla , " . 			//
			" nome , " . 			//
			" numero , " . 			//
			" quantidade , " . 			//
			$this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// idcampeonato
			" ? , " . 			// sigla
			" ? , " . 			// nome
			" ? , " . 			// numero
			" ? , " . 			// quantidade
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setNumero ( 7, $bean->getnumero () );
			$this->con->setNumero ( 8, $bean->getquantidade () );
			$this->con->setNumero ( 9, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteDAO insert", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new DescarteBean ();
		$this->bean->setid ( $this->getValorArray ( $array, $this->idtabela (), null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setnumero ( $this->getValorArray ( $array, "numero", null ) );
		$this->bean->setquantidade( $this->getValorArray ( $array, "quantidade", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteDAO findAll", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteDAO findAllAtivo", $this->con->getsql () );
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
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			" ORDER BY " . $this->ordernome;
			
			Util::echobr ( 0, "DescarteDAO findAllSort", $this->con->getsql () );
			
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
	
	public function findByEventoSortAtivo($bean) {
	    $dbg = 0;
	    $campeonatoDAO = new CampeonatoDAO ( $this->con );
		$this->clt = array ();
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			Util::echobr ( $dbg, 'DescarteDAO findByEventoSortAtivo $bean', $bean );
			$query = $query = " SELECT ".
        		$this->camposSelect () ." , " .
        		$campeonatoDAO->camposSelect () .
        		" FROM " .
        		$this->dbprexis . $this->tabelaAlias () .
        		" left join " .
        		$this->dbprexis . $campeonatoDAO->tabelaAlias () .
        		" on " .
        		$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .
        		" where " .
        		 $campeonatoDAO->idtabelaAlias () . " =  ?  " .
        		" ORDER BY " . $this->ordernome;
        		 $this->con->setNumero ( 1, Util::getIdObjeto($bean->getcampeonato()) );
            
            Util::echobr ( $dbg, "DescarteDAO findByEventoSortAtivo Query", $this->con->getsql () );
        		 
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "DescarteDAO findByEventoSortAtivo getsql", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findByNome($bean) {
		$this->results = new DescarteBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . "upper(" . $this->getalias () . ".nome) = upper(?) ";
			$this->con->setTexto ( 1, Util::getNomeObjeto ( $bean ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteDAO findByNome", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findById($id) {
		$this->results = new DescarteBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->idtabelaAlias () . " = ? ";
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
	public function findByCampeonato($idcampeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = $query = " SELECT ". 
					$this->camposSelect () ." , " . 
					$campeonatoDAO->camposSelect () .
					" FROM " . 
					$this->dbprexis . $this->tabelaAlias () . 
					" left join " .
					$this->dbprexis . $campeonatoDAO->tabelaAlias () . 
					" on " . 
					$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
								
					" where " . 
					" IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) = IFNULL( ? ,IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) ) " .
  				    " ORDER BY " . $this->getalias () . ".nome ";
			// echo $query;
			$this->con->setNumero ( 1, $idcampeonato );
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
	
	public function findByCampeonatoAtivos($idcampeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = $query = " SELECT ".
					$this->camposSelect () ." , " .
					$campeonatoDAO->camposSelect () .
					" FROM " .
					$this->dbprexis . $this->tabelaAlias () .
					" left join " .
					$this->dbprexis . $campeonatoDAO->tabelaAlias () .
					" on " .
					$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .
					" where " .
					" IFNULL(".$this->getalias ().".dtvalidade,now()) >= now() and " .
					" IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) = IFNULL( ? ,IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) ) " .
					" ORDER BY " . $this->getalias () . ".nome ";
			// echo $query;
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setsql ( $query );
			Util::echobr (0, "DescarteDAO findByCampeonatoAtivos getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findBySigla($sigla) {
		$this->results = new DescarteBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".sigla  = ? ";
			$this->con->setTexto ( 1, $sigla );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'DescarteDAO findBySigla getsql', $this->con->getsql () );
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
		$this->results = new DescarteBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
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