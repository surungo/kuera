<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/RankingDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
class RankingPilotoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "ranking_piloto";
	protected $tabela = "ranking_piloto";
	protected $idtabela = "idrankingpiloto";
	protected $campos = array (
			"idpiloto",
			"idranking",
			"posicao",
			"valorpontuacao",
			"desempate",
			"idrankingpiloto" 
	);
	protected $ordernome = " ranking_piloto.posicao ";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new RankingPilotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idpiloto = ? , " . 			// 4
			" idranking = ? , " . 			// 5
			" posicao = ? , " . 			// 6
			" valorpontuacao = ? , " . 			// 7
			" desempate = ? " . 			// 8
			" WHERE " . $this->idtabela () . " =  ? "; // 9
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getpiloto () );
			$this->con->setNumero ( 5, $bean->getranking () );
			$this->con->setNumero ( 6, $bean->getposicao () );
			$this->con->setNumero ( 7, $bean->getpontuacao () );
			$this->con->setNumero ( 8, $bean->getdesempate () );
			$this->con->setNumero ( 9, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoDAO update", $this->con->getsql () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . " idpiloto , " . " idranking , " . " posicao , " . " valorpontuacao , " . " desempate , " . $this->idtabela () . " )values ( " . " now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ? , " . 			// idpiloto
			" ? , " . 			// idranking
			" ? , " . 			// posicao
			" ? , " . 			// valorpontuacao
			" ? , " . 			// desempate
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getpiloto () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getranking () ) );
			$this->con->setNumero ( 6, $bean->getposicao () );
			$this->con->setNumero ( 7, $bean->getpontuacao () );
			$this->con->setNumero ( 8, $bean->getdesempate () );
			$this->con->setNumero ( 9, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoDAO insert", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			
			$this->returnDataBaseBean->setqta ( $this->con->affected_rows() );
			$this->returnDataBaseBean->setsucesso ( ($this->con->affected_rows() > 0) );
			if ($this->returnDataBaseBean->getsucesso ()) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " cadastrados no Ranking.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Nenhum piloto foi cadastado no ranking.</span>" );
			}
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new RankingPilotoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idrankingpiloto", null ) );
		$this->bean->setposicao ( $this->getValorArray ( $array, "posicao", null ) );
		$this->bean->setpontuacao ( $this->getValorArray ( $array, "valorpontuacao", null ) );
		$this->bean->setdesempate ( $this->getValorArray ( $array, "desempate", null ) );
		
		$rankingDAO = new RankingDAO ( $this->con );
		$this->bean->setranking ( $this->getValorArray ( $array, $rankingDAO->idtabela (), $rankingDAO ) );
		
		$pilotoDAO = new PilotoDAO ( $this->con );
		$piloto = $this->getValorArray ( $array, $pilotoDAO->idtabela (), $pilotoDAO );
		$this->bean->setpiloto ( $piloto );
		
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
	public function rankear($idranking) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = "select rankear(?) ; ";
			
			$this->con->setNumero ( 1, $idranking );
			Util::echobr ( 0, 'RankingPilotoDAO rankear $query', $query );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'RankingPilotoDAO rankear $this->con->getsql()', $this->con->getsql () );
			
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function findByRanking($idRanking) {
		$this->clt = array ();
		$rankingDAO = new RankingDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$rankingDAO->camposSelect () . ",  " . 
			$pilotoDAO->camposSelect () . "  " . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			" inner join " . $this->dbprexis . $rankingDAO->tabelaAlias () . " " . 
			" on " . $rankingDAO->idtabelaAlias () . " = " . $this->getalias () . ".idranking " . 

			" inner join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . " " . 
			" on " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . 

			" where " . $this->alias . ".idranking = ? " . " ORDER BY posicao " ;
			
			$this->con->setNumero ( 1, $idRanking );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoDAO findByRanking", $this->con->getsql () );
			
			$result = $this->con->execute ();
			//echo $this->con->getsql();
			while ( $array = $result->fetch_assoc () ) {
			//print_r( $array ); 
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($id) {
		$this->results = new RankingPilotoBean ();
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
	public function delete($bean) {
		$this->results = new RankingPilotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteByIdRanking($idRanking) {
		$this->results = new RankingPilotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . " idranking = ? ";
			
			$this->con->setNumero ( 1, $idRanking );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingPilotoDAO deleteByIdRanking", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}

?>