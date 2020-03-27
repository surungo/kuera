<?php
include_once PATHPUBDAO . '/PerfilDAO.php';
include_once PATHPUBDAO . '/ItemDAO.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBEAN . '/ItemPerfilBean.php';
include_once 'AbstractDAO.php';
class ItemPerfilDAO extends AbstractDAO {
	protected $dbprexis = "public_";
	protected $alias = "item_perfil";
	protected $tabela = "item_perfil";
	protected $idtabela = "iditemperfil";
	protected $campos = array (
			"iditem",
			"idperfil",
			"iditemperfil" 
	);
	protected $ordernome = "item_perfil.iditem";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function findByItem($id) {
		$this->results = new ItemPerfilBean ();
		$itemDAO = new ItemDAO ( $_conn );
		$perfilDAO = new PerfilDAO ( $_conn );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $itemDAO->camposSelect () . ", " . $perfilDAO->camposSelect () . " " . " FROM " . $this->dbprexis . $itemDAO->tabelaAlias () . ", " . $this->dbprexis . $itemDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . $itemDAO->idtabelaAlias () . " = " . $this->alias . ".idItem and " . $perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil and " . $itemDAO->idtabelaAlias () . " = " . $id . " ORDER BY " . $itemDAO->ordernome;
			$result = $this->con->query ( $query );
			if ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}

	public function findByPerfil($perfilBean) {
		$this->results = array ();
		$itemDAO = new ItemDAO ( $_conn );
		$perfilDAO = new PerfilDAO ( $_conn );
		try {
			$query = " SELECT " . 
				$this->camposSelect () . ", " . 
				$itemDAO->camposSelect () . ", " . 
				$perfilDAO->camposSelect () . " " . 
				" FROM " . 
				$this->dbprexis . $this->tabelaAlias () .
				" left join ".
				$this->dbprexis . $perfilDAO->tabelaAlias () . 
				" on " .
				$perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil ".
			 	" left join " .
				$this->dbprexis . $itemDAO->tabelaAlias () .  
				" on " . 
				$itemDAO->idtabelaAlias () . " = " . $this->alias . ".idItem ".
				" where " .
				$this->alias . ".idPerfil = ? ".
				" ORDER BY " . $itemDAO->getalias().".nome ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($perfilBean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemPerfilDAO findByPerfil getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results[] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function isItemPerfil($perfilBean,$itemBean) {
		$this->results = false;
	
		$itemperfilBean = new ItemPerfilBean ();
		$itemDAO = new ItemDAO ( $_conn );
		$perfilDAO = new PerfilDAO ( $_conn );
		try {
			$query = " SELECT " .
					" count(*) total " .
					" FROM " .
					$this->dbprexis . $this->tabelaAlias () .
					" where " .
					$this->alias . ".idPerfil = ? and ".
					$this->alias . ".idItem = ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto($perfilBean) );
			$this->con->setNumero ( 2, Util::getIdObjeto($itemBean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemPerfilDAO findByPerfil getsql", $this->con->getsql() );
			$result = $this->con->execute ();
			if ( $array = $result->fetch_assoc () ) {
				$this->results = $array['total']>0;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	
		return $this->results;
	}
	
	
	public function update($bean) {
		return $bean;
	}
	public function insert($bean) {
		$this->returnDataBaseBean = new ReturnDataBaseBean ();
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
					" idperfil, " .
					" iditem, " .
					$this->idtabela () .
					" )values ( " .
					" now(), " . 			// dtcriacao,
					" ?, " . 			// criador,
					" ?, " .      /* dtvalidade,*/
					" ?, " .      /* dtinicio,*/
					" ?, " . 			// idperfil,
					" ?, " . 			// iditem,
					" ? )"; // id;
				
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, Util::getIdObjeto($bean->getperfil ()) );
			$this->con->setTexto ( 5, Util::getIdObjeto($bean->getitem ()) );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "ItemPerfilDAO insert getsql", $this->con->getsql() );
				
			$this->con->execute ();
				
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
		
	}
	public function insertItemPerfil($idPerfil, $idItem) {
		$this->returnDataBaseBean = new ReturnDataBaseBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " INSERT INTO " . $this->dbprexis . $this->tabela () . " (	" . $this->camposInsert () . " ) " . " VALUES " . " ( ?, ?, ? )", $usuarioLoginBean->getusuario (), $idItem, $idPerfil );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $idPerfil );
			$this->returnDataBaseBean->setmensagem ( $this->con->affected_rows() );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$itemDAO = new ItemDAO ( $_conn );
		$perfilDAO = new PerfilDAO ( $_conn );
		
		$bean = new ItemPerfilBean ();
		
		$bean->setitem ( $itemDAO->getBeans ( $array ) );
		$bean->setperfil ( $perfilDAO->getBeans ( $array ) );
		$bean = $this->getLogBeans ( $array, $bean );
		return $bean;
	}
	public function delete($bean) {
	}
	public function deleteItemPerfil($bean) {
		$this->returnDataBaseBean = new ReturnDataBaseBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " .
			 $this->dbprexis . $this->tabela () . 
			" WHERE idperfil = ? and ".
			" iditem = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getperfil ()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getitem ()) );
			$this->con->setsql ( $query );
			Util::echobr (0, "ItemPerfilDAO deleteItemPerfil getsql", $this->con->getsql() );
			
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean->getid () );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function findAll() {
		$this->clt = array ();
		$itemDAO = new ItemDAO ( $_conn );
		$perfilDAO = new PerfilDAO ( $_conn );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $itemDAO->camposSelect () . ", " . $perfilDAO->camposSelect () . " " . " FROM " . $this->dbprexis . $itemDAO->tabelaAlias () . ", " . $this->dbprexis . $perfilDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . $itemDAO->idtabelaAlias () . " = " . $this->alias . ".idItem and " . $perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil " . " ORDER BY " . $perfilDAO->ordernome . ", " . $itemDAO->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
}
?>