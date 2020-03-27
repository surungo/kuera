<?php
include_once PATHPUBFAC . '/Util.php';
include_once 'AbstractControl.php';
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

$bean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->settotalvaga ( (isset ( $_POST ['totalvaga'] )) ? $_POST ['totalvaga'] : null );
$bean->settotalvagaequipe ( (isset ( $_POST ['totalvagaequipe'] )) ? $_POST ['totalvagaequipe'] : null );
$bean->settotalinscritoequipe ( (isset ( $_POST ['totalinscritoequipe'] )) ? $_POST ['totalinscritoequipe'] : null );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$bean->setvalorporextenso ( (isset ( $_POST ['valorporextenso'] )) ? $_POST ['valorporextenso'] : null );
$bean->setvalorpaypal ( (isset ( $_POST ['valorpaypal'] )) ? $_POST ['valorpaypal'] : null );
$bean->setvezespaypal ( (isset ( $_POST ['vezespaypal'] )) ? $_POST ['vezespaypal'] : null );
$bean->setemailpaypal ( (isset ( $_POST ['emailpaypal'] )) ? $_POST ['emailpaypal'] : null );
$bean->setmostrarespera ( (isset ( $_POST ['mostrarespera'] )) ? $_POST ['mostrarespera'] : null );
$bean->setmsglistaespera ( (isset ( $_POST ['msglistaespera'] )) ? $_POST ['msglistaespera'] : null );
$bean->setlistainscrito ( (isset ( $_POST ['listainscrito'] )) ? $_POST ['listainscrito'] : null );
$bean->setmsgaguardandopagamento ( (isset ( $_POST ['msgaguardandopagamento'] )) ? $_POST ['msgaguardandopagamento'] : null );
$bean->setmsgatualizadosucesso ( (isset ( $_POST ['msgatualizadosucesso'] )) ? $_POST ['msgatualizadosucesso'] : null );
$bean->setmsgsucesso ( (isset ( $_POST ['msgsucesso'] )) ? $_POST ['msgsucesso'] : null );
$bean->setmsgsucessoequipe ( (isset ( $_POST ['msgsucessoequipe'] )) ? $_POST ['msgsucessoequipe'] : null );
$bean->setdtinicioinscricoes ( (isset ( $_POST ['dtinicioinscricoes'] )) ? $_POST ['dtinicioinscricoes'] : null );
$bean->setdtfinalinscricoes ( (isset ( $_POST ['dtfinalinscricoes'] )) ? $_POST ['dtfinalinscricoes'] : null );
$bean->settipoevento ( (isset ( $_POST ['tipoevento'] )) ? $_POST ['tipoevento'] : null );
$bean->setadicionarcentavos ( (isset ( $_POST ['adicionarcentavos'] )) ? $_POST ['adicionarcentavos'] : null );
$showinativos = (isset ( $_POST ['showinativos'] )) ? $_POST ['showinativos'] : "N" ;
$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	case Choice::DESATIVAR :
		$retorno = $campeonatoBusiness->desativar ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();
		echo "<script>$(document).ready(function() { $('#formDefault').submit(); });</script>";
		$choice = Choice::LISTAR;
		break;
	case Choice::VALIDAR :
			$retorno = $campeonatoBusiness->ativar ( $bean );
			$bean = $retorno->getresposta ();
			$idobj = Util::getIdObjeto ( $bean );
			$mensagem = $retorno->getmensagem ();
			echo "<script>$(document).ready(function() { $('#formDefault').submit(); });</script>";
			$choice = Choice::LISTAR;
			break;

}

switch ($choice) {

	case Choice::EXCLUIR :
		if ($campeonatoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}

	case Choice::LISTAR :
	    if($showinativos=="S"){
	        $collection = $campeonatoBusiness->findAll ();
	    }else{
	        $collection = $campeonatoBusiness->findAllAtivo();
	    }
		
		$urlC = LISTAR;
		break;

	case Choice::SALVAR :
		$retorno = $campeonatoBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();

	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $campeonatoBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();

		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>
