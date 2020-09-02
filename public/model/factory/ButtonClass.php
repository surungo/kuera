<?php
class ButtonClass {
	public function ButtonClass() {
	}
	public function atributos($idurl, $idobj, $action, $target, $choice) {
		/*
		 * ChromePhp::log('Atributos; '); ChromePhp::log('value: '.$value); ChromePhp::log('idurl: '.$idurl); ChromePhp::log('idobj: '.$idobj); ChromePhp::log('action: '.$action); ChromePhp::log('target: '.$target); ChromePhp::log('choice: '.$choice);
		 */
		$retorno = ($idurl != '') ? " idurl='" . $idurl . "' \n" : "";
		$retorno .= ($idobj != "") ? " idobj='" . $idobj . "' \n" : "";
		$retorno .= ($action != "") ? " action='" . $action . "' \n" : "";
		$retorno .= ($target != "") ? " target='" . $target . "' \n" : "";
		$retorno .= ($choice != "") ? " choice='" . $choice . "' \n" : "";

		// ChromePhp::log('buttonAttr;'.$retorno);
		// ChromePhp::log($_SERVER);
		// ChromePhp::warn('something went wrong!');

		return $retorno;
	}

	public function btCustomImagem ( $idobj, $idurl, $choice, $imagem ){
		Util::echobr(0, 'BTN ', $imagem);
		return ButtonClass::btImagem($value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);
	}
	
	public function btImagem($value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h) {
		$retorno = ButtonClass::btImagemIfk('', $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);
		return $retorno;
	}
	
