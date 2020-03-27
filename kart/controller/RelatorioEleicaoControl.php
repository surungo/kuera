<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/business/VotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/GrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/VotoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

$dbg = 0;

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$cvoto = (isset ( $_POST ['cvoto'] )) ? $_POST ['cvoto'] : 0;
$agrupar = (isset ( $_POST ['agrupar'] )) ? $_POST ['agrupar'] : 0;
$totalgrps = (isset ( $_POST ['totalgrps'] )) ? $_POST ['totalgrps'] : 0;
$tresgrps= (isset ( $_POST ['tresgrps'] )) ? $_POST ['tresgrps'] : 0;

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();


//$selcampeonatobean = new CampeonatoBean ();
//$campeonatoBusiness = new CampeonatoBusiness ();
$tipos = array(TipoEventoEnum::ELEICAO);
if(Util::getIdObjeto($usuarioLoginBean->getperfil())==1){ // desenv
	$cltCampeonatoCollection = $campeonatoBusiness->findByTipos($tipos);
}else{
	$cltCampeonatoCollection = $campeonatoBusiness->findByTiposAtivos($tipos);	
}
	

//$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
// campeonato ativo
//$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
$selcampeonatoBean = $campeonatoBusiness->atualByTipo ($tipos[0]);
$selcampeonato = (isset ( $_POST ['campeonato'] ) ) ? 
					$_POST ['campeonato'] : Util::getIdObjeto($selcampeonatoBean);


$campeonatoTipoOk = false;
for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
	$idcampeonatobean = $cltCampeonatoCollection [$i];
	if($idcampeonatobean == $selcampeonato){
		$campeonatoTipoOk = true;
		break;
	}
}
if(!$campeonatoTipoOk || $selcampeonato == null|| $selcampeonato == ""){
	$selcampeonato = Util::getIdObjeto($selcampeonatoBean);
}

Util::echobr ( $dbg, 'RelatorioEleicaoControl $selcampeonato', $selcampeonato );
	


$grupoBusiness = new GrupoBusiness ();
$votoBusiness = new VotoBusiness();
$eleitoBusiness = new EleitorBusiness();
$candidatoBusiness = new CandidatoBusiness();

$urlOpcoes = "";


$resultadoVotos = $votoBusiness->relatorioFinal($selcampeonato);

$totalVotosGeral = $votoBusiness->totalVotosByCampeonato($selcampeonato);

$totalEleitorGeral = $eleitoBusiness->totalByCampeonato($selcampeonato);

$totalEleitoresGeral = $eleitoBusiness->totalEleitoresByCampeonato($selcampeonato);

$totalEleitoresVotaramGeral = $votoBusiness->totalEleitoresByCampeonato($selcampeonato);
		


$urlC = REPORT;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);?>