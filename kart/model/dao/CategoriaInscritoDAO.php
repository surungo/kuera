<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once  'InscritoDAO.php';
include_once  'CategoriaDAO.php';
include_once  'CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
class CategoriaInscritoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "categoriainscrito";
	protected $tabela = "categoriainscrito";
	protected $idtabela = "idcategoriainscrito";
	protected $campos = array (
			"idinscrito",
			"idcategoria",
			"nome",
			"valor",
			"idcategoriainscrito" 
	);
	protected $ordernome = "categoriainscrito.idcategoriainscrito";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	
	public function update($bean) {
		
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
			" idinscrito = ? , ".
			" idcategoria = ? ,".
			" nome = ? ,".
			" valor = ?  ".
			" WHERE " . $this->idtabela () . " =  ? ";
			$this->con->clearlistparametros();
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setNumero (	 4,  Util::getIdObjeto ($bean->getinscrito ()) );
			$this->con->setNumero (	 5,  Util::getIdObjeto ($bean->getcategoria ()) );
			$this->con->setTexto (	 6,  $bean->getnome() );
			$this->con->setTexto (	 7,  $bean->getvalor() );
			$this->con->setNumero (  8, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr (0, "CandidatoDAO update", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
			$this->returnDataBaseBean->setsucesso( $this->con->affected_rows() > 0 );
		} catch ( Exception $e ) {
			
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
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
			" idinscrito, " . 
			" idcategoria, " . 
			" nome, " . 
			" valor, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
            " ?, " .      /* dtinicio,*/ 
            " ?, " . 			// idinscrito,
			" ?, " . 			// idcategoria,
			" ?, " . 			// nome,
			" ?, " . 			// valor,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->getinscrito ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getcategoria ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getcategoria ()) );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setTexto ( 7, $bean->getvalor () );
			$this->con->setNumero ( 8, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'CategoriaInscritoDAO insert', $this->con->getsql ( ) );
				
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
		$this->bean = new CategoriaInscritoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idcategoriainscrito", null ) );
		$this->bean->setinscrito ( $this->getValorArray ( $array, "idinscrito", new InscritoDAO($this->con) ) );
		$this->bean->setcategoria ( $this->getValorArray ( $array, "idcategoria", new CategoriaDAO($this->con) ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
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
			Util::echobr ( 0, "CategoriaInscritoDAO findAllAtivo", $this->con->getsql () );
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
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$inscritoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $inscritoDao->tabelaAlias () .	
			 " on ".
			 $inscritoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idinscrito ".
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
	public function findAtivosByCampeonato($campeonato) {
	    $inscritoDao = new InscritoDAO($this->con);
	    $categoriaDao = new CategoriaDAO($this->con);
	    return $this->findAtivosByCampeonatoSort($campeonato,$categoriaDao->getalias() . ".nome, ".
	        $inscritoDao->getalias() . ".peso, ".
	        $inscritoDao->getalias() . ".nrinscrito ");
	}
	    
	public function findAtivosByCampeonatoSort($campeonato,$sort) {
	    $this->clt = array ();
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
	
		try {
			$query = " SELECT " .
					$inscritoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
					$this->dbprexis . $inscritoDao->tabelaAlias () .
					" on ".
					$inscritoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idinscrito ".
					" left join ".
					$this->dbprexis . $categoriaDao->tabelaAlias () .
					" on ".
					$categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
					" where " .
					$this->whereAtivo() . " and ".
					$inscritoDao->getalias() . ".idcampeonato = ?  ".
					" ORDER BY " .$sort;
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			
			Util::echobr (0, "CategotiaInscrito findAtivosByCampeonato query", $this->con->getsql() );
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
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
	
		try {
			$query = " SELECT " .
				$inscritoDao->camposSelect () ." , ".
				$categoriaDao->camposSelect () ." , ".
				$this->camposSelect () .
				" FROM " . $this->dbprexis . $this->tabelaAlias () .
				" inner join ".
				 $this->dbprexis . $inscritoDao->tabelaAlias () .
				 " on ".
				 $inscritoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idinscrito ".
				 " left join ".
				 $this->dbprexis . $categoriaDao->tabelaAlias () .
				 " on ".
				 $categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
				 " where " .
				 $inscritoDao->getalias() . ".idcampeonato = ?  ".
				 " ORDER BY " . $this->ordernome;
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr (0, "CategotiaInscrito query", $this->con->getsql() );
			$result = $this->con->execute ();
				
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function findAtivosByCampeonatoPagos($campeonato) {
	    $inscritoDao = new InscritoDAO($this->con);
	    $categoriaDao = new CategoriaDAO($this->con);
	    $campeonatoDao = new CampeonatoDAO($this->con);
	    return $this->findAtivosByCampeonatoPagosSort($campeonato, $categoriaDao->getalias() . ".nome, ".
	        $inscritoDao->getalias() . ".peso, ".
	        $inscritoDao->getalias() . ".nrinscrito ");
	}
	
    public function findAtivosByCampeonatoPagosSort($campeonato, $sort) {
	    $this->clt = array ();
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$campeonatoDao = new CampeonatoDAO($this->con);
	
		try {
			$query = " SELECT " .
					$inscritoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$campeonatoDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
					$this->dbprexis . $inscritoDao->tabelaAlias () .
					" on ".
					$inscritoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idinscrito ".
					" inner join ".
					$this->dbprexis . $categoriaDao->tabelaAlias () .
					" on ".
					$categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
					" inner join ".
					$this->dbprexis . $campeonatoDao->tabelaAlias () .
					" on ".
					$campeonatoDao->idtabelaAlias()	. " = "	. $inscritoDao->getalias() . ".idcampeonato ".
					" where " .
					$this->whereAtivo() . " and ".
					$inscritoDao->getalias() . ".idcampeonato = ?  ".
					" and ".$inscritoDao->getalias() . ".situacao = 'Pago'  ".
					" ORDER BY " .$sort;
				
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr (0, "CategotiaInscrito query", $this->con->getsql() );
			$result = $this->con->execute ();
	
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	
	
	public function findByCampeonatoPagos($campeonato) {
		$this->clt = array ();
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$campeonatoDao = new CampeonatoDAO($this->con);
		
		try {
			$query = " SELECT " .
					$inscritoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$campeonatoDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
					$this->dbprexis . $inscritoDao->tabelaAlias () .
					" on ".
					$inscritoDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idinscrito ".
					" inner join ".
					$this->dbprexis . $categoriaDao->tabelaAlias () .
					" on ".
					$categoriaDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idcategoria ".
					" inner join ".
					$this->dbprexis . $campeonatoDao->tabelaAlias () .	
					" on ".
					$campeonatoDao->idtabelaAlias()	. " = "	. $inscritoDao->getalias() . ".idcampeonato ".
					" where " .
					$inscritoDao->getalias() . ".idcampeonato = ?  ".
					" and ".$inscritoDao->getalias() . ".situacao = 'Pago'  ".
					" ORDER BY " .$categoriaDao->getalias() . ".nome, ". $inscritoDao->getalias() . ".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($campeonato) );
			$this->con->setsql ( $query );
			Util::echobr (0, "CategotiaInscrito query", $this->con->getsql() );
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
	public function findById($bean) {
		$dbg=0;
		$this->results = new CategoriaInscritoBean ();
		
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		$campeonatoDao = new CampeonatoDAO($this->con);
		try {
			$query = " SELECT " . 
			$inscritoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$campeonatoDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join ".
			 $this->dbprexis . $inscritoDao->tabelaAlias () .	
			 " on ".
			 $inscritoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idinscrito ".
			" inner join ".
			 $this->dbprexis . $categoriaDao->tabelaAlias () .	
			 " on ".
			 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
			" inner join ".
			 $this->dbprexis . $campeonatoDao->tabelaAlias () .	
			 " on ".
			 $campeonatoDao->idtabelaAlias()	. " = "	. $inscritoDao->getalias() . ".idcampeonato ".
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			Util::echobr($dbg,'Categoria inscrito ', $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByInscrito($inscrito) {
		$this->clt = array ();
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
		
		try {
			$query = " SELECT " . 
			$inscritoDao->camposSelect () ." , ".
			$categoriaDao->camposSelect () ." , ".
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" inner join ".
			 $this->dbprexis . $inscritoDao->tabelaAlias () .	
			 " on ".
			 $inscritoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idinscrito ".
			" inner join ".
			 $this->dbprexis . $categoriaDao->tabelaAlias () .	
			 " on ".
			 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
			" where " .  $this->getalias() . ".idinscrito  = ? ".
			" order by ". $categoriaDao->getalias() . ".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($inscrito) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaInscritoDAO findByInscrito getsql", $this->con->getsql() );

			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function isCategoriaInscrito($bean) {
		$retorno = false;
			try {
			$query = " SELECT count(*) total".
				" FROM " . $this->dbprexis . $this->tabelaAlias () .
				" where " .  $this->getalias() . ".idinscrito  = ? ".
				" and " .  $this->getalias() . ".idcategoria  = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getinscrito()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getcategoria()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaInscritoDAO isCategoriaInscrito getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			if ( $array = $result->fetch_assoc () ) {
				$retorno = $array['total']>0;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $retorno;
	}
	
	
	
	public function findByNomeInscrito($inscrito) {
		$this->clt = array ();
		$inscritoDao = new InscritoDAO($this->con);
		$categoriaDao = new CategoriaDAO($this->con);
	
		try {
			$query = " SELECT " .
					$inscritoDao->camposSelect () ." , ".
					$categoriaDao->camposSelect () ." , ".
					$this->camposSelect () .
					" FROM " . $this->dbprexis . $this->tabelaAlias () .
					" inner join ".
				 $this->dbprexis . $inscritoDao->tabelaAlias () .
				 " on ".
				 $inscritoDao->idtabelaAlias ()	. " = "	. $this->getalias() . ".idinscrito ".
				 " inner join ".
				 $this->dbprexis . $categoriaDao->tabelaAlias () .
				 " on ".
				 $categoriaDao->idtabelaAlias()	. " = "	. $this->getalias() . ".idcategoria ".
				 " where " .  $inscritoDao->getalias() . ".nome  = ? ";
			$this->con->setTexto( 1, Util::getNomeObjeto($inscrito) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaInscritoDAO findByNomeInscrito getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->clt;
	}
	
	public function desativar($bean) {
		$this->results = new InscritoBean ();
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
			Util::echobr ( 0, "InscritoDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
		
	public function delete($bean) {
		$this->results = new CategoriaInscritoBean ();
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
	
	public function deleteInscrito($bean) {
		$this->results = new CategoriaInscritoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idinscrito = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getinscrito ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaInscritoDAO deleteInscrito getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteCategoriaInscrito($bean) {
		$this->returnDataBaseBean;
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idinscrito = ? and ".
			" idcategoria = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getinscrito ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getcategoria ()) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaInscritoDAO deleteInscrito getsql", $this->con->getsql() );
			
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