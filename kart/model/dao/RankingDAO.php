<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';

include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/RankingPilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingEtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
class RankingDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "ranking";
	protected $tabela = "ranking";
	protected $idtabela = "idranking";
	protected $campos = array (
			"idcampeonato",
			"idetapa",
			"info",
			"descarte",
			"idcategoria",
			"tabelaranking",
			"idranking" 
	);
	
	protected $ordernome = " ranking.dtcriacao desc ";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new RankingBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . " dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" idcampeonato = ?, " . 
			" idetapa = ?, " .
			" info = ?,  " . 
			" descarte = ? , " . 
			" idcategoria= ? , " . 
			" tabelaranking= ? " . 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setNumero ( 5, $bean->getetapa () );
			$this->con->setTexto ( 6, $bean->getinfo () );
			$this->con->setNumero ( 7, $bean->getdescarte () );
			$this->con->setNumero ( 8, $bean->getcategoria () );
			$this->con->setTexto ( 9, $bean->gettabelaranking () );
			$this->con->setNumero ( 10, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO update", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			if ($this->con->affected_rows() > 0) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Ranking atualizado.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Ranking erro.</span>" );
			}
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
			" idcampeonato, " . 
			" idetapa, " . 
			" info, " . 
			" descarte, ".
			" idcategoria,  ".
			" tabelaranking, ".
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// campeonato,
			" ?, " . 			// etapa,
			" ?, " . 			// info,
			" ?, " . 			// descarte,
			" ?, " . 			// idcategoria,
			" ?, " . 			// tabelaranking,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setNumero ( 5, $bean->getetapa () );
			$this->con->setTexto ( 6, $bean->getinfo () );
			$this->con->setNumero ( 7, $bean->getdescarte () );
			$this->con->setNumero ( 8, $bean->getcategoria () );
			$this->con->setTexto ( 9, $bean->gettabelaranking () );
			$this->con->setNumero ( 10, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO insert", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setsucesso ( ($this->con->affected_rows() > 0) );
			if ($this->returnDataBaseBean->getsucesso ()) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Ranking cadastrado.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Ranking erro.</span>" );
			}
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function getBeans($array) {
		$this->bean = new RankingBean ();
		
		Util::echobr ( 0, "RankingDAO getBeans _descarte", $this->getValorArray ( $array, "descarte", null ) );
		
		$this->bean->setid ( $this->getValorArray ( $array, "idranking", null ) );
		$this->bean->setinfo ( $this->getValorArray ( $array, "info", null ) );
		$this->bean->setdescarte ( $this->getValorArray ( $array, "descarte", null ) );
		$this->bean->setcategoria ( $this->getValorArray ( $array, "idcategoria", null ) );
		$this->bean->settabelaranking ( $this->getValorArray ( $array, "tabelaranking", null ) );
		
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, $campeonatoDAO->idtabela (), $campeonatoDAO ) );
		
		$etapaDAO = new EtapaDAO ( $this->con );
		$this->bean->setetapa ( $this->getValorArray ( $array, $etapaDAO->idtabela (), $etapaDAO ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	public function existsRankTemp($bean) {
		$tbname = $bean->gettabelaranking();
		$retorno = false;
		$dbg=0;
		Util::echobr ( $dbg, "RankingDAO existsRankTemp", $tbname );
			
		try {
			$query = " SELECT table_name ".
			" FROM information_schema.tables ".
			" where table_schema='".DBNAME."' ".
			" and TABLE_NAME = ? ";
			
			$this->con->clearlistparametros();
			$this->con->setTexto ( 1,  $tbname );
			
			$this->con->setsql ( $query );
			
			Util::echobr ($dbg , "RankingDAO existsRankTemp", $this->con->getsql() );
			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$retorno = true;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $retorno;
	}
	
	
	public function findRankTemp($bean) {
		$tbname = $bean->gettabelaranking();
		$this->clt = array ();
		Util::echobr ( 0, "RankingDAO findRankTemp", $tbname );
			
		try {
			$query = " SELECT " . 
			" * " . 
			" FROM " . $tbname . 
			" order by posicao " ;
			$this->con->clearlistparametros();
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "RankingDAO findRankTemp", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $array;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function dropRankTemp($bean) {
		$tbname = $bean->gettabelaranking();
		$this->results = new RankingBean ();
		try {
			$query = " drop table $tbname ";
			$this->con->clearlistparametros();
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO dropRankTemp", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			if ($this->con->affected_rows() > 0) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Ranking atualizado.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Ranking erro.</span>" );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function createRankTemp($bean) {
	    $dbg = 0;
		$this->results = new RankingBean ();
		$rankingEtapaBusiness = new RankingEtapaBusiness();
		try {
			$usuarioLoginBean = $this->setoperador ();
			Util::echobr ( $dbg, 'RankingDAO Util::getIdObjeto($bean)', Util::getIdObjeto($bean) );
			
			$rankingEtapaClt = $rankingEtapaBusiness->findByRanking($bean);
			
			$query = 
			"  create table ".$bean->gettabelaranking()." as " .
				"  select  " .
				"  r.idranking, " .
				"  0 posicao, " .
				"  p.idpiloto, " .
				"  p.apelido nomepiloto, ";
			
			$etapaBean = new EtapaBean ();
			$etapaBusiness = new EtapaBusiness ();
			$cltEtapas = $etapaBusiness->findAtivoByCampeonato(Util::getIdObjeto($bean->getcampeonato() ));
			$lstidetapas = array();
			foreach($rankingEtapaClt as $rankingEtapaBean){
			    	$lstidetapas[] = Util::getIdObjeto($rankingEtapaBean->getEtapa());
			}
			$idetapas = implode(', ',$lstidetapas);
			for($idx = 0; $idx < count ( $cltEtapas ); $idx ++) {
			    $etapaBean = $cltEtapas[$idx];
			    //verfica se deve contar
			    $contaEtapa = false;
			    foreach($rankingEtapaClt as $rankingEtapaBean){
			    	if(Util::getIdObjeto($rankingEtapaBean->getEtapa()) == Util::getIdObjeto($etapaBean) )
			    		$contaEtapa = true;
			    }

			    if($contaEtapa){
				    $query .= 	
	    				" 'N' descartar".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).", " . 
	    				" ( select if(pb1.presente='N' or pb1.penalizacao = 'DQF' , 0, pont1.valor) valor " .
	    					"  from kart_bateria b1 " .
	    					"  inner join kart_pilotobateria pb1 " .
	    					"  on b1.idbateria = pb1.idbateria " .
	    					"  inner join kart_pontuacao pont1 " .
	    					"  on pont1.idpontuacaoesquema = b1.idpontuacaoesquema " .
	    					"  and pont1.idposicao = pb1.idposicao " .
	    					"  where b1.idcategoria = r.idcategoria " .
	    					"  and b1.idetapa = ". Util::getIdObjeto($etapaBean) . " " .
	    					"  and pb1.idpiloto = p.idpiloto  " .
	    					"  ) pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).", " .
	    				"  ( " .
	    				"  	select pb1p.idposicao " .
	    					"  from kart_bateria b1p " .
	    					"  inner join kart_pilotobateria pb1p " .
	    					"  on b1p.idbateria = pb1p.idbateria " .
	    					"  where b1p.idcategoria = r.idcategoria " .
	    					"  and b1p.idetapa = ". Util::getIdObjeto($etapaBean) . " " .
	    					"  and pb1p.idpiloto = p.idpiloto  " .
	    					"  ) pos".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).",".
	    				"   ( " .
	    					"  	select pb1p.penalizacao " .
	    					"  from kart_bateria b1p " .
	    					"  inner join kart_pilotobateria pb1p " .
	    					"  on b1p.idbateria = pb1p.idbateria " .
	    					"  where b1p.idcategoria = r.idcategoria " .
	    					"  and b1p.idetapa = ". Util::getIdObjeto($etapaBean) . " " .
	    					"  and pb1p.idpiloto = p.idpiloto  " .
	    					"  ) pena".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).",";
	    			}else{
	    				$query .= " '' pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).", " .
	    				"  '' pos".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).",".
	    				"  '' pena".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).",";
	    			}
    			}
			
    	
    		$query .=			
    		" ( select count(*) tpena             " .
    		" from                                " .
    		" kart_bateria b1p                    " .
    		" inner join                          " .
    		" kart_pilotobateria pb1p             " .
    		" on b1p.idbateria = pb1p.idbateria   " .
    		" where                               " .
    		" b1p.idcategoria = r.idcategoria     " . 
    		" and                                 " .
    		" b1p.idetapa in ( " .$idetapas. " )  " .
    		" and                                 " .
    		" pb1p.idpiloto = p.idpiloto          " .
    		" and                                 " .
    		"   if(ifnull(pb1p.penalizacao,'')='',1,0) = 0   " .
    		" ) tpena, " ;
	
            $query .=			
            "  0 descartev1, " .			
            "  0 descartev2, " .			
            "  0 total " .			
            "  from kart_ranking r " .
            "  inner join kart_bateria b " .
            "  on b.idetapa = r.idetapa " .
            "  and instr(b.nome,r.info) > 0 " .
            "  inner join kart_pilotobateria pb " .
            "  on pb.idbateria = b.idbateria " .
            "  inner join kart_piloto p " .
            "  on p.idpiloto = pb.idpiloto " .
            "  where r.idetapa = ? " .
            "  and r.idranking = ? " ;
            
            Util::echobr ($dbg, 'RankingDAO createRankTemp', $query);
			$this->con->clearlistparametros();
			$this->con->setNumero ( 1, $bean->getetapa () );
			$this->con->setNumero ( 2, $bean->getid () );


			$this->con->setsql ( $query );
			Util::echobr ($dbg, "RankingDAO update", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			if ($this->con->affected_rows() > 0) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Ranking atualizado.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Ranking erro.</span>" );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function somaRankTemp($bean) {
		$retorno = false;
		Util::echobr ( 0, "RankingDAO somaRankTemp",$bean->gettabelaranking());
		$tbname = $bean->gettabelaranking();
		try {
		    $etapaBean = new EtapaBean ();
		    $etapaBusiness = new EtapaBusiness ();
		    $cltEtapas = $etapaBusiness->findAtivoByCampeonato(Util::getIdObjeto($bean->getcampeonato() ));
		    $colunas = array ();
		    for($idx = 0; $idx < count ( $cltEtapas ); $idx ++) {
		        $etapaBean = $cltEtapas[$idx];
		        $colunas[] = "ifnull(pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome())).",0)";
		        
		    }
		    
		    $query = " update $tbname set total = (".implode ("+",$colunas).")-(descartev1+descartev2) ; ";
			
			$this->con->clearlistparametros();
						
			$this->con->setsql ( $query );
			
			Util::echobr (1 , "RankingDAO somaRankTemp", $this->con->getsql() );
			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$retorno = true;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $retorno;
	}
	
	public function descarte5RankTemp($bean) {
		$retorno = false;
		Util::echobr ( 0, "RankingDAO descarte5RankTemp",$bean->gettabelaranking());
		$tbname = $bean->gettabelaranking();
		try {
			$cltRanking	= $this->findRankTemp($bean);
			$etapaBean = new EtapaBean ();
			$etapaBusiness = new EtapaBusiness ();
			$cltEtapas = $etapaBusiness->findAtivoByCampeonato(Util::getIdObjeto($bean->getcampeonato() ));
			
			for($idxR = 0; $idxR < count ( $cltRanking); $idxR ++) {
				$ranking = $cltRanking[$idxR];
				$idpiloto = $ranking["idpiloto"];
				$coluna = "";
				$valor = 10000;
				for($idx = 0; $idx < count ( $cltEtapas ); $idx ++) {
					$etapaBean = $cltEtapas[$idx];
					if($etapaBean->getnumero() <= 5 && 
						"DQF" != $ranking["pena".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))] &&
						$valor > $ranking["pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))]){
						
						$coluna = "descartar".strtolower(str_ireplace(" ", "", $etapaBean->getnome()));
						$valor = $ranking["pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))];
						$valor = $valor==""?0:$valor;
					}
				}
				
				$query = " update $tbname set $coluna = 'S' , descartev1=$valor where idpiloto = $idpiloto ; ";
				$this->con->clearlistparametros();
				
				$this->con->setsql ( $query );
				
				Util::echobr (0 , "RankingDAO descarte5RankTemp", $this->con->getsql() );
				$result = $this->con->execute ();
				if( $array = $result->fetch_assoc () ) {
					$retorno = true;
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $retorno;
	}
	
	public function descarte10RankTemp($bean) {
		$retorno = false;
		Util::echobr ( 0, "RankingDAO descarte10RankTemp",$bean->gettabelaranking());
		$tbname = $bean->gettabelaranking();
		try {
			$cltRanking	= $this->findRankTemp($bean);
			$etapaBean = new EtapaBean ();
			$etapaBusiness = new EtapaBusiness ();
			$cltEtapas = $etapaBusiness->findAtivoByCampeonato(Util::getIdObjeto($bean->getcampeonato() ));
			
			for($idxR = 0; $idxR < count ( $cltRanking); $idxR ++) {
				$ranking = $cltRanking[$idxR];
				$idpiloto = $ranking["idpiloto"];
				$coluna = "";
				$valor = 10000;
				for($idx = 0; $idx < count ( $cltEtapas ); $idx ++) {
					$etapaBean = $cltEtapas[$idx];
					if($etapaBean->getnumero() > 5 && $etapaBean->getnumero() < 10 && 
						"DQF" != $ranking["pena".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))] &&
						$valor > $ranking["pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))]){
						
						$coluna = "descartar".strtolower(str_ireplace(" ", "", $etapaBean->getnome()));
						$valor = $ranking["pts".strtolower(str_ireplace(" ", "", $etapaBean->getnome()))];
						$valor = $valor==""?0:$valor;
					}
				}
				
				$query = " update $tbname set $coluna = 'S' , descartev2=$valor where idpiloto = $idpiloto ; ";
				$this->con->clearlistparametros();
				
				$this->con->setsql ( $query );
				
				Util::echobr (0 , "RankingDAO descarte5RankTemp", $this->con->getsql() );
				$result = $this->con->execute ();
				if( $array = $result->fetch_assoc () ) {
					$retorno = true;
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $retorno;
	}
	
	
	public function ordenaRanking($bean) {
	    $retorno = false;
	    Util::echobr ( 0, "RankingDAO ordenaRanking",$bean->gettabelaranking());
	    $tbname = $bean->gettabelaranking();
	    try {
	        
	        $query = 
               " set @rownum:=0; ";
            $this->con->clearlistparametros();
	        $this->con->setsql ( $query );
	        Util::echobr (0 , "RankingDAO ordenaRanking", $this->con->getsql() );
	        $result = $this->con->execute ();
	        
	        $query =
	        " update " .$bean->gettabelaranking() ." ".
	        " set posicao = ( select @rownum := @rownum + 1) " .
	        " where total is not null ".
	        " order by total desc;  ";
	        $this->con->clearlistparametros();
	        $this->con->setsql ( $query );
	        Util::echobr (0 , "RankingDAO ordenaRanking", $this->con->getsql() );
	        $result = $this->con->execute ();
	        
	        
	        if( $array = $result->fetch_assoc () ) {
	            $retorno = true;
	        }
	    } catch ( Exception $e ) {
	        throw new Exception ( $e->getMessage () );
	    }
	    
	    return $retorno;
	}
	
	// metodos padr達o
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
			Util::echobr ( 0, "RankingDAO findAllSort", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findAllCampeonato($bean) {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$etapaDAO = new EtapaDAO ( $this->con );
		try {
			$query = " SELECT " . $campeonatoDAO->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . " left join " . $this->dbprexis . $etapaDAO->tabelaAlias () . " on " . $etapaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idetapa " . " where " . $this->getalias () . ".idcampeonato = ?";
			$this->con->clearlistparametros();
			$this->con->setNumero ( 1, $bean->getcampeonato () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO findAllCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findAllCampeonatoMostrar($bean) {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$etapaDAO = new EtapaDAO ( $this->con );
		//print_r($bean);
		try {
			$query = " SELECT " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$etapaDAO->camposSelect () . ", " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . 
			" left join " . $this->dbprexis . $etapaDAO->tabelaAlias () . 
			" on " . $etapaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idetapa " . 
			" where " . $this->getalias () . ".idcampeonato = ? and " . 
			$this->getalias () . ".dtinicio < now() ".
			" order by " . $this->getalias () . ".dtinicio ";
			$this->con->clearlistparametros();
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getcampeonato () ));
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
	
	public function findByCampeonato($bean) {
		$this->clt = array ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idcampeonato = ? " . 
			" order by " . $this->getalias () . ".dtinicio ";
			$this->con->clearlistparametros();			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getcampeonato () ));
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
	
	public function findAllByEtapa($bean) {
		$this->clt = array ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idetapa = ? " . 
			" order by " . $this->getalias () . ".dtinicio ";
			$this->con->clearlistparametros();
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getetapa () ));
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
	
	
	
	public function findAtualEtapaInfo($bean) {
		$this->result = new RankingBean ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idetapa = ? and " . 
			 $this->getalias () . ".info = ? " . 
			" order by " . $this->getalias () . ".dtinicio desc ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getetapa () ));
			$this->con->setTexto ( 2, $bean->getinfo () );
			$this->con->setsql ( $query );

			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$this->result = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	
	public function findByEtapaCategoria($bean) {
		$this->result = new RankingBean ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idetapa = ? and " . 
			 $this->getalias () . ".idcategoria = ? " . 
			" order by " . $this->getalias () . ".dtinicio desc ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getetapa () ));
			$this->con->setTexto ( 2, Util::getIdObjeto($bean->getcategoria () ));
			$this->con->setsql ( $query );

			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$this->result = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	
	
	public function findAtualCampeonatoInfo($bean) {
		$this->result = new RankingBean ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idcampeonato = ? and " . 
			 $this->getalias () . ".info = ? and " . 
			$this->getalias () . ".dtinicio is not null  ".
			" order by " . $this->getalias () . ".dtinicio desc ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getcampeonato () ));
			$this->con->setTexto ( 2, $bean->getinfo () );
			$this->con->setsql ( $query );

			$result = $this->con->execute ();
			if( $array = $result->fetch_assoc () ) {
				$this->result = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	
	
	public function findUltimoForCampeonatoMostrar($bean) {
		$this->result = new RankingBean ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$etapaDAO = new EtapaDAO ( $this->con );
		try {
			$query = " SELECT " . $campeonatoDAO->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . " left join " . $this->dbprexis . $etapaDAO->tabelaAlias () . " on " . $etapaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idetapa " . " where " . $this->getalias () . ".idcampeonato = ? and " . $this->getalias () . ".dtinicio < now() " . " order by " . $etapaDAO->getalias () . ".numero desc limit 1 ";
			$this->con->setNumero ( 1, $bean->getcampeonato () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO findUltimoForCampeonatoMostrar", $this->con->getsql () );
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->result = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->result;
	}
	public function findById($id) {
		$this->results = new RankingBean ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$etapaDAO = new EtapaDAO ( $this->con );
		try {
			$query = " SELECT " . $campeonatoDAO->camposSelect () . ", " . $etapaDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " . " left join " . $this->dbprexis . $etapaDAO->tabelaAlias () . " on " . $etapaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idetapa " . " where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO findById", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findMaxByIdCampeonato($idCampeonato) {
		$this->results = new RankingBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idcampeonato = ? and " . 
			$this->getalias () . ".dtinicio < now() " . 
			" having max(" . $this->getalias () . ".dtcriacao)	";
			$this->con->setNumero ( 1, $idCampeonato );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "RankingDAO findMaxByIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findByIdEdit($id) {
		$this->results = new RankingBean ();
		$rankingPilotoDAO = new RankingPilotoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		$dbg = 0;
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $rankingPilotoDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . "  " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left JOIN " . $this->getdbprexis () . $rankingPilotoDAO->tabelaAlias () . " ON  " . $rankingPilotoDAO->getalias () . ".idranking =  " . $this->idtabelaAlias () . " left JOIN " . $this->getdbprexis () . $pilotoDAO->tabelaAlias () . " ON  " . $rankingPilotoDAO->getalias () . ".idpiloto =  " . $pilotoDAO->idtabelaAlias () . " where " . $this->idtabelaAlias () . " = ? " . " order by " . $rankingPilotoDAO->getalias () . ".valorpontuacao desc, " . $rankingPilotoDAO->getalias () . ".desempate " . "  ";
			
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "RankingDAO findByIdEdit query ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			$ponto_desempate = 0;
			$rankingBean = new RankingBean ();
			
			$rankingPilotoBean = new RankingPilotoBean ();
			$rankingPilotoClt = Array ();
			
			while ( $array = $result->fetch_assoc () ) {
				Util::echobr ( $dbg, "RankingDAO findByIdEdit getBeans ", ($rankingBean->getid () == '') ? "beanIdVazio" : "beanIdPreenchido" );
				if ($rankingBean->getid () < 1) {
					$rankingBean = $this->getBeans ( $array );
					$rankingPilotoClt = Array ();
				}
				// if(count($rankingPilotoClt)<1)$rankingPilotoClt = Array();
				
				$rankingPilotoDAO = new RankingPilotoDAO ( $this->con );
				
				if ($array [$rankingPilotoDAO->getalias () . "_" . $rankingPilotoDAO->idtabela ()] != 0) {
					$rankingPilotoTmpclt = Array ();
					$rankingPilotoTmpclt [] = $rankingPilotoDAO->getBeans ( $array );
					$rankingPilotoBean = $rankingPilotoTmpclt [0];
					$rankingPilotoClt [] = $rankingPilotoBean;
				}
			}
			$rankingBean->setrankingpilotoclt ( $rankingPilotoClt );
			Util::echobr ( $dbg, "RankingDAO findByIdEdit rankingBean ", $rankingBean );
			$this->results = $rankingBean;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findGraficoData($idcampeonato, $arrPilotos) {
		$this->clt = array ();
		try {
			$query = " 
  				select
  					etapa.numero numero,
( select valorpontuacao	from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p1	)p1,
( select valorpontuacao	from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p2	)p2,
  				( select valorpontuacao	from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p3	)p3,
  				( select valorpontuacao	from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p4	)p4,
  				( select valorpontuacao	from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p5	)p5
  				from
  					kart_ranking ranking
  					inner join 
  					kart_etapa etapa
  					on ranking.idetapa = etapa.idetapa
  					inner join
  					(select ? idcampeonato, ? p1, ? p2, ? p3, ? p4, ? p5 from dual) par
  					on ranking.idcampeonato = par.idcampeonato
  				where ranking.dtinicio < now()
  				order by etapa.numero
  
  
  		";
			
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
				$linha = array ();
				$linha [] = $array ['numero'];
				if ($arrPilotos [0] > 0) {
					$linha [] = $array ['p1'];
				}
				if ($arrPilotos [1] > 0) {
					$linha [] = $array ['p2'];
				}
				if ($arrPilotos [2] > 0) {
					$linha [] = $array ['p3'];
				}
				if ($arrPilotos [3] > 0) {
					$linha [] = $array ['p4'];
				}
				if ($arrPilotos [4] > 0) {
					$linha [] = $array ['p5'];
				}
				$this->clt [] = $linha;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findGraficoPosicao($idcampeonato, $arrPilotos) {
		$this->clt = array ();
		try {
			$query = "
  				select
  					etapa.numero numero,
( select posicao from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p1	)p1,
( select posicao from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p2	)p2,
( select posicao from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p3	)p3,
( select posicao from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p4	)p4,
( select posicao from kart_ranking_piloto rankingpiloto
  where	rankingpiloto.idranking = ranking.idranking	and rankingpiloto.idpiloto = par.p5	)p5
  				from
  					kart_ranking ranking
  					inner join
  					kart_etapa etapa
  					on ranking.idetapa = etapa.idetapa
  					inner join
  					(select ? idcampeonato, ? p1, ? p2, ? p3, ? p4, ? p5 from dual) par
  					on ranking.idcampeonato = par.idcampeonato
  				where ranking.dtinicio < now()
  				order by etapa.numero
  
  
  		";
			
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
				$linha = array ();
				$linha [] = $array ['numero'];
				if ($arrPilotos [0] > 0) {
					$linha [] = $array ['p1'];
				}
				if ($arrPilotos [1] > 0) {
					$linha [] = $array ['p2'];
				}
				if ($arrPilotos [2] > 0) {
					$linha [] = $array ['p3'];
				}
				if ($arrPilotos [3] > 0) {
					$linha [] = $array ['p4'];
				}
				if ($arrPilotos [4] > 0) {
					$linha [] = $array ['p5'];
				}
				$this->clt [] = $linha;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function delete($bean) {
		$this->results = new RankingBean ();
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