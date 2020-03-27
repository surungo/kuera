<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoEquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/EquipeDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/InscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
class InscritoEquipeDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "inscritoequipe";
	protected $tabela = "inscritoequipe";
	protected $idtabela = "idinscritoequipe";
	protected $campos = array (
			"idequipe",
			"idinscrito",
			"idpiloto",
			"admin",
			"idinscritoequipe" 
	);
	protected $ordernome = "inscritoequipe.idinscritoequipe";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->con->setclasspai ( "InscritoEquipeDAO update" );
		$this->results = new InscritoEquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idequipe = ? , " . 			// 4
			" idinscrito = ? , " . 			// 5
			" idpiloto = ? , " . 			// 6
			" admin = ? " . 			// 7
			" WHERE " . $this->idtabela () . " =  ? "; // 8
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getequipe () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getinscrito () ) );
			$this->con->setNumero ( 6, Util::getIdObjeto ( $bean->getpiloto () ) );
			$this->con->setNumero ( 7, $bean->getadmin () );
			$this->con->setNumero ( 8, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO update", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function insert($bean) {
		$this->con->setclasspai ( "InscritoEquipeDAO insert" );
		try {
			$usuarioLoginBean = $this->setoperador ();
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 			//
			" ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . 			//
			" idequipe , " . 			//
			" idinscrito , " . 			//
			" idpiloto , " . 			//
			" admin , " . 			//
			$this->idtabela () . 			//
			" )values ( " . 			//
			" now(), " . 			// dtcriacao
			" ?, " . 			// criador
			" ?, " . 			// dtvalidade
			" ?, " . 			// dtinicio
			" ? , " . 			// idequipe
			" ? , " . 			// idinscrito
			" ? , " . 			// idpiloto
			" ? , " . 			// admin
			" ? )"; // id
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getequipe () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getinscrito () ) );
			$this->con->setNumero ( 6, Util::getIdObjeto ( $bean->getpiloto () ) );
			$this->con->setNumero ( 7, $bean->getadmin () );
			$this->con->setNumero ( 8, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO insert", $this->con->getsql () );
			
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
		$this->bean = new InscritoEquipeBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idinscritoequipe", null ) );
		$this->bean->setequipe ( $this->getValorArray ( $array, "idequipe", new EquipeDAO ( $this->con ) ) );
		$this->bean->setinscrito ( $this->getValorArray ( $array, "idinscrito", new InscritoDAO ( $this->con ) ) );
		$this->bean->setpiloto ( $this->getValorArray ( $array, "idpiloto", new PilotoDAO ( $this->con ) ) );
		$this->bean->setadmin ( $this->getValorArray ( $array, "admin", null ) );
		Util::echobr ( 0, 'InscritoEquipeDAO getBeans $bean', $this->bean );
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	
	
	public function findAllAtivo() {
		$this->con->setclasspai ( "InscritoEquipeDAO findAllAtivo" );
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findAllAtivo", $this->con->getsql () );
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
		$this->con->setclasspai ( "InscritoEquipeDAO findAll" );
		$this->clt = array ();
		$pilotoDAO = new PilotoDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " . $pilotoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $pilotoDAO->tabelaAlias () . ", " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . "       " . $campeonatoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idcampeonato " . "   and " . $pilotoDAO->idtabelaAlias () . " = " . $this->tabelaAlias () . ".idpiloto ";
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
		$this->con->setclasspai ( "InscritoEquipeDAO findAllSort" );
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" on  " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " or " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 

			" ORDER BY " . $this->ordernome;
			// echo $query;
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
		$this->con->setclasspai ( "InscritoEquipeDAO findById" );
		$this->results = new InscritoEquipeBean ();
		$inscritoDAO = new InscritoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		try {
			$query = " SELECT " . $inscritoDAO->camposSelect () . ", " . $equipeDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . " on " . $equipeDAO->idtabelaAlias () . " = " . $this->getalias () . ".idequipe " . " left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . " " . " on " . $inscritoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idinscrito " . " where " . $this->idtabelaAlias () . " = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $id ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findById", $this->con->getsql () );
			
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPFcampeonato($cpfBusca,$idcampeonato) {
		$this->con->setclasspai ( "InscritoEquipeDAO findByCPFcampeonato" );
		$this->clt = array ();
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . ", " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . " " . 
			" inner join " . $this->dbprexis . $equipeDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . 
			" inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . 
			" where " . $this->whereAtivo () . 
			" and ". $inscritoDAO->getalias () . ".cpf = ? ".
			" and ". $equipeDAO->getalias () . ".idcampeonato = ? ".
			" ORDER BY " .$equipeDAO->getalias () . ".nome";
			
			$this->con->setNumero ( 1, $cpfBusca );
			$this->con->setTexto ( 2, $idcampeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findByCPFcampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->clt;
	}
	
	public function totalInscritos($equipe) {
		$this->con->setclasspai ( "InscritoEquipeDAO findById" );
		$this->results = "";
		try {
			$query = " SELECT " . " count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->getalias () . ".idequipe = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO totalInscritos", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['total'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function validaRegra($equipe,$regra) {
		$dbg = 0;
		$this->con->setclasspai ( "InscritoEquipeDAO validaRegra" );
		$this->results = "";
		$inscritoDAO = new InscritoDAO ( $this->con );
		try {
			$query = 
			" SELECT 1 valido " . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on " . $inscritoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idinscrito " . 
			" where " . $this->getalias () . ".idequipe = ? " .
			" ".$regra;
				
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe ) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "InscritoEquipeDAO pesoMaxInscrito", $this->con->getsql () );
				
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['valido'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function pesoMaxInscrito($equipe) {
		$this->con->setclasspai ( "InscritoEquipeDAO findById" );
		$this->results = "";
		$inscritoDAO = new InscritoDAO ( $this->con );
		try {
			$query = " SELECT " . " max( " . $inscritoDAO->getalias () . ".peso ) maior " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . " " . " on " . $inscritoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idinscrito " . " where " . $this->getalias () . ".idequipe = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO pesoMaxInscrito", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['maior'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function pesoMinInscrito($equipe) {
		$this->con->setclasspai ( "InscritoEquipeDAO findById" );
		$this->results = "";
		$inscritoDAO = new InscritoDAO ( $this->con );
		try {
			$query = " SELECT " . " min( " . $inscritoDAO->getalias () . ".peso ) menor " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . " " . " on " . $inscritoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idinscrito " . " where " . $this->getalias () . ".idequipe = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $equipe ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO pesoMinInscrito", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['menor'];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findByCampeonato($campeonato) {
		$this->con->setclasspai ( "InscritoEquipeDAO findByCampeonato" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . 
			" FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" inner join " . $this->dbprexis . $equipeDAO->tabelaAlias () . 
			" on " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" inner join " . $this->dbprexis . $this->tabelaAlias () . 
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . 
			" and  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . 
			" where " . 
			$campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
			" ORDER BY " . $equipeDAO->getalias () . ".nrinscrito ";
			// " ORDER BY " . $equipeDAO->getalias().".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findByCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonatoRelatorio($campeonato,$situacao) {
		$this->con->setclasspai ( "InscritoEquipeDAO findByCampeonato" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$categoriaDAO = new CategoriaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$categoriaDAO->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" inner join " . $this->dbprexis . $equipeDAO->tabelaAlias () .
			" on " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .
			" left join " .$this->dbprexis . $categoriaDAO->tabelaAlias () .
			" on " . $equipeDAO->getalias () . ".idcategoria = " . $categoriaDAO->idtabelaAlias () .
			" and  " . $categoriaDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .
			" left join " . $this->dbprexis . $this->tabelaAlias () .
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () .
			" left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" and  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () .
			" where " . 
			$campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
			" and " . $equipeDAO->getalias () . ".situacao = IFNULL(?, " .$equipeDAO->getalias () . ".situacao ) ".
			" ORDER BY " . 
			$equipeDAO->getalias () . ".nrinscrito, " .
			$equipeDAO->getalias () . ".idcategoria, " .
			$inscritoDAO->getalias () . ".nome ";
			// " ORDER BY " . $equipeDAO->getalias().".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setTexto ( 2, $situacao );
			$this->con->setsql ( $query );
//echo  $this->con->getsql () ;
			Util::echobr ( 0, "InscritoEquipeDAO findByCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonatoEquipe($bean) {
		$this->con->setclasspai ( "InscritoEquipeDAO findByCampeonatoEquipe" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . ", " . 
			$pilotoDAO->camposSelect () . " FROM " . 
			$this->dbprexis . $this->tabelaAlias () . 
			" left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" on  " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" or " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" where " . $campeonatoDAO->idtabelaAlias () . " =  ?  " . 
			" and " . $equipeDAO->idtabelaAlias () . " =  ?  " . 
			" ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getequipe()->getcampeonato() ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getequipe() ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findByCampeonatoEquipe", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function findByCampeonatoInscritoEquipe($bean) {
		$dbg = 0;
		$this->con->setclasspai ( "InscritoEquipeDAO findByCampeonatoInscritoEquipe" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			$query = 
			" SELECT " . $this->camposSelect () . ", " . 
			$campeonatoDAO->camposSelect () . ", " . 
			$equipeDAO->camposSelect () . ", " . 
			$inscritoDAO->camposSelect () . ", " .
			$pilotoDAO->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . 
			" on  " . $this->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . 
			" left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . 
			" on  " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" or " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
			" where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 
			" and " . $inscritoDAO->idtabelaAlias () . " =  ?  " . 
			" and " . $equipeDAO->idtabelaAlias () . " =  ?  " . 
			" ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getequipe ()->getcampeonato () ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getinscrito () ) );
			$this->con->setNumero ( 3, Util::getIdObjeto ( $bean->getequipe () ) );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, "InscritoEquipeDAO findByCampeonatoInscritoEquipe", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByCampeonatoInscrito($bean) {
		$this->con->setclasspai ( "InscritoEquipeDAO findByCampeonatoInscrito" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $equipeDAO->camposSelect () . ", " . $inscritoDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . " on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . " left join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . " on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . " left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . " on  " . $this->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . " left join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " on  " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " and " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . " and " . $inscritoDAO->idtabelaAlias () . " =  ?  " . " ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getinscrito ()->getcampeonato () ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getinscrito () ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findByCampeonatoInscritoEquipe", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findCampeonatoNotEquipe($selcampeonato) {
		$this->con->setclasspai ( "InscritoEquipeDAO findCampeonatoNotEquipe" );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		$inscritoDAO = new InscritoDAO ( $this->con );
		$pilotoDAO = new PilotoDAO ( $this->con );
		$equipeDAO = new EquipeDAO ( $this->con );
		try {
			$query = " SELECT " . $inscritoDAO->camposSelect () . ", " . $campeonatoDAO->camposSelect () . ", " . $this->camposSelect () . ", " . $equipeDAO->camposSelect () . ", " . $pilotoDAO->camposSelect () . " FROM " . $this->dbprexis . $campeonatoDAO->tabelaAlias () . " inner join " . $this->dbprexis . $inscritoDAO->tabelaAlias () . " on  " . $inscritoDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . " left join " . $this->dbprexis . $pilotoDAO->tabelaAlias () . " on  " . $inscritoDAO->getalias () . ".idpiloto = " . $pilotoDAO->idtabelaAlias () . " left join " . $this->dbprexis . $this->tabelaAlias () . " on  " . $this->getalias () . ".idinscrito = " . $inscritoDAO->idtabelaAlias () . " left join " . $this->dbprexis . $equipeDAO->tabelaAlias () . " on  " . $this->getalias () . ".idequipe = " . $equipeDAO->idtabelaAlias () . " left join " . $equipeDAO->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 

			" where " . $campeonatoDAO->idtabelaAlias () . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias () . " ) " . 

			" ORDER BY " . $this->ordernome;
			
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoEquipeDAO findCampeonatoNotEquipe", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function deleteEquipe($idequipe) {
		$this->con->setclasspai ( "InscritoEquipeDAO deleteEquipe" );
		$this->results = new InscritoEquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . "idequipe = ? ";
			
			$this->con->setNumero ( 1, $idequipe );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'InscritoEquipeDAO deleteEquipe ', $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $idequipe );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function delete($bean) {
		$this->con->setclasspai ( "InscritoEquipeDAO delete" );
		$this->results = new InscritoEquipeBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'PilotocampeonatDAO delete ', $this->con->getsql () );
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