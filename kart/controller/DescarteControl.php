<?php
$dbg = 0;
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteBean.php';
include_once PATHAPP . '/mvc/kart/model/business/DescarteBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteEtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/DescarteEtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';


$bean = new DescarteBean ();
$descarteBusiness = new DescarteBusiness ();
$descarteEtapaBusiness = new DescarteEtapaBusiness ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaBusiness = new CategoriaBusiness();
$etapaBusiness = new EtapaBusiness ();
$parametroBusiness = new ParametroBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
Util::echobr ( $dbg, 'DescarteControl  $idobj ', $idobj );
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setnumero ( (isset ( $_POST ['numero'] )) ? $_POST ['numero'] : null );
$bean->setquantidade ( (isset ( $_POST ['quantidade'] )) ? $_POST ['quantidade'] : null );

$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();
$bean->setcampeonato ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $parametroBusiness->findByCodigo ( ParametroEmun::CAMPEONATO_PRINCIPAL ) );
if ($bean->getcampeonato () == null || $bean->getcampeonato () == "" || $bean->getcampeonato () == 0) {
	$selcampeonato = $parametroBusiness->findByCodigo ( ParametroEmun::CAMPEONATO_PRINCIPAL );
} else {
	if ($bean->getcampeonato () != null) {
		$selcampeonato = $bean->getcampeonato ();
	}
}
Util::echobr ( $dbg, 'DescarteControl $selcampeonato ', $selcampeonato );

$seletapaCollection = $etapaBusiness->findByCampeonato ( $selcampeonato );

$descarteEtapaClt = null;
$multi =  (isset ( $_POST ['etapas'] )) ? $_POST ['etapas'] : null;
$N = count ( $multi );
Util::echobr($dbg,"DescarteControl N", $N);
Util::echobr($dbg,"DescarteControl multi ", $multi);
for($i = 0; $i < $N; $i ++) {
	$etapaBean = new EtapaBean();
	$etapaBean->setid( $multi [$i] );
	$descarteEtapaBean = new DescarteEtapaBean();
	$descarteEtapaBean->setetapa( $etapaBean  );
	$descarteEtapaBean->setdescarte( $bean );
	$descarteEtapaClt [] = $descarteEtapaBean ;
}

$bean->setdescarteetapa($descarteEtapaClt );

Util::echobr ( $dbg, 'DescarteControl $bean->getdescarteetapa', $bean->getdescarteetapa() );

$bean->getpostlog ();
$editar = true;
if ($selcampeonato != null) {
	$novo = true;
} else {
	$novo = false;
}

Util::echobr ( $dbg, 'DescarteControl $choice', $choice );
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($descarteBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
	default :
		Util::echobr ( 0, 'DescarteControl listar ', 1);
		$collection = $descarteBusiness->findByEventoSortAtivo( $bean );
		
		Util::echobr ( $dbg, 'DescarteControl lista $collection  ', $collection );
		$urlC = LISTAR;
		break;
		
	case Choice::SALVAR :
		$dbg = 0;
		Util::echobr ( $dbg, 'DescarteControl SALVAR $idobj ', $idobj );
		
		$retorno = $descarteBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ()->getid ();
		Util::echobr ( $dbg, 'DescarteControl DEPOIS DE SALVAR $idobj ', $idobj );
		$mensagem = $retorno->getmensagem ();
		
		
	case Choice::ABRIR :
		$dbg = 0;
		Util::echobr ( $dbg, 'DescarteControl ABRIR $idobj ', $idobj );
		
		if ($idobj > 0) {
			$dbg = 1;
			$bean = $descarteBusiness->findById( $idobj );
			Util::echobr ( $dbg, 'DescarteControl ABRIR $bean ',$bean );

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