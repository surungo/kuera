<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoEquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoEquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
$dbg = 0;
$bean = new InscritoEquipeBean ();
$inscritoEquipeBusiness = new InscritoEquipeBusiness ();
$equipeBusiness = new EquipeBusiness ();
$inscritoBusiness = new InscritoBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$campeonatoBusiness = new CampeonatoBusiness ();

$cltCampeonatoSelecionar = $campeonatoBusiness->findAllAtivo();
Util::echobr ( $dbg, 'InscritoEquipeControl  $cltCampeonatoSelecionar', $cltCampeonatoSelecionar );
// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'InscritoEquipeControl  $selcampeonato', $selcampeonato );

$cltEquipeSelecionar = $equipeBusiness->findByCampeonato ( $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$equipeBean = new EquipeBean ();
$equipeBean->setid ( (isset ( $_POST ['equipe'] )) ? $_POST ['equipe'] : null );
$equipeBean->setcampeonato ( $selcampeonato );
if (Util::getIdObjeto ( $equipeBean ) < 1) {
	$equipeSelClt = $equipeBusiness->findByCampeonato ( $selcampeonato );
	if (count ( $equipeSelClt ) > 0) {
		$equipeBean = $equipeSelClt [0];
	}
}
$bean->setequipe ( $equipeBean );
$bean->setinscrito ( (isset ( $_POST ['inscrito'] )) ? $_POST ['inscrito'] : null );
$bean->setpiloto ( (isset ( $_POST ['piloto'] )) ? $_POST ['piloto'] : null );
$bean->getpostlog ();

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	case Choice::ADICIONAR :
		Util::echobr ( 0, 'InscritoEquipeControl  choice ADICIONAR', $choice );
		$inscritoBean = new InscritoBean ();
		$inscritoBean->setcampeonato ( $selcampeonato );
		$cltInscritoSelecionar = $inscritoBusiness->findAllSort ( $inscritoBean );
		$urlCmais = "Inscrito";
		$urlC = LISTAR;
		break;
	
	case Choice::VOLTAR :
		$urlC = EDITAR;
		break;
	
	case Choice::SALVA_U :
		$bean->setinscrito ( $inscritoBusiness->findById ( Util::getIdObjeto ( $bean->getinscrito () ) ) );
		Util::echobr ( $dbg, 'InscritoEquipeControl SALVA_U getNomeObjeto $bean->getinscrito', Util::getNomeObjeto ( $bean->getinscrito () ) );
		$urlC = EDITAR;
		break;
	
	case Choice::EXCLUIR :
		if ($inscritoEquipeBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $inscritoEquipeBusiness->findByCampeonato ( $selcampeonato );
		
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		$retorno = $inscritoEquipeBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		$totalinscritoequipe = $inscritoEquipeBusiness->totalInscritos ( $equipeBean );
		Util::echobr ( 0, 'InscritoEquipeControl LISTAR $$totalinscritoequipe', $totalinscritoequipe );
		$inscritoEquipeClt = $inscritoEquipeBusiness->findByCampeonatoEquipe ( $bean );
		
		if ($idobj > 0) {
			$bean = $inscritoEquipeBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>