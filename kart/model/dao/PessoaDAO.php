<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';


class PessoaDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "pessoa";
	protected $tabela = "pessoa";
	protected $idtabela = "idpessoa";
	protected $campos = array (
			"apelido",
			"nome",
			"peso",
			"dtnascimento",
			"email",
			"cpf",
			"telefone",
			"tamanhocamisa",
			"dtvalidaemail",
			"senha",
			"idpessoa" 
	);
	protected $ordernome = "pessoa.nome";
	
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}

	public function updateNotNull($bean) {
		$this->results = new PessoaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " . $this->dbprexis . $this->tabela () .
			" SET " .
			" dtmodificacao = now(), " .
			" modificador = ? , " .
			" dtvalidade = ? , " .
			" dtinicio = ? , " .
			" apelido = ifnull(?,apelido) , " .
			" nome = ifnull(updateacentos(?),nome) , " .
			" peso = ifnull(?,peso) , " .
			" dtnascimento = ifnull(?,dtnascimento) , " .
			" email = ifnull(?,email) , " .
			" cpf = ifnull(?,cpf), " .
			" telefone = ifnull(?,telefone) , " .
			" tamanhocamisa = ifnull(?,tamanhocamisa), " .
			" dtvalidaemail = ifnull(?,dtvalidaemail), " .
			" senha = ifnull(?,senha) " .
			" WHERE " . $this->idtabela () . " =  ? ";
				
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setNumero (	 6, $bean->getpeso () );
			$this->con->setData (	 7, $bean->getdtnascimento () );
			$this->con->setTexto (	 8, $bean->getemail () );
			$this->con->setTexto ( 	 9, $bean->getcpfmascara () );
			$this->con->setTexto ( 	10, $bean->gettelefone () );
			$this->con->setTexto ( 	11, $bean->gettamanhocamisa () );
			$this->con->setData ( 	12, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	13, $bean->getsenha () );
			$this->con->setNumero ( 14, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO update", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function update($bean) {
		$this->results = new PessoaBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . 
			" SET " . 
			" dtmodificacao = now(), " . 
			" modificador = ? , " . 
			" dtvalidade = ? , " . 
			" dtinicio = ? , " . 
			" apelido = ? , " . 
			" nome = updateacentos(?) , " . 
			" peso = ? , " . 
			" dtnascimento = ? , " . 
			" email = ? , " . 
			" cpf = ? , " . 
			" telefone = ? , " . 
			" tamanhocamisa = ?, " . 
			" dtvalidaemail = ?, " . 
			" senha = ? " . 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setNumero (	 6, $bean->getpeso () );
			$this->con->setData (	 7, $bean->getdtnascimento () );
			$this->con->setTexto (	 8, $bean->getemail () );
			$this->con->setTexto ( 	 9, $bean->getcpfmascara () );
			$this->con->setTexto ( 	10, $bean->gettelefone () );
			$this->con->setTexto ( 	11, $bean->gettamanhocamisa () );
			$this->con->setData ( 	12, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	13, $bean->getsenha () );
			$this->con->setNumero ( 14, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO update", $this->con->getsql () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . 
			" ( " . 
			" dtcriacao, " . 
			" criador, " . 
			" dtvalidade, " . 
			" dtinicio, " . 
			" apelido, " . 
			" nome, " . 
			" peso, " . 
			" dtnascimento, " . 
			" email, " . 
			" cpf, " . 
			" telefone, " . 
			" tamanhocamisa, " . 
			" dtvalidaemail, " . 
			" senha, " . 
			$this->idtabela () . 
			" )values ( " . 
			" now(), " . 	    // dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// apelido,
			" updateacentos(?), " . 			// nome,
			" ?, " . 			// peso,
			" ?, " . 			// dtnascimento,
			" ?, " . 			// email,
			" ?, " . 			// cpf,
			" ?, " . 			// telefone,
			" ?, " . 			// tamanhocamisa,
			" ?, " . 			// dtvalidaemail,
			" ?, " . 			// senha,
			" ? )"; // id;
			
			$this->con->setTexto (	 1, $bean->getcriador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setNumero (	 6, $bean->getpeso () );
			$this->con->setData (	 7, $bean->getdtnascimento () );
			$this->con->setTexto (	 8, $bean->getemail () );
			$this->con->setTexto ( 	 9, $bean->getcpfmascara () );
			$this->con->setTexto ( 	10, $bean->gettelefone () );
			$this->con->setData ( 	11, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	12, $bean->gettamanhocamisa () );
			$this->con->setTexto ( 	13, $bean->getsenha () );
			$this->con->setNumero ( 14, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO insert", $this->con->getsql () );
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
		$this->bean = new PessoaBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idpessoa", null ) );
		$this->bean->setapelido ( $this->getValorArray ( $array, "apelido", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setpeso ( $this->getValorArray ( $array, "peso", null ) );
		$this->bean->setdtnascimento ( $this->getValorArray ( $array, "dtnascimento", null ) );
		$this->bean->setemail ( $this->getValorArray ( $array, "email", null ) );
		$this->bean->setcpf ( $this->getValorArray ( $array, "cpf", null ) );
		$this->bean->settelefone ( $this->getValorArray ( $array, "telefone", null ) );
		$this->bean->settamanhocamisa ( $this->getValorArray ( $array, "tamanhocamisa", null ) );
		$this->bean->setdtvalidaemail ( $this->getValorArray ( $array, "dtvalidaemail", null ) );
		$this->bean->setsenha ( $this->getValorArray ( $array, "senha", null ) );
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padrão
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" ORDER BY " . $this->ordernome;
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
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . 
			$this->camposSelect () . 
			" FROM " . 
			$this->dbprexis . $this->tabelaAlias () . 
			" ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO findAllSort", $this->con->getsql () );
			
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
		$this->results = new PessoaBean ();
		Util::echobr ( 0, "PessoaDAO findById id", $id );
		
		try {
			$query = " SELECT " .
					" updateacentos(".$this->getalias () .".apelido) ".$this->getalias () ."_apelido, ".
					" updateacentos(".$this->getalias () .".nome) ".$this->getalias () ."_nome, ".
					" ".$this->getalias () .".peso ".$this->getalias () ."_peso, ".
					" ".$this->getalias () .".dtnascimento ".$this->getalias () ."_dtnascimento, ".
					" ".$this->getalias () .".email ".$this->getalias () ."_email, ".
					" ".$this->getalias () .".cpf ".$this->getalias () ."_cpf, ".
					" ".$this->getalias () .".telefone ".$this->getalias () ."_telefone, ".
					" ".$this->getalias () .".tamanhocamisa ".$this->getalias () ."_tamanhocamisa, ".
					" ".$this->getalias () .".dtvalidaemail ".$this->getalias () ."_dtvalidaemail, ".
					" ".$this->getalias () .".senha ".$this->getalias () ."_senha, ".
					" ".$this->getalias () .".idpessoa ".$this->getalias () ."_idpessoa " .
			" FROM " . $this->dbprexis . $this->tabelaAlias () . 
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO findById", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPF($cpf) {
		$this->results = new PessoaBean ();
		
		try {
			$query = " SELECT " . 
			$this->camposSelect () .  
			" FROM " . $this->dbprexis . $this->tabelaAlias () .
			" where REPLACE(REPLACE(" . $this->getalias () . ".cpf, '.', ''), '-', '') = REPLACE(REPLACE(?, '.', ''), '-', '') " . 
			" ORDER BY " . $this->ordernome;
			$this->con->setTexto ( 1, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "PessoaDAO findByCPF", $this->con->getsql () );
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
		$this->results = new PessoaBean ();
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
}

?>