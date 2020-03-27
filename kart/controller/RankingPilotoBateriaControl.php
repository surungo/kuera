<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingPilotoBateriaBusiness.php';
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

$bean= new RankingPilotoBateriaBean();
$rankingPilotoBateriaBusiness= new RankingPilotoBateriaBusiness();
$pilotoBateriaBean  = new PilotoBateriaBean ();
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
Util::echobr ( $dbg, 'RankingPilotoBateriaControl  $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : '';
$seletapabean = $seletapaBusiness->findById ( $seletapa );
Util::echobr ( $dbg, 'RankingPilotoBateriaControl  $seletapa', $seletapa );

$selbateriabean = new BateriaBean ();
$selbateriaBusiness = new BateriaBusiness ();
$selbateriabean->setetapa ( $seletapabean );
$selbateriaCollection = $selbateriaBusiness->findBateriaByEtapa ( $selbateriabean );
$selbateria = (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : '';
$selbateriabean = $selbateriaBusiness->findById ( $selbateria );
Util::echobr ( $dbg, 'RankingPilotoBateriaControl  $selbateria', $selbateria );

$usuarioCollection = $usuarioBusiness->findAll ();
$cltPosicaoSelecionar = $posicaoBusiness->findAll ();


$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );

$bean->setdonovolta ( (isset ( $_POST ['donovolta'] )) ? $_POST ['donovolta'] : null );
$bean->setmelhorpessoal ( (isset ( $_POST ['melhorpessoal'] )) ? $_POST ['melhorpessoal'] : null );
$bean->setpontos ( (isset ( $_POST ['pontos'] )) ? $_POST ['pontos'] : null );


$bean->getpostlog ();
$editar = true;
$novo = true;

$urlCmais = "";

Util::echobr ( $dbg, 'RankingPilotoBateriaControl  $choice', $choice);
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($rankingPilotoBateriaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		// opcional server como padrao desta pagina
		$clsort = (isset ( $_POST ['clsort_' . $idurl] )) ? $_POST ['clsort_' . $idurl] : '';
		$bean->setsort ( $clsort );
		$dbg = 0;
		Util::echobr ( $dbg, 'RankingPilotoBateriaControl $selcampeonato,$seletapa,$selbateria ', 
		$selcampeonato.','.$seletapa.','.$selbateria );
		$collection = $rankingPilotoBateriaBusiness->findByIdCampeonatoEtapaBateria($selcampeonato,$seletapa,$selbateria );
		//$collection = $rankingPilotoBateriaBusiness->findAll();
		$dbg = 0;
		Util::echobr ( $dbg, 'RankingPilotoBateriaControl $collection ', $collection  );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $rankingPilotoBateriaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		// opcional server como padrao desta pagina
		// $bean->setsort((isset($_POST['clsort']))?$_POST['clsort']:'nome desc');
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		
		if ($idobj > 0) {
			$bean = $rankingPilotoBateriaBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>