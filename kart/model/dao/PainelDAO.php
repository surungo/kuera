<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PainelBean.php';


class PainelDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "painel";
	protected $tabela = "painel";
	protected $idtabela = "idpainel";
	protected $campos = array (
			"idusuario",
			"idbateria",
			"idetapa",
			"idcampeonato",
			"fase",
			"taxaatualizacao",
			"col01",
			"col02",
			"col03",
			"col04",
			"col05",
			"col06",
			"col07",
			"col08",
			"col09",
			"col10",
			"col11",
			"col12",
			"col13",
			"col14",
			"col15",
			"col16",
			"col17",
			"col18",
			"idpainel"			
	);
	
	protected $orderidbateria = "painel.idbateria";
	
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	
	public function update($bean) {
		$this->results = new PainelBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " . $this->dbprexis . $this->tabela () .//sql 
			" SET " .//sql 
			" dtmodificacao = now(), " .//sql 
			" modificador = ? , " .//sql 
			" dtvalidade = ? , " .//sql 
			" dtinicio = ? , " .//sql 
			" idusuario = ? , " .//sql 
			" idbateria = ? , " .//sql 
			" idetapa = ? , " .//sql
			" idcampeonato = ? , " .//sql
			" fase = ? , " .//sql 
			" taxaatualizacao = ? , " .//sql 
			" col01 = ? , " .//sql 
			" col02 = ? , " .//sql 
			" col03 = ? , " .//sql 
		    " col04 = ? , " .//sql 
		    " col05 = ? , " .//sql 
            " col06 = ? , " .//sql 
            " col07 = ? , " .//sql 
            " col08 = ? , " .//sql 
            " col09 = ? , " .//sql 
            " col10 = ? , " .//sql 
			" col11 = ? , " .//sql 
            " col12 = ? , " .//sql 
            " col13 = ? , " .//sql 
            " col14 = ? , " .//sql 
            " col15 = ? , " .//sql 
			" col16 = ?, " .//sql 
			" col17 = ?, " .//sql 
			" col18 = ? " .//sql 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setNumero (	 4, $bean->getusuario () );
			$this->con->setNumero (	 5, $bean->getbateria () );
			$this->con->setNumero (	 6, $bean->getetapa () );
			$this->con->setNumero (	 7, $bean->getcampeonato () );
			$this->con->setNumero (	 8, $bean->getfase () );
			$this->con->setNumero (	 9, $bean->gettaxaatualizacao () );
			$this->con->setTexto ( 	10, $bean->getcol01 () );
			$this->con->setTexto ( 	11, $bean->getcol02 () );
			$this->con->setTexto ( 	12, $bean->getcol03 () );
			$this->con->setTexto ( 	13, $bean->getcol04 () );
			$this->con->setTexto ( 	14, $bean->getcol05 () );
			$this->con->setTexto ( 	15, $bean->getcol06 () );
			$this->con->setTexto ( 	16, $bean->getcol07 () );
			$this->con->setTexto ( 	17, $bean->getcol08 () );
			$this->con->setTexto ( 	18, $bean->getcol09 () );
			$this->con->setTexto ( 	19, $bean->getcol10 () );
			$this->con->setTexto ( 	20, $bean->getcol11 () );
			$this->con->setTexto ( 	21, $bean->getcol12 () );
			$this->con->setTexto ( 	22, $bean->getcol13 () );
			$this->con->setTexto ( 	23, $bean->getcol14 () );
			$this->con->setTexto ( 	24, $bean->getcol15 () );
			$this->con->setTexto ( 	25, $bean->getcol16 () );
			$this->con->setTexto ( 	26, $bean->getcol17 () );
			$this->con->setTexto ( 	27, $bean->getcol18 () );
			$this->con->setNumero ( 28, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PainelDAO update", $this->con->getsql () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () .//sql 
			" ( " .//sql 
			" dtcriacao, " .//sql 
			" criador, " .//sql 
			" dtvalidade, " .//sql 
			" dtinicio, " .//sql 
			" idusuario, " .//sql 
			" idbateria, " .//sql 
			" idetapa, " .//sql
			" idcampeonato, " .//sql
			" fase, " .//sql 
			" taxaatualizacao, " .//sql 
			" col01, " .//sql 
			" col02, " .//sql 
			" col03, " .//sql 
		    " col04, " .//sql 
		    " col05, " .//sql 
            " col06, " .//sql 
            " col07, " .//sql 
            " col08, " .//sql 
            " col09, " .//sql 
            " col10, " .//sql 
			" col11, " .//sql 
            " col12, " .//sql 
            " col13, " .//sql 
            " col14, " .//sql 
            " col15, " .//sql 
			" col16, " .//sql 
			" col17, " .//sql 
			" col18, " .//sql 
			$this->idtabela () .//sql 
			" )values ( " .//sql 
			" now(), " . 	    // dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// idusuario,
			" ?, " . 			// idbateria,
			" ?, " . 			// idetapa,
			" ?, " . 			// idcampeonato,
			" ?, " . 			// fase,
			" ?, " . 			// taxaatualizacao,
			" ?, " . 			// col01,
			" ?, " . 			// col02,
			" ?, " . 			// col03,
			" ?, " . 			// col04,
			" ?, " . 			// col05,
			" ?, " . 			// col06,
			" ?, " . 			// col07,
			" ?, " . 			// col08,
			" ?, " . 			// col09,
			" ?, " . 			// col10,
			" ?, " . 			// col11,
			" ?, " . 			// col12,
			" ?, " . 			// col13,
			" ?, " . 			// col14,
			" ?, " . 			// col15,
			" ?, " . 			// col16,
			" ?, " . 			// col17,
			" ?, " . 			// col18,
			" ? )"; // id;
			
			$this->con->setTexto (	 1, $bean->getcriador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setNumero (	 4, $bean->getusuario () );
			$this->con->setNumero (	 5, $bean->getbateria () );
			$this->con->setNumero (	 6, $bean->getetapa () );
			$this->con->setNumero (	 7, $bean->getcampeonato () );
			$this->con->setNumero (	 8, $bean->getfase () );
			$this->con->setNumero (	 9, $bean->gettaxaatualizacao () );
			$this->con->setTexto ( 	10, $bean->getcol01 () );
			$this->con->setTexto ( 	11, $bean->getcol02 () );
			$this->con->setTexto ( 	12, $bean->getcol03 () );
			$this->con->setTexto ( 	13, $bean->getcol04 () );
			$this->con->setTexto ( 	14, $bean->getcol05 () );
			$this->con->setTexto ( 	15, $bean->getcol06 () );
			$this->con->setTexto ( 	16, $bean->getcol07 () );
			$this->con->setTexto ( 	17, $bean->getcol08 () );
			$this->con->setTexto ( 	18, $bean->getcol09 () );
			$this->con->setTexto ( 	19, $bean->getcol10 () );
			$this->con->setTexto ( 	20, $bean->getcol11 () );
			$this->con->setTexto ( 	21, $bean->getcol12 () );
			$this->con->setTexto ( 	22, $bean->getcol13 () );
			$this->con->setTexto ( 	23, $bean->getcol14 () );
			$this->con->setTexto ( 	24, $bean->getcol15 () );
			$this->con->setTexto ( 	25, $bean->getcol16 () );
			$this->con->setTexto ( 	26, $bean->getcol17 () );
			$this->con->setTexto ( 	27, $bean->getcol18 () );
			$this->con->setNumero ( 28, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PainelDAO insert", $this->con->getsql () );
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
		$this->bean = new PainelBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpainel", null ) );
		$this->bean->setusuario ( $this->getValorArray ( $array, "idusuario", null ) );
		$this->bean->setbateria ( $this->getValorArray ( $array, "idbateria", null ) );
		$this->bean->setetapa ( $this->getValorArray ( $array, "idetapa", null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", null ) );
		$this->bean->setfase ( $this->getValorArray ( $array, "fase", null ) );
		$this->bean->settaxaatualizacao ( $this->getValorArray ( $array, "taxaatualizacao", null ) );
		$this->bean->setcol01 ( $this->getValorArray ( $array, "col01", null ) );
		$this->bean->setcol02 ( $this->getValorArray ( $array, "col02", null ) );
		$this->bean->setcol03 ( $this->getValorArray ( $array, "col03", null ) );
		$this->bean->setcol04 ( $this->getValorArray ( $array, "col04", null ) );
		$this->bean->setcol05 ( $this->getValorArray ( $array, "col05", null ) );
		$this->bean->setcol06 ( $this->getValorArray ( $array, "col06", null ) );
		$this->bean->setcol07 ( $this->getValorArray ( $array, "col07", null ) );
		$this->bean->setcol08 ( $this->getValorArray ( $array, "col08", null ) );
		$this->bean->setcol09 ( $this->getValorArray ( $array, "col09", null ) );
		$this->bean->setcol10 ( $this->getValorArray ( $array, "col10", null ) );
		$this->bean->setcol11 ( $this->getValorArray ( $array, "col11", null ) );
		$this->bean->setcol12 ( $this->getValorArray ( $array, "col12", null ) );
		$this->bean->setcol13 ( $this->getValorArray ( $array, "col13", null ) );
		$this->bean->setcol14 ( $this->getValorArray ( $array, "col14", null ) );
		$this->bean->setcol15 ( $this->getValorArray ( $array, "col15", null ) );
        $this->bean->setcol16 ( $this->getValorArray ( $array, "col16", null ) );
		$this->bean->setcol17 ( $this->getValorArray ( $array, "col17", null ) );
		$this->bean->setcol18 ( $this->getValorArray ( $array, "col18", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padrão
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" ORDER BY " . $this->orderidbateria;
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

	public function findAllValidos() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where " .//sql 
			" IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " .//sql 
			" ORDER BY " . $this->orderidbateria;
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
	
	public function findAllSort($bean) {
		$this->clt = array ();
		try {
			if ($bean->getsort () != "") {
				$this->orderidbateria = $bean->getsort ();
			}
			$query = " SELECT " .//sql 
			$this->camposSelect () .//sql 
			" FROM " .//sql 
			$this->dbprexis . $this->tabelaAlias () .//sql 
			" ORDER BY " . $this->orderidbateria;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PainelDAO findAllSort", $this->con->getsql () );
			
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
		$this->results = new PainelBean ();
		Util::echobr ( 0, "PainelDAO findById id",  Util::getIdObjeto($bean) );
		
		try {
			$query = " SELECT " .//sql 
			$this->camposSelect ()  .//sql
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PainelDAO findById", $this->con->getsql () );
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
		$this->results = new PainelBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			
			$query = " DELETE " .//sql 
			" FROM " . $this->dbprexis . $this->tabela () .//sql 
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
	
	public function findByBateria($bean) {
		$this->results = new PainelBean ();
		Util::echobr ( 0, "PainelDAO findById id",  Util::getIdObjeto($bean) );
		
		try {
			$query = " SELECT " .//sql
					$this->camposSelect ()  .//sql
					" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql
					" where " . $this->getalias() . ".idbateria = ? ";
					$this->con->setNumero ( 1, Util::getIdObjeto($bean->getbateria()) );
					$this->con->setsql ( $query );
					Util::echobr ( 0, "PainelDAO findById", $this->con->getsql () );
					$result = $this->con->execute ();
					
					if ($array = $result->fetch_assoc ()) {
						$this->results = $this->getBeans ( $array );
					}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
}

?>