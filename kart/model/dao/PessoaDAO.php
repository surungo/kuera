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
			"pesoextra",
			"dtnascimento",
			"email",
			"cpf",
			"telefone",
			"rg",
            "endereco",
            "numero",
            "complemento",
            "bairro",
            "cidade",
            "uf",
            "cep",
            "tpsanguineo",
            "nmemergencia",
            "telefoneemergencia",
            "cidadeemergencia",
            "ufemergencia",
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
			$query = " UPDATE " . $this->dbprexis . $this->tabela () .//sql 
			" SET " .//sql 
			" dtmodificacao = now(), " .//sql 
			" modificador = ? , " .//sql 
			" dtvalidade = ? , " .//sql 
			" dtinicio = ? , " .//sql 
			" apelido = ifnull(?,apelido) , " .//sql 
			" nome = ifnull(updateacentos(?),nome) , " .//sql 
			" peso = ifnull(?,trim(peso)) , " .//sql 
			" pesoextra = ifnull(?,trim(pesoextra)) , " .//sql 
			" dtnascimento = ifnull(?,dtnascimento) , " .//sql 
			" email = ifnull(?,email) , " .//sql 
			" cpf = ifnull(?,cpf), " .//sql 
			" telefone = ifnull(?,telefone) , " .//sql 
			" rg = ifnull(?,rg) , " .//sql 
            " endereco = ifnull(?,endereco) , " .//sql 
            " numero = ifnull(?,numero) , " .//sql 
            " complemento = ifnull(?,complemento) , " .//sql 
            " bairro = ifnull(?,bairro) , " .//sql 
            " cidade = ifnull(?,cidade) , " .//sql 
            " uf = ifnull(?,uf) , " .//sql 
            " cep = ifnull(?,cep) , " .//sql 
            " tpsanguineo = ifnull(?,tpsanguineo) , " .//sql 
            " nmemergencia = ifnull(?,nmemergencia) , " .//sql 
            " telefoneemergencia = ifnull(?,telefoneemergencia) , " .//sql 
            " cidadeemergencia = ifnull(?,cidadeemergencia) , " .//sql 
            " ufemergencia = ifnull(?,ufemergencia) , " .//sql 
			" tamanhocamisa = ifnull(?,tamanhocamisa), " .//sql 
			" dtvalidaemail = ifnull(?,dtvalidaemail), " .//sql 
			" senha = ifnull(?,senha) " .//sql 
			" WHERE " . $this->idtabela () . " =  ? ";
				
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setTexto (	 6, $bean->getpeso () );
			$this->con->setTexto (	 7, $bean->getpeso () );
			$this->con->setData (	 8, $bean->getdtnascimento () );
			$this->con->setTexto (	 9, $bean->getemail () );
			$this->con->setTexto ( 	10, $bean->getcpfmascara () );
			$this->con->setTexto ( 	11, $bean->gettelefone () );
			$this->con->setTexto ( 	12, $bean->getrg () );
			$this->con->setTexto ( 	13, $bean->getendereco () );
			$this->con->setTexto ( 	14, $bean->getnumero () );
			$this->con->setTexto ( 	15, $bean->getcomplemento () );
			$this->con->setTexto ( 	16, $bean->getbairro () );
			$this->con->setTexto ( 	17, $bean->getcidade () );
			$this->con->setTexto ( 	18, $bean->getuf () );
			$this->con->setTexto ( 	19, $bean->getcep () );
			$this->con->setTexto ( 	20, $bean->gettpsanguineo () );
			$this->con->setTexto ( 	21, $bean->getnmemergencia () );
			$this->con->setTexto ( 	22, $bean->gettelefoneemergencia () );
			$this->con->setTexto ( 	23, $bean->getcidadeemergencia () );
			$this->con->setTexto ( 	24, $bean->getufemergencia () );
			$this->con->setTexto ( 	25, $bean->gettamanhocamisa () );
			$this->con->setData ( 	26, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	27, $bean->getsenha () );
			$this->con->setNumero ( 28, $bean->getid () );
			$this->con->setsql ( $query );
		    $dbg=0;
			Util::echobr ( $dbg, "PessoaDAO updateNotNull", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$dbg=0;
			Util::echobr ( $dbg, 'PessoaDAO updateNotNull $bean',  $bean );
			
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
			$query = " UPDATE " . $this->dbprexis . $this->tabela () .//sql 
			" SET " .//sql 
			" dtmodificacao = now(), " .//sql 
			" modificador = ? , " .//sql 
			" dtvalidade = ? , " .//sql 
			" dtinicio = ? , " .//sql 
			" apelido = ? , " .//sql 
			" nome = trim(?) , " .//sql 
			" peso = trim(?) , " .//sql
			" pesoextra = trim(?) , " .//sql
			" dtnascimento = ? , " .//sql 
			" email = ? , " .//sql 
			" cpf = ? , " .//sql 
			" telefone = ? , " .//sql 
			" rg = ? , " .//sql 
		    " endereco = ? , " .//sql 
		    " numero = ? , " .//sql 
            " complemento = ? , " .//sql 
            " bairro = ? , " .//sql 
            " cidade = ? , " .//sql 
            " uf = ? , " .//sql 
            " cep = ? , " .//sql 
			" tpsanguineo = ? , " .//sql 
            " nmemergencia = ? , " .//sql 
            " telefoneemergencia = ? , " .//sql 
            " cidadeemergencia = ? , " .//sql 
            " ufemergencia = ? , " .//sql 
			" tamanhocamisa = ?, " .//sql 
			" dtvalidaemail = ?, " .//sql 
			" senha = ? " .//sql 
			" WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setTexto (	 1, $bean->getmodificador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setTexto (	 6, $bean->getpeso () );
			$this->con->setTexto (	 7, $bean->getpesoextra () );
			$this->con->setData (	 8, $bean->getdtnascimento () );
			$this->con->setTexto (	 9, $bean->getemail () );
			$this->con->setTexto ( 	10, $bean->getcpfmascara () );
			$this->con->setTexto ( 	11, $bean->gettelefone () );
			$this->con->setTexto ( 	12, $bean->getrg () );
			$this->con->setTexto ( 	13, $bean->getendereco () );
			$this->con->setTexto ( 	14, $bean->getnumero () );
			$this->con->setTexto ( 	15, $bean->getcomplemento () );
			$this->con->setTexto ( 	16, $bean->getbairro () );
			$this->con->setTexto ( 	17, $bean->getcidade () );
			$this->con->setTexto ( 	18, $bean->getuf () );
			$this->con->setTexto ( 	19, $bean->getcep () );
			$this->con->setTexto ( 	20, $bean->gettpsanguineo () );
			$this->con->setTexto ( 	21, $bean->getnmemergencia () );
			$this->con->setTexto ( 	22, $bean->gettelefoneemergencia () );
			$this->con->setTexto ( 	23, $bean->getcidadeemergencia () );
			$this->con->setTexto ( 	24, $bean->getufemergencia () );
			$this->con->setTexto ( 	25, $bean->gettamanhocamisa () );
			$this->con->setData ( 	26, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	27, $bean->getsenha () );
			$this->con->setNumero ( 28, $bean->getid () );
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
			
			$query = " insert into " . $this->dbprexis . $this->tabela () .//sql 
			" ( " .//sql 
			" dtcriacao, " .//sql 
			" criador, " .//sql 
			" dtvalidade, " .//sql 
			" dtinicio, " .//sql 
			" apelido, " .//sql 
			" nome, " .//sql 
			" peso, " .//sql
			" pesoextra, " .//sql
			" dtnascimento, " .//sql 
			" email, " .//sql 
			" cpf, " .//sql 
			" telefone, " .//sql 
			" rg, " .//sql 
		    " endereco, " .//sql 
		    " numero, " .//sql 
            " complemento, " .//sql 
            " bairro, " .//sql 
            " cidade, " .//sql 
            " uf, " .//sql 
            " cep, " .//sql 
			" tpsanguineo, " .//sql 
            " nmemergencia, " .//sql 
            " telefoneemergencia, " .//sql 
            " cidadeemergencia, " .//sql 
            " ufemergencia, " .//sql 
			" tamanhocamisa, " .//sql 
			" dtvalidaemail, " .//sql 
			" senha, " .//sql 
			$this->idtabela () .//sql 
			" )values ( " .//sql 
			" now(), " . 	    // dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" trim(?), " . 			// apelido,
			" trim(?), " . 			// nome,
			" trim(?), " . 			// peso,
			" trim(?), " . 			// pesoextra,
			" ?, " . 			// dtnascimento,
			" ?, " . 			// email,
			" ?, " . 			// cpf,
			" ?, " . 			// telefone,
			" ?, " . 			// rg,
			" ?, " . 			// endereco,
			" ?, " . 			// numero,
			" ?, " . 			// complemento,
			" ?, " . 			// bairro,
			" ?, " . 			// cidade,
			" ?, " . 			// uf,
			" ?, " . 			// cep,
			" ?, " . 			// tpsanguineo,
			" ?, " . 			// nmemergencia,
			" ?, " . 			// telefoneemergencia,
			" ?, " . 			// cidadeemergencia,
			" ?, " . 			// ufemergencia,
			" ?, " . 			// tamanhocamisa,
			" ?, " . 			// dtvalidaemail,
			" ?, " . 			// senha,
			" ? )"; // id;
			
			$this->con->setTexto (	 1, $bean->getcriador () );
			$this->con->setData (	 2, $bean->getdtvalidade () );
			$this->con->setData (	 3, $bean->getdtinicio () );
			$this->con->setTexto (	 4, $bean->getapelido () );
			$this->con->setTexto (	 5, $bean->getnome () );
			$this->con->setTexto (	 6, $bean->getpeso () );
			$this->con->setTexto (	 7, $bean->getpesoextra () );
			$this->con->setData (	 8, $bean->getdtnascimento () );
			$this->con->setTexto (	 9, $bean->getemail () );
			$this->con->setTexto ( 	10, $bean->getcpfmascara () );
			$this->con->setTexto ( 	11, $bean->gettelefone () );
			$this->con->setTexto ( 	12, $bean->getrg () );
			$this->con->setTexto ( 	13, $bean->getendereco () );
			$this->con->setTexto ( 	14, $bean->getnumero () );
			$this->con->setTexto ( 	15, $bean->getcomplemento () );
			$this->con->setTexto ( 	16, $bean->getbairro () );
			$this->con->setTexto ( 	17, $bean->getcidade () );
			$this->con->setTexto ( 	18, $bean->getuf () );
			$this->con->setTexto ( 	19, $bean->getcep () );
			$this->con->setTexto ( 	20, $bean->gettpsanguineo () );
			$this->con->setTexto ( 	21, $bean->getnmemergencia () );
			$this->con->setTexto ( 	22, $bean->gettelefoneemergencia () );
			$this->con->setTexto ( 	23, $bean->getcidadeemergencia () );
			$this->con->setTexto ( 	24, $bean->getufemergencia () );
			$this->con->setTexto ( 	25, $bean->gettamanhocamisa () );
			$this->con->setData ( 	26, $bean->getdtvalidaemail () );
			$this->con->setTexto ( 	27, $bean->getsenha () );
			$this->con->setNumero ( 28, $bean->getid () );
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
		$this->bean->setpesoextra ( $this->getValorArray ( $array, "pesoextra", null ) );
		$this->bean->setdtnascimento ( $this->getValorArray ( $array, "dtnascimento", null ) );
		$this->bean->setemail ( $this->getValorArray ( $array, "email", null ) );
		$this->bean->setcpf ( $this->getValorArray ( $array, "cpf", null ) );
		$this->bean->settelefone ( $this->getValorArray ( $array, "telefone", null ) );
		$this->bean->setrg ( $this->getValorArray ( $array, "rg", null ) );
		$this->bean->setendereco ( $this->getValorArray ( $array, "endereco", null ) );
		$this->bean->setnumero ( $this->getValorArray ( $array, "numero", null ) );
		$this->bean->setcomplemento ( $this->getValorArray ( $array, "complemento", null ) );
		$this->bean->setbairro ( $this->getValorArray ( $array, "bairro", null ) );
		$this->bean->setcidade ( $this->getValorArray ( $array, "cidade", null ) );
		$this->bean->setuf ( $this->getValorArray ( $array, "uf", null ) );
		$this->bean->setcep ( $this->getValorArray ( $array, "cep", null ) );
		$this->bean->settpsanguineo ( $this->getValorArray ( $array, "tpsanguineo", null ) );
		$this->bean->setnmemergencia ( $this->getValorArray ( $array, "nmemergencia", null ) );
		$this->bean->settelefoneemergencia ( $this->getValorArray ( $array, "telefoneemergencia", null ) );
		$this->bean->setcidadeemergencia ( $this->getValorArray ( $array, "cidadeemergencia", null ) );
		$this->bean->setufemergencia ( $this->getValorArray ( $array, "ufemergencia", null ) );
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
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
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

	public function findAllValidos() {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where " .//sql 
			" IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " .//sql 
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
			$query = " SELECT " .//sql 
			$this->camposSelect () .//sql 
			" FROM " .//sql 
			$this->dbprexis . $this->tabelaAlias () .//sql 
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
	
		public function findId($id) {
		$this->results = new PessoaBean ();
		Util::echobr ( 0, "PessoaDAO findId id", $id );
		
		try {
			$query = " SELECT " .//sql 
					$this->camposSelect ()  .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
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
	
	public function findById($bean) {
		$this->results = new PessoaBean ();
		Util::echobr ( 0, "PessoaDAO findById id",  Util::getIdObjeto($bean) );
		
		try {
			$query = " SELECT " .//sql 
					" updateacentos(".$this->getalias () .".apelido) ".$this->getalias () ."_apelido, ".//sql 
					" updateacentos(".$this->getalias () .".nome) ".$this->getalias () ."_nome, ".//sql 
					" ".$this->getalias () .".peso ".$this->getalias () ."_peso, ".//sql
					" ".$this->getalias () .".pesoextra ".$this->getalias () ."_pesoextra, ".//sql
					" ".$this->getalias () .".dtnascimento ".$this->getalias () ."_dtnascimento, ".//sql 
					" ".$this->getalias () .".email ".$this->getalias () ."_email, ".//sql 
					" ".$this->getalias () .".cpf ".$this->getalias () ."_cpf, ".//sql 
					" ".$this->getalias () .".telefone ".$this->getalias () ."_telefone, ".//sql 
					" ".$this->getalias () .".tamanhocamisa ".$this->getalias () ."_tamanhocamisa, ".//sql 
					" ".$this->getalias () .".dtvalidaemail ".$this->getalias () ."_dtvalidaemail, ".//sql 
					" ".$this->getalias () .".senha ".$this->getalias () ."_senha, ".//sql 
					" ".$this->getalias () .".idpessoa ".$this->getalias () ."_idpessoa " .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
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
			$query = " SELECT " .//sql 
			$this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where REPLACE(REPLACE(" . $this->getalias () . ".cpf, '.', ''), '-', '') = REPLACE(REPLACE(?, '.', ''), '-', '') " .//sql 
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
}

?>