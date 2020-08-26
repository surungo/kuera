<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';


$dbg = 0;
Util::echobr ( $dbg, 'PilotoCampeonatoControl', 1 );

$bean = new PilotoCampeonatoBean ();
$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$campeonatoBusiness = new CampeonatoBusiness ();
$cltPilotoSelecionar = $pilotoBusiness->findAllAtivo();
Util::echobr ( $dbg, 'PilotoCampeonatoControl count($cltPilotoSelecionar) ',  count($cltPilotoSelecionar) );

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
$selcampeonato = (isset ( $_POST ['campeonato'] ) ) ?  $_POST ['campeonato']  : $selcampeonato;
$selcampeonatoBean = $campeonatoBusiness->findById ( $selcampeonato);
Util::echobr ( $dbg, 'EtapaControl  $selcampeonato', $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( $selcampeonato );
$bean->setpiloto ( (isset ( $_POST ['piloto'] )) ? $_POST ['piloto'] : null );


$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pilotoCampeonatoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $pilotoCampeonatoBusiness->findByCampeonato ( $selcampeonato );
		$pesomedio = round ( $pilotoCampeonatoBusiness->findByCampeonatoPesoMedio ( $selcampeonato ), 2 );
		$idademedia = round ( $pilotoCampeonatoBusiness->findByCampeonatoIdadeMedia ( $selcampeonato ) );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		$retorno = $pilotoCampeonatoBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		// opcional server como padrao desta pagina
		
		if ($idobj > 0) {
			$bean = $pilotoCampeonatoBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$cltCampeonatoSelecionar = $campeonatoBusiness->findAll ();

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>