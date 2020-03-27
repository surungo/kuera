<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
class CampeonatoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "campeonato";
	protected $tabela = "campeonato";
	protected $idtabela = "idcampeonato";
	protected $campos = array (
			"sigla",
			"nome",
			"totalvaga",
			"totalvagaequipe",
			"totalinscritoequipe",
			"valor",
			"valorporextenso",
			"valorpaypal",
			"emailpaypal",
			"mostrarespera",
			"msglistaespera",
			"listainscrito",
			"msgaguardandopagamento",
			"msgatualizadosucesso",
			"msgsucesso",
			"msgsucessoequipe",
			"dtinicioinscricoes",
			"dtfinalinscricoes",
			"tipoevento",
			"adicionarcentavos",
	        "vezespaypal",
			"idcampeonato"
	);
	protected $ordernome = "campeonato.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new CampeonatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = ? , " . 			// 1
			" dtvalidade = ? , " . 			// 2
			" dtinicio = ? , " . 			// 3
			" sigla = ? , " . 			// 4
			" nome = updateacentos(?) ,  " . 			// 5
			" totalvaga = ? , " . 			// 6
			" totalvagaequipe = ? , " . 			// 7
			" totalinscritoequipe = ? , " . 			// 8
			" valor = ? , " . 			// 9
			" valorporextenso = updateacentos(?) , " . 			// 10
			" valorpaypal = ? , " . 			// 11
			" emailpaypal = ? , " . 			// 12
			" mostrarespera = ? , " . 			// 13
			" msglistaespera = updateacentos(?) , " . 			// 14
			" listainscrito = ? , " . 			// 15
			" msgaguardandopagamento = updateacentos(?) , " . 			// 16
			" msgatualizadosucesso = updateacentos(?) , " . 			// 17
			" msgsucesso = updateacentos(?) , " . 			// 18
			" msgsucessoequipe = updateacentos(?) , " . 			// 19
			" dtinicioinscricoes = ? ,".	// 20
			" dtfinalinscricoes  = ? , ".	// 21
			" tipoevento = ? ,  " . 			// 22
			" adicionarcentavos = ? , " . 			// 23
			" vezespaypal = ?  " . 			// 24
			" WHERE " . $this->idtabela () . " =  ? "; // 25

			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getsigla () );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setNumero ( 6, $bean->gettotalvaga () );
			$this->con->setNumero ( 7, $bean->gettotalvagaequipe () );
			$this->con->setNumero ( 8, $bean->gettotalinscritoequipe () );
			$this->con->setTexto ( 9, $bean->getvalor () );
			$this->con->setTexto ( 10, $bean->getvalorporextenso () );
			$this->con->setTexto ( 11, $bean->getvalorpaypal () );
			$this->con->setTexto ( 12, $bean->getemailpaypal () );
			$this->con->setTexto ( 13, $bean->getmostrarespera () );
			$this->con->setTexto ( 14, $bean->getmsglistaespera () );
			$this->con->setTexto ( 15, $bean->getlistainscrito () );
			$this->con->setTexto ( 16, $bean->getmsgaguardandopagamento () );
			$this->con->setTexto ( 17, $bean->getmsgatualizadosucesso () );
			$this->con->setTexto ( 18, $bean->getmsgsucesso () );
			$this->con->setTexto ( 19, $bean->getmsgsucessoequipe () );
			$this->con->setData ( 20, $bean->getdtinicioinscricoes () );
			$this->con->setData ( 21, $bean->getdtfinalinscricoes () );
			$this->con->setNumero ( 22, $bean->gettipoevento () );
			$this->con->setNumero ( 23, $bean->getadicionarcentavos () );
			$this->con->setNumero ( 24, $bean->getvezespaypal () );
			$this->con->setNumero ( 25, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CampeonatoDAO update", $this->con->getsql () );
			$this->con->execute ();

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

			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " . " dtcriacao, " . " criador, " . " dtvalidade, " . " dtinicio, " . " sigla, " . " nome, " . " totalvaga , " . 			//
			" totalvagaequipe , " . 			//
			" totalinscritoequipe , " . 			//
			" valor , " . 			//
			" valorporextenso , " . 			//
			" valorpaypal , " . 			//
			" emailpaypal , " . 			//
			" mostrarespera , " . 			//
			" msglistaespera , " . 			//
			" listainscrito , " . 			//
			" msgaguardandopagamento , " . 			//
			" msgatualizadosucesso , " . 			//
			" msgsucesso , " . 			//
			" msgsucessoequipe , " . 			//
			" dtinicioinscricoes  ,".	// 20
			" dtfinalinscricoes  , ".	// 21
			" tipoevento , " . 			//
			" adicionarcentavos , " . 			//
			" vezespaypal , " . 			//24
			$this->idtabela () . " )values ( " . " now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// sigla,
			" updateacentos(?), " . 			// nome,
			" ? , " . 			// totalvaga
			" ? , " . 			// totalvagaequipe
			" ? , " . 			// totalinscritoequipe
			" ? , " . 			// valor
			" updateacentos(?) , " . 			// valorporextenso
			" ? , " . 			// valorpaypal
			" ? , " . 			// emailpaypal
			" ? , " . 			// mostrarespera
			" updateacentos(?) , " . 			// msglistaespera
			" ? , " . 			// listainscrito
			" updateacentos(?) , " . 			// msgaguardandopagamento
			" updateacentos(?) , " . 			// msgatualizadosucesso
			" updateacentos(?) , " . 			// msgsucesso
			" updateacentos(?) , " . 			// msgsucessoequipe
			" ? , " . 			// dtinicioinscricoes
			" ? , " . 			// dtfinalinscricoes
			" ? , " . 			// tipoevento
			" ? , " . 			// adicionarcentavos
			" ? , " . 			// vezespaypal
			" ? )"; // id;

			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getsigla () );
			$this->con->setTexto ( 5, $bean->getnome () );
			$this->con->setNumero ( 6, $bean->gettotalvaga () );
			$this->con->setNumero ( 7, $bean->gettotalvagaequipe () );
			$this->con->setNumero ( 8, $bean->gettotalinscritoequipe () );
			$this->con->setTexto ( 9, $bean->getvalor () );
			$this->con->setTexto ( 10, $bean->getvalorporextenso () );
			$this->con->setTexto ( 11, $bean->getvalorpaypal () );
			$this->con->setTexto ( 12, $bean->getemailpaypal () );
			$this->con->setTexto ( 13, $bean->getmostrarespera () );
			$this->con->setTexto ( 14, $bean->getmsglistaespera () );
			$this->con->setTexto ( 15, $bean->getlistainscrito () );
			$this->con->setTexto ( 16, $bean->getmsgaguardandopagamento () );
			$this->con->setTexto ( 17, $bean->getmsgatualizadosucesso () );
			$this->con->setTexto ( 18, $bean->getmsgsucesso () );
			$this->con->setTexto ( 19, $bean->getmsgsucessoequipe () );
			$this->con->setData ( 20, $bean->getdtinicioinscricoes () );
			$this->con->setData ( 21, $bean->getdtfinalinscricoes () );
			$this->con->setNumero ( 22, $bean->gettipoevento () );
			$this->con->setNumero ( 23, $bean->getadicionarcentavos () );
			$this->con->setNumero ( 24, $bean->getvezespaypal () );
			$this->con->setNumero ( 25, $bean->getid () );
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
		$this->bean = new CampeonatoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, $this->idtabela (), null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean->settotalvaga ( $this->getValorArray ( $array, "totalvaga", null ) );
		$this->bean->settotalvagaequipe ( $this->getValorArray ( $array, "totalvagaequipe", null ) );
		$this->bean->settotalinscritoequipe ( $this->getValorArray ( $array, "totalinscritoequipe", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		$this->bean->setvalorporextenso ( $this->getValorArray ( $array, "valorporextenso", null ) );
		$this->bean->setvalorpaypal ( $this->getValorArray ( $array, "valorpaypal", null ) );
		$this->bean->setvezespaypal ( $this->getValorArray ( $array, "vezespaypal", null ) );
		$this->bean->setemailpaypal ( $this->getValorArray ( $array, "emailpaypal", null ) );
		$this->bean->setmostrarespera ( $this->getValorArray ( $array, "mostrarespera", null ) );
		$this->bean->setmsglistaespera ( $this->getValorArray ( $array, "msglistaespera", null ) );
		$this->bean->setlistainscrito ( $this->getValorArray ( $array, "listainscrito", null ) );
		$this->bean->setmsgaguardandopagamento ( $this->getValorArray ( $array, "msgaguardandopagamento", null ) );
		$this->bean->setmsgatualizadosucesso ( $this->getValorArray ( $array, "msgatualizadosucesso", null ) );
		$this->bean->setmsgsucesso ( $this->getValorArray ( $array, "msgsucesso", null ) );
		$this->bean->setmsgsucessoequipe ( $this->getValorArray ( $array, "msgsucessoequipe", null ) );
		$this->bean->setdtinicioinscricoes ( $this->getValorArray ( $array, "dtinicioinscricoes", null ) );
		$this->bean->setdtfinalinscricoes ( $this->getValorArray ( $array, "dtfinalinscricoes", null ) );
		$this->bean->settipoevento ( $this->getValorArray ( $array, "tipoevento", null ) );
		$this->bean->setadicionarcentavos ( $this->getValorArray ( $array, "adicionarcentavos", null ) );

		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}

	// metodos padr�o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " .
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CampeonatoDAO findAll", $this->con->getsql () );
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
			$query = " SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " .
			" where " . $this->whereAtivo () .
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CampeonatoDAO findAllAtivo", $this->con->getsql () );
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
	public function findById($id) {
		$this->results = new CampeonatoBean ();
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

	public function findBySigla($sigla) {
		$this->results = new CampeonatoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" where " . $this->getalias () . ".sigla  = ? ";
			$this->con->setTexto ( 1, $sigla );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'CampeonatoDAO findBySigla getsql', $this->con->getsql () );
			$result = $this->con->execute ();

			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}

		return $this->results;
	}

	public function findByTiposAtivos($tipos) {
		$qtdtipo = count($tipos);

		$this->clt = array ();
		if($qtdtipo>0){
			try {
				$query = " SELECT " . $this->camposSelect () .
				" FROM " . $this->dbprexis . $this->tabelaAlias () .
				" where " .  $this->whereAtivo () . " and " .
				$this->getalias () . ".tipoevento in ".
				" ( 0 ". str_pad("",$qtdtipo*3,", ?") . " ) ".
				" order by " . $this->getalias () . ".nome  ";

				for($ind = 0;$qtdtipo > $ind;$ind++){
					$this->con->setNumero ( $ind+1, $tipos[$ind] );
				}

				$this->con->setsql ( $query );
				Util::echobr ( 0, 'CampeonatoDAO findByTipos getsql', $this->con->getsql () );
				$result = $this->con->execute ();

				while ( $array = $result->fetch_assoc () ) {
					$this->clt[] = $this->getBeans ( $array );
				}
			} catch ( Exception $e ) {
				throw new Exception ( $e->getMessage () );
			}
		}
		return $this->clt;
	}

	public function findByTipos($tipos) {
		$qtdtipo = count($tipos);

		$this->clt = array ();
		if($qtdtipo>0){
			try {
				$query = " SELECT " . $this->camposSelect () .
				" FROM " . $this->dbprexis . $this->tabelaAlias () .
				" where " . $this->getalias () . ".tipoevento in ".
				" ( 0 ". str_pad("",$qtdtipo*3,", ?") . " ) ".
				" order by " . $this->getalias () . ".nome  ";

				for($ind = 0;$qtdtipo > $ind;$ind++){
					$this->con->setNumero ( $ind+1, $tipos[$ind] );
				}

				$this->con->setsql ( $query );
				Util::echobr ( 0, 'CampeonatoDAO findByTipos getsql', $this->con->getsql () );
				$result = $this->con->execute ();

				while ( $array = $result->fetch_assoc () ) {
					$this->clt[] = $this->getBeans ( $array );
				}
			} catch ( Exception $e ) {
				throw new Exception ( $e->getMessage () );
			}
		}
		return $this->clt;
	}

	public function atual() {
		$this->results = new CampeonatoBean ();
		try {
			$query =
			" SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" where " . $this->whereAtivo ().
			" order by " . $this->getalias () . ".dtinicio desc ";

			$this->con->setsql ( $query );
			Util::echobr ( 0, "CampeonatoDAO atual", $this->con->getsql () );
			$result = $this->con->execute ();

			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}

		return $this->results;
	}

	public function atualByTipo ($tipo) {
		$this->results = new CampeonatoBean ();
		try {
			$query =
			" SELECT " . $this->camposSelect () .
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" where " . $this->whereAtivo () .
			" and " . $this->getalias () . ".tipoevento = ? " .
			" order by " . $this->getalias () . ".dtinicio desc ";

			$this->con->setNumero ( 1, $tipo );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "CampeonatoDAO atual", $this->con->getsql () );

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
		$this->results = new CampeonatoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();

			$query = " DELETE " .
			" FROM " . $this->dbprexis . $this->tabela () .
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


	public function desativar($bean) {
		$this->results = new CampeonatoBean ();
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
			Util::echobr ( 0, "CampeonatoDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}

	public function ativar($bean) {
		$this->results = new CampeonatoBean ();
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
			Util::echobr ( 0, "CampeonatoDAO updateDtEnvio", $this->con->getsql () );
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
