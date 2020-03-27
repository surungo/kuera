<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoCampeonatoDAO.php';
class PilotoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "piloto";
	protected $tabela = "piloto";
	protected $idtabela = "idpiloto";
	protected $campos = array (
			"nome",
			"apelido",
			"peso",
			"facebook",
			"foto",
			"fotoimg",
			"dtnascimento",
			"descricao",
			"observacao",
			"cpf",
			"telefone",
			"email",
			"nomejoin",
			"idpessoa",
			"idpiloto",
			"sigla" 
	);
	protected $ordernome = "piloto.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function updateimg($bean) {
		$dbg = 0;
		$this->results = new PilotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . " dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" nome = trim(?) , " . 
			" apelido = trim(?) , " . 
			" peso = ? , " . 
			" facebook = ? , " . 
			" foto = ? , " . 
			" fotoimg = ifnull(?,fotoimg) , " . 
			" dtnascimento = ?, " . 
			" descricao = ?, " . 
			" observacao = ?, " . 
			" cpf = ?, " . 
			" telefone = ?, " . 
			" email = ?, " . 
			" nomejoin = trim(?), " . 
			" idpessoa = ? , " .
			" sigla = ? " . 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getnome () );
			$this->con->setTexto ( 5, $bean->getapelido () );
			$this->con->setTexto ( 6, $bean->getpeso () );
			$this->con->setTexto ( 7, $bean->getfacebook () );
			$this->con->setTexto ( 8, $bean->getfoto () );
			$this->con->setTexto ( 9, $bean->getfotoimg () );
			$this->con->setData ( 10, $bean->getdtnascimento () );
			$this->con->setTexto ( 11, $bean->getdescricao () );
			$this->con->setTexto ( 12, $bean->getobservacao () );
			$this->con->setTexto ( 13, $bean->getcpf () );
			$this->con->setTexto ( 14, $bean->gettelefone () );
			$this->con->setTexto ( 15, $bean->getemail () );
			$this->con->setTexto ( 16, $bean->getnomejoin () );
			$this->con->setNumero ( 17, Util::getIdObjeto($bean->getpessoa ()) );
			$this->con->setTexto ( 18, $bean->getsigla () );
			$this->con->setNumero ( 19, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( $dbg, 'PilotoDAO updateimg $this->con->getsql()', $this->con->getsql () );
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " registro(s) atualizado(s)." );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	public function update($bean) {
		$this->results = new PilotoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . " dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" nome = trim(?) , " . 
			" apelido = trim(?) , " . 
			" peso = ? , " . 
			" facebook = ? , " . 
			" foto = ? , " . 
			" dtnascimento = ?, " . 
			" descricao = ?, " . 
			" observacao = ?, " . 
			" cpf = ?, " . 
			" telefone = ?, " . 
			" email = ?, " . 
			" nomejoin = trim(?), " . 
			" idpessoa = ?, " . 
			" sigla = ? " . 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getnome () );
			$this->con->setTexto ( 5, $bean->getapelido () );
			$this->con->setTexto ( 6, $bean->getpeso () );
			$this->con->setTexto ( 7, $bean->getfacebook () );
			$this->con->setTexto ( 8, $bean->getfoto () );
			$this->con->setData ( 9, $bean->getdtnascimento () );
			$this->con->setTexto ( 10, $bean->getdescricao () );
			$this->con->setTexto ( 11, $bean->getobservacao () );
			$this->con->setTexto ( 12, $bean->getcpf () );
			$this->con->setTexto ( 13, $bean->gettelefone () );
			$this->con->setTexto ( 14, $bean->getemail () );
			$this->con->setTexto ( 15, $bean->getnomejoin () );
			$this->con->setNumero ( 16, Util::getIdObjeto($bean->getpessoa ()) );
			$this->con->setTexto ( 17, $bean->getsigla () );
			$this->con->setNumero ( 18, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'PilotoDAO update $this->con->getsql()', $this->con->getsql () );
			
			$this->con->execute ();
			
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " registro(s) atualizado(s).</span>" );
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
			" nome, " . 
			" apelido, " . 
			" peso, " . 
			" facebook, " . 
			" foto, " . 
			" fotoimg, " . 
			" dtnascimento, " . 
			" descricao, " . 
			" observacao, " . 
			" cpf, " .
			" telefone, " . 
			" email, " . 
			" nomejoin, " . 
			" idpessoa, " . 
			" sigla, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" trim(?), " . 			// nome,
			" trim(?), " . 			// apelido,
			" ?, " . 			// peso,
			" ?, " . 			// facebook,
			" ?, " . 			// foto,
			" ?, " . 			// fotoimg,
			" ?, " . 			// dtnascimento,
			" ?, " . 			// descricao,
			" ?, " . 			// observacao,
			" ?, " . 			// cpf,
			" ?, " . 			// telefone,
			" ?, " . 			// email,
			" trim(?), " . 			// nomejoin,
			" ?, " . 			// idpessoa,
			" ?, " . 			// sigla,
			" ? )"; // id;
			
			$this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setTexto ( 4, $bean->getnome () );
			$this->con->setTexto ( 5, $bean->getapelido () );
			$this->con->setTexto ( 6, $bean->getpeso () );
			$this->con->setTexto ( 7, $bean->getfacebook () );
			$this->con->setTexto ( 8, $bean->getfoto () );
			$this->con->setTexto ( 9, $bean->getfotoimg () );
			$this->con->setData ( 10, $bean->getdtnascimento () );
			$this->con->setTexto ( 11, $bean->getdescricao () );
			$this->con->setTexto ( 12, $bean->getobservacao () );
			$this->con->setTexto ( 13, $bean->getcpf () );
			$this->con->setTexto ( 14, $bean->gettelefone () );
			$this->con->setTexto ( 15, $bean->getemail () );
			$this->con->setTexto ( 16, $bean->getnomejoin () );
			$this->con->setNumero ( 17, Util::getIdObjeto($bean->getpessoa ()) );
			$this->con->setTexto ( 18, $bean->getsigla () );
			$this->con->setNumero ( 19, $bean->getid () );
			$this->con->setsql ( $query );
			// echo $this->con->getsql();
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
		$this->bean = new PilotoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpiloto", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setapelido ( $this->getValorArray ( $array, "apelido", null ) );
		$this->bean->setpeso ( $this->getValorArray ( $array, "peso", null ) );
		$this->bean->setfacebook ( $this->getValorArray ( $array, "facebook", null ) );
		$this->bean->setfoto ( $this->getValorArray ( $array, "foto", null ) );
		$this->bean->setfotoimg ( $this->getValorArray ( $array, "fotoimg", null ) );
		$this->bean->setdtnascimento ( $this->getValorArray ( $array, "dtnascimento", null ) );
		$this->bean->setcpf ( $this->getValorArray ( $array, "cpf", null ) );
		$this->bean->setemail ( $this->getValorArray ( $array, "email", null ) );
		$this->bean->settelefone ( $this->getValorArray ( $array, "telefone", null ) );
		$this->bean->setdescricao ( $this->getValorArray ( $array, "descricao", null ) );
		$this->bean->setobservacao ( $this->getValorArray ( $array, "observacao", null ) );
		$this->bean->setnomejoin ( $this->getValorArray ( $array, "nomejoin", null ) );
		$this->bean->setpessoa ( $this->getValorArray ( $array, "idpessoa", null ) );
		$this->bean->setsigla ( $this->getValorArray ( $array, "sigla", null ) );
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padrao
	public function findAllAtivo() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where " . $this->whereAtivo () . " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoDAO findAllAtivo", $this->con->getsql () );
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
	public function findById($bean) {
		$this->results = new PilotoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
			$this->con->setsql ( $query );
			// echo $this->con->getsql();
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPF($cpf) {
		$this->results = new PilotoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where cpfClean(" . $this->getalias () . ".cpf) = ? ";
			$this->con->setTexto ( 1, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoDAO findByCPF", $this->con->getsql () );
			
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByPessoa($pessoa) {
		$this->results = new PilotoBean ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->getalias () . ".idpessoa = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($pessoa));
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoDAO findByPessoa", $this->con->getsql () );
			
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findInscritoSemelhante($inscritoBean) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . " (  " . " tiraacento(upper(" . $this->getalias () . ".nome)) = tiraacento(upper(?))" . " or " . " tiraacento(upper(" . $this->getalias () . ".apelido)) = tiraacento(upper(?))" . " or " . " tiraacento(upper(" . $this->getalias () . ".nomejoin)) = tiraacento(upper(?)) " . " or " . " (" . $this->getalias () . ".dtnascimento = ? AND " . " " . $this->getalias () . ".dtnascimento != '' )" . " ) ";
			$this->con->setTexto ( 1, $inscritoBean->getnome () );
			$this->con->setTexto ( 2, $inscritoBean->getnome () );
			$this->con->setTexto ( 3, $inscritoBean->getnome () );
			$this->con->setTexto ( 4, $inscritoBean->getdtnascimento () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PilotoDAO findInscritoSemelhante sql", $this->con->getsql () );
			
			$result = $this->con->execute ();
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
			Util::echobr ( 0, "PilotoDAO findInscritoSemelhante return", $this->clt );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findCampeonatoNotBateria($idcampeonato) {
		$this->clt = array ();
		$pilotoCampeonatoDao = new PilotoCampeonatoDAO ( $this->con );
		$pilotoBateriaDao = new PilotoBateriaDAO ( $this->con );
		
		$bateriaDao = new BateriaDAO ( $this->con );
		$etapaDao = new EtapaDAO ( $this->con );
		
		try {
			Util::echobr ( 0, 'PilotoDao findCampeonatoNotBateria', $idcampeonato );
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " inner join " . $this->dbprexis . $pilotoCampeonatoDao->tabelaAlias () . " on " . $this->idtabelaAlias () . " = " . $pilotoCampeonatoDao->getalias () . ".idpiloto " . " where " . $this->whereAtivo () . " and " . $pilotoCampeonatoDao->getalias () . ".idcampeonato = ? " . " and not exists ( " . " select 1 " . " from " . $this->dbprexis . $pilotoBateriaDao->tabelaAlias () . " inner join " . $this->dbprexis . $bateriaDao->tabelaAlias () . " on " . $pilotoBateriaDao->getalias () . ".idbateria = " . $bateriaDao->idtabelaAlias () . " inner join " . $this->dbprexis . $etapaDao->tabelaAlias () . " on " . $bateriaDao->getalias () . ".idetapa = " . $etapaDao->idtabelaAlias () . " where " . $pilotoBateriaDao->getalias () . ".idpiloto = " . $this->getalias () . ".idpiloto" . " and " . $pilotoBateriaDao->whereAtivo () . " and " . $bateriaDao->whereAtivo () . " and " . $etapaDao->whereAtivo () . " ) " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, 'PilotoDao $query', $query );
			$this->con->setNumero ( 1, $idcampeonato );
			$this->con->setsql ( $query );
			Util::echobr ( 0, 'PilotoDAO findCampeonatoNotBateria sql', $this->con->getsql () );
			
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
		$this->results = new PilotoBean ();
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