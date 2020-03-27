<?php
include_once PATHPUBBEAN . '/SessionBean.php';
include_once PATHPUBBUS . '/SessionBusiness.php';
include_once PATHPUBFAC . '/Util.php';

$bean = new SessionBean ();
$sessionBusiness = new SessionBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setkeysession ( (isset ( $_POST ['keysession'] )) ? $_POST ['keysession'] : null );
$bean->setusuario ( (isset ( $_POST ['idusuario'] )) ? $_POST ['idusuario'] : null );
$bean->setip ( (isset ( $_POST ['ip'] )) ? $_POST ['ip'] : null );

$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($sessionBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $sessionBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $sessionBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $sessionBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>