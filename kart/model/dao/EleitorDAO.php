<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PessoaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EleitorCategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/GrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';

class EleitorDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "eleitor";
	protected $tabela = "eleitor";
	protected $idtabela = "ideleitor";
	protected $campos = array (
			"idpessoa",
			"ideleitor" 
	);
	protected $ordernome = "eleitor.ideleitor";
	
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new EleitorBean ();
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
			Util::echobr ( 0, "EleitorDAO update", $this->con->getsql () );
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
			Util::echobr ( 0, 'EleitorDAO insert $usuarioLoginBean', $usuarioLoginBean );
				
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
			Util::echobr ( 0, "EleitorDAO insert", $this->con->getsql () );
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
		$this->bean = new EleitorBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "ideleitor", null ) );
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
		$eleitorcategoriagrupoDao = new EleitorCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
		try {
			$query = " SELECT distinct " . 
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () . 
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					
					" inner join " . 
					$this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
					
					" left join " .
					$this->dbprexis . $eleitorcategoriagrupoDao->tabelaAlias () .
					" on ".	$eleitorcategoriagrupoDao->getalias() . ".idEleitor = ".$this->idtabelaAlias () .
					
					" left join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ". $eleitorcategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					
					" left join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".	$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					
					" where " .	$grupoDao->getalias () . ".idcampeonato = ? " .
					" ORDER BY " . $pessoaDAO->getalias ().".nome  ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'EleitorDAO findByCampeoanto getsql', $this->con->getsql () );
				
			
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
			Util::echobr ( 0, "EleitorDAO findAllSort", $this->con->getsql () );
				
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
		$this->results = new EleitorBean ();
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
			Util::echobr ( 0, "EleitorDAO findById", $this->con->getsql () );
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
		$this->results = new EleitorBean ();
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
			Util::echobr ( 0, "EleitorDAO findByCPF", $this->con->getsql () );
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
		$this->results = new EleitorBean ();
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
			Util::echobr ( 0, "EleitorDAO findByIdPessoa", $this->con->getsql () );
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
		$this->results = new EleitorBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		$eleitorcategoriagrupoDAO = new EleitorCategoriaGrupoDAO( $this->con );
		$categoriagrupoDAO = new CategoriaGrupoDAO( $this->con );
		$categoriaDAO = new CategoriaDAO( $this->con );
		try {
			$query = " SELECT distinct " .
					$pessoaDAO->camposSelect () . " , " .
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .
					" inner join " . $this->dbprexis . $eleitorcategoriagrupoDAO->tabelaAlias () .
					" on " . $eleitorcategoriagrupoDAO->getalias () . ".ideleitor " . " = " . $this->idtabelaAlias ().
					" inner join " . $this->dbprexis . $categoriagrupoDAO->tabelaAlias () .
					" on " . $categoriagrupoDAO->idtabelaAlias () . " = " . $eleitorcategoriagrupoDAO->getalias () . ".idcategoriagrupo " .
					" inner join " . $this->dbprexis . $categoriaDAO->tabelaAlias () .
					" on " . $categoriaDAO->idtabelaAlias () . " = " . $categoriagrupoDAO->getalias () . ".idcategoria " .
					" where " . $this->getalias () . ".idpessoa = ? " .
					" and  " . $categoriaDAO->getalias () . ".idcampeonato = ? " .
					" ORDER BY " . $this->ordernome;
			$this->con->setTexto ( 1, Util::getIdObjeto($pessoa) );
			$this->con->setTexto ( 2, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EleitorDAO findByIdPessoa", $this->con->getsql () );
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
		$eleitorcategoriagrupoDao = new EleitorCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $eleitorcategoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias() . ".idEleitor = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "EleitorDAO totalByCampeonato getsql", $this->con->getsql() );
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
		$eleitorcategoriagrupoDao = new EleitorCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count( distinct " . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $eleitorcategoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias() . ".idEleitor = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->getalias () . ".idcampeonato = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "EleitorDAO totalEleitoresByCampeonato getsql", $this->con->getsql() );
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
		$eleitorcategoriagrupoDao = new EleitorCategoriaGrupoDAO($this->con);
		$categoriagrupoDao = new CategoriaGrupoDAO($this->con);
		$grupoDao = new GrupoDAO($this->con);
	
		try {
			$query = " SELECT count(" . $this->idtabelaAlias () . ") total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join " .
					$this->dbprexis . $eleitorcategoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias() . ".ideleitor = ".$this->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $categoriagrupoDao->tabelaAlias () .
					" on ".
					$eleitorcategoriagrupoDao->getalias () . ".idCategoriaGrupo = ".$categoriagrupoDao->idtabelaAlias () .
					" inner join " .
					$this->dbprexis . $grupoDao->tabelaAlias () .
					" on ".
					$categoriagrupoDao->getalias () . ".idGrupo = ".$grupoDao->idtabelaAlias () .
					" where " .
					$grupoDao->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($grupo)  );
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			Util::echobr (0, "EleitorDAO totalByGrupo getsql", $this->con->getsql() );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	
	public function delete($bean) {
		$this->results = new EleitorBean ();
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