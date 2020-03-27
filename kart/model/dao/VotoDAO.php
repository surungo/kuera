<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once  'EleitorCategoriaGrupoDAO.php';
include_once  'CandidatoCategoriaGrupoDAO.php';
include_once  'CategoriaGrupoDAO.php';
include_once  'GrupoDAO.php';
include_once  'CategoriaDAO.php';
include_once  'EleitorDAO.php';
include_once  'CandidatoDAO.php';
include_once  'PessoaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/VotoBean.php';
class VotoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "voto";
	protected $tabela = "voto";
	protected $idtabela = "idvoto";
	protected $campos = array (
			"ideleitorcategoriagrupo",
			"idcandidatocategoriagrupo",
			"idvoto" 
	);
	protected $ordernome = "voto.idvoto";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
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
			" ideleitorcategoriagrupo, " . 
			" idcandidatocategoriagrupo, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
            " ?, " .      /* dtinicio,*/ 
            " ?, " . 			// ideleitorcategoriagrupo,
			" ?, " . 			// idcandidatocategoriagrupo,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->geteleitorcategoriagrupo ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getcandidatocategoriagrupo ()) );
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
		$this->bean = new VotoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idvoto", null ) );
		Util::echobr (0, 'VotoDAO getBeans ideleitorcategoriagrupo', $this->getValorArray ( $array, "ideleitorcategoriagrupo", null) );
		$this->bean->seteleitorcategoriagrupo ( $this->getValorArray ( $array, "ideleitorcategoriagrupo", new EleitorCategoriaGrupoDAO($this->con) ) );
		$this->bean->setcandidatocategoriagrupo ( $this->getValorArray ( $array, "idcandidatocategoriagrupo", new CandidatoCategoriaGrupoDAO($this->con) ) );
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->whereAtivo () . 
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "VotoDAO findAllAtivo", $this->con->getsql () );
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
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorcategoriagrupoDAO->camposSelect () ." , ".
			$candidatocategoriagrupoDAO->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias () .	
			 " on ".
			 $eleitorcategoriagrupoDAO->idtabela ()	. " = "	. $this->getalias() . ".ideleitorcategoriagrupo ".
			" inner join ".
			 $this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .	
			 " on ".
			 $candidatocategoriagrupoDAO->idtabela ()	. " = "	. $this->getalias() . ".idcandidatocategoriagrupo ".
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
	
	public function findByCampeonato($campeonato) {
		$dbg = 0;
		$this->clt = array ();
		$eleitorDAO = new EleitorDAO($this->con);
		$candidatoDAO = new CandidatoDAO($this->con);
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriaDAO = new CategoriaDAO($this->con);
		$categoriaGrupoDAO = new CategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " .
				$eleitorDAO->camposSelect () . ", ".
				$candidatoDAO->camposSelect () . ", ".
				$eleitorcategoriagrupoDAO->camposSelect () . ", ".
				$candidatocategoriagrupoDAO->camposSelect () . ", ".
				$this->camposSelect () . 
				" from " . 
					$this->dbprexis . $categoriaDAO->tabelaAlias() .
				" inner join " .
					$this->dbprexis . $categoriaGrupoDAO->tabelaAlias() .
					" on " . $categoriaDAO->idtabelaAlias() ." = " . $categoriaGrupoDAO->getalias() .".idcategoria ". 
				" inner join " . 
				    $this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias() . 
				    " on " . $categoriaGrupoDAO->idtabelaAlias() . " = " . $eleitorcategoriagrupoDAO->getalias() .".idcategoriagrupo ".
				" inner join " .
				    $this->dbprexis . $eleitorDAO->tabelaAlias() .
				    " on " . $eleitorDAO->idtabelaAlias() . " = " . $eleitorcategoriagrupoDAO->getalias() .".ideleitor " .
				" left outer join ". 
				    $this->dbprexis . $this->tabelaAlias() .
				    " on " . $eleitorcategoriagrupoDAO->idtabelaAlias() . " = " . $this->getalias() .".ideleitorcategoriagrupo " .
				" left outer join ".
					$this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias() .
				    " on " . $candidatocategoriagrupoDAO->idtabelaAlias() . " = " . $this->getalias() .".idcandidatocategoriagrupo " . 
				" left outer join " .
					$this->dbprexis . $candidatoDAO->tabelaAlias() .
				    		
				    " on " . $candidatoDAO->idtabelaAlias() . " = " . $candidatocategoriagrupoDAO->getalias() .".idcandidato ".
		 		" where " .
					$categoriaDAO->getalias() .".idcampeonato = ? " ;
				 
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "votodao findByCampeonato query", $this->con->getsql() );
			
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
		$eleitorCategoriaGrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatoCategoriaGrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$eleitorDAO = new EleitorDAO($this->con);
		$candidatoDAO = new CandidatoDAO($this->con);
		
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . 
			$eleitorDAO->camposSelect () . ", ".
			$candidatoDAO->camposSelect () . ", ".
			$eleitorCategoriaGrupoDAO->camposSelect () . ", ".
			$candidatoCategoriaGrupoDAO->camposSelect () . ", ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join ".
			$this->dbprexis . $eleitorCategoriaGrupoDAO->tabelaAlias () .
			" on ".
			$eleitorCategoriaGrupoDAO->idtabelaAlias() . " = " . $this->getalias().".idEleitorCategoriaGrupo ". 
			" inner join ".
			$this->dbprexis . $candidatoCategoriaGrupoDAO->tabelaAlias () .
			" on ".
			$candidatoCategoriaGrupoDAO->idtabelaAlias() . " = " . $this->getalias().".idCandidatoCategoriaGrupo ". 
			" inner join ".
			$this->dbprexis . $eleitorDAO->tabelaAlias () .
			" on ".
			$eleitorDAO->idtabelaAlias() . " = " . $eleitorCategoriaGrupoDAO->getalias().".ideleitor ".
			" inner join ".
			$this->dbprexis . $candidatoDAO->tabelaAlias () .
			" on ".
			$candidatoDAO->idtabelaAlias() . " = " . $candidatoCategoriaGrupoDAO->getalias().".idcandidato ".
							
			" ORDER BY " . $this->ordernome;

			$this->con->setsql ( $query );
			Util::echobr ( 0, "VotoDAO findAllSort query", $this->con->getsql() );
				
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
		$this->results = new VotoBean ();
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorcategoriagrupoDAO->camposSelect().", ".
			$candidatocategoriagrupoDAO->camposSelect().", ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias () . 
			" on " . $this->getalias().".ideleitorcategoriagrupo = ".$eleitorcategoriagrupoDAO->idtabelaAlias().
			" inner join " . $this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () . 
			" on " . $this->getalias().".idcandidatocategoriagrupo = ".$candidatocategoriagrupoDAO->idtabelaAlias().
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
	
	public function relatorioFinal($campeonato) {
		$this->results = array();
		try {
			$query = 	" SELECT  " .
	"		g.idgrupo,  " .
	"	 	g.nome grupo,  " .
	"	 	c.idcandidato,  " .
	"	 	p.nome candidato,  " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto  " .
	"	 	 inner join kart_candidatocategoriagrupo ccg2  " .
	"	 	 on ccg2.idcandidatocategoriagrupo = voto.idcandidatocategoriagrupo  " .
	" where ccg2.idcandidatocategoriagrupo = ccg.idcandidatocategoriagrupo  " .
	" ) total,  " .
	" (select count(*)  " .
	" from kart_eleitorcategoriagrupo ecg3  " .
	" inner join kart_categoriagrupo cg3 " .
	" on ecg3.idcategoriagrupo = cg3.idcategoriagrupo ".
	" where cg3.idgrupo = g.idgrupo  " .
	" )  possiveisGrupo" .
	" ,  " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto4  " .
	" inner join kart_eleitorcategoriagrupo ecg4  " .
	" on ecg4.ideleitorcategoriagrupo = voto4.ideleitorcategoriagrupo  " .
	" inner join kart_categoriagrupo cg4  " .
	" on ecg4.idcategoriagrupo = cg4.idcategoriagrupo ".
	" where cg4.idgrupo = g.idgrupo  " .
	" ) votados , " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto4  " .
	" inner join kart_eleitorcategoriagrupo ecg4 on ecg4.ideleitorcategoriagrupo = voto4.ideleitorcategoriagrupo " .
	" inner join kart_categoriagrupo cg4 on ecg4.idcategoriagrupo = cg4.idcategoriagrupo  " .
	" inner join kart_eleitor e4 on e4.ideleitor = ecg4.ideleitor  " .
	" where e4.idpessoa = p.idpessoa and cg4.idgrupo = g.idgrupo  " .
	" ) votogrupo  " .
	"	 	 FROM kart_candidatocategoriagrupo ccg  " .
	"	 	 inner join kart_candidato c  " .
	"	 	 on c.idcandidato = ccg.idcandidato  " .
	"	 	 inner join kart_pessoa p  " .
	"	 	 on p.idpessoa = c.idpessoa  " .
	"	 	 inner join kart_categoriagrupo cg  " .
	"	 	 on ccg.idcategoriagrupo = cg.idcategoriagrupo  " .
	" inner join kart_grupo g  " .
	" on cg.idgrupo = g.idgrupo  " .
	" where  " .
	"	 	 g.idcampeonato = ?  " .
	
	"	 	 order by g.nome ,total desc   ";
			$this->con->setNumero ( 1, Util::GetIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr(0,'VotoDAO relatorioFinal query ',$this->con->getsql());

			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results[] =  $array ;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function relatorioFinalByGrupo($grupo) {
		$this->results = array();
		try {
			$query = 	" SELECT  " .
	"		g.idgrupo,  " .
	"	 	g.nome grupo,  " .
	"	 	c.idcandidato,  " .
	"	 	p.nome candidato,  " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto  " .
	"	 	 inner join kart_candidatocategoriagrupo ccg2  " .
	"	 	 on ccg2.idcandidatocategoriagrupo = voto.idcandidatocategoriagrupo  " .
	" where ccg2.idcandidatocategoriagrupo = ccg.idcandidatocategoriagrupo  " .
	" ) total,  " .
	" (  " .
	" (select count(*)  " .
	" from kart_eleitorcategoriagrupo ecg3  " .
	" inner join kart_eleitor e3  " .
	" on e3.ideleitor = ecg3.ideleitor  " .
	" where e3.idpessoa = p.idpessoa  " .
	" )  " .
	" -  " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto3  " .
	" inner join kart_eleitorcategoriagrupo ecg3  " .
	" on ecg3.ideleitorcategoriagrupo = voto3.ideleitorcategoriagrupo  " .
	" inner join kart_eleitor e3  " .
	" on e3.ideleitor = ecg3.ideleitor  " .
	" where e3.idpessoa = p.idpessoa  " .
	" )  " .
	" ) faltavotos , " .
	" (  " .
	" select count(*)  " .
	" from kart_voto voto4  " .
	" inner join kart_eleitorcategoriagrupo ecg4 on ecg4.ideleitorcategoriagrupo = voto4.ideleitorcategoriagrupo " .
	" inner join kart_categoriagrupo cg4 on ecg4.idcategoriagrupo = cg4.idcategoriagrupo  " .
	" inner join kart_eleitor e4 on e4.ideleitor = ecg4.ideleitor  " .
	" where e4.idpessoa = p.idpessoa and cg4.idgrupo = g.idgrupo  " .
	" ) votogrupo  " .
	"	 	 FROM kart_candidatocategoriagrupo ccg  " .
	"	 	 inner join kart_candidato c  " .
	"	 	 on c.idcandidato = ccg.idcandidato  " .
	"	 	 inner join kart_pessoa p  " .
	"	 	 on p.idpessoa = c.idpessoa  " .
	"	 	 inner join kart_categoriagrupo cg  " .
	"	 	 on ccg.idcategoriagrupo = cg.idcategoriagrupo  " .
	" inner join kart_grupo g  " .
	" on cg.idgrupo = g.idgrupo  " .
	" where  " .
	"	 	 g.idgrupo = ?  " .
	"	 	 group by p.nome  " .
	"	 	 order by total desc   ";
			$this->con->setNumero ( 1, Util::GetIdObjeto($grupo) );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results[] =  $array ;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function relatorioFinalEleitorByGrupo($grupo) {
		$this->results = array();
		try {
			$query =  " SELECT  ".
					"	g.idgrupo,  ".
					"	g.nome grupo,  ".
					"	e.ideleitor,  ".
					"	p.nome eleitor,  ".
					"	(select count(*)  ".
					"	 from kart_eleitorcategoriagrupo ecg3  ".
					"	 inner join kart_eleitor e3  ".
					"	 on e3.ideleitor = ecg3.ideleitor  ".
					"	 where e3.idpessoa = p.idpessoa  ".
					"	) opcoes ,  ".
					"	(  ".
					"	 select count(*)  ".
					"	 from kart_voto voto3  ".
					"	 inner join kart_eleitorcategoriagrupo ecg3  ".
					"	 on ecg3.ideleitorcategoriagrupo = voto3.ideleitorcategoriagrupo  ".
					"	 inner join kart_eleitor e3  ".
					"	 on e3.ideleitor = ecg3.ideleitor  ".
					"	 where e3.idpessoa = p.idpessoa  ".
					"	) votado  ".
					" FROM kart_eleitorcategoriagrupo ecg  ".
					"	inner join kart_eleitor e  ".
					"	on e.ideleitor = ecg.ideleitor  ".
					"	inner join kart_pessoa p  ".
					"	on p.idpessoa = e.idpessoa  ".
					"	inner join kart_categoriagrupo cg  ".
					"	on ecg.idcategoriagrupo = cg.idcategoriagrupo  ".
					"	inner join kart_grupo g  ".
					"	on cg.idgrupo = g.idgrupo  ".
					" where  ".
					"	g.idgrupo = ?  ".
					" group by p.nome  ".
					" order by votado  ";
			$this->con->setNumero ( 1, Util::GetIdObjeto($grupo) );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results[] =  $array ;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	
	
	public function findByEleitorECandidatoCategoriaGrupo($bean) {
		$this->results = new VotoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" where " . 
			$this->getalias () . ".idEleitorCategoriaGrupo = ? and ".
			$this->getalias () . ".idCandidatoCategoriaGrupo = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getEleitorCategoriaGrupo())  );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getCandidatoCategoriaGrupo()) );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "VotoDAO findByEleitorECandidatoCategoriaGrupo getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function findGruposFaltaVotarByEleitor($eleitor) {
		$this->results =Array ();
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$pessoaDAO = new PessoaDAO($this->con);
		$eleitorDAO = new EleitorDAO($this->con);
		$candidatoDAO = new CandidatoDAO($this->con);
		$categoriagrupoDAO = new CategoriaGrupoDAO($this->con);
		$grupoDAO = new GrupoDAO($this->con);
		$categoriaDAO = new CategoriaDAO($this->con);
		
		
		try {
			$query = " SELECT " .
			$eleitorcategoriagrupoDAO->camposSelect() . ", " .
			$categoriaDAO->camposSelect() . ", " .
			$grupoDAO->camposSelect() . ", " .
			$categoriagrupoDAO->camposSelect() . ", " .
			$pessoaDAO->camposSelect() .", ". 
			$eleitorDAO->camposSelect() . 
			" FROM " . 
			$this->dbprexis . $eleitorDAO->tabelaAlias() .
			" inner join " .
			$this->dbprexis . $pessoaDAO->tabelaAlias() .
			" on " .
			$pessoaDAO->idtabelaAlias() . " = " . $eleitorDAO->getalias().".idpessoa ".
			" inner join " .
			$this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias() .
			" on " .
			$eleitorDAO->idtabelaAlias() . " = " . $eleitorcategoriagrupoDAO->getalias().".ideleitor ".
			" inner join " .
			$this->dbprexis . $categoriagrupoDAO->tabelaAlias() .
			" on " .
			$categoriagrupoDAO->idtabelaAlias() . " = " . $eleitorcategoriagrupoDAO->getalias().".idcategoriagrupo ".
			" inner join " .
			$this->dbprexis . $grupoDAO->tabelaAlias() .
			" on " .
			$grupoDAO->idtabelaAlias() . " = " . $categoriagrupoDAO->getalias().".idgrupo ".
			" inner join " .
			$this->dbprexis . $categoriaDAO->tabelaAlias() .
			" on " .
			$categoriaDAO->idtabelaAlias() . " = " . $categoriagrupoDAO->getalias().".idcategoria ".
			/*" inner join ".
			$this->dbprexis . $this->tabelaAlias () .
			" on " . 
			$eleitorcategoriagrupoDAO->idtabelaAlias() . " = " . $this->getalias().".ideleitorcategoriagrupo ".
			*/
			" where " .
			" not exists ( ".
			" 	select 1 " .
			"   from " .
			"   kart_voto voto1 ".
			" where ". 
			$eleitorcategoriagrupoDAO->idtabelaAlias() . " = voto1.ideleitorcategoriagrupo ".
			" ) and ".
			$eleitorDAO->idtabelaAlias() . " = ?  ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($eleitor));
			$this->con->setsql ( $query );
			Util::echobr (0, "VotoDAO findGruposFaltaVotarByEleitor getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results[] = $this->getBeans ( $array );
				Util::echobr (0, 'VotoDAO findGruposFaltaVotarByEleitor $array', $array );
					
			}
			Util::echobr (0, 'VotoDAO findGruposFaltaVotarByEleitor $this->results', $this->results );
				
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	
	public function totalVotosByCampeonato($campeonato) {
		$this->results = 0;
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDAO = new CategoriaGrupoDAO($this->con);
		$grupoDAO = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join " .
			$this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .
			" on ".
			$this->getalias () . ".idCandidatoCategoriaGrupo = ".$candidatocategoriagrupoDAO->idtabelaAlias () .
			" inner join " . 
			$this->dbprexis . $categoriagrupoDAO->tabelaAlias () .
			" on ".
			$candidatocategoriagrupoDAO->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDAO->idtabelaAlias () .
			" inner join " .
			$this->dbprexis . $grupoDAO->tabelaAlias () .
			" on ".
			$categoriagrupoDAO->getalias () . ".idGrupo = ".$grupoDAO->idtabelaAlias () .
			" where " .
			$grupoDAO->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "VotoDAO totalVotosByCampeonato getsql", $this->con->getsql() );
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function totalEleitoresByCampeonato($campeonato) {
		$this->results = 0;
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDAO = new CategoriaGrupoDAO($this->con);
		$grupoDAO = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count( distinct ". $eleitorcategoriagrupoDAO->getalias().".ideleitor ) total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .
					" on ".
					$this->getalias () . ".idCandidatoCategoriaGrupo = ".$candidatocategoriagrupoDAO->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDAO->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDAO->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDAO->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDAO->tabelaAlias () .
					" on ".
					$categoriagrupoDAO->getalias () . ".idGrupo = ".$grupoDAO->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDAO->idtabelaAlias () . " = ". $this->getalias () . ".ideleitorcategoriagrupo ".
					" where " .
					$grupoDAO->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "VotoDAO totalEleitoresByCampeonato getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function totalVotosByGrupo($grupo) {
		$this->results = 0;
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDAO = new CategoriaGrupoDAO($this->con);
		$grupoDAO = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .
					" on ".
					$this->getalias () . ".idCandidatoCategoriaGrupo = ".$candidatocategoriagrupoDAO->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDAO->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDAO->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDAO->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDAO->tabelaAlias () .
					" on ".
					$categoriagrupoDAO->getalias () . ".idGrupo = ".$grupoDAO->idtabelaAlias () .
					" where " .
					$grupoDAO->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($grupo)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "VotoDAO totalVotosByGrupo getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function findByEleitorCategoriaGrupo($eleitorcategoriagrupo) {
		$this->clt = array ();
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO($this->con);
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorcategoriagrupoDAO->camposSelect () ." , ".
			$candidatocategoriagrupoDAO->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias () .	
			 " on ".
			 $eleitorcategoriagrupoDAO->idtabelaAlias(). " = "	. $this->getalias() . ".ideleitorcategoriagrupo ".
			" inner join ".
			 $this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .	
			 " on ".
			 $candidatocategoriagrupoDAO->idtabelaAlias(). " = "	. $this->getalias() . ".idcandidatocategoriagrupo ".
			" where " .  $this->getalias() . ".ideleitorcategoriagrupo  = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($eleitorcategoriagrupo) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "VotoDAO findByEleitorCategoriaGrupo getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function delete($bean) {
		$this->results = new VotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
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
	public function deleteEleitorCategoriaGrupo($bean) {
		$this->results = new VotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE ideleitorcategoriagrupo = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->geteleitorcategoriagrupo ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "VotoDAO deleteEleitorCategoriaGrupo getsql", $this->con->getsql() );
			
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