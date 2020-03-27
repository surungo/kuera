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
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';


$dbg = 0;

$bean = new PilotoBateriaBean ();
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
Util::echobr ( $dbg, 'RankingFaceControl    $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : '';
$seletapabean = $seletapaBusiness->findById ( $seletapa );
Util::echobr ( $dbg, 'RankingFaceControl    $seletapa', $seletapa );
Util::echobr ( $dbg, 'RankingFaceControl   count $seletapaCollection ', count($seletapaCollection) );

$selcategoria = (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : '';

$usuarioCollection = $usuarioBusiness->findAll ();
$cltPosicaoSelecionar = $posicaoBusiness->findAll ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );

$rankingBean = new RankingBean();
$rankingBusiness= new RankingBusiness();

$rankingBean->setCampeonato($selcampeonatoBean );

$cltRanking = $rankingBusiness->findByCampeonato($rankingBean);
Util::echobr ( $dbg, 'RankingFaceControl    $cltRanking ', $cltRanking );
$categorias = array();

for($i = 0; $i < count ( $cltRanking); $i ++) {
	$rankingBean = $cltRanking[$i];
	$info = $rankingBean->getinfo();
	if (!in_array($info, $categorias )) {
		$categorias[] = $info;
	}
}
$dbg=0;
$rankingBean->setEtapa($seletapa );
$rankingBean->setInfo($selcategoria );
$rankingBean = $rankingBusiness->findAtualEtapaInfo($rankingBean);
$tbname = 'kart_ranktemp_'.$selcategoria.'_'.$rankingBean->getid();
Util::echobr ($dbg, "RankingPg findRankTemp", $tbname );
$collection = $rankingBusiness->findRankTemp( $rankingBean );

Util::echobr ( $dbg, 'RankingFaceControl    $categorias', $categorias);
$urlC = LISTAR;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
Util::echobr ( $dbg, 'RankingFaceControl   $siteUrl', $siteUrl);
		
include ($siteUrl);
?>