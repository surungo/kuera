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
require_once PATHPUBFAC . '/ButtonClass.php';
$dbg = 0;
$button = new ButtonClass ();
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
$bean->setpiloto ( (isset ( $_POST ['piloto'] )) ? $_POST ['piloto'] : null );
Util::echobr ( $dbg, 'PilotoBateriaControl  $bean->getpiloto', $bean->getpiloto () );

$bean->setbateria ( (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : null );

$bean->setgridlargada ( (isset ( $_POST ['gridlargada'] )) ? $_POST ['gridlargada'] : null );
Util::echobr ( $dbg, 'PilotoBateriaControl  $bean->getgridlargada', $bean->getgridlargada () );

$bean->setpresente ( (isset ( $_POST ['presente'] )) ? $_POST ['presente'] : null );
$bean->setposicao ( (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : null );
$bean->setkart ( (isset ( $_POST ['kart'] )) ? $_POST ['kart'] : null );
$bean->setvolta ( (isset ( $_POST ['volta'] )) ? $_POST ['volta'] : null );
$bean->setna ( (isset ( $_POST ['na'] )) ? $_POST ['na'] : null );
$bean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$bean->setpregridlargada ( (isset ( $_POST ['pregridlargada'] )) ? $_POST ['pregridlargada'] : null );
$bean->setposicaooficial ( (isset ( $_POST ['posicaooficial'] )) ? $_POST ['posicaooficial'] : null );
$bean->setkartlargada ( (isset ( $_POST ['kartlargada'] )) ? $_POST ['kartlargada'] : null );

$bean->setpenalizacao ( (isset ( $_POST ['penalizacao'] )) ? $_POST ['penalizacao'] : null );
$bean->setcartaoamarelo ( (isset ( $_POST ['cartaoamarelo'] )) ? $_POST ['cartaoamarelo'] : null );
$bean->setconvidado ( (isset ( $_POST ['convidado'] )) ? $_POST ['convidado'] : null );

$bean->setinformacao ( (isset ( $_POST ['informacao'] )) ? $_POST ['informacao'] : null );
$bean->setobservacao ( (isset ( $_POST ['observacao'] )) ? $_POST ['observacao'] : null );

$bean->getpostlog ();
$editar = true;
$novo = true;

$urlCmais = "";
switch ($choice) {
	case Choice::ADICIONAR :
		Util::echobr ( 0, 'PilotoBateriaControl  choice ADICIONAR', $choice );
		$cltPilotoSelecionar = $pilotoBusiness->findCampeonatoNotBateria ( $selcampeonato );
		$urlCmais = "Piloto";
		$urlC = LISTAR;
		break;
	case Choice::VOLTAR :
		
		$urlC = EDITAR;
		break;
	case Choice::SALVA_U :
		$bean->setpiloto ( $pilotoBusiness->findById ( Util::getIdObjeto ( $bean->getpiloto () ) ) );
		Util::echobr ( $dbg, 'BateriaControl SALVA_U getNomeObjeto $bean->getpiloto', Util::getNomeObjeto ( $bean->getpiloto () ) );
		$urlC = EDITAR;
		break;
	case Choice::EXCLUIR :
		if ($pilotoBateriaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		// opcional server como padrao desta pagina
		$clsort = (isset ( $_POST ['clsort_' . $idurl] )) ? $_POST ['clsort_' . $idurl] : '';
		$bean->setsort ( $clsort );
		$collection = $pilotoBateriaBusiness->findBateria (  $bean );
		// $collection = $pilotoBateriaBusiness->findAll();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $pilotoBateriaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		// opcional server como padrao desta pagina
		// $bean->setsort((isset($_POST['clsort']))?$_POST['clsort']:'nome desc');
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		
		if ($idobj > 0) {
			$bean = $pilotoBateriaBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);;
?>