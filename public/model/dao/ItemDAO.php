<?php
include_once PATHPUBBEAN . "/ItemBean.php";
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHPUBDAO . '/UsuarioDAO.php';
include_once PATHPUBDAO . '/ItemPerfilDAO.php';
include_once PATHPUBDAO . '/PerfilDAO.php';
class ItemDAO extends AbstractDAO {
	protected $dbprexis = "public_";
	protected $alias = "item";
	protected $tabela = "item";
	protected $idtabela = "iditem";
	protected $campos = array (
			"nome",
			"codigo",
			"iditem" 
	);
	protected $ordernome = "item.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function findByUsuario($idusuario) {
		$this->clt = array ();
		$itemPerfilDAO = new ItemPerfilDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		$usuarioDAO = new UsuarioDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " " . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . 

			"   inner join " . DBPREFIXPUB . $itemPerfilDAO->tabelaAlias () . " on " . $itemPerfilDAO->getalias () . ".iditem = " . $this->idtabelaAlias () . 

			"   inner join " . DBPREFIXPUB . $usuarioDAO->tabelaAlias () . " on " . $usuarioDAO->getalias () . ".idperfil = " . $itemPerfilDAO->getalias () . ".idperfil " . 

			" where " . $this->idtabelaAlias () . " =  " . $idusuario . " ORDER BY " . $this->ordernome . " ASC ";
			
			$result = $this->con->query ( $query );
			if ($result != null) {
				while ( $array = $result->fetch_assoc () ) {
					$this->clt [] = $this->getBeans ( $array );
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByPerfil($idperfil) {
		$this->clt = array ();
		$itemPerfilDAO = new ItemPerfilDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		try {
			$query = $this->sqlSelect ( " SELECT " . $this->camposSelect () . " , " . $perfilDAO->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . 

			"   inner join " . DBPREFIXPUB . $itemPerfilDAO->tabelaAlias () . " on " . $itemPerfilDAO->getalias () . ".iditem = " . $this->idtabelaAlias () . 

			"   inner join " . DBPREFIXPUB . $perfilDAO->tabelaAlias () . " on " . $itemPerfilDAO->getalias () . ".idperfil = " . $perfilDAO->idtabelaAlias () . 

			" where " . $perfilDAO->idtabelaAlias () . " =  ? " . " ORDER BY " . $this->ordernome . " ASC ", $idperfil );
			$result = $this->con->query ( $query );
			if ($result != null) {
				while ( $array = $result->fetch_assoc () ) {
					$this->clt [] = $this->getBeans ( $array );
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findByNotPerfil($idperfil) {
		$this->clt = array ();
		$itemPerfilDAO = new ItemPerfilDAO ( $this->con );
		
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " WHERE " . "   " . $this->idtabelaAlias () . " NOT IN( " . "     SELECT " . $itemPerfilDAO->getalias () . ".iditem " . "     FROM " . DBPREFIXPUB . $itemPerfilDAO->tabelaAlias () . "     where " . $itemPerfilDAO->getalias () . ".idperfil = " . $idperfil . " ) " . " ORDER BY " . $this->ordernome . " ASC ";
			$result = $this->con->query ( $query );
			if ($result != null) {
				while ( $array = $result->fetch_assoc () ) {
					$this->clt [] = $this->getBeans ( $array );
				}
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function update($bean) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " . 
			$this->dbprexis . $this->tabela () . 
			" SET " . " dtmodificacao = now(), " . 
			" modificador = ? , " . 			//  1
			" dtvalidade = ? , " . 				//  2
			" dtinicio = ? , " .   				//  3
			" nome = updateacentos(?) , " .     //  4 
			" codigo = updateacentos(upper(?))  " . //  5
			" WHERE " . $this->idtabela () . " =  ? "; // 6
			
			$this->con->setTexto ( 1, $bean->getmodificador () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getnome () );
			$this->con->setTexto ( 5, $bean->getcodigo () );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemDAO update", $this->con->getsql () );
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
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . 
					" dtcriacao, " . 
					" criador, " . 
					" dtvalidade, " . 
					" dtinicio, " . 
					" nome, " . 
					" codigo, " . 
					$this->idtabela () . 
					" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" updateacentos(?), " . 			// nome,
			" updateacentos(upper(?)), " . 			// codigo,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $bean->getcriador () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getnome () );
			$this->con->setTexto ( 5, $bean->getcodigo () );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemDAO insert", $this->con->getsql () );
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
		$this->bean = new ItemBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "iditem", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setcodigo ( $this->getValorArray ( $array, "codigo", null ) );
		
		$perfilDAO = new PerfilDAO ( $this->con );
		$this->bean->setperfil ( $this->getValorArray ( $array, "idperfil", $perfilDAO ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemDAO findAllAtivo", $this->con->getsql () );
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
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " " . " ORDER BY " . $this->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($id) {
		$this->results = new ItemBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . DBPREFIXPUB . $this->tabelaAlias () . " where " . $this->idtabelaAlias () . " = " . $id . " ORDER BY " . $this->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function delete($bean) {
		$this->results = new ItemBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = $this->sqlSelect ( " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . $this->idtabela () . " = ? ", $bean->getid () );
			$this->results = $this->con->query ( $query );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}
?>