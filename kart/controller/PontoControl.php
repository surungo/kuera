<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

$bean = new PontoBean ();
$pontoBusiness = new PontoBusiness ();

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setposicao ( (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : null );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$bean->setdescartavel ( (isset ( $_POST ['descartavel'] )) ? $_POST ['descartavel'] : null );
$bean->setidcampeonato ( (isset ( $_POST ['idcampeonato'] )) ? $_POST ['idcampeonato'] : null );
$bean->setsort ( (isset ( $_POST ['clsort'] )) ? $_POST ['clsort'] : null );
$bean->setativo ( (isset ( $_POST ['ativo'] )) ? $_POST ['ativo'] : null );

$bean->getpostlog ();
$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pontoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $pontoBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$retorno = $pontoBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pontoBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		$cltCampeonatoSelecionar = $campeonatoBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>