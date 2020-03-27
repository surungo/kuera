<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once 'CampeonatoDAO.php';

class CategoriaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "categoria";
	protected $tabela = "categoria";
	protected $idtabela = "idcategoria";
	protected $campos = array (
			"idcampeonato",
			"nome",
			"valor",
			"valorlote1",
			"valorlote2",
			"valorlote3",
			"regulamento",
			"requisitos",
			"idcategoria" 
	);
	protected $ordernome = "categoria.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new CategoriaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
					" SET " . 
			" dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" idcampeonato = ? , " . 
			" nome = updateacentos(?), " . 
			" valor = ? ,  " .
			" valorlote1 = ? ,  " .
			" valorlote2 = ? ,  " .
			" valorlote3 = ? ,  " .
			" regulamento = ? ,  " .
			" requisitos = ?   " .
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setTexto ( 6, $bean->getvalor () );
			$this->con->setTexto ( 7, $bean->getvalorlote1() );
			$this->con->setTexto ( 8, $bean->getvalorlote2() );
			$this->con->setTexto ( 9, $bean->getvalorlote3() );
			$this->con->setTexto ( 10, $bean->getregulamento() );
			$this->con->setTexto ( 11, $bean->getrequisitos() );
			$this->con->setNumero ( 12, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			// echo "Categoria: ".$this->con->getsql();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 
		" ( " . 
		" dtcriacao, " . 
		" criador, " . 
		" dtvalidade, " . 
		" dtinicio, " . 
		" idcampeonato, " . 
		" nome, " . 
		" valor, " . 
		" valorlote1,  " .
		" valorlote2,  " .
		" valorlote3,  " .
		" regulamento,  " .
		" requisitos,  " .
		$this->idtabela () . 
		" )values ( " . 
		" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// idcampeonato,
			" updateacentos(?), " .	// nome,
			" ?, " . 			// valor,
			" ?, " . 			// valorlote1,
			" ?, " . 			// valorlote2,
			" ?, " . 			// valorlote3,
			" ?, " . 			// regulamento,
			" ?, " . 			// requisitos,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setTexto ( 6, $bean->getvalor () );
			$this->con->setTexto ( 7, $bean->getvalorlote1() );
			$this->con->setTexto ( 8, $bean->getvalorlote2() );
			$this->con->setTexto ( 9, $bean->getvalorlote3() );
			$this->con->setTexto ( 10, $bean->getregulamento() );
			$this->con->setTexto ( 11, $bean->getrequisitos() );
			$this->con->setNumero ( 12, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'query' , $this->con->getsql() );
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
		$this->bean = new CategoriaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idcategoria", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO($this->con) ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		$this->bean->setvalorlote1 ( $this->getValorArray ( $array, "valorlote1", null ) );
		$this->bean->setvalorlote2 ( $this->getValorArray ( $array, "valorlote2", null ) );
		$this->bean->setvalorlote3 ( $this->getValorArray ( $array, "valorlote3", null ) );
		$this->bean->setregulamento ( $this->getValorArray ( $array, "regulamento", null ) );
		$this->bean->setrequisitos ( $this->getValorArray ( $array, "requisitos", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
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
	public function findByCampeonato($campeonato) {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT ". 
					$this->camposSelect () ." , " . 
					$campeonatoDAO->camposSelect () . 
					" FROM " . 
					$this->dbprexis . $this->tabelaAlias () . 
					" left join " .
					$this->dbprexis . $campeonatoDAO->tabelaAlias () . 
					" on " . 
					$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () . 
					" where " . 
					" IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) = IFNULL( ? ,IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) ) " .
  				   " ORDER BY " . $this->getalias () . ".nome ";
			// echo $query;
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategoriaDAO findByCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	
	public function findValidosByCampeonato($campeonato) {
		$this->clt = array ();
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		try {
			$query = " SELECT ".
					$this->camposSelect () ." , " .
					$campeonatoDAO->camposSelect () .
					" FROM " .
					$this->dbprexis . $this->tabelaAlias () .
					" left join " .
					$this->dbprexis . $campeonatoDAO->tabelaAlias () .
					" on " .
					$this->getalias () . ".idcampeonato = " . $campeonatoDAO->idtabelaAlias () .
					" where " .
					$this->whereAtivo () .
					" and IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) = IFNULL( ? ,IFNULL( ".$campeonatoDAO->idtabelaAlias () . ",0) ) " .
					" ORDER BY " . $this->getalias () . ".nome ";
			// echo $query;
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CategotiaDAO findByCampeonato", $this->con->getsql () );
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
	public function findById($categoria) {
		$this->results = new CategoriaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($categoria) );
			$this->con->setsql ( $query );
			Util::echobr ( 0,' CategoriaDAO findById query  ', $this->con->getsql()  );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function delete($bean) {
		$this->results = new CategoriaBean ();
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