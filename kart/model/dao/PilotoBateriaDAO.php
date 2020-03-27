<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';

include_once PATHAPP . '/mvc/kart/model/dao/InscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaInscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PistaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PosicaoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PontuacaoDAO.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';


class PilotoBateriaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "pilotobateria";
	protected $tabela = "pilotobateria";
	protected $idtabela = "idpilotobateria";
	protected $campos = array (
			"idpiloto",
			"idbateria",
			"idgridlargada",
			"presente",
			"idposicao",
			"kart",
			"tempo",
			"volta",
			"na",
			"peso",
			"idpregridlargada",
			"idposicaooficial",
			"kartlargada",
			"penalizacao",
			"cartaoamarelo",
			"convidado",
			"informacao",
			"observacao",
			"idpilotobateria" 
	);
	protected $ordernome = "pilotobateria.idbateria";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	
	public function update($bean) {
		$dbg = 0;
		$this->results = new PilotoBateriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . 			//
			" dtmodificacao = now(), " . 			//
			" modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idpiloto = ? , " . 			// 4
			" idbateria = ? , " . 			// 5
			" idgridlargada = ? , " . 			// 6
			" presente = ? , " . 			// 7
			" idposicao = ? , " . 			// 8
			" kart = ? , " . 			// 9
			" tempo = ? , " . 			// 10
			" volta = ? , " . 			// 11
			" na = ? , " . 			// 12
			" peso = ? , " . 			// 13
			" idpregridlargada = ? , " . 			// 14
			" idposicaooficial = ? , " . 			// 15
			" kartlargada = ? , " . 			// 16
			" penalizacao = ? , " . 			// 17
			" cartaoamarelo = ? , " . 			// 18
			" convidado = ? , " . 			// 19
			" informacao = ? , " . 			// 20
			" observacao = ?  " . 			// 21
			" WHERE " . $this->idtabela () . " =  ? "; // 22
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getpiloto () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getbateria () ) );
			$this->con->setNumero ( 6, $bean->getgridlargada () );
			$this->con->setTexto ( 7, $bean->getpresente () );
			$this->con->setNumero ( 8, Util::getIdObjeto($bean->getposicao () ));
			$this->con->setNumero ( 9, $bean->getkart () );
			$this->con->setTexto ( 10, $bean->gettempo () );
			$this->con->setTexto ( 11, $bean->getvolta () );
			$this->con->setNumero ( 12, $bean->getna () );
			$this->con->setNumero ( 13, $bean->getpeso () );
			$this->con->setNumero ( 14, $bean->getpregridlargada () );
			$this->con->setNumero ( 15, $bean->getposicaooficial () );
			$this->con->setNumero ( 16, $bean->getkartlargada () );
			$this->con->setTexto ( 17, $bean->getpenalizacao () );
			$this->con->setNumero ( 18, $bean->getcartaoamarelo () );
			$this->con->setTexto ( 19, $bean->getconvidado () );
			$this->con->setTexto ( 20, $bean->getinformacao () );
			$this->con->setTexto ( 21, $bean->getobservacao () );
			$this->con->setNumero ( 22, $bean->getid () );
			
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "PilotoBateriaDAOupdate", $this->con->getsql () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 			//
			" ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . 			//
			" idpiloto , " . 			//
			" idbateria , " . 			//
			" idgridlargada , " . 			//
			" presente , " . 			//
			" idposicao , " . 			//
			" kart , " . 			//
			" tempo , " . 			//
			" volta , " . 			//
			" na , " . 			//
			" peso , " . 			//
			" idpregridlargada , " . 			//
			" idposicaooficial , " . 			//
			" kartlargada , " . 			//
			" penalizacao , " . 			//
			" cartaoamarelo , " . 			//
			" convidado , " . 			//
			" informacao , " . 			//
			" observacao , " . 			//
			$this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// idpiloto
			" ? , " . 			// idbateria
			" ? , " . 			// idgridlargada
			" ? , " . 			// presente
			" ? , " . 			// idposicao
			" ? , " . 			// kart
			" ? , " . 			// tempo
			" ? , " . 			// volta
			" ? , " . 			// na
			" ? , " . 			// peso
			" ? , " . 			// idpregridlargada
			" ? , " . 			// idposicaooficial
			" ? , " . 			// kartlargada
			" ? , " . 			// penalizacao
			" ? , " . 			// cartaoamarelo
			" ? , " . 			// convidado
			" ? , " . 			// informacao
			" ? , " . 			// observacao
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getpiloto () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getbateria () ) );
			$this->con->setNumero ( 6, $bean->getgridlargada () );
			$this->con->setTexto ( 7, $bean->getpresente () );
			$this->con->setNumero ( 8, $bean->getposicao () );
			$this->con->setNumero ( 9, $bean->getkart () );
			$this->con->setTexto ( 10, $bean->gettempo () );
			$this->con->setTexto ( 11, $bean->getvolta () );
			$this->con->setNumero ( 12, $bean->getna () );
			$this->con->setNumero ( 13, $bean->getpeso () );
			$this->con->setNumero ( 14, $bean->getpregridlargada () );
			$this->con->setNumero ( 15, $bean->getposicaooficial () );
			$this->con->setNumero ( 16, $bean->getkartlargada () );
			$this->con->setTexto ( 17, $bean->getpenalizacao () );
			$this->con->setNumero ( 18, $bean->getcartaoamarelo () );
			$this->con->setTexto ( 19, $bean->getconvidado () );
			$this->con->setTexto ( 20, $bean->getinformacao () );
			$this->con->setTexto ( 21, $bean->getobservacao () );
			$this->con->setNumero ( 22, $bean->getid () );
			
			$this->con->setsql ( $query );
			
			$this->con->execute ();
			Util::echobr ( 0, "PilotoBateriaDAOinsert", $this->con->getsql () );
			
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new PilotoBateriaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpilotobateria", null ) );
		$this->bean->setpiloto ( $this->getValorArray ( $array, "idpiloto", new PilotoDAO ( $this->con ) ) );
		$this->bean->setbateria ( $this->getValorArray ( $array, "idbateria", new BateriaDAO ( $this->con ) ) );
		$this->bean->setgridlargada ( $this->getValorArray ( $array, "idgridlargada", null ) );
		$this->bean->setpresente ( $this->getValorArray ( $array, "presente", null ) );
		$this->bean->setposicao ( $this->getValorArray ( $array, "idposicao", new PosicaoDAO ( $this->con ) ) );
		$this->bean->setkart ( $this->getValorArray ( $array, "kart", null ) );
		$this->bean->settempo ( $this->getValorArray ( $array, "tempo", null ) );
		$this->bean->setvolta ( $this->getValorArray ( $array, "volta", null ) );
		$this->bean->setna ( $this->getValorArray ( $array, "na", null ) );
		$this->bean->setpeso ( $this->getValorArray ( $array, "peso", null ) );
		$this->bean->setpregridlargada ( $this->getValorArray ( $array, "idpregridlargada", null ) );
		$this->bean->setposicaooficial ( $this->getValorArray ( $array, "idposicaooficial", null ) );
		$this->bean->setkartlargada ( $this->getValorArray ( $array, "kartlargada", null ) );
		$this->bean->setpenalizacao ( $this->getValorArray ( $array, "penalizacao", null ) );
		$this->bean->setcartaoamarelo ( $this->getValorArray ( $array, "cartaoamarelo", null ) );
		$this->bean->setconvidado ( $this->getValorArray ( $array, "convidado", null ) );
		$this->bean->setinformacao ( $this->getValorArray ( $array, "informacao", null ) );
		$this->bean->setobservacao ( $this->getValorArray ( $array, "observacao", null ) );
		$this->bean->setdonovolta ( $this->getValorArray ( $array, "donovolta", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->clt;
	}

	public function atualizaPosicoes($bean) {
	    $dbg = 0;
	    $retorno = false;
	    try {
	        $query = 
	            " set @rownum:=0; ";
	        $this->con->clearlistparametros();
	        $this->con->setsql ( $query );
	        Util::echobr ($dbg , "PilotoBateriaDAO atualizaPosicoes", $this->con->getsql() );
	        $result = $this->con->execute ();
	        
	        $query =
	        " update " . $this->dbprexis . $this->tabela () .
	        " set idgridlargada = ( select @rownum := @rownum + 1) " .
	        " where  idbateria = ? " .
	        " order by observacao desc;  ";

	        $this->con->clearlistparametros();
    		$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria() ));

	        $this->con->setsql ( $query );
	        Util::echobr ($dbg , "PilotoBateriaDAO atualizaPosicoes", $this->con->getsql() );
	        $result = $this->con->execute ();
	        
	        
	        if( $array = $result->fetch_assoc () ) {
	            $retorno = true;
	        }
	    } catch ( Exception $e ) {
	        throw new Exception ( $e->getMessage () );
	    }
	    
	    return $retorno;
	}

	
	public function insertGridInversoPrecedente($bean) {
		$dbg = 0;
		try {
			$query = " insert into kart_pilotobateria	" .
			"		( 	" .
			"		idpilotobateria,	" .
			"		idpiloto,	" .
			"		idbateria,	" .
			"		criador,	" .
			"		dtcriacao	" .
			"		)	" .
			"	select	" .
			"		sequenceNextVal('kart_pilotobateria') idpilotobateria,	" .
			"		pb.idpiloto,	" .
			"		b.idbateria,	" .
			"		'script' criador,	" .
			"		now()   dtcriacao	" .
			"		" .			
			"	from kart_bateria b	  " .
			"	inner join kart_pilotobateria pb	  " .
			"	on pb.idbateria = b.idbateriaprecedente	  " .
			"	inner join kart_etapa e  " .
			"	on e.idetapa = b.idetapa  " .
			"	inner join kart_pilotocampeonato pc  " .
			"	on pc.idpiloto = pb.idpiloto  " .
			"	and  pc.idcampeonato = e.idcampeonato  " .
			"	where b.idbateria = ?   " .
			"	    and IFNULL(pc.dtvalidade,now()) > NOW() - INTERVAL 1 SECOND    " .
			" 	    and IFNULL(pc.dtinicio,now()) < NOW() + INTERVAL 1 SECOND    " .
			"		and not exists(		  " .
			"			select 1		  " .
			"			from kart_pilotobateria pbe		   " .
			"			where pbe.idpiloto = pb.idpiloto	  " .
			"			and pbe.idbateria = b.idbateria	  " .
			"		)	  " ; 		
		
		
			$this->con->clearlistparametros ();			
		
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria () ));
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaDAO $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}
		
	public function qualificarGridInversoPrecedente($bean,$ranking) {
		$dbg = 0 ;
		try {
			$query = "	update	" .
				"		kart_pilotobateria pb	" .
				"		inner join kart_bateria b	" .
				"		on b.idbateria = pb.idbateria	" .
				"		inner join kart_pilotobateria pbant	" .
				"		on pbant.idpiloto = pb.idpiloto	" .
				"		and pbant.idbateria = b.idbateriaprecedente		" .
				"		inner join " .
				$ranking->gettabelaranking() . " r	" .
				"		on pbant.idpiloto = r.idpiloto	" .
				"	set	pb.observacao = 	" .
				"		concat( 	" .
				"			lpad(if(pbant.presente='S',pbant.idposicao,0),10,'0') , 	" .
				"			lpad(r.posicao,10,'0')	" .
				"		)	" .
				"	where 	" .
				"	b.idbateria = " . Util::getIdObjeto($bean->getbateria()) . " 	" ;			
//				"	b.idbateria = ?	" ;			

			//Util::echobr ( $dbg, 'PilotoBateriaDAO qualificarGridInversoPrecedente $query ', $query  );
			
			$this->con->clearlistparametros ();			

			$this->con->setsql ( $query );
			Util::echobr ( $dbg, 'PilotoBateriaDAO qualificarGridInversoPrecedente $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}
	
	
	
	
	public function insertGridInverso2Precedente1810($bean) {
		
		try {
			$query = " insert into kart_pilotobateria	" .
				"		( 	" .
				"		idpilotobateria,	" .
				"		idpiloto,	" .
				"		idbateria,	" .
				"		criador,	" .
				"		dtcriacao	" .
				"		)	" .
				"	select	" .
				"		sequenceNextVal('kart_pilotobateria') idpilotobateria,	" .
					"	idpiloto,	 " .
					"	idbateria,	 " .
					"	criador,	 " .
					"	dtcriacao " .
				"	from ( " .
				"	select	 " .
					"	pb.idpiloto,	 " .
					"	b.idbateria,	 " .
					"	'script' criador,	 " .
					"	now()   dtcriacao " .
				"	from kart_bateria b	 " .
				"	inner join kart_pilotobateria pb	 " .
				"	on pb.idbateria = b.idbateriaprecedente	 " .
				"	where b.idbateria = ". Util::getIdObjeto($bean->getbateria () ) ." " .
				"	and pb.idposicao < 19 " .
				
			"		and not exists(		" .
			"			select 1		" .
			"			from kart_pilotobateria pbe		" . 
			"			where pbe.idpiloto = pb.idpiloto	" .
			"			and pbe.idbateria = b.idbateria	" .
			"		)		" .			

				"	union " .
				"	select	 " .
					"	pb.idpiloto,	 " .
					"	b.idbateria, " .
					"	'script' criador,	 " .
					"	now()   dtcriacao " .
				"	from kart_bateria b	 " .
				"	inner join kart_bateria b2 " .
				"	on b.idetapa = b2.idetapa " .
				"	and b.idcategoria = b2.idcategoria " .
				"	and b.idbateria != b2.idbateria " .
				"	inner join kart_pilotobateria pb	 " .
				"	on pb.idbateria = b2.idbateriaprecedente	 " .
				"	where b.idbateria = ". Util::getIdObjeto($bean->getbateria () ) ." " .
				"	and pb.idposicao < 11 " .

			"		and not exists(		" .
			"			select 1		" .
			"			from kart_pilotobateria pbe		" . 
			"			where pbe.idpiloto = pb.idpiloto	" .
			"			and pbe.idbateria = b.idbateria	" .
			"		)		" .			

			"	)	geral " ;

		
			$this->con->clearlistparametros ();			
		
			//$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria () ));
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaDAO $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}

	public function qualificarGridInverso2Precedente1810($bean) {
		$dbg = 0 ;
		try {
			$query ="	update	" .
				"	kart_pilotobateria pbup	" .
				"	inner join	" .
				"	(	" .
				"	select 	" .
				"	(	select concat( lpad(30,10,'0') , lpad(pbantB.idposicao,10,'0') ) ordem 	" .
				"	from kart_pilotobateria pbantB	" .
				"	where pbantB.idposicao < 11	" .
				"	and	pbantB.idbateria = boutra.idbateria	" .
				"	and pbantB.idpiloto = pb.idpiloto	" .
				"	union	" .
				"	select concat( lpad(20,10,'0') , lpad(pbantA.idposicao,10,'0') ) ordem 	" .
				"	from kart_pilotobateria pbantA	" .
				"	where pbantA.idposicao < 19 	" .
				"	and pbantA.idbateria = b.idbateriaprecedente	" .
				"	and pbantA.idpiloto = pb.idpiloto	" .
				"	) ord	" .
				"	,pb.idpiloto,p.apelido,pb.idgridlargada,b.idbateriaprecedente,boutra.idbateria,pb.idpilotobateria	" .
				"	from 	" .
				"	kart_pilotobateria pb	" .
				"	inner join kart_bateria b	" .
				"	on pb.idbateria = b.idbateria		" .
				"	inner join kart_bateria bprecedete	" .
				"	on bprecedete.idbateria = b.idbateriaprecedente		" .
				"	inner join kart_piloto p	" .
				"	on p.idpiloto = pb.idpiloto	" .
				"	inner join kart_bateria boutra	" .
				"	on boutra.idcategoria = b.idcategoria	" .
				"	and boutra.idetapa = bprecedete.idetapa	" .
				"	and boutra.idbateria != b.idbateriaprecedente	" .
				"	where 	" .
				"	pb.idbateria = ".Util::getIdObjeto($bean->getbateria () )."	" .
				"	) pbi	" .
				"	on pbup.idpilotobateria = pbi.idpilotobateria	" .
				"	set pbup.observacao = pbi.ord	" ;
			
			$this->con->clearlistparametros();			
		
//			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria () ));
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaDAO $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}



	public function insertGridInverso2PioresPrecedente1810($bean) {
		
		try {
			$query = " insert into kart_pilotobateria	" .
				"		( 	" .
				"		idpilotobateria,	" .
				"		idpiloto,	" .
				"		idbateria,	" .
				"		criador,	" .
				"		dtcriacao	" .
				"		)	" .
				"	select	" .
				"		sequenceNextVal('kart_pilotobateria') idpilotobateria,	" .
				"		idpiloto,	 	" .
				"		idbateria,	 	" .
				"		criador,	 	" .
				"		dtcriacao 	" .
				"	from ( 	" .
				"		select	 	" .
				"			pb.idpiloto,	 	" .
				"			b.idbateria,	" .
				"			'script' criador,	 	" .
				"			now()   dtcriacao 	" .
				"		from kart_bateria b	 	" .
				"		inner join kart_pilotobateria pb	 	" .
				"		on pb.idbateria = b.idbateriaprecedente	 	" .
				"		where b.idbateria = ".Util::getIdObjeto($bean->getbateria () )." " .
				"		and pb.idposicao > 10 	" .
				"		and not exists(		" .
				"			select 1		" .
				"			from kart_pilotobateria pbe		 " .
				"			where pbe.idpiloto = pb.idpiloto	" .
				"			and pbe.idbateria = b.idbateria		" .
				"		)		" .
				"	union 	" .
				"		select	 	" .
				"			pb1.idpiloto,	 	" .
				"			b1.idbateria, 	" .
				"			'script' criador,	 	" .
				"			now()   dtcriacao 	" .
				"		from kart_bateria b1	" .
				"		inner join kart_bateria b2 	" .
				"		on b1.idetapa = b2.idetapa 	" .
				"		and b1.idcategoria = b2.idcategoria 	" .
				"		and b1.idbateria != b2.idbateria 	" .
				"		inner join kart_pilotobateria pb1	 	" .
				"		on pb1.idbateria = b2.idbateriaprecedente	 	" .
				"		where b1.idbateria = ".Util::getIdObjeto($bean->getbateria () )."	" .
				"		and pb1.idposicao > 18 	" .
				"		and not exists(		" .
				"			select 1		" .
				"			from kart_pilotobateria pbe		 " .
				"			where pbe.idpiloto = pb1.idpiloto	" .
				"			and pbe.idbateria = b1.idbateria		" .
				"		)		" .
				"			)	geral  ";
				
			
			$this->con->clearlistparametros ();			
		
//			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria () ));
//			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getbateria () ));
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaDAO $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}
	
	public function qualificarGridInverso2PioresPrecedente1810($bean,$ranking) {
		$dbg = 0 ;
		try {
			$query ="	update		" .
				"	kart_pilotobateria pbup		" .
				"	inner join		" .
				"	(		" .
				"	select 		" .
				"	ifnull(	(select concat( lpad(20,5,'0') , lpad(pbantB.idposicao,5,'0')) ordem 		" .
				"	from kart_pilotobateria pbantB		" .
				"	where pbantB.idposicao > 18		" .
				"	and	pbantB.idbateria = boutra.idbateria		" .
				"	and pbantB.idpiloto = pb.idpiloto	" .
				"	and pbantB.presente = 'S'	" .
				"	union		" .
				"	select concat( lpad(30,5,'0') , lpad(pbantA.idposicao,5,'0')) ordem 		" .
				"	from kart_pilotobateria pbantA		" .
				"	where pbantA.idposicao > 10 		" .
				"	and pbantA.idbateria = b.idbateriaprecedente		" .
				"	and pbantA.idpiloto = pb.idpiloto		" .
				"	and pbantA.presente = 'S')	" .
				"	,	" .
				"	(select concat( lpad(10,5,'0') , lpad(k.posicao,5,'0')) ordem	" .
				"	from ".$ranking->gettabelaranking() ." k	" .
				"	where k.idpiloto = p.idpiloto)	" .
				"	) ord		" .
				"	,pb.idpiloto,p.apelido,pb.idgridlargada,b.idbateriaprecedente,boutra.idbateria,pb.idpilotobateria		" .
				"	from 		" .
				"	kart_pilotobateria pb		" .
				"	inner join kart_bateria b		" .
				"	on pb.idbateria = b.idbateria			" .
				"	inner join kart_bateria bprecedete		" .
				"	on bprecedete.idbateria = b.idbateriaprecedente			" .
				"	inner join kart_piloto p		" .
				"	on p.idpiloto = pb.idpiloto		" .
				"	inner join kart_bateria boutra		" .
				"	on boutra.idcategoria = b.idcategoria		" .
				"	and boutra.idetapa = bprecedete.idetapa		" .
				"	and boutra.idbateria != b.idbateriaprecedente		" .
				"	where 		" .
				"	pb.idbateria = ". Util::getIdObjeto($bean->getbateria () )."	" .
				"	) pbi		" .
				"	on pbup.idpilotobateria = pbi.idpilotobateria		" .
				"	set pbup.observacao = pbi.ord		" ;
			
			$this->con->clearlistparametros();			
		
//			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria () ));
			$this->con->setsql ( $query );
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaDAO $this->con->getsql', $this->con->getsql() );

			$result = $this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->returnDataBaseBean;
	}
	
	
	public function findByPrecedente($bean) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" WHERE " . "   " . $this->alias . ".idpiloto = ? " . 
			"   and " . $this->alias . ".idbateria = ? ";
			// " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $bean->getpiloto () );
			$this->con->setNumero ( 2, $bean->getbateria () );
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
	
	public function findPilotoBateria($bean) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " WHERE " . "   " . $this->alias . ".idpiloto = ? " . "   and " . $this->alias . ".idbateria = ? ";
			// " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $bean->getpiloto () );
			$this->con->setNumero ( 2, $bean->getbateria () );
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
	
	public function pilotoVolta() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . 			//
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 			//
			" , ( " + "		SELECT idbateria, MIN( po.volta ) volta " + 			//
			"		FROM kart_pilotobateria po " + "		GROUP BY idbateria " + 			//
			")pox " + 			//
			"WHERE p.volta = pox.volta " + 			//
			"ORDER BY  p.idbateria ASC ";
			
			$this->con->clearlistparametros ();
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
	public function findGraficoData($idcampeonato, $arrPilotos) {
		$this->clt = array ();
		try {
			$query = " select 
				  etapa.numero
				  ,(
				  select  sum( (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
				    select pontuacao.valor 
				    from
				    kart_piloto piloto
				    inner join kart_pilotobateria pilotobateria
				    on pilotobateria.idpiloto = piloto.idpiloto
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    inner join kart_pontuacao pontuacao
				    on bateria.idpontuacaoesquema = pontuacao.idpontuacaoesquema 
				    and pontuacao.idposicao = pilotobateria.idposicao
				    where                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and piloto.idpiloto = par.p1
				    union
				    select 0 from dual where
				    not exists(
				    select 1
				    from kart_pilotobateria pilotobateria
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    where 
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and pilotobateria.idpiloto = par.p1 )   
				  ) ) pi1
				  from kart_etapa etapa_P
				  where etapa_P.idcampeonato = par.idcampeonato
				  and   etapa_P.dtinicio is not null
				  and   etapa_P.idetapa <= etapa.idetapa 
				) p1
				  ,(
				  select  sum( (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
				    select pontuacao.valor 
				    from
				    kart_piloto piloto
				    inner join kart_pilotobateria pilotobateria
				    on pilotobateria.idpiloto = piloto.idpiloto
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    inner join kart_pontuacao pontuacao
				    on bateria.idpontuacaoesquema = pontuacao.idpontuacaoesquema 
				    and pontuacao.idposicao = pilotobateria.idposicao
				    where                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and piloto.idpiloto = par.p2
				    union
				    select 0 from dual where
				    not exists(
				    select 1
				    from kart_pilotobateria pilotobateria
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    where 
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and pilotobateria.idpiloto = par.p2  )   
				  ) ) pi1
				  from kart_etapa etapa_P
				  where etapa_P.idcampeonato = par.idcampeonato
				  and   etapa_P.dtinicio is not null
				  and   etapa_P.idetapa <= etapa.idetapa 
				) p2
				  ,(
				  select  sum( (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
				    select pontuacao.valor 
				    from
				    kart_piloto piloto
				    inner join kart_pilotobateria pilotobateria
				    on pilotobateria.idpiloto = piloto.idpiloto
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    inner join kart_pontuacao pontuacao
				    on bateria.idpontuacaoesquema = pontuacao.idpontuacaoesquema 
				    and pontuacao.idposicao = pilotobateria.idposicao
				    where                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and piloto.idpiloto = par.p3
				    union
				    select 0 from dual where
				    not exists(
				    select 1
				    from kart_pilotobateria pilotobateria
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    where 
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and pilotobateria.idpiloto = par.p3  )   
				  ) ) pi1
				  from kart_etapa etapa_P
				  where etapa_P.idcampeonato = par.idcampeonato
				  and   etapa_P.dtinicio is not null
				  and   etapa_P.idetapa <= etapa.idetapa 
				) p3
				  ,(
				  select  sum( (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
				    select pontuacao.valor 
				    from
				    kart_piloto piloto
				    inner join kart_pilotobateria pilotobateria
				    on pilotobateria.idpiloto = piloto.idpiloto
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    inner join kart_pontuacao pontuacao
				    on bateria.idpontuacaoesquema = pontuacao.idpontuacaoesquema 
				    and pontuacao.idposicao = pilotobateria.idposicao
				    where                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and piloto.idpiloto = par.p4
				    union
				    select 0 from dual where
				    not exists(
				    select 1
				    from kart_pilotobateria pilotobateria
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    where 
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and pilotobateria.idpiloto = par.p4  )   
				  ) ) pi1
				  from kart_etapa etapa_P
				  where etapa_P.idcampeonato = par.idcampeonato
				  and   etapa_P.dtinicio is not null
				  and   etapa_P.idetapa <= etapa.idetapa 
				) p4
				  ,(
				  select  sum( (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
				    select pontuacao.valor 
				    from
				    kart_piloto piloto
				    inner join kart_pilotobateria pilotobateria
				    on pilotobateria.idpiloto = piloto.idpiloto
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    inner join kart_pontuacao pontuacao
				    on bateria.idpontuacaoesquema = pontuacao.idpontuacaoesquema 
				    and pontuacao.idposicao = pilotobateria.idposicao
				    where                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and piloto.idpiloto = par.p5
				    union
				    select 0 from dual where
				    not exists(
				    select 1
				    from kart_pilotobateria pilotobateria
				    inner join kart_bateria bateria
				    on bateria.idbateria = pilotobateria.idbateria
				    where 
				    bateria.idetapa = etapa_P.idetapa
				    and pilotobateria.convidado is null
				    and pilotobateria.idpiloto = par.p5  )   
				  ) ) pi1
				  from kart_etapa etapa_P
				  where etapa_P.idcampeonato = par.idcampeonato
				  and   etapa_P.dtinicio is not null
				  and   etapa_P.idetapa <= etapa.idetapa 
				) p5
				from kart_etapa etapa ,
				(select ? idcampeonato, ? p1, ? p2, ? p3, ? p4, ? p5 from dual) par
				where etapa.idcampeonato = par.idcampeonato
				and   etapa.dtinicio is not null
				order by etapa.numero ";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $arrPilotos [0] );
			$this->con->setNumero ( 3, $arrPilotos [1] );
			$this->con->setNumero ( 4, $arrPilotos [2] );
			$this->con->setNumero ( 5, $arrPilotos [3] );
			$this->con->setNumero ( 6, $arrPilotos [4] );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findGraficoData", $idcampeonato . $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$linha = array (
						$array ['numero'],
						$array ['p1'],
						$array ['p2'],
						$array ['p3'],
						$array ['p4'],
						$array ['p5'] 
				);
				$this->clt [] = $linha;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findPiloto($id) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			$query = " SELECT " . $this->camposSelect () . ", " . 			//
			$campeonatoDAO->camposSelect () . ", " . 			//
			$posicaoDAO->camposSelect () . ", " . 			//
			$etapaDAO->camposSelect () . ", " . 			//
			$pilotoDAO->camposSelect () . ", " . 			//
			$bateriaDAO->camposSelect () . 			//
			" FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . 			//
			$this->getdbprexis () . $campeonatoDAO->tabelaAlias () . ", " . 			//
			$this->getdbprexis () . $posicaoDAO->tabelaAlias () . ", " . 			//
			$this->getdbprexis () . $etapaDAO->tabelaAlias () . ", " . 			//
			$this->getdbprexis () . $pilotoDAO->tabelaAlias () . ", " . 			//
			$this->getdbprexis () . $bateriaDAO->tabelaAlias () . " " . 			//
			" WHERE " . "   " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . " and " . 			//
			$bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . " and " . 			//
			$this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . " and " . 			//
			$this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " and " . 			//
			$this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . " and " . 			//
			$this->getalias () . ".idpiloto = ? " . 			//
			" ORDER BY " . $bateriaDAO->getalias () . ".nome, " . $pilotoDAO->getalias () . ".nome";
			
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			// echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	public function findPilotoForRanking($id, $idcampeonato) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$pistaDAO = new PistaDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
			$query = " SELECT " . 			//
			"   ( SELECT count(*) " . 			//
			" 	FROM kart_pilotobateria po " . 			//
			"    WHERE  " . 			//
			"		  po.volta = (SELECT MIN( p1.volta ) " . 			//
			"		  FROM kart_pilotobateria p1 " . 			//
			"		  WHERE p1.idbateria = po.idbateria) " . 			//
			"		and po.idpiloto = " . $this->getalias () . ".idpiloto " . 			//
			"		and po.idbateria = " . $this->getalias () . ".idbateria ) " . 			//
			$this->alias . "_donovolta , " . 			//
			$this->camposSelect () . ", " . 			//
			$campeonatoDAO->camposSelect () . ", " . 			//
			$posicaoDAO->camposSelect () . ", " . 			//
			$etapaDAO->camposSelect () . ", " . 			//
			$pilotoDAO->camposSelect () . ", " . 			//
			$pontuacaoDAO->camposSelect () . ", " . 			//
			$pistaDAO->camposSelect () . ", " . 			//
			$bateriaDAO->camposSelect () . 			//
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . 			//
			" ON " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 			//
			" INNER JOIN " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . 			//
			" ON  " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $etapaDAO->tabelaAlias () . 			//
			" ON  " . $bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () . 			//
			" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . 			//
			" ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $pistaDAO->tabelaAlias () . 			//
			" ON  " . $bateriaDAO->getalias () . ".idpista =  " . $pistaDAO->idtabelaAlias () . 			//
			" LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . 			//
			" ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . 			//
			" and " . 			//
			$bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . 			//
			" WHERE " . "  " . $this->getalias () . ".idpiloto = ? " . 			//
			" and " . $etapaDAO->getalias () . ".dtinicio < now() " . 			//
			" and " . $etapaDAO->getalias () . ".idcampeonato = ? " . 			//
			" and ifnull(" . $this->getalias () . ".convidado,'N') != 'S' " . 			//
			" ORDER BY " . $etapaDAO->getalias () . ".numero, " . $bateriaDAO->getalias () . ".nome ";
			
			$this->con->setNumero ( 1, $id );
			$this->con->setNumero ( 2, $idcampeonato );
			
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
	public function findBateria($bean) {
		$this->clt = array ();
		try {
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			
			$query = " SELECT " . $this->camposSelect () . ", " . $pilotoDAO->camposSelect () . ", " . $bateriaDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . ", " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . " " . " WHERE " . "   " . $this->alias . ".idbateria = ? " . " and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " and " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . " ORDER BY " . $pilotoDAO->getalias () . ".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getbateria () ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findPilotosEtapa($bean) {
		$this->clt = array ();
		try {
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$query = " SELECT " . $this->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . ", " . $bateriaDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . $this->getdbprexis () . $etapaDAO->tabelaAlias () . ", " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . ", " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . " " . " WHERE " . "   " . $bateriaDAO->getalias () . ".idetapa = ? " . " and " . $bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . " and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " and " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . " ORDER BY " . $bateriaDAO->getalias () . ".nome, " . $pilotoDAO->getalias () . ".nome";
			
			$this->con->setNumero ( 1, $bean->getbateria ()->getetapa ()->getid () );
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
	
	// metodos padr?o
	public function findAll() {
		$bean = new PilotoBateriaBean ();
		return $this->findAllSort ( $bean );
	}
	public function findAllSort($bean) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
			
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			} else {
				$this->ordernome = $pilotoDAO->getalias () . ".nome";
			}
			
			$query = " SELECT " . $this->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $posicaoDAO->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . ", " . $pontuacaoDAO->camposSelect () . ", " . $bateriaDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . " ON " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " INNER JOIN " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $etapaDAO->tabelaAlias () . " ON  " . $bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () . " ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . " ORDER BY " . $this->ordernome;
			
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
	public function findBateriaByCampeonatoEtapa($idcampeonato, $idetapa) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
			
			$query = " SELECT " . $this->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $posicaoDAO->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . ", " . $pontuacaoDAO->camposSelect () . ", " . $bateriaDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . " ON " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " INNER JOIN " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $etapaDAO->tabelaAlias () . " ON  " . $bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $campeonatoDAO->tabelaAlias () . " ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . " where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . " and " . $etapaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateriaByCampeonatoEtapa", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findBateriaByCampeonatoEtapaBateria($idcampeonato, $idetapa, $idbateria) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
			
			$query = " SELECT " . $this->camposSelect () . ", " . 
				$campeonatoDAO->camposSelect () . ", " . 
				$posicaoDAO->camposSelect () . ", " . 
				$etapaDAO->camposSelect () . ", " . 
				$pilotoDAO->camposSelect () . ", " . 
				$pontuacaoDAO->camposSelect () . ", " . 
				$bateriaDAO->camposSelect () . 
				" FROM " . 
				$this->dbprexis . $this->tabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
				" ON " . 
				$this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $bateriaDAO->tabelaAlias () . 
				" ON  " . 
				$this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $etapaDAO->tabelaAlias () . 
				" ON  " . 
				$bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $campeonatoDAO->tabelaAlias () . 
				" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . " LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . " ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . " where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . " and " . $etapaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . " and " . $bateriaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $bateriaDAO->idtabelaAlias () . " )  " . " ORDER BY " . $this->ordernome . " desc";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setNumero ( 3, $idbateria );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateriaByCampeonatoEtapaBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	
	public function findBateriaByCampeonatoEtapaBateriaPiloto($idcampeonato, $idetapa, $idbateria, $idpiloto) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
			
			$query = " SELECT " . $this->camposSelect () . ", " . 
				$campeonatoDAO->camposSelect () . ", " . 
				$posicaoDAO->camposSelect () . ", " . 
				$etapaDAO->camposSelect () . ", " . 
				$pilotoDAO->camposSelect () . ", " . 
				$pontuacaoDAO->camposSelect () . ", " . 
				$bateriaDAO->camposSelect () . 
				" FROM " . 
				$this->dbprexis . $this->tabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
				" ON " . 
				$this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" INNER JOIN " . 
				$this->getdbprexis () . $bateriaDAO->tabelaAlias () . 
				" ON  " . 
				$this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $etapaDAO->tabelaAlias () . 
				" ON  " . 
				$bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $campeonatoDAO->tabelaAlias () . 
				" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . 
				  " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . 
				" where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
				" and " . $etapaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . 
				" and " . $bateriaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $bateriaDAO->idtabelaAlias () . " )  " . 
				" and " . $pilotoDAO->idtabelaAlias () . " =   IFNULL( ? ," . $pilotoDAO->idtabelaAlias () . " )  " . 
				" ORDER BY " . $this->ordernome . " desc";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setNumero ( 3, $idbateria );
			$this->con->setNumero ( 4, $idpiloto );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateriaByCampeonatoEtapaBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findBateriaByCampeonatoEtapaBateriaPilotoNome($idcampeonato, $idetapa, $idbateria, $nome) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
	$dbg = 0;
	Util::echobr ( $dbg, 'PilotoBateriaDAO c e b c ', $idcampeonato.", ".$idetapa.", ".$idbateria.", ".$nome);
			
			$query = " SELECT " . $this->camposSelect () . ", " . 
				$campeonatoDAO->camposSelect () . ", " . 
				$posicaoDAO->camposSelect () . ", " . 
				$etapaDAO->camposSelect () . ", " . 
				$pilotoDAO->camposSelect () . ", " . 
				$pontuacaoDAO->camposSelect () . ", " . 
				$bateriaDAO->camposSelect () . 
				" FROM " . 
				$this->dbprexis . $this->tabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
				" ON " . 
				$this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" INNER JOIN " . 
				$this->getdbprexis () . $bateriaDAO->tabelaAlias () . 
				" ON  " . 
				$this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $etapaDAO->tabelaAlias () . 
				" ON  " . 
				$bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $campeonatoDAO->tabelaAlias () . 
				" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . 
				  " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . 
				" where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
				" and " . $etapaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . 
				" and " . $bateriaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $bateriaDAO->idtabelaAlias () . " )  " . 
				" and " .
				" 	( " .
					" lower(" . $pilotoDAO->getalias () . ".nome) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".nome ) ) " . 
					" or lower(" . $pilotoDAO->getalias () . ".apelido) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".apelido) ) " . 
					" or lower(" . $pilotoDAO->getalias () . ".nomejoin) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".nomejoin) ) " . 
				"	) " .					
				" ORDER BY " . $this->ordernome . " desc";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setNumero ( 3, $idbateria );
			$this->con->setTexto ( 4, $nome );
			$this->con->setTexto ( 5, $nome );
			$this->con->setTexto ( 6, $nome );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateriaByCampeonatoEtapaBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	
	public function findBateriaByCampeonatoEtapaPilotoNome($idcampeonato, $idetapa, $nome) {
		$this->clt = array ();
		try {
			$campeonatoDAO = new CampeonatoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$posicaoDAO = new PosicaoDAO ( $this->con );
			$posicaoDAO->setalias ( "posicaochegada" );
			
			$pontuacaoDAO = new PontuacaoDAO ( $this->con );
	$dbg = 0;
	Util::echobr ( $dbg, 'PilotoBateriaDAO c e c ', $idcampeonato.", ".$idetapa.", ".$nome);
			
			$query = " SELECT " . $this->camposSelect () . ", " . 
				$campeonatoDAO->camposSelect () . ", " . 
				$posicaoDAO->camposSelect () . ", " . 
				$etapaDAO->camposSelect () . ", " . 
				$pilotoDAO->camposSelect () . ", " . 
				$pontuacaoDAO->camposSelect () . ", " . 
				$bateriaDAO->camposSelect () . 
				" FROM " . 
				$this->dbprexis . $this->tabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
				" ON " . 
				$this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" INNER JOIN " . 
				$this->getdbprexis () . $bateriaDAO->tabelaAlias () . 
				" ON  " . 
				$this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $etapaDAO->tabelaAlias () . 
				" ON  " . 
				$bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 
				" LEFT JOIN " . 
				$this->getdbprexis () . $campeonatoDAO->tabelaAlias () . 
				" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . 
				" LEFT JOIN " . $this->getdbprexis () . $pontuacaoDAO->tabelaAlias () . 
				" ON  " . $this->getalias () . ".idposicao =  " . $pontuacaoDAO->getalias () . ".idposicao " . 
				  " and " . $bateriaDAO->getalias () . ".idpontuacaoesquema =  " . $pontuacaoDAO->getalias () . ".idpontuacaoesquema " . 
				" where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
				" and " . $etapaDAO->idtabelaAlias () . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . 
				" and " .
				" 	( " .
					" lower(" . $pilotoDAO->getalias () . ".nome) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".nome ) ) " . 
					" or lower(" . $pilotoDAO->getalias () . ".apelido) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".apelido) ) " . 
					" or lower(" . $pilotoDAO->getalias () . ".nomejoin) =   lower(IFNULL( tiraacento( ? )," . $pilotoDAO->getalias () . ".nomejoin) ) " . 
				"	) " .					
				" ORDER BY " . $this->ordernome . " desc";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setTexto ( 3, $nome );
			$this->con->setTexto ( 4, $nome );
			$this->con->setTexto ( 5, $nome );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findBateriaByCampeonatoEtapaBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findPilotoSemBateriaNotBateria($idcampeonato, $idetapa, $idbateria) {
		$this->clt = array ();
		try {
			$pilotoCampeonatoDAO = new pilotoCampeonatoDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$etapaDAO = new EtapaDAO ( $this->con );
			$inscritoDAO = new InscritoDAO ( $this->con );
			$categoriaInscritoDAO = new CategoriaInscritoDAO (  $this->con );
			$categoriaDAO = new CategoriaDAO (  $this->con );
			
			$bateriaDAO = new BateriaDAO ( $this->con );
			$inetapaDAO = new EtapaDAO ( $this->con );
			$inetapaDAO->setalias ( "inetapa" );
			$inbateriaDAO = new BateriaDAO ( $this->con );
			$inbateriaDAO->setalias ( "inbateria" );
			
			$query = " SELECT distinct "  . 
			$pilotoCampeonatoDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . ",  " . 
			$etapaDAO->camposSelect () . "  " . 
			" FROM " . $this->getdbprexis () . $pilotoCampeonatoDAO->tabelaAlias () . 
			" INNER JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
			" ON " . $pilotoCampeonatoDAO->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
			" INNER JOIN " . $this->getdbprexis () . $etapaDAO->tabelaAlias () . 
			" ON  " . $etapaDAO->getalias () . ".idcampeonato =  " . $pilotoCampeonatoDAO->getalias () . ".idcampeonato " .
			" INNER JOIN " . $this->getdbprexis () . $inscritoDAO->tabelaAlias () . 
			" ON  " . $inscritoDAO->getalias () . ".idpessoa =  " . $pilotoDAO->getalias () . ".idpessoa " .
			" INNER JOIN " . $this->getdbprexis () . $categoriaInscritoDAO->tabelaAlias () . 
			" ON  " . $categoriaInscritoDAO->getalias () . ".idinscrito =  " . $inscritoDAO->idtabelaAlias () .
			" INNER JOIN " . $this->getdbprexis () . $categoriaDAO->tabelaAlias () . 
			" ON  " . $categoriaDAO->getalias () . ".idcategoria  =  " . $categoriaInscritoDAO->getalias () . ".idcategoria " .
			" and " . $categoriaDAO->getalias () . ".idcampeonato =  " . $pilotoCampeonatoDAO->getalias () . ".idcampeonato " .  
			" where " .
			$pilotoCampeonatoDAO->whereAtivo () .
			// não esta nesta bateria
			" and not exists( " . 
				" select 1  " . 
				" FROM " . $this->getdbprexis () . $this->tabelaAlias () . 
				" INNER JOIN " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . 
				" ON " . $bateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idbateria " . 
				" INNER JOIN " . $this->getdbprexis () . $inetapaDAO->tabelaAlias () . 
				" ON  " . $inetapaDAO->getalias () . ".idetapa = " . $bateriaDAO->getalias () . ".idetapa " . 
				" WHERE " . 
				$inetapaDAO->getalias () . ".idcampeonato = " . $pilotoCampeonatoDAO->getalias () . ".idcampeonato " . 
				" and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" and " . $inetapaDAO->idtabelaAlias () . " = " . $etapaDAO->idtabelaAlias () .
				" and " . $bateriaDAO->idtabelaAlias () . " = IFNULL( ? , 0 ) " .  
			" ) " . 
			/// não estar em outra bateria da mesma categoria
			" and not exists( " . 
				" select 1  " . 
				" FROM " . 
				$this->getdbprexis () . $bateriaDAO->tabelaAlias () .
				" INNER JOIN " . $this->getdbprexis () . $inbateriaDAO->tabelaAlias () . 
				" ON " . $bateriaDAO->getalias () . ".idetapa = " . $inbateriaDAO->getalias () . ".idetapa " . 
				" and " . $bateriaDAO->getalias () . ".idcategoria = " . $inbateriaDAO->getalias () . ".idcategoria " .
				" INNER JOIN " . $this->getdbprexis () . $this->tabelaAlias () . 
				" ON " . $inbateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idbateria " . 
				" INNER JOIN " . $this->getdbprexis () . $inetapaDAO->tabelaAlias () . 
				" ON  " . $inetapaDAO->getalias () . ".idetapa = " . $bateriaDAO->getalias () . ".idetapa " . 
				
				" WHERE " . 
				$inetapaDAO->getalias () . ".idcampeonato = " . $pilotoCampeonatoDAO->getalias () . ".idcampeonato " . 
				" and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
				" and " . $inetapaDAO->idtabelaAlias () . " = " . $etapaDAO->idtabelaAlias () .
				" and " . $inbateriaDAO->getalias () . ".idcategoria "  . " = " . $categoriaDAO->idtabelaAlias () .
				" and " . $bateriaDAO->idtabelaAlias () . " = IFNULL( ? , 0 ) " .  
			" ) " . 
			" and " . 
			$pilotoCampeonatoDAO->getalias () . ".idcampeonato = IFNULL( ? ," . $pilotoCampeonatoDAO->getalias () . ".idcampeonato )  " . 
			" and " . 
			$etapaDAO->idtabelaAlias () . " = IFNULL( ? ," . $etapaDAO->idtabelaAlias () . " )  " . 
			" ORDER BY " . $pilotoDAO->getalias () . ".nome ";
			
			$this->con->setNumero ( 1, $idbateria );
			$this->con->setNumero ( 2, $idbateria );
			$this->con->setNumero ( 3, $idcampeonato );
			$this->con->setNumero ( 4, $idetapa );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findPilotoSemBateria", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findPilotoSemBateria($idcampeonato, $idetapa) {
		$this->clt = array ();
		try {
			$pilotoCampeonatoDAO = new pilotoCampeonatoDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$inscritoDAO = new InscritoDAO ( $this->con );
			$categoriaInscritoDAO = new CategoriaInscritoDAO (  $this->con );
			$categoriaDAO = new CategoriaDAO (  $this->con );
			
			
			$etapaDAO = new EtapaDAO ( $this->con );
			
			$bateriaDAO = new BateriaDAO ( $this->con );
			
			$query = " SELECT " . 
			$pilotoCampeonatoDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . "  " . 
			
			" FROM " . $this->getdbprexis () . $pilotoCampeonatoDAO->tabelaAlias () . 
			" INNER JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . 
			" ON " . $pilotoCampeonatoDAO->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
			" INNER JOIN " . $this->getdbprexis () . $inscritoDAO->tabelaAlias () . 
			" ON  " . $inscritoDAO->getalias () . ".idpessoa =  " . $pilotoDAO->getalias () . ".idpessoa " .
			" INNER JOIN " . $this->getdbprexis () . $categoriaInscritoDAO->tabelaAlias () . 
			" ON  " . $categoriaInscritoDAO->getalias () . ".idinscrito =  " . $inscritoDAO->idtabelaAlias () .
			" INNER JOIN " . $this->getdbprexis () . $categoriaDAO->tabelaAlias () . 
			" ON  " . $categoriaDAO->getalias () . ".idcategoria  =  " . $categoriaInscritoDAO->getalias () . ".idcategoria " .
			" and " . $categoriaDAO->getalias () . ".idcampeonato =  " . $pilotoCampeonatoDAO->getalias () . ".idcampeonato " .  
			" where ".
			$pilotoCampeonatoDAO->whereAtivo () .
			" and ".$pilotoCampeonatoDAO->getalias () . ".idcampeonato = IFNULL( ? ," . $pilotoCampeonatoDAO->getalias () . ".idcampeonato )  " . 
			" and not exists( " . 
				" select 1  " . 
				" FROM " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () .
				" INNER JOIN " . $this->getdbprexis () . $this->tabelaAlias () . 
				" ON " . $bateriaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idbateria " . 
				" WHERE " . 
				$bateriaDAO->getalias () . ".idetapa = IFNULL( ? ," . $bateriaDAO->getalias () . ".idetapa )  " . 
				" and ".$bateriaDAO->getalias () . ".idcategoria  = ".$categoriaDAO->getalias () . ".idcategoria ".
				" and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
			" )  " . 
			" ORDER BY " . $pilotoDAO->getalias () . ".nome ";
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setNumero ( 2, $idetapa );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoBateriaDAO findPilotoSemBateria", $this->con->getsql () );
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
		$this->results = new PilotoBateriaBean ();
		try {
			$etapaDAO = new EtapaDAO ( $this->con );
			$pilotoDAO = new PilotoDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$query = " SELECT " . $this->camposSelect () . ", " . 
			$etapaDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . ", " . 
			$bateriaDAO->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . 
			$this->getdbprexis () . $etapaDAO->tabelaAlias () . ", " . 
			$this->getdbprexis () . $pilotoDAO->tabelaAlias () . ", " . 
			$this->getdbprexis () . $bateriaDAO->tabelaAlias () . " " . 
			" WHERE " . 
			"   " . $bateriaDAO->getalias () . ".idetapa =  " . $etapaDAO->idtabelaAlias () . 
			" and " . $this->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . 
			" and " . $this->getalias () . ".idbateria =  " . $bateriaDAO->idtabelaAlias () . 
			" and " . $this->idtabelaAlias () . " = ? ";
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
		$this->results = new PilotoBateriaBean ();
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
	public function deletebateria($bean) {
		$this->results = new PilotoBateriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . " idbateria = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getbateria () ) );
			$this->con->setsql ( $query );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteetapa($idetapa) {
		$this->results = new PilotoBateriaBean ();
		$bateriaDAO = new BateriaDAO ( $this->con );
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " delete from kart_Piloto_bateria " . " where idbateria in ( " . " select bateria.idbateria " . " from " . " kart_bateria bateria " . " where " . " bateria.idetapa = ? ) ";
			$this->con->setNumero ( 1, $idetapa );
			$this->con->setsql ( $query );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deletepiloto($bean) {
		$this->results = new PilotoBateriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->alias . "idpiloto = ? ";
			
			$this->con->setNumero ( 1, $bean->getpiloto () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	
	
	
	public function ausentarTodosBateria($bateria) {
		$dbg = 0;
		$this->results = new PilotoBateriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . 			
			" presente = 'N'  " . 			
			" WHERE  idbateria = ? "; 
			
			$this->con->setNumero (1, Util::getIdObjeto ( $bateria ) );
			
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "ausentarTodosBateria", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
}

?>