<?php
include_once PATHPUBFAC . '/Util.php';
include_once 'AbstractControl.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PistaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PistaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoEsquemaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontuacaoEsquemaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
$dbg = 0;
Util::echobr ( $dbg, 'BateriaControl  ', 1);

$bean = new BateriaBean ();
$bateriaBusiness = new BateriaBusiness ();
$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaBusiness = new CategoriaBusiness ();

$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'BateriaControl  $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );

$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : $seletapa;
Util::echobr ( $dbg, 'BateriaControl  $seletapa', $seletapa );

$dbg = 0;
$bean->setbateriaprecedente( (isset ( $_POST ['bateriaprecedente'] )) ? $_POST ['bateriaprecedente'] : null);
Util::echobr ( $dbg, 'BateriaControl  $$bean->getbateriaprecedente(', $bean->getbateriaprecedente());

$idetapaPrecedenteselect = (isset ( $_POST ['etapaprecedente'] )) ? $_POST ['etapaprecedente'] : null;

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setdtbateria ( (isset ( $_POST ['dtbateria'] ) && $_POST ['dtbateria'] != "") ? Util::strtotimestamp ( $_POST ['dtbateria'] ) : "" );

$bean->seturlresultados ( (isset ( $_POST ['urlresultados'] )) ? $_POST ['urlresultados'] : null );
$bean->setetapa ( (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : null );
$bean->setpista ( (isset ( $_POST ['pista'] )) ? $_POST ['pista'] : null );
$bean->setcategoria ( (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : null );
$bean->setpontuacaoesquema ( (isset ( $_POST ['pontuacaoesquema'] )) ? $_POST ['pontuacaoesquema'] : null );
Util::echobr ( $dbg, 'BateriaControl   $bean->getpontuacaoesquema()', $bean->getpontuacaoesquema () );

$bean->getpostlog ();
$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($bateriaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $bateriaBusiness->findBateriaByCampeonatoEtapa ( $selcampeonato, $seletapa );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$retorno = $bateriaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		$campeonatobean = new CampeonatoBean ();
		$etapabean = new EtapaBean ();
		$pistabean = new PistaBean ();
		$pontuacaoEsquemaBean = new PontuacaoEsquemaBean ();
		$etapabean->setcampeonato ( $campeonatobean );
		$bean->setetapa ( $etapabean );
		$bean->setpista ( $pistabean );
		$bean->setpontuacaoEsquema ( $pontuacaoEsquemaBean );
		$categoriaclt = $categoriaBusiness->findByCampeonato($selcampeonato);

		$idbateriaprecedenteselect = Util::getIdObjeto ( $bean->getbateriaprecedente() );			
		if ($idobj > 0) {
			$bean = $bateriaBusiness->findById ( $idobj );
		}
		if(Util::getIdObjeto ( $bean->getbateriaprecedente() )>0){
			$bateriaprecedenteBean = new BateriaBean();
			$idbateriaprecedenteselect = Util::getIdObjeto ( $bean->getbateriaprecedente() );
			$bateriaprecedenteBean = $bateriaBusiness->findById ( $idbateriaprecedenteselect );
			$idetapaPrecedenteselect = Util::getIdObjeto ( $bateriaprecedenteBean->getetapa() )>0?Util::getIdObjeto ( $bateriaprecedenteBean->getetapa() ):$idetapaPrecedenteselect;
			$bean->setbateriaprecedente($bateriaprecedenteBean);
		}
		
		if($idetapaPrecedenteselect != 0){
			$cltBateriaPrecedenteCollection = $bateriaBusiness->findBateriaByCampeonatoEtapa ( $selcampeonato, $idetapaPrecedenteselect );			
		}
				
		
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		// $etapaBusiness = new EtapaBusiness();
		// $cltEtapaSelecionar = $etapaBusiness->findAll();
		
		$pontuacaoEsquemaBusiness = new PontuacaoEsquemaBusiness ();
		$cltPontuacaoEsquemaSelecionar = $pontuacaoEsquemaBusiness->findAll ();
		
		$campeonatoBusiness = new CampeonatoBusiness ();
		$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
		
		if ($idobj < 1 || $bean->getetapa ()->getcampeonato ()->getid () < 1) {
			$bean->getetapa ()->getcampeonato ()->setid ( $selcampeonato );
		}
		$etapaBusiness = new EtapaBusiness ();
		$cltEtapaCollection = $etapaBusiness->findByCampeonato ( $selcampeonato );
		
		if ($idobj < 1 || $bean->getetapa ()->getid () < 1) {
			$bean->getetapa ()->setid ( $seletapa );
		}
		
		$pistaBusiness = new PistaBusiness ();
		$cltPistaCollection = $pistaBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>