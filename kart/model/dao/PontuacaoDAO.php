<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PosicaoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PontuacaoEsquemaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
class PontuacaoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "pontuacao";
	protected $tabela = "pontuacao";
	protected $idtabela = "idpontuacao";
	protected $campos = array (
			"idpontuacaoesquema",
			"idposicao",
			"valor",
			"idpontuacao" 
	);
	protected $ordernome = "pontuacao.idpontuacao";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function findByBateriaPosicao($bateriaBean, $posicaoChegadaBean) {
		$this->results = new PontuacaoBean ();
		try {
			$pontuacaoesquemaDAO = new PontuacaoEsquemaDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$query = " SELECT " . $this->camposSelect () . ", " . $pontuacaoesquemaDAO->camposSelect () . " " . " FROM " . $this->getdbprexis () . $pontuacaoesquemaDAO->tabelaAlias () . ", " . $this->getdbprexis () . $bateriaDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . "     " . $this->getalias () . ".idpontuacaoesquema =  " . $pontuacaoesquemaDAO->idtabelaAlias () . " and " . $this->getalias () . ".idpontuacaoesquema = " . $bateriaDAO->getalias () . ".idpontuacaoesquema " . " and " . $bateriaDAO->idtabelaAlias () . " = ? " . " and " . $this->getalias () . ".idposicao = ? ";
			
			$this->con->setNumero ( 1, $bateriaBean->getid () );
			$this->con->setNumero ( 2, $posicaoChegadaBean->getid () );
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
	public function findByPontuacaoEsquema($pontuacaoesquema) {
		$this->results = new PontuacaoBean ();
		try {
			$pontuacaoesquemaDAO = new PontuacaoEsquemaDAO ( $this->con );
			$bateriaDAO = new BateriaDAO ( $this->con );
			$query = " SELECT " . $this->camposSelect () . " " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . "     " . $this->getalias () . ".idpontuacaoesquema =  ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $pontuacaoesquema ) );
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
	public function update($bean) {
		$this->results = new PontuacaoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . " dtvalidade = ? , " . " dtinicio = ? , " . " idpontuacaoesquema = ? ,  " . " idposicao = ? ,  " . " valor = ?  " . " WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getpontuacaoesquema () );
			$this->con->setNumero ( 5, $bean->getposicao () );
			$this->con->setNumero ( 6, $bean->getvalor () );
			$this->con->setNumero ( 7, $bean->getid () );
			$this->con->setsql ( $query );
			$this->con->execute ();
			// echo "Pontuacao: ".$this->con->getsql();
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . " idpontuacaoesquema, " . " idposicao, " . " valor, " . $this->idtabela () . " )values ( " . " now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " .      /* dtvalidade,*/ 
      " ?, " .      /* dtinicio,*/ 
			" ?, " . 			// idpontuacaoesquema,
			" ?, " . 			// idposicao,
			" ?, " . 			// valor,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getpontuacaoesquema () );
			$this->con->setNumero ( 5, $bean->getposicao () );
			$this->con->setNumero ( 6, $bean->getvalor () );
			$this->con->setNumero ( 7, $bean->getid () );
			$this->con->setsql ( $query );
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
		$this->bean = new PontuacaoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpontuacao", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		$this->bean->setpontuacaoesquema ( $this->getValorArray ( $array, "idpontuacaoesquema", new PontuacaoEsquemaDAO ( $this->con ) ) );
		$this->bean->setposicao ( $this->getValorArray ( $array, "idposicao", new PosicaoDAO ( $this->con ) ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr�o
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PontuacaoDAO findAllAtivo", $this->con->getsql () );
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
		$pontuacaoesquemaDAO = new PontuacaoEsquemaDAO ( $this->con );
		$posicaoDAO = new PosicaoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $posicaoDAO->camposSelect () . ", " . $pontuacaoesquemaDAO->camposSelect () . " " . " FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . $this->getdbprexis () . $posicaoDAO->tabelaAlias () . ", " . $this->getdbprexis () . $pontuacaoesquemaDAO->tabelaAlias () . " " . " where " . " 	  " . $this->getalias () . ".idposicao =  " . $posicaoDAO->idtabelaAlias () . " and " . $this->getalias () . ".idpontuacaoesquema =  " . $pontuacaoesquemaDAO->idtabelaAlias () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			// echo $query;
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
			// echo $query;
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($id) {
		$this->results = new PontuacaoBean ();
		try {
			$pontuacaoesquemaDAO = new PontuacaoEsquemaDAO ( $this->con );
			$query = " SELECT " . $this->camposSelect () . ", " . $pontuacaoesquemaDAO->camposSelect () . " " . " FROM " . $this->getdbprexis () . $pontuacaoesquemaDAO->tabelaAlias () . ", " . $this->dbprexis . $this->tabelaAlias () . " where " . "     " . $this->getalias () . ".idpontuacaoesquema =  " . $pontuacaoesquemaDAO->idtabelaAlias () . " and " . $this->idtabelaAlias () . " = ? ";
			
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
	public function findByPosicaoEsquema($bean) {
		$this->results = null;
		$pontuacaoBean = new PontuacaoBean ();
		$pontuacaoBean = $bean;
		
		try {
			$query = " SELECT " . $this->camposSelect () . " " . " FROM " . $this->getdbprexis () . $this->tabelaAlias () . " where " . "     " . $this->getalias () . ".idpontuacaoesquema =  ? " . " and " . $this->getalias () . ".idposicao = ? ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $pontuacaoBean->getpontuacaoesquema () ) );
			$this->con->setNumero ( 2, Util::getIdObjeto ( $pontuacaoBean->getposicao () ) );
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
		$this->results = new PontuacaoBean ();
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