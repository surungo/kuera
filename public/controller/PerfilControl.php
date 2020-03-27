<?php
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBUS . '/PerfilBusiness.php';
include_once PATHPUBBEAN . '/PaginaBean.php';
include_once PATHPUBBUS . '/PaginaBusiness.php';

include_once PATHPUBFAC . '/Util.php';

$bean = new PerfilBean ();
$perfilBusiness = new PerfilBusiness ();

$paginaBusiness = new PaginaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setpaginacapa ( (isset ( $_POST ['idpaginaCapa'] )) ? $_POST ['idpaginaCapa'] : null );

$editar = true;
$novo = true;
for($i = 0; $i < count ( $itemCollection ); $i ++) {
	$itemBean = new ItemBean ();
	$itemBean = $itemCollection [$i];
	if ($itemBean->getcodigo () == "PERFIL_EDITAR") {
		$editar = true;
	}
	if ($itemBean->getcodigo () == "PERFIL_NOVO") {
		$novo = true;
	}
	if ($itemBean->getcodigo () == "PERFIL_EXCLUIR") {
		$excluir = true;
	}
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($perfilBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $perfilBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $perfilBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $perfilBusiness->findById ( $idobj );
		}
		$cltPaginaSelecionar = $paginaBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>