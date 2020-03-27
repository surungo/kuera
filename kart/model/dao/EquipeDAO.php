<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once 'CategoriaDAO.php';
include_once 'InscritoDAO.php';
include_once 'InscritoEquipeDAO.php';
include_once 'CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
class EquipeDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "equipe";
	protected $tabela = "equipe";
	protected $idtabela = "idequipe";
	protected $campos = array (
			"idcampeonato",
			"sigla",
			"nome",
			"codigoacesso",
			"campoaux",
			"valor",
			"situacao",
			"dtpagamento",
			"nrinscrito",
			"idcategoria",
			"idinscritolider",
			"idequipe" 
	);
	protected $ordernome = "equipe.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new EquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . 			//
			" dtmodificacao = now(), " . 			//
			" modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idcampeonato = ? , " . 			// 4
			" sigla = ? , " . 			// 5
			" nome = updateacentos( ? ) , " . 			// 6
			" codigoacesso = ? , " . 			// 7
			" campoaux = ? , " . 			// 8
			" valor = ? , " . 			// 9
			" situacao = updateacentos( ? ) , " . 			// 10
			" dtpagamento = ? , " . 			// 11
			" nrinscrito = ? , " . 			// 12
			" idcategoria = ? , " . 			// 13
			" idinscritolider = ?  " . 			// 14
			" WHERE " . $this->idtabela () . " =  ? "; // 15
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setTexto ( 7, $bean->getcodigoacesso () );
			$this->con->setTexto ( 8, $bean->getcampoaux () );
			$this->con->setTexto ( 9, $bean->getvalor () );
			$this->con->setTexto ( 10, $bean->getsituacao () );
			$this->con->setData ( 11, $bean->getdtpagamento () );
			$this->con->setNumero ( 12, $bean->getnrinscrito () );
			$this->con->setNumero ( 13,  Util::getIdObjeto ($bean->getcategoria ()) );
			$this->con->setNumero ( 14,  Util::getIdObjeto ($bean->getinscritolider ()) );
			$this->con->setNumero ( 15, $bean->getid () );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO update", $this->con->getsql () );
				
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 			//
			" ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . 			//
			" idcampeonato , " . 			//
			" sigla , " . 			//
			" nome , " . 			//
			" codigoacesso , " . 			//
			" campoaux , " . 			//
			" valor , " . 			//
			" situacao , " . 			//
			" dtpagamento , " . 			//
			" nrinscrito, " . 
			" idcategoria, " . 
			" idinscritolider, " . $this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// idcampeonato
			" ? , " . 			// sigla
			" updateacentos(?) , " . 			// nome
			" ? , " . 			// codigoacesso
			" ? , " . 			// campoaux
			" ? , " . 			// valor
			" updateacentos(?) , " . 			// situacao
			" ? , " . 			// dtpagamento
			" ? , " . 			// nrinscrito,
			" ? , " . 			// idcategoria,
			" ? , " . 			// idinscritolider,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getsigla () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setTexto ( 7, $bean->getcodigoacesso () );
			$this->con->setTexto ( 8, $bean->getcampoaux () );
			$this->con->setTexto ( 9, $bean->getvalor () );
			$this->con->setTexto ( 10, $bean->getsituacao () );
			$this->con->setData ( 11, $bean->getdtpagamento () );
			$this->con->setNumero ( 12, $bean->getnrinscrito () );
			$this->con->setNumero ( 13, $bean->getcategoria () );
			$this->con->setNumero ( 14, $bean->getinscritolider () );
			$this->con->setNumero ( 15, $bean->getid () );
			
			$this->con->setsql ( $query );
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
		$this->bean = new EquipeBean ();
		$this->bean->setid ( $this->getValorArray ( $array, $this->idtabela (), null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setcodigoacesso ( $this->getValorArray ( $array, "codigoacesso", null ) );
		$this->bean->setcampoaux ( $this->getValorArray ( $array, "campoaux", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		$this->bean->setsituacao ( $this->getValorArray ( $array, "situacao", null ) );
		$this->bean->setdtpagamento ( $this->getValorArray ( $array, "dtpagamento", null ) );
		$this->bean->setnrinscrito ( $this->getValorArray ( $array, "nrinscrito", null ) );
		$this->bean->setcategoria ( $this->getValorArray ( $array, "idcategoria", new CategoriaDAO ( $this->con ) ) );
		$this->bean->setinscritolider ( $this->getValorArray ( $array, "idinscritolider", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO findAll", $this->con->getsql () );
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
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO findAllAtivo", $this->con->getsql () );
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

	public function findByNome($bean) {
		$this->results = new EquipeBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . 
			" upper(" . $this->getalias () . ".nome ) = upper(?) ".
			" and " . $this->getalias () . ".idcampeonato = ? ";
			$this->con->setTexto ( 1, Util::getNomeObjeto ( $bean ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getcampeonato() ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO findByNome", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByLider($bean) {
		$this->results = new EquipeBean ();
		$inscritoEquipeDao = new InscritoEquipeDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$inscritoEquipeDao->camposSelect () .", ".
			$this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join " .
			$this->dbprexis . $inscritoEquipeDao->tabelaAlias () .
			" on ".
			$inscritoEquipeDao->getalias().".idequipe = ".$this->idtabelaAlias().
			" where " .
			$this->idtabelaAlias()." = ? ".
			" and " . $this->getalias () . ".idcampeonato = ? ".
			" and " . $inscritoEquipeDao->getalias().".idinscrito = ".$this->getalias().".idinscritolider ";
			$this->con->setTexto ( 1, Util::getIdObjeto ( $bean ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getcampeonato() ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO findByLider", $this->con->getsql () );
				
			$result = $this->con->execute ();
				
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
				$this->results->setinscritolider($array[$this->getValorArray ( $array, "idinscrito", new InscritoDAO( $this->con ) )]);
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	public function findById($equipe) {
		$dbg = 0;
		$this->results = new EquipeBean ();
		$categoriaDAO = new CategoriaDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$categoriaDAO->camposSelect () .", ".
			$campeonatoDAO->camposSelect () .", ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" left join ". $this->dbprexis . $categoriaDAO->tabelaAlias () .
			" on ". $categoriaDAO->idtabelaAlias() ." = ".$this->getalias().".idcategoria ".
			" left join ". $this->dbprexis . $campeonatoDAO->tabelaAlias () .
			" on ". $campeonatoDAO->idtabelaAlias() ." = ".$this->getalias().".idcampeonato ".
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe ) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "EquipeDAO findById", $this->con->getsql () );
				
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function totalPagoCampeonato($equipe) {
		$dbg = 0;
		$this->results = 0;
		$categoriaDAO = new CategoriaDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " .
					" count(*) total " .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" left join ". $this->dbprexis . $categoriaDAO->tabelaAlias () .
					" on ". $categoriaDAO->idtabelaAlias() ." = ".$this->getalias().".idcategoria ".
					" inner join ". $this->dbprexis . $campeonatoDAO->tabelaAlias () .
					" on ". $campeonatoDAO->idtabelaAlias() ." = ".$this->getalias().".idcampeonato ".
					" where " . $this->getalias().".idcampeonato = ? ".
					" and ". $this->getalias().".situacao = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe->getcampeonato() ) );
			$this->con->setTexto  ( 2, $equipe->getsituacao() );
			
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "EquipeDAO findById", $this->con->getsql () );
	
			$result = $this->con->execute ();
				
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function findByCodigoAcesso($codigoacesso) {
		$dbg = 0;
		$this->results = new EquipeBean ();
		$categoriaDAO = new CategoriaDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " .
			$categoriaDAO->camposSelect () .", ".
			$campeonatoDAO->camposSelect () .", ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" left join ". $this->dbprexis . $categoriaDAO->tabelaAlias () .
			" on ". $categoriaDAO->idtabelaAlias() ." = ".$this->getalias().".idcategoria ".
			" inner join ". $this->dbprexis . $campeonatoDAO->tabelaAlias () .
			" on ". $campeonatoDAO->idtabelaAlias() ." = ".$this->getalias().".idcampeonato ".
			" where " . $this->getalias () . ".codigoacesso = ? ";
			$this->con->setTexto ( 1, $codigoacesso );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "EquipeDAO findByCodigoAcesso", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	
	}
	
	public function findByCPFcampeonato($cpfBusca,$idcampeonato){
		$dbg=0;
		$this->clt = array ();
		try {
			$query = 
			" SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " .
			$this->whereAtivo () .
			" and " . $this->getalias () . ".campoaux = ? " .
			" and " . $this->getalias () . ".idcampeonato = ? " . 
			" ORDER BY " . $this->ordernome;
			
			$this->con->setTexto ( 1, $cpfBusca );
			$this->con->setNumero ( 2, $idcampeonato );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "EquipeDAO findByCPFcampeonato", $this->con->getsql () );
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
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", 
					" . $campeonatoDAO->camposSelect () . 
					" FROM " . 
					$this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . 
					$this->dbprexis . $this->tabelaAlias () . 
					" where " . $this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
					" and " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " .
  				//" ORDER BY " . $this->ordernome;
  				" ORDER BY " .  $this->getalias () . ".nrinscrito ";
			// echo $query;
			$this->con->setNumero ( 1, Util::getIdObjeto ($campeonato) );
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
	public function findByNrInscrito($nrinscrito, $campeonato) {
		$this->results = new EquipeBean ();
		
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".nrinscrito = ? and " . $this->getalias () . ".idcampeonato = ? and " . $this->whereAtivo ();
			
			$this->con->setNumero ( 1, $nrinscrito );
			$this->con->setNumero ( 2, $campeonato );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO findByNrInscrito", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function getNovoNrInscrito($campeoanto) {
		$this->results = null;
		try {
			$query = " select min(u.nr) nr " . "	from  " . "		( " . "		select count(*)+1 nr " . "		from " . "			kart_equipe total " . "		where " . "			total.idcampeonato = ? " . "			and total.nrinscrito > 0 " . "		union " . "		select min( xc.rank) nr " . "		from " . "		(	SELECT t.*, " . "				   @rownum := @rownum + 1 AS rank " . "			  FROM kart_equipe t, " . "				   (SELECT @rownum := 0) r " . "			where " . "				t.idcampeonato = ? " . "			and t.nrinscrito > 0 " . "			order by t.nrinscrito) xc " . "		where " . "			xc.nrinscrito != xc.rank " . "		) u ";
			
			$this->con->setNumero ( 1, $campeoanto );
			$this->con->setNumero ( 2, $campeoanto );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO getNovoNrInscrito", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['nr'];
			}
			Util::echobr ( 0, "InscritoDAO getNovoNrInscrito result", $this->results );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function getIdMinEquipe($bean) {
		$this->results = null;
		$inscritoEquipeDao = new InscritoEquipeDAO ( $this->con );
		$inscritoDao = new InscritoDAO ( $this->con );
		try {
			$query = " select min(inscrito.idinscrito) idinscrito " . 
				"	from  " .
				$this->dbprexis . $this->tabelaAlias (). 
				" inner join ".
				$this->dbprexis . $inscritoEquipeDao->tabelaAlias ().
				" on  ".
				$this->idtabelaAlias()." = " .	$inscritoEquipeDao->getalias().".idequipe ".
				" inner join ".
				$this->dbprexis . $inscritoDao->tabelaAlias ().
				" on  ".
				$inscritoEquipeDao->getalias().".idinscrito = " .	$inscritoDao->idtabelaAlias().
				" where ". 
				$this->idtabelaAlias()." = ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO setOutroAdm", $this->con->getsql () );
				
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['idinscrito'];
			}
			Util::echobr ( 0, "InscritoDAO getNovoNrInscrito result", $this->results );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function findBySigla($sigla) {
		$this->results = new EquipeBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".sigla  = ? ";
			$this->con->setTexto ( 1, $sigla );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'EquipeDAO findBySigla getsql', $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function atual() {
		$this->results = new EquipeBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".dtinicio <= now() and " . $this->getalias () . ".dtvalidade >= now() " . " order by " . $this->getalias () . ".dtinicio desc ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO atual", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function delete($bean) {
		$this->results = new EquipeBean ();
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
	
	public function desativar($bean) {
		$this->results = new EquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " .
				 $this->dbprexis . $this->tabela () .
				 " SET " .
				 " dtmodificacao = now(), " .
				 " modificador = ? ,  " .
				 " dtvalidade = now()  " .
				 " WHERE " . $this->idtabela () . " =  ? ";

			$this->con->setTexto  ( 1, $usuarioLoginBean->getusuario() );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}

	public function ativar($bean) {
		$this->results = new EquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " .
				 $this->dbprexis . $this->tabela () .
				 " SET " .
				 " dtmodificacao = now(), " .
				 " modificador = ? ,  " .
				 " dtvalidade = null  " .
				 " WHERE " . $this->idtabela () . " =  ? ";

			$this->con->setTexto  ( 1, $usuarioLoginBean->getusuario() );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "EquipeDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}

}

?>