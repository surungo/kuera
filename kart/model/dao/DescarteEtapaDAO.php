<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteEtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/DescarteDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
class DescarteEtapaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "descarteetapa";
	protected $tabela = "descarteetapa";
	protected $idtabela = "iddescarteetapa";
	protected $campos = array (
			"idetapa",
			"iddescarte",
			"iddescarteetapa" 
	);
	protected $ordernome = " descarteetapa.idetapa ";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new DescarteEtapaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . 
			" dtmodificacao = now(), " . 
			" modificador = ? , " . 		// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" idetapa = ? , " . 			// 4
			" iddescarte = ?  " . 			// 5
			" WHERE " . $this->idtabela () . " =  ? "; // 6
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getetapa () );
			$this->con->setNumero ( 5, $bean->getdescarte () );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteEtapaDAO update", $this->con->getsql () );
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
			
			$query = " insert into " . 
			$this->dbprexis . $this->tabela () . 
			" ( " . 
			" dtcriacao, " . 
			" criador, " . 
			" dtvalidade, " . 
			" dtinicio, " . 
			" idetapa , " . 
			" iddescarte , " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ? , " . 			// idetapa
			" ? , " . 			// iddescarte
			" ? )"; // id
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getetapa () ) );
			$this->con->setNumero ( 5, Util::getIdObjeto ( $bean->getdescarte () ) );
			$this->con->setNumero ( 6, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteEtapaDAO insert", $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			
			$this->returnDataBaseBean->setqta ( $this->con->affected_rows() );
			$this->returnDataBaseBean->setsucesso ( ($this->con->affected_rows() > 0) );
			if ($this->returnDataBaseBean->getsucesso ()) {
				$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " cadastrados no Descarte.</span>" );
			} else {
				$this->returnDataBaseBean->setmensagem ( "<span class='red'>Nenhum etapa foi cadastado no descarte.</span>" );
			}
		} catch ( Exception $e ) {
			$bean->setid ( 0 );
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	
	public function getBeans($array) {
		$this->bean = new DescarteEtapaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "iddescarteetapa", null ) );
	
		$descarteDAO = new DescarteDAO ( $this->con );
		$this->bean->setdescarte ( $this->getValorArray ( $array, $descarteDAO->idtabela (), $descarteDAO ) );
		
		$etapaDAO = new EtapaDAO ( $this->con );
		$etapa = $this->getValorArray ( $array, $etapaDAO->idtabela (), $etapaDAO );
		$this->bean->setetapa ( $etapa );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	public function hasetapa($bean) {
		$this->results = false;
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . $this->whereAtivo () . 
			" and " . $this->getalias () . ".idetapa = ? "  . 
			" and " . $this->getalias () . ".iddescarte = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getetapa () ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $bean->getdescarte () ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteEtapaDAO findAllAtivo", $this->con->getsql () );
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = true;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results ;
	}
	
	// metodos padrao
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . " " . 
			" where " . $this->whereAtivo () . 
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "BateriaDAO findAllAtivo", $this->con->getsql () );
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
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
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
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
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
	
	public function findByDescarte($descarte) {
		$this->clt = array ();
		$descarteDAO = new DescarteDAO ( $this->con );
		$etapaDAO = new EtapaDAO ( $this->con );
		try {
			$query = " SELECT " . 
			$this->camposSelect () . ", " . 
			$descarteDAO->camposSelect () . ",  " . 
			$etapaDAO->camposSelect () . "  " . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . 
			" inner join " . $this->dbprexis . $descarteDAO->tabelaAlias () . " " . 
			" on " . $descarteDAO->idtabelaAlias () . " = " . $this->getalias () . ".iddescarte " . 

			" inner join " . $this->dbprexis . $etapaDAO->tabelaAlias () . " " . 
			" on " . $etapaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idetapa " . 

			" where " . 
			$this->alias . ".iddescarte = ? " ;
			
			$this->con->setNumero ( 1, Util::getIdObjeto($descarte) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteEtapaDAO findByDescarte", $this->con->getsql () );
			
			$result = $this->con->execute ();
			//echo $this->con->getsql();
			while ( $array = $result->fetch_assoc () ) {
			//print_r( $array ); 
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($id) {
		$this->results = new DescarteEtapaBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
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
	public function delete($bean) {
		$this->results = new DescarteEtapaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . 
			" FROM " . $this->dbprexis . $this->tabela () . 
			" WHERE " . $this->idtabela () . " = ? ";
			
			$this->con->setNumero ( 1, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	public function deleteByIdDescarte($idDescarte) {
		$this->results = new DescarteEtapaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . " WHERE " . " iddescarte = ? ";
			
			$this->con->setNumero ( 1, $idDescarte );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "DescarteEtapaDAO deleteByIdDescarte", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
	
	public function deletedescarteetapa($bean) {
		$this->results = new DescarteEtapaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela () . 
			" WHERE " . 
			" iddescarte = ? " .
			" and idetapa = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto($bean->getdescarte()) );
			$this->con->setNumero ( 2, Util::getIdObjeto($bean->getetapa()) );
			$this->con->setsql ( $query );
			Util::echobr (0, "DescarteEtapaDAO deletedescarteetapa", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->results;
	}
}

?>