<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PessoaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CandidatoCategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/GrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';

class CandidatoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "candidato";
	protected $tabela = "candidato";
	protected $idtabela = "idcandidato";
	protected $campos = array (
			"idpessoa",
			"idcandidato" 
	);
	protected $ordernome = "candidato.idcandidato";
	
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new CandidatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . 
			" dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" idpessoa = ? " . 
			" WHERE " . $this->idtabela () . " =  ? ";
			$this->con->clearlistparametros();
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setNumero (	 4,  Util::getIdObjeto ($bean->getpessoa ()) );
			$this->con->setNumero (  5, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO update", $this->con->getsql () );
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
			if ($usuarioLoginBean != null) {
				$bean->setcriador ( $usuarioLoginBean->getusuario () );
			}
			Util::echobr ( 0, 'CandidatoDAO insert $usuarioLoginBean', $usuarioLoginBean );
			
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 
			" ( " . " dtcriacao, " .
			" criador, " . 
			" dtvalidade, " . 
			" dtinicio, " . 
			" idpessoa, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio
			" ?, " . 			// idpessoa,
			" ? )"; // id;
			$this->con->clearlistparametros();
			$this->con->setTexto (	 1, $bean->getcriador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setNumero (	 4,  Util::getIdObjeto ($bean->getpessoa ()) );
			$this->con->setNumero (  5, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO insert", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$this->bean = new CandidatoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idcandidato", null ) );
		$this->bean->setpessoa ( $this->getValorArray ( $array, "idpessoa", new PessoaDAO ( $this->con ) ) );
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padrão
	public function findAll() {
		$this->clt = array ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$pessoaDAO->camposSelect () . " , " .
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
			" ORDER BY " . $pessoaDAO->ordernome;
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
	
	public function findByCampeonato($campeonato) {
		$this->clt = array ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		$candidatocategoriagrupoDao = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		try {
			$query = " SELECT distinct " .
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					
					" inner join " . 
					$this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa ".
					
					" left join " . 
					$this->dbprexis . $candidatocategoriagrupoDao->tabelaAlias () .
					" on ".	$candidatocategoriagrupoDao->getalias() . ".idCandidato = ".$this->idtabelaAlias () .
					
					" left join " . 
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".	$candidatocategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					
					" left join " . 
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".	$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					
					" where " . $grupoDao->getalias () . ".idcampeonato = ? " .
					" ORDER BY " . $pessoaDAO->getalias ().".nome  ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'CandidatoDAO findByCampeoanto getsql', $this->con->getsql () );
				
			
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
		$pessoaDAO = new PessoaDAO ( $this->con );
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . 
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () . 
					" FROM " . $this->dbprexis . $this->tabelaAlias () . 
					" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
					" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO findAllSort", $this->con->getsql () );
			
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
		$this->results = new CandidatoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$pessoaDAO->camposSelect () . " , " .
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO findById", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPF($cpf) {
		$this->results = new CandidatoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$pessoaDAO->camposSelect () . " , " .
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
			" where " . $pessoaDAO->getalias () . ".cpf = ? " . 
			" ORDER BY " . $pessoaDAO->ordernome;
			$this->con->setTexto ( 1, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO findByCPF", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByPessoa($pessoa) {
		$this->results = new CandidatoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		try {
			$query = " SELECT " .
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
					" where " . $this->getalias () . ".idpessoa = ? " .
					" ORDER BY " . $this->ordernome;
			$this->con->setTexto ( 1, Util::getIdObjeto($pessoa) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO findByIdPessoa", $this->con->getsql () );
			$result = $this->con->execute ();
	
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}

	public function findByPessoaCampeonato($pessoa,$campeonato) {
		$this->results = new CandidatoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		$candidatocategoriagrupoDAO = new CandidatoCategoriaGrupoDAO( $this->con );
		$categoriagrupoDAO = new CategoriaGrupoDAO( $this->con );
		$categoriaDAO = new CategoriaDAO( $this->con );
		try {
			$query = " SELECT distinct " .
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
					" inner join " . $this->dbprexis . $candidatocategoriagrupoDAO->tabelaAlias () .
					" on " . $candidatocategoriagrupoDAO->getalias () . ".idcandidato " . " = " . $this->idtabelaAlias ().
					" inner join " . $this->dbprexis . $categoriagrupoDAO->tabelaAlias () .
					" on " . $categoriagrupoDAO->idtabelaAlias () . " = " . $candidatocategoriagrupoDAO->getalias () . ".idcategoriagrupo " .
					" inner join " . $this->dbprexis . $categoriaDAO->tabelaAlias () .
					" on " . $categoriaDAO->idtabelaAlias () . " = " . $categoriagrupoDAO->getalias () . ".idcategoria " .
					" where " . $this->getalias () . ".idpessoa = ? " .
					" and  " . $categoriaDAO->getalias () . ".idcampeonato = ? " .
					" ORDER BY " . $this->ordernome;
			$this->con->setTexto ( 1, Util::getIdObjeto($pessoa) );
			$this->con->setTexto ( 2, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CandidatoDAO findByIdPessoa", $this->con->getsql () );
			$result = $this->con->execute ();
	
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}	
	
	public function totalByCampeonato($campeonato) {
		$this->results = 0;
		$candidatocategoriagrupoDao = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $candidatocategoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias() . ".idCandidato = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "CandidatoDAO totalByCampeonato getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function totalCandidatosByCampeonato($campeonato) {
		$this->results = 0;
		$candidatocategoriagrupoDao = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count( distinct " . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $candidatocategoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias() . ".idCandidato = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "CandidatoDAO totalCandidatosByCampeonato getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function totalByGrupo($grupo) {
		$this->results = 0;
		$candidatocategoriagrupoDao = new CandidatoCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $candidatocategoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias() . ".idcandidato = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$candidatocategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($grupo)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "CandidatoDAO totalByGrupo getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}

		
	public function delete($bean) {
		$this->results = new CandidatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . 
			" FROM " . $this->dbprexis . $this->tabela () . 
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
}

?>