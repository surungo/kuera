<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingVO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PistaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PosicaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PosicaoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontuacaoBusiness.php';

$idcampeonato = 1;
$rankingVO = new RankingVO ();
$pilotoBateriaBusiness = new PilotoBateriaBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$bateriaBusiness = new BateriaBusiness ();
$pontuacaoBusiness = new PontuacaoBusiness ();

$cltRanking = $pilotoBateriaBusiness->findRanking ( $idcampeonato );
$urlC = LISTAR;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>