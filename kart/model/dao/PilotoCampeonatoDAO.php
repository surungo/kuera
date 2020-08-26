<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingVO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
class PilotoCampeonatoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "pilotocampeonato";
	protected $tabela = "pilotocampeonato";
	protected $idtabela = "idpilotocampeonato";
	protected $campos = array (
			"idpiloto",
			"idcampeonato",
			"idpilotocampeonato" 
	);
	protected $ordernome = "pilotocampeonato.idpilotocampeonato";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new PilotoCampeonatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . " dtvalidade = ? , " . " dtinicio = ? , " . " idcampeonato = ? , " . " idpiloto = ?  " . " WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto($bean->getcampeonato ()) );
			$this->con->setNumero ( 5,  Util::getIdObjeto($bean->getpiloto ()) );
			$this->con->setNumero ( 6, $bean->getid () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . " idcampeonato, " . " idpiloto, " . $this->idtabela () . " )values ( " . " now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
          " ?, " .      /* dtinicio,*/ 
          " ?, " . 			// idcampeonato,
			" ?, " . 			// idpiloto,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4,  Util::getIdObjeto($bean->getcampeonato ()) );
			$this->con->setNumero ( 5,  Util::getIdObjeto($bean->getpiloto ()) );
			$this->con->setNumero ( 6, $bean->getid () );
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
		$this->bean = new PilotoCampeonatoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpilotocampeonato", null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setpiloto ( $this->getValorArray ( $array, "idpiloto", new PilotoDAO ( $this->con ) ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	/*
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . $this->whereAtivo () . 
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoCampeonatoDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->clt;
	}
	*/
	public function findByCampeonatoRanking($idcampeonato) {
		$this->clt = array ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = "  		select " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . ", " . "  		IFNULL( " . "  		(select " . "  		sum(pontuacao_1.valor) pontuacao_1 " . "  		from " . "  		kart_pilotobateria pilotobateria_1 " . "  		inner join kart_bateria bateria_1 " . "  		on bateria_1.idbateria = pilotobateria_1.idbateria " . "  		inner join kart_etapa etapa_1 " . "  		on etapa_1.idetapa = bateria_1.idetapa " . "  		inner join kart_pontuacao pontuacao_1 " . "  		on (pilotobateria_1.idposicao = pontuacao_1.idposicao " . "  		and bateria_1.idpontuacaoesquema = pontuacao_1.idpontuacaoesquema) " . "  		where " . "  		etapa_1.dtinicio < thoje.hoje " . "  		and etapa_1.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_1.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_1.idpiloto = piloto.idpiloto " . "  		),0) pontos, " . "  		IFNULL( " . "     (select " . "       sum(if(posicao_6.ordem is null,15,    if(bateria_6.sigla='GA',1,if(bateria_6.sigla='GB',5,9)) )   ) " . "        /sum(1/ifnull(posicao_6.ordem,22)) desemp " . "  		from " . "  		kart_pilotobateria pilotobateria_6 " . "  		inner join kart_bateria bateria_6 " . "  		on bateria_6.idbateria = pilotobateria_6.idbateria " . "  		inner join kart_etapa etapa_6 " . "  		on etapa_6.idetapa = bateria_6.idetapa " . "  		left outer join  kart_posicao posicao_6 " . "  		on pilotobateria_6.idposicao = posicao_6.idposicao " . "  		left outer join  kart_pontuacao pontuacao_6 " . "  		on pilotobateria_6.idposicao = pontuacao_6.idposicao " . "          and bateria_6.idpontuacaoesquema = pontuacao_6.idpontuacaoesquema " . "  		where " . "  		etapa_6.dtinicio < thoje.hoje " . "  		and etapa_6.idcampeonato =  campeonato.idcampeonato " . "           and ifnull(pilotobateria_6.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_6.idpiloto = piloto.idpiloto " . "  		),0) desempate, " . "  		IFNULL( " . "  		(select " . "  		max(posicao_2.ordem) posicao_2 " . "  		from " . "  		kart_pilotobateria pilotobateria_2 " . "  		inner join kart_bateria bateria_2 " . "  		on bateria_2.idbateria = pilotobateria_2.idbateria " . "  		inner join kart_etapa etapa_2 " . "  		on etapa_2.idetapa = bateria_2.idetapa " . "  		inner join kart_posicao posicao_2 " . "  		on pilotobateria_2.idposicao = posicao_2.idposicao " . "  		where " . "  		etapa_2.dtinicio < thoje.hoje " . "  		and etapa_2.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_2.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_2.idpiloto = piloto.idpiloto " . "  		), " . "  		22*( " . "  		select count(*) " . "  		from  kart_etapa etapa_3 " . "  		where " . "  		etapa_3.idcampeonato = campeonato.idcampeonato " . "  		and etapa_3.dtinicio < thoje.hoje " . "  		) " . "  		) posicao, " . "  		IFNULL( " . "  		(select " . "  		min(pilotobateria_4.volta) volta_4 " . "  		from " . "  		kart_pilotobateria pilotobateria_4 " . "  		inner join kart_bateria bateria_4 " . "  		on bateria_4.idbateria = pilotobateria_4.idbateria " . "  		inner join kart_etapa etapa_4 " . "  		on etapa_4.idetapa = bateria_4.idetapa " . "  		where " . "  		etapa_4.dtinicio < thoje.hoje " . "  		and pilotobateria_4.idpiloto = piloto.idpiloto " . "       and ifnull(pilotobateria_4.convidado,'N') != 'S' " . 			//
			"     and etapa_4.idcampeonato = campeonato.idcampeonato " . "  		),0) volta, " . "  		IFNULL( " . "  		(select " . "  		sum(pilotobateria_5.peso)/sum(if(ifnull(pilotobateria_5.peso,0)=0,0,1)) peso_5 " . "  		from " . "  		kart_pilotobateria pilotobateria_5 " . "  		inner join kart_bateria bateria_5 " . "  		on bateria_5.idbateria = pilotobateria_5.idbateria " . "  		inner join kart_etapa etapa_5 " . "  		on etapa_5.idetapa = bateria_5.idetapa " . "  		where " . "  		etapa_5.dtinicio < thoje.hoje " . "  		and pilotobateria_5.idpiloto = piloto.idpiloto " . "  		and etapa_5.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_5.convidado,'N') != 'S' " . 			//
			"  		),0) pesomedio, " . "  		thoje.hoje hoje " . "  		from " . "  		kart_piloto piloto " . "  		inner join kart_pilotocampeonato pilotocampeonato " . "  		on pilotocampeonato.idpiloto = piloto.idpiloto " . "  		inner join kart_campeonato campeonato " . "  		on pilotocampeonato.idcampeonato = campeonato.idcampeonato " . "  		inner join (select now() hoje, ? nretapa, ? idcampeonato from dual) thoje " . "  		where " . "  		campeonato.idcampeonato = thoje.idcampeonato " . "  		order by pontos desc,desempate asc";
			
			$this->con->clearlistparametros ();
			$this->con->setNumero ( 1, $idetapa );
			$this->con->setNumero ( 2, $idcampeonato );
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "PilotoCampeonatoDAO findByCampeonatoRanking: ", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$pilotoCampeonatoBean = $this->getBeans ( $array );
				$beanRakingVO = new RankingVO ();
				$beanRakingVO->setvalorpontuacao ( $array ["pontos"] );
				$beanRakingVO->setposicao ( $array ["posicao"] );
				$beanRakingVO->setdesempate ( $array ["desempate"] );
				$pilotoCampeonatoBean->getpiloto ()->setpeso ( $array ["pesomedio"] );
				$beanRakingVO->setpiloto ( $pilotoCampeonatoBean->getpiloto () );
				$this->clt [] = $beanRakingVO;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonatoEtapa($idcampeonato, $idetapa) {
		$this->clt = array ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = "  		select " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . ", " . "  		IFNULL( " . "  		(select " . "  		sum(pontuacao_1.valor) pontuacao_1 " . "  		from " . "  		kart_pilotobateria pilotobateria_1 " . "  		inner join kart_bateria bateria_1 " . "  		on bateria_1.idbateria = pilotobateria_1.idbateria " . "  		inner join kart_etapa etapa_1 " . "  		on etapa_1.idetapa = bateria_1.idetapa " . "  		inner join kart_pontuacao pontuacao_1 " . "  		on (pilotobateria_1.idposicao = pontuacao_1.idposicao " . "  		and bateria_1.idpontuacaoesquema = pontuacao_1.idpontuacaoesquema) " . "  		where " . "  		etapa_1.dtinicio < thoje.hoje " . "  		and etapa_1.numero <= thoje.nretapa " . "  		and etapa_1.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_1.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_1.idpiloto = piloto.idpiloto " . "  		),0) pontos, " . "  		IFNULL( " . "     (select " . "       sum(if(posicao_6.ordem is null,15,    if(bateria_6.sigla='GA',1,if(bateria_6.sigla='GB',5,9)) )   ) " . "        /sum(1/ifnull(posicao_6.ordem,22)) desemp " . "  		from " . "  		kart_pilotobateria pilotobateria_6 " . "  		inner join kart_bateria bateria_6 " . "  		on bateria_6.idbateria = pilotobateria_6.idbateria " . "  		inner join kart_etapa etapa_6 " . "  		on etapa_6.idetapa = bateria_6.idetapa " . "  		left outer join  kart_posicao posicao_6 " . "  		on pilotobateria_6.idposicao = posicao_6.idposicao " . "  		left outer join  kart_pontuacao pontuacao_6 " . "  		on pilotobateria_6.idposicao = pontuacao_6.idposicao " . "          and bateria_6.idpontuacaoesquema = pontuacao_6.idpontuacaoesquema " . "  		where " . "  		etapa_6.dtinicio < thoje.hoje " . "  		and etapa_6.numero <= thoje.nretapa " . "  		and etapa_6.idcampeonato =  campeonato.idcampeonato " . "           and ifnull(pilotobateria_6.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_6.idpiloto = piloto.idpiloto " . "  		),0) desempate, " . "  		IFNULL( " . "  		(select " . "  		max(posicao_2.ordem) posicao_2 " . "  		from " . "  		kart_pilotobateria pilotobateria_2 " . "  		inner join kart_bateria bateria_2 " . "  		on bateria_2.idbateria = pilotobateria_2.idbateria " . "  		inner join kart_etapa etapa_2 " . "  		on etapa_2.idetapa = bateria_2.idetapa " . "  		inner join kart_posicao posicao_2 " . "  		on pilotobateria_2.idposicao = posicao_2.idposicao " . "  		where " . "  		etapa_2.dtinicio < thoje.hoje " . "  		and etapa_2.numero <= thoje.nretapa " . "  		and etapa_2.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_2.convidado,'N') != 'S' " . 			//
			"  		and pilotobateria_2.idpiloto = piloto.idpiloto " . "  		), " . "  		22*( " . "  		select count(*) " . "  		from  kart_etapa etapa_3 " . "  		where " . "  		etapa_3.idcampeonato = campeonato.idcampeonato " . "  		and etapa_3.dtinicio < thoje.hoje " . "  		and etapa_3.numero <= thoje.nretapa " . "  		) " . "  		) posicao, " . "  		IFNULL( " . "  		(select " . "  		min(pilotobateria_4.volta) volta_4 " . "  		from " . "  		kart_pilotobateria pilotobateria_4 " . "  		inner join kart_bateria bateria_4 " . "  		on bateria_4.idbateria = pilotobateria_4.idbateria " . "  		inner join kart_etapa etapa_4 " . "  		on etapa_4.idetapa = bateria_4.idetapa " . "  		where " . "  		etapa_4.dtinicio < thoje.hoje " . "  		and etapa_4.numero <= thoje.nretapa " . "  		and pilotobateria_4.idpiloto = piloto.idpiloto " . "       and ifnull(pilotobateria_4.convidado,'N') != 'S' " . 			//
			"     and etapa_4.idcampeonato = campeonato.idcampeonato " . "  		),0) volta, " . "  		IFNULL( " . "  		(select " . "  		sum(pilotobateria_5.peso)/sum(if(ifnull(pilotobateria_5.peso,0)=0,0,1)) peso_5 " . "  		from " . "  		kart_pilotobateria pilotobateria_5 " . "  		inner join kart_bateria bateria_5 " . "  		on bateria_5.idbateria = pilotobateria_5.idbateria " . "  		inner join kart_etapa etapa_5 " . "  		on etapa_5.idetapa = bateria_5.idetapa " . "  		where " . "  		etapa_5.dtinicio < thoje.hoje " . "  		and etapa_5.numero <= thoje.nretapa " . "  		and pilotobateria_5.idpiloto = piloto.idpiloto " . "  		and etapa_5.idcampeonato = campeonato.idcampeonato " . "       and ifnull(pilotobateria_5.convidado,'N') != 'S' " . 			//
			"  		),0) pesomedio, " . "  		thoje.hoje hoje " . "  		from " . "  		kart_piloto piloto " . "  		inner join kart_pilotocampeonato pilotocampeonato " . "  		on pilotocampeonato.idpiloto = piloto.idpiloto " . "  		inner join kart_campeonato campeonato " . "  		on pilotocampeonato.idcampeonato = campeonato.idcampeonato " . "  		inner join (select now() hoje, ? nretapa from dual) thoje " . "  		where " . "  		campeonato.idcampeonato = ? " . "  		order by pontos desc,desempate asc";
			
			$this->con->clearlistparametros ();
			$this->con->setNumero ( 1, $idetapa );
			$this->con->setNumero ( 2, $idcampeonato );
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "PilotoCampeonatoDAO findByCampeonatoRanking: ", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$pilotoCampeonatoBean = $this->getBeans ( $array );
				$beanRakingVO = new RankingVO ();
				$beanRakingVO->setvalorpontuacao ( $array ["pontos"] );
				$beanRakingVO->setposicao ( $array ["posicao"] );
				$beanRakingVO->setdesempate ( $array ["desempate"] );
				$pilotoCampeonatoBean->getpiloto ()->setpeso ( $array ["pesomedio"] );
				$beanRakingVO->setpiloto ( $pilotoCampeonatoBean->getpiloto () );
				$this->clt [] = $beanRakingVO;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonato($id) {
		$dbg = 0;
		$this->clt = array ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . 
			" left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . 
			" on " . 
			$pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . 
			" left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" on " . 
			$campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . 
			" where ". 
			// $this->whereAtivo () . " and " .
			// $pilotoDAO->whereAtivo () .	" and " . 
			//$campeonatoDAO->whereAtivo () . " and " . 
			$this->getalias () . ".idcampeonato  =  IFNULL( ? ,  ".$this->getalias () . ".idcampeonato) " . 
			" ORDER BY " . $pilotoDAO->getalias () . ".apelido ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoCampeonatoDAO findByCampeonato: ", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonatoPesoMedio($campeonato) {
		$dbg = 0;
		$this->result = 0;
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . " sum( " . $pilotoDAO->getalias () . ".peso)/count(*) pesomedio" . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . " on " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . " left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . " where " . $this->whereAtivo () . " and " . $pilotoDAO->whereAtivo () . " and " . $campeonatoDAO->whereAtivo () . " and " . $this->getalias () . ".idcampeonato  =  ? and " . " ( " . $pilotoDAO->getalias () . ".peso != '' or " . $pilotoDAO->getalias () . ".peso != 0 ) " . " ORDER BY " . $pilotoDAO->getalias () . ".apelido ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "PilotoCampeonatoDAO findByCampeonato: ", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->result = $array ["pesomedio"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	public function findByCampeonatoIdadeMedia($campeonato) {
		$dbg = 0;
		$this->result = 0;
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . " sum( FLOOR(DATEDIFF(NOW()," . $pilotoDAO->getalias () . ".dtnascimento) / 365))/count(*) pesomedio" . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . " on " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . " left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . " where " . $this->whereAtivo () . " and " . $pilotoDAO->whereAtivo () . " and " . $campeonatoDAO->whereAtivo () . " and " . $this->getalias () . ".idcampeonato  =  ? and " . $pilotoDAO->getalias () . ".dtnascimento != '' " . " ORDER BY " . $pilotoDAO->getalias () . ".apelido ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "PilotoCampeonatoDAO findByCampeonato: ", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->result = $array ["pesomedio"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	public function findByCampeonatoOrderIdPiloto($id) {
		$this->clt = array ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . "       " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . "   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . "   and " . $this->getalias () . ".idcampeonato  =  ? " . " ORDER BY " . $pilotoDAO->getalias () . ".idpiloto ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoCampeonatoDAO findByCampeonatoOrderIdPiloto: ", $this->con->getsql () );
			
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
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . "       " . $campeonatoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idcampeonato " . "   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idpiloto ";
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
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . 
			$pilotoDAO->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . 
			$this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . 
			$this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . 
			$this->whereAtivo() .
			"   and " . $pilotoDAO->whereAtivo() .
			"   and " . $campeonatoDAO->whereAtivo() .
			"   and " . $campeonatoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idcampeonato " . 
			"   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idpiloto ";
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
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . "       " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . "   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . " ORDER BY " . $this->ordernome;
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
	public function findById($id) {
		$this->results = new PilotoCampeonatoBean ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . "       " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . "   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . "   and " . $this->idtabelaAlias () . " = ? ";
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
	public function findByCampeonatoPiloto($bean) {
		$this->results = new PilotoCampeonatoBean ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$pilotoDAO->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . 
			$this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . 
			$this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . "       " . 
			$campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . 
			"   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpiloto " . 
			"   and " . $this->getalias () . ".idcampeonato = ? " . 
			"   and " . $this->getalias () . ".idpiloto = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getcampeonato ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getpiloto ()) );
			$this->con->setsql ( $query );
			Util::echobr (0, 'PilotocampeonatDAO findByCampeonatoPiloto ', $this->con->getsql () );
			
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
		$this->results = new PilotoCampeonatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'PilotocampeonatDAO delete ', $this->con->getsql () );
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