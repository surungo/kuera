<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once  'CandidatoDAO.php';
include_once  'CategoriaGrupoDAO.php';
include_once  'CategoriaDAO.php';
include_once  'GrupoDAO.php';
include_once  'PessoaDAO.php';
include_once  'EleitorDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoCategoriaGrupoBean.php';
class CandidatoCategoriaGrupoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "candidatocategoriagrupo";
	protected $tabela = "candidatocategoriagrupo";
	protected $idtabela = "idcandidatocategoriagrupo";
	protected $campos = array (
			"idcandidato",
			"idcategoriagrupo",
			"idcandidatocategoriagrupo" 
	);
	protected $ordernome = "candidatocategoriagrupo.idcandidatocategoriagrupo";
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
			" idcandidato, " . 
			" idcategoriagrupo, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
            " ?, " .      /* dtinicio,*/ 
            " ?, " . 			// idcandidato,
			" ?, " . 			// idcategoriagrupo,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->getcandidato ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getcategoriagrupo ()) );
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
		$this->bean = new CandidatoCategoriaGrupoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idcandidatocategoriagrupo", null ) );
		$this->bean->setcandidato ( $this->getValorArray ( $array, "idcandidato", new CandidatoDAO($this->con) ) );
		$this->bean->setcategoriagrupo ( $this->getValorArray ( $array, "idcategoriagrupo", new CategoriaGrupoDAO($this->con) ) );
		
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
			Util::echobr ( 0, "CandidatoCategoriaGrupoDAO findAllAtivo", $this->con->getsql () );
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
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$candidatoDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $candidatoDao->tabelaAlias () .	
			 " on ".
			 $candidatoDao->idtabela ()	. " = "	. $this->getalias() . ".idcandidato ".
			" inner join ".
			 $this->dbprexis . $categoriagrupoDao->tabelaAlias () .	
			 " on ".
			 $categoriagrupoDao->idtabela ()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
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
				
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$pessoaDao = new PessoaDao($this->con);
		$eleitorDao = new EleitorDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}

			$query = " SELECT " .
					$grupoDao->camposSelect () ." , ".
					$pessoaDao->camposSelect () ." , ".
					$candidatoDao->camposSelect () ." , ".
					$categoriagrupoDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
				 	$this->dbprexis . $candidatoDao->tabelaAlias () .
					 " on ".
					 $candidatoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcandidato ".
					 " inner join ".
					 $this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					 " on ".
					 $categoriagrupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
					 " inner join ".
					 $this->dbprexis . $pessoaDao->tabelaAlias () .
					 " on ".
					 $pessoaDao->idtabelaAlias ()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
					 " inner join ".
					 $this->dbprexis . $grupoDao->tabelaAlias () .
					 " on " .
					 $grupoDao->idtabelaAlias ()	. " = "	. $categoriagrupoDao->getalias() . ".idgrupo ".
					 " ORDER BY " . $this->ordernome;
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'CandidatoCategoriaGrupoDao findAllSort query', $this->con->getsql( ) );
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
		$this->results = new CandidatoCategoriaGrupoBean ();
		$pessoaDao = new PessoaDAO($this->con);
		$candidatoDao = new CandidatoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$pessoaDao->camposSelect () ." , ".
			$candidatoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join ".
			$this->dbprexis . $candidatoDao->tabelaAlias () .	
			" on ".
			$candidatoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcandidato ".
			" inner join ".
			$this->dbprexis . $pessoaDao->tabelaAlias () .
			" on ".
			$pessoaDao->idtabelaAlias()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr (0, "CandidatoCategoriaGRupoDAO findById getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findAllNotEleitor($eleitorCategoriaGrupo) {
		$this->clt = array ();
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$pessoaDao = new PessoaDao($this->con);
		$eleitorDao = new EleitorDAO($this->con);
		
		try {
			$query = " SELECT " .
					$pessoaDao->camposSelect () ." , ".
					$candidatoDao->camposSelect () ." , ".
					$categoriagrupoDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
				 $this->dbprexis . $candidatoDao->tabelaAlias () .
				 " on ".
				 $candidatoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcandidato ".
				 " inner join ".
				 $this->dbprexis . $categoriagrupoDao->tabelaAlias () .
				 " on ".
				 $categoriagrupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
				 " inner join ".
				 $this->dbprexis . $pessoaDao->tabelaAlias () .
				 " on ".
				 $pessoaDao->idtabelaAlias ()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
				 " where ".
				 " not exists ( ".
				 " 	select 1 ".
				 "  from " .
				 $this->dbprexis . $eleitorDao->tabelaAlias () .
				 "	where ".
				 $eleitorDao->getalias(). ".idpessoa = ". $candidatoDao->getalias(). ".idpessoa and ".
				 $eleitorDao->idtabelaAlias ()	. " = ? " .
				 " ) and ".
				 $this->getalias() . ".idcategoriagrupo  = ? ".
				 " ORDER BY " . $pessoaDao->getalias().".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($eleitorCategoriaGrupo->geteleitor() ) );
			$this->con->setNumero ( 2, Util::getIdObjeto($eleitorCategoriaGrupo->getcategoriagrupo()) );
				
			$this->con->setsql ( $query );
			
			Util::echobr (0, 'CandidatoCategoriaGrupoDAO this->con->setsql ', $this->con->setsql  );
			$result = $this->con->execute ();
				
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findByCandidatoEvento($candidato,$evento) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT " .
			$pessoaDao->camposSelect () ." , ".
			$candidatoDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$grupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			$this->dbprexis . $candidatoDao->tabelaAlias () .	
			" on ".
			$candidatoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcandidato ".
			" inner join ".
			$this->dbprexis . $categoriagrupoDao->tabelaAlias () .	
			" on ".
			$categoriagrupoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
			
			" inner join ".
			$this->dbprexis . $categoriaDao->tabelaAlias () .
			" on ".
			$categoriaDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idcategoria ".
			" inner join ".
			$this->dbprexis . $grupoDao->tabelaAlias () .
			" on ".
			$grupoDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idgrupo ".
			" inner join ".
			$this->dbprexis . $pessoaDao->tabelaAlias () .
			" on ".
			$pessoaDao->idtabelaAlias()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
				
			
			" where " .  $this->getalias() . ".idcandidato  = ? " .
			" and "  .  $grupoDao->getalias() . ".idcampeonato  = IFNULL(?,".  $grupoDao->getalias() . ".idcampeonato) " ;

			$this->con->setNumero ( 1, Util::getIdObjeto($candidato) );
			$this->con->setNumero ( 2, Util::getIdObjeto($evento) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoCategoriaGrupoDAO findByCandidatoEvento getsql", $this->con->getsql() );
			
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	
	public function findByCandidato($candidato) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT " .
			$pessoaDao->camposSelect () ." , ".
			$candidatoDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$grupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			$this->dbprexis . $candidatoDao->tabelaAlias () .	
			" on ".
			$candidatoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcandidato ".
			" inner join ".
			$this->dbprexis . $categoriagrupoDao->tabelaAlias () .	
			" on ".
			$categoriagrupoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
			
			" inner join ".
			$this->dbprexis . $categoriaDao->tabelaAlias () .
			" on ".
			$categoriaDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idcategoria ".
			" inner join ".
			$this->dbprexis . $grupoDao->tabelaAlias () .
			" on ".
			$grupoDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idgrupo ".
			" inner join ".
			$this->dbprexis . $pessoaDao->tabelaAlias () .
			" on ".
			$pessoaDao->idtabelaAlias()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
				
			
			" where " .  $this->getalias() . ".idcandidato  = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($candidato) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoCategoriaGrupoDAO findByCandidato getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findByCategoriaGrupo($categoriagrupo) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$candidatoDao = new CandidatoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT " .
			$pessoaDao->camposSelect () ." , ".
			$candidatoDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$grupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			$this->dbprexis . $candidatoDao->tabelaAlias () .	
			" on ".
			$candidatoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcandidato ".
			" inner join ".
			$this->dbprexis . $categoriagrupoDao->tabelaAlias () .	
			" on ".
			$categoriagrupoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoriagrupo ".
			
			" inner join ".
			$this->dbprexis . $categoriaDao->tabelaAlias () .
			" on ".
			$categoriaDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idcategoria ".
			" inner join ".
			$this->dbprexis . $grupoDao->tabelaAlias () .
			" on ".
			$grupoDao->idtabelaAlias()	. " = "	. $categoriagrupoDao->getalias() . ".idgrupo ".
			" inner join ".
			$this->dbprexis . $pessoaDao->tabelaAlias () .
			" on ".
			$pessoaDao->idtabelaAlias()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
	
						
					" where " .  
			$this->getalias() . ".idcategoriagrupo  = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($categoriagrupo) );
			$this->con->setsql ( $query );
			Util::echobr (0, "CandidatoCategoriaGrupoDAO findByGrupoCategoria getsql", $this->con->getsql() );
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
		$this->results = new CandidatoCategoriaGrupoBean ();
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
	public function deleteCandidato($bean) {
		$this->results = new CandidatoCategoriaGrupoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idcandidato = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getcandidato ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoCategoriaGrupoDAO deleteCandidato getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteCandidatoCategoriaGrupo($bean) {
		
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idcandidato = ? ". 
			" and idCategoriaGrupo = ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getCandidato ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getCategoriaGrupo ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoCategoriaGrupoDAO deleteCandidatoCategoriaGrupo getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
}

?>