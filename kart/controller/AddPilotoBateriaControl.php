<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';

$dbg = 1;

$bean = new PilotoCampeonatoBean ();
$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$cltPilotoSelecionar = $pilotoBusiness->findAll ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();
// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'AddPilotoBateriaControl  $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : $seletapa;
$seletapabean = $seletapaBusiness->findById ( $seletapa );
Util::echobr ( $dbg, 'AddPilotoBateriaControl  $seletapa', $seletapa );

$selbateriabean = new BateriaBean ();
$selbateriaBusiness = new BateriaBusiness ();
$selbateriabean->setetapa ( $seletapabean );
$selbateriaCollection = $selbateriaBusiness->findBateriaByEtapa ( $selbateriabean );
$selbateria = (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : $selbateria;
$selbateriabean = $selbateriaBusiness->findById ( $selbateria );
Util::echobr ( $dbg, 'AddPilotoBateriaControl  $selbateria', $selbateria );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : null );
$bean->setpiloto ( (isset ( $_POST ['piloto'] )) ? $_POST ['piloto'] : null );
$bean->getpostlog ();

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
$siteUrl = "mvc/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>