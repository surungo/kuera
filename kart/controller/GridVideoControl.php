<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PosicaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PosicaoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';

$dbg = 0;

$bean = new BateriaBean ();
$pilotoBateriaBean = new PilotoBateriaBean ();
$pilotoBateriaBusiness = new PilotoBateriaBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$bateriaBusiness = new BateriaBusiness ();
$posicaoBusiness = new PosicaoBusiness ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();
// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'PilotoBateriaControl  $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : '';
$seletapabean = $seletapaBusiness->findById ( $seletapa );
Util::echobr ( $dbg, 'PilotoBateriaControl  $seletapa', $seletapa );

$selbateriabean = new BateriaBean ();
$selbateriaBusiness = new BateriaBusiness ();
$selbateriabean->setetapa ( $seletapabean );
$selbateriaCollection = $selbateriaBusiness->findBateriaByEtapa ( $selbateriabean );

$selbateria = (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : '';
$selbateriabean = $selbateriaBusiness->findById ( $selbateria );
Util::echobr ( $dbg, 'PilotoBateriaControl  $selbateria', $selbateria );

$usuarioCollection = $usuarioBusiness->findAll ();
$cltPosicaoSelecionar = $posicaoBusiness->findAll ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );


$bean->getpostlog ();
$editar = true;
$novo = true;

$urlCmais = "";
switch ($choice) {
	case Choice::VOLTAR :
		
		$urlC = EDITAR;
		break;
	case Choice::LISTAR :
		
		$urlC = LISTAR;
		break;
	
	case Choice::ABRIR :
		// opcional server como padrao desta pagina
		$clsort = "idposicao";
		$bean->setsort ( $clsort );
		$collection = $pilotoBateriaBusiness->findBateriaByCampeonatoEtapaBateria ( $selcampeonato, $seletapa,  $idobj );
		usort($collection , 'sortGrid');
		// $collection = $pilotoBateriaBusiness->findAll();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

function sortGrid($object1, $object2) { 
    return $object1->getgridlargada() > $object2->getgridlargada() ; 
} 
?>