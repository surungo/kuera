<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/business/VotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/GrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorCategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';



$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$siglaCampeonato = "NDC";
$campeonatoBean = $campeonatoBusiness->findBySigla ( $siglaCampeonato );
Util::echobr ( 0, '$campeonatoBean', $campeonatoBean );
Util::echobr ( 0, '$campeonatoBean->getnome()', $campeonatoBean->getnome () );
$campeonato = Util::getIdObjeto ( $campeonatoBean );

$grupoBusiness = new GrupoBusiness ();
$votoBusiness = new VotoBusiness();
$eleitoBusiness = new EleitorBusiness();
$eleitorCategoriaGrupoBusiness = new EleitorCategoriaGrupoBusiness();

$urlOpcoes = "";

switch ($choice) {

	case Choice::ABRIR :
		$grupoBean = $grupoBusiness->findById($idobj);
		$resultadoVotos = $votoBusiness->relatorioFinalEleitorByGrupo($idobj);
		$totalVotos = $votoBusiness->totalVotosByGrupo($idobj);
		$totalEleitor =$eleitoBusiness->totalByGrupo($idobj);
		$atualizar = false;
		$urlOpcoes = "Grupo";
		$beanPaginaAtual->setnome($beanPaginaAtual->getnome()." - ".$urlOpcoes.": ".Util::getNomeObjeto($grupoBean));
		break;

	case Choice::LISTAR:
		$grupoclt = $grupoBusiness->findByCampeonatoAtivos($campeonato);
		$totalVotosGeral = $votoBusiness->totalVotosByCampeonato($campeonato);
		$totalEleitorGeral =$eleitoBusiness->totalByCampeonato($campeonato);
		
		$totalEleitoresGeral = $eleitoBusiness->totalEleitoresByCampeonato($campeonato);
		$totalEleitoresVotaramGeral = $votoBusiness->totalEleitoresByCampeonato($campeonato);
		break;
}


$urlC = REPORT;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);?>