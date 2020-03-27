<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PistaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PistaBusiness.php';

$bean = new PistaBean ();
$pistaBusiness = new PistaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setsentido ( (isset ( $_POST ['sentido'] )) ? $_POST ['sentido'] : null );
$bean->setlocal ( (isset ( $_POST ['local'] )) ? $_POST ['local'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->getpostlog ();

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pistaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $pistaBusiness->findAllSort ( $bean );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $pistaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pistaBusiness->findById ( $idobj );
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