	public function btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h) {
		$retorno = "<input id='custom".$idobj."' name='custom' " . " title='" . $idobj . "' ";
		$retorno .= ($itemFK != '') ? " itemFK='" . $itemFK . "' \n" : "";
		$retorno .= ($value != '') ? " value='" . $value . "' \n" : "";
		$retorno .= ($idurl != '') ? " idurl='" . $idurl . "' \n" : "";
		$retorno .= ($idobj != "") ? " idobj='" . $idobj . "' \n" : "";
		$retorno .= ($action != "") ? " action='" . $action . "' \n" : "";
		$retorno .= ($target != "") ? " target='" . $target . "' \n" : "";
		$retorno .= ($choice != "") ? " choice='" . $choice . "' \n" : "";
		$retorno .= " type='button' ";
		$retorno .= " style=\"background: url('" . $imagem . "'); ";
		$retorno .= ($w != "") ?" width:".$w."; ":"";
		$retorno .= ($h != "") ?" height:".$h."; ":"";
		$retorno .= " text-align:left; ";
		$retorno .= " color: black; ";
		$retorno .= " border: 0px; ";
		$retorno .= " background-color: transparent; ";
		$retorno .= " background-position:right; ";
		$retorno .= " background-repeat:no-repeat;\" ";
		$retorno .= " class='btn_abrir' title='" . $action. " " . $idobj . "' " ;
		$retorno .=  " />";
		return $retorno;
	}

	public function btBotao($value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h) {
		$retorno = "<input id='custom".$idobj."' name='custom' " . " title='" . $idobj . "' ";
		$retorno .= ($value != '') ? " value='" . $value . "' \n" : "";
		$retorno .= ($idurl != '') ? " idurl='" . $idurl . "' \n" : "";
		$retorno .= ($idobj != "") ? " idobj='" . $idobj . "' \n" : "";
		$retorno .= ($action != "") ? " action='" . $action . "' \n" : "";
		$retorno .= ($target != "") ? " target='" . $target . "' \n" : "";
		$retorno .= ($choice != "") ? " choice='" . $choice . "' \n" : "";
		$retorno .= " type='button' ";
		$retorno .= " style=\"background: url('" . $imagem . "'); ";
		$retorno .= " width:".$w."; ";
		$retorno .= " height:".$h."; ";
		$retorno .= " text-align:left; ";
		//$retorno .= " border: 0px;color:white";
		$retorno .= " margin: 2px; ";
		$retorno .= " background-color: #eeeeee; ";
		//$retorno .= " background-position:right; ";
		$retorno .= " background-position: 95% 50%; ";
		$retorno .= " background-repeat:no-repeat;\" ";
		$retorno .= " class='btn_abrir' title='" . $idobj . "' " ;
		$retorno .=  " />";
		return $retorno;
	}



	public function btHidden($idinput, $value, $idurl, $idobj, $action, $target, $choice) {
		$retorno = "<input id='" . $idinput . "".$idobj."' " .
		" name='" . $idinput . "' " .
		" value='btHidden' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='hidden' title='$idobj' " . "/>";
		return $retorno;
	}
	public function btLink($value, $idurl, $idobj, $action, $target, $choice) {
		return "<div id='btn_link".$idobj."'  " .
		" value='$value' \n" . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " class='btn_link' title='$idobj' \n" . ">" . $value . "</div>\n";
	}
	public function btMenu($value, $idurl, $idobj, $action, $target, $choice) {
		// ChromePhp::log('menu;'.$value);
		$retorno = "<div id='$action".$idobj."'  " .
		" value='$value' \n" . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		" class='btn_item_menu'  \n" . ">" . $value . "</div>\n";
		return $retorno;
	}
	public function btNovoImagem($idurl) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::ABRIR;
		$retorno = "<input id='novo".$idobj."' name='novo' " . " value='Novo' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='image' " . " class='btn_abrir' " .
				" src='".URLAPPVER."/public/view/images/novo.png' title='$idobj' ".
				/*" style='border: 0px;color:white;background-color: transparent;' ".*/
			"/>";
		return $retorno;
	}
	public function btEditarOld($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::ABRIR;
		$retorno = "<input id='editar".$idobj."' " . " name='editar' " . " value='Editar' " .
		$this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='image' " .
		" class='btn_abrir' title='$idobj' " . " src='".URLAPPVER."/public/view/images/editar.png' " .
		" style='border: 0px;color:white;background-color: transparent;' " . "/>";
		return $retorno;
	}

	public function btEditar($idobj, $idurl) {
		$value = '';
		$action = '';
		$target = '';
		$choice = Choice::ABRIR;
		$imagem = URLAPPVER.'/public/view/images/editar.png';
		$w = "24px";
		$h = "24px";
		return $this->btImagem($value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);

	}
	public function btDesativar($idobj, $idurl) {
		$value = "";
		$action = "";
		$target = "";
		$choice = Choice::DESATIVAR;
		$imagem = URLAPPVER.'/public/view/images/desativar.png';
		$w = "24px";
		$h = "24px";
		return $this->btImagem($value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);
	}

	public function btValidar($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::VALIDAR;
		$retorno = "<input id='validar".$idobj."' " . " name='validar' " . " value='validar' " .
		" title='$idobj' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		" type='image' " . " class='btn_abrir' " .
		" src='".URLAPPVER."/public/view/images/validar.png' " . " style='border: 0px;color:white;background-color: transparent;' " . "/>";
		return $retorno;
	}
	
	public function btPresente($idobj, $idurl) {
	    $action = null;
	    $target = null;
	    $choice = Choice::PRESENTE;
	    $retorno = "<input id='validar".$idobj."' " . " name='presente' " . " value='presente' " .
	   	    " title='$idobj' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
	   	    " type='image' " . " class='btn_abrir' " .
	   	    " src='".URLAPPVER."/public/view/images/red.gif' " . " style='width: 52px; border: 0px;color:white;background-color: transparent;' " . "/>";
	    return $retorno;
	}
	public function btAusente($idobj, $idurl) {
	    $action = null;
	    $target = null;
	    $choice = Choice::AUSENTE;
	    $retorno = "<input id='validar".$idobj."' " . " name='ausente' " . " value='ausente' " .
	   	    " title='$idobj' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
	   	    " type='image' " . " class='btn_abrir' " .
	   	    " src='".URLAPPVER."/public/view/images/green.gif' " . " style='width: 52px; border: 0px;color:white;background-color: transparent;' " . "/>";
	    return $retorno;
	}
	
	
	
	public function btProximo($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::ABRIR;
		$retorno = "<input id='proximo".$idobj."' " . " name='proximo' " .
		" value='Proximo >>' " . $this->atributos ( $idurl, $idobj + 1, $action, $target, $choice ) .
		 " type='button' " . " class='btn_abrir' title='$idobj' " . "/>";
		return $retorno;
	}
	public function btAnterior($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::ABRIR;
		$retorno = "<input id='anterior".$idobj."' " .
		 " name='anterior' " . " value='<< Anterior' " .
		$this->atributos ( $idurl, $idobj - 1, $action, $target, $choice ) .
		" type='button' " . " class='btn_abrir' title='$idobj' " . "/>";
		return $retorno;
	}
	public function btSalvar($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::SALVAR;
		$retorno = "<input id='salvar".$idobj."' " . " name='salvar' " .
		" value='Salvar' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		 " type='button' " . " class='btn_abrir' title='$idobj' " . "/>";
		return $retorno;
	}
	public function btNovo($idurl) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::SALVAR;

		$retorno = "<input id='novo".$idobj."' name='novo' " .
		 " value='Novo' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		" type='button' " . " class='btn_abrir' title='$idobj' " . "/>";
		return $retorno;
	}
	public function btExcluirImagem($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::EXCLUIR;

		$retorno = "<input id='excluir".$idobj."' name='excluir' " .
				" value='Excluir' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
				 " type='image' title='$idobj' " . " class='btn_abrir' " .
				 " src='".URLAPPVER."/public/view/images/excluir.png' " .
				 " style='border: 0px;color:white;background-color: transparent;' " .

		"/>";
		return $retorno;
	}
	public function btCorrigirImagem($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::CORRIGIR;

		$retorno = "<input id='corrigir".$idobj."' name='corrigir' " .
				" value='Corrigir' title='$idobj' " .
				$this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
				" type='image' " . " class='btn_abrir' title='$idobj' " .
				" src='".URLAPPVER."/public/view/images/excluir.png' " . " style='border: 0px;color:white;background-color: transparent;' " .

		"/>";
		return $retorno;
	}
	public function btExcluir($idobj, $idurl) {
		$action = null;
		$target = null;
		$choice = Choice::EXCLUIR;

		$retorno = "<input id='excluir".$idobj."' name='excluir' " .
		" value='Excluir' title='$idobj' " . $this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		" type='button' " . " class='btn_abrir' " . "/>";
		return $retorno;
	}
	public function btVoltar($idurlx) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::LISTAR;

		$retorno = "<input id='voltar".$idobj."' name='voltar' " .
		" value='Lista' title='pg_$idurlx' " . $this->atributos ( $idurlx, $idobj, $action, $target, $choice ) .
		 " type='button' " . " class='btn_abrir' " . "/>";
		return $retorno;
	}

	public function btVoltar2($idurlx) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::LISTAR;

		$retorno = "<input id='voltar".$idobj."' name='voltar' " .
		 " value='Voltar' title='pg_$idurlx' " .
		 $this->atributos ( $idurlx, $idobj, $action, $target, $choice ) .
		" type='button' " . " class='btn_abrir' " . "/>";
		return $retorno;
	}


	public function btListar($idurl) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::LISTAR;

		$retorno = "<input id='listar".$idobj."' name='listar' " . " value='Listar' title='$idobj' " .
		$this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='button' " .
		" class='btn_abrir' " . "/>";
		return $retorno;
	}
	
	public function btAtualizarLista($idurl) {
	    $idobj = null;
	    $action = null;
	    $target = null;
	    $choice = Choice::LISTAR;
	    
	    $retorno = "<input id='atualizar".$idobj."' name='atualizar' " . " value='Atualizar' title='$idobj' " .
	    $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='button' " .
	    " class='btn_abrir' " . "/>";
	    return $retorno;
	}
	
	public function btRefreshLista($idurl) {
	    $idobj = null;
	    $action = null;
	    $target = null;
	    $choice = Choice::LISTAR;
	    
	    $retorno = "<input id='listar".$idobj."' name='listar' " . " value='Listar' title='$idobj' " .
	    $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='image' " .
	    " class='btn_abrir' title='$idobj' " . " width='16' height='16' " .
	    " src='".URLAPPVER."/public/view/images/refresh.png' " .
	    " style='border: 0px;color:white;background-color: transparent;' " . "/>";
	    return $retorno;
	}
	
	public function btSort($clSort, $coluna, $atualsort, $idurl) {
		$idobj = null;
		$action = null;
		$target = null;
		$choice = Choice::LISTAR;
		$marca = "";

		$pieces = explode ( ",", $atualsort );

		for($i = 0; $i < count ( $pieces ); $i ++) {
			$pos = strpos ( $pieces [$i], $clSort );
			$pos_asc = strpos ( $pieces [$i], "desc" );

			if ($pos > - 1) {
				if ($pos_asc > - 1) {
					$marca = "&uarr;";
				} else {
					$marca = "&darr;";
				}
			}
		}
		$retorno = "<div id='clSort_" . $clSort . "' " . " name='sort' " .
		" value='clsort_" . ((ENCRIPT_LINK) ? Cripto::decrypt ( $idurl ) : $idurl) . "' " .
		$this->atributos ( $idurl, $idobj, $action, $target, $choice ) .
		" clsort='" . $clSort . "' " . " class='cl_sort' " . ">" . $coluna . " " . $marca . "</div>";
		return $retorno;
	}
	public function btSV($idobj, $idurl) {
		$retorno = $this->btSalvar ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		$retorno .= $this->btVoltar ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		return $retorno;
	}


	public function btSEV($idobj, $idurl) {
		$retorno = $this->btNovo ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		if ($idobj != "") {
			$retorno .= $this->btSalvar ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		$retorno .= $this->btExcluir ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		// if($idobj!=""){
		if (false) {
			$retorno .= $this->btAnterior ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
			$retorno .= $this->btProximo ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		$retorno .= $this->btVoltar ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		return $retorno;
	}
    public function btSEV2($idobj, $idurl) {
    	$retorno = "";
    	if ($idobj == "") {
			$retorno .= $this->btNovo ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
    	}	else{
			$retorno .= $this->btSalvar ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		$retorno .= $this->btExcluir ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		// if($idobj!=""){
		if (false) {
			$retorno .= $this->btAnterior ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
			$retorno .= $this->btProximo ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		$retorno .= $this->btVoltar ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		return $retorno;
	}
	public function btSEV3($idobj, $idurl) {
		$retorno = "";
		if ($idobj == "") {
			$retorno .= $this->btNovo ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}	else{
			$retorno .= $this->btSalvar ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		// if($idobj!=""){
		if (false) {
			$retorno .= $this->btAnterior ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
			$retorno .= $this->btProximo ( $idobj, $idurl ) . "&nbsp;&nbsp;&nbsp;";
		}
		$retorno .= $this->btVoltar ( $idurl ) . "&nbsp;&nbsp;&nbsp;";
		return $retorno;
	}

	public function btCustom($idurl, $idobj, $action, $target, $choice) {
		$choice = $choice != null ? $choice : $action;

		$retorno = "<input id='$action' name='$action' " . " value='$action' title='$idobj' " .
		 $this->atributos ( $idurl, $idobj, $action, $target, $choice ) . " type='button' " .
		" class='btn_abrir' " . "/>";
		return $retorno;
	}
}
?>
