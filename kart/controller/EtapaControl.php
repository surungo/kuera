<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

$dbg = 0;

$bean = new EtapaBean ();
$etapaBusiness = new EtapaBusiness ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'EtapaControl  $selcampeonato', $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnumero ( (isset ( $_POST ['numero'] )) ? $_POST ['numero'] : null );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setinfo ( (isset ( $_POST ['info'] )) ? $_POST ['info'] : null );
$bean->setcampeonato ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $selcampeonato );
$bean->setdtresultado ( (isset ( $_POST ['dtresultado'] )) ? $_POST ['dtresultado'] : null );
$bean->setdtgrid ( (isset ( $_POST ['dtgrid'] )) ? $_POST ['dtgrid'] : null );
$bean->setdtranking ( (isset ( $_POST ['dtranking'] )) ? $_POST ['dtranking'] : null );
$bean->getpostlog ();

$bean->getpostlog ();
$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($etapaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $etapaBusiness->findEtapaByCampeonato ( $selcampeonato );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $etapaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $etapaBusiness->findById ( $idobj );
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