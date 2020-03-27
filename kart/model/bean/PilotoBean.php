<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PilotoBean extends AbstractBean {
	private $id;
	private $nome;
	private $apelido;
	private $sigla;
	private $cpf;
	private $telefone;
	private $email;
	private $peso;
	private $facebook;
	private $foto;
	private $fotoimg;
	private $dtnascimento;
	private $descricao;
	private $observacao;
	private $nomeJoin;
	private $pessoa;
	public function PilotoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function getnrpiloto() {
		return str_pad ( $this->getid (), 3, "0", STR_PAD_LEFT );
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function getapelido() {
		return ($this->apelido == "") ? $this->nome : $this->apelido;
	}
	public function setapelido($apelido) {
		$this->apelido = $apelido;
	}
	public function getsigla() {
		return $this->sigla;
	}
	public function setsigla($sigla) {
		$this->sigla= $sigla;
	}
	public function getcpfmascara() {
		return str_replace ( "-", "", str_replace ( ".", "", $this->cpf ) );
	}
	public function getcpf() {
		$vowels = array(".", "-");
		return str_replace($vowels, "",$this->cpf);
	}
	public function gettxcpf() {
		return $this->cpf;
	}
	public function setcpf($cpf) {
		$this->cpf = $cpf;
	}
	public function gettelefone() {
		return $this->telefone;
	}
	public function settelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function getemail() {
		return $this->email;
	}
	public function setemail($email) {
		$this->email = $email;
	}
	public function getpeso() {
		return $this->peso;
	}
	public function setpeso($peso) {
		$this->peso = $peso;
	}
	public function getfacebook() {
		return $this->facebook;
	}
	public function setfacebook($facebook) {
		$facebook = str_replace ( "https://", "http://", $facebook );
		$this->facebook = $facebook;
	}
	public function getfotoimg() {
		return $this->fotoimg;
	}
	public function setfotoimg($fotoimg) {
		$this->fotoimg = $fotoimg;
	}
	public function getfoto() {
		return $this->foto;
	}
	public function setfoto($foto) {
		$foto = str_replace ( "https://", "http://", $foto );
		$this->foto = $foto;
	}
	public function getfotourl() {
		$urlImages = URLAPPVER . '/kart/view/images/';
		// $urlfoto = ($this->foto=='')?'piloto.png':$this->foto;
		// $urlfoto = ($this->getfotoimg()=='')?'piloto.png':'pilotojpg.php?idobj='.$this->getid();
		$urlfoto = ($this->getfotoimg () == '') ? 'piloto.png' : 'pilotopng.php?idobj=' . $this->getid ();
		
		return $urlImages . $urlfoto;
	}
	public function getfotourlPNG() {
		$urlImages = URLAPPVER . '/kart/view/images/';
		// $urlfoto = ($this->foto=='')?'piloto.png':$this->foto;
		$urlfoto = ($this->getfotoimg () == '') ? 'piloto.png' : 'pilotopng.php?idobj=' . $this->getid ();
		
		return $urlImages . $urlfoto;
	}
	public function getfotoFilePNG($tipo) {
		$urlImages = URLAPPVER . '/kart/view/images/';
		// $urlfoto = ($this->foto=='')?'piloto.png':$this->foto;
		$urlfoto = ($this->getfotoimg () == '') ? 'piloto.png' : $this->getnrpiloto () . '-' . $this->getnome () . '.png';
		
		return $urlImages . $tipo . '/' . $urlfoto;
	}
	public function getfotourl1() {
		$urlImages = URLAPPVER . '/kart/view/images/';
		$urlfoto = $this->foto;
		if ($urlfoto != "") {
			$urlfoto = str_replace ( "https://", "http://", $urlfoto );
			$urlfoto = (strpos ( $urlfoto, 'http://' ) > - 1) ? $urlfoto : $urlImages . $urlfoto;
			$headersTest = @get_headers ( $urlfoto );
			// $urlfoto= $headersTest[0];
			if (strpos ( $headersTest [0], '404' ) === false && strpos ( $headersTest [0], '403' ) === false) {
				if (file_get_contents ( $urlfoto, 0, null, 0, 1 )) {
					$urlfoto = $urlfoto;
				} else {
					$urlfoto = '';
				}
			} else {
				$urlfoto = '';
			}
		}
		if ($urlfoto == '') {
			$urlfoto = $urlImages . "piloto.png";
		}
		
		return $urlfoto;
	}
	public function getfotourlOLD() {
		$urlImages = URLAPPVER . '/kart/view/images/';
		$urlfoto = $this->foto;
		if ($urlfoto != "") {
			$urlfoto = str_replace ( "https://", "http://", $urlfoto );
			$urlfoto = (strpos ( $urlfoto, 'http://' ) > - 1) ? $urlfoto : $urlImages . $urlfoto;
			if (file_exists ( $urlfoto ) == 0) {
				$urlfoto = '';
			}
		}
		if ($urlfoto == '') {
			$urlfoto = $urlImages . "piloto.png";
		}
		
		return $urlfoto;
	}
	public function checkRemoteFile($url) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		// don't download content
		curl_setopt ( $ch, CURLOPT_NOBODY, 1 );
		curl_setopt ( $ch, CURLOPT_FAILONERROR, 1 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		if (curl_exec ( $ch ) !== FALSE) {
			return true;
		} else {
			return false;
		}
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
	public function getdescricao() {
		return $this->descricao;
	}
	public function setdescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getobservacao() {
		return $this->observacao;
	}
	public function setobservacao($observacao) {
		$this->observacao = $observacao;
	}
	public function getnomeJoin() {
		return $this->nomeJoin;
	}
	public function setnomeJoin($nomeJoin) {
		$this->nomeJoin = $nomeJoin;
	}
	public function getpessoa() {
		return $this->pessoa;
	}
	public function setpessoa($pessoa) {
		$this->pessoa= $pessoa;
	}
}
?>
