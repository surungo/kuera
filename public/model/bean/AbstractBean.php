<?php
include_once PATHPUBBUS . '/ParametroBusiness.php';
abstract class AbstractBean {
	protected $criador;
	protected $dtcriacao;
	protected $modificador;
	protected $dtmodificacao;
	protected $dtvalidade;
	protected $dtinicio;
	protected $sort;
	public function getcriador() {
		return $this->criador;
	}
	public function setcriador($criador) {
		$this->criador = $criador;
	}
	public function getdtcriacao() {
		return $this->dtcriacao;
	}
	public function setdtcriacao($dtcriacao) {
		$this->dtcriacao = $dtcriacao;
	}
	public function getmodificador() {
		return $this->modificador;
	}
	public function setmodificador($modificador) {
		$this->modificador = $modificador;
	}
	public function getdtmodificacao() {
		return $this->dtmodificacao;
	}
	public function setdtmodificacao($dtmodificacao) {
		$this->dtmodificacao = $dtmodificacao;
	}
	public function isvalidade() {
		$dbg = 0;
		setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
		date_default_timezone_set('America/Sao_Paulo');
				
		$date =  Date( '2999-12-31 23:59:59' );
		//$dtvalidade = ($this->dtvalidade == "") ? $date->format ( 'Y-m-d H:i:s' ) : $this->dtvalidade;
		$dtvalidade = ($this->dtvalidade == "") ? $date : $this->dtvalidade;
		Util::echobr ( $dbg, 'AbstractBean idvalidade dtvalidade', $dtvalidade );
		$data = date ( "Y-m-d H:i:s" );
		Util::echobr ( $dbg, 'AbstractBean idvalidade data now', $data );
		$parametroBusiness = new ParametroBusiness();
		$ajustedata = $parametroBusiness->findByCodigo("AJUSTEDATA");
		Util::echobr ( $dbg, 'AbstractBean idvalidade $ajustedata', $ajustedata );
		$newtimestamp = strtotime($data.' '.$ajustedata);
		$data = date('Y-m-d H:i:s', $newtimestamp);
		Util::echobr ( $dbg, 'AbstractBean idvalidade data ajustada', $data );
		Util::echobr ( $dbg, 'AbstractBean idvalidade $dtvalidade > $data', ($dtvalidade > $data)?'true':'false' );
		
		return $dtvalidade > $data;
	}
	
	public function isiniciou() {
		$dbg = 0;

		$date = new DateTime ( '1900-01-01' );
		$dtinicio = ($this->dtinicio == "") ? $date->format ( 'Y-m-d H:i:s' ) : $this->dtinicio;
		Util::echobr ( $dbg, 'AbstractBean isiniciou $dtinicio', $dtinicio );
		$data = date ( "Y-m-d H:i:s" );
		Util::echobr ( $dbg, 'AbstractBean isiniciou data now', $data );
		$parametroBusiness = new ParametroBusiness();
		$ajustedata = $parametroBusiness->findByCodigo("AJUSTEDATA");
		Util::echobr ( $dbg, 'AbstractBean isiniciou $ajustedata', $ajustedata );
		$newtimestamp = strtotime($data.' '.$ajustedata);
		$data = date('Y-m-d H:i:s', $newtimestamp);
		Util::echobr ( $dbg, 'AbstractBean isiniciou data ajustada', $data );
		return $dtinicio < $data;
	}
	

	public function getdtvalidade() {
		return $this->dtvalidade;
	}
	public function setdtvalidade($dtvalidade) {
		$this->dtvalidade = $dtvalidade;
	}
	public function getdtinicio() {
		return $this->dtinicio;
	}
	public function setdtinicio($dtinicio) {
		$this->dtinicio = $dtinicio;
	}
	public function getsort() {
		return $this->sort;
	}
	public function setsort($sort) {
		$this->sort = $sort;
	}
	public function getpostlog() {
		$this->setdtinicio ( (isset ( $_POST ['dtinicio'] ) && $_POST ['dtinicio'] != "") ? Util::strtotimestamp ( $_POST ['dtinicio'] ) : "" );
		$this->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
	}
	
	/* Essa é a função estática de comparação */
	static function cmp_obj_nome($a, $b) {
		$al = strtolower ( $a->getnome());
		$bl = strtolower ( $b->getnome());
		if ($al == $bl) {
			return 0;
		}
		return ($al > $bl) ? + 1 : - 1;
	}

}
?>