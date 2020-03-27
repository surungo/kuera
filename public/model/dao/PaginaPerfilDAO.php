<?php
include_once PATHPUBDAO . '/PerfilDAO.php';
include_once PATHPUBDAO . '/PaginaDAO.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBEAN . '/PaginaBean.php';
include_once PATHPUBBEAN . '/PaginaPerfilBean.php';
include_once 'AbstractDAO.php';
class PaginaPerfilDAO extends AbstractDAO {
	protected $alias = "pape";
	protected $tabela = "pagina_perfil";
	protected $idtabela = "idperfil";
	protected $campos = array (
			"idpagina",
			"idperfil" 
	);
	protected $ordernome = "pape.idpagina";
	/*public function __construct($_conn) {
		parent::__construct ( $_conn );
	}*/
	public function findByPagina($id) {
		$this->results = new PaginaPerfilBean ();
		$paginaDAO = new PaginaDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $paginaDAO->camposSelect () . ", " . 
			$perfilDAO->camposSelect () . " " . 
			" FROM " .
			DBPREFIXPUB . $paginaDAO->tabelaAlias () . ", " . 
			DBPREFIXPUB . $paginaDAO->tabelaAlias () . ", " . 
			DBPREFIXPUB . $this->tabelaAlias () . 
			" where " . $paginaDAO->idtabelaAlias () . " = " . $this->alias . ".idpagina and " . 
			$perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil and " . 
			$paginaDAO->idtabelaAlias () . " = " . $id . 
			" ORDER BY " . $paginaDAO->ordernome;
			$result = $this->con->query ( $query );
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findByPerfil($perfilBean) {
		$this->results = new PaginaPerfilBean ();
		$cltpagina = array ();
		
		$paginaperfil = new PaginaPerfilBean ();
		$paginaDAO = new PaginaDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $paginaDAO->camposSelect () . ", " . $perfilDAO->camposSelect () . " " . " FROM " . DBPREFIXPUB . $paginaDAO->tabelaAlias () . ", " . DBPREFIXPUB . $perfilDAO->tabelaAlias () . ", " . DBPREFIXPUB . $this->tabelaAlias () . " where " . $paginaDAO->idtabelaAlias () . " = " . $this->alias . ".idpagina and " . $perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil and " . $perfilDAO->idtabelaAlias () . " = " . $perfilBean->getId () . " ORDER BY " . $perfilDAO->ordernome;
			$result = $this->con->query ( $query );
			while ( $result != null && $array = $result->fetch_assoc () ) {
				$cltpagina [] = $paginaDAO->getBeans ( $array );
			}
			$paginaperfil->setpagina ( $cltpagina );
			$paginaperfil->setperfil ( $perfilBean );
			$this->results = $paginaperfil;
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function update($bean) {
		return $bean;
	}
	public function insert($bean) {
	}
	public function insertPaginaPerfil($idPerfil, $idpagina) {
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = $this->sqlSelect ( " INSERT INTO " . DBPREFIXPUB . $this->tabela () . " (	criador, idpagina, idperfil ) " . " VALUES " . " ( ?, ?, ? )", $usuarioLoginBean->getusuario (), $idpagina, $idPerfil );
			$this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $idPerfil );
			$this->returnDataBaseBean->setmensagem ( $this->con->affected_rows() );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function getBeans($array) {
		$paginaDAO = new PaginaDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		
		$bean = new PaginaPerfilBean ();
		$bean->setpagina ( $this->getValorArray ( $array, $paginaDAO->idtabela (), $paginaDAO ) );
		$bean->setperfil ( $this->getValorArray ( $array, $perfilDAO->idtabela (), $perfilDAO ) );
		
		$bean = $this->getLogBeans ( $array, $bean );
		return $bean;
	}
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PaginaPerfilDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->clt;
	}
	public function delete($bean) {
	}
	public function deletePaginaPerfil($idPerfil, $idpagina) {
		$this->results = new PaginaPerfilBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = $this->sqlSelect ( " DELETE " . " FROM " . DBPREFIXPUB . $this->tabela () . " WHERE " . " idperfil = ? and " . " idpagina = ? ", $idPerfil, $idpagina );
			$this->results = $this->con->query ( $query );
			$this->returnDataBaseBean->setresposta ( $idPerfil );
			$this->returnDataBaseBean->setmensagem ( $this->con->affected_rows() );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function findAll() {
		$this->clt = array ();
		$paginaDAO = new PaginaDAO ( $this->con );
		$perfilDAO = new PerfilDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $paginaDAO->camposSelect () . ", " . $perfilDAO->camposSelect () . " " . " FROM " . DBPREFIXPUB . $paginaDAO->tabelaAlias () . ", " . DBPREFIXPUB . $perfilDAO->tabelaAlias () . ", " . DBPREFIXPUB . $this->tabelaAlias () . " where " . $paginaDAO->idtabelaAlias () . " = " . $this->alias . ".idpagina and " . $perfilDAO->idtabelaAlias () . " = " . $this->alias . ".idPerfil " . " ORDER BY " . $perfilDAO->ordernome . ", " . $paginaDAO->ordernome;
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