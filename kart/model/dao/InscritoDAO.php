<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PessoaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/GrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaInscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
class InscritoDAO extends AbstractDAO {
	protected $dbprexis = "kart_";
	protected $alias = "inscrito";
	protected $tabela = "inscrito";
	protected $idtabela = "idinscrito";
	protected $campos = array (
			"idcampeonato",
			"apelido",
			"nome",
			"peso",
			"pesoextra",
			"dtnascimento",
			"email",
			"cpf",
			"telefone",
			"valor",
			"grupo",
			"situacao",
			"dtpagamento",
			"tamanhocamisa",
			"dtvalidaemail",
			"dtinscricao",
			"idpessoa",
			"nrinscrito",
			"carro",
			"nrcarro",
			"endereco",
			"nrcba",
			"cidade",
			"uf",
			"cep",
			"celular",
			"telefonecomercial",
			"chefeequipe",
			"complemento",
			"bairro",
			"evento",
			"ipcriacao",
			"dtenvio",
			"numero",
			"idinscrito" 
	);
	protected $ordernome = "inscrito.nome";
	public function __construct($_conn) {
		parent::__construct ( $_conn );
	}
	public function update($bean) {
		$this->results = new InscritoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " .//sql 
			$this->dbprexis . $this->tabela () .//sql 
			" SET " . " dtmodificacao = now(), " .//sql 
			" modificador = ? , " . 			//  1
			" dtvalidade = ? , " . 				//  2
			" dtinicio = ? , " .   				//  3
			" idcampeonato = ? , " . 			//  4 
			" apelido = trim(?) , " .  //  5
			" nome = trim(?) , " .     //  6 
			" peso = trim(?) , " .                    //  7
			" pesoextra = trim(?) , " .                    //  8
			" dtnascimento = ? , " .            //  9
			" email = ? , " .                   // 10
			" cpf = ? , " .                     // 11
			" telefone = ? , " .                // 12
			" valor = ? , " .                   // 13
			" grupo = ? , " .                   // 14 
			" situacao = ? , " .                // 15
			" dtpagamento = ? , " .             // 16
			" tamanhocamisa = ?, " .            // 17
			" dtvalidaemail = ?, " .            // 18
			" dtinscricao = ?, " .              // 19
			" idpessoa = ?, " .                 // 20
			" nrinscrito = ?, " .               // 21
			" carro = ?, " .     // 22
			" nrcarro = ?, " .                  // 23
			" endereco = ?, " .  // 24
			" nrcba = ?, " .                    // 25
			" cidade = ?, " .    // 26
			" uf = ?, " .        // 27
			" cep = ?, " .                       // 28
		    	" celular = ?, " .                   // 29
			" telefonecomercial = ?, " .         // 30
		
			" chefeequipe = ?, " . // 31
			" complemento = ?, " . // 32
			" bairro = ?, " .	  // 33
			" evento = ?, " . 		// 34
			" ipcriacao = ?, " .               	// 35
			" dtenvio = ?, " .	                //	 36
			" numero = ? " .                   //	 37
			" WHERE " . $this->idtabela () . " =  ? "; // 38
			
			$this->con->setTexto ( 1, $bean->getmodificador () );
			$this->con->setData ( 2, $bean->getdtvalidade () );
			$this->con->setData ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 5, $bean->getapelido () );
			$this->con->setTexto ( 6, $bean->getnome () );
			$this->con->setTexto ( 7, $bean->getpeso () );
			$this->con->setTexto ( 8, $bean->getpesoextra () );
			$this->con->setData ( 9, $bean->getdtnascimento () );
			$this->con->setTexto ( 10, $bean->getemail () );
			$this->con->setTexto ( 11, $bean->getcpf () );
			$this->con->setTexto ( 12, $bean->gettelefone () );
			$this->con->setTexto ( 13, $bean->getvalor () );
			$this->con->setTexto ( 14, $bean->getgrupo () );
			$this->con->setTexto ( 15, $bean->getsituacao () );
			$this->con->setData ( 16, $bean->getdtpagamento () );
			$this->con->setTexto ( 17, $bean->gettamanhocamisa () );
			$this->con->setData ( 18, $bean->getdtvalidaemail () );
			$this->con->setData ( 19, $bean->getdtinscricao () );
			$this->con->setNumero ( 20, Util::getIdObjeto ( $bean->getpessoa () ) );
			$this->con->setNumero ( 21, $bean->getnrinscrito () );
			$this->con->setTexto ( 22, $bean->getcarro () );
			$this->con->setTexto ( 23, $bean->getnrcarro () );
			$this->con->setTexto ( 24, $bean->getendereco () );
			$this->con->setTexto ( 25, $bean->getnrcba () );
			$this->con->setTexto ( 26, $bean->getcidade () );
			$this->con->setTexto ( 27, $bean->getuf () );
			$this->con->setNumero ( 28, $bean->getcep () );
			$this->con->setTexto ( 29, $bean->getcelular () );
			$this->con->setTexto ( 30, $bean->gettelefonecomercial () );
			$this->con->setTexto ( 31, $bean->getchefeequipe () );
			$this->con->setTexto ( 32, $bean->getcomplemento () );
			$this->con->setTexto ( 33, $bean->getbairro() );
			$this->con->setTexto ( 34, $bean->getevento () );
			$this->con->setTexto ( 35, $bean->getipcriacao () );
			$this->con->setTexto ( 36, $bean->getdtenvio () );
			$this->con->setNumero ( 37, $bean->getnumero () );
			$this->con->setNumero ( 38, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO update", $this->con->getsql () );
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
			$usuarioLoginBean = $this->getoperador ();
			Util::echobr ( 0, 'InscritoDAO insert $usuarioLoginBean', $usuarioLoginBean );
			if ($usuarioLoginBean != null) {
				$bean->setcriador ( $usuarioLoginBean->getusuario () );
			}
			$bean->setid ( $this->getid ( $this->dbprexis ) );
			
			$query = " insert into " . $this->dbprexis . $this->tabela () . " ( " .//sql 
					" dtcriacao, " .//sql 
					" criador, " .//sql 
					" dtvalidade, " .//sql 
					" dtinicio, " .//sql 
					" idcampeonato, " .//sql 
					" apelido, " .//sql 
					" nome, " .//sql 
					" peso, " .//sql 
					" pesoextra, " .//sql 
					" dtnascimento, " .//sql 
					" email, " .//sql 
					" cpf, " .//sql 
					" telefone, " .//sql 
					" valor, " .//sql 
					" grupo, " .//sql 
					" situacao, " .//sql 
					" dtpagamento, " .//sql 
					" tamanhocamisa, " .//sql 
					" dtvalidaemail, " .//sql 
					" dtinscricao, " .//sql 
					" idpessoa, " .//sql 
					" nrinscrito, " .//sql 
					" carro, " .//sql 
					" nrcarro, " .//sql 
					" endereco, " .//sql 
					" nrcba, " .//sql 
					" cidade, " .//sql 
					" uf," .//sql 
					" cep," .//sql 
					" celular, " .                    // sql
					" telefonecomercial, " .          // sql
					" chefeequipe, " .                // sql
					" complemento, " .                // sql
					" bairro, " .            		    //sql
					" evento, " .                		// sql
					" ipcriacao, " .                	// sql
					" dtenvio, " . 	                // sql
					" numero, " . 	                // sql
					$this->idtabela () .//sql 
					" )values ( " .//sql 
			" now(), " . 			// dtcriacao,
			" ?, " . 			// criador,
			" ?, " . 			// dtvalidade,
			" ?, " . 			// dtinicio,
			" ?, " . 			// idcampeonato,
			" trim(?), " . 			// apelido,
			" trim(?), " . 			// nome,
			" trim(?), " . 			// peso,
			" trim(?), " . 			// pesoextra,
			" ?, " . 			// dtnascimento,
			" ?, " . 			// email,
			" ?, " . 			// cpf,
			" ?, " . 			// telefone,
			" ?, " . 			// valor,
			" ?, " . 			// grupo,
			" ?, " . 			// situacao,
			" ?, " . 			// dtpagamento,
			" ?, " . 			// tamanhocamisa,
			" ?, " . 			// dtvalidaemail,
			" ?, " . 			// dtinscricao,
			" ?, " . 			// idpessoa,
			" ?, " . 			// nrinscricao,
			" ?, " . 			// carro, " .//sql 
			" ?, " . 			// nrcarro, " .//sql 
			" ?, " . 			// endereco, " .//sql 
			" ?, " . 			// nrcba, " .//sql 
			" ?, " . 			// cidade, " .//sql 
			" ?, " . 			// uf," .//sql 
			" ?, " . 			// cep," .//sql 
			" ?, " . 			// celular," .//sql 
			" ?, " . 			// telefonecomercial," .//sql 
			" ?, " . 			// chefeequipe," .//sql 
			" ?, " . 			// complemento," .//sql 
			" ?, " . 			// bairro," .//sql 
			" ?, " . 			// evento," .//sql 
			" ?, " . 			// ipcriacao," .//sql 
			" ?, " . 			// dtenvio," .//sql 
			" ?, " . 			// numero," .//sql 
					
			" ? )"; // id;
			
			$this->con->setTexto  ( 1, $bean->getcriador () );
			$this->con->setData   ( 2, $bean->getdtvalidade () );
			$this->con->setData   ( 3, $bean->getdtinicio () );
			$this->con->setNumero ( 4, $bean->getcampeonato () );
			$this->con->setTexto  ( 5, $bean->getapelido () );
			$this->con->setTexto  ( 6, $bean->getnome () );
			$this->con->setTexto  ( 7, $bean->getpeso () );
			$this->con->setTexto  ( 8, $bean->getpesoextra () );
			$this->con->setData   ( 9, $bean->getdtnascimento () );
			$this->con->setTexto  ( 10, $bean->getemail () );
			$this->con->setTexto  ( 11, $bean->getcpf () );
			$this->con->setTexto  ( 12, $bean->gettelefone () );
			$this->con->setTexto  ( 13, $bean->getvalor () );
			$this->con->setTexto  ( 14, $bean->getgrupo () );
			$this->con->setTexto  ( 15, $bean->getsituacao () );
			$this->con->setData   ( 16, $bean->getdtpagamento () );
			$this->con->setTexto  ( 17, $bean->gettamanhocamisa () );
			$this->con->setData   ( 18, $bean->getdtvalidaemail () );
			$this->con->setData   ( 19, $bean->getdtinscricao () );
			$this->con->setNumero ( 20, $bean->getpessoa () );
			$this->con->setNumero ( 21, $bean->getnrinscrito () );
			$this->con->setTexto  ( 22, $bean->getcarro () );
			$this->con->setTexto  ( 23, $bean->getnrcarro () );
			$this->con->setTexto  ( 24, $bean->getendereco () );
			$this->con->setTexto  ( 25, $bean->getnrcba () );
			$this->con->setTexto  ( 26, $bean->getcidade () );
			$this->con->setTexto  ( 27, $bean->getuf () );
			$this->con->setNumero ( 28, $bean->getcep () );
			$this->con->setTexto  ( 29, $bean->getcelular () );
			$this->con->setTexto  ( 30, $bean->gettelefonecomercial () );
			$this->con->setTexto  ( 31, $bean->getchefeequipe () );
			$this->con->setTexto  ( 32, $bean->getcomplemento () );
			$this->con->setTexto  ( 33, $bean->getbairro() );
			$this->con->setTexto  ( 34, $bean->getevento () );
			$this->con->setTexto  ( 35, $bean->getipcriacao () );
			$this->con->setTexto  ( 36, $bean->getdtenvio () );
			$this->con->setNumero ( 37, $bean->getnumero () );
			$this->con->setNumero ( 38, $bean->getid () );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO insert", $this->con->getsql () );
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
		$this->bean = new InscritoBean ();
		$this->bean->setid ( $this->getValorArray ( $array, "idinscrito", null ) );
		$this->bean->setcampeonato ( $this->getValorArray ( $array, "idcampeonato", new CampeonatoDAO ( $this->con ) ) );
		$this->bean->setapelido ( $this->getValorArray ( $array, "apelido", null ) );
		$this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
		$this->bean->setpeso ( $this->getValorArray ( $array, "peso", null ) );
		$this->bean->setpesoextra ( $this->getValorArray ( $array, "pesoextra", null ) );
		$this->bean->setdtnascimento ( $this->getValorArray ( $array, "dtnascimento", null ) );
		$this->bean->setemail ( $this->getValorArray ( $array, "email", null ) );
		$this->bean->setcpf ( $this->getValorArray ( $array, "cpf", null ) );
		$this->bean->setvalor ( $this->getValorArray ( $array, "valor", null ) );
		$this->bean->settelefone ( $this->getValorArray ( $array, "telefone", null ) );
		$this->bean->setgrupo ( $this->getValorArray ( $array, "grupo", new GrupoDAO ( $this->con ) ) );
		$this->bean->setsituacao ( $this->getValorArray ( $array, "situacao", null ) );
		$this->bean->setdtpagamento ( $this->getValorArray ( $array, "dtpagamento", null ) );
		$this->bean->settamanhocamisa ( $this->getValorArray ( $array, "tamanhocamisa", null ) );
		$this->bean->setdtvalidaemail ( $this->getValorArray ( $array, "dtvalidaemail", null ) );
		$this->bean->setdtinscricao ( $this->getValorArray ( $array, "dtinscricao", null ) );
		$this->bean->setnrinscrito ( $this->getValorArray ( $array, "nrinscrito", null ) );
		$this->bean->setpessoa ( $this->getValorArray ( $array, "idpessoa", new PessoaDAO ( $this->con ) ) );
		$this->bean->setcategoria ( $this->getValorArray ( $array, "categoria", null ) );
		$this->bean->setcarro ( $this->getValorArray ( $array, "carro", null ) );
		$this->bean->setnrcarro ( $this->getValorArray ( $array, "nrcarro", null ) );
		$this->bean->setendereco ( $this->getValorArray ( $array, "endereco", null ) );
		$this->bean->setnumero( $this->getValorArray ( $array, "numero", null ) );
		$this->bean->setnrcba ( $this->getValorArray ( $array, "nrcba", null ) );
		$this->bean->setcidade ( $this->getValorArray ( $array, "cidade", null ) );
		$this->bean->setuf ( $this->getValorArray ( $array, "uf", null ) );
		$this->bean->setcep ( $this->getValorArray ( $array, "cep", null ) );
		
		$this->bean->setcelular ( $this->getValorArray ( $array, "celular", null ) );
		$this->bean->settelefonecomercial ( $this->getValorArray ( $array, "telefonecomercial", null ) );
		$this->bean->setchefeequipe ( $this->getValorArray ( $array, "chefeequipe", null ) );
		$this->bean->setcomplemento ( $this->getValorArray ( $array, "complemento", null ) );
		$this->bean->setbairro ( $this->getValorArray ( $array, "bairro", null ) );
		$this->bean->setevento ( $this->getValorArray ( $array, "evento", null ) );
		$this->bean->setipcriacao ( $this->getValorArray ( $array, "ipcriacao", null ) );
		$this->bean->setdtenvio ( $this->getValorArray ( $array, "dtenvio", null ) );

		
		
		$this->bean = $this->getLogBeans ( $array, $this->bean );
		return $this->bean;
	}
	
