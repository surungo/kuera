<?php
$dbg = 0;
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingPilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingEtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingEtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';


$bean = new RankingBean ();
$rankingPilotoClt = Array ();
$rankingBusiness = new RankingBusiness ();
$rankingPilotoBusiness = new RankingPilotoBusiness ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaBusiness = new CategoriaBusiness();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();
$etapaBusiness = new EtapaBusiness ();
$parametroBusiness = new ParametroBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
Util::echobr ( $dbg, 'RankingControl  $idobj ', $idobj );
$bean->setid ( $idobj );
$bean->setinfo ( (isset ( $_POST ['info'] )) ? $_POST ['info'] : null );
$bean->setdescarte ( (isset ( $_POST ['descarte'] )) ? $_POST ['descarte'] : null );
$bean->setcategoria ( (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : null );
$bean->settabelaranking ( (isset ( $_POST ['tabelaranking'] )) ? $_POST ['tabelaranking'] : null );
$bean->setcampeonato ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $parametroBusiness->findByCodigo ( ParametroEmun::CAMPEONATO_PRINCIPAL ) );
$bean->setetapa ( (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : null );

$idRankingPiloto = (isset ( $_POST ['rankingpiloto'] )) ? $_POST ['rankingpiloto'] : null;
$pontosRankingPiloto = (isset ( $_POST ['pontuacao_' . $idRankingPiloto] )) ? $_POST ['pontuacao_' . $idRankingPiloto] : null;
Util::echobr ( $dbg, 'RankingControl $idRankingPiloto  ', $idRankingPiloto );
if ($bean->getcampeonato () == null || $bean->getcampeonato () == "" || $bean->getcampeonato () == 0) {
	$selcampeonato = $parametroBusiness->findByCodigo ( ParametroEmun::CAMPEONATO_PRINCIPAL );
} else {
	if ($bean->getcampeonato () != null) {
		$selcampeonato = $bean->getcampeonato ();
	}
}
Util::echobr ( $dbg, 'RankingControl $selcampeonato ', $selcampeonato );
$seletapaCollection = $etapaBusiness->findByCampeonato ( $selcampeonato );

$bean->setetapa ( (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : null );
if ($bean->getetapa () != null) {
	$seletapa = $bean->getetapa ();
}

$rankingEtapaClt = null;
$multi =  (isset ( $_POST ['etapas'] )) ? $_POST ['etapas'] : null;
$N = count ( $multi );
Util::echobr($dbg,"RankingControl N", $N);
Util::echobr($dbg,"RankingControl multi ", $multi);
for($i = 0; $i < $N; $i ++) {
	$etapaBean = new EtapaBean();
	$etapaBean->setid( $multi [$i] );
	$rankingEtapaBean = new RankingEtapaBean();
	$rankingEtapaBean->setetapa( $etapaBean  );
	$rankingEtapaBean->setranking( $bean );
	$rankingEtapaClt [] = $rankingEtapaBean ;
}

$bean->setrankingetapaclt($rankingEtapaClt );

Util::echobr ( $dbg, 'RankingControl $bean->getrankingetapaclt', $bean->getrankingetapaclt() );

$bean->getpostlog ();
$editar = true;
if ($selcampeonato != null) {
	$novo = true;
} else {
	$novo = false;
}
$dbg = 0;
Util::echobr ( $dbg, 'RankingControl $choice', $choice );
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($rankingBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
	default :
		$collection = $rankingBusiness->findAllCampeonato ( $bean );
		
		$dbg=0;
		Util::echobr ( $dbg, 'RankingControl lista $collection  ', $collection );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
	case Choice::PASSO_1 :
		$retorno = $rankingBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ()->getid ();
		if ($idobj > 0) {
			$bean = $rankingBusiness->findByIdEdit ( $idobj );
		}
		$mensagem = $retorno->getmensagem ();
		
		if(Choice::PASSO_1 == $choice){
			$dbg = 0;
			Util::echobr ( $dbg, "RankingControl PASSO_1 Atualiza ranking", 0 );
			$retorno = $rankingBusiness->atualizaRanking( $idobj );
			Util::echobr ( $dbg, "RankingControl PASSO_1 Atualiza ranking", 1 );
			
		}
	case Choice::ABRIR :
		$dbg =0;
		Util::echobr ( $dbg, 'RankingControl ABRIR $idobj ', $idobj );
		
		if ($idobj > 0) {
			$dbg = 0;
			$bean = $rankingBusiness->findByIdEdit ( $idobj );
			Util::echobr ( $dbg, 'RankingControl ABRIR $bean ',$bean );
			$categoriaclt = $categoriaBusiness->findByCampeonato($selcampeonato);
			
			Util::echobr ( $dbg, 'RankingControl ABRIR $categoriaclt ', $categoriaclt  );
			$cltTabela = $rankingBusiness->findRankTemp( $bean );
			$dbg =0;		
			Util::echobr ( $dbg, 'RankingControl ABRIR $cltTabela ', $cltTabela );

		}
		if ($bean->getetapa () != null) {
			$seletapa = $bean->getetapa ();
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
	
	
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";

include ($siteUrl);



?>