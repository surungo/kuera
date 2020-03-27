<?php
class ParametroSQL {
	private $tipo;
	private $valor;
	private $posicao;
	public function ParametroSQL() {
		//echo "Novo<br>";
	}
	/*public function __construct() {
	}*/
	public function setNumero($posicao, $valor) {
		//aspas simples
	    $valor = strval($valor);
	    $valor = $valor == "" ? "null" : Util::soNumero($valor);
		$this->settipo ( "number" );
		$this->setposicao ( $posicao );
		$this->setvalor ( $valor );
	}
	
	public function setTexto($posicao, $valor) {
		
		$this->settipo ( "string" );
		$this->setposicao ( $posicao );
	//	$this->setvalor (   ($valor == null )? null : ( $valor == "") ? "''" : "'" . addslashes($valor) . "'" );
		Util::echobr ( 0, "ParametroSQL setTexto posicao", $posicao );
		Util::echobr ( 0, "ParametroSQL setTexto valor",  $valor );
		Util::echobr ( 0, "ParametroSQL setTexto null",  $valor==null );
		$this->setvalor (   
				($valor == null )? 
					" null " : 
					(
						( $valor == "") ? 
							"''" : 
							"'" . addslashes($valor) . "'"
					) 
			);
	}
	public function setData($posicao, $valor) {
		$dbg = 0;
		$this->settipo ( "date" );
		$this->setposicao ( $posicao );
		if(Util::validateDate($valor) || Util::validateDate($valor,$format = 'Y-m-d H:i') || Util::validateDate($valor,$format = 'Y-m-d') ){
			$valor = $valor;
			Util::echobr($dbg, 'ParametroSQL setData: Y-m-d ', $valor);
		}else{
			if(Util::validateDate($valor,$format = 'd/m/Y H:i:s') ||Util::validateDate($valor,$format = 'd/m/Y H:i') ||Util::validateDate($valor,$format = 'd/m/Y')){
				$valor = Util::strtotimestamp($valor);	
				Util::echobr($dbg, 'ParametroSQL setData: d/m/Y ', $valor);
				
			}
		}
		Util::echobr($dbg, 'ParametroSQL setData: return ', $valor);
		$this->setvalor ( $valor == "" ? "null" : "'" . $valor . "'" );
	}
	public function setBooleano($posicao, $valor) {
		$valor = $valor == "" ? "null" : $valor;
		$valor = $valor == true ? "true" : "false";
		$this->settipo ( "boolean" );
		$this->setposicao ( $posicao );
		$this->setvalor ( $valor );
	}
	public function gettipo() {
		return $this->tipo;
	}
	public function settipo($tipo) {
		$this->tipo = $tipo;
	}
	public function getposicao() {
		return $this->posicao;
	}
	public function setposicao($posicao) {
		$this->posicao = $posicao;
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$this->valor = $valor;
	}
}

?>