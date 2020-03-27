<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBateriaBean.php';

include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';

class RankingPilotoBateriaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "ranking_piloto_bateria";
	protected $tabela = "ranking_piloto_bateria";
	protected $idtabela = "idrankingpilotobateria";
	protected $campos = array (
			"idrankingpiloto",
			"idpilotobateria",
			"donovolta",
			"melhorpessoal",
			"pontos",
			"idrankingpilotobateria" 
	);
	protected $ordernome = "ranking_piloto_bateria.idpilotobateria";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new RankingPilotoBateriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idrankingpiloto = ? , " . 			// 4
			" idpilotobateria = ? , " . 			// 5
			" donovolta = ? , " . 			// 6
			" melhorpessoal = ?, " . 			// 7
			" pontos = ? " . 			// 8
			" WHERE " . $this->idtabela () . " =  ? "; // 9
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getrankingpiloto () );
			$this->con->setTexto ( 5, $bean->getpilotobateria () );
			$this->con->setTexto ( 6, $bean->getdonovolta () );
			$this->con->setTexto ( 7, $bean->getmelhorpessoal () );
			$this->con->setNumero ( 8, $bean->getpontos () );
			$this->con->setNumero ( 9, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoBateriaDAO update", $this->con->getsql () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 
			" ( " . 
			" dtcriacao, " . 
			" criador, " . 
			" dtvalidade, " .
			" dtinicio, " . 
			" idrankingpiloto , " . 
			" idpilotobateria , " . 
			" donoVolta , " . 
			" melhorPessoal , " . 
			" pontos, " . $this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// idrankingpiloto,
			" ?, " . 			// idpilotobateria,
			" ?, " . 			// donoVolta,
			" ?, " . 			// melhorPessoal,
			" ?, " . 			// pontos,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getrankingpiloto () );
			$this->con->setTexto ( 5, $bean->getpilotobateria () );
			$this->con->setTexto ( 6, $bean->getdonovolta () );
			$this->con->setTexto ( 7, $bean->getmelhorpessoal () );
			$this->con->setNumero ( 8, $bean->getpontos () );
			$this->con->setNumero ( 9, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoBateriaDAO insert", $this->con->getsql () );
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
	
	
		$this->bean = new RankingPilotoBateriaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idrankingpilotobateria", null ) );
		$this->bean->setrankingpiloto ( $this->getValorArray ( $array, "idrankingpiloto", null ) );
		$this->bean->setdonoVolta ( $this->getValorArray ( $array, "donoVolta", null ) );
		$this->bean->setmelhorPessoal ( $this->getValorArray ( $array, "melhorPessoal", null ) );
		$this->bean->setpontos ( $this->getValorArray ( $array, "pontos", null ) );
	
		$pilotoBateriaDAO = new PilotoBateriaDAO( $this->con );
	//	$bateriaDAO= new BateriaDAO( $this->con );
	//	$etapaDAO = new EtapaDAO( $this->con );
	//	$bateriaDAO->setEtapa ( $this->getValorArray ( $array, $etapaDAO ->idtabela (), $etapaDAO ) );
	//	$pilotoBateriaDAO->setBateria ( $this->getValorArray ( $array, $bateriaDAO->idtabela (), $bateriaDAO) );
		$this->bean->setpilotobateria ( $this->getValorArray ( $array, $pilotoBateriaDAO->idtabela (), $pilotoBateriaDAO ) );
		
		
		
	
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padrão
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
			$query = " SELECT " . $this->camposSelect () .
			 " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			 " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			
			$dbg = 0;
			Util::echobr ( $dbg, 'RankingPilotoBateriaDAO findAll $this->con->setsql', $this->con->getsql());
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			$dbg = 0;
			Util::echobr ( $dbg, 'RankingPilotoBateriaDAO findAll $this->clt []', $this->clt );
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
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			
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
		$this->results = new RankingPilotoBateriaBean ();
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
	
	public function findPontosByIdPilotoEtapa($idpiloto,$idetapa) {
		$this->results = new RankingPilotoBateriaBean ();
		$pilotoBateriaDAO = new PilotoBateriaDAO( $this->con );
		$bateriaDAO= new BateriaDAO( $this->con );
		$etapaDAO = new EtapaDAO( $this->con );
		try {
			$query = " SELECT " . 
			$pilotoBateriaDAO->camposSelect () . ",  " . 
			$bateriaDAO->camposSelect () . ",  " . 
			$etapaDAO->camposSelect () . ",  " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $pilotoBateriaDAO->tabelaAlias () . " " .
			" inner join " . $this->dbprexis . $bateriaDAO->tabelaAlias () . " " . 
			" on " . $bateriaDAO->idtabelaAlias () . " = " . $pilotoBateriaDAO->getalias () . ".idbateria" . 
			" inner join " . $this->dbprexis . $etapaDAO ->tabelaAlias () . " " . 
			" on " . $etapaDAO ->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa" . 
			" inner join " . $this->dbprexis . $this->tabelaAlias () . " " .
			" on " . $pilotoBateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpilotobateria" . 
			" where " . $pilotoBateriaDAO->getalias () . ".idpiloto = ? " .
			" and ".  $etapaDAO ->idtabelaAlias () . " = ? ";
			
			$this->con->setNumero ( 1, $idpiloto);
			$this->con->setNumero ( 2, $idetapa);
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
	
	public function findPontosByIdPilotoEtapaBateria($idpiloto,$idetapa,$idbateria) {
		$this->clt = array ();
		$pilotoBateriaDAO = new PilotoBateriaDAO( $this->con );
		$bateriaDAO= new BateriaDAO( $this->con );
		$etapaDAO = new EtapaDAO( $this->con );
		Util::echobr ( 0, 'RankingPilotoBateriaDAO findPontosByIdPilotoEtapaBateria $idpiloto,$idetapa,$idbateria',  $idpiloto.','.$idetapa.','.$idbateria );
		try {
			$query = " SELECT " . 
			$pilotoBateriaDAO->camposSelect () . ",  " . 
			$bateriaDAO->camposSelect () . ",  " . 
			$etapaDAO->camposSelect () . ",  " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $pilotoBateriaDAO->tabelaAlias () . " " .
			" inner join " . $this->dbprexis . $bateriaDAO->tabelaAlias () . " " . 
			" on " . $bateriaDAO->idtabelaAlias () . " = " . $pilotoBateriaDAO->getalias () . ".idbateria" . 
			" inner join " . $this->dbprexis . $etapaDAO ->tabelaAlias () . " " . 
			" on " . $etapaDAO ->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa" . 
			" inner join " . $this->dbprexis . $this->tabelaAlias () . " " .
			" on " . $pilotoBateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpilotobateria" . 
			" where " . $pilotoBateriaDAO->getalias () . ".idpiloto = ? " .
			" and ".  $etapaDAO ->idtabelaAlias () . " = ? " .
			" and ".  $bateriaDAO->idtabelaAlias () . " = ? " ;
			
			$this->con->setNumero ( 1, $idpiloto);
			$this->con->setNumero ( 2, $idetapa);
			$this->con->setNumero ( 3, $idbateria);
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'RankingPilotoBateriaDAO findPontosByIdPilotoEtapaBateria $this->con->setsql',  $this->con->getsql() );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt ;
	}
	
	public function findByIdCampeonatoEtapaBateria($idcampeonato,$idetapa,$idbateria) {
		$this->clt = array ();
		$pilotoBateriaDAO = new PilotoBateriaDAO( $this->con );
		$bateriaDAO= new BateriaDAO( $this->con );
		$etapaDAO = new EtapaDAO( $this->con );
		$dbg = 0;
		Util::echobr ( $dbg, 'RankingPilotoBateriaDAO  findByIdCampeonatoEtapaBateria $idcampeonato,$idetapa,$idbateria', 
		$idcampeonato.','.$idetapa.','.$idbateria);
		try {
			$query = " SELECT " . 
			$pilotoBateriaDAO->camposSelect () . ",  " . 
			$bateriaDAO->camposSelect () . ",  " . 
			$etapaDAO ->camposSelect () . ",  " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $pilotoBateriaDAO->tabelaAlias () . " " .
			" inner join " . $this->dbprexis . $bateriaDAO->tabelaAlias () . " " . 
			" on " . $bateriaDAO->idtabelaAlias () . " = " . $pilotoBateriaDAO->getalias () . ".idbateria" . 
			" inner join " . $this->dbprexis . $etapaDAO ->tabelaAlias () . " " . 
			" on " . $etapaDAO ->idtabelaAlias () . " = " . $bateriaDAO->getalias () . ".idetapa" . 
			" inner join " . $this->dbprexis . $this->tabelaAlias () . " " .
			" on " . $pilotoBateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpilotobateria" . 
			" where " . $etapaDAO->getalias () . ".idcampeonato = ifnull(?," . $etapaDAO->getalias () . ".idcampeonato ) " .
			" and ".  $etapaDAO ->idtabelaAlias () . " = ifnull( ? ,".  $etapaDAO ->idtabelaAlias () .") ".
			" and ".  $bateriaDAO->idtabelaAlias () . " = ifnull( ? ,".  $bateriaDAO->idtabelaAlias () .") "
			;
			Util::echobr ( $dbg, 'RankingPilotoBateriaDAO findByIdCampeonatoEtapaBateria $query', $query);
			
			$this->con->setNumero ( 1, $idcampeonato);
			$this->con->setNumero ( 2, $idetapa);
			$this->con->setNumero ( 3, $idbateria);
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'RankingPilotoBateriaDAO findByIdCampeonatoEtapaBateria$this->con->setsql', $this->con->getsql());
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findByIdPilotoRanking($idpilotoranking) {
		$this->results = new RankingPilotoBateriaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->alias . ".idpilotoranking = ? ";
			$this->con->setNumero ( 1, idpilotoranking );
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
		$this->results = new RankingPilotoBateriaBean ();
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