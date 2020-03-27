<?php
include_once PATHPUBBUS . '/PaginaBusiness.php';
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBUS . '/ItemBusiness.php';
include_once PATHPUBFAC . '/Util.php';

$bean = new ItemBean ();
$itemBusiness = new ItemBusiness ();
$paginaBusiness = new PaginaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setcodigo ( (isset ( $_POST ['codigo'] )) ? $_POST ['codigo'] : null );

$editar = false;
$novo = false;
for($i = 0; $i < count ( $itemCollection ); $i ++) {
	$itemBean = new ItemBean ();
	$itemBean = $itemCollection [$i];
	if ($itemBean->getcodigo () == "ITEM_EDITAR") {
		$editar = true;
	}
	if ($itemBean->getcodigo () == "ITEM_NOVO") {
		$novo = true;
	}
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($itemBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $itemBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $itemBusiness->salve ( $bean );
		$idobj = Util::getIdObjeto($retorno->getresposta());
		$mensagem = $retorno->getmensagem();
		
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $itemBusiness->findById ( $idobj );
		} else {
			$bean = new ItemBean ();
		}
		$ctlPagina = $paginaBusiness->findAll ();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>