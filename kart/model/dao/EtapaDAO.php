<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
class EtapaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "etapa";
	protected $tabela = "etapa";
	protected $idtabela = "idetapa";
	protected $campos = array (
			"idcampeonato",
			"sigla",
			"numero",
			"nome",
			"info",
			"dtresultado",
			"dtgrid",
			"dtranking",
			"idetapa" 
	);
	protected $ordernome = "etapa.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . 
			" dtmodificacao = now() , " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" idcampeonato = ? , " . 
			" sigla = ? , " . 
			" numero = ? , " . 
			" nome = ? , " .
			" dtresultado = ? , " . 
			" dtgrid = ? , " . 
			" dtranking = ?, " .  
			" info = ? " .  
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setNumero ( 6, $bean->getnumero () );
			$this->con->setTexto ( 7, $bean->getnome () );
			$this->con->setData ( 8, $bean->getdtresultado() );
			$this->con->setData ( 9, $bean->getdtgrid() );
			$this->con->setData ( 10, $bean->getdtranking() );
			$this->con->setTexto( 11, $bean->getinfo() );
			$this->con->setNumero ( 12, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . 
			" dtcriacao, " . 
			" criador, " . 
			" dtvalidade, " . 
			" dtinicio, " . 
			" idcampeonato, " .
			 " sigla, " . 
			 " numero, " . 
			 " nome, " . 
			 " dtresultado, " . 
			 " dtgrid, " . 
			 " dtranking, " . 
			 " info, " . 
			 $this->idtabela () . 
			 " )values ( " . 
			 " now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      			// dtvalidade
      			" ?, " .      			// dtinicio,
			" ?, " . 			// idcampeonato,
			" ?, " . 			// sigla,
			" ?, " . 			// numero,
			" ?, " . 			// nome,
			" ?, " . 			// dtresultado,
			" ?, " . 			// dtgrid,
			" ?, " . 			// dtranking,
			" ?, " . 			// info,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setNumero ( 6, $bean->getnumero () );
			$this->con->setTexto ( 7, $bean->getnome () );
			$this->con->setData ( 8, $bean->getdtresultado() );
			$this->con->setData ( 9, $bean->getdtgrid() );
			$this->con->setData ( 10, $bean->getdtranking() );
			$this->con->setTexto( 11, $bean->getinfo() );
			$this->con->setNumero ( 12, $bean->getid () );
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
		$this->bean = new EtapaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, $this->idtabela (), null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setnumero ( $this->getValorArray ( $array, "numero", null ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean->setdtresultado ( $this->getValorArray ( $array, "dtresultado", null ) );
		$this->bean->setdtgrid ( $this->getValorArray ( $array, "dtgrid", null ) );
		$this->bean->setdtranking ( $this->getValorArray ( $array, "dtranking", null ) );
		$this->bean->setinfo ( $this->getValorArray ( $array, "info", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	public function findPilotoBateria($pilotobean, $bateriabean) {
		$pilotobateriaDAO = new PilotoBateriaDAO ( $this->con );
		$bateriaDAO = new BateriaDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $bateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $pilotobateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " WHERE " . "   " . $pilotobateriaDAO->getalias () . ".idpiloto = ? " . "   and " . $pilotobateriaDAO->getalias () . ".idbateria = ? " . "   and " . $bateriaDAO->idtabelaAlias () . " = " . $pilotobateriaDAO->getalias () . ".idbateria " . "   and " . $this->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa ";
			// " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $pilotobean->getid () );
			$this->con->setNumero ( 2, $bateriabean->getid () );
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
	public function isPiloto($etapa, $piloto) {
		$retorno = false;
		$pilotobateriaDAO = new PilotoBateriaDAO ( $this->con );
		$bateriaDAO = new BateriaDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $bateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $pilotobateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " WHERE " . "   " . $pilotobateriaDAO->getalias () . ".idpiloto = ? " . "   and " . $bateriaDAO->getalias () . ".idetapa = ? " . "   and " . $bateriaDAO->idtabelaAlias () . " = " . $pilotobateriaDAO->getalias () . ".idbateria " . "   and " . $this->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa ";
			// " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $piloto ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $etapa ) );
			$this->con->setsql ( $query );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
				$retorno = true;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $retorno;
	}
	public function findAll() {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " .  //sql
			$this->camposSelect () . ", ".//sql
			$campeonatoDAO->camposSelect () . //sql
			" FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " .  //sql
			$this->dbprexis . $this->tabelaAlias () .  //sql
			" where " .  //sql
			$campeonatoDAO->
			$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .  //sql
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
	public function findAllAtivo() {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = 
			" SELECT " .  //sql
			$this->camposSelect () . ", ".//sql
			$campeonatoDAO->camposSelect () . //sql
			" FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " .  //sql
			$this->dbprexis . $this->tabelaAlias () .  //sql
			" where " .  //sql
			$this->whereAtivo () . //sql
			" and " . $campeonatoDAO->whereAtivo () . //sql
			" and " . $this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .  //sql
			" ORDER BY " . $this->ordernome;
			
			
			" where " . $this->whereAtivo () . 
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EtapaDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			} 
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByBateria($bateria) {
		$bateriaDAO = new BateriaDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $bateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . $bateriaDAO->getalias () . ".idbateria = ? " . " and " . $this->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bateria ) );
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

	public function findByCampeonato($campeonato) {
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () ;
			$query .= " where " ;
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					array_push($campeonatos , $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) " );
				}
				$query .= " ( ";
				$query .= implode(' or ', $campeonatos );
				$query .= " ) ";
				
			} else {
				$query .= $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) ";
			} 
			
			$query .= " order by " . $this->getalias () . ".sigla ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					$this->con->setNumero ( $idx+1, $campeonato[$idx] );
				}
			} else {
				$this->con->setNumero ( 1, $campeonato );
			}


			$this->con->setsql ( $query );
			//echo "camp".$idcampeonato;
			//echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			// print_r($this->results ) ;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}

	public function findAtivoByCampeonato($campeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias (). 
			" inner join " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () .
	   	        " on " . $this->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () 	   	        
			;
			$query .= " where " ;
			
			//$query .= $this->whereAtivo () ;
			$query .= $campeonatoDAO->whereAtivo () ;
			$query .= " and ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					array_push($campeonatos , $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) " );
				}
				$query .= " ( ";
				$query .= implode(' or ', $campeonatos );
				$query .= " ) ";
				
			} else {
				$query .= $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) ";
			} 
			
			$query .= " order by " . $this->getalias () . ".sigla ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					$this->con->setNumero ( $idx+1, $campeonato[$idx] );
				}
			} else {
				$this->con->setNumero ( 1, $campeonato );
			}


			$this->con->setsql ( $query );
			//echo "camp".$idcampeonato;
			//echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			// print_r($this->results ) ;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findAtivoResultadosByCampeonato($campeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias (). 
			" inner join " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () .
	   	        " on " . $this->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () 	   	        
			;
			$query .= " where " ;
			
			//$query .= $this->whereAtivo () ;
			$query .= $campeonatoDAO->whereAtivo () ;
			$query .= " and " .  $this->whereAtivoData(  $this->getalias () . ".dtresultado" );
			$query .= " and ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					array_push($campeonatos , $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) " );
				}
				$query .= " ( ";
				$query .= implode(' or ', $campeonatos );
				$query .= " ) ";
				
			} else {
				$query .= $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) ";
			} 
			
			$query .= " order by " . $this->getalias () . ".sigla ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					$this->con->setNumero ( $idx+1, $campeonato[$idx] );
				}
			} else {
				$this->con->setNumero ( 1, $campeonato );
			}


			$this->con->setsql ( $query );
			//echo "camp".$idcampeonato;
			//echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			// print_r($this->results ) ;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}

	public function findAtivoGridByCampeonato($campeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias (). 
			" inner join " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () .
	   	        " on " . $this->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () 	   	        
			;
			$query .= " where " ;
			
			//$query .= $this->whereAtivo () ;
			$query .= $campeonatoDAO->whereAtivo () ;
			$query .= " and " .  $this->whereAtivoData(  $this->getalias () . ".dtgrid" );
			$query .= " and ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					array_push($campeonatos , $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) " );
				}
				$query .= " ( ";
				$query .= implode(' or ', $campeonatos );
				$query .= " ) ";
				
			} else {
				$query .= $this->getalias () . ".idcampeonato  = IFNULL(?," . $this->getalias () . ".idcampeonato ) ";
			} 
			
			$query .= " order by " . $this->getalias () . ".sigla ";
			
			if(is_array($campeonato)){
				$campeonatos = array();
				for($idx = 0; $idx < count ( $campeonato); $idx ++) {
					$this->con->setNumero ( $idx+1, $campeonato[$idx] );
				}
			} else {
				$this->con->setNumero ( 1, $campeonato );
			}


			$this->con->setsql ( $query );
			//echo "camp".$idcampeonato;
			//echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			// print_r($this->results ) ;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}

	public function findAllSort($bean) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " ORDER BY " . $this->ordernome;
			// echo $query;
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
	public function findEtapaByCampeonato($idcampeonato) {
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $campeonatoDAO->camposSelect () . " FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " and " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . " ORDER BY " . $this->ordernome;
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
	
	public function findById($id) {
		$this->results = null;
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
	
	public function findByEtapaCampeonatoAtivo($bean) {
	    $this->results = null;
	    $campeonatoDAO = new CampeonatoDAO ( $this->con );
	    
	    try {
	        $query = " SELECT " . //sql
	   	        $this->camposSelect () . //sql
	   	        " FROM " . // 
	   	        $this->dbprexis . $this->tabelaAlias () . //sql
	   	        " inner join " . $this->getdbprexis() . $campeonatoDAO->tabelaAlias() . // sql
	   	        " on " . $this->getalias() . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias() . // sql
	   	        
	   	        " where " .
	   	        $this->whereAtivo() . //sql
	   	        " and " . $campeonatoDAO->whereAtivo() . //sql
	   	        " and " . $this->idtabelaAlias () . " = ? " .  //sql
	   	        " and " . $this->getalias() . ".idcampeonato = ? ";  //sql
	   	        
	   	        $this->con->setNumero ( 1, Util::getIdObjeto($bean) );
	   	        $this->con->setNumero ( 2, Util::getIdObjeto($bean->getcampeonato()) );
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
	
	public function isPassouNrEtapa($bean) {
		$this->results = false;
		$bateriaDAO = new BateriaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			" 1 total " . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " , ".
			$this->dbprexis . $bateriaDAO->tabelaAlias () .
			" where " . $this->getalias () . ".numero = ? " .
			" and " . $this->getalias () . ".idcampeonato = ? ".
			" and " . $bateriaDAO->getalias () . ".dtbateria < now() " . 
			" and " . $this->idtabelaAlias () . " = " . $bateriaDAO->getalias().".idetapa "  ;
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getnumero()) );
			$this->con->setNumero ( 2,Util::getIdObjeto($bean->getcampeonato()) );
			$this->con->setsql ( $query );
			
			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$this->results = true;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function delete($bean) {
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