<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once  'GrupoDAO.php';
include_once  'PessoaDAO.php';
include_once  'CategoriaDAO.php';
include_once  'CategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
class CategoriaGrupoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "categoriagrupo";
	protected $tabela = "categoriagrupo";
	protected $idtabela = "idcategoriagrupo";
	protected $campos = array (
			"idgrupo",
			"idcategoria",
			"idcategoriagrupo" 
	);
	protected $ordernome = "categoriagrupo.idcategoriagrupo";
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
			" idgrupo, " . 
			" idcategoria, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
            " ?, " .      /* dtinicio,*/ 
            " ?, " . 			// idgrupo,
			" ?, " . 			// idcategoria,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->getgrupo ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getcategoria ()) );
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
		$this->bean = new CategoriaGrupoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idcategoriagrupo", null ) );
		$this->bean->setgrupo ( $this->getValorArray ( $array, "idgrupo", new GrupoDAO($this->con) ) );
		$this->bean->setcategoria ( $this->getValorArray ( $array, "idcategoria", new CategoriaDAO($this->con) ) );
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
			Util::echobr ( 0, "CategoriaGrupoDAO findAllAtivo", $this->con->getsql () );
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
		$grupoDao = new GrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$grupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $grupoDao->tabelaAlias () .	
			 " on ".
			 $grupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idgrupo ".
			" inner join ".
			 $this->dbprexis . $categoriaDao->tabelaAlias () .	
			 " on ".
			 $categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
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
		$this->clt = array ();
		$grupoDao = new GrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
	
		try {
			$query = " SELECT " .
					$grupoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" left join ".
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$grupoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idgrupo ".
					" left join ".
					$this->dbprexis . $categoriaDao->tabelaAlias () .
					" on ".
					$categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
					" where " .
					$grupoDao->getalias() . ".idcampeonato = ?  ".
					" ORDER BY " . $this->ordernome;
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategotiaGrupo query", $this->con->getsql() );
			$result = $this->con->execute ();
	
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findEleitorCandidatoCampeonato($campeonato) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$eleitorDao = new EleitorDAO($this->con);
		$candidatoDao = new CandidatoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		
		try {
			$query = " SELECT " .
					$pessoaDao->camposSelect () ." , ".
					$eleitorDao->camposSelect () ." , ".
					$candidatoDao->camposSelect () .
					" FROM " . $this->dbprexis . $pessoaDao->tabelaAlias () .
				 " left join ".
				 $this->dbprexis . $eleitorDao->tabelaAlias () .
				 " on ".
				 $pessoaDao->idtabelaAlias()	. " = "	. $eleitorDao->getalias() . ".idpessoa ".
				 " left join ".
				 $this->dbprexis . $candidatoDao->tabelaAlias () .
				 " on ".
				 $pessoaDao->idtabelaAlias ()	. " = "	. $candidatoDao->getalias() . ".idpessoa ".
				 " where " .
				 " exists " .
				 " ( ".
				 " select " . 
				 " * " .
				 " from " . 
				 $this->dbprexis . $grupoDao->tabelaAlias () .
				 " inner join ".
				 $this->dbprexis . $categoriagrupoDao->tabelaAlias () .
				 " on ".
				 $grupoDao->idtabelaAlias ()	. " = "	. $categoriagrupoDao->getalias() . ".idgrupo ".
				 " where ".
				 
				 $grupoDao->getalias() . ".idcampeonato = ?  ".
				 " ) ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategotiaGrupo query", $this->con->getsql() );
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
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
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
	public function findById($id) {
		$this->results = new CategoriaGrupoBean ();
		
		$grupoDao = new GrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		try {
			$query = " SELECT " . 
			$grupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join ".
			 $this->dbprexis . $grupoDao->tabelaAlias () .	
			 " on ".
			 $grupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idgrupo ".
			" inner join ".
			 $this->dbprexis . $categoriaDao->tabelaAlias () .	
			 " on ".
			 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
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
	public function findByGrupo($grupo) {
		$this->clt = array ();
		$grupoDao = new GrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$grupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $grupoDao->tabelaAlias () .	
			 " on ".
			 $grupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idgrupo ".
			" inner join ".
			 $this->dbprexis . $categoriaDao->tabelaAlias () .	
			 " on ".
			 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
			" where " .  $this->getalias() . ".idgrupo  = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($grupo) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaGrupoDAO findByGrupo getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findByNomeGrupo($grupo) {
		$this->clt = array ();
		$grupoDao = new GrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
	
		try {
			$query = " SELECT " .
					$grupoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
				 $this->dbprexis . $grupoDao->tabelaAlias () .
				 " on ".
				 $grupoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idgrupo ".
				 " inner join ".
				 $this->dbprexis . $categoriaDao->tabelaAlias () .
				 " on ".
				 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
				 " where " .  $grupoDao->getalias() . ".nome  = ? ";
			$this->con->setTexto( 1, Util::getNomeObjeto($grupo) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaGrupoDAO findByNomeGrupo getsql", $this->con->getsql() );
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
		$this->results = new CategoriaGrupoBean ();
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
	
	public function deleteGrupo($bean) {
		$this->results = new CategoriaGrupoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idgrupo = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getgrupo ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaGrupoDAO deleteGrupo getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteCategoriaGrupo($bean) {
		
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idgrupo = ? and ".
			" idcategoria = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getgrupo ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getcategoria ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaGrupoDAO deleteGrupo getsql", $this->con->getsql() );
			
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