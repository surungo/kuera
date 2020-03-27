<?php
include_once PATHPUBBEAN . '/PaginaBean.php';
include_once PATHPUBBUS . '/PaginaBusiness.php';
include_once PATHPUBBUS . '/SistemaBusiness.php';
include_once PATHPUBFAC . '/Util.php';

$bean = new PaginaBean ();
$paginaBusiness = new PaginaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->seturl ( (isset ( $_POST ['url'] )) ? $_POST ['url'] : null );
$bean->setordem ( (isset ( $_POST ['ordem'] )) ? $_POST ['ordem'] : null );
$bean->sethierarquia ( (isset ( $_POST ['hierarquia'] )) ? $_POST ['hierarquia'] : null );
$bean->settarget ( (isset ( $_POST ['idtarget'] )) ? $_POST ['idtarget'] : null );
$bean->setvisivel ( (isset ( $_POST ['visivel'] )) ? $_POST ['visivel'] : null );
$bean->setativo ( (isset ( $_POST ['ativo'] )) ? $_POST ['ativo'] : null );
$bean->setsistema ( (isset ( $_POST ['sistema'] )) ? $_POST ['sistema'] : null );

$editar = true;
$novo = true;
/*
 * for ($i = 0; $i < count($itemCollection); $i++) { $itemBean = new ItemBean(); $itemBean = $itemCollection[$i]; if($itemBean->getcodigo()=="PAGINA_EDITAR"){ $editar = true; } if($itemBean->getcodigo()=="PAGINA_NOVO"){ $novo = true; } }
 */

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($paginaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $paginaBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $paginaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $paginaBusiness->findById ( $idobj );
		}
		$cltPagina = $paginaBusiness->findAll ();
		$cltSistema = $sistemaBusiness->findAll ();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>