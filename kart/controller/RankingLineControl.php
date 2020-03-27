<?php
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';

$rankingBean = new RankingBean ();
$rankingPilotoBean = new RankingPilotoBean ();
$rankingBean->setcampeonato ( 1 );
$rankingBusiness = new RankingBusiness ();
$rankingPilotoBusiness = new RankingPilotoBusiness ();

$rankingBean = $rankingBusiness->findUltimoForCampeonatoMostrar ( $rankingBean );
$cltPilotos = array ();
$idranking = $rankingBean->getid ();
$cltPilotos = $rankingPilotoBusiness->findByRanking ( $idranking );

$urlC = LISTAR;
$pagename = "RankingLine";
$siteUrl = 'mvc/' . $paginaBn->getsistema ()->getcodigo () . '/view/php/' . $pagename . $urlC . '.php';
Util::echobr ( 0, $idurl, $siteUrl );
include ($siteUrl);
?>