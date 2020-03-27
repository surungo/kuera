<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';

$pilotoBusiness = new PilotoBusiness ();
$idpiloto = (isset ( $_GET ["idobj"] ) && $_GET ["idobj"] > 0) ? $_GET ["idobj"] : 1;
$cltPiloto = $pilotoBusiness->findAll ();
$urlC = LISTAR;
$pagename = "FotosPilotos";
$siteUrl = 'mvc/' . $paginaBn->getsistema ()->getcodigo () . '/view/php/' . $pagename . $urlC . '.php';
Util::echobr ( 0, $idurl, $siteUrl );
include ($siteUrl);
?>