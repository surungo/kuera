<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class InscritoBean extends AbstractBean {
	private $id;
	private $nrinscrito;
	private $campeonato;
	private $apelido;
	private $nome;
	private $peso;
	private $pesoextra;
	private $dtnascimento;
	private $email;
	private $cpf;
	private $telefone;
	private $celular;
	private $telefonecomercial;
	private $valor;
	private $grupo;
	private $situacao;
	private $dtpagamento;
	private $tamanhocamisa;
	private $carro;
	private $nrcarro;
	private $chefeequipe;
	private $cep;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $nrcba;
	private $cidade;
	private $uf;
	private $evento;
	private $pessoa;
	private $dtvalidaemail;
	private $dtinscricao;
	private $categoria;
	private $ipcriacao;
	private $dtenvio;
	private $categoriainscrito;
	public function InscritoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getnrinscrito() {
		return $this->nrinscrito;
	}
	public function setnrinscrito($nrinscrito) {
		$this->nrinscrito = $nrinscrito;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
	public function getapelido() {
		return $this->apelido;
	}
	public function setapelido($apelido) {
		$this->apelido = $apelido;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function getpeso() {
		return $this->peso;
	}
	public function setpeso($peso) {
		$this->peso = $peso;
	}
	public function getpesoextra() {
		return $this->pesoextra;
	}
	public function setpesoextra($pesoextra) {
		$this->pesoextra = $pesoextra;
	}
	public function getdtnascimento() {
		return $this->dtnascimento;
	}
	public function setdtnascimento($dtnascimento) {
		$this->dtnascimento = $dtnascimento;
	}
	public function getidade() {
		$idade = ($this->dtnascimento != "") ? floor ( (strtotime ( date ( 'd-m-Y' ) ) - strtotime ( $this->dtnascimento )) / (60 * 60 * 24 * 365.2421896) ) : "";
		return ($idade > 99) ? "NA" : $idade;
	}
	public function getemail() {
		return $this->email;
	}
	public function setemail($email) {
		$this->email = $email;
	}
	public function getcpf() {
		$vowels = array(".", "-");
		return str_replace($vowels, "",$this->cpf);
	}
	public function gettxcpf() {
		return Util::mask($this->cpf,'###.###.###-##');
	}
	public function setcpf($cpf) {
		$this->cpf = $cpf;
	}
	public function gettelefone() {
		return $this->telefone;
	}
	public function gettelefonelength() {
		$telefoneF = $this->telefone;
		$telefoneF = Util::soNumero ( $telefoneF );
		$telefoneF = $telefoneF + 0;
		$tamanho = strlen ( $telefoneF );
		return $tamanho;
	}
	public function gettelefoneFormatI() {
		$retorno = "";
		$telefoneF = $this->telefone;
		$telefoneF = Util::soNumero ( $telefoneF );
		$telefoneF = $telefoneF + 0;
		$tamanho = strlen ( $telefoneF );
		// não tem ddd
		if ($tamanho == 11) {
			$telefoneF = substr_replace ( $telefoneF, "-", 6, 0 );
			$retorno = '(' . substr_replace ( $telefoneF, ") ", 2, 0 );
		}
		if ($tamanho == 10) {
			$telefoneF = substr_replace ( $telefoneF, "-", 6, 0 );
			if (substr ( $telefoneF, 2, 1 ) > 5) {
				$telefoneF = '(' . substr_replace ( $telefoneF, ") 9", 2, 0 );
			} else {
				$telefoneF = '(' . substr_replace ( $telefoneF, ") ", 2, 0 );
			}
			$retorno = $telefoneF;
		}
		
		return $retorno;
	}
	public function settelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getvalorDecimal() {
		// return str_replace(".", ",", $this->valor);
		return ($this->valor != null && $this->valor != "") ? number_format ( $this->valor, 2, ',', ' ' ) : "";
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$valor = str_replace ( " ", "", $valor );
		$valor = str_replace ( " ", "", $valor );
		$valor = str_replace ( " ", "", $valor );
		$this->valor = str_replace ( ",", ".", $valor );
	}
	public function getgrupo() {
		return $this->grupo;
	}
	public function setgrupo($grupo) {
		$this->grupo = $grupo;
	}
	public function getsituacao() {
		return $this->situacao;
	}
	public function setsituacao($situacao) {
		$this->situacao = $situacao;
	}
	public function getdtpagamento() {
		return $this->dtpagamento;
	}
	public function setdtpagamento($dtpagamento) {
		$this->dtpagamento = $dtpagamento;
	}
	public function gettamanhocamisa() {
		return $this->tamanhocamisa;
	}
	public function settamanhocamisa($tamanhocamisa) {
		$this->tamanhocamisa = $tamanhocamisa;
	}
	public function getdtvalidaemail() {
		return $this->dtvalidaemail;
	}
	public function setdtvalidaemail($dtvalidaemail) {
		$this->dtvalidaemail = $dtvalidaemail;
	}
	public function getdtinscricao() {
		return $this->dtinscricao;
	}
	public function setdtinscricao($dtinscricao) {
		$this->dtinscricao = $dtinscricao;
	}
	public function getpessoa() {
		return $this->pessoa;
	}
	public function setpessoa($pessoa) {
		$this->pessoa = $pessoa;
	}
	public function getcategoria() {
		return $this->categoria;
	}
	public function setcategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getcategoriainscrito() {
		return $this->categoriainscrito;
	}
	public function setcategoriainscrito($categoriainscrito) {
		$this->categoriainscrito = $categoriainscrito;
	}
	public function getcidade() {
		return $this->cidade;
	}
	public function setcidade($cidade) {
		$this->cidade = $cidade;
	}
	public function getuf() {
		return $this->uf;
	}
	public function setuf($uf) {
		$this->uf = $uf;
	}
	public function getendereco() {
		return $this->endereco;
	}
	public function setendereco($endereco) {
		$this->endereco = $endereco;
	}
	public function getnrcba() {
		return $this->nrcba;
	}
	public function getnrcbalpad5() {
		$nrcbaN = Util::soNumero ( $this->nrcba );
		if ($nrcbaN > 99999) {
			$nrcbaN = "";
		} else {
			$nrcbaN = str_pad ( $nrcbaN, 5, "0", STR_PAD_LEFT );
		}
		return $nrcbaN;
	}
	public function setnrcba($nrcba) {
		$this->nrcba = $nrcba;
	}
	public function getcarro() {
		return $this->carro;
	}
	public function setcarro($carro) {
		$this->carro = $carro;
	}
	public function getnrcarro() {
		return $this->nrcarro;
	}
	public function setnrcarro($nrcarro) {
		$this->nrcarro = $nrcarro;
	}
	public function getcep() {
		return $this->cep;
	}
	public function setcep($cep) {
		$this->cep = $cep;
	}
	public function getcelular() {
		return $this->celular;
	}
	public function setcelular($celular) {
		$this->celular = $celular;
	}
	public function gettelefonecomercial() {
		return $this->telefonecomercial;
	}
	public function settelefonecomercial($telefonecomercial) {
		$this->telefonecomercial = $telefonecomercial;
	}
	public function getchefeequipe() {
		return $this->chefeequipe;
	}
	public function setchefeequipe($chefeequipe) {
		$this->chefeequipe = $chefeequipe;
	}
	public function getnumero() {
		return $this->numero;
	}
	public function setnumero($numero) {
		$this->numero = $numero;
	}
	public function getcomplemento() {
		return $this->complemento;
	}
	public function setcomplemento($complemento) {
		$this->complemento = $complemento;
	}
	public function getbairro() {
		return $this->bairro;
	}
	public function setbairro($bairro) {
		$this->bairro = $bairro;
	}
	public function getevento() {
		return $this->evento;
	}
	public function setevento($evento) {
		$this->evento = $evento;
	}
	public function getipcriacao() {
		return $this->ipcriacao;
	}
	public function setipcriacao($ipcriacao) {
		$this->ipcriacao = $ipcriacao;
	}
	public function getdtenvio() {
		return $this->dtenvio;
	}
	public function setdtenvio($dtenvio) {
		$this->dtenvio = $dtenvio;
	}
	
	public function setpessoaatualiza($pessoa) {
		$this->pessoa = $pessoa;
		
		$this->setapelido(		$pessoa->getapelido());
		$this->setbairro(		$pessoa->getbairro());
		$this->setcep(		$pessoa->getcep());
		$this->setcidade(		$pessoa->getcidade());
		$this->setcomplemento(		$pessoa->getcomplemento());
		$this->setcpf(		$pessoa->getcpf());
		$this->setdtnascimento(		$pessoa->getdtnascimento());
		$this->setdtvalidaemail(		$pessoa->getdtvalidaemail());
		$this->setemail(		$pessoa->getemail());
		$this->setendereco(		$pessoa->getendereco());
		$this->setnome(		$pessoa->getnome());
		$this->setnumero(		$pessoa->getnumero());
		$this->setpeso(		$pessoa->getpeso());
		$this->setpesoextra(		$pessoa->getpesoextra());
		$this->settamanhocamisa(		$pessoa->gettamanhocamisa());
		$this->settelefone(		$pessoa->gettelefone());
		$this->setuf(		$pessoa->getuf());		
		
	}
	
	
	public function setpilotoatualiza($piloto) {
		
		$this->setapelido(		$piloto->getapelido());
		$this->setcpf(		$piloto->getcpf());
		$this->setdtnascimento(		$piloto->getdtnascimento());
		$this->setemail(		$piloto->getemail());
		$this->setnome(		$piloto->getnome());
		$this->setpeso(		$piloto->getpeso());
		$this->setpesoextra(		$piloto->getpesoextra());
		$this->settelefone(		$piloto->gettelefone());
		$this->setpessoa(		$piloto->getpessoa());
				
	}
	
}
?>
