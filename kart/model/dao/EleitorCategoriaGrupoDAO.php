<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once  'PessoaDAO.php';
include_once  'EleitorDAO.php';
include_once  'CategoriaGrupoDAO.php';
include_once  'CategoriaDAO.php';
include_once  'GrupoDAO.php';
include_once  'VotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';
class EleitorCategoriaGrupoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "eleitorcategoriagrupo";
	protected $tabela = "eleitorcategoriagrupo";
	protected $idtabela = "ideleitorcategoriagrupo";
	protected $campos = array (
			"ideleitor",
			"idcategoriagrupo",
			"ideleitorcategoriagrupo" 
	);
	protected $ordernome = "eleitorcategoriagrupo.ideleitorcategoriagrupo";
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
			" ideleitor, " . 
			" idcategoriagrupo, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
            " ?, " .      /* dtinicio,*/ 
            " ?, " . 			// ideleitor,
			" ?, " . 			// idcategoriagrupo,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->geteleitor ()) );
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
		$this->bean = new EleitorCategoriaGrupoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "ideleitorcategoriagrupo", null ) );
		$this->bean->seteleitor ( $this->getValorArray ( $array, "ideleitor", new EleitorDAO($this->con) ) );
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
			Util::echobr ( 0, "EleitorCategoriaGrupoDAO findAllAtivo", $this->con->getsql () );
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
		$eleitorDao = new EleitorDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $eleitorDao->tabelaAlias () .	
			 " on ".
			 $eleitorDao->idtabela ()	. " = "	. $this->getalias() . ".ideleitor ".
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
		$this->results = new EleitorCategoriaGrupoBean ();
		$eleitorDao = new EleitorDAO($this->con);
		$pessoaDao = new PessoaDAO($this->con);
		try {
			$query = " SELECT " . 
			$eleitorDao->camposSelect () ." , ".
			$pessoaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join ".
			$this->dbprexis . $eleitorDao->tabelaAlias () .	
			" on ".
			$eleitorDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".ideleitor ".
			" inner join ".
			$this->dbprexis . $pessoaDao->tabelaAlias () .
			" on ".
			$pessoaDao->idtabelaAlias()	. " = "	. $eleitorDao->getalias() . ".idpessoa ".
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
	
	public function findByEleitorEvento($eleitor,$evento) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$eleitorDao = new EleitorDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorDao->camposSelect () ." , ".
			$pessoaDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$grupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			$this->dbprexis . $eleitorDao->tabelaAlias () .	
			" on ".
			$eleitorDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".ideleitor ".
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
			$pessoaDao->idtabelaAlias()	. " = "	. $eleitorDao->getalias() . ".idpessoa ".
			" where " .
			"  IFNULL(" . $grupoDao->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " .
			 " and IFNULL(" . $grupoDao->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND ".
			
			" and " . $this->getalias() . ".ideleitor  = ?  ".
			" and " . $grupoDao->getalias() . ".idcampeonato  = ?  ".
			" order by ". $grupoDao->getalias( ). ".nome ";

			$this->con->setNumero ( 1, Util::getIdObjeto($eleitor) );
			$this->con->setNumero ( 2, Util::getIdObjeto($evento) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EleitorCategoriaGrupoDAO findByEleitor getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findByEleitor($eleitor) {
		$this->clt = array ();
		$pessoaDao = new PessoaDAO($this->con);
		$eleitorDao = new EleitorDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$eleitorDao->camposSelect () ." , ".
			$pessoaDao->camposSelect () ." , ".
			$categoriagrupoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$grupoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			$this->dbprexis . $eleitorDao->tabelaAlias () .	
			" on ".
			$eleitorDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".ideleitor ".
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
			$pessoaDao->idtabelaAlias()	. " = "	. $eleitorDao->getalias() . ".idpessoa ".
			" where " .
			"  IFNULL(" . $grupoDao->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " .
			 " and IFNULL(" . $grupoDao->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND ".
			
			" and " . $this->getalias() . ".ideleitor  = ?  ".
			" order by ". $grupoDao->getalias( ). ".nome ";
			$this->con->setNumero ( 1, Util::getIdObjeto($eleitor) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EleitorCategoriaGrupoDAO findByEleitor getsql", $this->con->getsql() );
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
		$this->results = new EleitorCategoriaGrupoBean ();
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
	public function deleteEleitor($bean) {
		$this->results = new EleitorCategoriaGrupoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE ideleitor = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->geteleitor()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EleitorCategoriaGrupoDAO deleteEleitor getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
		
	public function deleteEleitorCategoriaGrupo($bean) {
		$this->results = new EleitorCategoriaGrupoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
				
			$query = " DELETE " . " FROM " .
				 $this->dbprexis . $this->tabela () .
				" WHERE ideleitor = ? ". 
				" and idCategoriaGrupo = ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getEleitor ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getCategoriaGrupo ()) );
			
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EleitorCategoriaGrupoDAO deleteEleitor getsql", $this->con->getsql() );
				
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