	// metodos padr?o
	public function findAll() {
		$this->clt = array ();
		try {
			$query = " SELECT " .//sql 
			$this->camposSelect () .//sql 
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
	public function findAllSort($bean) {
		$this->clt = array ();
		$campeonato = Util::getIdObjeto ( $bean->getcampeonato () );
		$pessoaDAO = new PessoaDAO ( $this->con );
		$grupoDAO = new GrupoDAO ( $this->con );
		
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . $pessoaDAO->camposSelect () . ", " .//sql 
			$grupoDAO->camposSelect () . ", " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" left join " . $this->dbprexis . $grupoDAO->tabelaAlias () .//sql 
			" on " . $grupoDAO->idtabelaAlias () . " = " . $this->getalias () . ".grupo " .//sql 
			 " left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () . " " .//sql 
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa ";
			
			if ($campeonato > 0) {
				$query .= " where  " . $this->getalias () . ".idcampeonato = ? ";
				$this->con->setNumero ( 1, $campeonato );
			}
			
			$query .= " ORDER BY " . $this->ordernome;
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findAllSort", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findOrdenarGrupos($bean) {
		$this->clt = array ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			if ($bean->getsort () != "") {
				$this->ordernome = $bean->getsort ();
			}
			$query = " SELECT " . $this->camposSelect () . ", " .//sql 
			" CASE " .//sql 
			" WHEN " . $this->getalias () . ".dtnascimento > param.dtnascimento " .//sql 
			" THEN 0 " .//sql 
			" ELSE 1 END AS " . $this->getalias () . "_categoria " .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " ," .//sql 
			" ( select ? campeonato, ? situacao, ? dtnascimento, ? peso from dual ) param " .//sql 
			" where  " . $this->getalias () . ".idcampeonato = param.campeonato  and " .//sql 
			$this->getalias () . ".situacao = " .//sql 
			" case param.situacao when  " . "  'Todos' then " .//sql 
			$this->getalias () . ".situacao else " . "   param.situacao end " .//sql 
			" ORDER BY " . $this->getalias () . "_categoria , inscrito.peso , " .//sql 
			$this->getalias () . ".dtnascimento desc ";
			
			$this->con->setNumero ( 1, Util::getIdObjeto ( $bean->getcampeonato () ) );
			$this->con->setTexto ( 2, $bean->getsituacao () );
			$this->con->setData ( 3, $bean->getdtnascimento () );
			$this->con->setNumero ( 4, $bean->getpeso () );
			
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "InscritoDAO findAllSort", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$bean = $this->getBeans ( $array );
				$this->clt [] = $bean;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findPagosComCPFComPessoa($campeonato) {
		$this->clt = array ();
		/*$pessoaDAO = new PessoaDAO ( $this->con );
		$pessoaCampeonatoDAO = new PessoaCampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis .//sql 
			$this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () .//sql 
			" and IFNULL(" . $this->getalias () . ".cpf,'') != '' " .//sql 
			" and  " . $this->getalias () . ".situacao = 'Pago' " .//sql 
			" and exists ( " .//sql 
			"	select 1 " .//sql 
			"	from " . $this->dbprexis . $pessoaDAO->tabelaAlias () . " " .//sql 
			" 	where " .//sql 
				$pessoaDAO->getalias () . ".cpf =  " . $this->getalias () . ".cpf ".//sql 
			" 	or " .//sql 
				$pessoaDAO->getalias () . ".idpessoa =  " . $this->getalias () . ".idpessoa " .//sql 
			" ) " .//sql 
			" and not exists ( " .//sql 
			"	select 1 " .//sql 
			"	from " . $this->dbprexis . $pessoaCampeonatoDAO->tabelaAlias () . " " .//sql 
			" 	where " .//sql 
				$this->getalias () . ".idpessoa =  " . $pessoaCampeonatoDAO->getalias () . ".idpessoa ".//sql 
			" 	and " .//sql 
				$this->getalias () . ".idcampeonato =  " . $pessoaCampeonatoDAO->getalias () . ".idcampeonato " .//sql 
			 " ) " .//sql 
			" ORDER BY " . $this->ordernome;
			
			
			
			Util::echobr ( 0, "InscritoDAO findPagosComCPFComPessoa $ query", $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPFComPessoa campeonato", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPFComPessoa", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		*/
		return $this->clt;
	}
	public function findPagosComCPFSemPessoa($campeonato) {
		$this->clt = array ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and IFNULL(" . $this->getalias () . ".cpf,'') != '' " . " and  " . $this->getalias () . ".situacao = 'Pago' " . " and not exists ( " . "	select 1 " . "	from " . $this->dbprexis . $pessoaDAO->tabelaAlias () . " " . " 	where " . $pessoaDAO->getalias () . ".cpf =  " . $this->getalias () . ".cpf  or " . $pessoaDAO->getalias () . ".idpessoa =  " . $this->getalias () . ".idpessoa" . " ) " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, "InscritoDAO findPagosComCPFSemPessoa $ query", $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPFSemPessoa $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPFSemPessoa", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findPagos($campeonato) {
		$this->clt = array ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " .//sql 
			" where " . $this->whereAtivo () . " and " .//sql 
			$this->getalias () . ".idcampeonato = ? " . " and  " .//sql 
			$this->getalias () . ".situacao = 'Pago' " .//sql 
			" order by " . $this->getalias () . "_peso, " . $this->getalias () . "_dtnascimento desc ";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "InscritoDAO findPagos $ bean->getcampeonato()", $campeonato );
			Util::echobr ( 0, "InscritoDAO findPagos", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	public function relatorioInscrito($inscrito) {
	    $this->clt = array ();
	    $categoriainscrito = new CategoriaInscritoDAO($this->con);
	    $categoria = new CategoriaDAO($this->con);
	    
	    try {
	        $query = " SELECT " .//sql 
	   	    $categoriainscrito->camposSelect () ." , ".//sql 
	   	    $categoria->camposSelect () ." , ".//sql 
   	        $this->camposSelect () .//sql 
   	        " FROM " . $this->dbprexis . $this->tabelaAlias () . " " .//sql 
   	        " inner join " .$this->dbprexis . $categoriainscrito->tabelaAlias () . " " .//sql 
   	        " on " . $categoriainscrito->getalias () . ".idinscrito  = " . $this->idtabelaAlias () .//sql 
   	        " inner join " .$this->dbprexis . $categoria->tabelaAlias () . " " .//sql 
   	        " on " . $categoria->idtabelaAlias () . " = " . $categoriainscrito->getalias () . ".idcategoria " .//sql 
   	        
	        " where " . $this->whereAtivo () . " and " .//sql 
	        $this->getalias () . ".idcampeonato = ? " ; 
	        if( $inscrito->getsituacao()=='Pago'){
	            $query .= " and  " .$this->getalias () . ".situacao = 'Pago' " ;
	        }
	        $query .= " order by " . $categoria->getalias () . ".nome, " . $this->getalias () . ".situacao desc ";
	        $this->con->setNumero ( 1, Util::getIdObjeto ( $inscrito->getcampeonato() ) );
	        
	        $this->con->setsql ( $query );
	        
	        Util::echobr (0, "InscritoDAO findPagos", $this->con->getsql () );
	        
	        $result = $this->con->execute ();
	        
	        while ( $array = $result->fetch_assoc () ) {
	            $this->clt [] = $this->getBeans ( $array );
	        }
	    } catch ( Exception $e ) {
	        throw new Exception ( $e->getMessage () );
	    }
	    
	    return $this->clt;
	}
	
	
	public function relatorio($dataBase) {
		$this->clt = array ();
		
		$qtGrupo = (isset ( $_POST ['qtGrupo'] )) ? $_POST ['qtGrupo'] : '';
		$lmDtNascimento = (isset ( $_POST ['lmDtNascimento'] )) ? $_POST ['lmDtNascimento'] : '';
		$lmPeso = (isset ( $_POST ['lmPeso'] )) ? $_POST ['lmPeso'] : '';
		$pesoA = (isset ( $_POST ['pesoA'] )) ? $_POST ['pesoA'] : '';
		$pesoB = (isset ( $_POST ['pesoB'] )) ? $_POST ['pesoB'] : '';
		$pesoC = (isset ( $_POST ['pesoC'] )) ? $_POST ['pesoC'] : '';
		$pesoD = (isset ( $_POST ['pesoD'] )) ? $_POST ['pesoD'] : '';
		$campeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : '';
		$situacao = (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : '';
		$contaesp = (isset ( $_POST ['contaesp'] )) ? $_POST ['contaesp'] : '';
		
		$arrayaux = array_merge ( $this->campos, $this->camposLog );
		foreach ( $arrayaux as &$value ) {
			$value = "relatorio.inscrito_" . $value . " inscrito_" . $value;
		}
		$elect = implode ( ", ", $arrayaux );
		
		try {
			$query = " SELECT " . $elect . " , " . "   case                                                                                                                                                             " . "   when                                                                                                                                                             " . "   	relatorio.inscrito_grp = 'A' AND relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'N')                                                " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT('GRUPO A menos de ', relatorio.pesoA),' kilos')                                                                                                  " . "   when                                                                                                                                                             " . "   	relatorio.inscrito_grp = 'B' AND relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'N')                                                " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT(CONCAT(CONCAT('GRUPO B entre ', relatorio.pesoA - 1), ' e ' ),relatorio.pesoB ),' kilos')                                                        " . "   when                                                                                                                                                             " . "   	relatorio.inscrito_grp = 'C' AND relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'N')                                                " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT(CONCAT(CONCAT('GRUPO C entre ', relatorio.pesoB - 1), ' e ' ),relatorio.pesoC ),' kilos')                                                        " . "   when                                                                                                                                                             " . "   	relatorio.inscrito_grp = 'D' AND relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'N')                                                " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT(CONCAT(CONCAT('GRUPO D entre ', relatorio.pesoC - 1), ' e ' ),relatorio.pesoD ),' kilos')                                                        " . "   when                                                                                                                                                             " . "   	(relatorio.inscrito_grp = 'E'                                                                                                                                  " . "   	or(                                                                                                                                                            " . "   		relatorio.inscrito_grp = 'D' and                                                                                                                             " . "   		relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'S')                                                                               " . "   	)                                                                                                                                                              " . "   	or(                                                                                                                                                            " . "   		relatorio.inscrito_grp = 'C' and                                                                                                                             " . "   		relatorio.inscrito_esp = IF(relatorio.contaesp='N',relatorio.inscrito_esp,'S')                                                                               " . "   	))                                                                                                                                                             " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT('GRUPO E mais de ', relatorio.pesoD-1),' kilos')                                                                                                   " . "   else                                                                                                                                                             " . "   	'fora'                                                                                                                                                         " . "   end                                                                                                                                                              " . "   as inscrito_grp,                                                                                                                                                 " . "   case                                                                                                                                                             " . "   when                                                                                                                                                             " . "   	relatorio.inscrito_esp = 'S'                                                                                                                                   " . "   then                                                                                                                                                             " . "   	CONCAT(CONCAT(CONCAT(CONCAT(CONCAT('Entre ', relatorio.pesoEsp),' e '), relatorio.pesoD ),' e nascido antes de '),DATE_FORMAT(relatorio.dtnascEsp,'%d/%m/%Y')) " . "   else                                                                                                                                                             " . "   	'N&atilde;o especial'                                                                                                                                                            " . "   end                                                                                                                                                              " . "   as inscrito_esp,                                                                                                                                                 " . "   relatorio.inscrito_esp inscrito_esp2,                                                                                                                            " . "   relatorio.contaesp                                                                                                                                               " . "                                                                                                                                                                    " . "   from(                                                                                                                                                            " . " select                                                                                                                                                             " . "   " . $this->camposSelect () . ",                                                                                                                                   " . "   CASE WHEN                                                                                                                                                        " . "   	(inscrito.peso < param.pesoA)                                                                                                                                  " . "   THEN                                                                                                                                                             " . "   	'A'                                                                                                                                                            " . "   WHEN                                                                                                                                                             " . "   	(inscrito.peso >= param.pesoA and inscrito.peso < param.pesoB)                                                                                                 " . "   THEN                                                                                                                                                             " . "   	'B'                                                                                                                                                            " . "   WHEN                                                                                                                                                             " . "   	(inscrito.peso  >= param.pesoB and inscrito.peso < param.pesoC)                                                                                                " . "   THEN                                                                                                                                                             " . "   	'C'                                                                                                                                                            " . "   WHEN                                                                                                                                                             " . "   	(inscrito.peso  >= param.pesoC and inscrito.peso < param.pesoD)                                                                                                " . "   THEN                                                                                                                                                             " . "   	'D'                                                                                                                                                            " . "   WHEN                                                                                                                                                             " . "   	(inscrito.peso  >= param.pesoD )                                                                                                                               " . "   THEN                                                                                                                                                             " . "   	'E'                                                                                                                                                            " . "   ELSE                                                                                                                                                             " . "   	'SEM GRUPO'                                                                                                                                                    " . "   end                                                                                                                                                              " . "   AS inscrito_grp,                                                                                                                                                 " . "   CASE WHEN                                                                                                                                                        " . "   	(inscrito.peso >= param.pesoEsp and inscrito.peso  < param.pesoD  and inscrito.dtnascimento < param.dtnascEsp )                                                " . "   THEN                                                                                                                                                             " . "   	'S'                                                                                                                                                            " . "   ELSE                                                                                                                                                             " . "   	'N'                                                                                                                                                            " . "   END                                                                                                                                                              " . "   AS 	inscrito_esp,                                                                                                                                                " . "   param.campeonato,                                                                                                                                                " . "   param.situacao,                                                                                                                                                  " . "   param.dtnascEsp,                                                                                                                                                 " . "   param.pesoEsp,                                                                                                                                                   " . "   param.pesoA,                                                                                                                                                     " . "     param.pesoB,                                                                                                                                                   " . "     param.pesoC,                                                                                                                                                   " . "   param.pesoD,                                                                                                                                                     " . "   param.contaesp                                                                                                                                                   " . "                                                                                                                                                                    " . " from                                                                                                                                                               " . "   kart_inscrito inscrito,                                                                                                                                          " . "   (                                                                                                                                                                " . " select                                                                                                                                                             " . "   ? campeonato,                                                                                                                                                    " . "   ? situacao,                                                                                                                                                " . "   ? dtnascEsp,                                                                                                                                 " . "   ? pesoEsp,                                                                                                                                                      " . "   ? pesoA,                                                                                                                                                        " . "   ? pesoB,                                                                                                                                                      " . "   ? pesoC,                                                                                                                                                      " . "   ? pesoD,                                                                                                                                                       " . "   ? contaesp                                                                                                                                                     " . " from                                                                                                                                                               " . "   dual ) param                                                                                                                                                     " . " where                                                                                                                                                              " . "   inscrito.idcampeonato = param.campeonato                                                                                                                         " . " and inscrito.situacao =                                                                                                                                            " . "   case param.situacao                                                                                                                                              " . "   when 'Todos'                                                                                                                                                     " . "   then inscrito.situacao                                                                                                                                           " . "   else param.situacao                                                                                                                                              " . "   end                                                                                                                                                              " . "                                                                                                                                                                    " . " ) relatorio                                                                                                                                                        " . " order by inscrito_grp, relatorio.inscrito_peso,relatorio.inscrito_dtnascimento desc                                                                                ";
			
			$this->con->setNumero ( 1, $campeonato );
			$this->con->setTexto ( 2, $situacao );
			$this->con->setData ( 3, Util::strtotimestamp ( $lmDtNascimento ) );
			$this->con->setNumero ( 4, $lmPeso );
			$this->con->setNumero ( 5, $pesoA );
			$this->con->setNumero ( 6, $pesoB );
			$this->con->setNumero ( 7, $pesoC );
			$this->con->setNumero ( 8, $pesoD );
			$this->con->setTexto ( 9, $contaesp );
			
			$this->con->setsql ( $query );
			
			Util::echobr ( 0, "InscritoDAO relatorio $ bean->getcampeonato()", $campeonato );
			Util::echobr ( 0, "InscritoDAO relatorio", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
				$this->bean->setcategoria ( $this->getValorArray ( $array, "grp", null ) );
				$this->bean->settamanhocamisa ( $this->getValorArray ( $array, "esp", null ) );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findInscritoPessoa($campeonato) {
		$this->clt = array ();
		/*$pessoaDAO = new PessoaDAO ( $this->con );
		$pessoaCampeonatoDAO = new PessoaCampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " .//sql 

			$pessoaDAO->camposSelect () . ", " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . ", " . $this->dbprexis . $pessoaDAO->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa ".//sql 
  		//" and IFNULL(".$this->getalias(). ".cpf,'') != '' ".//sql 
  		//" and  " . $this->getalias(). ".situacao = 'Pago' ".//sql 
  		" and exists ( " . "	select 1 " . "	from " . $this->dbprexis . $pessoaCampeonatoDAO->tabelaAlias () . " " . " where " . $this->getalias () . ".idpessoa =  " . $pessoaCampeonatoDAO->getalias () . ".idpessoa and " . $this->getalias () . ".idcampeonato =  " . $pessoaCampeonatoDAO->getalias () . ".idcampeonato " . " ) " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, "InscritoDAO findInscritoPessoa $ query", $query );
			Util::echobr ( 0, "InscritoDAO findInscritoPessoa $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findInscritoPessoa", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		*/
		return $this->clt;
	}
	public function findPagosSemCPFSemPessoa($campeonato) {
		$this->clt = array ();
		/*$pessoaCampeonatoDAO = new PessoaCampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and IFNULL(" . $this->getalias () . ".cpf,'') = '' " . " and  " . $this->getalias () . ".situacao = 'Pago' " . " and not exists ( " . "	select 1 " . "	from " . $this->dbprexis . $pessoaCampeonatoDAO->tabelaAlias () . " " . " 	where " . $this->getalias () . ".idpessoa =  " . $pessoaCampeonatoDAO->getalias () . ".idpessoa and " . $this->getalias () . ".idcampeonato =  " . $pessoaCampeonatoDAO->getalias () . ".idcampeonato " . " ) " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, "InscritoDAO findPagosComCPF $ query", $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPF $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPF", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		*/
		return $this->clt;
	}
	public function findPagosSemCPF($campeonato) {
		$this->clt = array ();
		/*$pessoaDAO = new PessoaDAO ( $this->con );
		$pessoaCampeonatoDAO = new PessoaCampeonatoDAO ( $this->con );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and IFNULL(" . $this->getalias () . ".cpf,'') = '' " . " and  " . $this->getalias () . ".situacao = 'Pago' " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, "InscritoDAO findPagosComCPF $ query", $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPF $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findPagosComCPF", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		*/
		return $this->clt;
	}
	public function findNaoPagos($campeonato) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".situacao != 'Pago' " . " ORDER BY " . $this->ordernome;
			Util::echobr ( 0, "InscritoDAO findNaoPagos $ query", $query );
			Util::echobr ( 0, "InscritoDAO findNaoPagos $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findNaoPagos", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findNaoPagosNaoPiloto($campeonato) {
	    $pessoaDAO = new PessoaDAO ( $this->con );
	    $pessoaDAO = new PessoaDAO ( $this->con );
	    $pilotoCampeonatoDAO = new PilotoCampeonatoDAO ( $this->con );
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " " . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () .//sql 
			" and  " . $this->getalias () . ".situacao != 'Pago' " .//sql 
			" and not exists ( " .//sql 
			"	select 1 " .//sql 
			"	from " . $this->dbprexis . $pilotoCampeonatoDAO->tabelaAlias () . " " .//sql 
			" 	where " . $this->getalias () . ".idpessoa =  " .//sql 
			  $pilotoCampeonatoDAO->getalias () . ".idpiloto and " .//sql 
			$this->getalias () . ".idcampeonato =  " .//sql 
			  $pilotoCampeonatoDAO->getalias () . ".idcampeonato " . " ) " .//sql 
			" ORDER BY " . $this->ordernome;
			
			Util::echobr ( 0, "InscritoDAO findNaoPagosNaoPiloto $ query", $query );
			Util::echobr ( 0, "InscritoDAO findNaoPagosNaoPiloto $ bean->getcampeonato()", $campeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findNaoPagosNaoPiloto", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	public function findById($inscrito) {
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " .//sql 
				$this->camposSelect () . ", " .//sql 
				$pessoaDAO->camposSelect () .//sql 
				" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
				" left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .//sql 
				" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () .//sql 
				".idpessoa " . " where " . $this->idtabelaAlias () . " = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($inscrito) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findById", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPFCampeonato($cpf, $campeonato) {
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " . $this->camposSelect () . ", " .//sql 
				$pessoaDAO->camposSelect () .//sql 
				" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
				" left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .//sql 
				" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .//sql 
				" where " . $this->whereAtivo () .//sql 
				" and " . $this->getalias () . ".idcampeonato = ? " .//sql 
				" and " . $this->getalias () . ".cpf = cpfClean( ? ) " .//sql 
				" order by " . $this->getalias () . ".dtcriacao desc";
			$this->con->setNumero ( 1, Util::getIdObjeto ( $campeonato ) );
			$this->con->setTexto ( 2, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findByCPFCampeonato", $this->con->getsql () );

			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByCPFArrancada($cpf) {
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		$campeonatoDAO = new CampeonatoDAO ( $this->con );
		
		try {
			$query = " SELECT " .//sql 
					" IFNULL( " .$this->getalias () . ".dtmodificacao,". $this->getalias () . ".dtcriacao ), ".//sql 
					$this->camposSelect () . ", " .//sql 
					$pessoaDAO->camposSelect () .//sql 
					" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
					" inner join " . $this->dbprexis . $campeonatoDAO->tabelaAlias () .//sql 
					" on " . $campeonatoDAO->idtabelaAlias () . " = " . $this->getalias () . ".idcampeonato " .//sql 
					" left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .//sql 
					" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .//sql 
					" where " . $this->whereAtivo () .//sql 
					" and " . $campeonatoDAO->getalias () . ".tipoevento  = " . TipoEventoEnum::ARRANCADA .//sql 
					" and " . $this->getalias () . ".cpf = ? " .//sql 
					" order by IFNULL( " .$this->getalias () . ".dtmodificacao,".//sql 
						$this->getalias () . ".dtcriacao ) desc";
			$this->con->setTexto ( 1, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findByCPFArrancada", $this->con->getsql () );

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
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " .//sql 
			$this->camposSelect () . ", " .//sql 
			$pessoaDAO->camposSelect () .//sql 
			" FROM " .//sql 
			$this->dbprexis . $this->tabelaAlias () .//sql 
			" left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .//sql 
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .//sql 
			" where " . $this->getalias () . ".cpf = ? " .//sql 
			" order by " . $this->getalias () . ".dtcriacao desc";
			$this->con->setTexto ( 1, $cpf );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findByCPF", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	
	public function findByPessoa($pessoa) {
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " .//sql 
			$this->camposSelect () . ", " .//sql 
			$pessoaDAO->camposSelect () .//sql 
			" FROM " .//sql 
			$this->dbprexis . $this->tabelaAlias () .//sql 
			" inner join " . $this->dbprexis . $pessoaDAO->tabelaAlias () .//sql 
			" on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " .//sql 
			" where " . $this->getalias () . ".idpessoa = ? ";
			$this->con->setNumero ( 1, Util::getIdObjeto($pessoa) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findByPessoa", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findByNrInscrito($nrinscrito, $campeonato) {
		$this->results = new InscritoBean ();
		$pessoaDAO = new PessoaDAO ( $this->con );
		
		try {
			$query = " SELECT " . $this->camposSelect () . ", " . $pessoaDAO->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " left join " . $this->dbprexis . $pessoaDAO->tabelaAlias () . " on " . $pessoaDAO->idtabelaAlias () . " = " . $this->getalias () . ".idpessoa " . " where " . $this->getalias () . ".nrinscrito = ? and " . $this->getalias () . ".idcampeonato = ? and " . $this->whereAtivo ();
			
			$this->con->setNumero ( 1, $nrinscrito );
			$this->con->setNumero ( 2, $campeonato );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findById", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findByBetweenIdDtEnvioNull($id1, $id2) {
		$this->results = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->whereAtivo () . "inscrito.dtenvio is null and " . "inscrito.idinscrito between ? and  ? ";
			
			$this->con->setNumero ( 1, $id1 );
			$this->con->setNumero ( 2, $id2 );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findByBetweenId", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function gruposPorIdCampeonato($idcampeonato) {
		$this->results = array ();
		try {
			$query = " SELECT distinct " . $this->alias . ".grupo " . $this->alias . "_grupo" . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where " . $this->whereAtivo () . $this->getalias () . ".idcampeonato = ? " . " order by  " . $this->alias . ".grupo ";
			
			$this->con->setNumero ( 1, $idcampeonato );
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO gruposPorIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results [] = $this->getValorArray ( $array, "grupo", null );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosPorGrupoIdCampeonato($idcampeonato) {
		$this->results = array ();
		try {
			$query = " SELECT grupo, count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " group by grupo " . " order by grupo ";
			
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "grupo", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalNPago($campeonato) {
		$this->results = 0;
		$parametroBusiness = new ParametroBusiness ();
		$situacaoPG = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_PG );
		
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".situacao != '" . $situacaoPG . "' ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalComDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalPago($campeonato) {
		$this->results = 0;
		$parametroBusiness = new ParametroBusiness ();
		$situacaoPG = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_PG );
		
		try {
			$query = " SELECT count(*) total " .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () .//sql 
			" where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () .//sql 
			" and  " . $this->getalias () . ".situacao = '" . $situacaoPG . "' ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalComDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalAguardandoPagamento($campeonato) {
		$this->results = 0;
		$parametroBusiness = new ParametroBusiness ();
		$situacaoAP = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_AP );
		
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".situacao = '" . $situacaoAP . "' ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalComDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalEspera($campeonato) {
		$this->results = 0;
		$parametroBusiness = new ParametroBusiness ();
		$situacaoLE = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_LE );
		
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".situacao = '" . $situacaoLE . "' ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalComDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalComDtPagamento($campeonato) {
		$this->results = 0;
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".dtpagamento is not null ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalComDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalSemDtPagamento($campeonato) {
		$this->results = 0;
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and  " . $this->getalias () . ".dtpagamento is null ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO totalSemDtPagamento ", $this->con->getsql () );
			$result = $this->con->execute ();
			
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosFatorGrupo($idcampeonato) {
		$this->results = array ();
		try {
			$query = $query = " SELECT " . $this->camposSelect () .//sql 
               //", ".               " (".$this->getalias().".peso+".$this->getalias().".idade/10) fator ".//sql 
		  		" FROM ( " .  " select " . "   interna.idcampeonato, " . "   interna.apelido, " . "   interna.nome, " . "   interna.peso, " . "   interna.dtnascimento, " . "   interna.email, " . "   interna.cpf, " . "   interna.telefone, " . "   interna.valor, " . "   interna.grupo, " . "   interna.situacao, " . "   interna.dtpagamento, " . "   interna.tamanhocamisa, " . "   interna.idinscrito, " . "   interna.criador, " . "   interna.dtcriacao, " . "   interna.modificador, " . "   interna.dtmodificacao, " . "   interna.dtvalidade, " . "   interna.dtinicio, " . "   (YEAR( CURDATE( ) ) - YEAR( interna.dtnascimento ) ) - " . "		( RIGHT( CURDATE( ) , 5 ) < RIGHT( interna.dtnascimento , 5 ) ) idade " . "		 FROM " . $this->dbprexis . $this->tabela . " interna " . " )  " . $this->getalias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " and " . $this->getalias () . ".dtpagamento is not null " . " order by  (" . $this->getalias () . ".peso+(" . $this->getalias () . ".idade/10)) ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritosFatorGrupo", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosPorTamanhoCamisetaIdCampeonato($idcampeonato) {
		$this->results = array ();
		try {
			$query = " SELECT  CASE " . " WHEN  tamanhocamisa = '3XG' THEN 50" . " WHEN  tamanhocamisa = 'GG' THEN 40" . " WHEN  tamanhocamisa = 'G' THEN 30" . " WHEN  tamanhocamisa = 'M' THEN 20" . " else 10 end " . " ordem,tamanhocamisa, count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " group by tamanhocamisa " . " order by ordem ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritosPorTamanhoCamisetaIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "tamanhocamisa", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosPorParametroIdCampeonato($campeonato, $parametrosarray) {
		$this->results = array ();
		
		$rangesPesos = " CASE " . " WHEN  (idade > " . $parametrosarray ['GPESADOIDADE'] . " and peso > " . $parametrosarray ['GPESADOPESOOPCIONAL'] . ") or " . " peso > " . $parametrosarray ['GPESADOPESO'] . " " . " THEN 'Mais de " . $parametrosarray ['GPESADOPESO'] . "Kg ou " . "mais de " . $parametrosarray ['GPESADOPESOOPCIONAL'] . "kg e com mas de " . $parametrosarray ['GPESADOIDADE'] . " anos' " .//sql 

		" WHEN  ";
		if ($parametrosarray ['GMEDIOIDADE '] != 0) {
			$rangesPesos .= " ( " . " idade <= " . $parametrosarray ['GPESADOIDADE'] . " and peso <= " . $parametrosarray ['GPESADOPESOOPCIONAL'] . " and " . " idade > " . $parametrosarray ['GMEDIOIDADE '] . " and peso > " . $parametrosarray ['GMEDIOPESOOPCIONAL '] . ") or ";
		}
		$rangesPesos .= " peso > " . $parametrosarray ['GMEDIOPESO '] . " and " . " peso <= " . $parametrosarray ['GPESADOPESO'] . " " . " THEN 'Mais de " . $parametrosarray ['GMEDIOPESO'] . "Kg e menos de " . $parametrosarray ['GPESADOPESO'] . "Kg";
		if ($parametrosarray ['GMEDIOIDADE '] != 0) {
			$rangesPesos .= " ou mais de " . $parametrosarray ['GMEDIOPESOOPCIONAL'] . "kg e com mas de " . $parametrosarray ['GMEDIOIDADE'] . " anos' ";
		}
		$rangesPesos .= " when peso < " . $parametrosarray ['105'] . " and peso >= " . $parametrosarray ['95'] . " THEN 'Entre " . $parametrosarray ['104'] . "Kg a " . $parametrosarray ['94'] . "Kg' " . " when peso < " . $parametrosarray ['95'] . " and peso >= " . $parametrosarray ['85'] . " " . " THEN 'Entre " . $parametrosarray ['94'] . "Kg a " . $parametrosarray ['85'] . "Kg' " . " ELSE 'Menos " . $parametrosarray ['84'] . "Kg' " . " END ";
		
		try {
			$query = " SELECT " . $rangesPesos . " pesos " . " , count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->whereAtivo () . " group by " . $rangesPesos . " order by pesos ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritosPorPesoIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "pesos", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosPorPesoIdCampeonato($campeonato) {
		$this->results = array ();
		$rangesPesos = " CASE WHEN peso >= 105 THEN '105Kg ou mais' " . " when peso < 105 and peso >= 95 THEN 'Entre 104Kg a 95Kg' " . " when peso < 95 and peso >= 85 THEN 'Entre 94Kg a 85Kg' " . " ELSE 'Menos 84Kg' " . " END ";
		
		try {
			$query = " SELECT " . $rangesPesos . " pesos " . " , count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " group by " . $rangesPesos . " order by pesos ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritosPorPesoIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "pesos", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritosPorPesoIdadeIdCampeonato($campeonato) {
		$this->results = array ();
		$rangesPesos = " CASE WHEN (idade >= 40 and peso >= 95) or peso >= 105 THEN '105Kg ou mais e tamb&#233;m 95kg ou mais com 40 anos ou mais' " . " when idade < 40 and peso < 105 and peso >= 95 THEN 'Entre 104Kg a 95Kg' " . " when peso < 95 and peso >= 85 THEN 'Entre 94Kg a 85Kg' " . " ELSE 'Menos 84Kg' " . " END ";
		
		try {
			$query = " SELECT " . $rangesPesos . " Categorias " . " , count(*) total " . " FROM ( " . " select " . "   interna.idcampeonato, " . "   interna.dtvalidade, " . "   interna.dtinicio, " . "   interna.peso, " . "   (YEAR( CURDATE( ) ) - YEAR( interna.dtnascimento ) ) - " . "		( RIGHT( CURDATE( ) , 5 ) < RIGHT( interna.dtnascimento , 5 ) ) idade " . "		 FROM " . $this->dbprexis . $this->tabela . " interna " . " )  " . $this->getalias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " group by " . $rangesPesos . " order by Categorias ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritosPorPesoIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "Categorias", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function inscritoPorDiaIdCampeonato($campeonato) {
		$this->results = array ();
		try {
			$query = " SELECT DATE_FORMAT(" . $this->getalias () . ".dtcriacao,'%Y%m%d') dia," . " DATE_FORMAT(" . $this->getalias () . ".dtcriacao,'%d/%m/%Y') categoria,count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " group by DATE_FORMAT(" . $this->getalias () . ".dtcriacao,'%Y%m%d') ," . " DATE_FORMAT(" . $this->getalias () . ".dtcriacao,'%d/%m/%Y') " . " order by DATE_FORMAT(" . $this->getalias () . ".dtcriacao,'%Y%m%d') ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO inscritoPorDiaIdCampeonato", $this->con->getsql () );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$retorno = array (
						$this->getValorArray ( $array, "categoria", null ),
						$this->getValorArray ( $array, "total", null ) 
				);
				$this->results [] = $retorno;
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function totalByIdCampeonato($campeonato) {
		$this->results = new InscritoBean ();
		try {
			$query = " SELECT count(*) total " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND ";
			
			$this->con->setsql ( $query );
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->results = $array ["total"];
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function findAllByIdCampeonato($campeonato) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " ORDER BY " . $this->getalias () . ".situacao , " . $this->getalias () . ".NOME ";
			
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
	public function findAllByIdCampeonatoSortId($campeonato) {
		$this->clt = array ();
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " ORDER BY " . $this->getalias () . "." . $this->idtabela () . " ";
			
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
	public function findAllByIdCampeonatoSemEspera($campeonato) {
		$this->clt = array ();
		$parametroBusiness = new ParametroBusiness ();
		$situacaoLE = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_LE );
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->getalias () . ".situacao != '" . $situacaoLE . "' " . " and IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " ORDER BY " . $this->getalias () . ".NOME ";
			
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
	public function findAllByIdCampeonatoSortIdSemEspera($campeonato) {
		$this->clt = array ();
		$parametroBusiness = new ParametroBusiness ();
		$situacaoLE = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_LE );
		try {
			$query = " SELECT " . $this->camposSelect () .//sql 
			" FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( 1, $campeonato );
			}
			$query .= $this->getalias () . ".situacao !=  '" . $situacaoLE . "' " .//sql 
                " and IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " .//sql 
                " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " .//sql 
                " ORDER BY " . $this->getalias () . ".nrinscrito ";

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
	public function findAllByGrupoIdCampeonatoSortId($campeonato, $grupo) {
		$this->clt = array ();
		$nrvar = 1;
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM " . $this->dbprexis . $this->tabelaAlias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( $nrvar, $campeonato );
				$nrvar ++;
			}
			$query .= $this->alias . ".grupo = ? " . " and IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " ORDER BY " . $this->getalias () . "." . $this->idtabela () . " ";
			
			$this->con->setTexto ( $nrvar, $grupo );
			
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
	public function findAllPesoRangeIdCampeonato($idcampeonato, $pesoMax, $pesoMin) {
		$this->clt = array ();
		$parametroBusiness = new ParametroBusiness ();
		
		$pesoops = $parametroBusiness->findByCodigo ( 'GPESADOPESOOPCIONAL' );
		$idadeops = $parametroBusiness->findByCodigo ( 'GPESADOIDADE' );
		
		$pesopesado = $parametroBusiness->findByCodigo ( 'GPESADOPESO' );
		$varpar = 1;
		try {
			$query = " SELECT " . $this->camposSelect () . " FROM ( " . " select " . "   interna.idcampeonato, " . "   interna.apelido, " . "   interna.nome, " . "   interna.peso, " . "   interna.dtnascimento, " . "   interna.email, " . "   interna.cpf, " . "   interna.telefone, " . "   interna.valor, " . "   interna.grupo, " . "   interna.situacao, " . "   interna.dtpagamento, " . "   interna.tamanhocamisa, " . "   interna.idinscrito, " . "   interna.criador, " . "   interna.dtcriacao, " . "   interna.modificador, " . "   interna.dtmodificacao, " . "   interna.dtvalidade, " . "   interna.dtinicio, " . "   (YEAR( CURDATE( ) ) - YEAR( interna.dtnascimento ) ) - " . "		( RIGHT( CURDATE( ) , 5 ) < RIGHT( interna.dtnascimento , 5 ) ) idade " . "		 FROM " . $this->dbprexis . $this->tabela . " interna " . " )  " . $this->getalias () . " where ";
			if ($campeonato > 0) {
				$query .= $this->getalias () . ".idcampeonato = ? and ";
				$this->con->setNumero ( $nrvar, $campeonato );
				$nrvar ++;
			}
			$query .= " IFNULL(" . $this->getalias () . ".dtvalidade,now()) > NOW() - INTERVAL 1 SECOND " . " and IFNULL(" . $this->getalias () . ".dtinicio,now()) < NOW() + INTERVAL 1 SECOND " . " and " . $this->getalias () . ".dtpagamento is not null " . " and ( ";
			if ($pesoMin >= $pesopesado) {
				$query .= " ( " . $this->getalias () . ".peso < ? " . " and " . $this->getalias () . ".peso >= ? " . " ) " . " OR ( " . $this->getalias () . ".idade >= " . $idadeops . "  AND " . $this->getalias () . ".peso >= " . $pesoops . " ) ";
			}
			if ($pesoMin < $pesopesado) {
				$query .= " ( " . $this->getalias () . ".idade < " . $idadeops . "  AND " . $this->getalias () . ".peso < ? " . " and " . $this->getalias () . ".peso >= ? " . " ) " . " OR (" . $this->getalias () . ".idade >= " . $idadeops . "  AND  " . $this->getalias () . ".peso < " . $pesoops . " )   ";
			}
			$query .= " ) " . " ORDER BY " . $this->getalias () . ".peso desc ";
			
			$this->con->setNumero ( $varpar, $pesoMax );
			$varpar ++;
			$this->con->setNumero ( $varpar, $pesoMin );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO findAllPesoRangeIdCampeonato $pesoMin query", $this->con->getsql () );
			
			$result = $this->con->execute ();
			
			while ( $array = $result->fetch_assoc () ) {
				$this->clt [] = $this->getBeans ( $array );
			}
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->clt;
	}
	
	/*
	 * public function findByCPF($cpf) { $this->results = null; try { $query = " SELECT " . $this->camposSelect() . " FROM " . $this->dbprexis . $this->tabelaAlias() . " where " . $this->getalias(). ".cpf = ? ". " ORDER BY ".$this->getalias(). ".NOME "; $this->con->setTexto(1,$cpf); 
	 * $this->con->setsql($query); Util::echobr(0,"InscritoDAO findByCPF", $this->con->getsql()); $result = $this->con->execute(); if ($array = $result->fetch_assoc()) { $this->results = $this->getBeans($array); } Util::echobr(0,"InscritoDAO findByCPF result", $this->results); } catch (Exception $e) { throw new Exception ($e->getMessage()); } return $this->results; }
	 */
	public function getNovoNrInscrito($campeoanto) {
		$this->results = null;
		try {
			$query = 
			" select min(u.nr) nr " .//sql 
			"	from  " .//sql 
			"		( " .//sql 
			"		select count(*)+1 nr " .//sql 
			"		from " .//sql 
			"			kart_inscrito total " .//sql 
			"		where " .//sql 
			"			total.idcampeonato = ? " .//sql 
			"			and total.nrinscrito > 0 " .//sql 
			"		union " .//sql 
			"		select min( xc.rank) nr " .//sql 
			"		from " .//sql 
			"		(	SELECT t.*, " .//sql 
			"				   @rownum := @rownum + 1 AS rank " .//sql 
			"			  FROM kart_inscrito t, " .//sql 
			"				   (SELECT @rownum := 0) r " .//sql 
			"			where " .//sql 
			"				t.idcampeonato = ? " .//sql 
			"			and t.nrinscrito > 0 " .//sql 
			"			order by t.nrinscrito) xc " .//sql 
			"		where " .//sql 
			"			xc.nrinscrito != xc.rank " .//sql 
			"		) u ";
			
			$this->con->setNumero ( 1, $campeoanto );
			$this->con->setNumero ( 2, $campeoanto );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO getNovoNrInscrito", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $array ['nr'];
			}
			Util::echobr ( 0, "InscritoDAO getNovoNrInscrito result", $this->results );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function situacaoAll() {
		$this->results = null;
		try {
			$query = " SELECT " . " distinct " . $this->getalias () . ".situacao " . " FROM " . $this->dbprexis . $this->tabelaAlias () . " ORDER BY " . $this->getalias () . ".situacao ";
			
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO situacao", $this->con->getsql () );
			
			$result = $this->con->execute ();
			if ($array = $result->fetch_assoc ()) {
				$this->results = $this->getBeans ( $array );
			}
			Util::echobr ( 0, "InscritoDAO situacao", $this->results );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		
		return $this->results;
	}
	public function updateDtEnvio($id) {
		$this->results = new InscritoBean ();
		try {
			$query = " UPDATE " . $this->dbprexis . $this->tabela () . " SET " . " dtmodificacao = now(), " . " modificador = 'desenv',  " . " dtenvio = now()  " . " WHERE " . $this->idtabela () . " =  ? ";
			
			$this->con->setNumero ( 1, $id );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	public function updateAguardandoPagamento($bean) {
		$this->results = new InscritoBean ();
		try {
			$query = " UPDATE " . $this->dbprexis . $this->tabela () .//sql 
			 " SET " .//sql 
			 " dtmodificacao = now(), " .//sql 
			 " situacao  = 'Aguardando pagamento', " .//sql 
			 " modificador = 'desenv',  " .//sql 
			" dtenvio = now()  " .//sql 
			" WHERE " .//sql 
			$this->idtabela () . " =  ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto( $bean ) );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO updateAguardandoPagamento", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	
	
	
	public function desativar($bean) {
		$this->results = new InscritoBean ();
		try {
			$usuarioLoginBean = $this->setoperador ();
			if ($usuarioLoginBean != null) {
				$bean->setmodificador ( $usuarioLoginBean->getusuario () );
			}
			$query = " UPDATE " .//sql 
			$this->dbprexis . $this->tabela () .//sql 
			 " SET " .//sql 
			 " dtmodificacao = now(), " .//sql 
			 " modificador = ? ,  " .//sql 
			" dtativo = now()  " .//sql 
			" WHERE " . $this->idtabela () . " =  ? ";
				
			$this->con->setNumero ( 1, Util::getIdObjeto($bean) );
			$this->con->setNumero ( 2, $usuarioLoginBean->getusuario() );
			$this->con->setsql ( $query );
			Util::echobr ( 0, "InscritoDAO updateDtEnvio", $this->con->getsql () );
			$this->con->execute ();
			$this->returnDataBaseBean->setresposta ( $bean );
			$this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
		return $this->returnDataBaseBean;
	}
	
	
	public function delete($bean) {
		$this->results = new InscritoBean ();
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