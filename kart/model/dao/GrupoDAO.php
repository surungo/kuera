<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';

include_once 'InscritoDAO.php';
include_once 'CampeonatoDAO.php';
include_once 'CategoriaGrupoDAO.php';
include_once 'CategoriaDAO.php';

class GrupoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "grupo";
	protected $tabela = "grupo";
	protected $idtabela = "idgrupo";
	protected $campos = array (
			"idcampeonato",
			"sigla",
			"nome",
			"idgrupo" 
	);
	protected $ordernome = "grupo.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new GrupoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . 			//
			" dtmodificacao = now(), " . 			//
			" modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idcampeonato = ? , " . 			// 4
			" sigla = ? , " . 			// 5
			" nome = ? " . 			// 6
			" WHERE " . $this->idtabela () . " =  ? "; // 7
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setNumero ( 7, $bean->getid () );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "GrupoDAO update", $this->con->getsql () );
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
			$this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// idcampeonato
			" ? , " . 			// sigla
			" ? , " . 			// nome
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setNumero ( 7, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "GrupoDAO insert", $this->con->getsql () );
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
		$this->bean = new GrupoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, $this->idtabela (), null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->settotal ( $this->getValorArray ( $array, "total", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "GrupoDAO findAll", $this->con->getsql () );
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
			Util::echobr ( 0, "GrupoDAO findAllAtivo", $this->con->getsql () );
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
			
			Util::echobr ( 0, "GrupoDAO findAllSort", $this->con->getsql () );
			
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
			Util::echobr ( $dbg, 'GrupoDAO findByEventoSortAtivo $bean', $bean );
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
            
            Util::echobr ( $dbg, "GrupoDAO findByEventoSortAtivo Query", $this->con->getsql () );
        		 
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "GrupoDAO findByEventoSortAtivo getsql", $this->con->getsql () );
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
		$this->results = new GrupoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . "upper(" . $this->getalias () . ".nome) = upper(?) ";
			$this->con->setTexto ( 1, Util::getNomeObjeto ( $bean ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "GrupoDAO findByNome", $this->con->getsql () );
			
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
		$this->results = new GrupoBean ();
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
			Util::echobr (0, "GrupoDAO findByCampeonatoAtivos getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	
	public function totalPilotosGruposByCampeonato($campeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$inscritoDAO = new inscritoDAO ( $this->con );
		try {
			
			$query = " SELECT " . $this->camposSelect () . ", " . 
	 		" count(1) " .
	 		$this->getalias () . "_total " . 
	 		" FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . 
	 		$this->dbprexis . $inscritoDAO->tabelaAlias () . ", " . 
	 		$this->dbprexis . $this->tabelaAlias () . 
	 		" where " . 
	 		$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
	 		" and " . $inscritoDAO->getalias () . ".grupo = " . $this->idtabelaAlias () .
	 		" and " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " .
		//" ORDER BY " . $this->ordernome;
  		" group by grupo." .implode ( ",grupo.", $this->campos ) . 
		" ORDER BY " . $this->getalias () . ".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'GrupoDAO totalPilotosGruposByCampeonato getsql', $this->con->getsql () );
			
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
		$this->results = new GrupoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".sigla  = ? ";
			$this->con->setTexto ( 1, $sigla );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'GrupoDAO findBySigla getsql', $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function atual() {
		$this->results = new GrupoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".dtinicio <= now() and " . $this->getalias () . ".dtvalidade >= now() " . " order by " . $this->getalias () . ".dtinicio desc ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "GrupoDAO atual", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function delete($bean) {
		$this->results = new GrupoBean ();
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